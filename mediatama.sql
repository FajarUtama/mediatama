-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 10:16 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediatama`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(255) NOT NULL,
  `username_admin` varchar(100) NOT NULL,
  `password_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`) VALUES
(1, 'admintest1', '$2y$12$7CDk1qKxy.n.PiiE4nCwlO4qZbC7Vm.ievpTHVZFywpJUsaTOkkO6');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id_request` int(255) NOT NULL,
  `id_video` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_admin` int(255) DEFAULT NULL,
  `time_accept` datetime DEFAULT NULL,
  `time_expired` datetime DEFAULT NULL,
  `allow_access` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id_request`, `id_video`, `id_user`, `id_admin`, `time_accept`, `time_expired`, `allow_access`) VALUES
(1, 1, 1, 1, '2024-07-25 16:20:41', '2024-07-25 18:20:41', 1),
(4, 3, 1, 1, '2024-07-25 17:08:22', '2024-07-25 19:08:22', 1),
(6, 1, 3, 3, '2024-07-25 17:10:17', '2024-07-25 19:10:17', 0),
(7, 4, 3, 3, '2024-07-25 17:10:19', '2024-07-25 19:10:19', 0),
(8, 5, 3, 3, '2024-07-25 17:57:33', '2024-07-25 19:57:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'usertest1', '$2y$12$wX1VaNjxLWSw0hjI/yJKD.yPWgpXFGLf4.6ZE55aB1rOVMiwlp5Ia'),
(3, 'usertest2', '$2y$12$lyfkoypmr8K3F8mBMiWxHulCyYjph0ADf086znTfcisWJrRL3OknK'),
(4, 'usertest3', '$2y$12$SCehgmIftZ0p3XXBYsvKv.r/KBL6AJ.VCFI2rYuE0N.NMS2K5rxSW');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id_video` int(255) NOT NULL,
  `title_video` varchar(100) NOT NULL,
  `location_video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id_video`, `title_video`, `location_video`) VALUES
(1, 'video test 1', 'storage/video test 1.mp4'),
(3, 'video test 2.mp4', 'storage/videos/video test 2.mp4'),
(4, 'videoTest3.mp4', 'storage/videos/videoTest3.mp4'),
(5, 'VideoTestUpload', 'videos/1721930219-SampleVideo_1280x720_1mb.mp4'),
(6, 'patung', 'videos/2pXDJT0ik9yU9vKcAZUoPW0V7dmuO4zYSV6NBsjN.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username_admin` (`username_admin`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id_request`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id_request` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
