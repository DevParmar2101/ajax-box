<?php

namespace common\models;

use thamtech\uuid\helpers\UuidHelper;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_address".
 *
 * @property int $id
 * @property string $city
 * @property string $state
 * @property string $post_code
 * @property string $address
 * @property string $landmark
 * @property int $status
 * @property int $user_id
 * @property string $uuid
 */
class UserAddress extends   ActiveRecord
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'Inactive';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city', 'state', 'post_code', 'address', 'landmark', 'status','user_id'], 'required'],
            [['address'], 'string'],
            [['status'], 'integer'],
            [['city', 'state'], 'string', 'max' => 155],
            [['post_code'], 'string', 'max' => 11],
            [['landmark'], 'string', 'max' => 225],
            [['user_id'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => 'City',
            'state' => 'State',
            'post_code' => 'Post Code',
            'address' => 'Address',
            'landmark' => 'Landmark',
            'status' => 'Status',
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
    /**
     * @return array|mixed
     */
    public static function status()
    {
        $array = [
            self::ACTIVE => self::STATUS_ACTIVE,
            self::INACTIVE =>  self::STATUS_INACTIVE,
        ];
        return $array;
    }
}
