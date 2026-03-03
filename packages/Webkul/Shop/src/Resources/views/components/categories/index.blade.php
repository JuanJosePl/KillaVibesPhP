@extends('shop::layouts.master')

@section('page_title')
    {{ __('Categorías') }}
@endsection

@section('content-wrapper')
<style>
    /* Estructura de 3 Columnas Reales */
    .killa-category-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); 
        gap: 30px;
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    /* Diseño de la Tarjeta */
    .killa-category-card {
        background: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        text-decoration: none;
        border: 1px solid #eee;
        transition: all 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    }

    .killa-category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border-color: #ccc;
    }

    /* Contenedor de Imagen */
    .killa-img-box {
        height: 250px;
        background: #f8f8f8;
        position: relative;
    }

    .killa-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .killa-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #ffc107;
        color: #000;
        font-size: 10px;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 6px;
        text-transform: uppercase;
    }

    /* Textos */
    .killa-info-box { padding: 25px; }
    .killa-info-box h2 { 
        font-size: 1.4rem; 
        font-weight: 800; 
        color: #111; 
        margin: 0; 
        text-transform: uppercase; 
    }
    .killa-info-box p { 
        color: #666; 
        font-size: 0.9rem; 
        margin: 10px 0 20px; 
        line-height: 1.4;
    }
    .killa-btn { 
        color: #2563eb; 
        font-weight: 700; 
        font-size: 0.85rem; 
        text-transform: uppercase; 
    }

    /* Responsivo para móviles */
    @media (max-width: 992px) { .killa-category-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 600px) { .killa-category-grid { grid-template-columns: 1fr; } }
</style>

<div class="killa-category-grid">
    @php
        // Obtenemos todas las categorías visibles desde la base de datos
        $categories = app('Webkul\Category\Repositories\CategoryRepository')->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);
    @endphp

    @foreach ($categories as $category)
        <a href="{{ url($category->url_path) }}" class="killa-category-card">
            <div class="killa-img-box">
                <span class="killa-badge">Destacada</span>
                @if ($category->image_url)
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}">
                @else
                    <img src="{{ asset('vendor/webkul/ui/assets/images/product-placeholder.webp') }}" alt="Placeholder">
                @endif
            </div>
            
            <div class="killa-info-box">
                <h2>{{ $category->name }}</h2>
                <p>{{ $category->description ?? 'Explora nuestra colección de ' . $category->name }}</p>
                <span class="killa-btn">Ver Colección →</span>
            </div>
        </a>
    @endforeach
</div>
@endsection