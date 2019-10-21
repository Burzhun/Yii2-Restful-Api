<?php 
namespace app\models;

use yii\mongodb\ActiveRecord;


class Organisation extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'organisations';
    }

    public function rules()
    {
        return [
            
            [[ 'name', 'city', 'category','slug'], 'required'],          
        ];
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['_id', 'name', 'city', 'category','slug'];
    }

    

    
}