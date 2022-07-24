-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2022 at 08:35 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutorfinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Id` int(10) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Id`, `user_name`, `email_id`, `password`) VALUES
(1, 'Tarun@1234', 'Tarunwins@gmail.com', 'Tarun@1234'),
(2, 'Kapil@1234', 'kapilwins@gmail.com', 'Kapil@1234'),
(3, 'Shreya@1234', 'Shreyawins@gmail.com', 'Shreya@1234'),
(4, 'Kartik@1234', 'Admin@Einvoicing.com', 'Shreya@1234'),
(5, 'Manish@1234', 'Manish@yopmail.com', 'Manish@1234'),
(6, 'ManiTa@1234', 'Manish@yopmail.com', 'Manish@1234'),
(7, 'Aditi@1234', 'Aditi@yopmail.com', 'Aditi@1234');

-- --------------------------------------------------------

--
-- Table structure for table `profile_picture`
--

CREATE TABLE `profile_picture` (
  `id` int(10) NOT NULL,
  `Image_name` varchar(40) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Size` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_picture`
--

INSERT INTO `profile_picture` (`id`, `Image_name`, `Type`, `Size`) VALUES
(2, 'download (1).jpg', 'image/jpeg', 8022),
(0, '544036-furry-wolf-animals.jpg', 'image/jpeg', 640721),
(7, 'images7.jpg', 'image/jpeg', 19199);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) NOT NULL,
  `Subjects` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `Subjects`) VALUES
(2, 'Mathematics'),
(2, 'Science'),
(0, 'Data Structure'),
(0, 'C++ (language)'),
(0, 'Java (language)'),
(0, 'Adv. Data Structure'),
(7, 'Mathematics'),
(7, 'Chemistry'),
(7, 'Physics');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE `teacher_info` (
  `id` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Gender` varchar(50) NOT NULL,
  `Age` int(2) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(30) NOT NULL,
  `State` varchar(40) NOT NULL,
  `Pincode` varchar(6) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNo` int(12) NOT NULL,
  `Qualification` varchar(50) NOT NULL,
  `Specialization` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`id`, `Name`, `Gender`, `Age`, `Address`, `City`, `State`, `Pincode`, `Email`, `PhoneNo`, `Qualification`, `Specialization`) VALUES
(2, 'Kapil', 'Male', 26, ' Hno 1523 Sector-36, Chandigarh', 'Chandigarh ', 'Chandigarh', '160036', 'kapilwins@gmail.com', 2147483647, 'Graduate', 'Computer Application'),
(7, 'Shreya', 'Female', 26, ' Hno No 1526 Chandigarh', 'Chandigarh ', 'Chandigarh', '160036', 'Shreyawins@gmail.com', 2147483647, 'Graduate', 'Computer Application'),
(7, 'Aditi Grewal', 'Female', 25, ' H no 245 Sector - 44 D Chandigarh', 'Chandigarh ', 'Chandigarh', '160036', 'AditiGrewal@yopmail.com', 2147483647, 'Graduate', 'Computer Application');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_review`
--

CREATE TABLE `teacher_review` (
  `id` int(10) NOT NULL,
  `Stu_name` varchar(30) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `review_stars` int(1) NOT NULL,
  `Comment` varchar(2000) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_review`
--

INSERT INTO `teacher_review` (`id`, `Stu_name`, `email_id`, `review_stars`, `Comment`, `Time`) VALUES
(2, 'Sahil', 'sahilkumarwins@gmail.com', 5, 'He is really a nice Teacher', '2022-07-21 06:39:34'),
(2, 'Kapil', 'AlexBarns@gmail.com', 3, 'Nice Teacher', '2022-07-21 06:42:39'),
(2, 'admin', 'Ronda@gmail.com', 5, 'Nice teacher', '2022-07-21 06:44:25'),
(2, 'Kartik', 'MickeysWife@gmail.com', 5, 'Nicwe', '2022-07-21 09:37:32'),
(7, 'Aditya Kumar', 'Adityakumar@yopmail.com', 3, 'She teaches it well', '2022-07-23 05:41:38'),
(2, 'Manish Jha', 'Manish@yopmail.com', 3, 'He teaches really nice', '2022-07-23 06:09:28'),
(2, 'Arihant Sinha', 'Arihant@yopmail.com', 4, 'He really teaches in a nice He completes syllabus within time and take test thoroughly and never demotivate students for scoring low instead help him to learn and do more hard wort next time ', '2022-07-23 06:40:16'),
(2, 'Manikarnika', 'Manikarna@yopmail.com', 4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industrys standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book It has s', '2022-07-23 06:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `teaching_info`
--

CREATE TABLE `teaching_info` (
  `id` int(10) NOT NULL,
  `BoardUniv` varchar(40) NOT NULL,
  `ClassCourse` varchar(30) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `TeachingDays` varchar(30) NOT NULL,
  `Duration` int(2) NOT NULL,
  `Language` varchar(30) NOT NULL,
  `Fees` int(10) NOT NULL,
  `TagLine` varchar(255) NOT NULL,
  `Facilities` varchar(30) NOT NULL,
  `Experience` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teaching_info`
--

INSERT INTO `teaching_info` (`id`, `BoardUniv`, `ClassCourse`, `Type`, `TeachingDays`, `Duration`, `Language`, `Fees`, `TagLine`, `Facilities`, `Experience`) VALUES
(2, 'CBSE', '6th-10th', 'Home', 'Mon-Fri', 2, 'English', 2000, 'I teach the function in easiest possible way', '1,2,3', 2),
(0, 'PU', 'BCA', 'Class Room', 'Mon-Fri', 2, 'English', 20000, 'I teach easy', '3,4,5', 2),
(7, 'CBSE', '11th-12th', 'Home', '3 days a week', 2, 'Hindi', 3000, 'I teach with best practices', '1,2,5,6', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
