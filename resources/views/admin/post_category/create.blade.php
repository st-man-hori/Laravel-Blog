@extends('adminlte::page')

@section('title', 'カテゴリ新規作成')

@section('content_header')
    <h1>カテゴリ新規作成</h1>
@stop

@section('content')
    <x-adminlte-card title="カテゴリ-新規作成">
        <form action="{{ route('admin.post-category.store') }}" method="POST">
            @csrf
            <div class="form-group col-6">
                <x-adminlte-input name="name" label="カテゴリ名" value="{{ old('name') }}" />
            </div>
            <div class="form-group col-6">
                <x-adminlte-input name="slug" label="スラグ" value="{{ old('slug') }}" />
            </div>
            <div class="form-group col-6">
                <x-adminlte-button type="submit" label="登録" theme="primary" />
            </div>
        </form>
    </x-adminlte-card>
@stop

@section('css')
@stop

@section('js')
@stop
