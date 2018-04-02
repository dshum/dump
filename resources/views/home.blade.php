@extends('layout')

@section('title')
Home page
@endsection

@section('content')
@isset ($register)
<div class="ok">Вы успешно зарегистрировались!</div>
@endisset

@if (session('status'))
<div class="ok">
    {{ session('status') }}
</div>
@endif

<h1>Home page</h1>

@endsection