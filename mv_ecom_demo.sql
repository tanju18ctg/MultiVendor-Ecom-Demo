-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 12:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mv_ecom_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `image`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, '01868332991', 'admin@gmail.com', NULL, '$2y$10$f0oDHDmAoC9Ij56Sm3ahx.gyQX0nmSln8B6c.OUPvpca5zaawSG3W', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_file_systems`
--

CREATE TABLE `admin_file_systems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(191) NOT NULL,
  `type` enum('product','category','brand','slider') NOT NULL DEFAULT 'product',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_file_systems`
--

INSERT INTO `admin_file_systems` (`id`, `url`, `type`, `created_at`, `updated_at`) VALUES
(1, '/uploads/brands/05182025092147fsSfKVl1MuS45nL5_350_350.png', 'brand', '2025-05-18 03:21:47', '2025-05-18 03:21:47'),
(2, '/uploads/sliders/05182025094917zoAdjmdKA7bqNgrW_1440_450.jfif', 'slider', '2025-05-18 03:49:17', '2025-05-18 03:49:17'),
(3, '/uploads/sliders/05182025094922pDdgTukKGxqgR9cZ_1440_450.jfif', 'slider', '2025-05-18 03:49:22', '2025-05-18 03:49:22'),
(4, '/uploads/sliders/05182025094930c0Ewh96D9BSTMKdi_1440_450.jfif', 'slider', '2025-05-18 03:49:30', '2025-05-18 03:49:30'),
(5, '/uploads/sliders/05182025094931Z2kgV68ajc5Sv9lk_1440_450.jfif', 'slider', '2025-05-18 03:49:31', '2025-05-18 03:49:31'),
(6, '/uploads/brands/05182025094948dOfCUhlmKSq8XzNQ_350_350.jpg', 'brand', '2025-05-18 03:49:48', '2025-05-18 03:49:48'),
(7, '/uploads/brands/05182025094959mMm9U8z9Pu4x6Rgo_350_350.png', 'brand', '2025-05-18 03:49:59', '2025-05-18 03:49:59'),
(8, '/uploads/brands/05182025094959R6ehAD4r8d3BKDp1_350_350.jpg', 'brand', '2025-05-18 03:49:59', '2025-05-18 03:49:59'),
(9, '/uploads/brands/05182025094959RT3P1qJrOX3gAMTI_350_350.jpg', 'brand', '2025-05-18 03:50:00', '2025-05-18 03:50:00'),
(10, '/uploads/brands/05182025095000Cc39kSofDKhaFjlG_350_350.jpg', 'brand', '2025-05-18 03:50:00', '2025-05-18 03:50:00'),
(11, '/uploads/brands/05182025095000fv4hPp9yBMVzwIMb_350_350.jpg', 'brand', '2025-05-18 03:50:00', '2025-05-18 03:50:00'),
(12, '/uploads/brands/05192025084335J4VWPHM4Jsdm9gB1_350_350.jpg', 'brand', '2025-05-19 02:43:35', '2025-05-19 02:43:35'),
(13, '/uploads/brands/05192025084400yCv5OTfn4VIJbV8G_350_350.jpg', 'brand', '2025-05-19 02:44:00', '2025-05-19 02:44:00'),
(14, '/uploads/brands/05192025084400iHcDtnAX5fTPO4AR_350_350.jpg', 'brand', '2025-05-19 02:44:00', '2025-05-19 02:44:00'),
(15, '/uploads/brands/05192025084401N4PwD8CLmi7fVHGV_350_350.jpg', 'brand', '2025-05-19 02:44:01', '2025-05-19 02:44:01'),
(16, '/uploads/brands/05192025084401NCBx3K6AjN5nkSnt_350_350.png', 'brand', '2025-05-19 02:44:01', '2025-05-19 02:44:01'),
(17, '/uploads/categories/05192025084641C7u2Segyn8bwes96_250_120.png', 'category', '2025-05-19 02:46:41', '2025-05-19 02:46:41'),
(18, '/uploads/categories/0519202508472002xLsJ5MLQZ69XaM_250_120.png', 'category', '2025-05-19 02:47:20', '2025-05-19 02:47:20'),
(19, '/uploads/categories/05192025084720ENddJQdGJBXA2yi2_250_120.png', 'category', '2025-05-19 02:47:20', '2025-05-19 02:47:20'),
(20, '/uploads/categories/05192025084720ElCiuvVTuZxDx0eG_250_120.jpg', 'category', '2025-05-19 02:47:20', '2025-05-19 02:47:20'),
(21, '/uploads/categories/05192025084721vPpGs4PgamlRb1a8_250_120.jpg', 'category', '2025-05-19 02:47:21', '2025-05-19 02:47:21'),
(22, '/uploads/categories/05192025084721GSef5aDRb7Ekypur_250_120.jpg', 'category', '2025-05-19 02:47:21', '2025-05-19 02:47:21'),
(23, '/uploads/categories/051920250847217my67adj5n9FP5yX_250_120.jpg', 'category', '2025-05-19 02:47:21', '2025-05-19 02:47:21'),
(24, '/uploads/categories/05192025084721RyD0x4s8m6Uy9rMi_250_120.jpg', 'category', '2025-05-19 02:47:21', '2025-05-19 02:47:21'),
(25, '/uploads/categories/05192025084722u6kDWSgi9eESQLHa_250_120.jpg', 'category', '2025-05-19 02:47:22', '2025-05-19 02:47:22'),
(26, '/uploads/categories/05192025084722m50owJRK8gIyFX38_250_120.png', 'category', '2025-05-19 02:47:22', '2025-05-19 02:47:22'),
(27, '/uploads/categories/05192025084722my8ML8RdeE5qZAwS_250_120.png', 'category', '2025-05-19 02:47:22', '2025-05-19 02:47:22'),
(28, '/uploads/categories/05192025084723iOy2F6EIm0Y4zg3p_250_120.png', 'category', '2025-05-19 02:47:23', '2025-05-19 02:47:23'),
(29, '/uploads/categories/051920250847237I4jyIhmrSKNFUy9_250_120.jpg', 'category', '2025-05-19 02:47:23', '2025-05-19 02:47:23'),
(30, '/uploads/categories/051920250847236XCu5ZzPo6aEj7Jl_250_120.png', 'category', '2025-05-19 02:47:23', '2025-05-19 02:47:23'),
(31, '/uploads/categories/05192025084723EauxhVk5LagrDTUp_250_120.png', 'category', '2025-05-19 02:47:23', '2025-05-19 02:47:23'),
(32, '/uploads/categories/05192025084724AmI4tJdjzwsY3huJ_250_120.jpg', 'category', '2025-05-19 02:47:24', '2025-05-19 02:47:24'),
(39, '/uploads/products/05192025090011aexywcNyCHPntfAK_450_450.jpg', 'product', '2025-05-19 03:00:11', '2025-05-19 03:00:11'),
(40, '/uploads/products/051920250900110BtmeZ3xYMkNTUIJ_450_450.jpg', 'product', '2025-05-19 03:00:11', '2025-05-19 03:00:11'),
(41, '/uploads/products/05192025090012sfNdZGyLWDVtBxCn_450_450.jpg', 'product', '2025-05-19 03:00:12', '2025-05-19 03:00:12'),
(42, '/uploads/products/05192025090012pn2lUYoWTQwpXDfB_450_450.jpg', 'product', '2025-05-19 03:00:12', '2025-05-19 03:00:12'),
(43, '/uploads/products/05192025090012Oxy95ZN1d9IDaycj_450_450.jpg', 'product', '2025-05-19 03:00:12', '2025-05-19 03:00:12'),
(45, '/uploads/products/05192025090013uBw9dHq3jM341auT_450_450.png', 'product', '2025-05-19 03:00:13', '2025-05-19 03:00:13'),
(46, '/uploads/products/05192025090013dOQYKRNSqaztlqkJ_450_450.png', 'product', '2025-05-19 03:00:13', '2025-05-19 03:00:13'),
(47, '/uploads/products/05192025090101crFTKWditsZxaWrR_450_450.jpg', 'product', '2025-05-19 03:01:01', '2025-05-19 03:01:01'),
(48, '/uploads/products/05192025090102QrETCDxvHdVOQ3l7_450_450.jpg', 'product', '2025-05-19 03:01:02', '2025-05-19 03:01:02'),
(49, '/uploads/products/05192025090102G37OWgPvMujqsV34_450_450.png', 'product', '2025-05-19 03:01:02', '2025-05-19 03:01:02'),
(50, '/uploads/products/05192025090115pSc76G4UP0m03sFU_450_450.jpg', 'product', '2025-05-19 03:01:15', '2025-05-19 03:01:15'),
(51, '/uploads/products/05192025090115BNOFoSZudgBd4UA3_450_450.jpg', 'product', '2025-05-19 03:01:15', '2025-05-19 03:01:15'),
(52, '/uploads/products/05192025090115JDacuARN3lzkBZyz_450_450.png', 'product', '2025-05-19 03:01:15', '2025-05-19 03:01:15'),
(53, '/uploads/products/05192025090116W0u2sQkzexdOy4aY_450_450.png', 'product', '2025-05-19 03:01:16', '2025-05-19 03:01:16'),
(54, '/uploads/products/05192025090146NyTFoDcAxszrgUi4_450_450.jpg', 'product', '2025-05-19 03:01:46', '2025-05-19 03:01:46'),
(55, '/uploads/products/05192025090146nDMdnlmfmtUFIS3k_450_450.jpg', 'product', '2025-05-19 03:01:46', '2025-05-19 03:01:46'),
(56, '/uploads/products/05192025090146lksbOB86ZgfYw9Qx_450_450.jpg', 'product', '2025-05-19 03:01:46', '2025-05-19 03:01:46'),
(57, '/uploads/products/05192025090147pF4lZTOfSz7oePWR_450_450.png', 'product', '2025-05-19 03:01:47', '2025-05-19 03:01:47'),
(58, '/uploads/products/05192025090147K1iY0JCOpLDzt7pq_450_450.png', 'product', '2025-05-19 03:01:47', '2025-05-19 03:01:47'),
(59, '/uploads/products/05192025090147KuNQsKqmYSUohCYy_450_450.png', 'product', '2025-05-19 03:01:47', '2025-05-19 03:01:47'),
(63, '/uploads/products/05192025115305T097XExfnZnkKdl6_450_450.jpg', 'product', '2025-05-19 05:53:05', '2025-05-19 05:53:05'),
(64, '/uploads/sliders/05192025115356GQiDA6d9dAQ598bp_1440_450.jpg', 'slider', '2025-05-19 05:53:57', '2025-05-19 05:53:57'),
(65, '/uploads/sliders/05192025115357ItWoiYXU5rGQjLy0_1440_450.jfif', 'slider', '2025-05-19 05:53:57', '2025-05-19 05:53:57'),
(66, '/uploads/sliders/05192025115358kc6aQxO3AjfkFEi7_1440_450.jfif', 'slider', '2025-05-19 05:53:58', '2025-05-19 05:53:58'),
(67, '/uploads/sliders/05192025115358eIe1UGlD9snqiC6x_1440_450.jfif', 'slider', '2025-05-19 05:53:58', '2025-05-19 05:53:58'),
(68, '/uploads/sliders/05192025115359NXb6qYNibZsH20bk_1440_450.jfif', 'slider', '2025-05-19 05:53:59', '2025-05-19 05:53:59'),
(69, '/uploads/products/05192025120951dyfnUhfnO2Gd3wQs_450_450.jpg', 'product', '2025-05-19 06:09:51', '2025-05-19 06:09:51'),
(70, '/uploads/products/05192025121037ijLE2lE2gZpIjjO5_450_450.jpg', 'product', '2025-05-19 06:10:38', '2025-05-19 06:10:38'),
(71, '/uploads/products/05192025121038WJPCGH8uLH0hrS71_450_450.jpg', 'product', '2025-05-19 06:10:38', '2025-05-19 06:10:38'),
(72, '/uploads/products/05192025121038NEMg1QcsfrSPyY7z_450_450.png', 'product', '2025-05-19 06:10:39', '2025-05-19 06:10:39'),
(73, '/uploads/products/05192025121039oSVZUyeDBHVtuyUH_450_450.png', 'product', '2025-05-19 06:10:39', '2025-05-19 06:10:39'),
(74, '/uploads/products/05192025121040AHrw51OKUnhXaqbw_450_450.png', 'product', '2025-05-19 06:10:40', '2025-05-19 06:10:40'),
(75, '/uploads/products/051920251210405kWemLe08BF26tGs_450_450.jpg', 'product', '2025-05-19 06:10:40', '2025-05-19 06:10:40'),
(76, '/uploads/sliders/05192025121215fP1R2z714zTtqePA_1440_450.jfif', 'slider', '2025-05-19 06:12:15', '2025-05-19 06:12:15'),
(77, '/uploads/sliders/05192025121216KdQkrUHCClZcu4lN_1440_450.jfif', 'slider', '2025-05-19 06:12:16', '2025-05-19 06:12:16'),
(78, '/uploads/sliders/05192025121216wbtZssCdklqoPkyl_1440_450.jfif', 'slider', '2025-05-19 06:12:17', '2025-05-19 06:12:17'),
(79, '/uploads/sliders/05192025121217k3pLsxhh0Gzf5Xyk_1440_450.jfif', 'slider', '2025-05-19 06:12:17', '2025-05-19 06:12:17'),
(80, '/uploads/categories/05192025121233TyFDZWcbPmg3fmPQ_250_120.jfif', 'category', '2025-05-19 06:12:33', '2025-05-19 06:12:33'),
(81, '/uploads/sliders/05212025205836PxwLZ1WonhIDbjc6_1440_450.jpg', 'slider', '2025-05-21 14:58:37', '2025-05-21 14:58:37'),
(82, '/uploads/brands/05212025205920czPY2mLUljsS9jbC_350_350.jpg', 'brand', '2025-05-21 14:59:21', '2025-05-21 14:59:21'),
(83, '/uploads/brands/05212025205921vQapPl5qjKd2BYG8_350_350.jpg', 'brand', '2025-05-21 14:59:21', '2025-05-21 14:59:21'),
(84, '/uploads/brands/05212025205921dIR7DrQ0LJbKycwl_350_350.jpg', 'brand', '2025-05-21 14:59:22', '2025-05-21 14:59:22'),
(85, '/uploads/brands/05212025205922svU87upIxtsgKs0e_350_350.jpg', 'brand', '2025-05-21 14:59:22', '2025-05-21 14:59:22'),
(86, '/uploads/brands/052120252059229JUQJYmFZCbmFmMw_350_350.jpg', 'brand', '2025-05-21 14:59:22', '2025-05-21 14:59:22'),
(87, '/uploads/brands/052120252059232I4UVVqLJriGBA7i_350_350.jpg', 'brand', '2025-05-21 14:59:23', '2025-05-21 14:59:23'),
(88, '/uploads/brands/05212025205923eAp0OBqTqeWi0gqp_350_350.jpg', 'brand', '2025-05-21 14:59:24', '2025-05-21 14:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Lenovo', 'lenovo', '/uploads/brands/05182025092147fsSfKVl1MuS45nL5_350_350.png', 'active', '2025-05-17 21:22:06', '2025-05-17 21:22:06'),
(2, 'Acer', 'acer', '/uploads/brands/05182025094959RT3P1qJrOX3gAMTI_350_350.jpg', 'active', '2025-05-19 02:42:34', '2025-05-19 02:42:34'),
(3, 'Asus', 'asus', '/uploads/brands/05182025094959R6ehAD4r8d3BKDp1_350_350.jpg', 'active', '2025-05-19 02:42:49', '2025-05-19 02:42:49'),
(4, 'Sony', 'sony', '/uploads/brands/05182025095000fv4hPp9yBMVzwIMb_350_350.jpg', 'active', '2025-05-19 02:43:05', '2025-05-19 02:43:05'),
(5, 'Toyota', 'toyota', '/uploads/brands/05192025084335J4VWPHM4Jsdm9gB1_350_350.jpg', 'active', '2025-05-19 02:45:11', '2025-05-19 02:45:11'),
(7, 'Mitsubishi', 'mitsubishi', '/uploads/brands/05182025095000Cc39kSofDKhaFjlG_350_350.jpg', 'active', '2025-05-20 04:22:29', '2025-05-20 04:22:29'),
(8, 'Suzuki', 'suzuki', '/uploads/brands/05192025084400yCv5OTfn4VIJbV8G_350_350.jpg', 'active', '2025-05-20 04:28:53', '2025-05-20 04:28:53'),
(9, 'Dell', 'dell', '/uploads/brands/05192025084401N4PwD8CLmi7fVHGV_350_350.jpg', 'active', '2025-05-20 04:29:18', '2025-05-20 04:29:18'),
(10, 'Nissan', 'nissan', '/uploads/brands/05192025084400iHcDtnAX5fTPO4AR_350_350.jpg', 'active', '2025-05-20 04:29:51', '2025-05-20 04:29:51'),
(11, 'Apple', 'apple', '/uploads/brands/05192025084401NCBx3K6AjN5nkSnt_350_350.png', 'active', '2025-05-20 04:31:41', '2025-05-20 04:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Head Phone', 'head-phone', '/uploads/categories/05192025084723EauxhVk5LagrDTUp_250_120.png', 'active', '2025-05-19 02:48:15', '2025-05-19 02:48:15'),
(3, 'Camera', 'camera', '/uploads/categories/051920250847237I4jyIhmrSKNFUy9_250_120.jpg', 'active', '2025-05-19 02:48:32', '2025-05-19 02:48:32'),
(4, 'Doll', 'doll', '/uploads/categories/05192025084722my8ML8RdeE5qZAwS_250_120.png', 'active', '2025-05-19 02:48:49', '2025-05-19 02:48:49'),
(5, 'Beg', 'beg', '/uploads/categories/05192025084720ElCiuvVTuZxDx0eG_250_120.jpg', 'active', '2025-05-18 20:49:17', '2025-05-18 20:49:17'),
(6, 'Mobile', 'mobile', '/uploads/categories/05192025084722m50owJRK8gIyFX38_250_120.png', 'active', '2025-05-19 02:49:40', '2025-05-19 02:49:40'),
(7, 'Gent\'s shoe', 'gents-shoe', '/uploads/products/05192025121039oSVZUyeDBHVtuyUH_450_450.png', 'active', '2025-05-20 04:03:47', '2025-05-20 04:03:47'),
(8, 'Light', 'light', '/uploads/products/05192025121038NEMg1QcsfrSPyY7z_450_450.png', 'active', '2025-05-20 04:05:30', '2025-05-20 04:05:30'),
(9, 'Ladies Sweater', 'ladies-sweater', '/uploads/products/05192025121037ijLE2lE2gZpIjjO5_450_450.jpg', 'active', '2025-05-20 04:07:23', '2025-05-20 04:07:23'),
(10, 'Summer hat', 'summer-hat', '/uploads/products/05192025090147KuNQsKqmYSUohCYy_450_450.png', 'active', '2025-05-20 04:13:29', '2025-05-20 04:13:29'),
(11, 'Gent\'s Watch', 'gents-watch', '/uploads/products/05192025090147K1iY0JCOpLDzt7pq_450_450.png', 'active', '2025-05-20 04:14:08', '2025-05-20 04:14:08'),
(12, 'Ladies Watch', 'ladies-watch', '/uploads/products/05192025090102G37OWgPvMujqsV34_450_450.png', 'active', '2025-05-20 04:14:36', '2025-05-20 04:14:36'),
(13, 'Jar', 'jar', '/uploads/products/05192025090013dOQYKRNSqaztlqkJ_450_450.png', 'active', '2025-05-20 04:14:52', '2025-05-20 04:14:52'),
(17, 'Smart Phone', 'smart-phone', '/uploads/products/05192025090115pSc76G4UP0m03sFU_450_450.jpg', 'active', '2025-05-20 04:16:49', '2025-05-20 04:16:49'),
(20, 'Laptop', 'laptop', '/uploads/products/05192025090147pF4lZTOfSz7oePWR_450_450.png', 'active', '2025-05-20 04:19:56', '2025-05-20 04:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `value` double(8,2) NOT NULL DEFAULT 0.00,
  `type` enum('fixed','percent') NOT NULL DEFAULT 'fixed',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `value`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CMC-101', 100.00, 'fixed', 'active', '2025-05-19 02:54:40', '2025-05-19 02:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `division_id`, `name`, `bn_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Narsingdi', 'নরসিংদী', NULL, NULL),
(2, 1, 'Gazipur', 'গাজীপুর', NULL, NULL),
(3, 1, 'Shariatpur', 'শরীয়তপুর', NULL, NULL),
(4, 1, 'Narayanganj', 'নারায়ণগঞ্জ', NULL, NULL),
(5, 1, 'Tangail', 'টাঙ্গাইল', NULL, NULL),
(6, 1, 'Kishoreganj', 'কিশোরগঞ্জ', NULL, NULL),
(7, 1, 'Manikganj', 'মানিকগঞ্জ', NULL, NULL),
(8, 1, 'Dhaka', 'ঢাকা', NULL, NULL),
(9, 1, 'Munshiganj', 'মুন্সিগঞ্জ', NULL, NULL),
(10, 1, 'Rajbari', 'রাজবাড়ী', NULL, NULL),
(11, 1, 'Madaripur', 'মাদারীপুর', NULL, NULL),
(12, 1, 'Gopalganj', 'গোপালগঞ্জ', NULL, NULL),
(13, 1, 'Faridpur', 'ফরিদপুর', NULL, NULL),
(14, 2, 'Comilla', 'কুমিল্লা', NULL, NULL),
(15, 2, 'Feni', 'ফেনী', NULL, NULL),
(16, 2, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', NULL, NULL),
(17, 2, 'Rangamati', 'রাঙ্গামাটি', NULL, NULL),
(18, 2, 'Noakhali', 'নোয়াখালী', NULL, NULL),
(19, 2, 'Chandpur', 'চাঁদপুর', NULL, NULL),
(20, 2, 'Lakshmipur', 'লক্ষ্মীপুর', NULL, NULL),
(21, 2, 'Chittagong', 'চট্টগ্রাম', NULL, NULL),
(22, 2, 'Coxsbazar', 'কক্সবাজার', NULL, NULL),
(23, 2, 'Khagrachhari', 'খাগড়াছড়ি', NULL, NULL),
(24, 2, 'Bandarban', 'বান্দরবান', NULL, NULL),
(25, 3, 'Sirajganj', 'সিরাজগঞ্জ', NULL, NULL),
(26, 3, 'Pabna', 'পাবনা', NULL, NULL),
(27, 3, 'Bogra', 'বগুড়া', NULL, NULL),
(28, 3, 'Rajshahi', 'রাজশাহী', NULL, NULL),
(29, 3, 'Natore', 'নাটোর', NULL, NULL),
(30, 3, 'Joypurhat', 'জয়পুরহাট', NULL, NULL),
(31, 3, 'Chapainawabganj', 'চাঁপাইনবাবগঞ্জ', NULL, NULL),
(32, 3, 'Naogaon', 'নওগাঁ', NULL, NULL),
(33, 4, 'Jessore', 'যশোর', NULL, NULL),
(34, 4, 'Satkhira', 'সাতক্ষীরা', NULL, NULL),
(35, 4, 'Meherpur', 'মেহেরপুর', NULL, NULL),
(36, 4, 'Narail', 'নড়াইল', NULL, NULL),
(37, 4, 'Chuadanga', 'চুয়াডাঙ্গা', NULL, NULL),
(38, 4, 'Kushtia', 'কুষ্টিয়া', NULL, NULL),
(39, 4, 'Magura', 'মাগুরা', NULL, NULL),
(40, 4, 'Khulna', 'খুলনা', NULL, NULL),
(41, 4, 'Bagerhat', 'বাগেরহাট', NULL, NULL),
(42, 4, 'Jhenaidah', 'ঝিনাইদহ', NULL, NULL),
(43, 5, 'Jhalakathi', 'ঝালকাঠি', NULL, NULL),
(44, 5, 'Patuakhali', 'পটুয়াখালী', NULL, NULL),
(45, 5, 'Pirojpur', 'পিরোজপুর', NULL, NULL),
(46, 5, 'Barisal', 'বরিশাল', NULL, NULL),
(47, 5, 'Bhola', 'ভোলা', NULL, NULL),
(48, 5, 'Barguna', 'বরগুনা', NULL, NULL),
(49, 6, 'Panchagarh', 'পঞ্চগড়', NULL, NULL),
(50, 6, 'Dinajpur', 'দিনাজপুর', NULL, NULL),
(51, 6, 'Lalmonirhat', 'লালমনিরহাট', NULL, NULL),
(52, 6, 'Nilphamari', 'নীলফামারী', NULL, NULL),
(53, 6, 'Gaibandha', 'গাইবান্ধা', NULL, NULL),
(54, 6, 'Thakurgaon', 'ঠাকুরগাঁও', NULL, NULL),
(55, 6, 'Rangpur', 'রংপুর', NULL, NULL),
(56, 6, 'Kurigram', 'কুড়িগ্রাম', NULL, NULL),
(57, 7, 'Sylhet', 'সিলেট', NULL, NULL),
(58, 7, 'Moulvibazar', 'মৌলভীবাজার', NULL, NULL),
(59, 7, 'Habiganj', 'হবিগঞ্জ', NULL, NULL),
(60, 7, 'Sunamganj', 'সুনামগঞ্জ', NULL, NULL),
(61, 8, 'Sherpur', 'শেরপুর', NULL, NULL),
(62, 8, 'Mymensingh', 'ময়মনসিংহ', NULL, NULL),
(63, 8, 'Jamalpur', 'জামালপুর', NULL, NULL),
(64, 8, 'Netrokona', 'নেত্রকোণা', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `bn_name` varchar(191) NOT NULL,
  `charge` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `bn_name`, `charge`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 'ঢাকা', 60.00, NULL, NULL),
(2, 'Chittagong', 'চট্টগ্রাম', 100.00, NULL, NULL),
(3, 'Rajshahi', 'রাজশাহী', 100.00, NULL, NULL),
(4, 'Khulna', 'খুলনা', 100.00, NULL, NULL),
(5, 'Barisal', 'বরিশাল', 100.00, NULL, NULL),
(6, 'Rangpur', 'রংপুর', 100.00, NULL, NULL),
(7, 'Sylhet', 'সিলেট', 100.00, NULL, NULL),
(8, 'Mymensingh', 'ময়মনসিংহ', 100.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2022_02_17_051650_create_admins_table', 1),
(11, '2022_02_27_095748_create_sellers_table', 1),
(12, '2022_02_27_095920_create_sliders_table', 1),
(13, '2022_02_28_032530_create_brands_table', 1),
(14, '2022_02_28_032936_create_categories_table', 1),
(15, '2022_02_28_033121_create_subcategories_table', 1),
(16, '2022_02_28_033231_create_colors_table', 1),
(17, '2022_02_28_033304_create_sizes_table', 1),
(18, '2022_02_28_034238_create_shops_table', 1),
(19, '2022_02_28_035238_create_products_table', 1),
(20, '2022_03_13_111342_create_product_users_table', 1),
(21, '2022_05_13_161406_create_seller_file_systems_table', 1),
(22, '2022_05_13_161522_create_admin_file_systems_table', 1),
(23, '2022_05_19_093817_create_coupons_table', 1),
(24, '2022_05_21_124646_create_divisions_table', 1),
(25, '2022_05_21_124727_create_districts_table', 1),
(26, '2022_06_06_191101_create_orders_table', 1),
(27, '2022_06_06_191156_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('5271e7bb563e204749de933fb9dee26d411a234652cc057291b77f69c206f2938b6bdc942642eb20', 1, 1, 'adminToken', '[\"admin\"]', 0, '2025-05-19 02:40:03', '2025-05-19 02:40:03', '2026-05-19 08:40:03'),
('fb460843f27fc18f3761aecb5cff0ac2ee3640baeafd1b5cad479995d4cf9075a88485539ec46f44', 1, 1, 'adminToken', '[\"admin\"]', 0, '2025-05-21 14:50:56', '2025-05-21 14:50:56', '2026-05-21 20:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(191) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'ufTPM9QVsDYsqtijqoI31bCJI10zKH5RxP16DvPe', NULL, 'http://localhost', 1, 0, 0, '2025-05-10 12:07:07', '2025-05-10 12:07:07'),
(2, NULL, 'Laravel Password Grant Client', '4v7jAxdk86VKQZXsK1JouZZUcQ9IhaOPfXGL9OgG', 'users', 'http://localhost', 0, 1, 0, '2025-05-10 12:07:07', '2025-05-10 12:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-05-10 12:07:07', '2025-05-10 12:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` int(11) DEFAULT NULL,
  `shipping_address` varchar(191) NOT NULL,
  `payment_type` varchar(20) NOT NULL DEFAULT 'cash',
  `subtotal` double(8,2) NOT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `charges` double(8,2) DEFAULT 0.00,
  `total` double(8,2) NOT NULL,
  `status` enum('pending','confirmed','delivered') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `thumbnail` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `price` double(8,2) NOT NULL DEFAULT 0.00,
  `discount` int(11) NOT NULL DEFAULT 0,
  `size` varchar(191) DEFAULT NULL,
  `color` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sale` tinyint(1) NOT NULL DEFAULT 0,
  `conditions` enum('new','popular','winter','feature') NOT NULL DEFAULT 'new',
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `added_by` enum('seller','admin') NOT NULL DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `seller_id`, `brand_id`, `category_id`, `subcategory_id`, `name`, `slug`, `thumbnail`, `image`, `price`, `discount`, `size`, `color`, `description`, `stock`, `sale`, `conditions`, `status`, `added_by`, `created_at`, `updated_at`) VALUES
(1, NULL, 5, 4, 8, 'Baby Frock', 'baby-frock', '/uploads/products/05192025090012pn2lUYoWTQwpXDfB_450_450.jpg', '[\"\\/uploads\\/products\\/05192025090102QrETCDxvHdVOQ3l7_450_450.jpg\",\"\\/uploads\\/products\\/05192025090012pn2lUYoWTQwpXDfB_450_450.jpg\",\"\\/uploads\\/products\\/05192025090012Oxy95ZN1d9IDaycj_450_450.jpg\"]', 750.00, 10, '[]', '[]', '<p>This is our latest collection of Baby Frock. You can Buy from us with exclusive design &amp; price. </p>', 10, 0, 'new', 'active', 'admin', '2025-05-19 03:06:03', '2025-05-19 03:06:03'),
(2, NULL, 4, 5, 4, 'School Beg', 'school-beg', '/uploads/products/05192025090101crFTKWditsZxaWrR_450_450.jpg', '[\"\\/uploads\\/products\\/05192025090101crFTKWditsZxaWrR_450_450.jpg\"]', 1200.00, 20, '[]', '[]', '<p>This is our Latest collection of School, College, University Beg.</p>', 15, 0, 'popular', 'active', 'admin', '2025-05-19 03:08:54', '2025-05-19 03:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_user`
--

CREATE TABLE `product_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `shop_name` varchar(191) DEFAULT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `banner` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `address` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `isVerified` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('open','closed') NOT NULL DEFAULT 'closed',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `shop_name`, `slug`, `image`, `banner`, `phone`, `email`, `address`, `email_verified_at`, `password`, `isVerified`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Seller', NULL, NULL, NULL, NULL, '01812852822', 'seller@gmail.com', NULL, NULL, '$2y$10$HIiOTqFRAkh4evFzVLaWuOW0vSc8z/OGLKElYIRESS8LOx/pZS8r6', 1, 'closed', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seller_file_systems`
--

CREATE TABLE `seller_file_systems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `url` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `followers` bigint(20) DEFAULT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'closed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(4, '/uploads/products/05192025121038WJPCGH8uLH0hrS71_450_450.jpg', 'active', '2025-05-19 06:11:20', '2025-05-19 06:11:20'),
(5, '/uploads/sliders/05192025115357ItWoiYXU5rGQjLy0_1440_450.jfif', 'active', '2025-05-20 04:32:20', '2025-05-20 04:32:20'),
(9, '/uploads/sliders/05192025115358eIe1UGlD9snqiC6x_1440_450.jfif', 'active', '2025-05-20 04:33:44', '2025-05-20 04:33:44'),
(10, '/uploads/sliders/05192025121216KdQkrUHCClZcu4lN_1440_450.jfif', 'active', '2025-05-20 04:34:48', '2025-05-20 04:34:48'),
(11, '/uploads/sliders/05192025121217k3pLsxhh0Gzf5Xyk_1440_450.jfif', 'active', '2025-05-20 04:35:04', '2025-05-20 04:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 'Samsun-Galaxy', 'samsun-galaxy', 'active', '2025-05-19 02:50:19', '2025-05-19 02:50:19'),
(2, 6, 'I-Phone', 'i-phone', 'active', '2025-05-19 02:51:21', '2025-05-19 02:51:21'),
(3, 6, 'Nokia-UP', 'nokia-up', 'active', '2025-05-19 02:51:21', '2025-05-19 02:51:21'),
(4, 5, 'School Beg', 'school-beg', 'active', '2025-05-19 02:52:20', '2025-05-19 02:52:20'),
(5, 5, 'College Beg', 'college-beg', 'active', '2025-05-19 02:52:20', '2025-05-19 02:52:20'),
(6, 5, 'Ladies Bag', 'ladies-bag', 'active', '2025-05-18 20:52:20', '2025-05-18 20:52:20'),
(7, 4, 'Small Doll', 'small-doll', 'active', '2025-05-19 02:53:09', '2025-05-19 02:53:09'),
(8, 4, 'Big Doll', 'big-doll', 'active', '2025-05-19 02:53:09', '2025-05-19 02:53:09'),
(9, 3, 'DSLR Camera', 'dslr-camera', 'active', '2025-05-19 02:53:31', '2025-05-19 02:53:31'),
(10, 2, 'Neck Ben', 'neck-ben', 'active', '2025-05-19 02:53:47', '2025-05-19 02:53:47'),
(11, 2, 'warless Headphone', 'warless-headphone', 'active', '2025-05-19 02:53:47', '2025-05-19 02:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `isVerified` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(191) NOT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `phone`, `email`, `email_verified_at`, `isVerified`, `password`, `division_id`, `district_id`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', NULL, '01881514131', 'user@gmail.com', NULL, 1, '$2y$10$e0BfFEPlQZMoBAi4J924vOC1dYMXMrWdd0GJKAhQ8NGHf5FF3L3i6', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`);

--
-- Indexes for table `admin_file_systems`
--
ALTER TABLE `admin_file_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_user`
--
ALTER TABLE `product_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sellers_email_unique` (`email`),
  ADD UNIQUE KEY `sellers_phone_unique` (`phone`);

--
-- Indexes for table `seller_file_systems`
--
ALTER TABLE `seller_file_systems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shops_name_unique` (`name`),
  ADD UNIQUE KEY `shops_slug_unique` (`slug`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategories_name_unique` (`name`),
  ADD UNIQUE KEY `subcategories_slug_unique` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_file_systems`
--
ALTER TABLE `admin_file_systems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_user`
--
ALTER TABLE `product_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seller_file_systems`
--
ALTER TABLE `seller_file_systems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
