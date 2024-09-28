@extends('Layout.app')

@section('content')
    @include('Components.User.menubar')
    @include('Components.User.about_heroSlider')
    @include('Components.User.service')
    @include('Components.User.testimonial')
    @include('Components.User.footer')
@endsection