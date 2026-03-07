@inject ('productViewHelper', 'Webkul\Product\Helpers\View')

{!! view_render_event('bagisto.shop.products.view.attributes.before', ['product' => $product]) !!}

@if ($customAttributeValues = $productViewHelper->getAdditionalData($product))
<accordian
    :title="trans('shop::app.products.specification')"
    :active="false">
    <div slot="header" style="display:flex;align-items:center;justify-content:space-between;padding:0.85rem 0;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;background:linear-gradient(135deg,#6366f1,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
        @lang('shop::app.products.specification')
        <i class="icon expand-icon right"></i>
    </div>

    <div slot="body" style="padding:0.5rem 0;">
        @foreach ($customAttributeValues as $attribute)
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.5rem 1.5rem;padding:0.65rem 0;border-bottom:1px solid rgba(226,232,240,0.5);font-size:0.88rem;">
            <span style="font-weight:600;color:var(--foreground);">
                @if ($attribute['label'])
                {{ $attribute['label'] }}
                @else
                {{ $attribute['admin_name'] }}
                @endif
            </span>

            @if ($attribute['type'] == 'file' && $attribute['value'])
            <a href="{{ route('shop.product.file.download', [$product->id, $attribute['id']]) }}" style="color:#6366f1;">
                <i class="icon sort-down-icon download"></i>
            </a>
            @elseif ($attribute['type'] == 'image' && $attribute['value'])
            <a href="{{ route('shop.product.file.download', [$product->id, $attribute['id']]) }}" style="color:#6366f1;">
                <img src="{{ Storage::url($attribute['value']) }}" style="height:20px;width:20px;border-radius:0.25rem;" alt="" />
            </a>
            @else
            <span style="color:var(--muted-foreground);">{{ $attribute['value'] }}</span>
            @endif
        </div>
        @endforeach
    </div>
</accordian>
@endif

{!! view_render_event('bagisto.shop.products.view.attributes.after', ['product' => $product]) !!}
