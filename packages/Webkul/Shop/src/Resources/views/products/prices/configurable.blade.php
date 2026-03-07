{{-- configurable.blade.php — Configurable product price --}}
<p class="price-label" style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:rgba(99,102,241,0.55);margin-bottom:0.25rem;">
    @lang('shop::app.products.prices.configurable.as-low-as')
</p>

<p class="final-price" style="font-size:1.05rem;font-weight:800;background:linear-gradient(135deg,#6366f1,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
    {{ $prices['regular']['formatted_price'] }}
</p>
