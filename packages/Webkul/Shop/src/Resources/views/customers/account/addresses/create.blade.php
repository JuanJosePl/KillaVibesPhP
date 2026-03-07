<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.addresses.create.add-address')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="addresses.create" />
        @endSection
    @endif

    @push('styles')
    <style>
        .kv-form-card {
            background: rgba(255,255,255,0.72);
            backdrop-filter: blur(12px);
            border: 1.5px solid rgba(99,102,241,0.12);
            border-radius: 1.25rem;
            box-shadow: 0 4px 24px rgba(99,102,241,0.07);
            overflow: hidden;
            max-width: 680px;
        }
        .kv-form-header {
            background: linear-gradient(135deg, rgba(99,102,241,0.07), rgba(34,211,238,0.05));
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(99,102,241,0.10);
            display: flex; align-items: center; gap: 0.875rem;
        }
        .kv-form-icon {
            width: 2.75rem; height: 2.75rem; border-radius: 9999px;
            background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(34,211,238,0.12));
            display: flex; align-items: center; justify-content: center;
            color: #6366f1; border: 1.5px solid rgba(99,102,241,0.18); flex-shrink:0;
        }
        .kv-form-body { padding: 2rem; }
        .kv-form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 1.25rem; }
        .kv-submit-btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.85rem 2.5rem; border-radius: 9999px;
            background: linear-gradient(135deg, #6366f1, #22d3ee);
            color: #fff; font-weight: 700; font-size: 0.9rem;
            border: none; cursor: pointer;
            box-shadow: 0 4px 20px rgba(99,102,241,0.28);
            transition: transform 0.25s, box-shadow 0.25s;
            margin-top: 0.5rem;
        }
        .kv-submit-btn:hover {
            transform: scale(1.04);
            box-shadow: 0 8px 28px rgba(99,102,241,0.38);
        }
        .kv-checkbox-row {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.875rem 1rem; border-radius: 0.875rem;
            background: rgba(99,102,241,0.04);
            border: 1px solid rgba(99,102,241,0.10);
            margin-bottom: 1.5rem;
        }
        @media (max-width: 768px) {
            .kv-form-card { border-radius: 1rem; max-width: 100%; }
            .kv-form-header { padding: 1.25rem 1rem; }
            .kv-form-body { padding: 1.25rem 1rem; }
            .kv-form-grid { grid-template-columns: 1fr; gap: 0; }
            .kv-submit-btn { width: 100%; justify-content: center; border-radius: 0.875rem; }
        }
    </style>
    @endpush

    <div class="max-md:hidden">
        <x-shop::layouts.account.navigation />
    </div>

    <div class="mx-4 flex-auto max-md:mx-6 max-sm:mx-4">
        <!-- Page header -->
        <div class="mb-6 flex items-center max-md:mb-4">
            <a class="grid md:hidden" href="{{ route('shop.customers.account.addresses.index') }}">
                <span class="icon-arrow-left rtl:icon-arrow-right text-2xl text-[#6366f1]"></span>
            </a>
            <h2 class="text-2xl font-semibold max-md:text-xl max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0" style="color:var(--foreground);">
                @lang('shop::app.customers.account.addresses.create.add-address')
            </h2>
        </div>

        <v-create-customer-address>
            <x-shop::shimmer.form.control-group :count="10" />
        </v-create-customer-address>
    </div>

    @push('scripts')
        <script
            type="text/x-template"
            id="v-create-customer-address-template"
        >
            <div class="kv-form-card">
                <!-- Card Header -->
                <div class="kv-form-header">
                    <div class="kv-form-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.2rem;height:1.2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p style="font-size:1rem;font-weight:700;color:var(--foreground);margin:0;">Nueva Dirección</p>
                        <p style="font-size:0.72rem;color:var(--muted-foreground);margin:0;">Completa los datos de envío</p>
                    </div>
                </div>

                <div class="kv-form-body">
                    <x-shop::form :action="route('shop.customers.account.addresses.store')">
                        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.before') !!}

                        <div class="kv-form-grid">
                            <!-- First Name -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="required">
                                    @lang('shop::app.customers.account.addresses.create.first-name')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="first_name" rules="required"
                                    :value="old('first_name')"
                                    :label="trans('shop::app.customers.account.addresses.create.first-name')"
                                    :placeholder="trans('shop::app.customers.account.addresses.create.first-name')" />
                                <x-shop::form.control-group.error control-name="first_name" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.first_name.after') !!}

                            <!-- Last Name -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="required">
                                    @lang('shop::app.customers.account.addresses.create.last-name')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="last_name" rules="required"
                                    :value="old('last_name')"
                                    :label="trans('shop::app.customers.account.addresses.create.last-name')"
                                    :placeholder="trans('shop::app.customers.account.addresses.create.last-name')" />
                                <x-shop::form.control-group.error control-name="last_name" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.last_name.after') !!}
                        </div>

                        <div class="kv-form-grid">
                            <!-- Email -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="required">
                                    @lang('shop::app.customers.account.addresses.create.email')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="email" rules="required|email"
                                    :value="old('email')"
                                    :label="trans('shop::app.customers.account.addresses.create.email')"
                                    :placeholder="trans('shop::app.customers.account.addresses.create.email')" />
                                <x-shop::form.control-group.error control-name="email" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.email.after') !!}

                            <!-- Company Name -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label>
                                    @lang('shop::app.customers.account.addresses.create.company-name')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="company_name"
                                    :value="old('company_name')"
                                    :label="trans('shop::app.customers.account.addresses.create.company-name')"
                                    :placeholder="trans('shop::app.customers.account.addresses.create.company-name')" />
                                <x-shop::form.control-group.error control-name="company_name" />
                            </x-shop::form.control-group>
                        </div>

                        <!-- Vat Id -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label>
                                @lang('shop::app.customers.account.addresses.create.vat-id')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control type="text" name="vat_id"
                                :value="old('vat_id')"
                                :label="trans('shop::app.customers.account.addresses.create.vat-id')"
                                :placeholder="trans('shop::app.customers.account.addresses.create.vat-id')" />
                            <x-shop::form.control-group.error control-name="vat_id" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.vat_id.after') !!}

                        <!-- Street Address -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.customers.account.addresses.create.street-address')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control type="text" name="address[]" rules="required|address"
                                :value="collect(old('address'))->first()"
                                :label="trans('shop::app.customers.account.addresses.create.street-address')"
                                :placeholder="trans('shop::app.customers.account.addresses.create.street-address')" />
                            <x-shop::form.control-group.error control-name="address[]" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.street_address.after') !!}

                        @if (
                            core()->getConfigData('customer.address.information.street_lines')
                            && core()->getConfigData('customer.address.information.street_lines') > 1
                        )
                            @for ($i = 1; $i < core()->getConfigData('customer.address.information.street_lines'); $i++)
                                <x-shop::form.control-group.control type="text" name="address[{{ $i }}]"
                                    :value="old('address[{{ $i }}]')" rules="address"
                                    :label="trans('shop::app.customers.account.addresses.create.street-address')"
                                    :placeholder="trans('shop::app.customers.account.addresses.create.street-address')" />
                                <x-shop::form.control-group.error class="mb-2" name="address[{{ $i }}]" />
                            @endfor
                        @endif

                        <div class="kv-form-grid">
                            <!-- Country -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="{{ core()->isCountryRequired() ? 'required' : '' }}">
                                    @lang('shop::app.customers.account.addresses.create.country')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="select" name="country"
                                    rules="{{ core()->isCountryRequired() ? 'required' : '' }}"
                                    v-model="country"
                                    aria-label="trans('shop::app.customers.account.addresses.create.country')"
                                    :label="trans('shop::app.customers.account.addresses.create.country')">
                                    <option value="">@lang('shop::app.customers.account.addresses.create.select-country')</option>
                                    @foreach (core()->countries() as $country)
                                        <option value="{{ $country->code }}">{{ $country->name }}</option>
                                    @endforeach
                                </x-shop::form.control-group.control>
                                <x-shop::form.control-group.error control-name="country" />
                            </x-shop::form.control-group>

                            <!-- State -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="{{ core()->isStateRequired() ? 'required' : '' }}">
                                    @lang('shop::app.customers.account.addresses.create.state')
                                </x-shop::form.control-group.label>
                                <template v-if="haveStates()">
                                    <x-shop::form.control-group.control type="select" id="state" name="state"
                                        rules="{{ core()->isStateRequired() ? 'required' : '' }}"
                                        v-model="state"
                                        :label="trans('shop::app.customers.account.addresses.create.state')"
                                        :placeholder="trans('shop::app.customers.account.addresses.create.state')">
                                        <option v-for='(state, index) in countryStates[country]' :value="state.code">@{{ state.default_name }}</option>
                                    </x-shop::form.control-group.control>
                                </template>
                                <template v-else>
                                    <x-shop::form.control-group.control type="text" name="state"
                                        :value="old('state')"
                                        rules="{{ core()->isStateRequired() ? 'required' : '' }}"
                                        :label="trans('shop::app.customers.account.addresses.create.state')"
                                        :placeholder="trans('shop::app.customers.account.addresses.create.state')" />
                                </template>
                                <x-shop::form.control-group.error control-name="state" />
                            </x-shop::form.control-group>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.state.after') !!}

                        <div class="kv-form-grid">
                            <!-- City -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="required">
                                    @lang('shop::app.customers.account.addresses.create.city')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="city" rules="required"
                                    :value="old('city')"
                                    :label="trans('shop::app.customers.account.addresses.create.city')"
                                    :placeholder="trans('shop::app.customers.account.addresses.create.city')" />
                                <x-shop::form.control-group.error control-name="city" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.city.after') !!}

                            <!-- Post Code -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="{{ core()->isPostCodeRequired() ? 'required' : '' }}">
                                    @lang('shop::app.customers.account.addresses.create.post-code')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="postcode"
                                    rules="{{ core()->isPostCodeRequired() ? 'required' : '' }}|numeric"
                                    :value="old('postcode')"
                                    :label="trans('shop::app.customers.account.addresses.create.post-code')"
                                    :placeholder="trans('shop::app.customers.account.addresses.create.post-code')" />
                                <x-shop::form.control-group.error control-name="postcode" />
                            </x-shop::form.control-group>
                        </div>

                        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.postcode.after') !!}

                        <!-- Phone -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.customers.account.addresses.create.phone')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control type="text" name="phone" rules="required|phone"
                                :value="old('phone')"
                                :label="trans('shop::app.customers.account.addresses.create.phone')"
                                :placeholder="trans('shop::app.customers.account.addresses.create.phone')" />
                            <x-shop::form.control-group.error control-name="phone" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.phone.after') !!}

                        <!-- Default Address Checkbox -->
                        <div class="kv-checkbox-row">
                            <input type="checkbox" name="default_address" value="1" id="default_address" class="peer hidden cursor-pointer">
                            <label class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-navyBlue peer-checked:text-navyBlue" for="default_address"></label>
                            <label class="block cursor-pointer text-sm text-zinc-600 max-md:text-xs" for="default_address">
                                @lang('shop::app.customers.account.addresses.create.set-as-default')
                            </label>
                        </div>

                        <button type="submit" class="kv-submit-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            @lang('shop::app.customers.account.addresses.create.save')
                        </button>

                        {!! view_render_event('bagisto.shop.customers.account.addresses.create_form_controls.after') !!}
                    </x-shop::form>
                    {!! view_render_event('bagisto.shop.customers.account.address.create.after') !!}
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-create-customer-address', {
                template: '#v-create-customer-address-template',
                data() {
                    return {
                        country: "{{ old('country') }}",
                        state: "{{ old('state') }}",
                        countryStates: @json(core()->groupedStatesByCountries()),
                    }
                },
                methods: {
                    haveStates() {
                        return !!this.countryStates[this.country]?.length;
                    },
                }
            });
        </script>
    @endpush

</x-shop::layouts.account>
