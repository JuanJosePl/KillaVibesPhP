{!! view_render_event('bagisto.shop.layout.header.before') !!}

{{-- Barra superior moneda/idioma solo desktop --}}
@if(core()->getCurrentChannel()->locales()->count() > 1 || core()->getCurrentChannel()->currencies()->count() > 1)
<div class="max-lg:hidden">
    <x-shop::layouts.header.desktop.top />
</div>
@endif

<header
    id="kv-header"
    style="
        position: sticky;
        top: 0;
        z-index: 50;
        width: 100%;
        background-color: rgba(255,255,255,0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(226,232,240,0.6);
        box-shadow: 0 1px 20px -4px rgba(99,102,241,0.08);
        transition: background-color 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
    ">
    {{-- Desktop nav --}}
    <div class="max-lg:hidden">
        <x-shop::layouts.header.desktop />
    </div>

    {{-- Mobile nav --}}
    <div class="lg:hidden">
        <x-shop::layouts.header.mobile />
    </div>

    {{-- Barra de progreso scroll --}}
    <div
        id="kv-scroll-progress"
        style="
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            width: 0%;
            background: linear-gradient(90deg, #6366f1, #22d3ee, #6366f1);
            background-size: 200% 100%;
            transition: width 0.1s linear;
        "
        aria-hidden="true"></div>
</header>

{!! view_render_event('bagisto.shop.layout.header.after') !!}

@pushOnce('scripts')
<script>
    (function() {
        var header = document.getElementById('kv-header');
        var progressBar = document.getElementById('kv-scroll-progress');
        if (!header) return;

        function onScroll() {
            var scrollY = window.scrollY;
            var docHeight = document.documentElement.scrollHeight - window.innerHeight;
            var progress = docHeight > 0 ? Math.min((scrollY / docHeight) * 100, 100) : 0;

            if (progressBar) progressBar.style.width = progress + '%';

            if (scrollY > 30) {
                header.style.backgroundColor = 'rgba(255,255,255,0.95)';
                header.style.backdropFilter = 'blur(24px)';
                header.style.webkitBackdropFilter = 'blur(24px)';
                header.style.borderBottomColor = 'rgba(226,232,240,0.8)';
                header.style.boxShadow = '0 4px 30px -6px rgba(99,102,241,0.15)';
            } else {
                header.style.backgroundColor = 'rgba(255,255,255,0.85)';
                header.style.backdropFilter = 'blur(16px)';
                header.style.webkitBackdropFilter = 'blur(16px)';
                header.style.borderBottomColor = 'rgba(226,232,240,0.6)';
                header.style.boxShadow = '0 1px 20px -4px rgba(99,102,241,0.08)';
            }
        }

        window.addEventListener('scroll', onScroll, {
            passive: true
        });
        onScroll();
    })();
</script>
@endPushOnce
