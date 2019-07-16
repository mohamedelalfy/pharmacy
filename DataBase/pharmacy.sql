-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2018 at 09:10 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visibility` tinyint(4) NOT NULL DEFAULT '0',
  `Sales` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Ordering`, `Visibility`, `Sales`) VALUES
(21, 'lbvs', 'Part Of lbvs', 1, 0, 0),
(22, 'ointment', 'Part Of ointment', 2, 0, 0),
(23, 'capsules', 'Part Of capsules', 0, 0, 1),
(24, 'For fractures Tools', 'All hand fractures Tools and other..', 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Producing_Date` date NOT NULL,
  `Expiration_Date` date NOT NULL,
  `Images` varchar(255) NOT NULL,
  `Cat_ID` int(11) NOT NULL,
  `Sales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `Name`, `Description`, `Price`, `Producing_Date`, `Expiration_Date`, `Images`, `Cat_ID`, `Sales`) VALUES
(22, 'Paragesic', 'Acetaminophen (or paracetamol) is not well known, but it is believed to work to prevent certain vectors from being responsible for pain in the central nervous system, thus stopping pain and preventing heat from rising.', '10', '2018-08-03', '2018-08-31', '996215821_p.jpg', 21, 0),
(23, 'PROFENID', 'The treatment belongs to a group of treatments called \"non-steroidal anti-inflammatory drugs,\" which inhibit the action of an enzyme (called ring oxidation enzyme), which is responsible for the manufacture of substances in the body that cause inflammation and pain. Treatment has a pain-relieving, anti-fever, anti-inflammatory effect.', '20', '2018-08-02', '2018-08-11', '767639160_c.jpg', 21, 10),
(24, 'Giacarin', 'Acetaminophen (or paracetamol) is not well known, but it is believed to work to prevent certain vectors from being responsible for pain in the central nervous system, thus stopping pain and preventing heat from rising.', '50', '2018-08-31', '2018-08-03', '401763916_b.jpg', 21, 2),
(25, 'Gilson', 'Acetaminophen (or paracetamol) is not well known, but it is believed to work to prevent certain vectors from being responsible for pain in the central nervous system, thus stopping pain and preventing heat from rising.', '6', '2018-08-31', '2018-08-27', '268157959_l.jpg', 21, 0),
(26, 'dolphin', 'Its mechanism of action is due to its ability to prevent prostaglandin synthesis by inhibiting cyclooxygenase (ring oxidation enzymes). Prostaglandins, which cause inflammation and pain', '32', '2018-08-31', '2018-08-04', '590881348_s.jpg', 21, 0),
(27, 'AlGason', 'To relieve rheumatic pain, inflammation and associated localized pain in muscles, joints and surrounding tissues  - To relieve the pain of muscle ruptures, stiff neck, lymphago, bruising, muscle stiffness and convulsions  - to relieve muscle pain and contractions resulting from fatigue and excessive effort as well as resulting from injuries or sprains joints when performing a large muscle effort', '22', '2018-08-04', '2018-08-31', '495025635_d.jpg', 22, 0),
(28, 'Adapalene Gel', 'Deverein opens open pores in the skin that cause the appearance of blackheads and spots, making the skin fat.  Results usually appear within months.', '5', '2018-08-02', '2018-08-31', '501556396_s.JPG', 22, 0),
(29, 'BETADERM', 'Betamethasone is a high-effective steroid drug that regulates protein build-up rate, reduces inflammation by inhibiting leukocyte migration and reversing increased permeability of capillaries and lysosomal stability at the cell level to prevent or control inflammation.', '80', '2018-08-17', '2018-08-30', '818420410_t.jpg', 22, 0),
(30, 'GARAMYCIN', 'Antibiotics have a wide activity against different types of gram-negative bacteria and some strains of the cluster and therefore used to treat the bacterial infection of the eye. Do not touch the dropper or tube of ointment, either by hand or eye is sterile and touching may cause infection to the eye, after the drop in the eye Click At the tip of the eye (next to the nose) to prevent loss of the dose. Do not use droplets if you notice a change in color or particles.', '70', '2018-08-02', '2018-08-31', '184082031_sa.jpg', 22, 35),
(31, 'Gynozol ', ' Vaginal infections caused by fungal infections such as Candida ... ** Vaginal injury of fungi and Gram positive bacteria at the same time ... *** Increased vaginal discharge due to infection of fungi and bacteria. And the accompanying sensation of burning and burning .', '98', '2018-08-21', '2019-01-31', '124511718_sq.jpg', 22, 1),
(32, 'درموفيت', 'علاج الاكزيما: تعد الاكزيما من الأمراض الجلدية الخطيرة و التي تظهر على شكل بقع حمراء تكسوها قشور و في الغالب تظهر في الوجه و اليد. علاج تساقط الشعر: يساعد ديرموفيت في علاج تساقط الشعر خاصة في الحالات التي يكون فيها التساقط على شكل حلقة دائرية في الرأس أي الثعلبة. علاج الأمراض الجلدية المزمنة: يعالج ديرموفيت أمراض مثل الحزاز و الذئبة الحمراء. علاج الأمراض الجلدية الشائعة: يعتبر ديرموفيت مهدأ للهياج الجلدي و علاجا للحساسية. علاج الصدفية و البهاق: بسبب نقص الصبغة الجلدية يمكن الإصابة بالبهاق و ديرموفيت يعالج ذلك النقص، أما الصدفية فهي مرض جلدي يظهر على شكل قشور ذات لون فضي.', '22', '2018-08-24', '2018-08-30', '342956543_e.jpg', 22, 0),
(33, 'DERMAZIN', 'Fadazine is an antibiotic derived from Sulfa. Mechanism of action: To inhibit the activity and proliferation of bacterial cells by inhibiting the manufacture of certain enzymes needed by bacteria in its growth and activity. It works on a wide range of Gram negative, Gram positive, as well as its effect on Plasmodium and Toxoplasma,', '45', '2018-08-16', '2018-08-29', '191680908_ss.jpg', 22, 9),
(34, 'Fastum Gel', 'Relieve the inflammation that occurs in the muscles that arise due to rheumatism. Treatment of pains that arise in both joints and bones as the substance of Ketoprofen effective in the treatment of pains that arise in the bone as a result of muscle effort. Torsion of the ankle and knee Lower back pain and muscle pain in general', '23', '2018-08-04', '2018-10-26', '915252686_ff.jpg', 22, 0),
(35, 'Fucidin ', 'Vesosidine ointment is used to treat skin infections caused by cluster bacteria, including those resistant to penicillin, and may be used as such:  Treatment of injury wounds. Treatment of herpes disease. Treat the skin infection that appears around the nails. Treatment of follicles that affect hair follicles. Eczema treatment. Treatment of boils that appear on the face or body. Treatment of burns if used with creams treated for burns. Treatment of cereals that appear due to the use of cosmetics. Wounds that are harvested after birth and surgery, where the ointment is applied to the area where the stitching is performed. It can be used as an adjuvant cream to treat the problem of acne and pills that appear in the face. It can be used in the treatment of infections and pills that appear in the sensitive area, which it is possible to', '33', '2018-08-08', '2018-08-31', '754333496_d.jpg', 22, 0),
(36, 'wrist Hand', 'Used in alleviating the pain of the bones, this tube is placed on broken bones Used in alleviating the pain of the bones, this tube is placed on broken bones ', '80', '2018-08-16', '2018-08-04', '130340576_2Pcs-New-font-b-Wrist-b-font-Hand-font-b-Support-b-font-font-b-Glove-800x800.jpg', 24, 0),
(37, 'wrist Leg', 'Used in alleviating the pain of the bones, this tube is placed on broken bones Used in alleviating the pain of the bones, this tube is placed on broken bones  Used in alleviating the pain of the bones, this tube is placed on broken bones Used in alleviating the pain of the bones, this tube is placed on broken bones ', '80', '2018-08-17', '2018-08-31', '224487304_61PsOhZ5YuL._SX355_.jpg', 24, 2),
(38, 'Wheel chair', 'Used in alleviating the pain of the bones, this tube is placed on broken bones Used in alleviating the pain of the bones, this tube is placed on broken bones  ', '1550', '2018-08-30', '2018-08-27', '6408691_file.jpg', 24, 0),
(39, 'Protect the neck', 'Used in alleviating the pain of the bones, this tube is placed on broken bones Used in alleviating the pain of the bones, this tube is placed on broken bones  Used in alleviating the pain of the bones, this tube is placed on broken bones Used in alleviating the pain of the bones, this tube is placed on broken bones ', '150', '2018-08-09', '2018-08-31', '408355713_item_L_5130200_1872930.jpg', 24, 0),
(40, 'Medical crutches', 'Used in alleviating the pain of the bones, this tube is placed on broken bones Used in alleviating the pain of the bones, this tube is placed on broken bones  Used in alleviating the pain of the bones, this tube is placed on broken bones Used in alleviating the pain of the bones, this tube is placed on broken bones ', '5360', '2018-08-17', '2018-08-31', '44036865_item_L_22397081_30424016.jpg', 24, 100),
(41, 'Medical crutches 2', 'Used in alleviating the pain of the bones, this tube is placed on broken bones Used in alleviating the pain of the bones, this tube is placed on broken bones  Used in alleviating the pain of the bones, this tube is placed on broken bones Used in alleviating the pain of the bones, this tube is placed on broken bones ', '30', '2018-08-09', '2018-08-31', '934387207_item_XL_29978407_89728251.jpg', 24, 150);

-- --------------------------------------------------------

--
-- Table structure for table `ordering`
--

CREATE TABLE `ordering` (
  `Oreder_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ordering`
--

INSERT INTO `ordering` (`Oreder_ID`, `User_ID`, `Item_ID`) VALUES
(47, 17, 38),
(48, 17, 40);

-- --------------------------------------------------------

--
-- Table structure for table `private_message`
--

CREATE TABLE `private_message` (
  `M_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `Images` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `private_message`
--

INSERT INTO `private_message` (`M_ID`, `User_ID`, `Date`, `Images`, `Subject`, `Message`) VALUES
(11, 1, '2018-08-12 21:58:21', '', 'Tsesttest', 'This is '),
(12, 14, '2018-08-13 08:10:44', '340820312_contact-bg.jpg', 'about anyThing', 'about anything');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `RegStatus` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Password`, `Email`, `FullName`, `GroupID`, `RegStatus`, `Date`, `Images`) VALUES
(1, 'Mohamed', '601f1889667efaebb33b8c12572835da3f027f78', 'mohamedadel31038@gmail.com', 'Mohamed Adel Mohamed Salah', 1, 1, '2018-07-01', ''),
(13, 'Apo Salah', '601f1889667efaebb33b8c12572835da3f027f78', 'aposalah@gmail.com', 'Mohamed Salah Elsead', 0, 1, '2018-08-13', '803314209_mohameds.jpg'),
(14, 'Mostafa', '601f1889667efaebb33b8c12572835da3f027f78', 'mostafa@gmail.com', 'Mostafa Mohamed Assem Fathe', 0, 1, '2018-08-13', '47698974_mostafa.JPG'),
(15, 'Elalfy', '601f1889667efaebb33b8c12572835da3f027f78', 'elalfy@gmail.com', 'Mohamed Ahmed Elalfy', 0, 0, '2018-08-13', ''),
(16, 'ApoGamal ', '601f1889667efaebb33b8c12572835da3f027f78', 'apogamal@gmail.com', 'Mohamed Gamal Abdallah', 0, 1, '2018-08-13', '198516845_IMG_20180701_215814_979.jpg'),
(17, 'Apo Hepa', '601f1889667efaebb33b8c12572835da3f027f78', 'mohamedadel31038@gmail.com', 'Mohamed Adel Mohamed Salah', 0, 1, '2018-08-13', '68695068_IMG_E9870.JPG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`Oreder_ID`),
  ADD KEY `oreder-user` (`User_ID`),
  ADD KEY `item-order` (`Item_ID`);

--
-- Indexes for table `private_message`
--
ALTER TABLE `private_message`
  ADD PRIMARY KEY (`M_ID`),
  ADD KEY `Message` (`User_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `ordering`
--
ALTER TABLE `ordering`
  MODIFY `Oreder_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `private_message`
--
ALTER TABLE `private_message`
  MODIFY `M_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordering`
--
ALTER TABLE `ordering`
  ADD CONSTRAINT `item-order` FOREIGN KEY (`Item_ID`) REFERENCES `items` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oreder-user` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `private_message`
--
ALTER TABLE `private_message`
  ADD CONSTRAINT `Message` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
