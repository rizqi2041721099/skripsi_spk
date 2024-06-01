@extends('layouts.frontend.app-detail')
@section('title-head')
    Detail
@endsection
@section('list')
    <li class="breadcrumb-item text-white active" aria-current="page">Restaurants</li>
@endsection
@section('content')
<div class="container-xxl py-5" id="about-us">
    <div class="container">
        <div class="row g-5 align-items-center">
            <h1 class="mb-4">Welcome to <i class="fa fa-utensils text-primary me-2"></i>Restoran {{ $restaurant->name }}</h1>
            <div class="col-md-4">
                @if (is_null($restaurant->images) || $restaurant->images == '')
                    <img src="{{ asset('frontend/img/restaurant.jpg')}}" alt="img" class="rounded" width="100%">
                @else
                    <img src="{{ Storage::url('public/images/restaurants/' . $restaurant->images) }}"
                        alt="img" class="rounded" width="100px" height="150px">
                @endif
            </div>
            <div class="col-md-6">
                <h4>Detail Restaurant</h4>
                <table class="table table-borderless">
                    <tr>
                        <th>Alamat</th>
                        <td class="text-end">{{ $restaurant->address }}</td>
                    </tr>
                    <tr>
                        <th>Fasilitas</th>
                        <td class="text-end">
                            @if (!$restaurant->facilities)
                                -
                            @else
                                @foreach ($restaurant->facilities as $item)
                                    {{ $item->name . ', ' }}
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Jarak</th>
                        <td class="text-end">{{ $restaurant->distance }} m</td>
                    </tr>
                    <tr>
                        <th>Link Gmaps</th>
                        <td class="text-end">
                        @if (empty($restaurant->map_link))
                            <span class="text-danger fw-bold">tidak ada link gmaps</span>
                        @else
                            <a href="{{ $restaurant->map_link }}" class="btn btn-sm btn-primary" target="_blank"><i
                                    class="fa fa-map-marker" aria-hidden="true"></i>
                                check location</a>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Rata - Rata Harga</th>
                        <td class="text-end"> {{ number_format($restaurant->average) }}</td>
                    </tr>
                    <tr>
                        <th>Qty Variasi Makanan</th>
                        <td class="text-end">  {{ $restaurant->qty_variasi_makanan }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12">
                <h4>Variasi Menu</h4>
                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($food_variaty as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ number_format($item->price) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>Harga</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-12">
                <h4>Data Alternatif</h4>
                <table class="table table-bordered" width="100%" id="alternatif_table">
                    <thead>
                        <tr>
                            <th rowspan="2" width="15%">Restaurant</th>
                            <th colspan="5" class="text-center">Kriteria</th>
                        </tr>
                        <tr>
                            <th>Harga Makanan</th>
                            <th>Jarak</th>
                            <th>Fasilitas</th>
                            <th>Rasa Makanan</th>
                            <th>Variasi Makanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $restaurant->name }}</td>
                            <td>{{ $restaurant->harga->value }}</td>
                            <td>{{ $restaurant->jarak->value }}</td>
                            <td>{{ $restaurant->fasilitas->value }}</td>
                            <td>{{ $restaurant->rasa->value }}</td>
                            <td>{{ $restaurant->variasiMenu->value }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Restaurant</th>
                            <th>Harga Makanan</th>
                            <th>Jarak</th>
                            <th>Fasilitas</th>
                            <th>Rasa Makanan</th>
                            <th>Variasi Makanan</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="form_comment">
                        @csrf
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}"></input>
                        <div class="row">
                            <div class="col-md-2 mt-3">
                                <label for="">Tinggalkan Rating</label>
                            </div>
                            <div class="col">
                                <div class="rating">
                                    <label>
                                        <input type="radio" name="star_rating" value="1" />
                                        <span class="icon">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="star_rating" value="2" />
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="star_rating" value="3" />
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="star_rating" value="4" />
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="star_rating" value="5" />
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                    </label>
                                </div>
                                <small class="text-danger" id="error-star-rating"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Coba Jelaskan Pengalaman Anda</label>
                            <textarea id="content" cols="30" rows="3" class="form-control" name="content"></textarea>
                        </div>
                        <button type="submit" id="submit-button" class="btn btn-sm btn-primary mt-2"
                            data-loading-text="Loading...">Post Comment</button>
                    </form>
                    @if (count($commentList) > 0)
                        <div class="comment-list my-5">
                            <section style="background-color: #f7f6f6;">
                                <div class="row d-flex justify-content-start">
                                    <div class="col-md-12 col-lg-10 p-4">
                                        <h4 class="mb-0">Recent comments</h4>
                                        <p class="fw-light mb-4">Latest Comments section by users</p>
                                        @foreach ($commentList as $comment)
                                            <div class="card-body p-4">
                                                <div class="d-flex flex-start">
                                                    <img class="rounded-circle img-fluid" src="{{ asset('assets/img/boy.png') }}" alt="avatar" style="width: 50px; height: 50px;" />
                                                    <div class="mx-2">
                                                        <h6 class="mb-1"><span class="font-weight-bold">{{ $comment->user->name }} </span> <span class=""><small> {{  \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }} </small></span> </h6>
                                                        <p class="mb-0">
                                                            {{ $comment->content }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-4">
                                                    <div class="d-flex align-items-center">
                                                        <a href="#!" class="link-muted mx-4 like-btn" data-comment-id="{{ $comment->id }}"><i class="fas fa-thumbs-up me-1"></i>0</a>
                                                        <a href="#!" class="link-muted"><i class="fas fa-thumbs-down me-1"></i>0</a>
                                                    </div>
                                                    <a type="button" class="link-muted btn-reply" data-comment-id="{{ $comment->id }}" data-restaurant-id="{{ $restaurant->id }}"><i class="fas fa-reply me-1"></i> Reply</a>
                                                </div>
                                                @if(count($comment->replies) > 0)
                                                    <ul class="nested-comments">
                                                        @foreach($comment->replies as $reply)
                                                            <li style="list-style: none">
                                                                <div class="card-body p-4">
                                                                    <div class="d-flex flex-start">
                                                                        <img class="rounded-circle img-fluid" src="{{ asset('assets/img/boy.png') }}" alt="avatar" style="width: 50px; height: 50px;" />
                                                                        <div class="mx-2">
                                                                            <h6 class="mb-1"> <span class="font-weight-bold"> {{ $reply->user->name }} </span> <small>{{  \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}</small></h6>
                                                                            <p class="mb-0">
                                                                                {{ $reply->content }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                                                        <div class="d-flex align-items-center">
                                                                            <a href="#!" class="link-muted mx-4 like-btn" data-comment-id="{{ $reply->id }}"><i class="fas fa-thumbs-up me-1"></i>{{ $reply->likes }}</a>
                                                                            <a href="#!" class="link-muted"><i class="fas fa-thumbs-down me-1"></i>0</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Recursive Call for Nested Replies -->
                                                                {{-- @include('pages.restaurant.nested_comment', ['comment' => $reply]) --}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                                <!-- End of Nested Comments -->
                                            </div>
                                            <hr class="my-0" />
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script type="application/javascript">
    $(document).ready(function () {
        var loggedIn = {{ auth()->check() ? 'true' : 'false' }};

        $(document).on('click', '.btn-reply', function(e) {
            e.preventDefault();
            if (!loggedIn){
                window.location.href = '/signin';
            } else {
                var cardBody = $(this).closest('.card-body');
                var restaurantId = $(this).data('restaurant-id');
                var commentId = $(this).data('comment-id');
                var form = `
                    <form id="form-reply-comment" class="my-2">
                        @csrf
                        <input type="hidden" value="${restaurantId}" name="restaurant_id" id="restaurant_id" />
                        <input type="hidden" value="${commentId}" name="parent_id" id="parent_id" />
                        <div class="form-group">
                            <textarea id="content" cols="30" rows="" class="form-control" name="content" autofocus></textarea>
                        </div>
                        <div class="d-inline-block mt-2">
                            <button type="button" class="btn btn-sm btn-outline-danger rounded cancel-button">Cancel</button>
                            <button type="button" class="btn btn-sm btn-outline-primary rounded submit-button" data-loading-text="Loading...">Send</button>
                        </div>
                    </form>`;
                cardBody.append(form);
                cardBody.data('replyButton', $(this));
                $(this).hide();
            }
        });

        $(document).on('click', '.cancel-button', function(e) {
            e.preventDefault();
            var cardBody = $(this).closest('.card-body');
            $(this).closest('#form-reply-comment').remove();
            cardBody.data('replyButton').show();
        });

        $(document).on('click', '.submit-button', function(e) {
            e.preventDefault();
            if (!loggedIn){
                window.location.href = '/signin';
            } else {
                var form = $(this).closest('form');
                var btn = $(this);
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var formData = new FormData(form[0]);

                btn.attr('disabled', true);
                btn.text(btn.data("loading-text"));

                $.ajax({
                    url: "{{ route('comment.store') }}",
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success == true) {
                            form[0].reset();
                            toastr.success(response.message,{
                                fadeOut: 1000,
                                swing: 300,
                                fadeIn: 5000,
                                linear: 1000,
                                timeOut: 3000,
                            });
                            window.location.href = '/detail-restaurant/' + {{ $restaurant->id }};
                        } else if (response.success == false) {
                            btn.attr('disabled', false);
                            btn.text('Submit');
                            toastr.error(response.message);
                        }
                    },
                    error: function(response) {
                        btn.attr('disabled', false);
                        btn.text('Submit');
                        toastr.error('An error occurred.');
                    }
                });
            }
        });

        $('#form_comment').on('submit', function(event) {
            event.preventDefault();
            if (!loggedIn){
                window.location.href = '/signin';
            } else {
                var form = $(this).closest('form');
                var formData = new FormData(this);

                var btn = $('#submit-button');
                btn.attr('disabled', true);
                btn.val(btn.data("loading-text"));

                $('#error-star-rating').text('');

                $.ajax({
                    url: "{{ route('comment.store') }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success == true) {
                            form[0].reset();
                            toastr.success(response.message,{
                                fadeOut: 1000,
                                swing: 300,
                                fadeIn: 5000,
                                linear: 1000,
                                timeOut: 3000,
                            });
                            window.location.href = '/detail-restaurant/' + {{ $restaurant->id }};
                        } else if (response.success == false) {
                            btn.attr('disabled', false);
                            btn.text('Submit');
                            toastr.error('error', response.message);
                        }
                    },
                    error: function(response) {
                        btn.attr('disabled', false);
                        btn.text('Submit');
                        $('#error-star-rating').text(response.responseJSON.errors.star_rating);
                    }
                });
            }
        });

        // function updateLikes(commentId) {
        //     $.ajax({
        //         url: '/comment/' + commentId + '/likes',
        //         type: 'GET',
        //         success: function(response) {
        //             var newLikesCount = response.likes;
        //             var likeBtn = $('.like-btn[data-comment-id="' + commentId + '"]');
        //             // likeBtn.text(newLikesCount);
        //             // likeBtn.show();
        //         },
        //         error: function(xhr, status, error) {
        //             console.error(error);
        //         }
        //     });
        // }

        $('.like-btn').on('click', function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var commentId = $(this).data('comment-id');
            var clickedBtn = $(this);
            $.ajax({
                url: '/comment/' + commentId + '/like',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                type: 'POST',
                success: function(response) {
                    var newLikesCount = response.likes;
                    clickedBtn.find('i').text(newLikesCount);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        // setInterval(function() {
        //     $('.like-btn').each(function() {
        //         var commentId = $(this).data('comment-id');
        //         updateLikes(commentId);
        //     });
        // }, 5000);
    });
</script>
@endsection
@endsection
