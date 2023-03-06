@extends('structure')

@section('title', "Pagina di Gestione Inviti")

@section('scripts')
    <script src="{{ asset('scripts/guest.js') }}" defer></script>
@endsection

@section('content')
    <div class="dialogs">
        <span>Ciao, sei {{ $guest->name }} {{ $guest->surname }}?</span>
        <button value="1">Sì</button>
        <button value="0">No</button>
    </div>
@endsection