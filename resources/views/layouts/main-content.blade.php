@extends('layouts.app')

@section('main')

<div id="content">
    @include('layouts.top-nav')
    @yield('content')
    @include('layouts.footer')
</div>
@endsection
