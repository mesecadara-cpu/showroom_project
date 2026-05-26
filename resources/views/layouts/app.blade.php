<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kЛАЕР — Шоурум стильной одежды</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Advent+Pro:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'klaer-pink-gradient': '#F9F1F5',
                        'klaer-pink-logo': '#f7d3e0',
                        'graphite': '#5C5C5C',
                        'btn-rose': '#B27F85',
                        'btn-rose-hover': '#96666B'
                    },
                    fontFamily: { sans: ['Advent Pro', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        .backdrop-blur-md { backdrop-filter: blur(12px); }
        .bg-klaer-pink { background: linear-gradient(180deg, #f7d3e0 0%, #F9F1F5 100%); }
    </style>
</head>
<body class="font-sans text-graphite bg-[#f9f1f5] flex flex-col min-h-screen">

<header class="fixed w-full z-50 backdrop-blur-md bg-white/40 border-b border-white/20">
    <div class="container mx-auto px-6 py-4 flex flex-wrap justify-between items-center text-sm uppercase">
        
        <div class="flex items-center justify-between w-full md:w-auto z-10">
            <a href="/" class="flex items-center gap-2">
                <span class="font-semibold tracking-widest text-[#B27F85]">kЛАЕР</span>
            </a>
            
            <button onclick="toggleMenu()" class="md:hidden hover:opacity-70 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <div id="nav-menu" class="hidden md:flex flex-col md:flex-row w-full md:w-auto items-center mt-4 md:mt-0 gap-4 md:gap-10">
            
            <nav class="flex flex-col md:flex-row text-center gap-4 md:gap-10 font-medium tracking-wide w-full md:w-auto">
                <a href="{{ route('catalog') }}" class="hover:text-[#B27F85] py-2 border-b md:border-none border-gray-200">Каталог</a>
                <a href="{{ route('about') }}" class="hover:text-[#B27F85] py-2 border-b md:border-none border-gray-200">О нас</a>
                <a href="{{ route('delivery') }}" class="hover:text-[#B27F85] py-2">Доставка и оплата</a>
            </nav>

            <div class="flex items-center gap-6 text-lg py-2">
                <button onclick="toggleSearch()" class="hover:opacity-70 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
                <a href="{{ route('cart') }}" class="hover:opacity-70 transition-opacity relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <span id="cart-count" class="absolute -top-2 -right-2 bg-[#B27F85] text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center">
                        {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }}
                    </span>
                </a>
            </div>
        </div>

        <div id="search-bar" class="w-full mt-4 hidden">
            <input type="text" placeholder="Поиск..." class="w-full bg-white border border-[#B27F85]/30 rounded-full px-4 py-2 text-sm focus:outline-none text-graphite lowercase">
        </div>
    </div>
</header>

<main class="flex-grow pt-32">
    @yield('content')
</main>

<footer class="bg-white/70 py-16 border-t border-white/20">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 text-sm uppercase text-gray-600">

        <div>
            <h4 class="font-bold mb-8 text-graphite">Связаться с нами</h4>
            <p class="mb-3">+7 (982) 729-59-49</p>
            <div class="flex flex-col gap-2">
                <a href="https://vk.com/klaer_rus" target="_blank" class="hover:text-[#B27F85] transition-colors">
                    ВКонтакте
                </a>
                <a href="https://t.me/klaer_rus" target="_blank" class="hover:text-[#B27F85] transition-colors">
                    Telegram
                </a>
            </div>
        </div>

        <div>
            <h4 class="font-bold mb-8 text-graphite">Покупателям</h4>
            <ul class="space-y-3">
                <li><a href="{{ route('catalog') }}" class="hover:text-[#B27F85]">Одежда</a></li>
                <li><a href="{{ route('catalog') }}" class="hover:text-[#B27F85]">Обувь</a></li>
                <li><a href="{{ route('catalog') }}" class="hover:text-[#B27F85]">Аксессуары</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold mb-8 text-graphite">Разделы</h4>
            <p class="mb-3"><a href="{{ route('about') }}" class="hover:text-[#B27F85]">О нас</a></p>
            <p><a href="{{ route('delivery') }}" class="hover:text-[#B27F85]">Доставка</a></p>
        </div>
    </div>

    <div class="container mx-auto px-6 mt-16 pt-10 border-t border-gray-100 flex justify-between text-xs text-gray-400">
        <p>Политика конфиденциальности</p>
        <p>kЛАЕР, 2026</p>
    </div>
</footer>

<script>
    function toggleSearch() {
        const bar = document.getElementById('search-bar');
        const menu = document.getElementById('nav-menu');
        
        // Закрываем меню, если оно открыто
        if (!menu.classList.contains('hidden')) menu.classList.add('hidden');
        
        bar.classList.toggle('hidden');
        if (!bar.classList.contains('hidden')) bar.querySelector('input').focus();
    }

    function toggleMenu() {
        const menu = document.getElementById('nav-menu');
        const bar = document.getElementById('search-bar');
        
        // Закрываем поиск, если он открыт
        if (!bar.classList.contains('hidden')) bar.classList.add('hidden');
        
        menu.classList.toggle('hidden');
    }
</script>

</body>
</html>
