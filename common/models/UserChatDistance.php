<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_chat_distance".
 *
 * @property int $id
 * @property float $km_from
 * @property float $km_to
 * @property float $min_order_price
 * @property float $delivery_price
 * @property int $user_id
 *
 * @property UserChatDistance[] $chatDistance
 */
class UserChatDistance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_chat_distance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['km_from', 'km_to', 'min_order_price', 'delivery_price', 'user_id'], 'required'],
            [['km_from', 'km_to', 'min_order_price', 'delivery_price'], 'number'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'km_from' => 'Km From',
            'km_to' => 'Km To',
            'min_order_price' => 'Min Order Price',
            'delivery_price' => 'Delivery Price',
            'user_id' => 'User ID',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChatDistance(): \yii\db\ActiveQuery
    {
        return $this->hasMany(User::class,['id'=>'user_id']);
    }
}
