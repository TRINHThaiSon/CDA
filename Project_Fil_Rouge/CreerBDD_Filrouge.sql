DROP DATABASE IF EXISTS Villa_Green;
CREATE DATABASE Villa_Green;
USE Villa_Green;

CREATE TABLE Clients(
    num_cli                Varchar (15) NOT NULL,
    nom_cli                Varchar (50) NOT NULL,
    prenom_cli             Varchar (50) NOT NULL,
    adr_cli                Varchar (150) NOT NULL,
    cp_cli                 INT (5) NOT NULL,
    ville_cli              Varchar (50),
    contact_cli            INT (10) NOT NULL,
    type_cli               Varchar (3),
    PRIMARY KEY (num_cli)
);

INSERT INTO Clients (num_cli, nom_cli, prenom_cli, adr_cli, cp_cli, ville_cli, contact_cli, type_cli) VALUES
('A00001', 'Painchaud', 'Marc','330 rue de Paris', 80012, 'Amiens', 0653363363, 'PRO'),
('A00002', 'Desseaux', 'Luc', '15 boulevard de la République', 33010, 'Giroud', 0612056065, 'PAR'),
('A00012', 'Dupont', 'Matthieu', '250 route de Riverain', 48022, 'River Plate', 0522233322, 'PRO'),
('A00015', 'Lemaire', 'Jean', "16 route d'Abbaye", 72011, 'Nanterre', 0622987123, 'PAR'),
('A00016', 'Lama', 'Catherine', '57 rue de Cauchemar', 60120, 'Galaxie', 0672525987, 'PAR'),
('A00018', 'Vaillant', 'Frank', '122 rue Lavache', 52013, 'Leciel', 0532436678, 'PRO');

                    
CREATE TABLE Fournisseurs(
    num_four               Varchar (15) NOT NULL,
    nom_four               Varchar (50) NOT NULL,
    prenom_four            Varchar (50) NOT NULL,
    adr_four               Varchar (150) NOT NULL,
    cp_four                Varchar (5) NOT NULL,
    ville_four             Varchar (50) NOT NULL,
    contact_four           INT (10) NOT NULL,
    type_four              Varchar (3),
    PRIMARY KEY (num_four)
);

INSERT INTO Fournisseurs (num_four, nom_four, prenom_four, adr_four, cp_four, ville_four, contact_four, type_four) VALUES
('F00001', 'Raban', 'Paco','130 rue de la Savane', 75012, 'Argenteuille', 0633363921, 'CON'),
('F00002', 'Ozenfant', 'Carl', '152 boulevard Exterieur', 14010, 'Camon', 0615367752, 'IMP'),
('F00003', 'Aumarche', 'Andre', '25 rue Vainglory', 50022, 'Boca', 0625336522, 'CON'),
('F00004', 'Medicis', 'Jean', "28 route d'Abbeville", 60011, 'Rosario', 0624965125, 'IMP'),
('F00005', 'Maux', 'Dantes', '77 rue du Mal', 40120, 'Laterre', 0652513657, 'IMP'),
('F00006', 'Dejardin', 'Frank', '222 rue Lantern', 32013, 'Lespace', 0534425567, 'CON');


CREATE TABLE Commandes(
    num_com                INT NOT NULL,
    num_cli                Varchar (15) NOT NULL,
    date_com               timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    montant_com            decimal (9,2) NOT NULL,
    adr_livr               Varchar (150) NOT NULL,
    cp_livr                INT (5) NOT NULL,
    ville_livr             Varchar (50) NOT NULL,
    adr_fact               Varchar (150) NOT NULL,
    cp_fact                INT (5) NOT NULL,
    ville_fact             Varchar (50) NOT NULL,
    PRIMARY KEY (num_com),
    CONSTRAINT Commandes_Clients_FK FOREIGN KEY (num_cli) REFERENCES Clients(num_cli)
);

INSERT INTO Commandes (num_com, num_cli, date_com, montant_com, adr_livr, cp_livr, ville_livr, adr_fact, cp_fact, ville_fact) VALUES
(210001, 'A00001', '2021-01-25', 8049.8, '30 rue StGlinglin', 80012, 'Amiens','30 rue StGlinglin', 80010, 'Amiens'),
(210002, 'A00015', '2021-02-15', 657.8, "16 route d'Abbaye", 72011, 'Nanterre',"16 route d'Abbaye", 72011, 'Nanterre'),
(210003, 'A00002', '2021-03-10', 4056.8, '15 boulevard de la République', 33010, 'Giroud','15 boulevard de la République', 33010, 'Giroud'),
(210004, 'A00012', '2021-04-17', 32323.5, '250 route de Riverain', 48022, 'River Plate','128 rue Fleuve', 48022, 'River Plate'),
(210005, 'A00016', '2021-06-22', 1213.19, '57 rue de Cauchemar', 60120, 'Galaxie','57 rue de Cauchemar', 60120, 'Galaxie'),
(210006, 'A00018', '2021-07-11', 25891.8, '122 rue Lavache', 52013, 'Leciel','122 rue Lavache', 52013, 'Leciel'),
(210007, 'A00015', '2021-07-15', 488.4, "16 route d'Abbaye", 72011, 'Nanterre',"16 route d'Abbaye", 72011, 'Nanterre');


CREATE TABLE Livraisons(
    num_livr               INT (10) NOT NULL,
    date_livr              date,
    date_arr_prevue        date,
    PRIMARY KEY (num_livr)
);

INSERT INTO Livraisons (num_livr, date_livr, date_arr_prevue) VALUES
(02001, '2021-02-06', '2021-02-09'),
(02002, '2021-02-22', '2021-02-27'),
(03005, '2021-03-20', '2021-03-28'),
(04005, '2021-04-25', '2021-04-30'),
(06005, '2021-06-29', '2021-07-08'),
(07002, '2021-07-20', '2021-07-28'),
(07003, '2021-07-25', '2021-08-03');

CREATE TABLE Facturation(
    num_fact               INT (10) NOT NULL,
    date_fact              date NOT NULL,
    coef_deduit            decimal (3,2),
    num_com                INT NOT NULL,
    PRIMARY KEY (num_fact),
    unique (num_com),
    CONSTRAINT Facturation_commandes_FK FOREIGN KEY (num_com) REFERENCES Commandes(num_com)
);

INSERT INTO Facturation(num_fact, date_fact, coef_deduit, num_com) VALUES
(00001,'2021-02-10', 0.15, 210001),
(00002,'2021-02-28', 0, 210002),
(00003,'2021-03-30',0 , 210003),
(00004,'2021-05-01', 0.15, 210004),
(00005,'2021-07-10', 0, 210005),
(00006,'2021-07-30', 0.15, 210006),
(00007,'2021-08-05',0 , 210007);


CREATE TABLE Categories(
    num_cat                Varchar (15) NOT NULL,
    nom_cat                Varchar (100),
    PRIMARY KEY (num_cat)
);

INSERT INTO Categories (num_cat, nom_cat) VALUES
('C0001G', 'Guitars et Bass'),
('C0002B', 'Batteries et Percussions'),
('C0003P', 'Pianos et Claviers'),
('C0004I', 'Instruments à vent'),
('C0005A', 'Accessoires pour musiciens');


CREATE TABLE Sous_categories(
    num_sous_cat           Varchar (25) NOT NULL,
    num_cat                Varchar (15) NOT NULL,
    nom_sous_cat           Varchar (100),
    PRIMARY KEY (num_sous_cat),
    FOREIGN KEY (num_cat) REFERENCES Categories(num_cat)
);

INSERT INTO Sous_categories (num_sous_cat, num_cat, nom_sous_cat) VALUES
('C0001G1', 'C0001G', 'Guitares Electriques'),
('C0001G2', 'C0001G', 'Guitares Classiques'),
('C0001G3', 'C0001G', 'Amplificateurs Guitares Electriques'),
('C0002B1', 'C0002B', 'Batteries Acoustiques'),
('C0002B2', 'C0002B', 'Batteries Electroniques'),
('C0002B3', 'C0002B', 'Pièces Detachées pour Batteries'),
('C0003P1', 'C0003P', 'Pianos Droits'),
('C0003P2', 'C0003P', 'Orgues Electroniques'),
('C0003P3', 'C0003P', 'Accordéons'),
('C0004I1', 'C0004I', 'Saxophones'),
('C0004I2', 'C0004I', 'Bassons'),
('C0004I3', 'C0004I', 'Trompettes'),
('C0005A1', 'C0005A', 'Pieds et Supports'),
('C0005A2', 'C0005A', 'Sièges, Banc et Tabourets'),
('C0005A3', 'C0005A', 'Supports de Stockage');

CREATE TABLE Produits(
    num_article            Varchar (10) NOT NULL,
    num_sous_cat           Varchar (25) NOT NULL,
    libelle_courte_article Varchar (100),
    libelle_longue_article text,
    photo_article          Varchar(100),
    PU_article             decimal(7,2) NOT NULL,
    nom_stk_article        INT,
    PRIMARY KEY (num_article),
    CONSTRAINT Produits_Sous_categories_FK FOREIGN KEY (num_sous_cat) REFERENCES Sous_categories(num_sous_cat)
);

INSERT INTO Produits (num_article, num_sous_cat, libelle_courte_article, libelle_longue_article, photo_article, PU_article, nom_stk_article) VALUES
('G1E0001', 'C0001G1', 'Guitare Hollowbody', '','', 248, 10),
('G1E0002', 'C0001G1', 'Guitare Custom', '', '', 600.50, 10),
('G2C0001', 'C0001G2', 'Guitare classique 1/8', '', '', 88, 25),
('G2C0002', 'C0001G2', 'Guitare flamenco', '', '', 666, 08),
('G3A0001', 'C0001G3', 'Combo guitare à lampe', '', '', 699, 12),
('G3A0002', 'C0001G3', 'Combo guitare à pile', '', '', 68, 30),
('B100001', 'C0002B1', 'Batterie Acoustique complète', '', '', 148, 20),
('B100002', 'C0002B1', 'Caisse claire en bois', '', '', 129, 20),
('B200001', 'C0002B2', 'Batterie Electronique complète', '', '', 598, 15),
('B200002', 'C0002B2', 'Pad de caisse claire', '', '', 129, 13),
('B300001', 'C0002B3', 'Suspension pour Tom', '', '', 11.9, 50),
('B300002', 'C0002B3', 'Déclencheur de Timbre', '', '', 58, 35),
('P100001', 'C0003P1', 'Yamaha 88 touches, 3 pédales', '', '', 3590, 22),
('P100002', 'C0003P1', 'Yamaha B3 PE 88 touches', '', '', 5490, 17),
('P200001', 'C0003P2', 'Clavia Nord Electro 6D 73', '', '', 1789, 50),
('P200002', 'C0003P2', 'Hammond XK-5', '', '', 3699, 32),
('P300001', 'C0003P3', 'Accordéon à bouton', '', '', 695, 52),
('P300002', 'C0003P3', 'Accordéon à piano', '', '', 588, 37),
('I100001', 'C0004I1', 'Saxophone Alto', '', '', 248, 60),
('I100002', 'C0004I1', 'Saxophone Ténor', '', '', 498, 18),
('I200001', 'C0004I2', 'Basson 1350P Children Model', '', '', 4890, 10),
('I200002', 'C0004I2', 'Bassoon 1361 Orchester Plus', '', '', 10330, 02),
('I300001', 'C0004I3', 'Trompette à Piston en Sib', '', '', 149, 55),
('I300002', 'C0004I3', 'Trompette à Piston en Ut', '', '', 222, 60),
('A100001', 'C0005A1', 'Support pour Guitares & Basses', '', '', 7.9, 120),
('A100002', 'C0005A1', "Pied d'Enceinte", '', '', 98, 80),
('A200001', 'C0005A2', 'Banc pour Clavier', '', '', 148, 60),
('A200002', 'C0005A2', 'Banc pour Piano', '', '', 98, 60),
('A300001', 'C0005A3', 'Carte Mémoire 64GB', '', '', 38, 1020),
('A300002', 'C0005A3', 'Disque Dur Externe SSD 2TB', '', '', 429, 250);


CREATE TABLE Fournit(
    num_four               Varchar (15) NOT NULL,
    num_article            Varchar (10) NOT NULL,
    prix_uni_four          decimal (7,2) NOT NULL,
    taux_TVA_four          decimal (3,2) NOT NULL,
    qte_four               INT NOT NULL,
    date_four              date,
    PRIMARY KEY (num_four, num_article),
    CONSTRAINT Fournisseur_Produit_FK1 FOREIGN KEY (num_four) REFERENCES Fournisseurs(num_four),
    CONSTRAINT Fournisseur_Produit_FK2 FOREIGN KEY (num_article) REFERENCES Produits(num_article)
);

INSERT INTO Fournit (num_four, num_article, prix_uni_four, taux_TVA_four, qte_four, date_four) VALUES
('F00001', 'A100001', 4.5, 0.1, 200, '2020-03-15'),
('F00001', 'A100002', 60, 0.1, 150, '2020-03-15'),
('F00001', 'A200001', 100, 0.1, 100, '2020-03-15'),
('F00001', 'A200002', 50, 0.1, 100, '2020-03-15'),
('F00002', 'A300001', 20, 0.1, 1500, '2020-04-20'),
('F00002', 'A300002', 300, 0.1, 350, '2020-04-20'),
('F00002', 'P100001', 2500, 0.1, 50, '2020-04-20'),
('F00002', 'P100002', 4000, 0.1, 25, '2020-04-20'),
('F00002', 'P200001', 1200, 0.1, 60, '2020-04-20'),
('F00002', 'P200002', 2200, 0.1, 50, '2020-04-20'),
('F00002', 'P300001', 450, 0.1, 75, '2020-04-20'),
('F00002', 'P300002', 400, 0.1, 75, '2020-04-20'),
('F00003', 'B100001', 80, 0.1, 80, '2020-05-17'),
('F00003', 'B100002', 70, 0.1, 50, '2020-05-17'),
('F00003', 'B300001', 6, 0.1, 100, '2020-05-17'),
('F00003', 'B300002', 30, 0.1, 100, '2020-05-17'),
('F00003', 'G2C0001', 50, 0.1, 100, '2020-05-17'),
('F00003', 'G2C0002', 350, 0.1, 25, '2020-05-17'),
('F00004', 'B200001', 350, 0.1, 50, '2020-04-07'),
('F00004', 'B200002', 70, 0.1, 40, '2020-04-07'),
('F00004', 'G1E0001', 120, 0.1, 25, '2020-04-07'),
('F00004', 'G1E0002', 400, 0.1, 50, '2020-04-07'),
('F00004', 'G3A0001', 450, 0.1, 50, '2020-04-07'),
('F00004', 'G3A0002', 40, 0.1, 80, '2020-04-07'),
('F00005', 'I100001', 120, 0.1, 100, '2020-06-06'),
('F00005', 'I100002', 300, 0.1, 60, '2020-06-06'),
('F00005', 'I200001', 3000, 0.1, 20, '2020-06-06'),
('F00005', 'I200002', 7500, 0.1, 5, '2020-06-06'),
('F00006', 'I300001', 80, 0.1, 100, '2020-06-20'),
('F00006', 'I300002', 120, 0.1, 100, '2020-06-20');


CREATE TABLE SeComposeDe(
    num_article            Varchar (10) NOT NULL,
    num_com                INT NOT NULL,
    num_livr               INT (10) NOT NULL,
    qte_article_com        INT,
    taux_TVA               decimal(3,2) NOT NULL,
    type_paiement          Varchar(3),
    PRIMARY KEY (num_article, num_com, num_livr),
    FOREIGN KEY (num_article) REFERENCES Produits(num_article),
    FOREIGN KEY (num_com) REFERENCES Commandes(num_com),
    FOREIGN KEY (num_livr) REFERENCES Livraisons(num_livr)

);

INSERT INTO SeComposeDe (num_article, num_com, num_livr, qte_article_com, taux_TVA, type_paiement) VALUES
('G1E0001', 210001, 02001, 05, 0.1, 'après'),
('A100002', 210001, 02001, 20, 0.1, 'après'),
('A100001', 210001, 02001, 20, 0.1, 'après'),
('I300001', 210001, 02001, 10, 0.1, 'après'),
('I300002', 210001, 02001, 10, 0.1, 'après'),
('B200001', 210002, 02002, 01, 0.1, 'à la commande'),
('P100001', 210003, 03005, 01, 0.1, 'à la commande'),
('A200002', 210003, 03005, 01, 0.1, 'à la commande'),
('P300001', 210004, 04005, 10, 0.1, 'après'),
('P300002', 210004, 04005, 10, 0.1, 'après'),
('G3A0001', 210004, 04005, 05, 0.1, 'après'),
('G3A0002', 210004, 04005, 10, 0.1, 'après'),
('A300002', 210004, 04005, 20, 0.1, 'après'),
('A300001', 210004, 04005, 100, 0.1, 'après'),
('G2C0002', 210005, 06005, 01, 0.1, 'à la commande'),
('A100001', 210005, 06005, 01, 0.1, 'à la commande'),
('A300002', 210005, 06005, 01, 0.1, 'à la commande'),
('B100001', 210006, 07002, 10, 0.1, 'après'),
('B100002', 210006, 07002, 10, 0.1, 'après'),
('B300001', 210006, 07002, 20, 0.1, 'après'),
('B300002', 210006, 07002, 20, 0.1, 'après'),
('P200001', 210006, 07002, 10, 0.1, 'après'),
('A200001', 210006, 07002, 10, 0.1, 'après'),
('B200002', 210007, 07003, 02, 0.1, 'à la commande'),
('A100002', 210007, 07003, 01, 0.1, 'à la commande'),
('G2C0001', 210007, 07003, 02, 0.1, 'à la commande');

-- *******************pour sauvegarder la database Villa_Green**********************************************
$ mysqldump -u admin2 -p Villa_Green > back_Villa_Green.sql