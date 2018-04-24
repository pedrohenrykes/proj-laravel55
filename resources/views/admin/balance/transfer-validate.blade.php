@extends('adminlte::page')

@section('title', 'Confirmar transferência')

@section('content_header')
    <h1>Confirmar transferência</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Transferência</a></li>
        <li><a href="">Confirmação</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Confirmar transferência</h3>
        </div>
        <div class="box-body">

            @include('admin.includes.alerts')

            <p><strong>Favorecido: </strong>{{ $receiver->name }}</p>
            <p><strong>Seu saldo atual: </strong>R$ {{ number_format($balance->amount, 2, ',', '') }}</p>

            <form method="POST" action="{{ route('transfer.store') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                <div class="form-group"><input class="form-control" type="text" name="new_value" placeholder="Valor da trasnferência"></div>
                <div class="form-group"><button class="btn btn-success" type="submit">Transferir</button></div>
            </form>
        </div>
    </div>
@stop