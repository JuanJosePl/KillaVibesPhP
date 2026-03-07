@push('styles')
<style>
    /* ═══════════════════════════════════════════
       KILLAVIBES — CATEGORY VIEW PAGE
       ═══════════════════════════════════════════ */

    @keyframes kvvwFadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes kvvwPulse {
        0%,100% { opacity: 1; }
        50%      { opacity: 0.55; }
    }
    @keyframes kvvwGradShift {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    @keyframes kvvwSpin {
        to { transform: rotate(360deg); }
    }

    /* ── Page root ── */
    .kvvw-root {
        position: relative; overflow: hidden;
        background: linear-gradient(to bottom,
            var(--background),
            rgba(99,102,241,0.025) 40%,
            var(--background));
        min-height: 80vh;
    }
    .kvvw-orb-tr {
        position: absolute; top: -8rem; right: -8rem;
        width: 32rem; height: 32rem; border-radius: 9999px;
        background: radial-gradient(circle, rgba(99,102,241,0.10), rgba(34,211,238,0.06));
        filter: blur(80px); pointer-events: none; z-index: 0;
        animation: kvvwPulse 5s ease-in-out infinite;
    }
    .kvvw-orb-bl {
        position: absolute; bottom: 10%; left: -6rem;
        width: 22rem; height: 22rem; border-radius: 9999px;
        background: radial-gradient(circle, rgba(34,211,238,0.08), rgba(99,102,241,0.05));
        filter: blur(72px); pointer-events: none; z-index: 0;
        animation: kvvwPulse 5s ease-in-out infinite 2.5s;
    }
    .kvvw-dotgrid {
        position: absolute; inset: 0; opacity: 0.018;
        background-image: radial-gradient(circle at 1px 1px, currentColor 1px, transparent 0);
        background-size: 40px 40px; pointer-events: none; z-index: 0;
    }

    /* ── Container ── */
    .kvvw-container {
        position: relative; z-index: 10;
        max-width: 1400px; margin: 0 auto;
        padding: 0 3.75rem;
    }
    @media (max-width: 1024px) { .kvvw-container { padding: 0 2rem; } }
    @media (max-width: 768px)  { .kvvw-container { padding: 0 1rem; } }

    /* ── Banner ── */
    .kvvw-banner {
        margin-top: 2rem; margin-bottom: 0;
        border-radius: 1.5rem; overflow: hidden;
        box-shadow: 0 8px 40px -10px rgba(99,102,241,0.20);
        border: 2px solid rgba(226,232,240,0.4);
    }
    .kvvw-banner img { width: 100%; aspect-ratio: 4/1; object-fit: cover; display: block; }

    /* ── Description block ── */
    .kvvw-desc {
        margin-top: 1.5rem;
        background: rgba(255,255,255,0.85);
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        border: 1.5px solid rgba(226,232,240,0.55);
        border-left: 3px solid #6366f1;
        border-radius: 0.85rem;
        padding: 1rem 1.5rem;
        font-size: 0.9rem; color: var(--muted-foreground); line-height: 1.7;
    }

    /* ── Page heading ── */
    .kvvw-heading { padding-top: 2.5rem; padding-bottom: 1.5rem; }
    .kvvw-heading__badge {
        display: inline-flex; align-items: center; gap: 0.4rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.10), rgba(34,211,238,0.10));
        padding: 0.35rem 0.9rem; border-radius: 9999px;
        border: 1px solid rgba(99,102,241,0.20); margin-bottom: 0.75rem;
    }
    .kvvw-heading__badge span {
        font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.09em;
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .kvvw-heading__title {
        font-family: var(--font-heading), 'DM Serif Display', serif;
        font-size: clamp(1.5rem, 3vw, 2.2rem); font-weight: 800;
        letter-spacing: -0.03em; color: var(--foreground); margin: 0;
    }
    .kvvw-heading__line {
        width: 2.5rem; height: 3px; border-radius: 9999px;
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        margin-top: 0.75rem;
    }

    /* ── Layout: sidebar + main ── */
    .kvvw-layout {
        display: flex; align-items: flex-start;
        gap: 2rem;
        padding-bottom: 5rem;
    }
    @media (max-width: 1024px) { .kvvw-layout { gap: 1.25rem; } }
    .kvvw-main { flex: 1; min-width: 0; }

    /* ── Empty state ── */
    .kvvw-empty {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        padding: 5rem 1rem; text-align: center;
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        border: 2px solid rgba(226,232,240,0.5); border-radius: 1.25rem;
    }
    .kvvw-empty p {
        font-size: 1rem; font-weight: 600; color: var(--muted-foreground); margin-top: 1.25rem;
    }

    /* ── Load more button ── */
    .kvvw-load-more {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.8rem 2.5rem;
        font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.09em;
        color: #6366f1;
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        border: 2px solid rgba(99,102,241,0.30); border-radius: 9999px;
        box-shadow: 0 4px 20px -4px rgba(99,102,241,0.15);
        cursor: pointer; transition: all 0.3s ease;
    }
    .kvvw-load-more:hover {
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        color: white; border-color: transparent;
        box-shadow: 0 8px 30px -6px rgba(99,102,241,0.40);
        transform: translateY(-2px);
    }
    .kvvw-load-more:hover svg { transform: translateY(2px); }
    .kvvw-load-more svg { transition: transform 0.25s; }

    .kvvw-load-more--loading {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.8rem 2.5rem;
        font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.09em;
        color: rgba(99,102,241,0.4);
        background: rgba(255,255,255,0.7);
        border: 2px solid rgba(226,232,240,0.55); border-radius: 9999px;
        pointer-events: none;
    }
    .kvvw-spinner {
        width: 1rem; height: 1rem;
        border: 2px solid rgba(99,102,241,0.2);
        border-top-color: #6366f1;
        border-radius: 9999px;
        animation: kvvwSpin 0.75s linear infinite;
        display: inline-block;
    }

    /* ── Load more wrapper ── */
    .kvvw-load-more-wrap {
        display: flex; justify-content: center;
        margin-top: 3.5rem; padding-bottom: 1rem;
    }
    @media (max-width: 640px) { .kvvw-load-more-wrap { margin-top: 2rem; } }
</style>
@endpush

<!-- SEO Meta Content -->
@push('meta')
    <meta
        name="description"
        content="{{ trim($category->meta_description) != "" ? $category->meta_description : \Illuminate\Support\Str::limit(strip_tags($category->description), 120, '') }}"
    />

    <meta
        name="keywords"
        content="{{ $category->meta_keywords }}"
    />

    @if (core()->getConfigData('catalog.rich_snippets.categories.enable'))
        <script type="application/ld+json">
            {!! app('Webkul\Product\Helpers\SEO')->getCategoryJsonLd($category) !!}
        </script>
    @endif
@endPush

<x-shop::layouts>
    <x-slot:title>
        {{ trim($category->meta_title) != "" ? $category->meta_title : $category->name }}
    </x-slot>

    <div class="kvvw-root">
        <div class="kvvw-orb-tr" aria-hidden="true"></div>
        <div class="kvvw-orb-bl" aria-hidden="true"></div>
        <div class="kvvw-dotgrid" aria-hidden="true"></div>

        <div class="kvvw-container">

            {!! view_render_event('bagisto.shop.categories.view.banner_path.before') !!}

            <!-- Banner -->
            @if ($category->banner_path)
                <div class="kvvw-banner">
                    <img
                        src="{{ $category->banner_url }}"
                        alt="{{ $category->name }}"
                        width="1320"
                        height="300"
                    >
                </div>
            @endif

            {!! view_render_event('bagisto.shop.categories.view.banner_path.after') !!}
            {!! view_render_event('bagisto.shop.categories.view.description.before') !!}

            <!-- Description -->
            @if (in_array($category->display_mode, [null, 'description_only', 'products_and_description']))
                @if ($category->description)
                    <div class="kvvw-desc max-md:text-sm max-sm:text-xs">
                        {!! $category->description !!}
                    </div>
                @endif
            @endif

            {!! view_render_event('bagisto.shop.categories.view.description.after') !!}

            <!-- Products -->
            @if (in_array($category->display_mode, [null, 'products_only', 'products_and_description']))
                <v-category>
                    <x-shop::shimmer.categories.view />
                </v-category>
            @endif

        </div>
    </div>

    @pushOnce('scripts')
        <script type="text/x-template" id="v-category-template">
            <div class="kvvw-container">

                <!-- Page Heading -->
                <div class="kvvw-heading max-md:hidden">
                    <div class="kvvw-heading__badge">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:0.7rem;height:0.7rem;color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span>Colección</span>
                    </div>
                    <h1 class="kvvw-heading__title">{{ $category->name }}</h1>
                    <div class="kvvw-heading__line"></div>
                </div>

                <!-- Layout -->
                <div class="kvvw-layout">

                    <!-- Sidebar Filters -->
                    @include('shop::categories.filters')

                    <!-- Main Content -->
                    <div class="kvvw-main">

                        <!-- Desktop Toolbar -->
                        <div class="max-md:hidden mb-6">
                            @include('shop::categories.toolbar')
                        </div>

                        <!-- ── LIST MODE ── -->
                        <div
                            class="grid grid-cols-1 gap-4"
                            v-if="filters.toolbar.mode === 'list'"
                        >
                            <template v-if="isLoading">
                                <x-shop::shimmer.products.cards.list count="12" />
                            </template>

                            {!! view_render_event('bagisto.shop.categories.view.list.product_card.before') !!}

                            <template v-else>
                                <template v-if="products.length">
                                    <x-shop::products.card
                                        ::mode="'list'"
                                        v-for="product in products"
                                    />
                                </template>
                                <template v-else>
                                    <div class="kvvw-empty">
                                        <img
                                            style="width:5rem;height:5rem;opacity:0.35;"
                                            src="{{ bagisto_asset('images/thank-you.png') }}"
                                            alt="@lang('shop::app.categories.view.empty')"
                                        />
                                        <p>@lang('shop::app.categories.view.empty')</p>
                                    </div>
                                </template>
                            </template>

                            {!! view_render_event('bagisto.shop.categories.view.list.product_card.after') !!}
                        </div>

                        <!-- ── GRID MODE ── -->
                        <div v-else>
                            <template v-if="isLoading">
                                <div class="grid grid-cols-3 gap-6 max-1060:grid-cols-2 max-md:grid-cols-2 max-md:gap-4 max-sm:grid-cols-1">
                                    <x-shop::shimmer.products.cards.grid count="12" />
                                </div>
                            </template>

                            {!! view_render_event('bagisto.shop.categories.view.grid.product_card.before') !!}

                            <template v-else>
                                <template v-if="products.length">
                                    <div class="grid grid-cols-3 gap-6 max-1060:grid-cols-2 max-md:grid-cols-2 max-md:gap-4 max-sm:grid-cols-1">
                                        <x-shop::products.card
                                            ::mode="'grid'"
                                            v-for="product in products"
                                        />
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="kvvw-empty">
                                        <img
                                            style="width:5rem;height:5rem;opacity:0.35;"
                                            src="{{ bagisto_asset('images/thank-you.png') }}"
                                            alt="@lang('shop::app.categories.view.empty')"
                                        />
                                        <p>@lang('shop::app.categories.view.empty')</p>
                                    </div>
                                </template>
                            </template>

                            {!! view_render_event('bagisto.shop.categories.view.grid.product_card.after') !!}
                        </div>

                        {!! view_render_event('bagisto.shop.categories.view.load_more_button.before') !!}

                        <!-- Load More -->
                        <div class="kvvw-load-more-wrap">
                            <button
                                class="kvvw-load-more"
                                @click="loadMoreProducts"
                                v-if="links.next && ! loader"
                            >
                                @lang('shop::app.categories.view.load-more')
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <button
                                class="kvvw-load-more--loading"
                                v-else-if="links.next"
                            >
                                <span class="kvvw-spinner"></span>
                                Cargando...
                            </button>
                        </div>

                        {!! view_render_event('bagisto.shop.categories.view.grid.load_more_button.after') !!}
                    </div>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-category', {
                template: '#v-category-template',

                data() {
                    return {
                        isMobile: window.innerWidth <= 767,

                        isLoading: true,

                        isDrawerActive: {
                            toolbar: false,

                            filter: false,
                        },

                        filters: {
                            toolbar: {},

                            filter: {},
                        },

                        products: [],

                        links: {},

                        loader: false,
                    }
                },

                computed: {
                    queryParams() {
                        let queryParams = Object.assign({}, this.filters.filter, this.filters.toolbar);

                        return this.removeJsonEmptyValues(queryParams);
                    },

                    queryString() {
                        return this.jsonToQueryString(this.queryParams);
                    },
                },

                watch: {
                    queryParams() {
                        this.getProducts();
                    },

                    queryString() {
                        window.history.pushState({}, '', '?' + this.queryString);
                    },
                },

                methods: {
                    setFilters(type, filters) {
                        this.filters[type] = filters;
                    },

                    clearFilters(type, filters) {
                        this.filters[type] = {};
                    },

                    getProducts() {
                        this.isDrawerActive = {
                            toolbar: false,

                            filter: false,
                        };

                        document.body.style.overflow ='scroll';

                        this.$axios.get("{{ route('shop.api.products.index', ['category_id' => $category->id]) }}", {
                            params: this.queryParams
                        })
                            .then(response => {
                                this.isLoading = false;

                                this.products = response.data.data;

                                this.links = response.data.links;
                            }).catch(error => {
                                console.log(error);
                            });
                    },

                    loadMoreProducts() {
                        if (! this.links.next) {
                            return;
                        }

                        this.loader = true;

                        this.$axios.get(this.links.next)
                            .then(response => {
                                this.loader = false;

                                this.products = [...this.products, ...response.data.data];

                                this.links = response.data.links;
                            }).catch(error => {
                                console.log(error);
                            });
                    },

                    removeJsonEmptyValues(params) {
                        Object.keys(params).forEach(function (key) {
                            if ((! params[key] && params[key] !== undefined)) {
                                delete params[key];
                            }

                            if (Array.isArray(params[key])) {
                                params[key] = params[key].join(',');
                            }
                        });

                        return params;
                    },

                    jsonToQueryString(params) {
                        let parameters = new URLSearchParams();

                        for (const key in params) {
                            parameters.append(key, params[key]);
                        }

                        return parameters.toString();
                    }
                },
            });
        </script>
    @endPushOnce
</x-shop::layouts>
