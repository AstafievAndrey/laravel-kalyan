<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Content\File;
use App\Models\Content\Telegram;
use Illuminate\Http\Request;


class FileController extends Controller
{
    
    /**
     * Отобразим список файлов
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('file.index',[
                'files'=>File::paginate(15)
            ]);
    }

    /**
     * Форма для сохранения в файла
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('file.create',['types'=>array('img'=>'изображения','doc'=>'документы','video'=>'видео')]);
    }
    
    /**
    * @return array
    */
    private function messages()
    {
        return [
            'name.required' => 'Заполните название поля',
            'type.required' => 'Выберите значение',
            'desc.required' => 'Дайте описание файла',
            'file.required' => 'Прикрепите файл',
            'file.mimes'    => 'Не верный формат файла. Выберите верный файл',
        ];
    }

    /**
     * Сохраним файл в бд и на сервер
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png,jpeg,gif,avi',
            'type' => 'required'], $this->messages());        
        if ($validator->fails()) {
            return redirect('files/create')->withErrors($validator)->withInput();
        }
        
        $file = new File;
        $file->name = $request->name; $file->desc = $request->desc;
        $file->type = $request->type; $file->data = $request->file;
        $file->filepath = $request->file->store($request->type,'public');
        $file->extension = $request->file->extension();
        $file->mime_type = $request->file->getMimeType();
        $file->original_name = $request->file->getClientOriginalName();
        $file->size = $request->file->getClientSize();
        $file->save();
        if(!is_null($request->telegram) && ($file->type==="img"))
            $this->telegram(storage_path('app/public/'.$file->filepath));
        return redirect('files/create');
    }
    
    /**
     * Рассылаем изображение всем пользователям, которые подписаны на бота
     */
    private function telegram($realpath){
        $chats = Telegram::all();
        $bot_url    = config('telegram.TattstBot.bot_url');
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type:multipart/form-data"
        ));
        echo $realpath;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        foreach ($chats as $chat) {
            curl_setopt($ch, CURLOPT_URL, $bot_url . "sendPhoto?chat_id=".$chat->id);
            $post_fields = array('chat_id'   => $chat->id,
                'photo'     => new \CURLFile(realpath($realpath))
            );
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
            curl_exec($ch);
        }
        curl_close($ch);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Мягкое удаление из бд и не мягко удаляем из файловой системы
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        @$file->delete();
        @unlink(storage_path('app/public/'.$file->filepath));
        return redirect('files');
    }
}
