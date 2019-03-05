<?php

use yii\db\Migration;

class m190305_200554_update_table_sms_list extends Migration
{
    public function up()
    {
        $this->createTable('{{%sms_list}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'created_by' => $this->integer(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%sms_list}}');
    }
}
