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

                    {{ __('You are logged in!') }}
                    <br>
                    <a href="{{ url('animals') }}" class="btn btn-primary">Display Animals </a>
                    <a href="{{ url('adoption_requests') }}" class="btn btn-primary">Display Adoption Requests </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
