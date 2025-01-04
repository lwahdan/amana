@extends('admin.layouts.app')

@section('content')
    <div class="container py-6">

        <div class="d-flex justify-content-end align-items-center mb-4 ">
            <a href="{{ route('comments.index') }}" class="btn btn-primary me-3 users_index">
                <i class="fas fa-plus"></i> Add a Comment
            </a>
        </div>
    </div>
@endsection