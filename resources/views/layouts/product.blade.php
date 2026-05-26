@extends('layouts.app')

@section('content')
<main class="pt-32 pb-20 bg-[#FDFBFB]">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-16">

            <div class="lg:w-3/5 flex gap-4">
                {{-- Миниатюры (если их несколько) --}}
                <div class="hidden md:flex flex-col gap-4 w-20">
                    <div class="h-28 bg-gray-100 rounded-2xl overflow-hidden cursor-pointer border-2 border-[#B27F85]">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover" alt="thumb">
                    </div>
                    {{-- Сюда потом можно добавить доп. фото из таблицы product_images --}}
                </div>

                {{-- Главное фото --}}
                <div class="flex-grow h-[700px] bg-gray-50 rounded-[48px] overflow-hidden shadow-sm">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover hover:scale-105 transition duration-700" alt="{{ $product->name }}">
                </div>
            </div>

            <div class="lg:w-2/5 flex flex-col">
                <div class="mb-8">
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 mb-2">{{ $product->category }}</p>
                    <h1 class="text-4xl font-extrabold uppercase tracking-tighter mb-4">{{ $product->name }}</h1>
                    <span class="text-3xl font-black italic text-gray-900">{{ number_format($product->price, 0, '', ' ') }} ₽</span>
                </div>

                <div class="mb-10">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Выберите размер</h3>
                        <a href="#" class="text-[9px] uppercase border-b border-gray-300 pb-1 hover:text-[#B27F85] transition">Таблица размеров</a>
                    </div>
                    <div class="flex gap-3">
                        @foreach(['XS', 'S', 'M', 'L'] as $size)
                            <label class="cursor-pointer">
                                <input type="radio" name="size" value="{{ $size }}" class="hidden peer">
                                <div class="w-14 h-14 rounded-2xl border border-gray-100 flex items-center justify-center text-xs font-bold peer-checked:bg-black peer-checked:text-white peer-checked:border-black transition-all">
                                    {{ $size }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button onclick="addToCart({{ $product->id }})" class="w-full py-6 bg-black text-white rounded-[24px] text-xs font-black uppercase tracking-[0.3em] hover:bg-[#B27F85] transition-all shadow-xl shadow-gray-200 mb-10 flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    Добавить в корзину
                </button>

                <div class="space-y-6 border-t border-gray-100 pt-10">
                    <div>
                        <h4 class="text-[10px] font-black uppercase tracking-widest mb-3">Описание</h4>
                        <p class="text-sm text-gray-500 leading-relaxed font-medium">
                            {{ $product->description ?? 'Минималистичная модель из лимитированной коллекции kЛАЕР. Идеальный крой и премиальные материалы для твоего комфорта.' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-4">
                        <div class="p-4 bg-white rounded-2xl border border-gray-50 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#F9F1F5] flex items-center justify-center text-[#B27F85]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2"/><path d="M7 11V7a2 2 0 0 1 2-2h9"/></svg>
                            </div>
                            <span class="text-[9px] font-bold uppercase tracking-tighter">Быстрая доставка</span>
                        </div>
                        <div class="p-4 bg-white rounded-2xl border border-gray-50 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-[#F9F1F5] flex items-center justify-center text-[#B27F85]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            </div>
                            <span class="text-[9px] font-bold uppercase tracking-tighter">Гарантия качества</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
