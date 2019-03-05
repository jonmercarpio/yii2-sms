<?php

use yii\db\Migration;

class m190305_201522_create_view_sms_view_conversation extends Migration
{
    public function up()
    {
        $this->execute("
                create view sms_view_conversation as
                select
                    `d`.`from` AS `from` ,
                    `d`.`to` AS `to` ,
                    `d`.`body` AS `body` ,
                    `d`.`created_at` AS `created_at` ,
                    `d`.`direction` AS `direction`
                from
                    (
                        select
                            `t`.`from` AS `from` ,
                            `t`.`to` AS `to` ,
                            `t`.`body` AS `body` ,
                            `t`.`created_at` AS `created_at` ,
                            `t`.`direction` AS `direction`
                        from
                            `sms_queue` `t`
                        union all
                            select
                                `t`.`To` AS `from` ,
                                `t`.`From` AS `to` ,
                                `t`.`Body` AS `body` ,
                                `t`.`created_at` AS `created_at` ,
                                'inbound-api' AS `direction`
                            from
                                `sms_reception` `t`
                    ) `d`
                order by
                    `d`.`created_at` ,
                    `d`.`to`
                "
        );

    }

    public function down()
    {
        $this->execute("drop view sms_view_conversation");
    }
}
