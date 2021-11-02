-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 30, 2021 lúc 05:59 PM
-- Phiên bản máy phục vụ: 10.4.18-MariaDB
-- Phiên bản PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `thi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `give_hw`
--

CREATE TABLE `give_hw` (
  `id_hw` int(11) UNSIGNED NOT NULL,
  `name_hw` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `require` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_st` datetime NOT NULL DEFAULT current_timestamp(),
  `time_ex` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- INSERT INTO `give_hw` (`id_hw`, `name_hw`, `require`, `time_st`, `time_ex`) VALUES
-- (1, 'Công nghệ web.doc', 'nộp muộn trừ 1 điểm', '2021-10-25 09:49:28','2021-10-31 19:49:28');
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `submit`
--

CREATE TABLE `submit` (
  `id_sb` int(11) UNSIGNED NOT NULL,
  `file_sb` varchar(300) NOT NULL,
  `id_student` int(11) UNSIGNED NOT NULL,
  `id_hw` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users_student`
--

CREATE TABLE `users_student` (
  `id_student` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users_teacher`
--

CREATE TABLE `users_teacher` (
  `id_teacher` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `give_hw`
--
ALTER TABLE `give_hw`
  ADD PRIMARY KEY (`id_hw`);

--
-- Chỉ mục cho bảng `submit`
--
ALTER TABLE `submit`
  ADD PRIMARY KEY (`id_sb`),
  ADD KEY `id_hw` (`id_hw`),
  ADD KEY `id_student` (`id_student`);

--
-- Chỉ mục cho bảng `users_student`
--
ALTER TABLE `users_student`
  ADD PRIMARY KEY (`id_student`);

--
-- Chỉ mục cho bảng `users_teacher`
--
ALTER TABLE `users_teacher`
  ADD PRIMARY KEY (`id_teacher`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `give_hw`
--
ALTER TABLE `give_hw`
  MODIFY `id_hw` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `submit`
--
ALTER TABLE `submit`
  MODIFY `id_sb` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users_student`
--
ALTER TABLE `users_student`
  MODIFY `id_student` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users_teacher`
--
ALTER TABLE `users_teacher`
  MODIFY `id_teacher` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `submit`
--
ALTER TABLE `submit`
  ADD CONSTRAINT `submit_ibfk_1` FOREIGN KEY (`id_hw`) REFERENCES `give_hw` (`id_hw`),
  ADD CONSTRAINT `submit_ibfk_2` FOREIGN KEY (`id_student`) REFERENCES `users_student` (`id_student`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
