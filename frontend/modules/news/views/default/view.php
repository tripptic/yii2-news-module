<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Nav;
use yii\helpers\Url;
$this->registerCss(".news-menu li { float:none;}");
?>
<h1><?= $model->title ?></h1>
<div><?= Yii::$app->formatter->asDate($model->date_create, 'yyyy-MM-dd') . ' ' . $model->theme ?></div>
<div><?= $model->text . '<br/>'.  Html::a('Все новости', urldecode(Url::to(['index'])))?></div>