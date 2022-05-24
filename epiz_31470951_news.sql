-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql102.epizy.com
-- Generation Time: May 24, 2022 at 08:05 PM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_31470951_news`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `news_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `news_id`, `name`, `comment`, `created_at`) VALUES
(13, 13, 'Test', ' test second comment', '2022-05-24 18:16:08'),
(14, 13, 'Test', 'Test a third comment ', '2022-05-24 18:16:24'),
(12, 13, 'Ehab', ' What a sad news', '2022-05-24 18:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `brief` varchar(200) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `brief`, `body`, `created_at`) VALUES
(13, 'Quad Summit: World faces \'dark hour\' with Ukraine war, says Biden', ' The world is \"navigating a dark hour in our shared history\" with Russia\'s invasion of Ukraine, US President Joe Biden told key Asian allies.', '  The war has now become a \"global issue\" underscoring the importance of defending international order, he said.\r\n\r\nJapanese PM Fumio Kishida also echoed his comments, saying that a similar invasion should not happen in Asia.\r\n\r\nMr Biden is meeting the leaders of Japan, Australia and India in Tokyo in his first visit to Asia as president.\r\n\r\nThe four countries known collectively as the Quad are discussing security and economic concerns including China\'s growing influence in the region - and differences over the Russian invasion.\r\n\r\nMr Biden\'s comments come a day after he warned China that it was \"flirting with danger\" over Taiwan, and vowed to protect Taiwan militarily if China attacked, appearing to contradict a long-standing policy on the issue.', '2022-05-24 02:28:23'),
(6, 'Ukraine peace deal: Kyiv rules out ceding land to Russia.', ' The Ukrainian government says it will not agree a ceasefire deal with Russia that involves giving up territory.', '  The apparent hardening of Ukraine\'s position comes a day after President Volodymyr Zelensky said the war could only be resolved through diplomacy.\r\n\r\nPresidential adviser Mykhaylo Podolyak said concessions would lead to an even larger and bloodier Russian offensive.\r\n\r\nHis comments come as Russia continues attempts to encircle Ukrainian forces defending Severodonetsk in the east.\r\n\r\nIn another development, Polish President Andrzej Duda has become the first foreign leader to address the parliament in Kyiv in person.\r\n\r\nHe received a standing ovation as he declared that only Ukrainians themselves could decide their future.', '2022-05-22 16:58:50'),
(16, 'BBC apologises after \'Manchester United are rubbish\' appears on screen', 'The BBC has apologised after a message appeared on the news channel saying \"Manchester United are rubbish\".', 'The text mistakenly popped up on the news ticker at the bottom of the screen during a tennis update just after 0930 on Tuesday.\r\nLater in the morning, presenter Annita Mcveigh apologised to any Manchester United fans who may have been offended.\r\nShe said the mistake had occurred as someone was learning how to operate the ticker and was \"writing random things\".\r\nAnother message which appeared on the ticker read simply: \"Weather rain everywhere.\"\r\nMcveigh told viewers: \"A little earlier, some of you may have noticed something pretty unusual on the ticker that runs along the bottom of the screen with news making a comment about Manchester United, and I hope that Manchester United fans weren\'t offended by it.', '2022-05-24 16:35:43'),
(25, 'teeest', 'teeeeeeeeeeeeeeeeeeeeeest 1111', 'tesssssssssssssssssssssssssssssssssssssssssssssssssssssssssst  ', '2022-05-24 18:17:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
