-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2017 at 04:17 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitness`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cal_burnt_cardio` ()  MODIFIES SQL DATA
BEGIN
           DECLARE cal int;
           DECLARE log_id int;
           
            SET log_id = (SELECT max(log_entry_id) from cardio_exercise_log);
            SET cal = (SELECT cardio_exercise_log.time FROM cardio_exercise_log WHERE log_entry_id = log_id) * (SELECT calories_m FROM exercise_db WHERE exercise_id IN (SELECT exercise_id FROM cardio_exercise_log WHERE log_entry_id = log_id)); 
            UPDATE cardio_exercise_log SET calories_burnt = cal WHERE log_entry_id = log_id;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cal_burnt_graph` (IN `uid` INT, IN `cu_date` INT)  MODIFIES SQL DATA
BEGIN
            DECLARE tot_cal int;
            DECLARE userid int;
            DECLARE cardio_tot_cal int;
            DECLARE strength_tot_cal int;
            
            SET userid = (select user_id from calories_burnt_graph where c_date = cu_date and user_id = uid);

            SET cardio_tot_cal = (select sum(calories_burnt) from cardio_exercise_log where user_id = uid and log_date = cu_date);
            SET strength_tot_cal = (select sum(calories_burnt) from strength_exercise_log where user_id = uid and log_date = cu_date);

            IF cardio_tot_cal IS NULL THEN 
                SET cardio_tot_cal = 0;
            END IF;
            IF strength_tot_cal IS NULL THEN 
                SET strength_tot_cal = 0;
            END IF;
            SET tot_cal =  cardio_tot_cal + strength_tot_cal ;
            IF userid IS NULL THEN
                insert into calories_burnt_graph (user_id, c_date, total_burnt_calories) values (uid,cu_date,tot_cal);
            ELSE 
                update calories_burnt_graph SET total_burnt_calories = tot_cal where user_id = uid and c_date = cu_date;
            END IF;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cal_burnt_strength` ()  MODIFIES SQL DATA
BEGIN
           DECLARE cal int;
           DECLARE log_id int;
           
            SET log_id = (SELECT max(log_entry_id) from strength_exercise_log);
            SET cal = (SELECT strength_exercise_log.sets FROM strength_exercise_log WHERE log_entry_id = log_id) * (SELECT calories_m FROM exercise_db WHERE exercise_id IN (SELECT exercise_id FROM strength_exercise_log WHERE log_entry_id = log_id)); 
            UPDATE strength_exercise_log SET calories_burnt = cal WHERE log_entry_id = log_id;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cal_gained` ()  MODIFIES SQL DATA
BEGIN
            DECLARE log_id int;
            DECLARE cal int;
            SET log_id = (SELECT max(log_entry_id) from food_log);
            SET cal = ((SELECT amount_g FROM food_log WHERE log_entry_id = log_id) * (SELECT calories_g FROM food_db WHERE food_id IN (SELECT food_id FROM food_log WHERE log_entry_id = log_id))) / 100;
            UPDATE food_log SET calories_consumed = cal WHERE log_entry_id = log_id;
         END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cal_gained_graph` (IN `uid` INT, IN `cu_date` INT)  MODIFIES SQL DATA
BEGIN
        DECLARE tot_cal int;
        DECLARE userid int;
        SET FOREIGN_KEY_CHECKS=0;
        SET userid = (select user_id from calories_gained_graph where c_date = cu_date and user_id = uid);
            IF userid IS NULL THEN
                SET tot_cal = (select sum(calories_consumed) from food_log where user_id = uid and log_date = cu_date);
                insert into calories_gained_graph (user_id, c_date, total_gained_calories) values (uid,cu_date,tot_cal);
            ELSE 
                SET tot_cal = (select sum(calories_consumed) from food_log where user_id = uid and log_date = cu_date);
                update calories_gained_graph SET total_gained_calories = tot_cal where user_id = uid and c_date = cu_date;
            END IF;
        END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `calories_burnt_graph`
--

CREATE TABLE `calories_burnt_graph` (
  `entry_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `c_date` date DEFAULT NULL,
  `total_burnt_calories` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calories_burnt_graph`
--

INSERT INTO `calories_burnt_graph` (`entry_id`, `user_id`, `c_date`, `total_burnt_calories`) VALUES
(1, 1, '2017-11-02', 258),
(2, 1, '2017-11-03', 666),
(3, 1, '2017-11-04', 330),
(4, 1, '2017-11-05', 195),
(5, 1, '2017-11-06', 124),
(6, 1, '2017-11-07', 162),
(7, 1, '2017-11-08', 201),
(8, 2, '2017-11-18', 1500),
(9, 3, '2017-11-18', 84),
(10, 1, '2017-11-18', 105),
(11, 2, '2017-11-19', 40),
(12, 1, '2017-11-23', 21),
(14, 1, '2017-11-26', 135);

-- --------------------------------------------------------

--
-- Table structure for table `calories_gained_graph`
--

CREATE TABLE `calories_gained_graph` (
  `entry_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `c_date` date DEFAULT NULL,
  `total_gained_calories` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calories_gained_graph`
--

INSERT INTO `calories_gained_graph` (`entry_id`, `user_id`, `c_date`, `total_gained_calories`) VALUES
(1, 1, '2017-11-02', 3855),
(2, 1, '2017-11-03', 2499),
(3, 1, '2017-11-07', 2125),
(4, 2, '2017-11-18', 17460),
(5, 1, '2017-11-18', 357),
(6, 2, '2017-11-19', 678),
(7, 1, '2017-11-23', 365);

-- --------------------------------------------------------

--
-- Table structure for table `cardio_exercise_log`
--

CREATE TABLE `cardio_exercise_log` (
  `log_entry_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `exercise_id` int(11) DEFAULT NULL,
  `distance` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `calories_burnt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cardio_exercise_log`
--

INSERT INTO `cardio_exercise_log` (`log_entry_id`, `user_id`, `log_date`, `exercise_id`, `distance`, `time`, `calories_burnt`) VALUES
(1, 1, '2017-11-02', 80, 3500, 15, 135),
(2, 1, '2017-11-02', 77, 2500, 10, 60),
(3, 1, '2017-11-03', 79, 1380, 15, 150),
(4, 1, '2017-11-03', 80, 2620, 10, 90),
(5, 1, '2017-11-04', 76, 1, 15, 60),
(6, 1, '2017-11-04', 82, 1000, 30, 240),
(7, 1, '2017-11-05', 78, 1250, 15, 135),
(8, 1, '2017-11-05', 77, 680, 5, 30),
(9, 1, '2017-11-06', 81, 1000, 10, 70),
(10, 1, '2017-11-06', 85, 50, 10, 70),
(11, 1, '2017-11-07', 83, 2000, 15, 120),
(12, 1, '2017-11-07', 79, 3000, 15, 150),
(13, 1, '2017-11-08', 84, 10, 15, 165),
(14, 1, '2017-11-08', 81, 1000, 15, 105),
(15, 2, '2017-11-18', 76, 12, 12, 48),
(16, 1, '2017-11-18', 81, 1000, 15, 105),
(17, 1, '2017-11-26', 78, 2000, 15, 135);

--
-- Triggers `cardio_exercise_log`
--
DELIMITER $$
CREATE TRIGGER `timestamp_exercise_cardio` BEFORE INSERT ON `cardio_exercise_log` FOR EACH ROW SET NEW.log_date = CURRENT_DATE()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `exercise_category_db`
--

CREATE TABLE `exercise_category_db` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exercise_category_db`
--

INSERT INTO `exercise_category_db` (`category_id`, `category_name`) VALUES
(1, 'Abdominals'),
(2, 'Back'),
(3, 'Biceps'),
(9, 'Cardio'),
(5, 'Chest'),
(6, 'Forearms'),
(4, 'Legs'),
(7, 'Shoulder'),
(8, 'Triceps');

-- --------------------------------------------------------

--
-- Table structure for table `exercise_db`
--

CREATE TABLE `exercise_db` (
  `exercise_id` int(11) NOT NULL,
  `exercise_name` varchar(40) NOT NULL,
  `exercise_category_id` int(11) DEFAULT NULL,
  `calories_m` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exercise_db`
--

INSERT INTO `exercise_db` (`exercise_id`, `exercise_name`, `exercise_category_id`, `calories_m`) VALUES
(1, 'Crunches', 1, 3),
(2, 'Side Crunches', 1, 3),
(3, 'Sit Ups', 1, 6),
(4, 'Hanging Leg Raises', 1, 6),
(5, 'Plank', 1, 4),
(6, 'Leg Raises', 1, 6),
(7, 'Dumbbell Side Bend', 1, 5),
(8, 'Side Plank', 1, 7),
(9, 'Mountain Climbers', 1, 8),
(10, 'Bicycle Crunches', 1, 4),
(11, 'One Arm Dumbbell Bent Over Rows', 2, 7),
(12, 'Seated Cable Rows', 2, 6),
(13, 'Lat Pulldown', 2, 7),
(14, 'Pull Ups', 2, 7),
(15, 'Behind the Neck Pulldown', 2, 7),
(16, 'Bent Over Barbell Rows', 2, 7),
(17, 'Deadlifts', 2, 8),
(18, 'Hyper Extensions', 2, 6),
(19, 'T-Bar Rows', 2, 7),
(20, 'Good Mornings', 2, 8),
(21, 'Barbell Curl', 3, 6),
(22, 'Preacher Curl', 3, 5),
(23, 'Hammer Curl', 3, 6),
(24, 'Concentration Curl', 3, 6),
(25, 'EZ Bar Curl', 3, 5),
(26, 'Zottman Curl', 3, 5),
(27, 'Cross Body Hammer Curl', 3, 5),
(28, 'Overhead Cable Curl', 3, 6),
(29, 'Incline Dumbbell Curl', 3, 5),
(30, 'Incline Hammer Curl', 3, 5),
(31, 'Standing Calf Raise', 4, 3),
(32, 'Seated Calf Raise', 4, 4),
(33, 'Leg Extension', 4, 5),
(34, 'Barbell Squats', 4, 8),
(35, 'Dumbbell Lunges', 4, 8),
(36, 'Leg Press', 4, 7),
(37, 'Leg Curl', 4, 7),
(38, 'Stiff Leg Deadlifts', 4, 7),
(39, 'Step Ups', 4, 7),
(40, 'Front Squats', 4, 8),
(41, 'Bench Press', 5, 8),
(42, 'Flat Dumbbell Flyes', 5, 7),
(43, 'Push Ups', 5, 6),
(44, 'Incline Dumbbell Press', 5, 7),
(45, 'Machine Chest Press', 5, 6),
(46, 'Pec Deck Flyes', 5, 6),
(47, 'Cable Cross Overs', 5, 7),
(48, 'Decline Dumbbell Bench Press', 5, 7),
(49, 'Pull Over', 5, 6),
(50, 'Upward Cable Crossovers', 5, 6),
(51, 'Wrist Curls', 6, 3),
(52, 'Reverse Wrist Curls', 6, 4),
(53, 'Weight Roll Ups', 6, 3),
(54, 'Bar Hold', 6, 4),
(55, 'Plate Pinches', 6, 3),
(56, 'Dumbbell Shoulder Press', 7, 7),
(57, 'Lateral Raises', 7, 5),
(58, 'Machine Shoulder Press', 7, 5),
(59, 'Front Dumbbell Raises', 7, 5),
(60, 'Arnold Press', 7, 6),
(61, 'Shrugs', 7, 6),
(62, 'Rear Deltoid Flyes', 7, 5),
(63, 'Clean and Press', 7, 7),
(64, 'Front Plate Raise', 7, 5),
(65, 'Kettlebell Press', 7, 7),
(66, 'Upright Rows', 7, 6),
(67, 'Cable Pushdown', 8, 5),
(68, 'Kick Back', 8, 5),
(69, 'One Arm Dumbbell Extension', 8, 5),
(70, 'Bench Dips', 8, 4),
(71, 'Rope Extensions', 8, 5),
(72, 'Close Grip Bench Press', 8, 7),
(73, 'Push Ups: Close Grip', 8, 5),
(74, 'Tricep Extension', 8, 4),
(75, 'Skull Crushers', 8, 4),
(76, 'Brisk Walk', 9, 4),
(77, 'Elliptical Trainer', 9, 6),
(78, 'Outdoor Running', 9, 9),
(79, 'Treadmill Running', 9, 10),
(80, 'Stationary Bike', 9, 9),
(81, 'Incline Walk', 9, 7),
(82, 'Swimming', 9, 8),
(83, 'Rowing Machine', 9, 8),
(84, 'Jumping Rope', 9, 11),
(85, 'Pilates', 9, 7);

-- --------------------------------------------------------

--
-- Table structure for table `fat_log`
--

CREATE TABLE `fat_log` (
  `log_entry_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `fat_p` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fat_log`
--

INSERT INTO `fat_log` (`log_entry_id`, `user_id`, `log_date`, `fat_p`) VALUES
(1, 1, '2017-10-01', 15),
(2, 2, '2017-10-01', 20),
(3, 1, '2017-10-03', 15),
(4, 2, '2017-10-03', 20),
(5, 1, '2017-10-05', 15),
(6, 2, '2017-10-05', 20),
(7, 1, '2017-10-07', 15),
(8, 2, '2017-10-07', 20),
(9, 1, '2017-10-09', 15),
(10, 2, '2017-10-09', 20),
(11, 1, '2017-10-11', 14),
(12, 2, '2017-10-11', 19),
(13, 1, '2017-10-13', 14),
(14, 2, '2017-10-13', 19),
(15, 1, '2017-10-15', 14),
(16, 2, '2017-10-15', 19),
(17, 1, '2017-10-17', 14),
(18, 2, '2017-10-17', 19),
(19, 1, '2017-10-19', 14),
(20, 2, '2017-10-19', 19),
(21, 1, '2017-10-21', 14),
(22, 2, '2017-10-21', 19),
(23, 1, '2017-10-23', 14),
(24, 2, '2017-10-23', 20),
(25, 1, '2017-10-25', 13),
(26, 2, '2017-10-25', 19),
(27, 1, '2017-10-27', 13),
(28, 2, '2017-10-27', 18),
(29, 1, '2017-10-29', 13),
(30, 2, '2017-10-29', 19),
(31, 1, '2017-11-18', 13),
(32, 2, '2017-11-18', 13),
(33, 2, '2017-11-18', 13),
(34, 2, '2017-11-18', 13),
(35, 2, '2017-11-18', 12),
(36, 2, '2017-11-18', 12),
(37, 4, '2017-11-18', 10),
(38, 5, '2017-11-18', 10),
(41, 2, '2017-11-19', 5);

--
-- Triggers `fat_log`
--
DELIMITER $$
CREATE TRIGGER `timestamp_fat` BEFORE INSERT ON `fat_log` FOR EACH ROW SET NEW.log_date = CURRENT_DATE()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `food_category_db`
--

CREATE TABLE `food_category_db` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_category_db`
--

INSERT INTO `food_category_db` (`category_id`, `category_name`) VALUES
(4, 'Cereals'),
(7, 'Chocolate'),
(5, 'Dairy'),
(3, 'Dry Fruits'),
(1, 'Fruits'),
(6, 'Meat'),
(2, 'Vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `food_db`
--

CREATE TABLE `food_db` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(30) NOT NULL,
  `food_category_id` int(11) DEFAULT NULL,
  `calories_g` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_db`
--

INSERT INTO `food_db` (`food_id`, `food_name`, `food_category_id`, `calories_g`) VALUES
(1, 'Apple', 1, 44),
(2, 'Avocado', 1, 160),
(3, 'Banana', 1, 65),
(4, 'Cherry', 1, 50),
(5, 'Grapes', 1, 62),
(6, 'Guava', 1, 68),
(7, 'Kiwi', 1, 50),
(8, 'Lemon', 1, 29),
(9, 'Mango', 1, 60),
(10, 'Melon', 1, 28),
(11, 'Orange', 1, 30),
(12, 'Peach', 1, 30),
(13, 'Pear', 1, 38),
(14, 'Pineapple', 1, 40),
(15, 'Strawberries', 1, 30),
(16, 'Tomato', 1, 20),
(17, 'Beans', 2, 80),
(18, 'Brocolli', 2, 32),
(19, 'Cabbage', 2, 20),
(20, 'Carrot', 2, 25),
(21, 'Cauliflower', 2, 30),
(22, 'Celery', 2, 10),
(23, 'Cucumber', 2, 10),
(24, 'Leek', 2, 20),
(25, 'Lentils', 2, 100),
(26, 'Letuce', 2, 15),
(27, 'Mushrooms', 2, 12),
(28, 'Olives', 2, 80),
(29, 'Onion', 2, 40),
(30, 'Peas', 2, 148),
(31, 'Spinach', 2, 8),
(32, 'Dates', 3, 282),
(33, 'Cashew', 3, 553),
(34, 'Almonds', 3, 576),
(35, 'Anjeer (Figs)', 3, 47),
(36, 'Peanut', 3, 567),
(37, 'Walnuts', 3, 654),
(38, 'Wheat', 4, 339),
(39, 'Oats', 4, 68),
(40, 'Rice', 4, 111),
(41, 'Corn', 4, 365),
(42, 'Cornflakes', 4, 357),
(43, 'Pasta', 4, 110),
(44, 'Noodles', 4, 70),
(45, 'Cheese', 5, 440),
(46, 'Cream', 5, 428),
(47, 'Eggs', 5, 150),
(48, 'Ice Cream', 5, 180),
(49, 'Milk', 5, 70),
(50, 'Soya Milk', 5, 36),
(51, 'Yogurt', 5, 60),
(52, 'Butter', 5, 750),
(53, 'Bacon', 6, 500),
(54, 'Beef', 6, 280),
(55, 'Chicken', 6, 200),
(56, 'Cod', 6, 100),
(57, 'Crab', 6, 110),
(58, 'Duck', 6, 430),
(59, 'Ham', 6, 240),
(60, 'Lam', 6, 300),
(61, 'Lobster', 6, 100),
(62, 'Pheasant', 6, 200),
(63, 'Prawns', 6, 100),
(64, 'Pork', 6, 290),
(65, 'Rabbit', 6, 180),
(66, 'Salmon', 6, 180),
(67, 'Turkey', 6, 160),
(68, 'Veal', 6, 240),
(69, 'Dairy Milk Silk', 7, 365),
(70, 'Nestle Milky Bar', 7, 108),
(71, 'Mars', 7, 491),
(72, 'Snickers', 7, 480),
(73, 'Ferero Rocher', 7, 220),
(74, 'Cadburys Bournville', 7, 225);

-- --------------------------------------------------------

--
-- Table structure for table `food_log`
--

CREATE TABLE `food_log` (
  `log_entry_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `amount_g` int(11) DEFAULT NULL,
  `calories_consumed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_log`
--

INSERT INTO `food_log` (`log_entry_id`, `user_id`, `log_date`, `food_id`, `amount_g`, `calories_consumed`) VALUES
(1, 1, '2017-11-02', 38, 100, 339),
(2, 1, '2017-11-02', 43, 200, 220),
(3, 1, '2017-11-02', 53, 100, 500),
(4, 1, '2017-11-02', 3, 50, 33),
(5, 1, '2017-11-02', 32, 10, 28),
(6, 1, '2017-11-02', 17, 20, 16),
(7, 1, '2017-11-02', 19, 50, 10),
(8, 1, '2017-11-02', 27, 40, 5),
(9, 1, '2017-11-02', 28, 10, 8),
(10, 1, '2017-11-02', 45, 20, 88),
(11, 1, '2017-11-02', 49, 500, 350),
(12, 1, '2017-11-02', 40, 500, 555),
(13, 1, '2017-11-02', 69, 200, 730),
(14, 1, '2017-11-02', 34, 20, 115),
(15, 1, '2017-11-02', 35, 30, 14),
(16, 1, '2017-11-02', 37, 30, 196),
(17, 1, '2017-11-02', 17, 10, 8),
(18, 1, '2017-11-02', 20, 40, 10),
(19, 1, '2017-11-02', 22, 100, 10),
(20, 1, '2017-11-02', 25, 100, 100),
(21, 1, '2017-11-02', 47, 100, 150),
(22, 1, '2017-11-02', 49, 100, 70),
(23, 1, '2017-11-02', 60, 100, 300),
(24, 1, '2017-11-03', 40, 200, 222),
(25, 1, '2017-11-03', 71, 100, 491),
(26, 1, '2017-11-03', 18, 100, 32),
(27, 1, '2017-11-03', 19, 100, 20),
(28, 1, '2017-11-03', 21, 205, 62),
(29, 1, '2017-11-03', 25, 200, 200),
(30, 1, '2017-11-03', 1, 240, 106),
(31, 1, '2017-11-03', 7, 500, 250),
(32, 1, '2017-11-03', 45, 200, 880),
(33, 1, '2017-11-03', 50, 100, 36),
(34, 1, '2017-11-03', 55, 100, 200),
(35, 1, '2017-11-07', 41, 100, 365),
(36, 1, '2017-11-07', 43, 500, 550),
(37, 1, '2017-11-07', 23, 500, 50),
(38, 1, '2017-11-07', 64, 400, 1160),
(39, 2, '2017-11-18', 40, 2000, 2220),
(40, 2, '2017-11-18', 74, 2000, 4500),
(41, 2, '2017-11-18', 42, 2000, 7140),
(42, 2, '2017-11-18', 48, 2000, 3600),
(43, 1, '2017-11-18', 42, 100, 357),
(44, 2, '2017-11-19', 38, 200, 678),
(45, 1, '2017-11-23', 41, 100, 365);

--
-- Triggers `food_log`
--
DELIMITER $$
CREATE TRIGGER `timestamp_food` BEFORE INSERT ON `food_log` FOR EACH ROW SET NEW.log_date = CURRENT_DATE()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `strength_exercise_log`
--

CREATE TABLE `strength_exercise_log` (
  `log_entry_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `exercise_id` int(11) DEFAULT NULL,
  `weights` int(11) DEFAULT NULL,
  `sets` int(11) DEFAULT NULL,
  `reps` int(11) DEFAULT NULL,
  `calories_burnt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strength_exercise_log`
--

INSERT INTO `strength_exercise_log` (`log_entry_id`, `user_id`, `log_date`, `exercise_id`, `weights`, `sets`, `reps`, `calories_burnt`) VALUES
(1, 1, '2017-11-02', 41, 15, 3, 15, 24),
(2, 1, '2017-11-02', 48, 12, 3, 12, 21),
(3, 1, '2017-11-02', 49, 18, 3, 12, 18),
(4, 1, '2017-11-03', 13, 50, 12, 12, 84),
(5, 1, '2017-11-03', 11, 14, 3, 12, 21),
(6, 1, '2017-11-03', 56, 10, 3, 12, 21),
(7, 1, '2017-11-04', 57, 8, 3, 8, 15),
(8, 1, '2017-11-04', 62, 10, 3, 10, 15),
(9, 1, '2017-11-05', 35, 14, 3, 15, 24),
(10, 1, '2017-11-05', 33, 45, 3, 15, 15),
(11, 1, '2017-11-05', 37, 50, 3, 15, 21),
(12, 1, '2017-11-06', 21, 6, 3, 15, 18),
(13, 1, '2017-11-06', 23, 8, 3, 12, 18),
(14, 1, '2017-11-06', 24, 8, 3, 8, 18),
(15, 1, '2017-11-07', 75, 6, 3, 15, 12),
(16, 1, '2017-11-07', 69, 6, 3, 12, 15),
(17, 1, '2017-11-07', 68, 5, 3, 12, 15),
(18, 1, '2017-11-08', 1, 0, 3, 30, 9),
(19, 1, '2017-11-08', 5, 5, 3, 0, 12),
(20, 1, '2017-11-08', 7, 10, 3, 30, 15),
(21, 2, '2017-11-18', 15, 1212, 112, 10, 784),
(22, 2, '2017-11-18', 38, 1212, 12, 10, 84),
(23, 2, '2017-11-18', 69, 1212, 112, 10, 560),
(24, 2, '2017-11-18', 41, 8, 3, 8, 24),
(25, 3, '2017-11-18', 11, 8, 12, 10, 84),
(26, 2, '2017-11-19', 41, 5, 5, 5, 40),
(27, 1, '2017-11-23', 44, 20, 3, 12, 21);

--
-- Triggers `strength_exercise_log`
--
DELIMITER $$
CREATE TRIGGER `timestamp_exercise_strength` BEFORE INSERT ON `strength_exercise_log` FOR EACH ROW SET NEW.log_date = CURRENT_DATE()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`, `first_name`, `last_name`, `email`, `age`) VALUES
(1, 'sandman', '1234', 'Sandman', ' ', 'sandman@xyz.com', 20),
(2, 'foxtrot', '5678', 'Foxtrot', 'Zulu', 'foxtrot@abc.com', 30),
(3, 'kkbkj', '123', 'poncfwe', 'wefwe', 'bkjb', 77),
(4, 'shathin', '85564', 'Shathin', 'Rao', 'shathin.rao@gmail.com', 20);

-- --------------------------------------------------------

--
-- Table structure for table `weight_log`
--

CREATE TABLE `weight_log` (
  `log_entry_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `log_date` date DEFAULT NULL,
  `weight_kg` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weight_log`
--

INSERT INTO `weight_log` (`log_entry_id`, `user_id`, `log_date`, `weight_kg`) VALUES
(1, 1, '2017-10-01', 100),
(2, 2, '2017-10-01', 120),
(3, 1, '2017-10-03', 99),
(4, 2, '2017-10-03', 120),
(5, 1, '2017-10-05', 98),
(6, 2, '2017-10-05', 118),
(7, 1, '2017-10-07', 99),
(8, 2, '2017-10-07', 119),
(9, 1, '2017-10-09', 99),
(10, 2, '2017-10-09', 118),
(11, 1, '2017-10-11', 97),
(12, 2, '2017-10-11', 118),
(13, 1, '2017-10-13', 98),
(14, 2, '2017-10-13', 117),
(15, 1, '2017-10-15', 97),
(16, 2, '2017-10-15', 118),
(17, 1, '2017-10-17', 96),
(18, 2, '2017-10-17', 119),
(19, 1, '2017-10-19', 97),
(20, 2, '2017-10-19', 118),
(21, 1, '2017-10-21', 96),
(22, 2, '2017-10-21', 117),
(23, 1, '2017-10-23', 96),
(24, 2, '2017-10-23', 116),
(25, 1, '2017-10-25', 96),
(26, 2, '2017-10-25', 118),
(27, 1, '2017-10-27', 97),
(28, 2, '2017-10-27', 117),
(29, 1, '2017-10-29', 96),
(30, 2, '2017-10-29', 118),
(31, 1, '2017-11-18', 96),
(32, 2, '2017-11-18', 1212),
(33, 2, '2017-11-18', 1212),
(34, 2, '2017-11-18', 1212),
(35, 2, '2017-11-18', 6),
(36, 2, '2017-11-18', 8),
(37, 4, '2017-11-18', 50),
(38, 5, '2017-11-18', 50),
(41, 2, '2017-11-19', 50);

--
-- Triggers `weight_log`
--
DELIMITER $$
CREATE TRIGGER `timestamp_weight` BEFORE INSERT ON `weight_log` FOR EACH ROW SET NEW.log_date = CURRENT_DATE()
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calories_burnt_graph`
--
ALTER TABLE `calories_burnt_graph`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `calories_gained_graph`
--
ALTER TABLE `calories_gained_graph`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cardio_exercise_log`
--
ALTER TABLE `cardio_exercise_log`
  ADD PRIMARY KEY (`log_entry_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indexes for table `exercise_category_db`
--
ALTER TABLE `exercise_category_db`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `exercise_db`
--
ALTER TABLE `exercise_db`
  ADD PRIMARY KEY (`exercise_id`),
  ADD UNIQUE KEY `exercise_name` (`exercise_name`),
  ADD KEY `exercise_category_id` (`exercise_category_id`);

--
-- Indexes for table `fat_log`
--
ALTER TABLE `fat_log`
  ADD PRIMARY KEY (`log_entry_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `food_category_db`
--
ALTER TABLE `food_category_db`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `food_db`
--
ALTER TABLE `food_db`
  ADD PRIMARY KEY (`food_id`),
  ADD UNIQUE KEY `food_name` (`food_name`),
  ADD KEY `food_category_id` (`food_category_id`);

--
-- Indexes for table `food_log`
--
ALTER TABLE `food_log`
  ADD PRIMARY KEY (`log_entry_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `strength_exercise_log`
--
ALTER TABLE `strength_exercise_log`
  ADD PRIMARY KEY (`log_entry_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `exercise_id` (`exercise_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `weight_log`
--
ALTER TABLE `weight_log`
  ADD PRIMARY KEY (`log_entry_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calories_burnt_graph`
--
ALTER TABLE `calories_burnt_graph`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `calories_gained_graph`
--
ALTER TABLE `calories_gained_graph`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cardio_exercise_log`
--
ALTER TABLE `cardio_exercise_log`
  MODIFY `log_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `exercise_category_db`
--
ALTER TABLE `exercise_category_db`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `exercise_db`
--
ALTER TABLE `exercise_db`
  MODIFY `exercise_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `fat_log`
--
ALTER TABLE `fat_log`
  MODIFY `log_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `food_category_db`
--
ALTER TABLE `food_category_db`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `food_db`
--
ALTER TABLE `food_db`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `food_log`
--
ALTER TABLE `food_log`
  MODIFY `log_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `strength_exercise_log`
--
ALTER TABLE `strength_exercise_log`
  MODIFY `log_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `weight_log`
--
ALTER TABLE `weight_log`
  MODIFY `log_entry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calories_burnt_graph`
--
ALTER TABLE `calories_burnt_graph`
  ADD CONSTRAINT `calories_burnt_graph_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `calories_gained_graph`
--
ALTER TABLE `calories_gained_graph`
  ADD CONSTRAINT `calories_gained_graph_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `cardio_exercise_log`
--
ALTER TABLE `cardio_exercise_log`
  ADD CONSTRAINT `cardio_exercise_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cardio_exercise_log_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercise_db` (`exercise_id`);

--
-- Constraints for table `exercise_db`
--
ALTER TABLE `exercise_db`
  ADD CONSTRAINT `exercise_db_ibfk_1` FOREIGN KEY (`exercise_category_id`) REFERENCES `exercise_category_db` (`category_id`);

--
-- Constraints for table `fat_log`
--
ALTER TABLE `fat_log`
  ADD CONSTRAINT `fat_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `food_db`
--
ALTER TABLE `food_db`
  ADD CONSTRAINT `food_db_ibfk_1` FOREIGN KEY (`food_category_id`) REFERENCES `food_category_db` (`category_id`);

--
-- Constraints for table `food_log`
--
ALTER TABLE `food_log`
  ADD CONSTRAINT `food_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `food_log_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food_db` (`food_id`);

--
-- Constraints for table `strength_exercise_log`
--
ALTER TABLE `strength_exercise_log`
  ADD CONSTRAINT `strength_exercise_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `strength_exercise_log_ibfk_2` FOREIGN KEY (`exercise_id`) REFERENCES `exercise_db` (`exercise_id`);

--
-- Constraints for table `weight_log`
--
ALTER TABLE `weight_log`
  ADD CONSTRAINT `weight_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
