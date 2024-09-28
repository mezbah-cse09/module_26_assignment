@extends('Layout.dashboard-nav')

@section('content')
    @include('Components.Admin.leftMenubar')
    @include('Components.Admin.topMenubar')

    @include('Components.Admin.customer.customer-list')
    @include('Components.Admin.customer.customer-create')
    @include('Components.Admin.customer.customer-update')
    @include('Components.Admin.customer.customer-delete')

    @include('Components.Admin.footer')
@endsection
