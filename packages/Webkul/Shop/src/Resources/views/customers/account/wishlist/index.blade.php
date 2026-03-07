<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.wishlist.page-title')
        </x-slot>

        <!-- Breadcrumbs -->
        @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
        <x-shop::breadcrumbs name="wishlist" />
        @endSection
        @endif

        @push('styles')
        <style>
            .kv-wish-item {
                display: flex;
                gap: 1.25rem;
                align-items: flex-start;
                padding: 1.25rem 0;
                border-bottom: 1px solid rgba(226, 232, 240, 0.6);
            }

            .kv-wish-item:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }

            .kv-wish-img {
                width: 7rem;
                min-width: 7rem;
                height: 7rem;
                border-radius: 0.875rem;
                object-fit: cover;
                border: 1.5px solid rgba(99, 102, 241, 0.10);
                flex-shrink: 0;
                transition: transform 0.3s;
            }

            .kv-wish-img:hover {
                transform: scale(1.03);
            }

            .kv-wish-name {
                font-size: 0.95rem;
                font-weight: 700;
                color: var(--foreground);
                margin: 0;
            }

            .kv-wish-price {
                font-size: 1.15rem;
                font-weight: 800;
                color: #6366f1;
            }

            .kv-remove-link {
                font-size: 0.78rem;
                color: #ef4444;
                cursor: pointer;
                text-decoration: none;
                font-weight: 600;
                transition: opacity 0.2s;
            }

            .kv-remove-link:hover {
                opacity: 0.7;
            }

            .kv-move-btn {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                padding: 0.55rem 1.25rem;
                border-radius: 9999px;
                background: linear-gradient(135deg, #6366f1, #22d3ee);
                color: #fff;
                font-weight: 700;
                font-size: 0.8rem;
                border: none;
                cursor: pointer;
                max-height: 2.5rem;
                box-shadow: 0 4px 14px rgba(99, 102, 241, 0.28);
                transition: transform 0.2s, box-shadow 0.2s;
            }

            .kv-move-btn:hover {
                transform: scale(1.04);
                box-shadow: 0 6px 20px rgba(99, 102, 241, 0.38);
            }

            .kv-clear-btn {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                padding: 0.55rem 1.25rem;
                border-radius: 9999px;
                border: 1.5px solid rgba(239, 68, 68, 0.25);
                color: #ef4444;
                font-weight: 600;
                font-size: 0.82rem;
                background: rgba(239, 68, 68, 0.04);
                cursor: pointer;
                transition: background 0.25s, transform 0.2s;
            }

            .kv-clear-btn:hover {
                background: rgba(239, 68, 68, 0.10);
                transform: scale(1.03);
            }

            .kv-wish-container {
                background: rgba(255, 255, 255, 0.72);
                backdrop-filter: blur(12px);
                border: 1.5px solid rgba(99, 102, 241, 0.12);
                border-radius: 1.25rem;
                box-shadow: 0 4px 24px rgba(99, 102, 241, 0.07);
                overflow: hidden;
            }

            .kv-wish-header {
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.06), rgba(34, 211, 238, 0.04));
                padding: 1.25rem 1.75rem;
                border-bottom: 1px solid rgba(99, 102, 241, 0.10);
            }

            .kv-wish-body {
                padding: 0 1.75rem;
            }

            .kv-empty-wrap {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 5rem 1.5rem;
                text-align: center;
                gap: 1rem;
            }

            .kv-empty-icon {
                width: 5rem;
                height: 5rem;
                border-radius: 9999px;
                background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(34, 211, 238, 0.06));
                display: flex;
                align-items: center;
                justify-content: center;
                color: #6366f1;
                border: 1.5px solid rgba(99, 102, 241, 0.15);
            }

            @media (max-width: 768px) {
                .kv-wish-container {
                    border-radius: 1rem;
                }

                .kv-wish-header {
                    padding: 1rem;
                }

                .kv-wish-body {
                    padding: 0 1rem;
                }

                .kv-wish-img {
                    width: 5rem;
                    min-width: 5rem;
                    height: 5rem;
                }

                .kv-wish-item {
                    gap: 0.875rem;
                }
            }
        </style>
        @endpush

        <div class="max-md:hidden">
            <x-shop::layouts.account.navigation />
        </div>

        <div class="mx-4 flex-auto">
            <v-wishlist-products>
                <x-shop::shimmer.customers.account.wishlist :count="4" />
            </v-wishlist-products>
        </div>

        @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-wishlist-products-template">
            <div>
                <template v-if="isLoading">
                    <x-shop::shimmer.customers.account.wishlist :count="4" />
                </template>

                {!! view_render_event('bagisto.shop.customers.account.wishlist.list.before') !!}

                <template v-else>
                    <!-- Page Header -->
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:0.75rem;">
                        <div style="display:flex;align-items:center;gap:0.75rem;">
                            <a class="grid md:hidden" href="{{ route('shop.customers.account.index') }}">
                                <span class="icon-arrow-left rtl:icon-arrow-right text-2xl" style="color:#6366f1;"></span>
                            </a>
                            <h2 style="font-size:1.5rem;font-weight:700;color:var(--foreground);margin:0;" class="max-md:text-xl max-sm:text-base">
                                @lang('shop::app.customers.account.wishlist.page-title')
                            </h2>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.account.wishlist.delete_all.before') !!}

                        <div class="kv-clear-btn" @click="removeAll" v-if="wishlistItems.length">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:0.8rem;height:0.8rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            @lang('shop::app.customers.account.wishlist.delete-all')
                        </div>

                        {!! view_render_event('bagisto.shop.customers.account.wishlist.delete_all.after') !!}
                    </div>

                    <div v-if="wishlistItems.length" class="kv-wish-container">
                        <div class="kv-wish-header">
                            <p style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:#6366f1;margin:0;">
                                @{{ wishlistItems.length }} @{{ wishlistItems.length === 1 ? 'Producto' : 'Productos' }}
                            </p>
                        </div>
                        <div class="kv-wish-body">
                            <div
                                v-for="(item, index) in wishlistItems"
                            >
                                <div class="kv-wish-item">
                                    {!! view_render_event('bagisto.shop.customers.account.wishlist.image.before') !!}

                                    <a :href="`{{ route('shop.product_or_category.index', '') }}/${item.product.url_key}`">
                                        <img
                                            class="kv-wish-img"
                                            :src="item.product.base_image.small_image_url"
                                            alt="Product Image"
                                        />
                                    </a>

                                    {!! view_render_event('bagisto.shop.customers.account.wishlist.image.after') !!}

                                    <div style="flex:1;min-width:0;display:flex;flex-direction:column;gap:0.5rem;">
                                        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:0.5rem;">
                                            <p class="kv-wish-name">@{{ item.product.name }}</p>
                                            <span @click="remove(item.id)" class="icon-bin text-xl text-zinc-400 cursor-pointer hover:text-red-500 transition-colors flex-shrink-0"></span>
                                        </div>

                                        <!-- Attributes -->
                                        <div class="flex flex-wrap gap-x-2.5 gap-y-1.5" v-if="item.options?.attributes">
                                            <div class="grid gap-2">
                                                <div>
                                                    <p class="flex cursor-pointer items-center gap-x-2 text-sm" style="color:var(--muted-foreground);" @click="item.option_show = ! item.option_show">
                                                        @lang('shop::app.customers.account.wishlist.see-details')
                                                        <span class="text-xl" :class="{'icon-arrow-up': item.option_show, 'icon-arrow-down': ! item.option_show}"></span>
                                                    </p>
                                                </div>
                                                <div class="grid gap-1.5" v-show="item.option_show">
                                                    <div v-for="option in item.options?.attributes">
                                                        <p class="text-xs font-semibold">@{{ option.attribute_name + ':' }}</p>
                                                        <p class="text-xs" style="color:var(--muted-foreground);">@{{ option.option_label }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Price + Actions -->
                                        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;margin-top:0.25rem;">
                                            <p class="kv-wish-price" v-html="item.product.min_price"></p>

                                            {!! view_render_event('bagisto.shop.customers.account.wishlist.perform_actions.before') !!}

                                            <div style="display:flex;align-items:center;gap:0.75rem;flex-wrap:wrap;">
                                                <x-shop::quantity-changer
                                                    name="quantity"
                                                    ::value="item.options.quantity ?? 1"
                                                    class="flex max-h-10 items-center gap-x-2.5 rounded-full border border-navyBlue px-3.5 py-1.5 max-md:gap-x-1 max-md:px-1.5 max-md:py-1"
                                                    @change="setItemQuantity($event, item)"
                                                />

                                                @if (core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                                                    <x-shop::button
                                                        class="kv-move-btn"
                                                        :title="trans('shop::app.customers.account.wishlist.move-to-cart')"
                                                        ::loading="isMovingToCart[item.id]"
                                                        ::disabled="isMovingToCart[item.id]"
                                                        @click="moveToCart(item.id, index)"
                                                    />
                                                @endif
                                            </div>

                                            {!! view_render_event('bagisto.shop.customers.account.wishlist.perform_actions.after') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty Wishlist -->
                    <div class="kv-empty-wrap" v-else>
                        <div class="kv-empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:2rem;height:2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p style="font-size:1.1rem;font-weight:700;color:var(--foreground);margin:0 0 0.35rem;">Tu wishlist está vacía</p>
                            <p style="font-size:0.82rem;color:var(--muted-foreground);margin:0;">@lang('shop::app.customers.account.wishlist.empty')</p>
                        </div>
                    </div>
                </template>

                {!! view_render_event('bagisto.shop.customers.account.wishlist.list.after') !!}

            </div>
        </script>

        <script type="module">
            app.component("v-wishlist-products", {
                template: '#v-wishlist-products-template',
                data() {
                    return {
                        isLoading: true,
                        isMovingToCart: {},
                        wishlistItems: [],
                    };
                },
                mounted() {
                    this.get();
                },
                methods: {
                    get() {
                        this.$axios.get("{{ route('shop.api.customers.account.wishlist.index') }}")
                            .then(response => {
                                this.isLoading = false;
                                this.wishlistItems = response.data.data;
                            })
                            .catch(error => {});
                    },
                    remove(id) {
                        this.$emitter.emit('open-confirm-modal', {
                            agree: () => {
                                this.$axios.delete(`{{ route('shop.api.customers.account.wishlist.destroy', '') }}/${id}`)
                                    .then(response => {
                                        this.wishlistItems = this.wishlistItems.filter(item => item.id != id);
                                        this.$emitter.emit('add-flash', {
                                            type: 'success',
                                            message: response.data.message
                                        });
                                    })
                                    .catch(error => {});
                            }
                        });
                    },
                    removeAll() {
                        this.$emitter.emit('open-confirm-modal', {
                            agree: () => {
                                this.$axios.post("{{ route('shop.api.customers.account.wishlist.destroy_all') }}", {
                                        '_method': 'DELETE'
                                    })
                                    .then(response => {
                                        this.wishlistItems = [];
                                        this.$emitter.emit('add-flash', {
                                            type: 'success',
                                            message: response.data.data.message
                                        });
                                    })
                                    .catch(error => {});
                            }
                        });
                    },
                    moveToCart(id, index) {
                        this.isMovingToCart[id] = true;
                        let url = `{{ route('shop.api.customers.account.wishlist.move_to_cart', ':wishlist_id:') }}`.replace(':wishlist_id:', id);
                        let existingItem = this.wishlistItems.find(item => item.id == id);
                        if (!existingItem) return;
                        this.$axios.post(url, {
                                quantity: existingItem.quantity ?? existingItem.options.quantity,
                                product_id: id
                            })
                            .then(response => {
                                if (response.data.redirect) {
                                    this.$emitter.emit('add-flash', {
                                        type: 'warning',
                                        message: response.data.message
                                    });
                                    window.location.href = response.data.data;
                                } else {
                                    this.wishlistItems = this.wishlistItems.filter(item => item.id != id);
                                    this.$emitter.emit('update-mini-cart', response.data.data.cart);
                                    this.$emitter.emit('add-flash', {
                                        type: 'success',
                                        message: response.data.message
                                    });
                                }
                                this.isMovingToCart[id] = false;
                            })
                            .catch(error => {
                                this.isMovingToCart[id] = false;
                            });
                    },
                    setItemQuantity(quantity, requestedItem) {
                        let existingItem = this.wishlistItems.find((item) => item.id === requestedItem.id);
                        if (existingItem) {
                            existingItem.quantity = quantity;
                        }
                    },
                },
            });
        </script>
        @endpushOnce
</x-shop::layouts.account>
