<?php

namespace backend\modules\news\models;
use yii\helpers\ArrayHelper;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property integer $theme_id
 * @property string $title
 * @property string $text
 * @property string $date_create
 *
 * @property Themes $theme
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['theme_id'], 'integer'],
            [['title'], 'required'],
            [['text'], 'string'],
            [['date_create'], 'safe'],
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
            'theme_id' => 'Тема',
            'title' => 'Название',
            'text' => 'Текст',
            'date_create' => 'Дата публикации',
        ];
    }
	
	public function getThemesList() { 
        $models = Themes::find()->asArray()->all();
        return ArrayHelper::map($models, 'id', 'title');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTheme()
    {
        return $this->hasOne(Themes::className(), ['id' => 'theme_id']);
    }
	
	public function relations()
    {
       return [
           'theme_id' => array(self::BELONGS_TO, 'Themes', 'themes'),
       ];
    }
}
