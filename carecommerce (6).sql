-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 02:44 PM
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
-- Database: `carecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand_images`
--

CREATE TABLE `brand_images` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand_images`
--

INSERT INTO `brand_images` (`id`, `image_path`) VALUES
(1, 'br1.png'),
(2, 'br2.png'),
(3, 'br3.png'),
(4, 'br4.png'),
(5, 'br5.png'),
(6, 'br6.png'),
(10, 'nissanaltima2022-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `carimages`
--

CREATE TABLE `carimages` (
  `ImageID` int(11) NOT NULL,
  `CarID` int(11) NOT NULL,
  `ImageName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carimages`
--

INSERT INTO `carimages` (`ImageID`, `CarID`, `ImageName`) VALUES
(67, 1, 'toyotacamry2022-0.jpg'),
(68, 1, 'toyotacamry2022-2.jpg'),
(69, 1, 'toyotacamry2022-1.png'),
(72, 2, 'fordmustang2023-1.jpg'),
(73, 2, 'fordmustang2023.jpg'),
(74, 3, 'hondaaccord2024-4.jpg'),
(75, 3, 'hondaaccord2024-2.jpg'),
(76, 3, 'hondaaccord2024-1.png'),
(77, 3, 'hondaaccord2024.jpg'),
(78, 4, 'toyotacorolla2021-4.jpg'),
(79, 4, 'toyotacorolla2021-3.jpg'),
(80, 4, 'toyotacorolla2021-2.jpg'),
(81, 4, 'toyotacorolla2021-1.jpg'),
(82, 5, 'hondacivic2022-4.jpeg'),
(83, 5, 'hondacivic2022-1.jpg'),
(84, 5, 'hondacivic2022.jpg'),
(85, 5, 'hondacivic2022-2.avif'),
(86, 6, 'fordfusion2020-2.jpg'),
(87, 6, 'fordfusion2020-1.jpg'),
(88, 6, 'fordfusion2020.jpg'),
(89, 7, 'chevroletmalibo2021-3.jpg'),
(90, 7, 'chevroletmalibo2021-1.avif'),
(91, 7, 'chevroletmalibo2021.jpg'),
(92, 8, 'nissanaltima2022-3.jpg'),
(93, 8, 'nissanaltima2022.jpeg'),
(94, 9, 'hundiasonata20220-3.jpg'),
(95, 9, 'hundiasonata2022-1.jpg'),
(96, 9, 'hundiasonata2022.jpg'),
(97, 10, 'kiaiptima2021-3.jpg'),
(98, 10, 'kiaiptima2021-2.jpg'),
(99, 10, 'kiaiptima2021.jpg'),
(100, 11, 'mazda62022-3.jpg'),
(101, 11, 'mazda62022-1.jpg'),
(102, 11, 'mazda62022.jpg'),
(103, 12, 'subarulegacy2020-1.jpg'),
(104, 12, 'subarulegacy2020.avif'),
(105, 12, 'subarulegacy2020-2.webp'),
(106, 13, 'volksvakenpassat2021-4.webp'),
(107, 13, 'volksvakenpassat2021-1.jpg'),
(108, 13, 'volksvakenpassat2021.jpg'),
(109, 14, 'bmw3series2022-3.jpg'),
(110, 14, 'bmw3series2022-1.jpg'),
(111, 14, 'bmw3series2022.webp'),
(112, 15, 'Mercedes-Benz C-Class2020-3.jpg'),
(113, 15, 'Mercedes-Benz C-Class2020-2.jpg'),
(114, 15, 'Mercedes-Benz C-Class2020-1.jpg'),
(115, 16, 'audiA42021-3.avif'),
(116, 16, 'audiA42021-2.jpg'),
(117, 16, 'audiA42021-1.jpg'),
(118, 60, 's402000volvo-5.jpg'),
(119, 60, 's402000volvo-4.jpg'),
(120, 60, 's402000volvo-3.jpg'),
(121, 60, 's402000volvo-2.jpg'),
(122, 60, 's402000volvo-1.jpg'),
(123, 61, 'Lamborghini Aventador SV 2018-3.jpg'),
(124, 61, 'Lamborghini Aventador SV 2018-2.jpg'),
(125, 61, 'Lamborghini Aventador SV 2018-1.jpg'),
(131, 2, '09-1664372491056@2x.jpg'),
(132, 2, 'fordmustang.jpeg'),
(133, 64, 'toyotarav42023-1.jpg'),
(134, 64, 'toyotarav42023.jpg'),
(135, 65, 'Honda-CR-V-21.avif'),
(136, 65, 'Honda-CR-V-2.jpg'),
(137, 66, 'fordexplorer2023-1.avif'),
(138, 66, 'fordexplorer2023.webp'),
(139, 67, 'chevsiv2.webp'),
(140, 67, 'chevsiv1.jpeg'),
(141, 68, 'nissanRogue2.jpg'),
(142, 68, 'nissanRogue1.jpeg'),
(143, 69, 'hyundiatucson2.jpg'),
(144, 69, 'hyundiatucson1.jpg'),
(145, 70, 'kiayull12.avif'),
(146, 70, 'kiayull1.jpg'),
(147, 71, 'mazdacx5.jpeg'),
(148, 71, 'mazdacx51.jpg'),
(149, 72, 'sabaru20231.jpg'),
(150, 72, 'sabaru2023.jpeg'),
(151, 73, 'sabaru2023.jpg'),
(152, 73, 'sabaru20231-0.jpg'),
(153, 73, 'sabaru2023-0.jpeg'),
(154, 74, 'x320231.jpeg'),
(155, 74, 'x320231.jpg'),
(156, 75, 'Mercedes-AMG-GLC63s-28.jpg'),
(157, 75, 'Mercedes-AMG-GLC63s-26.jpg'),
(158, 75, 'Mercedes-AMG-GLC63s-27.jpg'),
(159, 76, 'AudiQ51.jpg'),
(160, 76, 'AudiQ5.jpg'),
(161, 77, 'highlander1.jpg'),
(162, 77, 'highlander.jpg'),
(163, 78, 'toyotapilot1.jpeg'),
(164, 78, 'toyotapilot.jpeg'),
(165, 79, 'toyotapilot2.jpg'),
(166, 79, 'ford1501.jpeg'),
(167, 79, 'ford150.webp');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CarID` int(11) NOT NULL,
  `Make` varchar(50) NOT NULL,
  `Model` varchar(50) NOT NULL,
  `Year` int(11) NOT NULL,
  `Price` decimal(10,2) NOT NULL,
  `Description` text DEFAULT NULL,
  `DateAdded` date DEFAULT curdate(),
  `isNew` tinyint(1) NOT NULL DEFAULT 1,
  `quantity` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `gear` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarID`, `Make`, `Model`, `Year`, `Price`, `Description`, `DateAdded`, `isNew`, `quantity`, `type`, `gear`) VALUES
(1, 'Toyota', 'Camry', 2022, 25000.00, 'A reliable and fuel-efficient sedan.', '2024-01-01', 1, 6, 'Cars and Minivans', 'Automatic'),
(2, 'Ford', 'Mustang', 2023, 35000.00, 'A classic American muscle car.', '2024-02-01', 1, 8, 'Cars and Minivans', 'Automatic'),
(3, 'Honda', 'Accord', 2024, 28000.00, 'A versatile midsize sedan.', '2024-03-15', 1, 20, 'Cars and Minivans', 'Automatic'),
(4, 'Toyota', 'Corolla', 2021, 20000.00, 'Compact and reliable', '2024-01-01', 1, 12, 'Cars and Minivans', 'Automatic'),
(5, 'Honda', 'Civic', 2022, 21000.00, 'Fuel-efficient and modern', '2024-01-02', 1, 15, 'Cars and Minivans', 'Automatic'),
(6, 'Ford', 'Fusion', 2020, 22000.00, 'Spacious and safe', '2024-01-03', 0, 9, 'Cars and Minivans', 'Automatic'),
(7, 'Chevrolet', 'Malibu', 2021, 23000.00, 'Comfortable and tech-savvy', '2024-01-04', 1, 8, 'Cars and Minivans', 'Automatic'),
(8, 'Nissan', 'Altima', 2022, 24000.00, 'Stylish and efficient', '2024-01-05', 1, 10, 'Cars and Minivans', 'Automatic'),
(9, 'Hyundai', 'Sonata', 2020, 25000.00, 'Reliable and powerful', '2024-01-06', 0, 7, 'Cars and Minivans', 'Automatic'),
(10, 'Kia', 'Optima', 2021, 26000.00, 'Sporty and dynamic', '2024-01-07', 1, 11, 'Cars and Minivans', 'Automatic'),
(11, 'Mazda', '6', 2022, 27000.00, 'Elegant and high-performance', '2024-01-08', 1, 6, 'Cars and Minivans', 'Automatic'),
(12, 'Subaru', 'Legacy', 2020, 28000.00, 'Durable and all-wheel drive', '2024-01-09', 0, 5, 'Cars and Minivans', 'Automatic'),
(13, 'Volkswagen', 'Passat', 2021, 29000.00, 'Luxurious and comfortable', '2024-01-10', 1, 14, 'Cars and Minivans', 'Automatic'),
(14, 'BMW', '3 Series', 2022, 40000.00, 'Premium and performance-oriented.Fast and effective', '2024-01-11', 1, 13, 'Cars and Minivans', 'Automatic'),
(15, 'Mercedes-Benz', 'C-Class', 2020, 45000.00, 'Luxury and advanced features', '2024-01-12', 0, 4, 'Cars and Minivans', 'Automatic'),
(16, 'Audi', 'A4', 2021, 42000.00, 'Sleek and technologically advanced', '2024-01-13', 1, 10, 'Cars and Minivans', 'Automatic'),
(60, 'Volvo', 's40', 2000, 2000.00, 'Reliable and Strong.', '2024-07-17', 0, 1, 'Cars and Minivans', 'Automatic'),
(61, 'Lamborghini', 'Aventador SV', 2018, 20000.00, 'No need to describe this masterpeice.', '2024-07-18', 1, 1, 'Cars and Minivans', 'Manual'),
(64, 'Toyota', 'RAV4', 2023, 32000.00, 'Versatile and reliable compact SUV.', '2024-08-04', 1, 10, 'SUV', 'Automatic'),
(65, 'Honda', 'CR-V', 2023, 31000.00, 'Spacious and fuel-efficient crossover.', '2024-08-04', 1, 8, 'SUV', 'Automatic'),
(66, 'Ford', 'Explorer', 2023, 38000.00, 'Powerful and spacious midsize SUV.', '2024-08-04', 1, 6, 'SUV', 'Automatic'),
(67, 'Chevrolet', 'Silverado', 2023, 40000.00, 'Robust and capable full-size pickup truck.', '2024-08-04', 1, 7, 'Truck', 'Automatic'),
(68, 'Nissan', 'Rogue', 2023, 29000.00, 'Comfortable and tech-savvy compact SUV.', '2024-08-04', 1, 9, 'SUV', 'Automatic'),
(69, 'Hyundai', 'Tucson', 2023, 28000.00, 'Stylish and feature-packed compact SUV.', '2024-08-04', 1, 11, 'SUV', 'Automatic'),
(70, 'Kia', 'Telluride', 2023, 36000.00, 'Award-winning midsize SUV with luxurious features.', '2024-08-04', 1, 5, 'SUV', 'Automatic'),
(71, 'Mazda', 'CX-5', 2023, 30000.00, 'Upscale and sporty compact SUV.', '2024-08-04', 1, 8, 'SUV', 'Automatic'),
(72, 'Subaru', 'Outback', 2023, 31000.00, 'Versatile and adventure-ready wagon-style SUV.', '2024-08-04', 1, 7, 'SUV', 'Automatic'),
(73, 'Volkswagen', 'Tiguan', 2023, 29000.00, 'Refined and spacious compact SUV.', '2024-08-04', 1, 9, 'SUV', 'Automatic'),
(74, 'BMW', 'X3', 2023, 45000.00, 'Luxurious and sporty compact luxury SUV.', '2024-08-04', 1, 6, 'SUV', 'Automatic'),
(75, 'Mercedes-Benz', 'GLC', 2023, 47000.00, 'Elegant and high-tech compact luxury SUV. Reliable and effective.', '2024-08-04', 1, 5, 'SUV', 'Automatic'),
(76, 'Audi', 'Q5', 2023, 46000.00, 'Sophisticated and powerful compact luxury SUV.', '2024-08-04', 1, 7, 'SUV', 'Automatic'),
(77, 'Toyota', 'Highlander', 2023, 37000.00, 'Spacious and reliable midsize SUV.', '2024-08-04', 1, 8, 'SUV', 'Automatic'),
(78, 'Honda', 'Pilot', 2023, 38000.00, 'Family-friendly and capable midsize SUV.', '2024-08-04', 1, 6, 'SUV', 'Automatic'),
(79, 'Ford', 'F-150', 2023, 42000.00, 'Best-selling full-size pickup truck.', '2024-08-04', 1, 10, 'Truck', 'Automatic');

-- --------------------------------------------------------

--
-- Table structure for table `car_features`
--

CREATE TABLE `car_features` (
  `FeatureID` int(11) NOT NULL,
  `CarID` int(11) DEFAULT NULL,
  `Transmission` varchar(100) DEFAULT NULL,
  `FuelEconomy` varchar(50) DEFAULT NULL,
  `Engine` varchar(100) DEFAULT NULL,
  `DriveType` varchar(50) DEFAULT NULL,
  `PassengerCapacity` int(11) DEFAULT NULL,
  `DiscountPrice` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_features`
--

INSERT INTO `car_features` (`FeatureID`, `CarID`, `Transmission`, `FuelEconomy`, `Engine`, `DriveType`, `PassengerCapacity`, `DiscountPrice`) VALUES
(1, 1, '12-speed automatic', '28 city / 39 highway', '2.5L 4-cylinder', 'Front-wheel drive', 5, 23500.00),
(2, 2, '10-speed automatic', '21 city / 32 highway', '2.3L EcoBoost', 'Rear-wheel drive', 4, 33000.00),
(3, 3, 'CVT', '30 city / 38 highway', '1.5L Turbo 4-cylinder', 'Front-wheel drive', 5, 26500.00),
(4, 4, 'CVT', '31 city / 40 highway', '1.8L 4-cylinder', 'Front-wheel drive', 5, 19000.00),
(5, 5, 'CVT', '32 city / 42 highway', '2.0L 4-cylinder', 'Front-wheel drive', 5, 20000.00),
(6, 6, '6-speed automatic', '23 city / 34 highway', '1.5L EcoBoost', 'Front-wheel drive', 5, 20500.00),
(7, 7, '9-speed automatic', '29 city / 36 highway', '1.5L Turbo 4-cylinder', 'Front-wheel drive', 5, 21500.00),
(8, 8, 'CVT', '28 city / 39 highway', '2.5L 4-cylinder', 'Front-wheel drive', 5, 22500.00),
(9, 9, '8-speed automatic', '28 city / 38 highway', '2.5L 4-cylinder', 'Front-wheel drive', 5, 23500.00),
(10, 10, '8-speed automatic', '27 city / 37 highway', '1.6L Turbo 4-cylinder', 'Front-wheel drive', 5, 24500.00),
(11, 11, '6-speed automatic', '26 city / 35 highway', '2.5L 4-cylinder', 'Front-wheel drive', 5, 25500.00),
(12, 12, 'CVT', '27 city / 35 highway', '2.5L 4-cylinder', 'All-wheel drive', 5, 26500.00),
(13, 13, '8-speed automatic', '24 city / 36 highway', '2.0L Turbo 4-cylinder', 'Front-wheel drive', 5, 27500.00),
(14, 14, '8-speed automatic', '26 city / 36 highway', '2.0L Turbo 4-cylinder', 'Rear-wheel drive', 5, 38000.00),
(15, 15, '9-speed automatic', '24 city / 35 highway', '2.0L Turbo 4-cylinder', 'Rear-wheel drive', 5, 42500.00),
(16, 16, '7-speed dual-clutch', '25 city / 34 highway', '2.0L Turbo 4-cylinder', 'All-wheel drive', 5, 40000.00),
(17, 64, '8-speed automatic', '27 city / 35 highway', '2.5L 4-cylinder', 'All-wheel drive', 5, 30400.00),
(18, 65, 'CVT', '28 city / 34 highway', '1.5L Turbo 4-cylinder', 'All-wheel drive', 5, 29450.00),
(19, 66, '10-speed automatic', '21 city / 28 highway', '2.3L EcoBoost', 'Rear-wheel drive', 7, 36100.00),
(20, 67, '10-speed automatic', '20 city / 23 highway', '5.3L V8', 'Four-wheel drive', 6, 38000.00),
(21, 68, 'CVT', '26 city / 33 highway', '2.5L 4-cylinder', 'All-wheel drive', 5, 27550.00),
(22, 69, '8-speed automatic', '26 city / 33 highway', '2.5L 4-cylinder', 'All-wheel drive', 5, 26600.00),
(23, 70, '8-speed automatic', '20 city / 26 highway', '3.8L V6', 'All-wheel drive', 8, 34200.00),
(24, 71, '6-speed automatic', '25 city / 31 highway', '2.5L 4-cylinder', 'All-wheel drive', 5, 28500.00),
(25, 72, 'CVT', '26 city / 33 highway', '2.5L 4-cylinder', 'All-wheel drive', 5, 29450.00),
(26, 73, '8-speed automatic', '23 city / 30 highway', '2.0L Turbo 4-cylinder', 'Front-wheel drive', 5, 27550.00),
(27, 74, '8-speed automatic', '23 city / 29 highway', '2.0L Turbo 4-cylinder', 'All-wheel drive', 5, 42750.00),
(28, 75, '9-speed automatic', '22 city / 28 highway', '2.0L Turbo 4-cylinder', 'All-wheel drive', 5, 44650.00),
(29, 76, '7-speed dual-clutch', '23 city / 28 highway', '2.0L Turbo 4-cylinder', 'All-wheel drive', 5, 43700.00),
(30, 77, '8-speed automatic', '21 city / 29 highway', '3.5L V6', 'Front-wheel drive', 8, 35150.00),
(31, 78, '9-speed automatic', '20 city / 27 highway', '3.5L V6', 'All-wheel drive', 8, 36100.00),
(32, 79, '10-speed automatic', '20 city / 24 highway', '3.5L EcoBoost V6', 'Four-wheel drive', 5, 39900.00);

-- --------------------------------------------------------

--
-- Table structure for table `car_warranties`
--

CREATE TABLE `car_warranties` (
  `WarrantyID` int(11) NOT NULL,
  `CarID` int(11) DEFAULT NULL,
  `BumperToBumperMonthsMiles` varchar(100) DEFAULT NULL,
  `MajorComponentsMonths` varchar(100) DEFAULT NULL,
  `IncludedMaintenanceMonths` varchar(100) DEFAULT NULL,
  `RoadsideAssistanceMonths` varchar(100) DEFAULT NULL,
  `CorrosionPerforation` varchar(100) DEFAULT NULL,
  `AccessoriesMonths` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_warranties`
--

INSERT INTO `car_warranties` (`WarrantyID`, `CarID`, `BumperToBumperMonthsMiles`, `MajorComponentsMonths`, `IncludedMaintenanceMonths`, `RoadsideAssistanceMonths`, `CorrosionPerforation`, `AccessoriesMonths`) VALUES
(1, 1, '42 months / 36,000 miles', '60 months / 60,000 miles', '24 months / 25,000 miles', '24 months / unlimited miles', '60 months / unlimited miles', '6 months / 12,000 miles'),
(2, 2, '36 months / 36,000 miles', '60 months / 60,000 miles', 'Not included', '60 months / 60,000 miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(3, 3, '36 months / 36,000 miles', '60 months / 60,000 miles', '36 months / 36,000 miles', '36 months / 36,000 miles', '60 months / unlimited miles', '36 months / 36,000 miles'),
(4, 4, '36 months / 36,000 miles', '60 months / 60,000 miles', '24 months / 25,000 miles', '24 months / unlimited miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(5, 5, '36 months / 36,000 miles', '60 months / 60,000 miles', '36 months / 36,000 miles', '36 months / 36,000 miles', '60 months / unlimited miles', '36 months / 36,000 miles'),
(6, 6, '36 months / 36,000 miles', '60 months / 60,000 miles', 'Not included', '60 months / 60,000 miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(7, 7, '36 months / 36,000 miles', '60 months / 60,000 miles', 'Not included', '60 months / 60,000 miles', '72 months / 100,000 miles', '12 months / 12,000 miles'),
(8, 8, '36 months / 36,000 miles', '60 months / 60,000 miles', 'Not included', '36 months / 36,000 miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(9, 9, '60 months / 60,000 miles', '120 months / 100,000 miles', '36 months / 36,000 miles', '60 months / unlimited miles', '84 months / unlimited miles', '12 months / 12,000 miles'),
(10, 10, '60 months / 60,000 miles', '120 months / 100,000 miles', '12 months / 12,000 miles', '60 months / 60,000 miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(11, 11, '36 months / 36,000 miles', '60 months / 60,000 miles', 'Not included', '36 months / 36,000 miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(12, 12, '36 months / 36,000 miles', '60 months / 60,000 miles', '24 months / 24,000 miles', '36 months / 36,000 miles', '60 months / unlimited miles', '36 months / 36,000 miles'),
(13, 13, '48 months / 50,000 miles', '72 months / 72,000 miles', 'Not included', '36 months / 36,000 miles', '84 months / unlimited miles', '12 months / 12,000 miles'),
(14, 14, '48 months / 50,000 miles', '72 months / 72,000 miles', '36 months / 36,000 miles', '48 months / unlimited miles', '144 months / unlimited miles', '24 months / unlimited miles'),
(15, 15, '48 months / 50,000 miles', '72 months / 72,000 miles', '36 months / 36,000 miles', '48 months / 50,000 miles', '48 months / 50,000 miles', '48 months / 50,000 miles'),
(16, 16, '48 months / 50,000 miles', '72 months / 72,000 miles', '12 months / 10,000 miles', '48 months / unlimited miles', '144 months / unlimited miles', '48 months / 50,000 miles'),
(49, 64, '36 months / 36,000 miles', '60 months / 60,000 miles', '24 months / 25,000 miles', '24 months / unlimited miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(50, 65, '36 months / 36,000 miles', '60 months / 60,000 miles', '36 months / 36,000 miles', '36 months / 36,000 miles', '60 months / unlimited miles', '36 months / 36,000 miles'),
(51, 66, '36 months / 36,000 miles', '60 months / 60,000 miles', 'Not included', '60 months / 60,000 miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(52, 67, '36 months / 36,000 miles', '60 months / 60,000 miles', 'Not included', '60 months / 60,000 miles', '72 months / 100,000 miles', '12 months / 12,000 miles'),
(53, 68, '36 months / 36,000 miles', '60 months / 60,000 miles', 'Not included', '36 months / 36,000 miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(54, 69, '60 months / 60,000 miles', '120 months / 100,000 miles', '36 months / 36,000 miles', '60 months / unlimited miles', '84 months / unlimited miles', '12 months / 12,000 miles'),
(55, 70, '60 months / 60,000 miles', '120 months / 100,000 miles', '12 months / 12,000 miles', '60 months / 60,000 miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(56, 71, '36 months / 36,000 miles', '60 months / 60,000 miles', 'Not included', '36 months / 36,000 miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(57, 72, '36 months / 36,000 miles', '60 months / 60,000 miles', '24 months / 24,000 miles', '36 months / 36,000 miles', '60 months / unlimited miles', '36 months / 36,000 miles'),
(58, 73, '48 months / 50,000 miles', '72 months / 72,000 miles', 'Not included', '36 months / 36,000 miles', '84 months / unlimited miles', '12 months / 12,000 miles'),
(59, 74, '48 months / 50,000 miles', '72 months / 72,000 miles', '36 months / 36,000 miles', '48 months / unlimited miles', '144 months / unlimited miles', '24 months / unlimited miles'),
(60, 75, '48 months / 50,000 miles', '72 months / 72,000 miles', '36 months / 36,000 miles', '48 months / 50,000 miles', '48 months / 50,000 miles', '48 months / 50,000 miles'),
(61, 76, '48 months / 50,000 miles', '72 months / 72,000 miles', '12 months / 10,000 miles', '48 months / unlimited miles', '144 months / unlimited miles', '48 months / 50,000 miles'),
(62, 77, '36 months / 36,000 miles', '60 months / 60,000 miles', '24 months / 25,000 miles', '24 months / unlimited miles', '60 months / unlimited miles', '12 months / 12,000 miles'),
(63, 78, '36 months / 36,000 miles', '60 months / 60,000 miles', '36 months / 36,000 miles', '36 months / 36,000 miles', '60 months / unlimited miles', '36 months / 36,000 miles'),
(64, 79, '36 months / 36,000 miles', '60 months / 60,000 miles', 'Not included', '60 months / 60,000 miles', '60 months / unlimited miles', '12 months / 12,000 miles');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `valid_from` date NOT NULL,
  `valid_until` date NOT NULL,
  `usage_limit` int(11) NOT NULL DEFAULT 1,
  `times_used` int(11) NOT NULL DEFAULT 0,
  `status` enum('active','expired','used') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `discount`, `valid_from`, `valid_until`, `usage_limit`, `times_used`, `status`) VALUES
(1, 'SUMMER21', 15.00, '2024-07-01', '2024-09-01', 100, 1, 'active'),
(2, 'FALL22', 10.00, '2024-02-01', '2026-10-31', 50, 5, 'active'),
(3, 'WINTER23', 20.00, '2024-12-01', '2024-12-31', 30, 0, 'active'),
(4, 'SPRING24', 5.00, '2024-03-01', '2025-03-31', 20, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `instagram` varchar(200) NOT NULL,
  `linkedin` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`instagram`, `linkedin`, `twitter`, `facebook`, `id`) VALUES
('https://www.instagram.com/alisleiman0?igsh=MXduNjh2bjNpM3JqZg==', 'https://www.linkedin.com/in/AliSleiman11', 'https://x.com/alisleiman899?t=z-9l0OmX-r0mW8eyfT3XAg&s=09', 'https://www.facebook.com/ali.sleimam?mibextid=ZbWKwL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderDetailID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `CarID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `expected_delivery_date` date NOT NULL,
  `order_status` enum('pending','approved','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderDetailID`, `OrderID`, `CarID`, `Quantity`, `Price`, `color`, `address`, `city`, `country`, `zip_code`, `expected_delivery_date`, `order_status`) VALUES
(1, 29, 5, 1, 21000.00, 'White', '1600 Amphitheatre Parkway', 'Mountain View', 'United States', '94043', '2024-08-07', 'approved'),
(2, 29, 5, 2, 21000.00, 'Orange', '1600 Amphitheatre Parkway', 'Mountain View', 'United States', '94043', '2024-08-07', 'approved'),
(3, 29, 6, 2, 22000.00, 'Black', '1600 Amphitheatre Parkway', 'Mountain View', 'United States', '94043', '2024-08-07', 'approved'),
(4, 29, 2, 2, 35000.00, 'Black', '1600 Amphitheatre Parkway', 'Mountain View', 'United States', '94043', '2024-08-07', 'approved'),
(5, 30, 2, 2, 35000.00, 'Yellow', '1600 Amphitheatre Parkway', 'Mountain View', 'United States', '94043', '2024-08-07', 'pending'),
(6, 30, 2, 2, 35000.00, 'Red', '1600 Amphitheatre Parkway', 'Mountain View', 'United States', '94043', '2024-08-07', 'pending'),
(7, 30, 2, 2, 35000.00, 'Blue', '1600 Amphitheatre Parkway', 'Mountain View', 'United States', '94043', '2024-08-07', 'pending'),
(8, 31, 5, 1, 21000.00, 'Black', 'C. Montes Urales 445', 'Ciudad de México', 'Mexico', '11000', '2024-08-07', 'pending'),
(9, 32, 4, 4, 20000.00, 'Silver', 'Av. dos Andradas, 3000', 'Belo Horizonte', 'Germany', '10001', '2024-08-09', 'shipped'),
(10, 32, 8, 1, 24000.00, 'Black', 'Av. dos Andradas, 3000', 'Belo Horizonte', 'Germany', '10001', '2024-08-09', 'shipped'),
(11, 33, 1, 1, 25000.00, 'Red', 'C. Montes Urales 445', 'München', 'United States', '30260-070', '2024-08-10', 'pending'),
(12, 34, 1, 1, 25000.00, 'Black', 'Av. dos Andradas, 3000', 'Belo Horizonte', 'Germany', '80636', '2024-08-10', 'pending'),
(13, 35, 79, 13, 42000.00, 'Blue', 'Erika-Mann-Straße 33', 'Belo Horizonte', 'United States', '30260-070', '2024-08-11', 'pending'),
(14, 36, 5, 3, 21000.00, 'White', 'Erika-Mann-Straße 33', 'München', 'United States', '30260-070', '2024-08-11', 'pending'),
(15, 37, 67, 4, 40000.00, 'Blue', 'pep', 'pep', 'pep', 'pep', '2024-08-11', 'pending'),
(16, 38, 79, 4, 42000.00, 'Blue', 'pep', 'pep', 'joe', '10001', '2024-08-11', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `OrderDate` date NOT NULL,
  `TotalAmount` decimal(10,2) NOT NULL,
  `order_status` enum('pending','approved','shipped') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `OrderDate`, `TotalAmount`, `order_status`) VALUES
(29, 3, '2024-07-31', 150450.00, 'shipped'),
(30, 3, '2024-07-31', 210000.00, 'pending'),
(31, 3, '2024-07-31', 18900.00, 'shipped'),
(32, 3, '2024-08-02', 93600.00, 'shipped'),
(33, 3, '2024-08-03', 22500.00, 'pending'),
(34, 3, '2024-08-03', 22500.00, 'pending'),
(35, 1, '2024-08-04', 546000.00, 'pending'),
(36, 14, '2024-08-04', 63000.00, 'pending'),
(37, 1, '2024-08-04', 144000.00, 'pending'),
(38, 20, '2024-08-04', 168000.00, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `icon`, `image`) VALUES
(1, 'Largest Dealership of Car', 'Explore our vast selection of vehicles, offering new, used, and certified pre-owned cars to fit every budget and lifestyle.', 'flaticon-car', 'ppph1.jpg'),
(2, 'Unlimited Repair Warranty', 'Enjoy peace of mind with our comprehensive repair coverage, ensuring your car stays in top condition without extra costs.', 'flaticon-car-repair', 'ppph2.jpg'),
(3, 'Insurance Support', 'Get expert advice and support to choose the best insurance plan, ensuring you have the right coverage for your needs.', 'flaticon-car-1', 'ppph3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `banner` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `banner`) VALUES
(1, 'Welcome to Your Premier Car Dealership', 'Explore our extensive collection of top-quality vehicles and experience unparalleled customer service at Your Premier Car Dealership.', 'welcome-banner1-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `testimonial_text` text NOT NULL,
  `client_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `client_name`, `location`, `testimonial_text`, `client_image`) VALUES
(1, 'Tomas Lili', 'Qana,Lebanon', 'Sed ut pers unde omnis iste natus error sit voluptatem accusantium dolor laudan rem aperiam, eaque ipsa quae ab illo inventore verit', 'me.jpg'),
(2, 'Romi Rain', 'London', 'Sed ut pers unde omnis iste natus error sit voluptatem accusantium dolor laudan rem aperiam, eaque ipsa quae ab illo inventore verit.', 'c2.png'),
(3, 'John Doe', 'Washington', 'Sed ut pers unde omnis iste natus error sit voluptatem accusantium dolor laudan rem aperiam, eaque ipsa quae ab illo inventore verit.', 'c3.png'),
(5, 'pep', 'fpd', 'Sed ut pers unde omnis iste natus error sit voluptatem accusantium dolor laudan rem aperiam, eaque ipsa quae ab illo inventore verit', 'tate.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `CustomerID` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `DateSignedUp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usertype` varchar(50) DEFAULT 'customer',
  `Name` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`CustomerID`, `Email`, `PasswordHash`, `DateSignedUp`, `usertype`, `Name`) VALUES
(1, 'john.doe@example.com', '$2y$10$mQEttpE8.K1YBnVdatxbb.Sd2VbhNjUEY/zv03k9rRt6K6qjvxx2G', '2024-08-02 15:16:56', 'superadmin', 'John Doe'),
(3, 'clahroyale084@gmail.com', '$2y$10$91.WOxspwTtu5633e4o2TeFUvZl83jak1daWA.zunp/J376jdOQd.', '2024-07-20 18:08:55', 'customer', 'Ali Sleiman'),
(10, 'clahroyale0084@gmail.com', '$2y$10$ZOcAgqPRbRVp3W2XtvaTmeF5lugQrcu5E9/vIuKPlzXVwWLs7cARe', '2024-08-02 15:17:22', 'admin', 'Ali'),
(12, 'sleiman@gmail.com', '$2y$10$hz.ytpGoyZtDfKMihktYneGgDWxcM5Lu8p0toM2xGah790Tp7LY2m', '2024-07-28 16:52:18', 'customer', 'Ali'),
(14, 'teste@exemplo.us', '', '2024-08-04 12:51:41', 'admin', 'João Souza Silva'),
(15, 'teste4@exemplo.us', '', '2024-08-04 12:53:09', 'admin', 'Juan Francisco García Flores'),
(16, 'Ghanem@email.com', '$2y$10$FiPVc1R.te/hawAP9wrkj.klnYLnN3HQEasDuwgJg4sl/11u3Bztm', '2024-08-02 15:29:34', 'admin', 'Ali'),
(18, 'ali@gmail.com', '$2y$10$eIowhfZCDulv9tcVNpYToeLVrszCxi1hWNJflC52s.5FG1Xa2LOZC', '2024-08-04 10:36:29', 'customer', 'Ali Sleiman'),
(19, 'pep@gmail.com', '$2y$10$ZkJ4cVd7Q6DRMg.elIbiI.BZXBs2iM.GCtmwQ/J0KP6ipAzmbnWAa', '2024-08-04 10:48:34', 'customer', 'pep'),
(20, 'joe@email.com', '$2y$10$URCR0p3jzLCH/fU4IftU0.wDJCt3OC63JuwFZyZah3JVKA7aM0i/K', '2024-08-04 10:53:17', 'customer', 'joe');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `WishlistID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `CarID` int(11) DEFAULT NULL,
  `DateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`WishlistID`, `CustomerID`, `CarID`, `DateAdded`) VALUES
(16, 1, 3, '2024-07-29'),
(18, 1, 1, '2024-07-29'),
(19, 1, 10, '2024-07-29'),
(20, 1, 9, '2024-07-29'),
(30, 3, 1, '2024-08-02'),
(32, 3, 10, '2024-08-04'),
(33, 1, 79, '2024-08-04'),
(34, 14, 5, '2024-08-04'),
(35, 1, 67, '2024-08-04'),
(36, 3, 2, '2024-08-08'),
(37, 3, 3, '2024-08-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand_images`
--
ALTER TABLE `brand_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carimages`
--
ALTER TABLE `carimages`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `CarID` (`CarID`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CarID`);

--
-- Indexes for table `car_features`
--
ALTER TABLE `car_features`
  ADD PRIMARY KEY (`FeatureID`),
  ADD KEY `CarID` (`CarID`);

--
-- Indexes for table `car_warranties`
--
ALTER TABLE `car_warranties`
  ADD PRIMARY KEY (`WarrantyID`),
  ADD KEY `CarID` (`CarID`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderDetailID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `CarID` (`CarID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`WishlistID`),
  ADD KEY `fk_wishlist_customer` (`CustomerID`),
  ADD KEY `fk_wishlist_car` (`CarID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand_images`
--
ALTER TABLE `brand_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `carimages`
--
ALTER TABLE `carimages`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `car_features`
--
ALTER TABLE `car_features`
  MODIFY `FeatureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `car_warranties`
--
ALTER TABLE `car_warranties`
  MODIFY `WarrantyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `OrderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `WishlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carimages`
--
ALTER TABLE `carimages`
  ADD CONSTRAINT `CarID` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carimages_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`);

--
-- Constraints for table `car_features`
--
ALTER TABLE `car_features`
  ADD CONSTRAINT `car_features_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`);

--
-- Constraints for table `car_warranties`
--
ALTER TABLE `car_warranties`
  ADD CONSTRAINT `car_warranties_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `fk_orderdetails_carid` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_orderdetails_orderid` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `users` (`CustomerID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_wishlist_car` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wishlist_customer` FOREIGN KEY (`CustomerID`) REFERENCES `users` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
