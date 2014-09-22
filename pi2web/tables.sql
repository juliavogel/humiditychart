CREATE TABLE `sensor_data` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `sensor_id` VARCHAR(45) NOT NULL DEFAULT 0,
  `ts` TIMESTAMP NOT NULL DEFAULT 0,
  `temperature` VARCHAR(45) NOT NULL DEFAULT '',
  `humidity` VARCHAR(45) NOT NULL DEFAULT '',
  PRIMARY KEY(`id`)
)
ENGINE = InnoDB;

ALTER TABLE `sensor_data` ADD UNIQUE `unique_index`(`sensor_id`, `ts`);