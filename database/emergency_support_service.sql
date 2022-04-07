-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2022 at 05:48 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emergency_support_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `password`, `status`) VALUES
(1, 'admin', '1234', '1');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(2) NOT NULL,
  `district_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `district_name`) VALUES
(1, 'Comilla'),
(2, 'Feni'),
(3, 'Brahmanbaria'),
(4, 'Rangamati'),
(5, 'Noakhali'),
(6, 'Chandpur'),
(7, 'Lakshmipur'),
(8, 'Chattogram'),
(9, 'Coxsbazar'),
(10, 'Khagrachhari'),
(11, 'Bandarban'),
(12, 'Sirajganj'),
(13, 'Pabna'),
(14, 'Bogura'),
(15, 'Rajshahi'),
(16, 'Natore'),
(17, 'Joypurhat'),
(18, 'Chapainawabganj'),
(19, 'Naogaon'),
(20, 'Jashore'),
(21, 'Satkhira'),
(22, 'Meherpur'),
(23, 'Narail'),
(24, 'Chuadanga'),
(25, 'Kushtia'),
(26, 'Magura'),
(27, 'Khulna'),
(28, 'Bagerhat'),
(29, 'Jhenaidah'),
(30, 'Jhalakathi'),
(31, 'Patuakhali'),
(32, 'Pirojpur'),
(33, 'Barisal'),
(34, 'Bhola'),
(35, 'Barguna'),
(36, 'Sylhet'),
(37, 'Moulvibazar'),
(38, 'Habiganj'),
(39, 'Sunamganj'),
(40, 'Narsingdi'),
(41, 'Gazipur'),
(42, 'Shariatpur'),
(43, 'Narayanganj'),
(44, 'Tangail'),
(45, 'Kishoreganj'),
(46, 'Manikganj'),
(47, 'Dhaka'),
(48, 'Munshiganj'),
(49, 'Rajbari'),
(50, 'Madaripur'),
(51, 'Gopalganj'),
(52, 'Faridpur'),
(53, 'Panchagarh'),
(54, 'Dinajpur'),
(55, 'Lalmonirhat'),
(56, 'Nilphamari'),
(57, 'Gaibandha'),
(58, 'Thakurgaon'),
(59, 'Rangpur'),
(60, 'Kurigram'),
(61, 'Sherpur'),
(62, 'Mymensingh'),
(63, 'Jamalpur'),
(64, 'Netrokona');

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `id` int(200) NOT NULL,
  `user_id` int(30) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lon` varchar(255) NOT NULL,
  `supervisor_id` int(200) NOT NULL,
  `service_id` int(40) NOT NULL,
  `message` text NOT NULL,
  `optional_mobile` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `feedback` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emergency`
--

INSERT INTO `emergency` (`id`, `user_id`, `lat`, `lon`, `supervisor_id`, `service_id`, `message`, `optional_mobile`, `image`, `status`, `date`, `feedback`) VALUES
(1, 1, '23.7878894', '90.3751976', 2, 2, 'test', '01767270653', ' ', 'Complete', '2022-04-03 10:39:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emergency_feedback`
--

CREATE TABLE `emergency_feedback` (
  `id` int(200) NOT NULL,
  `emergency_id` int(255) NOT NULL,
  `reaction` varchar(255) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emergency_feedback`
--

INSERT INTO `emergency_feedback` (`id`, `emergency_id`, `reaction`, `feedback`) VALUES
(1, 1, 'Highly Satisfied', 'Wow'),
(2, 1, 'Highly Satisfied', 'Wow'),
(3, 1, 'Highly Satisfied', 'wow'),
(4, 1, 'Highly Satisfied', 'Wow');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_history`
--

CREATE TABLE `emergency_history` (
  `id` int(200) NOT NULL,
  `emergency_id` int(200) NOT NULL,
  `user_id` int(30) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lon` varchar(255) NOT NULL,
  `supervisor_id` int(200) NOT NULL,
  `service_id` int(40) NOT NULL,
  `message` text NOT NULL,
  `optional_mobile` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emergency_history`
--

INSERT INTO `emergency_history` (`id`, `emergency_id`, `user_id`, `lat`, `lon`, `supervisor_id`, `service_id`, `message`, `optional_mobile`, `image`, `status`, `date`) VALUES
(1, 1, 1, '23.7878894', '90.3751976', 2, 2, 'test', '01767270653', ' ', 'New', '2022-04-03 10:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `history_supervisor`
--

CREATE TABLE `history_supervisor` (
  `id` int(255) NOT NULL,
  `supervisor_id` varchar(255) NOT NULL,
  `super_name` varchar(255) NOT NULL,
  `login_status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_supervisor`
--

INSERT INTO `history_supervisor` (`id`, `supervisor_id`, `super_name`, `login_status`, `date`) VALUES
(1, '5', 'Ramzan', 'login', '2022-02-19 17:40:54'),
(2, '5', 'Ramzan', 'logout', '2022-02-19 17:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `live_supervisors`
--

CREATE TABLE `live_supervisors` (
  `id` int(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `nidPassport` varchar(255) NOT NULL,
  `supervisorDistrict` varchar(255) NOT NULL,
  `superviorUpazila` varchar(255) NOT NULL,
  `serviceArea` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `live_users`
--

CREATE TABLE `live_users` (
  `id` int(11) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `nidPassport` varchar(255) NOT NULL,
  `userDistrict` varchar(255) NOT NULL,
  `userUpazila` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `live_users`
--

INSERT INTO `live_users` (`id`, `phoneNumber`, `firstName`, `lastName`, `emailAddress`, `userName`, `password`, `dateOfBirth`, `nidPassport`, `userDistrict`, `userUpazila`, `latitude`, `longitude`, `ip_address`, `date`) VALUES
(5, '01516158298', 'Ramzan', 'Ali', 'mdramzanroni76@gmail.com', 'ramzan', '81dc9bdb52d04dc20036dbd8313ed055', '2022-02-19', '1234', '14', '1', '23.78777457142857', '90.37513192857143', '::1', '2022-02-18 19:13:23'),
(6, '01516158298', 'Ramzan', 'Ali', 'mdramzanroni76@gmail.com', 'ramzan', '81dc9bdb52d04dc20036dbd8313ed055', '2022-02-19', '1234', '14', '1', '23.7981653', '90.3664409', '::1', '2022-02-19 16:14:23'),
(1, '01516158298', 'Ramzan', 'Ali', 'mdramzanroni76@gmail.com', 'ramzan', '81dc9bdb52d04dc20036dbd8313ed055', '2022-03-06', '1234', '14', '1', '23.7981436', '90.3658341', '::1', '2022-03-06 18:26:21'),
(1, '01516158298', 'Ramzan', 'Ali', 'mdramzanroni76@gmail.com', 'ramzan', '81dc9bdb52d04dc20036dbd8313ed055', '2022-03-06', '1234', '14', '1', '23.7880817', '90.3751888', '::1', '2022-04-02 21:25:43'),
(1, '01516158298', 'Ramzan', 'Ali', 'mdramzanroni76@gmail.com', 'ramzan', '81dc9bdb52d04dc20036dbd8313ed055', '2022-03-06', '1234', '14', '1', '', '', '::1', '2022-04-04 17:09:01'),
(1, '01516158298', 'Ramzan', 'Ali', 'mdramzanroni76@gmail.com', 'ramzan', '81dc9bdb52d04dc20036dbd8313ed055', '2022-03-06', '1234', '14', '1', '23.7879264', '90.3751762', '::1', '2022-04-06 17:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `message_otp`
--

CREATE TABLE `message_otp` (
  `id` int(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `otp_code` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message_otp`
--

INSERT INTO `message_otp` (`id`, `phone_number`, `otp_code`) VALUES
(1, '01516158298', 625808),
(2, '01516158298', 221114),
(3, '01516158298', 457290),
(4, '01516158298', 331511),
(5, '01516158298', 140226),
(6, '01516158298', 490779),
(7, '01516158298', 824914);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(255) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `serviceImg` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `serviceImg`, `status`) VALUES
(1, 'Test Service111', '', 0),
(2, 'Another Test Service', '', 1),
(3, 'test', '', 1),
(4, 'testData', 'admin/images/1645384541.JPG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `id` int(11) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `nidPassport` varchar(255) NOT NULL,
  `supervisorDistrict` varchar(255) NOT NULL,
  `superviorUpazila` varchar(255) NOT NULL,
  `serviceArea` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `phoneNumber`, `firstName`, `lastName`, `emailAddress`, `userName`, `password`, `dateOfBirth`, `nidPassport`, `supervisorDistrict`, `superviorUpazila`, `serviceArea`, `latitude`, `longitude`, `status`, `date`) VALUES
(2, '1516158298', 'test', 'test', '', '1234', '81dc9bdb52d04dc20036dbd8313ed055', '2022-02-03', '1234', '', '', '2', '23.7552032', '90.3758115', 1, '2022-02-03 12:55:34'),
(3, '1516158298', 'test', 'test', 'mdramzanroni76@gmail.com', '1234', '81dc9bdb52d04dc20036dbd8313ed055', '2022-02-03', '1234', '', '', '2', '23.7552031', '90.3758115', 1, '2022-02-03 12:57:01'),
(4, '1516158298', 'test', 'test', 'mdramzanroni76@gmail.com', 'test', '81dc9bdb52d04dc20036dbd8313ed055', '2022-02-03', '1234', '14', '1', '2', '24.8962873', '91.8221296', 1, '2022-02-03 13:12:54'),
(5, '1516158298', 'Ramzan', 'Roni', 'mdramzanroni76@gmail.com', 'ramzan', '81dc9bdb52d04dc20036dbd8313ed055', '2022-02-03', '12345678', '14', '1', '2', '25.7499116', '89.2270258', 0, '2022-02-03 13:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_token`
--

CREATE TABLE `supervisor_token` (
  `id` int(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supervisor_token`
--

INSERT INTO `supervisor_token` (`id`, `token`, `date`) VALUES
(1, '61f9721e5bd49', '2022-02-01 19:03:10'),
(2, '61f9864085d98', '2022-02-01 19:25:04'),
(3, '61f989dd2818a', '2022-02-01 19:28:29'),
(4, '61fa86dcddf98', '2022-02-02 13:27:56'),
(5, '61fa86edc66a7', '2022-02-02 13:28:13'),
(6, '61faa65e5802b', '2022-02-03 10:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `upazila`
--

CREATE TABLE `upazila` (
  `id` int(3) NOT NULL,
  `district_code` int(2) NOT NULL,
  `upazila_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upazila`
--

INSERT INTO `upazila` (`id`, `district_code`, `upazila_name`) VALUES
(1, 1, 'Debidwar'),
(2, 1, 'Barura'),
(3, 1, 'Brahmanpara'),
(4, 1, 'Chandina'),
(5, 1, 'Chauddagram'),
(6, 1, 'Daudkandi'),
(7, 1, 'Homna'),
(8, 1, 'Laksam'),
(9, 1, 'Muradnagar'),
(10, 1, 'Nangalkot'),
(11, 1, 'Comilla Sadar'),
(12, 1, 'Meghna'),
(13, 1, 'Monohargonj'),
(14, 1, 'Sadarsouth'),
(15, 1, 'Titas'),
(16, 1, 'Burichang'),
(17, 1, 'Lalmai'),
(18, 2, 'Chhagalnaiya'),
(19, 2, 'Feni Sadar'),
(20, 2, 'Sonagazi'),
(21, 2, 'Fulgazi'),
(22, 2, 'Parshuram'),
(23, 2, 'Daganbhuiyan'),
(24, 3, 'Brahmanbaria Sadar'),
(25, 3, 'Kasba'),
(26, 3, 'Nasirnagar'),
(27, 3, 'Sarail'),
(28, 3, 'Ashuganj'),
(29, 3, 'Akhaura'),
(30, 3, 'Nabinagar'),
(31, 3, 'Bancharampur'),
(32, 3, 'Bijoynagar'),
(33, 4, 'Rangamati Sadar'),
(34, 4, 'Kaptai'),
(35, 4, 'Kawkhali'),
(36, 4, 'Baghaichari'),
(37, 4, 'Barkal'),
(38, 4, 'Langadu'),
(39, 4, 'Rajasthali'),
(40, 4, 'Belaichari'),
(41, 4, 'Juraichari'),
(42, 4, 'Naniarchar'),
(43, 5, 'Noakhali Sadar'),
(44, 5, 'Companiganj'),
(45, 5, 'Begumganj'),
(46, 5, 'Hatia'),
(47, 5, 'Subarnachar'),
(48, 5, 'Kabirhat'),
(49, 5, 'Senbug'),
(50, 5, 'Chatkhil'),
(51, 5, 'Sonaimori'),
(52, 6, 'Haimchar'),
(53, 6, 'Kachua'),
(54, 6, 'Shahrasti'),
(55, 6, 'Chandpur Sadar'),
(56, 6, 'Matlab South'),
(57, 6, 'Hajiganj'),
(58, 6, 'Matlab North'),
(59, 6, 'Faridgonj'),
(60, 7, 'Lakshmipur Sadar'),
(61, 7, 'Kamalnagar'),
(62, 7, 'Raipur'),
(63, 7, 'Ramgati'),
(64, 7, 'Ramganj'),
(65, 8, 'Rangunia'),
(66, 8, 'Sitakunda'),
(67, 8, 'Mirsharai'),
(68, 8, 'Patiya'),
(69, 8, 'Sandwip'),
(70, 8, 'Banshkhali'),
(71, 8, 'Boalkhali'),
(72, 8, 'Anwara'),
(73, 8, 'Chandanaish'),
(74, 8, 'Satkania'),
(75, 8, 'Lohagara'),
(76, 8, 'Hathazari'),
(77, 8, 'Fatikchhari'),
(78, 8, 'Raozan'),
(79, 8, 'Karnafuli'),
(80, 9, 'Coxsbazar Sadar'),
(81, 9, 'Chakaria'),
(82, 9, 'Kutubdia'),
(83, 9, 'Ukhiya'),
(84, 9, 'Moheshkhali'),
(85, 9, 'Pekua'),
(86, 9, 'Ramu'),
(87, 9, 'Teknaf'),
(88, 10, 'Khagrachhari Sadar'),
(89, 10, 'Dighinala'),
(90, 10, 'Panchari'),
(91, 10, 'Laxmichhari'),
(92, 10, 'Mohalchari'),
(93, 10, 'Manikchari'),
(94, 10, 'Ramgarh'),
(95, 10, 'Matiranga'),
(96, 10, 'Guimara'),
(97, 11, 'Bandarban Sadar'),
(98, 11, 'Alikadam'),
(99, 11, 'Naikhongchhari'),
(100, 11, 'Rowangchhari'),
(101, 11, 'Lama'),
(102, 11, 'Ruma'),
(103, 11, 'Thanchi'),
(104, 12, 'Belkuchi'),
(105, 12, 'Chauhali'),
(106, 12, 'Kamarkhand'),
(107, 12, 'Kazipur'),
(108, 12, 'Raigonj'),
(109, 12, 'Shahjadpur'),
(110, 12, 'Sirajganj Sadar'),
(111, 12, 'Tarash'),
(112, 12, 'Ullapara'),
(113, 13, 'Sujanagar'),
(114, 13, 'Ishurdi'),
(115, 13, 'Bhangura'),
(116, 13, 'Pabna Sadar'),
(117, 13, 'Bera'),
(118, 13, 'Atghoria'),
(119, 13, 'Chatmohar'),
(120, 13, 'Santhia'),
(121, 13, 'Faridpur'),
(122, 14, 'Kahaloo'),
(123, 14, 'Bogra Sadar'),
(124, 14, 'Shariakandi'),
(125, 14, 'Shajahanpur'),
(126, 14, 'Dupchanchia'),
(127, 14, 'Adamdighi'),
(128, 14, 'Nondigram'),
(129, 14, 'Sonatala'),
(130, 14, 'Dhunot'),
(131, 14, 'Gabtali'),
(132, 14, 'Sherpur'),
(133, 14, 'Shibganj'),
(134, 15, 'Paba'),
(135, 15, 'Durgapur'),
(136, 15, 'Mohonpur'),
(137, 15, 'Charghat'),
(138, 15, 'Puthia'),
(139, 15, 'Bagha'),
(140, 15, 'Godagari'),
(141, 15, 'Tanore'),
(142, 15, 'Bagmara'),
(143, 16, 'Natore Sadar'),
(144, 16, 'Singra'),
(145, 16, 'Baraigram'),
(146, 16, 'Bagatipara'),
(147, 16, 'Lalpur'),
(148, 16, 'Gurudaspur'),
(149, 16, 'Naldanga'),
(150, 17, 'Akkelpur'),
(151, 17, 'Kalai'),
(152, 17, 'Khetlal'),
(153, 17, 'Panchbibi'),
(154, 17, 'Joypurhat Sadar'),
(155, 18, 'Chapainawabganj Sadar'),
(156, 18, 'Gomostapur'),
(157, 18, 'Nachol'),
(158, 18, 'Bholahat'),
(159, 18, 'Shibganj'),
(160, 19, 'Mohadevpur'),
(161, 19, 'Badalgachi'),
(162, 19, 'Patnitala'),
(163, 19, 'Dhamoirhat'),
(164, 19, 'Niamatpur'),
(165, 19, 'Manda'),
(166, 19, 'Atrai'),
(167, 19, 'Raninagar'),
(168, 19, 'Naogaon Sadar'),
(169, 19, 'Porsha'),
(170, 19, 'Sapahar'),
(171, 20, 'Manirampur'),
(172, 20, 'Abhaynagar'),
(173, 20, 'Bagherpara'),
(174, 20, 'Chougachha'),
(175, 20, 'Jhikargacha'),
(176, 20, 'Keshabpur'),
(177, 20, 'Jessore Sadar'),
(178, 20, 'Sharsha'),
(179, 21, 'Assasuni'),
(180, 21, 'Debhata'),
(181, 21, 'Kalaroa'),
(182, 21, 'Satkhira Sadar'),
(183, 21, 'Shyamnagar'),
(184, 21, 'Tala'),
(185, 21, 'Kaliganj'),
(186, 22, 'Mujibnagar'),
(187, 22, 'Meherpur Sadar'),
(188, 22, 'Gangni'),
(189, 23, 'Narail Sadar'),
(190, 23, 'Lohagara'),
(191, 23, 'Kalia'),
(192, 24, 'Chuadanga Sadar'),
(193, 24, 'Alamdanga'),
(194, 24, 'Damurhuda'),
(195, 24, 'Jibannagar'),
(196, 25, 'Kushtia Sadar'),
(197, 25, 'Kumarkhali'),
(198, 25, 'Khoksa'),
(199, 25, 'Mirpur'),
(200, 25, 'Daulatpur'),
(201, 25, 'Bheramara'),
(202, 26, 'Shalikha'),
(203, 26, 'Sreepur'),
(204, 26, 'Magura Sadar'),
(205, 26, 'Mohammadpur'),
(206, 27, 'Paikgasa'),
(207, 27, 'Fultola'),
(208, 27, 'Digholia'),
(209, 27, 'Rupsha'),
(210, 27, 'Terokhada'),
(211, 27, 'Dumuria'),
(212, 27, 'Botiaghata'),
(213, 27, 'Dakop'),
(214, 27, 'Koyra'),
(215, 28, 'Fakirhat'),
(216, 28, 'Bagerhat Sadar'),
(217, 28, 'Mollahat'),
(218, 28, 'Sarankhola'),
(219, 28, 'Rampal'),
(220, 28, 'Morrelganj'),
(221, 28, 'Kachua'),
(222, 28, 'Mongla'),
(223, 28, 'Chitalmari'),
(224, 29, 'Jhenaidah Sadar'),
(225, 29, 'Shailkupa'),
(226, 29, 'Harinakundu'),
(227, 29, 'Kaliganj'),
(228, 29, 'Kotchandpur'),
(229, 29, 'Moheshpur'),
(230, 30, 'Jhalakathi Sadar'),
(231, 30, 'Kathalia'),
(232, 30, 'Nalchity'),
(233, 30, 'Rajapur'),
(234, 31, 'Bauphal'),
(235, 31, 'Patuakhali Sadar'),
(236, 31, 'Dumki'),
(237, 31, 'Dashmina'),
(238, 31, 'Kalapara'),
(239, 31, 'Mirzaganj'),
(240, 31, 'Galachipa'),
(241, 31, 'Rangabali'),
(242, 32, 'Pirojpur Sadar'),
(243, 32, 'Nazirpur'),
(244, 32, 'Kawkhali'),
(245, 32, 'Zianagar'),
(246, 32, 'Bhandaria'),
(247, 32, 'Mathbaria'),
(248, 32, 'Nesarabad'),
(249, 33, 'Barisal Sadar'),
(250, 33, 'Bakerganj'),
(251, 33, 'Babuganj'),
(252, 33, 'Wazirpur'),
(253, 33, 'Banaripara'),
(254, 33, 'Gournadi'),
(255, 33, 'Agailjhara'),
(256, 33, 'Mehendiganj'),
(257, 33, 'Muladi'),
(258, 33, 'Hizla'),
(259, 34, 'Bhola Sadar'),
(260, 34, 'Borhan Sddin'),
(261, 34, 'Charfesson'),
(262, 34, 'Doulatkhan'),
(263, 34, 'Monpura'),
(264, 34, 'Tazumuddin'),
(265, 34, 'Lalmohan'),
(266, 35, 'Amtali'),
(267, 35, 'Barguna Sadar'),
(268, 35, 'Betagi'),
(269, 35, 'Bamna'),
(270, 35, 'Pathorghata'),
(271, 35, 'Taltali'),
(272, 36, 'Balaganj'),
(273, 36, 'Beanibazar'),
(274, 36, 'Bishwanath'),
(275, 36, 'Companiganj'),
(276, 36, 'Fenchuganj'),
(277, 36, 'Golapganj'),
(278, 36, 'Gowainghat'),
(279, 36, 'Jaintiapur'),
(280, 36, 'Kanaighat'),
(281, 36, 'Sylhet Sadar'),
(282, 36, 'Zakiganj'),
(283, 36, 'Dakshinsurma'),
(284, 36, 'Osmaninagar'),
(285, 37, 'Barlekha'),
(286, 37, 'Kamolganj'),
(287, 37, 'Kulaura'),
(288, 37, 'Moulvibazar Sadar'),
(289, 37, 'Rajnagar'),
(290, 37, 'Sreemangal'),
(291, 37, 'Juri'),
(292, 38, 'Nabiganj'),
(293, 38, 'Bahubal'),
(294, 38, 'Ajmiriganj'),
(295, 38, 'Baniachong'),
(296, 38, 'Lakhai'),
(297, 38, 'Chunarughat'),
(298, 38, 'Habiganj Sadar'),
(299, 38, 'Madhabpur'),
(300, 39, 'Sunamganj Sadar'),
(301, 39, 'South Sunamganj'),
(302, 39, 'Bishwambarpur'),
(303, 39, 'Chhatak'),
(304, 39, 'Jagannathpur'),
(305, 39, 'Dowarabazar'),
(306, 39, 'Tahirpur'),
(307, 39, 'Dharmapasha'),
(308, 39, 'Jamalganj'),
(309, 39, 'Shalla'),
(310, 39, 'Derai'),
(311, 40, 'Belabo'),
(312, 40, 'Monohardi'),
(313, 40, 'Narsingdi Sadar'),
(314, 40, 'Palash'),
(315, 40, 'Raipura'),
(316, 40, 'Shibpur'),
(317, 41, 'Kaliganj'),
(318, 41, 'Kaliakair'),
(319, 41, 'Kapasia'),
(320, 41, 'Gazipur Sadar'),
(321, 41, 'Sreepur'),
(322, 42, 'Shariatpur Sadar'),
(323, 42, 'Naria'),
(324, 42, 'Zajira'),
(325, 42, 'Gosairhat'),
(326, 42, 'Bhedarganj'),
(327, 42, 'Damudya'),
(328, 43, 'Araihazar'),
(329, 43, 'Bandar'),
(330, 43, 'Narayanganj Sadar'),
(331, 43, 'Rupganj'),
(332, 43, 'Sonargaon'),
(333, 44, 'Basail'),
(334, 44, 'Bhuapur'),
(335, 44, 'Delduar'),
(336, 44, 'Ghatail'),
(337, 44, 'Gopalpur'),
(338, 44, 'Madhupur'),
(339, 44, 'Mirzapur'),
(340, 44, 'Nagarpur'),
(341, 44, 'Sakhipur'),
(342, 44, 'Tangail Sadar'),
(343, 44, 'Kalihati'),
(344, 44, 'Dhanbari'),
(345, 45, 'Itna'),
(346, 45, 'Katiadi'),
(347, 45, 'Bhairab'),
(348, 45, 'Tarail'),
(349, 45, 'Hossainpur'),
(350, 45, 'Pakundia'),
(351, 45, 'Kuliarchar'),
(352, 45, 'Kishoreganj Sadar'),
(353, 45, 'Karimgonj'),
(354, 45, 'Bajitpur'),
(355, 45, 'Austagram'),
(356, 45, 'Mithamoin'),
(357, 45, 'Nikli'),
(358, 46, 'Harirampur'),
(359, 46, 'Saturia'),
(360, 46, 'Manikganj Sadar'),
(361, 46, 'Gior'),
(362, 46, 'Shibaloy'),
(363, 46, 'Doulatpur'),
(364, 46, 'Singiar'),
(365, 47, 'Savar'),
(366, 47, 'Dhamrai'),
(367, 47, 'Keraniganj'),
(368, 47, 'Nawabganj'),
(369, 47, 'Dohar'),
(370, 48, 'Munshiganj Sadar'),
(371, 48, 'Sreenagar'),
(372, 48, 'Sirajdikhan'),
(373, 48, 'Louhajanj'),
(374, 48, 'Gajaria'),
(375, 48, 'Tongibari'),
(376, 49, 'Rajbari Sadar'),
(377, 49, 'Goalanda'),
(378, 49, 'Pangsa'),
(379, 49, 'Baliakandi'),
(380, 49, 'Kalukhali'),
(381, 50, 'Madaripur Sadar'),
(382, 50, 'Shibchar'),
(383, 50, 'Kalkini'),
(384, 50, 'Rajoir'),
(385, 51, 'Gopalganj Sadar'),
(386, 51, 'Kashiani'),
(387, 51, 'Tungipara'),
(388, 51, 'Kotalipara'),
(389, 51, 'Muksudpur'),
(390, 52, 'Faridpur Sadar'),
(391, 52, 'Alfadanga'),
(392, 52, 'Boalmari'),
(393, 52, 'Sadarpur'),
(394, 52, 'Nagarkanda'),
(395, 52, 'Bhanga'),
(396, 52, 'Charbhadrasan'),
(397, 52, 'Madhukhali'),
(398, 52, 'Saltha'),
(399, 53, 'Panchagarh Sadar'),
(400, 53, 'Debiganj'),
(401, 53, 'Boda'),
(402, 53, 'Atwari'),
(403, 53, 'Tetulia'),
(404, 54, 'Nawabganj'),
(405, 54, 'Birganj'),
(406, 54, 'Ghoraghat'),
(407, 54, 'Birampur'),
(408, 54, 'Parbatipur'),
(409, 54, 'Bochaganj'),
(410, 54, 'Kaharol'),
(411, 54, 'Fulbari'),
(412, 54, 'Dinajpur Sadar'),
(413, 54, 'Hakimpur'),
(414, 54, 'Khansama'),
(415, 54, 'Birol'),
(416, 54, 'Chirirbandar'),
(417, 55, 'Lalmonirhat Sadar'),
(418, 55, 'Kaliganj'),
(419, 55, 'Hatibandha'),
(420, 55, 'Patgram'),
(421, 55, 'Aditmari'),
(422, 56, 'Syedpur'),
(423, 56, 'Domar'),
(424, 56, 'Dimla'),
(425, 56, 'Jaldhaka'),
(426, 56, 'Kishorganj'),
(427, 56, 'Nilphamari Sadar'),
(428, 57, 'Sadullapur'),
(429, 57, 'Gaibandha Sadar'),
(430, 57, 'Palashbari'),
(431, 57, 'Saghata'),
(432, 57, 'Gobindaganj'),
(433, 57, 'Sundarganj'),
(434, 57, 'Phulchari'),
(435, 58, 'Thakurgaon Sadar'),
(436, 58, 'Pirganj'),
(437, 58, 'Ranisankail'),
(438, 58, 'Haripur'),
(439, 58, 'Baliadangi'),
(440, 59, 'Rangpur Sadar'),
(441, 59, 'Gangachara'),
(442, 59, 'Taragonj'),
(443, 59, 'Badargonj'),
(444, 59, 'Mithapukur'),
(445, 59, 'Pirgonj'),
(446, 59, 'Kaunia'),
(447, 59, 'Pirgacha'),
(448, 60, 'Kurigram Sadar'),
(449, 60, 'Nageshwari'),
(450, 60, 'Bhurungamari'),
(451, 60, 'Phulbari'),
(452, 60, 'Rajarhat'),
(453, 60, 'Ulipur'),
(454, 60, 'Chilmari'),
(455, 60, 'Rowmari'),
(456, 60, 'Charrajibpur'),
(457, 61, 'Sherpur Sadar'),
(458, 61, 'Nalitabari'),
(459, 61, 'Sreebordi'),
(460, 61, 'Nokla'),
(461, 61, 'Jhenaigati'),
(462, 62, 'Fulbaria'),
(463, 62, 'Trishal'),
(464, 62, 'Bhaluka'),
(465, 62, 'Muktagacha'),
(466, 62, 'Mymensingh Sadar'),
(467, 62, 'Dhobaura'),
(468, 62, 'Phulpur'),
(469, 62, 'Haluaghat'),
(470, 62, 'Gouripur'),
(471, 62, 'Gafargaon'),
(472, 62, 'Iswarganj'),
(473, 62, 'Nandail'),
(474, 62, 'Tarakanda'),
(475, 63, 'Jamalpur Sadar'),
(476, 63, 'Melandah'),
(477, 63, 'Islampur'),
(478, 63, 'Dewangonj'),
(479, 63, 'Sarishabari'),
(480, 63, 'Madarganj'),
(481, 63, 'Bokshiganj'),
(482, 64, 'Barhatta'),
(483, 64, 'Durgapur'),
(484, 64, 'Kendua'),
(485, 64, 'Atpara'),
(486, 64, 'Madan'),
(487, 64, 'Khaliajuri'),
(488, 64, 'Kalmakanda'),
(489, 64, 'Mohongonj'),
(490, 64, 'Purbadhala'),
(491, 64, 'Netrokona Sadar'),
(492, 12, 'test'),
(493, 13, 'Pangsha');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `nidPassport` varchar(255) NOT NULL,
  `userDistrict` varchar(255) NOT NULL,
  `userUpazila` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phoneNumber`, `firstName`, `lastName`, `emailAddress`, `userName`, `password`, `dateOfBirth`, `nidPassport`, `userDistrict`, `userUpazila`, `latitude`, `longitude`, `status`, `date`) VALUES
(1, '01516158298', 'Ramzan', 'Ali', 'mdramzanroni76@gmail.com', 'ramzan', '81dc9bdb52d04dc20036dbd8313ed055', '2022-03-06', '1234', '14', '1', '23.7880201', '90.375175', 1, '2022-03-06 16:32:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_feedback`
--
ALTER TABLE `emergency_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_history`
--
ALTER TABLE `emergency_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_supervisor`
--
ALTER TABLE `history_supervisor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_otp`
--
ALTER TABLE `message_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisor_token`
--
ALTER TABLE `supervisor_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upazila`
--
ALTER TABLE `upazila`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_id` (`district_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emergency_feedback`
--
ALTER TABLE `emergency_feedback`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emergency_history`
--
ALTER TABLE `emergency_history`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history_supervisor`
--
ALTER TABLE `history_supervisor`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message_otp`
--
ALTER TABLE `message_otp`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supervisor_token`
--
ALTER TABLE `supervisor_token`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `upazila`
--
ALTER TABLE `upazila`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=494;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `upazila`
--
ALTER TABLE `upazila`
  ADD CONSTRAINT `upazila_ibfk_2` FOREIGN KEY (`district_code`) REFERENCES `district` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
