<!-- Mini Cart Vue Component -->
<v-mini-cart>
    <span
        class="icon-cart cursor-pointer text-2xl"
        role="button"
        aria-label="@lang('shop::app.checkout.cart.mini-cart.shopping-cart')"
    ></span>
</v-mini-cart>

@pushOnce('scripts')
    <script
        type="text/x-template"
        id="v-mini-cart-template"
    >
        {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.before') !!}

        @if (core()->getConfigData('sales.checkout.mini_cart.display_mini_cart'))
            <x-shop::drawer>
                <!-- Drawer Toggler -->
                <x-slot:toggle>
                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.toggle.before') !!}

                    <span class="relative">
                        <span
                            class="icon-cart cursor-pointer text-2xl transition-transform duration-200 hover:scale-110"
                            role="button"
                            aria-label="@lang('shop::app.checkout.cart.mini-cart.shopping-cart')"
                            tabindex="0"
                        ></span>

                        @if (core()->getConfigData('sales.checkout.my_cart.summary') == 'display_item_quantity')
                            <span
                                class="absolute -top-4 min-w-[1.35rem] rounded-full bg-gradient-to-r from-[#6366f1] to-[#22d3ee] px-1.5 py-1 text-center text-[10px] font-bold leading-[10px] text-white shadow-md ltr:left-4 max-md:ltr:left-3 rtl:right-4 max-md:rtl:right-3"
                                v-if="cart?.items_count"
                            >
                                @{{ cart.items_count }}
                            </span>
                        @else
                            <span
                                class="absolute -top-4 min-w-[1.35rem] rounded-full bg-gradient-to-r from-[#6366f1] to-[#22d3ee] px-1.5 py-1 text-center text-[10px] font-bold leading-[10px] text-white shadow-md ltr:left-4 max-md:ltr:left-3 rtl:right-4 max-md:rtl:right-3"
                                v-if="cart?.items_qty"
                            >
                                @{{ cart.items_qty }}
                            </span>
                        @endif
                    </span>

                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.toggle.after') !!}
                </x-slot>

                <!-- Drawer Header -->
                <x-slot:header>
                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.header.before') !!}

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-[rgba(99,102,241,0.12)] to-[rgba(34,211,238,0.12)]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#6366f1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <p class="text-xl font-bold tracking-tight text-[var(--foreground)] max-md:text-lg">
                                @lang('shop::app.checkout.cart.mini-cart.shopping-cart')
                            </p>
                        </div>
                    </div>

                    @if (core()->getConfigData('sales.checkout.mini_cart.offer_info'))
                        <div class="mt-3 flex items-center gap-2 rounded-xl border border-[rgba(34,197,94,0.2)] bg-[rgba(34,197,94,0.06)] px-3.5 py-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0 text-[#22c55e]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <p class="text-xs font-medium text-[#16a34a]">
                                {{ core()->getConfigData('sales.checkout.mini_cart.offer_info') }}
                            </p>
                        </div>
                    @endif

                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.header.after') !!}
                </x-slot>

                <!-- Drawer Content -->
                <x-slot:content>
                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.before') !!}

                    <!-- Cart Item Listing -->
                    <div
                        class="mt-6 grid gap-5 max-md:mt-3 max-md:gap-4"
                        v-if="cart?.items?.length"
                    >
                        <div
                            class="group flex gap-x-4 rounded-2xl border border-[rgba(226,232,240,0.6)] bg-[rgba(255,255,255,0.6)] p-3.5 backdrop-blur-sm transition-all duration-300 hover:border-[rgba(99,102,241,0.25)] hover:shadow-[0_4px_20px_rgba(99,102,241,0.10)] max-md:gap-x-3 max-md:p-3"
                            v-for="item in cart?.items"
                        >
                            <!-- Cart Item Image -->
                            {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.image.before') !!}

                            <div class="flex-shrink-0">
                                <a :href="`{{ route('shop.product_or_category.index', '') }}/${item.product_url_key}`">
                                    <img
                                        :src="item.base_image.small_image_url"
                                        class="h-24 w-24 rounded-xl object-cover transition-transform duration-300 group-hover:scale-105 max-md:h-[72px] max-md:w-[72px]"
                                    />
                                </a>
                            </div>

                            {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.image.after') !!}

                            <!-- Cart Item Information -->
                            <div class="grid flex-1 place-content-start justify-stretch gap-y-2">
                                <div class="flex items-start justify-between gap-2 max-sm:flex-wrap">

                                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.name.before') !!}

                                    <a
                                        class="max-w-[65%] max-md:max-w-full"
                                        :href="`{{ route('shop.product_or_category.index', '') }}/${item.product_url_key}`"
                                    >
                                        <p class="text-sm font-semibold leading-snug text-[var(--foreground)] transition-colors hover:text-[#6366f1] max-sm:text-xs">
                                            @{{ item.name }}
                                        </p>
                                    </a>

                                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.name.after') !!}
                                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.price.before') !!}

                                    <template v-if="displayTax.prices == 'including_tax'">
                                        <p class="text-sm font-bold text-[#6366f1] max-sm:text-xs">
                                            @{{ item.formatted_price_incl_tax }}
                                        </p>
                                    </template>

                                    <template v-else-if="displayTax.prices == 'both'">
                                        <p class="flex flex-col text-right text-sm font-bold text-[#6366f1] max-sm:text-xs">
                                            @{{ item.formatted_price_incl_tax }}
                                            <span class="text-xs font-normal text-[var(--muted-foreground)]">
                                                @lang('shop::app.checkout.cart.mini-cart.excl-tax')
                                                <span class="font-medium text-[var(--foreground)]">@{{ item.formatted_price }}</span>
                                            </span>
                                        </p>
                                    </template>

                                    <template v-else>
                                        <p class="text-sm font-bold text-[#6366f1] max-sm:text-xs">
                                            @{{ item.formatted_price }}
                                        </p>
                                    </template>

                                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.price.after') !!}
                                </div>

                                <!-- Cart Item Options Container -->
                                <div
                                    class="grid select-none gap-x-2 gap-y-1 max-sm:gap-y-0.5"
                                    v-if="item.options.length"
                                >
                                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.product_details.before') !!}

                                    <!-- Details Toggler -->
                                    <div>
                                        <p
                                            class="flex cursor-pointer items-center gap-x-2 text-xs font-medium text-[var(--muted-foreground)] transition-colors hover:text-[#6366f1] max-md:gap-x-1.5"
                                            @click="item.option_show = ! item.option_show"
                                        >
                                            @lang('shop::app.checkout.cart.mini-cart.see-details')
                                            <span
                                                class="text-base max-md:text-sm"
                                                :class="{'icon-arrow-up': item.option_show, 'icon-arrow-down': ! item.option_show}"
                                            ></span>
                                        </p>
                                    </div>

                                    <!-- Option Details -->
                                    <div
                                        class="grid gap-1.5 rounded-lg bg-[rgba(99,102,241,0.04)] p-2"
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

                                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.product_details.after') !!}
                                </div>

                                <div class="flex flex-wrap items-center gap-3 max-md:gap-2">
                                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.quantity_changer.before') !!}

                                    <!-- Cart Item Quantity Changer -->
                                    <x-shop::quantity-changer
                                        class="max-h-8 max-w-[130px] gap-x-2 rounded-full border-[rgba(99,102,241,0.2)] bg-[rgba(99,102,241,0.04)] px-3 py-1 text-sm max-md:gap-x-1.5 max-md:px-2 max-md:py-0.5"
                                        name="quantity"
                                        ::value="item?.quantity"
                                        @change="updateItem($event, item)"
                                    />

                                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.quantity_changer.after') !!}
                                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.remove_button.before') !!}

                                    <!-- Cart Item Remove Button -->
                                    <button
                                        type="button"
                                        class="flex items-center gap-1 text-xs font-medium text-[var(--muted-foreground)] transition-colors hover:text-[#ef4444]"
                                        @click="removeItem(item.id)"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        @lang('shop::app.checkout.cart.mini-cart.remove')
                                    </button>

                                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.remove_button.after') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty Cart Section -->
                    <div
                        class="flex flex-col items-center justify-center py-16 max-md:py-12"
                        v-else
                    >
                        <div class="mb-5 flex h-24 w-24 items-center justify-center rounded-full bg-gradient-to-br from-[rgba(99,102,241,0.08)] to-[rgba(34,211,238,0.08)]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#6366f1] opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <img
                            class="hidden"
                            src="{{ bagisto_asset('images/thank-you.png') }}"
                        >
                        <p class="text-base font-semibold text-[var(--foreground)] max-md:text-sm">
                            @lang('shop::app.checkout.cart.mini-cart.empty-cart')
                        </p>
                        <p class="mt-1.5 text-xs text-[var(--muted-foreground)]">
                            Agrega productos para comenzar
                        </p>
                    </div>

                    {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.content.after') !!}
                </x-slot>

                <!-- Drawer Footer -->
                <x-slot:footer>
                    <div
                        v-if="cart?.items?.length"
                        class="grid gap-4 max-md:gap-2.5"
                    >
                        <!-- Subtotal Row -->
                        <div
                            class="flex items-center justify-between border-t border-[rgba(226,232,240,0.7)] px-6 pt-5 max-md:px-4 max-md:pt-3"
                            :class="{'!justify-end': isLoading}"
                        >
                            {!! view_render_event('bagisto.shop.checkout.mini-cart.subtotal.before') !!}

                            <template v-if="! isLoading">
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wider text-[var(--muted-foreground)]">
                                        @lang('shop::app.checkout.cart.mini-cart.subtotal')
                                    </p>
                                </div>

                                <template v-if="displayTax.subtotal == 'including_tax'">
                                    <p class="text-2xl font-bold text-[#6366f1] max-md:text-xl">
                                        @{{ cart.formatted_sub_total_incl_tax }}
                                    </p>
                                </template>

                                <template v-else-if="displayTax.subtotal == 'both'">
                                    <p class="flex flex-col text-right text-2xl font-bold text-[#6366f1] max-md:text-base max-sm:text-right">
                                        @{{ cart.formatted_sub_total_incl_tax }}
                                        <span class="text-xs font-normal text-[var(--muted-foreground)] max-sm:text-xs">
                                            @lang('shop::app.checkout.cart.mini-cart.excl-tax')
                                            <span class="font-semibold text-[var(--foreground)]">@{{ cart.formatted_sub_total }}</span>
                                        </span>
                                    </p>
                                </template>

                                <template v-else>
                                    <p class="text-2xl font-bold text-[#6366f1] max-md:text-xl">
                                        @{{ cart.formatted_sub_total }}
                                    </p>
                                </template>
                            </template>

                            <template v-else>
                                <!-- Spinner -->
                                <svg
                                    class="h-7 w-7 animate-spin text-[#6366f1] max-md:h-6 max-md:w-6 max-sm:h-5 max-sm:w-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    aria-hidden="true"
                                    viewBox="0 0 24 24"
                                >
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </template>

                            {!! view_render_event('bagisto.shop.checkout.mini-cart.subtotal.after') !!}
                        </div>

                        {!! view_render_event('bagisto.shop.checkout.mini-cart.action.before') !!}

                        <!-- Cart Action Container -->
                        <div class="grid gap-2.5 px-6 pb-2 max-md:px-4 max-sm:gap-2">
                            {!! view_render_event('bagisto.shop.checkout.mini-cart.continue_to_checkout.before') !!}

                            <a
                                href="{{ route('shop.checkout.onepage.index') }}"
                                class="mx-auto block w-full cursor-pointer rounded-2xl bg-gradient-to-r from-[#6366f1] to-[#22d3ee] px-6 py-3.5 text-center text-sm font-bold text-white shadow-[0_4px_16px_rgba(99,102,241,0.35)] transition-all duration-300 hover:scale-[1.02] hover:shadow-[0_8px_24px_rgba(99,102,241,0.45)] max-md:rounded-xl max-md:py-2.5 max-md:text-sm"
                            >
                                @lang('shop::app.checkout.cart.mini-cart.continue-to-checkout')
                            </a>

                            {!! view_render_event('bagisto.shop.checkout.mini-cart.continue_to_checkout.after') !!}

                            <div class="block cursor-pointer text-center text-sm font-medium text-[var(--muted-foreground)] transition-colors hover:text-[#6366f1] max-md:py-1">
                                <a href="{{ route('shop.checkout.cart.index') }}">
                                    @lang('shop::app.checkout.cart.mini-cart.view-cart')
                                </a>
                            </div>
                        </div>

                        {!! view_render_event('bagisto.shop.checkout.mini-cart.action.after') !!}
                    </div>
                </x-slot>
            </x-shop::drawer>

        @else
            <a href="{{ route('shop.checkout.onepage.index') }}">
                {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.toggle.before') !!}

                <span class="relative">
                    <span
                        class="icon-cart cursor-pointer text-2xl transition-transform duration-200 hover:scale-110"
                        role="button"
                        aria-label="@lang('shop::app.checkout.cart.mini-cart.shopping-cart')"
                        tabindex="0"
                    ></span>

                    <span
                        class="absolute -top-4 min-w-[1.35rem] rounded-full bg-gradient-to-r from-[#6366f1] to-[#22d3ee] px-1.5 py-1 text-center text-[10px] font-bold leading-[10px] text-white shadow-md ltr:left-4 max-md:ltr:left-3 rtl:right-4 max-md:rtl:right-3"
                        v-if="cart?.items_qty"
                    >
                        @{{ cart.items_qty }}
                    </span>
                </span>

                {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.toggle.after') !!}
            </a>
        @endif

        {!! view_render_event('bagisto.shop.checkout.mini-cart.drawer.after') !!}
    </script>

    <script type="module">
        app.component("v-mini-cart", {
            template: '#v-mini-cart-template',

            data() {
                return  {
                    cart: null,

                    isLoading:false,

                    displayTax: {
                        prices: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_prices') }}",
                        subtotal: "{{ core()->getConfigData('sales.taxes.shopping_cart.display_subtotal') }}",
                    },
                }
            },

            mounted() {
                this.getCart();

                /**
                 * To Do: Implement this.
                 *
                 * Action.
                 */
                this.$emitter.on('update-mini-cart', (cart) => {
                    this.cart = cart;
                });
            },

            methods: {
                getCart() {
                    this.$axios.get('{{ route('shop.api.checkout.cart.index') }}')
                        .then(response => {
                            this.cart = response.data.data;
                        })
                        .catch(error => {});
                },

                updateItem(quantity, item) {
                    this.isLoading = true;

                    let qty = {};

                    qty[item.id] = quantity;

                    this.$axios.put('{{ route('shop.api.checkout.cart.update') }}', { qty })
                        .then(response => {
                            if (response.data.message) {
                                this.cart = response.data.data;
                            } else {
                                this.$emitter.emit('add-flash', { type: 'warning', message: response.data.data.message });
                            }

                            this.isLoading = false;
                        }).catch(error => this.isLoading = false);
                },

                removeItem(itemId) {
                    this.$emitter.emit('open-confirm-modal', {
                        agree: () => {
                            this.isLoading = true;

                            this.$axios.post('{{ route('shop.api.checkout.cart.destroy') }}', {
                                '_method': 'DELETE',
                                'cart_item_id': itemId,
                            })
                            .then(response => {
                                this.cart = response.data.data;

                                this.$emitter.emit('add-flash', { type: 'success', message: response.data.message });

                                this.isLoading = false;
                            })
                            .catch(error => {
                                this.$emitter.emit('add-flash', { type: 'error', message: response.data.message });

                                this.isLoading = false;
                            });
                        }
                    });
                },
            },
        });
    </script>
@endpushOnce
