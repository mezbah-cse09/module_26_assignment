@extends('Layout.app')

@section('content')
    @include('Components.User.menubar')
    {{-- @include('Components.User.about_heroSlider') --}}
    {{-- @include('Components.User.about')
    @include('Components.User.testimonial') --}}
    @include('Components.User.about_heroSlider')
    @include('Components.User.car.car-list')
    @include('Components.User.footer')
@endsection