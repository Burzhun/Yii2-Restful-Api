<?php 
namespace app\models;


use yii\mongodb\ActiveRecord;



class Post extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'posts';
    }

    public function rules()
    {
        return [
            
            [[ 'userSlug', 'text','rating','timePassed'], 'safe'],
            [['placeSlug', 'organisationSlug'], 'required_condition'],
            ['rating', 'in', 'range' => ['very-bad', 'very-good','bad','good']],
            ['timePassed','integer']
           
        ];
    }

    public function required_condition($attribute_name, $params)
    {
        if (empty($this->placeSlug)
                && empty($this->organisationSlug)
        ) {
            $this->addError($attribute_name, Yii::t('Post', 'At least 1 of the field must be filled up properly'));

            return false;
        }

        return true;
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['_id', 'userSlug', 'placeSlug', 'organisationSlug', 'text','rating','timePassed'];
    }

    public function fields()
    {
        return ['_id','place','user','organisation', 'text','rating','timePassed'];
    }

   

    public function getPlace()
    {
        return $this->hasOne(Place::className(),['slug'=>'placeSlug']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['slug'=>'userSlug']);
    }

    public function getOrganisation()
    {
        return $this->hasOne(Organisation::className(),['slug'=>'organisationSlug']);
    }

    
}