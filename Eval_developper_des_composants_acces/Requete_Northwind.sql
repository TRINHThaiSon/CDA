-- 1.Liste de contacts français

SELECT CompanyName AS Société, ContactName AS Contact, ContactTitle AS Fonction, Phone AS Téléphone FROM customers
WHERE country = 'France'

-- ****************************************2.PRODUITS VENDUS PAR LE FOURNISSEUR "EXOTIC LIQUIDS"*************************************************************************************************
SELECT ProductName AS Produit, UnitPrice AS Prix FROM products
JOIN suppliers ON suppliers.SupplierID = products.SupplierID
WHERE CompanyName = 'Exotic Liquids'

-- ****************************************3.NOMBRE DE PRODUITS VENDUS PAR LES FOURNISSEURS FRANCAIS DANS L'ORDRE DECROISSANT*********************************************************************
SELECT CompanyName AS 'Fournisseur', COUNT(ProductName) AS 'Nbre produit' FROM products
JOIN suppliers ON products.SupplierID = suppliers.SupplierID
WHERE Country = 'France'
GROUP BY CompanyName
ORDER BY COUNT(ProductName) desc

-- ****************************************4.LISTE DES CLIENTS FRANCAIS AYANT PLUS DE 10 COMMANDES************************************************************************************************
SELECT customers.CompanyName AS 'Client', COUNT(OrderID) AS 'Nbre commandes' FROM customers
JOIN orders ON customers.CustomerID = orders.CustomerID
WHERE Country = 'France'
GROUP BY CompanyName
HAVING COUNT(OrderID) >10

-- ****************************************5.LISTE DES CLIENTS  AYANT UN CHIFFRE D'AFFAIRES > 30000************************************************************************************************

SELECT CompanyName AS 'Clients', SUM(UnitPrice*Quantity) AS 'CA', Country AS 'Pays' FROM customers
JOIN orders ON customers.CustomerID = orders.CustomerID
JOIN `order details` ON `order details`.OrderID = orders.OrderID
GROUP BY customers.CustomerID
HAVING SUM(UnitPrice*Quantity) > 30000
ORDER BY SUM(UnitPrice*Quantity) desc

-- ****************************************6 – Liste des pays dont les clients ont passé commande de produits fournis par "Exotic Liquids"**********************************************************

SELECT DISTINCT (customers.Country) AS 'Pays' FROM customers
JOIN orders ON customers.CustomerID = orders.CustomerID
JOIN `order details` ON `order details`.OrderID = orders.OrderID
JOIN products ON products.ProductID = `order details`.ProductID
JOIN suppliers ON suppliers.SupplierID = products.SupplierID
WHERE suppliers.CompanyName LIKE 'Exotic Liquids'
ORDER BY customers.Country asc

-- ****************************************7 – MONTANT DE VENTS DE 1997******************************************************************************************************************************

SELECT SUM(UnitPrice*Quantity) AS 'Montant des ventes 1997' FROM `order details`
JOIN orders ON `order details`.OrderID = orders.OrderID
WHERE YEAR(OrderDate) = 1997

-- ****************************************8 – MONTANT DE VENTS DE 1997 MOIS PAR MOIS****************************************************************************************************************

SELECT MONTH(OrderDate) AS "MOIS", SUM(UnitPrice*Quantity) AS 'Montant des ventes 1997' FROM `order details`
JOIN orders ON `order details`.OrderID = orders.OrderID
WHERE YEAR(OrderDate) = 1997
GROUP BY MONTH(OrderDate);

-- ****************************************9 – Depuis quelle date le client « Du monde entier » n’a plus commandé ?**********************************************************************************

SELECT  OrderDate AS 'Date de dernière commande' FROM orders
JOIN customers ON customers.CustomerID = orders.CustomerID
WHERE customers.CompanyName LIKE 'Du monde entier'
ORDER BY OrderDate DESC LIMIT 1;

-- ****************************************10 – Quel est le délai moyen de livraison en jours ?*****************************************************************************************************

SELECT ROUND(AVG(DATEDIFF(ShippedDate, OrderDate)),0) AS 'Délai moyen de livraison en jours' FROM orders



-- ****************************************PROCEDURES STOCKEES*****************************************************************************************************
-- ****************************************PROCEDURES STOCKEES*****************************************************************************************************
-- ****************************************PROCEDURES STOCKEES*****************************************************************************************************

--Codez deux procédures stockées correspondant aux requêtes 9 et 10. Les procédures stockées doivent prendre en compte les éventuels paramètres.


--9 – Depuis quelle date le client « Du monde entier » n’a plus commandé ?
delimiter |
CREATE PROCEDURE list_dernier_date()
BEGIN 
     SELECT  OrderDate AS 'Date de dernière commande' FROM orders
     JOIN customers ON customers.CustomerID = orders.CustomerID
     WHERE customers.CompanyName LIKE 'Du monde entier'
     ORDER BY OrderDate DESC LIMIT 1;
END |
delimiter ;   

--10 – Quel est le délai de livraison en jours ?

delimiter |
CREATE PROCEDURE calcul_delai(IN id INT) 
                              
BEGIN 
   SELECT DATEDIFF(ShippedDate, OrderDate) AS 'Délai de livraison en jours' FROM orders
   WHERE id = OrderID;
END |
delimiter;  


CALL calcul_delai(10262);  --(Example de lancer la procédure avec OrderID=10262)


--le délai moyen

delimiter |
CREATE PROCEDURE calcul_delai_moyen()
BEGIN 
   SELECT ROUND(AVG(DATEDIFF(ShippedDate, OrderDate)),0) AS 'Délai moyen de livraison en jours' FROM orders;
END |
delimiter;	

CALL calcul_delai_moyen  --(Pour lancer la procédure)


-- ****************************************Mise en place d'une règle de gestion*****************************************************************************************************
-- ****************************************Mise en place d'une règle de gestion*****************************************************************************************************
-- ****************************************Mise en place d'une règle de gestion*****************************************************************************************************

/*SELECT `order details`.OrderID, `order details`.ProductID, customers.Country AS 'Pays de client', suppliers.Country AS 'Pays de Fournisseur' FROM `order details`
JOIN orders ON orders.OrderID = `order details`.OrderID
JOIN customers ON customers.CustomerID = orders.CustomerID
JOIN products ON products.ProductID = `order details`.ProductID
JOIN suppliers ON suppliers.SupplierID = products.SupplierID
WHERE customers.Country = suppliers.Country


SELECT ProductID, suppliers.Country FROM products
JOIN suppliers ON suppliers.SupplierID = products.SupplierID */

--(ON VÉRIFIERA QUE POUR CHAQUE PRODUIT D'UNE COMMANDE, LE CLIENT RÉSIDE DANS LE MÊME PAYS QUE LE FOURNISSEUR DU MÊME PRODUIT)
delimiter |
CREATE TRIGGER insert_cli_four AFTER INSERT ON `order details` FOR EACH ROW 
    BEGIN 
         DECLARE id_ord INT;
         DECLARE id_pro INT;
         DECLARE pays_four VARCHAR(15);
         DECLARE pays_cli VARCHAR(15);
         SET id_pro = NEW.ProductID;
         SET id_ord = NEW.OrderID;
         SET pays_four = (SELECT Country FROM products
                          JOIN suppliers ON products.SupplierID = suppliers.SupplierID
                          WHERE id_pro = ProductID);
         SET pays_cli = (SELECT Country FROM orders
			                JOIN customers ON orders.CustomerID = customers.CustomerID
								 WHERE id_ord = OrderID); 
			if pays_four != pays_cli then
			   SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT ='Vous ne pouvez plus insérer ce produit parce que le pays de fournisseur est différent de pays de client';
			   END if ;
	 END |
delimiter;

--(POUR TESTER, on va insérer 2 commandes suivantes avec CustomerID = 'RATTC' vient de USA and ProductID = 1 ayant le fournisseur qui vient de UK )

INSERT INTO `orders` (`OrderID`, `CustomerID`, `EmployeeID`, `OrderDate`, `RequiredDate`, `ShippedDate`, `ShipVia`, `Freight`, `ShipName`, `ShipAddress`, `ShipCity`, `ShipRegion`, `ShipPostalCode`, `ShipCountry`) VALUES
(11078, 'RATTC', 1, '1998-05-06 00:00:00', '1998-06-03 00:00:00', NULL, 2, 8.5300, 'Rattlesnake Canyon Grocery', '2817 Milton Dr.', 'Albuquerque', 'NM', '87110', 'USA');
								 
INSERT INTO `order details` (`OrderID`, `ProductID`, `UnitPrice`, `Quantity`, `Discount`) VALUES
(11078, 1, 18.0000, 2, 0);
