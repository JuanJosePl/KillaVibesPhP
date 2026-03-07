@push('styles')
<style>
    /* ═══════════════════════════════════════════
       KILLAVIBES — PRODUCT GALLERY
       ═══════════════════════════════════════════ */

    /* ── Thumbnail strip ── */
    .kvgl-thumb-wrap {
        display: flex;
        flex-direction: column;
        min-width: 88px;
        max-width: 88px;
        gap: 0.5rem;
        align-items: center;
    }

    .kvgl-thumb-scroll {
        display: flex;
        flex-direction: column;
        max-height: 520px;
        gap: 0.5rem;
        overflow: auto;
        scroll-behavior: smooth;
        scrollbar-width: none;
    }

    .kvgl-thumb-scroll::-webkit-scrollbar {
        display: none;
    }

    .kvgl-thumb-arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 9999px;
        border: 1.5px solid rgba(226, 232, 240, 0.7);
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(6px);
        cursor: pointer;
        font-size: 1rem;
        color: var(--foreground);
        transition: border-color 0.2s, background 0.2s, color 0.2s;
        flex-shrink: 0;
    }

    .kvgl-thumb-arrow:hover {
        border-color: rgba(99, 102, 241, 0.35);
        background: rgba(99, 102, 241, 0.06);
        color: #6366f1;
    }

    /* ── Thumbnail item ── */
    .kvgl-thumb {
        width: 80px;
        height: 80px;
        border-radius: 0.85rem;
        overflow: hidden;
        border: 2px solid transparent;
        cursor: pointer;
        transition: border-color 0.25s, box-shadow 0.25s, transform 0.25s;
        flex-shrink: 0;
        background: rgba(226, 232, 240, 0.3);
    }

    .kvgl-thumb:hover {
        border-color: rgba(99, 102, 241, 0.30);
        transform: scale(1.04);
    }

    .kvgl-thumb--active {
        border-color: #6366f1 !important;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }

    .kvgl-thumb img,
    .kvgl-thumb video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ── Main image ── */
    .kvgl-main-wrap {
        position: relative;
        border: 2px solid rgba(226, 232, 240, 0.55);
        border-radius: 1.5rem;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.04), rgba(34, 211, 238, 0.04));
        box-shadow: 0 8px 40px -10px rgba(99, 102, 241, 0.15);
        max-width: 540px;
        max-height: 600px;
    }

    .kvgl-main-wrap img,
    .kvgl-main-wrap video {
        width: 100%;
        cursor: zoom-in;
        border-radius: 1.4rem;
    }

    /* ── Shimmer ── */
    .kvgl-shimmer {
        border-radius: 1.5rem;
        overflow: hidden;
        background: rgba(226, 232, 240, 0.5);
        min-height: 580px;
        min-width: 540px;
    }

    /* ── Mobile gallery ── */
    .kvgl-mobile-wrap {
        overflow: hidden;
        border-radius: 0;
    }

    .kvgl-mobile-scroll {
        display: flex;
        overflow-x: auto;
        gap: 1rem;
        scroll-snap-type: x mandatory;
        scrollbar-width: none;
    }

    .kvgl-mobile-scroll::-webkit-scrollbar {
        display: none;
    }

    .kvgl-mobile-item {
        flex-shrink: 0;
        width: 100%;
        scroll-snap-align: center;
    }

    /* ── Fix: Gallery visibility by breakpoint ── */
    @media (min-width: 1180px) {

        .kvgl-mobile-wrap,
        .kvgl-mobile-scroll {
            display: none !important;
        }
    }

    @media (max-width: 1179px) {
        .kvgl-desktop-wrap {
            display: none !important;
        }
    }
</style>
@endpush

<v-product-gallery ref="gallery">
    <x-shop::shimmer.products.gallery />
</v-product-gallery>

@pushOnce('scripts')
<script type="text/x-template" id="v-product-gallery-template">
    <div>
            <!-- ── Desktop: ≥ 1180px ── -->
            <div class="kvgl-desktop-wrap sticky top-20 flex h-max gap-5">

                <!-- Thumbnail Strip -->
                <div class="kvgl-thumb-wrap">
                    <button
                        class="kvgl-thumb-arrow icon-arrow-up"
                        role="button"
                        aria-label="@lang('shop::app.components.products.carousel.previous')"
                        tabindex="0"
                        @click="swipeDown"
                        v-if="lengthOfMedia"
                    ></button>

                    <div ref="swiperContainer" class="kvgl-thumb-scroll">
                        <template v-for="(media, index) in [...media.images, ...media.videos]">
                            <div
                                class="kvgl-thumb"
                                :class="{ 'kvgl-thumb--active': isActiveMedia(index) }"
                                @click="change(media, index)"
                                tabindex="0"
                            >
                                <video
                                    v-if="media.type == 'videos'"
                                    alt="{{ $product->name }}"
                                >
                                    <source :src="media.video_url" type="video/mp4" />
                                </video>
                                <img
                                    v-else
                                    :src="media.small_image_url"
                                    alt="{{ $product->name }}"
                                    width="80"
                                    height="80"
                                />
                            </div>
                        </template>
                    </div>

                    <button
                        class="kvgl-thumb-arrow icon-arrow-down"
                        v-if="lengthOfMedia"
                        role="button"
                        aria-label="@lang('shop::app.components.products.carousel.previous')"
                        tabindex="0"
                        @click="swipeTop"
                    ></button>
                </div>

                <!-- Main Image — Shimmer -->
                <div class="kvgl-main-wrap" v-show="isMediaLoading">
                    <div class="kvgl-shimmer shimmer"></div>
                </div>

                <!-- Main Image — Loaded -->
                <div class="kvgl-main-wrap" v-show="! isMediaLoading">
                    <img
                        v-if="baseFile.type == 'image'"
                        :src="baseFile.path"
                        alt="{{ $product->name }}"
                        width="540"
                        height="600"
                        tabindex="0"
                        style="min-width:440px;"
                        @click="isImageZooming = !isImageZooming"
                        @load="onMediaLoad()"
                    />

                    <div v-if="baseFile.type == 'video'" tabindex="0">
                        <video
                            controls
                            width="540"
                            alt="{{ $product->name }}"
                            @click="isImageZooming = !isImageZooming"
                            @loadeddata="onMediaLoad()"
                            :key="baseFile.path"
                        >
                            <source :src="baseFile.path" type="video/mp4" />
                        </video>
                    </div>
                </div>
            </div>

            <!-- ── Mobile: < 1180px ── -->
            <div class="kvgl-mobile-wrap overflow-hidden" v-show="isMediaLoading">
                <div class="shimmer aspect-square max-h-screen w-screen bg-[rgba(226,232,240,0.5)]"></div>
            </div>

            <div class="kvgl-mobile-scroll w-screen gap-6 max-sm:gap-4" v-show="! isMediaLoading">
                <template
                    v-if="media.images.length + media.videos.length <= 1"
                    v-for="(media, index) in [...media.images, ...media.videos]"
                >
                    <div class="kvgl-mobile-item">
                        <video
                            v-if="media.type == 'videos'"
                            alt="{{ $product->name }}"
                            controls
                            @click="isImageZooming = !isImageZooming"
                            class="w-full"
                        >
                            <source :src="media.video_url" type="video/mp4" />
                        </video>

                        <img
                            v-else
                            :src="media.large_image_url"
                            alt="{{ $product->name }}"
                            width="490"
                            height="550"
                            @click="isImageZooming = !isImageZooming"
                            class="w-full"
                        />
                    </div>
                </template>

                <x-shop::products.mobile.carousel
                    v-else
                    ::options="[...media.images, ...media.videos]"
                    @click="isImageZooming = !isImageZooming"
                />
            </div>

            <!-- Zoomer -->
            <x-shop::image-zoomer
                ::attachments="attachments"
                ::is-image-zooming="isImageZooming"
                ::initial-index="`media_${activeIndex}`"
            />
        </div>
    </script>

@php
$galleryImages = product_image()->getGalleryImages($product);
$galleryVideos = product_video()->getVideos($product);
@endphp

<script type="module">
    app.component('v-product-gallery', {
        template: '#v-product-gallery-template',

        data() {
            return {
                isImageZooming: false,

                isMediaLoading: true,

                media: {
                    images: @json($galleryImages),

                    videos: @json($galleryVideos),
                },

                baseFile: {
                    type: '',
                    path: ''
                },

                activeIndex: 0,

                containerOffset: 110,
            };
        },

        watch: {
            'media.images': {
                deep: true,
                handler(newImages, oldImages) {
                    let selectedImage = newImages?.[this.activeIndex];
                    if (JSON.stringify(newImages) !== JSON.stringify(oldImages) && selectedImage?.large_image_url) {
                        this.baseFile.path = selectedImage.large_image_url;
                    }
                },
            },
        },

        mounted() {
            if (this.media.images.length) {
                this.baseFile.type = 'image';
                this.baseFile.path = this.media.images[0].large_image_url;
            } else if (this.media.videos.length) {
                this.baseFile.type = 'video';
                this.baseFile.path = this.media.videos[0].video_url;
            }
        },

        computed: {
            lengthOfMedia() {
                if (this.media.images.length) {
                    return [...this.media.images, ...this.media.videos].length > 5;
                }
            },

            attachments() {
                return [...this.media.images, ...this.media.videos].map(media => ({
                    url: media.type === 'videos' ? media.video_url : media.original_image_url,
                    type: media.type === 'videos' ? 'video' : 'image',
                }));
            },
        },

        methods: {
            isActiveMedia(index) {
                return index === this.activeIndex;
            },

            onMediaLoad() {
                this.isMediaLoading = false;
            },

            change(media, index) {
                this.isMediaLoading = true;

                if (media.type == 'videos') {
                    this.baseFile.type = 'video';
                    this.baseFile.path = media.video_url;
                    this.onMediaLoad();
                } else {
                    this.baseFile.type = 'image';
                    this.baseFile.path = media.large_image_url;
                }

                if (index > this.activeIndex) {
                    this.swipeDown();
                } else if (index < this.activeIndex) {
                    this.swipeTop();
                }

                this.activeIndex = index;
            },

            swipeTop() {
                const container = this.$refs.swiperContainer;
                container.scrollTop -= this.containerOffset;
            },

            swipeDown() {
                const container = this.$refs.swiperContainer;
                container.scrollTop += this.containerOffset;
            },
        },
    });
</script>
@endpushOnce
