<?php

namespace backend\modules\news\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "themes".
 *
 * @property integer $id
 * @property string $title
 *
 * @property News[] $news
 */
class Themes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'themes';
    }
	
	public static function getThemesList() { 
        $models = Themes::find()->asArray()->all();
        return ArrayHelper::map($models, 'id', 'title');
    }
	
	    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['theme_id' => 'id']);
    }
}
