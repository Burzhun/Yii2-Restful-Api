<?php

namespace app\modules\api;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    public $defaultRoute = 'main/index';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        
        \Yii::$app->response->on(\yii\web\Response::EVENT_BEFORE_SEND, function ($event) 
        {
            $response = $event->sender;
            
            if($response->statusCode==404){
                $response->data=json_encode([
                    "status"=> "UrlNotFound",
                    "message"=> "URL не найден",
                    "data"=> []
                ],JSON_UNESCAPED_UNICODE);                         
            }
            if($response->statusCode==500){
                $response->data=json_encode([
                    "status"=> "GeneralInternalError",
                    "message"=> "Произошла ошибка",
                    "data"=> []
                ],JSON_UNESCAPED_UNICODE );                         
            }
            if($response->statusCode==200) {
                $response->data = [
                    'status' => "Success",
                    'code' => "Успешно",
                    "data" =>["post"=>$response->data]
                ];
            }

            
        });
    }
}
