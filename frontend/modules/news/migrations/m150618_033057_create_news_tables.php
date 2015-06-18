<?php

use yii\db\Schema;
use yii\db\Migration;

class m150618_033057_create_news_tables extends Migration
{
    public function up()
    {
		$this->createTable('themes', [
            'id'     => 'pk',
            'title'  => Schema::TYPE_STRING . ' NOT NULL'
        ]);
		$this->createTable('news', [
            'id'     => 'pk',
			'theme_id' =>  Schema::TYPE_INTEGER. ' DEFAULT NULL',
            'title'  => Schema::TYPE_STRING . ' NOT NULL',
            'text'   => Schema::TYPE_TEXT . ' NOT NULL',
            'date_create' => Schema::TYPE_DATETIME
        ]);
		$this->createIndex('FK_news', 'news', 'theme_id');
		$this->addForeignKey('FK_news', 'news', 'theme_id', 'themes', 'id');
		for($i=0;$i<6;$i++) $this->insert('themes',[ 'title' =>'Тема'.$i ]);
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
