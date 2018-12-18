@extends('layouts.app')
<style>
    .body {
        margin-top: 20px;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>

            <div class="body">
                <div class="card-header">Your orders</div>

                <div class="card-body">
                    @foreach($produse as $key => $data)
                        <span>Order number: {{$data->idOrder}}</span> </br>
                        <span>{{$data->name}}</span>
                        <span>Price: {{$data->pret}}</span>
                        <span>Quantity: {{$data->cantitateOrder}}</span>
                        <span>Final Price: {{$data->pret * $data->cantitateOrder}}</span>
                        </br> </br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
