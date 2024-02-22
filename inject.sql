CREATE DATABASE LoginSystem;
USE LoginSystem;

CREATE TABLE IF NOT EXISTS `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(50) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(50) NOT NULL,
 `create_datetime` datetime NOT NULL,
 PRIMARY KEY (`id`)
);

ALTER TABLE `users`
ADD COLUMN `gender` ENUM('Male', 'Female', 'Other') NULL,
ADD COLUMN `age` INT NULL,
ADD COLUMN `units` ENUM('Imperial', 'Metric') NULL,
ADD COLUMN `height_ft` INT NULL,
ADD COLUMN `height_in` DECIMAL(4,1) NULL,
ADD COLUMN `weight_kg` DECIMAL(6,1) NULL,
ADD COLUMN `activity_level` ENUM('Sedentary', 'Lightly Active', 'Moderately Active', 'Very Active', 'Super Active') NULL,
ADD COLUMN `weight_goal` ENUM('Lose fat', 'Build muscle', 'Maintain weight') NULL,
ADD COLUMN `weekly_variety` INT NULL,
ADD COLUMN `max_recipe_complexity` INT NULL,
ADD COLUMN `daily_meals` SET('breakfast', 'lunch', 'dinner', 'snack') NULL,
ADD COLUMN `diet_type` VARCHAR(255) NULL,
ADD COLUMN `budget` DECIMAL(10,2) NULL;

