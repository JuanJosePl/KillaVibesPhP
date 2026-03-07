<x-shop::layouts.account>
    <!-- Page Title -->
    <x-slot:title>
        @lang('shop::app.customers.account.reviews.title')
    </x-slot>

    <!-- Breadcrumbs -->
    @if ((core()->getConfigData('general.general.breadcrumbs.shop')))
        @section('breadcrumbs')
            <x-shop::breadcrumbs name="reviews" />
        @endSection
    @endif

    @push('styles')
    <style>
        .kv-review-card {
            background: rgba(255,255,255,0.78);
            backdrop-filter: blur(10px);
            border: 1.5px solid rgba(99,102,241,0.12);
            border-radius: 1.25rem;
            padding: 1.5rem;
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
            display: flex; gap: 1.25rem; align-items: flex-start;
            text-decoration: none; color: inherit;
        }
        .kv-review-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 36px rgba(99,102,241,0.12);
            border-color: rgba(99,102,241,0.25);
        }
        .kv-review-img {
            width: 7rem; min-width: 7rem; height: 7rem;
            border-radius: 0.875rem; object-fit: cover;
            border: 1.5px solid rgba(99,102,241,0.10);
            flex-shrink: 0;
        }
        .kv-review-title {
            font-size: 1rem; font-weight: 700; color: var(--foreground); margin: 0;
        }
        .kv-review-date {
            font-size: 0.72rem; color: var(--muted-foreground); margin: 0.3rem 0 0;
        }
        .kv-review-comment {
            font-size: 0.88rem; color: var(--muted-foreground); line-height: 1.7;
            margin: 0.75rem 0 0; flex: 1;
        }
        .kv-verified-badge {
            display: inline-flex; align-items: center; gap: 0.3rem;
            font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;
            padding: 0.2rem 0.6rem; border-radius: 9999px;
            background: rgba(34,197,94,0.10); color: #22c55e;
            border: 1px solid rgba(34,197,94,0.20);
        }
        .kv-star { font-size: 1.1rem; }

        /* Mobile review card */
        .kv-review-card-mobile {
            background: rgba(255,255,255,0.78);
            backdrop-filter: blur(10px);
            border: 1.5px solid rgba(99,102,241,0.12);
            border-radius: 1rem;
            padding: 1rem;
            display: block; text-decoration: none; color: inherit;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .kv-review-card-mobile:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99,102,241,0.10);
        }
        .kv-review-img-sm {
            width: 4.5rem; min-width: 4.5rem; height: 4.5rem;
            border-radius: 0.625rem; object-fit: cover;
            border: 1.5px solid rgba(99,102,241,0.10); flex-shrink: 0;
        }
        .kv-empty-wrap {
            display: flex; flex-direction: column; align-items: center;
            justify-content: center; padding: 5rem 1.5rem; text-align: center; gap: 1rem;
        }
        .kv-empty-icon {
            width: 5rem; height: 5rem; border-radius: 9999px;
            background: linear-gradient(135deg, rgba(99,102,241,0.08), rgba(34,211,238,0.06));
            display: flex; align-items: center; justify-content: center;
            color: #6366f1; border: 1.5px solid rgba(99,102,241,0.15);
        }
        @media (max-width: 768px) {
            .kv-review-card { display: none; }
        }
        @media (min-width: 769px) {
            .kv-review-card-mobile { display: none; }
        }
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
                @lang('shop::app.customers.account.reviews.title')
            </h2>
        </div>

        <!-- Reviews Vue Component -->
        <v-product-reviews>
            <x-shop::shimmer.customers.account.reviews :count="4" />
        </v-product-reviews>
    </div>

    @pushOnce('scripts')
        <script
            type="text/x-template"
            id="v-product-reviews-template"
        >
            <div>
                <template v-if="isLoading">
                    <x-shop::shimmer.customers.account.reviews :count="4" />
                </template>

                {!! view_render_event('bagisto.shop.customers.account.reviews.list.before', ['reviews' => $reviews]) !!}

                <template v-else>
                    @if (! $reviews->isEmpty())
                        <div class="grid gap-4 max-1060:grid-cols-1 max-md:mt-0">
                            @foreach($reviews as $review)
                                {{-- Desktop Card --}}
                                <a
                                    href="{{ route('shop.product_or_category.index', $review->product->url_key) }}"
                                    id="{{ $review->product_id }}"
                                    aria-label="{{ $review->title }}"
                                    class="kv-review-card"
                                >
                                    {!! view_render_event('bagisto.shop.customers.account.reviews.image.before', ['reviews' => $reviews]) !!}

                                    <x-shop::media.images.lazy
                                        class="kv-review-img"
                                        src="{{ $review->product->base_image_url ?? bagisto_asset('images/small-product-placeholder.webp') }}"
                                        alt="Review Image"
                                    />

                                    {!! view_render_event('bagisto.shop.customers.account.reviews.image.after', ['reviews' => $reviews]) !!}

                                    <div style="flex:1;min-width:0;">
                                        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;flex-wrap:wrap;">

                                            {!! view_render_event('bagisto.shop.customers.account.reviews.title.before', ['reviews' => $reviews]) !!}

                                            <p class="kv-review-title">{{ $review->title }}</p>

                                            {!! view_render_event('bagisto.shop.customers.account.reviews.title.after', ['reviews' => $reviews]) !!}

                                            <div style="display:flex;align-items:center;gap:0.5rem;flex-shrink:0;">
                                                {!! view_render_event('bagisto.shop.customers.account.reviews.rating.before', ['reviews' => $reviews]) !!}

                                                <div style="display:flex;gap:1px;">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <span class="icon-star-fill kv-star {{ $review->rating >= $i ? 'text-amber-400' : 'text-zinc-300' }}"></span>
                                                    @endfor
                                                </div>

                                                {!! view_render_event('bagisto.shop.customers.account.reviews.rating.after', ['reviews' => $reviews]) !!}

                                                <span class="kv-verified-badge">✓ Verificado</span>
                                            </div>
                                        </div>

                                        {!! view_render_event('bagisto.shop.customers.account.reviews.created_at.before', ['reviews' => $reviews]) !!}
                                        <p class="kv-review-date">{{ $review->created_at }}</p>
                                        {!! view_render_event('bagisto.shop.customers.account.reviews.created_at.after', ['reviews' => $reviews]) !!}

                                        {!! view_render_event('bagisto.shop.customers.account.reviews.comment.before', ['reviews' => $reviews]) !!}
                                        <p class="kv-review-comment">{{ $review->comment }}</p>
                                        {!! view_render_event('bagisto.shop.customers.account.reviews.comment.after', ['reviews' => $reviews]) !!}
                                    </div>
                                </a>

                                {{-- Mobile Card --}}
                                <a
                                    href="{{ route('shop.product_or_category.index', $review->product->url_key) }}"
                                    id="mobile-{{ $review->product_id }}"
                                    aria-label="{{ $review->title }}"
                                    class="kv-review-card-mobile"
                                >
                                    <div style="display:flex;gap:0.875rem;align-items:flex-start;">
                                        <x-shop::media.images.lazy
                                            class="kv-review-img-sm"
                                            src="{{ $review->product->base_image_url ?? bagisto_asset('images/small-product-placeholder.webp') }}"
                                            alt="Review Image"
                                        />
                                        <div style="flex:1;min-width:0;">
                                            <p style="font-size:0.88rem;font-weight:700;color:var(--foreground);margin:0;">{{ $review->title }}</p>
                                            <p style="font-size:0.68rem;color:var(--muted-foreground);margin:0.2rem 0 0.4rem;">{{ $review->created_at }}</p>
                                            <div style="display:flex;gap:1px;">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span class="icon-star-fill" style="font-size:0.9rem;{{ $review->rating >= $i ? 'color:#fbbf24;' : 'color:#d4d4d8;' }}"></span>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p style="font-size:0.78rem;color:var(--muted-foreground);line-height:1.65;margin:0.75rem 0 0;">{{ $review->comment }}</p>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div style="margin-top:2rem;">
                            {{ $reviews->links() }}
                        </div>
                    @else
                        <div class="kv-empty-wrap">
                            <div class="kv-empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" style="width:2rem;height:2rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                            </div>
                            <div>
                                <p style="font-size:1.1rem;font-weight:700;color:var(--foreground);margin:0 0 0.35rem;">Sin reseñas todavía</p>
                                <p style="font-size:0.82rem;color:var(--muted-foreground);margin:0;">@lang('shop::app.customers.account.reviews.empty-review')</p>
                            </div>
                        </div>
                    @endif
                </template>

                {!! view_render_event('bagisto.shop.customers.account.reviews.list.after', ['reviews' => $reviews]) !!}

            </div>
        </script>

        <script type="module">
            app.component("v-product-reviews", {
                template: '#v-product-reviews-template',
                data() {
                    return { isLoading: true };
                },
                mounted() {
                    this.get();
                },
                methods: {
                    get() {
                        this.$axios.get("{{ route('shop.customers.account.reviews.index') }}")
                            .then(response => { this.isLoading = false; })
                            .catch(error => {});
                    },
                },
            });
        </script>
    @endpushOnce
</x-shop::layouts.account>
