-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2024 at 11:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `udemy_streaming`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 es director y 2 es actor',
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `profession` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`id`, `full_name`, `imagen`, `type`, `state`, `profession`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Itm', 'streaming/actors/QLfbj59QKBwtxhrzINnjkCk3CT13ooYrr7bYBmzJ.png', 1, 1, 'Director', '2024-07-04 13:46:19', '2024-07-04 13:46:19', NULL),
(2, 'Hernan Torres', 'streaming/actors/bWXQ7nWRzhJVPm1o0JLrcXLczED9du8loiBt97mB.jpg', 2, 1, 'Camarografo', '2024-07-04 14:16:05', '2024-07-04 19:44:26', '2024-07-04 19:44:26'),
(3, 'prueba', 'streaming/actors/UhPGF3DKc8t8cRpSM5yEpIKzX5WXwVhhwdZ8c1Sw.jpg', 2, 1, 'prueba', '2024-07-18 19:06:08', '2024-07-18 19:06:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 es peliculas y 2 es tv show y videos',
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `title`, `imagen`, `type`, `state`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Action', 'streaming/genres/5sGh20pYFRs8im7bBxXbQcIWcVfPWKDls90BaMgN.jpg', 1, 1, '2024-07-02 04:35:27', '2024-07-02 04:35:27', NULL),
(3, 'Action', 'streaming/genres/F96gi5QPVGEGUjjXVs8SO98m67cAfZGVuzsYP0GQ.jpg', 2, 2, '2024-07-02 05:39:37', '2024-07-02 13:07:06', NULL),
(4, 'Animation', 'streaming/genres/pb7VjHiL1Aay5Xt5WX5ka6WqloRV7nw5DiiiBGiU.jpg', 1, 1, '2024-07-02 10:56:04', '2024-07-02 12:51:36', NULL),
(5, 'Comedy', 'streaming/genres/9XpCxkT6AtLdnsWyV9neqlMVXYUspZR6D3utjg5G.jpg', 1, 1, '2024-07-02 12:53:22', '2024-07-02 17:53:49', '2024-07-02 17:53:49');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan_paypals`
--

CREATE TABLE `plan_paypals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `precio_mensual` double NOT NULL,
  `precio_anual` double NOT NULL,
  `month_free` tinyint(2) UNSIGNED NOT NULL DEFAULT 1,
  `id_plan_paypal_mensual` varchar(150) NOT NULL,
  `id_plan_paypal_anual` varchar(150) NOT NULL,
  `id_product_paypal` varchar(250) DEFAULT NULL,
  `product_paypal_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan_paypals`
--

INSERT INTO `plan_paypals` (`id`, `name`, `description`, `precio_mensual`, `precio_anual`, `month_free`, `id_plan_paypal_mensual`, `id_plan_paypal_anual`, `id_product_paypal`, `product_paypal_id`, `created_at`, `updated_at`) VALUES
(2, 'BASICO', 'CON EL PLAN BASICO EL CLIENTE VA A PODER VER UNICAMENTE PELICULAS', 20, 144, 1, 'P-9CN86315VP8848250MZRQ2LI', 'P-3L555179JH756084EMZRQ2LY', 'PROD-1XX1571074681804N', 1, '2024-06-07 13:37:51', '2024-06-07 13:37:51'),
(3, 'STANDARzz', 'EL PLAN STANDAR VA A PERMITIR AL CLIENTE VER LAS PELICULAS Y SERIES', 45, 400, 1, 'P-90X78400SD162044XMZRRNYA', 'P-8VB55188GW017502MMZRRNYI', 'PROD-1XX1571074681804N', 1, '2024-06-07 14:19:13', '2024-06-07 16:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_paypals`
--

CREATE TABLE `product_paypals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `type` varchar(150) NOT NULL,
  `category` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `id_product_paypal` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_paypals`
--

INSERT INTO `product_paypals` (`id`, `name`, `type`, `category`, `description`, `id_product_paypal`, `created_at`, `updated_at`) VALUES
(1, 'Plataforma de suscripción', 'SERVICE', 'MOVIE', 'El cliente va a poder ver sus peliculas, series además de novelas y videos', 'PROD-1XX1571074681804N', '2024-05-21 01:04:45', '2024-05-24 01:05:09'),
(5, 'Ventas de cursos Online', 'DIGITAL', 'ONLINE_SERVICES', 'Venta de cursos de desarrollo web para estudiantes de udemy', 'PROD-4UX51542W1707271K', '2024-05-26 12:46:54', '2024-05-26 12:46:54'),
(6, 'Soluciones multimedia Vimeo', 'DIGITAL', 'ONLINE_DATING', 'Plataforma para poder alojar los recursos multimedia de tu página udemy', 'PROD-0U6662105F202192B', '2024-05-26 14:43:03', '2024-05-26 16:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `permisos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permisos`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permisos`, `created_at`, `updated_at`) VALUES
(1, 'ADMINISTRADOR GENERAL', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `streamings`
--

CREATE TABLE `streamings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` text NOT NULL,
  `subtitle` text NOT NULL,
  `imagen` varchar(250) DEFAULT NULL,
  `genre_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vimeo_id` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 es inactivo y 2 es publico',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 es movie, 2 es tv show y 3 video',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `streamings`
--

INSERT INTO `streamings` (`id`, `title`, `slug`, `subtitle`, `imagen`, `genre_id`, `vimeo_id`, `time`, `description`, `tags`, `state`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ZOMBIES ISLAND', 'zombies-island', 'Baileys Irish Cream is an Irish cream liqueur an alcoholic', 'streaming/uytFPEr5OcroJrdxgJThWug2JUVlsjfqjxJPhNLc.jpg', 1, NULL, NULL, 'Baileys Irish Cream is an Irish cream liqueur an alcoholic beverage flavoured with cream, cocoa, and Irish whiskey made by Diageo at Republic of Ireland and in Mallusk, Northern Ireland.', 'Action', 1, 1, '2024-07-17 00:44:47', '2024-07-18 23:08:25', NULL),
(6, 'p2', 'p2', 'prueba sub', 'streaming/AIYuTa3OUb78rlYE5bArCgY4HBNuYijBBOzYFErk.jpg', 4, NULL, NULL, 'p2', 'Action,4k Ultra', 1, 1, '2024-07-18 18:50:59', '2024-07-20 18:50:58', NULL),
(7, 'prueba2', 'prueba2', 'prueba2', 'streaming/O4u2D0LRxj4ZUIGS8IZuKUvI7d36eHe0zxljkbxo.jpg', 1, NULL, NULL, 'prueba2', 'Action', 1, 1, '2024-07-18 22:41:55', '2024-07-20 20:27:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `streaming_actors`
--

CREATE TABLE `streaming_actors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `streaming_id` bigint(20) UNSIGNED NOT NULL,
  `actor_id` bigint(20) DEFAULT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `streaming_actors`
--

INSERT INTO `streaming_actors` (`id`, `streaming_id`, `actor_id`, `state`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, '2024-07-17 00:44:47', '2024-07-17 00:44:47', NULL),
(6, 6, 1, 1, '2024-07-18 18:50:59', '2024-07-19 07:51:35', '2024-07-19 07:51:35'),
(7, 7, 1, 1, '2024-07-18 22:41:55', '2024-07-21 01:27:57', '2024-07-21 01:27:57'),
(8, 6, 3, 1, '2024-07-19 02:51:35', '2024-07-19 02:51:35', NULL),
(10, 7, 3, 1, '2024-07-20 20:27:57', '2024-07-21 01:34:18', '2024-07-21 01:34:18'),
(14, 7, 1, 1, '2024-07-20 20:36:07', '2024-07-20 20:36:07', NULL),
(15, 7, 3, 1, '2024-07-20 20:36:07', '2024-07-20 20:36:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `streaming_episodes`
--

CREATE TABLE `streaming_episodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `streaming_season_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 es activo',
  `vimeo_id` varchar(50) DEFAULT NULL,
  `time` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `streaming_seasons`
--

CREATE TABLE `streaming_seasons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `streaming_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 es activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(250) NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 es peliculas y 2 es tv show y videos',
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `type`, `state`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Action', 1, 1, '2024-07-07 16:27:13', '2024-07-07 16:43:44', NULL),
(2, '4k Ultra', 2, 2, '2024-07-07 16:28:18', '2024-07-07 21:47:43', '2024-07-07 21:47:43'),
(3, '4k Ultra', 2, 1, '2024-07-07 16:50:20', '2024-07-07 16:50:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(250) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `type_user` tinyint(1) UNSIGNED DEFAULT 1 COMMENT '1 es admin y 2 es cliente',
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `state` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1 es activo y 2 es inactivo',
  `avatar` varchar(250) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `type_user`, `role_id`, `state`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'David', NULL, 'juan@correo.com', 1, 1, 1, NULL, NULL, '$2y$10$yLxZKFxq97EKVg5vzupkluZxKKIi1K1z4.8Br0OzEMu3NmyQyDstS', NULL, '2024-04-25 00:10:33', '2024-04-25 00:10:33', NULL),
(2, 'Juan David', 'Ruiz', 'juanruiz@correo.com', 1, 1, 1, 'users/b57NnORhhxVWQ5JjXGYiXwWPanNgqsignh9yvTUF.jpg', NULL, '12345678', NULL, '2024-05-13 09:51:34', '2024-05-13 23:29:40', NULL),
(3, 'Damian Robert', 'Mars', 'damian@correo.com', 1, 1, 2, 'users/hkb2KNn083toLBHnV00OziofYMJ4QSmh9fPKXFiw.jpg', NULL, '12345678', NULL, '2024-05-13 09:58:04', '2024-05-14 00:19:48', '2024-05-14 00:19:48'),
(4, 'Steven', 'Smith', 'steven@correo.com', 1, 1, 1, 'users/Ak9cl5xIRIlJwmzYIWMmJdE8YpkkQNkP0pQzfKzZ.jpg', NULL, '12345678', NULL, '2024-05-13 16:23:33', '2024-05-14 00:18:30', NULL),
(5, 'Guy', 'Turin', 'guy@correo.com', 1, 1, 2, 'users/8zHBWgGOvAiJU1vYour709BQph0mDUFgcj5SNbiF.jpg', NULL, '12345678', NULL, '2024-05-13 22:22:14', '2024-05-14 00:21:29', NULL),
(6, 'Sami', 'Robert', 'sami@correo.com', 1, 1, 1, 'users/WHsXZEhq8NZPGdDh18ohOWQMS3BjCGIZSwdsK7UH.jpg', NULL, '12345678', NULL, '2024-05-13 23:18:07', '2024-05-13 23:18:07', NULL),
(7, 'Payasin', 'Smith', 'payasin@correo.com', 1, 1, 1, 'users/4dd3zJfUMovtsiCYpfD0JYWS6SaF0S53LgLBIVPf.jpg', NULL, '12345678', NULL, '2024-07-02 09:23:41', '2024-07-02 15:27:41', '2024-07-02 15:27:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `plan_paypals`
--
ALTER TABLE `plan_paypals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_paypals`
--
ALTER TABLE `product_paypals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `streamings`
--
ALTER TABLE `streamings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `streaming_actors`
--
ALTER TABLE `streaming_actors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `streaming_episodes`
--
ALTER TABLE `streaming_episodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `streaming_seasons`
--
ALTER TABLE `streaming_seasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plan_paypals`
--
ALTER TABLE `plan_paypals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_paypals`
--
ALTER TABLE `product_paypals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `streamings`
--
ALTER TABLE `streamings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `streaming_actors`
--
ALTER TABLE `streaming_actors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `streaming_episodes`
--
ALTER TABLE `streaming_episodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `streaming_seasons`
--
ALTER TABLE `streaming_seasons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
