@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default panel-heading col-md-8 col-md-offset-2">
             <a href="{{ url('shop/create') }}" class="btn btn-primary btn-xs">Добавить</a>
        </div>
        <div class="col-md-8 col-md-offset-2">
            @foreach ($shops as $shop)
                <div class="row panel panel-default">
                    <div class="col-sm-12 page-header">
                        <h3>{{ $shop->name }} <br> <small>{{ $shop->short_desc }}</small></h3>
                    </div>
                    <div class="col-sm-12" style="text-align: right;padding-bottom: 10px">
                        <form class="form-inline" action="{{ url('shop/'.$shop->id) }}" method="POST">
                            {{ method_field('delete') }}
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="#" class="btn btn-primary btn-xs">Редактировать</a>
                            <button type="submit" class="btn btn-danger btn-xs">Удалить</button>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-sm-12">
                    {{ $shops->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection