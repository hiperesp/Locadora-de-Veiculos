-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 01-Nov-2019 às 10:15
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdLocacao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbMarca`
--

CREATE TABLE `tbMarca` (
  `idMarca` int(11) NOT NULL,
  `nomeMarca` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tbMarca`
--

INSERT INTO `tbMarca` (`idMarca`, `nomeMarca`) VALUES
(1, 'Agrale'),
(2, 'Aston Martin'),
(3, 'Audi'),
(4, 'Bentley'),
(5, 'BMW'),
(6, 'BYD'),
(7, 'CAOA Chery'),
(8, 'Changan'),
(9, 'Chevrolet'),
(10, 'Chrysler'),
(11, 'Citroën'),
(12, 'Dodge'),
(13, 'Dongfeng'),
(14, 'Effa'),
(15, 'Ferrari'),
(16, 'Fiat'),
(17, 'Ford'),
(18, 'Foton'),
(19, 'Geely'),
(20, 'Hafei'),
(21, 'Honda'),
(22, 'Hyundai'),
(23, 'Iveco'),
(24, 'JAC'),
(25, 'Jaguar'),
(26, 'Jeep'),
(27, 'Jinbei'),
(28, 'Kia'),
(29, 'Lamborghini'),
(30, 'Land Rover'),
(31, 'Lexus'),
(32, 'Lifan'),
(33, 'Maserati'),
(34, 'McLaren'),
(35, 'Mercedes-AMG'),
(36, 'Mercedes-Benz'),
(37, 'Mini'),
(38, 'Mitsubishi'),
(39, 'Nissan'),
(40, 'Peugeot'),
(41, 'Porsche'),
(42, 'RAM'),
(43, 'Rely'),
(44, 'Renault'),
(45, 'Rolls-Royce'),
(46, 'Shineray'),
(47, 'Smart'),
(48, 'SsangYong'),
(49, 'Subaru'),
(50, 'Suzuki'),
(51, 'TAC'),
(52, 'Tesla'),
(53, 'Toyota'),
(54, 'Troller'),
(55, 'Volkswagen'),
(56, 'Volvo'),
(57, 'Marcas vendidas no exterior'),
(58, 'Abarth'),
(59, 'Acura'),
(60, 'Alfa Romeo'),
(61, 'Brilliance'),
(62, 'Bugatti'),
(63, 'Buick'),
(64, 'Cadillac'),
(65, 'Dacia'),
(66, 'Daihatsu'),
(67, 'Datsun'),
(68, 'DS'),
(69, 'Genesis'),
(70, 'Great Wall'),
(71, 'Haima'),
(72, 'Hummer'),
(73, 'Infiniti'),
(74, 'Koenigsegg'),
(75, 'Lada'),
(76, 'Lancia'),
(77, 'Landwind'),
(78, 'Lincoln'),
(79, 'Lotus'),
(80, 'Mahindra'),
(81, 'Mazda'),
(82, 'MG'),
(83, 'Opel'),
(84, 'Pagani'),
(85, 'Pontiac'),
(86, 'Qoros'),
(87, 'Saab'),
(88, 'Seat'),
(89, 'Spyker'),
(90, 'Tata'),
(91, 'Zotye'),
(92, 'ZX Auto');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbMarca`
--
ALTER TABLE `tbMarca`
  ADD PRIMARY KEY (`idMarca`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbMarca`
--
ALTER TABLE `tbMarca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
