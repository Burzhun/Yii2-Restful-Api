<?php 
namespace app\models;

use yii\mongodb\ActiveRecord;


class User extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            
            [[ 'secondName'], 'safe'],
            [['firstName'], 'required'],           
        ];
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes()
    {
        return ['_id', 'firstName', 'secondName', 'slug '];
    }

    

    
}