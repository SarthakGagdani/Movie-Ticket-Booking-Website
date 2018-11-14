-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2018 at 11:21 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `searchmovie` (IN `movie` VARCHAR(1000))  NO SQL
SELECT * from movies where Movie_Name like CONCAT('%', movie, '%')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('akash', '1234'),
('sarthak', '123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `username` varchar(200) NOT NULL,
  `movie` varchar(200) NOT NULL,
  `theatre` varchar(200) NOT NULL,
  `seats` varchar(2000) NOT NULL,
  `date` varchar(100) NOT NULL,
  `movie_time` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `amount` int(200) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`username`, `movie`, `theatre`, `seats`, `date`, `movie_time`, `location`, `amount`, `id`) VALUES
('sarthak', 'Gold', 'Citypride', 'A3 A4', '15-10-2018', '13:00', 'kothrud', 400, 10),
('sarthak', 'Gold', 'Citypride', 'B3 B4', '15-10-2018', '13:00', 'kothrud', 400, 13),
('sarthak', 'Gold', 'Citypride', 'A5 B5', '15-10-2018', '13:00', 'kothrud', 400, 15),
('sarthak', 'Gold', 'Citypride', 'E2 J2', '15-10-2018', '13:00', 'kothrud', 380, 16),
('sarthak', 'Gold', 'Citypride', 'A1 B1 C1 C2', '15-10-2018', '13:00', 'kothrud', 800, 17);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `Movie_Name` varchar(50) NOT NULL,
  `Actor` varchar(25) NOT NULL,
  `Actress` varchar(25) NOT NULL,
  `Release_date` varchar(50) NOT NULL,
  `Director` varchar(50) NOT NULL,
  `Movie_id` int(100) NOT NULL,
  `poster` varchar(300) NOT NULL,
  `RunTime` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `ActorImg` varchar(300) NOT NULL,
  `ActressImg` varchar(400) NOT NULL,
  `DirectorImg` varchar(300) NOT NULL,
  `Description` varchar(4000) DEFAULT NULL,
  `trailer` varchar(400) NOT NULL,
  `wiki` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`Movie_Name`, `Actor`, `Actress`, `Release_date`, `Director`, `Movie_id`, `poster`, `RunTime`, `type`, `ActorImg`, `ActressImg`, `DirectorImg`, `Description`, `trailer`, `wiki`) VALUES
('Dhadak', 'Ishan Khattar', 'Jhanvi Kapoor', '2018-07-20', 'Shashank Khaitan', 29, 'images.jpg', '2 hr 20 min', 'Drama', 'MV5BOThiYzM3YTktNDE5Ni00ODRhLWI3YTAtYTk4ZjM2NDIxYjU1L2ltYWdlXkEyXkFqcGdeQXVyMTExNDQ2MTI@._V1_QL50_.jpg', 'MV5BYzU0YzYwYWYtM2UxMy00NmQzLTllODItNjJmZGEzZjYxMWY3XkEyXkFqcGdeQXVyMTExNDQ2MTI@._V1_QL50_SY1000_CR0,0,870,1000_AL_.jpg', 'MV5BMjMxMjMyNTk3N15BMl5BanBnXkFtZTgwODI0MzA3MTI@._V1_QL50_SY1000_CR0,0,747,1000_AL_.jpg', 'Dhadak is a 2018 Indian Hindi-language tragic romance film written and directed by Shashank Khaitan. It was jointly produced by Karan Johar, Hiroo Yash Johar and Apoorva Mehta under the Dharma Productions banner with Zee Studios. A remake of the Marathi language film Sairat (2016), the film stars Ishaan Khatter and debutant Janhvi Kapoor, with Ashutosh Rana, Ankit Bisht, Shridhar Watsar, Kshitij Kumar and Aishwarya Narkar in supporting roles.  ', 'TIE92mUvSsw', 'https://en.wikipedia.org/wiki/Dhadak'),
('MI- Fallout (2018)', 'Tom Cruise', 'Rebecca Ferguson', '2018-08-10', 'Christopher', 30, 'mission-impossible-6-poster.jpg', '2 hr 20 min', 'Action', 'MV5BMTk1MjM3NTU5M15BMl5BanBnXkFtZTcwMTMyMjAyMg@@._V1_QL50_.jpg', 'MV5BNzA4NDA1MTA5NV5BMl5BanBnXkFtZTcwNjMyNTQ3OA@@._V1_QL50_.jpg', 'MV5BMzQyMzg1NjUxN15BMl5BanBnXkFtZTgwNDAyMjAwMDE@._V1_QL50_SY1000_CR0,0,753,1000_AL_.jpg', 'Ethan Hunt and his IMF team, along with some familiar allies, race against time after a mission gone wrong.    ', 'XnYG1WRDvw4', 'https://www.imdb.com/title/tt4912910/?ref_=nv_sr_1'),
('Stree', 'Rajkumar Rao', 'Shraddha Kapoor', '2018-08-31', 'Amar Kaushik', 35, 'stree-int.jpg', '2 hr 20 min', 'Comedy', 'raj.jpg', 'index.jpg', 'DSC_0012_400x400.JPG', 'Stree is a 2018 Indian Hindi-language comedy horror film. The film is directed by Amar Kaushik, written by Raj Nidimoru and Krishna D.K. and produced by Dinesh Vijan and Raj Nidimoru and Krishna D.K. under the banner of Maddock Films in association with D2RFilms. It is based on the Indian urban legend Nale Ba, about a spirit who knocks on people doors at night. Stree stars Rajkummar Rao and Shraddha Kapoor. Pankaj Tripathi, Aparshakti Khurrana, and Abhishek Banerjee appear in supporting roles.  ', 'gzeaGcLLl_A', 'https://en.wikipedia.org/wiki/Stree_(2018_film)'),
('Gold', 'Akshay Kumar', 'Mouni Roy', '2018-08-15', 'Reema Kagti', 39, 'thequint_2018-06_4e70ccdc-3886-4d57-80a8-90303417e05c_gold_poster.jpg', '2 hr 15 min', 'Drama', 'MV5BODI4NDY1NzkyM15BMl5BanBnXkFtZTgwNzM3MDM0OTE@._V1_QL50_SY1000_CR0,0,795,1000_AL_.jpg', 'MV5BMjcwZGMxNTYtOGI2OS00NjhhLTk3MjMtMWZjZDc0MjJjY2FjXkEyXkFqcGdeQXVyMTExNDQ2MTI@._V1_QL50_.jpg', 'indexreema.jpg', 'Gold: The Dream That United Our Nation is a 2018 Indian historical sports-drama film based upon the national hockey team title at the 1948 Summer Olympics, directed by Reema Kagti and produced by Ritesh Sidhwani and Farhan Akhtar under the Excel Entertainment banner.It stars Akshay Kumar, Mouni Roy, Kunal Kapoor, Vineet Kumar Singh, Amit Sadh, and Sunny Kaushal.\r\n\r\nThe movie became the first Bollywood film ever to release in Saudi Arabia.  ', 'gpWrT-LdMfs', 'https://en.wikipedia.org/wiki/Gold_(2018_film)'),
('Sui Dhaaga', 'Varun Dhawan', 'Anushka Sharma', '2018-10-05', 'Sharat Katariya 	', 46, '65383768.jpg', '2 hr 15 min', 'Drama', 'index1.jpg', 'anuska.jpg', 'dir.jpg', 'Sui Dhaaga is an upcoming Indian Hindi-language comedy-drama film directed by Sharat Katariya and produced by Maneesh Sharma under the banner of Yash Raj Films. It stars Varun Dhawan and Anushka Sharma in lead roles. Principal photography began in the town of Chanderi, Madhya Pradesh in February 2018 and the film is scheduled for release on 28 September 2018.   ', 'VUe3p23AJMo', 'https://en.wikipedia.org/wiki/Sui_Dhaaga'),
('Pataakha', 'Sunil Grover', 'Sanya Malhotra', '2018-09-28', 'Vishal Bhardwaj', 47, 'Pataakha_poster.jpg', '2 hr 20 min', 'Comedy', 'vg0tV1Ka.jpg', '5b44d4fa04e29.image.jpg', '494122_v9_ba.jpg', 'Pataakha is an upcoming Indian Hindi comedy-drama film directed by Vishal Bhardwaj about two sisters who share a difficult relationship with each other.      ', '9Gq2454aNQo', 'https://en.wikipedia.org/wiki/Pataakha'),
('Thugs of Hindostan', 'Amir khan', 'Katrina', '2018-11-08', 'Vijay Acharya', 48, 'thugss.jpg', '2 hr 35 min', 'thriller', 'amir.jpg', 'katrina.jpeg', 'vijaydir.jpg', 'Thugs of Hindostan is an upcoming 2018 Indian Hindi-language epic action-adventure film written and directed by Vijay Krishna Acharya. It is produced by Aditya Chopra under his banner Yash Raj Films. The film features Amitabh Bachchan, Aamir Khan, Katrina Kaif, Fatima Sana Shaikh and Lloyd Owen in lead roles. It follows a band of thugs led by Azaad (Bachchan), which functions during company rule in India and aspires to free the country from the British. Alarmed, John Clive (Owen), a British commander, sends Firangi Mallah (Khan), a small-time thug from Awadh, to counter the threat.[5] The soundtrack was composed by Ajay-Atul with lyrics written by Amitabh Bhattacharya.     ', 'zI-Pux4uaqM', 'https://en.wikipedia.org/wiki/Thugs_of_Hindostan'),
('Badhaai Ho', 'Ayushmann Khurrana', 'Sanya Malhotra', '2018-10-19', 'Amit Sharma', 49, 'badhaai.jpg', '2 hr 20 min', 'Comedy', '2018_9$largeimg27_Thursday_2018_124115725.jpg', '5b44d4fa04e29.image.jpg', 'amit-sharma_20160429202710.jpg', 'Badhaai Ho is an upcoming Indian comedy drama film directed by Amit Ravindernath Sharma. The film stars Ayushmann Khurrana and Sanya Malhotra in the lead roles. Badhaai Ho is tipped to be a coming-of-age story with a tinge of romance.The Film is produced by Vineet Jain, Hemant Bhandari and Aleya Sen under the banner of Junglee Pictures and Chrome Pictures. It is written by Shantanu Srivastava.  ', 'unAljCZMQYw', 'https://en.wikipedia.org/wiki/Badhaai_Ho'),
('Venom', 'Tom Hardy', 'Michelle Williams', '2018-10-05', 'Ruben Fleischer', 50, 'p13937884_p_v8_ab.jpg', '2 hr 10 min', 'Horror/Thriller', 'MV5BMTQ3ODEyNjA4Nl5BMl5BanBnXkFtZTgwMTE4ODMyMjE@._V1_QL50_SY1000_CR0,0,666,1000_AL_.jpg', 'MV5BMjExNjY5NDY0MV5BMl5BanBnXkFtZTgwNjQ1Mjg1MTI@._V1_QL50_SY1000_CR0,0,665,1000_AL_.jpg', 'MV5BMTc0NDU5MDc1NF5BMl5BanBnXkFtZTcwMDY0MTM5OA@@._V1_QL50_SY1000_CR0,0,664,1000_AL_.jpg', 'Venom is a 2018 American superhero film based on the Marvel Comics character of the same name, produced by Columbia Pictures in association with Marvel. Distributed by Sony Pictures Releasing, it is the first film in Sony Marvel Universe, adjunct to the Marvel Cinematic Universe .The film is directed by Ruben Fleischer from a screenplay by Scott Rosenberg, Jeff Pinkner, and Kelly Marcel, and stars Tom Hardy as Eddie Brock  Venom, alongside Michelle Williams, Riz Ahmed, Scott Haze, and Reid Scott. In Venom, journalist Brock gains superpowers after being bound to an alien symbiote whose species plans to invade Earth.  ', 'xLCn88bfW1o', 'https://en.wikipedia.org/wiki/Venom_(2018_film)'),
('Boyz 2', 'Parth Bhalerao', 'Kishori Ambiye', '2018-10-05', 'Vishal Devrukhkar', 51, 'boys_.jpg', '2 hr 35 min', 'Comedy', '85rVmHau_400x400.jpg', 'Interview_of_Kishori_Ambiye_755x460542404801e835.jpg', 'A366763_list_20180430141002.jpg', 'Naru Bondwe son of college trustee Madan Bondwe keeps of doing re admission in college and has rivalry with Juniors.Dhariya,Dhungya and Kabir are known to fight for rights of Juniors.But Kabir has now staying away from hostel as he doesnt want more trouble with seniors due to his 12th standard board exams.A grade committee is about to visit the college in the year and the principal gives a teacher Vikram Sabnis to put an end to Junior and Senior rivalry.Chitra a beautiful girls enters the college and Kabir attract towards he rand shifts back to hostel.The rivalry of Juniors and Seniors takes to a worst turn that before the grade committees visit.Naru and Kabir selected members from both teams should loose their virginity towards a girl.And as a proof record the video failing which the looser has to leave the college. ', 'g68ggJgg_HA', 'https://www.imdb.com/title/tt8873348/'),
('U.R.I', 'Vicky Kaushal', 'Yami Gautam', '2019-01-11', 'Aditya Dhar', 52, 'MV5BZDUxZWRiNDAtM2M4Yi00OTY4LTgyNmMtNTIzOGMwNTFiYjg0XkEyXkFqcGdeQXVyNjE1OTQ0NjA@._V1_QL50_SY1000_CR0,0,628,1000_AL_.jpg', '2 hr 20 min', 'Thriller', 'MV5BMjIxMjMzNjQ0OF5BMl5BanBnXkFtZTgwODc4ODEzOTE@._V1_QL50_SY1000_CR0,0,1502,1000_AL_.jpg', 'MV5BYzQyY2M1NDctNGE5OS00ZjI2LThkNmItYzhhYjQ4OWJiMjBiXkEyXkFqcGdeQXVyNDUzOTQ5MjY@._V1_QL50_SY1000_CR0,0,514,1000_AL_.jpg', '50s6whkvyi90kk2jzbwn.jpeg', 'It is a story based on surgical strike carried out by Indian Special Forces in 2016.   ', 'aXYPUqFL9ZU', 'https://www.imdb.com/title/tt8291224/'),
('Andhadhun', 'Ayushmann Khurrana', 'Radhika Apte', '2018-10-05', 'Sriram Raghavan', 53, 'MV5BMmFmN2NlNGUtNDVjNy00NDA0LTk5MTQtOTEwN2NlZjM0NDFhXkEyXkFqcGdeQXVyNDAzNDk0MTQ@._V1_QL50_SX692_CR0,0,692,999_AL_.jpg', '2 hr 18 min', 'Horror/Thriller', '2018_9$largeimg27_Thursday_2018_124115725.jpg', 'MV5BMTU3MzcyMzQ2NF5BMl5BanBnXkFtZTgwNjI4MjA3ODE@._V1_QL50_SY1000_CR0,0,666,1000_AL_.jpg', 'sriram.jpg', 'Andhadhun is a 2018 Indian Hindi-language black comedy thriller film directed by Sriram Raghavan. It stars Tabu, Ayushmann Khurrana, and Radhika Apte and tells the story of a piano player who unwittingly becomes embroiled in the murder of a former film actor.It is inspired by the 2010 French short film LAccordeur (The Piano Tuner). The film was released theatrically on 5 October 2018, and received critical acclaim.   ', '2iVYI99VGaw', 'https://en.wikipedia.org/wiki/Andhadhun');

-- --------------------------------------------------------

--
-- Table structure for table `theatres`
--

CREATE TABLE `theatres` (
  `Theatre_id` int(200) NOT NULL,
  `Theatre_Name` varchar(200) NOT NULL,
  `Location` varchar(300) NOT NULL,
  `Movie_Name` varchar(200) NOT NULL,
  `time1` varchar(200) NOT NULL,
  `time2` varchar(200) NOT NULL,
  `time3` varchar(200) NOT NULL,
  `time4` varchar(200) NOT NULL,
  `time5` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `theatres`
--

INSERT INTO `theatres` (`Theatre_id`, `Theatre_Name`, `Location`, `Movie_Name`, `time1`, `time2`, `time3`, `time4`, `time5`) VALUES
(3, 'INOX', 'Bund Garden', 'Sui Dhaaga', '22:00', '', '', '', ''),
(4, 'Citypride', 'Kothrud', 'Boyz 2', '13:00', '10:00', '', '', ''),
(5, 'E-Square', 'Shivajinagar', 'Venom', '22:00', '', '', '', ''),
(6, 'E-Square', 'Shivajinagar', 'Sui Dhaaga', '17:00', '20:00', '', '', ''),
(7, 'INOX', 'Bund Garden', 'Andhadhun', '20:00', '17:00', '', '', ''),
(8, 'INOX', 'Bund Garden', 'Pataakha', '13:00', '', '', '', ''),
(10, 'E-Square', 'Shivajinagar', 'Venom', '13:00', '10:00', '', '', ''),
(11, 'Citypride', 'Kothrud', 'Andhadhun', '17:00', '23:00', '', '', ''),
(12, 'Citypride', 'Kothrud', 'Sui Dhaaga', '20:00', '', '', '', ''),
(13, 'INOX', 'Kothrud', 'Andhadhun', '23:00', '', '', '', ''),
(14, 'E-Square', 'Kothrud', 'Andhadhun', '16:00', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `timings`
--

CREATE TABLE `timings` (
  `id` int(200) NOT NULL,
  `showtime` varchar(200) NOT NULL,
  `Theatre_Name` varchar(200) NOT NULL,
  `ticket_rate_Gold` int(50) NOT NULL,
  `ticket_rate_Silver` int(50) NOT NULL,
  `seats` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timings`
--

INSERT INTO `timings` (`id`, `showtime`, `Theatre_Name`, `ticket_rate_Gold`, `ticket_rate_Silver`, `seats`) VALUES
(5, '13:00', 'Citypride', 200, 180, 106),
(6, '10:00', 'Citypride', 150, 120, 120),
(7, '09:00', 'E-Square', 150, 100, 120),
(8, '13:00', 'E-Square', 200, 180, 120),
(9, '17:00', 'E-Square', 200, 150, 120),
(10, '20:00', 'E-Square', 250, 200, 120),
(11, '10:00', 'INOX', 150, 100, 120),
(12, '22:00', 'INOX', 250, 220, 120),
(13, '22:00', 'E-Square', 200, 180, 120),
(14, '13:00', 'INOX', 200, 180, 120),
(15, '17:00', 'INOX', 250, 220, 120),
(16, '20:00', 'INOX', 300, 280, 120),
(17, '20:00', 'Citypride', 250, 220, 120),
(18, '17:00', 'Citypride', 250, 200, 120),
(19, '23:00', 'Citypride', 250, 210, 120),
(20, '23:00', 'INOX', 250, 220, 120),
(21, '16:00', 'E-Square', 250, 180, 120);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`) VALUES
('abhijeet', 'abhijeet', '$2y$10$PO7NHZKsZE1f69lMLGtLxuhgCy0.929yS8Mmc6MpKUuD0zbEXIzDi'),
('akash', 'akash.butala.365@gmail.com', '$2y$10$ELA0gnMFhepMFRewePULO.pe7tzbt6mWZYOumFz9wDLATZaby7IVK'),
('sarthak', 'sarthak.gag@gmail.com', '$2y$10$8l01/lflzUO5QRCICy58G.3OmLopyNg7EC/cqXm1IMjIhiIx3LraK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`Movie_id`);

--
-- Indexes for table `theatres`
--
ALTER TABLE `theatres`
  ADD PRIMARY KEY (`Theatre_id`);

--
-- Indexes for table `timings`
--
ALTER TABLE `timings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `Movie_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `theatres`
--
ALTER TABLE `theatres`
  MODIFY `Theatre_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `timings`
--
ALTER TABLE `timings`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_seat` ON SCHEDULE EVERY 24 HOUR STARTS '2018-10-13 00:00:00' ENDS '2018-11-30 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO Update timings set seats=120 where seats<120$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
