@extends('Layout.dashboard-nav')

@section('content')
    @include('Components.Admin.leftMenubar')
    @include('Components.Admin.topMenubar')

    {{-- @include('Components.Admin.rental') --}}
    @include('Components.Admin.rental.rental-list')
    @include('Components.Admin.rental.rental-update')
    @include('Components.Admin.rental.rental-delete')

    @include('Components.Admin.footer')
@endsection
