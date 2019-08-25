-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2019 at 02:14 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vswa`
--
create database if not exists vswa;
use vswa;
-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Movie'),
(2, 'Animation'),
(3, 'Music'),
(4, 'Entertainment'),
(5, 'Sports'),
(6, 'News'),
(7, 'Gaming'),
(8, 'Education'),
(9, 'Comedy'),
(10, 'Science & Technology'),
(11, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `postedBy` varchar(50) NOT NULL,
  `videoId` int(11) NOT NULL,
  `responseTo` int(11) NOT NULL,
  `body` text NOT NULL,
  `datePosted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentId` int(11) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `userTo` varchar(50) NOT NULL,
  `userFrom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL,
  `videoId` int(11) NOT NULL,
  `filePath` varchar(250) NOT NULL,
  `selected` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `videoId`, `filePath`, `selected`) VALUES
(7, 3, 'uploads/videos/thumbnails/3-5c25ee28b9a69.jpg', 1),
(8, 3, 'uploads/videos/thumbnails/3-5c25ee2ae5d25.jpg', 0),
(9, 3, 'uploads/videos/thumbnails/3-5c25ee2ee8124.jpg', 0),
(10, 4, 'uploads/videos/thumbnails/4-5c25eef649b4c.jpg', 1),
(11, 4, 'uploads/videos/thumbnails/4-5c25eefae8014.jpg', 0),
(12, 4, 'uploads/videos/thumbnails/4-5c25ef03bcd8b.jpg', 0),
(13, 5, 'uploads/videos/thumbnails/5-5c25ef6494d4d.jpg', 1),
(14, 5, 'uploads/videos/thumbnails/5-5c25ef66958d7.jpg', 0),
(15, 5, 'uploads/videos/thumbnails/5-5c25ef6a39bc4.jpg', 0),
(16, 6, 'uploads/videos/thumbnails/6-5c25f035c0924.jpg', 1),
(17, 6, 'uploads/videos/thumbnails/6-5c25f0391e018.jpg', 0),
(18, 6, 'uploads/videos/thumbnails/6-5c25f03f3b189.jpg', 0),
(19, 7, 'uploads/videos/thumbnails/7-5c25f12e2b6f6.jpg', 1),
(20, 7, 'uploads/videos/thumbnails/7-5c25f12fc9b82.jpg', 0),
(21, 7, 'uploads/videos/thumbnails/7-5c25f13299c69.jpg', 0),
(22, 8, 'uploads/videos/thumbnails/8-5c25f228841a9.jpg', 1),
(23, 8, 'uploads/videos/thumbnails/8-5c25f2290ea85.jpg', 0),
(24, 8, 'uploads/videos/thumbnails/8-5c25f229d6274.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profilePic` varchar(255) NOT NULL,
  `userType` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `email`, `password`, `signUpDate`, `profilePic`, `userType`) VALUES
(1, 'Taufiq', 'Hasib', 'sadi7', 'taufiqhasib@yahoo.com', '930437eac6c85f187e3ee26d3f763c6fa171d6d825031fb1d13e17977c1d0a58be8585f08a78adff8d671c2d2fe12ff16561c5f8ecd504956107a860893da78b', '2018-12-08 23:04:34', 'designer/images/profilePicture/profile.png', 'user'),
(2, 'Taufiq', 'Hasib', 'sadi17', 'taufiq.hasib@yahoo.com', '930437eac6c85f187e3ee26d3f763c6fa171d6d825031fb1d13e17977c1d0a58be8585f08a78adff8d671c2d2fe12ff16561c5f8ecd504956107a860893da78b', '2018-12-11 04:06:29', 'designer/images/profilePicture/profile.png', 'admin'),
(4, 'Tasmimanasrin', 'Priyanka', 'priyanka123', 'priyanka_progga@yahoo.com', '0d976494d3faba24e9bead01bb11eefe8c12693c6c64908313ef35e5cd185309ec966672ef3d11f410d5910702c78ba75f35eb62fa0eda2ce5057dbcd5f6e985', '2018-12-28 00:40:52', 'designer/images/profilePicture/profile.png', 'user'),
(5, 'Sultana', 'Sharna', 'sharna123', 'sultanasharna04@yahoo.com', '4bb8a5960859844f191097632cb74caa38539843b5fe9b61b584e9df6e6cf595daf4b782b8283c49fb09f50a8e0dcbe65fd8d75f69840892049f9b6596946831', '2018-12-28 00:43:27', 'designer/images/profilePicture/profile.png', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `uploadedBy` varchar(50) NOT NULL,
  `title` varchar(70) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `privacy` int(11) NOT NULL,
  `filePath` varchar(250) NOT NULL,
  `category` int(11) NOT NULL,
  `uploadDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int(11) NOT NULL,
  `duration` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `uploadedBy`, `title`, `description`, `privacy`, `filePath`, `category`, `uploadDate`, `views`, `duration`) VALUES
(3, 'sadi7', 'Cutest Baby Talk Ever', '', 0, 'uploads/videos/5c25edcabc7b7.mp4', 4, '2018-12-28 01:32:58', 0, '01:03'),
(4, 'sadi7', 'Doctor distracts baby form her shots with goofy tune', '', 1, 'uploads/videos/5c25ee652430a.mp4', 1, '2018-12-28 01:35:33', 0, '03:00'),
(5, 'sadi7', 'kids dancing Funny Video 4- SpiderMan Series', '', 1, 'uploads/videos/5c25ef2d18ce7.mp4', 4, '2018-12-28 01:38:53', 0, '01:08'),
(6, 'sadi7', 'Laughing Hyenas- Don\'t Look Up Wshen You\'re Running Esme', '', 0, 'uploads/videos/5c25efa5772f8.mp4', 4, '2018-12-28 01:40:53', 0, '01:27'),
(7, 'sadi7', 'Star Trek- Time Jump in \"Calypso\" Short Treks Trailer', '', 0, 'uploads/videos/5c25f0f16c1c3.mp4', 1, '2018-12-28 01:46:25', 0, '00:30'),
(8, 'sadi7', 'The Lion King Official Teaser Trailer', '', 0, 'uploads/videos/5c25f221cc84c.mp4', 1, '2018-12-28 01:51:29', 0, '01:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
