<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Nav;
use yii\helpers\Url;
$this->registerCss(".news-menu li{ float:none;};");
$this->registerCss(".news-content{margin-left:150px;}");
?>
<h1>Новости</h1>
<?= Nav::widget(
	[
		'options' => ['class' => ' navbar-nav navbar-left news-menu'],
		'items' => $menuItems
	]
)?>

<div class='news-content'>
<?php foreach ($news as $news_item): ?>
    <div>
        <h4><?= $news_item->title ?></h4>
		<div><?= Yii::$app->formatter->asDate($news_item->date_create, 'yyyy-MM-dd') . ' ' . $news_item->theme ?></div>
		<div><?= \yii\helpers\StringHelper::truncate($news_item->text, 256) . '<br/>'. Html::a('Читать далее', urldecode(Url::toRoute(['default/view', 'id' => $news_item->id])))?></div>
    </div>
<?php endforeach; ?>
</div>

<?= LinkPager::widget(['pagination' => $pagination]) ?>