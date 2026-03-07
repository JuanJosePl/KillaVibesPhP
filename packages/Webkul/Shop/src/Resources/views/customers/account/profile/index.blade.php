<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.profile.index.title')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="profile" />
        @endSection
    @endif

    @push('styles')
    <style>
        .kv-profile-card {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(12px);
            border: 1.5px solid rgba(99,102,241,0.12);
            border-radius: 1.25rem;
            box-shadow: 0 4px 24px rgba(99,102,241,0.07);
            overflow: hidden;
        }
        .kv-profile-header {
            background: linear-gradient(135deg, rgba(99,102,241,0.07), rgba(34,211,238,0.05));
            padding: 1.75rem 2rem;
            border-bottom: 1px solid rgba(99,102,241,0.10);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .kv-profile-title-wrap { display: flex; align-items: center; gap: 0.875rem; }
        .kv-profile-icon-wrap {
            width: 2.75rem; height: 2.75rem; border-radius: 9999px;
            background: linear-gradient(135deg, rgba(99,102,241,0.15), rgba(34,211,238,0.12));
            display: flex; align-items: center; justify-content: center;
            color: #6366f1;
            border: 1.5px solid rgba(99,102,241,0.18);
            flex-shrink: 0;
        }
        .kv-section-title {
            font-size: 1.1rem; font-weight: 700; color: var(--foreground); margin: 0;
        }
        .kv-edit-btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1.25rem; border-radius: 9999px;
            border: 1.5px solid rgba(99,102,241,0.25); color: #6366f1;
            font-weight: 600; font-size: 0.82rem;
            text-decoration: none; background: rgba(99,102,241,0.04);
            transition: background 0.25s, transform 0.2s, box-shadow 0.2s;
        }
        .kv-edit-btn:hover {
            background: rgba(99,102,241,0.10);
            transform: scale(1.03);
            box-shadow: 0 4px 14px rgba(99,102,241,0.15);
        }
        .kv-profile-fields { padding: 1.25rem 0; }
        .kv-profile-row {
            display: grid;
            grid-template-columns: 1fr 1.6fr;
            padding: 0.85rem 2rem;
            border-bottom: 1px solid rgba(226,232,240,0.6);
            align-items: center;
            transition: background 0.2s;
        }
        .kv-profile-row:last-child { border-bottom: none; }
        .kv-profile-row:hover { background: rgba(99,102,241,0.025); }
        .kv-label {
            font-size: 0.78rem; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.05em;
            color: var(--muted-foreground);
        }
        .kv-value {
            font-size: 0.9rem; font-weight: 500; color: var(--foreground);
        }
        .kv-delete-section {
            padding: 1.5rem 2rem;
            border-top: 1px solid rgba(226,232,240,0.6);
            background: rgba(239,68,68,0.02);
        }
        .kv-delete-btn-desktop {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.6rem 1.5rem; border-radius: 9999px;
            background: rgba(239,68,68,0.08);
            border: 1.5px solid rgba(239,68,68,0.20);
            color: #ef4444; font-weight: 600; font-size: 0.82rem;
            cursor: pointer; transition: background 0.25s, transform 0.2s;
        }
        .kv-delete-btn-desktop:hover {
            background: rgba(239,68,68,0.14);
            transform: scale(1.03);
        }
        @media (max-width: 768px) {
            .kv-profile-card { border-radius: 1rem; }
            .kv-profile-header { padding: 1.25rem 1rem; }
            .kv-profile-row { grid-template-columns: 1fr 1fr; padding: 0.75rem 1rem; }
            .kv-delete-section { padding: 1.25rem 1rem; }
        }
    </style>
    @endpush

    <div class="max-md:hidden">
        <x-shop::layouts.account.navigation />
    </div>

    <div class="mx-4 flex-auto max-md:mx-6 max-sm:mx-4">

        {{-- Mobile back + title --}}
        <div class="mb-6 flex items-center justify-between max-md:mb-4">
            <div class="flex items-center gap-2.5">
                <a class="grid md:hidden" href="{{ route('shop.customers.account.index') }}">
                    <span class="icon-arrow-left rtl:icon-arrow-right text-2xl text-[#6366f1]"></span>
                </a>
                <h2 class="text-2xl font-semibold max-md:text-xl max-sm:text-base" style="color:var(--foreground);">
                    @lang('shop::app.customers.account.profile.index.title')
                </h2>
            </div>

            {!! view_render_event('bagisto.shop.customers.account.profile.edit_button.before') !!}

            <a href="{{ route('shop.customers.account.profile.edit') }}" class="kv-edit-btn max-sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.9rem;height:0.9rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                @lang('shop::app.customers.account.profile.index.edit')
            </a>

            {!! view_render_event('bagisto.shop.customers.account.profile.edit_button.after') !!}
        </div>

        <!-- Profile Card -->
        <div class="kv-profile-card">
            <div class="kv-profile-header">
                <div class="kv-profile-title-wrap">
                    <div class="kv-profile-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.2rem;height:1.2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="kv-section-title">Información Personal</p>
                        <p style="font-size:0.72rem;color:var(--muted-foreground);margin:0;">Datos de tu cuenta KillaVibes</p>
                    </div>
                </div>

                <a href="{{ route('shop.customers.account.profile.edit') }}" class="kv-edit-btn sm:hidden max-sm:flex">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:0.9rem;height:0.9rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    @lang('shop::app.customers.account.profile.index.edit')
                </a>
            </div>

            <div class="kv-profile-fields">

                {!! view_render_event('bagisto.shop.customers.account.profile.first_name.before') !!}
                <div class="kv-profile-row">
                    <p class="kv-label">@lang('shop::app.customers.account.profile.index.first-name')</p>
                    <p class="kv-value">{{ $customer->first_name }}</p>
                </div>
                {!! view_render_event('bagisto.shop.customers.account.profile.first_name.after') !!}

                {!! view_render_event('bagisto.shop.customers.account.profile.last_name.before') !!}
                <div class="kv-profile-row">
                    <p class="kv-label">@lang('shop::app.customers.account.profile.index.last-name')</p>
                    <p class="kv-value">{{ $customer->last_name }}</p>
                </div>
                {!! view_render_event('bagisto.shop.customers.account.profile.last_name.after') !!}

                {!! view_render_event('bagisto.shop.customers.account.profile.gender.before') !!}
                <div class="kv-profile-row">
                    <p class="kv-label">@lang('shop::app.customers.account.profile.index.gender')</p>
                    <p class="kv-value">{{ $customer->gender ?? '-' }}</p>
                </div>
                {!! view_render_event('bagisto.shop.customers.account.profile.gender.after') !!}

                {!! view_render_event('bagisto.shop.customers.account.profile.date_of_birth.before') !!}
                <div class="kv-profile-row">
                    <p class="kv-label">@lang('shop::app.customers.account.profile.index.dob')</p>
                    <p class="kv-value">{{ $customer->date_of_birth ?? '-' }}</p>
                </div>
                {!! view_render_event('bagisto.shop.customers.account.profile.date_of_birth.after') !!}

                {!! view_render_event('bagisto.shop.customers.account.profile.email.before') !!}
                <div class="kv-profile-row">
                    <p class="kv-label">@lang('shop::app.customers.account.profile.index.email')</p>
                    <p class="kv-value" style="word-break:break-all;">{{ $customer->email }}</p>
                </div>
                {!! view_render_event('bagisto.shop.customers.account.profile.email.after') !!}

            </div>

            <!-- Delete Section -->
            {!! view_render_event('bagisto.shop.customers.account.profile.delete.before') !!}

            <div class="kv-delete-section">
                <x-shop::form action="{{ route('shop.customers.account.profile.destroy') }}">
                    <x-shop::modal>
                        <x-slot:toggle>
                            <!-- Desktop -->
                            <div class="kv-delete-btn-desktop max-md:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.9rem;height:0.9rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                @lang('shop::app.customers.account.profile.index.delete-profile')
                            </div>
                            <!-- Mobile -->
                            <div class="w-full py-2.5 text-center text-sm font-semibold text-red-500 md:hidden">
                                @lang('shop::app.customers.account.profile.index.delete-profile')
                            </div>
                        </x-slot>

                        <x-slot:header>
                            <h2 class="text-xl font-semibold max-md:text-base" style="color:var(--foreground);">
                                @lang('shop::app.customers.account.profile.index.enter-password')
                            </h2>
                        </x-slot>

                        <x-slot:content>
                            <x-shop::form.control-group class="!mb-0">
                                <x-shop::form.control-group.control
                                    type="password"
                                    name="password"
                                    class="px-6 py-4"
                                    rules="required"
                                    placeholder="Enter your password"
                                />
                                <x-shop::form.control-group.error class="text-left" control-name="password" />
                            </x-shop::form.control-group>
                        </x-slot>

                        <x-slot:footer>
                            <button
                                type="submit"
                                class="primary-button flex rounded-2xl px-11 py-3 max-md:rounded-lg max-md:px-6 max-md:text-sm"
                            >
                                @lang('shop::app.customers.account.profile.index.delete')
                            </button>
                        </x-slot>
                    </x-shop::modal>
                </x-shop::form>
            </div>

            {!! view_render_event('bagisto.shop.customers.account.profile.delete.after') !!}
        </div>

    </div>
</x-shop::layouts.account>
