@extends('shop::layouts.master')

@section('page_title')
    Explorar Categorías | KillaVibes
@endsection

@section('content-wrapper')
    <div class="container py-12 px-6" style="max-width: 1280px; margin: 0 auto;">
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-black text-black uppercase tracking-tighter">Categorías</h1>
            <div class="h-1.5 w-24 bg-blue-600 mx-auto mt-4 rounded-full"></div>
        </div>

        {{-- Grid de 3 Columnas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @php
                $categories = app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);
            @endphp

            @foreach ($categories as $category)
                <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100 group flex flex-col h-full transition-all hover:-translate-y-2">
                    
                    {{-- Contenedor de Imagen --}}
                    <div class="h-72 relative overflow-hidden bg-gray-50">
                        @if ($category->image_url)
                            <img src="{{ $category->image_url }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $category->name }}">
                        @else
                            <div class="flex items-center justify-center h-full opacity-30">
                                <span class="text-4xl font-bold uppercase">{{ $category->name }}</span>
                            </div>
                        @endif
                        
                        <div class="absolute top-6 right-6 bg-yellow-400 text-black text-[10px] font-black px-4 py-1.5 rounded-lg uppercase shadow-lg">
                            Destacada
                        </div>
                    </div>

                    {{-- Info de Categoría --}}
                    <div class="p-8 flex flex-col flex-grow">
                        <h2 class="text-2xl font-black text-gray-900 uppercase leading-none mb-3">
                            {{ $category->name }}
                        </h2>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                            {{ $category->description ?? 'Explora nuestra colección exclusiva de ' . $category->name }}
                        </p>
                        <a href="{{ url($category->url_path) }}" class="inline-flex items-center text-blue-600 font-black text-xs uppercase tracking-widest hover:text-black transition-colors">
                            Ver Colección <span class="ml-2">→</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection