@extends('adminlte::page')

@section('title', 'Página inicial')

@section('content_header')
    <h1>Saldo</h1>

    <ol class="breadcrumb">
        <li><a href="">Dashboard</a></li>
        <li><a href="">Saldo</a></li>
    </ol>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <a href="{{ route('balance.deposit') }}" class="btn btn-primary">
                <i class="fa fa-sign-in" aria-hidden="true"></i> Depósitar
            </a>
            @if ($amount > 0)
                <a href="{{ route('balance.withdraw') }}" class="btn btn-danger">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Sacar
                </a>
                <a href="{{ route('balance.transfer') }}" class="btn btn-warning">
                    <i class="fa fa-exchange" aria-hidden="true"></i> Transferir
                </a>
            @endif
        </div>
        <div class="box-body">

            @include('admin.includes.alerts')
            
            <div class="row">
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>R$ {{ number_format($amount, 2, ',', '') }}</h3>
                            <p>Saldo em conta</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Histórico <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
@stop