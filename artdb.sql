-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2022 at 02:11 AM
-- Server version: 5.7.38-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankdetails`
--

CREATE TABLE `bankdetails` (
  `id` int(11) NOT NULL,
  `bankname` varchar(255) NOT NULL,
  `accno` varchar(255) NOT NULL,
  `confaccno` varchar(255) NOT NULL,
  `ifsc` varchar(255) NOT NULL,
  `holdername` varchar(255) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bankdetails`
--

INSERT INTO `bankdetails` (`id`, `bankname`, `accno`, `confaccno`, `ifsc`, `holdername`, `seller_id`) VALUES
(1, 'State Bank of India', '38616282611', '38616282611', 'SBIN0001091', 'Avinash Prasad', 17);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `sell_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `sell_id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(9, 6, 16, 'needlework', 1, 5, 'artist/Chikankari1.jpg'),
(10, 9, 16, 'Pottery', 1, 4, 'artist/Bluepottery1.jpg'),
(11, 1, 16, 'King Palace', 1, 5, 'artist/mysore1.jpg'),
(12, 11, 16, 'Bone Carving', 1, 3, 'artist/BoneCarving2.jpg'),
(13, 7, 16, 'Ornament', 1, 2, 'artist/BoneCarving2.jpg'),
(14, 10, 16, 'Stone ornament', 1, 2, 'artist/Stonecraft2.jpg'),
(15, 12, 16, 'glass art', 1, 1, 'artist/Indian-Glassware-1.jpg'),
(26, 7, 23, 'Ornament', 1, 2, 'artist/BoneCarving2.jpg'),
(35, 8, 17, 'pots', 1, 2, 'artist/Bluepottery2.jpg'),
(36, 10, 17, 'Stone ornament', 1, 1, 'artist/Stonecraft2.jpg'),
(37, 1, 22, 'King Palace', 1, 1, 'artist/mysore1.jpg'),
(38, 7, 22, 'Ornament', 1, 1, 'artist/BoneCarving2.jpg'),
(44, 7, 17, 'Ornament', 1, 1, 'artist/BoneCarving2.jpg'),
(45, 12, 14, 'glass art', 1, 1, 'artist/Indian-Glassware-1.jpg'),
(46, 1, 14, 'King Palace', 1, 1, 'artist/mysore1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `follow_list`
--

CREATE TABLE `follow_list` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follow_list`
--

INSERT INTO `follow_list` (`id`, `follower_id`, `user_id`) VALUES
(3, 17, 14),
(4, 17, 15),
(7, 17, 16),
(8, 17, 21),
(9, 17, 22),
(12, 17, 23);

-- --------------------------------------------------------

--
-- Table structure for table `like_post`
--

CREATE TABLE `like_post` (
  `like_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_post`
--

INSERT INTO `like_post` (`like_id`, `post_id`, `user_id`) VALUES
(6, 29, 17);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `sell_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `p_o_d_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `sell_id`, `user_id`, `name`, `quantity`, `price`, `p_o_d_id`) VALUES
(32, 12, 17, 'glass art', 1, 1, 25),
(33, 11, 17, 'Bone Carving', 1, 1, 25),
(34, 8, 17, 'pots', 1, 1, 25),
(35, 10, 17, 'Stone ornament', 1, 1, 25),
(36, 6, 22, 'needlework', 1, 1, 27),
(37, 11, 22, 'Bone Carving', 1, 1, 27),
(38, 1, 22, 'King Palace', 1, 1, 27),
(39, 8, 22, 'pots', 1, 1, 27),
(40, 12, 14, 'glass art', 1, 1, 29),
(41, 8, 17, 'pots', 2, 1, 25),
(42, 10, 17, 'Stone ornament', 1, 1, 25),
(43, 7, 17, 'Ornament', 1, 1, 25),
(44, 7, 23, 'Ornament', 2, 1, 31),
(45, 7, 23, 'Ornament', 2, 1, 31),
(46, 8, 17, 'pots', 2, 1, 25),
(47, 10, 17, 'Stone ornament', 1, 1, 25),
(48, 7, 17, 'Ornament', 1, 1, 25),
(49, 8, 17, 'pots', 2, 1, 25),
(50, 10, 17, 'Stone ornament', 1, 1, 25),
(51, 7, 17, 'Ornament', 1, 1, 25),
(52, 7, 23, 'Ornament', 2, 1, 31);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `otp_id` int(11) NOT NULL,
  `otpnum` varchar(255) NOT NULL,
  `mobilenum` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`otp_id`, `otpnum`, `mobilenum`) VALUES
(1, '37899', 7004806734),
(2, '71512', 8084226930),
(3, '35403', 7004806734),
(4, '63744', 8084226930),
(5, '54809', 8084226930),
(6, '64050', 7004806734),
(7, '12973', 7004806734),
(8, '87993', 8318959667),
(9, '75122', 8318959667),
(10, '23511', 8318959667),
(11, '88446', 7004806734),
(12, '42852', 7004806734),
(13, '60024', 7004806734),
(14, '79454', 8318959667),
(15, '72087', 8318959667),
(16, '41152', 7004806731),
(17, '67532', 7004806731),
(18, '83914', 7004806731),
(19, '19687', 7004806734),
(20, '31088', 7004806734),
(21, '80550', 7004806734),
(22, '41268', 8084226930),
(23, '96265', 7004806734),
(24, '92532', 7004806734),
(25, '61545', 7004806734),
(26, '15807', 7004806734),
(27, '91255', 7004806734),
(28, '71844', 7004806734),
(29, '23380', 7004806734),
(30, '66415', 7004806734),
(31, '16821', 7004806734),
(32, '46310', 8095162168),
(33, '83012', 8095162168),
(34, '41873', 8095162168),
(35, '13996', 7004806734),
(36, '21103', 7004806734),
(37, '45741', 8095162168),
(38, '96505', 8318959667);

-- --------------------------------------------------------

--
-- Table structure for table `paymentdetails`
--

CREATE TABLE `paymentdetails` (
  `ordersid` varchar(255) NOT NULL,
  `paymentid` varchar(255) NOT NULL,
  `emailid` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `orderdate` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentdetails`
--

INSERT INTO `paymentdetails` (`ordersid`, `paymentid`, `emailid`, `phone`, `amount`, `orderdate`, `username`) VALUES
('order_JhSbsyHMPDWOgo', 'pay_JhScC6KUAkUS2k', 'shadowavip26@gmail.com', 7004806735, 1, '14-06-22 11-11-00', ''),
('order_JhT1n9iv3QP2Uj', 'pay_JhT2Z7eGufQtAQ', 'shadowavip26@gmail.com', 7004806735, 1, '14-06-22 11-35-56', 'shadowavip'),
('order_JiHM4RVmgbOuhq', 'pay_JiHMzhqCiWKzcA', '831kavita73@gmail.com', 8318959667, 1, '17-06-22 12-50-07', 'KavitaC'),
('order_JlatCx7bs15lPz', 'pay_JlathhwZJgp0X9', 'shadowavip26@gmail.com', 7004806734, 4, '25-06-22 09-53-18', 'shadowavip'),
('order_JrHBS7Adw9Smrb', 'pay_JrHBpIywLxuLUO', 'karthikshrikanth@gmail.com', 8095162168, 2, '09-07-22 06-30-55', 'karthik_1308');

-- --------------------------------------------------------

--
-- Table structure for table `person_order_details`
--

CREATE TABLE `person_order_details` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person_order_details`
--

INSERT INTO `person_order_details` (`id`, `fname`, `lname`, `country`, `street_address`, `town`, `state`, `pincode`, `phone`, `email`, `notes`, `username`, `user_id`) VALUES
(25, 'Shadow', 'Prasad', 'India', 'KS Boys Hostel', 'Banglore', 'Karnataka', '560109', 7004806735, 'shadowavip26@gmail.com', 'thank you', 'shadowavip', 17),
(26, 'Shadow', 'Prasad', 'India', 'KS Boys Hostel', 'Banglore', 'Karnataka', '560109', 7004806735, 'shadowavip26@gmail.com', 'thank you', 'shadowavip', 17),
(27, 'Pawan', 'Patil', 'India', 'KS Boys Hostel', 'Banglore', 'Karnataka', '560062', 7892463307, 'patilpawanpatil00@gmail.com', 'thank you', 'Pawanpatil', 22),
(28, 'Pawan', 'Patil', 'India', 'KS Boys Hostel', 'Banglore', 'Karnataka', '560062', 7892463307, 'patilpawanpatil00@gmail.com', 'thank you', 'Pawanpatil', 22),
(29, 'Kavita', 'Chaudhary', 'India', 'KS Girls Hostel', 'Banglore', 'Karnataka', '560062', 8318959667, '831kavita73@gmail.com', 'thank you', 'KavitaC', 14),
(30, 'Shadow', 'Prasad', 'India', 'KS Boys Hostel', 'Banglore', 'Karnataka', '560109', 7004806734, 'shadowavip26@gmail.com', 'art for kavita', 'shadowavip', 17),
(31, 's', 's', 'India', 's', 's', 's', 's', 0, 's', 's', 'karthik_1308', 23),
(32, 's', 's', 'India', 's', 's', 's', 's', 0, 's', 's', 'karthik_1308', 23),
(33, 'avinash ', 'prasad', 'India', 'ks boys hostel', 'bangalore', 'karnataka', '560109', 7004806734, 'shadowavip26@gmail.com', 'Birthday gift', 'shadowavip', 17),
(34, 'avinash ', 'prasad', 'India', 'ks boys hostel', 'bangalore', 'karnataka', '560109', 7004806734, 'shadowavip26@gmail.com', 'Birthday gift', 'shadowavip', 17),
(35, 'Karthik', 'K', 'India', 'KS Boys Hostel', 'Banglore', 'Karnataka', '560109', 8318959667, 'karthikshrikanth@gmail.com', 'gift', 'karthik_1308', 23);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `post_img` text NOT NULL,
  `post_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_name`, `post_img`, `post_text`, `created_at`) VALUES
(29, 'shadowavip', 'upload/eye_sketch.jpg', 'Eye Sketch', '2022-06-25 00:55:45'),
(30, 'shadowavip', 'upload/buddha_painting.jpg', 'Buddha painting', '2022-06-25 02:45:03'),
(31, 'karthik_1308', 'upload/haitam-ouahabi-art-style-doodle-abstract-surrealism-artwork-by-haitam-ouahabi.jpg', 'my first post', '2022-07-09 12:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `material` varchar(255) NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `arttype` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `provenance` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`id`, `name`, `year`, `title`, `material`, `height`, `width`, `price`, `quantity`, `arttype`, `city`, `provenance`, `image`, `address`, `email`, `phone`, `username`) VALUES
(1, 'Avinash Prasad', '2022', 'King Palace', 'oil painting, paper, brush', 300, 300, 1, 3, 'Paintings', 'Bangalore', 'Mysore Painting from Mysore', 'artist/mysore1.jpg', 'KS Boys Hostel, Bangalore - 560109', 'batch16projectg4@gmail.com', 7004806734, 'avi26'),
(6, 'Kavita Chaudhary', '2022', 'needlework', 'pearls, thread, stones, needle', 45, 65, 1, 1, 'Needlework', 'Bengaluru', 'Chikankari from Lucknow', 'artist/Chikankari1.jpg', 'Raebareli', '831kavita73@gmail.com', 8318959667, 'KavitaC'),
(7, 'Kavita Chaudhary', '2022', 'Ornament', 'pearls, thread, stones, bone', 56, 78, 1, 2, 'Stone_crafts', 'Bengaluru', 'Bone carving from lucknow', 'artist/BoneCarving2.jpg', 'Raebareli', '831kavita73@gmail.com', 8318959667, 'KavitaC'),
(8, 'Kavita Chaudhary', '2022', 'pots', 'oil painting, paper, brush, pots, clay', 60, 65, 1, 2, 'Houseware', 'Rajasthan', 'Bluepottery from Rajasthan', 'artist/Bluepottery2.jpg', 'Raebareli', '831kavita73@gmail.com', 8318959667, 'KavitaC'),
(9, 'Kavita Chaudhary', '2022', 'Pottery', 'oil painting, brush, pots, clay', 45, 60, 1, 1, 'Houseware', 'Jaipur', 'Potteries from Jaipur', 'artist/Bluepottery1.jpg', 'No.14 KS Girls Hostel, KSIT Junction Raghuvanahalli,', 'narendrachaudharyrbl@gmail.com', 8318959667, 'KavitaC'),
(10, 'Kavita Chaudhary', '2022', 'Stone ornament', 'pearls, thread, stones, needle', 100, 100, 1, 1, 'Stone_crafts', 'Bengaluru', 'Stone from Rajasthan', 'artist/Stonecraft2.jpg', 'Raebareli', '831kavita73@gmail.com', 8318959667, 'KavitaC'),
(11, 'Avinash Prasad', '2022', 'Bone Carving', 'Bone, paints, ornaments', 100, 50, 1, 5, 'Carving', 'Uttar Pradesh', 'Bone carving from lucknow', 'artist/BoneCarving2.jpg', 'KS Boys Hostel', 'batch16projectg4@gmail.com', 7004806734, 'avinash26'),
(12, 'Avinash Prasad', '2022', 'glass art', 'glass, paint, thread, glue', 100, 75, 1, 4, 'Ceramics_and_glass_crafts', 'Bangalore', 'Firozabad from Uttar Pradesh', 'artist/Indian-Glassware-1.jpg', 'KS Boys Hostel, Bangalore - 560109', 'batch16projectg4@gmail.com', 7004806734, 'avinash26'),
(13, 'karthik', '2022', 'haitam ouahabi art style', 'Oil painting', 80, 70, 6500, 2, 'Paintings', 'bangalore', 'karnataka', 'artist/haitam-ouahabi-art-style-doodle-abstract-surrealism-artwork-by-haitam-ouahabi.jpg', 'Jayanagar 4th block, Bangalore', 'karthikshrikanth@gmail.com', 8095162168, 'karthik_1308');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `idd` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pno` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confpass` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`idd`, `email`, `pno`, `password`, `confpass`, `dob`, `gender`, `fname`, `lname`, `username`, `token`, `status`, `image_path`) VALUES
(14, '831kavita73@gmail.com', 8318959667, '$2y$10$U53rf5JAejuzZhmSomQbZu2Zuiu7.Fg1rJSknye5JLFbjLxJY4TC2', '$2y$10$0SHB2IIYR6.E96w36kJCkeAbEBfBX0Ug7ALbM/r1u171A3Qcp3Iy2', '2001-03-07', 'female', 'Kavita', 'Chaudhary', 'KavitaC', '07dfe7f75049a012ce3e3eb537c502', 'active', 'upload/Kavita Chaudhary_1KS18CS029.jpeg'),
(15, 'batch16projectg4@gmail.com', 7004806730, '$2y$10$ygYhokX0uPoTE0gpuDGa3OXZJYXEIyo5.kRAyo7R/EiMDtj1K4A9C', '$2y$10$A.yKzGqIbYHEM9PaK3ACxu2wK/Z1ceZYQPoWHRADQhUQbhngHtn1W', '1998-09-26', 'male', 'Avinash', 'Prasad', 'avinash26', 'f2816b36118dd349b339bf6f87f3b6', 'active', 'upload/aQ.jpg'),
(16, 'narendrachaudharyrbl@gmail.com', 8601168013, '$2y$10$u227nLvmaCt85jVoGTEn5u3IO3BJlZZitAxftojW7fJ9iqr7TCNfq', '$2y$10$8bVsA0g3DftUGcHml386L.fmqqyuz0W2rZgp5GLDKpFixdv1V0KYi', '2009-06-17', 'male', 'kaush', 'singh', 'Kaush', 'e34cae9323045bb9f4fe810491565b', 'active', 'upload/kerala-mural-paintings2.jpg'),
(17, 'shadowavip26@gmail.com', 7004806734, '$2y$10$CPCkCuZFUNrznNrKTo.J6.HJj0FktJyy1n1NfOyufRYyprwog8fdO', '$2y$10$OPwpyLpihRGK/sQy.4pJtOXBdinvwvaKF2hzoszENkwQ0hsx.HJbm', '1998-09-26', 'male', 'Shadow', 'Prasad', 'shadowavip', '690a15bd4d36845faa25cce6e8cb5e', 'active', 'upload/5.png'),
(21, 'anmolprasad06@gmail.com', 7004806736, '$2y$10$kKCzrGXWqD7KtGpnrtj6Iu0ivTI2RnzGR0a8BDeSeodNL8GKBcW1K', '$2y$10$o9SQZk1teRuRGVM3FacimOEgCzwAn6doW8uhwev.3hxJTQiQIamQC', '1998-09-26', 'male', 'Anmol', 'Kumar', 'anmol_kumar', 'cb67edcd6c673145058ab3920a7c8b', 'active', 'upload/p8.PNG'),
(22, 'patilpawanpatil00@gmail.com', 7892463307, '$2y$10$LXkdt/f3w6AkfZ2m4F4LL.wqNDS7.SN9NDIMp0y3t5Zi.acBDzI5y', '$2y$10$i1SF1hKxkHnTEqei8qqI9O6nh9OWw6trltXLcyWIAgp0AkbJLXl2K', '2000-06-10', 'male', 'Pawan', 'Patil', 'Pawanpatil', '16ed894273b8a509eca32fca601717', 'active', 'upload/C5A32920-DCB1-4217-A33B-C1A7F30CD2BF.jpeg'),
(23, 'karthikshrikanth@gmail.com', 8095162168, '$2y$10$S/5lPu1jQdpk8sp28CTD0uLmuz4TXPDVwiz/D3tZBx.fZgLqITYVG', '$2y$10$sjen6pwZMO2RhIk3Sj8bf.72dPm3ClYPAXszhu0J9MiiMk7bAbjpi', '1998-08-13', 'male', 'Karthik', 'K', 'karthik_1308', 'c099aa31033f41a0ca6447db8c5903', 'active', 'upload/6.PNG'),
(25, 'avinashprasad184@gmail.com', 8084226930, '$2y$10$C6cpBwj.ZQZluMOhaqpCg.KJzme7bhVLGm7uKp3fpXlFm99TDtPmy', '$2y$10$.ZcqnLozRSkPKnBchOgyU.PLe.0E7QqilgkyCKyb0CgZAByavOLlC', '1998-09-26', 'male', 'Avinash', 'Prasad', 'avi26', '48d4ca2bdcee57056fda4c0293abc6', 'active', 'upload/form photo1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bankdetails`
--
ALTER TABLE `bankdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sell_id` (`sell_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `follow_list`
--
ALTER TABLE `follow_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_post`
--
ALTER TABLE `like_post`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `person_order_details`
--
ALTER TABLE `person_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`idd`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bankdetails`
--
ALTER TABLE `bankdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `follow_list`
--
ALTER TABLE `follow_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `like_post`
--
ALTER TABLE `like_post`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `person_order_details`
--
ALTER TABLE `person_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `idd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`sell_id`) REFERENCES `sell` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `signup` (`idd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
