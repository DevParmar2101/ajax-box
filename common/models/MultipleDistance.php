<?php

namespace common\models;

use thamtech\uuid\helpers\UuidHelper;
use Yii;
use yii\behaviors\AttributeBehavior;

/**
 * This is the model class for table "multiple_distance".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $uuid
 * @property string $created_at
 * @property int $user_id
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
            'user_id' => 'User ID'
        ];
    }
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviours = parent::behaviors();
        $behaviours['uuidBehavior'] = [
            'class' => AttributeBehavior::class,
            'attributes' => [
                self::EVENT_BEFORE_INSERT => 'uuid',
            ],
            'value' => static function () {
                return UuidHelper::uuid();
            },
        ];
        return $behaviours;
    }
}
