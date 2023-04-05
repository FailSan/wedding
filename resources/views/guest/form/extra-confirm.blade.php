<form class="hidden" action="#" method="post" id="extra_confirm_form" data-form-sel="0" data-content="extra_confirm">
    @csrf

    <p class="brown">7 / 7</p>

    <p class="mid">Pensi di portare altri <i>ospiti</i> con te?</p>
    
    <fieldset class="radio-group">
        <label class="radio-label">
            <p>Sì, ho qualche ospite!</p>
            <img src="{{ Storage::url('images/yes.svg') }}">
            <input type="radio" name="extra_confirm" value="true" tabindex="-1">
        </label>

        <label class="radio-label">
            <p>No, non porto nessuno con me.</p>
            <img src="{{ Storage::url('images/no.svg') }}">
            <input type="radio" name="extra_confirm" value="false" tabindex="-1">
        </label>
    </fieldset>

    <p class="error-box hidden"></p>

    <label class="submit-label">
        <input type="submit" value="Ok!" tabindex="-1">
        <p>premi <strong>Invio &crarr;</strong></p>
    </label>

    <span class="info-box">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">Puoi portare con te qualcuno se vuoi, assicurati però di inserire i
            suoi dati corretti.
            <br>Se i dati pre-inseriti dovessero essere corretti, puoi premere
            Ok e andare avanti.</p>
    </span>
</form>