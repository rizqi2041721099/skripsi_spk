@extends('layouts.frontend.app-detail')
@section('title-head')
    Search
@endsection
@section('list')
    <li class="breadcrumb-item text-white active" aria-current="page">Restaurants</li>
@endsection
@section('content')
<div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row g-0">
        <div class="col-md-12 bg-dark d-flex align-items-center">
            <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                <h5 class="section-title ff-secondary text-start text-primary fw-normal">Search Restaurants</h5>
                <h1 class="text-white mb-4">Temukan restaurant yang kamu cari!</h1>
                <form id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="variasi_menu" id="" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach ($getVariasiMenu as $item)
                                        <option value="{{ $item->id }}">{{ $item->range_value }}  variasi makanan</option>
                                    @endforeach
                                </select>
                                <label for="range-variasi-makanan">Range Variasi Menu Makanan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="jarak" id="jarak" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach ($getJarak as $item)
                                        <option value="{{ $item->id }}">{{ $item->range_value }}</option>
                                    @endforeach
                                </select>
                                <label for="rentang-jarak">Rentang Jarak</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="harga" id="harga" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach ($getHarga as $item)
                                        <option value="{{ $item->id }}">{{ $item->range_value }}</option>
                                    @endforeach
                                </select>
                                <label for="range-harga">Rentang Harga</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="rasa" id="rasa" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach ($getRasa as $item)
                                        <option value="{{ $item->value }}">{{ $item->standard_value }}</option>
                                    @endforeach
                                </select>
                                <label for="select1">Kriteria Rasa Makanan</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="facility" class="form-label text-white fw-bold">Fasilitas</label>
                            <div class="d-flex flex-wrap">
                                @foreach($facilities as $facility)
                                    <div class="form-check me-3">
                                        <input type="checkbox" name="facility_id[]" value="{{ $facility->id }}" id="facility_{{ $facility->id }}" class="form-check-input">
                                        <label for="facility_{{ $facility->id }}" class="form-check-label text-white fw-semibold">{{ $facility->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-secondary w-100 py-3" type="button" id="reset">Reset</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary w-100 py-3" type="button" id="filter">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="container-xxl py-5 d-none" id="data-restaurants">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Restaurant</h5>
        </div>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                        <i class="fa fa-star fa-2x text-primary"></i>
                        <div class="ps-3">
                            <small class="text-body">Popular</small>
                            {{-- <h6 class="mt-n1 mb-0">Breakfast</h6> --}}
                        </div>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.frontend.home.modal')
<script>
    $(document).ready(function(){
        $('#filter').click(function() {
            filterRestaurants();
        });

        function filterRestaurants() {
            var formData = $('#filterForm').serialize();
            $.ajax({
                type: 'GET',
                url: '{{ route("filter.restaurants") }}',
                data: formData,
                success: function(response) {
                    if(response.length != 0)
                    {
                        $('#data-restaurants').removeClass("d-none");
                        var row = $('#tab-1 .row');
                        row.empty()
                        response.forEach(function(restaurant) {
                            var sum = 0;
                            var count = restaurant.comments.length;
                            for (var i = 0; i < count; i++) {
                                sum += restaurant.comments[i].star_rating;
                            }
                            var average = count > 0 ? sum / count : 0;
                            id = restaurant.id;

                            var starColor = average > 0 ? '#ffcd3c' : '#aaa';
                            var starHtml = '';
                            if (average > 0) {
                                for (var i = 0; i < parseInt(average); i++) {
                                    starHtml += '<i class="fa fa-star fa-xs" style="color: ' + starColor + '; font-size: 16px" aria-hidden="true"></i>';
                                }
                            } else {
                                starHtml += '<i class="fa fa-star fa-xs" style="color: ' + starColor + '; font-size: 16px" aria-hidden="true"></i>';
                            }
                            var link = '{{ route("detail.restaurant", ":id") }}';
                            link = link.replace(':id', id);

                            var column = `<div class="col-lg-6">`;
                            column += `<a href="${link}">`;
                            column += `<div class="d-flex align-items-center">
                                <img class="flex-shrink-0 img-fluid rounded" src="{{ asset('frontend/img/restaurant.jpg')}}" alt="" style="width: 80px;">
                                <div class="w-100 d-flex flex-column text-start ps-4">
                                    <h5 class="d-flex justify-content-between border-bottom pb-2">
                                        <span>${restaurant.name}</span>
                                        <span class="text-primary">${starHtml}</span>
                                    </h5>
                                    <small class="fst-italic">
                                        ${restaurant.facilities.length > 0 ? restaurant.facilities.map(item => item.name).join(', ') : '-'}
                                    </small>
                                </div>
                            </div>`;
                            column += '</a>';
                            column += `</div>`;
                           row.append(column);

                        });
                    } else {
                       $('.modal').show();
                       $('#btn-close').click(function(){
                            $('.modal').hide();
                       });
                    }
                }
            });
        }

        $('#reset').click(function() {
            $('input[type="checkbox"]').prop('checked', false);
            filterRestaurants();
        });
    });
</script>
@endsection
