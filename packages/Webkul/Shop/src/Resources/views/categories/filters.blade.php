@push('styles')
<style>
    /* ═══════════════════════════════════════════
       KILLAVIBES — FILTERS SIDEBAR
       ═══════════════════════════════════════════ */

    /* ── Sidebar panel ── */
    .kvf-panel {
        position: relative;
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        border: 2px solid rgba(226,232,240,0.55);
        border-radius: 1.25rem;
        box-shadow: 0 4px 20px -4px rgba(99,102,241,0.10);
        overflow: hidden;
    }
    .kvf-panel::before {
        content: '';
        position: absolute; top: 0; right: 0;
        width: 6rem; height: 6rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.07), transparent);
        border-radius: 0 1.25rem 0 100%;
        pointer-events: none;
    }

    /* ── Panel header ── */
    .kvf-panel__header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 1.1rem 1.25rem 1rem;
        border-bottom: 1px solid rgba(226,232,240,0.7);
    }
    .kvf-panel__title {
        font-size: 0.78rem !important; font-weight: 700 !important;
        text-transform: uppercase; letter-spacing: 0.09em;
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    }
    .kvf-panel__clear {
        font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.07em;
        color: rgba(99,102,241,0.55); cursor: pointer;
        transition: color 0.2s;
        border: none; background: none; padding: 0;
    }
    .kvf-panel__clear:hover { color: #6366f1; }

    /* ── Accordion item ── */
    .kvf-item { border-bottom: 1px solid rgba(226,232,240,0.55); }
    .kvf-item:last-child { border-bottom: none; }
    .kvf-item__header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.85rem 1.25rem;
    }
    .kvf-item__name {
        font-size: 0.8rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.06em; color: var(--foreground);
    }

    /* ── Checkbox options ── */
    .kvf-option {
        display: flex; align-items: center; gap: 0.65rem;
        padding: 0.45rem 1.25rem;
        transition: background 0.15s;
        cursor: pointer;
    }
    .kvf-option:hover { background: rgba(99,102,241,0.04); }
    .kvf-option label { font-size: 0.85rem; color: var(--foreground); cursor: pointer; }

    /* ── Mobile bottom bar ── */
    .kvf-mobile-bar {
        position: fixed; bottom: 0; left: 0; right: 0; z-index: 10;
        display: grid; grid-template-columns: 1fr auto 1fr;
        align-items: center; justify-items: center;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        border-top: 1px solid rgba(226,232,240,0.6);
        box-shadow: 0 -4px 20px -4px rgba(99,102,241,0.12);
        padding: 0 1.25rem;
    }
    .kvf-mobile-btn {
        display: flex; align-items: center; gap: 0.5rem;
        padding: 0.875rem 0.75rem;
        font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;
        color: var(--foreground); cursor: pointer;
        transition: color 0.2s;
    }
    .kvf-mobile-btn:hover { color: #6366f1; }
    .kvf-mobile-btn .kvf-icon { font-size: 1.2rem; color: #6366f1; }
    .kvf-mobile-sep { width: 1px; height: 1.25rem; background: rgba(226,232,240,0.7); }
</style>
@endpush

{!!view_render_event('bagisto.shop.categories.view.filters.before') !!}

<!-- Desktop Filters -->
<div v-if="! isMobile">
    <v-filters
        @filter-applied="setFilters('filter', $event)"
        @filter-clear="clearFilters('filter', $event)"
    >
        <x-shop::shimmer.categories.filters />
    </v-filters>
</div>

<!-- Mobile Bottom Bar -->
<div class="kvf-mobile-bar" v-if="isMobile">

    <!-- Filter Drawer -->
    <x-shop::drawer
        position="left"
        width="100%"
        ::is-active="isDrawerActive.filter"
    >
        <x-slot:toggle>
            <div class="kvf-mobile-btn" @click="isDrawerActive.filter = true">
                <span class="kvf-icon icon-filter-1"></span>
                @lang('shop::app.categories.filters.filter')
            </div>
        </x-slot>

        <x-slot:header>
            <div class="flex items-center justify-between">
                <p class="kvf-panel__title" style="-webkit-text-fill-color:unset;color:#6366f1;">
                    @lang('shop::app.categories.filters.filters')
                </p>
                <p
                    class="kvf-panel__clear ltr:mr-[50px] rtl:ml-[50px]"
                    @click="clearFilters('filter', '')"
                >
                    @lang('shop::app.categories.filters.clear-all')
                </p>
            </div>
        </x-slot>

        <x-slot:content>
            <v-filters
                @filter-applied="setFilters('filter', $event)"
                @filter-clear="clearFilters('filter', $event)"
            >
                <x-shop::shimmer.categories.filters />
            </v-filters>
        </x-slot>
    </x-shop::drawer>

    <span class="kvf-mobile-sep"></span>

    <!-- Sort Drawer -->
    <x-shop::drawer
        position="bottom"
        width="100%"
        ::is-active="isDrawerActive.toolbar"
    >
        <x-slot:toggle>
            <div class="kvf-mobile-btn" @click="isDrawerActive.toolbar = true">
                <span class="kvf-icon icon-sort-1"></span>
                @lang('shop::app.categories.filters.sort')
            </div>
        </x-slot>

        <x-slot:header>
            <div class="flex items-center justify-between">
                <p class="kvf-panel__title" style="-webkit-text-fill-color:unset;color:#6366f1;">
                    @lang('shop::app.categories.filters.sort')
                </p>
            </div>
        </x-slot>

        <x-slot:content class="!px-0">
            @include('shop::categories.toolbar')
        </x-slot>
    </x-shop::drawer>

</div>

{!!view_render_event('bagisto.shop.categories.view.filters.after') !!}

@pushOnce('scripts')
    <script type="text/x-template" id="v-filters-template">
        <template v-if="isLoading">
            <x-shop::shimmer.categories.filters />
        </template>

        <template v-else>
            <div class="kvf-panel journal-scroll grid max-h-[1320px] min-w-[250px] grid-cols-[1fr] overflow-y-auto overflow-x-hidden max-xl:min-w-[220px] md:max-w-[270px] max-md:rounded-none max-md:border-0 max-md:shadow-none max-md:bg-transparent">

                <!-- Header -->
                <div class="kvf-panel__header max-md:hidden">
                    <p class="kvf-panel__title">
                        @lang('shop::app.categories.filters.filters')
                    </p>
                    <p class="kvf-panel__clear" tabindex="0" @click="clear()">
                        @lang('shop::app.categories.filters.clear-all')
                    </p>
                </div>

                <!-- Filter Items -->
                <v-filter-item
                    ref="filterItemComponent"
                    :key="filterIndex"
                    :filter="filter"
                    v-for='(filter, filterIndex) in filters.available'
                    @values-applied="applyFilter(filter, $event)"
                >
                </v-filter-item>
            </div>
        </template>
    </script>

    <script type="text/x-template" id="v-filter-item-template">
        <template v-if="filter.type === 'price' || filter.options.length">
            <x-shop::accordion class="last:border-b-0 border-b border-[rgba(226,232,240,0.55)]">
                <x-slot:header class="px-5 py-3 max-sm:!pb-2">
                    <div class="flex items-center justify-between">
                        <p style="font-size:0.78rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:var(--foreground);">
                            @{{ filter.name }}
                        </p>
                    </div>
                </x-slot>

                <x-slot:content class="!p-0 !pt-1 pb-2">
                    <!-- Price Range -->
                    <ul v-if="filter.type === 'price'" style="padding: 0 1.25rem 0.5rem;">
                        <li>
                            <v-price-filter
                                :key="refreshKey"
                                :default-price-range="appliedValues"
                                @set-price-range="applyValue($event)"
                            ></v-price-filter>
                        </li>
                    </ul>

                    <!-- Checkboxes -->
                    <ul v-else style="padding-bottom:0.5rem;">
                        <li
                            :key="option.id"
                            v-for="(option, optionIndex) in filter.options"
                        >
                            <div
                                style="display:flex;align-items:center;gap:0.65rem;padding:0.45rem 1.25rem;transition:background 0.15s;cursor:pointer;"
                                onmouseover="this.style.background='rgba(99,102,241,0.04)'"
                                onmouseout="this.style.background='transparent'"
                            >
                                <input
                                    type="checkbox"
                                    :id="'option_' + option.id"
                                    class="peer hidden"
                                    :value="option.id"
                                    v-model="appliedValues"
                                    @change="applyValue"
                                />
                                <label
                                    class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-xl peer-checked:text-[#6366f1] text-[rgba(226,232,240,0.9)] transition-colors"
                                    role="checkbox"
                                    aria-checked="false"
                                    :aria-label="option.name"
                                    :aria-labelledby="'label_option_' + option.id"
                                    tabindex="0"
                                    :for="'option_' + option.id"
                                ></label>
                                <label
                                    style="font-size:0.85rem;color:var(--foreground);cursor:pointer;width:100%;padding:0.2rem 0;"
                                    :id="'label_option_' + option.id"
                                    :for="'option_' + option.id"
                                    role="button"
                                    tabindex="0"
                                >
                                    @{{ option.name }}
                                </label>
                            </div>
                        </li>
                    </ul>
                </x-slot>
            </x-shop::accordion>
        </template>
    </script>

    <script type="text/x-template" id="v-price-filter-template">
        <div style="padding:0.5rem 0;">
            <template v-if="isLoading">
                <x-shop::shimmer.range-slider />
            </template>
            <template v-else>
                <x-shop::range-slider
                    ::key="refreshKey"
                    default-type="price"
                    ::default-allowed-max-range="allowedMaxPrice"
                    ::default-min-range="minRange"
                    ::default-max-range="maxRange"
                    @change-range="setPriceRange($event)"
                />
            </template>
        </div>
    </script>

    <script type='module'>
        app.component('v-filters', {
            template: '#v-filters-template',

            data() {
                return {
                    isLoading: true,

                    filters: {
                        available: {},

                        applied: {},
                    },
                };
            },

            mounted() {
                this.getFilters();

                this.setFilters();
            },

            methods: {
                getFilters() {
                    this.$axios.get('{{ route("shop.api.categories.attributes") }}', {
                            params: {
                                category_id: "{{ isset($category) ? $category->id : ''  }}",
                            }
                        })
                        .then((response) => {
                            this.isLoading = false;

                            this.filters.available = response.data.data;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                },

                setFilters() {
                    let queryParams = new URLSearchParams(window.location.search);

                    queryParams.forEach((value, filter) => {
                        /**
                         * Removed all toolbar filters in order to prevent key duplication.
                         */
                        if (! ['sort', 'limit', 'mode'].includes(filter)) {
                            this.filters.applied[filter] = value.split(',');
                        }
                    });

                    this.$emit('filter-applied', this.filters.applied);
                },

                applyFilter(filter, values) {
                    if (values.length) {
                        this.filters.applied[filter.code] = values;
                    } else {
                        delete this.filters.applied[filter.code];
                    }

                    this.$emit('filter-applied', this.filters.applied);
                },

                clear() {
                    /**
                     * Clearing parent component.
                     */
                    this.filters.applied = {};

                    /**
                     * Clearing child components. Improvisation needed here.
                     */
                    this.$refs.filterItemComponent.forEach((filterItem) => {
                        if (filterItem.filter.code === 'price') {
                            filterItem.$data.appliedValues = null;
                        } else {
                            filterItem.$data.appliedValues = [];
                        }
                    });

                    this.$emit('filter-applied', this.filters.applied);
                },
            },
        });

        app.component('v-filter-item', {
            template: '#v-filter-item-template',

            props: ['filter'],

            data() {
                return {
                    active: true,

                    appliedValues: null,

                    refreshKey: 0,
                }
            },

            watch: {
                appliedValues() {
                    if (this.filter.code === 'price' && ! this.appliedValues) {
                        ++this.refreshKey;
                    }
                },
            },

            mounted() {
                if (this.filter.code === 'price') {
                    /**
                     * Improvisation needed here for `this.$parent.$data`.
                     */
                    this.appliedValues = this.$parent.$data.filters.applied[this.filter.code]?.join(',');

                    ++this.refreshKey;

                    return;
                }

                /**
                 * Improvisation needed here for `this.$parent.$data`.
                 */
                this.appliedValues = this.$parent.$data.filters.applied[this.filter.code] ?? [];
            },

            methods: {
                applyValue($event) {
                    if (this.filter.code === 'price') {
                        this.appliedValues = $event;

                        this.$emit('values-applied', this.appliedValues);

                        return;
                    }

                    this.$emit('values-applied', this.appliedValues);
                },
            },
        });

        app.component('v-price-filter', {
            template: '#v-price-filter-template',

            props: ['defaultPriceRange'],

            data() {
                return {
                    refreshKey: 0,

                    isLoading: true,

                    allowedMaxPrice: 100,

                    priceRange: this.defaultPriceRange ?? [0, 100].join(','),
                };
            },

            computed: {
                minRange() {
                    let priceRange = this.priceRange.split(',');

                    return priceRange[0];
                },

                maxRange() {
                    let priceRange = this.priceRange.split(',');

                    return priceRange[1];
                }
            },

            mounted() {
                this.getMaxPrice();
            },

            methods: {
                getMaxPrice() {
                    this.$axios.get('{{ route("shop.api.categories.max_price", $category->id ?? '') }}')
                        .then((response) => {
                            this.isLoading = false;

                            /**
                             * If data is zero, then default price will be displayed.
                             */
                            if (response.data.data.max_price) {
                                this.allowedMaxPrice = response.data.data.max_price;
                            }

                            if (! this.defaultPriceRange) {
                                this.priceRange = [0, this.allowedMaxPrice].join(',');
                            }

                            ++this.refreshKey;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                },

                setPriceRange($event) {
                    this.priceRange = [$event.minRange, $event.maxRange].join(',');

                    this.$emit('set-price-range', this.priceRange);
                },
            },
        });
    </script>
@endPushOnce
