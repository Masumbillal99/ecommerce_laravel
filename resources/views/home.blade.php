@extends('layouts/dashboard_master')
@section('home')
active
@endsection

@section('content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>

    <div class="sl-pagebody">

        <div class="row row-sm">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <p>Welcome, {{ Str::title(Auth::user()->name) }}</p>
                        <p>Welcome, {{ Auth::user()->email }}</p>
                        <p>Welcome, {{ Auth::user()->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Total Users: {{ $total_users }}</h1>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">ID No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Createed at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class='text-center'> {{ $users->firstItem()+$loop->index }} </td>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td> {{ $user->name }} </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {{ $user->created_at->format('d/m/Y h:i:s A') }}
                                        <br>
                                        {{ $user->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div><!-- row -->
    </div>

    @endsection
