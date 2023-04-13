<form action="#" method="post" id="castle_form" data-form-sel="0" data-content="castle_confirm">
    @csrf

    <span class="top-section">
        <p class="brown">4 / 4</p>
        <p class="mid">Sarai presente al <i>Ricevimento?</i></p>
    </span>
    
    <div class="mid-section">
        <fieldset class="radio-group">
            <label class="radio-label yes">
                <p>Sì, ci sarò!</p>
                <input type="radio" name="castle_confirm" value="true" tabindex="-1">
            </label>

            <label class="radio-label no">
                <p>No, mi spiace.</p>
                <input type="radio" name="castle_confirm" value="false" tabindex="-1">
            </label>
        </fieldset>

        <span class="error-box hidden"></span>

        <input type="submit" value="Conferma" tabindex="-1">
    </div>

    <span class="bot-section">    
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">Il ricevimento si svolgerà alle 19.00 presso il Castello Xirumi di Serravalle.
            <br>Abbiamo bisogno di sapere in anticipo se ci sarai.
            <br>Se i dati pre-inseriti dovessero essere corretti, puoi premere
            Ok e andare avanti.</p>
    </span>
</form>