@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Файлы
                    <a class="btn btn-primary btn-xs" href="{{ url('files/create') }}">добавить</a>
                </div>

                <div class="panel-body">
                    @foreach ($files as $file)
                        <div class="row" style="margin-top:10px; padding: 10px 0px; background: #f9f9f9;">
                            @if ($file->type === 'img')
                                <div class="col-sm-6">
                                    <img src="{{ asset('storage/'.$file->filepath) }}" alt="..." class="img-thumbnail">
                                </div>
                                <div class="col-sm-6">
                            @else
                                <div class="col-sm-12">
                            @endif
                                    <div class="row">
                                        <div class="col-sm-12">
                                            Название: {{ $file->original_name }}
                                        </div>
                                        <div class="col-sm-12">
                                            Тип:@if ($file->type === 'img')
                                                    изображение
                                                @elseif ($file->type === 'doc')
                                                    документ
                                                @else
                                                    видео
                                                @endif
                                        </div>
                                        <div class="col-sm-12">
                                            Размер: {{ round($file->size / 1024,2) }} кБ
                                        </div>
                                        <div class="col-sm-12">
                                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ url('files/'.$file->id) }}">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger btn-xs" type="submit">
                                                    удалить
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-sm-12">
                            {{ $files->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection