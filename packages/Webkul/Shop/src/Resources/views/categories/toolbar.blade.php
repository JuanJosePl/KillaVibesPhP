@push('styles')
<style>
    /* ═══════════════════════════════════════════
       KILLAVIBES — TOOLBAR
       ═══════════════════════════════════════════ */

    .kvtb-bar {
        display: flex; align-items: center; justify-content: space-between;
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        border: 2px solid rgba(226,232,240,0.55); border-radius: 1rem;
        box-shadow: 0 4px 20px -4px rgba(99,102,241,0.10);
        padding: 0.6rem 1rem;
        gap: 1rem;
    }

    /* ── Dropdown button ── */
    .kvtb-dropdown-btn {
        display: flex; align-items: center; gap: 0.5rem;
        background: transparent;
        border: 1.5px solid rgba(226,232,240,0.7);
        border-radius: 0.65rem;
        padding: 0.5rem 0.85rem;
        font-size: 0.8rem; font-weight: 600; color: var(--foreground);
        cursor: pointer; transition: border-color 0.2s, background 0.2s;
        white-space: nowrap;
    }
    .kvtb-dropdown-btn:hover {
        border-color: rgba(99,102,241,0.35);
        background: rgba(99,102,241,0.04);
        color: #6366f1;
    }
    .kvtb-dropdown-btn .kvtb-label {
        font-size: 0.68rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.06em; color: rgba(99,102,241,0.55); margin-right: 0.1rem;
    }
    .kvtb-dropdown-btn .icon-arrow-down { font-size: 1rem; color: rgba(99,102,241,0.4); }

    /* Active dropdown item */
    .kvtb-item-active {
        background: rgba(99,102,241,0.06) !important;
        color: #6366f1 !important;
        font-weight: 600;
    }

    /* ── Right group ── */
    .kvtb-right { display: flex; align-items: center; gap: 0.75rem; }
    .kvtb-sep { width: 1px; height: 1.25rem; background: rgba(226,232,240,0.7); }

    /* ── Mode switcher ── */
    .kvtb-modes { display: flex; align-items: center; gap: 0.35rem; }
    .kvtb-mode-btn {
        display: flex; align-items: center; justify-content: center;
        width: 2.1rem; height: 2.1rem;
        border-radius: 0.55rem;
        border: 1.5px solid rgba(226,232,240,0.7);
        background: transparent;
        color: rgba(99,102,241,0.3);
        font-size: 1.1rem; cursor: pointer;
        transition: border-color 0.2s, background 0.2s, color 0.2s;
    }
    .kvtb-mode-btn:hover {
        border-color: rgba(99,102,241,0.35);
        background: rgba(99,102,241,0.04);
        color: #6366f1;
    }
    .kvtb-mode-btn--active {
        border-color: rgba(99,102,241,0.35);
        background: rgba(99,102,241,0.08);
        color: #6366f1;
    }

    /* ── Mobile sort list ── */
    .kvtb-sort-list { list-style: none; margin: 0; padding: 0.5rem 0; }
    .kvtb-sort-item {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem; color: var(--foreground);
        cursor: pointer; transition: background 0.15s;
    }
    .kvtb-sort-item:hover { background: rgba(99,102,241,0.04); }
    .kvtb-sort-item--active {
        background: rgba(99,102,241,0.06);
        color: #6366f1; font-weight: 700;
    }
    .kvtb-sort-check {
        display: inline-flex; align-items: center; justify-content: center;
        width: 1.2rem; height: 1.2rem;
        border-radius: 9999px;
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        color: white; font-size: 0.6rem;
    }
</style>
@endpush

{!! view_render_event('bagisto.shop.categories.view.toolbar.before') !!}

<v-toolbar @filter-applied='setFilters("toolbar", $event)'></v-toolbar>

{!! view_render_event('bagisto.shop.categories.view.toolbar.after') !!}

@inject('toolbar' , 'Webkul\Product\Helpers\Toolbar')

@pushOnce('scripts')
    <script type="text/x-template" id='v-toolbar-template'>
        <div>
            <!-- Desktop Toolbar -->
            <div class="kvtb-bar max-md:hidden">

                {!! view_render_event('bagisto.shop.categories.toolbar.filter.before') !!}

                <!-- Sort Dropdown -->
                <x-shop::dropdown class="z-[1]" position="bottom-left">
                    <x-slot:toggle>
                        <button class="kvtb-dropdown-btn">
                            <span class="kvtb-label">Ordenar:</span>
                            @{{ sortLabel ?? "@lang('shop::app.products.sort-by.title')" }}
                            <span class="icon-arrow-down" role="presentation"></span>
                        </button>
                    </x-slot>
                    <x-slot:menu>
                        <x-shop::dropdown.menu.item
                            v-for="(sort, key) in filters.available.sort"
                            ::class="{'kvtb-item-active': sort.value == filters.applied.sort}"
                            @click="apply('sort', sort.value)"
                        >
                            @{{ sort.title }}
                        </x-shop::dropdown.menu.item>
                    </x-slot>
                </x-shop::dropdown>

                {!! view_render_event('bagisto.shop.categories.toolbar.filter.after') !!}
                {!! view_render_event('bagisto.shop.categories.toolbar.pagination.before') !!}

                <!-- Right: Limit + Mode -->
                <div class="kvtb-right">

                    <!-- Limit Dropdown -->
                    <x-shop::dropdown position="bottom-right">
                        <x-slot:toggle>
                            <button class="kvtb-dropdown-btn">
                                <span class="kvtb-label">Ver:</span>
                                @{{ filters.applied.limit ?? "@lang('shop::app.categories.toolbar.show')" }}
                                <span class="icon-arrow-down" role="presentation"></span>
                            </button>
                        </x-slot>
                        <x-slot:menu>
                            <x-shop::dropdown.menu.item
                                v-for="(limit, key) in filters.available.limit"
                                ::class="{'kvtb-item-active': limit == filters.applied.limit}"
                                @click="apply('limit', limit)"
                            >
                                @{{ limit }}
                            </x-shop::dropdown.menu.item>
                        </x-slot>
                    </x-shop::dropdown>

                    <span class="kvtb-sep"></span>

                    <!-- Mode Switcher -->
                    <div class="kvtb-modes">
                        <button
                            class="kvtb-mode-btn"
                            :class="{ 'kvtb-mode-btn--active': filters.applied.mode === 'list' }"
                            role="button"
                            aria-label="@lang('shop::app.categories.toolbar.list')"
                            tabindex="0"
                            @click="changeMode('list')"
                        >
                            <span :class="(filters.applied.mode === 'list') ? 'icon-listing-fill' : 'icon-listing'"></span>
                        </button>

                        <button
                            class="kvtb-mode-btn"
                            :class="{ 'kvtb-mode-btn--active': filters.applied.mode !== 'list' }"
                            role="button"
                            aria-label="@lang('shop::app.categories.toolbar.grid')"
                            tabindex="0"
                            @click="changeMode()"
                        >
                            <span :class="(filters.applied.mode === 'grid') ? 'icon-grid-view-fill' : 'icon-grid-view'"></span>
                        </button>
                    </div>

                </div>

                {!! view_render_event('bagisto.shop.categories.toolbar.pagination.after') !!}
            </div>

            <!-- Mobile Sort List (inside drawer) -->
            <div class="md:hidden">
                <ul class="kvtb-sort-list">
                    <li
                        class="kvtb-sort-item"
                        :class="{ 'kvtb-sort-item--active': sort.value == filters.applied.sort }"
                        v-for="(sort, key) in filters.available.sort"
                        @click="apply('sort', sort.value)"
                    >
                        <span>@{{ sort.title }}</span>
                        <span class="kvtb-sort-check" v-if="sort.value == filters.applied.sort">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-toolbar', {
            template: '#v-toolbar-template',

            data() {
                return {
                    filters: {
                        available: {
                            sort: @json($toolbar->getAvailableOrders()),

                            limit: @json($toolbar->getAvailableLimits()),

                            mode: @json($toolbar->getAvailableModes()),
                        },

                        default: {
                            sort: '{{ $toolbar->getOrder([])['value'] }}',

                            limit: '{{ $toolbar->getLimit([]) }}',

                            mode: '{{ $toolbar->getMode([]) }}',
                        },

                        applied: {
                            sort: '{{ $toolbar->getOrder($params ?? [])['value'] }}',

                            limit: '{{ $toolbar->getLimit($params ?? []) }}',

                            mode: '{{ $toolbar->getMode($params ?? []) }}',
                        }
                    }
                };
            },

            mounted() {
                this.setFilters();
            },

            computed: {
                sortLabel() {
                    return this.filters.available.sort.find(sort => sort.value === this.filters.applied.sort).title;
                }
            },

            methods: {
                apply(type, value) {
                    this.filters.applied[type] = value;

                    this.setFilters();
                },

                changeMode(value = 'grid') {
                    this.filters.applied['mode'] = value;

                    this.setFilters();
                },

                setFilters() {
                    let filters = {};

                    for (let key in this.filters.applied) {
                        if (this.filters.applied[key] != this.filters.default[key]) {
                            filters[key] = this.filters.applied[key];
                        }
                    }

                    this.$emit('filter-applied', filters);
                }
            },
        });
    </script>
@endPushOnce
