{{--
    ============================================================
    KILLAVIBES — Register Page (Bagisto Blade)
    Sistema visual: Dark glassmorphism, purple/blue gradient
    Lógica backend: 100% original de Bagisto (sin modificar)
    ============================================================
--}}

@push('meta')
    <meta name="description" content="@lang('shop::app.customers.signup-form.page-title')" />
    <meta name="keywords"    content="@lang('shop::app.customers.signup-form.page-title')" />
@endpush

@push('styles')
<style>
/* ══ KILLAVIBES REGISTER ══════════════════════════════════ */
.kv-register-root {
    --kvr-bg: #0a0a0f;
    --kvr-purple: #7c3aed;
    --kvr-blue: #2563eb;
    --kvr-purple-light: #a78bfa;
    --kvr-card-bg: rgba(255,255,255,0.03);
    --kvr-card-border: rgba(255,255,255,0.10);
    --kvr-input-bg: rgba(255,255,255,0.05);
    --kvr-input-border: rgba(255,255,255,0.10);
    --kvr-input-focus: rgba(124,58,237,0.50);
    --kvr-text: #ffffff;
    --kvr-text-muted: rgba(255,255,255,0.50);
    --kvr-label-color: rgba(255,255,255,0.70);
    --kvr-error-text: #fca5a5;
    --kvr-font-heading: 'Space Grotesk','Inter',sans-serif;
    --kvr-font-body: 'Inter','Poppins',sans-serif;
    position:relative; min-height:100vh; display:flex;
    align-items:center; justify-content:center;
    background-color:var(--kvr-bg); overflow:hidden; padding:3rem 0;
}
.kv-register-overlay {
    position:absolute; inset:0;
    background:linear-gradient(135deg,rgba(88,28,135,.40) 0%,rgba(30,58,138,.40) 50%,rgba(0,0,0,.60) 100%);
    pointer-events:none; z-index:0;
}
.kv-register-orb--tr {
    position:absolute; top:-10%; right:-10%; width:45%; height:45%;
    background:rgba(124,58,237,.15); border-radius:9999px;
    filter:blur(120px); pointer-events:none; z-index:0;
}
.kv-register-orb--bl {
    position:absolute; bottom:-10%; left:-10%; width:45%; height:45%;
    background:rgba(37,99,235,.15); border-radius:9999px;
    filter:blur(120px); pointer-events:none; z-index:0;
}
.kv-register-container {
    position:relative; z-index:10; width:100%;
    max-width:576px; margin:0 auto; padding:0 1rem;
}
.kv-register-logo-wrap { display:flex; justify-content:center; margin-bottom:1.5rem; }
.kv-register-logo { filter:brightness(0) invert(1); opacity:.9; transition:opacity .3s; }
.kv-register-logo:hover { opacity:1; }
.kv-register-card {
    background:var(--kvr-card-bg);
    backdrop-filter:blur(40px); -webkit-backdrop-filter:blur(40px);
    border:1px solid var(--kvr-card-border); border-radius:2.5rem;
    padding:2rem;
    box-shadow:0 25px 50px -12px rgba(0,0,0,.5),inset 0 1px 0 rgba(255,255,255,.06);
}
@media(min-width:768px){ .kv-register-card{ padding:2.5rem; } }
.kv-register-header { text-align:center; margin-bottom:2rem; }
.kv-register-icon-wrap {
    display:inline-flex; padding:.75rem; border-radius:1rem;
    background:linear-gradient(135deg,rgba(124,58,237,.20),rgba(37,99,235,.20));
    border:1px solid rgba(255,255,255,.10); margin-bottom:1rem; color:#fff;
}
.kv-register-title {
    font-family:var(--kvr-font-heading) !important;
    font-size:1.875rem !important; font-weight:800 !important;
    color:#fff !important; letter-spacing:-.025em !important;
    line-height:1.2 !important; margin-bottom:.5rem !important;
}
.kv-register-subtitle {
    font-size:.875rem; color:var(--kvr-text-muted); margin-bottom:0;
}
.kv-register-grid {
    display:grid; grid-template-columns:1fr; gap:1.25rem; margin-bottom:1.25rem;
}
@media(min-width:768px){ .kv-register-grid{ grid-template-columns:1fr 1fr; } }
.kv-field-group { margin-bottom:1.25rem; }
.kv-register-label {
    display:block !important; font-size:.75rem !important;
    font-weight:600 !important; text-transform:uppercase !important;
    letter-spacing:.05em !important; color:var(--kvr-label-color) !important;
    margin-bottom:.5rem !important; margin-left:.25rem !important;
}
.kv-register-label.required::after { color:#f87171 !important; margin-left:.25rem; }
.kv-register-input,
.kv-register-root input.kv-register-input {
    width:100% !important; padding:.875rem 1.25rem !important;
    border-radius:1rem !important; background:var(--kvr-input-bg) !important;
    border:1px solid var(--kvr-input-border) !important;
    color:#fff !important; font-size:.9375rem !important;
    outline:none !important; box-shadow:none !important;
    transition:border-color .25s,background .25s !important;
}
.kv-register-input::placeholder { color:rgba(255,255,255,.25) !important; }
.kv-register-input:focus,
.kv-register-root input.kv-register-input:focus {
    border-color:var(--kvr-input-focus) !important;
    background:rgba(255,255,255,.07) !important;
    box-shadow:0 0 0 3px rgba(124,58,237,.12) !important;
}
.kv-register-input:-webkit-autofill,
.kv-register-input:-webkit-autofill:focus {
    -webkit-box-shadow:0 0 0 1000px rgba(30,20,50,.95) inset !important;
    -webkit-text-fill-color:#fff !important;
}
.kv-register-error {
    display:block !important; margin-top:.375rem !important;
    margin-left:.25rem !important; font-size:.75rem !important;
    font-weight:500 !important; color:var(--kvr-error-text) !important;
}
.kv-register-actions { display:flex; flex-direction:column; gap:1rem; padding-top:1.5rem; }
.kv-register-btn-primary {
    display:flex !important; align-items:center !important;
    justify-content:center !important; width:100% !important;
    padding:1rem 1.5rem !important; border-radius:1rem !important;
    background:linear-gradient(135deg,#7c3aed 0%,#2563eb 100%) !important;
    color:#fff !important; font-size:1rem !important; font-weight:700 !important;
    border:none !important; cursor:pointer !important;
    box-shadow:0 4px 14px rgba(124,58,237,.35) !important;
    transition:all .15s ease !important; max-width:none !important; margin:0 !important;
}
.kv-register-btn-primary:hover {
    box-shadow:0 8px 24px rgba(124,58,237,.50) !important;
    opacity:.95 !important; transform:translateY(-1px) !important; color:#fff !important;
}
.kv-register-btn-primary:active { transform:scale(.98) !important; }
.kv-register-btn-secondary {
    display:flex !important; align-items:center !important;
    justify-content:center !important; gap:.5rem !important;
    width:100% !important; padding:1rem !important; border-radius:1rem !important;
    background:rgba(255,255,255,.05) !important;
    border:1px solid rgba(255,255,255,.10) !important;
    color:rgba(255,255,255,.60) !important; font-size:.875rem !important;
    font-weight:600 !important; text-decoration:none !important;
    transition:all .25s ease !important;
}
.kv-register-btn-secondary:hover {
    background:rgba(255,255,255,.10) !important; color:#fff !important;
}
.kv-register-account-exists {
    margin-top:1.25rem !important; font-size:.875rem !important;
    color:var(--kvr-text-muted) !important; text-align:center !important;
    font-weight:500 !important;
}
.kv-register-account-exists__link {
    color:var(--kvr-purple-light) !important; font-weight:600 !important;
    text-decoration:none !important; margin-left:.25rem;
}
.kv-register-account-exists__link:hover { color:#fff !important; }
.kv-register-footer {
    margin-top:1.5rem !important; text-align:center !important;
    font-size:.75rem !important; color:rgba(255,255,255,.25) !important;
}
.kv-register-newsletter { display:flex; align-items:center; gap:.5rem; margin-bottom:1.25rem; }
.kv-register-newsletter__label { font-size:.875rem; color:var(--kvr-text-muted); cursor:pointer; }
@media(max-width:640px){
    .kv-register-card{ border-radius:1.25rem; padding:1.5rem; }
    .kv-register-title{ font-size:1.5rem !important; }
}
</style>
@endpush

<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
>
    <x-slot:title>
        @lang('shop::app.customers.signup-form.page-title')
    </x-slot>

    {{-- ══════════════════════════════════════════════════════════
         ROOT — fondo oscuro + orbes decorativos (igual que React)
         ══════════════════════════════════════════════════════════ --}}
    <div class="kv-register-root">

        <div class="kv-register-overlay"      aria-hidden="true"></div>
        <div class="kv-register-orb--tr"      aria-hidden="true"></div>
        <div class="kv-register-orb--bl"      aria-hidden="true"></div>

        <div class="kv-register-container">

            {!! view_render_event('bagisto.shop.customers.sign-up.logo.before') !!}

            {{-- Logo --}}
            <div class="kv-register-logo-wrap">
                <a href="{{ route('shop.home.index') }}"
                   aria-label="@lang('shop::app.customers.signup-form.bagisto')">
                    <img
                        src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                        alt="{{ config('app.name') }}"
                        width="131"
                        height="29"
                        class="kv-register-logo"
                    >
                </a>
            </div>

            {!! view_render_event('bagisto.shop.customers.sign-up.logo.before') !!}

            {{-- ══════════════════════════════════
                 CARD glassmorphism
                 ══════════════════════════════════ --}}
            <div class="kv-register-card">

                {{-- Cabecera --}}
                <div class="kv-register-header">
                    <div class="kv-register-icon-wrap" aria-hidden="true">
                        {{-- Ícono UserPlus (inline SVG, sin dependencias) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <line x1="19" y1="8" x2="19" y2="14"/>
                            <line x1="22" y1="11" x2="16" y2="11"/>
                        </svg>
                    </div>
                    <h1 class="kv-register-title">
                        @lang('shop::app.customers.signup-form.page-title')
                    </h1>
                    <p class="kv-register-subtitle">
                        @lang('shop::app.customers.signup-form.form-signup-text')
                    </p>
                </div>

                {{-- ══════════════════════════════════
                     FORMULARIO — lógica 100% Bagisto
                     ══════════════════════════════════ --}}
                <div class="kv-register-form-wrap">
                    <x-shop::form :action="route('shop.customers.register.store')">

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.before') !!}

                        {{-- Grid 2 columnas: Nombre | Apellido --}}
                        <div class="kv-register-grid">

                            <x-shop::form.control-group class="kv-field-group">
                                <x-shop::form.control-group.label class="kv-register-label required">
                                    @lang('shop::app.customers.signup-form.first-name')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control
                                    type="text"
                                    class="kv-register-input"
                                    name="first_name"
                                    rules="required"
                                    :value="old('first_name')"
                                    :label="trans('shop::app.customers.signup-form.first-name')"
                                    :placeholder="trans('shop::app.customers.signup-form.first-name')"
                                    :aria-label="trans('shop::app.customers.signup-form.first-name')"
                                    aria-required="true"
                                />
                                <x-shop::form.control-group.error class="kv-register-error" control-name="first_name" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.signup_form.first_name.after') !!}

                            <x-shop::form.control-group class="kv-field-group">
                                <x-shop::form.control-group.label class="kv-register-label required">
                                    @lang('shop::app.customers.signup-form.last-name')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control
                                    type="text"
                                    class="kv-register-input"
                                    name="last_name"
                                    rules="required"
                                    :value="old('last_name')"
                                    :label="trans('shop::app.customers.signup-form.last-name')"
                                    :placeholder="trans('shop::app.customers.signup-form.last-name')"
                                    :aria-label="trans('shop::app.customers.signup-form.last-name')"
                                    aria-required="true"
                                />
                                <x-shop::form.control-group.error class="kv-register-error" control-name="last_name" />
                            </x-shop::form.control-group>

                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form.last_name.after') !!}

                        {{-- Email --}}
                        <x-shop::form.control-group class="kv-field-group kv-field-group--full">
                            <x-shop::form.control-group.label class="kv-register-label required">
                                @lang('shop::app.customers.signup-form.email')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="email"
                                class="kv-register-input"
                                name="email"
                                rules="required|email"
                                :value="old('email')"
                                :label="trans('shop::app.customers.signup-form.email')"
                                placeholder="nombre@ejemplo.com"
                                :aria-label="trans('shop::app.customers.signup-form.email')"
                                aria-required="true"
                            />
                            <x-shop::form.control-group.error class="kv-register-error" control-name="email" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.signup_form.email.after') !!}

                        {{-- Password --}}
                        <x-shop::form.control-group class="kv-field-group kv-field-group--full">
                            <x-shop::form.control-group.label class="kv-register-label required">
                                @lang('shop::app.customers.signup-form.password')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="password"
                                class="kv-register-input"
                                name="password"
                                rules="required|min:6"
                                :value="old('password')"
                                :label="trans('shop::app.customers.signup-form.password')"
                                :placeholder="trans('shop::app.customers.signup-form.password')"
                                ref="password"
                                :aria-label="trans('shop::app.customers.signup-form.password')"
                                aria-required="true"
                            />
                            <x-shop::form.control-group.error class="kv-register-error" control-name="password" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.signup_form.password.after') !!}

                        {{-- Confirmar Password --}}
                        <x-shop::form.control-group class="kv-field-group kv-field-group--full">
                            <x-shop::form.control-group.label class="kv-register-label">
                                @lang('shop::app.customers.signup-form.confirm-pass')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="password"
                                class="kv-register-input"
                                name="password_confirmation"
                                rules="confirmed:@password"
                                value=""
                                :label="trans('shop::app.customers.signup-form.password')"
                                :placeholder="trans('shop::app.customers.signup-form.confirm-pass')"
                                :aria-label="trans('shop::app.customers.signup-form.confirm-pass')"
                                aria-required="true"
                            />
                            <x-shop::form.control-group.error class="kv-register-error" control-name="password_confirmation" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.signup_form.password_confirmation.after') !!}

                        {{-- CAPTCHA — condicional Bagisto, intacto --}}
                        @if (core()->getConfigData('customer.captcha.credentials.status'))
                            <div class="kv-field-group kv-field-group--full mb-5 flex">
                                {!! Captcha::render() !!}
                            </div>
                        @endif

                        {{-- Newsletter — condicional Bagisto, intacto --}}
                        @if (core()->getConfigData('customer.settings.create_new_account_options.news_letter'))
                            <div class="kv-register-newsletter">
                                <input
                                    type="checkbox"
                                    name="is_subscribed"
                                    id="is-subscribed"
                                    class="peer hidden"
                                    onchange="switchVisibility()"
                                />
                                <label
                                    class="icon-uncheck peer-checked:icon-check-box kv-register-newsletter__check"
                                    for="is-subscribed"
                                ></label>
                                <label class="kv-register-newsletter__label" for="is-subscribed">
                                    @lang('shop::app.customers.signup-form.subscribe-to-newsletter')
                                </label>
                            </div>
                        @endif

                        {!! view_render_event('bagisto.shop.customers.signup_form.newsletter_subscription.after') !!}

                        {{-- Botones de acción --}}
                        <div class="kv-register-actions">

                            <button type="submit" class="kv-register-btn-primary">
                                @lang('shop::app.customers.signup-form.button-title')
                            </button>

                            <a href="{{ route('shop.customer.session.index') }}"
                               class="kv-register-btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     aria-hidden="true">
                                    <path d="m15 18-6-6 6-6"/>
                                </svg>
                                @lang('shop::app.customers.signup-form.sign-in-button')
                            </a>

                            <div class="flex flex-wrap gap-4">
                                {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}
                            </div>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.signup_form_controls.after') !!}

                    </x-shop::form>
                </div>

                {{-- Link ¿Ya tienes cuenta? --}}
                <p class="kv-register-account-exists">
                    @lang('shop::app.customers.signup-form.account-exists')
                    <a href="{{ route('shop.customer.session.index') }}"
                       class="kv-register-account-exists__link">
                        @lang('shop::app.customers.signup-form.sign-in-button')
                    </a>
                </p>

            </div>{{-- /kv-register-card --}}

            <p class="kv-register-footer">
                @lang('shop::app.customers.signup-form.footer', ['current_year' => date('Y')])
            </p>

        </div>{{-- /kv-register-container --}}
    </div>{{-- /kv-register-root --}}

    @push('scripts')
        {!! Captcha::renderJS() !!}
    @endpush

</x-shop::layouts>
