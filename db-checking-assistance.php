<?php
require_once(ABSPATH ."wp-admin/includes/upgrade.php");
function DB_checking_asistance_create(){
  global $wpdb;
  $DB_subscriptions_plan_tb_name="chap_subscriptions_plan";
  $DB_subscribers_tb_name="chap_subscribers";
  $DB_checking_assistance_tb_name="chap_checking_assistance";

  $charset_collate = $wpdb->get_charset_collate();
  $sql = "CREATE TABLE IF NOT EXISTS $DB_subscriptions_plan_tb_name (
            `id_plan` INT(10)  AUTO_INCREMENT,
            `name_plan` VARCHAR(45) NULL,
            PRIMARY KEY (`id_plan`)
          )$charset_collate;";
  dbDelta($sql);

  $sql = "CREATE TABLE IF NOT EXISTS $DB_subscribers_tb_name (
    `id_subs` INT(10) AUTO_INCREMENT,
        `identification` INT  NOT NULL ,
        `first_name` VARCHAR(45) NOT NULL,
        `last_name` VARCHAR(45) NOT NULL,
        `email` VARCHAR(45) NOT NULL,
        `ins_date` DATE NOT NULL,
        `end_date` DATE NOT NULL,
        `id_subscription_plan` INT(10) ,
        PRIMARY KEY (`id_subs`),
        UNIQUE INDEX `identification_UNIQUE` (`identification`),
        INDEX `fk_subscribers_subscriptions_plan_idx` (`id_subscription_plan`),
        FOREIGN KEY (`id_subscription_plan`)
        REFERENCES $DB_subscriptions_plan_tb_name(`id_plan`) ON UPDATE CASCADE ON DELETE CASCADE
              )$charset_collate;"; 
  dbDelta($sql);

  $sql = "CREATE TABLE IF NOT EXISTS $DB_checking_assistance_tb_name (
    `id` INT(10) AUTO_INCREMENT,
    `estado_id` INT(10) NOT NULL, 
    `estado` VARCHAR(45)  NOT NULL,
    `assistance_date` DATE NOT NULL,
    `assistance_time` VARCHAR(45) NOT NULL,
    `id_subscriber` INT(10) NOT NULL,
        PRIMARY KEY (`id`),
        INDEX `fk_cheking_assistance_subscribers_idx` (`id_subscriber`),
        FOREIGN KEY (`id_subscriber`)
        REFERENCES $DB_subscribers_tb_name(`id_subs`) ON UPDATE CASCADE ON DELETE CASCADE      
          )$charset_collate;"; 
  dbDelta($sql);
}