@extends('Layout.app')

@section('content')
    @include('Components.User.menubar')
    @include('Components.User.about_heroSlider')
    @include('Components.User.booking.booking-list')
    @include('Components.User.footer')
@endsection
