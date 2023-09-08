-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 08, 2023 at 02:33 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_07_143147_create_projects_table', 1),
(6, '2023_09_07_143208_create_tasks_table', 1),
(7, '2023_09_07_143218_create_team_members_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `owner_id` bigint UNSIGNED NOT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_owner_id_foreign` (`owner_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `owner_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Project One', 'Project One', 1, '1', '2023-09-07 17:25:42', '2023-09-07 17:25:42'),
(2, 'Project Two', 'Project Two', 1, '1', '2023-09-07 12:08:59', '2023-09-07 12:08:59'),
(3, 'Project Three', 'Project Three', 1, '1', '2023-09-07 12:10:01', '2023-09-07 12:10:01'),
(4, 'Project Four', 'Project Four', 1, '1', '2023-09-07 12:10:10', '2023-09-07 23:17:15'),
(6, 'Project Five', 'Project Five', 1, '1', '2023-09-07 23:17:24', '2023-09-07 23:17:24'),
(7, 'Project Six', 'Project Six', 2, '1', '2023-09-08 02:44:22', '2023-09-08 02:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint UNSIGNED NOT NULL,
  `is_completed` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_project_id_foreign` (`project_id`),
  KEY `tasks_creator_id_foreign` (`creator_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `title`, `description`, `creator_id`, `is_completed`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Task One', 'Task One', 1, '1', '1', '2023-09-08 03:10:58', '2023-09-08 08:49:10'),
(2, 1, 'Task Two', 'Task Two', 1, '1', '1', '2023-09-08 07:15:50', '2023-09-08 07:43:23'),
(3, 2, 'Task Three', 'Task Three', 1, '0', '1', '2023-09-08 07:15:58', '2023-09-08 07:15:58'),
(4, 2, 'Task Four', 'Task Four', 1, '0', '1', '2023-09-08 07:16:07', '2023-09-08 07:16:07'),
(5, 3, 'Task Five', 'Task Five', 1, '0', '1', '2023-09-08 07:16:20', '2023-09-08 07:16:20'),
(6, 3, 'Task Six', 'Task Six', 1, '1', '1', '2023-09-08 07:16:27', '2023-09-08 08:57:03'),
(7, 7, 'Test Task', 'Test Task', 2, '0', '1', '2023-09-08 07:16:58', '2023-09-08 07:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
CREATE TABLE IF NOT EXISTS `team_members` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `role` enum('admin','member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_members_user_id_project_id_unique` (`user_id`,`project_id`),
  KEY `team_members_project_id_foreign` (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `user_id`, `project_id`, `role`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'admin', '2023-09-08 01:04:19', '2023-09-08 01:04:19'),
(2, 3, 1, 'member', '2023-09-08 01:04:19', '2023-09-08 01:04:19'),
(3, 4, 1, 'member', '2023-09-08 01:04:19', '2023-09-08 01:04:19'),
(4, 5, 1, 'member', '2023-09-08 01:04:19', '2023-09-08 01:04:19'),
(5, 6, 1, 'member', '2023-09-08 01:04:19', '2023-09-08 01:04:19'),
(6, 3, 2, 'admin', '2023-09-08 01:04:34', '2023-09-08 01:04:34'),
(7, 4, 2, 'member', '2023-09-08 01:04:34', '2023-09-08 01:04:34'),
(8, 5, 2, 'member', '2023-09-08 01:04:34', '2023-09-08 01:04:34'),
(9, 6, 2, 'member', '2023-09-08 01:04:34', '2023-09-08 01:04:34'),
(10, 7, 2, 'member', '2023-09-08 01:04:34', '2023-09-08 01:04:34'),
(11, 4, 3, 'admin', '2023-09-08 01:04:49', '2023-09-08 01:04:49'),
(12, 5, 3, 'member', '2023-09-08 01:04:49', '2023-09-08 01:04:49'),
(13, 6, 3, 'member', '2023-09-08 01:04:49', '2023-09-08 01:04:49'),
(14, 7, 3, 'member', '2023-09-08 01:04:49', '2023-09-08 01:04:49'),
(15, 8, 3, 'member', '2023-09-08 01:04:49', '2023-09-08 01:04:49'),
(16, 9, 3, 'member', '2023-09-08 01:04:49', '2023-09-08 01:04:49'),
(17, 5, 4, 'admin', '2023-09-08 01:04:59', '2023-09-08 01:04:59'),
(18, 8, 4, 'member', '2023-09-08 01:04:59', '2023-09-08 01:04:59'),
(19, 9, 4, 'member', '2023-09-08 01:04:59', '2023-09-08 01:04:59'),
(20, 10, 4, 'member', '2023-09-08 01:04:59', '2023-09-08 01:04:59'),
(21, 11, 4, 'member', '2023-09-08 01:04:59', '2023-09-08 01:04:59'),
(22, 6, 6, 'admin', '2023-09-08 01:05:10', '2023-09-08 01:05:10'),
(23, 2, 6, 'member', '2023-09-08 01:05:10', '2023-09-08 01:05:10'),
(24, 3, 6, 'member', '2023-09-08 01:05:10', '2023-09-08 01:05:10'),
(25, 4, 6, 'member', '2023-09-08 01:05:10', '2023-09-08 01:05:10'),
(26, 7, 6, 'member', '2023-09-08 01:05:10', '2023-09-08 01:05:10'),
(27, 8, 6, 'member', '2023-09-08 01:05:10', '2023-09-08 01:05:10'),
(28, 9, 6, 'member', '2023-09-08 01:05:10', '2023-09-08 01:05:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gajendiran', 'gajendiran.gaja1@gmail.com', NULL, '$2y$10$vsFc0Ocwv.Jtogj9VieGQenbFkWFprxEBYVlJLCVL1HB.07avM2BS', NULL, '2023-09-07 10:55:21', '2023-09-07 10:55:21'),
(2, 'User One', 'user1@gmail.com', NULL, '$2y$10$3vYfTrYtkeD9XyfEtFGOBeZHu4aZDNlT.K/xbHTup6LCkiidSA1T6', NULL, '2023-09-07 10:56:22', '2023-09-07 10:56:22'),
(3, 'User Two', 'user2@gmail.com', NULL, '$2y$10$3vYfTrYtkeD9XyfEtFGOBeZHu4aZDNlT.K/xbHTup6LCkiidSA1T6', NULL, '2023-09-07 16:27:07', '2023-09-07 16:27:07'),
(4, 'User Three', 'user3@gmail.com', NULL, '$2y$10$3vYfTrYtkeD9XyfEtFGOBeZHu4aZDNlT.K/xbHTup6LCkiidSA1T6', NULL, '2023-09-07 16:27:07', '2023-09-07 16:27:07'),
(5, 'User Four', 'user4@gmail.com', NULL, '$2y$10$3vYfTrYtkeD9XyfEtFGOBeZHu4aZDNlT.K/xbHTup6LCkiidSA1T6', NULL, '2023-09-07 16:27:07', '2023-09-07 16:27:07'),
(6, 'User Five', 'user5@gmail.com', NULL, '$2y$10$3vYfTrYtkeD9XyfEtFGOBeZHu4aZDNlT.K/xbHTup6LCkiidSA1T6', NULL, '2023-09-07 16:27:07', '2023-09-07 16:27:07'),
(7, 'User Six', 'user6@gmail.com', NULL, '$2y$10$3vYfTrYtkeD9XyfEtFGOBeZHu4aZDNlT.K/xbHTup6LCkiidSA1T6', NULL, '2023-09-07 16:27:07', '2023-09-07 16:27:07'),
(8, 'User Seven', 'user7@gmail.com', NULL, '$2y$10$3vYfTrYtkeD9XyfEtFGOBeZHu4aZDNlT.K/xbHTup6LCkiidSA1T6', NULL, '2023-09-07 16:27:07', '2023-09-07 16:27:07'),
(9, 'User Eight', 'user8@gmail.com', NULL, '$2y$10$3vYfTrYtkeD9XyfEtFGOBeZHu4aZDNlT.K/xbHTup6LCkiidSA1T6', NULL, '2023-09-07 16:27:07', '2023-09-07 16:27:07'),
(10, 'User Nine', 'user9@gmail.com', NULL, '$2y$10$3vYfTrYtkeD9XyfEtFGOBeZHu4aZDNlT.K/xbHTup6LCkiidSA1T6', NULL, '2023-09-07 16:27:07', '2023-09-07 16:27:07'),
(11, 'User Ten', 'user10@gmail.com', NULL, '$2y$10$3vYfTrYtkeD9XyfEtFGOBeZHu4aZDNlT.K/xbHTup6LCkiidSA1T6', NULL, '2023-09-07 16:27:07', '2023-09-07 16:27:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
