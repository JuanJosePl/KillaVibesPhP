{!! view_render_event('bagisto.shop.layout.footer.before') !!}

@inject('themeCustomizationRepository', 'Webkul\Theme\Repositories\ThemeCustomizationRepository')

@php
    $customization = $themeCustomizationRepository->findOneWhere([
        'type'       => 'footer_links',
        'status'     => 1,
        'channel_id' => core()->getCurrentChannel()->id,
    ]);
@endphp

{{-- =====================================================================
     FOOTER KILLAVIBES — 100% INLINE STYLES
     Sin dependencia de clases externas. Todo el CSS va aquí mismo.
====================================================================== --}}

<style>
@keyframes kvf-float  { 0%,100%{transform:translateY(0)}  50%{transform:translateY(-14px)} }
@keyframes kvf-pulse  { 0%,100%{opacity:1}                50%{opacity:0.55} }
@keyframes kvf-heart  { 0%,100%{transform:scale(1)}        50%{transform:scale(1.35)} }

.kvf-social-btn:hover            { transform:scale(1.12)!important; box-shadow:0 6px 20px rgba(99,102,241,.22)!important; background:rgba(99,102,241,.09)!important; border-color:rgba(99,102,241,.35)!important; color:#6366f1!important; }
.kvf-social-btn.s-ig:hover       { color:#ec4899!important; background:rgba(236,72,153,.08)!important; border-color:rgba(236,72,153,.3)!important; }
.kvf-social-btn.s-fb:hover       { color:#2563eb!important; background:rgba(37,99,235,.08)!important;  border-color:rgba(37,99,235,.3)!important; }
.kvf-social-btn.s-tt:hover       { color:#111!important;    background:rgba(0,0,0,.06)!important;       border-color:rgba(0,0,0,.15)!important; }
.kvf-social-btn.s-wa:hover       { color:#16a34a!important; background:rgba(22,163,74,.08)!important;  border-color:rgba(22,163,74,.3)!important; }

.kvf-feat-row:hover              { color:#6366f1!important; }
.kvf-feat-row:hover .kvf-fi      { background:rgba(99,102,241,.20)!important; }

.kvf-lnk:hover                   { color:#6366f1!important; }
.kvf-lnk:hover .kvf-dot          { background:#6366f1!important; }

.kvf-ci:hover                    { color:#6366f1!important; }
.kvf-ci:hover .kvf-cicon         { background:rgba(99,102,241,.20)!important; }

.kvf-legal-a:hover               { color:#6366f1!important; }

.kvf-nl-btn:hover                { transform:translateY(-50%) scale(1.04)!important; box-shadow:0 4px 16px rgba(99,102,241,.40)!important; }
.kvf-nl-input:focus              { border-color:#6366f1!important; background:#fff!important; box-shadow:0 0 0 3px rgba(99,102,241,.12)!important; }

/* Responsive: en mobile el grid es 1 col */
@media (max-width:767px) {
    .kvf-main-grid   { grid-template-columns:1fr!important; }
    .kvf-bottom-row  { flex-direction:column!important; align-items:center!important; text-align:center!important; }
    .kvf-desktop-col { display:none!important; }
    .kvf-mob-acc     { display:block!important; }
}
@media (min-width:768px) and (max-width:1059px) {
    .kvf-main-grid   { grid-template-columns:1fr 1fr!important; }
    .kvf-desktop-col { display:none!important; }
    .kvf-mob-acc     { display:block!important; }
}
@media (min-width:1060px) {
    .kvf-main-grid   { grid-template-columns:2fr 1fr 1fr 1fr!important; }
    .kvf-desktop-col { display:block!important; }
    .kvf-mob-acc     { display:none!important; }
}
</style>

<footer style="
    position:relative;
    overflow:hidden;
    background:linear-gradient(to bottom,rgba(241,245,249,.35),rgba(241,245,249,.6));
    border-top:1px solid rgba(226,232,240,.6);
    margin-top:0;
    font-family:'Poppins',system-ui,sans-serif;
">

<div style="max-width:1280px;margin:0 auto;padding:0 2.5rem;position:relative;z-index:10;">

    {{-- ===================== MAIN GRID ===================== --}}
    <div style="padding:5rem 0 4rem 0;">

        <div class="kvf-main-grid" style="
            display:grid;
            grid-template-columns:2fr 1fr 1fr 1fr;
            column-gap:2.5rem;
            row-gap:2rem;
            align-items:start;
        ">

            {{-- ================= BRAND COLUMN ================= --}}
            <div style="display:flex;flex-direction:column;gap:1.75rem;">

                {{-- Logo --}}
                <a href="{{ route('shop.home.index') }}" style="display:inline-flex;align-items:center;gap:.75rem;text-decoration:none;">
                    <img src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                         style="height:2.5rem;width:auto;display:block;">
                    <span style="font-size:1.5rem;font-weight:800;background:linear-gradient(135deg,#6366f1,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                        {{ config('app.name','KillaVibes') }}
                    </span>
                </a>

                {{-- Description --}}
                <p style="color:#64748b;line-height:1.7;font-size:.875rem;max-width:22rem;margin:0;">
                    Tu tienda de confianza en Barranquilla para tecnología de calidad.
                    Productos originales, envíos rápidos y atención personalizada 24/7.
                </p>

            </div>

            {{-- ================= COLUMN 2 ================= --}}
            <div style="display:flex;flex-direction:column;">

                <h3 style="font-size:1rem;font-weight:700;color:#1a1c2d;margin:0 0 1.5rem 0;">
                    Contenido
                </h3>

                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.9rem;">
                    <li><a href="{{ url('/collections') }}" style="text-decoration:none;color:#64748b;font-size:.875rem;">Categorías</a></li>
                    <li><a href="{{ url('/about-us') }}" style="text-decoration:none;color:#64748b;font-size:.875rem;">Sobre Nosotros</a></li>
                </ul>

            </div>

            {{-- ================= COLUMN 3 ================= --}}
            <div style="display:flex;flex-direction:column;">

                <h3 style="font-size:1rem;font-weight:700;color:#1a1c2d;margin:0 0 1.5rem 0;">
                    Atención al Cliente
                </h3>

                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.9rem;">
                    <li><a href="{{ url('/contact-us') }}" style="text-decoration:none;color:#64748b;font-size:.875rem;">Contacto</a></li>
                    <li><a href="{{ url('/page/envios') }}" style="text-decoration:none;color:#64748b;font-size:.875rem;">Envíos</a></li>
                    <li><a href="{{ url('/page/devoluciones') }}" style="text-decoration:none;color:#64748b;font-size:.875rem;">Devoluciones</a></li>
                    <li><a href="{{ url('/page/garantia') }}" style="text-decoration:none;color:#64748b;font-size:.875rem;">Garantía</a></li>
                </ul>

            </div>

            {{-- ================= COLUMN 4 ================= --}}
            <div style="display:flex;flex-direction:column;">

                <h3 style="font-size:1rem;font-weight:700;color:#1a1c2d;margin:0 0 1.5rem 0;">
                    Contacto
                </h3>

                <div style="display:flex;flex-direction:column;gap:1rem;font-size:.875rem;color:#64748b;">
                    <span>Barranquilla, Colombia</span>
                    <span>+57 300 252 1314</span>
                    <span>info@killavibes.com</span>
                    <span>Atención 24/7</span>
                </div>

            </div>

        </div>
    </div>

    {{-- ================= NEWSLETTER ================= --}}
    <div style="
        padding:3rem 0;
        border-top:1px solid rgba(226,232,240,.6);
        border-bottom:1px solid rgba(226,232,240,.6);
        display:flex;
        justify-content:flex-start;
    ">

        <div style="max-width:500px;width:100%;">

            <p style="font-size:1.5rem;font-weight:700;color:#1a1c2d;margin:0 0 .75rem 0;">
                Suscríbete a nuestro Newsletter
            </p>

            <p style="font-size:.85rem;color:#64748b;margin:0 0 1.25rem 0;">
                Recibe ofertas y novedades directamente en tu correo.
            </p>

            <div style="position:relative;width:100%;">
                <input type="email"
                       placeholder="email@example.com"
                       style="
                           width:100%;
                           padding:.9rem 1.25rem;
                           padding-right:8rem;
                           border-radius:9999px;
                           border:1.5px solid rgba(226,232,240,.9);
                           font-size:.875rem;
                       ">
                <button style="
                    position:absolute;
                    right:5px;
                    top:50%;
                    transform:translateY(-50%);
                    padding:.6rem 1.2rem;
                    border-radius:9999px;
                    border:none;
                    background:linear-gradient(135deg,#6366f1,#22d3ee);
                    color:white;
                    font-size:.8rem;
                    font-weight:700;
                    cursor:pointer;
                ">
                    Suscribirme
                </button>
            </div>

        </div>
    </div>

    {{-- ================= BOTTOM BAR ================= --}}
    <div style="padding:1.75rem 0;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">

        <p style="font-size:.875rem;color:#64748b;margin:0;">
            © {{ date('Y') }} {{ config('app.name','KillaVibes') }}. Todos los derechos reservados.
        </p>

        <div style="display:flex;gap:1.25rem;flex-wrap:wrap;">
            <a href="{{ url('/terminos') }}" style="font-size:.75rem;color:#64748b;text-decoration:none;">Términos</a>
            <a href="{{ url('/privacidad') }}" style="font-size:.75rem;color:#64748b;text-decoration:none;">Privacidad</a>
            <a href="{{ url('/cookies') }}" style="font-size:.75rem;color:#64748b;text-decoration:none;">Cookies</a>
            <a href="{{ url('/faq') }}" style="font-size:.75rem;color:#64748b;text-decoration:none;">FAQ</a>
        </div>

    </div>

</div>
</footer>

{!! view_render_event('bagisto.shop.layout.footer.after') !!}
