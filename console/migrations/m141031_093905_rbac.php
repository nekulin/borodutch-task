<?php

use yii\db\Schema;
use yii\db\Migration;

class m141031_093905_rbac extends Migration
{
    public function up()
    {
        try {
            $this->execute("
        create table `auth_rule`
(
`name` varchar(64) not null,
`data` text,
`created_at` integer,
`updated_at` integer,
    primary key (`name`)
) engine InnoDB;

create table `auth_item`
(
`name` varchar(64) not null,
`type` integer not null,
`description` text,
`rule_name` varchar(64),
`data` text,
`created_at` integer,
`updated_at` integer,
primary key (`name`),
foreign key (`rule_name`) references `auth_rule` (`name`) on delete set null on update cascade,
key `type` (`type`)
) engine InnoDB;

create table `auth_item_child`
(
`parent` varchar(64) not null,
`child` varchar(64) not null,
primary key (`parent`, `child`),
foreign key (`parent`) references `auth_item` (`name`) on delete cascade on update cascade,
foreign key (`child`) references `auth_item` (`name`) on delete cascade on update cascade
) engine InnoDB;

create table `auth_assignment`
(
`item_name` varchar(64) not null,
`user_id` varchar(64) not null,
`created_at` integer,
primary key (`item_name`, `user_id`),
foreign key (`item_name`) references `auth_item` (`name`) on delete cascade on update cascade
) engine InnoDB;
        ");
        } catch (\Exception $e) {}
    }

    public function down()
    {
        echo "m141031_093905_rbac cannot be reverted.\n";

        return false;
    }
}
