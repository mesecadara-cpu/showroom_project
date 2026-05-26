@extends('layouts.admin')

@php
    $productColors = explode(', ', $product->color ?? '');
    $productSizes = explode(', ', $product->sizes ?? '');
@endphp

@section('content')
<div class="min-h-screen bg-[#F9F1F5] font-sans p-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-btn-rose uppercase tracking-widest">Редактировать товар</h1>
            <a href="{{ route('admin.index') }}" class="text-xs text-gray-400 hover:text-btn-rose uppercase tracking-widest transition-all">← Назад</a>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm p-10 border border-pink-100">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-btn-rose tracking-wider ml-2">Название</label>
                        <input type="text" name="name" value="{{ $product->name }}" required class="w-full px-5 py-3 rounded-2xl bg-pink-50/30 border border-pink-100 focus:border-btn-rose outline-none">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-btn-rose tracking-wider ml-2">Категория</label>
                        <select name="category_id" class="w-full px-5 py-3 rounded-2xl bg-pink-50/30 border border-pink-100 focus:border-btn-rose outline-none appearance-none">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-btn-rose tracking-wider ml-2">Цена (руб.)</label>
                        <input type="number" name="price" value="{{ $product->price }}" required class="w-full px-5 py-3 rounded-2xl bg-pink-50/30 border border-pink-100 focus:border-btn-rose outline-none">
                    </div>

                    <div class="space-y-2 text-center">
                        <label class="text-xs font-bold uppercase text-btn-rose tracking-wider block text-left ml-2">Текущее фото</label>
                        <div class="mt-1 flex items-center gap-4">
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-16 h-16 rounded-xl object-cover border border-pink-100">
                            <input type="file" name="image" class="flex-1 text-xs text-gray-400 file:bg-pink-100 file:text-btn-rose file:border-0 file:px-3 file:py-1 file:rounded-full">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 mb-6">
                    {{-- Второе фото --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-btn-rose tracking-wider ml-2">Второе фото</label>
                        <div class="flex items-center gap-4">
                            @if($product->image2)
                                <img src="{{ asset('storage/' . $product->image2) }}" class="w-12 h-12 rounded-lg object-cover border border-pink-100">
                            @endif
                            <input type="file" name="image2" class="flex-1 text-xs text-gray-400 file:bg-pink-100 file:text-btn-rose file:border-none file:px-3 file:py-1 file:rounded-full cursor-pointer">
                        </div>
                    </div>

                    {{-- Третье фото --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-btn-rose tracking-wider ml-2">Третье фото</label>
                        <div class="flex items-center gap-4">
                            @if($product->image3)
                                <img src="{{ asset('storage/' . $product->image3) }}" class="w-12 h-12 rounded-lg object-cover border border-pink-100">
                            @endif
                            <input type="file" name="image3" class="flex-1 text-xs text-gray-400 file:bg-pink-100 file:text-btn-rose file:border-none file:px-3 file:py-1 file:rounded-full cursor-pointer">
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase text-btn-rose tracking-wider ml-2">Описание</label>
                    <textarea name="description" rows="4" class="w-full px-5 py-3 rounded-2xl bg-pink-50/30 border border-pink-100 focus:border-btn-rose outline-none transition-all">{{ $product->description }}</textarea>
                </div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-8 p-8 bg-gray-50 rounded-[32px] border border-white shadow-inner">
    <div>
        <h3 class="text-[10px] font-bold uppercase text-gray-400 mb-4 tracking-widest">Цвета</h3>
        <div class="grid grid-cols-2 gap-3">
            @foreach(['Белый', 'Черный', 'Бежевый', 'Молочный', 'Розовый kЛАЕР', 'Пыльная роза'] as $color)
                <label class="flex items-center p-3 rounded-2xl bg-white border border-gray-100 cursor-pointer hover:border-[#B27F85] transition">
                    <input type="checkbox" name="colors[]" value="{{ $color }}"
                        {{ in_array($color, $productColors) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-gray-300 text-[#B27F85] focus:ring-[#B27F85]">
                    <span class="ml-3 text-xs font-semibold text-gray-600">{{ $color }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div>
        <h3 class="text-[10px] font-bold uppercase text-gray-400 mb-4 tracking-widest">Размеры</h3>
        <div class="flex flex-wrap gap-2">
            @foreach(['XS', 'S', 'M', 'L', 'XL'] as $size)
                <label class="cursor-pointer">
                    <input type="checkbox" name="sizes[]" value="{{ $size }}"
                        {{ in_array($size, $productSizes) ? 'checked' : '' }}
                        class="hidden peer">
                    <div class="px-5 py-3 border border-gray-100 bg-white rounded-2xl text-xs font-bold text-gray-400 peer-checked:bg-[#B27F85] peer-checked:text-white peer-checked:border-[#B27F85] transition-all shadow-sm">
                        {{ $size }}
                    </div>
                </label>
            @endforeach
        </div>
    </div>
</div>

                <button type="submit" class="w-full bg-btn-rose hover:bg-btn-rose-hover text-white py-4 rounded-2xl font-bold uppercase tracking-widest text-xs transition-all shadow-lg shadow-pink-200">
                    Сохранить изменения
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
