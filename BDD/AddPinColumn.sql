-- Ajouter la colonne isEpingle à la table ARTICLE si elle n'existe pas
ALTER TABLE ARTICLE ADD COLUMN isEpingle TINYINT(1) DEFAULT 0 AFTER numThem;
