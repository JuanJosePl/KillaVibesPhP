<div class="w-[418px] max-w-full max-md:w-full">
    {!! view_render_event('bagisto.shop.checkout.cart.summary.title.before') !!}

    <!-- Summary Header -->
    <div class="mb-6 flex items-center gap-3 max-md:mb-3">
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-[rgba(99,102,241,0.12)] to-[rgba(34,211,238,0.12)]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#6366f1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <p
            class="text-xl font-bold tracking-tight text-[var(--foreground)] max-md:text-base"
            role="heading"
            aria-level="1"
        >
            @lang('shop::app.checkout.cart.summary.cart-summary')
        </p>
    </div>

    {!! view_render_event('bagisto.shop.checkout.cart.summary.title.after') !!}

    <!-- Summary Card -->
    <div class="rounded-2xl border border-[rgba(226,232,240,0.7)] bg-[rgba(255,255,255,0.6)] p-5 backdrop-blur-sm max-md:rounded-xl max-md:p-4">

        <!-- Cart Totals -->
        <div class="grid gap-3.5 max-md:gap-2.5">

            <!-- Estimate Tax and Shipping -->
            @if (core()->getConfigData('sales.checkout.shopping_cart.estimate_shipping'))
                <template v-if="cart.have_stockable_items">
                    @include('shop::checkout.cart.summary.estimate-shipping')
                </template>
            @endif

            <!-- Sub Total -->
            {!! view_render_event('bagisto.shop.checkout.cart.summary.sub_total.before') !!}

            <template v-if="displayTax.subtotal == 'including_tax'">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-[var(--muted-foreground)] max-sm:text-xs">
                        @lang('shop::app.checkout.cart.summary.sub-total')
                    </p>
                    <p class="text-sm font-semibold text-[var(--foreground)] max-sm:text-xs">
                        @{{ cart.formatted_sub_total_incl_tax }}
                    </p>
                </div>
            </template>

            <template v-else-if="displayTax.subtotal == 'both'">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-[var(--muted-foreground)] max-sm:text-xs">
                        @lang('shop::app.checkout.cart.summary.sub-total-excl-tax')
                    </p>
                    <p class="text-sm font-semibold text-[var(--foreground)] max-sm:text-xs">
                        @{{ cart.formatted_sub_total }}
                    </p>
                </div>

                <div class="flex items-center justify-between">
                    <p class="text-sm text-[var(--muted-foreground)] max-sm:text-xs">
                        @lang('shop::app.checkout.cart.summary.sub-total-incl-tax')
                    </p>
                    <p class="text-sm font-semibold text-[var(--foreground)] max-sm:text-xs">
                        @{{ cart.formatted_sub_total_incl_tax }}
                    </p>
                </div>
            </template>

            <template v-else>
                <div class="flex items-center justify-between">
                    <p class="text-sm text-[var(--muted-foreground)] max-sm:text-xs">
                        @lang('shop::app.checkout.cart.summary.sub-total')
                    </p>
                    <p class="text-sm font-semibold text-[var(--foreground)] max-sm:text-xs">
                        @{{ cart.formatted_sub_total }}
                    </p>
                </div>
            </template>

            {!! view_render_event('bagisto.shop.checkout.cart.summary.sub_total.after') !!}

            <!-- Discount -->
            {!! view_render_event('bagisto.shop.checkout.cart.summary.discount_amount.before') !!}

            <div
                class="flex items-center justify-between rounded-lg bg-[rgba(34,197,94,0.06)] px-3 py-2"
                v-if="cart.discount_amount && parseFloat(cart.discount_amount) > 0"
            >
                <p class="flex items-center gap-1.5 text-sm text-[#16a34a] max-sm:text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    @lang('shop::app.checkout.cart.summary.discount-amount')
                </p>
                <p class="text-sm font-bold text-[#16a34a] max-sm:text-xs">
                    -@{{ cart.formatted_discount_amount }}
                </p>
            </div>

            {!! view_render_event('bagisto.shop.checkout.cart.summary.discount_amount.after') !!}

            <!-- Apply Coupon -->
            {!! view_render_event('bagisto.shop.checkout.cart.summary.coupon.before') !!}

            @include('shop::checkout.coupon')

            {!! view_render_event('bagisto.shop.checkout.cart.summary.coupon.after') !!}

            <!-- Divider -->
            <div class="border-t border-[rgba(226,232,240,0.7)]"></div>

            <!-- Shipping Rates -->
            {!! view_render_event('bagisto.shop.checkout.onepage.summary.delivery_charges.before') !!}

            <template v-if="displayTax.shipping == 'including_tax'">
                <div class="flex items-center justify-between">
                    <p class="flex items-center gap-1.5 text-sm text-[var(--muted-foreground)] max-sm:text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-[#6366f1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                        </svg>
                        @lang('shop::app.checkout.cart.summary.delivery-charges')
                    </p>
                    <p class="text-sm font-semibold text-[var(--foreground)] max-sm:text-xs">
                        @{{ cart.formatted_shipping_amount_incl_tax }}
                    </p>
                </div>
            </template>

            <template v-else-if="displayTax.shipping == 'both'">
                <div class="flex items-center justify-between">
                    <p class="flex items-center gap-1.5 text-sm text-[var(--muted-foreground)] max-sm:text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-[#6366f1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                        </svg>
                        @lang('shop::app.checkout.cart.summary.delivery-charges-excl-tax')
                    </p>
                    <p class="text-sm font-semibold text-[var(--foreground)] max-sm:text-xs">
                        @{{ cart.formatted_shipping_amount }}
                    </p>
                </div>

                <div class="flex items-center justify-between">
                    <p class="flex items-center gap-1.5 text-sm text-[var(--muted-foreground)] max-sm:text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-[#6366f1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                        </svg>
                        @lang('shop::app.checkout.cart.summary.delivery-charges-incl-tax')
                    </p>
                    <p class="text-sm font-semibold text-[var(--foreground)] max-sm:text-xs">
                        @{{ cart.formatted_shipping_amount_incl_tax }}
                    </p>
                </div>
            </template>

            <template v-else>
                <div class="flex items-center justify-between">
                    <p class="flex items-center gap-1.5 text-sm text-[var(--muted-foreground)] max-sm:text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-[#6366f1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                        </svg>
                        @lang('shop::app.checkout.cart.summary.delivery-charges')
                    </p>
                    <p class="text-sm font-semibold text-[var(--foreground)] max-sm:text-xs">
                        @{{ cart.formatted_shipping_amount }}
                    </p>
                </div>
            </template>

            {!! view_render_event('bagisto.shop.checkout.onepage.summary.delivery_charges.after') !!}

            <!-- Taxes -->
            {!! view_render_event('bagisto.shop.checkout.cart.summary.tax.before') !!}

            <div
                class="flex items-center justify-between"
                v-if="! cart.tax_total"
            >
                <p class="text-sm text-[var(--muted-foreground)] max-sm:text-xs">
                    @lang('shop::app.checkout.cart.summary.tax')
                </p>
                <p class="text-sm font-semibold text-[var(--foreground)] max-sm:text-xs">
                    @{{ cart.formatted_tax_total }}
                </p>
            </div>

            <div
                class="flex flex-col gap-2 rounded-xl border border-[rgba(226,232,240,0.7)] p-3"
                v-else
            >
                <div
                    class="flex cursor-pointer items-center justify-between"
                    @click="cart.show_taxes = ! cart.show_taxes"
                >
                    <p class="text-sm text-[var(--muted-foreground)] max-sm:text-xs">
                        @lang('shop::app.checkout.cart.summary.tax')
                    </p>
                    <p class="flex items-center gap-1.5 text-sm font-semibold text-[var(--foreground)] max-sm:text-xs">
                        @{{ cart.formatted_tax_total }}
                        <span
                            class="text-base text-[#6366f1]"
                            :class="{'icon-arrow-up': cart.show_taxes, 'icon-arrow-down': ! cart.show_taxes}"
                        ></span>
                    </p>
                </div>

                <div
                    class="flex flex-col gap-1.5"
                    v-show="cart.show_taxes"
                >
                    <div
                        class="flex items-center justify-between gap-1"
                        v-for="(amount, index) in cart.applied_taxes"
                    >
                        <p class="text-xs text-[var(--muted-foreground)]">
                            @{{ index }}
                        </p>
                        <p class="text-xs font-semibold text-[var(--foreground)]">
                            @{{ amount }}
                        </p>
                    </div>
                </div>
            </div>

            {!! view_render_event('bagisto.shop.checkout.cart.summary.tax.after') !!}

            <!-- Grand Total -->
            {!! view_render_event('bagisto.shop.checkout.cart.summary.grand_total.before') !!}

            <div class="mt-1 flex items-center justify-between rounded-xl bg-gradient-to-r from-[rgba(99,102,241,0.07)] to-[rgba(34,211,238,0.07)] px-4 py-3.5">
                <p class="text-base font-bold text-[var(--foreground)] max-md:text-sm">
                    @lang('shop::app.checkout.cart.summary.grand-total')
                </p>
                <p class="text-xl font-extrabold text-[#6366f1] max-md:text-base">
                    @{{ cart.formatted_grand_total }}
                </p>
            </div>

            {!! view_render_event('bagisto.shop.checkout.cart.summary.grand_total.after') !!}

            {!! view_render_event('bagisto.shop.checkout.cart.summary.proceed_to_checkout.before') !!}

            <a
                href="{{ route('shop.checkout.onepage.index') }}"
                class="primary-button mt-3 block w-full rounded-2xl bg-gradient-to-r from-[#6366f1] to-[#22d3ee] px-11 py-3.5 text-center text-sm font-bold text-white shadow-[0_4px_16px_rgba(99,102,241,0.30)] transition-all duration-300 hover:scale-[1.02] hover:shadow-[0_8px_24px_rgba(99,102,241,0.40)] max-md:my-3 max-md:rounded-xl max-md:py-3 max-md:text-sm max-sm:w-full max-sm:py-2.5"
            >
                @lang('shop::app.checkout.cart.summary.proceed-to-checkout')
            </a>

            {!! view_render_event('bagisto.shop.checkout.cart.summary.proceed_to_checkout.after') !!}
        </div>
    </div>

    <!-- Trust badges -->
    <div class="mt-4 flex items-center justify-center gap-4 max-md:gap-3">
        <div class="flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#22c55e]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <span class="text-[10px] font-medium text-[var(--muted-foreground)]">100% Seguro</span>
        </div>
        <div class="h-3 w-px bg-[var(--border)]"></div>
        <div class="flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#6366f1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <span class="text-[10px] font-medium text-[var(--muted-foreground)]">Pago Seguro</span>
        </div>
        <div class="h-3 w-px bg-[var(--border)]"></div>
        <div class="flex items-center gap-1.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#f97316]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
            </svg>
            <span class="text-[10px] font-medium text-[var(--muted-foreground)]">Envío Rápido</span>
        </div>
    </div>
</div>
