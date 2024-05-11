SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `vashu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(20) NOT NULL,
  `admin_fname` varchar(200) NOT NULL,
  `admin_lname` varchar(200) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_uname` varchar(200) NOT NULL,
  `admin_pwd` varchar(200) NOT NULL,
  `admin_dpic` varchar(60) NOT NULL
);

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_fname`, `admin_lname`, `admin_email`, `admin_uname`, `admin_pwd`, `admin_dpic`) VALUES
(1, 'System ', 'Admin', 'admin@vashu.com', 'Administrator', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'avatar-150.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(20) NOT NULL,
  `user_fname` varchar(200) NOT NULL,
  `user_lname` varchar(200) NOT NULL,
  `user_phone` varchar(200) NOT NULL,
  `user_addr` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `user_pwd` varchar(200) NOT NULL,
  `user_dpic` varchar(200) NOT NULL,
  `user_uname` varchar(200) NOT NULL,
  `user_bday` varchar(200) NOT NULL,
  `user_bio` longtext NOT NULL
);

-- INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_phone`, `user_addr`, `user_email`, )


-- `user_train_number` varchar(200) NOT NULL,
--   `user_train_name` varchar(200) NOT NULL,
--   `user_dep_station` varchar(200) NOT NULL,
--   `user_dep_time` varchar(200) NOT NULL,
--   `user_arr_station` varchar(200) NOT NULL,
--   `user_train_fare` varchar(200) NOT NULL,
--   `user_fare_payment_code` varchar(200) NOT NULL
-- --------------------------------------------------------

--
-- Table structure for table `orrs_passwordresets`
--

-- CREATE TABLE `orrs_passwordresets` (
--   `pwd_id` int(20) NOT NULL,
--   `email` varchar(200) NOT NULL,
--   `status` varchar(200) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --
-- -- Dumping data for table `orrs_passwordresets`
-- --

-- INSERT INTO `orrs_passwordresets` (`pwd_id`, `email`, `status`) VALUES
-- (1, 'martdevelopers254@gmail.com', 'Approved'),
-- (2, 'martinezmbithi@gmail.com', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `number` int(5) NOT NULL,
  `name` varchar(200) NOT NULL,
  `route` varchar(200) NOT NULL,
  `time` varchar(200) NOT NULL,
  `distance` varchar(200) NOT NULL,
  `source` varchar(200) NOT NULL,
  `destination` varchar(200) NOT NULL,
  `dep_time` varchar(200) NOT NULL,
  `arr_time` varchar(200) NOT NULL,
  `seats` int(5) NOT NULL,
  `fare` int(10) NOT NULL
);

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`number`, `name`, `route`, `time`, `distance`, `source`, `destination`, `dep_time`, `arr_time`, `seats`, `fare`) VALUES
(22436, 'Vande Bharat', '1-New Delhi-2-Kanpur-3-Allahabad-4-Varanasi', '1-06:00-2-10:10-3-12:10-4-14:00', '1-0-2-440-3-635-4-760', 'New Delhi', 'Varanasi', '06:00', '14:00', 50, 1500),
(12302, 'Rajdhani Express', '1-New Delhi-2-Kanpur-3-Allahabad-4-Gaya-5-Dhanbad-6-Howrah', '1-16:50-2-21:30-3-23:45-4-04:00-5-06:30-6-10:00', '1-0-2-440-3-635-4-990-5-1190-6-1450', 'New Delhi', 'Howrah', '16:50', '10:00', 60, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `pnr` bigint(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `pass_name` varchar(200) NOT NULL,
  `pass_email` varchar(200) NOT NULL,
  `train_name` varchar(200) NOT NULL,
  `train_no` int(5) NOT NULL,
  `date` date NOT NULL,
  `train_dep_stat` varchar(200) NOT NULL,
  `dep_time` varchar(5) NOT NULL,
  `train_arr_stat` varchar(200) NOT NULL,
  `arr_time` varchar(5) NOT NULL,
  `distance` int NOT NULL,
  `train_fare` int(10) NOT NULL
);

--
-- Dumping data for table `passenger`
--

-- INSERT INTO `passenger` (`pnr`, `user_id`, `pass_name`, `pass_email`, `train_name`, `train_no`, `train_dep_stat`, `train_arr_stat`, `train_fare`) VALUES
-- (2, 'Martin Mbithi', 'martdevelopers254@gmail.com', '127.0.0.1', 'Admiraal de Ruijter', 'T-002', 'Nairobi', 'Kisumu', '2500', 'KTM129NUD9', 'Approved'),
-- (3, 'Martin Mbithi', 'martdevelopers254@gmail.com', '127.0.0.1', 'Capitals United Express', 'T-005', 'Mombasa', 'Kampala', '4500', 'KTM129NUD9', 'Approved'),
-- (4, 'Martin Mbithi', 'martdevelopers254@gmail.com', '127.0.0.1', 'Admiraal de Ruijter', 'T-002', 'Nairobi', 'Kisumu', '2500', 'KTM129NUD9', 'Approved');


CREATE TABLE `booked` (
  `user_id` int(20) NOT NULL,
  `pnr` bigint(20) NOT NULL,
  `train_no` int(5) NOT NULL,
  `train_name` varchar(200) NOT NULL
);

CREATE TABLE `feedback` (
  `id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `feedback` longtext,
  `date` date NOT NULL,
  `time` time NOT NULL
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orrs_admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orrs_passenger`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `orrs_passwordresets`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `orrs_train`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`pnr`);

--
-- Indexes for table `orrs_train_tickets`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orrs_admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orrs_passwordresets`
--
ALTER TABLE `user`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


--
-- AUTO_INCREMENT for table `orrs_train_tickets`
--
ALTER TABLE `feedback`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `passenger`
ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE `booked`
ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE `feedback`
ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE `passenger`
ADD FOREIGN KEY (`pnr`) REFERENCES `booked`(`pnr`)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE `passenger`
ADD FOREIGN KEY (`train_no`) REFERENCES `train`(`number`)
ON DELETE CASCADE
ON UPDATE CASCADE;

ALTER TABLE `booked`
ADD FOREIGN KEY (`train_no`) REFERENCES `train`(`number`)
ON DELETE CASCADE
ON UPDATE CASCADE;

COMMIT;