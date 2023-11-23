-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 30, 2023 at 06:05 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Music`
--

-- --------------------------------------------------------

--
-- Table structure for table `Album`
--

CREATE TABLE `Album` (
  `Album_ID` int(11) NOT NULL,
  `Album_Name` varchar(255) NOT NULL,
  `Artist_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Album`
--

INSERT INTO `Album` (`Album_ID`, `Album_Name`, `Artist_ID`) VALUES
(1, '1989', 1),
(2, 'Speak Now', 1),
(3, 'Beatopia', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Artist`
--

CREATE TABLE `Artist` (
  `Artist_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Bio` varchar(255) NOT NULL,
  `Image_Url` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL,
  `Website` varchar(255) NOT NULL,
  `Birth_Date` date NOT NULL,
  `Age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Artist`
--

INSERT INTO `Artist` (`Artist_ID`, `Name`, `Bio`, `Image_Url`, `Country`, `Website`, `Birth_Date`, `Age`) VALUES
(1, 'Taylor Swift', 'Taylor Alison Swift is an American singer-songwriter. Recognized for her songwriting, musical versatility, artistic reinventions, and influence on the music industry, she is a prominent cultural figure of the 21st century. ', 'https://dims.apnews.com/dims4/default/744e2a3/2147483647/strip/true/crop/6000x4000+0+0/resize/599x399!/quality/90/?url=https%3A%2F%2Fassets.apnews.com%2F69%2Fbf%2F6663002a714bf4f6997b64279f56%2F8c92eb21ab7545429b24763188e5c6ae', 'USA', 'https://www.taylorswift.com', '1989-12-13', 33),
(2, 'Beabadoobee', 'Beatrice Kristi Ilejay Laus, known professionally as beabadoobee, is a Filipino-English singer and songwriter. ', 'https://popspoken.com/wp-content/uploads/2020/09/beabadoobee-jordan-curtis-hughes2-8eb56be1a64ebccc6b704fa65166f7a38989394d-s1600-c85-1.jpg', 'USA', 'https://en.wikipedia.org/wiki/Beabadoobee', '2000-06-03', 23);

-- --------------------------------------------------------

--
-- Table structure for table `Genre`
--

CREATE TABLE `Genre` (
  `Genre_ID` int(11) NOT NULL,
  `Genre_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Genre`
--

INSERT INTO `Genre` (`Genre_ID`, `Genre_name`) VALUES
(1, 'Pop'),
(2, 'Kpop'),
(3, 'Jazz'),
(4, 'Country'),
(5, 'R&B'),
(6, 'Hiphop'),
(7, 'Indie'),
(8, 'Classical');

-- --------------------------------------------------------

--
-- Table structure for table `Global_MusicBank`
--

CREATE TABLE `Global_MusicBank` (
  `Song_ID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Artist_ID` int(11) NOT NULL,
  `Genre_ID` int(11) NOT NULL,
  `Release_Date` date NOT NULL,
  `Album_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Global_MusicBank`
--

INSERT INTO `Global_MusicBank` (`Song_ID`, `Title`, `Artist_ID`, `Genre_ID`, `Release_Date`, `Album_ID`) VALUES
(1, 'The perfect pair', 2, 7, '2022-10-12', 3),
(2, 'Style', 1, 1, '2014-10-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE `Login` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `Student_ID` int(10) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Line_ID` varchar(50) NOT NULL,
  `Faculty` varchar(255) NOT NULL,
  `Year` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `profile_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`Student_ID`, `Username`, `Email`, `Line_ID`, `Faculty`, `Year`, `Name`, `profile_url`) VALUES
(642279013, 'Tyma', 'tyma@gmail.com', 'tyma123', 'CPE', 3, 'Featthima You', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwLrG4ngjah3CLIhaBkzP-5Oq6HtLiNbcM2TvEBym4bzAlDnOfKamlyEg8Ussg8LAU41o&usqp=CAU'),
(642279015, 'Jash', 'Jash@gmail.com', 'jash123', 'CPE', 3, 'Jaya Shree Hada', 'https://imgv3.fotor.com/images/slider-image/a-man-holding-a-camera-with-image-filter.jpg'),
(642279017, 'Rose', 'rose@gmail.com', 'rose123', 'CPE', 3, 'Roselyn Singrakthai', 'https://buffer.com/cdn-cgi/image/w=1000,fit=contain,q=90,f=auto/library/content/images/size/w1200/2023/10/free-images.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `User_MusicBank`
--

CREATE TABLE `User_MusicBank` (
  `Song_ID` int(11) NOT NULL,
  `Student_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Album`
--
ALTER TABLE `Album`
  ADD PRIMARY KEY (`Album_ID`),
  ADD KEY `Artist_ID` (`Artist_ID`);

--
-- Indexes for table `Artist`
--
ALTER TABLE `Artist`
  ADD PRIMARY KEY (`Artist_ID`);

--
-- Indexes for table `Genre`
--
ALTER TABLE `Genre`
  ADD PRIMARY KEY (`Genre_ID`);

--
-- Indexes for table `Global_MusicBank`
--
ALTER TABLE `Global_MusicBank`
  ADD PRIMARY KEY (`Song_ID`),
  ADD KEY `Artist_ID` (`Artist_ID`),
  ADD KEY `Album_ID` (`Album_ID`),
  ADD KEY `Genre_ID` (`Genre_ID`);

--
-- Indexes for table `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Student_ID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `User_MusicBank`
--
ALTER TABLE `User_MusicBank`
  ADD KEY `Song_ID` (`Song_ID`,`Student_ID`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Album`
--
ALTER TABLE `Album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`Artist_ID`) REFERENCES `Artist` (`Artist_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Global_MusicBank`
--
ALTER TABLE `Global_MusicBank`
  ADD CONSTRAINT `global_musicbank_ibfk_1` FOREIGN KEY (`Album_ID`) REFERENCES `Album` (`Album_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `global_musicbank_ibfk_2` FOREIGN KEY (`Artist_ID`) REFERENCES `Artist` (`Artist_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `global_musicbank_ibfk_3` FOREIGN KEY (`Genre_ID`) REFERENCES `Genre` (`Genre_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Login`
--
ALTER TABLE `Login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `Users` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User_MusicBank`
--
ALTER TABLE `User_MusicBank`
  ADD CONSTRAINT `user_musicbank_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `Users` (`Student_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_musicbank_ibfk_2` FOREIGN KEY (`Song_ID`) REFERENCES `Global_MusicBank` (`Song_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
