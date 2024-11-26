@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
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

<div class="category__content">
    <form class="category-form" action="/categories" method="post">
        <div class="category-form__item">
            @csrf
            <div class="category-form__input">
                <input class="category-form__input-text" type="text" name="name" id="" placeholder="カテゴリを入力してください">
            </div>
            <div class="category-form__button">
                <button type="submit" class="category-form__button-submit">作成</button>
            </div>
        </div>
    </form>
    <div class="category-table">
        <table class="category-table__inner">
            <tr class="category-table__row">
                <th class="category-table__header">Category</th>
            </tr>
            @foreach($categories as $category)
            <tr class="category-table__row">
                <form action="/categories/update" class="update-form" method="post">
                @csrf
                @method('patch')
                    <div class="update-form__item">
                        <td class="update-form__input">
                            <input type="text" name="name" value="{{ $category->name }}" class="update-form__input-text">
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                        </td>
                        <td class="update-form__button">
                            <button type="submit" class="update-form__button-submit">更新</button>
                        </td>
                    </div>
                </form>
                <form class="delete-form" action="/categories/delete" method="post">
                @csrf
                @method('delete')
                    <td class="delete-form__button">
                        <button type="submit" class="delete-form__button-submit">削除</button>
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                    </td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection