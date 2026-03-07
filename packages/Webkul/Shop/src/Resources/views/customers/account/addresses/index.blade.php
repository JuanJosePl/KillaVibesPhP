<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.addresses.index.add-address')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="addresses" />
        @endSection
    @endif

    @push('styles')
    <style>
        .kv-addr-card {
            background: rgba(255,255,255,0.72);
            backdrop-filter: blur(10px);
            border: 1.5px solid rgba(99,102,241,0.12);
            border-radius: 1.25rem;
            box-shadow: 0 4px 20px rgba(99,102,241,0.07);
            padding: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
            position: relative;
            overflow: hidden;
        }
        .kv-addr-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 36px rgba(99,102,241,0.14);
            border-color: rgba(99,102,241,0.25);
        }
        .kv-addr-card::before {
            content: '';
            position: absolute; top: 0; left: 0;
            width: 3px; height: 100%;
            background: linear-gradient(to bottom, #6366f1, #22d3ee);
            opacity: 0; transition: opacity 0.3s;
        }
        .kv-addr-card:hover::before { opacity: 1; }
        .kv-addr-name { font-size: 0.95rem; font-weight: 700; color: var(--foreground); margin: 0; }
        .kv-addr-text { font-size: 0.82rem; color: var(--muted-foreground); line-height: 1.65; margin-top: 0.75rem; }
        .kv-default-badge {
            display: inline-flex; align-items: center; gap: 0.3rem;
            font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em;
            padding: 0.2rem 0.65rem; border-radius: 9999px;
            background: linear-gradient(135deg, rgba(99,102,241,0.12), rgba(34,211,238,0.10));
            border: 1px solid rgba(99,102,241,0.22); color: #6366f1;
        }
        .kv-add-btn {
            display: inline-flex; align-items: center; gap: 0.45rem;
            padding: 0.6rem 1.25rem; border-radius: 9999px;
            background: linear-gradient(135deg, rgba(99,102,241,0.10), rgba(34,211,238,0.08));
            border: 1.5px solid rgba(99,102,241,0.22); color: #6366f1;
            font-weight: 600; font-size: 0.82rem; text-decoration: none;
            transition: background 0.25s, transform 0.2s, box-shadow 0.2s;
        }
        .kv-add-btn:hover {
            background: rgba(99,102,241,0.12);
            transform: scale(1.03);
            box-shadow: 0 4px 14px rgba(99,102,241,0.18);
        }
        .kv-empty-wrap {
            display: flex; flex-direction: column; align-items: center;
            justify-content: center; padding: 5rem 1.5rem; text-align: center;
            gap: 1rem;
        }
        .kv-empty-icon {
            width: 5rem; height: 5rem; border-radius: 9999px;
            background: linear-gradient(135deg, rgba(99,102,241,0.08), rgba(34,211,238,0.06));
            display: flex; align-items: center; justify-content: center;
            color: #6366f1; border: 1.5px solid rgba(99,102,241,0.15);
        }
    </style>
    @endpush

    <div class="max-md:hidden">
        <x-shop::layouts.account.navigation />
    </div>

    <div class="mx-4 flex-auto">
        <!-- Header -->
        <div class="mb-7 flex items-center justify-between max-md:mb-5">
            <div class="flex items-center gap-2.5">
                <a class="grid md:hidden" href="{{ route('shop.customers.account.index') }}">
                    <span class="icon-arrow-left rtl:icon-arrow-right text-2xl text-[#6366f1]"></span>
                </a>
                <h2 class="text-2xl font-semibold max-md:text-xl max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0" style="color:var(--foreground);">
                    @lang('shop::app.customers.account.addresses.index.title')
                </h2>
            </div>

            <a href="{{ route('shop.customers.account.addresses.create') }}" class="kv-add-btn">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:0.9rem;height:0.9rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                @lang('shop::app.customers.account.addresses.index.add-address')
            </a>
        </div>

        @if (! $addresses->isEmpty())

            {!! view_render_event('bagisto.shop.customers.account.addresses.list.before', ['addresses' => $addresses]) !!}

            <div class="mt-2 grid grid-cols-2 gap-5 max-1060:grid-cols-1 max-md:mt-0">
                @foreach ($addresses as $address)
                    <div class="kv-addr-card">
                        <!-- Card top -->
                        <div class="flex items-start justify-between gap-3 mb-4">
                            <div class="flex items-center gap-2 flex-wrap">
                                <p class="kv-addr-name">
                                    {{ $address->first_name }} {{ $address->last_name }}
                                    @if ($address->company_name)
                                        <span style="font-weight:500;color:var(--muted-foreground);font-size:0.82rem;">({{ $address->company_name }})</span>
                                    @endif
                                </p>
                                @if ($address->default_address)
                                    <div class="kv-default-badge">
                                        <svg xmlns="http://www.w3.org/2000/svg" style="width:0.6rem;height:0.6rem;fill:#6366f1;" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        @lang('shop::app.customers.account.addresses.index.default-address')
                                    </div>
                                @endif
                            </div>

                            <!-- Dropdown Actions -->
                            <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}">
                                <x-slot:toggle>
                                    <button
                                        class="icon-more cursor-pointer rounded-lg px-1.5 py-1 text-xl text-zinc-400 transition-all hover:bg-gray-100 hover:text-[#6366f1]"
                                        aria-label="More Options"
                                    ></button>
                                </x-slot>
                                <x-slot:menu class="!py-1 max-sm:!py-0">
                                    <x-shop::dropdown.menu.item>
                                        <a href="{{ route('shop.customers.account.addresses.edit', $address->id) }}">
                                            <p class="w-full">@lang('shop::app.customers.account.addresses.index.edit')</p>
                                        </a>
                                    </x-shop::dropdown.menu.item>

                                    <x-shop::dropdown.menu.item>
                                        <form method="POST" ref="addressDelete" action="{{ route('shop.customers.account.addresses.delete', $address->id) }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <a href="javascript:void(0);" @click="$emitter.emit('open-confirm-modal', { agree: () => { $refs['addressDelete'].submit() } })">
                                            <p class="w-full">@lang('shop::app.customers.account.addresses.index.delete')</p>
                                        </a>
                                    </x-shop::dropdown.menu.item>

                                    @if (! $address->default_address)
                                        <x-shop::dropdown.menu.item>
                                            <form method="POST" ref="setAsDefault" action="{{ route('shop.customers.account.addresses.update.default', $address->id) }}">
                                                @method('PATCH')
                                                @csrf
                                            </form>
                                            <a href="javascript:void(0);" @click="$emitter.emit('open-confirm-modal', { agree: () => { $refs['setAsDefault'].submit() } })">
                                                <button>@lang('shop::app.customers.account.addresses.index.set-as-default')</button>
                                            </a>
                                        </x-shop::dropdown.menu.item>
                                    @endif
                                </x-slot>
                            </x-shop::dropdown>
                        </div>

                        <!-- Address text -->
                        <p class="kv-addr-text">
                            {{ $address->address }},<br>
                            {{ $address->city }}, {{ $address->state }},<br>
                            {{ $address->country }}@if ($address->postcode) &nbsp;({{ $address->postcode }})@endif
                        </p>
                    </div>
                @endforeach
            </div>

            {!! view_render_event('bagisto.shop.customers.account.addresses.list.after', ['addresses' => $addresses]) !!}

        @else
            <!-- Empty State -->
            <div class="kv-empty-wrap">
                <div class="kv-empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:2rem;height:2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p style="font-size:1.1rem;font-weight:700;color:var(--foreground);margin:0 0 0.35rem;">Sin direcciones guardadas</p>
                    <p style="font-size:0.82rem;color:var(--muted-foreground);margin:0;">
                        @lang('shop::app.customers.account.addresses.index.empty-address')
                    </p>
                </div>
                <a href="{{ route('shop.customers.account.addresses.create') }}" class="kv-add-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:0.9rem;height:0.9rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    @lang('shop::app.customers.account.addresses.index.add-address')
                </a>
            </div>
        @endif
    </div>
</x-shop::layouts.account>
