{{-- =====================================================================
     PARTIAL: testimonial-card
     Uso: @include('shop::home.partials.testimonial-card', ['testimonial' => $t])
     Variables:
       $testimonial  array  (name, location, rating, product, comment, initials)
       $featured     bool   (default false) — height:100% para carrusel mobile
====================================================================== --}}

@php $featured = $featured ?? false; @endphp

<div
    class="kv-testimonial-card"
    style="
        position:relative; overflow:hidden;
        background: linear-gradient(135deg, var(--card) 0%, rgba(255,255,255,0.85) 100%);
        backdrop-filter: blur(8px);
        border: 2px solid rgba(226,232,240,0.5);
        border-radius: 1.25rem;
        box-shadow: 0 4px 20px -4px rgba(99,102,241,0.10);
        padding: 2rem;
        {{ $featured ? 'height:100%;' : '' }}
        display: flex; flex-direction: column; gap: 1.25rem;
    "
>
    {{-- Decoración: esquina hover --}}
    <div
        class="kv-card-corner"
        style="
            position:absolute; top:0; right:0;
            width:8rem; height:8rem;
            background:linear-gradient(135deg, rgba(99,102,241,0.10), transparent);
            border-radius:0 1.25rem 0 100%;
            pointer-events:none;
        "
    ></div>

    {{-- Quote icon gigante decorativo --}}
    <div
        class="kv-quote-bg"
        style="
            position:absolute; top:-1rem; right:-1rem;
            pointer-events:none;
        "
    >
        <svg xmlns="http://www.w3.org/2000/svg" style="width:8rem;height:8rem;color:#6366f1;transform:rotate(12deg);" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
        </svg>
    </div>

    {{-- Rating + Verificado --}}
    <div style="display:flex; align-items:center; justify-content:space-between; position:relative; z-index:1;">
        <div style="display:flex; gap:0.2rem;">
            @for($s = 0; $s < ($testimonial['rating'] ?? 5); $s++)
                <svg xmlns="http://www.w3.org/2000/svg" style="width:1.25rem;height:1.25rem;color:#fbbf24;fill:#fbbf24;" viewBox="0 0 24 24">
                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
            @endfor
        </div>
        <div style="display:flex; align-items:center; gap:0.3rem; background:rgba(34,197,94,0.10); padding:0.25rem 0.75rem; border-radius:9999px;">
            <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;color:#22c55e;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
            </svg>
            <span style="font-size:0.7rem; font-weight:700; color:#22c55e;">Verificado</span>
        </div>
    </div>

    {{-- Comentario --}}
    <p style="
        color:var(--muted-foreground); line-height:1.75;
        font-size:0.925rem; position:relative; z-index:1;
        flex:1; margin:0;
    ">
        <svg xmlns="http://www.w3.org/2000/svg" style="display:inline;width:1.25rem;height:1.25rem;color:rgba(99,102,241,0.30);margin-right:0.25rem;vertical-align:middle;" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
        </svg>
        {{ $testimonial['comment'] }}
        <svg xmlns="http://www.w3.org/2000/svg" style="display:inline;width:1.25rem;height:1.25rem;color:rgba(99,102,241,0.30);margin-left:0.25rem;vertical-align:middle;transform:rotate(180deg);" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
        </svg>
    </p>

    {{-- Producto comprado --}}
    @if(!empty($testimonial['product']))
        <div style="padding:0.75rem 1rem; background:rgba(99,102,241,0.05); border-radius:0.75rem; border:1px solid rgba(99,102,241,0.12); position:relative; z-index:1;">
            <p style="font-size:0.7rem; color:var(--muted-foreground); margin:0 0 0.2rem;">Producto comprado:</p>
            <p style="font-size:0.875rem; font-weight:700; color:#6366f1; margin:0;">{{ $testimonial['product'] }}</p>
        </div>
    @endif

    {{-- Avatar + info --}}
    <div style="display:flex; align-items:center; gap:1rem; position:relative; z-index:1;">
        {{-- Avatar con iniciales --}}
        <div style="
            width:3.5rem; height:3.5rem; border-radius:9999px;
            background:linear-gradient(135deg, rgba(99,102,241,0.20), rgba(34,211,238,0.20));
            display:flex; align-items:center; justify-content:center;
            font-weight:800; font-size:1.1rem; color:#6366f1;
            border:2px solid rgba(99,102,241,0.20);
            box-shadow:0 4px 12px rgba(99,102,241,0.15);
            flex-shrink:0;
        ">
            {{ $testimonial['initials'] }}
        </div>
        <div>
            <p style="font-weight:700; font-size:0.95rem; color:var(--foreground); margin:0 0 0.2rem;">{{ $testimonial['name'] }}</p>
            <p style="font-size:0.8rem; color:var(--muted-foreground); margin:0; display:flex; align-items:center; gap:0.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.75rem;height:0.75rem;color:#6366f1;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                {{ $testimonial['location'] }}
            </p>
        </div>
    </div>
</div>
