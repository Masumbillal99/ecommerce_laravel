@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 m-auto">
        <div class="card">
                <div class="card-header">
                    <h1>Update category:</h1>
                </div>
                <div class="card-body">
                    <form action="{{ url('add/category/post')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Add Category</label>
                            <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" value="{{ $category_name}}" >
                        </div>
                        <div class="mb-3">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection