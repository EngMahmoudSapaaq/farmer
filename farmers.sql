-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2024 at 10:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmers`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `email`, `password`, `account_type`, `created_at`, `updated_at`) VALUES
(1, 'youssef@gmail.com', '$2y$10$th5TFRtEnRpzNvw0RxPGdenmi0Uc.G.f/I1j03mAwQ990GtqNB2Vu', 'Buyer', NULL, NULL),
(2, 'ali6644@gmail.com', '$2y$10$qaGwk8X47CcMjVJd9IEoj.A5pH0lTp4h/5HRFicqgVUPpt6vJHlM6', 'Buyer', NULL, NULL),
(3, 'osama@gmail.com', '$2y$10$2N1D1vD2Sw68XAOB2c8qi.7Jl8jgV2PYAnYXKStJhPL2AlQDH30VS', 'Farmer', NULL, NULL),
(4, 'testing@gmail.com', '$2y$10$iCxG3BKBPGTX9dnngi4VYuosfQWlcu0Mp3QxCm1yLCD5HHOOtiirS', 'Farmer', NULL, NULL),
(5, 'rrtt@gmail.com', '$2y$10$.0Hk/O5qj38KkJpuZjuFJ.oXEHpt.0xUGgp15uIHxD7Z0aAwRbJOO', 'Farmer', NULL, NULL),
(6, 'alaa@gmail.com', '$2y$10$r5DivGoETEHSeRod6U/vbe4WbvQ0ehi7zuJpoXv0I2WRAdYKXmPOu', 'Farmer', NULL, NULL),
(7, 'tawfeeq@gmail.com', '$2y$10$KTM.qFB6UKhTleq3..rVBO7DXk3/a//91Oi7XeS9xJoRmoCn/i1n6', 'Farmer', NULL, NULL),
(8, 'mido@gmail.com', '$2y$10$53X0nRdmNX9toWQF3AtAIeDQ1Y1QSfEB4ddGhDB.rJ.HuJOeEJW9G', 'Farmer', NULL, NULL),
(9, 'tarek@gmail.com', '$2y$10$e3tf09y48tCCWTDF3BukwOm9EgZ/iisjWwUBZcau2bDdSlFkpevPS', 'Farmer', NULL, NULL),
(10, 'fghfg@gmail.com', '$2y$10$.cHdwV3LziEsVYai52.s3O1vIWXFt9wb5Fjahy3bjv2hQlV56Dp5i', 'Buyer', NULL, NULL),
(11, 'mostafa@gmail.com', '$2y$10$DJwS/I3RDuU1OWZDqSH39OXGniS412Rxmx28NWKjtzPIeF0lFldfm', 'Farmer', NULL, NULL),
(12, 'mmnn@gmail.com', '$2y$10$1Nf6u1IZG1qFKJvDy9HB6uSECfcijDG.0Il8TrUOxLjojhJorG7PG', 'Farmer', NULL, NULL),
(13, 'hassan@gmail.com', '$2y$10$RH2MZVFaJAiLmfh.fjX8k.8zyBwHqr5DZIKmzfZdPDfuczdFN1dS.', 'Farmer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@farmer.com', '$2y$10$V1bBou4DZv.8c7jHcjkeW.5xUFmbfOva.0q3xXuJbe7Nh23lcZCn.', '2024-03-12 22:29:53', '2024-03-12 22:29:53');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `reciever_id` bigint(20) UNSIGNED NOT NULL,
  `sender_user_type` enum('farmer','user') NOT NULL,
  `seen_user` tinyint(1) NOT NULL DEFAULT 0,
  `seen_farmer` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `message`, `sender_id`, `reciever_id`, `sender_user_type`, `seen_user`, `seen_farmer`, `created_at`) VALUES
(10, 'test', 6, 2, 'user', 0, 1, '2024-03-26 23:47:40'),
(11, 'second', 6, 2, 'user', 0, 1, '2024-03-26 23:47:48'),
(12, 'hello', 6, 3, 'user', 0, 0, '2024-03-26 23:59:54'),
(13, 'hola', 6, 2, 'user', 0, 1, '2024-03-27 00:01:12'),
(14, 'hola', 6, 2, 'user', 0, 1, '2024-03-27 00:01:40'),
(15, 'hola', 6, 2, 'user', 0, 1, '2024-03-27 00:02:23'),
(16, 'test', 8, 2, 'user', 1, 1, '2024-03-28 00:46:35'),
(17, 'test res', 2, 8, 'farmer', 1, 1, '2024-03-28 01:26:00'),
(18, 'test res', 2, 8, 'farmer', 1, 1, '2024-03-28 01:29:49');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_account` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `commercial_number` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('pending','activated','rejected','blocked') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `name`, `email`, `password`, `phone`, `bank_name`, `bank_account`, `image`, `commercial_number`, `location`, `status`, `created_at`, `updated_at`) VALUES
(2, 'ahmed', 'ahmed@farmer.com', '$2y$10$hBFoWGmoyuiPNLAWVnWPGunE1Xz7cA3ihLN6LLfouKie25dzCSGE2', '0512674978', 'Jaddah', '0054416545678', '1711577342.jpg', '4965489498', 'Jeddah', 'activated', '2024-03-05 19:32:21', '2024-03-05 19:32:21'),
(3, 'salem', 'salem@farmer.com', '$2y$10$rGso6K8.zNW4VAvIiig/UOxyjcCiBxRSXhItcELAFdOuNOaBljhom', '0516489749', 'Jaddah', 'Jaddah', 'farmer.jpg', '00056487', 'Riyadh', 'activated', '2024-03-05 23:53:04', '2024-03-05 23:53:04'),
(4, 'Farmer 1', 'farmer1@farmer.com', '$2y$10$hnpec6YetMH7BO/MANSf9eJ50LM/TG4H7tpjwiOlbvB3N5nzZWe6a', '0512345675', 'test', '65498748', '1711597961.jpg', '888888888888888', NULL, 'pending', NULL, NULL),
(5, 'ttt', 'test@gmail.com', '$2y$10$x1PH.gdZELAam/hQnnYeWef8VQj1FK2Yr.GBmPBPMrJuGjwl212di', '0598764321', 'gggg', '5665767', NULL, '546546546', NULL, 'pending', NULL, NULL),
(7, 'Osama Ali', 'osama@gmail.com', '$2y$10$2N1D1vD2Sw68XAOB2c8qi.7Jl8jgV2PYAnYXKStJhPL2AlQDH30VS', '0587321543', 'gdfgd', '6756756756', NULL, '456565464', NULL, 'pending', NULL, NULL),
(8, 'rtre', 'testing@gmail.com', '$2y$10$iCxG3BKBPGTX9dnngi4VYuosfQWlcu0Mp3QxCm1yLCD5HHOOtiirS', '0598764321', 'dfds', '5345453434', NULL, '454545', NULL, 'pending', NULL, NULL),
(9, 'ttyy', 'rrtt@gmail.com', '$2y$10$.0Hk/O5qj38KkJpuZjuFJ.oXEHpt.0xUGgp15uIHxD7Z0aAwRbJOO', '0567432154', 'errwerwe', '56546546546', NULL, '45465656', NULL, 'pending', NULL, NULL),
(10, 'Alaa Ali', 'alaa@gmail.com', '$2y$10$r5DivGoETEHSeRod6U/vbe4WbvQ0ehi7zuJpoXv0I2WRAdYKXmPOu', '0567432164', 'dfsdgf', '56546546546', NULL, '786776', NULL, 'pending', NULL, NULL),
(11, 'Tawfeeq', 'tawfeeq@gmail.com', '$2y$10$KTM.qFB6UKhTleq3..rVBO7DXk3/a//91Oi7XeS9xJoRmoCn/i1n6', '0587639872', 'dfsdgf', '56546546546', NULL, '654654645', NULL, 'pending', NULL, NULL),
(12, 'Ali Ahmed', 'mido@gmail.com', '$2y$10$53X0nRdmNX9toWQF3AtAIeDQ1Y1QSfEB4ddGhDB.rJ.HuJOeEJW9G', '0598763214', 'errwerwe', '6756756756', NULL, '43576765', NULL, 'pending', NULL, NULL),
(13, 'tarek', 'tarek@gmail.com', '$2y$10$e3tf09y48tCCWTDF3BukwOm9EgZ/iisjWwUBZcau2bDdSlFkpevPS', '0587643216', 'errwerwe', '56546546546', NULL, '7676786788', NULL, 'pending', NULL, NULL),
(14, 'mostafa', 'mostafa@gmail.com', '$2y$10$DJwS/I3RDuU1OWZDqSH39OXGniS412Rxmx28NWKjtzPIeF0lFldfm', '0598763421', 'errwerwe', '56546546546', NULL, '7676786788', NULL, 'pending', NULL, NULL),
(15, 'MMnn', 'mmnn@gmail.com', '$2y$10$1Nf6u1IZG1qFKJvDy9HB6uSECfcijDG.0Il8TrUOxLjojhJorG7PG', '0598764321', 'errwerwe', '56546546546', NULL, '7676786788', NULL, 'pending', NULL, NULL),
(16, 'hassan', 'hassan@gmail.com', '$2y$10$RH2MZVFaJAiLmfh.fjX8k.8zyBwHqr5DZIKmzfZdPDfuczdFN1dS.', '0598764321', 'errwerwe', '56546546546', NULL, '7676786788', NULL, 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `farmer_orders`
--

CREATE TABLE `farmer_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `farmer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `farmer_orders`
--

INSERT INTO `farmer_orders` (`id`, `order_id`, `farmer_id`, `created_at`, `updated_at`) VALUES
(25, 21, 2, '2024-03-20 19:50:31', NULL),
(26, 22, 2, '2024-03-20 19:56:28', NULL),
(27, 23, 2, '2024-03-27 00:03:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_type` enum('bank','deliver','online') NOT NULL,
  `rate` decimal(2,1) UNSIGNED NOT NULL DEFAULT 0.0,
  `message` text DEFAULT NULL,
  `status` enum('done','rejected','pending') NOT NULL DEFAULT 'pending',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `payment_type`, `rate`, `message`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(21, 'bank', 4.5, 'test\r\n\r\n\r\ntes', 'rejected', 7, '2024-03-20 19:50:31', NULL),
(22, 'online', 0.0, NULL, 'rejected', 7, '2024-03-20 19:56:28', NULL),
(23, 'bank', 0.0, NULL, 'done', 6, '2024-03-27 00:03:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(26, 21, 11, 5.00, '2024-03-28 02:23:58', '2024-03-28 02:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `type` enum('veg','fer') NOT NULL DEFAULT 'veg',
  `image` varchar(255) DEFAULT NULL,
  `farmer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `quantity`, `price`, `type`, `image`, `farmer_id`, `created_at`, `updated_at`) VALUES
(11, 'carrot', 'carrot is good', 300, 100.00, 'veg', '1711578459.jpg', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `city`, `street`, `district`, `created_at`, `updated_at`) VALUES
(1, '', 'test user', '$2y$10$zh3frrv3TvyE5vfNW8ZCR.i6fIilamFg20RB9NnQhHtxLwsOLtRCm', '', '', '', '', '2024-03-05 19:19:55', '2024-03-05 19:19:55'),
(6, 'user', 'user@farmer.com', '$2y$10$tJPXi1TBjxfwYCvzLENXRubmF4HcX7WmQ.x/lSAzwRjYF.5T1MVyS', '0512345675', 'test', 'test', 'test', NULL, NULL),
(7, 'test 2', 'test@farmer.com', '$2y$10$L4ZXaT0KTgIiKWChpzHkNuyCfnuUX/pbhYbYNuvT1aN4znMxCRc3y', '0512345675', 'test', 'test', 'test', NULL, NULL),
(8, 'user2', 'user2@farmer.com', '$2y$10$vshjBajOh0jeUSqG8qZDIOMHaCeo2nfZCtbQvy7CyWJTcZlz5tnc.', '0512345675', 'city', 'str', 'distr', NULL, NULL),
(9, 'Ali Ali Ali', 'ali2244@gmail.com', '$2y$10$MHo2wohO17..2.m7zSaX9eVdbCODhDT4B8s4RtA8zxRZqQQtKXpoa', '0576439872', 'rtre', 'rtret', 'yyy', NULL, NULL),
(17, 'Youssef Ali', 'youssef@gmail.com', '$2y$10$th5TFRtEnRpzNvw0RxPGdenmi0Uc.G.f/I1j03mAwQ990GtqNB2Vu', '0598734214', 'hh', 'bb', 'uu', NULL, NULL),
(18, 'wewe', 'rrr@gmail.com', '$2y$10$l6KTsgjIUvM6OZHghYReNOBMQ40/1ItApRH163uAGBujLXqMcFYme', '0587643212', 'ff', 'rr', 'vv', NULL, NULL),
(19, 'Ali Osama', 'ali6644@gmail.com', '$2y$10$qaGwk8X47CcMjVJd9IEoj.A5pH0lTp4h/5HRFicqgVUPpt6vJHlM6', '0548763214', 'dd', 'ee', 'tt', NULL, NULL),
(20, 'fgfdgdf', 'fghfg@gmail.com', '$2y$10$.cHdwV3LziEsVYai52.s3O1vIWXFt9wb5Fjahy3bjv2hQlV56Dp5i', '0598764321', 'gfhg', 'tretre', 'uiyuy', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `reciever_id` (`reciever_id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `farmers_email_unique` (`email`);

--
-- Indexes for table `farmer_orders`
--
ALTER TABLE `farmer_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer_orders_order_id_foreign` (`order_id`),
  ADD KEY `farmer_orders_farmer_id_foreign` (`farmer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`),
  ADD KEY `order_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_farmer` (`farmer_id`);

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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `farmer_orders`
--
ALTER TABLE `farmer_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `farmer_orders`
--
ALTER TABLE `farmer_orders`
  ADD CONSTRAINT `farmer_orders_farmer_id_foreign` FOREIGN KEY (`farmer_id`) REFERENCES `farmers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `farmer_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_farmer` FOREIGN KEY (`farmer_id`) REFERENCES `farmers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
