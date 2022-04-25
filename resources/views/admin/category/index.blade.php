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
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                            </tr>
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