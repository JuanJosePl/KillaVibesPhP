<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.profile.edit.edit-profile')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="profile.edit" />
        @endSection
    @endif

    @push('styles')
    <style>
        .kv-edit-card {
            background: rgba(255,255,255,0.72);
            backdrop-filter: blur(12px);
            border: 1.5px solid rgba(99,102,241,0.12);
            border-radius: 1.25rem;
            box-shadow: 0 4px 24px rgba(99,102,241,0.07);
            overflow: hidden;
        }
        .kv-edit-header {
            background: linear-gradient(135deg, rgba(99,102,241,0.07), rgba(34,211,238,0.05));
            padding: 1.5rem 2rem;
            border-bottom: 1px solid rgba(99,102,241,0.10);
            display: flex; align-items: center; gap: 0.875rem;
        }
        .kv-edit-icon-wrap {
            width: 2.75rem; height: 2.75rem; border-radius: 9999px;
            background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(34,211,238,0.12));
            display: flex; align-items: center; justify-content: center;
            color: #6366f1; border: 1.5px solid rgba(99,102,241,0.18); flex-shrink:0;
        }
        .kv-edit-body { padding: 2rem; }
        .kv-form-section {
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid rgba(226,232,240,0.6);
        }
        .kv-form-section:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
        .kv-section-label {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.07em; color: #6366f1;
            margin-bottom: 1rem;
        }
        .kv-section-label::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(to right, rgba(99,102,241,0.20), transparent);
        }
        .kv-save-btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.85rem 2.5rem; border-radius: 9999px;
            background: linear-gradient(135deg, #6366f1, #22d3ee);
            color: #fff; font-weight: 700; font-size: 0.9rem;
            border: none; cursor: pointer;
            box-shadow: 0 4px 20px rgba(99,102,241,0.30);
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .kv-save-btn:hover {
            transform: scale(1.04);
            box-shadow: 0 8px 28px rgba(99,102,241,0.40);
        }
        .kv-newsletter-row {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.875rem 1rem; border-radius: 0.875rem;
            background: rgba(99,102,241,0.04);
            border: 1px solid rgba(99,102,241,0.10);
            margin-bottom: 1.75rem;
        }
        @media (max-width: 768px) {
            .kv-edit-card { border-radius: 1rem; }
            .kv-edit-header { padding: 1.25rem 1rem; }
            .kv-edit-body { padding: 1.25rem 1rem; }
            .kv-save-btn { width: 100%; justify-content: center; border-radius: 0.875rem; padding: 0.75rem 1.5rem; }
        }
    </style>
    @endpush

    <div class="max-md:hidden">
        <x-shop::layouts.account.navigation />
    </div>

    <div class="mx-4 flex-auto max-md:mx-6 max-sm:mx-4">
        <!-- Page header -->
        <div class="mb-6 flex items-center max-md:mb-4">
            <a class="grid md:hidden" href="{{ route('shop.customers.account.profile.index') }}">
                <span class="icon-arrow-left rtl:icon-arrow-right text-2xl text-[#6366f1]"></span>
            </a>
            <h2 class="text-2xl font-semibold max-md:text-xl max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0" style="color:var(--foreground);">
                @lang('shop::app.customers.account.profile.edit.edit-profile')
            </h2>
        </div>

        {!! view_render_event('bagisto.shop.customers.account.profile.edit.before', ['customer' => $customer]) !!}

        <div class="kv-edit-card">
            <!-- Card Header -->
            <div class="kv-edit-header">
                <div class="kv-edit-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:1.2rem;height:1.2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <p style="font-size:1rem;font-weight:700;color:var(--foreground);margin:0;">Editar Perfil</p>
                    <p style="font-size:0.72rem;color:var(--muted-foreground);margin:0;">Actualiza tu información personal</p>
                </div>
            </div>

            <!-- Form Body -->
            <div class="kv-edit-body">
                <x-shop::form
                    :action="route('shop.customers.account.profile.update')"
                    enctype="multipart/form-data"
                >
                    {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.before', ['customer' => $customer]) !!}

                    <!-- Profile Photo -->
                    <div class="kv-form-section">
                        <div class="kv-section-label">Foto de perfil</div>
                        <x-shop::form.control-group class="mt-4">
                            <x-shop::form.control-group.control
                                type="image"
                                class="max-md:[&>*]:[&>*]:rounded-full mb-0 rounded-xl !p-0 text-gray-700 max-md:grid max-md:justify-center"
                                name="image[]"
                                :label="trans('Image')"
                                :is-multiple="false"
                                accepted-types="image/*"
                                :src="$customer->image_url"
                            />
                            <x-shop::form.control-group.error control-name="image[]" />
                        </x-shop::form.control-group>
                    </div>

                    {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.image.after') !!}

                    <!-- Personal Info -->
                    <div class="kv-form-section">
                        <div class="kv-section-label">Datos Personales</div>

                        <!-- First Name -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.customers.account.profile.edit.first-name')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="text"
                                name="first_name"
                                rules="required"
                                :value="old('first_name') ?? $customer->first_name"
                                :label="trans('shop::app.customers.account.profile.edit.first-name')"
                                :placeholder="trans('shop::app.customers.account.profile.edit.first-name')"
                            />
                            <x-shop::form.control-group.error control-name="first_name" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.first_name.after') !!}

                        <!-- Last Name -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.customers.account.profile.edit.last-name')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="text"
                                name="last_name"
                                rules="required"
                                :value="old('last_name') ?? $customer->last_name"
                                :label="trans('shop::app.customers.account.profile.edit.last-name')"
                                :placeholder="trans('shop::app.customers.account.profile.edit.last-name')"
                            />
                            <x-shop::form.control-group.error control-name="last_name" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.last_name.after') !!}

                        <!-- Email -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.customers.account.profile.edit.email')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="text"
                                name="email"
                                rules="required|email"
                                :value="old('email') ?? $customer->email"
                                :label="trans('shop::app.customers.account.profile.edit.email')"
                                :placeholder="trans('shop::app.customers.account.profile.edit.email')"
                            />
                            <x-shop::form.control-group.error control-name="email" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.email.after') !!}

                        <!-- Phone -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.customers.account.profile.edit.phone')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="text"
                                name="phone"
                                rules="required|phone"
                                :value="old('phone') ?? $customer->phone"
                                :label="trans('shop::app.customers.account.profile.edit.phone')"
                                :placeholder="trans('shop::app.customers.account.profile.edit.phone')"
                            />
                            <x-shop::form.control-group.error control-name="phone" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.phone.after') !!}

                        <!-- Gender -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label class="required">
                                @lang('shop::app.customers.account.profile.edit.gender')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="select"
                                class="mb-3"
                                name="gender"
                                rules="required"
                                :value="old('gender') ?? $customer->gender"
                                :aria-label="trans('shop::app.customers.account.profile.edit.select-gender')"
                                :label="trans('shop::app.customers.account.profile.edit.gender')"
                            >
                                <option value="Other">@lang('shop::app.customers.account.profile.edit.other')</option>
                                <option value="Male">@lang('shop::app.customers.account.profile.edit.male')</option>
                                <option value="Female">@lang('shop::app.customers.account.profile.edit.female')</option>
                            </x-shop::form.control-group.control>
                            <x-shop::form.control-group.error control-name="gender" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.gender.after') !!}

                        <!-- DOB -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label>
                                @lang('shop::app.customers.account.profile.edit.dob')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="date"
                                name="date_of_birth"
                                :value="old('date_of_birth') ?? $customer->date_of_birth"
                                :label="trans('shop::app.customers.account.profile.edit.dob')"
                                :placeholder="trans('shop::app.customers.account.profile.edit.dob')"
                            />
                            <x-shop::form.control-group.error control-name="date_of_birth" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.date_of_birth.after') !!}
                    </div>

                    <!-- Password Section -->
                    <div class="kv-form-section">
                        <div class="kv-section-label">Cambiar Contraseña</div>

                        <!-- Current Password -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label>
                                @lang('shop::app.customers.account.profile.edit.current-password')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="password"
                                name="current_password"
                                value=""
                                :label="trans('shop::app.customers.account.profile.edit.current-password')"
                                :placeholder="trans('shop::app.customers.account.profile.edit.current-password')"
                            />
                            <x-shop::form.control-group.error control-name="current_password" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.old_password.after') !!}

                        <!-- New Password -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label>
                                @lang('shop::app.customers.account.profile.edit.new-password')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="password"
                                name="new_password"
                                value=""
                                :label="trans('shop::app.customers.account.profile.edit.new-password')"
                                :placeholder="trans('shop::app.customers.account.profile.edit.new-password')"
                            />
                            <x-shop::form.control-group.error control-name="new_password" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.new_password.after') !!}

                        <!-- New Password Confirmation -->
                        <x-shop::form.control-group>
                            <x-shop::form.control-group.label>
                                @lang('shop::app.customers.account.profile.edit.confirm-password')
                            </x-shop::form.control-group.label>
                            <x-shop::form.control-group.control
                                type="password"
                                name="new_password_confirmation"
                                rules="confirmed:@new_password"
                                value=""
                                :label="trans('shop::app.customers.account.profile.edit.confirm-password')"
                                :placeholder="trans('shop::app.customers.account.profile.edit.confirm-password')"
                            />
                            <x-shop::form.control-group.error control-name="new_password_confirmation" />
                        </x-shop::form.control-group>

                        {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.new_password_confirmation.after') !!}
                    </div>

                    <!-- Newsletter + Submit -->
                    <div class="kv-newsletter-row">
                        <input
                            type="checkbox"
                            name="subscribed_to_news_letter"
                            id="is-subscribed"
                            class="peer hidden"
                            @checked($customer->subscribed_to_news_letter)
                        />
                        <label
                            class="icon-uncheck peer-checked:icon-check-box cursor-pointer text-2xl text-navyBlue peer-checked:text-navyBlue"
                            for="is-subscribed"
                        ></label>
                        <label class="cursor-pointer select-none text-sm text-zinc-600 max-md:text-xs ltr:pl-0 rtl:pr-0" for="is-subscribed">
                            @lang('shop::app.customers.account.profile.edit.subscribe-to-newsletter')
                        </label>
                    </div>

                    <button type="submit" class="kv-save-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        @lang('shop::app.customers.account.profile.edit.save')
                    </button>

                    {!! view_render_event('bagisto.shop.customers.account.profile.edit_form_controls.after', ['customer' => $customer]) !!}

                </x-shop::form>
            </div>
        </div>

        {!! view_render_event('bagisto.shop.customers.account.profile.edit.after', ['customer' => $customer]) !!}

    </div>
</x-shop::layouts.account>
