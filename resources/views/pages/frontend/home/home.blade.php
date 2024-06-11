@extends('layouts.frontend.app')

@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5" id="service">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-user-tie text-primary mb-4"></i>
                            <h5>Master Chefs</h5>
                            <p>Tentunya masakan yang ada pada restaurant dibawah dimasak oleh chef handal</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-utensils text-primary mb-4"></i>
                            <h5>Quality Food</h5>
                            <p>Takdir dari hidangan yang lezat terletak dalam kualitas bahan-bahannya</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-cart-plus text-primary mb-4"></i>
                            <h5>Online Order</h5>
                            <p>Makanan yang ada pada restaurant dibawah dapat di pesan lewat online</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-headset text-primary mb-4"></i>
                            <h5>24/7 Service</h5>
                            <p>Jelajahi setiap makanan pada restaurant dibawah,kami ada selama 24 jam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div class="container-xxl py-5" id="about-us">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.1s"
                                src="{{ asset('frontend/img/about-1.jpg') }}">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.3s"
                                src="{{ asset('frontend/img/about-2.jpg') }}" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.5s"
                                src="{{ asset('frontend/img/about-6.jpg') }}">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.7s"
                                src="{{ asset('frontend/img/about-7.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">About Us</h5>
                    <h1 class="mb-4">Welcome to <i class="fa fa-utensils text-primary me-2"></i>Tempat Makan</h1>
                    <p class="mb-4">Tentu! Di sini, kami menawarkan berbagai hidangan lezat dari berbagai jenis masakan
                        lokal dan internasional. Kami memiliki menu yang beragam untuk memenuhi selera dan preferensi
                        kuliner Anda.</p>
                    <p class="mb-4">Jadi, ayo! Jelajahi berbagai hidangan lezat yang kami tawarkan dan temukan makanan
                        favorit Anda di sini. Nikmati setiap gigitan dan rasakan kelezatannya. Kami berharap Anda menikmati
                        pengalaman kuliner yang luar biasa di tempat kami!</p>
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                                <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">
                                    @php
                                        $sumRestaurant = App\Models\Restaurant::count();
                                    @endphp
                                    {{ $sumRestaurant }}
                                </h1>
                                <div class="ps-4">
                                    <h6 class="text-uppercase mb-0">Tempat Makan</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center border-start border-5 border-primary px-3">
                                <h1 class="flex-shrink-0 display-5 text-primary mb-0" data-toggle="counter-up">
                                    @php
                                        $sumMenu = App\Models\FoodVariaty::whereNotNull('restaurant_id')->count();
                                    @endphp
                                    {{ $sumMenu }}
                                </h1>
                                <div class="ps-4">
                                    <h6 class="text-uppercase mb-0">Menu</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Menu Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Tempat Makan</h5>
                <h1 class="mb-5">Most Popular Tempat Makan</h1>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill"
                            href="#tab-1">
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
                            @php
                                $restaurants = App\Models\Restaurant::with([
                                    'comments' => function ($query) {
                                        $query->where('star_rating', '!=', 0);
                                    },
                                ])
                                    ->whereHas('comments', function ($query) {
                                        $query->where('star_rating', '!=', 0);
                                    })
                                    ->get();
                            @endphp
                            @foreach ($restaurants as $item)
                                <div class="col-lg-6">
                                    <a href="{{ route('detail.restaurant', $item->id) }}">
                                        <div class="d-flex align-items-center">
                                            @if (is_null($item->images) || $item->images == '')
                                                <img class="flex-shrink-0 img-fluid rounded"
                                                    src="{{ asset('frontend/img/restaurant.jpg') }}" alt=""
                                                    style="width: 80px;">
                                                @else
                                                <img class="flex-shrink-0 img-fluid rounded"
                                                    src="{{ Storage::url('public/images/restaurants/' . $item->images) }}" alt=""
                                                    style="width: 80px;">
                                            @endif
                                            <div class="w-100 d-flex flex-column text-start ps-4">
                                                <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                    <span>{{ $item->name }}</span>
                                                    <span class="text-primary">{{ number_format($item->average) }}</span>
                                                </h5>
                                                <small class="fst-italic">
                                                    @if (!$item->facilities)
                                                        -
                                                    @else
                                                        @foreach ($item->facilities as $item)
                                                            {{ $item->name . ', ' }}
                                                        @endforeach
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu End -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Testimonial</h5>
                <h1 class="mb-5">Our Clients Say!!!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                @php
                    $comments = App\Models\Comment::take(10)->latest()->get();
                @endphp
                @foreach ($comments as $item)
                    <div class="testimonial-item bg-transparent border rounded p-4">
                        <div class="d-flex justify-content-between">
                            <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                            <p class="fw-bold">
                                @php
                                    $restaurant = App\Models\Restaurant::find($item->restaurant_id);
                                @endphp
                                {{ $restaurant->name }}
                            </p>
                        </div>
                        <p>{{ $item->content }}</p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="{{ asset('assets/img/boy.png') }}"
                                style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1">{{ $item->user->name }}</h5>
                                {{-- <small>Profession</small> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
