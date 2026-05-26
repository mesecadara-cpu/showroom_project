@extends('layouts.app')

@section('content')
<section class="container mx-auto px-6 pb-20">
    <div class="bg-white/60 backdrop-blur-md rounded-[48px] p-8 md:p-16 shadow-xl border border-white/40 overflow-hidden">

        <div class="flex flex-col lg:flex-row gap-12 items-center mb-20">
            <div class="lg:w-1/2 order-2 lg:order-1">
                <span class="inline-block px-4 py-1.5 rounded-full bg-pink-50 text-[#B27F85] text-[10px] font-bold uppercase tracking-widest mb-6">Сервис</span>
                <h1 class="text-4xl md:text-6xl font-black mb-8 uppercase tracking-tighter text-gray-900 leading-tight">Доставка <br>и оплата</h1>
                <p class="text-xl text-gray-600 leading-relaxed font-light">
                    Теперь доставка нашей одежды прямо к вам домой абсолютно <span class="font-bold text-[#B27F85] italic">бесплатна</span> с возможностью примерки и отказа!
                </p>
            </div>
            <div class="lg:w-1/2 order-1 lg:order-2 w-full transform rotate-2 hover:rotate-0 transition-transform duration-500 rounded-[48px] overflow-hidden shadow-2xl">
                <img
                    src="{{ asset('images/доставка.jpg') }}"
                    alt="Klaer Delivery"
                    class="w-full h-[350px] md:h-[450px] object-cover object-[center_30%] "
                >
            </div>
        </div>
{{-- Секция доставки --}}
<div class="grid md:grid-cols-2 gap-4 md:gap-8">
    {{-- Карточка: Нижний Тагил --}}
    <div class="bg-white p-6 md:p-10 rounded-[32px] md:rounded-[40px] border border-pink-50 shadow-sm">
        <div class="w-10 h-10 md:w-12 md:h-12 bg-pink-50 rounded-2xl flex items-center justify-center mb-6">
            <span class="text-xl md:text-2xl">📍</span>
        </div>
        <h3 class="text-xl md:text-2xl font-black mb-4 uppercase tracking-wide text-gray-900">По Нижнему Тагилу</h3>
        <ul class="space-y-3 text-sm md:text-lg font-light text-gray-700">
            <li class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full bg-[#B27F85] flex-shrink-0"></div>
                <span>Бесплатная доставка с примеркой</span>
            </li>
            <li class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full bg-[#B27F85] flex-shrink-0"></div>
                <span>Доставка в день заказа</span>
            </li>
            <li class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full bg-[#B27F85] flex-shrink-0"></div>
                <span>Бесплатный отказ</span>
            </li>
        </ul>
    </div>

    {{-- Карточка: По России --}}
    <div class="bg-white p-6 md:p-10 rounded-[32px] md:rounded-[40px] border border-pink-50 shadow-sm">
        <div class="w-10 h-10 md:w-12 md:h-12 bg-pink-50 rounded-2xl flex items-center justify-center mb-6">
            <span class="text-xl md:text-2xl">📦</span>
        </div>
        <h3 class="text-xl md:text-2xl font-black mb-4 uppercase tracking-wide text-gray-900">По России</h3>
        <ul class="space-y-3 text-sm md:text-lg font-light text-gray-700">
            <li class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full bg-[#B27F85] flex-shrink-0"></div>
                <span>Фиксированная стоимость — <span class="font-bold text-[#B27F85]">250 ₽</span></span>
            </li>
            <li class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full bg-[#B27F85] flex-shrink-0"></div>
                <span>Доставка в любой город</span>
            </li>
            <li class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full bg-[#B27F85] flex-shrink-0"></div>
                <span>Возврат силами покупателя</span>
            </li>
        </ul>
    </div>
</div>

{{-- Блок "Как заказать" --}}
<div class="mt-12 md:mt-20">
    <h2 class="text-xl md:text-3xl font-black text-center mb-10 md:mb-16 uppercase tracking-tighter italic text-gray-900">Заказать легко!</h2>
    <div class="grid md:grid-cols-3 gap-8 md:gap-12">
        @foreach(['Выбери вещи в каталоге', 'Напиши нам детали заказа', 'Прими, примерь и оплати'] as $index => $text)
            <div class="text-center">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-[#B27F85] text-white rounded-full flex items-center justify-center text-xl md:text-2xl font-black mx-auto mb-4 md:mb-6 shadow-lg shadow-pink-200">
                    {{ $index + 1 }}
                </div>
                <p class="text-gray-700 font-medium px-2 text-sm md:text-lg">{{ $text }}</p>
            </div>
        @endforeach
    </div>
</div>

{{-- Финальный блок (замена темной плашки) --}}
<div class="mt-12 md:mt-20 p-6 md:p-10 rounded-[32px] bg-[#F9F1F5] text-center border border-pink-100">
    <p class="text-lg md:text-xl font-medium text-gray-800 mb-2">Теперь новинки от <span class="font-bold text-[#B27F85]">kлаер</span> доступны не выходя из дома.</p>
    <p class="text-gray-500 italic text-sm md:text-base">Успешных покупок и до скорых встреч!</p>
</div>
    </div>
</section>
@endsection
