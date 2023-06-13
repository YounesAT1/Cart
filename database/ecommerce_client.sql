

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `idclt` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `psw` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idclt`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


LOCK TABLES `client` WRITE;
INSERT INTO `client` VALUES (2,'Younes','1st N11','casablanca','YounesAT','12345678');
UNLOCK TABLES;

