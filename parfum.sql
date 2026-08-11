-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 11 août 2026 à 16:20
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parfum`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `adresse` text NOT NULL,
  `produits` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `paiement` varchar(50) NOT NULL DEFAULT 'Paiement à la livraison',
  `date_commande` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `nom`, `telephone`, `adresse`, `produits`, `total`, `paiement`, `date_commande`) VALUES
(1, 'daada', '5587845', 'sidi hssine', 'Produit : Marshmallow | Taille : 30 ML | Quantité : 3 | Prix : 12 DT | Total : 36 DT\r\nProduit : Bleu De Channel | Taille : 30 ML | Quantité : 1 | Prix : 12 DT | Total : 12 DT', 48.00, 'Paiement à la livraison', '2026-08-11 13:56:28'),
(2, 'daada', '5587845', 'sidi hssine', 'Produit : Marshmallow | Taille : 30 ML | Quantité : 3 | Prix : 12 DT | Total : 36 DT\r\nProduit : Bleu De Channel | Taille : 30 ML | Quantité : 1 | Prix : 12 DT | Total : 12 DT', 48.00, 'Paiement à la livraison', '2026-08-11 13:58:48');

-- --------------------------------------------------------

--
-- Structure de la table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`) VALUES
(1, 'yous', 'y3@gmail.com', '55874214', 'Question générale', 'hlfl', '2026-08-11 13:38:44'),
(2, 'yous', 'y3@gmail.com', '55874214', 'Question générale', 'hlfl', '2026-08-11 13:38:44'),
(3, 'yous', 'y3@gmail.com', '55874214', 'Question générale', 'hlfl', '2026-08-11 13:41:08'),
(4, 'yous', 'y3@gmail.com', '55874214', 'Question générale', 'hlfl', '2026-08-11 13:44:37'),
(5, 'youssef boukeri', 'youssefboukari23@gmail.com', '55874214', 'Question sur un parfum', 'dada', '2026-08-11 13:44:49'),
(6, 'ronaldo', 'ronaldo@gmail.com', '22356896', 'Question sur une commande', 'messiii', '2026-08-11 13:47:01'),
(7, 'ronaldo', 'ronaldo@gmail.com', '22356896', 'Question sur une commande', 'messiii', '2026-08-11 13:47:08');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price_30` decimal(10,0) NOT NULL,
  `price_50` decimal(10,0) NOT NULL,
  `price_100` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price_30`, `price_50`, `price_100`) VALUES
(1, 'Marshmallow', 'image/parfum1.jpg.webp', 12, 15, 25),
(2, 'Bleu De Channel', 'image/parfum2.jpg', 12, 15, 25),
(3, 'Baccarat Rouge', 'image/parfum3.jpg', 12, 15, 25),
(4, 'Vanilla Powder', 'image/parfum4.jpg', 12, 15, 25),
(5, 'Ultra Male', 'image/parfum5.jpg', 12, 15, 25),
(6, 'STRONGER WITH YOU', 'image/parfum6.jpg', 12, 15, 25),
(7, 'Ambre Levant', 'image/parfum7.jpg', 12, 15, 25),
(8, 'Sauvage Dior', 'image/parfum8.jpg', 12, 15, 25),
(9, 'Tom ford black orchid', 'image/parfum9.jpg', 12, 15, 25),
(10, 'Chance Chanel', 'image/parfum10.jpg', 12, 15, 25),
(11, 'Acqua De Parma', 'image/parfum11.jpg', 12, 15, 25),
(12, 'Dior Homme', 'image/parfum12.jpg', 12, 15, 25),
(13, 'Creed Aventus', 'image/parfum13.jpg', 12, 15, 25),
(14, 'Black Opiume ', 'image/parfum14.jpg', 12, 15, 25),
(15, 'Jo Malone', 'image/parfum15.jpg', 12, 15, 25),
(16, 'Montblanc Explorer', 'image/parfum16.jpg', 12, 15, 25),
(17, 'Valentino', 'image/parfum17.jpg', 12, 15, 25),
(18, 'Pleasure ', 'image/parfum18.jpg', 12, 15, 25),
(19, 'Replica ', 'image/parfum19.jpg', 12, 15, 25),
(20, 'Gucci', 'image/parfum20.jpg', 12, 15, 25);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
