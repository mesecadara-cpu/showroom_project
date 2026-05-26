@extends('layouts.app')

@section('title', 'kЛАЕР — Твой стиль, твоя атмосфера')

@section('content')
<div class="space-y-24 pb-20">

    {{-- 1. HERO SECTION --}}
    <section class="container mx-auto px-6 pt-10">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            <div class="lg:w-1/2 order-2 lg:order-1 text-center lg:text-left">
                <span class="text-[#B27F85] font-bold uppercase tracking-[0.3em] text-xs mb-4 block">New Collection 2026</span>
                <h1 class="text-6xl md:text-8xl font-black uppercase tracking-tighter leading-none text-[#333333] mb-8">
                    kЛАЕР<span class="text-[#B27F85]">.</span>
                </h1>
                <p class="text-gray-500 text-lg md:text-xl font-light mb-10 max-w-md leading-relaxed">
                    Одежда, которая меняет не только образ, но и внутреннее состояние. Почувствуй нашу атмосферу.
                </p>
                <a href="{{ route('catalog') }}" class="inline-block py-5 px-12 bg-[#333333] text-white rounded-full text-xs font-bold uppercase tracking-widest hover:bg-[#B27F85] transition-all duration-500 shadow-xl hover:shadow-pink-200">
                    Перейти в каталог
                </a>
            </div>

            <div class="lg:w-1/2 order-1 lg:order-2">
                <div class="relative">
                    <div class="absolute -inset-4 bg-white/30 backdrop-blur-xl rounded-[60px] -z-10"></div>
                    <div class="rounded-[50px] overflow-hidden shadow-2xl aspect-[4/5] bg-gray-200">
                        <img src="{{ asset('images\баннер.jpg') }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-1000" alt="Main Look">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. VALUES --}}
    <section class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Карточка 1 --}}
            <div class="bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white/40 shadow-sm hover:shadow-xl transition-all duration-500 group">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-[#B27F85] group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </div>
                <h3 class="font-bold uppercase tracking-tight text-[#333333] mb-2">Уютный шоурум</h3>
                <p class="text-xs text-gray-500 leading-relaxed uppercase font-medium">3 просторные примерочные и зона отдыха для гостей</p>
            </div>

            {{-- Карточка 2 --}}
            <div class="bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white/40 shadow-sm hover:shadow-xl transition-all duration-500 group">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-[#B27F85] group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                </div>
                <h3 class="font-bold uppercase tracking-tight text-[#333333] mb-2">Напитки для гостей</h3>
                <p class="text-xs text-gray-500 leading-relaxed uppercase font-medium">Игристое, чтобы ваш шопинг был максимально приятным</p>
            </div>

            {{-- Карточка 3 --}}
            <div class="bg-white/60 backdrop-blur-md p-10 rounded-[40px] border border-white/40 shadow-sm hover:shadow-xl transition-all duration-500 group">
                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:bg-[#B27F85] group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                </div>
                <h3 class="font-bold uppercase tracking-tight text-[#333333] mb-2">Подарок к покупке</h3>
                <p class="text-xs text-gray-500 leading-relaxed uppercase font-medium">Радуем полезными мелочами каждого нашего покупателя</p>
            </div>
        </div>
    </section>

    {{-- 3. ТРЕНДЫ (Мини-каталог) --}}
<section class="container mx-auto px-6 overflow-hidden">
    <div class="flex justify-between items-end mb-12">
        <div>
            <span class="text-[#B27F85] font-bold uppercase tracking-widest text-[10px]">Must Have</span>
            <h2 class="text-4xl font-black uppercase tracking-tighter text-[#333333]">Сейчас в тренде</h2>
        </div>
        <a href="{{ route('catalog') }}" class="text-xs font-bold uppercase border-b-2 border-[#B27F85] pb-1 hover:text-[#B27F85] transition-colors">
            Весь каталог
        </a>
    </div>

    <div class="flex gap-8 overflow-x-auto pb-10 scrollbar-hide">

        {{-- Заменяем @for на @foreach для вывода реальных товаров из базы --}}
        @forelse($trendingProducts as $product)
            <div class="min-w-[300px] group">
                <div class="h-[400px] bg-white rounded-[40px] overflow-hidden mb-6 relative shadow-sm transition-all duration-500 group-hover:shadow-2xl border border-white/40">

                    {{-- Ссылка на детальную страницу товара --}}
                    <a href="{{ route('product.show', $product->id) }}">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="{{ $product->name }}">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 italic text-xs">Нет фото</div>
                        @endif
                    </a>

                    {{-- Кнопка "В корзину" (Цвет: Графит #333333) --}}
                    <button onclick="addToCart({{ $product->id }})" class="absolute bottom-6 right-6 w-14 h-14 bg-[#333333] text-white rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0 shadow-xl hover:bg-[#B27F85]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    </button>
                </div>

                {{-- Название товара --}}
                <a href="{{ route('product.show', $product->id) }}">
                    <h3 class="font-bold uppercase text-sm tracking-tight mb-1 text-[#333333] hover:text-[#B27F85] transition-colors">{{ $product->name }}</h3>
                </a>

                {{-- Цена с форматированием --}}
                <p class="text-[#B27F85] font-black tracking-tighter">{{ number_format($product->price, 0, '', ' ') }} ₽</p>
            </div>
        @empty
            {{-- Это сработает, если в базе пока нет товаров --}}
            <div class="w-full text-center py-20 bg-white/30 rounded-[40px] border-2 border-dashed border-white/50 text-gray-400 italic">
                Новинки уже в пути... Загляните позже!
            </div>
        @endforelse

    </div>
</section>

<script>
function addToCart(productId) {
    const id = parseInt(productId);

    fetch('/add-to-cart/' + id, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success' || data.success) {
            // 1. Находим элемент счетчика в шапке
            const cartCountElement = document.getElementById('cart-count');

            if (cartCountElement) {
                // 2. Обновляем цифру данными, которые прислал контроллер
                cartCountElement.innerText = data.cart_count;

                // 3. Можно добавить легкую анимацию, чтобы было видно обновление
                cartCountElement.classList.add('scale-125', 'text-[#B27F85]');
                setTimeout(() => {
                    cartCountElement.classList.remove('scale-125', 'text-[#B27F85]');
                }, 300);
            }

            // Вместо бесячего алерта или перезагрузки просто выводим лог в консоль
            console.log('Товар успешно добавлен. Новый счетчик:', data.cart_count);
        }
    })
    .catch(error => console.error('Ошибка добавления:', error));
}
</script>

    {{-- 4. ГДЕ МЫ НАХОДИМСЯ (Карта) --}}
<section class="container mx-auto px-6 mb-24">
    <div class="bg-white/60 backdrop-blur-md rounded-[50px] overflow-hidden border border-white shadow-sm flex flex-col lg:flex-row items-stretch">

<div class="lg:w-2/5 p-10 md:p-16 flex flex-col justify-between">
    <div>
        {{-- Заголовок теперь в мягком графите --}}
        <h2 class="text-4xl font-black uppercase tracking-tighter mb-8 text-[#333333] leading-none">
            Ждем вас <br> <span class="text-[#B27F85]">в гости</span>
        </h2>

        <div class="space-y-8">
            {{-- Адрес --}}
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-pink-50 flex items-center justify-center flex-shrink-0 text-[#B27F85]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase font-extrabold tracking-widest mb-1">Наш адрес</p>
                    {{-- Текст адреса тоже в графите --}}
                    <p class="text-sm font-bold text-[#4A4A4A]">Пархоменко, 9, Нижний Тагил</p>
                </div>
            </div>

            {{-- Время --}}
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-pink-50 flex items-center justify-center flex-shrink-0 text-[#B27F85]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase font-extrabold tracking-widest mb-1">Режим работы</p>
                    <p class="text-sm font-bold text-[#4A4A4A]">Ежедневно: 10:00 — 21:00</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Кнопка теперь графитовая, а не черная --}}
    <div class="mt-12">
        <a href="https://yandex.ru/maps/-/CPg6iGjT" target="_blank" class="inline-flex items-center justify-center w-full py-5 px-8 bg-[#333333] text-white rounded-2xl text-[10px] font-bold uppercase tracking-widest hover:bg-[#B27F85] transition-all duration-500 shadow-lg shadow-gray-100 hover:shadow-pink-100">
            <span>Проложить маршрут</span>
            <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12l7-7M5 5h7v7"/></svg>
        </a>
    </div>
</div>

        <div class="lg:w-3/5 min-h-[450px] relative">
            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Aac217a340e0084de4421fa065bed2b7cf3e10672a23d01d5d7bfa073f868234f&amp;source=constructor"
                    width="100%" height="100%" frameborder="0"
                    style="filter: grayscale(0.2) contrast(1.1); min-height: 450px;">
            </iframe>
        </div>
    </div>
</section>

</div>

<style>
    /* Прячем полосу прокрутки для горизонтального слайдера */
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection
