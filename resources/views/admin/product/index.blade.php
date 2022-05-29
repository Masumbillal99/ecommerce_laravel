@extends('layouts.dashboard_master');

@section('product')
    active
@endsection

@section('content')
    <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home')}}">Home</a>
        <span class="breadcrumb-item active">Add Product</span>
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
                        <h1>List Product:</h1>
                    </div>
                    <div class="card-body">
                        <h3>List will be here</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Product Price</th> 
                                    <th scope="col">Product Quantity</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Category Photo</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td> {{ $loop->index + 1 }} </td>
                                    <td> {{ $product->product_name }} </td>
                                    <td> {{ $product->relationtocategorytable->category_name }} </td>
                                    <!-- <td> {{ App\Category::find($product->category_id)->category_name }} </td> -->
                                    <td> {{ $product->product_price }} </td>
                                    <td> {{ $product->product_quantity }} </td>
                                    <td> {{ $product->created_at }} </td>
                                    <td> {{ $product->product_thumbnail_photo }} </td>
                                    <td>
                                        <img src="{{ asset('uploads/product_photos')}}/{{ $product->product_thumbnail_photo }}"
                                            width="50" alt="not found">
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
                        <h1>Add Product:</h1>
                    </div>
                    <div class="card-body">

                        @if(session('success_messge'))
                        <div class="alert alert-success">
                            {{ session('success_messge') }}
                        </div>
                        @endif
                        <form action="{{ url('add/product/post')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="product_name">
                                @error('category_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <select class="form-control" name="category_id" id="">
                                    <option value="">--select one--</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Price</label>
                                <input type="text" class="form-control" name="product_price">
                                @error('category_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Quantity</label>
                                <input type="text" class="form-control" name="product_quantity">
                                @error('category_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Short Description</label>
                                <textarea class="form-control"  name="product_short_description" id="" cols="4"></textarea>
                                @error('category_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Long Description</label>
                                <textarea class="form-control"  name="product_long_description" id="" cols="4"></textarea>
                                @error('category_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Product Thumbnail Photo</label>
                                <input type="file" class="form-control" name="product_thumbnail_photo">
                                @error('category_photo')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Multiple Photo</label>
                                <input type="file" class="form-control" name="product_multiple_photos[]" multiple>
                                @error('category_photo')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection