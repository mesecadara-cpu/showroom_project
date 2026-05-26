@extends('layouts.app')

@section('content')
<section class="container mx-auto px-6 pb-20">
    <div class="bg-white/60 backdrop-blur-md rounded-[40px] p-8 md:p-16 shadow-xl border border-white/40 mb-12">

        <div class="text-center mb-16">
            <span class="text-[#B27F85] font-bold uppercase tracking-widest text-xs">Philosophy</span>
            <h1 class="text-4xl md:text-6xl font-black mt-4 uppercase tracking-tighter text-gray-900 leading-tight">
                Инвестиция <br> в своё <span class="text-[#B27F85] italic">счастье</span>
            </h1>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 items-start">

            <div class="space-y-12">
                <div class="prose prose-lg text-gray-700 font-light leading-relaxed">
                    <p class="text-xl font-medium text-gray-900 mb-8 italic border-l-4 border-pink-100 pl-6">Задумывались, почему после удачного похода по магазинам настроение взлетает до небес? Это не случайность — это наука!</p>

                    <div class="space-y-8">
                        <div class="flex items-start gap-4">
                            <div class="w-2 h-2 rounded-full bg-[#B27F85] mt-3 flex-shrink-0"></div>
                            <p><strong>Моментальный заряд эндорфинов.</strong> Новая вещь = новая эмоция. Мозг реагирует на обновление гардероба выбросом «гормонов счастья» — и вот вы уже улыбаетесь без причины!</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-2 h-2 rounded-full bg-[#B27F85] mt-3 flex-shrink-0"></div>
                            <p><strong>Повышение самооценки.</strong> Когда вы носите то, в чём чувствуете себя уверенно, это читается в осанке, взгляде, манере держаться. Одежда — ваш негласный союзник в любых делах!</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-2 h-2 rounded-full bg-[#B27F85] mt-3 flex-shrink-0"></div>
                            <p><strong>Терапия без слов.</strong> Плохой день? Усталость? Шопинг переключает фокус: вы отвлекаетесь от проблем, погружаетесь в атмосферу, и стресс тает!</p>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-2 h-2 rounded-full bg-[#B27F85] mt-3 flex-shrink-0"></div>
                            <p><strong>Поддержка локальных бизнесов.</strong> Покупая в местных магазинах, вы вкладываетесь в свой город. Ваш шопинг помогает любимым местам — и делает район уютнее для всех!</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-10 rounded-[32px] border border-gray-100 shadow-inner">
                    <h3 class="text-2xl font-black mb-8 uppercase text-gray-900 tracking-tight">В kЛАЕР мы создали именно такую атмосферу:</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 text-sm font-medium text-gray-800">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#B27F85]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            3 просторные примерочные
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#B27F85]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Игристое для гостей
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#B27F85]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Помощь в подборе образа
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#B27F85]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Подарок к каждой покупке
                        </li>
                    </ul>
                </div>
            </div>

{{-- Используем grid для автоматического расположения --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 items-center mt-8">

    {{-- Верхнее фото --}}
    <div class="relative w-full aspect-square md:aspect-auto md:h-[500px] rounded-[32px] overflow-hidden shadow-2xl border-4 border-white">
        <img src="{{ asset('images/вешалки.jpg') }}" class="w-full h-full object-cover" alt="Шоурум KLAER">
    </div>

    {{-- Нижнее фото (немного сместим его или оставим в сетке) --}}
    <div class="relative w-full aspect-square md:aspect-auto md:h-[500px] rounded-[32px] overflow-hidden shadow-xl border-4 border-white md:-mt-20">
        <img src="{{ asset('images/примерочные.jpg') }}" class="w-full h-full object-cover" alt="Примерочные">
    </div>

</div>

<div class="bg-white p-6 md:p-8 rounded-[32px] shadow-sm border border-gray-100">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 md:mb-8 pb-6 border-b border-gray-100 gap-4">
        <div>
            <h4 class="font-black uppercase text-base md:text-lg text-gray-900 tracking-tight">Ждем вас в гости</h4>
            <p class="text-xs md:text-sm text-gray-600 italic">Пархоменко, 9, Нижний Тагил</p>
        </div>
        <div class="text-left md:text-right bg-pink-50 px-4 py-2 rounded-full w-fit">
            <p class="text-xs md:text-sm font-bold text-[#B27F85]">10:00 – 21:00</p>
            <p class="text-[9px] text-gray-400 uppercase tracking-widest">ежедневно</p>
        </div>
    </div>

    <div class="rounded-2xl overflow-hidden h-[250px] md:h-[300px] shadow-inner grayscale hover:grayscale-0 transition-all duration-700">
        <iframe
            src="https://yandex.ru/map-widget/v1/?um=constructor%3Aac217a340e0084de4421fa065bed2b7cf3e10672a23d01d5d7bfa073f868234f&amp;source=constructor"
            width="100%"
            height="100%"
            frameborder="0">
        </iframe>
    </div>
</div>
            </div>
        </div>
    </div>
</section>
@endsection


