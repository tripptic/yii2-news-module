<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\Nav;
use yii\helpers\Url;
$this->registerCss(".news-menu li { float:none;}");
?>
<h1>Новости</h1>
<?= Nav::widget(
	[
		'options' => ['class' => ' navbar-nav  navbar-collapse news-menu'],
		'items' => $menuItems
	]
)?>

<ul>
<?php foreach ($news as $news_item): ?>
    <li>
        <?= $news_item->title . '<br />' . Yii::$app->formatter->asDate($news_item->date_create, 'yyyy-MM-dd') . ' ' . $news_item->theme .'<br/>'. \yii\helpers\StringHelper::truncate($news_item->text, 256) . '<br/>'. Html::a('Читать далее', urldecode(Url::toRoute(['default/view', 'id' => $news_item->id])))?>
    </li>
<?php endforeach; ?>
</ul>
</div>

<?= LinkPager::widget(['pagination' => $pagination]) ?>