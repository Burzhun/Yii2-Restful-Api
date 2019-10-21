<?php

namespace app\components;
 
use Yii;
use yii\web\Response;
use yii\web\UnsupportedMediaTypeHttpException;
 
/**
 * @inheritdoc
 */
class ErrorHandler extends \yii\web\ErrorHandler
{
    /**
     * @inheridoc
     */
    protected function renderException($exception)
    {
        if (Yii::$app->has('response')) {
            $response = Yii::$app->getResponse();           
            // reset parameters of response to avoid interference with partially created response data
            // in case the error occurred while sending the response.
            $response->isSent = false;
            $response->stream = null;
            $response->data = null;
            $response->content = null;
        } else {
            $response = new Response();
        }
        if ($exception instanceof UnsupportedMediaTypeHttpException) {
            $response->data = '';
        } else {
            $response->data = $this->convertExceptionToArray($exception);
        }
        $response->setStatusCode($exception->statusCode);
        $response->send();
    }

    public function getUniqueId()
    {
        return  $this->id;
    }
}