{{-- bundle.blade.php — Bundle product price range --}}
<div class="grid gap-1 max-md:flex max-md:flex-wrap max-md:items-center max-md:gap-x-2">
    @if ($prices['from']['regular']['price'] != $prices['from']['final']['price'])
        <p style="display:flex;align-items:center;gap:0.5rem;">
            <span
                style="font-size:0.82rem;font-weight:500;color:var(--muted-foreground);text-decoration:line-through;"
                aria-label="{{ $prices['from']['regular']['formatted_price'] }}"
            >
                {{ $prices['from']['regular']['formatted_price'] }}
            </span>
            <span style="font-size:1rem;font-weight:800;background:linear-gradient(135deg,#6366f1,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                {{ $prices['from']['final']['formatted_price'] }}
            </span>
        </p>
    @else
        <p style="font-size:1rem;font-weight:800;color:var(--foreground);">
            {{ $prices['from']['regular']['formatted_price'] }}
        </p>
    @endif

    @if (
        $prices['from']['regular']['price'] != $prices['to']['regular']['price']
        || $prices['from']['final']['price'] != $prices['to']['final']['price']
    )
        <p style="font-size:0.78rem;font-weight:600;color:rgba(99,102,241,0.55);text-transform:uppercase;letter-spacing:0.05em;">
            To
        </p>

        @if ($prices['to']['regular']['price'] != $prices['to']['final']['price'])
            <p style="display:flex;align-items:center;gap:0.5rem;">
                <span
                    style="font-size:0.82rem;font-weight:500;color:var(--muted-foreground);text-decoration:line-through;"
                    aria-label="{{ $prices['to']['regular']['formatted_price'] }}"
                >
                    {{ $prices['to']['regular']['formatted_price'] }}
                </span>
                <span style="font-size:1rem;font-weight:800;background:linear-gradient(135deg,#6366f1,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                    {{ $prices['to']['final']['formatted_price'] }}
                </span>
            </p>
        @else
            <p style="font-size:1rem;font-weight:800;color:var(--foreground);">
                {{ $prices['to']['regular']['formatted_price'] }}
            </p>
        @endif
    @endif
</div>
