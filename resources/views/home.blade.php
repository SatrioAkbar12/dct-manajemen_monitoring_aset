{{-- @extends('layouts.app') --}}
{{-- @extends('layouts.app')

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
@endsection --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

{{-- @section('content_header')
    <h1>Dashboard</h1>
@stop --}}

@section('content')
    <div class="row mb-5">
        <div class="col-3 col-md-5"></div>
        <div class="col-6 col-md-2 pt-5">
            <img src="{{ asset('assets/img/LOGO_MASTER-GRADASI.png') }}" class="img-fluid mt-5">
        </div>
        <div class="col-3 col-md-5"></div>
    </div>
    <h1 class="text-center display-5">Welcome to</h1>
    <h1 class="text-center display-2">Assets Control Montoring System</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
