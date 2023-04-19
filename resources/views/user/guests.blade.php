@extends('user.dashboard')

@section('title', "Pagina di Amministrazione Invitati")

@section('scripts')
    <script src="{{ asset('scripts/administration.js') }}" defer></script>
@endsection

@section('content')
    @parent

    <form action="#" method="post" name="search_form" id="search_form">
        @csrf

        <div class="labels">
            <label for="veg_flag">Solo Vegetariani</label>
            <label for="church_flag">Solo Presenti in Chiesa</label>
            <label for="castle_flag">Solo Presenti al Castello</label>
            <label for="updated_flag">Solo Confermati</label>
        </div>

        <div class="inputs">
            <input type="checkbox" name="veg_flag" id="veg_flag">
            <input type="checkbox" name="church_flag" id="church_flag">
            <input type="checkbox" name="castle_flag" id="castle_flag">
            <input type="checkbox" name="updated_flag" id="updated_flag">
        </div>

        <input type="text" name="search_string" placeholder="Cerca...">
    </form>

    <table id="guest_table">
        <thead>
            <tr>
                <th data-sort="id" data-order="asc">ID</th>
                <th data-sort="name" data-order="none">NOME</th>
                <th data-sort="surname" data-order="none">COGNOME</th>
                <th data-sort="diet" data-order="none">DIETA</th>
                <th data-sort="allergies" data-order="none">ALLERGIE</th>
                <th data-sort="church_confirm" data-order="none">IN CHIESA</th>
                <th data-sort="castle_confirm" data-order="none">AL CASTELLO</th>
                <th data-sort="updated" data-order="none">CONFERMATO</th>
                <th data-sort="password" data-order="none">CODICE</th>
                <th data-sort="host" data-order="none">INVITATO DA</th>
                <th data-sort="delete" data-order="none">CANCELLA</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($guests as $guest)
            <tr>
                <td>{{ $guest->id }}</td>
                <td>{{ $guest->name }}</td>
                <td>{{ $guest->surname }}</td>
                <td>{{ $guest->diet }}</td>
                <td>{{ $guest->allergies }}</td>
                <td>{{ $guest->church_confirm ? 'Sì' : 'No' }}</td>
                <td>{{ $guest->castle_confirm ? 'Sì' : 'No' }}</td>
                <td>{{ $guest->updated ? 'Sì' : 'No'}}</td>
                <td>{{ $guest->password }}</td>
                <td>{{ $guest->host ? $guest->host->name . ' ' . $guest->host->surname : 'Aurelio e Chiara' }}</td>
                <td data-link="delete"><a href="/guest/delete/{{ $guest->id }}">Cancella</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <form action="#" method="post" name="guest_form" id="guest_form">
        @csrf

        <div class="labels">
            <label for="create_name">Nome Invitato</label>
            <label for="create_surname">Cognome Invitato</label>
            <label for="create_diet">Dieta Invitato</label>
            <label for="create_allergies">Allergie Invitato</label>
            <label for="create_church_confirm">Presenza Chiesa</label>
            <label for="create_castle_confirm">Presenza Castello</label>
            <label for="create_updated">Confermato</label>
        </div>

        <div class="inputs">
            <input type="text" name="name" id="create_name" placeholder="(Es: Piero, Antonio, ecc.)">
            <input type="text" name="surname" id="create_surname" placeholder="(Es: Rossi, Biagi, ecc.)">
            <input type="text" name="diet" id="create_diet" placeholder="(Es: vegetariana, vegana, onnivora, ecc.)">
            <input type="text" name="allergies" id="create_allergies" placeholder="(Es: lattosio, glutine, ecc.)">
            <input type="checkbox" name="church_confirm" id="create_church_confirm">
            <input type="checkbox" name="castle_confirm" id="create_castle_confirm">
            <input type="checkbox" name="updated" id="create_updated">
        </div>
        
        <input type="submit" value="Crea Invitato">
    </form>

    <div class="dialogs"></div>
@endsection