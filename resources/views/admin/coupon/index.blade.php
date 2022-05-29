@extends('layouts.dashboard_master');

@section('coupon')
    active
@endsection

@section('content')
    <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home')}}">Home</a>
        <span class="breadcrumb-item active">Add Coupon</span>
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
                        <h1>List Coupon:</h1>
                    </div>
                    <div class="card-body">
                        <h3>List will be here</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Coupon Name</th>
                                    <th scope="col">Discount Amount (%)</th>
                                    <th scope="col">Validity Till</th> 
                                    <th scope="col">Validity Sattus</th> 
                                    <th scope="col">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $coupon->coupon_name }}</td>
                                    <td>{{ $coupon->discount_amount }}</td>
                                    <td>{{ $coupon->validity_till }}</td>
                                    <td>
                                        @if($coupon->validity_till >= \Carbon\Carbon::now()->format('Y-m-d'))
                                        <span class="badge badge-success">Valid</span>
                                        @else
                                        <span class="badge badge-danger">invalid</span>
                                        @endif
                                    </td>
                                    <td>{{ $coupon->created_at }}</td>
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
                        <h1>Add Coupon:</h1>
                    </div>
                    <div class="card-body">

                        @if(session('success_messge'))
                        <div class="alert alert-success">
                            {{ session('success_messge') }}
                        </div>
                        @endif
                        <form action="{{ url('add/coupon/post')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Coupon Name</label>
                                <input type="text" class="form-control" name="coupon_name">
                                @error('category_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Discount Amount (%)</label>
                                <input type="text" class="form-control" name="discount_amount">
                                @error('category_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Validity Till</label>
                                <input type="date" class="form-control" name="validity_till" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                @error('category_name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Coupon</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection