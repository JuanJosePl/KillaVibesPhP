{!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.before') !!}

<v-topbar>
    {{-- Shimmer --}}
    <div style="display:flex; align-items:center; justify-content:space-between; padding: 8px 64px; border-bottom: 1px solid rgba(226,232,240,0.5); background:rgba(250,250,251,0.6);">
        <div style="display:flex; align-items:center; gap:8px;">
            <div class="shimmer" style="height:14px; width:48px; border-radius:999px;"></div>
            <div class="shimmer" style="height:14px; width:14px; border-radius:999px;"></div>
        </div>
        <div class="shimmer" style="height:14px; width:220px; border-radius:999px;"></div>
        <div style="display:flex; align-items:center; gap:8px;">
            <div class="shimmer" style="height:14px; width:20px; border-radius:4px;"></div>
            <div class="shimmer" style="height:14px; width:56px; border-radius:999px;"></div>
            <div class="shimmer" style="height:14px; width:14px; border-radius:999px;"></div>
        </div>
    </div>
</v-topbar>

{!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.after') !!}

@pushOnce('scripts')
<script type="text/x-template" id="v-topbar-template">
    <div style="display:flex; align-items:center; justify-content:space-between; padding: 7px 64px; border-bottom: 1px solid rgba(226,232,240,0.5); background:rgba(250,250,251,0.6); font-size:12px;">

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.currency_switcher.before') !!}

        <x-shop::dropdown>
            <x-slot:toggle>
                <div style="display:flex; align-items:center; gap:6px; color:#64748b; font-weight:500; cursor:pointer; transition:color 0.2s;"
                     onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#64748b'"
                     role="button" tabindex="0" @click="currencyToggler = ! currencyToggler">
                    <span>{{ core()->getCurrentCurrency()->symbol . ' ' . core()->getCurrentCurrencyCode() }}</span>
                    <span class="text-base" :class="{'icon-arrow-up': currencyToggler, 'icon-arrow-down': ! currencyToggler}" role="presentation"></span>
                </div>
            </x-slot>
            <x-slot:content class="!p-0">
                <v-currency-switcher></v-currency-switcher>
            </x-slot>
        </x-shop::dropdown>

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.currency_switcher.after') !!}

        <p style="font-weight:500; color:#64748b; font-size:12px;">
            {{ core()->getConfigData('general.content.header_offer.title') }}
            @if ($redirectionTitle = core()->getConfigData('general.content.header_offer.redirection_title'))
                <a href="{{ core()->getConfigData('general.content.header_offer.redirection_link') ?? '#' }}"
                   style="margin-left:4px; font-weight:600; color:#6366f1; text-decoration:underline; text-underline-offset:2px; text-decoration-color:rgba(99,102,241,0.4);">
                    {{ $redirectionTitle }}
                </a>
            @endif
        </p>

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.locale_switcher.before') !!}

        <x-shop::dropdown position="bottom-{{ core()->getCurrentLocale()->direction === 'ltr' ? 'right' : 'left' }}">
            <x-slot:toggle>
                <div style="display:flex; align-items:center; gap:8px; color:#64748b; font-weight:500; cursor:pointer; transition:color 0.2s;"
                     onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#64748b'"
                     role="button" tabindex="0" @click="localeToggler = ! localeToggler">
                    <img src="{{ ! empty(core()->getCurrentLocale()->logo_url) ? core()->getCurrentLocale()->logo_url : bagisto_asset('images/default-language.svg') }}"
                         style="border-radius:2px;" width="20" height="14"
                         alt="@lang('shop::app.components.layouts.header.desktop.top.default-locale')" />
                    <span>{{ core()->getCurrentChannel()->locales()->orderBy('name')->where('code', app()->getLocale())->value('name') }}</span>
                    <span class="text-base" :class="{'icon-arrow-up': localeToggler, 'icon-arrow-down': ! localeToggler}" role="presentation"></span>
                </div>
            </x-slot>
            <x-slot:content class="!p-0">
                <v-locale-switcher></v-locale-switcher>
            </x-slot>
        </x-shop::dropdown>

        {!! view_render_event('bagisto.shop.components.layouts.header.desktop.top.locale_switcher.after') !!}
    </div>
</script>

<script type="text/x-template" id="v-currency-switcher-template">
    <div style="padding: 6px 0;">
        <span v-for="currency in currencies"
              style="display:block; padding: 8px 16px; font-size:13px; font-weight:500; color:#1a1c2d; cursor:pointer; transition: all 0.15s;"
              :style="currency.code == '{{ core()->getCurrentCurrencyCode() }}' ? 'background:rgba(99,102,241,0.08); color:#6366f1;' : ''"
              onmouseover="this.style.backgroundColor='rgba(99,102,241,0.06)'; this.style.color='#6366f1';"
              onmouseout="if(this.getAttribute('data-active')!=='1'){this.style.backgroundColor=''; this.style.color='#1a1c2d';}"
              @click="change(currency)">
            @{{ currency.symbol + ' ' + currency.code }}
        </span>
    </div>
</script>

<script type="text/x-template" id="v-locale-switcher-template">
    <div style="padding: 6px 0;">
        <span v-for="locale in locales"
              style="display:flex; align-items:center; gap:10px; padding: 8px 16px; font-size:13px; font-weight:500; color:#1a1c2d; cursor:pointer; transition: all 0.15s;"
              :style="locale.code == '{{ app()->getLocale() }}' ? 'background:rgba(99,102,241,0.08); color:#6366f1;' : ''"
              onmouseover="this.style.backgroundColor='rgba(99,102,241,0.06)'; this.style.color='#6366f1';"
              onmouseout="this.style.backgroundColor=''; this.style.color='#1a1c2d';"
              @click="change(locale)">
            <img :src="locale.logo_url || '{{ bagisto_asset('images/default-language.svg') }}'" style="border-radius:2px;" width="20" height="14" alt="" />
            @{{ locale.name }}
        </span>
    </div>
</script>

<script type="module">
    app.component('v-topbar', {
        template: '#v-topbar-template',
        data() { return { localeToggler: '', currencyToggler: '' }; },
    });
    app.component('v-currency-switcher', {
        template: '#v-currency-switcher-template',
        data() { return { currencies: @json(core()->getCurrentChannel()->currencies) }; },
        methods: {
            change(currency) {
                let url = new URL(window.location.href);
                url.searchParams.set('currency', currency.code);
                window.location.href = url.href;
            }
        }
    });
    app.component('v-locale-switcher', {
        template: '#v-locale-switcher-template',
        data() { return { locales: @json(core()->getCurrentChannel()->locales()->orderBy('name')->get()) }; },
        methods: {
            change(locale) {
                let url = new URL(window.location.href);
                url.searchParams.set('locale', locale.code);
                window.location.href = url.href;
            }
        }
    });
</script>
@endPushOnce
