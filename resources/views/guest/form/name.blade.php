<form action="#" method="post" id="name_form" data-form-sel="1" data-content="name">
    @csrf
    <p class="brown">1 / 4</p>
    
    <p class="mid">Cominciamo con qualcosa di semplice. E' proprio questo il tuo <i>nome</i>?</p>
    <input type="text" name="name" value="{{ $guest->name }}" placeholder="Nome" autocomplete="off">
    
    <p class="error-box hidden"></p>
    
    <label class="submit-label">
        <input type="submit" value="Ok!">
        <p>premi <strong>Invio &crarr;</strong></p>
    </label>

    <span class="info-box">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">Ti chiederemo di confermare i tuoi dati anagrafici principali.
            <br>Se i dati pre-inseriti dovessero essere corretti, puoi premere
            Ok e andare avanti.</p>
    </span>
</form>