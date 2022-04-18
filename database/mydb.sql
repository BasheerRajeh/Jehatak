-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2022 at 12:48 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `training_company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `text`, `training_company_id`) VALUES
(1, 'التدريب فى شركة : أرامكو السعودية\r\n\r\nتحية طيبة وبعد ...\r\nبألاشارة إلى خطاب سيادتكم الوارد الينا بتاريخ 2022/03/01 بأمكانية قبول تدريب\r\nالطلاب التالية أسمائهم :\r\n\r\nهند العلي\r\nنور غانم\r\nخلال الفترة\r\nمن 2022-03-10\r\nإلى 2022-03-24\r\nالرجاء العلم بأنه تم قبول تدريب الطلاب\r\nخلال هذه الفترة\r\nو يرجى العلم بأن إدارة الكلية غير مسئوله عن دفع أى تكاليف أو تحمل أى نفقات خاصة\r\nبكم لدى الطالب\r\nالرجاء إرسال الخطة التدريبية الخاصة بالطلاب حتى نستطيع متابعته فى الحضور لديكم .\r\n\r\nوتفضلوا بقبول وافر الإحترام\r\n\r\nمشرف وحدة التدريب في الكلية\r\n            ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL,
  `student_user_id` int(11) NOT NULL,
  `training_company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `status`, `message`, `student_user_id`, `training_company_id`) VALUES
(1, 'Accepted', 'أنا الطالبة هند العلي\r\nأريد الانضمام إلى شركتكم من أجل التدريب.', 10, 1),
(2, 'Pending', 'أنا الطالب فادي\r\nأريد الانضمام إلى شركتكم من أجل التدريب.', 13, 3),
(3, 'Accepted', 'أنا الطالبة نور غانم\r\nأريد الانضمام إلى شركتكم من أجل التدريب.', 11, 1),
(5, 'Accepted', 'أنا الطالبة نجوى العلي\r\nأريد الانضمام إلى شركتكم من أجل التدريب.', 15, 2),
(7, 'Accepted', 'أنا الطالب سلام أريد الانتساب لديكم', 36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(4, 'شركة'),
(3, 'طالب'),
(1, 'مدير'),
(2, 'مشرف');

-- --------------------------------------------------------

--
-- Table structure for table `speciality`
--

CREATE TABLE `speciality` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `speciality`
--

INSERT INTO `speciality` (`id`, `name`) VALUES
(2, 'ادارة اعمال'),
(1, 'نظم معلومات ادارية');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `user_id` int(11) NOT NULL,
  `universe_id` varchar(45) DEFAULT NULL,
  `national_id` varchar(45) DEFAULT NULL,
  `speciality_id` int(11) DEFAULT NULL,
  `rate` decimal(4,2) DEFAULT NULL,
  `supervisor_user_id` int(11) DEFAULT NULL,
  `training_company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`user_id`, `universe_id`, `national_id`, `speciality_id`, `rate`, `supervisor_user_id`, `training_company_id`) VALUES
(10, '33123', '202406123', 1, '94.20', 7, 1),
(11, '33144', NULL, 1, '91.00', 7, 1),
(13, '33222', NULL, 1, NULL, NULL, NULL),
(14, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '33532', NULL, 2, '85.14', NULL, 2),
(36, '1234567', '1324567890', 2, '90.00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `user_id` int(11) NOT NULL,
  `national_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`user_id`, `national_id`) VALUES
(8, '020404111'),
(7, '020404142'),
(9, '021411532');

-- --------------------------------------------------------

--
-- Table structure for table `training_company`
--

CREATE TABLE `training_company` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `training_company`
--

INSERT INTO `training_company` (`id`, `name`, `user_id`) VALUES
(1, 'أرامكو السعودية', 2),
(2, 'شركة ينساب', 6),
(3, 'مصرف الراجحي', 3),
(5, 'مستشفى الهيئة الملكية', 27),
(6, 'مستشفى ينبع العام', 28),
(7, 'مطار الامير عبد المحسن بن عبد العزيز', 29),
(8, 'الغرفة التجارية بينبع الصناعية', 30),
(9, 'شركة الالياف الزجاجيه', 31),
(10, 'مستوصف الفرابي', 32),
(11, 'مستوصف ساري القحطاني', 33),
(12, 'مستوصف الانصاري التخصصي', 34),
(13, 'مستشفى ينبع الوطني', 35);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(45) NOT NULL,
  `image_url` varchar(45) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `image_url`, `role_id`) VALUES
(1, 'admin@gmail.com', '$2y$10$SLeMnQBEK7XxitJXo/.zNOD4C.iL/FPYkgzCY3mKQjMu1H6Vc36tC', 'سارة', 'download.png', 1),
(2, 'aramco@gmail.com', '$2y$10$9/nvSq7apES4N5XNQDd65O2RSlonMBFSScmTZe6A/xyM8kuqCdAZm', 'أرامكو السعودية', 'aramco.png', 4),
(3, 'alrajhi@gmail.com', '$2y$10$RnYg5QFfYs/ZqclE20P1xO4xfiWImKwfwAqX4XVlVi.O6n7t1ToYe', 'مصرف الراجحي', 'Alrajhi.png', 4),
(6, 'yansab@gmail.com', '$2y$10$TSKRmcTTNm6Ps8AKqcD4z.qC.uO8nF8v/0eBpA70z7x/4yh0uNPqa', 'شركة ينساب', 'Yansab.png', 4),
(7, 'ali.ahmad@gmail.com', '$2y$10$GUBtdeHCXbnl/xrgYQeE4eLqBWTHlJWNhBTHUGME/ohTkoY7pQqfy', 'علي أحمد', 'Ali.png', 2),
(8, 'sima.adham@gmail.com', '$2y$10$Gr1CFdtIEthO.xPNq4jXieTcaqkDJ4ZncXnBbT.5gRYJnoDo0mGSi', 'سيما أدهم', 'sima.jpg', 2),
(9, 'adnan.ataya@gmail.com', '$2y$10$Oml8qvFA/9yJ/jj/BE1CO.4okyi2.Se4I3/EBOCsVXOZggSv9/T0u', 'عدنان قطايا', 'user.jpeg', 2),
(10, 'hind.alali@gmail.com', '$2y$10$vpUuetNsy7xXVyH/IWndueshVrkNnajy4n38TJBuR5RidZEtpwHUq', 'هند العلي', 'hind.png', 3),
(11, 'nour.ghanem@gmail.com', '$2y$10$N23MFXV7Cl.gfkkTN6WgsO5HmtQu.jNyOLD2bQr2UvSPOi2DBm66e', 'نور غانم', 'Nour.jpg', 3),
(13, 'fadi.kataya@gmail.com', '$2y$10$okOyTjN7m1mlI40QBWexleEk04iI21km1I3rSB98rxT6nvi2keVg2', 'فادي قطاية', 'user.jpeg', 3),
(14, 'mahmoud.adham@gmail.com', '$2y$10$9Td8m.RQD1FfXvFzvy1EqemFzI2LFQ6ROexLpEeCvdArIaCD/b8Ai', 'محمود أدهم', 'user.jpeg', 3),
(15, 'najwa.alali@gmail.com', '$2y$10$Wb1Gxj.P6TSC0/noTI2VrOmFNjwHRyvoM6kWWl2TO664NpRbMX/PO', 'نجوى العلي', 'user.jpeg', 3),
(27, 'royal@gmail.com', '$2y$10$UlbNApXqQJkoP8Ltt54GS.r/ooGdtDZSx5ujdmWPtSSiadrAtFeya', 'مستشفى الهيئة الملكية', 'hsp5-logo_400x400.png', 4),
(28, 'yanbu@gmail.com', '$2y$10$n3oC0VNxdH0Bp5xaph/8Y.dgSuPLY9tuHrSz1ObXxa0OkfauCuVNS', 'مستشفى ينبع العام', '2.jpg', 4),
(29, 'airport@gmail.com', '$2y$10$5dwaat4PC.8TThsXPMZfxuO00RCDvbqmmYSWMe0f29Dnly/Jz/u3y', 'مطار الامير عبد المحسن بن عبد العزيز', '3.jpg', 4),
(30, 'comroom@gmail.com', '$2y$10$WYGHrox49ktth5kNkScfLe9Ah.xG9LVjtbvxhsEyZovi/AD6vMmb2', 'الغرفة التجارية بينبع الصناعية', '4.jpg', 4),
(31, 'fiberglass@gmail.com', '$2y$10$D40kG89xYize3p/hTkzwr.E0kFrQYLOkvq0vnQY0hQbhKo0DGSbJu', 'شركة الالياف الزجاجيه', '5.jpg', 4),
(32, 'farabi@gmail.com', '$2y$10$qEjLOmq3uBkzjKR421UiSum0F1UD1uuvdsmmpLsz9/mNfNMP5bK6C', 'مستوصف الفرابي', '6.jpg', 4),
(33, 'sari.alqahtan@gmail.com', '$2y$10$y2VqD6umN8o0pjgOW1ahvOtAfvqNeqGWFJFSi4Z7aSCjOB.S/5Q2y', 'مستوصف ساري القحطاني', '7.jpg', 4),
(34, 'alansari@gmail.com', '$2y$10$auBNgE4vXvZaNaC76ZpZXe0Nol5A4P1rwsZiHvzinN1YTerbY//Eq', 'مستوصف الانصاري التخصصي', '8.jpg', 4),
(35, 'yanbu.hosbital@gmail.com', '$2y$10$xXyfYsD7283gFjCa9/EvG.jl/PmpAATjzy9rpuEVuJtjw2B5kFwaC', 'مستشفى ينبع الوطني', '9.jpg', 4),
(36, 'salam@gmail.com', '$2y$10$OjygqE0Js..wpfXFv5TOQedUoYAHAbKwrAB/Xymc/j/3yFFPfsUmG', 'سلام', '4205906.png', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message_training_company1_idx` (`training_company_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_request_student1_idx` (`student_user_id`),
  ADD KEY `fk_request_training_company1_idx` (`training_company_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `speciality`
--
ALTER TABLE `speciality`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `national_id_UNIQUE` (`national_id`),
  ADD UNIQUE KEY `universe_id_UNIQUE` (`universe_id`),
  ADD KEY `fk_student_speciality1_idx` (`speciality_id`),
  ADD KEY `fk_student_user1_idx` (`user_id`),
  ADD KEY `fk_student_supervisor1_idx` (`supervisor_user_id`),
  ADD KEY `fk_student_training_company1_idx` (`training_company_id`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `national_id_UNIQUE` (`national_id`),
  ADD KEY `fk_supervisor_user1_idx` (`user_id`);

--
-- Indexes for table `training_company`
--
ALTER TABLE `training_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_training_company_user1_idx` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`email`),
  ADD KEY `fk_user_role1_idx` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `speciality`
--
ALTER TABLE `speciality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `training_company`
--
ALTER TABLE `training_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_training_company1` FOREIGN KEY (`training_company_id`) REFERENCES `training_company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `fk_request_student1` FOREIGN KEY (`student_user_id`) REFERENCES `student` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_request_training_company1` FOREIGN KEY (`training_company_id`) REFERENCES `training_company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student_speciality1` FOREIGN KEY (`speciality_id`) REFERENCES `speciality` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_student_supervisor1` FOREIGN KEY (`supervisor_user_id`) REFERENCES `supervisor` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_student_training_company1` FOREIGN KEY (`training_company_id`) REFERENCES `training_company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_student_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `fk_supervisor_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `training_company`
--
ALTER TABLE `training_company`
  ADD CONSTRAINT `fk_training_company_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
