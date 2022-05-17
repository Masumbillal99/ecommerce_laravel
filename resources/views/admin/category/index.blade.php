@extends('layouts.dashboard_master');

@section('content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home')}}">Home</a>
        <span class="breadcrumb-item active">Add Category</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row row-sm">
            @if(session('update_status'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('update_status') }}
                </div>
            </div>
            @endif
            @if(session('restore_status'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    {{ session('restore_status') }}
                </div>
            </div>
            @endif
            @if(session('delete_status'))
            <div class="col-md-12">
                <div class="alert alert-warning">
                    {{ session('delete_status') }}
                </div>
            </div>
            @endif
            @if(session('harddelete_status'))
            <div class="col-md-12">
                <div class="alert alert-danger">
                    {{ session('harddelete_status') }}
                </div>
            </div>
            @endif

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
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Added by</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Last Update at</th>
                                    <th scope="col">Category Photo</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
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
                                        @if($category->updated_at)
                                        {{ $category->updated_at->diffForHumans() }}
                                        @else
                                        <span>-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ asset('uploads/category_photos')}}/{{ $category->category_photo }}"
                                            width="50" alt="not found">
                                    </td>
                                    <td>
                                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                                            <a href="{{ url('update/category')}}/{{ $category->id }}" type="button"
                                                class="btn btn-info">Update</a>
                                            <a href="{{ url('delete/category')}}/{{ $category->id }}" type="button"
                                                class="btn btn-danger">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="50" class="text-center text-danger ">No data to show</td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header bg-danger text-white">
                        <h1>Delete List category:</h1>
                    </div>
                    <div class="card-body">
                        <h3>Delete List will be here</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Added by</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Last Update at</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deleted_categories as $deleted_category)
                                <tr>
                                    <td> {{ $loop->index + 1 }} </td>
                                    <td> {{ $deleted_category->category_name }} </td>
                                    <td> {{ App\User::find($deleted_category->user_id)->name }} </td>
                                    <td>
                                        @if($deleted_category->created_at)
                                        {{ $deleted_category->created_at->diffForHumans() }}
                                        @else
                                        No time abal
                                        @endif
                                    </td>
                                    <td>
                                        @if($deleted_category->updated_at)
                                        {{ $deleted_category->updated_at->diffForHumans() }}
                                        @else
                                        <span>-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group text-white" role="group" aria-label="Basic example">
                                            <a href="{{ url('restore/category')}}/{{ $deleted_category->id }}"
                                                type="button" class="btn btn-info">Restore</a>
                                            <a href="{{ url('harddelete/category')}}/{{ $deleted_category->id }}"
                                                type="button" class="btn btn-danger">Hard Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="50" class="text-center text-danger ">No data to show</td>
                                </tr>
                                @endforelse

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
                        <form action="{{ url('add/category/post')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="category_name"
                                    placeholder="Enter Category Name">
                                @error('category_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category Photo</label>
                                <input type="file" class="form-control" name="category_photo">
                                @error('category_photo')
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
</div>

@endsection
