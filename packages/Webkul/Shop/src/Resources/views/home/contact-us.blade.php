{{-- ============================================================
     KillaVibes — Página de Contacto v4
     Archivo: packages/Webkul/Shop/src/Resources/views/home/contact-us.blade.php
     ============================================================ --}}
<x-shop::layouts>
    <x-slot:title>
        @lang('shop::app.home.contact.title')
    </x-slot>

    @push('styles')
    <style>
        /* ── Reset del container de Bagisto para esta página ── */
        .kv-contact-page {
            width: 100%;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding: 2.5rem 2rem 4rem;
        }

        /* ── Header ── */
        .kv-contact-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        .kv-contact-header h1 {
            font-size: 2.25rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            color: var(--foreground);
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        .kv-contact-header p {
            color: var(--muted-foreground);
            max-width: 42rem;
            margin: 0 auto;
            font-size: 1rem;
            line-height: 1.6;
        }

        /* ── Grid 2 columnas ── */
        .kv-contact-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            align-items: start;
        }
        @media (min-width: 1024px) {
            .kv-contact-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* ── Títulos de sección izquierda ── */
        .kv-contact-section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--foreground);
            margin-bottom: 1.75rem;
            letter-spacing: -0.02em;
        }

        /* ── Item de info (ícono + texto) ── */
        .kv-info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        /* ── Círculo del ícono ── */
        .kv-info-icon {
            width: 3rem;
            height: 3rem;
            min-width: 3rem;
            border-radius: 9999px;
            background-color: rgba(99, 102, 241, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .kv-info-icon svg {
            width: 1.4rem;
            height: 1.4rem;
            color: #6366f1;
            stroke: #6366f1;
            fill: none;
            stroke-width: 1.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ── Texto del item ── */
        .kv-info-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--foreground);
            margin-bottom: 0.25rem;
            line-height: 1.2;
        }
        .kv-info-text {
            color: var(--muted-foreground);
            font-size: 0.875rem;
            line-height: 1.6;
        }
        .kv-info-text a {
            color: var(--muted-foreground);
            text-decoration: none;
            transition: color 0.2s;
        }
        .kv-info-text a:hover { color: #6366f1; }

        /* ── Redes sociales ── */
        .kv-social-section { margin-top: 0.5rem; }
        .kv-social-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }
        .kv-social-btn {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            padding: 0.6rem 1.1rem !important;
            border-radius: 0.5rem !important;
            font-size: 0.875rem !important;
            font-weight: 600 !important;
            color: #fff !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
            border: none !important;
            cursor: pointer !important;
            line-height: 1 !important;
        }
        .kv-social-btn:hover { transform: translateY(-2px) !important; filter: brightness(1.08) !important; }
        .kv-social-btn svg, .kv-social-btn path { fill: #fff; }
        .kv-btn-wa   { background-color: #22c55e !important; }
        .kv-btn-ig   { background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%) !important; }
        .kv-btn-th   { background-color: #000 !important; }

        /* ── Card del formulario ── */
        .kv-form-card {
            background: #ffffff;
            border: 1px solid var(--border, #e2e8f0);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 40px -10px rgba(99, 102, 241, 0.15);
        }
        .kv-form-card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--foreground);
            margin-bottom: 1.5rem;
        }

        /* ── Grid nombre + teléfono ── */
        .kv-name-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-bottom: 0;
        }
        @media (min-width: 640px) {
            .kv-name-grid { grid-template-columns: 1fr 1fr; }
        }

        /* ── Labels ── */
        .kv-label {
            display: block !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            color: var(--foreground) !important;
            margin-bottom: 0.375rem !important;
        }
        .kv-label-required::after {
            content: ' *';
            color: #ef4444;
        }

        /* ── Inputs ── */
        .kv-form-card input,
        .kv-form-card textarea,
        .kv-form-card input[type="text"],
        .kv-form-card input[type="email"],
        .kv-form-card input[type="tel"] {
            width: 100% !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.5rem !important;
            background: #f1f5f9 !important;
            color: #1a1c2d !important;
            font-size: 0.875rem !important;
            padding: 0.625rem 0.875rem !important;
            transition: border-color 0.2s, box-shadow 0.2s !important;
            outline: none !important;
            box-sizing: border-box !important;
        }
        .kv-form-card input:focus,
        .kv-form-card textarea:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15) !important;
            background: #fff !important;
        }

        /* ── Grupo de campo ── */
        .kv-field { margin-bottom: 1rem; }

        /* ── Botón submit ── */
        .kv-submit {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 0.5rem !important;
            width: 100% !important;
            max-width: 100% !important;
            background: #6366f1 !important;
            color: #fff !important;
            border: none !important;
            border-radius: 0.5rem !important;
            padding: 0.875rem 1.5rem !important;
            font-size: 0.9375rem !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            margin-top: 0.5rem !important;
            letter-spacing: 0 !important;
            text-transform: none !important;
        }
        .kv-submit:hover {
            background: #4f46e5 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35) !important;
            opacity: 1 !important;
        }
        .kv-submit svg { width: 1.1rem; height: 1.1rem; stroke: #fff; fill: none; }

        /* ── Banner CTA ── */
        .kv-banner {
            margin-top: 4rem;
            background: linear-gradient(135deg, #6366f1 0%, #818cf8 50%, #22d3ee 100%);
            border-radius: 1.5rem;
            padding: 3rem 2rem;
            text-align: center;
            color: #fff;
        }
        .kv-banner h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #fff;
        }
        .kv-banner p {
            font-size: 1.125rem;
            opacity: 0.9;
            margin-bottom: 1.5rem;
        }
        .kv-banner-btn {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            background: #fff !important;
            color: #6366f1 !important;
            padding: 0.75rem 2rem !important;
            border-radius: 0.5rem !important;
            font-weight: 700 !important;
            font-size: 0.9375rem !important;
            text-decoration: none !important;
            transition: background 0.2s !important;
        }
        .kv-banner-btn:hover { background: #f1f5f9 !important; }
        .kv-banner-btn svg   { fill: #6366f1; width: 1.25rem; height: 1.25rem; }
    </style>
    @endpush

    <div class="kv-contact-page">

        {{-- ══ HEADER ══════════════════════════════════════════════ --}}
        <div class="kv-contact-header">
            <h1>@lang('shop::app.home.contact.title')</h1>
            <p>Estamos aquí para ayudarte. Contáctanos por cualquier medio y te responderemos lo más pronto posible.</p>
        </div>

        {{-- ══ GRID PRINCIPAL ══════════════════════════════════════ --}}
        <div class="kv-contact-grid">

            {{-- ── COL IZQUIERDA ──────────────────────────────────── --}}
            <div>
                <p class="kv-contact-section-title">Información de Contacto</p>

                {{-- Ubicación --}}
                <div class="kv-info-item">
                    <div class="kv-info-icon">
                        <svg viewBox="0 0 24 24"><path d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                    </div>
                    <div>
                        <p class="kv-info-title">Ubicación</p>
                        <p class="kv-info-text">Barranquilla, Atlántico<br>Colombia 🇨🇴</p>
                    </div>
                </div>

                {{-- Teléfono --}}
                <div class="kv-info-item">
                    <div class="kv-info-icon">
                        <svg viewBox="0 0 24 24"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 6.75Z"/></svg>
                    </div>
                    <div>
                        <p class="kv-info-title">Teléfono</p>
                        <p class="kv-info-text"><a href="tel:+573002521314">+57 300 252 1314</a></p>
                    </div>
                </div>

                {{-- Email --}}
                <div class="kv-info-item">
                    <div class="kv-info-icon">
                        <svg viewBox="0 0 24 24"><path d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                    </div>
                    <div>
                        <p class="kv-info-title">Email</p>
                        <p class="kv-info-text"><a href="mailto:info@killavibes.com">info@killavibes.com</a></p>
                    </div>
                </div>

                {{-- Horario --}}
                <div class="kv-info-item">
                    <div class="kv-info-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    </div>
                    <div>
                        <p class="kv-info-title">Horario de Atención</p>
                        <p class="kv-info-text">24/7 - Siempre disponibles<br>Respuesta garantizada 🧿</p>
                    </div>
                </div>

                {{-- Redes --}}
                <div class="kv-social-section">
                    <p class="kv-contact-section-title">Síguenos</p>
                    <div class="kv-social-grid">
                        <a href="https://wa.me/message/O4FKBMAABGC5L1" target="_blank" rel="noopener noreferrer" class="kv-social-btn kv-btn-wa">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="#fff"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            WhatsApp
                        </a>
                        <a href="https://www.instagram.com/killavibes_/" target="_blank" rel="noopener noreferrer" class="kv-social-btn kv-btn-ig">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="#fff"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            Instagram
                        </a>
                        <a href="https://www.threads.com/@killavibes_" target="_blank" rel="noopener noreferrer" class="kv-social-btn kv-btn-th">
                            <span style="font-weight:800; font-size:1rem; line-height:1;">@</span>
                            Threads
                        </a>
                    </div>
                </div>

            </div>{{-- /col izquierda --}}

            {{-- ── COL DERECHA: Formulario ─────────────────────── --}}
            <div>
                <div class="kv-form-card">
                    <p class="kv-form-card-title">Envíanos un Mensaje</p>

                    <x-shop::form :action="route('shop.home.contact_us.send_mail')">

                        {{-- Nombre + Teléfono --}}
                        <div class="kv-name-grid">
                            <div class="kv-field">
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.label class="kv-label kv-label-required">
                                        @lang('shop::app.home.contact.name')
                                    </x-shop::form.control-group.label>
                                    <x-shop::form.control-group.control
                                        type="text" name="name" rules="required"
                                        :value="old('name')"
                                        :label="trans('shop::app.home.contact.name')"
                                        :placeholder="trans('shop::app.home.contact.name')"
                                        aria-required="true"
                                    />
                                    <x-shop::form.control-group.error control-name="name" />
                                </x-shop::form.control-group>
                            </div>
                            <div class="kv-field">
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.label class="kv-label">
                                        @lang('shop::app.home.contact.phone-number')
                                    </x-shop::form.control-group.label>
                                    <x-shop::form.control-group.control
                                        type="text" name="contact" rules="phone"
                                        :value="old('contact')"
                                        :label="trans('shop::app.home.contact.phone-number')"
                                        placeholder="+57 300 123 4567"
                                    />
                                    <x-shop::form.control-group.error control-name="contact" />
                                </x-shop::form.control-group>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="kv-field">
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="kv-label kv-label-required">
                                    @lang('shop::app.home.contact.email')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control
                                    type="email" name="email" rules="required|email"
                                    :value="old('email')"
                                    :label="trans('shop::app.home.contact.email')"
                                    placeholder="tu@email.com"
                                    aria-required="true"
                                />
                                <x-shop::form.control-group.error control-name="email" />
                            </x-shop::form.control-group>
                        </div>

                        {{-- Mensaje --}}
                        <div class="kv-field">
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="kv-label kv-label-required">
                                    @lang('shop::app.home.contact.desc')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control
                                    type="textarea" name="message" rules="required"
                                    :label="trans('shop::app.home.contact.message')"
                                    :placeholder="trans('shop::app.home.contact.describe-here')"
                                    aria-required="true" rows="5"
                                />
                                <x-shop::form.control-group.error control-name="message" />
                            </x-shop::form.control-group>
                        </div>

                        {{-- reCaptcha --}}
                        @if (core()->getConfigData('customer.captcha.credentials.status'))
                            <div style="margin-bottom:1rem;">{!! Captcha::render() !!}</div>
                        @endif

                        {{-- Submit --}}
                        <button type="submit" class="kv-submit">
                            <svg viewBox="0 0 24 24" stroke-width="1.8" stroke="#fff" fill="none">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/>
                            </svg>
                            @lang('shop::app.home.contact.submit')
                        </button>

                    </x-shop::form>
                </div>
            </div>{{-- /col derecha --}}

        </div>{{-- /grid --}}

        {{-- ══ BANNER ══════════════════════════════════════════════ --}}
        <div class="kv-banner">
            <h2>¿Necesitas ayuda inmediata?</h2>
            <p>Contáctanos por WhatsApp para atención inmediata</p>
            <a href="https://wa.me/message/O4FKBMAABGC5L1" target="_blank" rel="noopener noreferrer" class="kv-banner-btn">
                <svg viewBox="0 0 24 24" fill="#6366f1"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                Chatear Ahora
            </a>
        </div>

    </div>{{-- /kv-contact-page --}}

    @push('scripts')
        {!! Captcha::renderJS() !!}
    @endpush

</x-shop::layouts>
