@php
    $channel = core()->getCurrentChannel();

    $testimonials = [
        ['name' => 'María González',  'location' => 'Barranquilla', 'rating' => 5, 'product' => 'Audífonos Bluetooth Premium',  'initials' => 'MG', 'comment' => 'Excelente servicio y productos de calidad. Los audífonos que compré suenan increíbles y llegaron súper rápido. ¡Totalmente recomendado!'],
        ['name' => 'Carlos Mendoza',  'location' => 'Soledad',       'rating' => 5, 'product' => 'Compresor Portátil',            'initials' => 'CM', 'comment' => 'El compresor portátil me salvó en una emergencia. Funciona perfecto y la batería dura mucho tiempo. La mejor inversión que he hecho.'],
        ['name' => 'Ana Rodríguez',   'location' => 'Barranquilla', 'rating' => 5, 'product' => 'Parlante Gato RGB',             'initials' => 'AR', 'comment' => 'Mi hija ama el parlante con orejitas de gato. La calidad del sonido es excelente y el diseño es hermoso. ¡Un 10/10!'],
        ['name' => 'Luis Martínez',   'location' => 'Barranquilla', 'rating' => 5, 'product' => 'Smartwatch Pro',                'initials' => 'LM', 'comment' => 'Atención al cliente de primera. Me asesoraron perfectamente y el envío fue rapidísimo. Volveré a comprar sin duda.'],
        ['name' => 'Isabella Torres', 'location' => 'Soledad',       'rating' => 5, 'product' => 'Auriculares Gaming',            'initials' => 'IT', 'comment' => 'Productos originales y a excelentes precios. La experiencia de compra fue increíble de principio a fin.'],
    ];

    $features = [
        ['icon' => 'truck',  'title' => 'Envío Gratis',  'desc' => 'Barranquilla',    'bg' => 'rgba(59,130,246,0.12)',  'color' => '#3b82f6'],
        ['icon' => 'shield', 'title' => '100% Original', 'desc' => 'Garantizado',     'bg' => 'rgba(34,197,94,0.12)',   'color' => '#22c55e'],
        ['icon' => 'clock',  'title' => 'Soporte 24/7',  'desc' => 'Siempre activos', 'bg' => 'rgba(249,115,22,0.12)',  'color' => '#f97316'],
        ['icon' => 'zap',    'title' => 'Vibra Killa',   'desc' => 'Únete ya',        'bg' => 'rgba(168,85,247,0.12)',  'color' => '#a855f7'],
    ];
@endphp

{{-- SEO --}}
@push('meta')
    <meta name="title"       content="{{ $channel->home_seo['meta_title']       ?? '' }}" />
    <meta name="description" content="{{ $channel->home_seo['meta_description'] ?? '' }}" />
    <meta name="keywords"    content="{{ $channel->home_seo['meta_keywords']    ?? '' }}" />
@endpush

<x-shop::layouts>

    <x-slot:title>{{ $channel->home_seo['meta_title'] ?? '' }}</x-slot>

    {{-- ================================================================
         ESTILOS DEL HOME
    ================================================================= --}}
    @push('styles')
    <style>
        /* ── Keyframes ──────────────────────────────────────────── */
        @keyframes kvPulse {
            0%,100% { opacity:1; }
            50%      { opacity:0.55; }
        }
        @keyframes kvFloat {
            0%,100% { transform:translateY(0); }
            50%      { transform:translateY(-18px); }
        }
        @keyframes kvFloatSlow {
            0%,100% { transform:translateY(0) rotate(0deg); }
            33%      { transform:translateY(-12px) rotate(1deg); }
            66%      { transform:translateY(-6px) rotate(-1deg); }
        }
        @keyframes kvFadeUp {
            from { opacity:0; transform:translateY(28px); }
            to   { opacity:1; transform:translateY(0); }
        }
        @keyframes kvGradShift {
            0%  { background-position:0% 50%; }
            50% { background-position:100% 50%; }
            100%{ background-position:0% 50%; }
        }
        @keyframes kvCardIn {
            from { opacity:0; transform:translateY(20px) scale(0.97); }
            to   { opacity:1; transform:translateY(0) scale(1); }
        }
        @keyframes kvBadgePop {
            0%   { transform:scale(0.85); opacity:0; }
            60%  { transform:scale(1.05); }
            100% { transform:scale(1); opacity:1; }
        }
        @keyframes kvSpin {
            to { transform:rotate(360deg); }
        }
        @keyframes kvOrbit {
            from { transform:rotate(0deg) translateX(90px) rotate(0deg); }
            to   { transform:rotate(360deg) translateX(90px) rotate(-360deg); }
        }

        /* ── Hero layout ─────────────────────────────────────────── */
        .kv-hero-grid {
            display:grid;
            grid-template-columns:1fr;
            gap:3rem;
            align-items:center;
        }
        @media(min-width:1024px){
            .kv-hero-grid { grid-template-columns:1fr 1fr; }
        }

        /* ── Feature grid ────────────────────────────────────────── */
        .kv-feat-grid {
            display:grid;
            grid-template-columns:repeat(2,1fr);
            gap:0.875rem;
        }
        @media(min-width:1024px){
            .kv-feat-grid { grid-template-columns:repeat(4,1fr); }
        }

        /* ── Left col animation ──────────────────────────────────── */
        .kv-hero-left  { animation:kvFadeUp 0.9s ease-out both; }
        .kv-hero-right { animation:kvFadeUp 0.9s ease-out 0.25s both; }

        /* ── CTA buttons ─────────────────────────────────────────── */
        .kv-cta-primary {
            display:inline-flex; align-items:center; gap:0.5rem;
            padding:1rem 2rem; border-radius:9999px;
            background:linear-gradient(135deg,#6366f1,#22d3ee);
            color:#fff; font-weight:700; font-size:0.95rem;
            text-decoration:none;
            box-shadow:0 4px 20px rgba(99,102,241,0.35);
            transition:transform 0.3s,box-shadow 0.3s;
        }
        .kv-cta-primary:hover {
            transform:scale(1.05);
            box-shadow:0 8px 30px rgba(99,102,241,0.5);
        }
        .kv-cta-outline {
            display:inline-flex; align-items:center; gap:0.5rem;
            padding:1rem 2rem; border-radius:9999px;
            border:2px solid #6366f1; color:#6366f1;
            font-weight:700; font-size:0.95rem;
            text-decoration:none; background:transparent;
            transition:background 0.3s,color 0.3s,transform 0.3s;
        }
        .kv-cta-outline:hover {
            background:#6366f1; color:#fff; transform:scale(1.05);
        }

        /* ── Feature card ────────────────────────────────────────── */
        .kv-feat-card {
            display:flex; flex-direction:column; align-items:center;
            text-align:center; gap:0.6rem; padding:1rem;
            border-radius:1rem; border:1px solid rgba(226,232,240,0.6);
            transition:transform 0.3s,box-shadow 0.3s,border-color 0.3s;
            cursor:default; position:relative; overflow:hidden;
        }
        .kv-feat-card:hover {
            transform:scale(1.06);
            box-shadow:0 8px 28px rgba(99,102,241,0.18);
            border-color:rgba(99,102,241,0.30);
        }

        /* ── Stats bar ───────────────────────────────────────────── */
        .kv-stats-bar {
            display:flex; align-items:center; justify-content:space-between;
            padding:1.25rem 1.5rem; border-radius:1rem;
            background:rgba(255,255,255,0.55);
            backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px);
            border:1px solid rgba(226,232,240,0.6);
            box-shadow:0 4px 20px rgba(99,102,241,0.07);
        }

        /* ── Hero right: showcase ────────────────────────────────── */
        .kv-showcase {
            position:relative;
            min-height:520px;
            display:flex; flex-direction:column; justify-content:center; align-items:center;
        }

        /* Central glow ring */
        .kv-glow-ring {
            position:absolute;
            width:320px; height:320px; border-radius:9999px;
            border:1px solid rgba(99,102,241,0.15);
            top:50%; left:50%; transform:translate(-50%,-50%);
            animation:kvPulse 3s ease-in-out infinite;
        }
        .kv-glow-ring-2 {
            position:absolute;
            width:420px; height:420px; border-radius:9999px;
            border:1px dashed rgba(34,211,238,0.12);
            top:50%; left:50%; transform:translate(-50%,-50%);
            animation:kvPulse 4s ease-in-out infinite 1s;
        }

        /* Centre badge */
        .kv-showcase-center {
            position:relative; z-index:10;
            width:140px; height:140px; border-radius:9999px;
            background:linear-gradient(135deg,#6366f1,#22d3ee);
            display:flex; flex-direction:column;
            align-items:center; justify-content:center; gap:0.3rem;
            box-shadow:0 0 40px rgba(99,102,241,0.40), 0 0 80px rgba(99,102,241,0.15);
            animation:kvFloatSlow 5s ease-in-out infinite;
        }

        /* Orbit cards */
        .kv-orbit-wrap {
            position:absolute;
            top:50%; left:50%;
            width:0; height:0;
        }
        .kv-orbit-card {
            position:absolute;
            width:160px;
            background:rgba(255,255,255,0.92);
            backdrop-filter:blur(16px); -webkit-backdrop-filter:blur(16px);
            border:1.5px solid rgba(226,232,240,0.8);
            border-radius:1rem;
            padding:0.875rem;
            box-shadow:0 8px 32px rgba(99,102,241,0.12), 0 2px 8px rgba(0,0,0,0.06);
            display:flex; flex-direction:column; gap:0.5rem;
            transition:transform 0.3s,box-shadow 0.3s;
            cursor:pointer;
        }
        .kv-orbit-card:hover {
            transform:scale(1.08) !important;
            box-shadow:0 16px 40px rgba(99,102,241,0.25);
        }

        /* Floating pill badges */
        .kv-pill {
            position:absolute; z-index:20;
            display:inline-flex; align-items:center; gap:0.4rem;
            padding:0.45rem 0.875rem; border-radius:9999px;
            font-size:0.72rem; font-weight:700;
            backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px);
            box-shadow:0 4px 16px rgba(0,0,0,0.10);
            animation:kvFloatSlow ease-in-out infinite;
        }

        /* ── Section wrapper ─────────────────────────────────────── */
        .kv-section {
            padding:5rem 0;
            position:relative; overflow:hidden;
        }
        .kv-section-inner {
            max-width:1400px; margin:0 auto; padding:0 1.5rem;
            position:relative; z-index:10;
        }
        .kv-section-header {
            text-align:center; margin-bottom:3rem;
        }
        .kv-section-badge {
            display:inline-flex; align-items:center; gap:0.5rem;
            background:linear-gradient(135deg,rgba(99,102,241,0.10),rgba(34,211,238,0.10));
            padding:0.6rem 1.25rem; border-radius:9999px;
            border:1px solid rgba(99,102,241,0.20);
            margin-bottom:1.25rem;
        }
        .kv-section-badge span {
            font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.08em;
            background:linear-gradient(135deg,#6366f1,#22d3ee);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
        }
        .kv-section-title {
            font-family:var(--font-heading),'DM Serif Display',serif;
            font-size:clamp(1.8rem,4vw,2.8rem); font-weight:800;
            letter-spacing:-0.03em; color:var(--foreground); margin:0;
            line-height:1.15;
        }
        .kv-gradient-word {
            background:linear-gradient(135deg,#6366f1,#22d3ee);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
        }
        .kv-underline-svg {
            position:absolute; bottom:-0.4rem; left:0; width:100%;
        }

        /* ── Testimonial card ────────────────────────────────────── */
        .kv-testi-card {
            position:relative; overflow:hidden;
            background:rgba(255,255,255,0.92);
            backdrop-filter:blur(8px); -webkit-backdrop-filter:blur(8px);
            border:2px solid rgba(226,232,240,0.55);
            border-radius:1.25rem;
            box-shadow:0 4px 20px -4px rgba(99,102,241,0.10);
            padding:1.75rem;
            display:flex; flex-direction:column; gap:1.1rem;
            transition:transform 0.4s,box-shadow 0.4s,border-color 0.4s;
            height:100%;
        }
        .kv-testi-card:hover {
            transform:translateY(-6px);
            box-shadow:0 20px 60px -15px rgba(99,102,241,0.25);
            border-color:rgba(99,102,241,0.30);
        }
        .kv-testi-corner {
            position:absolute; top:0; right:0;
            width:7rem; height:7rem;
            background:linear-gradient(135deg,rgba(99,102,241,0.09),transparent);
            border-radius:0 1.25rem 0 100%;
            opacity:0; transition:opacity 0.4s; pointer-events:none;
        }
        .kv-testi-card:hover .kv-testi-corner { opacity:1; }

        /* ── Testi grid / carousel ───────────────────────────────── */
        .kv-testi-desktop { display:none; }
        .kv-testi-mobile  { display:block; }
        @media(min-width:1024px){
            .kv-testi-desktop { display:block; }
            .kv-testi-mobile  { display:none; }
        }

        .kv-testi-grid {
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:1.75rem;
        }

        /* ── Nav buttons ─────────────────────────────────────────── */
        .kv-nav-btn {
            width:3rem; height:3rem; border-radius:9999px;
            background:linear-gradient(135deg,rgba(99,102,241,0.12),rgba(34,211,238,0.12));
            border:1px solid rgba(99,102,241,0.25); color:#6366f1;
            display:flex; align-items:center; justify-content:center;
            cursor:pointer; transition:transform 0.25s,box-shadow 0.25s;
            box-shadow:0 4px 14px rgba(99,102,241,0.12);
        }
        .kv-nav-btn:hover {
            transform:scale(1.12);
            box-shadow:0 8px 24px rgba(99,102,241,0.25);
        }

        /* ── Section orb decorations ─────────────────────────────── */
        .kv-orb {
            position:absolute; border-radius:9999px;
            filter:blur(72px); pointer-events:none;
        }
    </style>
    @endpush

    {{-- ================================================================
         HERO SECTION
    ================================================================= --}}
    <section id="kv-hero" style="position:relative; overflow:hidden; background:linear-gradient(135deg,rgba(99,102,241,0.05) 0%,var(--background) 50%,rgba(34,211,238,0.05) 100%); min-height:90vh; display:flex; align-items:center;">

        {{-- Fondo decorativo --}}
        <div style="position:absolute;inset:0;z-index:0;overflow:hidden;pointer-events:none;">
            <div style="position:absolute;top:-8rem;right:-8rem;width:28rem;height:28rem;border-radius:9999px;background:radial-gradient(circle,rgba(99,102,241,0.18),rgba(34,211,238,0.12));filter:blur(72px);animation:kvPulse 4s ease-in-out infinite;"></div>
            <div style="position:absolute;bottom:-8rem;left:-8rem;width:24rem;height:24rem;border-radius:9999px;background:radial-gradient(circle,rgba(34,211,238,0.18),rgba(99,102,241,0.08));filter:blur(72px);animation:kvPulse 4s ease-in-out infinite 2s;"></div>
            <div style="position:absolute;inset:0;opacity:0.025;background-image:radial-gradient(circle at 1px 1px,currentColor 1px,transparent 0);background-size:40px 40px;"></div>
            <div style="position:absolute;inset:0;background:linear-gradient(to bottom,transparent 60%,var(--background) 100%);"></div>
        </div>

        <div style="position:relative;z-index:10;width:100%;max-width:1400px;margin:0 auto;padding:4rem 1.5rem;">
            <div class="kv-hero-grid">

                {{-- ═══════════════ IZQUIERDA ═══════════════ --}}
                <div class="kv-hero-left" style="display:flex;flex-direction:column;gap:1.875rem;">

                    {{-- Badge --}}
                    <div style="width:fit-content;">
                        <div style="display:inline-flex;align-items:center;gap:0.75rem;background:linear-gradient(135deg,rgba(99,102,241,0.10),rgba(34,211,238,0.10));padding:0.7rem 1.25rem;border-radius:9999px;border:1px solid rgba(99,102,241,0.22);backdrop-filter:blur(8px);box-shadow:0 4px 14px rgba(99,102,241,0.10);animation:kvBadgePop 0.8s ease-out both;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:1.1rem;height:1.1rem;color:#6366f1;animation:kvPulse 2s ease-in-out infinite;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3l14 9-14 9V3z"/></svg>
                            <span style="font-size:0.78rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;background:linear-gradient(135deg,#6366f1,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">KillaVibes Premium</span>
                            <div style="width:0.45rem;height:0.45rem;border-radius:9999px;background:#6366f1;animation:kvPulse 2s ease-in-out infinite;"></div>
                        </div>
                    </div>

                    {{-- H1 --}}
                    <div>
                        <h1 style="font-family:var(--font-heading),'DM Serif Display',serif;font-size:clamp(2.4rem,5.5vw,4.2rem);font-weight:800;line-height:1.1;letter-spacing:-0.03em;color:var(--foreground);margin:0 0 1rem;">
                            Tecnología que
                            <span style="position:relative;display:inline-block;">
                                <span style="background:linear-gradient(135deg,#6366f1 0%,#22d3ee 50%,#6366f1 100%);background-size:200% auto;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:kvGradShift 3s ease infinite;">vibra</span>
                                <svg style="position:absolute;bottom:-0.3rem;left:0;width:100%;" height="10" viewBox="0 0 200 10" fill="none"><path d="M0 5 Q50 0,100 5 T200 5" stroke="#6366f1" stroke-width="2.5" fill="none" opacity="0.45"/></svg>
                            </span>
                            <br>contigo
                        </h1>
                        <p style="font-size:clamp(1rem,1.8vw,1.15rem);color:var(--muted-foreground);line-height:1.75;max-width:520px;margin:0;">
                            Descubre los mejores productos tecnológicos en
                            <span style="color:#6366f1;font-weight:600;">Barranquilla</span>.
                            Audífonos, parlantes, compresores y más con
                            <span style="color:#22d3ee;font-weight:600;">envíos gratis</span>
                            y garantía total.
                        </p>
                    </div>

                    {{-- CTAs --}}
                    <div style="display:flex;flex-wrap:wrap;gap:1rem;">
                        <a href="{{ url('/products') }}" class="kv-cta-primary">
                            Explorar Productos
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:1.15rem;height:1.15rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        <a href="{{ url('/page/ofertas') }}" class="kv-cta-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:1.15rem;height:1.15rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            Ver Ofertas
                        </a>
                    </div>

                    {{-- Feature cards --}}
                    <div class="kv-feat-grid">
                        @foreach($features as $idx => $feat)
                            <div class="kv-feat-card" style="background:{{ $feat['bg'] }};animation:kvCardIn 0.6s ease-out {{ $idx * 0.1 }}s both;">
                                <div style="width:3.25rem;height:3.25rem;border-radius:9999px;background:rgba(255,255,255,0.55);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;color:{{ $feat['color'] }};box-shadow:0 4px 12px rgba(0,0,0,0.07);">
                                    @if($feat['icon']==='truck')
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.6rem;height:1.6rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                                    @elseif($feat['icon']==='shield')
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.6rem;height:1.6rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    @elseif($feat['icon']==='clock')
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.6rem;height:1.6rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.6rem;height:1.6rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    @endif
                                </div>
                                <span style="font-size:0.8rem;font-weight:700;color:var(--foreground);display:block;">{{ $feat['title'] }}</span>
                                <span style="font-size:0.7rem;color:var(--muted-foreground);display:block;margin-top:-0.35rem;">{{ $feat['desc'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Stats bar --}}
                    <div class="kv-stats-bar">
                        @foreach([
                            ['val'=>'500+', 'label'=>'Clientes Felices', 'color'=>'#6366f1', 'svg'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>'],
                            ['val'=>'1000+','label'=>'Productos',        'color'=>'#22d3ee', 'svg'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>'],
                            ['val'=>'98%',  'label'=>'Satisfacción',     'color'=>'#22c55e', 'svg'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>'],
                        ] as $i => $stat)
                            @if($i > 0)
                                <div style="width:1px;height:2.75rem;background:var(--border);"></div>
                            @endif
                            <div style="text-align:center;flex:1;">
                                <div style="display:flex;align-items:center;justify-content:center;gap:0.25rem;margin-bottom:0.2rem;">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:1.15rem;height:1.15rem;color:{{ $stat['color'] }};" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">{!! $stat['svg'] !!}</svg>
                                    <span style="font-size:1.4rem;font-weight:800;color:{{ $stat['color'] }};">{{ $stat['val'] }}</span>
                                </div>
                                <p style="font-size:0.68rem;color:var(--muted-foreground);margin:0;">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ═══════════════ DERECHA — Visual Showcase ═══════════════ --}}
                <div class="kv-hero-right kv-showcase">

                    {{-- Rings --}}
                    <div class="kv-glow-ring"></div>
                    <div class="kv-glow-ring-2"></div>

                    {{-- Centre badge --}}
                    <div class="kv-showcase-center">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:2.5rem;height:2.5rem;color:#fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span style="font-size:0.65rem;font-weight:800;text-transform:uppercase;letter-spacing:0.06em;color:rgba(255,255,255,0.9);">KillaVibes</span>
                    </div>

                    {{-- Orbit card 1 — top --}}
                    <div class="kv-orbit-card" style="top:20px;left:50%;transform:translateX(-50%);animation:kvFloatSlow 5s ease-in-out infinite;">
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <div style="width:2.25rem;height:2.25rem;border-radius:0.5rem;background:linear-gradient(135deg,rgba(99,102,241,0.15),rgba(34,211,238,0.15));display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.15rem;height:1.15rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                            </div>
                            <div>
                                <p style="font-size:0.72rem;font-weight:700;color:var(--foreground);margin:0;">Audífonos BT</p>
                                <p style="font-size:0.65rem;color:var(--muted-foreground);margin:0;">Premium Sound</p>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;justify-content:space-between;">
                            <span style="font-size:0.85rem;font-weight:800;color:#6366f1;">$89.900</span>
                            <div style="display:flex;gap:1px;">
                                @for($s=0;$s<5;$s++)<svg xmlns="http://www.w3.org/2000/svg" style="width:0.65rem;height:0.65rem;color:#fbbf24;fill:#fbbf24;" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>@endfor
                            </div>
                        </div>
                    </div>

                    {{-- Orbit card 2 — right --}}
                    <div class="kv-orbit-card" style="top:50%;right:-10px;transform:translateY(-50%);animation:kvFloatSlow 6s ease-in-out infinite 1s;">
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <div style="width:2.25rem;height:2.25rem;border-radius:0.5rem;background:linear-gradient(135deg,rgba(249,115,22,0.15),rgba(239,68,68,0.12));display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.15rem;height:1.15rem;color:#f97316;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                            </div>
                            <div>
                                <p style="font-size:0.72rem;font-weight:700;color:var(--foreground);margin:0;">Compresor</p>
                                <p style="font-size:0.65rem;color:var(--muted-foreground);margin:0;">Portátil Pro</p>
                            </div>
                        </div>
                        <div style="padding:0.4rem 0.6rem;background:rgba(249,115,22,0.10);border-radius:0.5rem;text-align:center;">
                            <span style="font-size:0.78rem;font-weight:800;color:#f97316;">$124.900</span>
                        </div>
                    </div>

                    {{-- Orbit card 3 — bottom --}}
                    <div class="kv-orbit-card" style="bottom:20px;left:50%;transform:translateX(-50%);animation:kvFloatSlow 7s ease-in-out infinite 0.5s;">
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <div style="width:2.25rem;height:2.25rem;border-radius:0.5rem;background:linear-gradient(135deg,rgba(168,85,247,0.15),rgba(99,102,241,0.12));display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.15rem;height:1.15rem;color:#a855f7;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p style="font-size:0.72rem;font-weight:700;color:var(--foreground);margin:0;">Smartwatch</p>
                                <p style="font-size:0.65rem;color:var(--muted-foreground);margin:0;">Series Pro</p>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;justify-content:space-between;">
                            <span style="font-size:0.85rem;font-weight:800;color:#a855f7;">$199.900</span>
                            <span style="font-size:0.62rem;font-weight:700;padding:0.2rem 0.5rem;border-radius:9999px;background:rgba(239,68,68,0.12);color:#ef4444;">-20% OFF</span>
                        </div>
                    </div>

                    {{-- Orbit card 4 — left --}}
                    <div class="kv-orbit-card" style="top:50%;left:-10px;transform:translateY(-50%);animation:kvFloatSlow 5.5s ease-in-out infinite 1.8s;">
                        <div style="display:flex;align-items:center;gap:0.5rem;">
                            <div style="width:2.25rem;height:2.25rem;border-radius:0.5rem;background:linear-gradient(135deg,rgba(34,197,94,0.15),rgba(16,185,129,0.12));display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.15rem;height:1.15rem;color:#22c55e;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.536 8.464a5 5 0 010 7.072M12 18.364A9 9 0 003.636 10M16.243 6.757A9 9 0 0120.364 15"/></svg>
                            </div>
                            <div>
                                <p style="font-size:0.72rem;font-weight:700;color:var(--foreground);margin:0;">Parlante RGB</p>
                                <p style="font-size:0.65rem;color:var(--muted-foreground);margin:0;">Gato Edition</p>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:0.3rem;">
                            <div style="width:0.45rem;height:0.45rem;border-radius:9999px;background:#22c55e;animation:kvPulse 1.5s ease-in-out infinite;"></div>
                            <span style="font-size:0.65rem;color:#22c55e;font-weight:600;">En stock</span>
                        </div>
                    </div>

                    {{-- Floating pills --}}
                    <div class="kv-pill" style="top:12%;right:5%;background:rgba(255,255,255,0.88);border:1px solid rgba(34,197,94,0.25);color:#16a34a;animation-duration:4s;animation-delay:0.5s;">
                        <div style="width:0.5rem;height:0.5rem;border-radius:9999px;background:#22c55e;animation:kvPulse 1.5s infinite;"></div>
                        Envío hoy
                    </div>
                    <div class="kv-pill" style="bottom:14%;left:8%;background:rgba(255,255,255,0.88);border:1px solid rgba(99,102,241,0.25);color:#6366f1;animation-duration:5s;animation-delay:1s;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:0.8rem;height:0.8rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        100% Garantía
                    </div>
                </div>
            </div>
        </div>

        {{-- Wave bottom --}}
        <div style="position:absolute;bottom:0;left:0;right:0;height:5rem;overflow:hidden;pointer-events:none;z-index:5;">

        </div>
    </section>

    {{-- ================================================================
         CUSTOMIZATIONS LOOP — Carousels de Bagisto
    ================================================================= --}}
    @foreach ($customizations as $customization)
        @php ($data = $customization->options) @endphp
        @switch ($customization->type)

            @case ($customization::IMAGE_CAROUSEL)
                {{-- Renderizado aparte si se quiere mostrar en otra parte --}}
                @break

            @case ($customization::STATIC_CONTENT)
                @if(!empty($data['css']))
                    @push('styles')<style>{{ $data['css'] }}</style>@endpush
                @endif
                @if(!empty($data['html']))
                    <div style="max-width:1400px;margin:0 auto;padding:2rem 1.5rem;">{!! $data['html'] !!}</div>
                @endif
                @break

            @case ($customization::CATEGORY_CAROUSEL)
                <section class="kv-section" style="background:linear-gradient(to bottom,var(--background),rgba(99,102,241,0.03),var(--background));">
                    <div class="kv-orb" style="top:2rem;left:5%;width:18rem;height:18rem;background:rgba(99,102,241,0.05);"></div>
                    <div class="kv-orb" style="bottom:2rem;right:5%;width:22rem;height:22rem;background:rgba(34,211,238,0.05);"></div>
                    <div class="kv-section-inner">
                        <div class="kv-section-header">
                            <div class="kv-section-badge">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.9rem;height:0.9rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                <span>Categorías</span>
                            </div>
                            <h2 class="kv-section-title">
                                Explora nuestras <span class="kv-gradient-word">categorías</span>
                            </h2>
                        </div>
                        <x-shop::categories.carousel :title="''" :src="route('shop.api.categories.index',$data['filters']??[])" :navigation-link="route('shop.home.index')" aria-label="Categories Carousel"/>
                    </div>
                </section>
                @break

            @case ($customization::PRODUCT_CAROUSEL)
                <section class="kv-section" style="background:var(--background);">
                    <div class="kv-orb" style="top:50%;left:-4%;transform:translateY(-50%);width:20rem;height:20rem;background:rgba(99,102,241,0.04);"></div>
                    <div class="kv-orb" style="top:50%;right:-4%;transform:translateY(-50%);width:20rem;height:20rem;background:rgba(34,211,238,0.04);"></div>
                    <div class="kv-section-inner">
                        <div class="kv-section-header">
                            <div class="kv-section-badge">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.9rem;height:0.9rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                <span>Destacados</span>
                            </div>
                            <h2 class="kv-section-title">
                                {{ $data['title'] ?? 'Productos' }} <span class="kv-gradient-word">destacados</span>
                            </h2>
                        </div>
                        <x-shop::products.carousel :title="''" :src="route('shop.api.products.index',$data['filters']??[])" :navigation-link="route('shop.search.index',$data['filters']??[])" aria-label="Product Carousel"/>
                    </div>
                </section>
                @break

        @endswitch
    @endforeach

    {{-- ================================================================
         TESTIMONIOS — Pure Blade, sin @include dentro de loops Alpine
    ================================================================= --}}
    <section id="kv-testimonials" class="kv-section" style="background:linear-gradient(to bottom,var(--background),rgba(99,102,241,0.04) 50%,var(--background));">

        <div class="kv-orb" style="top:5rem;left:2rem;width:18rem;height:18rem;background:rgba(99,102,241,0.07);animation:kvFloat 6s ease-in-out infinite;"></div>
        <div class="kv-orb" style="bottom:5rem;right:2rem;width:24rem;height:24rem;background:rgba(34,211,238,0.07);animation:kvFloat 8s ease-in-out infinite 2s;"></div>

        <div class="kv-section-inner">

            {{-- Header --}}
            <div class="kv-section-header">
                <div class="kv-section-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;color:#ef4444;fill:#ef4444;" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    <span>Testimonios</span>
                </div>
                <h2 class="kv-section-title" style="margin-bottom:1rem;">
                    Lo que dicen
                    <span style="position:relative;display:inline-block;">
                        <span class="kv-gradient-word">nuestros clientes</span>
                        <svg style="position:absolute;bottom:-0.4rem;left:0;width:100%;" height="10" viewBox="0 0 200 10" fill="none"><path d="M0 5 Q50 0,100 5 T200 5" stroke="#6366f1" stroke-width="2.5" fill="none" opacity="0.4"/></svg>
                    </span>
                </h2>
                <p style="font-size:1.05rem;color:var(--muted-foreground);max-width:34rem;margin:0 auto 2rem;line-height:1.7;">
                    Cientos de clientes satisfechos confían en <span style="color:#6366f1;font-weight:600;">KillaVibes</span>
                </p>
                {{-- Stats --}}
                <div style="display:flex;align-items:center;justify-content:center;gap:3rem;flex-wrap:wrap;">
                    <div style="text-align:center;">
                        <div style="display:flex;align-items:center;gap:0.3rem;justify-content:center;margin-bottom:0.2rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:1.4rem;height:1.4rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                            <span style="font-size:1.75rem;font-weight:800;color:#6366f1;">500+</span>
                        </div>
                        <p style="font-size:0.78rem;color:var(--muted-foreground);margin:0;">Clientes Felices</p>
                    </div>
                    <div style="width:1px;height:2.75rem;background:var(--border);"></div>
                    <div style="text-align:center;">
                        <div style="display:flex;align-items:center;gap:0.3rem;justify-content:center;margin-bottom:0.2rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:1.4rem;height:1.4rem;color:#eab308;fill:#eab308;" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            <span style="font-size:1.75rem;font-weight:800;color:#eab308;">4.9</span>
                        </div>
                        <p style="font-size:0.78rem;color:var(--muted-foreground);margin:0;">Rating Promedio</p>
                    </div>
                </div>
            </div>

            {{-- ── MOBILE: carrusel con Alpine, HTML completamente inline ── --}}
            <div class="kv-testi-mobile"
                 x-data="{ cur:0, paused:false, total:{{ count($testimonials) }} }"
                 x-init="setInterval(()=>{ if(!paused) cur=(cur+1)%total },5000)"
                 @mouseenter="paused=true" @mouseleave="paused=false"
                 style="max-width:28rem;margin:0 auto;">

                <div style="position:relative;min-height:26rem;overflow:hidden;">
                    @foreach($testimonials as $ti => $t)
                    <div x-show="cur==={{ $ti }}"
                         style="transition:opacity 0.5s;{{ $ti===0 ? '' : 'display:none;' }}"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                    >
                        {{-- Card inline — no @include --}}
                        <div class="kv-testi-card">
                            <div class="kv-testi-corner"></div>
                            <div style="display:flex;align-items:center;justify-content:space-between;">
                                <div style="display:flex;gap:2px;">
                                    @for($s=0;$s<$t['rating'];$s++)<svg xmlns="http://www.w3.org/2000/svg" style="width:1.1rem;height:1.1rem;color:#fbbf24;fill:#fbbf24;" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>@endfor
                                </div>
                                <span style="font-size:0.68rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:9999px;background:rgba(34,197,94,0.10);color:#22c55e;">✓ Verificado</span>
                            </div>
                            <p style="color:var(--muted-foreground);line-height:1.75;font-size:0.9rem;margin:0;flex:1;">"{{ $t['comment'] }}"</p>
                            <div style="padding:0.6rem 0.875rem;background:rgba(99,102,241,0.05);border-radius:0.6rem;border:1px solid rgba(99,102,241,0.10);">
                                <p style="font-size:0.65rem;color:var(--muted-foreground);margin:0 0 0.15rem;">Producto comprado:</p>
                                <p style="font-size:0.8rem;font-weight:700;color:#6366f1;margin:0;">{{ $t['product'] }}</p>
                            </div>
                            <div style="display:flex;align-items:center;gap:0.875rem;">
                                <div style="width:3rem;height:3rem;border-radius:9999px;background:linear-gradient(135deg,rgba(99,102,241,0.18),rgba(34,211,238,0.18));display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1rem;color:#6366f1;border:2px solid rgba(99,102,241,0.18);flex-shrink:0;">{{ $t['initials'] }}</div>
                                <div>
                                    <p style="font-weight:700;font-size:0.9rem;color:var(--foreground);margin:0;">{{ $t['name'] }}</p>
                                    <p style="font-size:0.75rem;color:var(--muted-foreground);margin:0;">📍 {{ $t['location'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Nav mobile --}}
                <div style="display:flex;align-items:center;justify-content:center;gap:1rem;margin-top:1.5rem;">
                    <button @click="cur=(cur-1+total)%total" class="kv-nav-btn" style="width:2.5rem;height:2.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.1rem;height:1.1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <div style="display:flex;gap:0.4rem;">
                        @foreach($testimonials as $ti => $t)
                        <button @click="cur={{ $ti }}"
                                :style="cur==={{ $ti }} ? 'width:2rem;background:#6366f1;' : 'width:0.5rem;background:var(--border);'"
                                style="height:0.5rem;border-radius:9999px;transition:all 0.3s;cursor:pointer;border:none;"></button>
                        @endforeach
                    </div>
                    <button @click="cur=(cur+1)%total" class="kv-nav-btn" style="width:2.5rem;height:2.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.1rem;height:1.1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            {{-- ── DESKTOP: grid 3 cols con Alpine ── --}}
            <div class="kv-testi-desktop"
                 x-data="{ cur:0, paused:false, total:{{ count($testimonials) }} }"
                 x-init="setInterval(()=>{ if(!paused) cur=(cur+1)%total },5000)"
                 @mouseenter="paused=true" @mouseleave="paused=false">

                <div class="kv-testi-grid">
                    @foreach($testimonials as $ti => $t)
                    <div x-show="[0,1,2].map(i=>(cur+i)%total).includes({{ $ti }})"
                         style="transition:opacity 0.5s,transform 0.5s;"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                    >
                        {{-- Card inline -- no @include --}}
                        <div class="kv-testi-card">
                            <div class="kv-testi-corner"></div>
                            <div style="display:flex;align-items:center;justify-content:space-between;">
                                <div style="display:flex;gap:2px;">
                                    @for($s=0;$s<$t['rating'];$s++)<svg xmlns="http://www.w3.org/2000/svg" style="width:1.1rem;height:1.1rem;color:#fbbf24;fill:#fbbf24;" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>@endfor
                                </div>
                                <span style="font-size:0.68rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:9999px;background:rgba(34,197,94,0.10);color:#22c55e;">✓ Verificado</span>
                            </div>
                            <p style="color:var(--muted-foreground);line-height:1.75;font-size:0.9rem;margin:0;flex:1;">"{{ $t['comment'] }}"</p>
                            <div style="padding:0.6rem 0.875rem;background:rgba(99,102,241,0.05);border-radius:0.6rem;border:1px solid rgba(99,102,241,0.10);">
                                <p style="font-size:0.65rem;color:var(--muted-foreground);margin:0 0 0.15rem;">Producto comprado:</p>
                                <p style="font-size:0.8rem;font-weight:700;color:#6366f1;margin:0;">{{ $t['product'] }}</p>
                            </div>
                            <div style="display:flex;align-items:center;gap:0.875rem;">
                                <div style="width:3rem;height:3rem;border-radius:9999px;background:linear-gradient(135deg,rgba(99,102,241,0.18),rgba(34,211,238,0.18));display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1rem;color:#6366f1;border:2px solid rgba(99,102,241,0.18);flex-shrink:0;">{{ $t['initials'] }}</div>
                                <div>
                                    <p style="font-weight:700;font-size:0.9rem;color:var(--foreground);margin:0;">{{ $t['name'] }}</p>
                                    <p style="font-size:0.75rem;color:var(--muted-foreground);margin:0;">📍 {{ $t['location'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Nav desktop --}}
                <div style="display:flex;align-items:center;justify-content:center;gap:1rem;margin-top:3rem;">
                    <button @click="cur=(cur-1+total)%total" class="kv-nav-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.4rem;height:1.4rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <div style="display:flex;gap:0.6rem;align-items:center;">
                        @foreach($testimonials as $ti => $t)
                        <button @click="cur={{ $ti }}"
                                :style="cur==={{ $ti }} ? 'width:3rem;background:linear-gradient(to right,#6366f1,#22d3ee);box-shadow:0 2px 8px rgba(99,102,241,0.4);' : 'width:0.75rem;background:var(--border);'"
                                style="height:0.75rem;border-radius:9999px;transition:all 0.3s;cursor:pointer;border:none;"></button>
                        @endforeach
                    </div>
                    <button @click="cur=(cur+1)%total" class="kv-nav-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.4rem;height:1.4rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

</x-shop::layouts>
