-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 15, 2022 lúc 03:47 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `salesshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `PassWord` char(255) NOT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `Address` varchar(250) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `SecretQuestion` varchar(250) DEFAULT NULL,
  `SecretAnswer` varchar(250) DEFAULT NULL,
  `CreatedDay` date DEFAULT NULL,
  `Type` int(10) NOT NULL DEFAULT 0,
  `Status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`ID`, `UserName`, `PassWord`, `Name`, `Address`, `Email`, `Phone`, `SecretQuestion`, `SecretAnswer`, `CreatedDay`, `Type`, `Status`) VALUES
(1, 'admin', '$2y$10$eVNSa1tTwXaTBsQCgdVMg.j/qsu7/lJuOOa/2kop058Yi6jkp9h1O', 'Admin', 'Tphcm', 'Abc123@gmail.com', '0123456789', NULL, NULL, '2021-05-10', 1, 1),
(3, 'user', '$2y$10$V6Ht6Yc7Y12cYzlrT0dJjOlz94mSTzr87FJ7S7NyKfdd/9TKElXoO', 'User', 'abc123', 'user@gmail.com', '0123456789', NULL, NULL, '2021-05-10', 0, 1),
(5, 'tue', '$2y$10$Pox29be.x7m19WQWaWnHReeP2f5SqF.lpBR9IMyIpGewdFE3MMHpW', 'Lê Chính Tuệ', 'abc123', 'tue@gmail.com', '0123456789', NULL, NULL, '2021-05-25', 1, 1),
(6, 'ngan', '$2y$10$ymsYXyQzx.uBrJoyRqYD5OZYInNxDsEJhTe1.UPRPeVHQy2L6oNRy', 'Kim Ngan', 'TP.HCM', 'cnkimngan@gmail.com', '0965044975', NULL, NULL, '2021-05-25', 1, 1),
(7, 'anh', '$2y$10$X089qNS/btYsev6IFOBCfO2FWhv0Gdop6ReWXHlroXIs0b7/n3TsO', 'Nguyễn Thế Anh', 'abc123', 'anh@gmail.com', '0123456789', NULL, NULL, '2021-05-25', 1, 1),
(8, 'phuc', '$2y$10$MEWMVCO6Oy3eNSoxfoU02uiKymJdy8M8nkKf0bFfnxzmsFm2Q.M9W', 'Phan Huỳnh Phúc', 'abc123', 'phuc@gmail.com', '0123456789', NULL, NULL, '2021-05-25', 1, 1),
(9, 'long', '$2y$10$WdChKAS/jy5EMBZDkecYzO1JkGBa3Nc.3bIl5F/BKlNjiLPqrbMZa', 'Nguyễn Thăng Long', 'abc123', 'long@gmail.com', '0123456789', NULL, NULL, '2021-05-25', 1, 1),
(12, 'guess', '$2y$10$lHEiweyoJhvL5uzCqrlyOOATRAJb8BXR7EP4LWONDOEFBSQ4aKtxS', 'test', 'abc123', '123@gmail.com', '0123456789', NULL, NULL, '2021-05-28', 0, 1),
(14, 'Pihe', '$2y$10$1OMO4eAz7qGSF9dfg4GHdeykMvGm/Rq93yNkfytDPN5.QsMCEoEPa', 'Barron Allen', 'Earth', 'dapamu333@gmail.com', '069696969', NULL, NULL, '2021-05-28', 1, 1),
(17, 'test', '$2y$10$lj/tKt0pdWRXgb7diwORbuPGFmG5ij3LBC/7x5ISSJ5EVRK8x.3IG', 'abc', 'abc', 'a@bbc', '1234567890bc', 'What was your childhood name', 'false', '2021-05-28', 0, 1),
(18, 'user123', '$2y$10$MoiYPEV7QC8QPGYwq2/EK.I0PWKNVKpgihjr8lBwt8DvGyNI55G9y', NULL, NULL, NULL, NULL, 'What was your childhood name', 'sa', '2022-03-14', 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ProductImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Quantity` int(11) NOT NULL,
  `MaxQuantity` int(11) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`ID`, `UserID`, `ProductID`, `ProductName`, `ProductImage`, `Quantity`, `MaxQuantity`, `Price`) VALUES
(31, 14, 16, 'ASUS ROG Strix SCAR 17 G733', 'asusrogstrixscar17g733.png', 6, 20, 449940000),
(40, 3, 16, 'ASUS ROG Strix SCAR 17 G733', 'asusrogstrixscar17g733.png', 1, 18, 74990000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `favorite`
--

CREATE TABLE `favorite` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `CreatedDay` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `favorite`
--

INSERT INTO `favorite` (`ID`, `UserID`, `ProductID`, `CreatedDay`) VALUES
(4, 1, 16, '2021-05-15'),
(5, 1, 18, '2021-05-21'),
(6, 1, 30, '2021-06-20'),
(7, 13, 15, '2021-06-20'),
(8, 6, 16, '2021-06-20'),
(9, 3, 19, '2021-06-23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback`
--

CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` varchar(500) NOT NULL,
  `Response` tinyint(4) NOT NULL,
  `CreatedDay` date NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `feedback`
--

INSERT INTO `feedback` (`ID`, `UserID`, `Name`, `Email`, `Phone`, `Title`, `Content`, `Response`, `CreatedDay`, `Status`) VALUES
(1, 1, 'pihe', 'abc@123', '01234', 'test1', 'kiem tra^tra loi^cau hoi thu 2', 1, '2021-05-10', 1),
(2, 1, 'pihe', 'abc@123', '01234', 'test2', 'aaa^bbb^ccc', 1, '2021-05-11', 0),
(3, 1, 'ti', 'ti@123hehe', '01234', 'test', 'test^hihi^test1', 0, '2021-05-12', 1),
(5, 3, 'user', 'dapamu333@gmail.com', '0123', 'utesst', 'Chao ban, minh can giup do^Van ban co van de gi a^Loi trang roi nha ban', 1, '2021-05-15', 0),
(7, 3, 'user', 'dapamu333@gmail.com', '0123', 'test phan hoi', 'hello^hihi^hello^hihi^hello^hihi^hello^hihi^hello^hihi^hello^hihi^hello^hihi', 0, '2021-05-15', 0),
(8, 3, 'user', 'dapamu333@gmail.com', '0123', 'title 1', 'content 1^....', 0, '2021-05-16', 0),
(14, 1, 'a', 'ád@gmail.com', 'ádsad', 'áda', 'hello ha^? :))', 0, '2021-05-25', 0),
(15, 12, 'guess', 'guess@gamil.com', '123', 'Iphone ', 'Lỗi trang ^Dạ vâng, em đã nhận thông tin và sẽ khắc phục sớm nhất. Xin chân thành bạn đã phản hồi về cho chúng tôi. Chúc bạn một ngày mới tốt lành.', 0, '2021-05-26', 1),
(17, 3, 'bc', 'lechinhtue292001@gmail.com', '123', 'title 1', 'aaaa', 1, '2021-05-27', 1),
(18, 1, 'Barron Allen', 'Abc123@gmail.com', '0123456789', 'Test report', 'Just test report^hehe', 0, '2021-05-28', 1),
(20, 3, 'phuc', 'phucphan785@gmail.com', '0977840000', 'test contact', '280 An Dương Vương, Phường 4, Quận 8, TP.Hồ Chí Minh\n01234567892', 1, '2021-06-20', 0),
(21, 3, 'test', 'a@A', '123', 'test', 'aaaaaa', 1, '2021-06-21', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetail`
--

CREATE TABLE `orderdetail` (
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orderdetail`
--

INSERT INTO `orderdetail` (`OrderID`, `ProductID`, `Quantity`, `Price`) VALUES
(2, 7, 1, 9990000),
(3, 16, 2, 74990000),
(3, 17, 1, 109990000),
(4, 4, 2, 15790000),
(4, 15, 1, 32990000),
(5, 16, 1, 74990000),
(7, 19, 2, 20990000),
(8, 16, 1, 74990000),
(8, 19, 1, 20990000),
(9, 11, 3, 49910000),
(9, 18, 7, 38990000),
(10, 11, 3, 49910000),
(10, 16, 4, 74990000),
(10, 18, 7, 38990000),
(11, 6, 4, 18290000),
(11, 16, 14, 74990000),
(12, 14, 5, 11900000),
(13, 17, 1, 109990000),
(14, 16, 1, 74990000),
(15, 17, 1, 109990000),
(17, 16, 3, 224970000),
(17, 19, 1, 20990000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `CustomerPhone` varchar(255) NOT NULL,
  `CustomerAddress` varchar(255) NOT NULL,
  `CustomerEmail` varchar(255) NOT NULL,
  `CreatedDay` date NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`ID`, `CustomerID`, `CustomerName`, `CustomerPhone`, `CustomerAddress`, `CustomerEmail`, `CreatedDay`, `Status`) VALUES
(2, 1, 'tue', '01234', 'viet nam', 'abc@gmail.com', '2021-05-17', 1),
(3, 3, 'user', '01234', 'earth', 'abc@gmail.com', '2021-05-17', 1),
(5, 1, 'abc', 'dfg', 'fdgfdgdfg', 'dfg@gmail.com', '2021-05-18', 1),
(7, 12, 'user buy laptop', '123', '280 an duong vuong', 'adv@gmail.con', '2021-05-18', 1),
(8, 12, 'Tue', '123', 'tue', 'tue@gmail.com', '2021-05-18', 1),
(9, 1, 'Pihe', '01234', 'Earth', 'Abc@gmail.com', '2021-05-20', 0),
(10, 1, 'Pihe', '01234', 'Earth', 'Abc@gmail.com', '2021-05-22', 0),
(11, 1, 'Tue', '0123456789', 'Earth', 'dapamu333@gmail.com', '2021-05-27', 0),
(12, 1, 'Tue', '0123456789', 'Earth', 'dapamu333@gmail.com', '2021-05-28', 0),
(13, 13, 'Tt', '22', 'Tyy', 'Tt@gmail.com', '2021-06-20', 1),
(14, 6, 'ngan', '0965044975', 'abc', 'cnkimngan@gmail.com', '2021-06-20', 1),
(15, 13, 'buy test', '123', '123abc', '123a@gmail.com', '2021-06-21', 1),
(17, 1, 'tesst', '1234567890', 'tesst', 'tesst@gmail.com', '2021-06-26', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `IDCate` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Price` float NOT NULL,
  `Count` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `NewQuantity` int(11) NOT NULL,
  `Warranty` int(11) DEFAULT NULL,
  `View` int(11) NOT NULL,
  `Discount` int(11) DEFAULT NULL,
  `VATFee` int(11) DEFAULT NULL,
  `CreatedDay` date NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`ID`, `ProductName`, `IDCate`, `Description`, `Image`, `Price`, `Count`, `Quantity`, `NewQuantity`, `Warranty`, `View`, `Discount`, `VATFee`, `CreatedDay`, `Status`) VALUES
(1, 'iPhone 7 Plus 32GB Likenew', 1, 'Description mobile 1', 'iphone732gblikenew.png', 5990000, 20, 0, 0, 12, 35, 10, 0, '2021-05-15', 1),
(2, 'iPhone 11 Pro Max 64GB', 1, 'Description mobile 2', 'iphone11promax64gb.png', 22090000, 11, 10, 10, 9, 16, 0, 0, '2021-05-15', 1),
(4, 'Samsung Galaxy S20', 1, 'Description mobile 4', 'samsunggalaxys20.png', 15790000, 10, 10, 10, 21, 15, 0, 0, '2021-05-15', 1),
(5, 'iPhone 11 Pro Max 256GB', 1, 'Description mobile 5', 'iphone11promax256gb.png', 28790000, 20, 20, 20, 15, 21, 14, 0, '2021-05-15', 1),
(6, 'iPhone Xs 256GB', 1, 'Description mobile 6', 'iphonexs256gb.png', 18290000, 11, 10, 10, 13, 11, 0, 0, '2021-05-15', 1),
(7, 'iPad Mini 5 7.9 Wi-Fi 64GB', 2, 'Description tablet 1', 'ipadmini5201964gbwifi.png', 9990000, 21, 20, 20, 4, 20, 0, 0, '2021-05-15', 1),
(8, 'iPad 10.2 2020 Wi-Fi + Cellular 32GB', 2, 'Description tablet 2', 'ipad10-2.png', 12990000, 27, 10, 10, 16, 12, 0, 0, '2021-05-15', 1),
(10, 'iPad Air 10.9 2020 Wi-Fi 64GB', 2, 'Description tablet 4', 'ipadair10-9.png', 16990000, 10, 25, 25, 5, 20, 0, 0, '2021-05-15', 1),
(11, 'Fujifilm X-T4 Kit XF16-80MM', 3, 'Description camera 1', 'fujifilmkit16-80mm.png', 49910000, 12, 16, 16, 25, 33, 0, 0, '2021-05-15', 1),
(12, 'Canon EOS M6 Mark II Kit 15-45MM', 3, 'Description camera 2', 'canoneosm6mark2kit1545mm.png', 30990000, 13, 24, 24, 13, 19, 0, 0, '2021-05-15', 1),
(13, 'Nikon D750', 3, 'Description camera 3', 'nikond750.png', 29500000, 10, 16, 16, 11, 11, 0, 0, '2021-05-15', 1),
(14, 'Olympus Stylus Tough TG-6', 3, 'Description camera 4', 'olympustylus.png', 11900000, 14, 12, 12, 22, 19, 0, 0, '2021-05-15', 1),
(15, 'ASUS TUF Gaming A15 2021', 4, 'Description laptop 1', 'asustufgaminga152021.png', 32990000, 24, 37, 37, 1, 23, 0, 0, '2021-05-15', 1),
(16, 'ASUS ROG Strix SCAR 17 G733', 4, 'Description laptop 2', 'asusrogstrixscar17g733.png', 74990000, 54, 18, 20, 24, 91, 12, 0, '2021-05-15', 1),
(17, 'MSI GE76 Raider Series', 4, 'Description laptop 3', 'msige76raider.png', 109990000, 26, 50, 52, 14, 42, 0, 0, '2021-05-15', 1),
(18, 'Dell Gaming G7 15 7500', 4, 'Description laptop 4', 'dellgamingg7157500.png', 38990000, 38, 22, 22, 11, 42, 0, 0, '2021-05-15', 1),
(19, 'Acer Nitro 5 2020', 4, 'Descripton Laptop 5', 'acernitro5.png', 20990000, 57, 18, 18, 6, 63, 0, 0, '2021-05-15', 1),
(20, 'Samsung Galaxy Note 10 Plus', 1, 'Description 3', 'samsunggalaxynote10plus.png', 7000000, 50, 20, 20, 13, 54, 13, 0, '2021-05-16', 1),
(21, 'Laptop Lenovo IdeaPad S145 15IIL i3 1005G1', 4, 'description', 'lenovo-ideapad-s145-15iil-i3-1005g1-4gb-256gb-win1-2-org-removebg-preview.png', 11490000, 0, 50, 50, 12, 2, 0, 0, '2021-05-16', 1),
(22, 'Laptop Acer Aspire 7 A715 75G 52S5', 4, 'description', 'acer-aspire-7-a715-75g-52s5-i5-nhq85sv002-2-org-removebg-preview.png', 21990000, 0, 50, 50, 12, 2, 0, 0, '2021-05-16', 1),
(23, 'Laptop MSI GF63 10SC', 4, 'description', 'msi-gf63-10sc-i5-255vn--2-org-removebg.png', 20990000, 0, 50, 50, 12, 3, 0, 0, '2021-05-16', 1),
(24, 'Máy tính bảng Huawei MatePad', 2, 'description', 'huawei-matepad-1-org-removebg-preview.png', 6790000, 0, 50, 50, 12, 0, 5, 0, '2021-05-16', 1),
(25, 'Máy tính bảng Samsung Galaxy Tab A8', 2, 'description', 'samsung-galaxy-tab-a8-t295-2019-bac-1-org-removebg-preview.png', 3900000, 0, 50, 50, 12, 3, 5, 0, '2021-05-16', 1),
(26, 'Máy tính bảng Lenovo Tab M10', 2, 'description', 'lenovo-tab-m10-white-1020x680-org-removebg-preview.png', 3690000, 0, 50, 50, 12, 1, 10, 0, '2021-05-16', 1),
(27, 'Máy tính bảng Lenovo Tab E7', 2, 'description', 'lenovo-tab-e7-tb-7104i-den-1-org-removebg-preview.png', 1990000, 0, 50, 50, 12, 5, 20, 0, '2021-05-16', 1),
(28, 'Máy tính bảng Masstel Tab8 Pro', 2, 'description', 'masstel-tab8-pro-xanh-1-org-removebg-preview.png', 2090000, 0, 50, 50, 12, 2, 5, 0, '2021-05-16', 1),
(29, 'Laptop HP 340s G7', 4, 'description', 'hp-340s-g7-i3-240q4pa-2-1-org-removebg-preview.png', 12900000, 0, 50, 50, 12, 0, 0, 0, '2021-05-16', 1),
(30, 'Laptop HP ProBook 440 G8', 4, 'description', 'hp-probook-440-g8-i3-2h0r6pa-2-org-removebg-preview.png', 14090000, 0, 50, 50, 12, 1, 0, 0, '2021-05-16', 1),
(31, 'Điện thoại Xiaomi Redmi 9T', 1, 'description', 'xiaomi-redmi-9t-xanh-la-1-org-removebg-preview.png', 3990000, 0, 50, 50, 18, 0, 0, 0, '2021-05-16', 1),
(32, 'Điện thoại Samsung Galaxy A32 ', 1, 'description', 'samsung-galaxy-a32-4g-xanh-1-org-removebg-preview.png', 6690000, 0, 50, 50, 18, 1, 0, 0, '2021-05-16', 1),
(33, 'Điện thoại Samsung Galaxy A70', 1, 'description', 'samsung-galaxy-a70-xanh-duong-1-org-removebg-preview.png', 7290000, 0, 50, 50, 12, 0, 0, 0, '2021-05-16', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `productcategory`
--

CREATE TABLE `productcategory` (
  `ID` int(11) NOT NULL,
  `CateName` varchar(255) NOT NULL,
  `DisplayOrder` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `productcategory`
--

INSERT INTO `productcategory` (`ID`, `CateName`, `DisplayOrder`, `Status`) VALUES
(1, 'Mobiles', 1, 1),
(2, 'Tablets', 2, 1),
(3, 'Cameras', 3, 1),
(4, 'Laptops', 4, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `productcategory`
--
ALTER TABLE `productcategory`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account`
--
ALTER TABLE `account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `favorite`
--
ALTER TABLE `favorite`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `productcategory`
--
ALTER TABLE `productcategory`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
