-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 28, 2024 at 03:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carRental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `car_type` varchar(50) NOT NULL,
  `daily_rent_price` decimal(8,2) NOT NULL,
  `availability` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `brand`, `model`, `year`, `car_type`, `daily_rent_price`, `availability`, `image`, `created_at`, `updated_at`) VALUES
(17, 'Toyota Premio', 'Toyota', 'Premio', '2019', 'Sedan', 4000.00, 1, 'uploads/1727170200-9956306-PREMIO1.jpg', '2024-09-24 09:30:00', '2024-09-27 01:55:56'),
(18, 'Toyota Premio red', 'Toyota', 'Premio', '2021', 'Sedan', 3800.00, 1, 'uploads/1727170305-2141363-PREMIO_2.jpg', '2024-09-24 09:31:45', '2024-09-27 03:08:47'),
(19, 'Toyota Axio white', 'Toyota', 'Axio', '2020', 'Sedan', 3500.00, 1, 'uploads/1727170343-2937065-axio_1.jpg', '2024-09-24 09:32:23', '2024-09-27 01:55:59'),
(20, 'Toyota Axio meroon', 'Toyota', 'Axio', '2023', 'Sedan', 3700.00, 1, 'uploads/1727170381-1074709-axio_2.jpg', '2024-09-24 09:33:01', '2024-09-27 01:56:00'),
(21, 'Nissan X-Trail', 'Nissan', 'X-Trail', '2023', 'SUV', 8000.00, 1, 'uploads/1727170445-7144397-x-trail.jpg', '2024-09-24 09:34:05', '2024-09-27 00:48:32'),
(22, 'Nissan X-Trail Silver', 'Nissan', 'X-Trail', '2022', 'SUV', 7000.00, 1, 'uploads/1727170544-4273045-x-trail_2.webp', '2024-09-24 09:35:44', '2024-09-27 01:56:03'),
(23, 'Honda CRV Blue', 'Honda', 'CRV', '2018', 'SUV', 7500.00, 1, 'uploads/1727170641-3697564-honda-crv_2.png', '2024-09-24 09:37:21', '2024-09-27 01:56:05'),
(24, 'Toyota Harier black', 'Toyota', 'Harier', '2020', 'SUV', 9000.00, 1, 'uploads/1727216139-2824317-harier.jpg', '2024-09-24 22:15:39', '2024-09-27 01:56:09'),
(25, 'Toyota Premio new', 'Toyota', 'Premio', '2019', 'Sedan', 4000.00, 1, 'uploads/1727170200-9956306-PREMIO1.jpg', '2024-09-24 09:30:00', '2024-09-27 01:55:56'),
(26, 'Nissan X-Trail black', 'Nissan', 'X-Trail', '2022', 'SUV', 7000.00, 1, 'uploads/1727170544-4273045-x-trail_2.webp', '2024-09-24 09:35:44', '2024-09-27 01:56:03'),
(27, 'Toyota Axio blue', 'Toyota', 'Axio', '2023', 'Sedan', 3700.00, 1, 'uploads/1727170381-1074709-axio_2.jpg', '2024-09-24 09:33:01', '2024-09-27 01:56:00'),
(28, 'Toyota Harier red', 'Toyota', 'Harier', '2020', 'SUV', 9000.00, 1, 'uploads/1727216139-2824317-harier.jpg', '2024-09-24 22:15:39', '2024-09-27 01:56:09'),
(29, 'Honda CRV Black', 'Honda', 'CRV', '2018', 'SUV', 7500.00, 1, 'uploads/1727170641-3697564-honda-crv_2.png', '2024-09-24 09:37:21', '2024-09-27 01:56:05');

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
(5, '2024_09_16_174638_create_users_table', 1),
(6, '2024_09_16_174652_create_cars_table', 1),
(7, '2024_09_16_174707_create_rentals_table', 1),
(8, '2024_09_16_175021_create_sessions_table', 1),
(11, '2024_09_24_000850_add_status_to_rentals_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_cost` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Processing','Started','Canceled','Rejected','Completed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('hGF4V3tTSYX78lax5JnBXXqsLLjr2hYhp9b7BmIa', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibWxCTU5XcUhkQ1VaSFRKTFU3dHF2MzI3dzFGMmRZQUhNNVd0RFdDayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1727530650),
('XId84dP9Erc34SKXrOrvgJmY4iZE5inWR2Vz6Eir', NULL, '127.0.0.1', 'PostmanRuntime/7.40.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkNDR09FMU1Eb3pLdmhENXNCa3RraVRFVmVqdFhFRWxaTWI4WGNuMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9yZW50YWwvcmVudGFsLWJ5LWlkIjt9fQ==', 1727529622);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@carrental.com', '123', 'Admin', '2024-09-19 17:30:23', '2024-09-23 18:56:51'),
(2, 'Mirza Mezbah Uddin', 'mirza_mezbah@yahoo.com', '123', 'Customer', '2024-09-19 17:30:56', '2024-09-28 13:10:04'),
(17, 'Test User', 'test@carrental.com', '123', 'Customer', '2024-09-19 17:30:56', '2024-09-28 13:10:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rentals_user_id_foreign` (`user_id`),
  ADD KEY `rentals_car_id_foreign` (`car_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
