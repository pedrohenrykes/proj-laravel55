@extends('adminlte::page')

@section('title', 'Nova transferência')

@section('content_header')
    <h1>Realizar transferência</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Transferência</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Realizar transferência</h3>
        </div>
        <div class="box-body">

            @include('admin.includes.alerts')

            <form method="POST" action="{{ route('transfer.receiver-confirm') }}">
                {!! csrf_field() !!}
                <div class="form-group"><input class="form-control" type="text" name="receiver_user" placeholder="E-mail do favorecido"></div>
                <div class="form-group"><button class="btn btn-success" type="submit">Próxima etapa</button></div>
            </form>
        </div>
    </div>
@stop