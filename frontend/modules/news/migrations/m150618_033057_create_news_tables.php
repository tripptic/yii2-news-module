<?php

use yii\db\Schema;
use yii\db\Migration;

class m150618_033057_create_news_tables extends Migration
{
    public function up()
    {
		$this->createTable('news', [
            'id'     => 'pk',
			'theme_id' =>  'int(11) DEFAULT NULL',
            'title'  => Schema::TYPE_STRING . ' NOT NULL',
            'text'   => Schema::TYPE_TEXT . ' NOT NULL',
            'date_create' => Schema::TYPE_DATETIME
        ]);
		$this->createTable('themes', [
            'id'     => 'pk',
            'title'  => Schema::TYPE_STRING . ' NOT NULL'
        ]);
		$this->addForeignKey('FK_news', 'news', 'themes_id', 'themes', 'id');
    }

    public function down()
    {
        $this->dropTable('news');
        $this->dropTable('themes');

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
