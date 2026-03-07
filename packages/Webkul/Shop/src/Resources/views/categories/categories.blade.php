@push('styles')
<style>
    /* ═══════════════════════════════════════════
       KILLAVIBES — CATEGORIES PAGE
       ═══════════════════════════════════════════ */

    @keyframes kvcatFadeUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes kvcatPulse {
        0%,100% { opacity: 1; }
        50%      { opacity: 0.55; }
    }
    @keyframes kvcatGradShift {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .kvcat-root {
        position: relative; overflow: hidden;
        padding: 5rem 0 6rem;
        background: linear-gradient(to bottom,
            var(--background),
            rgba(99,102,241,0.03) 50%,
            var(--background));
    }
    .kvcat-orb-tr {
        position: absolute; top: -6rem; right: -6rem;
        width: 28rem; height: 28rem; border-radius: 9999px;
        background: radial-gradient(circle, rgba(99,102,241,0.12), rgba(34,211,238,0.08));
        filter: blur(72px); pointer-events: none; z-index: 0;
        animation: kvcatPulse 4s ease-in-out infinite;
    }
    .kvcat-orb-bl {
        position: absolute; bottom: -6rem; left: -6rem;
        width: 24rem; height: 24rem; border-radius: 9999px;
        background: radial-gradient(circle, rgba(34,211,238,0.12), rgba(99,102,241,0.06));
        filter: blur(72px); pointer-events: none; z-index: 0;
        animation: kvcatPulse 4s ease-in-out infinite 2s;
    }
    .kvcat-dotgrid {
        position: absolute; inset: 0; opacity: 0.025;
        background-image: radial-gradient(circle at 1px 1px, currentColor 1px, transparent 0);
        background-size: 40px 40px; pointer-events: none; z-index: 0;
    }
    .kvcat-wrapper {
        position: relative; z-index: 10;
        max-width: 1400px; margin: 0 auto; padding: 0 1.5rem;
    }

    /* ── Header ── */
    .kvcat-header { text-align: center; margin-bottom: 3.5rem; }
    .kvcat-badge {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.10), rgba(34,211,238,0.10));
        padding: 0.6rem 1.25rem; border-radius: 9999px;
        border: 1px solid rgba(99,102,241,0.20); margin-bottom: 1.25rem;
    }
    .kvcat-badge span {
        font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .kvcat-title {
        font-family: var(--font-heading), 'DM Serif Display', serif;
        font-size: clamp(1.8rem, 4vw, 2.8rem) !important;
        font-weight: 800 !important; letter-spacing: -0.03em !important;
        color: var(--foreground) !important; margin: 0 0 1rem !important; line-height: 1.15 !important;
    }
    .kvcat-title-accent {
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        background-size: 200% auto;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        animation: kvcatGradShift 3s ease infinite;
    }
    .kvcat-subtitle { font-size: 1.05rem; color: var(--muted-foreground); max-width: 34rem; margin: 0 auto; line-height: 1.7; }
    .kvcat-underline-wrap { position: relative; display: inline-block; }
    .kvcat-underline-wrap svg { position: absolute; bottom: -0.4rem; left: 0; width: 100%; }

    /* ── Grid ── */
    .kvcat-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 1.75rem; }
    @media (max-width: 1024px) { .kvcat-grid { grid-template-columns: repeat(2,1fr); } }
    @media (max-width: 640px)  { .kvcat-grid { grid-template-columns: 1fr; gap: 1.25rem; } .kvcat-root { padding: 3rem 0 4rem; } }

    /* ── Card ── */
    .kvcat-card {
        position: relative; overflow: hidden;
        display: flex; flex-direction: column;
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        border: 2px solid rgba(226,232,240,0.55); border-radius: 1.25rem;
        box-shadow: 0 4px 20px -4px rgba(99,102,241,0.10);
        text-decoration: none !important; color: inherit !important;
        transition: transform 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
        animation: kvcatFadeUp 0.6s cubic-bezier(0.16,1,0.3,1) both;
    }
    .kvcat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 60px -15px rgba(99,102,241,0.25);
        border-color: rgba(99,102,241,0.30); text-decoration: none !important;
    }
    .kvcat-card__corner {
        position: absolute; top: 0; right: 0; width: 8rem; height: 8rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.09), transparent);
        border-radius: 0 1.25rem 0 100%;
        opacity: 0; transition: opacity 0.4s; pointer-events: none; z-index: 2;
    }
    .kvcat-card:hover .kvcat-card__corner { opacity: 1; }
    .kvcat-card:nth-child(1)  { animation-delay: 0.05s; }
    .kvcat-card:nth-child(2)  { animation-delay: 0.10s; }
    .kvcat-card:nth-child(3)  { animation-delay: 0.15s; }
    .kvcat-card:nth-child(4)  { animation-delay: 0.20s; }
    .kvcat-card:nth-child(5)  { animation-delay: 0.25s; }
    .kvcat-card:nth-child(6)  { animation-delay: 0.30s; }
    .kvcat-card:nth-child(7)  { animation-delay: 0.35s; }
    .kvcat-card:nth-child(8)  { animation-delay: 0.40s; }
    .kvcat-card:nth-child(9)  { animation-delay: 0.45s; }
    .kvcat-card:nth-child(10) { animation-delay: 0.50s; }

    /* ── Image ── */
    .kvcat-card__img-wrap {
        position: relative; height: 210px; overflow: hidden;
        background: linear-gradient(135deg, rgba(99,102,241,0.06), rgba(34,211,238,0.06));
        flex-shrink: 0;
    }
    @media (max-width: 640px) { .kvcat-card__img-wrap { height: 180px; } }
    .kvcat-card__img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.16,1,0.3,1); }
    .kvcat-card:hover .kvcat-card__img-wrap img { transform: scale(1.06); }
    .kvcat-card__img-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to bottom, transparent 50%, rgba(255,255,255,0.15) 100%); z-index: 1;
    }
    .kvcat-card__no-img { display: flex; align-items: center; justify-content: center; height: 100%; color: rgba(99,102,241,0.25); }
    .kvcat-card__featured-badge {
        position: absolute; top: 0.75rem; right: 0.75rem; z-index: 3;
        font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em;
        padding: 0.3rem 0.75rem; border-radius: 9999px;
        background: linear-gradient(135deg, rgba(99,102,241,0.12), rgba(34,211,238,0.12));
        border: 1px solid rgba(99,102,241,0.20); color: #6366f1; backdrop-filter: blur(8px);
    }
    .kvcat-card__num {
        position: absolute; bottom: 0.6rem; left: 0.75rem; z-index: 3;
        font-size: 0.68rem; font-weight: 700; color: rgba(99,102,241,0.55); letter-spacing: 0.04em;
    }

    /* ── Body ── */
    .kvcat-card__body { padding: 1.5rem; display: flex; flex-direction: column; flex: 1; }
    .kvcat-card__tag {
        display: inline-flex; align-items: center; gap: 0.3rem;
        padding: 0.3rem 0.75rem; background: rgba(99,102,241,0.07);
        border: 1px solid rgba(99,102,241,0.12); border-radius: 9999px;
        margin-bottom: 0.75rem; width: fit-content;
    }
    .kvcat-card__tag span { font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #6366f1; }
    .kvcat-card__title {
        font-size: 1.1rem !important; font-weight: 800 !important;
        color: var(--foreground) !important; letter-spacing: -0.01em;
        margin-bottom: 0.5rem !important; line-height: 1.3 !important; transition: color 0.2s;
    }
    .kvcat-card:hover .kvcat-card__title { color: #6366f1 !important; }
    .kvcat-card__desc {
        font-size: 0.85rem; color: var(--muted-foreground); line-height: 1.65;
        margin-bottom: 1.25rem !important; flex: 1;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .kvcat-card__footer {
        display: flex; align-items: center; justify-content: space-between;
        padding-top: 1rem; border-top: 1px solid rgba(226,232,240,0.7); margin-top: auto;
    }
    .kvcat-card__cta {
        display: inline-flex; align-items: center; gap: 0.4rem;
        font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em;
        color: #6366f1; transition: gap 0.25s;
    }
    .kvcat-card:hover .kvcat-card__cta { gap: 0.65rem; }
    .kvcat-card__cta svg { transition: transform 0.25s; }
    .kvcat-card:hover .kvcat-card__cta svg { transform: translateX(3px); }
    .kvcat-card__dot {
        width: 0.55rem; height: 0.55rem; border-radius: 9999px;
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        opacity: 0.45; transition: opacity 0.25s, transform 0.25s; display: inline-block;
    }
    .kvcat-card:hover .kvcat-card__dot { opacity: 1; transform: scale(1.5); }

    .kvcat-empty {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        padding: 6rem 1rem; text-align: center; color: var(--muted-foreground);
    }
</style>
@endpush

@extends('shop::layouts.master')

@section('page_title')
    Categorías | KillaVibes
@endsection

@section('content-wrapper')

    @php
        $categoryRepository = app('Webkul\Category\Repositories\CategoryRepository');
        $categories = $categoryRepository->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);
    @endphp

    <section class="kvcat-root">
        <div class="kvcat-orb-tr" aria-hidden="true"></div>
        <div class="kvcat-orb-bl" aria-hidden="true"></div>
        <div class="kvcat-dotgrid" aria-hidden="true"></div>

        <div class="kvcat-wrapper">

            <div class="kvcat-header">
                <div class="kvcat-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:0.9rem;height:0.9rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span>KillaVibes Store</span>
                </div>

                <h1 class="kvcat-title">
                    Nuestras
                    <span class="kvcat-underline-wrap">
                        <span class="kvcat-title-accent">Categorías</span>
                        <svg height="10" viewBox="0 0 200 10" fill="none">
                            <path d="M0 5 Q50 0,100 5 T200 5" stroke="#6366f1" stroke-width="2.5" fill="none" opacity="0.4"/>
                        </svg>
                    </span>
                </h1>

                <p class="kvcat-subtitle">
                    Navega por nuestra colección completa y encuentra tu <span style="color:#6366f1;font-weight:600;">estilo</span>
                </p>
            </div>

            @if ($categories && count($categories) > 0)
                <div class="kvcat-grid">
                    @foreach ($categories as $category)
                        <a href="{{ url($category->url_path) }}" class="kvcat-card">
                            <div class="kvcat-card__corner"></div>

                            <div class="kvcat-card__img-wrap">
                                @if ($category->image_url)
                                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" loading="lazy">
                                @else
                                    <div class="kvcat-card__no-img">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="0.75">
                                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <path d="m21 15-5-5L5 21"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="kvcat-card__img-overlay"></div>
                                <span class="kvcat-card__featured-badge">Destacada</span>
                                <span class="kvcat-card__num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>

                            <div class="kvcat-card__body">
                                <div class="kvcat-card__tag">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:0.7rem;height:0.7rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    <span>KillaVibes</span>
                                </div>

                                <h2 class="kvcat-card__title">{{ $category->name }}</h2>

                                <p class="kvcat-card__desc">
                                    @if ($category->description)
                                        {!! strip_tags($category->description) !!}
                                    @else
                                        Explora nuestra colección exclusiva.
                                    @endif
                                </p>

                                <div class="kvcat-card__footer">
                                    <span class="kvcat-card__cta">
                                        Ver productos
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path d="M5 12h14M12 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                    <span class="kvcat-card__dot"></span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="kvcat-empty">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" style="margin-bottom:1.5rem;opacity:0.2;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                        <path d="M16 3H8L6 7h12l-2-4z"/>
                    </svg>
                    <p style="font-size:1.1rem;font-weight:600;">No hay categorías disponibles aún.</p>
                </div>
            @endif

        </div>
    </section>

@endsection
