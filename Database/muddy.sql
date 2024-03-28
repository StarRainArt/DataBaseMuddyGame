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

-- Dumping structure for table muddy.creatures
CREATE TABLE IF NOT EXISTS `creatures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `dialogue` varchar(1000) DEFAULT NULL,
  `room` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room` (`room`),
  CONSTRAINT `creatures_ibfk_1` FOREIGN KEY (`room`) REFERENCES `room` (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table muddy.creatures: ~3 rows (approximately)
REPLACE INTO `creatures` (`id`, `name`, `description`, `dialogue`, `room`) VALUES
	(1, 'Mysterious Crow', 'A rather large crow that sits lazily atop a branch nearby and caws at the top of its lungs.', 'Bad acid trip, huh? Damn. Been there. Done that. Anyway. Uhhhhh. You\'re in quest land? A land where you can explore to your hearts desire, until your acid trip wears off. Everything is kind of abandoned. Don\'t know why. Maybe your own psyche? It is your trip after all. Good luck buddy. Byeee. Leave. Go. Come on now. Skeddaddle.', 1),
	(2, 'Lil slug', 'A lil slug sitting on a rug on a mug. He is smoking a lil pipe. It is absolutely adorable... Also a little bit weird', 'Sup lil buddy. You lost, lil man? Cool, cool. Me too. I gotta say uhhh, careful of that river, lil bromie. It looks kinda dangerous. Like swept away dangerous. Maybe best to not step in there. But don\'t let me tell you what to do, lil dude.', 3),
	(3, 'Boblin the goblin', 'A rather smug looking goblin that does a constant little dance. He seems to be taunting you rather unsuccessfully.', 'I see you\'ve made it this far! Your trip is almost over. But not before you answer these riddle three... I uhh didn\'t really think of any. But just know they\'d be way too difficult for you. Now get out of here.', 2);

-- Dumping structure for table muddy.room
CREATE TABLE IF NOT EXISTS `room` (
  `node` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table muddy.room: ~10 rows (approximately)
REPLACE INTO `room` (`node`, `location`, `description`) VALUES
	(1, 'in a meadow', 'It is a peaceful looking meadow, with lots of flowers'),
	(2, 'in an enchanted Forest', 'It\'s an old enchanted forest, where ancient trees whisper secrets and mystical creatures roam beneath the dappled light of the canopy'),
	(3, 'at a northern riverside bank', 'It is a tranquil riverside, where the gentle flow of water kisses the shore beneath the embrace of lush greenery'),
	(4, 'at a bridge', 'It\'s a sturdy bridge spanning gracefully over the tranquil river, offering passage across the water'),
	(5, 'in an abandoned camp', 'It is an abandoned campsite just across the bridge. The embers still softly glow and feel warm to the touch. You can see erratic footprints, almost as if someone was dancing around the fire'),
	(9, 'at a southern riverside bank', 'It is a tranquil riverside, where the gentle flow of water kisses the shore beneath the embrace of lush greenery'),
	(10, 'in the Heart of the Forest', 'At the heart of the forest lies a sacred glade,  further up north an ancient oak stands tall. Behind this oak a portal swirls endlessly'),
	(11, 'in front of a portal', 'It is a blueish portal swirling with an ethereal energy. Beyond it you can see flashes of a strange and far away land'),
	(12, 'stepping through the portal', 'Your vision fades away and you slip in and out of consciousness. The DVD logo in your head hits the corner correctly and suddenly you see: TO BE CONTINUED!'),
	(13, 'being swept away', 'Oh no! The river current is too strong, you are swept away by the roaring current! Your only option is to go with the flow eastwards. The enchanted forest awaits');

-- Dumping structure for table muddy.room_directions
CREATE TABLE IF NOT EXISTS `room_directions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current_room` int(11) DEFAULT NULL,
  `direction` varchar(10) DEFAULT NULL,
  `destination` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `current_room` (`current_room`),
  CONSTRAINT `room_directions_ibfk_1` FOREIGN KEY (`current_room`) REFERENCES `room` (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table muddy.room_directions: ~17 rows (approximately)
REPLACE INTO `room_directions` (`id`, `current_room`, `direction`, `destination`) VALUES
	(4, 1, 'south', 3),
	(5, 3, 'west', 4),
	(6, 4, 'south', 5),
	(7, 5, 'east', 9),
	(8, 2, 'north', 10),
	(9, 10, 'north', 11),
	(10, 11, 'north', 12),
	(11, 3, 'north', 1),
	(12, 4, 'east', 3),
	(13, 5, 'north', 4),
	(14, 9, 'west', 5),
	(15, 10, 'south', 2),
	(16, 11, 'south', 10),
	(17, 12, 'south', 11),
	(18, 3, 'south', 13),
	(19, 9, 'north', 13),
	(20, 13, 'east', 2);

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
	('teacher', 1, 12);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
