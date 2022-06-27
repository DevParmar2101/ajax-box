<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "multiple_distance".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $uuid
 * @property string $created_at
 */
class MultipleDistance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'multiple_distance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'uuid'], 'required'],
            [['price'], 'number'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 125],
            [['uuid'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'uuid' => 'Uuid',
            'created_at' => 'Created At',
        ];
    }
}
