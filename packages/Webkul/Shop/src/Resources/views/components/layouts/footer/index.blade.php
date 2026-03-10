{!! view_render_event('bagisto.shop.layout.footer.before') !!}

@inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

@php
    $customization = $themeCustomizationRepository->findOneWhere([
        'type'       => 'footer_links',
        'status'     => 1,
        'channel_id' => core()->getCurrentChannel()->id,
    ]);

    // Build sorted sections array (preserves all CMS columns)
    $footerSections = [];
    if ($customization?->options) {
        foreach ($customization->options as $section) {
            usort($section, fn($a, $b) => $a['sort_order'] - $b['sort_order']);
            $footerSections[] = $section;
        }
    }
@endphp

<footer style="background:#0f0f14;color:#d1d5db;border-top:1px solid rgba(255,255,255,0.06);font-family:'DM Sans','Inter',sans-serif;display:block;width:100%;">

    {{-- ═══════════════════ MAIN GRID ═══════════════════ --}}
    <div style="
        display: grid;
        grid-template-columns: 1.3fr 1fr 1fr 1fr 1.4fr;
        gap: 2.5rem;
        max-width: 1280px;
        margin: 0 auto;
        padding: 3.5rem 3.75rem 3rem;
        align-items: start;
    " class="max-[1100px]:!grid-cols-3 max-md:!grid-cols-2 max-sm:!grid-cols-1 max-sm:!px-4 max-sm:!py-8 max-md:!px-6 max-[1100px]:!px-8">

        {{-- ── 1. BRAND ── --}}
        <div>
            <a href="{{ route('shop.home.index') }}"
               style="display:flex;align-items:center;gap:0.6rem;margin-bottom:1rem;text-decoration:none;">
                <img
                    src="{{ core()->getCurrentChannel()->logo_url ?? asset('themes/shop/default/images/logo.svg') }}"
                    alt="{{ core()->getCurrentChannel()->name }}"
                    style="width:2.2rem;height:2.2rem;object-fit:contain;display:block;"
                />
                <span style="font-size:1.3rem;font-weight:800;color:#f1f1f5;letter-spacing:-0.02em;line-height:1;">
                    {{ core()->getCurrentChannel()->name }}
                </span>
            </a>

            <p style="font-size:0.82rem;color:#9ca3af;line-height:1.7;max-width:16rem;margin-bottom:1.3rem;">
                Tu tienda de confianza en Barranquilla para tecnología de calidad.
                Productos originales, envíos rápidos y atención personalizada 24/7.
            </p>

            <ul style="list-style:none;padding:0;margin:0 0 1.5rem;display:flex;flex-direction:column;gap:0.55rem;">
                <li style="display:flex;align-items:center;gap:0.5rem;font-size:0.79rem;color:#9ca3af;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    Tecnología que vibra contigo
                </li>
                <li style="display:flex;align-items:center;gap:0.5rem;font-size:0.79rem;color:#9ca3af;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Barranquilla | Envíos co
                </li>
                <li style="display:flex;align-items:center;gap:0.5rem;font-size:0.79rem;color:#9ca3af;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Atención 24/7 | Garantizado ✅
                </li>
                <li style="display:flex;align-items:center;gap:0.5rem;font-size:0.79rem;color:#9ca3af;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                    ¡Únete a la vibra Killa! 😎
                </li>
            </ul>

            {{-- Socials --}}
            <div style="display:flex;align-items:center;gap:0.6rem;">
                @php
                    $socials = [
                        ['label'=>'Instagram','url'=>'https://instagram.com','icon'=>'<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>','fill'=>false],
                        ['label'=>'TikTok','url'=>'https://tiktok.com','icon'=>'<path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.27 6.27 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.19 8.19 0 004.79 1.53V6.79a4.85 4.85 0 01-1.02-.1z"/>','fill'=>true],
                        ['label'=>'Twitter/X','url'=>'https://twitter.com','icon'=>'<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.747l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>','fill'=>true],
                        ['label'=>'YouTube','url'=>'https://youtube.com','icon'=>'<path d="M23 7s-.3-1.9-1.2-2.7c-1.1-1.2-2.4-1.2-3-1.3C16.4 2.9 12 2.9 12 2.9s-4.4 0-6.8.2c-.6.1-1.9.1-3 1.3C1.3 5.1 1 7 1 7S.7 9.2.7 11.3v2c0 2.1.3 4.3.3 4.3s.3 1.9 1.2 2.7c1.1 1.2 2.6 1.1 3.3 1.2C7.3 21.7 12 21.7 12 21.7s4.4 0 6.8-.2c.6-.1 1.9-.1 3-1.3.9-.8 1.2-2.7 1.2-2.7s.3-2.2.3-4.3v-2C23.3 9.2 23 7 23 7zM9.7 15.5V8.4l8.1 3.6-8.1 3.5z"/>','fill'=>true],
                    ];
                @endphp
                @foreach($socials as $s)
                    <a href="{{ $s['url'] }}" target="_blank" rel="noopener" aria-label="{{ $s['label'] }}"
                       style="width:2.1rem;height:2.1rem;border-radius:50%;border:1px solid rgba(255,255,255,0.13);background:rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:center;color:#9ca3af;text-decoration:none;flex-shrink:0;transition:all 0.2s;"
                       onmouseover="this.style.borderColor='#6366f1';this.style.color='#6366f1';this.style.background='rgba(99,102,241,0.12)'"
                       onmouseout="this.style.borderColor='rgba(255,255,255,0.13)';this.style.color='#9ca3af';this.style.background='rgba(255,255,255,0.04)'">
                        <svg width="15" height="15" viewBox="0 0 24 24"
                             fill="{{ $s['fill'] ? 'currentColor' : 'none' }}"
                             stroke="{{ $s['fill'] ? 'none' : 'currentColor' }}"
                             stroke-width="{{ $s['fill'] ? '0' : '2' }}"
                             xmlns="http://www.w3.org/2000/svg">
                            {!! $s['icon'] !!}
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- ── 2. ENLACES RÁPIDOS — columna 1 del CMS ── --}}
        <div>
            <h3 style="display:flex;align-items:center;gap:0.4rem;font-size:0.73rem;font-weight:700;color:#f1f1f5;letter-spacing:0.07em;text-transform:uppercase;margin:0 0 1.2rem;">
                Enlaces Rápidos
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2.5" xmlns="http://www.w3.org/2000/svg"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </h3>
            <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.7rem;">
                @if(isset($footerSections[0]))
                    @foreach($footerSections[0] as $link)
                        <li>
                            <a href="{{ $link['url'] }}"
                               style="font-size:0.83rem;color:#9ca3af;text-decoration:none;display:inline-block;transition:color 0.2s,padding-left 0.2s;"
                               onmouseover="this.style.color='#f1f1f5';this.style.paddingLeft='0.3rem'"
                               onmouseout="this.style.color='#9ca3af';this.style.paddingLeft='0'">
                                {{ $link['title'] }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        {{-- ── 3. ATENCIÓN AL CLIENTE — columna 2 del CMS ── --}}
        <div>
            <h3 style="display:flex;align-items:center;gap:0.4rem;font-size:0.73rem;font-weight:700;color:#f1f1f5;letter-spacing:0.07em;text-transform:uppercase;margin:0 0 1.2rem;">
                Atención al Cliente
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2.5" xmlns="http://www.w3.org/2000/svg"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </h3>
            <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.7rem;">
                @if(isset($footerSections[1]))
                    @foreach($footerSections[1] as $link)
                        <li>
                            <a href="{{ $link['url'] }}"
                               style="font-size:0.83rem;color:#9ca3af;text-decoration:none;display:inline-block;transition:color 0.2s,padding-left 0.2s;"
                               onmouseover="this.style.color='#f1f1f5';this.style.paddingLeft='0.3rem'"
                               onmouseout="this.style.color='#9ca3af';this.style.paddingLeft='0'">
                                {{ $link['title'] }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

        {{-- ── 4. CONTACTO ── --}}
        <div>
            <h3 style="display:flex;align-items:center;gap:0.4rem;font-size:0.73rem;font-weight:700;color:#f1f1f5;letter-spacing:0.07em;text-transform:uppercase;margin:0 0 1.2rem;">
                Contacto
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2.5" xmlns="http://www.w3.org/2000/svg"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </h3>
            <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.85rem;">
                <li style="display:flex;align-items:flex-start;gap:0.6rem;font-size:0.82rem;color:#9ca3af;line-height:1.5;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" style="margin-top:0.1rem;flex-shrink:0;" xmlns="http://www.w3.org/2000/svg"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Barranquilla, Colombia
                </li>
                <li style="display:flex;align-items:flex-start;gap:0.6rem;font-size:0.82rem;color:#9ca3af;line-height:1.5;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" style="margin-top:0.1rem;flex-shrink:0;" xmlns="http://www.w3.org/2000/svg"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 0114 3.18 2 2 0 0116.92 5v3.09c0 1-.76 1.85-1.76 1.98a4 4 0 00-1.74.7 4 4 0 00-.7 1.74c-.13 1-.98 1.77-1.98 1.77H9"/></svg>
                    +57 300 252 1314
                </li>
                <li style="display:flex;align-items:flex-start;gap:0.6rem;font-size:0.82rem;color:#9ca3af;line-height:1.5;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" style="margin-top:0.1rem;flex-shrink:0;" xmlns="http://www.w3.org/2000/svg"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    info@killavibes.com
                </li>
                <li style="display:flex;align-items:flex-start;gap:0.6rem;font-size:0.82rem;color:#9ca3af;line-height:1.5;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" style="margin-top:0.1rem;flex-shrink:0;" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    24/7 Atención
                </li>
            </ul>
        </div>

        {{-- ── 5. NEWSLETTER ── --}}
        {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.before') !!}

        @if (core()->getConfigData('customer.settings.newsletter.subscription'))
        <div style="display:flex;flex-direction:column;gap:0.75rem;">

            <p style="font-size:1.05rem;font-weight:700;color:#f1f1f5;line-height:1.4;margin:0;">
                ¡Prepárate para nuestro boletín! 🎉
            </p>

            <p style="font-size:0.78rem;color:#9ca3af;margin:0;">
                @lang('shop::app.components.layouts.footer.subscribe-stay-touch')
            </p>

            <x-shop::form
                :action="route('shop.subscription.store')"
            >
                <div style="position:relative;width:100%;">
                    <label for="footer-newsletter-input" class="sr-only">
                        @lang('shop::app.components.layouts.footer.email')
                    </label>

                    <x-shop::form.control-group.control
                        type="email"
                        id="footer-newsletter-input"
                        name="email"
                        style="display:block;width:100%;padding:0.7rem 7rem 0.7rem 1rem;background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.13);border-radius:0.65rem;color:#f1f1f5;font-size:0.82rem;outline:none;font-family:inherit;box-sizing:border-box;"
                        rules="required|email"
                        :label="trans('shop::app.components.layouts.footer.email')"
                        placeholder="email@example.com"
                        autocomplete="email"
                    />

                    <x-shop::form.control-group.error control-name="email" />

                    <button
                        type="submit"
                        style="position:absolute;top:0.35rem;right:0.35rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:0.5rem;padding:0.45rem 0.9rem;font-size:0.75rem;font-weight:600;cursor:pointer;white-space:nowrap;font-family:inherit;"
                    >
                        @lang('shop::app.components.layouts.footer.subscribe')
                    </button>
                </div>
            </x-shop::form>

            <p style="display:flex;align-items:center;gap:0.4rem;font-size:0.7rem;color:#6b7280;margin:0;">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Sin spam. Cancela cuando quieras.
            </p>
        </div>
        @endif

        {!! view_render_event('bagisto.shop.layout.footer.newsletter_subscription.after') !!}

    </div>{{-- /main grid --}}

    {{-- ═══════════════════ BOTTOM BAR ═══════════════════ --}}
    <div style="border-top:1px solid rgba(255,255,255,0.07);display:flex;align-items:center;justify-content:space-between;gap:1rem;padding:1rem 3.75rem;flex-wrap:wrap;">

        {!! view_render_event('bagisto.shop.layout.footer.footer_text.before') !!}

        <p style="font-size:0.76rem;color:#6b7280;margin:0;">
            © {{ date('Y') }} {{ core()->getCurrentChannel()->name }}.
            Todos los derechos reservados.
            Hecho con <span style="color:#f87171;">♥</span> en Barranquilla
        </p>

        {!! view_render_event('bagisto.shop.layout.footer.footer_text.after') !!}

        <ul style="display:flex;align-items:center;gap:1.25rem;list-style:none;padding:0;margin:0;flex-wrap:wrap;">
            <li><a href="#" style="font-size:0.73rem;color:#6b7280;text-decoration:none;white-space:nowrap;"
                   onmouseover="this.style.color='#f1f1f5'" onmouseout="this.style.color='#6b7280'">Términos y Condiciones</a></li>
            <li><a href="#" style="font-size:0.73rem;color:#6b7280;text-decoration:none;white-space:nowrap;"
                   onmouseover="this.style.color='#f1f1f5'" onmouseout="this.style.color='#6b7280'">Política de Privacidad</a></li>
            <li><a href="#" style="font-size:0.73rem;color:#6b7280;text-decoration:none;white-space:nowrap;"
                   onmouseover="this.style.color='#f1f1f5'" onmouseout="this.style.color='#6b7280'">Política de Cookies</a></li>
            <li><a href="#" style="font-size:0.73rem;color:#6b7280;text-decoration:none;white-space:nowrap;"
                   onmouseover="this.style.color='#f1f1f5'" onmouseout="this.style.color='#6b7280'">FAQ</a></li>
        </ul>
    </div>

    {{-- Responsive fix for small screens --}}
    <style>
        @media (max-width: 1100px) {
            footer > div:first-of-type {
                grid-template-columns: repeat(3, 1fr) !important;
                padding: 2.5rem 2rem !important;
            }
        }
        @media (max-width: 768px) {
            footer > div:first-of-type {
                grid-template-columns: repeat(2, 1fr) !important;
                padding: 2rem 1.5rem !important;
            }
            footer > div:last-of-type {
                flex-direction: column !important;
                text-align: center !important;
                padding: 1rem 1.5rem !important;
            }
        }
        @media (max-width: 480px) {
            footer > div:first-of-type {
                grid-template-columns: 1fr !important;
                padding: 2rem 1rem !important;
            }
        }
    </style>

</footer>

{!! view_render_event('bagisto.shop.layout.footer.after') !!}