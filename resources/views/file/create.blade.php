@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Добавить файл</div>

                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ url('files') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Название документа</label>
                            <div class="col-sm-8">
                                <input value="{{ old('name') }}" type="text" name="name" 
                                       class="form-control" placeholder="введите название файла">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Тип файла</label>
                            <div class="col-sm-8">
                                <select name="type" class="form-control">
                                    @foreach ($types as $key=>$value)
                                        @if ( !is_null(old('type')) && ($key == old('type')))
                                            <option selected value="{{ $key }}">{{$value}}</option>
                                        @else
                                            <option value="{{ $key }}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Описание файла</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="max-width: 100%;" name="desc" 
                                          rows="3" placeholder="Описание файла">{{ old('desc') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-sm-12">
                                Отправить в телеграм(только для изображений)
                                <input type="checkbox" name="telegram">
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <div class="col-sm-offset-4 col-sm-8">
                                <label for="file" class="btn btn-success">Выберите файл</label>
                                <input style="display: none;" id="file" type="file" name="file">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection