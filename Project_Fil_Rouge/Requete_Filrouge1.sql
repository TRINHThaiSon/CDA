--1.Chiffre d'affaires mois par mois pour une année sélectionnée (2021)

SELECT MONTH(date_com) AS 'Mois', SUM((qte_article_com*PU_article)*(1-coef_deduit)*(1+taux_TVA)) AS "Chiffre d'affaire par mois" FROM SeComposeDe s
JOIN Produits p ON s.num_article = p.num_article
JOIN Commandes c ON c.num_com = s.num_com
JOIN Facturation f ON f.num_com = c.num_com
WHERE YEAR(date_com) =2021
GROUP BY Mois

--2.Chiffre d'affaires d'année de 2020 généré pour un fournisseur

SELECT num_four, SUM((prix_uni_four*qte_four)*(1+taux_TVA_four)) AS "Chiffre d'affaire" FROM Fournit
WHERE YEAR(date_four)=2020
GROUP BY num_fou


--3.TOP 10 des produits les plus commandés pour une année sélectionnée (référence et nom du produit, quantité commandée, fournisseur)

SELECT libelle_courte_article AS 'nom de produit',nom_four, SUM(qte_article_com) AS 'nombre de produit commandé' FROM SeComposeDe s
JOIN Fournit ft ON ft.num_article = s.num_article
JOIN Produits p ON p.num_article = s.num_article
JOIN Fournisseurs fo ON fo.num_four = ft.num_four
GROUP BY libelle_courte_article
ORDER BY SUM(qte_article_com) DESC LIMIT 10

--4.TOP 10 des produits les plus rémunérateurs pour une année sélectionnée (référence et nom du produit, marge, fournisseur)

SELECT libelle_courte_article AS 'nom de produit',nom_four, SUM((qte_article_com*PU_article)*(1-coef_deduit)*(1+taux_TVA) - (prix_uni_four*qte_article_com)*(1+taux_TVA_four)) AS 'Somme rémunératrice' FROM SeComposeDe s
JOIN Fournit ft ON ft.num_article = s.num_article
JOIN Produits p ON p.num_article = s.num_article
JOIN Fournisseurs fo ON fo.num_four = ft.num_four
JOIN Facturation f ON f.num_com = s.num_com
GROUP BY libelle_courte_article
ORDER BY SUM((qte_article_com*PU_article)*(1-coef_deduit)*(1+taux_TVA) - (prix_uni_four*qte_article_com)*(1+taux_TVA_four)) DESC LIMIT 10

--5.Top 3 des clients en nombre de commandes ou chiffre d'affaires
 
 --(PAR NOMBRE DE COMMANDES)
SELECT nom_cli, COUNT(num_com) AS 'nombre de commandes' FROM Clients
JOIN Commandes ON Clients.num_cli= Commandes.num_cli
GROUP BY nom_cli
ORDER BY COUNT(num_com) DESC LIMIT 3

--(PAR CHIFFRE D'AFFAIRE)

SELECT nom_cli, ROUND(SUM((qte_article_com*PU_article)*(1-coef_deduit)*(1+taux_TVA)),3) AS "Chiffre d'affaire" FROM Clients
JOIN Commandes ON Clients.num_cli= Commandes.num_cli
JOIN SeComposeDe s ON s.num_com = Commandes.num_com
JOIN Produits p ON p.num_article = s.num_article
JOIN Facturation f ON f.num_com = s.num_com
GROUP BY nom_cli
ORDER BY round(SUM((qte_article_com*PU_article)*(1-coef_deduit)*(1+taux_TVA)),3) DESC LIMIT 3

--6.Répartition du chiffre d'affaires par type de client

SELECT type_cli, ROUND(SUM((qte_article_com*PU_article)*(1-coef_deduit)*(1+taux_TVA)),3) AS "Chiffre d'affaire" FROM Clients
JOIN Commandes ON Clients.num_cli= Commandes.num_cli
JOIN SeComposeDe s ON s.num_com = Commandes.num_com
JOIN Produits p ON p.num_article = s.num_article
JOIN Facturation f ON f.num_com = s.num_com
GROUP BY type_cli
ORDER BY round(SUM((qte_article_com*PU_article)*(1-coef_deduit)*(1+taux_TVA)),3) DESC 

--7.Nombre de commandes en cours de livraison.

SELECT num_com,Livraisons.num_livr,date_livr,date_arr_prevue FROM Livraisons
JOIN SeComposeDe ON Livraisons.num_livr = SeComposeDe.num_livr
GROUP BY num_com


--***************PROCÉDURE STOCKÉE*********************************************
--***********************PROCÉDURE STOCKÉE*********************************************
--********************************PROCÉDURE STOCKÉE********************************************* 

--1.Créez une procédure stockée qui sélectionne les commandes non soldées (en cours de livraison)

delimiter |
CREATE PROCEDURE commande_livr()
  BEGIN 
       SELECT num_com,Livraisons.num_livr,date_livr,date_arr_prevue FROM Livraisons
       JOIN SeComposeDe ON Livraisons.num_livr = SeComposeDe.num_livr
       GROUP BY num_com;
  END |
delimiter;


--2.Calculer le délai moyen entre la date de commande et la date de facturation.

delimiter |
CREATE PROCEDURE delai_com_fact()
  BEGIN 
       SELECT round(AVG(DATEDIFF(date_fact,date_com)),0) AS 'Délai moyen' FROM Commandes
       JOIN Facturation ON Facturation.num_com = Commandes.num_com;
  END |
delimiter;    




--***************CRÉER DES VUES*********************************************
--***********************CRÉER DES VUES*********************************************
--********************************CRÉER DES VUES*********************************************

--1.Créez une vue correspondant à la jointure Produits - Fournisseurs

CREATE VIEW v_produit_fournisseur
AS 
SELECT Produits.num_article, libelle_courte_article, Fournit.num_four, nom_four FROM Produits
JOIN Fournit ON Fournit.num_article = Produits.num_article
JOIN Fournisseurs ON Fournit.num_four = Fournisseurs.num_four   

--2.Créez une vue correspondant à la jointure Produits - Catégorie/Sous catégorie

CREATE VIEW v_produit_categories
AS 
SELECT num_article, libelle_courte_article, Produits.num_sous_cat, nom_sous_cat,sc.num_cat, nom_cat FROM Produits
JOIN Sous_categories sc ON sc.num_sous_cat=Produits.num_sous_cat
JOIN Categories cs ON cs.num_cat = sc.num_cat
      
       