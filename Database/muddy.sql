-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.4.0-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for muddy
CREATE DATABASE IF NOT EXISTS `muddy` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `muddy`;

-- Dumping structure for table muddy.being
CREATE TABLE IF NOT EXISTS `being` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table muddy.being: ~2 rows (approximately)
REPLACE INTO `being` (`id`, `name`, `description`) VALUES
	(1, 'dex', 'dex is more into doing than thinking. With his trusty warhammer he is fast to make his point'),
	(2, 'cute rabbit', 'this rabbit is so cute, you would not hit it even if it was eating your foot, aaaaaawwwwwwhhhhh');

-- Dumping structure for table muddy.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_description` varchar(255) DEFAULT NULL,
  `event_location` int(11) DEFAULT NULL,
  `event_destination` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_location` (`event_location`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`event_location`) REFERENCES `muddy.room` (`node`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table muddy.events: ~0 rows (approximately)

-- Dumping structure for table muddy.room
CREATE TABLE IF NOT EXISTS `room` (
  `node` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table muddy.room: ~9 rows (approximately)
REPLACE INTO `room` (`node`, `location`, `description`) VALUES
	(1, 'Meadow', 'A peaceful looking meadow, with lots of flowers'),
	(2, 'Enchanted Forest', 'An enchanted forest, where ancient trees whisper secrets and mystical creatures roam beneath the dappled light of the canopy.'),
	(3, 'Riverside', 'A tranquil riverside, where the gentle flow of water kisses the shore beneath the embrace of lush greenery.'),
	(4, 'Bridge', 'A sturdy bridge spans gracefully over the tranquil river, offering passage across the water.'),
	(5, 'Abandoned camp', 'A campsite across the bridge. The embers still softly glow and feel warm to the touch.'),
	(9, 'Riverside south', 'The south side of the riverside.'),
	(10, 'Heart of the forest', 'At the heart of the forest lies a sacred glade,  further up north an ancient oak stands tall. Behind this oak a portal swirls endlessly'),
	(11, 'Portal', 'A blueish portal swirls with an ethereal energy. Beyond it you can see flashes of a strange and far away land.'),
	(12, 'Through portal', 'Your vision fades away and you slip in and out of consciousness. The DVD logo in your head hits the corner correctly and suddenly you see: TO BE CONTINUED!');

-- Dumping structure for table muddy.room_directions
CREATE TABLE IF NOT EXISTS `room_directions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current_room` int(11) DEFAULT NULL,
  `direction` varchar(10) DEFAULT NULL,
  `destination` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `current_room` (`current_room`),
  CONSTRAINT `room_directions_ibfk_1` FOREIGN KEY (`current_room`) REFERENCES `room` (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table muddy.room_directions: ~7 rows (approximately)
REPLACE INTO `room_directions` (`id`, `current_room`, `direction`, `destination`) VALUES
	(4, 1, 'south', 3),
	(5, 3, 'west', 4),
	(6, 4, 'south', 5),
	(7, 5, 'east', 9),
	(8, 2, 'north', 10),
	(9, 10, 'north', 11),
	(10, 11, 'north', 12);

-- Dumping structure for table muddy.user
CREATE TABLE IF NOT EXISTS `user` (
  `name` varchar(20) NOT NULL,
  `puppet` int(10) unsigned DEFAULT NULL,
  `current_room` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `puppet` (`puppet`),
  KEY `current_room` (`current_room`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`puppet`) REFERENCES `being` (`id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`current_room`) REFERENCES `room` (`node`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table muddy.user: ~2 rows (approximately)
REPLACE INTO `user` (`name`, `puppet`, `current_room`) VALUES
	('student', 2, NULL),
	('teacher', 1, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
