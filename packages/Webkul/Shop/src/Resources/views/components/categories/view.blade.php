<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-10">
    @foreach (app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id) as $category)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden group">
            
            <div class="h-64 bg-gray-50 relative overflow-hidden">
                @php $products = app('Webkul\Product\Repositories\ProductRepository')->getAll($category->id)->take(5); @endphp

                @if ($products->count() > 0)
                    <div class="flex transition-transform duration-700 ease-in-out" id="carousel-{{ $category->id }}">
                        @foreach ($products as $product)
                            <img src="{{ $product->base_image_url }}" class="min-w-full h-64 object-cover" alt="{{ $product->name }}">
                        @endforeach
                    </div>
                @else
                    <div class="flex items-center justify-center h-full">
                        <img src="{{ $category->image_url ?? asset('vendor/webkul/ui/assets/images/product-placeholder.webp') }}" class="w-32 opacity-50">
                    </div>
                @endif
            </div>

            <div class="p-6 text-center">
                <h3 class="text-xl font-bold text-gray-800">{{ $category->name }}</h3>
                <p class="text-sm text-gray-500 mb-4">{{ $products->count() }} Productos disponibles</p>
                <a href="{{ $category->url }}" class="inline-block bg-black text-white px-6 py-2 rounded-full text-sm font-medium hover:bg-gray-800 transition">
                    Ver Categoría
                </a>
            </div>
        </div>
    @endforeach
</div>

<script>
    // Script simple para mover los carruseles cada 3 segundos
    document.querySelectorAll('[id^="carousel-"]').forEach(carousel => {
        let index = 0;
        setInterval(() => {
            index = (index + 1) % carousel.children.length;
            carousel.style.transform = `translateX(-${index * 100}%)`;
        }, 3000);
    });
</script>