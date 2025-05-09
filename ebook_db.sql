-- Nastavenie pre prácu s integritou dát
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- Vytvorenie schémy ebook_db
CREATE SCHEMA IF NOT EXISTS `ebook_db` DEFAULT CHARACTER SET utf8 ;
USE `ebook_db` ;

-- -----------------------------------------------------
-- Vytvorenie tabuľky `users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ebook_db`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `role` INT NOT NULL,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Vytvorenie tabuľky `reviews`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ebook_db`.`reviews` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `message` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Vytvorenie tabuľky `ebooks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ebook_db`.`ebooks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(50) NOT NULL,
  `author` VARCHAR(50) NOT NULL,
  `price` DECIMAL NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Vloženie dát do tabuľky `ebooks`
-- -----------------------------------------------------
INSERT INTO `ebooks` (id, title, author, price) VALUES
(1, 'Forth Wing', 'Rebecca Yarros', 18),
(2, 'Iron Flame', 'Rebecca Yarros', 20),
(3, 'The Midnight Library', 'Matt Haig', 15),
(4, 'It Ends With Us', 'Colleen Hoover', 14),
(5, 'The Seven Husbands of Evelyn Hugo', 'Taylor Jenkins Reid', 16),
(6, 'Verity', 'Colleen Hoover', 13),
(7, 'A Court of Thorns and Roses', 'Sarah J. Maas', 17),
(8, 'The Silent Patient', 'Alex Michaelides', 15),
(9, 'Where the Crawdads Sing', 'Delia Owens', 16),
(10, 'The House in the Cerulean Sea', 'TJ Klune', 18),
(11, 'Book Lovers', 'Emily Henry', 14);

-- -----------------------------------------------------
-- Vloženie dát do tabuľky `users`
-- -----------------------------------------------------
INSERT INTO `users` (id, name, email, password, role, created_at) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$D70SoY/KX7O0w2w/CJi97.JbqCJ1dwTP6F.w24sMBVFlrxSF8gSCC', 0, '2025-04-28 21:30:33'),
(2, 'user', 'user@example.com', '$2y$10$G2GzEDQtlA.32.FFiNyV1.uMgAxdD7jmm40jdNKFVrSSodTqLp2q2', 1, '2025-04-28 21:30:49');

-- -----------------------------------------------------
-- Vloženie dát do tabuľky `reviews`
-- -----------------------------------------------------
INSERT INTO `reviews` (name, email, message) VALUES
('Anna Martinez', 'anna.martinez23@gmail.com', 'A fantastic selection of both classic and new releases! I found rare titles I couldn’t get anywhere else. The eBook downloads were fast and hassle-free.'),
('David Chen', 'dchen87@yahoo.com', 'Great prices and a smooth checkout process. I’ve ordered both physical books and eBooks, and everything has been top-notch. Highly recommend this store!'),
('Leila Al-Farsi', 'leila.al.farsi@mail.com', 'I''m a frequent reader and this is now my go-to store. The personalized recommendations are spot on, and the loyalty rewards are a nice bonus.'),
('Tom Richardson', 'tom.richardson@outlook.com', 'The store has a solid collection, but I wish there were more indie authors featured. Still, the delivery was quick and customer service was helpful.'),
('Sofia Novak', 'sofia.novak@example.com', 'I love how easy it is to buy and download eBooks here. The format compatibility is great, and I’ve never had a file issue. Will definitely be back!');

-- Obnovenie pôvodných nastavení
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
