@extends('adminlte::page')

@section('title', 'カテゴリ編集')

@section('content_header')
    <h1>カテゴリ編集</h1>
@stop

@section('content')
    <x-adminlte-card title="カテゴリ-編集">
        <form action="{{ route('admin.post-category.update', $postCategory->id) }}" method="POST">
            @csrf
            <div class="form-group col-6">
                <x-adminlte-input name="name" label="カテゴリ名" value="{{ old('name', $postCategory->name) }}" />
            </div>
            <div class="form-group col-6">
                <x-adminlte-input name="slug" label="スラグ" value="{{ old('slug', $postCategory->slug) }}" />
            </div>
            <div class="form-group col-6">
                <x-adminlte-button type="submit" label="更新" theme="primary" />
            </div>
        </form>
    </x-adminlte-card>
@stop

@section('css')
@stop

@section('js')
@stop
