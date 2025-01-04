@extends('layouts.app')
@section('title', 'services')
@section('breadcrumb-title', 'services')
@section('breadcrumb-subtitle', ' services')
@section('content')

    @include('shared.services')
    @include('shared.testimonials')
    @include('shared.value')
    @include('shared.providers')
    @include('shared.emergency')

@endsection
