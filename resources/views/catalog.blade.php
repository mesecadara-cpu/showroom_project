@extends('layouts.app')

@section('title', 'Каталог — kЛАЕР')

@section('content')
<main class="flex-grow pt-10 pb-20">
    <div class="container mx-auto px-6">
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold uppercase tracking-tighter text-gray-900">Коллекция 2026</h1>
        </div>

{{-- Кнопка для вызова фильтров (мобильные) --}}
<button type="button" onclick="toggleFilterSidebar()" class="md:hidden w-full py-4 mb-6 bg-white border border-[#B27F85]/20 rounded-2xl text-[10px] font-bold uppercase tracking-widest flex items-center justify-center gap-2">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
    Фильтры и сортировка
</button>

{{-- Форма теперь охватывает и фильтры, и товары --}}
<form action="{{ route('catalog') }}" method="GET" class="flex flex-col lg:flex-row gap-12">

    {{-- Секция фильтров --}}
    <aside id="filter-sidebar" class="hidden md:block fixed inset-0 z-50 bg-white p-6 md:p-0 overflow-y-auto md:static md:w-1/4 md:bg-transparent">
        <button type="button" onclick="toggleFilterSidebar()" class="md:hidden absolute top-6 right-6 text-2xl font-light">✕</button>

        <div class="bg-white/60 backdrop-blur-md p-8 rounded-[32px] border border-white shadow-sm md:sticky md:top-32">
            <h2 class="text-lg font-bold uppercase mb-8 tracking-tighter">Фильтры</h2>

            <div class="space-y-8">
                {{-- Поиск --}}
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск по названию..."
                           class="w-full p-3 text-sm border border-gray-200 rounded-xl outline-none focus:border-[#B27F85]">
                </div>

                {{-- Сортировка --}}
                <div>
                    <h3 class="text-[10px] font-extrabold uppercase text-gray-400 mb-4 tracking-widest">Сортировать</h3>
                    <select name="sort" class="w-full bg-transparent border-b border-gray-200 py-2 text-sm focus:outline-none focus:border-[#B27F85] cursor-pointer font-semibold">
                        <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>По умолчанию</option>
                        <option value="new" {{ request('sort') == 'new' ? 'selected' : '' }}>Новинки</option>
                        <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>Сначала дешевле</option>
                        <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>Сначала дороже</option>
                    </select>
                </div>

                {{-- Категория --}}
                <div>
                    <h3 class="text-[10px] font-extrabold uppercase text-gray-400 mb-4 tracking-widest">Категория</h3>
                    <div class="space-y-2 text-sm">
                        @foreach($categories as $category)
                            <label class="flex items-center cursor-pointer hover:text-[#B27F85] transition">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    {{ is_array(request('categories')) && in_array($category->id, request('categories')) ? 'checked' : '' }}
                                    class="mr-3 rounded border-gray-300 text-[#B27F85]">
                                {{ $category->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Цвет --}}
                <div>
                    <h3 class="text-[10px] font-extrabold uppercase text-gray-400 mb-4 tracking-widest">Цвет</h3>
                    <div class="grid grid-cols-6 gap-3">
                        @php
                            $colors = ['#FFFFFF' => 'Белый', '#F5F5DC' => 'Молочный', '#E5D3BD' => 'Бежевый', '#D2B48C' => 'Песочный', '#BC8F8F' => 'Пыльная роза', '#B27F85' => 'Розовый kЛАЕР', '#CD5C5C' => 'Терракотовый', '#8B4513' => 'Шоколадный', '#556B2F' => 'Оливковый', '#2E8B57' => 'Хвоя', '#4682B4' => 'Голубой', '#708090' => 'Стальной', '#BEBEBE' => 'Светло-серый', '#808080' => 'Серый', '#2F4F4F' => 'Графит', '#1A1A1B' => 'Угольный', '#000000' => 'Черный', '#E6E6FA' => 'Лаванда'];
                        @endphp
                        @foreach($colors as $hex => $name)
                            <label class="relative cursor-pointer group">
                                <input type="checkbox" name="colors[]" value="{{ $name }}" {{ is_array(request('colors')) && in_array($name, request('colors')) ? 'checked' : '' }} class="hidden peer">
                                <div title="{{ $name }}" class="w-6 h-6 rounded-full border border-gray-200 peer-checked:ring-2 peer-checked:ring-[#B27F85] peer-checked:ring-offset-2 transition-all group-hover:scale-110 shadow-sm" style="background-color: {{ $hex }}"></div>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Размер --}}
                <div>
                    <h3 class="text-[10px] font-extrabold uppercase text-gray-400 mb-4 tracking-widest">Размер</h3>
                    <div class="grid grid-cols-5 gap-2">
                        @foreach(['XS', 'S', 'M', 'L', 'XL'] as $size)
                            <label class="cursor-pointer">
                                <input type="checkbox" name="sizes[]" value="{{ $size }}" {{ is_array(request('sizes')) && in_array($size, request('sizes')) ? 'checked' : '' }} class="hidden peer">
                                <div class="py-2 border border-gray-100 rounded-lg text-[10px] font-bold text-center peer-checked:bg-[#B27F85] peer-checked:text-white transition">{{ $size }}</div>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Цена --}}
                <div>
                    <h3 class="text-[10px] font-extrabold uppercase text-gray-400 mb-4 tracking-widest">Цена (до 15 000 ₽)</h3>
                    <div class="flex items-center gap-2 mb-4">
                        <input type="number" name="min_price" value="{{ request('min_price', 0) }}" placeholder="0" class="w-1/2 p-2 text-xs border border-gray-100 rounded-xl outline-none">
                        <input type="number" name="max_price" id="price-max-input" value="{{ request('max_price', 15000) }}" max="15000" class="w-1/2 p-2 text-xs border border-gray-100 rounded-xl outline-none">
                    </div>
                    <input type="range" min="0" max="15000" step="500" value="{{ request('max_price', 15000) }}"
                           oninput="document.getElementById('price-max-input').value = this.value"
                           class="w-full h-1 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[#B27F85]">
                </div>

                <div class="space-y-3 pt-4 border-t border-gray-100">
                    <button type="submit" class="w-full py-4 bg-[#B27F85] text-white rounded-2xl text-[10px] font-bold uppercase tracking-widest hover:bg-[#a16f75] transition">Применить</button>
                    <a href="{{ route('catalog') }}" class="block w-full py-4 bg-white border border-gray-100 rounded-2xl text-[10px] font-bold uppercase text-center tracking-widest hover:bg-gray-50 transition">Сбросить</a>
                </div>
            </div>
        </div>
    </aside>

{{-- Секция товаров --}}
<main class="w-full lg:w-3/4">
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-8">
        @forelse($products as $product)
            <div class="bg-white/80 backdrop-blur-sm rounded-[24px] md:rounded-[40px] p-3 md:p-6 border border-white flex flex-col group transition-all hover:shadow-xl">
                {{-- Фото --}}
                <div class="h-48 md:h-80 bg-gray-50 rounded-[16px] md:rounded-[32px] mb-4 md:mb-6 overflow-hidden relative shadow-inner">
                    <a href="{{ route('product.show', $product->id) }}">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $product->name }}">
                    </a>
                </div>

                {{-- Название и Категория --}}
                <a href="{{ route('product.show', $product->id) }}">
                    <h3 class="text-[11px] md:text-sm font-bold uppercase tracking-tighter mb-1 line-clamp-2 leading-tight">{{ $product->name }}</h3>
                </a>
                <p class="text-[9px] md:text-[10px] text-gray-400 uppercase font-semibold mb-3">{{ $product->categoryRelation->name ?? 'Без категории' }}</p>

                {{-- ХАРАКТЕРИСТИКИ: Цвет и Размер --}}
                <div class="flex flex-col gap-2 mb-4">
                    {{-- Цвета --}}
                    @if(!empty($product->color_array))
                        <div class="flex gap-1">
                            @foreach($product->color_array as $colorName)
                                {{-- Если у вас есть словарь цветов, можно менять фон. Пока просто кружки --}}
                                <div class="w-3 h-3 rounded-full border border-gray-200" title="{{ $colorName }}" style="background-color: {{ $colorName == 'Черный' ? '#000' : '#ccc' }}"></div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Размеры --}}
                    @if(!empty($product->size_array))
                        <div class="flex gap-1 text-[9px] text-gray-500 font-bold uppercase">
                            {{ implode(' • ', $product->size_array) }}
                        </div>
                    @endif
                </div>

                {{-- Цена и Кнопка --}}
                <div class="flex justify-between items-center mt-auto">
                    <span class="text-sm md:text-lg font-extrabold">{{ number_format($product->price, 0, '', ' ') }} ₽</span>
                    <button type="button" onclick="addToCart({{ $product->id }})" class="w-9 h-9 md:w-12 md:h-12 bg-[#B27F85] text-white rounded-[16px] flex items-center justify-center hover:bg-[#a16f75] transition shadow-lg shadow-pink-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-2 md:col-span-3 xl:col-span-4 text-center py-20 bg-white/40 rounded-[40px]">
                <p class="text-gray-400 italic font-medium">Товары не найдены.</p>
            </div>
        @endforelse
    </div>
</main>
</form>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // 1. Логика ползунка цены
        // Используем ID, которые прописаны в HTML
        const slider = document.querySelector('input[type="range"]');
        const maxInput = document.getElementById('price-max-input');

        if (slider && maxInput) {
            // Синхронизация: ползунок -> поле
            slider.addEventListener('input', (e) => {
                maxInput.value = e.target.value;
            });

            // Синхронизация: поле -> ползунок
            maxInput.addEventListener('input', (e) => {
                // Ограничиваем значение макс. 15000, чтобы не сломать логику контроллера
                let val = parseInt(e.target.value);
                if (val > 15000) val = 15000;
                if (val < 0) val = 0;

                slider.value = val;
            });
        }
    });

    // 2. Управление фильтрами (для мобильных)
    function toggleFilterSidebar() {
        const sidebar = document.getElementById('filter-sidebar');
        if (sidebar) {
            sidebar.classList.toggle('hidden');
            // Блокируем скролл страницы, когда открыто меню фильтров
            document.body.classList.toggle('overflow-hidden');
        }
    }

    // 3. Добавление в корзину
    function addToCart(id) {
        fetch(`/add-to-cart/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ product_id: id })
        })
        .then(res => res.json())
        .then(data => {
            const badge = document.getElementById('cart-count');
            if (badge) {
                badge.innerText = data.cart_count;
                // Анимация при добавлении
                badge.classList.add('animate-bounce');
                setTimeout(() => badge.classList.remove('animate-bounce'), 1000);
            }
            // Можно добавить alert или toast уведомление об успехе
        })
        .catch(err => console.error('Ошибка корзины:', err));
    }
</script>
@endsection
