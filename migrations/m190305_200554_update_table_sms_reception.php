<?php

use yii\db\Migration;

class m190305_200554_update_table_sms_reception extends Migration
{
    public function up()
    {
        $this->createTable('{{%sms_reception}}', [
            'id' => $this->primaryKey(),
            'ToCountry' => $this->string(),
            'ToState' => $this->string(),
            'SmsMessageSid' => $this->string(),
            'NumMedia' => $this->string(),
            'ToCity' => $this->string(),
            'FromZip' => $this->string(),
            'SmsSid' => $this->string(),
            'FromState' => $this->string(),
            'SmsStatus' => $this->string(),
            'FromCity' => $this->string(),
            'Body' => $this->string(),
            'FromCountry' => $this->string(),
            'To' => $this->string(),
            'ToZip' => $this->string(),
            'NumSegments' => $this->string(),
            'MessageSid' => $this->string(),
            'AccountSid' => $this->string(),
            'From' => $this->string(),
            'ApiVersion' => $this->string(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%sms_reception}}');
    }
}
