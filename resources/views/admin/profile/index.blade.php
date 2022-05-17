@extends('layouts.dashboard_master');

@section('content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home')}}">Home</a>
        <span class="breadcrumb-item active">Add Category</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row row-sm">
            <div class="col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h1>Profile</h1>
                    </div>
                    <div class="card-body">

                        @if(session('success_message'))
                        <div class="alert alert-success">
                            {{ session('success_message') }}
                        </div>
                        @endif
                        <form action="{{ url('profile/post')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Your Name"
                                    value="{{ Str::title(Auth::user()->name) }}">
                                @error('name')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-info">Change Name</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-8 m-auto">
                    <div class="card">
                        <div class="card-header">
                            <h1>Change password</h1>
                        </div>
                        <div class="card-body">
                            @if(session('password_change_status'))
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    {{ session('password_change_status') }}
                                </div>
                            </div>
                            @endif
                            @if(session('database_status'))
                            <div class="alert alert-danger">
                                {{ session('database_status') }}
                            </div>
                            @endif
                            <form action="{{ url('password/post')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="">Old Password</label>
                                    <input type="text" class="form-control" name="old_password"
                                        placeholder="Enter Your Old Password" value="{{ old('old_password') }}">
                                    @error('old_password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="">New Password</label>
                                    <input type="text" class="form-control" name="password"
                                        placeholder="Enter Your New Password" value="{{ old('password') }}">
                                    @error('password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="">Confirm Password</label>
                                    <input type="text" class="form-control" name="password_confirmation"
                                        placeholder="Enter Your Confirm Password">
                                    @error('password_confirmation')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-info">Change Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
