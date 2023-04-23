<p class="brown-heading">{{ __("Riepilogo") }}</p>

<div class="summary-container">
    <span class="summary-field" data-content="name">
        <p class="field">{{ __("Nome") }}</p>
        <p class="value"></p>
    </span>

    <span class="summary-field" data-content="surname">
        <p class="field">{{ __("Cognome") }}</p>
        <p class="value"></p>
    </span>

    <span class="summary-field" data-content="church_confirm">
        <p class="field">{{ __("Presente alla Cerimonia") }}</p>
        <p class="value"></p>
    </span>

    <span class="summary-field" data-content="castle_confirm">
        <p class="field">{{ __("Presente al Ricevimento") }}</p>
        <p class="value"></p>
    </span>

    <span class="summary-field" data-content="diet">
        <p class="field">{{ __("Dieta") }}</p>
        <p class="value"></p>
    </span>

    <span class="summary-field" data-content="allergies">
        <p class="field">{{ __("Allergie") }}</p>
        <p class="value"></p>
    </span>

    <span class="summary-field" data-content="extra_confirm">
        <p class="field">{{ __("Ospiti Extra") }}</p>
        <p class="value"></p>
    </span>
</div>

<div class="submit-container">
    <button class="cta-button action-button add-guest edit-mode" tabindex="-1">
        Modifica Dati
    </button>

    <button class="cta-button input-button" tabindex="-1">
        @csrf
        {{ __("Ok, ho finito!") }}
    </button>
</div>