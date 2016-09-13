SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ip`
--

-- --------------------------------------------------------

--
-- Table structure for table `ips`
--

CREATE TABLE `ips` (
  `id` int(11) NOT NULL,
  `network` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `countryCode` varchar(250) NOT NULL,
  `isp` varchar(250) NOT NULL,
  `lat` varchar(250) NOT NULL,
  `lon` varchar(250) NOT NULL,
  `org` varchar(250) NOT NULL,
  `query` varchar(250) NOT NULL,
  `region` varchar(250) NOT NULL,
  `regionName` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `timezone` varchar(250) NOT NULL,
  `zip` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ips`
--
ALTER TABLE `ips`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ips`
--
ALTER TABLE `ips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
