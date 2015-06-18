<?php

namespace frontend\modules\news\controllers;

use yii\data\Pagination;
use frontend\modules\news\models\News;
use frontend\modules\news\models\Themes;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;

class DefaultController extends Controller
{
    public function actionIndex($date = null, $year = null, $theme = null)
    {
		$where_clause = ($date ? ['DATE_FORMAT(date_create, "%Y-%m")' => $date] : ($year ? ['YEAR(date_create)' => $year] : ($theme ? ['themes.title' => $theme] : null)));
		$query = News::find()->select('news.id, news.title, date_create, text, themes.title as theme')
			->orderBy('date_create DESC')
			->leftJoin('themes', '`themes`.`id` = `news`.`theme_id`')		
			->where($where_clause);
		
		$pagination = new Pagination([
			'defaultPageSize' => 5,
			'totalCount' => $query->count(),
		]);
		
		$news = $query->offset($pagination->offset)
			->limit($pagination->limit)
			->all();
			
		$menu = News::find()->select('YEAR(`date_create`) as year, MONTH(`date_create`) as month, date_create, COUNT(*) as countf')
		->groupBy('year, month')
		->orderBy('year DESC, month')
		->all();
			
		$months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
		$menuItems = [];
		$current_year = null;
        foreach ($menu as $value) {
			if ($current_year != $value['year']) 
			{
				$current_year = $value['year'];
				$menuItems[] = ['label' => $current_year , 'url' => '/frontend/web/index.php?r=news/default/index&year='.$current_year];
			}
			$menuItems[] = ['label' => $months[$value['month']-1].' ('.$value->countf.')' , 'url' => '/frontend/web/index.php?r=news/default/index&date='.Yii::$app->formatter->asDate($value->date_create, 'yyyy-MM')];
		}		
		
		$theme_menu = News::find()->select('themes.title, COUNT(*) as countf')
		->leftJoin('themes', '`themes`.`id` = `news`.`theme_id`')
		->groupBy('themes.title')
		->all();
		
		foreach ($theme_menu as $value) 
            if ($value['title']) $menuItems[] = ['label' => $value['title'].' ('.$value->countf.')' , 'url' => '/frontend/web/index.php?r=news/default/index&theme='.$value['title']];

        return $this->render('index', [
			'news' => $news,
			'pagination' => $pagination,
			'menuItems' => $menuItems,
		]);
    }
	
	protected function findModel($id)
    {
        if (($model = News::find()->select('news.id, news.title, date_create, text, themes.title as theme')->where(['news.id' => $id])->leftJoin('themes', '`themes`.`id` = `news`.`theme_id`')->one()) !== null) {
            return $model;
        } else {
            throw new HttpException(404);
        }
    }
	
	public function actionView($id)
	{
		return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
	}

}
