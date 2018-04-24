@extends('adminlte::page')

@section('title', 'Novo depósito')

@section('content_header')
    <h1>Realizar depósito</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Depósito</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Realizar depósito</h3>
        </div>
        <div class="box-body">

            @include('admin.includes.alerts')

            <form method="POST" action="{{ route('deposit.store') }}">
                {!! csrf_field() !!}
                <div class="form-group"><input class="form-control" type="text" name="new_value" placeholder="Valor da depósito"></div>
                <div class="form-group"><button class="btn btn-success" type="submit">Depósitar</button></div>
            </form>
        </div>
    </div>
@stop