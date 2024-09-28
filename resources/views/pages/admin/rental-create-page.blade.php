@extends('Layout.dashboard-nav')

@section('content')
    @include('Components.Admin.leftMenubar')
    @include('Components.Admin.topMenubar')

    @include('Components.Admin.rental.rental-create')

    @include('Components.Admin.footer')
@endsection
