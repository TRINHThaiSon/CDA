-- MySQL dump 10.19  Distrib 10.3.31-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Villa_Green
-- ------------------------------------------------------
-- Server version	10.3.31-MariaDB-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Categories`
--

DROP TABLE IF EXISTS `Categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categories` (
  `num_cat` varchar(15) NOT NULL,
  `nom_cat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`num_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categories`
--

LOCK TABLES `Categories` WRITE;
/*!40000 ALTER TABLE `Categories` DISABLE KEYS */;
INSERT INTO `Categories` VALUES ('C0001G','Guitars et Bass'),('C0002B','Batteries et Percussions'),('C0003P','Pianos et Claviers'),('C0004I','Instruments à vent'),('C0005A','Accessoires pour musiciens');
/*!40000 ALTER TABLE `Categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Clients`
--

DROP TABLE IF EXISTS `Clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Clients` (
  `num_cli` varchar(15) NOT NULL,
  `nom_cli` varchar(50) NOT NULL,
  `prenom_cli` varchar(50) NOT NULL,
  `adr_cli` varchar(150) NOT NULL,
  `cp_cli` int(5) NOT NULL,
  `ville_cli` varchar(50) DEFAULT NULL,
  `contact_cli` int(10) NOT NULL,
  `type_cli` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`num_cli`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Clients`
--

LOCK TABLES `Clients` WRITE;
/*!40000 ALTER TABLE `Clients` DISABLE KEYS */;
INSERT INTO `Clients` VALUES ('A00001','Painchaud','Marc','330 rue de Paris',80012,'Amiens',653363363,'PRO'),('A00002','Desseaux','Luc','15 boulevard de la République',33010,'Giroud',612056065,'PAR'),('A00012','Dupont','Matthieu','250 route de Riverain',48022,'River Plate',522233322,'PRO'),('A00015','Lemaire','Jean','16 route d\'Abbaye',72011,'Nanterre',622987123,'PAR'),('A00016','Lama','Catherine','57 rue de Cauchemar',60120,'Galaxie',672525987,'PAR'),('A00018','Vaillant','Frank','122 rue Lavache',52013,'Leciel',532436678,'PRO');
/*!40000 ALTER TABLE `Clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Commandes`
--

DROP TABLE IF EXISTS `Commandes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Commandes` (
  `num_com` int(11) NOT NULL,
  `num_cli` varchar(15) NOT NULL,
  `date_com` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `montant_com` decimal(9,2) NOT NULL,
  `adr_livr` varchar(150) NOT NULL,
  `cp_livr` int(5) NOT NULL,
  `ville_livr` varchar(50) NOT NULL,
  `adr_fact` varchar(150) NOT NULL,
  `cp_fact` int(5) NOT NULL,
  `ville_fact` varchar(50) NOT NULL,
  PRIMARY KEY (`num_com`),
  KEY `Commandes_Clients_FK` (`num_cli`),
  CONSTRAINT `Commandes_Clients_FK` FOREIGN KEY (`num_cli`) REFERENCES `Clients` (`num_cli`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Commandes`
--

LOCK TABLES `Commandes` WRITE;
/*!40000 ALTER TABLE `Commandes` DISABLE KEYS */;
INSERT INTO `Commandes` VALUES (210001,'A00001','2021-01-24 23:00:00',8049.80,'30 rue StGlinglin',80012,'Amiens','30 rue StGlinglin',80010,'Amiens'),(210002,'A00015','2021-02-14 23:00:00',657.80,'16 route d\'Abbaye',72011,'Nanterre','16 route d\'Abbaye',72011,'Nanterre'),(210003,'A00002','2021-03-09 23:00:00',4056.80,'15 boulevard de la République',33010,'Giroud','15 boulevard de la République',33010,'Giroud'),(210004,'A00012','2021-04-16 22:00:00',32323.50,'250 route de Riverain',48022,'River Plate','128 rue Fleuve',48022,'River Plate'),(210005,'A00016','2021-06-21 22:00:00',1213.19,'57 rue de Cauchemar',60120,'Galaxie','57 rue de Cauchemar',60120,'Galaxie'),(210006,'A00018','2021-07-10 22:00:00',25891.80,'122 rue Lavache',52013,'Leciel','122 rue Lavache',52013,'Leciel'),(210007,'A00015','2021-07-14 22:00:00',488.40,'16 route d\'Abbaye',72011,'Nanterre','16 route d\'Abbaye',72011,'Nanterre');
/*!40000 ALTER TABLE `Commandes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Facturation`
--

DROP TABLE IF EXISTS `Facturation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Facturation` (
  `num_fact` int(10) NOT NULL,
  `date_fact` date NOT NULL,
  `coef_deduit` decimal(3,2) DEFAULT NULL,
  `num_com` int(11) NOT NULL,
  PRIMARY KEY (`num_fact`),
  UNIQUE KEY `num_com` (`num_com`),
  CONSTRAINT `Facturation_commandes_FK` FOREIGN KEY (`num_com`) REFERENCES `Commandes` (`num_com`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Facturation`
--

LOCK TABLES `Facturation` WRITE;
/*!40000 ALTER TABLE `Facturation` DISABLE KEYS */;
INSERT INTO `Facturation` VALUES (1,'2021-02-10',0.15,210001),(2,'2021-02-28',0.00,210002),(3,'2021-03-30',0.00,210003),(4,'2021-05-01',0.15,210004),(5,'2021-07-10',0.00,210005),(6,'2021-07-30',0.15,210006),(7,'2021-08-05',0.00,210007);
/*!40000 ALTER TABLE `Facturation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Fournisseurs`
--

DROP TABLE IF EXISTS `Fournisseurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Fournisseurs` (
  `num_four` varchar(15) NOT NULL,
  `nom_four` varchar(50) NOT NULL,
  `prenom_four` varchar(50) NOT NULL,
  `adr_four` varchar(150) NOT NULL,
  `cp_four` varchar(5) NOT NULL,
  `ville_four` varchar(50) NOT NULL,
  `contact_four` int(10) NOT NULL,
  `type_four` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`num_four`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Fournisseurs`
--

LOCK TABLES `Fournisseurs` WRITE;
/*!40000 ALTER TABLE `Fournisseurs` DISABLE KEYS */;
INSERT INTO `Fournisseurs` VALUES ('F00001','Raban','Paco','130 rue de la Savane','75012','Argenteuille',633363921,'CON'),('F00002','Ozenfant','Carl','152 boulevard Exterieur','14010','Camon',615367752,'IMP'),('F00003','Aumarche','Andre','25 rue Vainglory','50022','Boca',625336522,'CON'),('F00004','Medicis','Jean','28 route d\'Abbeville','60011','Rosario',624965125,'IMP'),('F00005','Maux','Dantes','77 rue du Mal','40120','Laterre',652513657,'IMP'),('F00006','Dejardin','Frank','222 rue Lantern','32013','Lespace',534425567,'CON');
/*!40000 ALTER TABLE `Fournisseurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Fournit`
--

DROP TABLE IF EXISTS `Fournit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Fournit` (
  `num_four` varchar(15) NOT NULL,
  `num_article` varchar(10) NOT NULL,
  `prix_uni_four` decimal(7,2) NOT NULL,
  `taux_TVA_four` decimal(3,2) NOT NULL,
  `qte_four` int(11) NOT NULL,
  `date_four` date DEFAULT NULL,
  PRIMARY KEY (`num_four`,`num_article`),
  KEY `Fournisseur_Produit_FK2` (`num_article`),
  CONSTRAINT `Fournisseur_Produit_FK1` FOREIGN KEY (`num_four`) REFERENCES `Fournisseurs` (`num_four`),
  CONSTRAINT `Fournisseur_Produit_FK2` FOREIGN KEY (`num_article`) REFERENCES `Produits` (`num_article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Fournit`
--

LOCK TABLES `Fournit` WRITE;
/*!40000 ALTER TABLE `Fournit` DISABLE KEYS */;
INSERT INTO `Fournit` VALUES ('F00001','A100001',4.50,0.10,200,'2020-03-15'),('F00001','A100002',60.00,0.10,150,'2020-03-15'),('F00001','A200001',100.00,0.10,100,'2020-03-15'),('F00001','A200002',50.00,0.10,100,'2020-03-15'),('F00002','A300001',20.00,0.10,1500,'2020-04-20'),('F00002','A300002',300.00,0.10,350,'2020-04-20'),('F00002','P100001',2500.00,0.10,50,'2020-04-20'),('F00002','P100002',4000.00,0.10,25,'2020-04-20'),('F00002','P200001',1200.00,0.10,60,'2020-04-20'),('F00002','P200002',2200.00,0.10,50,'2020-04-20'),('F00002','P300001',450.00,0.10,75,'2020-04-20'),('F00002','P300002',400.00,0.10,75,'2020-04-20'),('F00003','B100001',80.00,0.10,80,'2020-05-17'),('F00003','B100002',70.00,0.10,50,'2020-05-17'),('F00003','B300001',6.00,0.10,100,'2020-05-17'),('F00003','B300002',30.00,0.10,100,'2020-05-17'),('F00003','G2C0001',50.00,0.10,100,'2020-05-17'),('F00003','G2C0002',350.00,0.10,25,'2020-05-17'),('F00004','B200001',350.00,0.10,50,'2020-04-07'),('F00004','B200002',70.00,0.10,40,'2020-04-07'),('F00004','G1E0001',120.00,0.10,25,'2020-04-07'),('F00004','G1E0002',400.00,0.10,50,'2020-04-07'),('F00004','G3A0001',450.00,0.10,50,'2020-04-07'),('F00004','G3A0002',40.00,0.10,80,'2020-04-07'),('F00005','I100001',120.00,0.10,100,'2020-06-06'),('F00005','I100002',300.00,0.10,60,'2020-06-06'),('F00005','I200001',3000.00,0.10,20,'2020-06-06'),('F00005','I200002',7500.00,0.10,5,'2020-06-06'),('F00006','I300001',80.00,0.10,100,'2020-06-20'),('F00006','I300002',120.00,0.10,100,'2020-06-20');
/*!40000 ALTER TABLE `Fournit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Livraisons`
--

DROP TABLE IF EXISTS `Livraisons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Livraisons` (
  `num_livr` int(10) NOT NULL,
  `date_livr` date DEFAULT NULL,
  `date_arr_prevue` date DEFAULT NULL,
  PRIMARY KEY (`num_livr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Livraisons`
--

LOCK TABLES `Livraisons` WRITE;
/*!40000 ALTER TABLE `Livraisons` DISABLE KEYS */;
INSERT INTO `Livraisons` VALUES (2001,'2021-02-06','2021-02-09'),(2002,'2021-02-22','2021-02-27'),(3005,'2021-03-20','2021-03-28'),(4005,'2021-04-25','2021-04-30'),(6005,'2021-06-29','2021-07-08'),(7002,'2021-07-20','2021-07-28'),(7003,'2021-07-25','2021-08-03');
/*!40000 ALTER TABLE `Livraisons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Produits`
--

DROP TABLE IF EXISTS `Produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Produits` (
  `num_article` varchar(10) NOT NULL,
  `num_sous_cat` varchar(25) NOT NULL,
  `libelle_courte_article` varchar(100) DEFAULT NULL,
  `libelle_longue_article` text DEFAULT NULL,
  `photo_article` varchar(100) DEFAULT NULL,
  `PU_article` decimal(7,2) NOT NULL,
  `nom_stk_article` int(11) DEFAULT NULL,
  PRIMARY KEY (`num_article`),
  KEY `Produits_Sous_categories_FK` (`num_sous_cat`),
  CONSTRAINT `Produits_Sous_categories_FK` FOREIGN KEY (`num_sous_cat`) REFERENCES `Sous_categories` (`num_sous_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Produits`
--

LOCK TABLES `Produits` WRITE;
/*!40000 ALTER TABLE `Produits` DISABLE KEYS */;
INSERT INTO `Produits` VALUES ('A100001','C0005A1','Support pour Guitares & Basses','','',7.90,120),('A100002','C0005A1','Pied d\'Enceinte','','',98.00,80),('A200001','C0005A2','Banc pour Clavier','','',148.00,60),('A200002','C0005A2','Banc pour Piano','','',98.00,60),('A300001','C0005A3','Carte Mémoire 64GB','','',38.00,1020),('A300002','C0005A3','Disque Dur Externe SSD 2TB','','',429.00,250),('B100001','C0002B1','Batterie Acoustique complète','','',148.00,20),('B100002','C0002B1','Caisse claire en bois','','',129.00,20),('B200001','C0002B2','Batterie Electronique complète','','',598.00,15),('B200002','C0002B2','Pad de caisse claire','','',129.00,13),('B300001','C0002B3','Suspension pour Tom','','',11.90,50),('B300002','C0002B3','Déclencheur de Timbre','','',58.00,35),('G1E0001','C0001G1','Guitare Hollowbody','','',248.00,10),('G1E0002','C0001G1','Guitare Custom','','',600.50,10),('G2C0001','C0001G2','Guitare classique 1/8','','',88.00,25),('G2C0002','C0001G2','Guitare flamenco','','',666.00,8),('G3A0001','C0001G3','Combo guitare à lampe','','',699.00,12),('G3A0002','C0001G3','Combo guitare à pile','','',68.00,30),('I100001','C0004I1','Saxophone Alto','','',248.00,60),('I100002','C0004I1','Saxophone Ténor','','',498.00,18),('I200001','C0004I2','Basson 1350P Children Model','','',4890.00,10),('I200002','C0004I2','Bassoon 1361 Orchester Plus','','',10330.00,2),('I300001','C0004I3','Trompette à Piston en Sib','','',149.00,55),('I300002','C0004I3','Trompette à Piston en Ut','','',222.00,60),('P100001','C0003P1','Yamaha 88 touches, 3 pédales','','',3590.00,22),('P100002','C0003P1','Yamaha B3 PE 88 touches','','',5490.00,17),('P200001','C0003P2','Clavia Nord Electro 6D 73','','',1789.00,50),('P200002','C0003P2','Hammond XK-5','','',3699.00,32),('P300001','C0003P3','Accordéon à bouton','','',695.00,52),('P300002','C0003P3','Accordéon à piano','','',588.00,37);
/*!40000 ALTER TABLE `Produits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SeComposeDe`
--

DROP TABLE IF EXISTS `SeComposeDe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SeComposeDe` (
  `num_article` varchar(10) NOT NULL,
  `num_com` int(11) NOT NULL,
  `num_livr` int(10) NOT NULL,
  `qte_article_com` int(11) DEFAULT NULL,
  `taux_TVA` decimal(3,2) NOT NULL,
  `type_paiement` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`num_article`,`num_com`,`num_livr`),
  KEY `num_com` (`num_com`),
  KEY `num_livr` (`num_livr`),
  CONSTRAINT `SeComposeDe_ibfk_1` FOREIGN KEY (`num_article`) REFERENCES `Produits` (`num_article`),
  CONSTRAINT `SeComposeDe_ibfk_2` FOREIGN KEY (`num_com`) REFERENCES `Commandes` (`num_com`),
  CONSTRAINT `SeComposeDe_ibfk_3` FOREIGN KEY (`num_livr`) REFERENCES `Livraisons` (`num_livr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SeComposeDe`
--

LOCK TABLES `SeComposeDe` WRITE;
/*!40000 ALTER TABLE `SeComposeDe` DISABLE KEYS */;
INSERT INTO `SeComposeDe` VALUES ('A100001',210001,2001,20,0.10,'après'),('A100001',210005,6005,1,0.10,'à la commande'),('A100002',210001,2001,20,0.10,'après'),('A100002',210007,7003,1,0.10,'à la commande'),('A200001',210006,7002,10,0.10,'après'),('A200002',210003,3005,1,0.10,'à la commande'),('A300001',210004,4005,100,0.10,'après'),('A300002',210004,4005,20,0.10,'après'),('A300002',210005,6005,1,0.10,'à la commande'),('B100001',210006,7002,10,0.10,'après'),('B100002',210006,7002,10,0.10,'après'),('B200001',210002,2002,1,0.10,'à la commande'),('B200002',210007,7003,2,0.10,'à la commande'),('B300001',210006,7002,20,0.10,'après'),('B300002',210006,7002,20,0.10,'après'),('G1E0001',210001,2001,5,0.10,'après'),('G2C0001',210007,7003,2,0.10,'à la commande'),('G2C0002',210005,6005,1,0.10,'à la commande'),('G3A0001',210004,4005,5,0.10,'après'),('G3A0002',210004,4005,10,0.10,'après'),('I300001',210001,2001,10,0.10,'après'),('I300002',210001,2001,10,0.10,'après'),('P100001',210003,3005,1,0.10,'à la commande'),('P200001',210006,7002,10,0.10,'après'),('P300001',210004,4005,10,0.10,'après'),('P300002',210004,4005,10,0.10,'après');
/*!40000 ALTER TABLE `SeComposeDe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sous_categories`
--

DROP TABLE IF EXISTS `Sous_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sous_categories` (
  `num_sous_cat` varchar(25) NOT NULL,
  `num_cat` varchar(15) NOT NULL,
  `nom_sous_cat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`num_sous_cat`),
  KEY `num_cat` (`num_cat`),
  CONSTRAINT `Sous_categories_ibfk_1` FOREIGN KEY (`num_cat`) REFERENCES `Categories` (`num_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sous_categories`
--

LOCK TABLES `Sous_categories` WRITE;
/*!40000 ALTER TABLE `Sous_categories` DISABLE KEYS */;
INSERT INTO `Sous_categories` VALUES ('C0001G1','C0001G','Guitares Electriques'),('C0001G2','C0001G','Guitares Classiques'),('C0001G3','C0001G','Amplificateurs Guitares Electriques'),('C0002B1','C0002B','Batteries Acoustiques'),('C0002B2','C0002B','Batteries Electroniques'),('C0002B3','C0002B','Pièces Detachées pour Batteries'),('C0003P1','C0003P','Pianos Droits'),('C0003P2','C0003P','Orgues Electroniques'),('C0003P3','C0003P','Accordéons'),('C0004I1','C0004I','Saxophones'),('C0004I2','C0004I','Bassons'),('C0004I3','C0004I','Trompettes'),('C0005A1','C0005A','Pieds et Supports'),('C0005A2','C0005A','Sièges, Banc et Tabourets'),('C0005A3','C0005A','Supports de Stockage');
/*!40000 ALTER TABLE `Sous_categories` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-02 13:42:55
