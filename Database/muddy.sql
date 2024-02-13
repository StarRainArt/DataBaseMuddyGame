DROP DATABASE IF EXISTS muddy;
CREATE DATABASE muddy;

-- everything that can walk or talk
-- heroes and monsters
CREATE TABLE muddy.being (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(255),
	description VARCHAR(255),

	PRIMARY KEY (id)
);


-- users are... you
-- as a user you can play any being you like
CREATE TABLE muddy.user (
	name VARCHAR(20),
	puppet INT UNSIGNED UNIQUE,

	PRIMARY KEY (name),
	FOREIGN KEY (puppet) REFERENCES muddy.being(id)
);

INSERT INTO muddy.being (name, description) VALUES
	('dex', 'dex is more into doing than thinking. With his trusty warhammer he is fast to make his point'),
	('cute rabbit', 'this rabbit is so cute, you would not hit it even if it was eating your foot, aaaaaawwwwwwhhhhh');

INSERT INTO muddy.user (name, puppet) VALUES
    ('teacher', 1),
	('student', 2);

CREATE TABLE muddy.room (
	node INT NOT NULL AUTO_INCREMENT,
	location VARCHAR(50),
	description VARCHAR(200),

	PRIMARY KEY (node)
);

CREATE TABLE muddy.room_directions (
	id INT NOT NULL AUTO_INCREMENT,
	current_room INT,
	direction VARCHAR(10),
	destination VARCHAR(50)

	PRIMARY KEY (id),
	FOREIGN KEY (current_room) REFERENCES muddy.room(node)
)