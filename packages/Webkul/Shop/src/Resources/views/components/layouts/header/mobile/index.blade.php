@php
    $showCompare  = (bool) core()->getConfigData('catalog.products.settings.compare_option');
    $showWishlist = (bool) core()->getConfigData('customer.settings.wishlist.wishlist_option');
@endphp

<style>
    /* Acción circular mobile */
    .kv-mob-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 9999px;
        color: #6b7280;
        text-decoration: none;
        transition: color 0.2s ease, background-color 0.2s ease;
        cursor: pointer;
    }
    .kv-mob-btn:hover {
        color: #6366f1;
        background-color: rgba(99,102,241,0.10);
    }
</style>

{{-- Solo visible en mobile (oculto en lg+) --}}
<div class="lg:hidden"
     style="display:flex; flex-direction:column; gap:12px; padding:14px 16px 16px;">

    {{-- ── Fila 1: hamburguesa | logo | acciones ── --}}
    <div style="display:flex; align-items:center; justify-content:space-between;">

        {{-- Izquierda: hamburguesa + logo --}}
        <div style="display:flex; align-items:center; gap:8px;">

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.drawer.before') !!}

            <x-shop::drawer position="left" width="100%">
                <x-slot:toggle>
                    <span class="icon-hamburger kv-mob-btn" style="font-size:22px;"></span>
                </x-slot>

                <x-slot:header>
                    <a href="{{ route('shop.home.index') }}">
                        <img src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                             alt="{{ config('app.name') }}" width="120" height="27">
                    </a>
                </x-slot>

                <x-slot:content>
                    {{-- Hero cuenta --}}
                    <div style="display:grid; grid-template-columns:auto 1fr; align-items:center; gap:14px; border:1px solid #f3f4f6; border-radius:12px; padding:12px; margin-bottom:16px; margin-top:8px;">
                        <img src="{{ auth()->user()?->image_url ?? bagisto_asset('images/user-placeholder.png') }}"
                             style="width:54px; height:54px; border-radius:9999px; object-fit:cover;"
                             alt="Perfil">
                        @guest('customer')
                            <a href="{{ route('shop.customer.session.create') }}"
                               style="font-size:14px; font-weight:600; color:#6366f1; text-decoration:none; display:flex; align-items:center; gap:6px;">
                                Inicia sesión o Regístrate
                                <span class="icon-double-arrow" style="font-size:18px;"></span>
                            </a>
                        @endguest
                        @auth('customer')
                            <div>
                                <p style="font-size:18px; font-weight:600; color:#111827; margin-bottom:2px;">
                                    ¡Hola, {{ auth()->user()?->first_name }}!
                                </p>
                                <p style="font-size:12px; color:#9ca3af;">{{ auth()->user()?->email }}</p>
                            </div>
                        @endauth
                    </div>

                    {{-- Links de nav en drawer --}}
                    <nav style="margin-bottom:8px;">
                        @foreach([
                            ['url' => route('shop.home.index'),   'label' => 'Inicio'],
                            ['url' => url('/products'),           'label' => 'Productos'],
                            ['url' => url('/page/categories'),    'label' => 'Categorías'],
                            ['url' => url('/page/ofertas'),       'label' => 'Ofertas', 'hot' => true],
                            ['url' => url('/contact-us'),         'label' => 'Contacto'],
                        ] as $nav)
                            <a href="{{ $nav['url'] }}"
                               style="display:flex; align-items:center; gap:6px; padding:13px 4px; border-bottom:1px solid #f9fafb; font-size:14px; font-weight:500; color:#374151; text-decoration:none; transition:color 0.2s;"
                               onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#374151'">
                                {{ $nav['label'] }}
                                @if(!empty($nav['hot']))
                                    <span style="padding:2px 6px; border-radius:9999px; font-size:9px; font-weight:700; text-transform:uppercase; color:#fff; background:linear-gradient(135deg,#ef4444,#f97316);">Hot</span>
                                @endif
                            </a>
                        @endforeach
                    </nav>

                    {!! view_render_event('bagisto.shop.components.layouts.header.mobile.drawer.categories.before') !!}

                    {{-- Categorías Bagisto dinámicas (en el drawer, bien) --}}
                    <p style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#9ca3af; margin-bottom:8px; padding-top:4px;">
                        Categorías de la tienda
                    </p>
                    <v-mobile-category></v-mobile-category>

                    {!! view_render_event('bagisto.shop.components.layouts.header.mobile.drawer.categories.after') !!}
                </x-slot>

                <x-slot:footer></x-slot>
            </x-shop::drawer>

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.drawer.after') !!}

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.logo.before') !!}

            <a href="{{ route('shop.home.index') }}"
               style="display:flex; align-items:center; text-decoration:none;"
               aria-label="@lang('shop::app.components.layouts.header.bagisto')">
                <img src="{{ core()->getCurrentChannel()->logo_url ?? bagisto_asset('images/logo.svg') }}"
                     style="height:28px; width:auto;"
                     alt="{{ config('app.name') }}" width="131" height="29">
            </a>

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.logo.after') !!}
        </div>

        {{-- Derecha: iconos de acción --}}
        <div style="display:flex; align-items:center; gap:2px;">

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.compare.before') !!}

            @if($showCompare)
                <a href="{{ route('shop.compare.index') }}" class="kv-mob-btn"
                   aria-label="@lang('shop::app.components.layouts.header.compare')">
                    <span class="icon-compare" style="font-size:21px;"></span>
                </a>
            @endif

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.compare.after') !!}

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.mini_cart.before') !!}

            @if(core()->getConfigData('sales.checkout.shopping_cart.cart_page'))
                @include('shop::checkout.cart.mini-cart')
            @endif

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.mini_cart.after') !!}

            {{-- Usuario — dropdown en tablet, link directo en móvil --}}
            <div class="max-md:hidden">
                <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}">
                    <x-slot:toggle>
                        <span class="icon-users kv-mob-btn" style="font-size:21px;"></span>
                    </x-slot>

                    @guest('customer')
                        <x-slot:content>
                            <p class="font-dmserif" style="font-size:20px; color:#111827; margin-bottom:6px;">
                                @lang('shop::app.components.layouts.header.welcome-guest')
                            </p>
                            <p style="font-size:13px; color:#6b7280;">
                                @lang('shop::app.components.layouts.header.dropdown-text')
                            </p>
                            <hr style="margin:14px 0; border:none; border-top:1px solid #f3f4f6;">
                            <div style="display:flex; gap:10px;">
                                <a href="{{ route('shop.customer.session.create') }}"
                                   style="padding:8px 18px; border-radius:9999px; border:1.5px solid #6366f1; color:#6366f1; font-size:13px; font-weight:600; text-decoration:none; transition:all 0.2s; white-space:nowrap;"
                                   onmouseover="this.style.backgroundColor='#6366f1'; this.style.color='#fff';"
                                   onmouseout="this.style.backgroundColor=''; this.style.color='#6366f1';">
                                    @lang('shop::app.components.layouts.header.sign-in')
                                </a>
                                <a href="{{ route('shop.customers.register.index') }}"
                                   style="padding:8px 18px; border-radius:9999px; background:linear-gradient(135deg,#6366f1,#22d3ee); color:#fff; font-size:13px; font-weight:600; text-decoration:none; box-shadow:0 4px 12px rgba(99,102,241,0.3); white-space:nowrap; transition:all 0.2s;"
                                   onmouseover="this.style.transform='scale(1.04)';"
                                   onmouseout="this.style.transform='scale(1)';">
                                    @lang('shop::app.components.layouts.header.sign-up')
                                </a>
                            </div>
                        </x-slot>
                    @endguest

                    @auth('customer')
                        <x-slot:content class="!p-0">
                            <div style="padding:18px 18px 0;">
                                <p class="font-dmserif" style="font-size:20px; color:#111827; margin-bottom:4px;">
                                    @lang('shop::app.components.layouts.header.welcome')'
                                    {{ auth()->guard('customer')->user()->first_name }}
                                </p>
                                <p style="font-size:13px; color:#6b7280;">
                                    @lang('shop::app.components.layouts.header.dropdown-text')
                                </p>
                            </div>
                            <hr style="margin:12px 0; border:none; border-top:1px solid #f3f4f6;">
                            <div style="padding-bottom:8px;">
                                <a href="{{ route('shop.customers.account.profile.index') }}"
                                   style="display:block; padding:9px 18px; font-size:13px; color:#374151; text-decoration:none; transition:all 0.15s;"
                                   onmouseover="this.style.backgroundColor='rgba(99,102,241,0.05)'; this.style.color='#6366f1';"
                                   onmouseout="this.style.backgroundColor=''; this.style.color='#374151';">
                                    @lang('shop::app.components.layouts.header.profile')
                                </a>
                                <a href="{{ route('shop.customers.account.orders.index') }}"
                                   style="display:block; padding:9px 18px; font-size:13px; color:#374151; text-decoration:none; transition:all 0.15s;"
                                   onmouseover="this.style.backgroundColor='rgba(99,102,241,0.05)'; this.style.color='#6366f1';"
                                   onmouseout="this.style.backgroundColor=''; this.style.color='#374151';">
                                    @lang('shop::app.components.layouts.header.orders')
                                </a>
                                @if($showWishlist)
                                    <a href="{{ route('shop.customers.account.wishlist.index') }}"
                                       style="display:block; padding:9px 18px; font-size:13px; color:#374151; text-decoration:none; transition:all 0.15s;"
                                       onmouseover="this.style.backgroundColor='rgba(99,102,241,0.05)'; this.style.color='#6366f1';"
                                       onmouseout="this.style.backgroundColor=''; this.style.color='#374151';">
                                        @lang('shop::app.components.layouts.header.wishlist')
                                    </a>
                                @endif
                                @auth('customer')
                                    <x-shop::form method="DELETE" action="{{ route('shop.customer.session.destroy') }}" id="customerLogoutMobile" />
                                    <a href="{{ route('shop.customer.session.destroy') }}"
                                       style="display:block; padding:9px 18px; font-size:13px; color:#ef4444; text-decoration:none; cursor:pointer; transition:all 0.15s;"
                                       onmouseover="this.style.backgroundColor='rgba(239,68,68,0.05)';"
                                       onmouseout="this.style.backgroundColor='';"
                                       onclick="event.preventDefault(); document.getElementById('customerLogoutMobile').submit();">
                                        @lang('shop::app.components.layouts.header.logout')
                                    </a>
                                @endauth
                            </div>
                        </x-slot>
                    @endauth
                </x-shop::dropdown>
            </div>

            <div class="md:hidden">
                @guest('customer')
                    <a href="{{ route('shop.customer.session.create') }}" class="kv-mob-btn"
                       aria-label="@lang('shop::app.components.layouts.header.account')">
                        <span class="icon-users" style="font-size:21px;"></span>
                    </a>
                @endguest
                @auth('customer')
                    <a href="{{ route('shop.customers.account.index') }}" class="kv-mob-btn"
                       aria-label="@lang('shop::app.components.layouts.header.account')">
                        <span class="icon-users" style="font-size:21px;"></span>
                    </a>
                @endauth
            </div>
        </div>
    </div>

    {{-- ── Fila 2: Buscador ── --}}
    {!! view_render_event('bagisto.shop.components.layouts.header.mobile.search.before') !!}

    <form action="{{ route('shop.search.index') }}"
          style="position:relative; width:100%;"
          role="search">
        <label for="organic-search-mobile" class="sr-only">
            @lang('shop::app.components.layouts.header.search')
        </label>

        <span class="icon-search" style="
            position:absolute;
            left:14px;
            top:50%;
            transform:translateY(-50%);
            font-size:18px;
            color:#9ca3af;
            pointer-events:none;
            z-index:1;
        "></span>

        <input
            type="text"
            id="organic-search-mobile"
            name="query"
            value="{{ request('query') }}"
            placeholder="@lang('shop::app.components.layouts.header.search-text')"
            required
            style="
                width: 100%;
                padding: 11px 16px 11px 42px;
                border-radius: 12px;
                border: 1.5px solid #e5e7eb;
                background-color: #f9fafb;
                font-size: 13px;
                font-weight: 500;
                color: #111827;
                outline: none;
                transition: border-color 0.25s, box-shadow 0.25s, background-color 0.25s;
            "
            onfocus="this.style.borderColor='#6366f1'; this.style.backgroundColor='#fff'; this.style.boxShadow='0 0 0 3px rgba(99,102,241,0.12)';"
            onblur="this.style.borderColor='#e5e7eb'; this.style.backgroundColor='#f9fafb'; this.style.boxShadow='none';"
        >

        @if (core()->getConfigData('catalog.products.settings.image_search'))
            @include('shop::search.images.index')
        @endif
    </form>

    {!! view_render_event('bagisto.shop.components.layouts.header.mobile.search.after') !!}
</div>


@pushOnce('scripts')
<script type="text/x-template" id="v-mobile-category-template">
    <div>
        <template v-for="(category) in categories">
            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.category.before') !!}

            <div style="display:flex; align-items:center; justify-content:space-between; padding:12px 4px; border-bottom:1px solid #f9fafb;">
                <a :href="category.url"
                   style="font-size:13px; font-weight:500; color:#374151; text-decoration:none; transition:color 0.2s;"
                   onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#374151'">
                    @{{ category.name }}
                </a>
                <span style="font-size:18px; color:#9ca3af; cursor:pointer; transition:color 0.2s;"
                      :class="{'icon-arrow-down': category.isOpen, 'icon-arrow-right': ! category.isOpen}"
                      @click="toggle(category)"></span>
            </div>

            <div v-if="category.isOpen" style="padding-left:12px;">
                <ul v-if="category.children.length" style="list-style:none; padding:0; margin:0;">
                    <li v-for="secondLevelCategory in category.children">
                        <div style="display:flex; align-items:center; justify-content:space-between; padding:10px 4px; border-bottom:1px solid #f9fafb;">
                            <a :href="secondLevelCategory.url"
                               style="font-size:13px; color:#6b7280; text-decoration:none; transition:color 0.2s;"
                               onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#6b7280'">
                                @{{ secondLevelCategory.name }}
                            </a>
                            <span style="font-size:16px; color:#d1d5db; cursor:pointer;"
                                  :class="{'icon-arrow-down': secondLevelCategory.category_show, 'icon-arrow-right': ! secondLevelCategory.category_show}"
                                  @click="secondLevelCategory.category_show = ! secondLevelCategory.category_show"></span>
                        </div>
                        <div v-if="secondLevelCategory.category_show" style="padding-left:12px;">
                            <ul v-if="secondLevelCategory.children.length" style="list-style:none; padding:0; margin:0;">
                                <li v-for="thirdLevelCategory in secondLevelCategory.children">
                                    <a :href="thirdLevelCategory.url"
                                       style="display:block; padding:9px 4px; font-size:12px; color:#9ca3af; text-decoration:none; border-bottom:1px solid #f9fafb; transition:color 0.2s;"
                                       onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#9ca3af'">
                                        @{{ thirdLevelCategory.name }}
                                    </a>
                                </li>
                            </ul>
                            <span v-else style="display:block; padding:8px 4px; font-size:12px; color:#9ca3af;">
                                @lang('shop::app.components.layouts.header.no-category-found')
                            </span>
                        </div>
                    </li>
                </ul>
                <span v-else style="display:block; padding:8px 4px; font-size:12px; color:#9ca3af;">
                    @lang('shop::app.components.layouts.header.no-category-found')
                </span>
            </div>

            {!! view_render_event('bagisto.shop.components.layouts.header.mobile.category.after') !!}
        </template>
    </div>

    @if(core()->getCurrentChannel()->locales()->count() > 1 || core()->getCurrentChannel()->currencies()->count() > 1)
        <div style="width:100%; border-top:1px solid #f3f4f6;">
            <div style="position:fixed; bottom:0; left:0; right:0; z-index:10; display:grid; grid-template-columns:1fr auto 1fr; align-items:center; justify-items:center; border-top:1px solid #e5e7eb; background:#fff; padding:0 20px;">
                <x-shop::drawer position="bottom" width="100%">
                    <x-slot:toggle>
                        <div style="padding:14px 10px; font-size:13px; font-weight:600; text-transform:uppercase; color:#374151; cursor:pointer; transition:color 0.2s;"
                             onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#374151'" role="button">
                            {{ core()->getCurrentCurrency()->symbol . ' ' . core()->getCurrentCurrencyCode() }}
                        </div>
                    </x-slot>
                    <x-slot:header>
                        <p style="font-size:16px; font-weight:600; color:#111827;">
                            @lang('shop::app.components.layouts.header.mobile.currencies')
                        </p>
                    </x-slot>
                    <x-slot:content class="!px-0">
                        <div class="overflow-auto" :style="{ height: getCurrentScreenHeight }">
                            <v-currency-switcher></v-currency-switcher>
                        </div>
                    </x-slot>
                </x-shop::drawer>

                <span style="width:1px; height:20px; background:#e5e7eb;"></span>

                <x-shop::drawer position="bottom" width="100%">
                    <x-slot:toggle>
                        <div style="display:flex; align-items:center; gap:8px; padding:14px 10px; font-size:13px; font-weight:600; text-transform:uppercase; color:#374151; cursor:pointer; transition:color 0.2s;"
                             onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#374151'" role="button">
                            <img src="{{ ! empty(core()->getCurrentLocale()->logo_url) ? core()->getCurrentLocale()->logo_url : bagisto_asset('images/default-language.svg') }}"
                                 style="border-radius:2px;" width="18" height="13" alt="Idioma" />
                            {{ core()->getCurrentChannel()->locales()->orderBy('name')->where('code', app()->getLocale())->value('name') }}
                        </div>
                    </x-slot>
                    <x-slot:header>
                        <p style="font-size:16px; font-weight:600; color:#111827;">
                            @lang('shop::app.components.layouts.header.mobile.locales')
                        </p>
                    </x-slot>
                    <x-slot:content class="!px-0">
                        <div class="overflow-auto" :style="{ height: getCurrentScreenHeight }">
                            <v-locale-switcher></v-locale-switcher>
                        </div>
                    </x-slot>
                </x-shop::drawer>
            </div>
        </div>
    @endif
</script>

<script type="module">
    app.component('v-mobile-category', {
        template: '#v-mobile-category-template',
        data() { return { categories: [] }; },
        mounted() { this.get(); },
        computed: {
            getCurrentScreenHeight() {
                return window.innerHeight - (window.innerWidth < 920 ? 61 : 0) + 'px';
            },
        },
        methods: {
            get() {
                this.$axios.get("{{ route('shop.api.categories.tree') }}")
                    .then(response => { this.categories = response.data.data; })
                    .catch(error => { console.log(error); });
            },
            toggle(selectedCategory) {
                this.categories = this.categories.map(cat => ({
                    ...cat,
                    isOpen: cat.id === selectedCategory.id ? !cat.isOpen : false,
                }));
            },
        },
    });
</script>
@endPushOnce
