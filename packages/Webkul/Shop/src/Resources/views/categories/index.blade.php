@extends('shop::layouts.master')

@section('page_title')
    Nuestras Categorías
@endsection

@section('content-wrapper')
<div style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">

    <h1 style="text-align: center; font-size: 2.5rem; font-weight: 900; text-transform: uppercase; margin-bottom: 40px;">
        Colecciones
    </h1>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px;">

        @php
            $categories = \Illuminate\Support\Facades\DB::table('category_translations')
                ->join('categories', 'category_translations.category_id', '=', 'categories.id')
                ->where('category_translations.locale', app()->getLocale())
                ->where('categories.status', 1)
                ->whereNotNull('categories.parent_id')
                ->select(
                    'categories.id',
                    'category_translations.name',
                    'category_translations.slug',
                    'categories.image'
                )
                ->get();
        @endphp

        @foreach ($categories as $cat)

            <a href="{{ url('category/' . $cat->slug) }}"
               style="text-decoration: none; color: #000; background: #fff; border-radius: 20px; border: 1px solid #eee; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); display: flex; flex-direction: column;">

                <div style="height: 250px; background: #f3f4f6;">

                    @if($cat->image)

                        <img src="{{ url('storage/' . $cat->image) }}"
                             style="width: 100%; height: 100%; object-fit: cover;">

                    @else

                        <div style="height: 100%; display: flex; align-items: center; justify-content: center; color: #ccc; font-weight: bold;">
                            {{ $cat->name }}
                        </div>

                    @endif

                </div>

                <div style="padding: 20px; text-align: center;">
                    <h2 style="margin: 0; font-size: 1.3rem; font-weight: 800; text-transform: uppercase;">
                        {{ $cat->name }}
                    </h2>

                    <p style="color: #2563eb; font-weight: 900; margin-top: 10px; font-size: 0.8rem;">
                        VER PRODUCTOS →
                    </p>
                </div>

            </a>

        @endforeach

    </div>

</div>
@endsection
