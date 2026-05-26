<form action="{{ route('order.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Ваше имя" required>
    <input type="text" name="phone" placeholder="Номер телефона" required>
    <textarea name="address" placeholder="Адрес доставки" required></textarea>

    {{-- Скрытое поле с итоговой суммой --}}
    <input type="hidden" name="total_price" value="{{ $total }}">

    <button type="submit">Подтвердить заказ</button>
</form>
