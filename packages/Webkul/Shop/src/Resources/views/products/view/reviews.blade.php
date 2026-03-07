@push('styles')
<style>
    /* ═══════════════════════════════════════════
       KILLAVIBES — PRODUCT REVIEWS
       ═══════════════════════════════════════════ */

    @keyframes kvrvFadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Review card ── */
    .kvrv-card {
        position: relative;
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
        border: 2px solid rgba(226,232,240,0.55);
        border-radius: 1.25rem;
        padding: 1.5rem;
        box-shadow: 0 4px 20px -4px rgba(99,102,241,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        animation: kvrvFadeUp 0.5s cubic-bezier(0.16,1,0.3,1) both;
    }
    .kvrv-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 40px -10px rgba(99,102,241,0.18);
        border-color: rgba(99,102,241,0.25);
    }
    .kvrv-card__corner {
        position: absolute; top: 0; right: 0;
        width: 6rem; height: 6rem;
        background: linear-gradient(135deg, rgba(99,102,241,0.07), transparent);
        border-radius: 0 1.25rem 0 100%;
        pointer-events: none;
    }

    /* ── Avatar ── */
    .kvrv-avatar {
        width: 3.5rem; height: 3.5rem; border-radius: 9999px;
        border: 2px solid rgba(226,232,240,0.6);
        background: linear-gradient(135deg, rgba(99,102,241,0.08), rgba(34,211,238,0.08));
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        font-size: 1rem; font-weight: 700;
        color: #6366f1;
    }
    .kvrv-avatar img { width: 100%; height: 100%; object-fit: cover; border-radius: 9999px; }

    /* ── Rating stars ── */
    .kvrv-stars { display: flex; align-items: center; gap: 0.1rem; }

    /* ── Stat block ── */
    .kvrv-stat {
        text-align: center;
        padding: 1.5rem;
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(8px);
        border: 2px solid rgba(226,232,240,0.55);
        border-radius: 1.25rem;
        box-shadow: 0 4px 20px -4px rgba(99,102,241,0.08);
    }
    .kvrv-stat__score {
        font-family: var(--font-heading), 'DM Serif Display', serif;
        font-size: 3.5rem; font-weight: 800;
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        line-height: 1.1;
    }

    /* ── Bar chart ── */
    .kvrv-bar-track {
        flex: 1; height: 0.5rem; border-radius: 9999px;
        background: rgba(226,232,240,0.7); overflow: hidden;
    }
    .kvrv-bar-fill {
        height: 100%; border-radius: 9999px;
        background: linear-gradient(135deg, #6366f1, #22d3ee);
    }

    /* ── Write review button ── */
    .kvrv-write-btn {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.7rem 1.5rem;
        font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;
        color: #6366f1;
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(8px);
        border: 2px solid rgba(99,102,241,0.30);
        border-radius: 9999px;
        box-shadow: 0 4px 16px -4px rgba(99,102,241,0.15);
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%; justify-content: center;
    }
    .kvrv-write-btn:hover {
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        color: white; border-color: transparent;
        box-shadow: 0 8px 24px -6px rgba(99,102,241,0.40);
    }

    /* ── Load more ── */
    .kvrv-load-more {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.7rem 2rem;
        font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em;
        color: #6366f1;
        background: rgba(255,255,255,0.92);
        border: 2px solid rgba(99,102,241,0.30);
        border-radius: 9999px;
        cursor: pointer; transition: all 0.3s ease;
    }
    .kvrv-load-more:hover {
        background: linear-gradient(135deg, #6366f1, #22d3ee);
        color: white; border-color: transparent;
        box-shadow: 0 8px 24px -6px rgba(99,102,241,0.35);
    }

    /* ── Translate btn ── */
    .kvrv-translate-btn {
        display: inline-flex; align-items: center; gap: 0.4rem;
        padding: 0.35rem 0.85rem;
        font-size: 0.75rem; font-weight: 600;
        color: rgba(99,102,241,0.7);
        background: rgba(99,102,241,0.06);
        border: 1.5px solid rgba(99,102,241,0.15);
        border-radius: 0.6rem;
        cursor: pointer; transition: all 0.2s;
    }
    .kvrv-translate-btn:hover {
        background: rgba(99,102,241,0.12);
        color: #6366f1;
        border-color: rgba(99,102,241,0.30);
    }

    /* ── Form section ── */
    .kvrv-form-section {
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(8px);
        border: 2px solid rgba(226,232,240,0.55);
        border-radius: 1.25rem;
        padding: 2rem;
        box-shadow: 0 4px 20px -4px rgba(99,102,241,0.10);
    }

    /* ── Empty state ── */
    .kvrv-empty {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        padding: 4rem 1rem; text-align: center;
        background: rgba(255,255,255,0.7);
        border: 2px solid rgba(226,232,240,0.5);
        border-radius: 1.25rem;
    }
</style>
@endpush

{!! view_render_event('bagisto.shop.products.view.reviews.after', ['product' => $product]) !!}

<v-product-reviews>
    <div class="container max-1180:px-5">
        <x-shop::shimmer.products.reviews />
    </div>
</v-product-reviews>

{!! view_render_event('bagisto.shop.products.view.reviews.after', ['product' => $product]) !!}

@pushOnce('scripts')
    <script type="text/x-template" id="v-product-reviews-template">
        <div class="container max-1180:mt-4 max-1180:px-5 max-md:px-4 max-sm:px-3.5">

            <!-- ── Write Review Form ── -->
            <div class="w-full" v-if="canReview">
                <div class="kvrv-form-section">
                    <div class="mb-5 flex items-center gap-3">
                        <div style="width:0.35rem;height:2rem;border-radius:9999px;background:linear-gradient(135deg,#6366f1,#22d3ee);"></div>
                        <h3 style="font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:var(--foreground);">
                            @lang('shop::app.products.view.reviews.write-a-review')
                        </h3>
                    </div>

                    <x-shop::form v-slot="{ meta, errors, handleSubmit }" as="div">
                        <form
                            class="grid grid-cols-[auto_1fr] justify-center gap-8 max-md:grid-cols-[1fr] max-md:gap-4"
                            @submit="handleSubmit($event, store)"
                            enctype="multipart/form-data"
                        >
                            <div class="max-w-[260px] max-md:max-w-full">
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.control
                                        type="image"
                                        class="!mb-0 !p-0 max-md:gap-1.5"
                                        name="attachments"
                                        :label="trans('shop::app.products.view.reviews.attachments')"
                                        :is-multiple="true"
                                        ref="reviewImages"
                                    />
                                    <x-shop::form.control-group.error class="mt-3" control-name="attachments" />
                                </x-shop::form.control-group>
                            </div>

                            <div>
                                <!-- Rating Stars -->
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.label class="required mt-0 text-sm font-semibold uppercase tracking-wider">
                                        @lang('shop::app.products.view.reviews.rating')
                                    </x-shop::form.control-group.label>

                                    <div class="flex gap-1 mt-1">
                                        <span
                                            class="icon-star-fill cursor-pointer text-2xl transition-colors"
                                            role="presentation"
                                            v-for="rating in [1,2,3,4,5]"
                                            :class="appliedRatings >= rating ? 'text-amber-500' : 'text-[rgba(226,232,240,0.9)]'"
                                            @click="appliedRatings = rating"
                                        ></span>
                                    </div>

                                    <v-field type="hidden" name="rating" v-model="appliedRatings"></v-field>
                                    <x-shop::form.control-group.error control-name="rating" />
                                </x-shop::form.control-group>

                                <!-- Guest Name -->
                                @if (
                                    core()->getConfigData('catalog.products.review.guest_review')
                                    && ! auth()->guard('customer')->user()
                                )
                                    <x-shop::form.control-group>
                                        <x-shop::form.control-group.label class="required text-sm font-semibold uppercase tracking-wider">
                                            @lang('shop::app.products.view.reviews.name')
                                        </x-shop::form.control-group.label>
                                        <x-shop::form.control-group.control
                                            type="text"
                                            name="name"
                                            rules="required"
                                            :value="old('name')"
                                            :label="trans('shop::app.products.view.reviews.name')"
                                            :placeholder="trans('shop::app.products.view.reviews.name')"
                                        />
                                        <x-shop::form.control-group.error control-name="name" />
                                    </x-shop::form.control-group>
                                @endif

                                <!-- Title -->
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.label class="required text-sm font-semibold uppercase tracking-wider">
                                        @lang('shop::app.products.view.reviews.title')
                                    </x-shop::form.control-group.label>
                                    <x-shop::form.control-group.control
                                        type="text"
                                        name="title"
                                        rules="required"
                                        :value="old('title')"
                                        :label="trans('shop::app.products.view.reviews.title')"
                                        :placeholder="trans('shop::app.products.view.reviews.title')"
                                    />
                                    <x-shop::form.control-group.error control-name="title" />
                                </x-shop::form.control-group>

                                <!-- Comment -->
                                <x-shop::form.control-group>
                                    <x-shop::form.control-group.label class="required text-sm font-semibold uppercase tracking-wider">
                                        @lang('shop::app.products.view.reviews.comment')
                                    </x-shop::form.control-group.label>
                                    <x-shop::form.control-group.control
                                        type="textarea"
                                        name="comment"
                                        rules="required"
                                        :value="old('comment')"
                                        :label="trans('shop::app.products.view.reviews.comment')"
                                        :placeholder="trans('shop::app.products.view.reviews.comment')"
                                        rows="8"
                                    />
                                    <x-shop::form.control-group.error control-name="comment" />
                                </x-shop::form.control-group>

                                <div class="mt-5 flex gap-3 max-sm:flex-col">
                                    <button
                                        style="flex:1;padding:0.8rem 1.5rem;font-size:0.8rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;background:linear-gradient(135deg,#6366f1,#22d3ee);color:white;border:none;border-radius:9999px;cursor:pointer;box-shadow:0 4px 16px -4px rgba(99,102,241,0.40);transition:box-shadow 0.2s;"
                                        type="submit"
                                    >
                                        @lang('shop::app.products.view.reviews.submit-review')
                                    </button>

                                    <button
                                        type="button"
                                        class="kvrv-write-btn"
                                        style="flex:none;width:auto;"
                                        @click="canReview = false"
                                    >
                                        @lang('shop::app.products.view.reviews.cancel')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </x-shop::form>
                </div>
            </div>

            <!-- ── Reviews List ── -->
            <div v-else>
                <template v-if="isLoading">
                    <x-shop::shimmer.products.reviews />
                </template>

                <template v-else>
                    <template v-if="reviews.length">

                        <!-- Heading -->
                        <div class="mb-8 flex items-center gap-3 max-md:mb-5">
                            <div style="width:0.35rem;height:2.2rem;border-radius:9999px;background:linear-gradient(135deg,#6366f1,#22d3ee);"></div>
                            <h3 style="font-family:var(--font-heading),'DM Serif Display',serif;font-size:1.5rem;font-weight:700;color:var(--foreground);">
                                @lang('shop::app.products.view.reviews.customer-review')
                                <span style="font-size:1rem;font-weight:600;color:rgba(99,102,241,0.65);margin-left:0.5rem;">
                                    ({{ $reviewHelper->getTotalReviews($product) }})
                                </span>
                            </h3>
                        </div>

                        <div class="flex gap-12 max-lg:flex-wrap max-sm:gap-5">

                            <!-- Left: Stats -->
                            <div class="sticky top-24 flex h-max flex-col gap-4 max-lg:relative max-lg:top-auto max-md:w-full" style="min-width:260px;max-width:300px;">

                                <!-- Score Card -->
                                <div class="kvrv-stat">
                                    <div class="kvrv-stat__score">{{ $avgRatings }}</div>
                                    <div class="kvrv-stars justify-center my-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="icon-star-fill text-2xl {{ $avgRatings >= $i ? 'text-amber-500' : 'text-[rgba(226,232,240,0.9)]' }}"></span>
                                        @endfor
                                    </div>
                                    <p style="font-size:0.8rem;color:var(--muted-foreground);">
                                        {{ $reviewHelper->getTotalFeedback($product) }}
                                        @lang('shop::app.products.view.reviews.ratings')
                                    </p>
                                </div>

                                <!-- Star Bars -->
                                <div style="display:grid;gap:0.6rem;">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <div style="display:flex;align-items:center;gap:0.65rem;">
                                            <span style="font-size:0.78rem;font-weight:700;color:var(--foreground);white-space:nowrap;min-width:1.5rem;">{{ $i }}★</span>
                                            <div class="kvrv-bar-track">
                                                <div class="kvrv-bar-fill" style="width:{{ $percentageRatings[$i] }}%;"></div>
                                            </div>
                                            <span style="font-size:0.72rem;color:var(--muted-foreground);min-width:2rem;text-align:right;">{{ $percentageRatings[$i] }}%</span>
                                        </div>
                                    @endfor
                                </div>

                                <!-- Write Review Button -->
                                @if(core()->getConfigData('catalog.products.review.customer_review'))
                                    @if (
                                        core()->getConfigData('catalog.products.review.guest_review')
                                        || auth()->guard('customer')->user()
                                    )
                                        <div class="kvrv-write-btn" @click="canReview = true">
                                            <span class="icon-pen text-lg"></span>
                                            @lang('shop::app.products.view.reviews.write-a-review')
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <!-- Right: Review Cards -->
                            <div class="flex w-full flex-col gap-4">
                                <v-product-review-item
                                    v-for="review in reviews"
                                    :review="review"
                                ></v-product-review-item>

                                <div class="flex justify-center mt-4" v-if="links?.next">
                                    <button class="kvrv-load-more" @click="get()">
                                        @lang('shop::app.products.view.reviews.load-more')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Empty -->
                    <template v-else>
                        <div class="kvrv-empty">
                            <img
                                style="width:6rem;height:6rem;opacity:0.3;margin-bottom:1.25rem;"
                                src="{{ bagisto_asset('images/review.png') }}"
                                alt=""
                            >
                            <p style="font-size:1rem;font-weight:600;color:var(--muted-foreground);">
                                @lang('shop::app.products.view.reviews.empty-review')
                            </p>

                            @if(core()->getConfigData('catalog.products.review.customer_review'))
                                @if (
                                    core()->getConfigData('catalog.products.review.guest_review')
                                    || auth()->guard('customer')->user()
                                )
                                    <div class="kvrv-write-btn mt-6" style="width:auto;" @click="canReview = true">
                                        <span class="icon-pen text-lg"></span>
                                        @lang('shop::app.products.view.reviews.write-a-review')
                                    </div>
                                @endif
                            @endif
                        </div>
                    </template>
                </template>
            </div>
        </div>
    </script>

    <!-- Review Item Template -->
    <script type="text/x-template" id="v-product-review-item-template">

        <!-- Desktop -->
        <div class="kvrv-card max-md:hidden">
            <div class="kvrv-card__corner"></div>

            <div class="flex gap-4 items-start">
                <div class="kvrv-avatar">
                    <template v-if="review.profile">
                        <img :src="review.profile" :alt="review.name" :title="review.name">
                    </template>
                    <template v-else>
                        @{{ review.name.split(' ').map(name => name.charAt(0).toUpperCase()).join('') }}
                    </template>
                </div>

                <div style="flex:1;min-width:0;">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p style="font-size:0.95rem;font-weight:700;color:var(--foreground);">@{{ review.name }}</p>
                            <p style="font-size:0.75rem;color:var(--muted-foreground);margin-top:0.15rem;">@{{ review.created_at }}</p>
                        </div>
                        <div class="kvrv-stars flex-shrink-0">
                            <span
                                class="icon-star-fill text-xl"
                                v-for="rating in [1,2,3,4,5]"
                                :class="review.rating >= rating ? 'text-amber-500' : 'text-[rgba(226,232,240,0.9)]'"
                            ></span>
                        </div>
                    </div>

                    <div style="height:1px;background:linear-gradient(to right,rgba(99,102,241,0.12),transparent);margin:0.85rem 0;"></div>

                    <p style="font-size:0.95rem;font-weight:600;color:var(--foreground);margin-bottom:0.4rem;">@{{ review.title }}</p>
                    <p style="font-size:0.88rem;color:var(--muted-foreground);line-height:1.7;">@{{ review.comment }}</p>

                    <button class="kvrv-translate-btn mt-3" @click="translate">
                        <template v-if="isLoading">
                            <img class="h-4 w-4 animate-spin" src="{{ bagisto_asset('images/spinner.svg') }}" />
                            @lang('shop::app.products.view.reviews.translating')
                        </template>
                        <template v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" role="presentation">
                                <g clip-path="url(#clip0_3148_2242)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.1484 9.31989L9.31995 12.1483L19.9265 22.7549L22.755 19.9265L12.1484 9.31989ZM12.1484 10.7341L10.7342 12.1483L13.5626 14.9767L14.9768 13.5625L12.1484 10.7341Z" fill="#6366f1"/>
                                    <path d="M11.0877 3.30949L13.5625 4.44748L16.0374 3.30949L14.8994 5.78436L16.0374 8.25924L13.5625 7.12124L11.0877 8.25924L12.2257 5.78436L11.0877 3.30949Z" fill="#6366f1"/>
                                    <path d="M2.39219 2.39217L5.78438 3.95197L9.17656 2.39217L7.61677 5.78436L9.17656 9.17655L5.78438 7.61676L2.39219 9.17655L3.95198 5.78436L2.39219 2.39217Z" fill="#6366f1"/>
                                    <path d="M3.30947 11.0877L5.78434 12.2257L8.25922 11.0877L7.12122 13.5626L8.25922 16.0374L5.78434 14.8994L3.30947 16.0374L4.44746 13.5626L3.30947 11.0877Z" fill="#6366f1"/>
                                </g>
                                <defs><clipPath id="clip0_3148_2242"><rect width="24" height="24" fill="white"/></clipPath></defs>
                            </svg>
                            @lang('shop::app.products.view.reviews.translate')
                        </template>
                    </button>

                    <!-- Attachments -->
                    <div class="mt-3 flex flex-wrap gap-2" v-if="review.images.length">
                        <template v-for="(file, index) in review.images">
                            <div class="flex h-14 w-14" target="_blank" v-if="file.type == 'image'">
                                <img
                                    style="width:3.5rem;height:3.5rem;object-fit:cover;border-radius:0.65rem;cursor:pointer;border:1.5px solid rgba(226,232,240,0.6);"
                                    :src="file.url"
                                    :alt="review.name"
                                    @click="isImageZooming = !isImageZooming; activeIndex = index"
                                >
                            </div>
                            <div class="flex h-14 w-14" target="_blank" v-else>
                                <video
                                    style="width:3.5rem;height:3.5rem;object-fit:cover;border-radius:0.65rem;cursor:pointer;"
                                    :src="file.url"
                                    @click="isImageZooming = !isImageZooming; activeIndex = index"
                                ></video>
                            </div>
                        </template>
                    </div>

                    <x-shop::image-zoomer
                        ::attachments="attachments"
                        ::is-image-zooming="isImageZooming"
                        ::initial-index="'file_'+activeIndex"
                    />
                </div>
            </div>
        </div>

        <!-- Mobile -->
        <div class="md:hidden">
            <div style="background:rgba(255,255,255,0.92);border:2px solid rgba(226,232,240,0.55);border-radius:1rem;padding:1rem;box-shadow:0 4px 16px -4px rgba(99,102,241,0.08);">
                <div class="flex items-center gap-2.5">
                    <div class="kvrv-avatar" style="width:2.5rem;height:2.5rem;font-size:0.8rem;">
                        <img v-if="review.profile" :src="review.profile" :alt="review.name" :title="review.name">
                        <template v-else>
                            @{{ review.name.split(' ').map(name => name.charAt(0).toUpperCase()).join('') }}
                        </template>
                    </div>

                    <div>
                        <p style="font-size:0.88rem;font-weight:700;color:var(--foreground);">@{{ review.name }}</p>
                        <p style="font-size:0.7rem;color:var(--muted-foreground);">@{{ review.created_at }}</p>
                    </div>
                </div>

                <div class="kvrv-stars mt-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="icon-star-fill text-lg {{ $avgRatings >= $i ? 'text-amber-500' : 'text-[rgba(226,232,240,0.9)]' }}"></span>
                    @endfor
                </div>

                <div style="height:1px;background:linear-gradient(to right,rgba(99,102,241,0.12),transparent);margin:0.65rem 0;"></div>

                <p style="font-size:0.85rem;font-weight:600;color:var(--foreground);margin-bottom:0.25rem;">@{{ review.title }}</p>
                <p style="font-size:0.82rem;color:var(--muted-foreground);line-height:1.6;">@{{ review.comment }}</p>

                <button class="kvrv-translate-btn mt-2.5" @click="translate">
                    <template v-if="isLoading">
                        <img class="h-4 w-4 animate-spin" src="{{ bagisto_asset('images/spinner.svg') }}" />
                        @lang('shop::app.products.view.reviews.translating')
                    </template>
                    <template v-else>
                        @lang('shop::app.products.view.reviews.translate')
                    </template>
                </button>

                <div class="mt-3 flex gap-2 overflow-auto" v-if="review.images.length">
                    <template v-for="file in review.images">
                        <a :href="file.url" class="flex h-16 w-16 flex-shrink-0" target="_blank" v-if="file.type == 'image'">
                            <img style="width:4rem;height:4rem;object-fit:cover;border-radius:0.65rem;" :src="file.url" :alt="review.name">
                        </a>
                        <a :href="file.url" class="flex h-16 w-16 flex-shrink-0" target="_blank" v-else>
                            <video style="width:4rem;height:4rem;object-fit:cover;border-radius:0.65rem;" :src="file.url"></video>
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </script>

    <script type="module">
        app.component('v-product-reviews', {
            template: '#v-product-reviews-template',

            data() {
                return {
                    isLoading: true,
                    appliedRatings: 5,
                    canReview: false,
                    reviews: [],
                    links: {
                        next: '{{ route('shop.api.products.reviews.index', $product->id) }}',
                    },
                    meta: {},
                }
            },

            mounted() { this.get(); },

            methods: {
                get() {
                    if (! this.links?.next) { return; }
                    this.$axios.get(this.links.next)
                        .then(response => {
                            this.isLoading = false;
                            this.reviews = [...this.reviews, ...response.data.data];
                            this.links = response.data.links;
                            this.meta = response.data.meta;
                        })
                        .catch(error => {});
                },

                store(params, { resetForm, setErrors }) {
                    let selectedFiles = this.$refs.reviewImages.uploadedFiles.filter(obj => obj.file instanceof File).map(obj => obj.file);
                    params.attachments = { ...params.attachments, ...selectedFiles };

                    this.$axios.post('{{ route('shop.api.products.reviews.store', $product->id) }}', params, {
                            headers: { 'Content-Type': 'multipart/form-data' }
                        })
                        .then(response => {
                            this.$emitter.emit('add-flash', { type: 'success', message: response.data.data.message });
                            resetForm();
                            this.canReview = false;
                        })
                        .catch(error => {
                            setErrors({'attachments': ["@lang('shop::app.products.view.reviews.failed-to-upload')"]});
                            this.$refs.reviewImages.uploadedFiles.forEach(element => {
                                setTimeout(() => { this.$refs.reviewImages.removeFile(); }, 0);
                            });
                        });
                },
            },
        });

        app.component('v-product-review-item', {
            template: '#v-product-review-item-template',

            props: ['review'],

            data() {
                return {
                    isLoading: false,
                    isImageZooming: false,
                    activeIndex: 0,
                }
            },

            computed: {
                attachments() {
                    return [...this.review.images].map((file) => ({
                        url: file.url,
                        type: file.type,
                    }));
                }
            },

            methods: {
                translate() {
                    this.isLoading = true;
                    this.$axios.get("{{ route('shop.api.products.reviews.translate', ['id' => $product->id, 'review_id' => ':reviewId']) }}".replace(':reviewId', this.review.id))
                        .then(response => {
                            this.isLoading = false;
                            this.review.comment = response.data.content;
                        })
                        .catch(error => {
                            this.isLoading = false;
                            this.$emitter.emit('add-flash', { type: 'error', message: error.response.data.message });
                        });
                },
            },
        });
    </script>
@endPushOnce
