@extends('Layout.dashboard-nav')

@section('content')
    @include('Components.Admin.leftMenubar')
    @include('Components.Admin.topMenubar')

    @include('Components.Admin.car')
    @include('Components.Admin.car.car-create')
    @include('Components.Admin.car.car-update')
    @include('Components.Admin.car.car-delete')

    @include('Components.Admin.footer')
@endsection
