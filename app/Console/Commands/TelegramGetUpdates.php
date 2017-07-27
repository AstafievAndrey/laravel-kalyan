<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Content\Telegram;

class TelegramGetUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url= config('telegram.TattstBot.bot_url');
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url.'getUpdates'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $res=json_decode(curl_exec($ch), true);
        curl_close($ch);
        if(isset($res["ok"]) && $res["ok"]===true ){
            for($i=0;$i<count($res['result']);$i++){
                $chat = $res['result'][$i]['message']['chat'];
                unset($res['result'][$i]['message']);
                $model = Telegram::find($chat['id']);
                if(is_null($model)){
                    $model = new Telegram();
                    $model->id = $chat['id'];
                    $model->first_name = $chat['first_name'];
                    $model->last_name = $chat['last_name'];
                    $model->type = $chat['type'];
                    $model->save();
                }
                unset($model);
            }
        }else{
            echo "Ошибка, пустой ответ от телеграмма!";
        }
    }
}
