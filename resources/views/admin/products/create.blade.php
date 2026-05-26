@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-[#F9F1F5] font-sans p-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-btn-rose uppercase tracking-widest">Добавить новинку в Klaer</h1>
            <a href="{{ route('admin.index') }}" class="text-xs text-gray-400 hover:text-btn-rose uppercase tracking-widest transition-all">← Назад к списку</a>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm p-10 border border-pink-100">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-btn-rose tracking-wider ml-2">Название товара</label>
                        <input type="text" name="name" required class="w-full px-5 py-3 rounded-2xl bg-pink-50/30 border border-pink-100 focus:border-btn-rose focus:ring-0 outline-none transition-all placeholder-gray-300" placeholder="Напр: Шелковое платье">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-btn-rose tracking-wider ml-2">Категория</label>
                        <select name="category_id" class="w-full px-5 py-3 rounded-2xl bg-pink-50/30 border border-pink-100 focus:border-btn-rose focus:ring-0 outline-none transition-all appearance-none text-graphite cursor-pointer">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-btn-rose tracking-wider ml-2">Цена (руб.)</label>
                        <input type="number" name="price" required class="w-full px-5 py-3 rounded-2xl bg-pink-50/30 border border-pink-100 focus:border-btn-rose focus:ring-0 outline-none transition-all" placeholder="5000">
                    </div>

                    {{-- Блок Главного Фото --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-btn-rose tracking-wider ml-2">Главное фото</label>
                        <input type="file" name="image" required class="w-full px-5 py-2 rounded-2xl bg-pink-50/30 border border-pink-100 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-btn-rose file:text-white hover:file:bg-btn-rose-hover transition-all text-gray-400 text-xs">
                    </div>
                </div>

                {{-- Дополнительные фото в ряд --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-gray-400 tracking-wider ml-2">Второе фото</label>
                        <input type="file" name="image2" class="w-full px-5 py-2 rounded-2xl bg-pink-50/30 border border-pink-100 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-pink-200 file:text-white hover:file:bg-btn-rose transition-all text-gray-400 text-xs">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-gray-400 tracking-wider ml-2">Третье фото</label>
                        <input type="file" name="image3" class="w-full px-5 py-2 rounded-2xl bg-pink-50/30 border border-pink-100 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-pink-200 file:text-white hover:file:bg-btn-rose transition-all text-gray-400 text-xs">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase text-btn-rose tracking-wider ml-2">Описание</label>
                    <textarea name="description" rows="4" class="w-full px-5 py-3 rounded-2xl bg-pink-50/30 border border-pink-100 focus:border-btn-rose focus:ring-0 outline-none transition-all" placeholder="Расскажите о ткани, крое и особенностях..."></textarea>
                </div>

<div class="space-y-8 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
    <div>
        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Доступные цвета</label>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach($availableColors as $color)
                <label class="flex items-center p-3 border border-gray-50 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                    <input type="checkbox" name="colors[]" value="{{ $color }}" class="rounded text-[#B27F85] focus:ring-[#B27F85]">
                    <span class="ml-3 text-sm text-gray-600">{{ $color }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div>
        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Доступные размеры</label>
        <div class="flex flex-wrap gap-3">
            @foreach($availableSizes as $size)
                <label class="relative">
                    <input type="checkbox" name="sizes[]" value="{{ $size }}" class="peer hidden">
                    <div class="px-6 py-2 border-2 border-gray-100 rounded-xl text-sm font-bold text-gray-400 peer-checked:border-[#B27F85] peer-checked:text-[#B27F85] peer-checked:bg-pink-50 transition-all cursor-pointer">
                        {{ $size }}
                    </div>
                </label>
            @endforeach
        </div>
    </div>
</div>

                <div class="pt-4 flex gap-4">
                    <button type="submit" class="flex-1 bg-btn-rose hover:bg-btn-rose-hover text-white py-4 rounded-2xl font-bold uppercase tracking-widest text-xs transition-all shadow-lg hover:shadow-xl">
                        Опубликовать в каталог
                    </button>
                    <a href="{{ route('admin.index') }}" class="px-8 py-4 bg-gray-100 text-gray-400 rounded-2xl font-bold uppercase tracking-widest text-xs hover:bg-gray-200 transition-all text-center">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
