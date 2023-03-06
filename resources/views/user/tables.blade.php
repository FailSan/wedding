@extends('user.dashboard')

@section('title', "Pagina di Amministrazione Tavoli")

@section('scripts')
    <script src="{{ asset('scripts/tables.js') }}" defer></script>
@endsection

@section('content')
    @parent
    
    <table id="table_table">
        <thead>
            <tr>
                <th data-sort="id" data-order="asc">ID</th>
                <th data-sort="description" data-order="none">DESCRIZIONE</th>
                <th data-sort="delete" data-order="none">CANCELLA</th>
            </tr>
        </thead>

        <tbody>
            @foreach($tables as $table)
            <tr>
                <td>{{ $table->id }}</td>
                <td>{{ $table->description }}</td>
                <td data-link="delete"><a href="/table/delete/{{ $table->id }}">Cancella</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <form action="#" method="post" name="table_form" id="table_form">
        @csrf

        <div class="labels">
            <label for="table_description">Descrizione</label>
        </div>

        <div class="inputs">
            <input type="text" name="description" id="table_description" placeholder="(Es: Tavolo dei testimoni)">
        </div>

        <input type="submit" value="Crea Tavolo">
    </form>

    <form action="#" method="post" name="assign_form" id="assign_form">
        <div class="labels">
            <label for="select_table">Seleziona Tavolo:</label>
            <label for="select_guest">Seleziona Utenti:</label>
        </div>

        <div class="inputs">
            <input list="tables" name="table_id" id="select_table">
            <datalist id="tables">
                @foreach($tables as $table)
                    <option value="{{ $table->description }}">
                @endforeach
            </datalist>

            <input list="guests" name="guest_id" id="select_guest">
            <datalist id="guests">
                @foreach($guests as $guest)
                    <option value="{{ $guest->id }}">{{ $guest->name . ' ' . $guest->surname }}</option>
                @endforeach
            </datalist>
        </div>
    </form>

    <div class="dialogs"></div>
@endsection