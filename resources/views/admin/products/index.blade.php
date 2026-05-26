@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-[#F9F1F5] font-sans text-graphite p-4 md:p-8">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
        <h1 class="text-3xl font-bold tracking-widest text-btn-rose uppercase">Панель управления</h1>
        <a href="{{ route('admin.products.create') }}"
           class="bg-btn-rose hover:bg-btn-rose-hover text-white px-6 py-3 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl uppercase text-xs font-semibold tracking-widest w-full md:w-auto text-center">
            + Добавить товар
        </a>
    </div>

    <div class="max-w-6xl mx-auto">
        <div class="md:hidden space-y-4">
            @foreach($products as $product)
            <div class="bg-white p-4 rounded-[2rem] border border-pink-100 shadow-sm flex items-center gap-4">
                <img src="{{ asset('storage/' . $product->image) }}" class="w-20 h-20 rounded-2xl object-cover">
                <div class="flex-grow min-w-0">
                    <h3 class="font-bold text-gray-800 truncate">{{ $product->name }}</h3>
                    <p class="text-[10px] text-[#B27F85] uppercase font-bold">{{ $product->categoryRelation->name ?? 'Без категории' }}</p>
                    <p class="font-bold text-btn-rose">{{ number_format($product->price, 0, '.', ' ') }} ₽</p>
                </div>
                <div class="flex flex-col gap-2">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-[10px] uppercase font-bold text-gray-500">Ред.</a>
                    <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Удалить?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-[10px] uppercase font-bold text-red-400">Удал.</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="hidden md:block bg-white rounded-[2rem] shadow-sm overflow-hidden border border-pink-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-pink-50/50">
                        <th class="px-6 py-5 text-xs font-bold uppercase text-btn-rose">Фото</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase text-btn-rose">Название</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase text-btn-rose">Категория</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase text-btn-rose">Цена</th>
                        <th class="px-6 py-5 text-xs font-bold uppercase text-btn-rose text-right">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-50">
                    @foreach($products as $product)
                    <tr class="hover:bg-pink-50/30 transition-colors">
                        <td class="px-6 py-4"><img src="{{ asset('storage/' . $product->image) }}" class="w-16 h-16 rounded-2xl object-cover"></td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $product->name }}</td>
                        <td class="px-6 py-4"><span class="px-3 py-1 bg-pink-50 text-[10px] text-[#B27F85] rounded-full uppercase font-bold">{{ $product->categoryRelation->name ?? 'Без категории' }}</span></td>
                        <td class="px-6 py-4 font-bold text-btn-rose">{{ number_format($product->price, 0, '.', ' ') }} ₽</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-4 text-xs font-semibold">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-graphite hover:text-btn-rose uppercase">Редактировать</a>
                                <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Удалить товар?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 uppercase">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="max-w-6xl mx-auto mt-8">
        <a href="{{ route('catalog') }}" class="text-gray-400 hover:text-btn-rose text-xs uppercase tracking-widest">← Вернуться в магазин</a>
    </div>
</div>
@endsection

