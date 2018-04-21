@if ($total)
<style>
.browse-plugin img {
    margin: 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 0;
}
</style>
<div>Сегодня я уже съел {{ $total }} кал.</div>
<br>
@foreach ($pictures as $picture)
@if ($picture['diff'] > 30)<br>@endif
<img src="{{ $picture['picture'] }}" title="{{ $picture['name'] }}, {{ $picture['grams'] }} г, {{ $picture['calories'] }} кал">
@endforeach
@else
<div>Сегодня я еще ничего не ел.</div>
@endif