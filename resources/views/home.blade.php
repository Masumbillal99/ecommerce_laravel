@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <p>Welcome, {{ Auth::user()->name }}</p>
                   <p>Welcome, {{ Auth::user()->email }}</p>
                   <p>Welcome, {{ Auth::user()->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h1>Total Users: {{ $total_users }}</h1>
                </div>
                <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Createed at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
