<?php 
namespace app\models;
use yii\mongodb\ActiveRecord;


class Place extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'places';
    }

    public function rules()
    {
        return [
            
            [[ 'subcategory'], 'safe'],
            [['name', 'city', 'street', 'category','timePassed'], 'required'],           
        ];
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['_id', 'name', 'city', 'street', 'category','subcategory','timePassed'];
    }

    

    
}