@extends('shop::layouts.master')

@section('page_title')
    Categorías | KillaVibes
@endsection

@section('content-wrapper')
    <div style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
        
        <h1 style="text-align: center; text-transform: uppercase; font-weight: 900; font-size: 2.5rem; margin-bottom: 40px;">Categorías</h1>

        {{-- Grid Manual para asegurar 3 columnas --}}
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            @php
                $categoryRepository = app('Webkul\Category\Repositories\CategoryRepository');
                $categories = $categoryRepository->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);
            @endphp

            @foreach ($categories as $category)
                <a href="{{ url($category->url_path) }}" style="text-decoration: none; color: inherit; background: white; border-radius: 20px; border: 1px solid #eee; overflow: hidden; display: block; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">

                    <div style="height: 250px; background: #f5f5f5; position: relative;">
                        @if ($category->image_url)
                            <img src="{{ $category->image_url }}" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $category->name }}">
                        @else
                            <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #ccc; font-weight: bold;">SIN IMAGEN</div>
                        @endif
                        <span style="position: absolute; top: 15px; right: 15px; background: #ffc107; color: black; font-size: 10px; font-weight: bold; padding: 5px 10px; border-radius: 5px; text-transform: uppercase;">Destacada</span>
                    </div>

                    <div style="padding: 25px;">
                        <h2 style="margin: 0 0 10px; font-size: 1.3rem; text-transform: uppercase; font-weight: 800;">{{ $category->name }}</h2>
                        <p style="color: #666; font-size: 0.9rem; margin-bottom: 20px; line-height: 1.4;">{{ $category->description ?? 'Explora nuestra colección.' }}</p>
                        <span style="color: #2563eb; font-weight: bold; font-size: 0.8rem; text-transform: uppercase;">Ver Productos →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
