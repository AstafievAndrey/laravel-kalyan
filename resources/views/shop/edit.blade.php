@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Добавить заведение</div>

                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ url('shop/'.$shop->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Название заведения</label>
                            <div class="col-sm-8">
                                <input value="{{ $shop->name }}" type="text" name="name" 
                                       class="form-control" placeholder="введите название заведения">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Телефон</label>
                            <div class="col-sm-8">
                                <input value="{{ $shop->phone }}" type="text" name="phone" 
                                       class="form-control" placeholder="укажите телефон">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Сайт</label>
                            <div class="col-sm-8">
                                <input value="{{ $shop->site }}" type="text" name="site" 
                                       class="form-control" placeholder="ссылка на сайт">
                                @if ($errors->has('site'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('site') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('inst') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Инстаграмм</label>
                            <div class="col-sm-8">
                                <input value="{{ $shop->inst }}" type="text" name="inst" 
                                       class="form-control" placeholder="ссылка на инстаграмм">
                                @if ($errors->has('inst'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('inst') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('vk') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Вконтакте</label>
                            <div class="col-sm-8">
                                <input value="{{ $shop->vk }}" type="text" name="vk" 
                                       class="form-control" placeholder="ссылка на страницу или группу в вк">
                                @if ($errors->has('vk'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                                Адрес
                                <!--<button onclick="addAddress()" type="button" class="btn btn-primary btn-xs">Добавить</button>-->
                            </label>
                            <div id="address" class="col-sm-12" style="margin-top: 10px">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-2{{ $errors->has('address.0.name') ? ' has-error' : '' }}">
                                        <input value="{{ $shop->address }}" type="text" name="address[0][name]" 
                                               class="form-control" placeholder="введите адрес">
                                        @if ($errors->has('address.0.name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address.0.name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-2{{ $errors->has('address.0.lat') ? ' has-error' : '' }}">
                                        <input value="{{ $shop->lat }}" type="text" name="address[0][lat]" 
                                               class="form-control" placeholder="широта">
                                        @if ($errors->has('address.0.lat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address.0.lat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-2{{ $errors->has('address.0.lon') ? ' has-error' : '' }}">
                                        <input value="{{ $shop->lon }}" type="text" name="address[0][lon]" 
                                               class="form-control" placeholder="долгота">
                                        @if ($errors->has('address.0.lon'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address.0.lon') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Выберите город</label>
                            <div class="col-sm-8">
                                <select name="city_id" class="form-control">
                                    @foreach ($cities as $city)
                                        @if ( $city->id == $shop->city->id )
                                            <option selected value="{{ $city->id }}">{{$city->name}}</option>
                                        @else
                                            <option value="{{ $city->id }}">{{$city->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('city_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-4 col-xs-6 control-label">
                                <label>Парковка:</label> 
                                @if ( $shop->parking )
                                    <label><input type="radio" name="parking" value="true" checked> Да</label>
                                    <label><input type="radio" name="parking" value="false" > Нет</label>
                                @else
                                    <label><input type="radio" name="parking" value="true"> Да</label>
                                    <label><input type="radio" name="parking" value="false" checked> Нет</label>
                                @endif
                            </div>
                            <div class="col-sm-4 col-xs-6 control-label">
                                <label>Алкоголь:</label> 
                                @if ( $shop->alcohol )
                                    <label><input type="radio" name="alcohol" value="true" checked> Да</label>
                                    <label><input type="radio" name="alcohol" value="false" > Нет</label>
                                @else
                                    <label><input type="radio" name="alcohol" value="true"> Да</label>
                                    <label><input type="radio" name="alcohol" value="false" checked> Нет</label>
                                @endif
                            </div>
                            <div class="col-sm-4 col-xs-6 control-label">
                                <label>Еда:</label> 
                                @if ( $shop->food )
                                    <label><input type="radio" name="food" value="true" checked> Да</label>
                                    <label><input type="radio" name="food" value="false" > Нет</label>
                                @else
                                    <label><input type="radio" name="food" value="true"> Да</label>
                                    <label><input type="radio" name="food" value="false" checked> Нет</label>
                                @endif
                            </div>
                            <div class="col-sm-4 col-xs-6 control-label">
                                <label>Веранда:</label> 
                                @if ( $shop->veranda )
                                    <label><input type="radio" name="veranda" value="true" checked> Да</label>
                                    <label><input type="radio" name="veranda" value="false" > Нет</label>
                                @else
                                    <label><input type="radio" name="veranda" value="true"> Да</label>
                                    <label><input type="radio" name="veranda" value="false" checked> Нет</label>
                                @endif
                            </div>
                            <div class="col-sm-4 col-xs-6 control-label">
                                <label>Консоли:</label> 
                                @if ( $shop->console )
                                    <label><input type="radio" name="console" value="true" checked> Да</label>
                                    <label><input type="radio" name="console" value="false" > Нет</label>
                                @else
                                    <label><input type="radio" name="console" value="true"> Да</label>
                                    <label><input type="radio" name="console" value="false" checked> Нет</label>
                                @endif
                            </div>
                            <div class="col-sm-4 col-xs-6 control-label">
                                <label>Настольные:</label> 
                                @if ( $shop->board )
                                    <label><input type="radio" name="board" value="true" checked> Да</label>
                                    <label><input type="radio" name="board" value="false" > Нет</label>
                                @else
                                    <label><input type="radio" name="board" value="true"> Да</label>
                                    <label><input type="radio" name="board" value="false" checked> Нет</label>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('short_desc') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Краткие описание</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="max-width: 100%;" name="short_desc" 
                                          rows="1">{{ $shop->short_desc }}</textarea>
                                @if ($errors->has('short_desc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('short_desc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label class="col-sm-4 control-label">Описание заведения</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="max-width: 100%;" name="description" 
                                          rows="3">{{ $shop->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                                Расписание:
                            </label>
                            @foreach ($shop->shedule as $day)
                                <div class="col-sm-12" style="margin-top: 10px">
                                    <div class="row">
                                        <div class="col-sm-2 control-label">
                                            <label>{{$day["day"]["name"]}}:</label> 
                                        </div>
                                        <div class="col-sm-6 control-label">
                                            <label>
                                                @if ( (int)$day["type_work"] == 1 )
                                                    <input onchange="sheduleType(this)"  type="radio" name="schedule[{{$day['day_id']}}][type_work]" value="1" checked>
                                                @else
                                                    <input onchange="sheduleType(this)"  type="radio" name="schedule[{{$day['day_id']}}][type_work]" value="1">
                                                @endif
                                                Выходной
                                            </label>
                                            <label>
                                                @if ( (int)$day["type_work"] == 2 )
                                                    <input onchange="sheduleType(this)"  type="radio" name="schedule[{{$day['day_id']}}][type_work]" value="2" checked>
                                                @else
                                                    <input onchange="sheduleType(this)" type="radio" name="schedule[{{$day['day_id']}}][type_work]" value="2">
                                                @endif
                                                Круглосуточно
                                            </label>
                                            <label>
                                                @if ( (int)$day["type_work"] == 3 )
                                                    <input onchange="sheduleType(this)"  type="radio" name="schedule[{{$day['day_id']}}][type_work]" value="3" checked>
                                                @else
                                                    <input onchange="sheduleType(this)" type="radio" name="schedule[{{$day['day_id']}}][type_work]" value="3">
                                                @endif
                                                Время
                                            </label>
                                        </div>
                                        <div class="col-sm-2">
                                            @if ( (int)$day["type_work"] == 3 )
                                                <select name="schedule[{{$day['day_id']}}][work_begin]" class="form-control">
                                            @else
                                                <select disabled name="schedule[{{$day['day_id']}}][work_begin]" class="form-control">
                                            @endif
                                            
                                                @for ($i = 1; $i < 25; $i++)
                                                    @if ( (int)$day["work_begin"] == $i  )
                                                        <option selected value="{{ $i }}">{{$i}}</option>
                                                    @else
                                                        <option value="{{ $i }}">{{$i}}</option>
                                                    @endif
                                                @endfor
                                                
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            @if ( (int)$day["type_work"] == 3 )
                                                <select name="schedule[{{$day['day_id']}}][work_end]" class="form-control">
                                            @else
                                                <select disabled name="schedule[{{$day['day_id']}}][work_end]" class="form-control">
                                            @endif
                                            
                                                @for ($i = 1; $i < 25; $i++)
                                                    @if ( (int)$day["work_end"] == $i  )
                                                        <option selected value="{{ $i }}">{{$i}}</option>
                                                    @else
                                                        <option value="{{ $i }}">{{$i}}</option>
                                                    @endif
                                                @endfor
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="logo" class="btn btn-primary btn-xs">Логотип</label>
                                <input style="display: none;" id="logo" type="file" name="logo" accept="image/jpeg,image/png">
<!--                                <label for="files" class="btn btn-primary btn-xs">Интерьер</label>
                                <input style="display: none;" id="files" multiple type="file" name="files" accept="image/jpeg,image/png">-->
                                <strong>Изображения могут быть в следующем формате JPEG, PNG</strong>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                            @if ( !is_null($shop->logo) )
                                <div class="col-sm-6">
                                    <img src="{{ asset('storage/kalyan/'.$shop->logo->name) }}" class="img-thumbnail">
                                </div>
                            @endif
                            <div class="col-sm-12">
                                @if ($errors->has('logo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group{{ $errors->has('translit') ? ' has-error' : '' }}">
                            <div class="col-sm-12">
                                @if ($errors->has('translit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('translit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 col-sm-offset-8 control-label">
                                <button type="submit" class="btn btn-primary">
                                    Сохранить
                                </button>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function addAddress(){
        var address = document.getElementById("address");
        address.innerHTML += '<div class="row" style="margin-top:10px;">\n\
                                <div class="col-sm-2 control-label">\n\
                                    <button type="button" onclick="removeAddress(this)" class="btn btn-danger btn-xs">Удалить</button>\n\
                                </div>\n\
                                <div class="col-sm-6">\n\
                                    <input value="" type="text" name="address['+address.children.length+'][name]" class="form-control" placeholder="введите адрес">\n\
                                </div>\n\
                                <div class="col-sm-2">\n\
                                    <input value="" type="text" name="address['+address.children.length+'][lat]" class="form-control" placeholder="широта">\n\
                                </div>\n\
                                <div class="col-sm-2">\n\
                                    <input value="" type="text" name="address['+address.children.length+'][lon]" class="form-control" placeholder="долгота">\n\
                                </div>\n\
                            </div>';
    }
    
    function removeAddress(th){
        var rm = th.parentElement.parentElement;
        rm.parentNode.removeChild(rm);
        var address = document.getElementById("address");
        for( var i=0; i < address.childNodes.length; i++){
            var inp = (address.childNodes[i]).getElementsByTagName("input");
            for(var j=0; j < inp.length; j++){
                var name = inp[j].getAttribute("name");
                if(name.indexOf("name") !== -1){
                    inp[j].setAttribute("name", "address["+i+"][name]");
                }
                if(name.indexOf("lat") !== -1){
                    inp[j].setAttribute("name", "address["+i+"][lat]");
                }
                if(name.indexOf("lon") !== -1){
                    inp[j].setAttribute("name", "address["+i+"][lon]");
                }
            }
        }
    }
    
    function sheduleType(th){
        var select = (th.parentElement.parentElement.parentElement)
                        .getElementsByTagName("select");
        if(parseInt(th.value) === 3){
            for(var i = 0; i < select.length; i++){
                select[i].disabled = false;
            }
        }else{
            for(var i = 0; i < select.length; i++){
                select[i].disabled = true;
            }
        }
    }
</script>
@endsection