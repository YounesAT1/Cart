
DROP TABLE IF EXISTS `produit`;

CREATE TABLE `produit` (
  `idp` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  `prixu` decimal(10,2) DEFAULT NULL,
  `qtestock` int DEFAULT NULL,
  PRIMARY KEY (`idp`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


LOCK TABLES `produit` WRITE;

INSERT INTO `produit` VALUES (2,'Jeans',49.99,30),(3,'Sneakers',79.99,20),(5,'Watch',99.99,5),(6,'iPhone 12 Pro',1099.99,10),(7,'Samsung Galaxy S21',999.99,20),(8,'Sony PlayStation 5',499.99,5);

UNLOCK TABLES;
