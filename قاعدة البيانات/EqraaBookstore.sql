-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2017 at 04:53 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `EqraaBookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `book_code` varchar(8) NOT NULL,
  `book_name` varchar(60) NOT NULL,
  `book_desc` tinytext NOT NULL,
  `book_img_name` varchar(60) NOT NULL,
  `price` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `category`, `book_code`, `book_name`, `book_desc`, `book_img_name`, `price`) VALUES
(1, 'stories', '815', 'Full Dark, No Stars', 'Full Dark, No Stars, published in November 2010, is a collection of four novellas by the author Stephen King, all dealing with the theme of retribution.', 'FullDark-NoStars.jpg', '200'),
(2, 'stories', '946', 'The Legend of Sleepy Hollow', '"The Legend of Sleepy Hollow" is a short story of speculative fiction by American author Washington Irving, contained in his collection of 34 essays and short stories entitled The Sketch Book of Geoffrey Crayon, Gent.', 'The-Legend-of-Sleepy-Hollow.jpg', '280'),
(3, 'stories', '249', 'The Lottery and Other Stories', 'The Lottery and Other Stories is a 1949 short story collection by American author Shirley Jackson. Published by Farrar, Straus, it includes "The Lottery" and 24 other stories.', 'The_Lottery_and_Other_Stories.jpg', '400'),
(4, 'textbooks', '457', 'Newton''s Principia', 'Mathematical Principles of Natural Philosophy, often referred to as simply the Principia, is a work in three books by Isaac Newton, in Latin, first published 5 July 1687. ', 'Newton''s-Principia.jpg', '99'),
(5, 'cookbooks', '912', 'Better Homes and Gardens', 'Since 1930, home cooks have turned to Better Homes and Gardens New Cook Book for guidance in the kitchen. This new edition includes more than 1,200 recipes, 1,000 color photos, and more tips and how-to information than ever.', 'Better-Homes-and-Gardens.jpg', '550'),
(6, 'cookbooks', '224', 'The Whole30', 'Millions of people visit Whole30.com every month and share their stories of weight loss and lifestyle makeovers. Hundreds of thousands of them have read It Starts With Food, which explains the science behind the program. ', 'The-Whole30.jpg', '345'),
(7, 'childrens', '542', 'Babar the Elephant', 'An orphaned baby elephant goes to live in the city with an old lady who gives him everything he wants, but eventually returns to the forest. Abridged form on board pages', 'Babar-the-Elephant.jpg', '39'),
(8, 'childrens', '813', 'Charlotte''s Web', 'Charlotte''s Web is a children''s novel by American author E. B. White and illustrated by Garth Williams; it was published in October 15, 1952, by Harper & Brothers.', 'Charlottes-Web.jpg', '45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
