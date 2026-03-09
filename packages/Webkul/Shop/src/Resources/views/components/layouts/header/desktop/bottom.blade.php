{!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.before') !!}

{{-- ============================================================
     Estilos del nav — inline en el <head> vía <style> tag.
     100% independiente de Tailwind purge.
============================================================ --}}
<style>
    /* ── Nav links ─────────────────────────────────────── */
    .kv-nav-item {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 14px;
        font-size: 14px;
        font-weight: 500;
        color: #4b5563;
        text-decoration: none;
        white-space: nowrap;
        border-radius: 8px;
        transition: color 0.25s ease, background-color 0.25s ease;
    }
    .kv-nav-item:hover {
        color: #6366f1;
        background-color: rgba(99,102,241,0.06);
    }
    .kv-nav-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 14px;
        right: 14px;
        height: 2px;
        border-radius: 9999px;
        background: linear-gradient(90deg, #6366f1, #22d3ee);
        transform: scaleX(0);
        transition: transform 0.3s ease;
        transform-origin: left;
    }
    .kv-nav-item:hover::after {
        transform: scaleX(1);
    }

    /* ── Icono acción circular ──────────────────────────── */
    .kv-action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 9999px;
        color: #6b7280;
        cursor: pointer;
        transition: color 0.25s ease, background-color 0.25s ease, transform 0.25s ease;
        text-decoration: none;
    }
    .kv-action-btn:hover {
        color: #6366f1;
        background-color: rgba(99,102,241,0.10);
        transform: scale(1.08);
    }

    /* ── Badge HOT ─────────────────────────────────────── */
    .kv-badge-hot {
        display: inline-flex;
        align-items: center;
        padding: 2px 7px;
        border-radius: 9999px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #fff;
        background: linear-gradient(135deg, #ef4444, #f97316);
        animation: kvPulse 2s ease-in-out infinite;
    }
    @keyframes kvPulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.75; }
    }
</style>

{{-- ============================================================
     BARRA PRINCIPAL DEL HEADER
============================================================ --}}
<div style="
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 68px;
    padding: 0 60px;
    width: 100%;
">

    {{-- ══════════════════════════════════════════
         IZQUIERDA: Logo + Nav links
    ══════════════════════════════════════════ --}}
    <div style="display:flex; align-items:center; gap:8px;">

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.before') !!}

        {{-- Logo --}}
        <a href="{{ route('shop.home.index') }}"
           style="display:flex; align-items:center; margin-right:24px; flex-shrink:0; text-decoration:none;"
           aria-label="@lang('shop::app.components.layouts.header.bagisto')">
            <img
                src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                style="height:36px; width:auto; transition:transform 0.3s ease;"
                onmouseover="this.style.transform='scale(1.05)'"
                onmouseout="this.style.transform='scale(1)'"
                width="131" height="29"
                alt="{{ config('app.name') }}"
            >
        </a>

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.logo.after') !!}

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.category.before') !!}

        {{-- Nav links --}}
        <nav style="display:flex; align-items:center; gap:10px;" aria-label="Navegación principal">

            <a href="{{ route('shop.home.index') }}" class="kv-nav-item">Inicio</a>

            <a href="{{ url('/collections') }}" class="kv-nav-item">Categorías</a>
            

            <a href="{{ url('/contact-us') }}" class="kv-nav-item">Contacto</a>



        </nav>

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.category.after') !!}
    </div>


    {{-- ══════════════════════════════════════════
         DERECHA: Buscador + Acciones
    ══════════════════════════════════════════ --}}
    <div style="display:flex; align-items:center; gap:12px;">

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.search_bar.before') !!}

        {{-- Buscador --}}
        <form action="{{ route('shop.search.index') }}"
              style="position:relative; display:flex; align-items:center;"
              role="search">

            <label for="organic-search-desktop" class="sr-only">
                @lang('shop::app.components.layouts.header.search')
            </label>

            {{-- Icono lupa --}}
            <span class="icon-search" style="
                position:absolute;
                left:12px;
                top:50%;
                transform:translateY(-50%);
                font-size:16px;
                color:#9ca3af;
                pointer-events:none;
                z-index:1;
            "></span>

            <input
                type="text"
                id="organic-search-desktop"
                name="query"
                value="{{ request('query') }}"
                placeholder="@lang('shop::app.components.layouts.header.search-text')"
                aria-label="@lang('shop::app.components.layouts.header.search-text')"
                aria-required="true"
                required
                minlength="{{ core()->getConfigData('catalog.products.search.min_query_length') }}"
                maxlength="{{ core()->getConfigData('catalog.products.search.max_query_length') }}"
                style="
                    width: 260px;
                    padding: 9px 16px 9px 38px;
                    border-radius: 9999px;
                    border: 1.5px solid #e5e7eb;
                    background-color: #f9fafb;
                    font-size: 13px;
                    font-weight: 500;
                    color: #111827;
                    outline: none;
                    transition: border-color 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
                "
                onfocus="
                    this.style.borderColor='#6366f1';
                    this.style.backgroundColor='#fff';
                    this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';
                "
                onblur="
                    this.style.borderColor='#e5e7eb';
                    this.style.backgroundColor='#f9fafb';
                    this.style.boxShadow='none';
                "
            >

            <button type="submit" style="display:none;"
                    aria-label="@lang('shop::app.components.layouts.header.submit')"></button>

            @if (core()->getConfigData('catalog.products.settings.image_search'))
                @include('shop::search.images.index')
            @endif
        </form>

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.search_bar.after') !!}

        {{-- Acciones: Compare + Cart + User ──────── --}}
        <div style="display:flex; align-items:center; gap:4px;">

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.compare.before') !!}

            @if(core()->getConfigData('catalog.products.settings.compare_option'))
                <a href="{{ route('shop.compare.index') }}"
                   class="kv-action-btn"
                   aria-label="@lang('shop::app.components.layouts.header.compare')">
                    <span class="icon-compare" style="font-size:22px;" role="presentation"></span>
                </a>
            @endif

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.compare.after') !!}

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.mini_cart.before') !!}

            @if(core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                @include('shop::checkout.cart.mini-cart')
            @endif

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.mini_cart.after') !!}

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile.before') !!}

            {{-- Dropdown usuario --}}
            <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}">
                <x-slot:toggle>
                    <span class="icon-users kv-action-btn"
                          style="font-size:22px;"
                          role="button"
                          aria-label="@lang('shop::app.components.layouts.header.profile')"
                          tabindex="0"></span>
                </x-slot>

                {{-- Guest --}}
                @guest('customer')
                    <x-slot:content>
                        <p class="font-dmserif" style="font-size:20px; color:#111827; margin-bottom:6px;">
                            @lang('shop::app.components.layouts.header.welcome-guest')
                        </p>
                        <p style="font-size:13px; color:#6b7280; margin-bottom:0;">
                            @lang('shop::app.components.layouts.header.dropdown-text')
                        </p>
                        <hr style="margin:14px 0; border:none; border-top:1px solid #f3f4f6;">

                        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.customers_action.before') !!}

                        <div style="display:flex; gap:10px; margin-top:4px;">
                            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.sign_in_button.before') !!}

                            <a href="{{ route('shop.customer.session.create') }}"
                               style="
                                   display:inline-block;
                                   padding: 8px 20px;
                                   border-radius: 9999px;
                                   border: 1.5px solid #6366f1;
                                   color: #6366f1;
                                   font-size: 13px;
                                   font-weight: 600;
                                   text-align:center;
                                   text-decoration:none;
                                   white-space:nowrap;
                                   transition: all 0.25s ease;
                               "
                               onmouseover="this.style.backgroundColor='#6366f1'; this.style.color='#fff';"
                               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#6366f1';">
                                @lang('shop::app.components.layouts.header.sign-in')
                            </a>

                            <a href="{{ route('shop.customers.register.index') }}"
                               style="
                                   display:inline-block;
                                   padding: 8px 20px;
                                   border-radius: 9999px;
                                   background: linear-gradient(135deg, #6366f1, #22d3ee);
                                   color: #fff;
                                   font-size: 13px;
                                   font-weight: 600;
                                   text-align:center;
                                   text-decoration:none;
                                   white-space:nowrap;
                                   box-shadow: 0 4px 14px rgba(99,102,241,0.3);
                                   transition: all 0.25s ease;
                               "
                               onmouseover="this.style.transform='scale(1.04)'; this.style.boxShadow='0 6px 20px rgba(99,102,241,0.4)';"
                               onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 14px rgba(99,102,241,0.3)';">
                                @lang('shop::app.components.layouts.header.sign-up')
                            </a>

                            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.sign_up_button.after') !!}
                        </div>

                        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.customers_action.after') !!}
                    </x-slot>
                @endguest

                {{-- Autenticado --}}
                @auth('customer')
                    <x-slot:content class="!p-0">
                        <div style="padding:20px 20px 0;">
                            <p class="font-dmserif" style="font-size:20px; color:#111827; margin-bottom:6px;">
                                @lang('shop::app.components.layouts.header.welcome')'
                                {{ auth()->guard('customer')->user()->first_name }}
                            </p>
                            <p style="font-size:13px; color:#6b7280;">
                                @lang('shop::app.components.layouts.header.dropdown-text')
                            </p>
                        </div>
                        <hr style="margin:12px 0; border:none; border-top:1px solid #f3f4f6;">

                        <div style="padding-bottom:10px;">
                            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile_dropdown.links.before') !!}

                            @foreach([
                                ['route' => 'shop.customers.account.profile.index', 'label' => 'shop::app.components.layouts.header.profile'],
                                ['route' => 'shop.customers.account.orders.index',  'label' => 'shop::app.components.layouts.header.orders'],
                            ] as $link)
                                <a href="{{ route($link['route']) }}"
                                   style="display:block; padding:9px 20px; font-size:13px; font-weight:500; color:#374151; text-decoration:none; transition:all 0.15s;"
                                   onmouseover="this.style.backgroundColor='rgba(99,102,241,0.05)'; this.style.color='#6366f1';"
                                   onmouseout="this.style.backgroundColor=''; this.style.color='#374151';">
                                    @lang($link['label'])
                                </a>
                            @endforeach

                            @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                                <a href="{{ route('shop.customers.account.wishlist.index') }}"
                                   style="display:block; padding:9px 20px; font-size:13px; font-weight:500; color:#374151; text-decoration:none; transition:all 0.15s;"
                                   onmouseover="this.style.backgroundColor='rgba(99,102,241,0.05)'; this.style.color='#6366f1';"
                                   onmouseout="this.style.backgroundColor=''; this.style.color='#374151';">
                                    @lang('shop::app.components.layouts.header.wishlist')
                                </a>
                            @endif

                            @auth('customer')
                                <x-shop::form method="DELETE"
                                              action="{{ route('shop.customer.session.destroy') }}"
                                              id="customerLogout" />
                                <a href="{{ route('shop.customer.session.destroy') }}"
                                   style="display:block; padding:9px 20px; font-size:13px; font-weight:500; color:#ef4444; text-decoration:none; transition:all 0.15s; cursor:pointer;"
                                   onmouseover="this.style.backgroundColor='rgba(239,68,68,0.05)';"
                                   onmouseout="this.style.backgroundColor='';"
                                   onclick="event.preventDefault(); document.getElementById('customerLogout').submit();">
                                    @lang('shop::app.components.layouts.header.logout')
                                </a>
                            @endauth

                            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile_dropdown.links.after') !!}
                        </div>
                    </x-slot>
                @endauth
            </x-shop::dropdown>

            {!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.profile.after') !!}
        </div>
    </div>
</div>

{!! view_render_event('bagisto.shop.components.layouts.header.desktop.bottom.after') !!}
