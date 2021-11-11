@extends('layouts.app')
<link rel="stylesheet" href="{{ asset("plugins/bootstrap/css/bootstrap.css") }}">
<script src="{{ asset("plugins/bootstrap/js/bootstrap.js") }}"></script>
<script src="{{ asset("plugins/jquery/jquery.js") }}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
