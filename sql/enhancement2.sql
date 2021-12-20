 /* SQL Statements for enhancement2*/

 --INSERT STATEMENT--
INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment)
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', '"I am the real Ironman"');

--UPDATE STATEMENT--
UPDATE clients
SET clientLevel = 3
WHERE clientId = 1;

--UPDATE STATEMENT FOR INVENTORY TABLE--
UPDATE inventory
SET invDescription = replace('Do you have 6 kids and like to go off-roading? The Hummer gives you the small interiors with an engine to get you out of any muddy or rocky situation.','small interiors', 'spacious interior')
WHERE invId = 12;

-- INNER JOIN STATEMENT --
SELECT i.invModel, c.classificationName
FROM inventory i
INNER JOIN carclassification c
ON i.classificationId = c.classificationId
WHERE c.classificationId = 1;

-- DELETE STATEMENT --
DELETE FROM inventory WHERE invId = 1;

--CONCAT STATEMENT--
UPDATE inventory
SET invImage=CONCAT("/phpmotors", invImage), invThumbnail=CONCAT("/phpmotors", invThumbnail);

