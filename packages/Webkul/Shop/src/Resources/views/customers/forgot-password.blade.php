<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('shop::app.customers.forgot-password.title')"/>
    <meta name="keywords" content="@lang('shop::app.customers.forgot-password.title')"/>
@endPush

@push('styles')
<style>
/* ══ KILLAVIBES FORGOT PASSWORD ══════════════════════════ */
.kv-forgot-root {
    --kvf-bg: #0a0a0f;
    --kvf-purple: #7c3aed;
    --kvf-blue: #2563eb;
    --kvf-purple-light: #a78bfa;
    --kvf-card-bg: rgba(255,255,255,0.03);
    --kvf-card-border: rgba(255,255,255,0.10);
    --kvf-input-bg: rgba(255,255,255,0.05);
    --kvf-input-border: rgba(255,255,255,0.10);
    --kvf-input-focus: rgba(124,58,237,0.50);
    --kvf-text-muted: rgba(255,255,255,0.50);
    --kvf-label-color: rgba(255,255,255,0.70);
    --kvf-error-text: #fca5a5;
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--kvf-bg);
    overflow: hidden;
    padding: 3rem 0;
}

.kv-forgot-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(88,28,135,.40) 0%, rgba(30,58,138,.40) 50%, rgba(0,0,0,.60) 100%);
    pointer-events: none; z-index: 0;
}
.kv-forgot-orb--tr {
    position: absolute; top: -10%; right: -10%;
    width: 45%; height: 45%;
    background: rgba(124,58,237,.15); border-radius: 9999px;
    filter: blur(120px); pointer-events: none; z-index: 0;
}
.kv-forgot-orb--bl {
    position: absolute; bottom: -10%; left: -10%;
    width: 45%; height: 45%;
    background: rgba(37,99,235,.15); border-radius: 9999px;
    filter: blur(120px); pointer-events: none; z-index: 0;
}

.kv-forgot-container {
    position: relative; z-index: 10;
    width: 100%; max-width: 480px;
    margin: 0 auto; padding: 0 1rem;
}

.kv-forgot-logo-wrap {
    display: flex; justify-content: center; margin-bottom: 1.5rem;
}
.kv-forgot-logo {
    filter: brightness(0) invert(1); opacity: .9; transition: opacity .3s;
}
.kv-forgot-logo:hover { opacity: 1; }

.kv-forgot-card {
    background: var(--kvf-card-bg);
    backdrop-filter: blur(40px); -webkit-backdrop-filter: blur(40px);
    border: 1px solid var(--kvf-card-border);
    border-radius: 2.5rem;
    padding: 2rem;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,.5), inset 0 1px 0 rgba(255,255,255,.06);
}
@media(min-width: 768px) { .kv-forgot-card { padding: 2.5rem; } }

.kv-forgot-header { text-align: center; margin-bottom: 2rem; }
.kv-forgot-icon-wrap {
    display: inline-flex; padding: .75rem; border-radius: 1rem;
    background: linear-gradient(135deg, rgba(124,58,237,.20), rgba(37,99,235,.20));
    border: 1px solid rgba(255,255,255,.10);
    margin-bottom: 1rem; color: #fff;
}
.kv-forgot-title {
    font-size: 1.875rem !important; font-weight: 800 !important;
    color: #fff !important; letter-spacing: -.025em !important;
    line-height: 1.2 !important; margin-bottom: .5rem !important;
}
.kv-forgot-subtitle {
    font-size: .875rem; color: var(--kvf-text-muted); margin-bottom: 0;
    line-height: 1.6;
}

/* Info banner */
.kv-forgot-info {
    display: flex; align-items: flex-start; gap: .75rem;
    background: rgba(124,58,237,.10);
    border: 1px solid rgba(124,58,237,.20);
    border-radius: .875rem;
    padding: .875rem 1rem;
    margin-bottom: 1.5rem;
}
.kv-forgot-info p {
    font-size: .8125rem; color: rgba(255,255,255,.65); line-height: 1.55; margin: 0;
}

/* Labels */
.kv-forgot-label {
    display: block !important; font-size: .75rem !important;
    font-weight: 600 !important; text-transform: uppercase !important;
    letter-spacing: .05em !important; color: var(--kvf-label-color) !important;
    margin-bottom: .5rem !important; margin-left: .25rem !important;
}
.kv-forgot-label.required::after { color: #f87171 !important; margin-left: .25rem; }

/* Inputs */
.kv-forgot-input,
.kv-forgot-root input.kv-forgot-input {
    width: 100% !important; padding: .875rem 1.25rem !important;
    border-radius: 1rem !important; background: var(--kvf-input-bg) !important;
    border: 1px solid var(--kvf-input-border) !important;
    color: #fff !important; font-size: .9375rem !important;
    outline: none !important; box-shadow: none !important;
    transition: border-color .25s, background .25s !important;
}
.kv-forgot-input::placeholder { color: rgba(255,255,255,.25) !important; }
.kv-forgot-input:focus,
.kv-forgot-root input.kv-forgot-input:focus {
    border-color: var(--kvf-input-focus) !important;
    background: rgba(255,255,255,.07) !important;
    box-shadow: 0 0 0 3px rgba(124,58,237,.12) !important;
}
.kv-forgot-input:-webkit-autofill,
.kv-forgot-input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px rgba(30,20,50,.95) inset !important;
    -webkit-text-fill-color: #fff !important;
}

/* Error */
.kv-forgot-error {
    display: block !important; margin-top: .375rem !important;
    margin-left: .25rem !important; font-size: .75rem !important;
    font-weight: 500 !important; color: var(--kvf-error-text) !important;
}

/* Field spacing */
.kv-forgot-field { margin-bottom: 1.25rem; }

/* Actions */
.kv-forgot-actions { display: flex; flex-direction: column; gap: 1rem; padding-top: 1.25rem; }

/* Submit button */
.kv-forgot-btn-primary {
    display: flex !important; align-items: center !important;
    justify-content: center !important; gap: .5rem !important;
    width: 100% !important; padding: 1rem 1.5rem !important;
    border-radius: 1rem !important;
    background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%) !important;
    color: #fff !important; font-size: 1rem !important; font-weight: 700 !important;
    border: none !important; cursor: pointer !important;
    box-shadow: 0 4px 14px rgba(124,58,237,.35) !important;
    transition: all .15s ease !important;
    max-width: none !important; margin: 0 !important;
}
.kv-forgot-btn-primary:hover {
    box-shadow: 0 8px 24px rgba(124,58,237,.50) !important;
    opacity: .95 !important; transform: translateY(-1px) !important;
    color: #fff !important;
}
.kv-forgot-btn-primary:active { transform: scale(.98) !important; }

/* Back button */
.kv-forgot-btn-secondary {
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
.kv-forgot-btn-secondary:hover {
    background: rgba(255,255,255,.10) !important; color: #fff !important;
}

/* Footer */
.kv-forgot-footer {
    margin-top: 1.5rem !important; text-align: center !important;
    font-size: .75rem !important; color: rgba(255,255,255,.25) !important;
}

@media(max-width: 640px) {
    .kv-forgot-card { border-radius: 1.25rem; padding: 1.5rem; }
    .kv-forgot-title { font-size: 1.5rem !important; }
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
        @lang('shop::app.customers.forgot-password.title')
    </x-slot>

    <div class="kv-forgot-root">

        <!-- Background layers -->
        <div class="kv-forgot-overlay" aria-hidden="true"></div>
        <div class="kv-forgot-orb--tr" aria-hidden="true"></div>
        <div class="kv-forgot-orb--bl" aria-hidden="true"></div>

        <div class="kv-forgot-container">

            {!! view_render_event('bagisto.shop.customers.forget_password.logo.before') !!}

            <!-- Logo -->
            <div class="kv-forgot-logo-wrap">
                <a
                    href="{{ route('shop.home.index') }}"
                    aria-label="@lang('shop::app.customers.forgot-password.bagisto')"
                >
                    <img
                        src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                        alt="{{ config('app.name') }}"
                        width="131"
                        height="29"
                        class="kv-forgot-logo"
                    >
                </a>
            </div>

            {!! view_render_event('bagisto.shop.customers.forget_password.logo.after') !!}

            <!-- Card -->
            <div class="kv-forgot-card">

                <!-- Header -->
                <div class="kv-forgot-header">
                    <div class="kv-forgot-icon-wrap" aria-hidden="true">
                        <!-- Key icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0 3 3L22 7l-3-3m-3.5 3.5L19 4"/>
                        </svg>
                    </div>
                    <h1 class="kv-forgot-title">
                        @lang('shop::app.customers.forgot-password.title')
                    </h1>
                    <p class="kv-forgot-subtitle">
                        @lang('shop::app.customers.forgot-password.forgot-password-text')
                    </p>
                </div>

                <!-- Info banner -->
                <div class="kv-forgot-info">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-4 w-4 flex-shrink-0 text-[#a78bfa]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p>Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>
                </div>

                {!! view_render_event('bagisto.shop.customers.forget_password.before') !!}

                <!-- Form -->
                <x-shop::form :action="route('shop.customers.forgot_password.store')">

                    {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.before') !!}

                    <!-- Email -->
                    <x-shop::form.control-group class="kv-forgot-field">
                        <x-shop::form.control-group.label class="kv-forgot-label required">
                            @lang('shop::app.customers.login-form.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="email"
                            class="kv-forgot-input"
                            name="email"
                            rules="required|email"
                            value=""
                            :label="trans('shop::app.customers.login-form.email')"
                            placeholder="nombre@ejemplo.com"
                            :aria-label="trans('shop::app.customers.login-form.email')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error class="kv-forgot-error" control-name="email" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.email.after') !!}

                    <!-- Captcha -->
                    <div class="mb-5">
                        {!! Captcha::render() !!}
                    </div>

                    <!-- Actions -->
                    <div class="kv-forgot-actions">

                        <button type="submit" class="kv-forgot-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            @lang('shop::app.customers.forgot-password.submit')
                        </button>

                        <a
                            href="{{ route('shop.customer.session.index') }}"
                            class="kv-forgot-btn-secondary"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 aria-hidden="true">
                                <path d="m15 18-6-6 6-6"/>
                            </svg>
                            @lang('shop::app.customers.forgot-password.back')
                            @lang('shop::app.customers.forgot-password.sign-in-button')
                        </a>

                    </div>

                    {!! view_render_event('bagisto.shop.customers.forget_password_form_controls.after') !!}

                </x-shop::form>

                {!! view_render_event('bagisto.shop.customers.forget_password.after') !!}

            </div><!-- /kv-forgot-card -->

            <p class="kv-forgot-footer">
                @lang('shop::app.customers.forgot-password.footer', ['current_year' => date('Y')])
            </p>

        </div><!-- /kv-forgot-container -->
    </div><!-- /kv-forgot-root -->

    @push('scripts')
        {!! Captcha::renderJS() !!}
    @endpush
</x-shop::layouts>
