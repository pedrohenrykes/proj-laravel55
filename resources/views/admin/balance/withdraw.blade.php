@extends('adminlte::page')

@section('title', 'Nova Recarga')

@section('content_header')
    <h1>Realizar saque</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Saque</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Realizar saque</h3>
        </div>
        <div class="box-body">

            @include('admin.includes.alerts')

            <form method="POST" action="{{ route('withdraw.store') }}">
                {!! csrf_field() !!}
                <div class="form-group"><input class="form-control" type="text" name="new_value" placeholder="Valor do saque"></div>
                <div class="form-group"><button class="btn btn-success" type="submit">Sacar</button></div>
            </form>
        </div>
    </div>
@stop