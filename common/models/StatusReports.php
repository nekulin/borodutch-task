<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "status_reports".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property integer $created_at
 *
 * @property User $user
 */
class StatusReports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_reports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'title' => 'Статус',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @param User $objUser
     * @return StatusReports[]
     */
    public static function findAllByUser(User $objUser)
    {
        return self::find()->where([
            'user_id' => $objUser->id,
        ])->orderBy('id desc')->all();
    }

    public static function findOneLast()
    {
        /** @var StatusReports $objReport */
        $objReport = self::find()->orderBy('id desc')->one();
        if ($objReport) {
            return $objReport;
        }
        return null;
    }

    /**
     * @return StatusReports[]
     */
    public static function findAllSortId()
    {
        return self::find()->orderBy('id desc')->all();
    }
}
