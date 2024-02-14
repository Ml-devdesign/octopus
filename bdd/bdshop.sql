CREATE DATABASE IF NOT EXISTS bdshop; 
USE bdshop;

-- Structure de la table `table_admin`
DROP TABLE IF EXISTS `table_admin`;
CREATE TABLE IF NOT EXISTS `table_admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `admin_login` varchar(50) DEFAULT NULL,
  `admin_password` varchar(255) DEFAULT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `table_admin`
INSERT INTO `table_admin` (`admin_id`, `admin_login`, `admin_password`, `admin_name`) VALUES
(1, 'admin1', 'password1', 'Admin 1'),
(2, 'admin2', 'password2', 'Admin 2'),
(3, 'admin3', 'password3', 'Admin 3');

-- Structure de la table `table_author`
DROP TABLE IF EXISTS `table_author`;
CREATE TABLE IF NOT EXISTS `table_author` (
  `author_ID` int NOT NULL AUTO_INCREMENT,
  `author_firstName` varchar(50) DEFAULT NULL,
  `author_lastName` varchar(50) DEFAULT NULL,
  `author_country` varchar(50) DEFAULT NULL,
  `author_image` varchar(255) DEFAULT NULL,
  `author_description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`author_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `table_author`
INSERT INTO `table_author` (`author_ID`, `author_firstName`, `author_lastName`, `author_country`, `author_image`, `author_description`) VALUES
(1, 'John', 'Doe', 'USA', 'john_doe.jpg', 'Auteur renommé des États-Unis'),
(2, 'Alice', 'Smith', 'UK', 'alice_smith.jpg', 'Auteure à succès du Royaume-Uni'),
(3, 'Mohammed', 'Ali', 'Egypt', 'mohammed_ali.jpg', 'Auteur égyptien célèbre');

-- Structure de la table `table_book`
DROP TABLE IF EXISTS `table_book`;
CREATE TABLE IF NOT EXISTS `table_book` (
  `book_ID` int NOT NULL AUTO_INCREMENT,
  `book_isbn` varchar(20) DEFAULT NULL,
  `book_title` varchar(255) DEFAULT NULL,
  `book_resume` text,
  `book_publisher` varchar(50) DEFAULT NULL,
  `book_date` date DEFAULT NULL,
  `book_cartoonist` varchar(50) DEFAULT NULL,
  `book_image` varchar(255) DEFAULT NULL,
  `book_description` varchar(50) DEFAULT NULL,
  `book_price` decimal(6,2) DEFAULT NULL,
  `book_type_id` int DEFAULT NULL,
  PRIMARY KEY (`book_ID`),
  UNIQUE KEY `book_isbn` (`book_isbn`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `table_book`
INSERT INTO `table_book` (`book_ID`, `book_isbn`, `book_title`, `book_resume`, `book_publisher`, `book_date`, `book_cartoonist`, `book_image`, `book_description`, `book_price`, `book_type_id`) VALUES
(1, NULL, 'Les Chroniques de Fantasy', 'Dans un monde fantastique...', 'Éditeur A', '2023-01-01', 'Dessinateur A', 'bd1.jpg', 'Premier tome des Chroniques de Fantasy', '19.99', 1),
(2, NULL, 'Le Mystère du Manoir', 'Une enquête mystérieuse...', 'Éditeur B', '2023-02-01', 'Dessinateur B', 'bd2.jpg', 'Intrigue captivante dans un manoir abandonné', '24.99', 2),
(3, NULL, 'Les Explorateurs de l\'Espace', 'Aventures intergalactiques...', 'Éditeur C', '2023-03-01', 'Dessinateur C', 'bd3.jpg', 'Voyage vers l\'inconnu dans les profondeurs de l\'es', '14.99', 3);

-- Structure de la table `table_book_author`
DROP TABLE IF EXISTS `table_book_author`;
CREATE TABLE IF NOT EXISTS `table_book_author` (
  `book_author_ID` int NOT NULL AUTO_INCREMENT,
  `book_author_book_id` int DEFAULT NULL,
  `book_author_author_ID` int DEFAULT NULL,
  PRIMARY KEY (`book_author_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `table_book_author`
INSERT INTO `table_book_author` (`book_author_ID`, `book_author_book_id`, `book_author_author_ID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- Structure de la table `table_book_category`
DROP TABLE IF EXISTS `table_book_category`;
CREATE TABLE IF NOT EXISTS `table_book_category` (
  `book_category_id` int NOT NULL AUTO_INCREMENT,
  `book_category_book` varchar(50) DEFAULT NULL,
  `book_category_category_id` int DEFAULT NULL,
  PRIMARY KEY (`book_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `table_book_category`
INSERT INTO `table_book_category` (`book_category_id`, `book_category_book`, `book_category_category_id`) VALUES
(1, '9781234567890', 1),
(2, '9780987654321', 2),
(3, '9789876543210', 3);

-- Structure de la table `table_category`
DROP TABLE IF EXISTS `table_category`;
CREATE TABLE IF NOT EXISTS `table_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_title` varchar(50) DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `category_description` text,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `table_category`
INSERT INTO `table_category` (`category_id`, `category_title`, `category_image`, `category_description`) VALUES
(1, 'Fantasy', 'fantasy.jpg', 'Bandes dessinées fantastiques'),
(2, 'Mystery', 'mystery.jpg', 'Bandes dessinées de mystère'),
(3, 'Science Fiction', 'sci-fi.jpg', 'Bandes dessinées de science-fiction');

-- Structure de la table `table_customer`
DROP TABLE IF EXISTS `table_customer`;
CREATE TABLE IF NOT EXISTS `table_customer` (
  `customer_ID` int NOT NULL AUTO_INCREMENT,
  `customer_slug` varchar(64) DEFAULT NULL,
  `customer_Lname` varchar(50) DEFAULT NULL,
  `customer_fname` varchar(50) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_password` varchar(64) DEFAULT NULL,
  `customer_address` varchar(100) DEFAULT NULL,
  `customer_zip` int DEFAULT NULL,
  `customer_city` varchar(50) DEFAULT NULL,
  `customer_phone` varchar(50) DEFAULT NULL,
  `subscription_description_date` date DEFAULT NULL,
  `customer_subscription_ID` int DEFAULT NULL,
  PRIMARY KEY (`customer_ID`),
  UNIQUE KEY `customer_email` (`customer_email`),
  UNIQUE KEY `customer_address` (`customer_address`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `table_customer`
INSERT INTO `table_customer` (`customer_ID`, `customer_slug`, `customer_Lname`, `customer_fname`, `customer_email`, `customer_password`, `customer_address`, `customer_zip`, `customer_city`, `customer_phone`, `subscription_description_date`, `customer_subscription_ID`) VALUES
(1, 'client1', 'Doe', 'John', 'john@example.com', 'password1', '123 Rue de la Ville', 12345, 'Ville', '123-456-7890', '2023-01-01', 1),
(2, 'client2', 'Smith', 'Alice', 'alice@example.com', 'password2', '456 Avenue du Quartier', 54321, 'Ville', '987-654-3210', '2023-02-01', 2),
(3, 'client3', 'Ali', 'Mohammed', 'mohammed@example.com', 'password3', '789 Boulevard de la Rue', 67890, 'Ville', '456-789-0123', '2023-03-01', 3);

-- Structure de la table `table_sale`
DROP TABLE IF EXISTS `table_sale`;
CREATE TABLE IF NOT EXISTS `table_sale` (
  `table_sale_ID` int NOT NULL AUTO_INCREMENT,
  `table_sale_date` date DEFAULT NULL,
  `table_sale_time` time DEFAULT NULL,
  `table_sale_book_id` varchar(255) DEFAULT NULL,
  `table_sale_customer_id` int DEFAULT NULL,
  `table_sale_quantity` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`table_sale_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `table_sale`
INSERT INTO `table_sale` (`table_sale_ID`, `table_sale_date`, `table_sale_time`, `table_sale_book_id`, `table_sale_customer_id`, `table_sale_quantity`) VALUES
(1, '2023-01-15', '12:30:00', '9781234567890', 1, '1'),
(2, '2023-02-20', '14:45:00', '9780987654321', 2, '2'),
(3, '2023-03-25', '11:15:00', '9789876543210', 3, '1');

-- Structure de la table `table_subscription`
DROP TABLE IF EXISTS `table_subscription`;
CREATE TABLE IF NOT EXISTS `table_subscription` (
  `subscription_ID` int NOT NULL AUTO_INCREMENT,
  `subscription_designation` varchar(255) DEFAULT NULL,
  `subscription_price` decimal(6,2) DEFAULT NULL,
  `subscription_description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`subscription_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `table_subscription`
INSERT INTO `table_subscription` (`subscription_ID`, `subscription_designation`, `subscription_price`, `subscription_description`) VALUES
(1, 'Abonnement mensuel', '9.99', 'Accès illimité aux nouveautés chaque mois'),
(2, 'Abonnement annuel', '99.99', 'Accès illimité à la bibliothèque pendant un an');

-- Structure de la table `table_type`
DROP TABLE IF EXISTS `table_type`;
CREATE TABLE IF NOT EXISTS `table_type` (
  `table_type_ID` int NOT NULL AUTO_INCREMENT,
  `table_type_designation` text,
  `table_type_illustration` varchar(255) DEFAULT NULL,
  `table_type_description` text,
  PRIMARY KEY (`table_type_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Déchargement des données de la table `table_type`
INSERT INTO `table_type` (`table_type_ID`, `table_type_designation`, `table_type_illustration`, `table_type_description`) VALUES
(1, 'Relié', 'hardcover.jpg', 'Bandes dessinées reliées'),
(2, 'Broché', 'paperback.jpg', 'Bandes dessinées brochées'),
(3, 'E-book', 'ebook.jpg', 'Bandes dessinées électroniques');