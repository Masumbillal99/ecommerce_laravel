@extends('layouts.app');

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>List category:</h1>
                </div>
                <div class="card-body">
                    <h3>List will be here</h3>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">SL No</th>
                            <th scope="col">Category</th>
                            <th scope="col">Added by</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                            <td> {{ $loop->index + 1 }} </td>
                            <td> {{ $category->category_name }} </td>
                            <td> {{ App\User::find($category->user_id)->name }} </td>
                            <td>
                                @if($category->created_at)
                                 {{ $category->created_at->diffForHumans() }}
                                @else
                                 No time abal
                                @endif
                            </td>
                            <td>
                                <div class="btn-group text-white" role="group" aria-label="Basic example">
                                    <a href="{{ url('update/category')}}/{{ $category->id }}" type="button" class="btn btn-info">Update</a>
                                    <a href="" type="button" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h1>Add category:</h1>
                </div>
                <div class="card-body">
                   
                    @if(session('success_messge'))
                    <div class="alert alert-success">
                    {{ session('success_messge') }}
                    </div>
                    @endif
                    <form action="{{ url('add/category/post')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Add Category</label>
                            <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" >
                        </div>
                        <div class="mb-3">
                        @error('category_name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection