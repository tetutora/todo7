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
        @csrf
        <div class="create-form__title">
            <h2>新規作成</h2>
        </div>
        <div class="create-form__item">
            <div class="create-form__input">
                <input class="create-form__input-text" type="text" name="content" id="" placeholder="Todoを入力してください">
            </div>
            <select class="create-form__select" name="category_id" id="">
                <option value="">カテゴリ</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <div class="create-form__button">
                <button type="submit" class="create-form__button-submit">作成</button>
            </div>
        </div>
    </form>
    <form class="search-form" action="/todos/search" method="get">
        @csrf
        <div class="search-form__title">
            <h2>Todo検索</h2>
        </div>
        <div class="search-form__item">
            @csrf
            <div class="search-form__input">
                <input class="search-form__input-text" type="search" name="content" id="" >
            </div>
            <select class="search-form__select" name="category_id" id="">
                <option value="">カテゴリ</option>
                <option value=""></option>
            </select>
            <div class="search-form__button">
                <button type="submit" class="search-form__button-submit">検索</button>
            </div>
        </div>
    </form>
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
                <th class="todo-table__category">カテゴリ</th>
            </tr>
            @foreach($todos as $todo)
            <tr class="todo-table__row">
                <form action="/todos/update" class="update-form" method="post">
                @csrf
                @method('PATCH')
                    <div class="update-form__item">
                        <td class="update-form__input">
                            <input type="text" name="content" value="{{ $todo->content }}" class="update-form__input-text">
                            <input type="hidden" name="id" value="{{ $todo->id }}">
                        </td>
                        <td class="category__item">
                            <select name="category_id" class="category__item-list">
                                <option value="">カテゴリを選択</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $todo->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="update-form__button">
                            <button type="submit" class="update-form__button-submit">更新</button>
                        </td>
                    </div>
                </form>
                <form class="delete-form" action="/todos/delete" method="post">
                @csrf
                @method('delete')
                    <td class="delete-form__button">
                        <button type="submit" class="delete-form__button-submit">削除</button>
                        <input type="hidden" name="id" value="{{ $todo->id }}">
                    </td>
                </form>
            @endforeach
            </tr>
        </table>
    </div>
</div>
@endsection