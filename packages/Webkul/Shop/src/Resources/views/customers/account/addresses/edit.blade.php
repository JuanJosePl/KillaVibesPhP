<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.addresses.edit.edit')
        @lang('shop::app.customers.account.addresses.edit.title')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="addresses.edit" :entity="$address" />
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
            <h2 class="text-2xl font-semibold max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0" style="color:var(--foreground);">
                @lang('shop::app.customers.account.addresses.edit.edit')
                @lang('shop::app.customers.account.addresses.edit.title')
            </h2>
        </div>

        {!! view_render_event('bagisto.shop.customers.account.address.edit.before', ['address' => $address]) !!}

        <v-edit-customer-address>
            <x-shop::shimmer.form.control-group :count="10" />
        </v-edit-customer-address>

        {!! view_render_event('bagisto.shop.customers.account.address.edit.after', ['address' => $address]) !!}
    </div>

    @push('scripts')
        <script
            type="text/x-template"
            id="v-edit-customer-address-template"
        >
            <div class="kv-form-card">
                <!-- Card Header -->
                <div class="kv-form-header">
                    <div class="kv-form-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.2rem;height:1.2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <p style="font-size:1rem;font-weight:700;color:var(--foreground);margin:0;">Editar Dirección</p>
                        <p style="font-size:0.72rem;color:var(--muted-foreground);margin:0;">Actualiza los datos de envío</p>
                    </div>
                </div>

                <div class="kv-form-body">
                    <x-shop::form method="PUT" :action="route('shop.customers.account.addresses.update', $address->id)">
                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.before', ['address' => $address]) !!}

                        <div class="kv-form-grid">
                            <!-- First Name -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="required">
                                    @lang('shop::app.customers.account.addresses.edit.first-name')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="first_name" rules="required"
                                    :value="old('first_name') ?? $address->first_name"
                                    :label="trans('shop::app.customers.account.addresses.edit.first-name')"
                                    :placeholder="trans('shop::app.customers.account.addresses.edit.first-name')" />
                                <x-shop::form.control-group.error control-name="first_name" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.account.addresses.edit_form_controls.first_name.after', ['address' => $address]) !!}

                            <!-- Last Name -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="required">
                                    @lang('shop::app.customers.account.addresses.edit.last-name')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="last_name" rules="required"
                                    :value="old('last_name') ?? $address->last_name"
                                    :label="trans('shop::app.customers.account.addresses.edit.last-name')"
                                    :placeholder="trans('shop::app.customers.account.addresses.edit.last-name')" />
                                <x-shop::form.control-group.error control-name="last_name" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.account.addresses.edit_form_controls.last_name.after', ['address' => $address]) !!}
                        </div>

                        <div class="kv-form-grid">
                            <!-- Email -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="required">
                                    @lang('Email')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="email" rules="required|email"
                                    :value="old('email') ?? $address->email"
                                    :label="trans('Email')"
                                    :placeholder="trans('Email')" />
                                <x-shop::form.control-group.error control-name="email" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.account.addresses.edit_form_controls.email.after', ['address' => $address]) !!}

                            <!-- Company Name -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label>
                                    @lang('shop::app.customers.account.addresses.edit.company-name')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="company_name"
                                    :value="old('company_name') ?? $address->company_name"
                                    :label="trans('shop::app.customers.account.addresses.edit.company-name')"
                                    :placeholder="trans('shop::app.customers.account.addresses.edit.company-name')" />
                                <x-shop::form.control-group.error control-name="company_name" />
                            </x-shop::form.control-group>
                        </div>

                        <!-- Vat ID -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label>
                                @lang('shop::app.customers.account.addresses.edit.vat-id')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control type="text" name="vat_id"
                                :value="old('vat_id') ?? $address->vat_id"
                                :label="trans('shop::app.customers.account.addresses.edit.vat-id')"
                                :placeholder="trans('shop::app.customers.account.addresses.edit.vat-id')" />
                            <x-shop::form.control-group.error control-name="vat_id" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.addresses.edit_form_controls.vat_id.after', ['address' => $address]) !!}

                        @php $addresses = explode(PHP_EOL, $address->address); @endphp

                        <!-- Street Address -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.customers.account.addresses.edit.street-address')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control type="text" name="address[]"
                                :value="collect(old('address'))->first() ?? $addresses[0]"
                                rules="required|address"
                                :label="trans('shop::app.customers.account.addresses.edit.street-address')"
                                :placeholder="trans('shop::app.customers.account.addresses.edit.street-address')" />
                            <x-shop::form.control-group.error control-name="address[]" />
                        </x-shop::form.control-group>

                        @if (
                            core()->getConfigData('customer.address.information.street_lines')
                            && core()->getConfigData('customer.address.information.street_lines') > 1
                        )
                            @for ($i = 1; $i < core()->getConfigData('customer.address.information.street_lines'); $i++)
                                <x-shop::form.control-group.control type="text" name="address[{{ $i }}]"
                                    :value="old('address[{{$i}}]', $addresses[$i] ?? '')" rules="address"
                                    :label="trans('shop::app.customers.account.addresses.edit.street-address')"
                                    :placeholder="trans('shop::app.customers.account.addresses.edit.street-address')" />
                                <x-shop::form.control-group.error class="mb-2" name="address[{{ $i }}]" />
                            @endfor
                        @endif

                        {!! view_render_event('bagisto.shop.customers.account.addresses.edit_form_controls.street-addres.after', ['address' => $address]) !!}

                        <div class="kv-form-grid">
                            <!-- Country -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="{{ core()->isCountryRequired() ? 'required' : '' }}">
                                    @lang('shop::app.customers.account.addresses.edit.country')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="select" name="country"
                                    rules="{{ core()->isStateRequired() ? 'required' : '' }}"
                                    v-model="addressData.country"
                                    :aria-label="trans('shop::app.customers.account.addresses.edit.country')"
                                    :label="trans('shop::app.customers.account.addresses.edit.country')">
                                    @foreach (core()->countries() as $country)
                                        <option {{ $country->code === config('app.default_country') ? 'selected' : '' }} value="{{ $country->code }}">{{ $country->name }}</option>
                                    @endforeach
                                </x-shop::form.control-group.control>
                                <x-shop::form.control-group.error control-name="country" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.account.addresses.edit_form_controls.country.after', ['address' => $address]) !!}

                            <!-- State -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="{{ core()->isStateRequired() ? 'required' : '' }}">
                                    @lang('shop::app.customers.account.addresses.edit.state')
                                </x-shop::form.control-group.label>
                                <template v-if="haveStates()">
                                    <x-shop::form.control-group.control type="select" name="state" id="state"
                                        rules="{{ core()->isStateRequired() ? 'required' : '' }}"
                                        v-model="addressData.state"
                                        :label="trans('shop::app.customers.account.addresses.edit.state')"
                                        :placeholder="trans('shop::app.customers.account.addresses.edit.state')">
                                        <option v-for='(state, index) in countryStates[addressData.country]' :value="state.code">@{{ state.default_name }}</option>
                                    </x-shop::form.control-group.control>
                                </template>
                                <template v-else>
                                    <x-shop::form.control-group.control type="text" name="state"
                                        rules="{{ core()->isStateRequired() ? 'required' : '' }}"
                                        :value="old('state') ?? $address->state"
                                        :label="trans('shop::app.customers.account.addresses.edit.state')"
                                        :placeholder="trans('shop::app.customers.account.addresses.edit.state')" />
                                </template>
                                <x-shop::form.control-group.error control-name="state" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.account.addresses.edit_form_controls.state.after', ['address' => $address]) !!}
                        </div>

                        <div class="kv-form-grid">
                            <!-- City -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="required">
                                    @lang('shop::app.customers.account.addresses.edit.city')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="city" rules="required"
                                    :value="old('city') ?? $address->city"
                                    :label="trans('shop::app.customers.account.addresses.edit.city')"
                                    :placeholder="trans('shop::app.customers.account.addresses.edit.city')" />
                                <x-shop::form.control-group.error control-name="city" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.account.addresses.edit_form_controls.city.after', ['address' => $address]) !!}

                            <!-- Post Code -->
                            <x-shop::form.control-group>
                                <x-shop::form.control-group.label class="{{ core()->isPostCodeRequired() ? 'required' : '' }}">
                                    @lang('shop::app.customers.account.addresses.edit.post-code')
                                </x-shop::form.control-group.label>
                                <x-shop::form.control-group.control type="text" name="postcode"
                                    rules="{{ core()->isPostCodeRequired() ? 'required' : '' }}|numeric "
                                    :value="old('postal-code') ?? $address->postcode"
                                    :label="trans('shop::app.customers.account.addresses.edit.post-code')"
                                    :placeholder="trans('shop::app.customers.account.addresses.edit.post-code')" />
                                <x-shop::form.control-group.error control-name="postcode" />
                            </x-shop::form.control-group>

                            {!! view_render_event('bagisto.shop.customers.account.addresses.edit_form_controls.postcode.after', ['address' => $address]) !!}
                        </div>

                        <!-- Phone -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.customers.account.addresses.edit.phone')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control type="text" name="phone" rules="required|phone"
                                :value="old('phone') ?? $address->phone"
                                :label="trans('shop::app.customers.account.addresses.edit.phone')"
                                :placeholder="trans('shop::app.customers.account.addresses.edit.phone')" />
                            <x-shop::form.control-group.error control-name="phone" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.addresses.edit_form_controls.phone.after', ['address' => $address]) !!}

                        <button type="submit" class="kv-submit-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                            @lang('shop::app.customers.account.addresses.edit.update-btn')
                        </button>

                        {!! view_render_event('bagisto.shop.customers.account.address.edit_form_controls.after', ['address' => $address]) !!}

                    </x-shop::form>
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-edit-customer-address', {
                template: '#v-edit-customer-address-template',
                data() {
                    return {
                        addressData: {
                            country: "{{ old('country') ?? $address->country }}",
                            state: "{{ old('state') ?? $address->state }}",
                        },
                        countryStates: @json(core()->groupedStatesByCountries()),
                    };
                },
                methods: {
                    haveStates() {
                        return !!this.countryStates[this.addressData.country]?.length;
                    },
                },
            });
        </script>
    @endpush

</x-shop::layouts.account>
