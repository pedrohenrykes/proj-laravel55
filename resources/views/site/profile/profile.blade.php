@extends('site.layouts.app')

@section('title', 'Meu Perfil')

@section('content')

<h1>Meu Perfil</h1>

@include('admin.includes.alerts')

<form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
    {!! csrf_field() !!}
    <div class="form-group">
        <label for="name">Nome:</label>
        <input type="text" name="name" placeholder="Nome" class="form-control" value="{{ auth()->user()->name }}">
    </div>
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" name="email" placeholder="E-mail" class="form-control" value="{{ auth()->user()->email }}">
    </div>
    <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" name="password" placeholder="Senha" class="form-control">
    </div>
    <div class="form-group">
        <label for="imagem">Foto:</label><br>

        @if(auth()->user()->image != null)
            <img src="{{ url('storage/users/'.auth()->user()->image) }}" alt="{{ auth()->user()->image }}" style="max-width:120px;border-style:inset;margin:3px;">
        @endif

        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Atualizar perfil</button>
    </div>
</form>

@endsection