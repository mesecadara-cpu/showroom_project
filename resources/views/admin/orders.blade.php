<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления заказами</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Advent Pro:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Advent Pro', sans-serif; background-color: #F3EBEB; color: #4A4A4A; }
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 35px;
            display: flex;
            flex-direction: column;
            min-height: 450px; /* Одинаковая высота для всех */
        }
        .custom-scroll::-webkit-scrollbar { width: 3px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #B27F85; border-radius: 10px; }
    </style>
</head>
<body class="antialiased min-h-screen pb-20">

    <div class="container mx-auto px-6 pt-12 max-w-6xl"> <div class="flex justify-between items-center mb-10">
            <h1 class="text-2xl font-bold uppercase tracking-[0.25em] text-[#B27F85]">Заказы</h1>
            <div class="flex gap-4">
                <a href="/admin" class="px-6 py-2 bg-white/60 border border-white rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-[#B27F85] hover:text-white transition-all">Товары</a>
                <a href="/catalog" class="px-6 py-2 bg-[#B27F85] text-white rounded-full text-[10px] font-bold uppercase tracking-widest shadow-lg hover:opacity-90 transition-all">← Магазин</a>
            </div>
        </div>

        <div class="flex gap-4 mb-10">
            <div class="glass-card !min-h-0 px-6 py-4 flex-1 flex justify-between items-center">
                <span class="text-[9px] font-bold uppercase tracking-widest text-gray-400">Всего</span>
                <span class="text-xl font-bold text-[#B27F85]">{{ $ordersCount }}</span>
            </div>
            <div class="glass-card !min-h-0 px-6 py-4 flex-1 flex justify-between items-center">
                <span class="text-[9px] font-bold uppercase tracking-widest text-gray-400">Выручка</span>
                <span class="text-xl font-bold text-[#B27F85]">{{ number_format($totalSum, 0, '.', ' ') }} ₽</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($orders as $order)
                <div class="glass-card p-6 shadow-sm hover:shadow-md transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-[10px] font-bold text-[#B27F85] bg-white px-3 py-1 rounded-full shadow-sm">№{{ $order->id }}</span>
                        <p class="text-[9px] text-gray-400 font-medium">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                    </div>

                    <h2 class="text-lg font-bold text-graphite mb-1">{{ $order->name }}</h2>
                    <p class="text-sm font-semibold text-[#B27F85] mb-4">{{ $order->phone }}</p>

                    <div class="bg-white/40 rounded-2xl p-3 mb-4 h-16 flex items-center">
                        <p class="text-[10px] text-gray-500 italic leading-snug overflow-hidden">
                             {{ $order->address }}
                        </p>
                    </div>

                    <div class="flex-grow">
                        <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest mb-2 italic">Товары:</p>
                        <div class="max-h-[120px] overflow-y-auto custom-scroll pr-1 space-y-1">
                            @foreach($order->items as $item)
                                <div class="flex justify-between text-[11px] border-b border-white/30 pb-1">
                                    <span class="text-graphite/70">{{ $item->product_name }}</span>
                                    <span class="font-bold text-[#B27F85]">{{ $item->quantity }} шт.</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-white/40">
                        <div class="flex justify-between items-end mb-4">
                            <span class="text-[9px] font-bold text-gray-400 uppercase">Итого:</span>
                            <span class="text-xl font-bold text-graphite">{{ number_format($order->total_price, 0, '.', ' ') }} ₽</span>
                        </div>

                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Удалить?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-2 bg-red-50 text-red-400 text-[9px] font-bold uppercase rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                Удалить
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center opacity-30 uppercase tracking-[0.5em]">Пусто</div>
            @endforelse
        </div>
    </div>

</body>
</html>
