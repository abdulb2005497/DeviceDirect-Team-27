-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 12:34 AM
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
-- Database: `devicedirect`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `admin_log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `affected_table` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_logs`
--

INSERT INTO `admin_logs` (`admin_log_id`, `user_id`, `action`, `affected_table`, `timestamp`) VALUES
(1, 6, 'Updated product variant ID \'1\'. Changes: Colour changed from \'Black\' to \'Grey\'; Size changed from \'40 inch\' to \'30 inch\'; Price changed from \'£249.99\' to \'£249.99\'', 'product_variants', '2025-03-19 17:48:58'),
(2, 6, 'Updated product variant ID \'1\'. Changes: Colour changed from \'Grey\' to \'Black\'; Size changed from \'30 inch\' to \'40 inch\'; Price changed from \'£249.99\' to \'£249.99\'', 'product_variants', '2025-03-19 17:50:04'),
(3, 6, 'Updated user ID \'8\' (c@hotmail.com). Changes: First Name changed from \'Best\' to \'Bes\'; Email changed from \'c@hotmail.com\' to \'\'', 'users', '2025-03-19 18:03:34'),
(4, 6, 'Added new product \'sara\' (ID: 36), Category: Headphones, Colour: White, Size: 25 inch, Price: £199.99, Quantity: 2', 'product_variants', '2025-03-19 20:24:09'),
(5, 6, 'Updated product variant ID \'83\'. Changes: Category changed from \'Headphones\' to \'TVs\'; Colour changed from \'White\' to \'Grey\'; Size changed from \'25 inch\' to \'60 inch\'; Description updated; Quantity changed from \'2\' to \'22\'; Price changed from \'£199.99\' to \'£199.99\'', 'product_variants', '2025-03-19 20:24:36'),
(6, 6, 'Deleted product variant ID 83 (Product: sara, Colour: Grey, Size: 60 inch, Product ID: 36)', 'product_variants', '2025-03-19 20:24:48'),
(7, 6, 'Updated user ID \'8\' (). Changes: Email changed from \'\' to \'c@gmail.com\'', 'users', '2025-03-19 20:27:16'),
(8, 13, 'Updated product variant ID \'1\'. Changes: Category changed from \'TVs\' to \'Headphones\'; Price changed from \'£249.99\' to \'£249.99\'', 'product_variants', '2025-03-21 14:25:09'),
(9, 13, 'Updated product variant ID \'1\'. Changes: Category changed from \'Headphones\' to \'TVs\'; Price changed from \'£249.99\' to \'£249.99\'', 'product_variants', '2025-03-21 14:25:30'),
(10, 6, 'Updated order #18 to status: Processing', 'orders', '2025-03-21 14:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_variant_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `prod_variant_id`, `quantity`) VALUES
(38, 8, 13, 4),
(53, 16, 13, 1),
(61, 17, 58, 2),
(62, 6, 61, 2);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `code_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `discount_type` enum('percentage','fixed') NOT NULL,
  `expires_at` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`code_id`, `code`, `discount_value`, `discount_type`, `expires_at`, `is_active`, `created_at`) VALUES
(2, 'DD', 10.00, 'percentage', '2025-12-20', 1, '2025-03-14 14:59:26'),
(7, 'discount please', 25.00, 'percentage', '3222-12-24', 1, '2025-03-19 17:02:07');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `date_ordered` datetime DEFAULT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled','returned') DEFAULT 'pending',
  `address` text DEFAULT NULL,
  `city` varchar(128) NOT NULL,
  `postal_code` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `first_name`, `last_name`, `total_price`, `date_ordered`, `status`, `address`, `city`, `postal_code`) VALUES
(26, 6, 'Munib', 'shafi', 149.99, '2025-03-22 20:42:42', 'pending', '57A RHYDYPENAU ROAD', 'Cardiff', 'CF23 6PY'),
(28, 6, 'asdasd', 'Shafi', 599.96, '2025-03-23 14:37:10', 'pending', 'Rhyd-Y-Penau Road', 'Cardiff', 'CF23 6PZ'),
(29, 6, 'Munib', 'Shafi', 199.99, '2025-03-23 14:37:50', 'pending', 'Rhyd-Y-Penau Road', 'Cardiff', 'CF23 6PZ'),
(30, 6, 'Munib', 'shafi', 299.98, '2025-03-23 14:50:00', 'pending', '57A RHYDYPENAU ROAD', 'Cardiff', 'CF23 6PY'),
(32, 6, 'Munib', 'Shafi', 449.97, '2025-03-23 15:02:38', 'pending', 'Rhyd-Y-Penau Road', 'Cardiff', 'CF23 6PZ');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `colour_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price_per_unit` decimal(7,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `return_status` enum('No Request','Requested','Approved','Rejected','Returned') DEFAULT 'No Request'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `prod_id`, `colour_id`, `quantity`, `price_per_unit`, `total_price`, `size_id`, `return_status`) VALUES
(26, 2, 1, 1, 149.99, 149.99, 3, 'No Request'),
(28, 2, 1, 4, 149.99, 599.96, 3, 'No Request'),
(29, 2, 1, 1, 199.99, 199.99, 4, 'No Request'),
(30, 2, 1, 2, 149.99, 299.98, 3, 'No Request'),
(32, 2, 1, 3, 149.99, 449.97, 3, 'No Request');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(128) NOT NULL,
  `prod_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `prod_desc`) VALUES
(1, 'Samsung 8K HDR Smart TV ', 'Experience breathtaking visuals with the Samsung 8K HDR Smart TV. Featuring Quantum Dot Technology and AI-powered upscaling, this television delivers ultra-sharp clarity, vibrant colors, and deep contrasts. With Dolby Atmos and Object Tracking Sound, it creates an immersive cinematic experience. Powered by Tizen OS, it provides seamless access to apps like Netflix, YouTube, and Disney+.'),
(2, 'KOORUI Gaming Monitor, 165Hz, FHD, IPS', 'The KOORUI Gaming Monitor is built for competitive gamers who demand high performance. With a 165Hz refresh rate and 1ms response time, it eliminates motion blur and ensures ultra-smooth gameplay. The IPS panel offers vibrant colours and wide viewing angles, while adaptive sync technology prevents screen tearing. Perfect for eSports and fast-paced action games.'),
(3, 'LG UR78 UHD 4K Smart TV', 'Upgrade your entertainment with the LG UR78 UHD 4K Smart TV. Featuring a 4K UHD display with HDR10 support, it delivers exceptional picture quality and realism. Powered by the α5 AI Processor Gen6, it enhances contrast and sharpness in real-time. With webOS, you can access streaming services effortlessly, and ThinQ AI enables voice control for a smart home experience.'),
(4, 'Samsung Galaxy Book', 'The Samsung Galaxy Book is a sleek and lightweight laptop designed for professionals and students. Featuring a 13th Gen Intel Core processor, AMOLED display, and long battery life, it ensures seamless multitasking and stunning visuals. With Wi-Fi 6E support, S Pen compatibility, and Samsung ecosystem integration, it\'s perfect for work, creativity, and entertainment.\n\n'),
(5, 'Razer Blade 16', 'The Razer Blade 16 is a powerhouse gaming laptop featuring an Intel Core i9 processor, NVIDIA GeForce RTX 4090 GPU, and a 16-inch Mini-LED dual-mode display. With a 240Hz refresh rate, per-key RGB backlit keyboard, and advanced cooling system, it delivers top-tier performance for gamers and creators alike.\n\n'),
(6, 'MacBook Air', 'The MacBook Air is Apple\'s ultra-light laptop, now powered by the Apple M3 chip. It features a Retina Display, all-day battery life, and a fanless design for silent operation. With macOS Ventura, Touch ID, and a Magic Keyboard, it’s perfect for professionals, students, and creatives on the go.\n\n'),
(7, 'Lenovo IdeaPad', 'The Lenovo IdeaPad is a budget-friendly laptop designed for productivity and entertainment. Equipped with an AMD Ryzen or Intel Core processor, a Full HD display, and a lightweight design, it’s perfect for students and professionals who need an affordable yet powerful machine.\n\n'),
(8, 'Bose Ultra Open Earbuds', 'The Bose Ultra Open Earbuds offer high-fidelity audio in a lightweight and comfortable design. Featuring Bose OpenAudio technology, they deliver immersive sound without completely blocking outside noise. With long battery life, IPX4 water resistance, and touch controls, these earbuds are perfect for music lovers and active users.\n\n'),
(9, 'Sony WX1000XM5', 'The Sony WH-1000XM5 wireless headphones redefine noise cancellation with dual noise sensor technology. Offering hi-res audio, 30-hour battery life, and adaptive sound control, they provide the ultimate listening experience. With touch controls and multipoint connectivity, they’re perfect for commuting, work, and travel.\n\n'),
(10, 'PlayStation 4', 'The PlayStation 4 is a legendary gaming console with a massive library of exclusive titles. Featuring HDR support, high-performance processing, and PlayStation VR compatibility, it delivers an immersive gaming experience. With online multiplayer via PlayStation Plus, it’s still a great choice for gamers.\n\n'),
(11, 'PlayStation 5', 'The PlayStation 5 is Sony’s most advanced console, featuring ray tracing, 4K gaming at up to 120Hz, and the DualSense controller for immersive haptic feedback. With a growing library of next-gen games and ultra-fast SSD loading times, it’s the ultimate gaming machine.\n\n'),
(12, 'Xbox One', 'The Xbox One is a versatile gaming console that offers 4K HDR gaming, backward compatibility, and an extensive Game Pass library. Whether you\'re playing online multiplayer or streaming movies, the Xbox One is an excellent entertainment hub.\n\n'),
(13, 'Xbox Series X', 'The Xbox Series X is the most powerful Xbox yet, delivering true 4K gaming, 120Hz refresh rates, and ray tracing for ultra-realistic visuals. With Xbox Game Pass, an ultra-fast SSD, and quick resume, it’s designed for next-generation gaming performance.\n\n'),
(14, 'Nintendo 3DS', 'The Nintendo 3DS is a handheld gaming system known for its glasses-free 3D display and iconic games like Pokémon, Mario, and Zelda. Featuring StreetPass, dual-screen gameplay, and a massive game library, it’s a beloved console for retro and modern handheld gaming fans.\n\n'),
(15, 'Nintendo Switch', 'The Nintendo Switch is a hybrid console that works as both a home and portable gaming system. With an iconic lineup of games like Zelda, Mario Kart, and Super Smash Bros, plus multiplayer and online features, it\'s one of the best-selling consoles of all time.\n\n'),
(16, 'PHILIPS Evnia Full HD LCD', 'The PHILIPS Evnia Full HD LCD is designed for both productivity and entertainment. Featuring a 1920x1080 Full HD resolution, IPS panel technology, and a smooth refresh rate, it delivers vibrant colors and sharp details. With Adaptive Sync and low blue light technology, it ensures a comfortable and immersive viewing experience for gaming, streaming, and work.\n\n'),
(19, 'Samsung Odyssey G5 Curved', 'The Samsung Odyssey G5 is a 1000R curved gaming monitor that enhances immersion with its 27-inch WQHD (2560x1440) display and 144Hz refresh rate. With AMD FreeSync Premium, it eliminates screen tearing, while HDR10 support delivers stunning contrast and vivid colors. Ideal for competitive gamers seeking speed and responsiveness.\n\n'),
(20, 'MSI G2712F Full HD', 'The MSI G2712F is a 27-inch Full HD gaming monitor built for smooth and responsive gameplay. Featuring a 180Hz refresh rate, 1ms response time, and IPS panel technology, it ensures fast motion clarity and wide viewing angles. With Adaptive Sync and anti-flicker technology, it reduces eye strain while providing a seamless gaming experience.\n\n'),
(21, 'Alienware 4K QD-OLED Gaming Monitor - AW3225QF', 'The Alienware AW3225QF is a 4K QD-OLED gaming monitor that combines cutting-edge technology with stunning visuals. With true HDR performance, a 165Hz refresh rate, and 0.1ms response time, it offers an ultra-smooth gaming experience. NVIDIA G-SYNC Ultimate ensures tear-free gameplay, while the QD-OLED panel delivers deep blacks, rich colors, and incredible brightness.\n\n'),
(23, 'Beats Solo 4', 'The Beats Solo 4 headphones provide premium sound quality with custom acoustic drivers for deep bass and crisp highs. With Apple\'s H1 chip, they offer seamless connectivity to Apple devices, 40-hour battery life, and Fast Fuel charging for quick top-ups. Featuring on-ear controls, Active Noise Cancellation (ANC), and a lightweight design, they are perfect for all-day use.\n\n'),
(24, 'Skullcandy Crusher® ANC 2', 'The Skullcandy Crusher ANC 2 headphones are built for bass lovers, featuring adjustable sensory bass, Active Noise Cancellation, and personalized audio tuning. With up to 50 hours of battery life, multipoint Bluetooth connectivity, and built-in Tile tracking, they’re the ultimate travel and music companion.\n'),
(25, 'JBL Endurance Peak 3', 'The JBL Endurance Peak 3 are true wireless sports earbuds designed for active lifestyles. Featuring IP68 water and dust resistance, they can withstand intense workouts and outdoor adventures. With JBL Pure Bass Sound, PowerHook™ design for a secure fit, and 50 hours of total battery life, they deliver powerful audio wherever you go.\n\n'),
(26, 'Hisense E4NTUK Smart ', 'The Hisense E4NTUK Smart TV delivers 4K UHD resolution, Dolby Vision HDR, and AI-powered image processing for a stunning viewing experience. Running on VIDAA OS, it provides easy access to streaming services like Netflix, Prime Video, and YouTube. With voice control support, Game Mode Plus, and a sleek design, it’s an excellent entertainment hub for any home.\n\n'),
(27, 'Sony  BRAVIA X75WL 4K Ultra HD HDR Smart Google TV', 'The Sony BRAVIA X75WL is a 4K Ultra HD Smart TV powered by Google TV. Featuring X-Reality PRO upscaling, Motionflow XR technology, and HDR10 support, it delivers crystal-clear visuals with smooth motion. With Dolby Audio, Google Assistant integration, and Chromecast built-in, it offers a seamless smart home experience.\n\n'),
(28, 'asdasd', ''),
(29, 'asdasd', ''),
(30, 'asdasd', 'asd'),
(31, 'asd', 'asd'),
(32, 'asd', 'asd'),
(33, 'test produt', 'TEST DESC'),
(34, 'asd', 'asd'),
(35, 'new prod', 'log testSSSSS'),
(36, 'sara', 'sarassssss');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`category_id`, `category_name`) VALUES
(1, 'Monitors'),
(2, 'TVs'),
(3, 'Laptops'),
(4, 'Headphones'),
(5, 'Gaming Consoles');

-- --------------------------------------------------------

--
-- Table structure for table `product_colours`
--

CREATE TABLE `product_colours` (
  `colour_id` int(11) NOT NULL,
  `colour_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_colours`
--

INSERT INTO `product_colours` (`colour_id`, `colour_name`) VALUES
(1, 'Black'),
(2, 'Red'),
(3, 'White'),
(4, 'Grey'),
(5, 'Red & Blue'),
(6, 'Limited Edition'),
(7, 'Blue'),
(8, 'Pink');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`size_id`, `size_name`) VALUES
(1, '12 inch\r\n'),
(2, '16 inch'),
(3, '25 inch'),
(4, '30 inch'),
(5, '40 inch'),
(6, '60 inch'),
(7, '80 inch'),
(8, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `prod_variant_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `colour_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`prod_variant_id`, `product_id`, `category_id`, `colour_id`, `size_id`, `quantity`, `image`, `price`) VALUES
(1, 1, 2, 1, 5, 0, 'samsung 40.jpg', 249.99),
(2, 3, 2, 1, 5, 99, '4k lg 40.jpg', 249.99),
(5, 1, 2, 1, 6, 99, 'samsung 60.jpg', 249.99),
(7, 3, 2, 1, 6, 99, '4k lg 60.jpg', 299.99),
(9, 1, 2, 1, 7, 99, 'samsung 80.jpg', 299.99),
(11, 3, 2, 1, 7, 99, '4k lg 80.jpg', 349.99),
(13, 2, 1, 1, 3, 82, 'koorui 20.jpg', 149.99),
(17, 2, 1, 1, 4, 98, 'koorui 30.jpg', 199.99),
(19, 16, 1, 1, 4, 99, 'phillips 30 black.jpg', 249.99),
(20, 16, 1, 3, 4, 99, 'phillips 30 white.jpg', 259.99),
(21, 4, 3, 1, 1, 99, 'gbook black.jpg', 399.99),
(22, 4, 3, 3, 1, 99, 'gbook silver.jpg', 409.99),
(27, 5, 3, 3, 2, 99, 'razer blade 16 grey.jpg', 459.99),
(28, 5, 3, 1, 2, 99, 'razer blade 16 black.jpg', 449.99),
(31, 6, 3, 1, 2, 99, 'Airbook black.jpg', 449.99),
(32, 6, 3, 7, 2, 99, 'Airbook blue.jpg', 459.99),
(33, 7, 3, 1, 1, 99, 'ideapad black.jpg', 499.99),
(34, 7, 3, 3, 1, 99, 'ideapad grey_2.jpg', 509.99),
(35, 7, 3, 7, 2, 99, 'ideapad blue.jpg', 499.99),
(36, 7, 3, 3, 2, 99, 'ideapad grey.jpg', 509.99),
(37, 8, 4, 1, 8, 99, 'inearblack.jpg', 249.99),
(38, 8, 4, 3, 8, 99, 'inearwhite.jpg', 249.99),
(39, 8, 4, 7, 8, 99, 'inearblue.jpg', 249.99),
(40, 9, 4, 1, 8, 99, 'overearblack.jpg', 259.99),
(41, 9, 4, 3, 8, 99, 'overearwhite.jpg', 259.99),
(42, 9, 4, 8, 8, 99, 'overearpink.jpg', 259.99),
(43, 10, 5, 1, 8, 99, 'PS4 black.jpg', 199.99),
(44, 10, 5, 3, 8, 99, 'PS4 white.jpg', 209.99),
(45, 10, 5, 6, 8, 99, 'PS4 dragon quest.jpg', 249.99),
(46, 11, 5, 1, 8, 99, 'PS5 black.webp', 249.99),
(47, 11, 5, 3, 8, 99, 'PS5 white.jpg', 259.99),
(48, 11, 5, 6, 8, 99, 'ps5 spiderman.jpg', 299.99),
(49, 12, 5, 1, 8, 99, 'xbox one black.jpg', 199.99),
(50, 12, 5, 3, 8, 99, 'xbox one white.jpg', 209.99),
(51, 12, 5, 6, 8, 99, 'xbox one forza.jpg', 249.99),
(52, 13, 5, 1, 8, 99, 'xbox series x black.jpg', 199.99),
(53, 13, 5, 3, 8, 99, 'xbox series x white.jpg', 209.99),
(54, 13, 5, 6, 8, 99, 'xbox series x halo.jpg', 229.99),
(55, 14, 5, 1, 8, 99, '3ds black.jpg', 199.99),
(56, 14, 5, 7, 8, 99, '3ds blue.jpg', 209.99),
(57, 14, 5, 2, 8, 99, '3ds red.jpg', 229.99),
(58, 15, 5, 5, 8, 99, 'switch.jpg', 249.99),
(59, 15, 5, 3, 8, 99, 'Switch white.jpg', 259.99),
(60, 15, 5, 6, 8, 99, 'switch zelda.jpg', 299.99),
(61, 19, 1, 1, 4, 25, 'samsung odyssey.jpg', 299.99),
(62, 20, 1, 1, 4, 12, 'MSI G2712F Full HD.jpg', 259.99),
(63, 21, 1, 1, 4, 23, 'alienware.jpg', 349.99),
(64, 23, 4, 1, 8, 42, 'beats solo black.jpg', 249.99),
(65, 23, 4, 4, 8, 45, 'beats solo grey.jpg', 249.99),
(66, 23, 4, 7, 8, 45, 'beats solo blue.jpg', 249.99),
(67, 24, 4, 1, 8, 2, 'skull black.jpg', 199.99),
(68, 24, 4, 3, 8, 2, 'skull white.jpg', 199.99),
(69, 24, 4, 7, 8, 2, 'skull blue.jpg', 199.99),
(70, 25, 4, 1, 8, 21, 'jbl black.jpg', 149.99),
(71, 25, 4, 3, 8, 21, 'jbl white.jpg', 149.99),
(72, 25, 4, 7, 8, 21, 'jbl blue.jpg', 149.99),
(73, 26, 2, 1, 5, 34, 'hisense 40.jpg', 249.99),
(74, 26, 2, 1, 5, 34, 'hisense 80.jpg', 749.90),
(75, 27, 2, 1, 5, 56, 'sony braia 40.jpg', 299.99),
(76, 27, 2, 1, 6, 56, 'sony bravia 60.jpg', 349.99);

-- --------------------------------------------------------

--
-- Table structure for table `prod_reviews`
--

CREATE TABLE `prod_reviews` (
  `review_id` int(11) NOT NULL,
  `prod_variant_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prod_reviews`
--

INSERT INTO `prod_reviews` (`review_id`, `prod_variant_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(6, 17, 6, 4, 'balasdsad', '2025-03-18 12:44:18'),
(8, 13, 14, 4, 'good', '2025-03-21 14:38:45'),
(9, 58, 17, 4, 'ad', '2025-03-23 18:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `query_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `query_text` text DEFAULT NULL,
  `resolved` enum('No','Yes') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`query_id`, `user_id`, `fullname`, `email`, `query_text`, `resolved`) VALUES
(27, 8, 'Munib shafi', 'munib.s2005@gmail.com', 'asdasd', 'No'),
(28, 8, 'Munib shafi', 'munib.s2005@gmail.com', 'asdasd', 'No'),
(29, 8, 'asd', 'asd@gmail.com', 'asdasd', 'No'),
(30, 8, 'asdasd', 'munib.s2005@gmail.com', 'asd', 'No'),
(31, 8, 'Munib shafi', 'munib.s2005@gmail.com', 'asdasd', 'No'),
(32, 8, 'asd', 'munib.s2005@gmail.com', 'adddd', 'No'),
(33, 8, 'Munib shafi', 'munib.s2005@gmail.com', 'asdasd', 'No'),
(34, 17, 'Munib shafi', 'munib.s2005@gmail.com', 'asd', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `refund_requests`
--

CREATE TABLE `refund_requests` (
  `refund_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `requested_at` datetime DEFAULT current_timestamp(),
  `reviewed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `refund_requests`
--

INSERT INTO `refund_requests` (`refund_id`, `order_id`, `user_id`, `reason`, `status`, `requested_at`, `reviewed_at`) VALUES
(1, 28, 13, 'wrong', 'approved', '2025-03-22 20:25:29', '2025-03-23 14:36:47'),
(2, 29, 13, 'late', 'approved', '2025-03-23 14:37:52', '2025-03-23 14:43:54'),
(3, 30, 13, 'late', 'under_review', '2025-03-23 14:39:28', NULL),
(4, 31, 14, 'late', 'under_review', '2025-03-23 14:41:44', NULL),
(5, 27, 17, 'wrong', 'under_review', '2025-03-23 14:44:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(128) NOT NULL,
  `post_code` varchar(128) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'client',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `phone`, `address`, `city`, `post_code`, `password`, `role`, `created_at`) VALUES
(6, 'devicedirect', 'no', 'dd@gmail.com', '0123123123213', 'aston', 'cf', '0', '$2y$10$KBDtnyDFN5MQ4B34RXTPJedHNvq2EGi4bRhm4zyPY8tojxY.TDtru', 'admin', '2025-02-09 13:52:25'),
(8, 'Bes', 'Customer', 'c@gmail.com', '07745993464', '57A RHYDYPENAU', 'Birmingham', 'B5 5JRw', '$2y$10$wrh7aNiAc/MwZqWBLGFfvOGYs81269aUe/0u80rHnMmmd.mMOHpi.', 'user', '2025-03-11 16:49:41'),
(13, 'Munib', 'shafi', 'dd1@gmail.com', '07745993464', 'aston', 'university', 'b5 5jr', '$2y$10$l5xrPvTRiFgVz/oF8svnt.gEi8pCLGCg/QjgxwphWXL94sxlGZ5t6', 'admin', '2025-03-21 14:14:05'),
(14, 'Munib', 'shafi', 'munib@gmail.com', '07745993464', '57A RHYDYPENAU ROAD', 'Cardiff', 'CF23 6PY', '$2y$10$P5uRj4PrDLOsCMWjoWBcXOr8.i1WxxbHrasXX5psfGgEHGay9y3h6', 'user', '2025-03-21 14:37:53'),
(15, 'Munib', 'shafi', 'testuser@gmail.com', '07745993464', '57A RHYDYPENAU ROAD', 'Cardiff', 'CF23 6PY', '$2y$10$cYPG6bzSng.U2B0fLiUI7.weFArXzQV.SL3EdlOvgs.r0A4tSW.Gq', 'user', '2025-03-22 22:11:14'),
(16, 'test', 'test', 'test@test.com', '07745993464', '57A RHYDYPENAU ROAD', 'Cardiff', 'CF23 6PY', '$2y$10$fAXSrQTls5o1Sn386on6xOsvr689IIP0ddD7UGKeuHsdeCFu/9Bki', 'user', '2025-03-22 22:58:55'),
(17, 'Munib', 'shafi', 'test@gmail.com', '07745993464', '57A RHYDYPENAU ROAD', 'Cardiff', 'CF23 6PY', '$2y$10$dMIQMa.JI08IxokzVjvysOT6oRk5zsXz2T9wVXoU0JqDYYPhw2l.S', 'user', '2025-03-23 01:24:16'),
(19, 'Munib', 'shafi', 'munib.s2005@gmail.com', '07745993464', '57A RHYDYPENAU ROAD', 'Cardiff', 'CF23 6PY', '$2y$10$plqTCfzw8y4RxrP1341IOucK0RLFDdGD7E/lGvYLvrKlTPMNlrLka', 'user', '2025-03-23 22:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prod_variant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`admin_log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`prod_variant_id`),
  ADD KEY `prod_variant_id` (`prod_variant_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`code_id`),
  ADD UNIQUE KEY `code_text` (`code`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_id`,`prod_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `colour_id` (`colour_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product_colours`
--
ALTER TABLE `product_colours`
  ADD PRIMARY KEY (`colour_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`prod_variant_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `colour_id` (`colour_id`),
  ADD KEY `size_id` (`size_id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Indexes for table `prod_reviews`
--
ALTER TABLE `prod_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `prod_id` (`prod_variant_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prod_variant_id` (`prod_variant_id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`query_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `refund_requests`
--
ALTER TABLE `refund_requests`
  ADD PRIMARY KEY (`refund_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prod_variant_id` (`prod_variant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `admin_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_colours`
--
ALTER TABLE `product_colours`
  MODIFY `colour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `prod_variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `prod_reviews`
--
ALTER TABLE `prod_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `query_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `refund_requests`
--
ALTER TABLE `refund_requests`
  MODIFY `refund_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD CONSTRAINT `admin_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`prod_variant_id`) REFERENCES `product_variants` (`prod_variant_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`category_id`),
  ADD CONSTRAINT `product_variants_ibfk_2` FOREIGN KEY (`colour_id`) REFERENCES `product_colours` (`colour_id`),
  ADD CONSTRAINT `product_variants_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `product_sizes` (`size_id`);

--
-- Constraints for table `prod_reviews`
--
ALTER TABLE `prod_reviews`
  ADD CONSTRAINT `prod_reviews_ibfk_1` FOREIGN KEY (`prod_variant_id`) REFERENCES `product_variants` (`prod_variant_id`),
  ADD CONSTRAINT `prod_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `queries`
--
ALTER TABLE `queries`
  ADD CONSTRAINT `queries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`prod_variant_id`) REFERENCES `product_variants` (`prod_variant_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
