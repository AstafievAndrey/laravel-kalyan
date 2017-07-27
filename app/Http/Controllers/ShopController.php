<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kalyan\Shop;
use App\Models\Kalyan\Shedule;
use App\Models\Kalyan\File;
use App\Models\Kalyan\City;

class ShopController extends Controller
{
    
    private $days_week = array(
        0 => array("id"=>1,"name"=>"Понедельник"),
        1 => array("id"=>2,"name"=>"Вторник"),
        2 => array("id"=>3,"name"=>"Среда"),
        3 => array("id"=>4,"name"=>"Четверг"),
        4 => array("id"=>5,"name"=>"Пятница"),
        5 => array("id"=>6,"name"=>"Суббота"),
        6 => array("id"=>7,"name"=>"Воскресенье"),
    );
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shop.index',[
                    "shops"=>Shop::where('user_id',  Auth::id())
                                ->orderBy('id','desc')
                                ->paginate(15)
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop.create',[
                    "cities"=>  City::all(),
                    "days_week"=>$this->days_week
                ]);
    }
    
    /**
    * @return array
    */
    private function messages()
    {
        return [
            'file.mimes' => 'Не верный формат файла. Выберите верный файл',
        ];
    }
    
    public function rus2translit($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '',    'ы' => 'y',   'ъ' => '',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
            
            ' ' => '-',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return  trim(
                    preg_replace('~[^-a-z0-9_]+~u', '-', strtolower(strtr($string, $converter))),
                '-');
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $seo_translit = $this->rus2translit(
            City::find($request->city_id)->name.' '.$request->name.' '.$request->address[0]['name']
        );
        $validator = Validator::make(array_merge($request->all(),array("seo_translit"=>$seo_translit)), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'description' => 'required|string',
            'address.0.name' => 'required|string',
            'address.0.lat' => 'required|string',
            'address.0.lon' => 'required|string',
            'logo' => 'required|file|mimes:jpg,png,jpeg',
//            'files' => 'required|file|mimes:jpg,png,jpeg'
        ], $this->messages());  
        $validator->after(function ($validator) {
            $input = $validator->getData();
            if(Shop::where('seo_translit',$input['seo_translit'])->first()){
                $validator->getMessageBag()->add('translit', 'Возможно такое заведение уже присутствует в бд');
            }
        });
        if ($validator->fails()) {
            return redirect('shop/create')->withErrors($validator)->withInput();
        }
        
        $file = new File();
        $file->name = str_replace('kalyan/', '',$request->logo->store('kalyan','public'));
        $file->organization_id = Auth::id();
        $file->size = $request->logo->getClientSize();
        $file->active = true;
        $file->save();
        
        $shop = new Shop();
        $shop->file_id = $file->id;
        $shop->name = $request->name;
        $shop->phone = $request->phone;
        $shop->address = $request->address[0]['name'];
        $shop->lat = $request->address[0]['lat'];
        $shop->lon = $request->address[0]['lon'];
        $shop->city_id = $request->city_id;
        $shop->organization_id = Auth::id();
        $shop->user_id = Auth::id();
        $shop->parking = $request->parking;
        $shop->alcohol = $request->alcohol;
        $shop->food = $request->food;
        $shop->veranda = $request->veranda;
        $shop->console = $request->console;
        $shop->board = $request->board;
        $shop->active = true;
        $shop->seo_translit = $seo_translit;
        $shop->short_desc = $request->short_desc;
        $shop->description = $request->description;
        $shop->save();
        
        foreach($request->schedule as $key=>$value){
            $shedule = new Shedule();
            $shedule->shop_id= $shop->id;
            $shedule->day_id= $key;
            $shedule->type_work= $value['type_work'];
            $shedule->work_begin= isset($value['work_begin'])? $value['work_begin']:null;
            $shedule->work_end= isset($value['work_end'])? $value['work_end']:null;
            $shedule->save();
            unset($shedule);
        }

        return redirect('shop/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo $id;
    }
}
