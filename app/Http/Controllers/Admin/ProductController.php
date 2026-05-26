<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
public function catalog(Request $request)
{
    $query = Product::query();

    // 1. Поиск по названию
    if ($request->filled('search')) {
        $query->where('name', 'LIKE', '%' . $request->search . '%');
    }

    // 2. Фильтр по категориям (тут работает whereIn, так как это ID)
    if ($request->has('categories') && is_array($request->categories)) {
        $query->whereIn('category_id', $request->categories);
    }

    // 3. Фильтр по цветам (используем логику LIKE для поиска в строке)
    if ($request->has('colors') && is_array($request->colors)) {
        $query->where(function($q) use ($request) {
            foreach ($request->colors as $color) {
                $q->orWhere('color', 'LIKE', '%' . $color . '%');
            }
        });
    }

    // 4. Фильтр по размерам (используем логику LIKE)
    if ($request->has('sizes') && is_array($request->sizes)) {
        $query->where(function($q) use ($request) {
            foreach ($request->sizes as $size) {
                $q->orWhere('sizes', 'LIKE', '%' . $size . '%');
            }
        });
    }

    // 5. Фильтр по цене с ограничением 15000
    if ($request->filled('min_price')) {
        $query->where('price', '>=', (float)$request->min_price);
    }

    $maxPrice = $request->filled('max_price') ? min((float)$request->max_price, 15000) : 15000;
    $query->where('price', '<=', $maxPrice);

    // 6. Сортировка
    switch ($request->sort) {
        case 'low': $query->orderBy('price', 'asc'); break;
        case 'high': $query->orderBy('price', 'desc'); break;
        case 'new': $query->latest(); break;
        default: $query->orderBy('id', 'desc'); break;
    }

    $products = $query->get();

    // Передаем категории для отображения в фильтрах
    $categories = \App\Models\Category::all();

    return view('catalog', compact('products', 'categories'));
}
        public function index()
        {
            $products = \App\Models\Product::with('categoryRelation')->get();
            return view('admin.products.index', compact('products'));
        }
        public function create()
        {
            $categories = Category::all();
            $availableColors = [
            'Белый', 'Молочный', 'Бежевый', 'Песочный', 'Пыльная роза', 'Розовый kЛАЕР',
            'Терракотовый', 'Шоколадный', 'Оливковый', 'Хвоя', 'Голубой', 'Стальной',
            'Светло-серый', 'Серый', 'Графит', 'Угольный', 'Черный', 'Лаванда'
            ];

            $availableSizes = ['XS', 'S', 'M', 'L', 'XL'];

            return view('admin.products.create', compact('categories', 'availableColors', 'availableSizes'));
        }
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    if($request->has('colors')) $data['color'] = implode(', ', $request->colors);
    if($request->has('sizes')) $data['sizes'] = implode(', ', $request->sizes);
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }
    if ($request->hasFile('image2')) {
        $data['image2'] = $request->file('image2')->store('products', 'public');
    }
    if ($request->hasFile('image3')) {
        $data['image3'] = $request->file('image3')->store('products', 'public');
    }

    \App\Models\Product::create($data);

    return redirect()->route('admin.index')->with('success', 'Товар успешно добавлен!');
}

    public function edit(Product $product)
    {
        $categories = Category::all();
        $availableColors = ['Белый', 'Молочный', 'Бежевый', 'Песочный', 'Пыльная роза', 'Розовый kЛАЕР', 'Терракотовый', 'Шоколадный', 'Оливковый', 'Хвоя', 'Голубой', 'Стальной', 'Светло-серый', 'Серый', 'Графит', 'Угольный', 'Черный', 'Лаванда'];
        $availableSizes = ['XS', 'S', 'M', 'L', 'XL'];

        return view('admin.products.edit', compact('product', 'categories', 'availableColors', 'availableSizes'));
    }

public function destroy(\App\Models\Product $product)
{
    if ($product->image && $product->image != 'test.jpg') {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
    }

    $product->delete();
    return redirect()->route('admin.index')->with('success', 'Товар удален навсегда');
}

public function update(Request $request, \App\Models\Product $product)
{
    // 1. Валидация
    $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
    ]);

    $data = $request->all();

    if ($request->has('colors')) {
        $data['color'] = implode(', ', $request->colors);
    } else {
        $data['color'] = null;
    }
    // Обработка размеров
    if ($request->has('sizes')) {
        $data['sizes'] = implode(', ', $request->sizes);
    } else {
        $data['sizes'] = null;
    }
    // 2. Обновляем основное фото
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    // 3. Обновляем второе фото
    if ($request->hasFile('image2')) {
        $data['image2'] = $request->file('image2')->store('products', 'public');
    }

    // 4. Обновляем третье фото
    if ($request->hasFile('image3')) {
        $data['image3'] = $request->file('image3')->store('products', 'public');
    }

    // 5. Сохраняем всё в базу
    $product->update($data);

    return redirect()->route('admin.index')->with('success', 'Товар успешно обновлен!');
}
}

