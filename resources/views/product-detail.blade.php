@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#F9F1F5] font-sans pb-20" x-data="{
    activeImage: '{{ asset('storage/' . $product->image) }}',
    images: [
        '{{ asset('storage/' . $product->image) }}',
        @if($product->image2) '{{ asset('storage/' . $product->image2) }}', @endif
        @if($product->image3) '{{ asset('storage/' . $product->image3) }}' @endif
    ],
    isOpen: false,
    currentIndex: 0,
    next() { this.currentIndex = (this.currentIndex + 1) % this.images.length; },
    prev() { this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length; }
}">
    <div class="max-w-7xl mx-auto px-6 py-8">
        <nav class="flex items-center gap-2 text-[10px] uppercase tracking-widest font-bold">
            <a href="/" class="text-gray-400 hover:text-[#B27F85]">Главная</a>
            <span class="text-gray-300">/</span>
            <a href="{{ route('catalog') }}" class="text-gray-400 hover:text-[#B27F85]">Каталог</a>
            <span class="text-[#B27F85]">{{ $product->name }}</span>
        </nav>
    </div>

    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-white rounded-[48px] shadow-sm p-6 md:p-12 border border-pink-50 flex flex-col lg:flex-row gap-16">

            {{-- Левая часть: Галерея --}}
            <div class="lg:w-1/2 space-y-6">
                <div class="rounded-[40px] overflow-hidden bg-gray-50 border border-pink-50 cursor-zoom-in shadow-inner"
                     @click="isOpen = true; currentIndex = images.indexOf(activeImage)">
                    <img :src="activeImage" class="w-full h-auto min-h-[400px] object-contain transition duration-500">
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <template x-for="(img, index) in images" :key="index">
                        <div class="rounded-[24px] overflow-hidden border-2 transition-all cursor-pointer shadow-sm"
                             :class="activeImage === img ? 'border-[#B27F85] scale-95' : 'border-transparent opacity-70 hover:opacity-100'"
                             @click="activeImage = img">
                            <img :src="img" class="w-full h-32 object-cover">
                        </div>
                    </template>
                </div>
            </div>

            {{-- Правая часть: Информация --}}
{{-- Правая часть: Информация (исправленное описание) --}}
<div class="lg:w-1/2 flex flex-col py-4">
    <div>
        <span class="inline-block px-4 py-1.5 rounded-full bg-pink-50 text-[#B27F85] text-[10px] font-bold uppercase tracking-widest mb-6">
            {{ $product->categoryRelation->name ?? 'Новинка' }}
        </span>
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 leading-tight mb-4 tracking-tighter">{{ $product->name }}</h1>
        <div class="text-3xl font-black text-[#B27F85] mb-10">{{ number_format($product->price, 0, '', ' ') }} ₽</div>

        <div class="space-y-6">
            <h3 class="text-xs font-black uppercase text-gray-400 tracking-[0.2em]">Описание товара</h3>

            {{-- Контейнер с выравниванием по ширине и ограничением ширины для комфорта --}}
            <div class="max-w-2xl text-justify text-gray-600 leading-relaxed text-base md:text-lg bg-gray-50/50 p-6 md:p-8 rounded-[32px] border border-gray-100/50">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    </div>

    <div class="mt-12">
        <button type="button" onclick="addToCart({{ $product->id }})" class="w-full bg-[#B27F85] text-white py-6 rounded-[28px] font-bold uppercase tracking-widest hover:bg-[#a16f75] transition-all transform hover:-translate-y-1 shadow-xl shadow-pink-100 flex items-center justify-center gap-4">
            Добавить в корзину
        </button>
    </div>
</div>
        </div>
    </div>

    {{-- Модальное окно (Lightbox) --}}
<div x-show="isOpen"
         x-cloak
         x-transition.opacity
         @keydown.window.escape="isOpen = false"
         @keydown.window.left="prev()"
         @keydown.window.right="next()"
         class="fixed inset-0 z-[100] bg-black/95 flex items-center justify-center p-4"
         style="display: none;"> {{-- Это гарантирует, что оно скрыто при старте --}}

        {{-- Кнопка закрыть --}}
        <button @click="isOpen = false" class="absolute top-10 right-10 text-white/50 hover:text-white transition-all z-[110]">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        {{-- Стрелка влево --}}
        <button @click="prev()" class="absolute left-4 md:left-10 text-white/50 hover:text-white transition-all z-[110]">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>

        {{-- Само изображение --}}
        <img :src="images[currentIndex]"
             class="max-w-full max-h-[90vh] object-contain rounded-xl shadow-2xl transition-all duration-300">

        {{-- Стрелка вправо --}}
        <button @click="next()" class="absolute right-4 md:right-10 text-white/50 hover:text-white transition-all z-[110]">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</div>
@endsection
