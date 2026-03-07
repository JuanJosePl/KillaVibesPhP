<!-- Estimate Tax and Shipping -->
{!! view_render_event('bagisto.shop.checkout.cart.summary.estimate_shipping.before') !!}

<x-shop::accordion
    class="overflow-hidden rounded-xl border border-[rgba(226,232,240,0.7)] bg-[rgba(99,102,241,0.02)] max-md:rounded-lg max-md:!border-none max-md:!bg-[rgba(99,102,241,0.03)]"
    :is-active="false"
>
    <x-slot:header class="font-semibold text-sm text-[var(--foreground)] max-md:py-3 max-md:font-medium max-sm:p-2 max-sm:text-xs">
        <span class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#6366f1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
            </svg>
            @lang('shop::app.checkout.cart.summary.estimate-shipping.title')
        </span>
    </x-slot>

    <x-slot:content class="px-4 pb-4 pt-0 max-md:rounded-t-none max-md:border max-md:border-t-0 max-md:pt-4">
        <v-estimate-tax-shipping
            :cart="cart"
            @processed="setCart"
        ></v-estimate-tax-shipping>
    </x-slot>
</x-shop::accordion>

{!! view_render_event('bagisto.shop.checkout.cart.summary.estimate_shipping.after') !!}

@pushOnce('scripts')
    <script type="text/x-template" id="v-estimate-tax-shipping-template">
        <!-- Destination Location Form -->
        <x-shop::form
            v-slot="{ meta, errors, handleSubmit }"
            as="div"
        >
            <form @change="handleSubmit($event, estimateShipping)">
                <p class="mb-4 text-xs text-[var(--muted-foreground)] max-sm:text-xs">
                    @lang('shop::app.checkout.cart.summary.estimate-shipping.info')
                </p>

                <!-- Country -->
                <x-shop::form.control-group class="!mb-3">
                    <x-shop::form.control-group.label class="mb-1.5 text-xs font-semibold text-[var(--foreground)] {{ core()->isCountryRequired() ? 'required' : '' }}">
                        @lang('shop::app.checkout.cart.summary.estimate-shipping.country')
                    </x-shop::form.control-group.label>

                    <x-shop::form.control-group.control
                        type="select"
                        name="country"
                        v-model="selectedCountry"
                        rules="{{ core()->isCountryRequired() ? 'required' : '' }}"
                        :label="trans('shop::app.checkout.cart.summary.estimate-shipping.country')"
                        :placeholder="trans('shop::app.checkout.cart.summary.estimate-shipping.country')"
                    >
                        <option value="">
                            @lang('shop::app.checkout.cart.summary.estimate-shipping.select-country')
                        </option>

                        <option
                            v-for="country in countries"
                            :value="country.code"
                            v-text="country.name"
                        >
                        </option>
                    </x-shop::form.control-group.control>

                    <x-shop::form.control-group.error name="country" />
                </x-shop::form.control-group>

                {!! view_render_event('bagisto.shop.checkout.onepage.address.form.country.after') !!}

                <!-- State -->
                <x-shop::form.control-group class="!mb-3">
                    <x-shop::form.control-group.label class="mb-1.5 text-xs font-semibold text-[var(--foreground)] {{ core()->isStateRequired() ? 'required' : '' }}">
                        @lang('shop::app.checkout.cart.summary.estimate-shipping.state')
                    </x-shop::form.control-group.label>

                    <template v-if="states">
                        <template v-if="haveStates">
                            <x-shop::form.control-group.control
                                type="select"
                                name="state"
                                rules="{{ core()->isStateRequired() ? 'required' : '' }}"
                                :label="trans('shop::app.checkout.cart.summary.estimate-shipping.state')"
                                :placeholder="trans('shop::app.checkout.cart.summary.estimate-shipping.state')"
                            >
                                <option value="">
                                    @lang('shop::app.checkout.cart.summary.estimate-shipping.select-state')
                                </option>

                                <option
                                    v-for='(state, index) in states[selectedCountry]'
                                    :value="state.code"
                                >
                                    @{{ state.default_name }}
                                </option>
                            </x-shop::form.control-group.control>
                        </template>

                        <template v-else>
                            <x-shop::form.control-group.control
                                type="text"
                                name="state"
                                rules="{{ core()->isStateRequired() ? 'required' : '' }}"
                                :label="trans('shop::app.checkout.cart.summary.estimate-shipping.state')"
                                :placeholder="trans('shop::app.checkout.cart.summary.estimate-shipping.state')"
                            />
                        </template>
                    </template>

                    <x-shop::form.control-group.error name="state" />
                </x-shop::form.control-group>

                <!-- Postcode -->
                <x-shop::form.control-group class="!mb-0">
                    <x-shop::form.control-group.label class="mb-1.5 text-xs font-semibold text-[var(--foreground)] {{ core()->isPostCodeRequired() ? 'required' : '' }}">
                        @lang('shop::app.checkout.cart.summary.estimate-shipping.postcode')
                    </x-shop::form.control-group.label>

                    <x-shop::form.control-group.control
                        type="text"
                        name="postcode"
                        rules="{{ core()->isPostCodeRequired() ? 'required' : '' }}"
                        :label="trans('shop::app.checkout.cart.summary.estimate-shipping.postcode')"
                        :placeholder="trans('shop::app.checkout.cart.summary.estimate-shipping.postcode')"
                    />

                    <x-shop::form.control-group.error control-name="postcode" />
                </x-shop::form.control-group>

                <!-- Estimated Shipping Methods -->
                <div
                    class="mt-4 overflow-hidden rounded-xl border border-[rgba(99,102,241,0.15)] bg-[rgba(255,255,255,0.7)]"
                    v-if="methods.length"
                >
                    <template v-for="method in methods">
                        {!! view_render_event('bagisto.shop.checkout.onepage.shipping.before') !!}

                        <div
                            class="relative select-none border-b border-[rgba(226,232,240,0.7)] last:border-b-0 max-md:max-w-full max-md:flex-auto"
                            v-for="rate in method.rates"
                        >
                            <div class="absolute top-4 ltr:left-4 rtl:right-4">
                                <x-shop::form.control-group.control
                                    type="radio"
                                    name="shipping_method"
                                    ::for="rate.method"
                                    ::id="rate.method"
                                    ::value="rate.method"
                                    ::label="rate.method"
                                />
                            </div>

                            <label
                                class="block cursor-pointer p-4 pl-12 transition-colors duration-200 hover:bg-[rgba(99,102,241,0.04)]"
                                :for="rate.method"
                            >
                                <p class="text-lg font-bold text-[#6366f1] max-md:text-base">
                                    @{{ rate.base_formatted_price }}
                                </p>
                                <p class="mt-1 text-xs text-[var(--muted-foreground)] max-md:mt-0">
                                    <span class="font-semibold text-[var(--foreground)]">@{{ rate.method_title }}</span>
                                    <span class="mx-1 text-[var(--border)]">·</span>
                                    @{{ rate.method_description }}
                                </p>
                            </label>
                        </div>

                        {!! view_render_event('bagisto.shop.checkout.onepage.shipping.after') !!}
                    </template>
                </div>
            </form>
        </x-shop::form>
    </script>

    <script type="module">
        app.component('v-estimate-tax-shipping', {
            template: '#v-estimate-tax-shipping-template',

            props: ['cart'],

            data() {
                return {
                    selectedCountry: '',

                    countries: [],

                    states: null,

                    methods: [],

                    isStoring: false,
                }
            },

            computed: {
                haveStates() {
                    return !! this.states[this.selectedCountry]?.length;
                },
            },

            mounted() {
                this.getCountries();

                this.getStates();
            },

            methods: {
                getCountries() {
                    this.$axios.get("{{ route('shop.api.core.countries') }}")
                        .then(response => {
                            this.countries = response.data.data;
                        })
                        .catch(() => {});
                },

                getStates() {
                    this.$axios.get("{{ route('shop.api.core.states') }}")
                        .then(response => {
                            this.states = response.data.data;
                        })
                        .catch(() => {});
                },

                estimateShipping(params, { setErrors }) {
                    this.isStoring = true;

                    Object.keys(params).forEach(key => params[key] == null && delete params[key]);

                    this.$axios.post('{{ route('shop.api.checkout.cart.estimate_shipping') }}', params)
                        .then((response) => {
                            this.isStoring = false;

                            this.methods = response.data.data.shipping_methods;

                            this.$emit('processed', response.data.data.cart);
                        })
                        .catch(error => {
                            this.isStoring = false;

                            if (error.response.status == 422) {
                                setErrors(error.response.data.errors);
                            }
                        });
                },
            },
        });
    </script>
@endPushOnce
