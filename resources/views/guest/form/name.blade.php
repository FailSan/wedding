<form action="#" method="post" id="name_form" data-form-sel="1" data-content="name">
    @csrf

    <span class="top-section">
        <p class="brown">1 / 4</p>
        <p class="mid">{{ __("Cominciamo con qualcosa di semplice. E' proprio questo il tuo") }} <i>{{ __("Nome") }}</i>?</p>

        <label class="main-input">
            <p>{{ __("Nome") }}</p>
            <input type="text" name="name" value="{{ $guest->name }}" placeholder=" " autocomplete="off" tabindex="-1">
        </label>
        
        <span class="error-box hidden"></span>
        
        <input type="submit" value="{{ __('Conferma') }}" tabindex="-1">
    </span>

    <span class="bot-section">
        <img src="{{ Storage::url('images/info.svg') }}">
        <p class="grey">{{ __("Ti chiederemo di confermare i tuoi dati anagrafici principali. Se i dati pre-inseriti dovessero essere corretti, puoi premere") }}
            <strong>{{ __("Conferma") }}</strong> {{__("e andare avanti.") }}</p>
    </span>
</form>