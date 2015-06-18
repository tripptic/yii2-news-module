# yii2-news-module

links:

/frontend/web/index.php?r=news/default/index

/backend/web/index.php?r=news/default/index

frontend  main.php:
'modules' => [
        'news' => [
            'class' => 'frontend\modules\news\News',
        ],
        
backend  main.php:
'modules' => [
        'news' => [
            'class' => 'backend\modules\news\News',
        ],
        
Migrations: frontend\modules\news\migrations
