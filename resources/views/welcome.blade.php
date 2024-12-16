@extends('layouts.app')
@section('title', 'Bienvenue')
@section('content')
<main>
        <header class="title">
            <h1>Bienvenue sur l'application Vino</h1>
            <p>Application de gestion de votre cellier</p>
        </header>
        <div class="nav">
            <a href="{{ route('bottle.scrape') }}" class="btn btn-border">Creer la liste des vins</a>
            <a href="{{ route('bottle.index') }}" class="btn btn-border">Afficher la liste des vins</a>
        </div>
</main>
@endsection