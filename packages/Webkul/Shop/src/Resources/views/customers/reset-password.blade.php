<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('shop::app.customers.reset-password.title')"/>
    <meta name="keywords" content="@lang('shop::app.customers.reset-password.title')"/>
@endPush

@push('styles')
<style>
/* ══ KILLAVIBES RESET PASSWORD ═══════════════════════════ */
.kv-reset-root {
    --kvr-bg: #0a0a0f;
    --kvr-purple: #7c3aed;
    --kvr-blue: #2563eb;
    --kvr-purple-light: #a78bfa;
    --kvr-card-bg: rgba(255,255,255,0.03);
    --kvr-card-border: rgba(255,255,255,0.10);
    --kvr-input-bg: rgba(255,255,255,0.05);
    --kvr-input-border: rgba(255,255,255,0.10);
    --kvr-input-focus: rgba(124,58,237,0.50);
    --kvr-text-muted: rgba(255,255,255,0.50);
    --kvr-label-color: rgba(255,255,255,0.70);
    --kvr-error-text: #fca5a5;
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--kvr-bg);
    overflow: hidden;
    padding: 3rem 0;
}

.kv-reset-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(88,28,135,.40) 0%, rgba(30,58,138,.40) 50%, rgba(0,0,0,.60) 100%);
    pointer-events: none; z-index: 0;
}
.kv-reset-orb--tr {
    position: absolute; top: -10%; right: -10%;
    width: 45%; height: 45%;
    background: rgba(124,58,237,.15); border-radius: 9999px;
    filter: blur(120px); pointer-events: none; z-index: 0;
}
.kv-reset-orb--bl {
    position: absolute; bottom: -10%; left: -10%;
    width: 45%; height: 45%;
    background: rgba(37,99,235,.15); border-radius: 9999px;
    filter: blur(120px); pointer-events: none; z-index: 0;
}

.kv-reset-container {
    position: relative; z-index: 10;
    width: 100%; max-width: 480px;
    margin: 0 auto; padding: 0 1rem;
}

.kv-reset-logo-wrap {
    display: flex; justify-content: center; margin-bottom: 1.5rem;
}
.kv-reset-logo {
    filter: brightness(0) invert(1); opacity: .9; transition: opacity .3s;
}
.kv-reset-logo:hover { opacity: 1; }

.kv-reset-card {
    background: var(--kvr-card-bg);
    backdrop-filter: blur(40px); -webkit-backdrop-filter: blur(40px);
    border: 1px solid var(--kvr-card-border);
    border-radius: 2.5rem;
    padding: 2rem;
    box-shadow: 0 25px 50px -12px rgba(0,0,0,.5), inset 0 1px 0 rgba(255,255,255,.06);
}
@media(min-width: 768px) { .kv-reset-card { padding: 2.5rem; } }

.kv-reset-header { text-align: center; margin-bottom: 2rem; }
.kv-reset-icon-wrap {
    display: inline-flex; padding: .75rem; border-radius: 1rem;
    background: linear-gradient(135deg, rgba(124,58,237,.20), rgba(37,99,235,.20));
    border: 1px solid rgba(255,255,255,.10);
    margin-bottom: 1rem; color: #fff;
}
.kv-reset-title {
    font-size: 1.875rem !important; font-weight: 800 !important;
    color: #fff !important; letter-spacing: -.025em !important;
    line-height: 1.2 !important; margin-bottom: .5rem !important;
}
.kv-reset-subtitle {
    font-size: .875rem; color: var(--kvr-text-muted); margin-bottom: 0;
}

/* Step indicator */
.kv-reset-steps {
    display: flex; align-items: center; justify-content: center;
    gap: .5rem; margin-bottom: 1.75rem;
}
.kv-reset-step {
    display: flex; align-items: center; gap: .375rem;
    font-size: .7rem; font-weight: 600; letter-spacing: .04em;
    text-transform: uppercase;
}
.kv-reset-step__dot {
    width: .5rem; height: .5rem; border-radius: 9999px;
}
.kv-reset-step--done .kv-reset-step__dot { background: rgba(255,255,255,.25); }
.kv-reset-step--done { color: rgba(255,255,255,.30); }
.kv-reset-step--active .kv-reset-step__dot { background: #7c3aed; }
.kv-reset-step--active { color: #a78bfa; }
.kv-reset-step-line {
    flex: 1; height: 1px; background: rgba(255,255,255,.08); max-width: 2rem;
}

/* Labels */
.kv-reset-label {
    display: block !important; font-size: .75rem !important;
    font-weight: 600 !important; text-transform: uppercase !important;
    letter-spacing: .05em !important; color: var(--kvr-label-color) !important;
    margin-bottom: .5rem !important; margin-left: .25rem !important;
}
.kv-reset-label.required::after { color: #f87171 !important; margin-left: .25rem; }

/* Inputs */
.kv-reset-input,
.kv-reset-root input.kv-reset-input {
    width: 100% !important; padding: .875rem 1.25rem !important;
    border-radius: 1rem !important; background: var(--kvr-input-bg) !important;
    border: 1px solid var(--kvr-input-border) !important;
    color: #fff !important; font-size: .9375rem !important;
    outline: none !important; box-shadow: none !important;
    transition: border-color .25s, background .25s !important;
}
.kv-reset-input::placeholder { color: rgba(255,255,255,.25) !important; }
.kv-reset-input:focus,
.kv-reset-root input.kv-reset-input:focus {
    border-color: var(--kvr-input-focus) !important;
    background: rgba(255,255,255,.07) !important;
    box-shadow: 0 0 0 3px rgba(124,58,237,.12) !important;
}
.kv-reset-input:-webkit-autofill,
.kv-reset-input:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 1000px rgba(30,20,50,.95) inset !important;
    -webkit-text-fill-color: #fff !important;
}

/* Error */
.kv-reset-error {
    display: block !important; margin-top: .375rem !important;
    margin-left: .25rem !important; font-size: .75rem !important;
    font-weight: 500 !important; color: var(--kvr-error-text) !important;
}

/* Password strength hint */
.kv-reset-hint {
    margin-top: .375rem; margin-left: .25rem;
    font-size: .72rem; color: rgba(255,255,255,.30);
}

/* Field spacing */
.kv-reset-field { margin-bottom: 1.25rem; }
.kv-reset-field:last-of-type { margin-bottom: 0; }

/* Actions */
.kv-reset-actions { display: flex; flex-direction: column; gap: 1rem; padding-top: 1.5rem; }

/* Submit button */
.kv-reset-btn-primary {
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
.kv-reset-btn-primary:hover {
    box-shadow: 0 8px 24px rgba(124,58,237,.50) !important;
    opacity: .95 !important; transform: translateY(-1px) !important;
    color: #fff !important;
}
.kv-reset-btn-primary:active { transform: scale(.98) !important; }

/* Back link button */
.kv-reset-btn-secondary {
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
.kv-reset-btn-secondary:hover {
    background: rgba(255,255,255,.10) !important; color: #fff !important;
}

/* Footer */
.kv-reset-footer {
    margin-top: 1.5rem !important; text-align: center !important;
    font-size: .75rem !important; color: rgba(255,255,255,.25) !important;
}

/* Divider */
.kv-reset-divider {
    height: 1px; background: rgba(255,255,255,.07);
    margin: 1.25rem 0;
}

@media(max-width: 640px) {
    .kv-reset-card { border-radius: 1.25rem; padding: 1.5rem; }
    .kv-reset-title { font-size: 1.5rem !important; }
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
        @lang('shop::app.customers.reset-password.title')
    </x-slot>

    <div class="kv-reset-root">

        <!-- Background layers -->
        <div class="kv-reset-overlay" aria-hidden="true"></div>
        <div class="kv-reset-orb--tr" aria-hidden="true"></div>
        <div class="kv-reset-orb--bl" aria-hidden="true"></div>

        <div class="kv-reset-container">

            {!! view_render_event('bagisto.shop.customers.reset_password.logo.before') !!}

            <!-- Logo -->
            <div class="kv-reset-logo-wrap">
                <a
                    href="{{ route('shop.home.index') }}"
                    aria-label="@lang('shop::app.customers.reset-password.bagisto')"
                >
                    <img
                        src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                        alt="{{ config('app.name') }}"
                        width="131"
                        height="29"
                        class="kv-reset-logo"
                    >
                </a>
            </div>

            {!! view_render_event('bagisto.shop.customers.reset_password.logo.after') !!}

            <!-- Card -->
            <div class="kv-reset-card">

                <!-- Header -->
                <div class="kv-reset-header">
                    <div class="kv-reset-icon-wrap" aria-hidden="true">
                        <!-- Shield lock icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                    </div>
                    <h1 class="kv-reset-title">
                        @lang('shop::app.customers.reset-password.title')
                    </h1>
                    <p class="kv-reset-subtitle">
                        Crea una nueva contraseña segura para tu cuenta
                    </p>
                </div>

                <!-- Step indicator -->
                <div class="kv-reset-steps">
                    <div class="kv-reset-step kv-reset-step--done">
                        <div class="kv-reset-step__dot"></div>
                        Email
                    </div>
                    <div class="kv-reset-step-line"></div>
                    <div class="kv-reset-step kv-reset-step--active">
                        <div class="kv-reset-step__dot"></div>
                        Nueva contraseña
                    </div>
                </div>

                {!! view_render_event('bagisto.shop.customers.reset_password.before') !!}

                <!-- Form -->
                <x-shop::form :action="route('shop.customers.reset_password.store')">

                    <!-- Hidden token -->
                    <x-shop::form.control-group.control
                        type="hidden"
                        name="token"
                        :value="$token"
                    />

                    {!! view_render_event('bagisto.shop.customers.reset_password_form_controls.before') !!}

                    <!-- Email -->
                    <x-shop::form.control-group class="kv-reset-field">
                        <x-shop::form.control-group.label class="kv-reset-label required">
                            @lang('shop::app.customers.reset-password.email')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="email"
                            class="kv-reset-input"
                            id="email"
                            name="email"
                            rules="required|email"
                            :value="old('email')"
                            :label="trans('shop::app.customers.reset-password.email')"
                            placeholder="nombre@ejemplo.com"
                            :aria-label="trans('shop::app.customers.reset-password.email')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error class="kv-reset-error" control-name="email" />
                    </x-shop::form.control-group>

                    <div class="kv-reset-divider"></div>

                    <!-- Password -->
                    <x-shop::form.control-group class="kv-reset-field">
                        <x-shop::form.control-group.label class="kv-reset-label required">
                            @lang('shop::app.customers.reset-password.password')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="password"
                            class="kv-reset-input"
                            name="password"
                            rules="required|min:6"
                            value=""
                            :label="trans('shop::app.customers.reset-password.password')"
                            :placeholder="trans('shop::app.customers.reset-password.password')"
                            ref="password"
                            :aria-label="trans('shop::app.customers.reset-password.password')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error class="kv-reset-error" control-name="password" />
                        <span class="kv-reset-hint">Mínimo 6 caracteres</span>
                    </x-shop::form.control-group>

                    <!-- Confirm Password -->
                    <x-shop::form.control-group class="kv-reset-field">
                        <x-shop::form.control-group.label class="kv-reset-label">
                            @lang('shop::app.customers.reset-password.confirm-password')
                        </x-shop::form.control-group.label>

                        <x-shop::form.control-group.control
                            type="password"
                            class="kv-reset-input"
                            name="password_confirmation"
                            rules="confirmed:@password"
                            value=""
                            :label="trans('shop::app.customers.reset-password.confirm-password')"
                            :placeholder="trans('shop::app.customers.reset-password.confirm-password')"
                            :aria-label="trans('shop::app.customers.reset-password.confirm-password')"
                            aria-required="true"
                        />

                        <x-shop::form.control-group.error class="kv-reset-error" control-name="password" />
                    </x-shop::form.control-group>

                    {!! view_render_event('bagisto.shop.customers.reset_password_form_controls.after') !!}
                    {!! view_render_event('bagisto.shop.customers.reset_password.submit_button.before') !!}

                    <!-- Actions -->
                    <div class="kv-reset-actions">

                        <button type="submit" class="kv-reset-btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            @lang('shop::app.customers.reset-password.submit-btn-title')
                        </button>

                        <a
                            href="{{ route('shop.customer.session.index') }}"
                            class="kv-reset-btn-secondary"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 aria-hidden="true">
                                <path d="m15 18-6-6 6-6"/>
                            </svg>
                            Volver al inicio de sesión
                        </a>

                    </div>

                    {!! view_render_event('bagisto.shop.customers.reset_password.submit_button.after') !!}

                </x-shop::form>

                {!! view_render_event('bagisto.shop.customers.reset_password.after') !!}

            </div><!-- /kv-reset-card -->

            <p class="kv-reset-footer">
                @lang('shop::app.customers.reset-password.footer', ['current_year' => date('Y')])
            </p>

        </div><!-- /kv-reset-container -->
    </div><!-- /kv-reset-root -->

</x-shop::layouts>
