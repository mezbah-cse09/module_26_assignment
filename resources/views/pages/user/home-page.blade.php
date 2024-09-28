@extends('Layout.app')

@section('content')
    @include('Components.User.menubar')
    @include('Components.User.heroSlider')
    @include('Components.User.featuredVehicle')
    @include('Components.User.about')
    @include('Components.User.service')
    @include('Components.User.testimonial')
    @include('Components.User.footer')
@endsection