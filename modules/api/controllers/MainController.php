<?php

namespace app\modules\api\controllers;

use yii\rest\ActiveController;


class MainController extends ActiveController
{
    public $modelClass = 'app\models\Post';


    public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),                
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
                
            ],
        ];
    }

    

    
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        return $actions;
    }

    public function actionView($id){
        $model = \app\models\Post::findOne($id);
        if($model){
            return $model;
        }else{
            return [
                "status"=>"RecordNotFound",
                "message"=> "Запись не найдена",
                "data"=> []
            ];
            
        }
         
    }

    
}