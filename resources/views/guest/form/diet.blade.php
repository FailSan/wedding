<form class="hidden" action="#" method="post" id="diet_form" data-form-sel="0" data-content="diet">
    @csrf

    <span class="top-section">
        <p class="brown">5 / 7</p>
        <p class="mid">{{ __("Dicci qualcosa sul tuo") }} <i>{{ __("stile alimentare") }}</i>.
            {{ __("Qui puoi comunicarci se sei vegetariano, crudariano o hai qualche problema con 
            alcuni alimenti.") }}</p>

        <label class="main-input">
            <p>{{ __("Onnivoro, vegetariano, non mangio pesce, ecc...") }}</p>
            <input type="text" name="diet" placeholder=" " autocomplete="off" tabindex="-1">
        </label>

        <span class="error-box hidden"></span>

        <input type="submit" value="Conferma" tabindex="-1">
    </span>    

    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">{{ __("Dato che sarai nostro ospite al ricevimento, ti chiediamo di 
            informarci riguardo le tue preferenze alimentari e le allergie di cui soffri.") }}</p>
    </span>
</form>