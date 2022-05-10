@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 m-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('add/category') }}">Add Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category_name }}</li>
                </ol>
            </nav>
        <div class="card">
                <div class="card-header">
                    <h1>Update category:</h1>
                </div>
                <div class="card-body">
                    <form action="{{ url('update/category/post')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Add Category</label>
                            <input type="hidden" name="category_id" value="{{ $category_id }}">
                            <input type="text" class="form-control" name="category_name" value="{{ $category_name}}" >
                        </div>
                        <div class="mb-3">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection