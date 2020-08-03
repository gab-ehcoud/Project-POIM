-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql301.epizy.com
-- Generation Time: Aug 03, 2020 at 01:12 PM
-- Server version: 5.6.48-88.0
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
-- Database: `epiz_26346287_poimclient`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `Agent_Id` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Name` char(200) NOT NULL,
  `Location` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `Agent_Id`, `email`, `password`, `Name`, `Location`) VALUES
(1, '123456', 'utkarsh@alonehands.com', 'be180cd72985657a654d60c9f00d5af3', 'Utkarsh Pandey', 'Delhi');

-- --------------------------------------------------------

--
-- Table structure for table `CA_details`
--

CREATE TABLE `CA_details` (
  `id` int(11) NOT NULL,
  `CA` varchar(100) NOT NULL,
  `Name` char(100) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Area_Code` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CA_details`
--

INSERT INTO `CA_details` (`id`, `CA`, `Name`, `Address`, `Area_Code`) VALUES
(1, '225222', 'Utkarsh Pandey', 'B-14, Mukundpur', 'M15');

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `Sno` int(11) NOT NULL,
  `Emp_Id` varchar(100) NOT NULL,
  `Emp_Name` char(100) NOT NULL,
  `Emp_Branch` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`Sno`, `Emp_Id`, `Emp_Name`, `Emp_Branch`) VALUES
(1, '2333', 'Utkarsh Pandey', 'Mukundpur,Delhi');

-- --------------------------------------------------------

--
-- Table structure for table `fixing_team`
--

CREATE TABLE `fixing_team` (
  `id` int(11) NOT NULL,
  `Ft_Id` varchar(100) NOT NULL,
  `Head_Name` char(100) NOT NULL,
  `Head_No` varchar(100) NOT NULL,
  `Area_Code` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fixing_team`
--

INSERT INTO `fixing_team` (`id`, `Ft_Id`, `Head_Name`, `Head_No`, `Area_Code`) VALUES
(1, '789456', 'Gaurav Dhiman', '+919990808950', 'M15');

-- --------------------------------------------------------

--
-- Table structure for table `ft_users`
--

CREATE TABLE `ft_users` (
  `id` int(11) NOT NULL,
  `Ft_Id` varchar(100) NOT NULL,
  `Team_No` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `Area_Code` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ft_users`
--

INSERT INTO `ft_users` (`id`, `Ft_Id`, `Team_No`, `password`, `Area_Code`) VALUES
(1, '789456', '456', 'be180cd72985657a654d60c9f00d5af3', 'M15');

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `Module_No` varchar(100) NOT NULL,
  `Area_Code` varchar(100) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `Module_No`, `Area_Code`, `lat`, `lng`, `type`) VALUES
(1, 'A555', 'M15', 28.738605, 77.178802, 'Tranformer'),
(2, 'B333', 'M16', 26.225222, 72.225540, 'Pole');

-- --------------------------------------------------------

--
-- Table structure for table `ozekimessagein`
--

CREATE TABLE `ozekimessagein` (
  `id` int(11) NOT NULL,
  `sender` varchar(30) DEFAULT NULL,
  `receiver` varchar(30) DEFAULT NULL,
  `msg` varchar(1024) DEFAULT NULL,
  `senttime` varchar(100) DEFAULT NULL,
  `receivedtime` varchar(100) DEFAULT NULL,
  `operator` varchar(100) DEFAULT NULL,
  `msgtype` varchar(160) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ozekimessageout`
--

CREATE TABLE `ozekimessageout` (
  `id` int(11) NOT NULL,
  `sender` varchar(30) DEFAULT NULL,
  `receiver` varchar(30) DEFAULT NULL,
  `msg` varchar(1024) DEFAULT NULL,
  `senttime` varchar(100) DEFAULT NULL,
  `receivedtime` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `msgtype` varchar(160) DEFAULT NULL,
  `operator` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ozekimessageout`
--

INSERT INTO `ozekimessageout` (`id`, `sender`, `receiver`, `msg`, `senttime`, `receivedtime`, `status`, `msgtype`, `operator`) VALUES
(1, NULL, '+919990808950', 'Hi', NULL, NULL, 'send', 'SMS:TEXT', NULL),
(2, NULL, '919990808950', 'Hi', NULL, NULL, 'send', 'SMS:TEXT', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `planned_outgae`
--

CREATE TABLE `planned_outgae` (
  `id` int(11) NOT NULL,
  `Area_Code` varchar(100) NOT NULL,
  `Planned_Dt` datetime NOT NULL,
  `Est_Time` int(10) NOT NULL,
  `Message` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `planned_outgae`
--

INSERT INTO `planned_outgae` (`id`, `Area_Code`, `Planned_Dt`, `Est_Time`, `Message`) VALUES
(1, 'M14', '2020-07-30 03:50:00', 140, 'This is trial messaging system'),
(2, 'B16', '2020-07-30 03:50:00', 140, 'This is trial messaging system');

-- --------------------------------------------------------

--
-- Table structure for table `power_outage`
--

CREATE TABLE `power_outage` (
  `Sno` int(11) NOT NULL,
  `Area_Code` varchar(100) NOT NULL,
  `Problem_Title` varchar(200) NOT NULL,
  `Est_Time` int(20) NOT NULL,
  `Status` varchar(100) NOT NULL DEFAULT 'Detected',
  `Module_No` varchar(200) NOT NULL,
  `Reported_Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Ft_Id` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `power_outage`
--

INSERT INTO `power_outage` (`Sno`, `Area_Code`, `Problem_Title`, `Est_Time`, `Status`, `Module_No`, `Reported_Time`, `Ft_Id`) VALUES
(12, 'M14', 'Try', 140, 'Solved', 'A552225', '2020-08-01 03:16:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `send_message`
--

CREATE TABLE `send_message` (
  `id` int(11) NOT NULL,
  `Message_Title` varchar(100) NOT NULL,
  `Message` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `send_message`
--

INSERT INTO `send_message` (`id`, `Message_Title`, `Message`) VALUES
(1, 'This is one of our trials', 'This is first encounter of the messages'),
(2, 'Try', 'This is a try\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `sms_mod`
--

CREATE TABLE `sms_mod` (
  `id` int(11) NOT NULL,
  `from` varchar(100) NOT NULL,
  `body` varchar(100) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_mod`
--

INSERT INTO `sms_mod` (`id`, `from`, `body`, `time`) VALUES
(51, '', '', '2020-08-03 04:06:43'),
(52, '', '', '2020-08-03 04:06:46'),
(53, '', '', '2020-08-03 04:06:49'),
(54, '', '', '2020-08-03 04:06:52'),
(55, '', '', '2020-08-03 04:20:25'),
(56, '', '', '2020-08-03 04:43:41'),
(57, '', '', '2020-08-03 04:44:06'),
(58, '', '', '2020-08-03 04:46:21'),
(59, '', '', '2020-08-03 04:46:56'),
(60, '', '', '2020-08-03 04:46:59'),
(61, '', '', '2020-08-03 04:54:26'),
(62, '', '', '2020-08-03 05:00:18'),
(63, '', '', '2020-08-03 05:00:39'),
(64, '', '', '2020-08-03 05:36:18'),
(65, '', '', '2020-08-03 05:36:49'),
(66, '', '', '2020-08-03 05:37:49'),
(67, '', '', '2020-08-03 05:37:52'),
(68, '', '', '2020-08-03 05:38:37'),
(69, '', '', '2020-08-03 05:41:45'),
(70, '', '', '2020-08-03 05:41:48'),
(71, '', '', '2020-08-03 05:42:03'),
(72, '', '', '2020-08-03 05:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `street_lights`
--

CREATE TABLE `street_lights` (
  `id` int(11) NOT NULL,
  `Poll_No` varchar(100) NOT NULL,
  `Problem_Title` char(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `street_lights`
--

INSERT INTO `street_lights` (`id`, `Poll_No`, `Problem_Title`) VALUES
(1, '252222', 'Try'),
(2, '255222', 'Panseefabfha'),
(3, '2', 'This is not working'),
(4, '2', 'This is the dummy problem');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `CA` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `CA`, `email`, `password`) VALUES
(1, '225222', 'pandey.utkarsh85@gmail.com', 'be180cd72985657a654d60c9f00d5af3'),
(2, '123456', 'jatin682000@gmail.com', '1dab4bfab398ed943af468e2a7c2661a'),
(3, '12345', 'jatin68200@gmail.com', '202cb962ac59075b964b07152d234b70'),
(4, '682', 'jk682000@gmail.com', '08d98638c6fcd194a4b1e6992063e944'),
(5, '12341234', 'khuranaraj.121@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CA_details`
--
ALTER TABLE `CA_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`Sno`);

--
-- Indexes for table `fixing_team`
--
ALTER TABLE `fixing_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ft_users`
--
ALTER TABLE `ft_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ozekimessagein`
--
ALTER TABLE `ozekimessagein`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ozekimessageout`
--
ALTER TABLE `ozekimessageout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planned_outgae`
--
ALTER TABLE `planned_outgae`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `power_outage`
--
ALTER TABLE `power_outage`
  ADD PRIMARY KEY (`Sno`);

--
-- Indexes for table `send_message`
--
ALTER TABLE `send_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_mod`
--
ALTER TABLE `sms_mod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `street_lights`
--
ALTER TABLE `street_lights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `CA_details`
--
ALTER TABLE `CA_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `Sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fixing_team`
--
ALTER TABLE `fixing_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ft_users`
--
ALTER TABLE `ft_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ozekimessagein`
--
ALTER TABLE `ozekimessagein`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ozekimessageout`
--
ALTER TABLE `ozekimessageout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `planned_outgae`
--
ALTER TABLE `planned_outgae`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `power_outage`
--
ALTER TABLE `power_outage`
  MODIFY `Sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `send_message`
--
ALTER TABLE `send_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sms_mod`
--
ALTER TABLE `sms_mod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `street_lights`
--
ALTER TABLE `street_lights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
