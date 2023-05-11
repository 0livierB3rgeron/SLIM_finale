create database pokemon;

drop table `pokemon`;

CREATE TABLE `pokemon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) DEFAULT NULL,
  `type` varchar(128) DEFAULT NULL,
  `abilite` varchar(255) default null,
  `stats_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8mb4;

create table `usager`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_usager` varchar(255) unique,
  `password` varchar(255),
  `cle_api` varchar(255) unique,
  primary key (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8mb4;


insert into pokemon (nom, type, abilite ,stats_total) values
('Bulbasaur', 'Grass/Poison', 'Chlorophyll', 318),
('Charmander', 'Fire', 'Solar Power', 309),
('Squirtle', 'Water', 'Rain Dish', 314),
('Pikachu', 'Electirc', 'Lightning Rod', 320),
('Gastly', 'Ghost/Poison', 'Levitate', 310),
('Octillery', 'Water', 'Moody', 480),
('Scyther', 'Bug/Flying', 'Technician', 500),
('Hariyama', 'Fighting', 'Sheer Force', 474),
('Swampert', 'Water/Ground', 'Damp', 535),
('Archeops', 'Rock/Flying', 'Defeatist', 567),
('Garchomp', 'Dragon/Ground', 'Rough Skin', 600),
('Torterra', 'Grass/Ground', 'Shell Armor', 525),
('Arceus', 'Normal', 'Multitype', 720);
