<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_detail".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $age
 * @property string $mobile_number
 * @property int $user_id
 */
class UserDetail extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'age', 'mobile_number', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['age'], 'string', 'max' => 5],
            [['mobile_number'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'age' => 'Age',
            'mobile_number' => 'Mobile Number',
            'user_id' => 'User ID',
        ];
    }
}
