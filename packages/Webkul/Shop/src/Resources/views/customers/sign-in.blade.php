<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('shop::app.customers.login-form.page-title')"/>
    <meta name="keywords" content="@lang('shop::app.customers.login-form.page-title')"/>
@endPush

@push('styles')
<style>
/* ══ KILLAVIBES SIGN-IN ══════════════════════════════════ */
.kv-login-root {
    --kvl-bg: #0a0a0f;
    --kvl-purple: #7c3aed;
    --kvl-blue: #2563eb;
    --kvl-purple-light: #a78bfa;
    --kvl-card-bg: rgba(255,255,255,0.03);
    --kvl-card-border: rgba(255,255,255,0.10);
    --kvl-input-bg: rgba(255,255,255,0.05);
    --kvl-input-border: rgba(255,255,255,0.10);
    --kvl-input-focus: rgba(124,58,237,0.50);
    --kvl-text: #ffffff;
    --kvl-text-muted: rgba(255,255,255,0.50);
    --kvl-label-color: rgba(255,255,255,0.70);
    --kvl-error-text: #fca5a5;
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--kvl-bg);
    overflow: hidden;
    padding: 3rem 0;
}
.kv-login-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(88,28,135,.40) 0%, rgba(30,58,138,.40) 50%, rgba(0,0,0,.60) 100%);
    pointer-events: none; z-index: 0;
}
.kv-login-orb--tr {
    position: absolute; top: -10%; right: -10%;
    width: 45%; height: 45%;
    background: rgba(124,58,237,.15); border-radius: 9999px;
    filter: blur(120px); pointer-events: none; z-index: 0;
}
.kv-login-orb--bl {
    position: absolute; bottom: -10%; left: -10%;
    width: 45%; height: 45%;
    background: rgba(37,99,235,.15); border-radius: 9999px;
    filter: blur(120px); pointer-events: none; z-index: 0;
}
.kv-login-container {
    position: relative; z-index: 10;
    width: 100%; max-width: 480px;
    margin: 0 auto; padding: 0 1rem;
}
.kv-login-logo-wrap {
    display: flex; justify-content: center; margin-bottom: 1.5rem;
}
.kv-login-logo {
    filter: brightness(0) invert(1); opacity: .9; transition: opacity .3s;
}
.kv-login-logo:hover { opacity: 1; }

.kv-login-card {
    background: var(--kvl-card-bg);
    backdrop-filter: blur(40px); -webkit-backdrop-filter: blur(40px);
    border: 1px solid var(--kvl-card-border); border-radius: 2.5rem;
    padding: 2rem;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,.5), inset 0 1px 0 rgba(255,255,255,.06);
}
@media(min-width: 768px) { .kv-login-card { padding: 2.5rem; } }

.kv-login-header { text-align: center; margin-bottom: 2rem; }
.kv-login-icon-wrap {
    display: inline-flex; padding: .75rem; border-radius: 1rem;
    background: linear-gradient(135deg, rgba(124,58,237,.20), rgba(37,99,235,.20));
    border: 1px solid rgba(255,255,255,.10);
    margin-bottom: 1rem; color: #fff;
}
.kv-login-title {
    font-size: 1.875rem !important; font-weight: 800 !important;
    color: #fff !important; letter-spacing: -.025em !important;
    line-height: 1.2 !important; margin-bottom: .5rem !important;
}
.kv-login-subtitle {
    font-size: .875rem; color: var(--kvl-text-muted); margin-bottom: 0;
}

/* Labels */
.kv-login-label {
    display: block !important; font-size: .75rem !important;
    font-weight: 600 !important; text-transform: uppercase !important;
    letter-spacing: .05em !important; color: var(--kvl-label-color) !important;
    margin-bottom: .5rem !important; margin-left: .25rem !important;
}
.kv-login-label.required::after { color: #f87171 !important; margin-left: .25rem; }

/* Inputs */
.kv-login-input,
.kv-login-root input.kv-login-input {
    width: 100% !important; padding: .875rem 1.25rem !important;
    border-radius: 1rem !important; background: var(--kvl-input-bg) !important;
    border: 1px solid var(--kvl-input-border) !important;
    color: #fff !important; font-size: .9375rem !important;
    outline: none !important; box-shadow: none !important;
    transition: border-color .25s, background .25s !important;
}
.kv-login-input::placeholder { color: rgba(255,255,255,.25) !important; }
.kv-login-input:focus,
.kv-login-root input.kv-login-input:focus {
    border-color: var(--kvl-input-focus) !important;
    background: rgba(255,255,255,.07) !important;
    box-shadow: 0 0 0 3px rgba(124,58,237,.12) !important;
}
.kv-login-input:-webkit-autofill,
.kv-login-input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px rgba(30,20,50,.95) inset !important;
    -webkit-text-fill-color: #fff !important;
}

/* Error */
.kv-login-error {
    display: block !important; margin-top: .375rem !important;
    margin-left: .25rem !important; font-size: .75rem !important;
    font-weight: 500 !important; color: var(--kvl-error-text) !important;
}

/* Checkbox row */
.kv-login-check-row {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 1.5rem; flex-wrap: wrap; gap: .75rem;
}
.kv-login-check-label {
    display: flex; align-items: center; gap: .5rem;
    font-size: .875rem; color: var(--kvl-text-muted);
    cursor: pointer; user-select: none;
}
.kv-login-check-icon {
    font-size: 1.25rem; color: var(--kvl-purple-light);
}
.kv-login-forgot {
    font-size: .875rem; color: var(--kvl-purple-light);
    font-weight: 600; text-decoration: none;
    transition: color .2s;
}
.kv-login-forgot:hover { color: #fff; }

/* Submit button */
.kv-login-btn-primary {
    display: flex !important; align-items: center !important;
    justify-content: center !important; width: 100% !important;
    padding: 1rem 1.5rem !important; border-radius: 1rem !important;
    background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%) !important;
    color: #fff !important; font-size: 1rem !important;
    font-weight: 700 !important; border: none !important;
    cursor: pointer !important;
    box-shadow: 0 4px 14px rgba(124,58,237,.35) !important;
    transition: all .15s ease !important;
    max-width: none !important; margin: 0 !important;
}
.kv-login-btn-primary:hover {
    box-shadow: 0 8px 24px rgba(124,58,237,.50) !important;
    opacity: .95 !important; transform: translateY(-1px) !important;
    color: #fff !important;
}
.kv-login-btn-primary:active { transform: scale(.98) !important; }

/* Register link button */
.kv-login-btn-secondary {
    display: flex !important; align-items: center !important;
    justify-content: center !important; gap: .5rem !important;
    width: 100% !important; padding: 1rem !important;
    border-radius: 1rem !important;
    background: rgba(255,255,255,.05) !important;
    border: 1px solid rgba(255,255,255,.10) !important;
    color: rgba(255,255,255,.60) !important; font-size: .875rem !important;
    font-weight: 600 !important; text-decoration: none !important;
    transition: all .25s ease !important;
}
.kv-login-btn-secondary:hover {
    background: rgba(255,255,255,.10) !important; color: #fff !important;
}

/* Actions wrapper */
.kv-login-actions { display: flex; flex-direction: column; gap: 1rem; padding-top: .5rem; }

/* Footer */
.kv-login-footer {
    margin-top: 1.5rem !important; text-align: center !important;
    font-size: .75rem !important; color: rgba(255,255,255,.25) !important;
}

/* Divider */
.kv-login-divider {
    display: flex; align-items: center; gap: .75rem; margin: 1.25rem 0;
}
.kv-login-divider__line {
    flex: 1; height: 1px; background: rgba(255,255,255,.08);
}
.kv-login-divider__text {
    font-size: .75rem; color: rgba(255,255,255,.25); white-space: nowrap;
}

/* Field spacing */
.kv-login-field { margin-bottom: 1.25rem; }
.kv-login-field:last-of-type { margin-bottom: 0; }

@media(max-width: 640px) {
    .kv-login-card { border-radius: 1.25rem; padding: 1.5rem; }
    .kv-login-title { font-size: 1.5rem !important; }
}
</style>
@endpush

<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.login-form.page-title')
    </x-slot>

    <div class="kv-login-root">

        <!-- Background layers -->
        <div class="kv-login-overlay"  aria-hidden="true"></div>
        <div class="kv-login-orb--tr"  aria-hidden="true"></div>
        <div class="kv-login-orb--bl"  aria-hidden="true"></div>

        <div class="kv-login-container">

            {!! view_render_event('bagisto.shop.customers.login.logo.before') !!}

            <!-- Logo -->
            <div class="kv-login-logo-wrap">
                <a
                    href="{{ route('shop.home.index') }}"
                    aria-label="@lang('shop::app.customers.login-form.bagisto')"
                >
                    <img
                        src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                        alt="{{ config('app.name') }}"
                        width="131"
                        height="29"
                        class="kv-login-logo"
                    >
                </a>
            </div>

            {!! view_render_event('bagisto.shop.customers.login.logo.after') !!}

            <!-- Card -->
            <div class="kv-login-card">

                <!-- Header -->
                <div class="kv-login-header">
                    <div class="kv-login-icon-wrap" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                            <polyline points="10 17 15 12 10 7"/>
                            <line x1="15" y1="12" x2="3" y2="12"/>
                        </svg>
                    </div>
                    <h1 class="kv-login-title">
                        @lang('shop::app.customers.login-form.page-title')
                    </h1>
                    <p class="kv-login-subtitle">
                        @lang('shop::app.customers.login-form.form-login-text')
                    </p>
                </div>

                {!! view_render_event('bagisto.shop.customers.login.before') !!}

                <!-- Form -->
                <x-shop::form :action="route('shop.customer.session.create')">

                    {!! view_render_event('bagisto.shop.customers.login_form_controls.before') !!}

                    <!-- Email -->
                    <x-shop::form.control-group class="kv-login-field">
                        <x-shop::form.control-group.label class="kv-login-label required">
                            @lang('shop::app.customers.login-form.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="email"
                            class="kv-login-input"
                            name="email"
                            rules="required|email"
                            value=""
                            :label="trans('shop::app.customers.login-form.email')"
                            placeholder="nombre@ejemplo.com"
                            :aria-label="trans('shop::app.customers.login-form.email')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error class="kv-login-error" control-name="email" />
                    </x-shop::form.control-group>

                    <!-- Password -->
                    <x-shop::form.control-group class="kv-login-field">
                        <x-shop::form.control-group.label class="kv-login-label required">
                            @lang('shop::app.customers.login-form.password')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="password"
                            class="kv-login-input"
                            id="password"
                            name="password"
                            rules="required|min:6"
                            value=""
                            :label="trans('shop::app.customers.login-form.password')"
                            :placeholder="trans('shop::app.customers.login-form.password')"
                            :aria-label="trans('shop::app.customers.login-form.password')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error class="kv-login-error" control-name="password" />
                    </x-shop::form.control-group>

                    <!-- Show password + Forgot password -->
                    <div class="kv-login-check-row">
                        <div class="flex select-none items-center gap-2">
                            <input
                                type="checkbox"
                                id="show-password"
                                class="peer hidden"
                                onchange="switchVisibility()"
                            />
                            <label
                                class="icon-uncheck peer-checked:icon-check-box kv-login-check-icon cursor-pointer"
                                for="show-password"
                            ></label>
                            <label
                                class="kv-login-check-label"
                                for="show-password"
                            >
                                @lang('shop::app.customers.login-form.show-password')
                            </label>
                        </div>

                        <a
                            href="{{ route('shop.customers.forgot_password.create') }}"
                            class="kv-login-forgot"
                        >
                            @lang('shop::app.customers.login-form.forgot-pass')
                        </a>
                    </div>

                    <!-- Captcha -->
                    @if (core()->getConfigData('customer.captcha.credentials.status'))
                        <div class="mb-5 flex">
                            {!! Captcha::render() !!}
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="kv-login-actions">

                        <button
                            type="submit"
                            class="kv-login-btn-primary"
                        >
                            @lang('shop::app.customers.login-form.button-title')
                        </button>

                        {!! view_render_event('bagisto.shop.customers.login_form_controls.after') !!}

                        <div class="kv-login-divider">
                            <div class="kv-login-divider__line"></div>
                            <span class="kv-login-divider__text">¿No tienes cuenta?</span>
                            <div class="kv-login-divider__line"></div>
                        </div>

                        <a
                            href="{{ route('shop.customers.register.index') }}"
                            class="kv-login-btn-secondary"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 aria-hidden="true">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <line x1="19" y1="8" x2="19" y2="14"/>
                                <line x1="22" y1="11" x2="16" y2="11"/>
                            </svg>
                            @lang('shop::app.customers.login-form.new-customer')
                            @lang('shop::app.customers.login-form.create-your-account')
                        </a>

                    </div>

                </x-shop::form>

                {!! view_render_event('bagisto.shop.customers.login.after') !!}

            </div><!-- /kv-login-card -->

            <p class="kv-login-footer">
                @lang('shop::app.customers.login-form.footer', ['current_year' => date('Y')])
            </p>

        </div><!-- /kv-login-container -->
    </div><!-- /kv-login-root -->

    @push('scripts')
        {!! Captcha::renderJS() !!}

        <script>
            function switchVisibility() {
                let passwordField = document.getElementById("password");

                passwordField.type = passwordField.type === "password"
                    ? "text"
                    : "password";
            }
        </script>
    @endpush
</x-shop::layouts>
