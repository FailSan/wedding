<form class="hidden" action="#" method="post" id="extra_guests_form" data-form-sel="1" data-content="extra_guests">
    @csrf
    <p class="brown">8 / 8</p>

    <p class="mid">Aggiungi gli ospiti che desideri invitare e inserisci i loro dati.
        Quando avrai finito, clicca <strong>Ok</strong> e vai avanti!</p>

    <fieldset class="extra-guests-container"></fieldset>

    <fieldset class="mini-form">
        <input class="mini" type="text" name="name" placeholder="Nome" autocomplete="off"  tabindex="-1">
        <input class="mini" type="text" name="surname" placeholder="Cognome" autocomplete="off"  tabindex="-1">
        <input class="mini" type="text" name="diet" placeholder="Onnivoro, vegetariano, non mangio pesce, ecc..." autocomplete="off" tabindex="-1">
        <input class="mini" type="text" name="allergies" placeholder="Glutine, lattosio, pesche, aglio, ecc..." autocomplete="off" tabindex="-1">
    </fieldset>

    <p class="error-box hidden"></p>

    <div class="submit-container">
        <button class="add-guest" tabindex="-1">
            <p>Aggiungi Ospite</p>
            <p>+</p>
        </button>

        <label class="submit-label">
            <input type="submit" value="Ok!" tabindex="-1">
            <p>premi <strong>Invio &crarr;</strong></p>
        </label>
    </div>

    <span class="info-box">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">Fornisci i dati dei tuoi ospiti, puoi aggiungere fino a 10 ospiti
            differenti.
            <br>Se i dati pre-inseriti dovessero essere corretti, puoi premere
            Ok e andare avanti.</p>
    </span>
</form>