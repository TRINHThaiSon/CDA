DROP DATABASE IF EXISTS Jarditou;
CREATE DATABASE Jarditou;
USE Jarditou;

CREATE TABLE Client(
    cli_num            INT,
    cli_nom            VARCHAR(50),
    cli_adresse        VARCHAR(50),
    cli_tel            VARCHAR(30),
    PRIMARY KEY (cli_num)
);

CREATE TABLE Produit(
    pro_num            INT,
    pro_libelle        VARCHAR(50),
    pro_description    VARCHAR(50),
    PRIMARY KEY (pro_num)
);

CREATE TABLE Commande(
    com_num            INT,
    cli_num            INT,
    com_date           DATETIME,
    com_obs            VARCHAR(50),
    PRIMARY KEY (com_num),
    CONSTRAINT Commande_Client_FK FOREIGN KEY (cli_num) REFERENCES Client(cli_num)
);

CREATE TABLE est_compose(
    com_num            INT,
    pro_num            INT,
    est_qte            INT,
    PRIMARY KEY (com_num, pro_num),
    CONSTRAINT est_compose_Produit_FK1 FOREIGN KEY (pro_num) REFERENCES Produit(pro_num),
    CONSTRAINT est_compose_Commande_FK2 FOREIGN KEY (com_num) REFERENCES Commande(com_num)

);

--************CREER UN INDEX SUR LE CHAMP cli_nom DE LA TABLE Client*****************************************************************

CREATE index cli_nom_index on Client(cli_nom);
show index from Client