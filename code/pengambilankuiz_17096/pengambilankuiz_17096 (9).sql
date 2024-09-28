-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 10:17 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengambilankuiz_17096`
--

-- --------------------------------------------------------

--
-- Table structure for table `gred`
--

CREATE TABLE `gred` (
  `IDGred` varchar(10) NOT NULL,
  `Kenyataan` varchar(10) NOT NULL,
  `MinMarkah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gred`
--

INSERT INTO `gred` (`IDGred`, `Kenyataan`, `MinMarkah`) VALUES
('A', 'Cemerlang', 80),
('B', 'Baik', 70),
('C', 'Memuaskan', 50),
('F', 'Gagal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kuiz`
--

CREATE TABLE `kuiz` (
  `IDKuiz` varchar(10) NOT NULL,
  `IDPengguna` varchar(10) NOT NULL,
  `IDTopik` varchar(3) NOT NULL,
  `TarikhKemaskini` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kuiz`
--

INSERT INTO `kuiz` (`IDKuiz`, `IDPengguna`, `IDTopik`, `TarikhKemaskini`) VALUES
('A01', '00029', 'T01', '2021-08-18'),
('A02', '00029', 'T01', '2021-08-24'),
('B01', '00029', 'T02', '2021-09-14');

-- --------------------------------------------------------

--
-- Table structure for table `pengambilankuiz`
--

CREATE TABLE `pengambilankuiz` (
  `IDPengambilan` int(11) NOT NULL,
  `IDPengguna` varchar(10) NOT NULL,
  `IDKuiz` varchar(10) NOT NULL,
  `IDGred` varchar(10) NOT NULL,
  `TarikhPengambilan` date NOT NULL,
  `Masa` time NOT NULL,
  `JumlahMarkah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengambilankuiz`
--

INSERT INTO `pengambilankuiz` (`IDPengambilan`, `IDPengguna`, `IDKuiz`, `IDGred`, `TarikhPengambilan`, `Masa`, `JumlahMarkah`) VALUES
(1, '17001', 'A01', 'F', '2021-08-19', '15:00:00', 25),
(2, '17003', 'A01', 'C', '2021-08-22', '11:00:00', 50),
(3, '17001', 'A01', 'A', '2021-08-23', '17:30:00', 100),
(4, '17001', 'A02', 'B', '2021-08-25', '15:35:00', 75),
(5, '17001', 'A02', 'A', '2021-08-27', '17:35:00', 100),
(6, '17001', 'B01', 'C', '2021-09-15', '16:00:00', 50),
(7, '17004', 'B01', 'C', '2021-09-28', '12:00:00', 50);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `IDPengguna` varchar(10) NOT NULL,
  `NamaPengguna` varchar(30) NOT NULL,
  `JenisPengguna` varchar(10) NOT NULL,
  `KataLaluan` varchar(15) NOT NULL,
  `Kelas` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`IDPengguna`, `NamaPengguna`, `JenisPengguna`, `KataLaluan`, `Kelas`) VALUES
('00029', 'Tan Li Hua', 'Guru', '041209', ''),
('17001', 'Su Hui San', 'Murid', '5525', 'S5A'),
('17003', 'Chloe Ho', 'Murid', '3668', 'S5A'),
('17004', 'Lee Hui', 'Murid', 'jinglebells', 'S5B');

-- --------------------------------------------------------

--
-- Table structure for table `pilihan`
--

CREATE TABLE `pilihan` (
  `IDPilihan` int(11) NOT NULL,
  `IDSoalan` int(11) NOT NULL,
  `ButiranPilihan` varchar(50) NOT NULL,
  `Markah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pilihan`
--

INSERT INTO `pilihan` (`IDPilihan`, `IDSoalan`, `ButiranPilihan`, `Markah`) VALUES
(1, 1, 'memasak', 1),
(2, 1, 'masakan', 0),
(3, 1, 'bermasak', 0),
(4, 1, 'kemasak', 0),
(5, 2, 'melari', 0),
(6, 2, 'larian', 0),
(7, 2, 'berlari', 1),
(8, 2, 'kelarian', 0),
(9, 3, 'bergoreng ', 0),
(10, 3, 'korengkan', 0),
(11, 3, 'mengoreng', 1),
(12, 3, 'gorengan', 0),
(13, 4, 'tidur', 1),
(14, 4, 'menidur', 0),
(15, 4, 'tiduran', 0),
(16, 4, 'ketidur', 0),
(17, 5, 'membeli', 1),
(18, 5, 'beli', 0),
(19, 5, 'berbeli', 0),
(20, 5, 'mengeli', 0),
(21, 6, 'berbaca', 0),
(22, 6, 'membaca', 1),
(23, 6, 'bacaan', 0),
(24, 6, 'kebacaan', 0),
(25, 7, 'mancing', 0),
(26, 7, 'bermancing', 0),
(27, 7, 'memancing', 1),
(28, 7, 'kemancing', 0),
(29, 8, 'berpandu', 0),
(30, 8, 'memandu', 1),
(31, 8, 'panduan', 0),
(32, 8, 'kepandu', 0),
(33, 9, 'sebilah', 0),
(34, 9, 'sekuntum', 0),
(35, 9, 'seekor', 1),
(36, 9, 'senaskah', 0),
(37, 10, 'sebilah', 0),
(38, 10, 'senaskah', 1),
(39, 10, 'sekuntum', 0),
(40, 10, 'seekor', 0),
(41, 11, 'sebilah', 0),
(42, 11, 'seekor', 0),
(43, 11, 'sekuntum', 1),
(44, 11, 'senaskah', 0),
(45, 12, 'seekor', 0),
(46, 12, 'senaskah', 0),
(47, 12, 'sekuntum', 0),
(48, 12, 'sebilah', 1);

-- --------------------------------------------------------

--
-- Table structure for table `soalan`
--

CREATE TABLE `soalan` (
  `IDSoalan` int(11) NOT NULL,
  `IDKuiz` varchar(10) NOT NULL,
  `ButiranSoalan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soalan`
--

INSERT INTO `soalan` (`IDSoalan`, `IDKuiz`, `ButiranSoalan`) VALUES
(1, 'A01', 'Emak Ali sedang __ di dapur.'),
(2, 'A01', 'Ronda __ di atas padang.'),
(3, 'A01', 'Ben sedang __ telur.'),
(4, 'A01', 'Dia __ kerana letih.'),
(5, 'A02', 'Ah Meng __ barang.'),
(6, 'A02', 'Jennie sedang __ buku.'),
(7, 'A02', 'Abu sedang __ ikan.'),
(8, 'A02', 'Bapa sedang __ kereta.'),
(9, 'B01', 'Josh memelihara __ kucing.'),
(10, 'B01', 'Dia sedang membaca __ surat khabar.'),
(11, 'B01', 'Bapa menghadiah ibu __ bunga.'),
(12, 'B01', 'Benie membeli __ pisau.');

-- --------------------------------------------------------

--
-- Table structure for table `topik`
--

CREATE TABLE `topik` (
  `IDTopik` varchar(3) NOT NULL,
  `ButiranTopik` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topik`
--

INSERT INTO `topik` (`IDTopik`, `ButiranTopik`) VALUES
('T01', 'Imbuhan'),
('T02', 'Penjodoh Bilangan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gred`
--
ALTER TABLE `gred`
  ADD PRIMARY KEY (`IDGred`);

--
-- Indexes for table `kuiz`
--
ALTER TABLE `kuiz`
  ADD PRIMARY KEY (`IDKuiz`),
  ADD KEY `IDPengguna` (`IDPengguna`),
  ADD KEY `IDTopik` (`IDTopik`);

--
-- Indexes for table `pengambilankuiz`
--
ALTER TABLE `pengambilankuiz`
  ADD PRIMARY KEY (`IDPengambilan`),
  ADD KEY `IDPengguna` (`IDPengguna`),
  ADD KEY `IDKuiz` (`IDKuiz`),
  ADD KEY `IDGred` (`IDGred`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`IDPengguna`);

--
-- Indexes for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD PRIMARY KEY (`IDPilihan`),
  ADD KEY `IDSoalan` (`IDSoalan`);

--
-- Indexes for table `soalan`
--
ALTER TABLE `soalan`
  ADD PRIMARY KEY (`IDSoalan`),
  ADD KEY `IDKuiz` (`IDKuiz`);

--
-- Indexes for table `topik`
--
ALTER TABLE `topik`
  ADD PRIMARY KEY (`IDTopik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengambilankuiz`
--
ALTER TABLE `pengambilankuiz`
  MODIFY `IDPengambilan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pilihan`
--
ALTER TABLE `pilihan`
  MODIFY `IDPilihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `soalan`
--
ALTER TABLE `soalan`
  MODIFY `IDSoalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kuiz`
--
ALTER TABLE `kuiz`
  ADD CONSTRAINT `kuiz_ibfk_4` FOREIGN KEY (`IDPengguna`) REFERENCES `pengguna` (`IDPengguna`),
  ADD CONSTRAINT `kuiz_ibfk_5` FOREIGN KEY (`IDTopik`) REFERENCES `topik` (`IDTopik`);

--
-- Constraints for table `pengambilankuiz`
--
ALTER TABLE `pengambilankuiz`
  ADD CONSTRAINT `pengambilankuiz_ibfk_4` FOREIGN KEY (`IDGred`) REFERENCES `gred` (`IDGred`),
  ADD CONSTRAINT `pengambilankuiz_ibfk_5` FOREIGN KEY (`IDKuiz`) REFERENCES `kuiz` (`IDKuiz`),
  ADD CONSTRAINT `pengambilankuiz_ibfk_6` FOREIGN KEY (`IDPengguna`) REFERENCES `pengguna` (`IDPengguna`);

--
-- Constraints for table `pilihan`
--
ALTER TABLE `pilihan`
  ADD CONSTRAINT `pilihan_ibfk_1` FOREIGN KEY (`IDSoalan`) REFERENCES `soalan` (`IDSoalan`);

--
-- Constraints for table `soalan`
--
ALTER TABLE `soalan`
  ADD CONSTRAINT `soalan_ibfk_1` FOREIGN KEY (`IDKuiz`) REFERENCES `kuiz` (`IDKuiz`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
