<!-- SEO Meta Content -->
@push('meta')
    <meta name="description" content="@lang('shop::app.checkout.cart.index.cart')"/>
    <meta name="keywords" content="@lang('shop::app.checkout.cart.index.cart')"/>
@endPush

@push('styles')
<style>
    /* ── Cart page animations ─────────────────────────────── */
    @keyframes kvCartFadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes kvPulse {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.55; }
    }

    .kv-cart-root {
        min-height: 100vh;
        background: linear-gradient(135deg, rgba(99,102,241,0.04) 0%, var(--background) 50%, rgba(34,211,238,0.03) 100%);
        position: relative;
    }

    /* ── Header ──────────────────────────────────────────── */
    .kv-cart-header {
        position: sticky; top: 0; z-index: 40;
        background: rgba(var(--background-rgb, 255,255,255), 0.85);
        backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(226,232,240,0.6);
        box-shadow: 0 2px 20px rgba(99,102,241,0.06);
    }

    /* ── Item card ───────────────────────────────────────── */
    .kv-cart-item {
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        border: 1.5px solid rgba(226,232,240,0.65);
        border-radius: 1.25rem;
        padding: 1.25rem;
        transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
        animation: kvCartFadeUp 0.5s ease-out both;
    }
    .kv-cart-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(99,102,241,0.12);
        border-color: rgba(99,102,241,0.25);
    }

    /* ── Quantity changer override ───────────────────────── */
    .kv-qty-wrap .x-quantity-changer {
        border-color: rgba(99,102,241,0.30) !important;
        border-radius: 9999px !important;
        background: rgba(99,102,241,0.04) !important;
    }

    /* ── Action buttons ──────────────────────────────────── */
    .kv-cart-btn-primary {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.75rem 1.75rem; border-radius: 9999px;
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        color: #fff; font-weight: 700; font-size: 0.875rem;
        text-decoration: none; border: none; cursor: pointer;
        box-shadow: 0 4px 16px rgba(99,102,241,0.30);
        transition: transform 0.25s, box-shadow 0.25s;
    }
    .kv-cart-btn-primary:hover {
        transform: scale(1.04);
        box-shadow: 0 8px 24px rgba(99,102,241,0.42);
        color: #fff;
    }
    .kv-cart-btn-secondary {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.75rem 1.75rem; border-radius: 9999px;
        border: 1.5px solid rgba(99,102,241,0.30);
        color: #6366f1; font-weight: 700; font-size: 0.875rem;
        background: transparent; cursor: pointer; text-decoration: none;
        transition: background 0.25s, color 0.25s, transform 0.25s;
    }
    .kv-cart-btn-secondary:hover {
        background: rgba(99,102,241,0.07);
        transform: scale(1.03);
    }

    /* ── Checkbox custom ─────────────────────────────────── */
    .kv-check-label {
        color: rgba(99,102,241,0.55);
        transition: color 0.2s;
    }
    .kv-check-label.peer-checked\:text-indigo { color: #6366f1 !important; }

    /* ── Section badge ───────────────────────────────────── */
    .kv-cart-section-badge {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.09), rgba(34,211,238,0.09));
        padding: 0.45rem 1rem; border-radius: 9999px;
        border: 1px solid rgba(99,102,241,0.18);
        font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em;
        background-clip: text; -webkit-background-clip: text;
    }
    .kv-cart-section-badge span {
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }

    /* ── Orb decorations ─────────────────────────────────── */
    .kv-orb {
        position: absolute; border-radius: 9999px;
        filter: blur(72px); pointer-events: none; z-index: 0;
    }

    /* ── Empty cart ──────────────────────────────────────── */
    .kv-empty-cart {
        display: flex; flex-direction: column; align-items: center;
        justify-content: center; padding: 6rem 1.5rem;
        text-align: center; animation: kvCartFadeUp 0.6s ease-out both;
    }

    /* ── Error banner ────────────────────────────────────── */
    .kv-cart-error {
        border-left: 4px solid #f97316;
        background: rgba(249,115,22,0.07);
        border-radius: 0.75rem;
        padding: 0.875rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #c2410c;
        margin-top: 1.25rem;
        display: flex; align-items: center; gap: 0.625rem;
    }
</style>
@endpush

<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.checkout.cart.index.cart')
    </x-slot>

    <div class="kv-cart-root">

        <!-- Orbes decorativos de fondo -->
        <div class="kv-orb" style="top:-6rem;right:-6rem;width:24rem;height:24rem;background:radial-gradient(circle,rgba(99,102,241,0.12),rgba(34,211,238,0.06));"></div>
        <div class="kv-orb" style="bottom:10rem;left:-6rem;width:20rem;height:20rem;background:radial-gradient(circle,rgba(34,211,238,0.10),rgba(99,102,241,0.05));"></div>

        {!! view_render_event('bagisto.shop.checkout.cart.header.before') !!}

        <!-- ══════════════════════════════════════
             HEADER sticky
        ══════════════════════════════════════ -->
        <header class="kv-cart-header">
            <div class="flex items-center justify-between px-16 py-4 max-lg:px-8 max-md:px-4">
                <div class="flex items-center gap-x-14 max-[1180px]:gap-x-9">
                    {!! view_render_event('bagisto.shop.checkout.cart.logo.before') !!}

                    <a
                        href="{{ route('shop.home.index') }}"
                        class="flex min-h-[30px] items-center"
                        aria-label="@lang('shop::app.checkout.cart.index.bagisto')"
                    >
                        <img
                            src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                            alt="{{ config('app.name') }}"
                            width="131"
                            height="29"
                        >
                    </a>

                    {!! view_render_event('bagisto.shop.checkout.cart.logo.after') !!}
                </div>

                @guest('customer')
                    @include('shop::checkout.login')
                @endguest
            </div>
        </header>

        {!! view_render_event('bagisto.shop.checkout.cart.header.after') !!}

        <!-- ══════════════════════════════════════
             MAIN CONTENT
        ══════════════════════════════════════ -->
        <div class="flex-auto">
            <div class="relative z-10 mx-auto max-w-[1400px] px-16 max-lg:px-8 max-md:px-4">

                {!! view_render_event('bagisto.shop.checkout.cart.breadcrumbs.before') !!}

                @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
                    <div class="pt-5">
                        <x-shop::breadcrumbs name="cart" />
                    </div>
                @endif

                {!! view_render_event('bagisto.shop.checkout.cart.breadcrumbs.after') !!}

                @php
                    $errors = Cart::getErrors();
                @endphp

                @if (! empty($errors) && $errors['error_code'] === 'MINIMUM_ORDER_AMOUNT')
                    <div class="kv-cart-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        {{ $errors['message'] }}: {{ $errors['amount'] }}
                    </div>
                @endif

                <v-cart ref="vCart">
                    <!-- Cart Shimmer Effect -->
                    <x-shop::shimmer.checkout.cart :count="3" />
                </v-cart>

            </div>
        </div>

        <!-- Cross-sell -->
        @if (core()->getConfigData('sales.checkout.shopping_cart.cross_sell'))
            {!! view_render_event('bagisto.shop.checkout.cart.cross_sell_carousel.before') !!}

            <div class="relative z-10 mt-8">
                <x-shop::products.carousel
                    :title="trans('shop::app.checkout.cart.index.cross-sell.title')"
                    :src="route('shop.api.checkout.cart.cross-sell.index')"
                >
                </x-shop::products.carousel>
            </div>

            {!! view_render_event('bagisto.shop.checkout.cart.cross_sell_carousel.after') !!}
        @endif

    </div><!-- /kv-cart-root -->

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-cart-template"
        >
            <div>
                <!-- Cart Shimmer -->
                <template v-if="isLoading">
                    <x-shop::shimmer.checkout.cart :count="3" />
                </template>

                <!-- Cart Content -->
                <template v-else>

                    <!-- ── CART WITH ITEMS ──────────────────────────── -->
                    <div
                        class="mt-8 flex flex-wrap gap-10 pb-12 max-1060:flex-col max-md:mt-4 max-md:gap-6 max-md:pb-6"
                        v-if="cart?.items?.length"
                    >
                        <!-- LEFT COL: Items -->
                        <div class="flex flex-1 flex-col gap-5 max-md:gap-4">

                            {!! view_render_event('bagisto.shop.checkout.cart.cart_mass_actions.before') !!}

                            <!-- Mass Actions Bar -->
                            <div class="flex items-center justify-between rounded-xl border border-[rgba(226,232,240,0.6)] bg-[rgba(255,255,255,0.55)] px-4 py-3 backdrop-blur-sm max-md:px-3 max-md:py-2">
                                <div class="flex select-none items-center gap-2.5">
                                    <input
                                        type="checkbox"
                                        id="select-all"
                                        class="peer hidden"
                                        v-model="allSelected"
                                        @change="selectAll"
                                    >
                                    <label
                                        class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-[rgba(99,102,241,0.45)] peer-checked:text-[#6366f1] transition-colors"
                                        for="select-all"
                                        tabindex="0"
                                        aria-label="@lang('shop::app.checkout.cart.index.select-all')"
                                    ></label>
                                    <span class="text-sm font-semibold text-[var(--foreground)] max-sm:text-xs">
                                        @{{ "@lang('shop::app.checkout.cart.index.items-selected')".replace(':count', selectedItemsCount) }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-3" v-if="selectedItemsCount">
                                    <button
                                        class="flex items-center gap-1.5 text-xs font-semibold text-[var(--muted-foreground)] transition-colors hover:text-[#ef4444]"
                                        role="button"
                                        tabindex="0"
                                        @click="removeSelectedItems"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        @lang('shop::app.checkout.cart.index.remove')
                                    </button>

                                    @if (auth()->guard()->check())
                                        <div class="h-3.5 w-px bg-[var(--border)]"></div>
                                        <button
                                            class="flex items-center gap-1.5 text-xs font-semibold text-[var(--muted-foreground)] transition-colors hover:text-[#6366f1]"
                                            role="button"
                                            tabindex="0"
                                            @click="moveToWishlistSelectedItems"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                            @lang('shop::app.checkout.cart.index.move-to-wishlist')
                                        </button>
                                    @endif
                                </div>
                            </div>

                            {!! view_render_event('bagisto.shop.checkout.cart.cart_mass_actions.after') !!}

                            {!! view_render_event('bagisto.shop.checkout.cart.item.listing.before') !!}

                            <!-- Items List -->
                            <div
                                class="grid gap-y-4"
                                v-for="item in cart?.items"
                            >
                                <div class="kv-cart-item">
                                    <div class="flex items-start justify-between gap-3">

                                        <!-- Left: checkbox + image + info -->
                                        <div class="flex items-start gap-4 max-md:gap-3">

                                            <!-- Checkbox -->
                                            <div class="mt-12 select-none max-md:mt-9 max-sm:mt-7">
                                                <input
                                                    type="checkbox"
                                                    :id="'item_' + item.id"
                                                    class="peer hidden"
                                                    v-model="item.selected"
                                                    @change="updateAllSelected"
                                                >
                                                <label
                                                    class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-[rgba(99,102,241,0.40)] peer-checked:text-[#6366f1] transition-colors"
                                                    :for="'item_' + item.id"
                                                    tabindex="0"
                                                    aria-label="@lang('shop::app.checkout.cart.index.select-cart-item')"
                                                ></label>
                                            </div>

                                            {!! view_render_event('bagisto.shop.checkout.cart.item_image.before') !!}

                                            <!-- Image -->
                                            <a :href="`{{ route('shop.product_or_category.index', '') }}/${item.product_url_key}`" class="flex-shrink-0">
                                                <x-shop::media.images.lazy
                                                    class="h-[110px] w-[110px] rounded-xl object-cover transition-transform duration-300 hover:scale-105 max-md:h-[76px] max-md:w-[76px]"
                                                    ::src="item.base_image.small_image_url"
                                                    ::alt="item.name"
                                                    width="110"
                                                    height="110"
                                                    ::key="item.id"
                                                    ::index="item.id"
                                                />
                                            </a>

                                            {!! view_render_event('bagisto.shop.checkout.cart.item_image.after') !!}

                                            <!-- Info -->
                                            <div class="grid place-content-start gap-y-2 max-md:gap-y-1">

                                                {!! view_render_event('bagisto.shop.checkout.cart.item_name.before') !!}

                                                <a :href="`{{ route('shop.product_or_category.index', '') }}/${item.product_url_key}`">
                                                    <p class="text-sm font-semibold leading-snug text-[var(--foreground)] transition-colors hover:text-[#6366f1] max-sm:text-xs">
                                                        @{{ item.name }}
                                                    </p>
                                                </a>

                                                {!! view_render_event('bagisto.shop.checkout.cart.item_name.after') !!}
                                                {!! view_render_event('bagisto.shop.checkout.cart.item_details.before') !!}

                                                <!-- Options -->
                                                <div
                                                    class="grid select-none gap-x-2 gap-y-1"
                                                    v-if="item.options.length"
                                                >
                                                    <p
                                                        class="flex cursor-pointer items-center gap-2 text-xs font-medium text-[var(--muted-foreground)] transition-colors hover:text-[#6366f1]"
                                                        @click="item.option_show = ! item.option_show"
                                                    >
                                                        @lang('shop::app.checkout.cart.index.see-details')
                                                        <span
                                                            class="text-base"
                                                            :class="{'icon-arrow-up': item.option_show, 'icon-arrow-down': ! item.option_show}"
                                                        ></span>
                                                    </p>

                                                    <div
                                                        class="grid gap-1.5 rounded-lg bg-[rgba(99,102,241,0.04)] px-3 py-2"
                                                        v-show="item.option_show"
                                                    >
                                                        <template v-for="option in item.options">
                                                            <div class="flex items-center gap-1.5 max-md:grid max-md:gap-0">
                                                                <p class="text-xs font-semibold text-[var(--muted-foreground)]">
                                                                    @{{ option.attribute_name + ':' }}
                                                                </p>
                                                                <p class="text-xs text-[var(--foreground)]">
                                                                    @{{ option.option_label }}
                                                                </p>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>

                                                {!! view_render_event('bagisto.shop.checkout.cart.item_details.after') !!}
                                                {!! view_render_event('bagisto.shop.checkout.cart.formatted_total.before') !!}

                                                <!-- Price (mobile) -->
                                                <div class="md:hidden">
                                                    <p class="text-base font-bold text-[#6366f1] max-md:text-sm">
                                                        @{{ item.formatted_total }}
                                                    </p>
                                                </div>

                                                {!! view_render_event('bagisto.shop.checkout.cart.formatted_total.after') !!}
                                                {!! view_render_event('bagisto.shop.checkout.cart.quantity_changer.before') !!}

                                                <!-- Quantity + Remove (mobile) -->
                                                <div class="flex items-center gap-3 max-md:mt-1.5">
                                                    <x-shop::quantity-changer
                                                        class="flex max-w-max items-center gap-x-2 rounded-full border border-[rgba(99,102,241,0.25)] bg-[rgba(99,102,241,0.04)] px-3.5 py-1.5 text-sm max-md:gap-x-1.5 max-md:px-2 max-md:py-0.5"
                                                        name="quantity"
                                                        ::value="item?.quantity"
                                                        @change="setItemQuantity(item.id, $event)"
                                                    />

                                                    <!-- Mobile remove -->
                                                    <button
                                                        class="hidden items-center gap-1 text-xs font-medium text-[var(--muted-foreground)] transition-colors hover:text-[#ef4444] max-md:flex"
                                                        role="button"
                                                        tabindex="0"
                                                        @click="removeItem(item.id)"
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        @lang('shop::app.checkout.cart.index.remove')
                                                    </button>
                                                </div>

                                                {!! view_render_event('bagisto.shop.checkout.cart.quantity_changer.after') !!}
                                            </div>
                                        </div>

                                        <!-- Right: price + remove (desktop) -->
                                        <div class="flex flex-col items-end gap-2 text-right max-md:hidden">
                                            {!! view_render_event('bagisto.shop.checkout.cart.total.before') !!}

                                            <template v-if="displayTax.prices == 'including_tax'">
                                                <p class="text-lg font-bold text-[#6366f1]">
                                                    @{{ item.formatted_total_incl_tax }}
                                                </p>
                                            </template>

                                            <template v-else-if="displayTax.prices == 'both'">
                                                <p class="flex flex-col text-lg font-bold text-[#6366f1]">
                                                    @{{ item.formatted_total_incl_tax }}
                                                    <span class="text-xs font-normal text-[var(--muted-foreground)]">
                                                        @lang('shop::app.checkout.cart.index.excl-tax')
                                                        <span class="font-semibold text-[var(--foreground)]">@{{ item.formatted_total }}</span>
                                                    </span>
                                                </p>
                                            </template>

                                            <template v-else>
                                                <p class="text-lg font-bold text-[#6366f1]">
                                                    @{{ item.formatted_total }}
                                                </p>
                                            </template>

                                            {!! view_render_event('bagisto.shop.checkout.cart.total.after') !!}
                                            {!! view_render_event('bagisto.shop.checkout.cart.remove_button.before') !!}

                                            <button
                                                class="flex items-center gap-1.5 text-xs font-medium text-[var(--muted-foreground)] transition-colors hover:text-[#ef4444]"
                                                role="button"
                                                tabindex="0"
                                                @click="removeItem(item.id)"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                @lang('shop::app.checkout.cart.index.remove')
                                            </button>

                                            {!! view_render_event('bagisto.shop.checkout.cart.remove_button.after') !!}
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {!! view_render_event('bagisto.shop.checkout.cart.item.listing.after') !!}

                            {!! view_render_event('bagisto.shop.checkout.cart.controls.before') !!}

                            <!-- Bottom Actions -->
                            <div class="flex flex-wrap items-center justify-end gap-4 pt-2 max-md:justify-between max-md:gap-3">
                                {!! view_render_event('bagisto.shop.checkout.cart.continue_shopping.before') !!}

                                <a
                                    class="kv-cart-btn-secondary max-md:text-xs"
                                    href="{{ route('shop.home.index') }}"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    @lang('shop::app.checkout.cart.index.continue-shopping')
                                </a>

                                {!! view_render_event('bagisto.shop.checkout.cart.continue_shopping.after') !!}
                                {!! view_render_event('bagisto.shop.checkout.cart.update_cart.before') !!}

                                <x-shop::button
                                    class="kv-cart-btn-primary max-md:text-xs"
                                    :title="trans('shop::app.checkout.cart.index.update-cart')"
                                    ::loading="isStoring"
                                    ::disabled="isStoring"
                                    @click="update()"
                                />

                                {!! view_render_event('bagisto.shop.checkout.cart.update_cart.after') !!}
                            </div>

                            {!! view_render_event('bagisto.shop.checkout.cart.controls.after') !!}
                        </div>

                        {!! view_render_event('bagisto.shop.checkout.cart.summary.before') !!}

                        <!-- Summary -->
                        @include('shop::checkout.cart.summary')

                        {!! view_render_event('bagisto.shop.checkout.cart.summary.after') !!}

                    </div>

                    <!-- ── EMPTY CART ──────────────────────────────── -->
                    <div
                        class="kv-empty-cart"
                        v-else
                    >
                        <div class="mb-6 flex h-28 w-28 items-center justify-center rounded-full bg-gradient-to-br from-[rgba(99,102,241,0.10)] to-[rgba(34,211,238,0.08)]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-[#6366f1] opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>

                        <img
                            class="hidden"
                            src="{{ bagisto_asset('images/thank-you.png') }}"
                            alt="@lang('shop::app.checkout.cart.index.empty-product')"
                        />

                        <p class="text-xl font-bold text-[var(--foreground)] max-md:text-base">
                            @lang('shop::app.checkout.cart.index.empty-product')
                        </p>
                        <p class="mt-2 text-sm text-[var(--muted-foreground)]">
                            Agrega productos para comenzar tu compra
                        </p>

                        <a
                            href="{{ route('shop.home.index') }}"
                            class="kv-cart-btn-primary mt-8"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Ir al inicio
                        </a>
                    </div>

                </template>
            </div>
        </script>

        <script type="module">
            app.component("v-cart", {
                template: '#v-cart-template',

                data() {
                    return  {
                        cart: [],

                        allSelected: false,

                        applied: {
                            quantity: {},
                        },

                        displayTax: {
                            prices: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_prices') }}",
                            subtotal: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_subtotal') }}",
                            shipping: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_shipping_amount') }}",
                        },

                        isLoading: true,

                        isStoring: false,
                    }
                },

                mounted() {
                    this.getCart();
                },

                computed: {
                    selectedItemsCount() {
                        return this.cart.items.filter(item => item.selected).length;
                    },
                },

                methods: {
                    getCart() {
                        this.$axios.get('{{ route('shop.api.checkout.cart.index') }}')
                            .then(response => {
                                this.cart = response.data.data;
                                this.isLoading = false;
                                if (response.data.message) {
                                    this.$emitter.emit('add-flash', { type: 'info', message: response.data.message });
                                }
                            })
                            .catch(error => {});
                    },

                    setCart(cart) {
                        this.cart = cart;
                    },

                    selectAll() {
                        for (let item of this.cart.items) {
                            item.selected = this.allSelected;
                        }
                    },

                    updateAllSelected() {
                        this.allSelected = this.cart.items.every(item => item.selected);
                    },

                    update() {
                        this.isStoring = true;

                        this.$axios.put('{{ route('shop.api.checkout.cart.update') }}', { qty: this.applied.quantity })
                            .then(response => {
                                this.cart = response.data.data;
                                if (response.data.message) {
                                    this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });
                                } else {
                                    this.$emitter.emit('add-flash', { type: 'warning', message: response.data.data.message });
                                }
                                this.isStoring = false;
                            })
                            .catch(error => {
                                this.isStoring = false;
                            });
                    },

                    setItemQuantity(itemId, quantity) {
                        this.applied.quantity[itemId] = quantity;
                    },

                    removeItem(itemId) {
                        this.$emitter.emit('open-confirm-modal', {
                            agree: () => {
                                this.$axios.post('{{ route('shop.api.checkout.cart.destroy') }}', {
                                    '_method': 'DELETE',
                                    'cart_item_id': itemId,
                                })
                                .then(response => {
                                    this.cart = response.data.data;
                                    this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });
                                })
                                .catch(error => {});
                            }
                        });
                    },

                    removeSelectedItems() {
                        this.$emitter.emit('open-confirm-modal', {
                            agree: () => {
                                const selectedItemsIds = this.cart.items.flatMap(item => item.selected ? item.id : []);

                                this.$axios.post('{{ route('shop.api.checkout.cart.destroy_selected') }}', {
                                    '_method': 'DELETE',
                                    'ids': selectedItemsIds,
                                })
                                .then(response => {
                                    this.cart = response.data.data;
                                    this.$emitter.emit('update-mini-cart', response.data.data);
                                    this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });
                                })
                                .catch(error => {});
                            }
                        });
                    },

                    moveToWishlistSelectedItems() {
                        this.$emitter.emit('open-confirm-modal', {
                            agree: () => {
                                const selectedItemsIds = this.cart.items.flatMap(item => item.selected ? item.id : []);
                                const selectedItemsQty = this.cart.items.filter(item => item.selected).map(item => this.applied.quantity[item.id] ?? item.quantity);

                                this.$axios.post('{{ route('shop.api.checkout.cart.move_to_wishlist') }}', {
                                    'ids': selectedItemsIds,
                                    'qty': selectedItemsQty
                                })
                                .then(response => {
                                    this.cart = response.data.data;
                                    this.$emitter.emit('update-mini-cart', response.data.data);
                                    this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });
                                })
                                .catch(error => {});
                            }
                        });
                    },
                }
            });
        </script>
    @endpushOnce
</x-shop::layouts>
