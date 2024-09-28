@extends('Layout.app')

@section('content')
    @include('Components.User.menubar')
    {{-- @include('Components.User.about_heroSlider') --}}
    @include('Components.auth.login-form')
    {{-- @include('Components.User.about')
    @include('Components.User.testimonial') --}}
    @include('Components.User.footer')
@endsection