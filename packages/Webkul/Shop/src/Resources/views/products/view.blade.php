@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('productViewHelper', 'Webkul\Product\Helpers\View')

@php
$avgRatings = $reviewHelper->getAverageRating($product);
$percentageRatings = $reviewHelper->getPercentageRating($product);
$customAttributeValues = $productViewHelper->getAdditionalData($product);
$attributeData = collect($customAttributeValues)->filter(fn ($item) => ! empty($item['value']));
@endphp

@push('meta')
<meta name="description" content="{{ trim($product->meta_description) != "" ? $product->meta_description : \Illuminate\Support\Str::limit(strip_tags($product->description), 120, '') }}" />
<meta name="keywords" content="{{ $product->meta_keywords }}" />

@if (core()->getConfigData('catalog.rich_snippets.products.enable'))
<script type="application/ld+json">
    {
        !!app('Webkul\Product\Helpers\SEO') - > getProductJsonLd($product) !!
    }
</script>
@endif

<?php $productBaseImage = product_image()->getProductBaseImage($product); ?>

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{{ $product->name }}" />
<meta name="twitter:description" content="{!! htmlspecialchars(trim(strip_tags($product->description))) !!}" />
<meta name="twitter:image:alt" content="" />
<meta name="twitter:image" content="{{ $productBaseImage['medium_image_url'] }}" />
<meta property="og:type" content="og:product" />
<meta property="og:title" content="{{ $product->name }}" />
<meta property="og:image" content="{{ $productBaseImage['medium_image_url'] }}" />
<meta property="og:description" content="{!! htmlspecialchars(trim(strip_tags($product->description))) !!}" />
<meta property="og:url" content="{{ route('shop.product_or_category.index', $product->url_key) }}" />
@endPush

@push('styles')
<style>
    /* ═══════════════════════════════════════════
       KILLAVIBES — PRODUCT VIEW PAGE
       ═══════════════════════════════════════════ */

    @keyframes kvpdFadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes kvpdPulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.55;
        }
    }

    @keyframes kvpdGradShift {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    @keyframes kvpdSpin {
        to {
            transform: rotate(360deg);
        }
    }

    /* ── Root ── */
    .kvpd-root {
        position: relative;
        overflow: hidden;
        background: linear-gradient(to bottom,
                var(--background),
                rgba(99, 102, 241, 0.025) 40%,
                var(--background));
        min-height: 80vh;
    }

    .kvpd-orb-tr {
        position: absolute;
        top: -8rem;
        right: -8rem;
        width: 32rem;
        height: 32rem;
        border-radius: 9999px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.10), rgba(34, 211, 238, 0.06));
        filter: blur(80px);
        pointer-events: none;
        z-index: 0;
        animation: kvpdPulse 5s ease-in-out infinite;
    }

    .kvpd-orb-bl {
        position: absolute;
        bottom: 5%;
        left: -6rem;
        width: 24rem;
        height: 24rem;
        border-radius: 9999px;
        background: radial-gradient(circle, rgba(34, 211, 238, 0.08), rgba(99, 102, 241, 0.05));
        filter: blur(72px);
        pointer-events: none;
        z-index: 0;
        animation: kvpdPulse 5s ease-in-out infinite 2.5s;
    }

    .kvpd-dotgrid {
        position: absolute;
        inset: 0;
        opacity: 0.018;
        background-image: radial-gradient(circle at 1px 1px, currentColor 1px, transparent 0);
        background-size: 40px 40px;
        pointer-events: none;
        z-index: 0;
    }

    /* ── Product layout ── */
    .kvpd-layout {
        position: relative;
        z-index: 10;
        animation: kvpdFadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    /* ── Product name ── */
    .kvpd-product-name {
        font-family: var(--font-heading), 'DM Serif Display', serif;
        font-size: clamp(1.4rem, 3vw, 2rem) !important;
        font-weight: 700 !important;
        letter-spacing: -0.02em;
        color: var(--foreground) !important;
        line-height: 1.2 !important;
    }

    /* ── Price block ── */
    .kvpd-price {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 1.25rem;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.07), rgba(34, 211, 238, 0.07));
        border: 1px solid rgba(99, 102, 241, 0.15);
        border-radius: 9999px;
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--foreground);
        margin-top: 1rem;
    }

    /* ── Short description ── */
    .kvpd-short-desc {
        font-size: 0.95rem;
        color: var(--muted-foreground);
        line-height: 1.75;
        margin-top: 1.25rem;
    }

    /* ── Wishlist button ── */
    .kvpd-wishlist-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.75rem;
        height: 2.75rem;
        border-radius: 9999px;
        border: 1.5px solid rgba(226, 232, 240, 0.7);
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        font-size: 1.3rem;
        cursor: pointer;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        flex-shrink: 0;
    }

    .kvpd-wishlist-btn:hover {
        border-color: rgba(99, 102, 241, 0.35);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.10);
        background: rgba(99, 102, 241, 0.04);
    }

    /* ── Section divider ── */
    .kvpd-divider {
        height: 1px;
        background: linear-gradient(to right, rgba(99, 102, 241, 0.15), rgba(34, 211, 238, 0.10), transparent);
        margin: 1.5rem 0;
    }

    /* ── Info tabs section ── */
    .kvpd-tabs-section {
        position: relative;
        z-index: 10;
        margin-top: 4rem;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-top: 1px solid rgba(226, 232, 240, 0.5);
        border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        padding: 2.5rem 0;
    }

    /* ── Mobile accordions section ── */
    .kvpd-mobile-section {
        position: relative;
        z-index: 10;
        margin-top: 1.5rem;
        padding: 0 0 2rem;
    }

    /* ── Accordion header override ── */
    .kvpd-accordion-header {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(34, 211, 238, 0.04)) !important;
        border-left: 3px solid #6366f1;
    }

    /* ── Attribute table ── */
    .kvpd-attr-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem 1.5rem;
        padding: 0.65rem 0;
        border-bottom: 1px solid rgba(226, 232, 240, 0.5);
        font-size: 0.9rem;
    }

    .kvpd-attr-label {
        font-weight: 600;
        color: var(--foreground);
    }

    .kvpd-attr-value {
        color: var(--muted-foreground);
    }

    /* ── Compare button ── */
    .kvpd-compare-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: rgba(99, 102, 241, 0.65);
        padding: 0.5rem 0;
        cursor: pointer;
        transition: color 0.2s;
        background: none;
        border: none;
    }

    .kvpd-compare-btn:hover {
        color: #6366f1;
    }

    /* ── Group pricing offers ── */
    .kvpd-offers {
        margin-top: 0.75rem;
        padding: 0.75rem 1rem;
        background: rgba(99, 102, 241, 0.04);
        border: 1px solid rgba(99, 102, 241, 0.12);
        border-radius: 0.75rem;
        font-size: 0.85rem;
        color: var(--muted-foreground);
    }

    .kvpd-offers [&>*] {
        color: var(--foreground);
    }

    /* ── Tag ── */
    .kvpd-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.3rem 0.75rem;
        background: rgba(99, 102, 241, 0.07);
        border: 1px solid rgba(99, 102, 241, 0.12);
        border-radius: 9999px;
        margin-bottom: 0.85rem;
        width: fit-content;
    }

    .kvpd-tag span {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* ── Description text ── */
    .kvpd-desc-text {
        font-size: 0.95rem !important;
        color: var(--muted-foreground) !important;
        line-height: 1.75 !important;
    }

    /* ── Breakpoint helpers: reemplazo de clases Tailwind personalizadas ── */
    @media (min-width: 1180px) {
        .kvpd-mobile-only {
            display: none !important;
        }
    }

    @media (max-width: 1179px) {
        .kvpd-desktop-only {
            display: none !important;
        }
    }
</style>
@endpush

<x-shop::layouts>
    <x-slot:title>
        {{ trim($product->meta_title) != "" ? $product->meta_title : $product->name }}
        </x-slot>

        {!! view_render_event('bagisto.shop.products.view.before', ['product' => $product]) !!}

        <!-- Breadcrumbs -->
        @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        <div class="flex justify-center max-lg:hidden relative z-10">
            <x-shop::breadcrumbs
                name="product"
                :entity="$product" />
        </div>
        @endif

        <!-- Root wrapper con orbes + dot grid -->
        <div class="kvpd-root">
            <div class="kvpd-orb-tr" aria-hidden="true"></div>
            <div class="kvpd-orb-bl" aria-hidden="true"></div>
            <div class="kvpd-dotgrid" aria-hidden="true"></div>

            <!-- Product Vue Component -->
            <v-product>
                <x-shop::shimmer.products.view />
            </v-product>
        </div>

        <!-- ── Desktop Tabs: Description / Attributes / Reviews ── -->
        <div class="kvpd-tabs-section kvpd-desktop-only">
            <div class="container px-[60px] max-lg:px-8">
                <x-shop::tabs position="center" ref="productTabs">

                    {!! view_render_event('bagisto.shop.products.view.description.before', ['product' => $product]) !!}

                    <x-shop::tabs.item
                        id="descritpion-tab"
                        class="container !p-0"
                        :title="trans('shop::app.products.view.description')"
                        :is-selected="true">
                        <div class="mt-8 max-w-3xl mx-auto kvpd-desc-text">
                            {!! $product->description !!}
                        </div>
                    </x-shop::tabs.item>

                    {!! view_render_event('bagisto.shop.products.view.description.after', ['product' => $product]) !!}

                    @if(count($attributeData))
                    <x-shop::tabs.item
                        id="information-tab"
                        class="container !p-0"
                        :title="trans('shop::app.products.view.additional-information')"
                        :is-selected="false">
                        <div class="mt-8 max-w-2xl mx-auto">
                            @foreach ($customAttributeValues as $customAttributeValue)
                            @if (! empty($customAttributeValue['value']))
                            <div class="kvpd-attr-row">
                                <p class="kvpd-attr-label">{!! $customAttributeValue['label'] !!}</p>

                                @if ($customAttributeValue['type'] == 'file')
                                <a href="{{ Storage::url($product[$customAttributeValue['code']]) }}" download="{{ $customAttributeValue['label'] }}">
                                    <span class="icon-download text-2xl text-[#6366f1]"></span>
                                </a>
                                @elseif ($customAttributeValue['type'] == 'image')
                                <a href="{{ Storage::url($product[$customAttributeValue['code']]) }}" download="{{ $customAttributeValue['label'] }}">
                                    <img class="h-5 w-5" src="{{ Storage::url($customAttributeValue['value']) }}" />
                                </a>
                                @else
                                <p class="kvpd-attr-value">{!! $customAttributeValue['value'] !!}</p>
                                @endif
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </x-shop::tabs.item>
                    @endif

                    <x-shop::tabs.item
                        id="review-tab"
                        class="container !p-0"
                        :title="trans('shop::app.products.view.review')"
                        :is-selected="false">
                        @include('shop::products.view.reviews')
                    </x-shop::tabs.item>
                </x-shop::tabs>
            </div>
        </div>

        <!-- ── Mobile Accordions ── -->
        <div class="kvpd-mobile-section kvpd-mobile-only container !px-4 grid gap-3">

            <x-shop::accordion class="overflow-hidden rounded-2xl border border-[rgba(226,232,240,0.55)] bg-white/90 backdrop-blur-sm" :is-active="true">
                <x-slot:header class="kvpd-accordion-header !py-3.5 !px-5">
                    <p class="text-sm font-semibold uppercase tracking-wider text-[#6366f1]">
                        @lang('shop::app.products.view.description')
                    </p>
                    </x-slot>
                    <x-slot:content class="!px-5 !py-4">
                        <div class="kvpd-desc-text max-sm:text-sm">
                            {!! $product->description !!}
                        </div>
                        </x-slot>
            </x-shop::accordion>

            @if (count($attributeData))
            <x-shop::accordion class="overflow-hidden rounded-2xl border border-[rgba(226,232,240,0.55)] bg-white/90 backdrop-blur-sm" :is-active="false">
                <x-slot:header class="kvpd-accordion-header !py-3.5 !px-5">
                    <p class="text-sm font-semibold uppercase tracking-wider text-[#6366f1]">
                        @lang('shop::app.products.view.additional-information')
                    </p>
                    </x-slot>
                    <x-slot:content class="!px-5 !py-4">
                        @foreach ($customAttributeValues as $customAttributeValue)
                        @if (! empty($customAttributeValue['value']))
                        <div class="kvpd-attr-row">
                            <p class="kvpd-attr-label text-sm">{{ $customAttributeValue['label'] }}</p>
                            @if ($customAttributeValue['type'] == 'file')
                            <a href="{{ Storage::url($product[$customAttributeValue['code']]) }}" download="{{ $customAttributeValue['label'] }}">
                                <span class="icon-download text-xl text-[#6366f1]"></span>
                            </a>
                            @elseif ($customAttributeValue['type'] == 'image')
                            <a href="{{ Storage::url($product[$customAttributeValue['code']]) }}" download="{{ $customAttributeValue['label'] }}">
                                <img class="h-5 w-5" src="{{ Storage::url($customAttributeValue['value']) }}" alt="Product Image" />
                            </a>
                            @else
                            <p class="kvpd-attr-value text-sm">{{ $customAttributeValue['value'] ?? '-' }}</p>
                            @endif
                        </div>
                        @endif
                        @endforeach
                        </x-slot>
            </x-shop::accordion>
            @endif

            <x-shop::accordion class="overflow-hidden rounded-2xl border border-[rgba(226,232,240,0.55)] bg-white/90 backdrop-blur-sm" :is-active="false">
                <x-slot:header class="kvpd-accordion-header !py-3.5 !px-5" id="review-accordian-button">
                    <p class="text-sm font-semibold uppercase tracking-wider text-[#6366f1]">
                        @lang('shop::app.products.view.review')
                    </p>
                    </x-slot>
                    <x-slot:content class="!px-0">
                        @include('shop::products.view.reviews')
                        </x-slot>
            </x-shop::accordion>
        </div>

        <!-- Related & Upsell -->
        <x-shop::products.carousel
            :title="trans('shop::app.products.view.related-product-title')"
            :src="route('shop.api.products.related.index', ['id' => $product->id])" />

        <x-shop::products.carousel
            :title="trans('shop::app.products.view.up-sell-title')"
            :src="route('shop.api.products.up-sell.index', ['id' => $product->id])" />

        {!! view_render_event('bagisto.shop.products.view.after', ['product' => $product]) !!}

        @pushOnce('scripts')
        <script type="text/x-template" id="v-product-template">
            <x-shop::form v-slot="{ meta, errors, handleSubmit }" as="div">
                <form ref="formData" @submit="handleSubmit($event, addToCart)">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="is_buy_now" v-model="is_buy_now">

                    <div class="kvpd-layout container px-[60px] max-1180:px-0">
                        <div class="mt-12 flex gap-10 max-1180:flex-wrap max-lg:mt-0 max-sm:gap-y-4">

                            <!-- Gallery -->
                            @include('shop::products.view.gallery')

                            <!-- Details Panel -->
                            <div class="relative max-w-[560px] max-1180:w-full max-1180:max-w-full max-1180:px-5 max-sm:px-4">

                                {!! view_render_event('bagisto.shop.products.name.before', ['product' => $product]) !!}

                                <!-- Tag + Name + Wishlist -->
                                <div class="kvpd-tag">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:0.7rem;height:0.7rem;" fill="none" viewBox="0 0 24 24" stroke="#6366f1" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    <span>KillaVibes</span>
                                </div>

                                <div class="flex items-start justify-between gap-4">
                                    <h1 class="kvpd-product-name">{{ $product->name }}</h1>

                                    @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                                        <div
                                            class="kvpd-wishlist-btn"
                                            role="button"
                                            aria-label="@lang('shop::app.products.view.add-to-wishlist')"
                                            tabindex="0"
                                            :class="isWishlist ? 'icon-heart-fill text-red-600' : 'icon-heart'"
                                            @click="addToWishlist"
                                        ></div>
                                    @endif
                                </div>

                                {!! view_render_event('bagisto.shop.products.name.after', ['product' => $product]) !!}

                                <!-- Ratings -->
                                {!! view_render_event('bagisto.shop.products.rating.before', ['product' => $product]) !!}

                                @if ($totalRatings = $reviewHelper->getTotalFeedback($product))
                                    <div
                                        class="mt-2 w-max cursor-pointer"
                                        role="button"
                                        tabindex="0"
                                        @click="scrollToReview"
                                    >
                                        <x-shop::products.ratings
                                            class="transition-all hover:border-[rgba(99,102,241,0.4)] max-sm:px-3 max-sm:py-1"
                                            :average="$avgRatings"
                                            :total="$totalRatings"
                                            ::rating="true"
                                        />
                                    </div>
                                @endif

                                {!! view_render_event('bagisto.shop.products.rating.after', ['product' => $product]) !!}

                                <div class="kvpd-divider"></div>

                                <!-- Pricing -->
                                {!! view_render_event('bagisto.shop.products.price.before', ['product' => $product]) !!}

                                <div class="kvpd-price max-sm:text-lg max-sm:mt-1.5">
                                    {!! $product->getTypeInstance()->getPriceHtml() !!}
                                </div>

                                @if (\Webkul\Tax\Facades\Tax::isInclusiveTaxProductPrices())
                                    <span class="mt-1 block text-xs text-[rgba(99,102,241,0.6)]">
                                        (@lang('shop::app.products.view.tax-inclusive'))
                                    </span>
                                @endif

                                @if (count($product->getTypeInstance()->getCustomerGroupPricingOffers()))
                                    <div class="kvpd-offers">
                                        @foreach ($product->getTypeInstance()->getCustomerGroupPricingOffers() as $offer)
                                            <p class="text-[rgba(99,102,241,0.7)] [&>*]:text-foreground">{!! $offer !!}</p>
                                        @endforeach
                                    </div>
                                @endif

                                {!! view_render_event('bagisto.shop.products.price.after', ['product' => $product]) !!}

                                <!-- Short Description -->
                                {!! view_render_event('bagisto.shop.products.short_description.before', ['product' => $product]) !!}

                                <p class="kvpd-short-desc max-sm:text-sm">
                                    {!! $product->short_description !!}
                                </p>

                                {!! view_render_event('bagisto.shop.products.short_description.after', ['product' => $product]) !!}

                                <div class="kvpd-divider"></div>

                                <!-- Product Types -->
                                @include('shop::products.view.types.configurable')
                                @include('shop::products.view.types.grouped')
                                @include('shop::products.view.types.bundle')
                                @include('shop::products.view.types.downloadable')

                                <!-- Actions: Qty + Add to Cart -->
                                <div class="mt-6 flex max-w-[470px] gap-3 max-sm:mt-4">

                                    {!! view_render_event('bagisto.shop.products.view.quantity.before', ['product' => $product]) !!}

                                    @if ($product->getTypeInstance()->showQuantityBox())
                                        <x-shop::quantity-changer
                                            name="quantity"
                                            value="1"
                                            class="gap-x-4 rounded-xl border border-[rgba(226,232,240,0.7)] bg-white/90 px-6 py-3.5 max-sm:gap-x-4 max-sm:rounded-lg max-sm:px-4 max-sm:py-2"
                                        />
                                    @endif

                                    {!! view_render_event('bagisto.shop.products.view.quantity.after', ['product' => $product]) !!}

                                    @if (core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                                        {!! view_render_event('bagisto.shop.products.view.add_to_cart.before', ['product' => $product]) !!}

                                        <x-shop::button
                                            type="submit"
                                            class="secondary-button w-full max-w-full max-md:py-3 max-sm:rounded-lg max-sm:py-2"
                                            button-type="secondary-button"
                                            :loading="false"
                                            :title="trans('shop::app.products.view.add-to-cart')"
                                            :disabled="! $product->isSaleable(1)"
                                            ::loading="isStoring.addToCart"
                                        />

                                        {!! view_render_event('bagisto.shop.products.view.add_to_cart.after', ['product' => $product]) !!}
                                    @endif
                                </div>

                                <!-- Buy Now -->
                                @if (core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                                    {!! view_render_event('bagisto.shop.products.view.buy_now.before', ['product' => $product]) !!}

                                    @if (core()->getConfigData('catalog.products.storefront.buy_now_button_display'))
                                        <x-shop::button
                                            type="submit"
                                            class="primary-button mt-3 w-full max-w-[470px] max-md:py-3 max-sm:rounded-lg max-sm:py-2"
                                            button-type="primary-button"
                                            :title="trans('shop::app.products.view.buy-now')"
                                            :disabled="! $product->isSaleable(1)"
                                            ::loading="isStoring.buyNow"
                                            @click="is_buy_now=1;"
                                        />
                                    @endif

                                    {!! view_render_event('bagisto.shop.products.view.buy_now.after', ['product' => $product]) !!}
                                @endif

                                {!! view_render_event('bagisto.shop.products.view.additional_actions.before', ['product' => $product]) !!}

                                <!-- Compare -->
                                <div class="mt-6 flex gap-6 max-md:mt-4 max-sm:gap-3">
                                    {!! view_render_event('bagisto.shop.products.view.compare.before', ['product' => $product]) !!}

                                    @if (core()->getConfigData('catalog.products.settings.compare_option'))
                                        <div
                                            class="kvpd-compare-btn"
                                            role="button"
                                            tabindex="0"
                                            @click="is_buy_now=0; addToCompare({{ $product->id }})"
                                        >
                                            <span class="icon-compare text-xl" role="presentation"></span>
                                            @lang('shop::app.products.view.compare')
                                        </div>
                                    @endif

                                    {!! view_render_event('bagisto.shop.products.view.compare.after', ['product' => $product]) !!}
                                </div>

                                {!! view_render_event('bagisto.shop.products.view.additional_actions.after', ['product' => $product]) !!}
                            </div>
                        </div>
                    </div>
                </form>
            </x-shop::form>
        </script>

        <script type="module">
            app.component('v-product', {
                template: '#v-product-template',

                data() {
                    return {
                        isWishlist: Boolean("{{ (boolean) auth()->guard()->user()?->wishlist_items->where('channel_id', core()->getCurrentChannel()->id)->where('product_id', $product->id)->count() }}"),

                        isCustomer: '{{ auth()->guard("customer")->check() }}',

                        is_buy_now: 0,

                        isStoring: {
                            addToCart: false,
                            buyNow: false,
                        },
                    }
                },

                methods: {
                    addToCart(params) {
                        const operation = this.is_buy_now ? 'buyNow' : 'addToCart';
                        this.isStoring[operation] = true;

                        let formData = new FormData(this.$refs.formData);
                        this.ensureQuantity(formData);

                        this.$axios.post('{{ route("shop.api.checkout.cart.store") }}', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            })
                            .then(response => {
                                if (response.data.message) {
                                    this.$emitter.emit('update-mini-cart', response.data.data);
                                    this.$emitter.emit('add-flash', {
                                        type: 'success',
                                        message: response.data.message
                                    });
                                    if (response.data.redirect) {
                                        window.location.href = response.data.redirect;
                                    }
                                } else {
                                    this.$emitter.emit('add-flash', {
                                        type: 'warning',
                                        message: response.data.data.message
                                    });
                                }
                                this.isStoring[operation] = false;
                            })
                            .catch(error => {
                                this.isStoring[operation] = false;
                                this.$emitter.emit('add-flash', {
                                    type: 'warning',
                                    message: error.response.data.message
                                });
                            });
                    },

                    addToWishlist() {
                        if (this.isCustomer) {
                            this.$axios.post('{{ route("shop.api.customers.account.wishlist.store") }}', {
                                    product_id: "{{ $product->id }}"
                                })
                                .then(response => {
                                    this.isWishlist = !this.isWishlist;
                                    this.$emitter.emit('add-flash', {
                                        type: 'success',
                                        message: response.data.data.message
                                    });
                                })
                                .catch(error => {});
                        } else {
                            window.location.href = "{{ route('shop.customer.session.index')}}";
                        }
                    },

                    addToCompare(productId) {
                        if (this.isCustomer) {
                            this.$axios.post('{{ route("shop.api.compare.store") }}', {
                                    'product_id': productId
                                })
                                .then(response => {
                                    this.$emitter.emit('add-flash', {
                                        type: 'success',
                                        message: response.data.data.message
                                    });
                                })
                                .catch(error => {
                                    if ([400, 422].includes(error.response.status)) {
                                        this.$emitter.emit('add-flash', {
                                            type: 'warning',
                                            message: error.response.data.data.message
                                        });
                                        return;
                                    }
                                    this.$emitter.emit('add-flash', {
                                        type: 'error',
                                        message: error.response.data.message
                                    });
                                });
                            return;
                        }

                        let existingItems = this.getStorageValue(this.getCompareItemsStorageKey()) ?? [];
                        if (existingItems.length) {
                            if (!existingItems.includes(productId)) {
                                existingItems.push(productId);
                                this.setStorageValue(this.getCompareItemsStorageKey(), existingItems);
                                this.$emitter.emit('add-flash', {
                                    type: 'success',
                                    message: "@lang('shop::app.products.view.add-to-compare')"
                                });
                            } else {
                                this.$emitter.emit('add-flash', {
                                    type: 'warning',
                                    message: "@lang('shop::app.products.view.already-in-compare')"
                                });
                            }
                        } else {
                            this.setStorageValue(this.getCompareItemsStorageKey(), [productId]);
                            this.$emitter.emit('add-flash', {
                                type: 'success',
                                message: "@lang('shop::app.products.view.add-to-compare')"
                            });
                        }
                    },

                    getCompareItemsStorageKey() {
                        return 'compare_items';
                    },
                    setStorageValue(key, value) {
                        localStorage.setItem(key, JSON.stringify(value));
                    },
                    getStorageValue(key) {
                        let value = localStorage.getItem(key);
                        if (value) {
                            value = JSON.parse(value);
                        }
                        return value;
                    },

                    scrollToReview() {
                        let accordianElement = document.querySelector('#review-accordian-button');
                        if (accordianElement) {
                            accordianElement.click();
                            accordianElement.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                        let tabElement = document.querySelector('#review-tab-button');
                        if (tabElement) {
                            tabElement.click();
                            tabElement.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    },

                    ensureQuantity(formData) {
                        if (!formData.has('quantity')) {
                            formData.append('quantity', 1);
                        }
                    },
                },
            });
        </script>
        @endPushOnce
</x-shop::layouts>
