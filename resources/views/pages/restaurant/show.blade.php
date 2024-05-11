@extends('layouts.main-content')
@section('title', 'Detail Restaurants')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Restaurant</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#">Detail Restaurant</a></li>
            </ol>
        </div>
        <div class="card mb-3" style="margin-top: -20px !important">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="font-weight-bold text-primary">
                    Restaurant {{ $restaurant->name }}
                </h6>
                <div class="rating">
                    <span>
                        @php
                            $starCount = 5;
                            $comments = App\Models\Comment::where('restaurant_id', $restaurant->id)->get();
                            $sumRating = 0;
                            $count = $comments->count();

                            foreach ($comments as $comment) {
                                $sumRating += $comment->star_rating;
                            }

                            $avgRating = ($count > 0) ? $sumRating / $count : 0;
                            $filledStars = intval($avgRating);
                            $emptyStars = $starCount - $filledStars;
                        @endphp
                        <div class="star-rating">
                            @for ($i = 0; $i < $filledStars; $i++)
                                <i class="fa fa-star fa-xs" style="color:#ffcd3c; font-size: 28px" aria-hidden="true"></i>
                            @endfor

                            @for ($i = 0; $i < $emptyStars; $i++)
                                <i class="fa fa-star fa-xs" style="color: #aaa;font-size:28px" aria-hidden="true"></i>
                            @endfor
                        </div>
                    </span>
                </div>
            </div>
            <div class="card-body mb-2">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">Detail</button>
                        <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                            type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Alamat</button>
                        <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact"
                            type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Data
                            Alternatif</button>
                        <button class="nav-link" id="nav-menu-tab" data-toggle="tab" data-target="#nav-menu" type="button"
                            role="tab" aria-controls="nav-menu" aria-selected="false">Variasi Menu</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <div class="col-sm-2">
                                @if (is_null($restaurant->images) || $restaurant->images == '')
                                    <img src="{{ asset('assets/img/default.png') }}" alt="img" class="rounded"
                                        width="100px" height="100px">
                                @else
                                    <img src="{{ Storage::url('public/images/restaurants/' . $restaurant->images) }}"
                                        alt="img" class="rounded" width="100px" height="150px">
                                @endif
                            </div>
                            <div class="col-sm-10">
                                <p class="mt-3 mb-0"> <span class="font-weight-bold">Alamat</span> :
                                    {{ $restaurant->address }}</p>
                                <p class="mb-0"><span class="font-weight-bold">Jarak</span> : {{ $restaurant->distance }}
                                </p>
                                <p class="mb-0"><span class="font-weight-bold">Fasilitas</span> :
                                    @if (!$restaurant->facilities)
                                        -
                                    @else
                                        @foreach ($restaurant->facilities as $item)
                                            {{ $item->name . ', ' }}
                                        @endforeach
                                    @endif
                                </p>
                                <p class="mb-0"><span class="font-weight-bold">Rata - Rata Harga</span> :
                                    {{ number_format($restaurant->average) }}</p>
                                <p class="mb-0"><span class="font-weight-bold">Qty Variasi Makanan</span> :
                                    {{ $restaurant->qty_variasi_makanan }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        @if (empty($restaurant->map_link))
                            <span class="text-danger fw-bold">tidak ada link gmaps</span>
                        @else
                            <a href="{{ $restaurant->map_link }}" class="btn btn-sm btn-primary" target="_blank"><i
                                    class="fa fa-map-marker" aria-hidden="true"></i>
                                check location</a>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="table-responsive my-5">
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
                    <div class="tab-pane fade" id="nav-menu" role="tabpanel" aria-labelledby="nav-menu-tab">
                        <div class="table-responsive my-5">
                            <table class="table table-bordered" width="100%" id="alternatif_table">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                @if (count($commentList) == 0)
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
                        <button type="submit" id="submit-button" class="btn btn-sm btn-primary"
                            data-loading-text="Loading...">Post Comment</button>
                    </form>
                @endif
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
                                                    <h6 class="mb-1"><span class="font-weight-bold">{{ $comment->user->name }} </span> <span><small> {{  \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }} </small></span> </h6>
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
    <script type="application/javascript">
        $(document).ready(function () {
            $(':radio').change(function() {
                console.log('New star rating: ' + this.value);
            });

            $(document).on('click', '.btn-reply', function(e) {
                e.preventDefault();
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
                        <div class="d-inline-block">
                            <button type="button" class="btn btn-sm btn-outline-danger rounded cancel-button">Cancel</button>
                            <button type="button" class="btn btn-sm btn-outline-primary rounded submit-button" data-loading-text="Loading...">Send</button>
                        </div>
                    </form>`;
                cardBody.append(form);
                cardBody.data('replyButton', $(this));
                $(this).hide();
            });

            $(document).on('click', '.cancel-button', function(e) {
                e.preventDefault();
                var cardBody = $(this).closest('.card-body');
                $(this).closest('#form-reply-comment').remove();
                cardBody.data('replyButton').show();
            });

            $(document).on('click', '.submit-button', function(e) {
                e.preventDefault();
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
                            window.location.href = '/restaurants/' + {{ $restaurant->id }};
                            sessionStorage.setItem('success', response.message);
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
            });

            $('#form_comment').on('submit', function(event) {
                event.preventDefault();
                var form = $(this).closest('form');
                var formData = new FormData(this);

                var btn = $('#submit-button');
                btn.attr('disabled', true);
                btn.val(btn.data("loading-text"));

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
                            window.location.href = '/restaurants/' + {{ $restaurant->id }};
                            sessionStorage.setItem('success', response.message);
                        } else if (response.success == false) {
                            btn.attr('disabled', false);
                            btn.text('Submit');
                            toastr.error('error', response.message);
                        }
                    },
                    error: function(response) {
                        btn.attr('disabled', false);
                        btn.text('Submit');
                    }
                });
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
