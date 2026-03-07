<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.downloadable-products.name')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="downloadable-products" />
        @endSection
    @endif

    @push('styles')
    <style>
        .kv-dl-card {
            background: rgba(255,255,255,0.78);
            backdrop-filter: blur(10px);
            border: 1.5px solid rgba(99,102,241,0.12);
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
            margin-bottom: 0.875rem;
        }
        .kv-dl-card:last-child { margin-bottom: 0; }
        .kv-dl-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99,102,241,0.10);
            border-color: rgba(99,102,241,0.22);
        }
        .kv-dl-order-id { font-size: 0.88rem; font-weight: 700; color: var(--foreground); }
        .kv-dl-date { font-size: 0.7rem; color: var(--muted-foreground); margin-top: 0.15rem; }
        .kv-dl-product { font-size: 0.88rem; font-weight: 700; color: #6366f1; }
        .kv-dl-meta { font-size: 0.72rem; color: var(--muted-foreground); margin-top: 0.2rem; }
        .kv-dl-meta span { font-weight: 600; color: var(--foreground); }
    </style>
    @endpush

    <div class="max-md:hidden">
        <x-shop::layouts.account.navigation />
    </div>

    <div class="mx-4 flex-auto max-md:mx-6 max-sm:mx-4">
        <!-- Header -->
        <div class="mb-7 flex items-center max-md:mb-4">
            <a class="grid md:hidden" href="{{ route('shop.customers.account.index') }}">
                <span class="icon-arrow-left rtl:icon-arrow-right text-2xl text-[#6366f1]"></span>
            </a>
            <h2 class="text-2xl font-semibold max-md:text-xl max-sm:text-base ltr:ml-2.5 md:ltr:ml-0 rtl:mr-2.5 md:rtl:mr-0" style="color:var(--foreground);">
                @lang('shop::app.customers.account.downloadable-products.name')
            </h2>
        </div>

        {!! view_render_event('bagisto.shop.customers.account.downloadable_products.list.before') !!}

        <!-- Desktop Datagrid -->
        <div class="max-md:hidden">
            <x-shop::datagrid :src="route('shop.customers.account.downloadable_products.index')" />
        </div>

        <!-- Mobile Cards -->
        <div class="hidden max-md:block">
            <x-shop::datagrid :src="route('shop.customers.account.downloadable_products.index')">
                <template #header="{ isLoading, available, applied, selectAll, sort, performAction }">
                    <div class="hidden"></div>
                </template>

                <template #body="{ isLoading, available, applied, selectAll, sort, performAction }">
                    <template v-if="isLoading">
                        <x-shop::shimmer.datagrid.table.body />
                    </template>

                    <template v-else>
                        <div>
                            <template v-for="record in available.records" v-if="available.records.length">
                                <div class="kv-dl-card">
                                    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:0.75rem;margin-bottom:0.75rem;">
                                        <div>
                                            <p class="kv-dl-order-id">
                                                @lang('shop::app.customers.account.downloadable-products.orderId'): #@{{ record.increment_id }}
                                            </p>
                                            <p class="kv-dl-date">@{{ record.created_at }}</p>
                                        </div>
                                        <div v-html="record.status"></div>
                                    </div>
                                    <div style="padding-top:0.75rem;border-top:1px solid rgba(226,232,240,0.6);">
                                        <p class="kv-dl-product" v-html="record.product_name"></p>
                                        <p class="kv-dl-meta">
                                            @lang('Remaining Downloads'):
                                            <span>@{{ record.remaining_downloads }}</span>
                                        </p>
                                    </div>
                                </div>
                            </template>

                            <template v-else>
                                <div style="text-align:center;padding:3rem 1.5rem;color:var(--muted-foreground);font-size:0.88rem;">
                                    @{{ available.records.length }} @lang('shop::app.customers.account.downloadable-products.records-found')
                                </div>
                            </template>
                        </div>
                    </template>
                </template>
            </x-shop::datagrid>
        </div>

        {!! view_render_event('bagisto.shop.customers.account.downloadable_products.list.after') !!}
    </div>
</x-shop::layouts.account>
