{{-- index.blade.php — Simple product price --}}
@if ($prices['final']['price'] < $prices['regular']['price'])
    <p
        style="font-size:0.85rem;font-weight:500;color:var(--muted-foreground);text-decoration:line-through;"
        aria-label="{{ $prices['regular']['formatted_price'] }}"
    >
        {{ $prices['regular']['formatted_price'] }}
    </p>

    <p style="font-size:1.05rem;font-weight:800;background:linear-gradient(135deg,#6366f1,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
        {{ $prices['final']['formatted_price'] }}
    </p>
@else
    <p style="font-size:1.05rem;font-weight:800;color:var(--foreground);">
        {{ $prices['regular']['formatted_price'] }}
    </p>
@endif
