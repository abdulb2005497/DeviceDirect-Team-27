-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 04:12 PM
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
(38, 8, 13, 4);

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
(2, 'DD', 10.00, 'percentage', '2025-12-20', 1, '2025-03-14 14:59:26');

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
(9, 6, 'aaa', 'a', 41.98, '2025-02-15 18:49:00', 'pending', 'a', 'a', 'a'),
(10, 6, 'a', 'a', 989.96, '2025-02-15 19:11:41', 'pending', 'a', 'a', 'a'),
(11, 6, 'a', 'a', 1049.95, '2025-02-16 16:48:23', 'shipped', 'a', 'a', 'a'),
(12, 8, 'Munib', 'shafi', 149.99, '2025-03-11 17:21:20', 'pending', '57A RHYDYPENAU ROAD', 'Cardiff', 'CF23 6PY'),
(13, 8, 'Munib', 'shafi', 459.98, '2025-03-11 17:33:56', 'shipped', '57A RHYDYPENAU ROAD', 'Cardiff', 'CF23 6PY'),
(16, 6, 'Munib', 'shafi', 269.98, '2025-03-14 14:59:40', 'processing', '57A RHYDYPENAU ROAD', 'Cardiff', 'CF23 6PY');

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
(9, 8, 1, 2, 20.99, 41.98, 8, 'No Request'),
(10, 1, 3, 1, 209.99, 209.99, 5, 'No Request'),
(10, 3, 3, 3, 259.99, 779.97, 5, 'No Request'),
(11, 1, 3, 5, 209.99, 1049.95, 5, 'No Request'),
(12, 2, 1, 1, 149.99, 149.99, 3, 'No Request'),
(13, 2, 1, 1, 149.99, 149.99, 3, 'No Request'),
(13, 3, 3, 1, 309.99, 309.99, 6, 'No Request'),
(16, 2, 1, 2, 149.99, 299.98, 3, 'No Request');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`) VALUES
(1, 'HD TV\n'),
(2, '2K Monitor'),
(3, '4K TV'),
(4, 'Windows Laptop'),
(5, 'Chromebook'),
(6, 'MacBook Air'),
(7, 'MacBook Pro'),
(8, 'In Ear Headphones'),
(9, 'Over Ear Headphones'),
(10, 'PS4'),
(11, 'PS5'),
(12, 'Xbox One'),
(13, 'Nintendo Wii'),
(14, 'Nintendo Wii U'),
(15, 'Nintendo Switch'),
(16, '4K Monitor');

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
(4, 'Grey');

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
(8, 'N/A\r\n');

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
  `prod_desc` text DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `price` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`prod_variant_id`, `product_id`, `category_id`, `colour_id`, `size_id`, `prod_desc`, `quantity`, `image`, `price`) VALUES
(1, 1, 2, 1, 5, 'Experience stunning visuals and immersive entertainment with the HD 40 Inch Black TV, the perfect addition to any home. Boasting crystal-clear picture quality, vibrant colors, and sleek modern design, this television is designed to enhance your viewing experience, whether you\'re watching your favorite movies, shows, or gaming. With advanced 4D surround sound technology and multiple connectivity options, including HDMI and USB, it\'s ready to integrate seamlessly into your setup. Limited Time Offer: Get this incredible HD TV at half the original price! Don\'t miss this opportunity to upgrade your entertainment system and bring cinematic visuals right to your living room. Click \"Add to Basket\" now to make it yours before the deal ends!\n', 99, 'HD-40-Black.webp', 199.99),
(2, 3, 2, 1, 5, 'Discover the brilliance of ultra-high definition with the 4K 40 Inch Black TV. Compact yet powerful, this TV combines sleek design with cutting-edge 4K resolution, offering unparalleled clarity and lifelike colour details. Perfect for bedrooms, kitchens, or smaller living spaces, this TV ensures every pixel delivers perfection, whether you’re streaming, gaming, or watching live TV. Complete with advanced sound technology and seamless connectivity through HDMI and USB, it’s designed to fit effortlessly into your modern lifestyle. Don’t miss out—upgrade to 4K quality now and enjoy an exclusive offer for a limited time only!\r\n', 99, '4K-40-Black.webp', 249.99),
(3, 1, 2, 3, 5, 'Experience stunning visuals and immersive entertainment with the HD 40 Inch White TV, the perfect addition to any home. Boasting crystal-clear picture quality, vibrant colours, and sleek modern design, this television is designed to enhance your viewing experience, whether you\'re watching your favourite movies, shows, or gaming. With advanced 4D surround sound technology and multiple connectivity options, including HDMI and USB, it\'s ready to integrate seamlessly into your setup. Limited Time Offer: Get this incredible HD TV at half the original price! Don\'t miss this opportunity to upgrade your entertainment system and bring cinematic visuals right to your living room. Click \"Add to Basket\" now to make it yours before the deal ends!\r\n', 99, 'HD-40-White.webp', 209.99),
(4, 3, 2, 3, 5, 'Discover the brilliance of ultra-high definition with the 4K 40 Inch White TV. Compact yet powerful, this TV combines sleek design with cutting-edge 4K resolution, offering unparalleled clarity and lifelike colour details. Perfect for bedrooms, kitchens, or smaller living spaces, this TV ensures every pixel delivers perfection, whether you’re streaming, gaming, or watching live TV. Complete with advanced sound technology and seamless connectivity through HDMI and USB, it’s designed to fit effortlessly into your modern lifestyle. Don’t miss out—upgrade to 4K quality now and enjoy an exclusive offer for a limited time only!\r\n', 99, '4k-40-White.webp', 259.99),
(5, 1, 2, 1, 6, 'Elevate your home entertainment experience with the HD 60 Inch Black TV, a stunning blend of size, style, and performance. Featuring crisp high-definition resolution, vivid colour reproduction, and a sleek aesthetic, this TV is the centrepiece for any living space. Whether you\'re watching blockbuster movies or binge-watching your favourite series, the expansive 60-inch display ensures you won’t miss a single detail. With 4D surround sound, HDMI, and USB ports for ultimate connectivity, it\'s ready to take your viewing experience to the next level. Don\'t wait—get this incredible HD TV today at an unbeatable price. Upgrade now to experience entertainment like never before!\r\n', 99, 'HD-60-Black.webp', 249.99),
(6, 1, 2, 3, 6, 'Elevate your home entertainment experience with the HD 60 Inch White TV, a stunning blend of size, style, and performance. Featuring crisp high-definition resolution, vivid colour reproduction, and a sleek aesthetic, this TV is the centrepiece for any living space. Whether you\'re watching blockbuster movies or binge-watching your favourite series, the expansive 60-inch display ensures you won’t miss a single detail. With 4D surround sound, HDMI, and USB ports for ultimate connectivity, it\'s ready to take your viewing experience to the next level. Don\'t wait—get this incredible HD TV today at an unbeatable price. Upgrade now to experience entertainment like never before!\r\n', 99, 'HD-60-White.webp', 259.99),
(7, 3, 2, 1, 6, 'Experience entertainment in breathtaking clarity with the 4K 60 Inch Black TV. With stunning ultra-high-definition visuals, lifelike colours, and a cinematic 60-inch display, this TV is built for serious viewing pleasure. Ideal for family movie nights or competitive gaming, it immerses you in a world of unparalleled detail and vibrant imagery. Boasting cutting-edge sound technology, along with HDMI and USB ports for easy connectivity, it’s ready to transform your entertainment space. Take advantage of this limited-time deal and bring home the ultimate 4K entertainment upgrade today!\n', 99, '4k-60-Black.webp', 299.99),
(8, 3, 2, 3, 6, 'Experience entertainment in breathtaking clarity with the 4K 60 Inch White TV. With stunning ultra-high-definition visuals, lifelike colours, and a cinematic 60-inch display, this TV is built for serious viewing pleasure. Ideal for family movie nights or competitive gaming, it immerses you in a world of unparalleled detail and vibrant imagery. Boasting cutting-edge sound technology, along with HDMI and USB ports for easy connectivity, it’s ready to transform your entertainment space. Take advantage of this limited-time deal and bring home the ultimate 4K entertainment upgrade today!\n', 99, '4k-60-White.webp', 309.99),
(9, 1, 2, 1, 7, 'Transform your living room into a personal cinema with the HD 80 Inch Black TV. With its massive display and crystal-clear high-definition resolution, this TV delivers a viewing experience that’s larger than life. Designed to impress, it showcases deep contrast, vibrant colours, and fluid motion—perfect for movies, gaming, or sports. Equipped with state-of-the-art audio and versatile connectivity options like HDMI and USB, this TV is built to integrate seamlessly into your setup. For a limited time, seize the chance to own this entertainment powerhouse at an extraordinary discount. Bring home the thrill of immersive visuals today!\r\n', 99, 'HD-80-Black.webp', 299.99),
(10, 1, 2, 3, 7, 'Transform your living room into a personal cinema with the HD 80 Inch White TV. With its massive display and crystal-clear high-definition resolution, this TV delivers a viewing experience that’s larger than life. Designed to impress, it showcases deep contrast, vibrant colours, and fluid motion—perfect for movies, gaming, or sports. Equipped with state-of-the-art audio and versatile connectivity options like HDMI and USB, this TV is built to integrate seamlessly into your setup. For a limited time, seize the chance to own this entertainment powerhouse at an extraordinary discount. Bring home the thrill of immersive visuals today!\r\n', 99, 'HD-80-White.webp', 309.99),
(11, 3, 2, 1, 7, 'Immerse yourself in cinematic brilliance with the 4K 80 Inch Black TV—the ultimate centrepiece for your entertainment space. Its enormous display paired with stunning 4K resolution ensures every scene comes to life with razor-sharp detail and vivid colour accuracy. Whether you’re hosting a movie marathon, gaming tournament, or sports viewing party, this TV delivers a truly immersive experience. With cutting-edge surround sound and versatile connectivity, it’s the perfect combination of technology and design. Limited Time Offer: Take this opportunity to own the pinnacle of home entertainment at a fraction of the cost. Click now to claim yours before it’s gone!\n', 99, '4k-80-Black.webp', 349.99),
(12, 3, 2, 3, 7, 'Immerse yourself in cinematic brilliance with the 4K 80 Inch White TV—the ultimate centrepiece for your entertainment space. Its enormous display paired with stunning 4K resolution ensures every scene comes to life with razor-sharp detail and vivid colour accuracy. Whether you’re hosting a movie marathon, gaming tournament, or sports viewing party, this TV delivers a truly immersive experience. With cutting-edge surround sound and versatile connectivity, it’s the perfect combination of technology and design. Limited Time Offer: Take this opportunity to own the pinnacle of home entertainment at a fraction of the cost. Click now to claim yours before it’s gone!\r\n', 99, '4k-80-White.webp', 359.99),
(13, 2, 1, 1, 3, 'Elevate your visual experience with this sleek 2K 25-inch monitor. Boasting a stunning 2560 x 1440 resolution, it delivers sharp, vibrant images for immersive gaming, productivity, or multimedia enjoyment. The monitor\'s minimalist black design blends seamlessly into any setup, while its ergonomic stand ensures adjustable comfort for long hours of use. Equipped with fast refresh rates and multiple connectivity options, it\'s perfect for tech enthusiasts and professionals alike.\r\n', 97, '2k-25-Black.webp', 149.99),
(14, 2, 1, 3, 3, 'Elevate your visual experience with this sleek 2K 25-inch monitor. Boasting a stunning 2560 x 1440 resolution, it delivers sharp, vibrant images for immersive gaming, productivity, or multimedia enjoyment. The monitor\'s minimalist black design blends seamlessly into any setup, while its ergonomic stand ensures adjustable comfort for long hours of use. Equipped with fast refresh rates and multiple connectivity options, it\'s perfect for tech enthusiasts and professionals alike.\r\n', 99, '2k-25-White.webp', 159.99),
(15, 16, 1, 1, 3, 'Discover extraordinary detail with this 4K 25-inch monitor, boasting an ultra-high-definition resolution of 3840 x 2160. Perfect for professionals, gamers, and content creators, it delivers breath-taking clarity and vibrant colours for an unmatched viewing experience. The sleek black design complements any setup, while its compact size ensures it fits seamlessly into any workspace. With advanced connectivity options and smooth performance, this monitor is a powerful blend of style and functionality, ideal for those who demand exceptional quality.\r\n', 99, '4k-25-black.webp', 199.99),
(16, 16, 1, 3, 3, 'Discover extraordinary detail with this 4K 25-inch monitor, boasting an ultra-high-definition resolution of 3840 x 2160. Perfect for professionals, gamers, and content creators, it delivers breath-taking clarity and vibrant colours for an unmatched viewing experience. The sleek black design complements any setup, while its compact size ensures it fits seamlessly into any workspace. With advanced connectivity options and smooth performance, this monitor is a powerful blend of style and functionality, ideal for those who demand exceptional quality.\r\n', 99, '4k-25-White.webp', 209.99),
(17, 2, 1, 1, 4, 'Experience unparalleled clarity with this 2K 30-inch monitor, offering a vibrant 2560 x 1440 resolution for crystal-clear visuals. Designed with productivity and entertainment in mind, its expansive screen provides ample space for multitasking and immersive viewing. The elegant black finish and slim bezel design add a modern touch to any workspace or gaming setup. Featuring a fast refresh rate, wide viewing angles, and versatile connectivity options, this monitor is built to deliver premium performance for work or play.\r\n', 99, '2k-30-Black.webp', 199.99),
(18, 2, 1, 3, 4, 'Experience unparalleled clarity with this 2K 30-inch monitor, offering a vibrant 2560 x 1440 resolution for crystal-clear visuals. Designed with productivity and entertainment in mind, its expansive screen provides ample space for multitasking and immersive viewing. The elegant black finish and slim bezel design add a modern touch to any workspace or gaming setup. Featuring a fast refresh rate, wide viewing angles, and versatile connectivity options, this monitor is built to deliver premium performance for work or play.\r\n', 99, '2k-30-White.webp', 209.99),
(19, 16, 1, 1, 4, 'Immerse yourself in stunning visuals with this 4K 30-inch monitor, featuring an impressive resolution of 3840 x 2160 for razor-sharp detail and vivid colour accuracy. Perfect for multitasking, gaming, or professional work, its expansive display provides ample screen real estate and an immersive viewing experience. The sleek black design with slim bezels adds a modern touch to any setup, while ergonomic features ensure long-lasting comfort. Equipped with fast refresh rates and multiple connectivity options, this monitor is built for performance and style, making it a must-have for power users.\n', 99, '4k-30-Black.webp', 249.99),
(20, 16, 1, 3, 4, 'Immerse yourself in stunning visuals with this 4K 30-inch monitor, featuring an impressive resolution of 3840 x 2160 for razor-sharp detail and vivid colour accuracy. Perfect for multitasking, gaming, or professional work, its expansive display provides ample screen real estate and an immersive viewing experience. The sleek black design with slim bezels adds a modern touch to any setup, while ergonomic features ensure long-lasting comfort. Equipped with fast refresh rates and multiple connectivity options, this monitor is built for performance and style, making it a must-have for power users.\r\n', 99, '4k-30-White.webp', 259.99),
(21, 4, 3, 1, 1, 'The 12-Inch Windows Laptop in bold black is a compact powerhouse for both work and entertainment. With the familiar Windows OS and efficient hardware, it’s perfect for multitasking, from editing documents to streaming your favorite shows. Its black finish adds a professional edge, while the lightweight design makes it easy to carry wherever you go. Featuring a sharp display and robust connectivity options, this laptop adapts seamlessly to your everyday needs.\r\n', 99, 'Windows-12-Black.webp', 399.99),
(22, 4, 3, 3, 1, 'Sleek and versatile, the 12-Inch Windows Laptop in white is designed for efficiency and style. Powered by the latest Windows OS, it offers a smooth and intuitive user experience, whether you\'re working, studying, or browsing. Its lightweight build, crisp display, and all-day battery life ensure you stay productive on the go. The bright white design adds a modern touch to its compact, feature-packed form, making it an ideal choice for professionals and students alike.\r\n', 99, 'Windows-12-White.webp', 409.99),
(23, 4, 3, 1, 2, 'Power and portability meet style in the 16-Inch Windows Laptop in black. With a spacious high-resolution display and the latest Windows OS, it’s designed for seamless multitasking and entertainment. Whether you’re working on a presentation, streaming content, or gaming, this laptop offers sharp visuals and smooth performance. Its sleek black design and lightweight build make it a versatile choice for professionals and students alike.\r\n', 99, 'Windows-16-Black.webp', 449.99),
(24, 4, 3, 3, 2, 'Elevate your work and play with the 16-Inch Windows Laptop in white. Featuring a large display and robust hardware, this laptop is perfect for multitasking, productivity, and entertainment. The bright white finish adds a modern touch, while the lightweight design ensures portability. With Windows OS and advanced connectivity options, it’s a reliable and stylish choice for anyone looking to stay productive and connected.\r\n', 99, 'Windows-16-White.webp', 459.99),
(25, 5, 3, 3, 1, 'Stay connected and productive with the 12-Inch Chromebook in pristine white. Featuring a fast-booting Chrome OS, this compact laptop is ideal for students and professionals who need a reliable device for work and study. Its lightweight build and slim design make it easy to carry, while the vibrant display ensures clear visuals for web browsing, streaming, or online classes. The clean white finish gives it a fresh, modern look that complements any style.\r\n', 99, 'Chromebook-12-white.webp', 459.99),
(26, 5, 3, 1, 1, 'The 12-Inch Chromebook in black offers an affordable yet premium computing experience. Perfect for students or casual users, this lightweight laptop features a fast Chrome OS for seamless web browsing, video streaming, and app usage. The black design is both modern and durable, while the 12-inch display provides crisp visuals for your daily tasks. With long battery life and built-in security, this Chromebook ensures worry-free use on the go.\r\n', 99, 'Chromebook-12-Black.webp', 449.99),
(27, 5, 3, 3, 2, 'Upgrade your productivity with the 16-Inch Chromebook in elegant white. Featuring a large display and the fast, efficient Chrome OS, this laptop is perfect for work, study, or entertainment. Its clean, modern design ensures it looks great in any setting, while the lightweight construction makes it easy to carry. With a sharp display and all-day battery life, this Chromebook is your go-to device for everyday tasks.\r\n', 99, 'Chromebook-16-white.webp', 459.99),
(28, 5, 3, 1, 2, 'The 16-Inch Chromebook in black combines affordability with a spacious display for an enhanced user experience. Ideal for students, professionals, and casual users, this laptop runs Chrome OS for fast, seamless browsing and app usage. The large 16-inch display offers sharp visuals, while the lightweight build makes it portable and convenient. Encased in a sleek black finish, this Chromebook is as stylish as it is functional.\r\n', 99, 'Chromebook-16-Black.webp', 449.99),
(29, 6, 3, 1, 1, 'The 12-Inch Airbook in sleek black is the ultimate companion for portability and performance. Its compact size makes it perfect for on-the-go professionals, while its robust build and elegant black finish exude sophistication. Featuring a stunning Retina display, lightning-fast SSD storage, and an advanced processor, it handles multitasking effortlessly. Whether you\'re editing documents, streaming content, or managing your projects, the 12-Inch Airbook is designed to deliver seamless performance in a lightweight package.\r\n', 99, 'Airbook-12-Black.webp', 449.99),
(30, 6, 3, 3, 1, 'Elevate your productivity with the 12-Inch Airbook in elegant white. This ultra-lightweight laptop combines style and functionality, featuring a crystal-clear Retina display and impressive battery life for all-day use. Whether you\'re working remotely or attending virtual meetings, the Airbook’s cutting-edge processor ensures smooth performance. The compact, minimalist design in white adds a modern touch, making it the perfect laptop for those who value both aesthetics and power.\r\n', 99, 'Airbook-12-White.webp', 459.99),
(31, 6, 3, 1, 2, 'The 16-Inch Airbook in sleek black delivers the ultimate combination of performance and portability in a larger display. Perfect for creative professionals and multitaskers, it features a Retina display that offers unparalleled color accuracy and detail. Backed by a lightning-fast processor and SSD storage, this Airbook is designed to handle resource-intensive tasks with ease. Its black finish exudes sophistication, making it a standout choice for those who demand both style and power.\r\n', 99, 'Airbook-16-black.webp', 449.99),
(32, 6, 3, 3, 2, 'Discover unparalleled productivity with the 16-Inch Airbook in pristine white. Designed for professionals on the go, this laptop features an expansive Retina display and an ultra-slim design for effortless portability. Whether you’re editing videos, designing graphics, or managing complex workflows, the Airbook’s advanced processor ensures flawless performance. The elegant white finish adds a premium touch, making it a laptop that’s as stylish as it is functional.\r\n', 99, 'Airbook-16-white.webp', 459.99),
(33, 7, 3, 1, 1, 'Step into high performance with the 12-Inch Probook in sleek black. Designed for professionals, this powerful laptop features an advanced processor, ample RAM, and fast SSD storage, making it ideal for intensive tasks like programming, graphic design, or data analysis. The compact 12-inch display ensures portability without compromising on quality, delivering sharp visuals and vibrant colors. Encased in a robust black shell, the Probook is the epitome of durability and sophistication.\r\n', 99, 'Probook-12-black.webp', 499.99),
(34, 7, 3, 3, 1, 'Unleash productivity with the 12-Inch Probook in stunning white. Built for professionals, this lightweight laptop combines a vibrant display with powerful performance, handling demanding applications with ease. Its ergonomic design and long-lasting battery make it perfect for extended work sessions, while its sleek white finish adds a touch of elegance to your workspace. Whether you’re working on presentations, coding, or creative projects, the Probook keeps you ahead.\r\n', 99, 'Probook-12-white.webp', 509.99),
(35, 7, 3, 1, 2, 'The 16-Inch Probook in black is built for professionals who need powerful performance in a sleek package. Featuring a large, high-resolution display, this laptop is perfect for intensive tasks like video editing, 3D modeling, or software development. Its robust hardware and ergonomic design ensure smooth multitasking and long-term comfort. The black finish adds a sophisticated, professional look to a laptop that means business.\r\n', 99, 'Probook-16-black.webp', 499.99),
(36, 7, 3, 3, 2, 'Maximize your productivity with the 16-Inch Probook in stunning white. Designed for professionals and creatives, this laptop features a spacious, high-resolution display and cutting-edge hardware to handle demanding tasks. Its slim, ergonomic design ensures comfort during extended use, while the elegant white finish enhances its modern appeal. Whether you’re at the office or working remotely, the Probook is your perfect productivity partner.\r\n', 99, 'Probook-16-white.webp', 509.99),
(37, 8, 4, 1, 8, 'Experience premium sound quality with these sleek in-ear headphones in black. Engineered for superior audio performance, they deliver crisp highs, deep bass, and immersive clarity, making them perfect for music, calls, or podcasts. The ergonomic design ensures a secure, comfortable fit for all-day wear, while the compact size makes them easy to carry wherever you go. With noise-isolation technology and durable construction, these black in-ear headphones are a must-have for audiophiles on the move.\r\n', 99, 'inearblack.webp', 20.99),
(38, 8, 4, 3, 8, 'Upgrade your listening experience with these stylish in-ear headphones in white. Featuring crystal-clear sound quality and a sleek, minimalist design, they’re perfect for work, travel, or workouts. The soft silicone ear tips provide a secure and comfortable fit, while noise-isolation technology blocks out distractions. Lightweight and portable, these white in-ear headphones combine elegance with exceptional performance for the ultimate listening experience.\r\n', 99, 'inearwhite.webp', 20.99),
(39, 8, 4, 4, 8, 'Discover unmatched comfort and sound clarity with these modern in-ear headphones in grey. Designed with precision audio drivers, they deliver balanced, high-quality sound for music, calls, or videos. The ergonomic design ensures a snug fit, while the understated grey finish adds a touch of sophistication. Compact and durable, these headphones are perfect for on-the-go users who demand style and performance in equal measure.\r\n', 99, 'ineargrey.webp', 20.99),
(40, 9, 4, 1, 8, 'Immerse yourself in powerful, studio-quality sound with these over-ear headphones in black. Designed for comfort and performance, they feature cushioned ear cups and an adjustable headband for a perfect fit. The advanced drivers deliver deep bass, clear mids, and vibrant highs, making them ideal for music enthusiasts, gamers, or professionals. With noise-cancelling technology and a sleek black design, these headphones ensure an uninterrupted listening experience, even in noisy environments.\r\n', 99, 'overearblack.webp', 40.99),
(41, 9, 4, 3, 8, 'Experience elegance and exceptional audio with these over-ear headphones in white. Combining comfort and style, they feature plush ear cushions and a lightweight frame for long listening sessions. The precision-tuned drivers provide dynamic sound with rich bass and crystal-clear highs, perfect for music, movies, or calls. Whether you’re at home or on the go, these noise-canceling white over-ear headphones deliver premium sound and timeless style.\r\n', 99, 'overearwhite.webp', 40.99),
(42, 9, 4, 4, 8, 'Experience premium sound and ultimate comfort with these over-ear headphones in grey. Featuring soft, cushioned ear cups and an adjustable headband, they’re designed for extended wear without fatigue. The advanced audio drivers deliver immersive, high-definition sound with deep bass and crisp detail, perfect for audiophiles and professionals alike. The sleek grey finish adds a modern touch to these versatile headphones, making them a stylish choice for any setting.\r\n', 99, 'overeargrey.webp', 40.99),
(43, 10, 5, 1, 8, 'The black PlayStation 4 delivers cutting-edge graphics and powerful performance in a sleek, modern package. Whether you’re diving into epic single-player campaigns or competing in fast-paced multiplayer matches, the PS4 ensures smooth gameplay and immersive visuals. Its expansive library includes critically acclaimed titles, catering to gamers of all interests. The console’s compact and stylish design fits seamlessly into any setup, while its intuitive interface and robust hardware make it a reliable choice for casual and hardcore gamers alike.\r\n', 99, 'PS4-black.webp', 199.99),
(44, 10, 5, 3, 8, 'The white PlayStation 4 offers a stunning combination of power and elegance, delivering exceptional gaming experiences for players of all levels. Its minimalist white finish adds a touch of sophistication to any entertainment space, while its powerful hardware ensures smooth performance for even the most demanding games. Whether you’re streaming movies, playing online with friends, or exploring richly detailed worlds, the white PS4 is built to impress. With an extensive library of exclusive titles, it’s the perfect console for those who value both style and substance.\r\n', 99, 'PS4%20white.webp', 209.99),
(45, 10, 5, 2, 8, 'Make a bold statement with the red PlayStation 4, a console that combines striking design with premium performance. Its vibrant red exterior sets it apart from the crowd, while its advanced hardware delivers breathtaking graphics and lightning-fast load times. Perfect for solo and multiplayer gaming, the red PS4 offers an extensive catalog of exclusive titles and immersive experiences. Whether you’re battling enemies, solving puzzles, or streaming content, this console is designed to elevate your entertainment setup.\r\n', 99, 'PS4%20red.webp', 249.99),
(46, 11, 5, 1, 8, 'The black PlayStation 5 is a next-gen powerhouse that redefines gaming with its sleek design and groundbreaking performance. Featuring lightning-fast SSD storage, stunning 4K graphics, and immersive DualSense controller technology, the PS5 delivers unmatched gaming experiences. Its bold black finish adds a professional and modern touch, making it a standout addition to any gaming setup. Whether you’re exploring massive open worlds or engaging in intense multiplayer battles, the black PS5 offers flawless performance for every gamer.\r\n', 99, 's5black.webp', 249.99),
(47, 11, 5, 3, 8, 'The white PlayStation 5 is a futuristic marvel that combines cutting-edge technology with a striking, minimalist design. Its ultra-fast SSD ensures seamless gameplay, while its 4K resolution and ray-tracing capabilities deliver breathtaking visuals. The DualSense controller introduces haptic feedback and adaptive triggers for a truly immersive experience. With a growing library of next-gen titles, the white PS5 is the ultimate console for gamers who demand both performance and style.\r\n', 99, 'PS5%20White.webp', 259.99),
(48, 11, 5, 2, 8, 'The red PlayStation 5 brings a bold, eye-catching design to the next generation of gaming. Its vibrant red exterior is paired with advanced hardware that offers lightning-fast load times, realistic 4K visuals, and revolutionary controller features. Whether you’re exploring vast open worlds or competing online, the red PS5 delivers unparalleled performance. Its striking design makes it a centerpiece in any entertainment setup, perfect for gamers who want to make a statement.\r\n', 99, 'PS5%20red.webp', 299.99),
(49, 12, 5, 1, 8, 'The black Xbox is a powerhouse designed for serious gamers, offering next-gen performance and a sleek, modern aesthetic. With support for 4K gaming, lightning-fast load times, and advanced hardware, it delivers an immersive experience across a wide range of titles. Its bold black finish adds a professional touch to any setup, while its seamless online connectivity ensures smooth multiplayer gameplay. Whether you’re streaming, gaming, or exploring expansive open worlds, the black Xbox delivers flawless performance.\r\n', 99, 'xboxblack.webp', 199.99),
(50, 12, 5, 3, 8, 'The white Xbox combines clean aesthetics with cutting-edge technology, making it an essential choice for modern gamers. With 4K capabilities, ultra-fast load times, and a vast library of games, it delivers a premium gaming experience. The sleek white design fits perfectly into any entertainment space, while its advanced cooling system ensures quiet, reliable performance. Whether you’re battling online or enjoying single-player adventures, the white Xbox has you covered.\r\n', 99, 'white.webp', 209.99),
(51, 12, 5, 2, 8, 'The red Xbox stands out with its bold, dynamic design and exceptional performance. Built for gamers who want both style and substance, it offers 4K gaming, smooth load times, and a seamless interface. Its vibrant red exterior adds a pop of color to your setup, while its powerful hardware ensures lag-free performance across all your favorite games. Perfect for casual players and hardcore enthusiasts, the red Xbox is a true gaming icon.\r\n', 99, 'red.webp', 249.99),
(52, 13, 5, 1, 8, 'Rediscover the joy of gaming with the iconic black Wii, a console that revolutionized home entertainment with its motion-based gameplay and intuitive controls. The sleek black finish adds a modern and sophisticated touch to any gaming setup, making it a standout addition to your entertainment space. Dive into a vast library of family-friendly games, from action-packed adventures to fitness challenges, all designed to bring people together. Whether you’re hosting a game night or enjoying solo play, the black Wii promises endless hours of fun with immersive and interactive gaming experiences.\n', 99, 'wiiblack.webp', 199.99),
(53, 13, 5, 3, 8, 'The white Wii is a timeless classic that combines innovation and simplicity, making it perfect for gamers of all ages. Its clean and minimalist design fits seamlessly into any home, while the intuitive motion controls bring a new level of interactivity to gaming. From iconic titles like Wii Sports to a wide range of multiplayer and single-player games, the white Wii delivers engaging entertainment for everyone. With its easy setup and family-oriented gameplay, this console is ideal for creating unforgettable memories with loved ones.\r\n', 99, 'Wii%20white.webp', 209.99),
(54, 13, 5, 3, 8, 'Add a splash of vibrancy to your gaming setup with the striking red Wii. This console combines bold aesthetics with innovative motion-based gameplay, making it a must-have for any enthusiast. Whether you’re swinging a tennis racket, bowling strikes, or embarking on thrilling adventures, the red Wii delivers unparalleled immersion and fun. Its compact design and colorful exterior make it an eye-catching addition to your home, while its extensive library of games ensures there’s something for everyone. Perfect for fitness enthusiasts, casual players, and families alike, the red Wii is a gaming powerhouse wrapped in a bold package.\r\n', 99, 'Wii%20red.webp', 229.99),
(55, 14, 5, 1, 8, 'Step into the next generation of gaming with the black Wii U, a console that combines high-definition visuals with innovative gameplay. Featuring the groundbreaking GamePad controller with a touchscreen, the Wii U opens up new ways to interact with games, offering dual-screen functionality and enhanced immersion. The sleek black design adds a touch of sophistication, making it a stylish centerpiece for your entertainment setup. Enjoy an extensive library of titles, from family-friendly classics to action-packed adventures, all designed to take advantage of the console’s unique capabilities. Whether you’re playing solo or with friends, the black Wii U is your gateway to unforgettable gaming experiences.\n', 99, 'wiiublack.webp', 199.99),
(56, 14, 5, 3, 8, 'The white Wii U redefines home gaming with its innovative features and stunning HD graphics. Its elegant white finish adds a fresh and modern aesthetic, making it a great addition to any living room. The GamePad controller allows for intuitive gameplay, offering a second screen for maps, inventories, or even off-TV play. Explore an impressive catalog of games that cater to players of all skill levels, from family-friendly adventures to competitive challenges. With its combination of style and performance, the white Wii U is perfect for gamers seeking a versatile and immersive console.\n', 99, 'Wii%20U%20white.webp', 209.99),
(57, 14, 5, 2, 8, 'Make a bold statement with the vibrant red Wii U, a console that merges cutting-edge technology with eye-catching design. Its dynamic red exterior sets it apart, while the GamePad controller introduces new possibilities for gameplay with its touchscreen and motion controls. Whether you’re exploring expansive open worlds, engaging in multiplayer battles, or enjoying classic Nintendo titles, the red Wii U delivers an unmatched gaming experience. Its HD graphics and seamless connectivity options ensure smooth performance, making it a perfect choice for gamers who value both style and substance.\r\n', 99, 'Wii%20U%20red.webp', 229.99),
(58, 15, 5, 1, 8, 'The black Nintendo Switch combines portability and versatility in a sleek, modern design. Whether you’re playing on the go or docking it for big-screen action, the Switch delivers a seamless gaming experience that adapts to your lifestyle. Its ergonomic Joy-Con controllers provide precision and comfort, while the vibrant display ensures crystal-clear visuals for handheld gaming. With a diverse library of games, including action-packed adventures, puzzles, and party games, the black Switch is perfect for solo players and groups alike. Its stylish black finish adds a professional touch, making it a must-have for gamers who value performance and aesthetics.\r\n', 99, 'switchblack.webp', 249.99),
(59, 15, 5, 3, 8, 'The white Nintendo Switch brings a fresh and elegant look to one of the most versatile consoles ever created. Perfect for gamers of all types, it transitions effortlessly between handheld, tabletop, and docked modes, offering unmatched flexibility. The Joy-Con controllers are comfortable and responsive, while the vibrant screen ensures stunning visuals in handheld mode. Whether you’re exploring vast open worlds, competing in multiplayer battles, or enjoying casual games with friends, the white Switch delivers endless entertainment. Its sleek, minimalist design makes it a stylish addition to any gaming setup.\r\n', 99, 'Switch%20white.webp', 259.99),
(60, 15, 5, 2, 8, 'Stand out with the bold red Nintendo Switch, a console that combines dynamic style with unmatched versatility. Designed for gamers on the go, it transitions seamlessly between handheld and docked modes, ensuring you can play anywhere, anytime. The vibrant red finish makes a striking statement, while the ergonomic Joy-Con controllers and immersive screen elevate your gaming experience. From fast-paced action to cooperative multiplayer games, the red Switch offers a rich library of titles to suit every taste. With its compact design and innovative features, it’s perfect for gamers who want both functionality and flair.\r\n', 99, 'switch%20red.webp', 299.99);

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
(33, 8, 'Munib shafi', 'munib.s2005@gmail.com', 'asdasd', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `First_name` varchar(50) NOT NULL,
  `Last_name` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'client',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `First_name`, `Last_name`, `Email`, `Phone`, `Address`, `password`, `role`, `created_at`) VALUES
(6, 'devicedirect', 'no', 'dd@gmail.com', '0123123123213', 'aston', '$2y$10$xypKa5bQPE3XFfMMm5pBjeDXMjYtwXHu01tkqRQECZg./OGMqgGtC', 'admin', '2025-02-09 13:52:25'),
(7, 'cust', 'customer', 'customer@gmail.com', '07745993464', '57A RHYDYPENAU ROAD', '$2y$10$G.YvchFny3FK0Ms1GBcR9OXUlsvDG8pkLlNzMLlH.bM1k6PQ1bdoK', 'user', '2025-03-11 16:34:22'),
(8, 'customER', 'customer', 'c@gmail.com', '07745993464', '57A RHYDYPENAU ROAD', '$2y$10$.WNvMiTx.4C.Q6NngJTcn.V2WD77EJm1i.PtP1UorbJ7SvHFpb12C', 'user', '2025-03-11 16:49:41');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_colours`
--
ALTER TABLE `product_colours`
  MODIFY `colour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `prod_variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `prod_reviews`
--
ALTER TABLE `prod_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `query_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
