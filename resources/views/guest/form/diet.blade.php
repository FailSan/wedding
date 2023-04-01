<form class="hidden" action="#" method="post" id="diet_form" data-form-sel="0" data-content="diet">
    @csrf

    <p class="brown">5 / 7</p>

    <p class="mid">Dicci qualcosa sul tuo <i>stile alimentare</i>.
        Qui puoi comunicarci se sei vegetariano, crudariano o hai qualche problema con 
        alcuni alimenti.</p>
    <input type="text" name="diet" value=""
        placeholder="Onnivoro, vegetariano, non mangio pesce, ecc..." 
        autocomplete="off">

    <p class="error-box hidden"></p>

    <label class="submit-label">
        <input type="submit" value="Ok!">
        <p>premi <strong>Invio &crarr;</strong></p>
    </label>

    <span class="info-box">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">Dato che sarai nostro ospite al ricevimento, ti chiediamo di 
            informarci riguardo le tue preferenze alimentari e le allergie di cui soffri.
            <br>Se i dati pre-inseriti dovessero essere corretti, puoi premere
            <strong>Ok</strong> e andare avanti.</p>
    </span>
</form>