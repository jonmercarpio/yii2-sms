<?php

use yii\db\Migration;

class m190305_200554_update_table_sms_queue extends Migration
{
    public function up()
    {
        $this->createTable('{{%sms_queue}}', [
            'id' => $this->primaryKey(),
            'list_id' => $this->integer(),
            'to' => $this->string()->notNull(),
            'from' => $this->string()->notNull(),
            'body' => $this->string()->notNull(),
            'error_code' => $this->string(),
            'error_message' => $this->string(),
            'date_sent_utc' => $this->dateTime(),
            'sid' => $this->string(),
            'direction' => $this->string(),
            'account_sid' => $this->string(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'created_by' => $this->integer(),
        ]);

        $this->createIndex('list_id', '{{%sms_queue}}', 'list_id');
        $this->addForeignKey('sms_queue_ibfk_1', '{{%sms_queue}}', 'list_id', '{{%sms_list}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%sms_queue}}');
    }
}
