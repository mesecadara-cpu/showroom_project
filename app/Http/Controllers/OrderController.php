<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // 1. Валидация данных из формы
$request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'string', 'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'],
            'address' => 'required|string|max:500',
        ], [
            'phone.regex' => 'Введите номер телефона полностью в формате +7 (XXX) XXX-XX-XX',
            'name.required' => 'Пожалуйста, введите ваше имя',
            'address.required' => 'Поле адреса не может быть пустым'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Корзина пуста!');
        }

        // 2. Создаем основной заказ
        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => collect($cart)->sum(function($item) {
                return $item['price'] * $item['quantity'];
            }),
            'status' => 'new',
        ]);

        // 3. Сохраняем каждый товар из корзины в таблицу order_items
        foreach ($cart as $id => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $details['name'],
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }
        session()->forget('cart');
        return redirect()->back()->with('success', 'Заказ успешно оформлен! Наш менеджер скоро свяжется с вами.');
    }

public function adminIndex()
{
    $orders = Order::with('items')->latest()->get();
    $totalSum = $orders->sum('total_price');
    $ordersCount = $orders->count();
    return view('admin.orders', compact('orders', 'totalSum', 'ordersCount'));
}

public function destroy($id)
{
    $order = Order::findOrFail($id);
    $order->delete();
    return redirect()->back()->with('success', 'Заказ удален');
}
}
