<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShowroomController extends Controller
{

    // Главная страница
public function index(Request $request)
{
    $brandName = "kЛАЕР";
    $aboutText = "Минималистичные коллекции для тех, кто ценит качество и комфорт в каждой детали.";

    $trendingProducts = \App\Models\Product::latest()->take(4)->get();

    // 1. Начинаем строить запрос к базе данных через модель Product
    $query = \App\Models\Product::query();

    // 2. Фильтр по цветам (ищем в колонке 'color')
    if ($request->has('colors')) {
        $query->where(function($q) use ($request) {
            foreach ($request->colors as $color) {
                // Используем LIKE, так как в базе цвета хранятся строкой через запятую
                $q->orWhere('color', 'LIKE', '%' . $color . '%');
            }
        });
    }

    // 3. Фильтр по размерам (ищем в колонке 'sizes')
    if ($request->has('sizes')) {
        $query->where(function($q) use ($request) {
            foreach ($request->sizes as $size) {
                $q->orWhere('sizes', 'LIKE', '%' . $size . '%');
            }
        });
    }

    // 4. Получаем итоговый список товаров из базы
    $products = $query->get();

    // 5. Отправляем данные в ту же вьюху welcome (или catalog, смотря где у тебя витрина)
    return view('welcome', compact('brandName', 'aboutText', 'products', 'trendingProducts'));
}


    public function show($id)
{
    // Находим товар по ID, который пришел из ссылки
    $product = \App\Models\Product::findOrFail($id);

    // Отправляем пользователя на страницу с деталями товара
    return view('product-detail', compact('product'));
}

    // Страница Каталога
public function catalog(Request $request)
{
    // 1. Начинаем строить запрос, но не выполняем его сразу
    $query = \App\Models\Product::query();

    // 2. Фильтр по категориям
    // Если в запросе есть массив categories (нажаты галочки)
    if ($request->has('categories') && is_array($request->categories)) {
        $query->whereIn('category_id', $request->categories);
    }

    // 3. Фильтр по цене (от)
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    // 4. Фильтр по цене (до)
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    // 5. Выполняем запрос и получаем результат
    $products = $query->get();

    // 6. Не забываем получить категории для отображения в сайдбаре
    $categories = \App\Models\Category::all();

    return view('catalog', compact('products', 'categories'));
}

    // Страница О нас
    public function about()
    {
        return view('about');
    }

    // Страница Доставка и оплата
    public function delivery()
    {
        return view('delivery');
    }

    // Отображение страницы корзины
    public function cart()
    {
        // Получаем товары из сессии, если их нет — пустой массив
        $cartItems = session()->get('cart', []);

        return view('cart', compact('cartItems'));
    }

    // Добавление товара в корзину (AJAX запрос)
public function addToCart(Request $request, $id)
{
    $product = Product::findOrFail($id);
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "image" => $product->image
        ];
    }

    session()->put('cart', $cart);
    $totalQuantity = collect($cart)->sum('quantity');

    // Если запрос идет от JavaScript (как у нас)
    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'cart_count' => $totalQuantity
        ]);
    }

    return redirect()->back();
}

public function removeFromCart($id)
{
    $cart = session()->get('cart');

    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()->with('success', 'Товар удален!');
}

public function updateCart(Request $request, $id)
{
    $cart = session()->get('cart');

    if(isset($cart[$id])) {
        // Если пришло 'inc', увеличиваем, если 'dec' — уменьшаем (но не меньше 1)
        if($request->action == 'inc') {
            $cart[$id]['quantity']++;
        } elseif($request->action == 'dec' && $cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        }

        session()->put('cart', $cart);
    }

    return back();
}

    // Обработка быстрой заявки (обратный звонок)
    public function order(Request $request)
    {
        return back()->with('success', 'Заявка отправлена! Менеджер скоро свяжется с вами.');
    }
}
