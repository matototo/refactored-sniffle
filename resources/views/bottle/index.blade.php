@extends('layouts.app')
@section('title', 'Liste des Bouteilles')
@section('content')
<h1 class="title">Bouteille List</h1>
    <div class="grid-container">
        @forelse ($bouteilles as $bouteille)
            <div class="card">
                <h5>{{ $bouteille->nom }}</h5>
                <p>{{ $bouteille->identity }}</p>
                <strong>{{ $bouteille->price }}</strong>
            </div>
        @empty
            <div class="alert">There are no bottles to display!</div>
        @endforelse
    </div>
@endsection