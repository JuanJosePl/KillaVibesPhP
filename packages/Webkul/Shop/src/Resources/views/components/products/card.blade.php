<v-product-card
    {{ $attributes }}
    :product="product">
</v-product-card>

@pushOnce('scripts')
<script
    type="text/x-template"
    id="v-product-card-template">
    <!-- ══════════════════════════════
             GRID CARD
        ══════════════════════════════ -->
    <div
        style="
                position:relative;
                display:flex;
                flex-direction:column;
                background:rgba(255,255,255,0.92);
                backdrop-filter:blur(8px);
                -webkit-backdrop-filter:blur(8px);
                border:2px solid rgba(226,232,240,0.55);
                border-radius:1.25rem;
                box-shadow:0 4px 20px -4px rgba(99,102,241,0.10);
                overflow:hidden;
                text-decoration:none;
                transition:transform 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
                cursor:pointer;
            "
        v-if="mode != 'list'"
        @mouseover="$event.currentTarget.style.transform='translateY(-6px)'; $event.currentTarget.style.boxShadow='0 20px 60px -15px rgba(99,102,241,0.25)'; $event.currentTarget.style.borderColor='rgba(99,102,241,0.30)'"
        @mouseout="$event.currentTarget.style.transform=''; $event.currentTarget.style.boxShadow='0 4px 20px -4px rgba(99,102,241,0.10)'; $event.currentTarget.style.borderColor='rgba(226,232,240,0.55)'">
        <!-- Corner gradient -->
        <div style="position:absolute;top:0;right:0;width:7rem;height:7rem;background:linear-gradient(135deg,rgba(99,102,241,0.08),transparent);border-radius:0 1.25rem 0 100%;pointer-events:none;z-index:2;"></div>

        <!-- Image Wrapper -->
        <div class="group relative overflow-hidden" style="height:220px;background:linear-gradient(135deg,rgba(99,102,241,0.05),rgba(34,211,238,0.05));flex-shrink:0;">

            {!! view_render_event('bagisto.shop.components.products.card.image.before') !!}

            <a
                :href="`{{ route('shop.product_or_category.index', '') }}/${product.url_key}`"
                :aria-label="product.name + ' '">
                <x-shop::media.images.lazy
                    class="after:content-[' '] relative h-full w-full bg-transparent transition-transform duration-500 group-hover:scale-105 after:block after:pb-[calc(100%+9px)]"
                    ::src="product.base_image.medium_image_url"
                    ::key="product.id"
                    ::index="product.id"
                    width="291"
                    height="220"
                    ::alt="product.name" />
            </a>

            {!! view_render_event('bagisto.shop.components.products.card.image.after') !!}

            <!-- Ratings badge -->
            {!! view_render_event('bagisto.shop.components.products.card.average_ratings.before') !!}

            @if (core()->getConfigData('catalog.products.review.summary') == 'star_counts')
            <x-shop::products.ratings
                class="absolute bottom-2 items-center !border-white bg-white/85 !px-2 !py-1 text-xs ltr:left-2 rtl:right-2"
                ::average="product.ratings.average"
                ::total="product.ratings.total"
                ::rating="false"
                v-if="product.ratings.total" />
            @else
            <x-shop::products.ratings
                class="absolute bottom-2 items-center !border-white bg-white/85 !px-2 !py-1 text-xs ltr:left-2 rtl:right-2"
                ::average="product.ratings.average"
                ::total="product.reviews.total"
                ::rating="false"
                v-if="product.reviews.total" />
            @endif

            {!! view_render_event('bagisto.shop.components.products.card.average_ratings.after') !!}

            <!-- Sale / New badge -->
            <p
                style="position:absolute;top:0.6rem;left:0.6rem;z-index:3;font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;padding:0.25rem 0.65rem;border-radius:9999px;background:rgba(239,68,68,0.90);color:white;backdrop-filter:blur(4px);"
                v-if="product.on_sale">
                @lang('shop::app.components.products.card.sale')
            </p>

            <p
                style="position:absolute;top:0.6rem;left:0.6rem;z-index:3;font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;padding:0.25rem 0.65rem;border-radius:9999px;background:linear-gradient(135deg,rgba(99,102,241,0.90),rgba(34,211,238,0.90));color:white;backdrop-filter:blur(4px);"
                v-else-if="product.is_new">
                @lang('shop::app.components.products.card.new')
            </p>

            <!-- Mobile wishlist / compare icons -->
            <div class="opacity-0 transition-all duration-300 group-hover:opacity-100 max-lg:opacity-100">

                {!! view_render_event('bagisto.shop.components.products.card.wishlist_option.before') !!}

                @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                <span
                    style="position:absolute;top:0.6rem;right:0.6rem;z-index:3;display:flex;align-items:center;justify-content:center;width:2rem;height:2rem;border-radius:9999px;border:1.5px solid rgba(226,232,240,0.7);background:rgba(255,255,255,0.9);font-size:1.1rem;cursor:pointer;transition:border-color 0.2s;"
                    class="md:hidden"
                    role="button"
                    aria-label="@lang('shop::app.components.products.card.add-to-wishlist')"
                    tabindex="0"
                    :class="product.is_wishlist ? 'icon-heart-fill text-red-500' : 'icon-heart'"
                    @click="addToWishlist()"></span>
                @endif

                {!! view_render_event('bagisto.shop.components.products.card.wishlist_option.after') !!}

                {!! view_render_event('bagisto.shop.components.products.card.compare_option.before') !!}

                @if (core()->getConfigData('catalog.products.settings.compare_option'))
                <span
                    style="position:absolute;top:3rem;right:0.6rem;z-index:3;display:flex;align-items:center;justify-content:center;width:2rem;height:2rem;border-radius:9999px;border:1.5px solid rgba(226,232,240,0.7);background:rgba(255,255,255,0.9);font-size:1.1rem;cursor:pointer;"
                    class="icon-compare sm:hidden"
                    role="button"
                    aria-label="@lang('shop::app.components.products.card.add-to-compare')"
                    tabindex="0"
                    @click="addToCompare(product.id)"></span>
                @endif

                {!! view_render_event('bagisto.shop.components.products.card.compare_option.after') !!}
            </div>
        </div>

        <!-- Card Body -->
        <div class="group flex flex-1 flex-col gap-2 p-4 max-sm:p-3">

            {!! view_render_event('bagisto.shop.components.products.card.name.before') !!}

            <a :href="`{{ route('shop.product_or_category.index', '') }}/${product.url_key}`">
                <p style="font-size:0.9rem;font-weight:600;color:var(--foreground);line-height:1.4;transition:color 0.2s;"
                    class="hover:text-[#6366f1] max-sm:text-sm">
                    @{{ product.name }}
                </p>
            </a>

            {!! view_render_event('bagisto.shop.components.products.card.name.after') !!}

            <!-- Price -->
            {!! view_render_event('bagisto.shop.components.products.card.price.before') !!}

            <div
                style="display:flex;align-items:center;gap:0.5rem;font-size:1rem;font-weight:800;color:var(--foreground);"
                v-html="product.price_html"></div>

            {!! view_render_event('bagisto.shop.components.products.card.price.before') !!}

            <!-- Hover Actions -->
            <div style="margin-top:auto;" class="flex items-center justify-between pt-2 border-t border-[rgba(226,232,240,0.55)] ">

                @if (core()->getConfigData('sales.checkout.shopping_cart.cart_page'))

                {!! view_render_event('bagisto.shop.components.products.card.add_to_cart.before') !!}

                <button
                    style="flex:1;padding:0.5rem 0.75rem;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.06em;color:#6366f1;background:rgba(99,102,241,0.07);border:1.5px solid rgba(99,102,241,0.20);border-radius:0.6rem;cursor:pointer;transition:background 0.2s,color 0.2s;"
                    :disabled="! product.is_saleable || isAddingToCart"
                    @click="addToCart()"
                    @mouseover="$event.currentTarget.style.background='#6366f1';$event.currentTarget.style.color='white'"
                    @mouseout="$event.currentTarget.style.background='rgba(99,102,241,0.07)';$event.currentTarget.style.color='#6366f1'">
                    @lang('shop::app.components.products.card.add-to-cart')
                </button>

                {!! view_render_event('bagisto.shop.components.products.card.add_to_cart.after') !!}
                @endif

                <!-- Desktop Wishlist -->
                {!! view_render_event('bagisto.shop.components.products.card.wishlist_option.before') !!}

                @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                <span
                    style="display:flex;align-items:center;justify-content:center;width:2.1rem;height:2.1rem;border-radius:9999px;border:1.5px solid rgba(226,232,240,0.7);background:transparent;font-size:1.1rem;cursor:pointer;transition:border-color 0.2s;margin-left:0.5rem;flex-shrink:0;"
                    class="max-sm:hidden"
                    role="button"
                    aria-label="@lang('shop::app.components.products.card.add-to-wishlist')"
                    tabindex="0"
                    :class="product.is_wishlist ? 'icon-heart-fill text-red-600' : 'icon-heart'"
                    @click="addToWishlist()"></span>
                @endif

                {!! view_render_event('bagisto.shop.components.products.card.wishlist_option.after') !!}

                {!! view_render_event('bagisto.shop.components.products.card.compare_option.before') !!}

                @if (core()->getConfigData('catalog.products.settings.compare_option'))
                <span
                    style="display:flex;align-items:center;justify-content:center;width:2.1rem;height:2.1rem;border-radius:9999px;border:1.5px solid rgba(226,232,240,0.7);background:transparent;font-size:1.1rem;cursor:pointer;transition:border-color 0.2s;margin-left:0.35rem;flex-shrink:0;"
                    class="icon-compare max-sm:hidden"
                    role="button"
                    aria-label="@lang('shop::app.components.products.card.add-to-compare')"
                    tabindex="0"
                    @click="addToCompare(product.id)"></span>
                @endif

                {!! view_render_event('bagisto.shop.components.products.card.compare_option.after') !!}
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════
             LIST CARD
        ══════════════════════════════ -->
    <div
        style="
                position:relative;
                display:flex;
                gap:1.25rem;
                background:rgba(255,255,255,0.92);
                backdrop-filter:blur(8px);
                -webkit-backdrop-filter:blur(8px);
                border:2px solid rgba(226,232,240,0.55);
                border-radius:1.25rem;
                box-shadow:0 4px 20px -4px rgba(99,102,241,0.10);
                overflow:hidden;
                transition:transform 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
                width:100%;
            "
        v-else
        @mouseover="$event.currentTarget.style.transform='translateY(-4px)'; $event.currentTarget.style.boxShadow='0 20px 60px -15px rgba(99,102,241,0.22)'; $event.currentTarget.style.borderColor='rgba(99,102,241,0.28)'"
        @mouseout="$event.currentTarget.style.transform=''; $event.currentTarget.style.boxShadow='0 4px 20px -4px rgba(99,102,241,0.10)'; $event.currentTarget.style.borderColor='rgba(226,232,240,0.55)'">
        <!-- List Image -->
        <div class="group relative overflow-hidden flex-shrink-0" style="width:200px;min-width:200px;background:linear-gradient(135deg,rgba(99,102,241,0.05),rgba(34,211,238,0.05));">

            {!! view_render_event('bagisto.shop.components.products.card.image.before') !!}

            <a :href="`{{ route('shop.product_or_category.index', '') }}/${product.url_key}`">
                <x-shop::media.images.lazy
                    class="after:content-[' '] relative h-full w-full bg-transparent transition-transform duration-500 group-hover:scale-105 after:block after:pb-[calc(100%+9px)]"
                    ::src="product.base_image.medium_image_url"
                    ::key="product.id"
                    ::index="product.id"
                    width="200"
                    height="220"
                    ::alt="product.name" />
            </a>

            {!! view_render_event('bagisto.shop.components.products.card.image.after') !!}

            <p
                style="position:absolute;top:0.6rem;left:0.6rem;z-index:3;font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;padding:0.25rem 0.65rem;border-radius:9999px;background:rgba(239,68,68,0.90);color:white;"
                v-if="product.on_sale">
                @lang('shop::app.components.products.card.sale')
            </p>

            <p
                style="position:absolute;top:0.6rem;left:0.6rem;z-index:3;font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;padding:0.25rem 0.65rem;border-radius:9999px;background:linear-gradient(135deg,rgba(99,102,241,0.90),rgba(34,211,238,0.90));color:white;"
                v-else-if="product.is_new">
                @lang('shop::app.components.products.card.new')
            </p>

            <!-- Wishlist mobile -->
            {!! view_render_event('bagisto.shop.components.products.card.wishlist_option.before') !!}

            @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
            <span
                style="position:absolute;top:0.6rem;right:0.6rem;z-index:3;display:flex;align-items:center;justify-content:center;width:2rem;height:2rem;border-radius:9999px;border:1.5px solid rgba(226,232,240,0.7);background:rgba(255,255,255,0.9);font-size:1.1rem;cursor:pointer;"
                role="button"
                aria-label="@lang('shop::app.components.products.card.add-to-wishlist')"
                tabindex="0"
                :class="product.is_wishlist ? 'icon-heart-fill text-red-600' : 'icon-heart'"
                @click="addToWishlist()"></span>
            @endif

            {!! view_render_event('bagisto.shop.components.products.card.wishlist_option.after') !!}

            {!! view_render_event('bagisto.shop.components.products.card.compare_option.before') !!}

            @if (core()->getConfigData('catalog.products.settings.compare_option'))
            <span
                style="position:absolute;top:3rem;right:0.6rem;z-index:3;display:flex;align-items:center;justify-content:center;width:2rem;height:2rem;border-radius:9999px;border:1.5px solid rgba(226,232,240,0.7);background:rgba(255,255,255,0.9);font-size:1.1rem;cursor:pointer;"
                class="icon-compare"
                role="button"
                aria-label="@lang('shop::app.components.products.card.add-to-compare')"
                tabindex="0"
                @click="addToCompare(product.id)"></span>
            @endif

            {!! view_render_event('bagisto.shop.components.products.card.compare_option.after') !!}
        </div>

        <!-- List Body -->
        <div style="display:flex;flex-direction:column;gap:0.75rem;padding:1.25rem 1.25rem 1.25rem 0;flex:1;min-width:0;">

            {!! view_render_event('bagisto.shop.components.products.card.name.before') !!}

            <a :href="`{{ route('shop.product_or_category.index', '') }}/${product.url_key}`">
                <p style="font-size:1rem;font-weight:700;color:var(--foreground);line-height:1.35;transition:color 0.2s;" class="hover:text-[#6366f1]">
                    @{{ product.name }}
                </p>
            </a>

            {!! view_render_event('bagisto.shop.components.products.card.name.after') !!}

            {!! view_render_event('bagisto.shop.components.products.card.price.before') !!}

            <div
                style="display:flex;align-items:center;gap:0.5rem;font-size:1.1rem;font-weight:800;color:var(--foreground);"
                v-html="product.price_html"></div>

            {!! view_render_event('bagisto.shop.components.products.card.price.after') !!}

            {!! view_render_event('bagisto.shop.components.products.card.average_ratings.before') !!}

            <div>
                <template v-if="! product.ratings.total">
                    <p style="font-size:0.8rem;color:var(--muted-foreground);">
                        @lang('shop::app.components.products.card.review-description')
                    </p>
                </template>
                <template v-else>
                    @if (core()->getConfigData('catalog.products.review.summary') == 'star_counts')
                    <x-shop::products.ratings
                        ::average="product.ratings.average"
                        ::total="product.ratings.total"
                        ::rating="false" />
                    @else
                    <x-shop::products.ratings
                        ::average="product.ratings.average"
                        ::total="product.reviews.total"
                        ::rating="false" />
                    @endif
                </template>
            </div>

            {!! view_render_event('bagisto.shop.components.products.card.average_ratings.after') !!}

            @if (core()->getConfigData('sales.checkout.shopping_cart.cart_page'))

            {!! view_render_event('bagisto.shop.components.products.card.add_to_cart.before') !!}

            <div style="margin-top:auto;">
                <x-shop::button
                    style="display:inline-flex;align-items:center;padding:0.6rem 1.5rem;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#6366f1;background:rgba(99,102,241,0.08);border:1.5px solid rgba(99,102,241,0.25);border-radius:0.75rem;cursor:pointer;transition:all 0.2s;white-space:nowrap;"
                    class="primary-button"
                    :title="trans('shop::app.components.products.card.add-to-cart')"
                    ::loading="isAddingToCart"
                    ::disabled="! product.is_saleable || isAddingToCart"
                    @click="addToCart()" />
            </div>

            {!! view_render_event('bagisto.shop.components.products.card.add_to_cart.after') !!}

            @endif
        </div>
    </div>
</script>

<script type="module">
    app.component('v-product-card', {
        template: '#v-product-card-template',

        props: ['mode', 'product'],

        data() {
            return {
                isCustomer: '{{ auth()->guard("customer")->check() }}',

                isAddingToCart: false,
            }
        },

        methods: {
            addToWishlist() {
                if (this.isCustomer) {
                    this.$axios.post(`{{ route('shop.api.customers.account.wishlist.store') }}`, {
                            product_id: this.product.id
                        })
                        .then(response => {
                            this.product.is_wishlist = !this.product.is_wishlist;
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

                let items = this.getStorageValue() ?? [];
                if (items.length) {
                    if (!items.includes(productId)) {
                        items.push(productId);
                        localStorage.setItem('compare_items', JSON.stringify(items));
                        this.$emitter.emit('add-flash', {
                            type: 'success',
                            message: "@lang('shop::app.components.products.card.add-to-compare-success')"
                        });
                    } else {
                        this.$emitter.emit('add-flash', {
                            type: 'warning',
                            message: "@lang('shop::app.components.products.card.already-in-compare')"
                        });
                    }
                } else {
                    localStorage.setItem('compare_items', JSON.stringify([productId]));
                    this.$emitter.emit('add-flash', {
                        type: 'success',
                        message: "@lang('shop::app.components.products.card.add-to-compare-success')"
                    });
                }
            },

            getStorageValue(key) {
                let value = localStorage.getItem('compare_items');
                if (!value) {
                    return [];
                }
                return JSON.parse(value);
            },

            addToCart() {
                this.isAddingToCart = true;
                this.$axios.post('{{ route("shop.api.checkout.cart.store") }}', {
                        'quantity': 1,
                        'product_id': this.product.id,
                    })
                    .then(response => {
                        if (response.data.message) {
                            this.$emitter.emit('update-mini-cart', response.data.data);
                            this.$emitter.emit('add-flash', {
                                type: 'success',
                                message: response.data.message
                            });
                        } else {
                            this.$emitter.emit('add-flash', {
                                type: 'warning',
                                message: response.data.data.message
                            });
                        }
                        this.isAddingToCart = false;
                    })
                    .catch(error => {
                        this.$emitter.emit('add-flash', {
                            type: 'error',
                            message: error.response.data.message
                        });
                        if (error.response.data.redirect_uri) {
                            window.location.href = error.response.data.redirect_uri;
                        }
                        this.isAddingToCart = false;
                    });
            },
        },
    });
</script>
@endpushOnce
