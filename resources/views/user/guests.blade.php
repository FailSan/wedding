@extends('user.structure')

@section('scripts')
    <script src="{{ asset('scripts/administration.js') }}" defer></script>
@endsection

@section('content')

    <div class="forms-container">
        <form action="#" method="post" name="guest_form" id="guest_form">
            @csrf
            <fieldset>
                <legend>Creazione Invitato</legend>

                <label class="text-label">
                    <p>Nome Invitato</p>
                    <input type="text" name="name" placeholder=" ">
                </label>

                <label class="text-label">
                    <p>Cognome Invitato</p>
                    <input type="text" name="surname" placeholder=" ">
                </label>

                <label class="text-label">
                    <p>Dieta Invitato</p>
                    <input type="text" name="diet" placeholder=" ">
                </label>

                <label class="text-label">
                    <p>Allergie Invitato</p>
                    <input type="text" name="allergies" placeholder=" ">
                </label>

                <label class="check-label">
                    <p>Presente in Chiesa</p>
                    <input type="checkbox" name="church_confirm" value="true">
                </label>

                <label class="check-label">
                    <p>Presente al Castello</p>
                    <input type="checkbox" name="castle_confirm" value="true">
                </label>

                <label class="check-label">
                    <p>Menu Bambino</p>
                    <input type="checkbox" name="child_menu" value="true">
                </label>

                <label class="check-label">
                    <p>Confermato</p>
                    <input type="checkbox" name="updated" value="true">
                </label>

                <span class="error-dialog hidden"></span>
                
                <input class="cta-button input-button" type="submit" value="Crea Invitato">
            </fieldset>
        </form>

        <form action="#" method="post" name="search_form" id="search_form">
            @csrf

            <fieldset>
                <legend>Filtra Invitati</legend>

                <label class="check-label">
                    <p>Cerimonia</p>
                    <input type="checkbox" name="church_flag" value="true">
                </label>

                <label class="check-label">
                    <p>Ricevimento</p>
                    <input type="checkbox" name="castle_flag" value="true">
                </label>

                <label class="check-label">
                    <p>Vegetariani</p>
                    <input type="checkbox" name="veg_flag" value="true">
                </label>

                <label class="check-label">
                    <p>Menu Bambino</p>
                    <input type="checkbox" name="child_flag" value="true">
                </label>

                <label class="check-label">
                    <p>Confermati</p>
                    <input type="checkbox" name="updated_flag" value="true">
                </label>

                <label class="text-label">
                    <p>Cerca Invitato</p>
                    <input type="text" name="search_string" placeholder=" ">
                </label>
            </fieldset>
            
        </form>
    </div>


    <div class="table-container">
        <table id="guest_table">
            <caption>
                Tabella Invitati
            </caption>

            <thead>
                <tr>
                    <td colspan="12" class="guest-counter">Invitati Trovati: {{ $guests->count() }}</td>
                </tr>
                <tr>
                    <th data-sort="id" data-order="asc">ID</th>
                    <th data-sort="name" data-order="none">NOME</th>
                    <th data-sort="surname" data-order="none">COGNOME</th>
                    <th data-sort="diet" data-order="none">DIETA</th>
                    <th data-sort="allergies" data-order="none">ALLERGIE</th>
                    <th data-sort="church_confirm" data-order="none">IN CHIESA</th>
                    <th data-sort="castle_confirm" data-order="none">AL CASTELLO</th>
                    <th data-sort="child_menu" data-order="none">MENU BAMBINO</th>
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
                    <td>{{ $guest->child_menu ? 'Sì' : 'No' }}</td>
                    <td>{{ $guest->updated ? 'Sì' : 'No'}}</td>
                    <td>{{ $guest->password }}</td>
                    <td>{{ $guest->host ? $guest->host->name . ' ' . $guest->host->surname : 'Aurelio e Chiara' }}</td>
                    <td data-link="delete"><a href="/guest/delete/{{ $guest->id }}">Cancella</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@endsection