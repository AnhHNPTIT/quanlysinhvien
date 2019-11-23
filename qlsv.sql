-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 23, 2019 lúc 03:12 AM
-- Phiên bản máy phục vụ: 10.4.6-MariaDB
-- Phiên bản PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlsv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bangdiem`
--

CREATE TABLE `bangdiem` (
  `MaBD` varchar(15) NOT NULL,
  `MaSV_MH` varchar(15) NOT NULL,
  `DiemCC` float NOT NULL,
  `DiemKT` float NOT NULL,
  `DiemTH` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `bangdiem`
--

INSERT INTO `bangdiem` (`MaBD`, `MaSV_MH`, `DiemCC`, `DiemKT`, `DiemTH`) VALUES
('1', '1', 10, 0, 0),
('2', '2', 10, 0, 0),
('3', '3', 10, 0, 0),
('4', '4', 10, 0, 0),
('5', '5', 10, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hocky`
--

CREATE TABLE `hocky` (
  `MaHK` varchar(15) NOT NULL,
  `TenHK` varchar(50) NOT NULL,
  `TimeBD` date NOT NULL,
  `TimeKT` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `hocky`
--

INSERT INTO `hocky` (`MaHK`, `TenHK`, `TimeBD`, `TimeKT`) VALUES
('1', '2016A', '2015-08-01', '2016-01-31'),
('2', '2016B', '2016-02-01', '2016-07-31'),
('3', '2017A', '2016-08-01', '2017-01-31'),
('4', '2017B', '2017-02-01', '2017-07-31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lop`
--

CREATE TABLE `lop` (
  `MaLop` varchar(15) NOT NULL,
  `TenLop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `lop`
--

INSERT INTO `lop` (`MaLop`, `TenLop`) VALUES
('1', 'd16cn2'),
('2', 'd16cn5'),
('3', 'd16at1'),
('4', 'd16at2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monhoc`
--

CREATE TABLE `monhoc` (
  `MaMH` varchar(15) NOT NULL,
  `TenMH` varchar(50) NOT NULL,
  `SoTC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `monhoc`
--

INSERT INTO `monhoc` (`MaMH`, `TenMH`, `SoTC`) VALUES
('BAS1111', 'Những nguyên lý cơ bản của Chủ nghĩa Mác Lênin 1', 2),
('BAS1142', 'Tiếng anh A12', 4),
('BAS1144', 'Tiếng anh A22', 3),
('BAS1201', 'Đại số', 3),
('BAS1203', 'Giải tích 1', 3),
('BAS1227', 'Vật lý 3 và thí nghiệm', 3),
('INT1330', 'Kỹ thuật vi xử lý', 3),
('INT1332', 'Lập trình hướng đối tượng', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sinhvien`
--

CREATE TABLE `sinhvien` (
  `MaSV` varchar(15) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `GioiTinh` varchar(15) NOT NULL,
  `NgaySinh` date NOT NULL,
  `QueQuan` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `MaLop` varchar(15) NOT NULL,
  `Anh` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sinhvien`
--

INSERT INTO `sinhvien` (`MaSV`, `HoTen`, `GioiTinh`, `NgaySinh`, `QueQuan`, `Email`, `MaLop`, `Anh`) VALUES
('b16dcat103', 'Đỗ Đức Minh', 'Nam', '1998-05-01', 'Nghệ An', 'minh@gmail.com', '4', ''),
('b16dcat111', 'Bùi Thanh Na', 'Nữ', '1997-10-20', 'Hưng Yên', 'na.bt@gmail.com', '3', ''),
('b16dcat123', 'Hoàng Kim An', 'Nữ', '1997-01-01', 'Thái Bình', 'an.hoangkim@gmail.com', '3', ''),
('b16dcat199', 'Bùi Xuân Công', 'Nam', '1997-10-10', 'undefined', 'xuancong@gmail.com', '1', ''),
('b16dcat205', 'Bùi Hùng', 'Nam', '1997-10-01', 'undefined', 'buihung@gmail.com', '3', ''),
('b16dcat888', 'Đỗ Trần Anh Quân', 'Nam', '1997-12-21', 'undefined', 'anhquan@gmail.com', '4', 'public/images/img_2019-11-21-14-02.png'),
('b16dccn010', 'Nguyễn Thị Lan Anh', 'Nữ', '1998-06-01', 'Hải Dương', 'lananh@gmail.com', '1', ''),
('b16dccn018', 'Hoàng Ngọc Ánh', 'Nữ', '1997-12-27', 'Thái Bình', 'anhhn97.ptit@gmail.com', '1', ''),
('b16dccn110', 'Đỗ Minh An', 'Nữ', '1998-08-01', 'Hưng Yên', 'xinhgai271297@gmail.com', '2', ''),
('b16dccn186', 'Nhữ Thị Huyền', 'Nữ', '1998-01-01', 'Hải Dương', 'nhuhuyen@gmail.com', '1', ''),
('b16dccn209', 'Đỗ Đức Cảnh', 'Nam', '1997-07-05', 'Thái Bình', 'gieomamsusong@gmail.com', '1', ''),
('b16dccn210', 'Hoàng Kim Hoa', 'Nữ', '1998-06-06', 'Thái Bình', 'kimhoa@gmail.com', '2', ''),
('b16dccn218', 'Bùi Thị Lụa', 'Nữ', '1998-09-11', 'Nghệ An', 'luabui@gmail.com', '1', ''),
('b16dccn260', 'Khổng Hoàng Phong', 'Nam', '1998-10-26', 'Hải Phòng', 'phongkhonghoang@gmail.com', '2', 'public/images/img_2019-11-21-14-02.png'),
('b16dccn267', 'Khổng Hoàng', 'Nam', '1998-10-26', 'Hải Phòng', 'phongkhonghoang@gmail.com', '2', ''),
('b16dccn511', 'Bùi Trung Kiên', 'Nam', '1998-02-01', 'Bình Thuận', 'kien123@gmail.com', '2', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `svmh`
--

CREATE TABLE `svmh` (
  `MaSV_MH` varchar(15) NOT NULL,
  `MaSV` varchar(15) NOT NULL,
  `MaMH` varchar(15) NOT NULL,
  `MaHK` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `svmh`
--

INSERT INTO `svmh` (`MaSV_MH`, `MaSV`, `MaMH`, `MaHK`) VALUES
('1', 'b16dccn010', 'BAS1111', '1'),
('2', 'b16dccn018', 'BAS1111', '1'),
('3', 'b16dccn186', 'BAS1111', '1'),
('4', 'b16dccn218', 'BAS1111', '1'),
('5', 'b16dccn260', 'BAS1111', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaSV` varchar(15) NOT NULL,
  `TenDangNhap` varchar(50) NOT NULL,
  `MatKhau` varchar(50) NOT NULL,
  `NhomQuyen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`MaSV`, `TenDangNhap`, `MatKhau`, `NhomQuyen`) VALUES
('b16dcat103', 'b16dcat103', '1', 1),
('b16dccn209', 'admin', 'admin', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bangdiem`
--
ALTER TABLE `bangdiem`
  ADD PRIMARY KEY (`MaBD`),
  ADD KEY `MaSV_MH` (`MaSV_MH`);

--
-- Chỉ mục cho bảng `hocky`
--
ALTER TABLE `hocky`
  ADD PRIMARY KEY (`MaHK`);

--
-- Chỉ mục cho bảng `lop`
--
ALTER TABLE `lop`
  ADD PRIMARY KEY (`MaLop`);

--
-- Chỉ mục cho bảng `monhoc`
--
ALTER TABLE `monhoc`
  ADD PRIMARY KEY (`MaMH`);

--
-- Chỉ mục cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD PRIMARY KEY (`MaSV`),
  ADD KEY `MaLop` (`MaLop`);

--
-- Chỉ mục cho bảng `svmh`
--
ALTER TABLE `svmh`
  ADD PRIMARY KEY (`MaSV_MH`),
  ADD KEY `MaHK` (`MaHK`),
  ADD KEY `MaMH` (`MaMH`),
  ADD KEY `MaSV` (`MaSV`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaSV`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bangdiem`
--
ALTER TABLE `bangdiem`
  ADD CONSTRAINT `bangdiem_ibfk_1` FOREIGN KEY (`MaSV_MH`) REFERENCES `svmh` (`MaSV_MH`);

--
-- Các ràng buộc cho bảng `sinhvien`
--
ALTER TABLE `sinhvien`
  ADD CONSTRAINT `sinhvien_ibfk_1` FOREIGN KEY (`MaLop`) REFERENCES `lop` (`MaLop`);

--
-- Các ràng buộc cho bảng `svmh`
--
ALTER TABLE `svmh`
  ADD CONSTRAINT `svmh_ibfk_1` FOREIGN KEY (`MaHK`) REFERENCES `hocky` (`MaHK`),
  ADD CONSTRAINT `svmh_ibfk_2` FOREIGN KEY (`MaMH`) REFERENCES `monhoc` (`MaMH`),
  ADD CONSTRAINT `svmh_ibfk_3` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `taikhoan_ibfk_1` FOREIGN KEY (`MaSV`) REFERENCES `sinhvien` (`MaSV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
