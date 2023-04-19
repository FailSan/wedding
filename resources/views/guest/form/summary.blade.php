<div class="summary-container">
    <div class="main-summary">
        <p class="brown">{{ __("Riepilogo") }}</p>

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

        <span class="summary-field hidden" data-content="diet">
            <p class="field">{{ __("Dieta") }}</p>
            <p class="value"></p>
        </span>

        <span class="summary-field hidden" data-content="allergies">
            <p class="field">{{ __("Allergie") }}</p>
            <p class="value"></p>
        </span>

        <span class="summary-field hidden" data-content="extra_confirm">
            <p class="field">{{ __("Ospiti Extra") }}</p>
            <p class="value"></p>
        </span>

        <span class="summary-field hidden" data-content="extra_guests">
            <p class="field">{{ __("Numero Ospiti") }}</p>
            <p class="value"></p>
        </span>
    </div>

    <div class="extra-summary-container hidden">
        <p class="brown">{{ __("Ospiti Extra") }}</p>
        
        <div class="extra-summary" data-guest-index="0">

            <span class="summary-field" data-content="name">
                <p class="field">{{ __("Nome") }}</p>
                <p class="value"></p>
            </span>

            <span class="summary-field" data-content="surname">
                <p class="field">{{ __("Cognome") }}</p>
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

        </div>
    </div>
</div>

<button class="confirm-button" tabindex="-1">
    @csrf
    {{ __("Conferma") }}
</button>