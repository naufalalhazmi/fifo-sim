-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 04:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fifo-sim`
--

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `id_obat` varchar(25) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `jumlah_stock` int(50) NOT NULL,
  `harga` decimal(65,0) NOT NULL,
  `hargatot` decimal(65,0) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `id_obat`, `nama_obat`, `satuan`, `jumlah_stock`, `harga`, `hargatot`, `tanggal_masuk`, `tanggal_kadaluarsa`) VALUES
(28, '65242e28e4adf', 'Proris', '', 3, '0', '0', '2023-10-12', '2023-11-02'),
(39, '653a7a37db77c', 'Antimo', '', 15, '0', '0', '2023-10-26', '2024-01-26'),
(42, '6552619ec44ba', 'Sutra', 'Pack', 3, '15000', '0', '2023-11-14', '2024-01-17'),
(43, '655266bb6bcbf', 'Anlene', 'Bungkus', 13, '72000', '0', '2023-11-15', '2024-02-23'),
(44, '655f641595b1a', 'Amoxicilin', 'Papan', 5, '2500', '25000', '2023-11-23', '2024-03-15'),
(45, '656498ab21b53', 'Paracetamol', 'Papan', 20, '5000', '100000', '2023-08-22', '2023-12-06'),
(46, '6564adf9a8c14', 'Glibenclamide', 'Tablet', 15, '500', '7500', '2023-09-15', '2023-12-04'),
(47, '6564ae7429dec', 'Gentamicin Tetes Mata 3 mg/ml', 'Botol', 10, '30000', '300000', '2023-09-08', '2023-12-09'),
(48, '6564af7f2e6c1', 'Cetrizine', 'Tablet', 15, '5000', '75000', '2023-09-14', '2023-12-07'),
(49, '6564aff81e7ce', 'Domperidon 10 mg', 'Tablet', 20, '7000', '140000', '2023-09-14', '2023-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `id_obat` varchar(25) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `harga` decimal(65,0) NOT NULL,
  `hargatot` decimal(65,0) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_keluar` int(50) NOT NULL,
  `dokumen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `id_obat`, `nama_obat`, `satuan`, `tujuan`, `harga`, `hargatot`, `tanggal_keluar`, `jumlah_keluar`, `dokumen`) VALUES
(1, '651842b6dff9b', 'Kodein', '', 'Pekanbaru', '48000', '0', '2023-09-28', 7, 'Menu Login.png'),
(2, '6518013c25a64', 'Paramex', '', 'Surabaya', '175000', '0', '2023-09-15', 25, 'jurnal budidarma.png'),
(5, '65184f4f26fea', 'Sanmol', '', 'Kandis', '15000', '0', '2023-09-28', 3, 'Screenshot (1720).png'),
(6, '6517c58683c28', 'Sanmol', '', 'Rohul', '15000', '0', '2023-10-01', 5, 'Screenshot (1723).png'),
(7, '6517c58683c28', 'Sanmol', '', 'Tebing Tinggi', '15000', '0', '2023-10-27', 3, 'Screenshot (1725).png'),
(8, '6517c58683c28', 'Sanmol', '', 'Asahan', '15000', '0', '2023-10-02', 3, 'Screenshot (1724).png'),
(9, '6517c58683c28', 'Sanmol', '', 'Padang', '15000', '0', '2023-10-06', 5, 'Screenshot (1784).png'),
(10, '651921832df91', 'Ambroxol', '', 'Jambi', '20000', '0', '2023-10-07', 5, 'Screenshot (1830).png'),
(11, '6517c58683c28', 'Sanmol', '', 'Aceh', '15000', '0', '2023-10-06', 2, ''),
(12, '651921832df91', 'Ambroxol', '', 'Pasir', '2500', '0', '2023-10-06', 5, ''),
(13, '651921832df91', 'Ambroxol', '', 'Binjai', '2500', '0', '2023-10-06', 5, 'Screenshot (1953).png'),
(14, '65242bb8af5b2', 'Proris', '', 'Kandis', '10000', '0', '2023-10-12', 5, ''),
(15, '65242db4242e4', 'Proris', '', 'Tebing Tinggi', '10000', '0', '2023-10-12', 5, ''),
(21, '', 'Sutra', '', 'Kandis', '5000', '0', '2023-10-13', 2, 'Screenshot (1).png'),
(22, '', 'Sutra', '', 'Asahan', '9000', '0', '2023-10-15', 13, 'Opening.png'),
(23, '6524334cbaf00', 'Sutra', '', 'Pekanbaru', '9000', '0', '2023-10-12', 2, 'Screenshot (16).png'),
(24, '6524334cbaf00&652435388c4', 'Sutra', '', 'Jateng', '9000', '0', '2023-10-15', 8, 'Screenshot (42).png'),
(25, '6524361d644d8 & 652436266', 'Sutra', '', 'Jatim', '9000', '0', '2023-10-14', 12, 'Screenshot (18).png'),
(26, '652436266afb4&6524383d226', 'Sutra', '', 'Jogja', '9000', '0', '2023-10-14', 12, ''),
(27, '6552619ec44ba', 'Sutra', '', 'Pekanbaru', '18000', '0', '2023-11-18', 3, ''),
(28, '655266bb6bcbf', 'Anlene', '', 'Aceh', '80000', '0', '2023-11-17', 6, ''),
(29, '655266bb6bcbf', 'Anlene', '', 'Pekanbaru', '6000', '0', '2023-11-16', 2, ''),
(30, '655266bb6bcbf', 'Anlene', '', 'Tebing Tinggi', '4000', '0', '2023-11-17', 1, ''),
(31, '655266bb6bcbf', 'Anlene', '', 'Kandis', '4000', '0', '2023-11-18', 1, ''),
(32, '655266bb6bcbf', 'Anlene', 'Bungkus', 'Jemput di Graha', '4000', '0', '2023-11-19', 1, ''),
(33, '655f641595b1a', 'Amoxicilin', 'Papan', 'Kandis', '3000', '15000', '2023-11-25', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `jumlah_stock` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `nama_obat`, `satuan`, `jumlah_stock`) VALUES
(1, 'Acetylcysteine 200 mg', 'Tablet', 209),
(2, 'Aciclovir 400 mg', 'Tablet', 97),
(3, 'Antasida Suspensi', 'Botol', 22),
(4, 'Alcohol Swab 0,5%', 'Box', 4),
(5, 'Alkohol 70%  1L/Medika', 'Botol', 1),
(6, 'Alkohol 70%  1L/ Citomed', 'Botol', 1),
(7, 'Alkohol 96%  1L/ Citomed', 'Botol', 100),
(8, 'Alkohol 95%  1L/ Medika', 'Botol', 1),
(9, 'Allopurinol 100 mg', 'Tablet', 79),
(10, 'Allopurinol 300 mg', 'Tablet', 237),
(11, 'Aminofilin Inj 24mg/ml', 'Ampul', 162),
(12, 'Amitriptilin 25 mg ', 'Tablet', 22),
(13, 'Amlodipin 5 mg', 'Tablet', 17),
(14, 'Amlodipin 10 mg', 'Tablet', 650),
(15, 'Amoksisillin 500 mg', 'Tablet', 353),
(16, 'Amoksisilin sirup kering 125 mg/ 5 ml', 'Botol', 99),
(17, 'Antasida  tablet ', 'Tablet', 1355),
(18, 'Antiseptik Surgical Hand 500 ml /E-Care', 'Box ', 1),
(19, 'Aripiprazole 5 mg /Arinia', 'Tablet', 5),
(20, 'Aripiprazole 10 mg ', 'Tablet', 4),
(21, 'Asam Mefenamat 500 mg', 'Tablet', 235),
(22, 'Asam Valproat 250 mg / 5 ml Syrup', 'Botol', 2),
(23, 'Asam Folat', 'Tablet', 70),
(24, 'Atropin Injeksi 0,25 mg/ml', 'Ampul', 582),
(25, 'Benang Bedah Cat Gut-Plain 4-0 / Triton', 'Box', 24),
(26, 'Benang Bedah Silk 3/0 HR-27', 'Box', 199),
(27, 'Benang Bedah Silk Black 3/0  HR 30 MM ', 'Pcs', 1),
(28, 'Betametason krim 0,1%', 'Tube', 27),
(29, 'Bisacodyl 5 mg', 'Tablet', 372),
(30, 'Blood Lancet', 'Box', 20),
(32, 'Captopril 25 mg', 'Tablet', 21),
(33, 'Cetrizine', 'Tablet', 122),
(34, 'Ciprofloxacin 500mg', 'Tablet', 400),
(35, 'Clozapine 25 mg', 'Tablet', 264),
(36, 'Deksametason injeksi', 'Ampul', 623),
(37, 'Deksametason 0.5 mg', 'Tablet', 343),
(38, 'Diazepam 2 mg', 'Tablet', 91),
(40, 'Diazepam Enema 5 mg/ 2,5 ml', 'Tube', 629),
(41, 'Diazepam Enema 10 mg / 2,5 ml', 'Tube', 670),
(42, 'Diethylcarbamazine 100 mg', 'Tablet', 2),
(43, 'Dipenhydramine 10 mg Injeksi', 'Ampul', 7),
(44, 'Domperidon 10 mg', 'Tablet', 56),
(45, 'Dulcolax Pediatric 5 mg Supp', 'Supp', 786),
(46, 'Dulcolax Adult 10 mg Supp', 'Supp', 2),
(47, 'Epinefrine Injeksi 1 mg / ,l', 'Ampul', 2),
(48, 'Fitomenadion (Vit K) Tab', 'Tablet', 4),
(49, 'Fitomenadion/ Vit K Injeksi 2 mg / ml', 'Ampul', 530),
(50, 'Fixation tape 2,5 cm X 3,6 m / Lymfix', 'Roll', 813),
(51, 'Garam Oralit', 'Sach', 88),
(52, 'Gentamicin Tetes Mata 3 mg/ml', 'Botol', 299),
(53, 'Glibenclamide', 'Tablet', 104),
(54, 'Glimepiride 2 mg', 'Tablet', 373),
(55, 'Glucosa 5% 500 ml', 'Botol', 21),
(56, 'Haloperidol 5 mg', 'Tablet', 10),
(57, 'Haloperidol Inj 50 mg/ml', 'Ampul', 977),
(58, 'Hand Sanitizer 500 ml / Jasmine', 'Botol', 1),
(59, 'Herbakof Syrup 100 ml', 'Botol', 4),
(60, 'Hidroklortiazide 25mg', 'Tablet', 200),
(61, 'Hidrokortison 2,5 % cream', 'tube', 11),
(62, 'Infuset Anak / TP', 'Set', 2),
(63, 'Infusion Set Anak Otsuka-34', 'Pcs', 1),
(64, 'Infuset Dewasa / TP', 'Pcs', 5),
(65, 'Infusion Set Type Y Air Vent Luer Slip', 'Pcs', 4),
(66, 'Isosorbit Dinitrate', 'Tablet', 9),
(67, 'IV Catheter 22 G', 'Pcs', 4),
(68, 'IV Catheter 24 G', 'Pcs', 2),
(69, 'IV Chateter No 20 G /TP', 'pcs', 2),
(70, 'Kalsium Laktat 500 mg', 'Tablet', 9),
(71, 'Kapas lidi', 'Box', 187),
(72, 'Kapas lidi / Cotton Swab Onemed', 'Box', 1),
(73, 'Kapas 100 gr', 'bks', 5),
(74, 'Kapas Pembalut 100 gr', 'bks', 12),
(75, 'Kapas Pembalut 250 gr ', 'bks', 482),
(76, 'Kasa Verban  10 cm X 3,6m / Unicorn', 'Pcs', 1),
(77, 'Kasa Verban  5 cm X 3,6m / Unicorn', 'Pcs', 17),
(78, 'Kasa Pembalut 55,6 cm x 3,6 m', 'Roll', 7),
(79, 'Kasa Pembalut 55,10 cm x 3,6 m', 'Roll', 7),
(80, 'Kasa Steril / Cuplik 16 x 16', 'Roll', 17),
(81, 'Ketoconazole 200 mg', 'Tablet', 54),
(82, 'Kloramfenikol / Bufacetin salep kulit', 'tube', 888),
(83, 'Kloramfenikol / Bufacetin 2% 15 g salep kulit', 'tube', 5),
(84, 'Masker Hijab / Baymed', 'Box', 2),
(85, 'Masker Ear Loop', 'Box', 5),
(86, 'Masker Tie on Premium / Jasmin', 'Box', 2),
(87, 'Metformin 500', 'Tablet', 644),
(88, 'Methylprednisolon 4mg', 'Tablet', 269),
(89, 'Metoklopramid Tab 10 mg', 'Tablet', 43),
(90, 'Metoklopramide Injeksi', 'Ampul', 230),
(91, 'Metronidazol Syrup 125 mg / 5 ml', 'Botol', 200),
(92, 'Metronidazole 500mg', 'Tablet', 8),
(93, 'Miconazol 2% cream', 'tube ', 29),
(94, 'Napza Combo 5', 'Unit', 140),
(95, 'Natrium Diklofenac 50 mg', 'Tablet', 59),
(97, 'Nistatin 500.000 IU', 'Tablet', 28),
(98, 'Nistatin 100.000 IU', 'Tablet', 3),
(100, 'Olopatadin Hcl Tetes Mata', 'Botol', 750),
(101, 'Omeprazole Inj ', 'Ampul', 470),
(102, 'Parasetamol 500 mg', 'Tablet', 66),
(103, 'Parasetamol sirup', 'Botol', 31),
(104, 'Pirantel Pamoat Syrup 125 mg / ml', 'Botol', 141),
(105, 'Prednison 5 mg', 'Tablet', 480),
(106, 'Povidone Iodine 60 ml', 'Botol', 1),
(107, 'Ranitidin 150mg', 'Tablet', 126),
(108, 'Reagen Immersion Oil 1x 100 ml', 'Botol', 98),
(109, 'Reagen KOH 10% 1X 500 ML', 'Botol', 33),
(110, 'Reagen Pewarna Gram Set 1x 100 ml', 'Botol', 65),
(111, 'Reagen Pewarna MDT / R3 (Methylen) 1x 100 ml', 'Botol', 79),
(112, 'Reagen Ziehl Neelsen Set 3x 100 ml / Onecare', 'Set', 363),
(113, 'Risperidon 2 mg', 'Tablet', 300),
(115, 'Rivanol 100 ml', 'Botol', 4),
(116, 'RPR Antigen Test', 'Kit', 100),
(117, 'Salbutamol Sulfate 1 mg / ml Injeksi', 'Ampul', 3),
(118, 'Salbutamol Syrup', 'Botol', 510),
(119, 'Salbutamol 2 mg', 'Tablet', 104),
(120, 'Salbutamol 4 mg', 'Tablet', 260),
(121, 'Salep 2-4', 'Pot', 170),
(122, 'Sampel Container 40 ml Steril', 'Pcs', 7),
(123, 'Sarung Tangan Steril No 7 / E-Care', 'Pasang', 3),
(124, 'Sarung Tangan Non Steril / Jasmine', 'Box', 51),
(125, 'Simvastatin 10 mg', 'Tablet', 272),
(126, 'Simvastatin 20 mg', 'Tablet', 29),
(127, 'Spuit 1 cc', 'Pcs', 3),
(129, 'Spuit 1 cc  / Nipro', 'Pcs', 43),
(130, 'Spuit 10 cc', 'Pcs', 700),
(131, 'Spuit 10 cc / Nipro', 'Pcs', 14),
(132, 'Spuit 3 cc  / Nipro', 'Pcs', 31),
(133, 'Spuit 5ml / Nipro', 'Pcs', 19),
(134, 'Sulfadiazine Silver Krim 1%', 'Tube', 928),
(135, 'Syphilis Ab Rapid Test. IS', 'Box', 0),
(136, 'Thiamin/ Vitamin B1, 50mg', 'Tablet', 160),
(137, 'Trihexiphenidil ', 'Tablet', 98),
(138, 'Trihexiphenidil 2 mg tab', 'Tablet', 125),
(139, 'Vitamin B Kompleks', 'Tablet', 121),
(140, 'Vitamin B6 10 mg', 'Tablet', 182),
(141, 'Vitamin C 50 mg', 'Tablet', 192),
(142, 'Yuni-Sol Desinfektan 5 L', 'Botol', 264),
(143, 'Zeta Pestisida Foging', 'Liter', 70),
(144, 'Rapid Malaria', 'Box', 15),
(145, 'ADS Oneject 5ml', 'pcs', 40300),
(146, 'ADS/Spuit 0,5ml', 'pcs', 191),
(147, 'Bio-Strach', 'Kaplet', 8),
(148, 'Coverall', 'Pcs', 2),
(149, 'Insektisida DBD (Insek. Zeta 15 uI)', 'Liter', 110),
(150, 'Kaca Slide', 'Box', 8),
(151, 'Pot Sputum', 'Pcs', 137),
(152, 'RDT DBD Combo', 'Ktk', 200),
(153, 'Tablet Tambah Darah', 'Tablet', 1128),
(154, 'Vitamin A 100.000 IU / BIRU', 'Kapsul', 3),
(155, 'Vitamin A 200.000 IU / MERAH', 'Kapsul', 30),
(156, 'Zink 20 mg', 'Tablet', 384),
(157, 'Abacavir 300mg /ABC', 'Botol', 200),
(158, 'ABC (120)/ 3TC (60)', 'Botol', 23),
(159, 'DTG 50mg', 'Botol', 313),
(160, 'Efavirenz', 'Botol', 600),
(161, 'Lamivudine 150mg (3TC) / HIVIRAL', 'Botol', 12),
(162, 'Lopinavir 200mg/Ritonavir 50mg (Aluvia) ', 'Botol', 208),
(163, 'Nevirapine 200mg (NVP) ', 'Botol', 6),
(164, 'Tenofovir 300mg (TDF 300mg)', 'Botol', 17),
(165, 'Tenofovir/Emtricitabine (TDF/FTC 300/200)', 'Botol', 1),
(166, 'Tenofovir+Lamivudine+Efavirenz /300/300/600 (FDC) ', 'Botol', 5),
(167, 'TLD (TDF/ 3TC/ DTG)', 'Botol', 18),
(168, 'Zidovudine 100mg', 'Botol', 121),
(169, 'Zidovudine 300mg + Lamivudine 150mg (DUVIRAL) ', 'Botol', 8),
(170, 'Cotrimoxazole 480 mg', 'Tablet', 21),
(171, 'Cotrimoxazole 960 mg', 'Tablet', 6),
(172, 'Fluconazole 150 mg', 'Botol', 0),
(173, 'Benzatine Penicilline 2.4 juta IU', 'Botol', 0),
(174, 'Rabivax-Svaksin (Rabies Inj 2,5 IU)', 'Botol', 0),
(175, 'SERUM ANTI RABIES (SAR)', 'Botol', 4),
(176, 'OAT Kategori I', 'Paket', 7),
(177, 'OAT Kategori Anak', 'Paket', 968),
(178, 'Bedaquillin 100 mg', 'Tablet', 0),
(179, 'Clofazimine 100 mg', 'Tablet', 0),
(180, 'Cycloserine 250 mg', 'Tablet', 0),
(181, 'Delamanide 50 mg', 'Tablet', 0),
(182, 'Ethambutol 400 mg', 'Tablet', 2),
(183, 'Ethionamide 250 mg', 'Tablet', 5),
(184, 'Levofloxacin 250 mg', 'Tablet', 0),
(185, 'Linezolid 600 mg', 'Tablet', 0),
(186, 'Masker N95', 'pcs', 7),
(187, 'Masker Bedah', 'pcs', 1),
(188, 'Moxifloxacine 400 mg', 'Tablet', 3),
(189, 'Pirazinamid', 'Tablet', 18),
(190, 'Catridge Xpert MTB/RIF', 'pcs', 100),
(191, 'Tuberkulin', 'Vial', 28),
(192, 'Rifapentine 150 mg', 'Tablet', 6),
(193, 'Virocheck HIV 1/2', 'Test', 6),
(194, 'Rapid 1 HIV', 'Test', 5),
(195, 'Rapid 2 HIV', 'Test', 2),
(196, 'Rapid 3 HIV', 'Test', 2),
(197, 'RPR Test Sifilis Fokus', 'Test', 200),
(198, 'Isoniazid 100 mg', 'Tablet', 800),
(199, 'Isoniazid 300 mg (H2)', 'Tablet', 3),
(200, 'Primaquin', 'Tablet', 380),
(201, 'Artesunate Inj', 'Vial', 55),
(202, 'DHP-Frimal', 'Tablet', 306),
(203, 'Albendazole suspensi', 'Botol', 2),
(204, 'Natrium Clorida 500 mL', 'Fls', 100),
(205, 'Diazepam inj', 'Ampul', 40),
(206, 'Chlorpheniramine Maleate (CTM) 4 mg', 'Tablet', 10),
(207, 'Safety Box 2.5 L ', 'Pcs', 2),
(208, 'Safety Box 5 L ', 'Pcs', 350),
(209, 'RDT HbsAG', 'Test', 8),
(210, 'HBIG', 'Vial', 92),
(211, 'Abate Larvasida', 'Kg', 50),
(216, 'Sutra', 'Pack', 3),
(217, 'Anlene', 'Bungkus', 13),
(218, 'Amoxicilin', 'Papan', 5),
(219, 'Paracetamol', 'Papan', 20);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
(1, 'rudi@gmail.com', 'rudi123', 'rudi321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_obat` (`id_obat`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_obat` (`nama_obat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
