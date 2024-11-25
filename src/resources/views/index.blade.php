@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="alert-message">
    @if(session('message'))
    <div class="alert-message__success">{{ session('message') }}</div>
    @endif
    @if($errors->any())
    <div class="alert-message__danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="todo__content">
    <form class="crete-form" action="/todos" method="post">
        <div class="create-form__item">
            @csrf
            <div class="create-form__input">
                <input class="create-form__input-text" type="text" name="content" id="" placeholder="Todoを入力してください">
            </div>
            <div class="create-form__button">
                <button type="submit" class="create-form__button-submit">作成</button>
            </div>
        </div>
    </form>
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
            </tr>
            @foreach($todos as $todo)
            <tr class="todo-table__row">
                <form action="/todos/update" class="update-form" method="post">
                @csrf
                    <div class="update-form__item">
                        <td class="update-form__input">
                            <input type="text" name="content" value="{{ $todo->content }}" class="update-form__input-text">
                        </td>
                        <td class="update-form__button">
                            <button type="submit" class="update-form__button-submit">更新</button>
                        </td>
                    </div>
                </form>
                <form class="delete-form" action="/todos/delete" method="post">
                @csrf
                    <td class="delete-form__button">
                        <button type="submit" class="delete-form__button-submit">削除</button>
                    </td>
                </form>
            @endforeach
            </tr>
        </table>
    </div>
</div>
@endsection