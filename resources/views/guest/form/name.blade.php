<form action="#" method="post" id="name_form" data-form-sel="1" data-content="name">
    @csrf

    <span class="top-section">
        <p class="brown">1 / 4</p>
        <p class="mid">Cominciamo con qualcosa di semplice. E' proprio questo il tuo <i>nome</i>?</p>
    </span>
    
    <div class="mid-section">
        <label class="main-input">
            <p>Nome</p>
            <input type="text" name="name" value="{{ $guest->name }}" placeholder=" " autocomplete="off" tabindex="-1">
        </label>
        
        <span class="error-box hidden"></span>
        
        <input type="submit" value="Conferma" tabindex="-1">
    </div>

    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">Ti chiederemo di confermare i tuoi dati anagrafici principali.
            <br>Se i dati pre-inseriti dovessero essere corretti, puoi premere
            <strong>Conferma</strong> e andare avanti.</p>
    </span>
</form>