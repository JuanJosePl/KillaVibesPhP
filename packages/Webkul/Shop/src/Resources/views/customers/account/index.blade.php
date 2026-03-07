<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.orders.title')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="orders" />
        @endSection
    @endif

    @push('styles')
    <style>
        .kv-account-nav-wrap { padding: 0 1rem; }
        .kv-logout-card {
            max-width: 440px;
            margin: 2rem auto 0;
            border-radius: 1.25rem;
            border: 1.5px solid rgba(99,102,241,0.15);
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(12px);
            box-shadow: 0 4px 24px rgba(99,102,241,0.07);
            overflow: hidden;
        }
        .kv-logout-inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            padding: 2.5rem 2rem;
        }
        .kv-logout-icon {
            width: 3.5rem; height: 3.5rem;
            border-radius: 9999px;
            background: linear-gradient(135deg, rgba(239,68,68,0.10), rgba(249,115,22,0.08));
            border: 1.5px solid rgba(239,68,68,0.18);
            display: flex; align-items: center; justify-content: center;
            color: #ef4444;
        }
        .kv-logout-btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.75rem 2rem; border-radius: 9999px;
            background: linear-gradient(135deg, #ef4444, #f97316);
            color: #fff; font-weight: 700; font-size: 0.9rem;
            text-decoration: none; border: none; cursor: pointer;
            box-shadow: 0 4px 16px rgba(239,68,68,0.25);
            transition: transform 0.2s, box-shadow 0.2s;
            width: 100%;
            justify-content: center;
        }
        .kv-logout-btn:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 24px rgba(239,68,68,0.35);
        }
        .kv-divider {
            width: 100%; height: 1px;
            background: linear-gradient(to right, transparent, rgba(99,102,241,0.15), transparent);
            margin: 0.25rem 0;
        }
    </style>
    @endpush

    <div class="kv-account-nav-wrap">
        <x-shop::layouts.account.navigation />
    </div>

    <span class="mb-5 mt-2 w-full border-t border-zinc-200/70"></span>

    {{-- Customers logout --}}
    @auth('customer')
        <div class="mx-4">
            <div class="kv-logout-card">
                <div class="kv-logout-inner">
                    <div class="kv-logout-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1.5rem;height:1.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>

                    <div style="text-align:center;">
                        <p style="font-size:1rem;font-weight:700;color:var(--foreground);margin:0 0 0.25rem;">
                            @lang('shop::app.components.layouts.header.logout')
                        </p>
                        <p style="font-size:0.8rem;color:var(--muted-foreground);margin:0;">
                            ¿Seguro que deseas cerrar sesión?
                        </p>
                    </div>

                    <div class="kv-divider"></div>

                    <x-shop::form
                        method="DELETE"
                        action="{{ route('shop.customer.session.destroy') }}"
                        id="customerLogout"
                    />

                    <a
                        class="kv-logout-btn"
                        href="{{ route('shop.customer.session.destroy') }}"
                        onclick="event.preventDefault(); document.getElementById('customerLogout').submit();"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        @lang('shop::app.components.layouts.header.logout')
                    </a>
                </div>
            </div>
        </div>
    @endauth

</x-shop::layouts.account>
