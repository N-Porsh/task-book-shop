CREATE DATABASE IF NOT EXISTS `task_db`;

CREATE TABLE IF NOT EXISTS `task_db`.`users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP ,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,

  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  INDEX (`username`, `email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `task_db`.`users_details` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `birth_date` date NOT NULL,
 `created_at` timestamp DEFAULT CURRENT_TIMESTAMP ,
 `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,

 PRIMARY KEY (`id`),
 UNIQUE KEY `id` (`id`),
 INDEX (`user_id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE IF NOT EXISTS `task_db`.`products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `description` TEXT COLLATE utf8_unicode_ci NOT NULL,
  `quantity` smallint NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP ,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,

  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  INDEX (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `task_db`.`transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP ,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,

  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `product_id` (`product_id`),
  INDEX (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



INSERT INTO `task_db`.`products` (`name`, `price`, `description`, `quantity`) VALUES
  ('Refactoring', 49.99, 'Programming. refactoring', 30),
  ('Patterns of Enterprise Application Architecture', 59.50, '', 20),
  ('Analysis Patterns', 25, 'Programming...', 25),
  ('Clean Code', 20.99, 'Programming. Basics', 30),
  ('Band of Four', 39.99, 'Patterns', 30);