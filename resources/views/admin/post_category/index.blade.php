@extends('adminlte::page')

@section('title', 'カテゴリ一覧')

@section('content_header')
    <h1>カテゴリ一覧</h1>
@stop

@section('content')
    <x-adminlte-card title="検索">
        <form action="{{ route('admin.post-category.index') }}">
            <div class="form-group col-4">
                <x-adminlte-input name="keyword" label="フリーワード" value="{{ $searchRequests['keyword'] }}" />
            </div>
            <div class="form-group col-6">
                <x-adminlte-button type="submit" label="検索" theme="primary" icon="fas fa-search" />
            </div>
        </form>
    </x-adminlte-card>

    <x-adminlte-card title="カテゴリ一覧">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>カテゴリ名</th>
                    <th>スラグ名</th>
                    <th>登録日時</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postCategories as $postCategory)
                    <tr>
                        <td>{{ $postCategory->id }}</td>
                        <td>{{ $postCategory->name }}</td>
                        <td>{{ $postCategory->slug }}</td>
                        <td>{{ $postCategory->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer clearfix">
            {{ $postCategories->links() }}
        </div>
    </x-adminlte-card>
@stop

@section('css')
@stop

@section('js')
@stop
