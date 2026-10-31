-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2026 at 03:15 AM
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
-- Database: `vizit_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_page_settings`
--

CREATE TABLE `about_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sections`)),
  `section_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`section_order`)),
  `page_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`page_styles`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_page_settings`
--

INSERT INTO `about_page_settings` (`id`, `seo_title`, `seo_description`, `sections`, `section_order`, `page_styles`, `content`, `created_at`, `updated_at`) VALUES
(1, 'About Us - Vizit Hotel & Suites | Our Story', 'Learn about Vizit Hotel & Suites commitment to excellence in hospitality. Discover our story, values, and dedication to providing exceptional guest experiences in Benin city.', '\"{\\\"hero\\\":true,\\\"video\\\":true,\\\"services\\\":true,\\\"features\\\":true,\\\"testimonials\\\":true}\"', '\"[\\\"hero\\\",\\\"video\\\",\\\"services\\\",\\\"features\\\",\\\"testimonials\\\"]\"', NULL, '{\"hero_title\":\"Our Story\",\"video_subtitle\":\"A Legacy of Excellence\",\"video_duration\":\"our story, 3:15 min\",\"about_services_count\":3,\"about_services_subtitle\":\"why choose us\",\"about_services_title\":\"Exceptional Hospitality\",\"about_service1_title\":\"Welcome Experience\",\"about_service1_text\":\"From the moment you arrive, our dedicated team ensures a warm Nigerian welcome. Complimentary drinks, swift check-in, and personalized attention set the tone for your stay.\",\"about_service1_button\":\"read more\",\"about_service1_link\":\"\\/services\",\"about_service2_title\":\"Premium Facilities\",\"about_service2_text\":\"Our world-class swimming pool provide everything you need for relaxation and rejuvenation during your stay.\",\"about_service2_button\":\"read more\",\"about_service2_link\":\"\\/services\",\"about_service3_title\":\"Culinary Excellence\",\"about_service3_text\":\"Our restaurants serve a fusion of Nigerian delicacies and international cuisine. All meals are prepared with fresh, locally-sourced ingredients by our award-winning chefs.\",\"about_service3_button\":\"read more\",\"about_service3_link\":\"\\/restaurant\",\"feature1_label\":\"Rosewood Suite\",\"feature1_title\":\"\\u20a685,000\",\"feature1_text\":\"The pinnacle of luxury with separate living area \\/ meeting area, featuring a premium bedding and stunning city views, memory foam mattresses, and luxury pillows for the ultimate sleep experience.\",\"feature2_label\":\"The Monarch\",\"feature2_title\":\"\\u20a6128,000\",\"feature2_text\":\"The Perfect comfort for family featuring double bed, Nice views. Perfect for Family getaway and special occasions.\",\"about_quotes_count\":2,\"about_quote1_text\":\"Vizit Hotel & Suites represents the best of Nigerian hospitality. The staff\'s attention to detail and genuine warmth made my business trip feel like a vacation.\",\"about_quote1_author\":\"Ambassador James Oluwole\",\"about_quote2_text\":\"I\'ve been coming here for years and the consistency in quality is remarkable. The rooms are always immaculate, and the food never disappoints. Highly recommended!\",\"about_quote2_author\":\"Senator Patricia Nwosu\",\"feature1_button\":\"check availability\",\"feature2_button\":\"check availability\",\"about_feature1_label\":\"from \\u20a685,000\",\"about_feature1_title\":\"Rosewood Suite\",\"about_feature1_text\":\"The pinnacle of luxury with separate living area \\/ meeting area, featuring a premium bedding and stunning city views, memory foam mattresses, and luxury pillows for the ultimate sleep experience.\",\"about_feature1_button\":\"check availability\",\"about_feature1_link\":\"\\/search\",\"about_feature2_label\":\"from \\u20a6128,000\",\"about_feature2_title\":\"The Monarch\",\"about_feature2_text\":\"The Perfect comfort for family featuring double bed, Nice views. Perfect for Family getaway and special occasions.\",\"about_feature2_button\":\"check availability\",\"about_feature2_link\":\"\\/search\",\"about_grid_services_count\":3,\"about_grid_service1_title\":\"Restaurant\",\"about_grid_service1_link\":\"\\/restaurant\",\"about_grid_service2_title\":\"Swimming Pool\",\"about_grid_service2_link\":\"\\/services\",\"about_grid_service3_title\":\"Bar & Lounge\",\"about_grid_service3_link\":\"\\/services\"}', '2026-01-14 21:00:02', '2026-01-14 23:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `bar_menus`
--

CREATE TABLE `bar_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` enum('beer','wine','spirits','cocktail','mocktail','soft_drink','coffee','tea') NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ingredients` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ingredients`)),
  `alcohol_content` decimal(5,2) DEFAULT NULL,
  `serving_size` varchar(255) DEFAULT NULL,
  `is_alcoholic` tinyint(1) NOT NULL DEFAULT 0,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `cost_price` decimal(8,2) DEFAULT NULL,
  `preparation_notes` text DEFAULT NULL,
  `preparation_time` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bar_menus`
--

INSERT INTO `bar_menus` (`id`, `name`, `description`, `category`, `price`, `image`, `ingredients`, `alcohol_content`, `serving_size`, `is_alcoholic`, `is_available`, `is_featured`, `sort_order`, `cost_price`, `preparation_notes`, `preparation_time`, `created_at`, `updated_at`) VALUES
(1, 'Water', NULL, 'soft_drink', 800.00, NULL, NULL, NULL, NULL, 0, 1, 0, 1, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(2, 'Fresh Juice', NULL, 'soft_drink', 3000.00, NULL, NULL, NULL, NULL, 0, 1, 0, 2, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(3, 'Amstel Malt', NULL, 'soft_drink', 2000.00, NULL, NULL, NULL, NULL, 0, 1, 0, 3, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(4, 'Malta Guinness', NULL, 'soft_drink', 2000.00, NULL, NULL, NULL, NULL, 0, 1, 0, 4, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(5, 'Hollandia', NULL, 'soft_drink', 3500.00, NULL, NULL, NULL, NULL, 0, 1, 0, 5, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(6, 'Chi-Exotic', NULL, 'soft_drink', 3500.00, NULL, NULL, NULL, NULL, 0, 1, 0, 6, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(7, 'Chi-Active', NULL, 'soft_drink', 3500.00, NULL, NULL, NULL, NULL, 0, 1, 0, 7, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(8, 'Vitamilk', NULL, 'soft_drink', 3500.00, NULL, NULL, NULL, NULL, 0, 1, 0, 8, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(9, 'Foyrous', NULL, 'soft_drink', 1000.00, NULL, NULL, NULL, NULL, 0, 1, 0, 9, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(10, 'Soda (Coke, Fanta, Sprite)', NULL, 'soft_drink', 1000.00, NULL, NULL, NULL, NULL, 0, 1, 0, 10, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(11, 'Fearless', 'Energy drink', 'soft_drink', 1500.00, NULL, NULL, NULL, NULL, 0, 1, 0, 11, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(12, 'Predator', 'Energy drink', 'soft_drink', 1500.00, NULL, NULL, NULL, NULL, 0, 1, 0, 12, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(13, 'Monster', 'Energy drink', 'soft_drink', 2500.00, NULL, NULL, NULL, NULL, 0, 1, 0, 13, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(14, 'Power Horse', 'Energy drink', 'soft_drink', 2500.00, NULL, NULL, NULL, NULL, 0, 1, 0, 14, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(15, 'Red Bull', 'Energy drink', 'soft_drink', 2500.00, NULL, NULL, NULL, NULL, 0, 1, 0, 15, NULL, NULL, NULL, '2026-01-14 23:28:02', '2026-01-14 23:28:02'),
(16, 'Blue Bullet', 'Energy drink', 'soft_drink', 2500.00, NULL, NULL, NULL, NULL, 0, 1, 0, 16, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(17, 'Black Bullet', 'Energy drink', 'soft_drink', 3000.00, NULL, NULL, NULL, NULL, 0, 1, 0, 17, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(18, 'Double Black', 'Energy drink', 'soft_drink', 2500.00, NULL, NULL, NULL, NULL, 0, 1, 0, 18, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(19, 'Origin Bitters', 'Herbal bitters', 'soft_drink', 3000.00, NULL, NULL, NULL, NULL, 0, 1, 0, 19, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(20, 'Heineken (Medium)', NULL, 'beer', 2500.00, NULL, NULL, NULL, '330ml', 1, 1, 0, 20, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(21, 'Heineken (Large)', NULL, 'beer', 3000.00, NULL, NULL, NULL, '600ml', 1, 1, 0, 21, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(22, '\"33\" Export', NULL, 'beer', 2500.00, NULL, NULL, NULL, NULL, 1, 1, 0, 22, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(23, 'Goldberg', NULL, 'beer', 2500.00, NULL, NULL, NULL, NULL, 1, 1, 0, 23, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(24, 'Goldberg Black', NULL, 'beer', 3000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 24, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(25, 'Stout (Medium)', NULL, 'beer', 2500.00, NULL, NULL, NULL, NULL, 1, 1, 0, 25, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(26, 'Smirnoff Ice (Big)', NULL, 'beer', 3500.00, NULL, NULL, NULL, NULL, 1, 1, 0, 26, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(27, 'Trophy', NULL, 'beer', 2500.00, NULL, NULL, NULL, NULL, 1, 1, 0, 27, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(28, 'Hero', NULL, 'beer', 2500.00, NULL, NULL, NULL, NULL, 1, 1, 0, 28, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(29, 'Big Williams', NULL, 'beer', 3000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 29, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(30, 'Gulder', NULL, 'beer', 2500.00, NULL, NULL, NULL, NULL, 1, 1, 0, 30, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(31, 'Tiger', NULL, 'beer', 2000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 31, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(32, 'Desperado', NULL, 'beer', 2500.00, NULL, NULL, NULL, NULL, 1, 1, 0, 32, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(33, 'Star Radler', NULL, 'beer', 2500.00, NULL, NULL, NULL, NULL, 1, 1, 0, 33, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(34, 'Andre', 'Sparkling wine', 'wine', 30000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 34, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(35, 'Martini Rose', 'Rosé wine', 'wine', 30000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 35, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(36, 'Baron De Valls', NULL, 'wine', 20000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 36, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(37, 'Four Cousin', NULL, 'wine', 20000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 37, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(38, 'Carlo Rossi', NULL, 'wine', 20000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 38, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(39, 'Friends & Family', NULL, 'wine', 20000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 39, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(40, 'Agor', NULL, 'wine', 20000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 40, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(41, 'Drevnii Monah', NULL, 'wine', 25000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 41, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(42, 'Small Best Cream', 'Cream liqueur', 'spirits', 5000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 42, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(43, 'Small William Lawson', 'Scotch whisky', 'spirits', 10000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 43, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(44, 'Big William Lawson', 'Scotch whisky', 'spirits', 35000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 44, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(45, 'Small Campari', 'Italian aperitif', 'spirits', 12000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 45, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(46, 'Big Campari', 'Italian aperitif', 'spirits', 45000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 46, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(47, 'Omelca Tequila', 'Premium tequila', 'spirits', 55000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 47, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(48, 'Small Smirnoff Vodka', NULL, 'spirits', 5000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 48, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(49, 'Big Smirnoff Vodka', NULL, 'spirits', 15000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 49, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(50, 'Jagermeister', 'German herbal liqueur', 'spirits', 30000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 50, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(51, 'Jameson Green', 'Irish whiskey', 'spirits', 45000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 51, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(52, 'Jameson Black', 'Irish whiskey - Premium', 'spirits', 75000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 52, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(53, 'Black Label', 'Johnnie Walker Scotch whisky', 'spirits', 75000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 53, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(54, 'Martell VS', 'Cognac', 'spirits', 120000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 54, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(55, 'Martell Blue Swift', 'Cognac - Premium', 'spirits', 170000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 55, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(56, 'Hennessey VS', 'Cognac', 'spirits', 80000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 56, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(57, 'Hennessey VSOP', 'Cognac - Premium', 'spirits', 160000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 57, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(58, 'Glenfiddich 12YRS', 'Single malt Scotch whisky - 12 Years', 'spirits', 130000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 58, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(59, 'Glenfiddich 15YRS', 'Single malt Scotch whisky - 15 Years', 'spirits', 160000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 59, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(60, 'Glenfiddich 18YRS', 'Single malt Scotch whisky - 18 Years', 'spirits', 250000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 60, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(61, 'Blue Lagoon', 'Vodka-based cocktail with blue curaçao', 'cocktail', 6000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 61, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(62, 'Margarita', 'Classic tequila cocktail', 'cocktail', 8000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 62, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(63, 'Tequila Sunrise', 'Tequila with orange juice and grenadine', 'cocktail', 6000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 63, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(64, 'Pina Colada', 'Rum with coconut and pineapple', 'cocktail', 8000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 64, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(65, 'Screwdriver', 'Vodka with orange juice', 'cocktail', 6000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 65, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(66, 'Blue Haven', 'Tropical blue cocktail', 'cocktail', 8000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 66, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(67, 'Sex on the Beach', 'Vodka, peach schnapps, orange and cranberry', 'cocktail', 8000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 67, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(68, 'Wet Pussy', 'Sweet layered shot', 'cocktail', 8000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 68, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(69, 'Long Island Iced Tea', 'Mixed spirits cocktail', 'cocktail', 8000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 69, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(70, 'Alcoholic Chapman', 'Nigerian cocktail with spirits', 'cocktail', 8000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 70, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03'),
(71, 'Non-Alcoholic Chapman', 'Classic Nigerian mocktail with Fanta, Sprite, and bitters', 'mocktail', 5000.00, NULL, NULL, NULL, NULL, 0, 1, 0, 71, NULL, NULL, NULL, '2026-01-14 23:28:03', '2026-01-14 23:28:03');

-- --------------------------------------------------------

--
-- Table structure for table `bar_orders`
--

CREATE TABLE `bar_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bar_order_items`
--

CREATE TABLE `bar_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_number` varchar(255) NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `check_in_time` time NOT NULL DEFAULT '14:00:00',
  `check_out_time` time NOT NULL DEFAULT '11:00:00',
  `adults` int(11) NOT NULL DEFAULT 1,
  `children` int(11) NOT NULL DEFAULT 0,
  `nights` int(11) NOT NULL,
  `booking_type` enum('daily','weekly','monthly') NOT NULL,
  `status` enum('pending','confirmed','checked_in','checked_out','cancelled','no_show') NOT NULL DEFAULT 'pending',
  `room_rate` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `service_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` enum('pending','partial','paid','refunded') NOT NULL DEFAULT 'pending',
  `special_requests` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `checked_in_at` timestamp NULL DEFAULT NULL,
  `checked_out_at` timestamp NULL DEFAULT NULL,
  `checked_in_by` bigint(20) UNSIGNED DEFAULT NULL,
  `checked_out_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cancellation_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('vizit-hotel-suites-cache-admin@vermon.com|127.0.0.1', 'i:1;', 1768561072),
('vizit-hotel-suites-cache-admin@vermon.com|127.0.0.1:timer', 'i:1768561072;', 1768561072),
('vizit-hotel-suites-cache-admin@vermonhotel.com|127.0.0.1', 'i:3;', 1768611764),
('vizit-hotel-suites-cache-admin@vermonhotel.com|127.0.0.1:timer', 'i:1768611764;', 1768611764);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalog_settings`
--

CREATE TABLE `catalog_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `display_mode` enum('grid','list','compact') NOT NULL DEFAULT 'grid',
  `items_per_row` int(11) NOT NULL DEFAULT 3,
  `show_images` tinyint(1) NOT NULL DEFAULT 1,
  `show_descriptions` tinyint(1) NOT NULL DEFAULT 1,
  `show_prices` tinyint(1) NOT NULL DEFAULT 1,
  `show_featured_badge` tinyint(1) NOT NULL DEFAULT 1,
  `show_item_count` tinyint(1) NOT NULL DEFAULT 1,
  `default_tab` enum('drinks','food','rooms') NOT NULL DEFAULT 'drinks',
  `show_drinks_section` tinyint(1) NOT NULL DEFAULT 1,
  `show_food_section` tinyint(1) NOT NULL DEFAULT 1,
  `show_rooms_section` tinyint(1) NOT NULL DEFAULT 1,
  `show_qrcode_tab` tinyint(1) NOT NULL DEFAULT 1,
  `tagline` varchar(255) DEFAULT NULL,
  `show_contact_bar` tinyint(1) NOT NULL DEFAULT 1,
  `show_phone` tinyint(1) NOT NULL DEFAULT 1,
  `show_email` tinyint(1) NOT NULL DEFAULT 1,
  `show_address` tinyint(1) NOT NULL DEFAULT 1,
  `show_website` tinyint(1) NOT NULL DEFAULT 1,
  `primary_color` varchar(7) NOT NULL DEFAULT '#b59f6a',
  `background_color` varchar(7) NOT NULL DEFAULT '#1a1a2e',
  `card_bg_color` varchar(7) NOT NULL DEFAULT '#16213e',
  `text_color` varchar(7) NOT NULL DEFAULT '#eeeeee',
  `muted_text_color` varchar(7) NOT NULL DEFAULT '#aaaaaa',
  `price_color` varchar(7) DEFAULT NULL,
  `show_footer` tinyint(1) NOT NULL DEFAULT 1,
  `show_back_button` tinyint(1) NOT NULL DEFAULT 1,
  `custom_css` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalog_settings`
--

INSERT INTO `catalog_settings` (`id`, `display_mode`, `items_per_row`, `show_images`, `show_descriptions`, `show_prices`, `show_featured_badge`, `show_item_count`, `default_tab`, `show_drinks_section`, `show_food_section`, `show_rooms_section`, `show_qrcode_tab`, `tagline`, `show_contact_bar`, `show_phone`, `show_email`, `show_address`, `show_website`, `primary_color`, `background_color`, `card_bg_color`, `text_color`, `muted_text_color`, `price_color`, `show_footer`, `show_back_button`, `custom_css`, `created_at`, `updated_at`) VALUES
(1, 'list', 3, 1, 1, 1, 1, 1, 'drinks', 1, 1, 1, 1, 'Enjoy exceptional dining at Vizit Hotel & Suites. Our restaurants serve authentic Nigerian cuisine and international dishes prepared by expert chefs', 1, 1, 1, 1, 1, '#b59f6a', '#1a1a2e', '#16213e', '#eeeeee', '#aaaaaa', '#b59f6a', 1, 1, NULL, '2026-01-14 21:33:07', '2026-01-14 23:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `contact_page_settings`
--

CREATE TABLE `contact_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sections`)),
  `section_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`section_order`)),
  `page_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`page_styles`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_page_settings`
--

INSERT INTO `contact_page_settings` (`id`, `seo_title`, `seo_description`, `sections`, `section_order`, `page_styles`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Contact Us - Vizit Hotel & Suites', 'Get in touch with Vizit Hotel & Suites. Contact us for reservations, inquiries, or to plan your perfect stay in benin city, edo state Nigeria.', '\"{\\\"hero\\\":true,\\\"video\\\":true,\\\"form\\\":true,\\\"info\\\":true}\"', '\"[\\\"hero\\\",\\\"video\\\",\\\"form\\\",\\\"info\\\"]\"', NULL, '{\"hero_title\":\"Contact Us\",\"video_tagline\":\"We\'re Here to Help\",\"video_label\":\"contact overview, 1:30 min\",\"form_subtitle\":\"reach out to us\",\"form_title\":\"Send Us a Message\",\"info_address\":\"2 Namuna street off godwin abbe way limit sapele road Benin city, Edo, Nigeria\",\"info_city\":\"Benin city, Edo state\",\"info_phone\":\"+234 816 325 9205\",\"info_email\":\"reservations@Vizithotel&suites.com\",\"info_check_in\":\"2:00 PM\",\"info_check_out\":\"12:00 PM\",\"info_hours\":\"24 Hours Daily\",\"newsletter_button\":\"subscribe now\"}', '2026-01-14 21:01:27', '2026-01-14 23:05:46');

-- --------------------------------------------------------

--
-- Table structure for table `explore_page_settings`
--

CREATE TABLE `explore_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sections`)),
  `section_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`section_order`)),
  `page_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`page_styles`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `explore_page_settings`
--

INSERT INTO `explore_page_settings` (`id`, `seo_title`, `seo_description`, `sections`, `section_order`, `page_styles`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Gallery - Vizit Hotel & Suites', 'View photos of Vizit Hotel & Suites including our spacious rooms, restaurant, pool, bar, and facilities. See why we\'re Benin\'s premier hotel.', '{\"hero\":{\"visible\":true},\"intro\":{\"visible\":true},\"features\":{\"visible\":true},\"rooms\":{\"visible\":true}}', '[\"hero\",\"intro\",\"features\",\"rooms\"]', '{\"background_color\":\"\",\"text_color\":\"\",\"heading_color\":\"\",\"accent_color\":\"\",\"background_image\":\"\",\"custom_css\":\"\"}', '{\"hero_title\":\"Our Gallery\"}', '2026-01-14 22:58:24', '2026-01-14 23:44:44');

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
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `image_url`, `caption`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'uploads/1768432545_1.png', NULL, 0, 1, '2026-01-14 23:15:46', '2026-01-14 23:15:46'),
(2, 'uploads/1768432891_3.png', NULL, 0, 1, '2026-01-14 23:21:32', '2026-01-14 23:21:32'),
(3, 'uploads/1768432896_1.png', NULL, 0, 1, '2026-01-14 23:21:37', '2026-01-14 23:21:37'),
(4, 'uploads/1768432901_1.png', NULL, 0, 1, '2026-01-14 23:21:42', '2026-01-14 23:21:42'),
(5, 'uploads/1768432907_photo-1604964432806-254d07c11f32.jpeg', NULL, 0, 1, '2026-01-14 23:21:48', '2026-01-14 23:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `emergency_contact_phone` varchar(255) DEFAULT NULL,
  `special_requests` text DEFAULT NULL,
  `preferences` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`preferences`)),
  `is_vip` tinyint(1) NOT NULL DEFAULT 0,
  `is_blacklisted` tinyint(1) NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_page_settings`
--

CREATE TABLE `home_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sections`)),
  `section_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`section_order`)),
  `page_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`page_styles`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_settings`
--

INSERT INTO `home_page_settings` (`id`, `seo_title`, `seo_description`, `sections`, `section_order`, `page_styles`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Vizit Hotel & Suites - Luxury Accommodation in Benin city, Edo State Nigeria', 'Experience unparalleled luxury at Vizit Hotel & Suites in Benin city, Edo State. Premium rooms, exquisite dining, refreshing pool, and world-class bar services await you.', '{\"hero\":{\"visible\":true},\"intro\":{\"visible\":true},\"features\":true,\"services\":true,\"amenities\":true,\"rooms\":{\"visible\":true},\"testimonials\":true,\"video\":{\"visible\":true},\"restaurants\":{\"visible\":true},\"booking_bar\":{\"visible\":false},\"features_pair\":{\"visible\":true},\"services_grid\":{\"visible\":true},\"features_grid\":{\"visible\":true},\"parallax_cta\":{\"visible\":true},\"quotes\":{\"visible\":true}}', '[\"hero\",\"booking_bar\",\"intro\",\"features_grid\",\"features_pair\",\"services_grid\",\"parallax_cta\",\"rooms\",\"quotes\",\"video\",\"restaurants\"]', '[]', '{\"seo_title\":\"Vizit Hotel & Suites - Luxury Accommodation in Benin city, Edo State Nigeria\",\"seo_description\":\"Experience unparalleled luxury at Vizit Hotel & Suites in Benin city, Edo State. Premium rooms, exquisite dining, refreshing pool, and world-class bar services await you.\",\"hero_title\":\"Vizit Hotel & Suites <br>Experience True Luxury\",\"intro_subtitle\":\"Vizit Hotel & Suites\",\"intro_title\":\"Welcome to a World of Elegance\",\"intro_text\":\"Nestled in the vibrant heart of Benin City, Edo state, Vizit Hotel & Suites redefines luxury hospitality in Nigeria. Our establishment combines sophisticated accommodation with exceptional dining and entertainment, creating an unforgettable experience for business and leisure travelers alike. From our meticulously designed rooms to our world-class restaurant and bar, every detail is crafted to exceed your expectations.\",\"amenities_subtitle\":\"premium amenities\",\"amenities_title\":\"Luxury at Every Turn\",\"rooms_subtitle\":\"accommodation\",\"rooms_title\":\"Our Premium Rooms\",\"booking_button_text\":\"book now\",\"booking_button_link\":\"\\/search\",\"feature1_label\":\"Pearl Room\",\"feature1_title\":\"Pearl Room\",\"feature1_button_text\":\"check availability\",\"feature1_text\":\"Comfortable and well-equipped room offering excellent value. Features all essential amenities for a pleasant stay.\\r\\nFeature 1 Button Text: check availability\",\"feature1_button_link\":\"\\/search\",\"feature2_label\":\"Crest Room\",\"feature2_title\":\"Crest Room\",\"feature2_button_text\":\"check availability\",\"feature2_text\":\"Our Crest Rooms offer the perfect balance of comfort and style. Enjoy modern amenities, plush furnishings, and thoughtful touches that make your stay memorable. Ideal for both business and leisure travelers.\\r\\nFeature 2 Button Text: check availability\",\"feature2_button_link\":\"\\/search\",\"service1_title\":\"Restaurant\",\"service1_link\":\"\\/services\",\"service2_title\":\"Swimming Pool\",\"service2_link\":\"\\/services\",\"service3_title\":\"Bar & Lounge\",\"service3_link\":\"\\/services\",\"features_grid_subtitle\":\"premium amenities\",\"features_grid_title\":\"Luxury at Every Turn\",\"amenity1_title\":\"Airport Transfer\",\"amenity1_button\":\"read more\",\"amenity1_link\":\"\\/services\",\"amenity1_text\":\"Complimentary airport pickup and drop-off services available for all guests. Our professional drivers ensure a comfortable journey.\",\"amenity2_title\":\"Welcome Drinks\",\"amenity2_button\":\"read more\",\"amenity2_link\":\"\\/services\",\"amenity2_text\":\"Start your stay with a refreshing complimentary welcome drink served upon arrival. Choose from our selection of fresh juices, cocktails, or premium beverages.\",\"amenity3_title\":\"Swimming Pool\",\"amenity3_button\":\"read more\",\"amenity3_link\":\"\\/services\",\"amenity3_text\":\"Dive into relaxation at our stunning rooftop swimming pool. Enjoy panoramic city views, poolside service, and a refreshing escape tropical heat.\",\"amenity4_title\":\"Breakfast Included\",\"amenity4_button\":\"read more\",\"amenity4_link\":\"\\/services\",\"amenity4_text\":\"Wake up to a complimentary breakfast featuring Nigerian and continental options. Fresh fruits, pastries, hot dishes, and premium coffee await you each morning.\",\"amenity5_title\":\"swimming pool\",\"amenity5_button\":\"read more\",\"amenity5_link\":\"\\/services\",\"amenity5_text\":\"Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.\",\"amenity6_title\":\"food included\",\"amenity6_button\":\"read more\",\"amenity6_link\":\"\\/services\",\"amenity6_text\":\"Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.\",\"parallax_cta_button_text\":\"book now\",\"parallax_cta_button_link\":\"\\/search\",\"room1_name\":\"Pearl Room\",\"room1_type\":\"Standard Room\",\"room1_price\":\"book from \\u20a643,500\",\"room1_link\":\"\\/search\",\"room1_text\":\"Comfortable and well-equipped room offering excellent value. Features all essential amenities for a pleasant stay.\",\"room2_name\":\"Crest Room\",\"room2_type\":\"Deluxe Room\",\"room2_price\":\"book from \\u20a660,000\",\"room2_link\":\"\\/search\",\"room2_text\":\"Our Crest Rooms offer the perfect balance of comfort and style. Enjoy modern amenities, plush furnishings, and thoughtful touches that make your stay memorable. Ideal for both business and leisure travelers.\",\"room3_name\":\"Royal Crest Room\",\"room3_type\":\"Premium Room\",\"room3_price\":\"book from \\u20a665,000\",\"room3_link\":\"\\/search\",\"room3_text\":\"Rest peacefully on our premium king-sized beds featuring Egyptian cotton linens, memory foam mattresses, and luxury pillows for the ultimate sleep experience.\",\"room4_name\":\"Rosewood Suite\",\"room4_type\":\"Luxury Suite\",\"room4_price\":\"book from \\u20a685,000\",\"room4_link\":\"\\/search\",\"room4_text\":\"The pinnacle of luxury with separate living area \\/ meeting area, featuring a premium bedding and stunning city views, memory foam mattresses, and luxury pillows for the ultimate sleep experience.\",\"quote1_text\":\"The service at Vizit Hotel & Suites exceeded all my expectations. From check-in to checkout, every staff member made me feel like royalty. I\'ll definitely return!\",\"quote1_author\":\"Chief Emeka Okonkwo, Lagos\",\"quote2_text\":\"As a frequent business traveler, I\'ve stayed at many hotels in Benin city. Vizit Hotel & suites stands out for its attention to detail, excellent restaurant, and professional staff.\",\"quote2_author\":\"Dr. Amina Ibrahim, Abuja\",\"quote3_text\":\"We celebrated our anniversary at Vizit Hotel & Suites and it was magical. The room was beautiful, the food was exceptional, and the atmosphere was perfect.\",\"quote3_author\":\"Mr. & Mrs. Adeyemi, Port Harcourt\",\"video_title\":\"Discover Our Story\",\"video_subtitle\":\"virtual tour, 2:30 min\",\"video_url\":\"https:\\/\\/vimeo.com\\/54851233\",\"restaurants_subtitle\":\"fine dining\",\"restaurants_title\":\"Culinary Excellence\",\"restaurant1_title\":\"The Vizit Restaurant\",\"restaurant1_button\":\"view menu\",\"restaurant1_link\":\"\\/restaurant\",\"restaurant1_text\":\"Experience culinary artistry at The Vizit Restaurant. Our expert chefs blend Nigerian flavors with international techniques to create unforgettable dishes using the freshest local ingredients.\",\"restaurant2_title\":\"Rooftop Sit-out\",\"restaurant2_button\":\"Rooftop Sit-out\",\"restaurant2_link\":\"\\/restaurant\",\"restaurant2_text\":\"Unwind at our Rooftop Sit-out with stunning views.\",\"features_pair_count\":\"3\",\"feature1_price\":\"43,500\",\"feature2_price\":\"60,000\",\"feature3_label\":\"Royal Crest Room\",\"feature3_title\":\"Royal Crest Room\",\"feature3_price\":\"65,000\",\"feature3_text\":\"Rest peacefully on our premium king-sized beds featuring Egyptian cotton linens, memory foam mattresses, and luxury pillows for the ultimate sleep experience.\\r\\nFeature 2 Button Text: check availability\",\"feature3_button_text\":\"check availability\",\"feature3_button_link\":\"\\/search\",\"feature3_image\":\"\\/storage\\/uploads\\/1768615693_crestroom3.webp\",\"feature2_image\":\"\\/storage\\/uploads\\/1768615677_crestroom.jpg\",\"service4_title\":\"activities\",\"service4_link\":\"\\/services\",\"services_grid_count\":\"3\",\"amenities_count\":\"4\",\"rooms_count\":\"5\",\"room5_name\":\"The Monarch\",\"room5_type\":\"Family Suite\",\"room5_price\":\"book from \\u20a6128,000\",\"room5_text\":\"The Perfect comfort for family featuring double bed, Nice views. Perfect for Family getaway and special occasions.\",\"room5_link\":\"\\/search\",\"quotes_count\":\"3\",\"restaurants_count\":\"2\",\"hero_type\":\"slider\",\"hero_slider_speed\":\"5000\",\"hero_slider_effect\":\"kenburns\",\"hero_slider_nav\":\"0\",\"hero_slides\":[{\"title\":\"\",\"subtitle\":\"\",\"image\":\"\\/uploads\\/home\\/hero_slide_0_1768613295.webp\"},{\"title\":\"\",\"subtitle\":\"\",\"image\":\"\\/uploads\\/home\\/hero_slide_1_1768613295.jpg\"},{\"title\":\"\",\"subtitle\":\"\",\"image\":\"\\/uploads\\/home\\/hero_slide_2_1768613295.jpg\"}],\"hero_slider_dots\":\"0\",\"hero_overlay_color\":\"#000000\",\"hero_overlay_color_text\":\"#000000\",\"hero_overlay_opacity\":\"60\",\"hero_overlay_blend\":\"normal\",\"hero_overlay_gradient\":\"none\",\"hero_overlay_pattern\":\"none\",\"hero_pattern_opacity\":\"15\",\"intro_image\":\"\\/storage\\/uploads\\/1768615438_collage2.png\",\"feature1_image\":\"\\/storage\\/uploads\\/1768615700_Pearlroom.jpg\",\"room1_image\":\"\\/storage\\/uploads\\/1768615780_Pearlroom.jpg\",\"room2_image\":\"\\/storage\\/uploads\\/1768615785_crestroom.jpg\"}', '2026-01-14 21:01:27', '2026-01-17 02:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_categories`
--

CREATE TABLE `inventory_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('food','beverage','supplies','amenities','maintenance') NOT NULL,
  `code` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_items`
--

CREATE TABLE `inventory_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `unit` varchar(255) NOT NULL,
  `unit_cost` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) DEFAULT NULL,
  `current_stock` int(11) NOT NULL DEFAULT 0,
  `minimum_stock` int(11) NOT NULL DEFAULT 0,
  `maximum_stock` int(11) DEFAULT NULL,
  `reorder_level` int(11) NOT NULL DEFAULT 0,
  `storage_location` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `supplier_code` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `track_expiry` tinyint(1) NOT NULL DEFAULT 0,
  `is_perishable` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_transactions`
--

CREATE TABLE `inventory_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `room_charges` decimal(10,2) NOT NULL DEFAULT 0.00,
  `restaurant_charges` decimal(10,2) NOT NULL DEFAULT 0.00,
  `bar_charges` decimal(10,2) NOT NULL DEFAULT 0.00,
  `other_charges` decimal(10,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  `service_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `balance_amount` decimal(10,2) NOT NULL,
  `status` enum('draft','sent','paid','overdue','cancelled') NOT NULL DEFAULT 'draft',
  `notes` text DEFAULT NULL,
  `line_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`line_items`)),
  `sent_at` timestamp NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `open_in_new_tab` tinyint(1) NOT NULL DEFAULT 0,
  `css_class` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_14_093938_create_room_types_table', 1),
(5, '2025_10_14_093945_create_rooms_table', 1),
(6, '2025_10_14_093946_create_guests_table', 1),
(7, '2025_10_14_093947_create_bookings_table', 1),
(8, '2025_10_14_093948_create_room_prices_table', 1),
(9, '2025_10_14_093949_create_invoices_table', 1),
(10, '2025_10_14_093955_create_inventory_categories_table', 1),
(11, '2025_10_14_093955_create_inventory_items_table', 1),
(12, '2025_10_14_093956_create_suppliers_table', 1),
(13, '2025_10_14_093957_create_purchase_orders_table', 1),
(14, '2025_10_14_093958_create_inventory_transactions_table', 1),
(15, '2025_10_14_094003_create_restaurant_menus_table', 1),
(16, '2025_10_14_094004_create_restaurant_orders_table', 1),
(17, '2025_10_14_094005_create_restaurant_order_items_table', 1),
(18, '2025_10_14_094006_create_bar_menus_table', 1),
(19, '2025_10_14_094007_create_bar_orders_table', 1),
(20, '2025_10_14_094012_create_bar_order_items_table', 1),
(21, '2025_10_14_094013_create_payments_table', 1),
(22, '2025_10_14_094014_create_transactions_table', 1),
(23, '2025_10_14_094015_create_reports_table', 1),
(24, '2025_10_14_094016_create_notifications_table', 1),
(25, '2025_10_14_094401_create_permission_tables', 1),
(26, '2025_10_14_094532_create_personal_access_tokens_table', 1),
(27, '2025_10_14_102449_create_website_settings_table', 1),
(28, '2025_10_14_105854_create_menus_table', 1),
(29, '2025_10_17_000001_add_home_fields_to_website_settings_table', 1),
(30, '2025_10_17_000002_create_gallery_images_table', 1),
(31, '2025_11_28_000001_create_home_page_settings_table', 1),
(32, '2025_11_28_000002_add_content_to_home_page_settings_table', 1),
(33, '2025_11_28_000003_create_about_page_settings_table', 1),
(34, '2025_11_28_000004_create_site_settings_table', 1),
(35, '2025_11_28_000005_create_contact_page_settings_table', 1),
(36, '2025_11_28_000006_create_explore_page_settings_table', 1),
(37, '2025_11_28_000007_create_restaurant_page_settings_table', 1),
(38, '2025_11_28_000008_create_rooms_gallery_page_settings_table', 1),
(39, '2025_11_28_000009_create_rooms_page_settings_table', 1),
(40, '2025_11_28_000010_create_search_page_settings_table', 1),
(41, '2025_11_28_000011_create_services_page_settings_table', 1),
(42, '2025_11_28_000012_create_tandc_page_settings_table', 1),
(43, '2025_11_28_000020_add_slug_to_room_types_table', 1),
(44, '2025_11_28_174839_add_menu_fields_to_site_settings_table', 1),
(45, '2025_12_01_101928_create_subscribers_table', 1),
(46, '2026_01_07_000001_create_theme_settings_table', 1),
(47, '2026_01_07_194249_add_show_top_bar_to_theme_settings_table', 1),
(48, '2026_01_07_194914_add_section_order_and_styles_to_page_settings', 1),
(49, '2026_01_07_202651_add_footer_website_to_site_settings_table', 1),
(50, '2026_01_07_203010_add_header_footer_colors_to_site_settings_table', 1),
(51, '2026_01_07_203558_add_footer_link_heading_colors_to_site_settings_table', 1),
(52, '2026_01_07_210544_add_drinks_category_to_restaurant_menus_table', 1),
(53, '2026_01_08_070716_add_currency_to_site_settings_table', 1),
(54, '2026_01_08_074145_add_section_order_and_page_styles_to_search_page_settings_table', 1),
(55, '2026_01_08_074226_add_section_order_and_page_styles_to_tandc_page_settings_table', 1),
(56, '2026_01_08_120000_create_catalog_settings_table', 1),
(57, '2026_01_14_000001_add_social_tiktok_booking_to_site_settings_table', 2),
(58, '2026_01_15_000001_add_reveal_loader_to_theme_settings', 3),
(59, '2026_01_17_013641_add_subscribe_styles_to_site_settings_table', 4),
(60, '2026_01_17_020831_add_custom_code_to_site_settings_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_number` varchar(255) NOT NULL,
  `payable_type` varchar(255) NOT NULL,
  `payable_id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED DEFAULT NULL,
  `processed_by` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','card','bank_transfer','mobile_payment','cheque') NOT NULL,
  `status` enum('pending','completed','failed','refunded','cancelled') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `reference_number` varchar(255) DEFAULT NULL,
  `payment_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_details`)),
  `notes` text DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `refund_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `refunded_at` timestamp NULL DEFAULT NULL,
  `refunded_by` bigint(20) UNSIGNED DEFAULT NULL,
  `refund_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_menus`
--

CREATE TABLE `restaurant_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` enum('appetizer','main_course','dessert','beverage','drinks','breakfast','lunch','dinner') DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ingredients` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`ingredients`)),
  `allergens` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`allergens`)),
  `preparation_time` int(11) DEFAULT NULL,
  `is_vegetarian` tinyint(1) NOT NULL DEFAULT 0,
  `is_vegan` tinyint(1) NOT NULL DEFAULT 0,
  `is_spicy` tinyint(1) NOT NULL DEFAULT 0,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `cost_price` decimal(8,2) DEFAULT NULL,
  `chef_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_menus`
--

INSERT INTO `restaurant_menus` (`id`, `name`, `description`, `category`, `price`, `image`, `ingredients`, `allergens`, `preparation_time`, `is_vegetarian`, `is_vegan`, `is_spicy`, `is_available`, `is_featured`, `sort_order`, `cost_price`, `chef_notes`, `created_at`, `updated_at`) VALUES
(1, 'Jollof Rice', 'Nigerian classic - tomato-based rice dish', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 1, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(2, 'Fried Rice', 'Stir-fried rice with vegetables', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 2, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(3, 'White Rice', 'Plain steamed rice', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 3, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(4, 'Basmati Rice', 'Premium long-grain aromatic rice', 'main_course', 6000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 4, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(5, 'Coconut Rice', 'Rice cooked in coconut milk (On Request)', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 5, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(6, 'Special Fried Rice', 'Premium fried rice with extra toppings (On Request)', 'main_course', 8000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 6, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(7, 'Native Rice', 'Traditional Nigerian rice dish (On Request)', 'main_course', 8000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 7, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(8, 'Jamaican Rice', 'Caribbean-style rice (On Request)', 'main_course', 6000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 8, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(9, 'Seafood Jollof', 'Jollof rice with assorted seafood (On Request)', 'main_course', 8000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 9, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(10, 'Signature Rice', 'Chef\'s special rice dish (On Request)', 'main_course', 8000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 10, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(11, 'Vegetable Noodles', 'Stir-fried noodles with vegetables', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 11, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(12, 'Jollof Spaghetti', 'Nigerian-style spaghetti in tomato sauce', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 12, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(13, 'White Spaghetti', 'Plain spaghetti with sauce', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 13, NULL, NULL, '2026-01-14 23:59:40', '2026-01-14 23:59:40'),
(14, 'Spaghetti Bolognese', 'Italian pasta with meat sauce', 'main_course', 6000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 14, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(15, 'Stir Fry Pasta', 'Wok-fried pasta with vegetables', 'main_course', 6000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 15, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(16, 'Alfredo Pasta (Creamy)', 'Pasta in creamy white sauce (On Request)', 'main_course', 6000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 16, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(17, 'Seafood Pasta', 'Pasta with assorted seafood (On Request)', 'main_course', 8000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 17, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(18, 'Penne Arabiata', 'Penne in spicy tomato sauce (On Request)', 'main_course', 6000.00, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 0, 18, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(19, 'Turkey', 'Seasoned turkey portion', 'main_course', 8000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 19, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(20, 'Chicken', 'Well-seasoned chicken portion', 'main_course', 6000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 20, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(21, 'Goat Meat', 'Tender goat meat portion', 'main_course', 6000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 21, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(22, 'Beef', 'Premium beef portion', 'main_course', 5000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 22, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(23, 'Snail (One Portion)', 'Giant African snail delicacy', 'main_course', 10000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 23, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(24, 'Sauced Kpomo', 'Cow skin in pepper sauce', 'main_course', 5000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 24, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(25, 'Assorted Meat', 'Mixed meat selection', 'main_course', 7000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 25, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(26, 'Cow Head', 'Traditional cow head meat', 'main_course', 6000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 26, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(27, 'Meluza Fish', 'Grilled Meluza fish', 'main_course', 6000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 27, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(28, 'Croaker Fish', 'Fresh croaker fish', 'main_course', 9000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 28, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(29, 'Titus Fish', 'Grilled Titus mackerel', 'main_course', 8000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 29, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(30, 'Catfish (Half)', 'Half portion of catfish', 'main_course', 8000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 30, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(31, 'Chicken Pepper Soup', 'Spicy chicken broth', 'appetizer', 8000.00, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 0, 31, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(32, 'Goatmeat Pepper Soup', 'Traditional goat meat soup', 'appetizer', 8000.00, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 0, 32, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(33, 'Catfish Pepper Soup (One Portion)', 'Single portion catfish soup', 'appetizer', 8000.00, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 0, 33, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(34, 'Catfish Pepper Soup (Full Pot)', 'Full pot of catfish soup', 'appetizer', 15000.00, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 0, 34, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(35, 'Ukodo (Full Catfish and Yam)', 'Traditional Urhobo yam pepper soup with full catfish', 'appetizer', 18000.00, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 0, 35, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(36, 'Ukodo (Half Catfish and Yam)', 'Urhobo yam pepper soup with half catfish', 'appetizer', 11000.00, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 0, 36, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(37, 'Assorted Pepper Soup', 'Mixed meat pepper soup', 'appetizer', 7000.00, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 0, 37, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(38, 'Croaker Pepper Soup', 'Croaker fish in spicy broth', 'appetizer', 10000.00, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 0, 38, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(39, 'Egusi Soup', 'Melon seed soup - Nigerian classic', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 39, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(40, 'Ogbono Soup', 'Draw soup made from bush mango seeds', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 40, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(41, 'Banga Soup', 'Palm fruit soup - Delta specialty', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 41, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(42, 'Black Soup', 'Traditional black soup', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 42, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(43, 'Vegetable Soup', 'Fresh vegetable soup', 'main_course', 4000.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 43, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(44, 'Okro Soup', 'Okra-based soup', 'main_course', 4000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 44, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(45, 'Bitterleaf Soup', 'Igbo traditional bitterleaf soup', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 45, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(46, 'Oha Soup', 'Igbo soup with oha leaves', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 46, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(47, 'Seafood Okro', 'Okro soup with assorted seafood (On Request)', 'main_course', 15000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 47, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(48, 'Fisherman Soup', 'Rich soup with fresh fish and seafood (On Request)', 'main_course', 20000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 48, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(49, 'Poundo', 'Pounded yam - smooth and stretchy', 'main_course', 2000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 49, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(50, 'Semo', 'Semolina swallow', 'main_course', 2000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 50, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(51, 'Eba', 'Garri swallow - cassava-based', 'main_course', 2000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 51, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(52, 'Starch', 'Cassava starch swallow - Delta specialty', 'main_course', 2000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 52, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(53, 'Yam Chips/Boiled Yam', 'Fried or boiled yam', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 53, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(54, 'Fried Plantain/Boiled Plantain', 'Sweet plantain - fried or boiled', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 54, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(55, 'Fried/Boiled Sweet Potato', 'Sweet potato preparation', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 55, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(56, 'Boiled Irish Potato', 'Soft boiled potatoes', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 56, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(57, 'Porridge Yam', 'Yam cooked in palm oil and spices', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 57, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(58, 'Porridge Beans', 'Beans cooked in palm oil', 'main_course', 3000.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 58, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(59, 'Moi-Moi', 'Steamed bean pudding', 'appetizer', 2000.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 59, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(60, 'Akara', 'Deep-fried bean cakes', 'appetizer', 2000.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 60, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(61, 'Custard', 'Creamy custard pudding', 'breakfast', 1500.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 61, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(62, 'Oat Meal', 'Warm oatmeal', 'breakfast', 1500.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 62, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(63, 'Boiled/Fried Eggs', 'Eggs - your choice of style', 'breakfast', 2000.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 63, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(64, 'Salad', 'Fresh vegetable salad', 'appetizer', 2000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 0, 64, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(65, 'Egg Sauce', 'Tomato-based sauce with eggs', 'main_course', 2500.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 65, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(66, 'Vegetable Sauce', 'Fresh vegetable sauce', 'main_course', 2000.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 66, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(67, 'Tomato Sauce', 'Rich tomato sauce', 'main_course', 2000.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 67, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(68, 'Garden Egg Sauce', 'African eggplant sauce', 'main_course', 2000.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 68, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(69, 'Fish Sauce', 'Sauce with fish chunks', 'main_course', 2500.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 69, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(70, 'Toasted Bread with Tea/Coffee', 'Toasted or fresh bread with hot beverage', 'breakfast', 3000.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 70, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(71, 'Pancakes', 'Fluffy pancakes (On Request)', 'breakfast', 2000.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 71, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(72, 'Waffles', 'Crispy waffles (On Request)', 'breakfast', 2000.00, NULL, NULL, NULL, NULL, 1, 0, 0, 1, 0, 72, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(73, 'English Breakfast', 'Toasted bread, sausage, baked beans, omelette with tea or coffee', 'breakfast', 7000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 73, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(74, 'Club Sandwich', 'Triple-decker sandwich with chicken, bacon, and veggies', 'lunch', 4000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 74, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(75, 'French Fries', 'Crispy golden fries', 'appetizer', 3000.00, NULL, NULL, NULL, NULL, 1, 1, 0, 1, 0, 75, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(76, 'Chicken & Chips', 'Grilled chicken with french fries', 'main_course', 9000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 76, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(77, 'Barbecue Fish (Catfish), Chips & Salad', 'BBQ catfish with fries and fresh salad', 'main_course', 10000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 77, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(78, 'Barbecue with Bole, Chips & Salad', 'BBQ meat with roasted plantain, chips and salad', 'main_course', 13000.00, NULL, NULL, NULL, NULL, 0, 0, 0, 1, 0, 78, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(79, 'Isi Ewu (Full Goat Head)', 'Igbo delicacy - spiced goat head', 'main_course', 10000.00, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 0, 79, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41'),
(80, 'Nkwobi (Cow Head)', 'Igbo delicacy - spiced cow foot in palm oil', 'main_course', 10000.00, NULL, NULL, NULL, NULL, 0, 0, 1, 1, 0, 80, NULL, NULL, '2026-01-14 23:59:41', '2026-01-14 23:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_orders`
--

CREATE TABLE `restaurant_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `guest_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `waiter_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `table_number` varchar(255) DEFAULT NULL,
  `guest_count` int(11) NOT NULL DEFAULT 1,
  `order_type` enum('dine_in','room_service','takeaway') NOT NULL,
  `status` enum('pending','confirmed','preparing','ready','served','cancelled') NOT NULL DEFAULT 'pending',
  `subtotal` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `service_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `special_instructions` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `prepared_at` timestamp NULL DEFAULT NULL,
  `served_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_order_items`
--

CREATE TABLE `restaurant_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_page_settings`
--

CREATE TABLE `restaurant_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sections`)),
  `section_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`section_order`)),
  `page_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`page_styles`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_page_settings`
--

INSERT INTO `restaurant_page_settings` (`id`, `seo_title`, `seo_description`, `sections`, `section_order`, `page_styles`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Restaurant & Dining - Vizit Hotel & Suites', 'Enjoy exceptional dining at Vizit Hotel & Suites. Our restaurants serve authentic Nigerian cuisine and international dishes prepared by expert chefs.', '\"{\\\"hero\\\":true,\\\"video\\\":true,\\\"menu\\\":true}\"', '\"[\\\"hero\\\",\\\"video\\\",\\\"menu\\\"]\"', NULL, '{\"hero_title\":\"Restaurant\",\"video_tagline\":\"Culinary Excellence Awaits\",\"menu_subtitle\":\"our specialties\",\"menu_title\":\"Featured Menu\"}', '2026-01-14 21:01:27', '2026-01-14 23:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `floor` enum('Ground','1st','2nd','3rd','4th','5th') NOT NULL,
  `status` enum('available','occupied','maintenance','cleaning','out_of_order') NOT NULL DEFAULT 'available',
  `description` text DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `last_cleaned_at` timestamp NULL DEFAULT NULL,
  `last_maintenance_at` timestamp NULL DEFAULT NULL,
  `maintenance_notes` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `room_type_id`, `floor`, `status`, `description`, `features`, `images`, `last_cleaned_at`, `last_maintenance_at`, `maintenance_notes`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '100', 1, 'Ground', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(2, '101', 1, 'Ground', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(3, '102', 1, 'Ground', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(4, '103', 1, 'Ground', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(5, '104', 1, 'Ground', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(6, '105', 2, '1st', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(7, '106', 2, '1st', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(8, '107', 2, '1st', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(9, '108', 2, '1st', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(10, '109', 2, '1st', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(11, '110', 3, '2nd', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(12, '111', 3, '2nd', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(13, '112', 3, '2nd', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(14, '113', 3, '2nd', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(15, '114', 3, '2nd', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(16, '115', 4, '3rd', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(17, '116', 4, '3rd', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(18, '117', 4, '3rd', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(19, '118', 4, '3rd', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(20, '119', 4, '3rd', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(21, '120', 5, '4th', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(22, '121', 5, '4th', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(23, '122', 5, '4th', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(24, '123', 5, '4th', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27'),
(25, '124', 5, '4th', 'available', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2026-01-14 21:01:27', '2026-01-14 21:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_gallery_page_settings`
--

CREATE TABLE `rooms_gallery_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sections`)),
  `section_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`section_order`)),
  `page_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`page_styles`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms_gallery_page_settings`
--

INSERT INTO `rooms_gallery_page_settings` (`id`, `seo_title`, `seo_description`, `sections`, `section_order`, `page_styles`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Room Gallery - Vizit Hotel & Suites', 'View our stunning room gallery. See the luxury interiors, premium amenities, and elegant design of our rooms and suites at Vizit Hotel & Suites.', '{\"hero\":{\"visible\":true},\"amenities\":{\"visible\":true},\"gallery\":{\"visible\":true},\"room_details\":{\"visible\":true},\"more_rooms\":{\"visible\":true}}', '[\"hero\",\"amenities\",\"gallery\",\"room_details\",\"more_rooms\"]', '{\"background_color\":\"\",\"text_color\":\"\",\"heading_color\":\"\",\"accent_color\":\"\",\"background_image\":\"\",\"custom_css\":\"\"}', '[]', '2026-01-14 23:16:12', '2026-01-14 23:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_page_settings`
--

CREATE TABLE `rooms_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sections`)),
  `section_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`section_order`)),
  `page_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`page_styles`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms_page_settings`
--

INSERT INTO `rooms_page_settings` (`id`, `seo_title`, `seo_description`, `sections`, `section_order`, `page_styles`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Our Rooms & Suites - Vizit Hotel & Suites', 'Discover our luxurious rooms and suites at Vizit Hotel & Suites. From Pearl Rooms to The Monarch Suite, find your perfect accommodation in Benin City.', '{\"hero\":{\"visible\":true},\"booking_form\":{\"visible\":true},\"rooms_list\":{\"visible\":true}}', '[\"hero\",\"booking_form\",\"rooms_list\"]', '[]', '{\"hero_title\":\"Our Rooms\",\"hero_image\":\"http:\\/\\/127.0.0.1:8000\\/assets\\/img\\/6.jpg\",\"rooms_subtitle\":\"elegant suites\",\"rooms_title\":\"Our rooms\",\"book_button_text\":\"book now\",\"book_button_url\":\"https:\\/\\/booking.com\\/hotel\",\"book_button_new_tab\":\"0\"}', '2026-01-14 21:01:27', '2026-01-15 00:42:42');

-- --------------------------------------------------------

--
-- Table structure for table `room_prices`
--

CREATE TABLE `room_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `season_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `daily_rate` decimal(10,2) NOT NULL,
  `weekly_rate` decimal(10,2) DEFAULT NULL,
  `monthly_rate` decimal(10,2) DEFAULT NULL,
  `weekend_rate` decimal(10,2) DEFAULT NULL,
  `minimum_stay` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `priority` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `stars` int(11) NOT NULL DEFAULT 5,
  `description` text DEFAULT NULL,
  `max_occupancy` int(11) NOT NULL,
  `max_adults` int(11) NOT NULL,
  `max_children` int(11) NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `amenities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`amenities`)),
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `size_sqft` decimal(8,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `slug`, `subtitle`, `stars`, `description`, `max_occupancy`, `max_adults`, `max_children`, `base_price`, `amenities`, `images`, `size_sqft`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Pearl Room', 'pearl-room', NULL, 5, 'Comfortable and well-equipped room offering excellent value. Features all essential amenities for a pleasant stay.', 2, 2, 0, 43500.00, NULL, NULL, NULL, 1, 0, '2026-01-14 21:01:08', '2026-01-14 21:01:08'),
(2, 'Crest Room', 'crest-room', NULL, 5, 'Our Crest Rooms offer the perfect balance of comfort and style. Enjoy modern amenities, plush furnishings, and thoughtful touches that make your stay memorable. Ideal for both business and leisure travelers.', 2, 2, 0, 60000.00, NULL, NULL, NULL, 1, 0, '2026-01-14 21:01:08', '2026-01-14 21:01:08'),
(3, 'Royal Crest Room', 'royal-crest-room', NULL, 5, 'Rest peacefully on our premium king-sized beds featuring Egyptian cotton linens, memory foam mattresses, and luxury pillows for the ultimate sleep experience.', 3, 2, 1, 65000.00, NULL, NULL, NULL, 1, 0, '2026-01-14 21:01:08', '2026-01-14 21:01:08'),
(4, 'Rosewood Suite', 'rosewood-suite', NULL, 5, 'The pinnacle of luxury with separate living area / meeting area, featuring a premium bedding and stunning city views, memory foam mattresses, and luxury pillows for the ultimate sleep experience.', 4, 3, 1, 85000.00, NULL, NULL, NULL, 1, 0, '2026-01-14 21:01:08', '2026-01-14 21:01:08'),
(5, 'The Monarch', 'the-monarch', NULL, 5, 'The Perfect comfort for family featuring double bed, Nice views. Perfect for Family getaway and special occasions.', 5, 4, 2, 128000.00, NULL, NULL, NULL, 1, 0, '2026-01-14 21:01:08', '2026-01-14 21:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `search_page_settings`
--

CREATE TABLE `search_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sections`)),
  `section_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`section_order`)),
  `page_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`page_styles`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `search_page_settings`
--

INSERT INTO `search_page_settings` (`id`, `seo_title`, `seo_description`, `sections`, `section_order`, `page_styles`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Book Your Stay - Vizit Hotel & Suites', 'Search and book available rooms at Vizit Hotel & Suites. Find the perfect accommodation for your stay in Benin City, Nigeria.', '{\"hero\":{\"visible\":true},\"search_results\":{\"visible\":true}}', '[\"hero\",\"search_results\"]', '{\"background_color\":\"\",\"text_color\":\"\",\"heading_color\":\"\",\"accent_color\":\"\",\"background_image\":\"\",\"custom_css\":\"\"}', '{\"hero_title\":\"Find Your Perfect Room\",\"hero_subtitle\":\"Search Availability\"}', '2026-01-14 23:40:35', '2026-01-14 23:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `services_page_settings`
--

CREATE TABLE `services_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sections`)),
  `section_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`section_order`)),
  `page_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`page_styles`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services_page_settings`
--

INSERT INTO `services_page_settings` (`id`, `seo_title`, `seo_description`, `sections`, `section_order`, `page_styles`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Our Services - Vizit hotel & suites', 'Discover the premium services at Vizit hotel & suites including mini mart, restaurant, pool, Bar and more. Experience luxury hospitality in Benin city.', '\"{\\\"hero\\\":true,\\\"video\\\":true,\\\"services\\\":true,\\\"offers\\\":true}\"', '\"[\\\"hero\\\",\\\"video\\\",\\\"services\\\",\\\"offers\\\"]\"', NULL, '{\"hero_title\":\"Our Services\",\"video_tagline\":\"Excellence in Every Detail\",\"boxes_count\":5,\"services_subtitle\":\"premium offerings\",\"services_title\":\"World-Class Amenities\",\"box1_title\":\"Smoke-Free Environment\",\"box1_description\":\"Breathe easy in our completely smoke-free rooms and common areas. We maintain the highest air quality standards for your health and comfort. Designated outdoor smoking areas available.\",\"box1_button\":\"read more\",\"box2_title\":\"Luxury Bedding\",\"box2_description\":\"Sink into our premium king-sized beds featuring 400-thread count cotton sheets, plush duvets, and a pillow menu to customize your perfect night\'s sleep.\",\"box2_button\":\"read more\",\"box3_title\":\"Airport Transfers\",\"box3_description\":\"Enjoy complimentary luxury airport transfers in our air-conditioned vehicles. Our professional drivers track your flight and ensure punctual pickup and drop-off services.\",\"box3_button\":\"read more\",\"box4_title\":\"Welcome Refreshments\",\"box4_description\":\"Begin your stay with our signature welcome drink service. Choose from fresh tropical juices, premium wines, or expertly crafted cocktails upon arrival.\",\"box4_button\":\"read more\",\"box5_title\":\"Rooftop sit-out\",\"box5_description\":\"Our stunning rooftop sit-out offers breathtaking views.\",\"box5_button\":\"read more\",\"offers_count\":2,\"offers_subtitle\":\"exclusive services\",\"offers_title\":\"What We Offer\",\"service1_title\":\"The Vizit Restaurant\",\"service1_description\":\"Our flagship restaurant serves breakfast, lunch, and dinner daily. Experience a blend of Nigerian and continental cuisine prepared with the freshest ingredients by our culinary team.\",\"service1_button\":\"explore\",\"service2_title\":\"Swimming Pool\",\"service2_description\":\"Our pool area Perfect for relaxation or hosting intimate gatherings.\",\"service2_button\":\"explore\",\"video_label\":\"services overview, 2:00 min\"}', '2026-01-14 21:01:27', '2026-01-14 23:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jV1MtNOuAQDxl04NIZAUA5hlf85e1KDbPP2htWRo', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVkE2ZHNMRHJLc0xLbWRZSko5Z0w1WEx6RmJNTERkZUg4Z0Z1QkRTOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zaXRlLXNldHRpbmdzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1768615876);

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) NOT NULL DEFAULT 'Kuwait Cabin Hotel Bar',
  `site_logo` varchar(255) DEFAULT NULL,
  `site_favicon` varchar(255) DEFAULT NULL,
  `header_phone` varchar(255) DEFAULT NULL,
  `header_email` varchar(255) DEFAULT NULL,
  `header_address` text DEFAULT NULL,
  `footer_about` text DEFAULT NULL,
  `footer_phone` varchar(255) DEFAULT NULL,
  `footer_email` varchar(255) DEFAULT NULL,
  `footer_address` text DEFAULT NULL,
  `footer_website` varchar(255) DEFAULT NULL,
  `footer_copyright` varchar(255) DEFAULT NULL,
  `social_facebook` varchar(255) DEFAULT NULL,
  `social_twitter` varchar(255) DEFAULT NULL,
  `social_instagram` varchar(255) DEFAULT NULL,
  `social_tiktok` varchar(255) DEFAULT NULL,
  `social_youtube` varchar(255) DEFAULT NULL,
  `social_tripadvisor` varchar(255) DEFAULT NULL,
  `social_booking` varchar(255) DEFAULT NULL,
  `notification_email` varchar(255) DEFAULT NULL,
  `currency_symbol` varchar(10) NOT NULL DEFAULT '₦',
  `currency_code` varchar(10) NOT NULL DEFAULT 'NGN',
  `currency_position` varchar(10) NOT NULL DEFAULT 'before',
  `custom_header_code` text DEFAULT NULL,
  `custom_footer_code` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `header_menu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`header_menu`)),
  `header_bg_color` varchar(255) DEFAULT NULL,
  `header_text_color` varchar(255) DEFAULT NULL,
  `footer_subtitle` varchar(255) DEFAULT NULL,
  `footer_title` varchar(255) DEFAULT NULL,
  `footer_menu` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`footer_menu`)),
  `footer_bg_color` varchar(255) DEFAULT NULL,
  `footer_text_color` varchar(255) DEFAULT NULL,
  `footer_heading_color` varchar(255) DEFAULT NULL,
  `footer_link_color` varchar(255) DEFAULT NULL,
  `show_scroll_buttons` tinyint(1) NOT NULL DEFAULT 1,
  `check_in_time` varchar(255) DEFAULT NULL,
  `check_out_time` varchar(255) DEFAULT NULL,
  `opening_hours` varchar(255) DEFAULT NULL,
  `subscribe_button` varchar(255) DEFAULT NULL,
  `partner_logo_1` varchar(255) DEFAULT NULL,
  `partner_logo_2` varchar(255) DEFAULT NULL,
  `partner_logo_3` varchar(255) DEFAULT NULL,
  `partner_logo_4` varchar(255) DEFAULT NULL,
  `subscribe_style` varchar(255) DEFAULT 'classic',
  `subscribe_title` varchar(255) DEFAULT NULL,
  `subscribe_subtitle` varchar(255) DEFAULT NULL,
  `subscribe_placeholder` varchar(255) DEFAULT NULL,
  `subscribe_input_bg` varchar(255) DEFAULT NULL,
  `subscribe_input_text` varchar(255) DEFAULT NULL,
  `subscribe_input_border` varchar(255) DEFAULT NULL,
  `subscribe_input_border_radius` varchar(255) DEFAULT NULL,
  `subscribe_btn_bg` varchar(255) DEFAULT NULL,
  `subscribe_btn_text` varchar(255) DEFAULT NULL,
  `subscribe_btn_hover_bg` varchar(255) DEFAULT NULL,
  `subscribe_btn_hover_text` varchar(255) DEFAULT NULL,
  `subscribe_btn_border_radius` varchar(255) DEFAULT NULL,
  `subscribe_btn_icon` varchar(255) DEFAULT NULL,
  `subscribe_btn_icon_only` tinyint(1) NOT NULL DEFAULT 0,
  `subscribe_container_bg` varchar(255) DEFAULT NULL,
  `subscribe_container_shadow` varchar(255) DEFAULT NULL,
  `subscribe_show_section` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `site_logo`, `site_favicon`, `header_phone`, `header_email`, `header_address`, `footer_about`, `footer_phone`, `footer_email`, `footer_address`, `footer_website`, `footer_copyright`, `social_facebook`, `social_twitter`, `social_instagram`, `social_tiktok`, `social_youtube`, `social_tripadvisor`, `social_booking`, `notification_email`, `currency_symbol`, `currency_code`, `currency_position`, `custom_header_code`, `custom_footer_code`, `created_at`, `updated_at`, `header_menu`, `header_bg_color`, `header_text_color`, `footer_subtitle`, `footer_title`, `footer_menu`, `footer_bg_color`, `footer_text_color`, `footer_heading_color`, `footer_link_color`, `show_scroll_buttons`, `check_in_time`, `check_out_time`, `opening_hours`, `subscribe_button`, `partner_logo_1`, `partner_logo_2`, `partner_logo_3`, `partner_logo_4`, `subscribe_style`, `subscribe_title`, `subscribe_subtitle`, `subscribe_placeholder`, `subscribe_input_bg`, `subscribe_input_text`, `subscribe_input_border`, `subscribe_input_border_radius`, `subscribe_btn_bg`, `subscribe_btn_text`, `subscribe_btn_hover_bg`, `subscribe_btn_hover_text`, `subscribe_btn_border_radius`, `subscribe_btn_icon`, `subscribe_btn_icon_only`, `subscribe_container_bg`, `subscribe_container_shadow`, `subscribe_show_section`) VALUES
(1, 'Vizit Hotel & Suites', '/storage/uploads/1768426101_vizit_logo.jpeg', '/storage/uploads/1768426104_vizit_logo1.jpeg', '+234 816 325 9205', 'info@Vizithotelandsuites.com', '2 Namuna street off godwin abbe way limit sapele road Benin city, Edo, Nigeria', 'Vizit Hotel & Suites offers an exceptional blend of luxury accommodation and vibrant entertainment in the heart of Benin City. Experience Nigerian hospitality at its finest with world-class amenities and personalized service.', '+234 816 325 9205', 'reservations@Vizithotelandsuites.com', '2 Namuna street off godwin abbe way limit sapele road Benin city, Edo, Nigeria', 'www.vizithotelandsuites.com', '© 2025 Vizit Hotel & Suites. All rights reserved.', NULL, NULL, 'https://www.instagram.com/vizit_hotelsuites?igsh=MThobnljY3pmcXE1ZQ==', 'https://www.tiktok.com/@vizithotelandsuites?_r=1&_t=ZS-930KienLb4J', NULL, 'https://www.tripadvisor.com/Hotel_Review-g298361-d33974433-Reviews-Vizit_Hotel_Suites-Benin_City_Edo_State.html', 'https://www.booking.com/hotel/ng/vizit-amp-suites.html', 'admin@Vizithotelandsuites.com', '₦', 'NGN', 'before', NULL, NULL, '2026-01-14 21:00:19', '2026-01-17 01:50:16', '[{\"label\":\"Home\",\"url\":\"\\/\",\"submenu\":[]},{\"label\":\"About us\",\"url\":\"\\/about\",\"submenu\":[]},{\"label\":\"Rooms\",\"url\":\"\\/rooms\",\"submenu\":[{\"label\":\"Our Rooms\",\"url\":\"\\/rooms\"},{\"label\":\"Room Gallery\",\"url\":\"\\/rooms\\/gallery\"}]},{\"label\":\"Our Services\",\"url\":\"#\",\"submenu\":[{\"label\":\"Explore\",\"url\":\"\\/explore\"},{\"label\":\"Search\",\"url\":\"\\/search\"},{\"label\":\"Terms & Conditions\",\"url\":\"\\/tandc\"},{\"label\":\"Services\",\"url\":\"\\/services\"},{\"label\":\"Restaurant\",\"url\":\"\\/restaurant\"}]},{\"label\":\"contact\",\"url\":\"\\/contact\",\"submenu\":[]},{\"label\":\"book now\",\"url\":\"\\/search\",\"highlight\":\"1\",\"submenu\":[]}]', '#1a2a3a', '#ffffff', 'get in touch', 'contact us today', '[{\"label\":\"terms & conditions\",\"url\":\"\\/tandc\"},{\"label\":\"services\",\"url\":\"\\/services\"},{\"label\":\"restaurant\",\"url\":\"\\/restaurant\"},{\"label\":\"testimonials\",\"url\":\"#\"},{\"label\":\"gallery & images\",\"url\":\"\\/rooms\\/gallery\"}]', '#1a2a3a', '#cccccc', '#ffffff', '#cccccc', 1, '2:00 PM', '12:00 PM', '24 Hours', 'subscribe', '/storage/uploads/1768426295_vizit_logo.jpeg', '/storage/uploads/1768426297_vizit_logo1.jpeg', '/storage/uploads/1768426304_vizit_logo.jpeg', NULL, 'modern', NULL, NULL, 'your email here', '#212121', '#ffffff', '#333333', '0', '#000000', '#ffffff', '#333333', '#ffffff', '0', NULL, 0, '#1a1a1a', 'large', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `source` varchar(255) NOT NULL DEFAULT 'footer',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `subscribed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `unsubscribed_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tandc_page_settings`
--

CREATE TABLE `tandc_page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `sections` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sections`)),
  `section_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`section_order`)),
  `page_styles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`page_styles`)),
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tandc_page_settings`
--

INSERT INTO `tandc_page_settings` (`id`, `seo_title`, `seo_description`, `sections`, `section_order`, `page_styles`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Terms & Conditions - Vizit Hotel & Suites', 'Read the terms and conditions for booking at Vizit Hotel & Suites. Learn about check-in/check-out times, cancellation policy, and hotel rules.', '{\"hero\":{\"visible\":true},\"faq\":{\"visible\":true}}', '[\"hero\",\"faq\"]', '{\"background_color\":\"\",\"text_color\":\"\",\"heading_color\":\"\",\"accent_color\":\"\",\"background_image\":\"\",\"custom_css\":\"\"}', '{\"hero_title\":\"Terms & Conditions\",\"faq_subtitle\":\"booking policies\",\"faq_title\":\"Hotel Terms & Conditions\",\"faq_1_question\":\"What do room prices include?\",\"faq_1_answer\":\"All prices include breakfast for 1 person and free swimming pool access.\",\"faq_2_question\":\"What are the check-in and check-out times?\",\"faq_2_answer\":\"Check-in time is 2:00pm and Check-out time is 12:00 Noon.\",\"faq_3_question\":\"Is early check-in available?\",\"faq_3_answer\":\"Early check-in is subject to room availability. Please contact the front desk to inquire.\",\"faq_4_question\":\"What are the late check-out charges?\",\"faq_4_answer\":\"Late check-out attracts a surcharge as follows: Before 4:00pm - 50% of room rate, After 4:00pm - 100% of room rate.\",\"faq_5_question\":\"How do I guarantee my booking?\",\"faq_5_answer\":\"Payment in full or a valid credit card guarantees the booking.\",\"faq_6_question\":\"What happens if I check out early?\",\"faq_6_answer\":\"Early check-out will be charged in full for the entire booking period.\",\"faq_7_question\":\"What is the no-show policy?\",\"faq_7_answer\":\"No-show fee will be charged in full for the first night booked.\",\"faq_8_question\":\"What is the cancellation policy?\",\"faq_8_answer\":\"Cancellations made less than 24 hours before arrival will be charged in full.\",\"faq_9_question\":\"What is the maximum room occupancy?\",\"faq_9_answer\":\"Maximum occupancy per room is two (2) persons. Exceeding this limit is not permitted.\",\"faq_count\":9,\"terms_content\":\"\\r\\n<h3>Booking & Rates<\\/h3>\\r\\n<ul>\\r\\n<li>All prices include breakfast for 1 person and free swimming<\\/li>\\r\\n<li>Payment in full or a valid credit card guarantees the booking<\\/li>\\r\\n<li>Maximum occupancy per room is two (2) persons. Exceeding this limit is not permitted.<\\/li>\\r\\n<\\/ul>\\r\\n\\r\\n<h3>Check-In & Check-Out<\\/h3>\\r\\n<ul>\\r\\n<li>Check-in time is 2:00 PM<\\/li>\\r\\n<li>Check-out time is 12:00 Noon<\\/li>\\r\\n<li>Early check-in is subject to room availability<\\/li>\\r\\n<\\/ul>\\r\\n\\r\\n<h3>Late Check-Out Policy<\\/h3>\\r\\n<ul>\\r\\n<li>Before 4:00 PM: 50% of room rate<\\/li>\\r\\n<li>After 4:00 PM: 100% of room rate<\\/li>\\r\\n<\\/ul>\\r\\n\\r\\n<h3>Cancellation Policy<\\/h3>\\r\\n<ul>\\r\\n<li>Early check-out will be paid in full<\\/li>\\r\\n<li>No-show fee will be charged in full for the first night booked<\\/li>\\r\\n<li>Cancellations made less than 24 hours before arrival will be charged in full<\\/li>\\r\\n<\\/ul>\\r\\n\"}', '2026-01-14 22:10:49', '2026-01-14 23:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `primary_color` varchar(255) NOT NULL DEFAULT '#aa8453',
  `secondary_color` varchar(255) NOT NULL DEFAULT '#1b1b1b',
  `accent_color` varchar(255) NOT NULL DEFAULT '#c9a66b',
  `text_color` varchar(255) NOT NULL DEFAULT '#666666',
  `heading_color` varchar(255) NOT NULL DEFAULT '#1b1b1b',
  `link_color` varchar(255) NOT NULL DEFAULT '#aa8453',
  `button_color` varchar(255) NOT NULL DEFAULT '#aa8453',
  `button_hover_color` varchar(255) NOT NULL DEFAULT '#8a6a43',
  `footer_bg_color` varchar(255) NOT NULL DEFAULT '#1b1b1b',
  `footer_text_color` varchar(255) NOT NULL DEFAULT '#999999',
  `reveal_color` varchar(255) DEFAULT '#1a2a3a',
  `loader_image` varchar(255) DEFAULT NULL,
  `loader_bg_color` varchar(255) DEFAULT '#ffffff',
  `heading_font` varchar(255) NOT NULL DEFAULT 'Poppins',
  `body_font` varchar(255) NOT NULL DEFAULT 'Roboto',
  `header_style` varchar(255) NOT NULL DEFAULT 'dark',
  `sticky_header` tinyint(1) NOT NULL DEFAULT 1,
  `show_top_bar` tinyint(1) NOT NULL DEFAULT 1,
  `button_style` varchar(255) NOT NULL DEFAULT 'rounded',
  `layout_style` varchar(255) NOT NULL DEFAULT 'wide',
  `custom_css` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `primary_color`, `secondary_color`, `accent_color`, `text_color`, `heading_color`, `link_color`, `button_color`, `button_hover_color`, `footer_bg_color`, `footer_text_color`, `reveal_color`, `loader_image`, `loader_bg_color`, `heading_font`, `body_font`, `header_style`, `sticky_header`, `show_top_bar`, `button_style`, `layout_style`, `custom_css`, `created_at`, `updated_at`) VALUES
(1, '#f7c51e', '#1a2a3a', '#f7c51e', '#333333', '#1a2a3a', '#f7c51e', '#f7c51e', '#e0b300', '#1a2a3a', '#cccccc', '#f7c51e', '/storage/uploads/1768436384_loader.jpeg', '#ffffff', 'Playfair Display', 'Poppins', 'dark', 1, 1, 'rounded', 'wide', NULL, '2026-01-14 21:02:51', '2026-01-15 00:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `last_login_at` timestamp NULL DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `emergency_contact_phone` varchar(255) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `phone`, `email_verified_at`, `password`, `avatar`, `status`, `last_login_at`, `employee_id`, `date_of_birth`, `gender`, `address`, `emergency_contact_name`, `emergency_contact_phone`, `salary`, `hire_date`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'User', 'admin@vizithotel.com', NULL, '2026-01-14 21:20:19', '$2y$12$O8tZhEcU.iNRmzji4CdmpOiko9uGGwHKXQzeX9gpno7yalfrdToJS', NULL, 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-14 21:00:19', '2026-01-14 21:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) NOT NULL DEFAULT 'Kuwait Cabin Hotel Bar',
  `site_description` text DEFAULT NULL,
  `hero_title` varchar(255) DEFAULT NULL,
  `hero_subtitle` text DEFAULT NULL,
  `hero_description` text DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `primary_color` varchar(255) NOT NULL DEFAULT '#000000',
  `secondary_color` varchar(255) NOT NULL DEFAULT '#ffffff',
  `accent_color` varchar(255) NOT NULL DEFAULT '#333333',
  `text_primary` varchar(255) NOT NULL DEFAULT '#ffffff',
  `text_secondary` varchar(255) NOT NULL DEFAULT '#cccccc',
  `background_primary` varchar(255) NOT NULL DEFAULT '#000000',
  `background_secondary` varchar(255) NOT NULL DEFAULT '#111111',
  `background_tertiary` varchar(255) NOT NULL DEFAULT '#222222',
  `border_color` varchar(255) NOT NULL DEFAULT '#333333',
  `font_primary` varchar(255) NOT NULL DEFAULT 'Arial, sans-serif',
  `font_secondary` varchar(255) NOT NULL DEFAULT 'Georgia, serif',
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `home_about_title` varchar(255) DEFAULT NULL,
  `home_about_text` text DEFAULT NULL,
  `home_stay_title` varchar(255) DEFAULT NULL,
  `home_eat_title` varchar(255) DEFAULT NULL,
  `home_gallery_title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_page_settings`
--
ALTER TABLE `about_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bar_menus`
--
ALTER TABLE `bar_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bar_menus_category_is_available_index` (`category`,`is_available`),
  ADD KEY `bar_menus_is_featured_sort_order_index` (`is_featured`,`sort_order`),
  ADD KEY `bar_menus_is_alcoholic_index` (`is_alcoholic`);

--
-- Indexes for table `bar_orders`
--
ALTER TABLE `bar_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bar_order_items`
--
ALTER TABLE `bar_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_booking_number_unique` (`booking_number`),
  ADD KEY `bookings_created_by_foreign` (`created_by`),
  ADD KEY `bookings_checked_in_by_foreign` (`checked_in_by`),
  ADD KEY `bookings_checked_out_by_foreign` (`checked_out_by`),
  ADD KEY `bookings_cancelled_by_foreign` (`cancelled_by`),
  ADD KEY `bookings_status_check_in_date_index` (`status`,`check_in_date`),
  ADD KEY `bookings_guest_id_status_index` (`guest_id`,`status`),
  ADD KEY `bookings_room_id_check_in_date_check_out_date_index` (`room_id`,`check_in_date`,`check_out_date`),
  ADD KEY `bookings_booking_number_index` (`booking_number`),
  ADD KEY `bookings_payment_status_index` (`payment_status`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `catalog_settings`
--
ALTER TABLE `catalog_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_page_settings`
--
ALTER TABLE `contact_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `explore_page_settings`
--
ALTER TABLE `explore_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guests_email_phone_index` (`email`,`phone`),
  ADD KEY `guests_is_vip_is_blacklisted_index` (`is_vip`,`is_blacklisted`),
  ADD KEY `guests_first_name_last_name_index` (`first_name`,`last_name`);

--
-- Indexes for table `home_page_settings`
--
ALTER TABLE `home_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_categories`
--
ALTER TABLE `inventory_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_categories_name_unique` (`name`),
  ADD UNIQUE KEY `inventory_categories_code_unique` (`code`),
  ADD KEY `inventory_categories_type_is_active_index` (`type`,`is_active`);

--
-- Indexes for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventory_items_sku_unique` (`sku`),
  ADD KEY `inventory_items_category_id_is_active_index` (`category_id`,`is_active`),
  ADD KEY `inventory_items_current_stock_minimum_stock_index` (`current_stock`,`minimum_stock`),
  ADD KEY `inventory_items_sku_index` (`sku`),
  ADD KEY `inventory_items_expiry_date_index` (`expiry_date`);

--
-- Indexes for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_created_by_foreign` (`created_by`),
  ADD KEY `invoices_booking_id_status_index` (`booking_id`,`status`),
  ADD KEY `invoices_guest_id_invoice_date_index` (`guest_id`,`invoice_date`),
  ADD KEY `invoices_invoice_number_index` (`invoice_number`),
  ADD KEY `invoices_status_due_date_index` (`status`,`due_date`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_payment_number_unique` (`payment_number`),
  ADD KEY `payments_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  ADD KEY `payments_processed_by_foreign` (`processed_by`),
  ADD KEY `payments_refunded_by_foreign` (`refunded_by`),
  ADD KEY `payments_status_processed_at_index` (`status`,`processed_at`),
  ADD KEY `payments_payment_number_index` (`payment_number`),
  ADD KEY `payments_guest_id_status_index` (`guest_id`,`status`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_menus`
--
ALTER TABLE `restaurant_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_menus_category_is_available_index` (`category`,`is_available`),
  ADD KEY `restaurant_menus_is_featured_sort_order_index` (`is_featured`,`sort_order`);

--
-- Indexes for table `restaurant_orders`
--
ALTER TABLE `restaurant_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurant_orders_order_number_unique` (`order_number`),
  ADD KEY `restaurant_orders_booking_id_foreign` (`booking_id`),
  ADD KEY `restaurant_orders_created_by_foreign` (`created_by`),
  ADD KEY `restaurant_orders_status_created_at_index` (`status`,`created_at`),
  ADD KEY `restaurant_orders_waiter_id_status_index` (`waiter_id`,`status`),
  ADD KEY `restaurant_orders_order_number_index` (`order_number`),
  ADD KEY `restaurant_orders_guest_id_booking_id_index` (`guest_id`,`booking_id`);

--
-- Indexes for table `restaurant_order_items`
--
ALTER TABLE `restaurant_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_page_settings`
--
ALTER TABLE `restaurant_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rooms_room_number_unique` (`room_number`),
  ADD KEY `rooms_status_is_active_index` (`status`,`is_active`),
  ADD KEY `rooms_room_type_id_index` (`room_type_id`),
  ADD KEY `rooms_floor_index` (`floor`);

--
-- Indexes for table `rooms_gallery_page_settings`
--
ALTER TABLE `rooms_gallery_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms_page_settings`
--
ALTER TABLE `rooms_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_prices`
--
ALTER TABLE `room_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_prices_room_type_id_start_date_end_date_index` (`room_type_id`,`start_date`,`end_date`),
  ADD KEY `room_prices_is_active_priority_index` (`is_active`,`priority`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_types_name_unique` (`name`),
  ADD UNIQUE KEY `room_types_slug_unique` (`slug`),
  ADD KEY `room_types_is_active_sort_order_index` (`is_active`,`sort_order`);

--
-- Indexes for table `search_page_settings`
--
ALTER TABLE `search_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_page_settings`
--
ALTER TABLE `services_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribers_email_unique` (`email`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tandc_page_settings`
--
ALTER TABLE `tandc_page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_employee_id_unique` (`employee_id`),
  ADD KEY `users_status_created_at_index` (`status`,`created_at`),
  ADD KEY `users_employee_id_index` (`employee_id`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_page_settings`
--
ALTER TABLE `about_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bar_menus`
--
ALTER TABLE `bar_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `bar_orders`
--
ALTER TABLE `bar_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bar_order_items`
--
ALTER TABLE `bar_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catalog_settings`
--
ALTER TABLE `catalog_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_page_settings`
--
ALTER TABLE `contact_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `explore_page_settings`
--
ALTER TABLE `explore_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_page_settings`
--
ALTER TABLE `home_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory_categories`
--
ALTER TABLE `inventory_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_items`
--
ALTER TABLE `inventory_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant_menus`
--
ALTER TABLE `restaurant_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `restaurant_orders`
--
ALTER TABLE `restaurant_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant_order_items`
--
ALTER TABLE `restaurant_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `restaurant_page_settings`
--
ALTER TABLE `restaurant_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `rooms_gallery_page_settings`
--
ALTER TABLE `rooms_gallery_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rooms_page_settings`
--
ALTER TABLE `rooms_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room_prices`
--
ALTER TABLE `room_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `search_page_settings`
--
ALTER TABLE `search_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services_page_settings`
--
ALTER TABLE `services_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tandc_page_settings`
--
ALTER TABLE `tandc_page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_cancelled_by_foreign` FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_checked_in_by_foreign` FOREIGN KEY (`checked_in_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_checked_out_by_foreign` FOREIGN KEY (`checked_out_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `inventory_items`
--
ALTER TABLE `inventory_items`
  ADD CONSTRAINT `inventory_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `inventory_categories` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `invoices_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payments_refunded_by_foreign` FOREIGN KEY (`refunded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `restaurant_orders`
--
ALTER TABLE `restaurant_orders`
  ADD CONSTRAINT `restaurant_orders_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `restaurant_orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `restaurant_orders_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `restaurant_orders_waiter_id_foreign` FOREIGN KEY (`waiter_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`);

--
-- Constraints for table `room_prices`
--
ALTER TABLE `room_prices`
  ADD CONSTRAINT `room_prices_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
