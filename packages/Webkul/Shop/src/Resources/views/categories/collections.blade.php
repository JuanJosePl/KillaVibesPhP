@push('meta')
    <meta name="description" content="Explora todas las colecciones de KillaVibes" />
@endpush

<x-shop::layouts>
    <x-slot:title>
        Colecciones | KillaVibes
    </x-slot>

    <div class="container mt-10 max-1180:px-5 max-md:mt-6">

        <div class="mb-10 text-center">
            <h1 class="font-dmserif text-4xl max-md:text-3xl max-sm:text-2xl">
                Nuestras Colecciones
            </h1>
            <p class="mt-3 text-zinc-500 max-sm:text-sm">
                Descubre todo lo que KillaVibes tiene para ti
            </p>
        </div>

        @php
            $categoryRepository = app('Webkul\Category\Repositories\CategoryRepository');
            $rootId = core()->getCurrentChannel()->root_category_id;
            $categories = $categoryRepository->getVisibleCategoryTree($rootId);
        @endphp

        @if ($categories && count($categories) > 0)
            <div class="grid grid-cols-3 gap-8 max-lg:grid-cols-2 max-sm:grid-cols-1 mb-16">

                @foreach ($categories as $category)
                    <a href="/{{ $category->slug }}"
                       class="group block overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">

                        <div class="relative h-60 overflow-hidden bg-zinc-100">
                            @if ($category->image_url)
                                <img
                                    src="{{ $category->image_url }}"
                                    alt="{{ $category->name }}"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    loading="lazy"
                                >
                            @else
                                <div class="flex h-full items-center justify-center text-zinc-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <path d="m21 15-5-5L5 21"/>
                                    </svg>
                                </div>
                            @endif

                            <span class="absolute right-3 top-3 rounded-full bg-navyBlue px-3 py-1 text-[10px] font-bold uppercase text-white">
                                Colección
                            </span>
                        </div>

                        <div class="p-6">
                            <h2 class="mb-2 text-lg font-bold uppercase tracking-wide text-zinc-900">
                                {{ $category->name }}
                            </h2>

                            @if (!empty($category->description))
                                <p class="mb-4 line-clamp-2 text-sm leading-relaxed text-zinc-500">
                                    {!! strip_tags($category->description) !!}
                                </p>
                            @else
                                <p class="mb-4 text-sm text-zinc-400">
                                    Explora nuestra colección.
                                </p>
                            @endif

                            <span class="text-xs font-bold uppercase tracking-wider text-navyBlue group-hover:underline">
                                Ver Productos →
                            </span>
                        </div>

                    </a>
                @endforeach

            </div>
        @else
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <p class="text-xl font-semibold text-zinc-400">
                    No hay colecciones disponibles aún.
                </p>
            </div>
        @endif

    </div>
</x-shop::layouts>
