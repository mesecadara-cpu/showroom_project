<script src="https://unpkg.com/imask"></script>

@extends('layouts.app')

@section('content')

@if(session('success'))
    <div id="success-alert" class="fixed top-24 left-1/2 -translate-x-1/2 z-[110] w-full max-w-md px-4 animate-modal">
        <div class="bg-white/80 backdrop-blur-xl border border-white p-6 rounded-[30px] shadow-2xl flex items-center gap-4">
            <div class="bg-[#B27F85] text-white p-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.42-6.446z"/>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold text-graphite uppercase tracking-widest">Успешно!</p>
                <p class="text-[10px] text-gray-500 uppercase mt-1">{{ session('success') }}</p>
            </div>
        </div>
    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 5000);
    </script>
@endif

<style>
    @keyframes modalShow {
        from { opacity: 0; transform: scale(0.95) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-modal {
        animation: modalShow 0.3s ease-out forwards;
    }
</style>

{{-- Обертка с min-h, чтобы прижать футер вниз и убрать пустоту --}}
<div class="container mx-auto px-6 max-w-5xl flex flex-col min-h-[70vh]">
    <h1 class="text-3xl font-extrabold uppercase mb-12 tracking-tighter text-graphite">Ваша корзина</h1>

    @if(!isset($cartItems) || count($cartItems) == 0)
        <div class="text-center py-20 bg-white/60 backdrop-blur-md rounded-[40px] border border-white my-auto">
            <div class="mb-8 flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#B27F85" class="opacity-20" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-graphite mb-4">В корзине пока ничего нет</h2>
            <p class="text-gray-500 mb-10">Самое время наполнить её стильными вещами!</p>
            <a href="{{ route('catalog') }}" class="bg-[#B27F85] text-white px-10 py-4 rounded-full font-semibold hover:bg-[#9a6a70] transition shadow-lg shadow-rose-200/50">
                Перейти в каталог
            </a>
        </div>
    @else
        <div class="flex flex-col lg:flex-row gap-10 mb-20">
            <div class="lg:w-2/3 space-y-6">
                @foreach($cartItems as $id => $details)
                    <div class="item-card bg-white rounded-[32px] p-6 shadow-sm border border-white flex items-center gap-6 relative group">

                        {{-- Кнопка удаления (крестик) --}}
                        <form action="{{ route('cart.remove', $id) }}" method="POST" class="absolute top-6 right-6">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-300 hover:text-red-400 transition-colors" title="Удалить из корзины">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </form>

                        <div class="w-24 h-32 bg-gray-50 rounded-2xl overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-grow">
                            <h3 class="font-bold text-lg text-graphite mb-1 uppercase tracking-tight">{{ $details['name'] }}</h3>
                            <p class="text-[10px] text-gray-400 uppercase mb-4 tracking-widest font-semibold">
                                Цена за шт: {{ number_format($details['price'], 0, '', ' ') }} ₽
                            </p>

                            {{-- Управление количеством --}}
<div class="flex items-center gap-4">
    <div class="flex items-center border border-gray-100 rounded-full px-2 py-1 bg-gray-50/50">
        {{-- Кнопка МИНУС --}}
        <form action="{{ route('cart.update', $id) }}" method="POST" class="m-0 flex items-center">
            @csrf
            @method('PATCH')
            <input type="hidden" name="action" value="dec">
            <button type="submit" class="w-8 h-8 flex items-center justify-center hover:bg-white rounded-full transition shadow-sm font-bold text-[#B27F85]">−</button>
        </form>

        <span class="quantity font-extrabold text-xs mx-3 text-graphite leading-none">
            {{ $details['quantity'] }}
        </span>

        {{-- Кнопка ПЛЮС --}}
        <form action="{{ route('cart.update', $id) }}" method="POST" class="m-0 flex items-center">
            @csrf
            @method('PATCH')
            <input type="hidden" name="action" value="inc">
            <button type="submit" class="w-8 h-8 flex items-center justify-center hover:bg-white rounded-full transition shadow-sm font-bold text-[#B27F85]">+</button>
        </form>
    </div>
</div>
                        </div>

                        <div class="text-right pr-4">
                            <span class="font-extrabold text-xl text-[#B27F85] whitespace-nowrap">
                                {{ number_format($details['price'] * $details['quantity'], 0, '', ' ') }} ₽
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Оформление --}}
            <div class="lg:w-1/3">
                <div class="bg-white rounded-[40px] p-8 shadow-lg border border-white sticky top-32">
                    <h2 class="text-xl font-extrabold uppercase mb-8 tracking-tighter">Оформление</h2>

                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-xs text-gray-400 uppercase font-bold">
                            <span>Товары ({{ count($cartItems) }})</span>
                            <span>{{ number_format(collect($cartItems)->sum(function($item) { return $item['price'] * $item['quantity']; }), 0, '', ' ') }} ₽</span>
                        </div>
                        <div class="flex justify-between text-xs text-gray-400 uppercase font-bold">
                            <span>Доставка</span>
                            <span class="text-green-500">Бесплатно</span>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 flex justify-between items-end">
                        <span class="text-xs uppercase font-black text-graphite">Итого:</span>
                        <span class="text-3xl font-black text-[#B27F85]">
                            {{ number_format(collect($cartItems)->sum(function($item) { return $item['price'] * $item['quantity']; }), 0, '', ' ') }} ₽
                        </span>
                    </div>

                    <button onclick="toggleOrderModal()" class="w-full mt-8 py-5 bg-[#B27F85] text-white rounded-[20px] font-bold uppercase tracking-[0.2em] text-[11px] hover:bg-[#a16f75] transition-colors shadow-lg">
                        Оформить заказ
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>


<script>
    function changeQty(id, delta) {
        console.log('Изменить количество товара ' + id + ' на ' + delta);
    }
</script>

<div id="orderModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/20 backdrop-blur-sm" onclick="toggleOrderModal()"></div>

    <div class="animate-modal relative bg-white/80 backdrop-blur-xl border border-white p-8 rounded-[40px] shadow-2xl w-full max-w-md">
        <button onclick="toggleOrderModal()" class="absolute top-6 right-6 text-gray-400 hover:text-graphite">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>

        <h2 class="text-lg font-bold text-graphite uppercase tracking-widest mb-6 text-center">Оформление заказа</h2>

<form action="{{ route('order.store') }}" method="POST" class="space-y-4">
    @csrf

    <div class="flex bg-[#f9f1f5] p-1 rounded-2xl mb-6">
        <label class="flex-1 text-center">
            <input type="radio" name="delivery_method" value="pickup" class="hidden peer" onchange="toggleDeliveryFields(false)">
            <span class="block py-2 text-[10px] font-bold uppercase tracking-wider rounded-xl cursor-pointer peer-checked:bg-white peer-checked:text-[#B27F85] text-gray-400 transition-all">
                Самовывоз
            </span>
        </label>
        <label class="flex-1 text-center">
            <input type="radio" name="delivery_method" value="delivery" class="hidden peer" checked onchange="toggleDeliveryFields(true)">
            <span class="block py-2 text-[10px] font-bold uppercase tracking-wider rounded-xl cursor-pointer peer-checked:bg-white peer-checked:text-[#B27F85] text-gray-400 transition-all">
                Доставка
            </span>
        </label>
    </div>

    <div>
        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-2">Имя</label>
        <input type="text" name="name" placeholder="Введите ваше имя" required
               class="w-full mt-1 px-5 py-4 bg-white/50 border border-white rounded-2xl text-[11px] focus:outline-none focus:border-[#B27F85] transition-all">
    </div>

    <div>
        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-2">Телефон</label>
        <input type="text" name="phone" placeholder="+7 (___) ___-__-__" required
               class="w-full mt-1 px-5 py-4 bg-white/50 border border-white rounded-2xl text-[11px] focus:outline-none focus:border-[#B27F85] transition-all">
    </div>

    <div id="addressField">
        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider ml-2">Адрес доставки</label>
        <textarea name="address" placeholder="Город, улица, дом..." rows="3"
                  class="w-full mt-1 px-5 py-4 bg-white/50 border border-white rounded-2xl text-[11px] focus:outline-none focus:border-[#B27F85] transition-all resize-none"></textarea>
    </div>

    <div id="pickupInfo" class="hidden p-4 bg-white/30 border border-dashed border-white rounded-2xl">
        <p class="text-[10px] text-gray-500 uppercase leading-relaxed text-center">
            Пункт выдачи: <br>
            <strong class="text-graphite">г. Нижний Тагил, ул. Пархоменко, 9</strong><br>
            Ежедневно с 10:00 до 21:00
        </p>
    </div>

    <button type="submit" class="w-full mt-4 py-5 bg-[#B27F85] text-white rounded-2xl font-bold uppercase tracking-[0.2em] text-[11px] shadow-lg hover:bg-[#a16f75] transition-all">
        Подтвердить заказ
    </button>
</form>
    </div>
</div>

<script>
function toggleOrderModal() {
    const modal = document.getElementById('orderModal');
    modal.classList.toggle('hidden');
}

function toggleDeliveryFields(show) {
    const addressField = document.getElementById('addressField');
    const pickupInfo = document.getElementById('pickupInfo');
    const addressInput = addressField.querySelector('textarea');

    if (show) {
        addressField.classList.remove('hidden');
        pickupInfo.classList.add('hidden');
        addressInput.required = true;
        // Очищаем поле, если там было слово "Самовывоз"
        if (addressInput.value === 'Самовывоз') {
            addressInput.value = '';
        }
    } else {
        addressField.classList.add('hidden');
        pickupInfo.classList.remove('hidden');
        addressInput.required = false;
        // Устанавливаем значение, но пользователь его не увидит, так как поле скрыто
        addressInput.value = 'Самовывоз';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.querySelector('input[name="phone"]');
    const maskOptions = {
        mask: '+{7} (000) 000-00-00'
    };
    if (phoneInput) {
        const mask = IMask(phoneInput, maskOptions);
    }
});
</script>
@endsection
