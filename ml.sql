-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2024 at 07:49 PM
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
-- Database: `calendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `ml`
--

CREATE TABLE `ml` (
  `id` int(11) NOT NULL,
  `air_temp` decimal(8,2) DEFAULT NULL,
  `soil_temp` decimal(8,2) DEFAULT NULL,
  `solar_rad` decimal(8,2) DEFAULT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ml`
--

INSERT INTO `ml` (`id`, `air_temp`, `soil_temp`, `solar_rad`, `date`, `status`) VALUES
(1, 26.07, 13.73, 660.13, '2024-01-01', 1),
(2, 13.21, 21.71, 886.02, '2024-01-02', 1),
(3, 19.89, 11.13, 634.87, '2024-01-03', 1),
(4, 20.87, 13.31, 992.22, '2024-01-04', 1),
(5, 26.65, 18.19, 705.95, '2024-01-05', 0),
(6, 10.64, 16.11, 770.38, '2024-01-06', 1),
(7, 20.64, 6.55, 459.35, '2024-01-07', 0),
(8, 39.00, 18.38, 556.75, '2024-01-08', 0),
(9, 33.22, 9.07, 756.54, '2024-01-09', 1),
(10, 17.51, 17.98, 596.18, '2024-01-10', 1),
(11, 14.69, 8.93, 611.53, '2024-01-11', 1),
(12, 20.99, 22.72, 464.36, '2024-01-12', 1),
(13, 39.45, 23.49, 741.18, '2024-01-13', 1),
(14, 10.55, 10.27, 410.13, '2024-01-14', 1),
(15, 34.73, 16.09, 439.51, '2024-01-15', 1),
(16, 18.07, 21.89, 532.10, '2024-01-16', 1),
(17, 24.01, 19.16, 311.18, '2024-01-17', 1),
(18, 23.10, 14.42, 235.28, '2024-01-18', 1),
(19, 37.26, 7.38, 894.48, '2024-01-19', 1),
(20, 19.48, 17.54, 350.34, '2024-01-20', 0),
(21, 31.84, 14.29, 311.81, '2024-01-21', 0),
(22, 13.12, 17.11, 772.36, '2024-01-22', 1),
(23, 29.76, 5.22, 262.50, '2024-01-23', 0),
(24, 26.65, 19.04, 874.84, '2024-01-24', 0),
(25, 10.95, 21.43, 208.93, '2024-01-25', 1),
(26, 37.79, 22.12, 601.40, '2024-01-26', 1),
(27, 15.86, 8.14, 358.10, '2024-01-27', 1),
(28, 39.88, 13.52, 314.30, '2024-01-28', 0),
(29, 32.56, 14.02, 999.27, '2024-01-29', 1),
(30, 16.49, 8.06, 292.83, '2024-01-30', 0),
(31, 17.76, 23.60, 898.22, '2024-01-31', 1),
(32, 39.87, 8.01, 812.88, '2024-02-01', 0),
(33, 27.85, 21.77, 526.25, '2024-02-02', 1),
(34, 21.84, 13.05, 862.35, '2024-02-03', 1),
(35, 15.37, 6.94, 958.87, '2024-02-04', 0),
(36, 22.38, 19.17, 443.49, '2024-02-05', 0),
(37, 12.06, 8.07, 649.95, '2024-02-06', 0),
(38, 12.09, 10.88, 409.05, '2024-02-07', 0),
(39, 20.15, 13.36, 260.09, '2024-02-08', 0),
(40, 21.48, 15.98, 676.68, '2024-02-09', 0),
(41, 36.30, 12.70, 435.65, '2024-02-10', 0),
(42, 31.19, 16.55, 815.70, '2024-02-11', 0),
(43, 17.97, 24.67, 296.15, '2024-02-12', 1),
(44, 36.79, 15.26, 908.87, '2024-02-13', 1),
(45, 33.95, 11.35, 353.98, '2024-02-14', 0),
(46, 24.18, 11.66, 397.96, '2024-02-15', 0),
(47, 23.44, 15.52, 429.22, '2024-02-16', 1),
(48, 22.34, 14.88, 388.63, '2024-02-17', 1),
(49, 33.35, 21.00, 732.18, '2024-02-18', 1),
(50, 29.04, 12.91, 258.05, '2024-02-19', 0),
(51, 29.99, 21.03, 206.06, '2024-02-20', 1),
(52, 14.40, 21.65, 777.17, '2024-02-21', 0),
(53, 21.59, 17.02, 876.87, '2024-02-22', 0),
(54, 27.97, 19.26, 814.78, '2024-02-23', 1),
(55, 16.27, 23.72, 242.76, '2024-02-24', 0),
(56, 14.06, 10.97, 270.25, '2024-02-25', 1),
(57, 23.54, 17.57, 830.45, '2024-02-26', 0),
(58, 37.29, 12.69, 354.51, '2024-02-27', 1),
(59, 24.45, 24.43, 530.01, '2024-02-28', 0),
(60, 25.09, 6.42, 877.41, '2024-02-29', 0),
(63, 28.04, 14.96, 748.41, '2024-03-01', 1),
(64, 28.38, 10.24, 577.89, '2024-03-02', 1),
(65, 23.81, 16.50, 594.50, '2024-03-03', 1),
(66, 16.82, 23.24, 903.36, '2024-03-04', 1),
(67, 29.79, 11.40, 696.71, '2024-03-05', 0),
(68, 35.80, 22.32, 799.55, '2024-03-06', 0),
(69, 25.01, 6.06, 811.56, '2024-03-07', 1),
(70, 10.60, 7.25, 601.00, '2024-03-08', 0),
(71, 20.29, 9.15, 206.10, '2024-03-09', 0),
(72, 11.71, 5.73, 209.87, '2024-03-10', 1),
(73, 31.67, 20.13, 692.39, '2024-03-11', 1),
(74, 15.76, 15.75, 289.14, '2024-03-12', 1),
(75, 21.63, 7.10, 490.22, '2024-03-13', 0),
(76, 22.11, 15.47, 525.47, '2024-03-14', 0),
(77, 12.88, 6.80, 328.88, '2024-03-15', 1),
(78, 15.93, 12.59, 443.66, '2024-03-16', 0),
(79, 10.25, 22.77, 534.46, '2024-03-17', 0),
(80, 36.04, 6.34, 784.35, '2024-03-18', 0),
(81, 11.97, 24.49, 739.37, '2024-03-19', 0),
(82, 16.56, 19.98, 271.51, '2024-03-20', 0),
(83, 31.87, 5.95, 239.14, '2024-03-21', 0),
(84, 21.03, 15.58, 634.14, '2024-03-22', 0),
(85, 10.09, 17.74, 340.56, '2024-03-23', 1),
(86, 19.30, 17.96, 447.29, '2024-03-24', 1),
(87, 12.49, 17.18, 836.57, '2024-03-25', 0),
(88, 21.14, 13.02, 913.00, '2024-03-26', 0),
(89, 27.79, 9.10, 397.48, '2024-03-27', 1),
(90, 20.58, 23.15, 584.03, '2024-03-28', 1),
(91, 38.39, 18.99, 726.77, '2024-03-29', 0),
(92, 39.83, 12.81, 974.49, '2024-03-30', 1),
(93, 23.33, 9.24, 782.15, '2024-03-31', 0),
(94, 26.87, 13.90, 631.09, '2024-04-01', 0),
(95, 15.35, 21.29, 629.91, '2024-04-02', 0),
(96, 28.17, 10.96, 739.05, '2024-04-03', 0),
(97, 20.50, 11.55, 670.35, '2024-04-04', 1),
(98, 10.59, 9.57, 266.65, '2024-04-05', 1),
(99, 22.16, 21.68, 962.65, '2024-04-06', 0),
(100, 23.92, 15.53, 391.18, '2024-04-07', 1),
(101, 20.90, 24.36, 800.44, '2024-04-08', 1),
(102, 39.74, 13.22, 264.58, '2024-04-09', 0),
(103, 28.35, 15.91, 914.95, '2024-04-10', 1),
(104, 24.27, 22.69, 995.89, '2024-04-11', 0),
(105, 28.64, 7.86, 880.50, '2024-04-12', 1),
(106, 27.11, 12.57, 345.24, '2024-04-13', 1),
(107, 19.48, 10.27, 495.86, '2024-04-14', 0),
(108, 15.49, 19.78, 316.92, '2024-04-15', 1),
(109, 13.93, 7.26, 337.81, '2024-04-16', 1),
(110, 12.84, 23.13, 399.07, '2024-04-17', 1),
(111, 36.27, 21.11, 519.40, '2024-04-18', 1),
(112, 31.12, 20.59, 828.02, '2024-04-19', 1),
(113, 27.35, 7.65, 940.71, '2024-04-20', 0),
(114, 21.57, 9.60, 994.11, '2024-04-21', 0),
(115, 21.70, 7.59, 581.73, '2024-04-22', 1),
(116, 26.67, 20.73, 411.42, '2024-04-23', 1),
(117, 10.59, 9.21, 995.66, '2024-04-24', 0),
(118, 31.61, 16.59, 788.19, '2024-04-25', 1),
(119, 24.59, 17.34, 700.89, '2024-04-26', 0),
(120, 25.53, 20.02, 362.02, '2024-04-27', 1),
(121, 15.64, 18.26, 800.46, '2024-04-28', 1),
(122, 27.05, 15.99, 233.93, '2024-04-29', 1),
(123, 30.74, 20.31, 802.51, '2024-04-30', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ml`
--
ALTER TABLE `ml`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ml`
--
ALTER TABLE `ml`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
