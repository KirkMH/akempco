-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 01, 2016 at 08:29 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `akempcodb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_UOM`
--

CREATE TABLE IF NOT EXISTS `tbl_UOM` (
  `uom_no` int(11) NOT NULL AUTO_INCREMENT,
  `uom_name` varchar(50) NOT NULL,
  `uom_desc` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`uom_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audittrail`
--

CREATE TABLE IF NOT EXISTS `tbl_audittrail` (
  `at_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `action` text NOT NULL,
  `reference` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `user_no` int(11) NOT NULL,
  PRIMARY KEY (`at_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bo`
--

CREATE TABLE IF NOT EXISTS `tbl_bo` (
  `bo_no` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` text NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`bo_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_creditpayment`
--

CREATE TABLE IF NOT EXISTS `tbl_creditpayment` (
  `cp_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_type` varchar(1) NOT NULL,
  `customer_no` bigint(20) NOT NULL,
  `paid` double(10,2) NOT NULL,
  `payDate` date NOT NULL,
  `ref_no` varchar(25) NOT NULL,
  PRIMARY KEY (`cp_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `cust_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `cust_type` text NOT NULL,
  `cust_name` text NOT NULL,
  `id_no` int(11) NOT NULL,
  `SI_no` int(11) NOT NULL,
  `discount_amount` int(11) NOT NULL,
  PRIMARY KEY (`cust_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE IF NOT EXISTS `tbl_department` (
  `dept_no` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(50) NOT NULL,
  `dept_desc` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`dept_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discount`
--

CREATE TABLE IF NOT EXISTS `tbl_discount` (
  `disc_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `disc_description` text NOT NULL,
  `percentage` double(5,4) NOT NULL,
  `lessVAT` tinyint(1) NOT NULL COMMENT 'deduct from total first',
  `active` tinyint(1) NOT NULL,
  `user_no` int(11) NOT NULL,
  PRIMARY KEY (`disc_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_giftcert`
--

CREATE TABLE IF NOT EXISTS `tbl_giftcert` (
  `gc_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(100) NOT NULL,
  `con_no` bigint(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `source` varchar(50) NOT NULL,
  `genDate` varchar(20) NOT NULL,
  `expiryDate` varchar(20) NOT NULL,
  `user_no` int(11) NOT NULL,
  `returned` tinyint(1) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`gc_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groupcredit`
--

CREATE TABLE IF NOT EXISTS `tbl_groupcredit` (
  `group_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_name` text NOT NULL,
  `department` text NOT NULL,
  `headName` text NOT NULL,
  `contact_no` varchar(13) NOT NULL,
  `num_members` int(11) NOT NULL,
  `credit_limit` double(10,2) NOT NULL,
  `charge_total` double(10,2) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`group_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groupmembers`
--

CREATE TABLE IF NOT EXISTS `tbl_groupmembers` (
  `gm_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `group_no` int(11) NOT NULL,
  `gm_name` text NOT NULL,
  `contact_no` int(11) NOT NULL,
  PRIMARY KEY (`gm_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE IF NOT EXISTS `tbl_members` (
  `member_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `barcode` bigint(20) unsigned NOT NULL,
  `member_name` text NOT NULL,
  `password` varchar(60) NOT NULL,
  `member_tin` varchar(20) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `member_address` text NOT NULL,
  `dept_no` tinyint(3) NOT NULL,
  `credit_limit` double(10,2) NOT NULL,
  `charge_total` double(10,2) NOT NULL,
  `extra_credit` double(10,2) NOT NULL,
  `member_type` varchar(15) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`member_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_packages`
--

CREATE TABLE IF NOT EXISTS `tbl_packages` (
  `pk_no` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'package number',
  `barcode` text NOT NULL,
  `pk_name` text NOT NULL,
  `spk_name` varchar(30) NOT NULL,
  `num_qty` int(11) NOT NULL,
  `pk_price` double(10,2) NOT NULL,
  PRIMARY KEY (`pk_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `pay_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `SI_no` int(11) NOT NULL,
  `paymentType` text NOT NULL,
  `amount` int(11) NOT NULL,
  `reference_no` varchar(50) NOT NULL,
  PRIMARY KEY (`pay_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `prod_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `barcode` text NOT NULL,
  `prod_name` text NOT NULL,
  `short_name` text NOT NULL,
  `srprice` double(10,2) NOT NULL,
  `numWholesale` smallint(6) NOT NULL,
  `qty_begin` int(11) NOT NULL,
  `actual_count` int(11) NOT NULL,
  `variance` int(11) NOT NULL,
  `qty_delivered` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `package` tinyint(1) NOT NULL,
  PRIMARY KEY (`prod_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productpackage`
--

CREATE TABLE IF NOT EXISTS `tbl_productpackage` (
  `pp_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `pk_no` int(11) NOT NULL,
  `prod_no` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `ucost` int(11) NOT NULL,
  PRIMARY KEY (`pp_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productprice`
--

CREATE TABLE IF NOT EXISTS `tbl_productprice` (
  `pprice_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `prod_no` int(11) NOT NULL,
  `wholeSalePrice` float NOT NULL,
  `retailPrice` float NOT NULL,
  `numWholesale` smallint(6) NOT NULL,
  `uom_no` varchar(25) NOT NULL,
  `sellingPrice` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `d_from` varchar(15) NOT NULL,
  `d_to` varchar(15) NOT NULL,
  `qty_onhand` int(11) NOT NULL,
  `min_stock` int(11) NOT NULL,
  `max_stock` int(11) NOT NULL,
  `active` bit(1) NOT NULL,
  `b_inventory` int(11) NOT NULL COMMENT 'beginning inventory or physical count result',
  PRIMARY KEY (`pprice_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productsupplier`
--

CREATE TABLE IF NOT EXISTS `tbl_productsupplier` (
  `ps_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `sup_no` int(11) NOT NULL,
  `prod_no` int(11) NOT NULL,
  PRIMARY KEY (`ps_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchasedetail`
--

CREATE TABLE IF NOT EXISTS `tbl_purchasedetail` (
  `pd_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `purchase_id` bigint(20) NOT NULL,
  `prod_no` bigint(20) NOT NULL,
  `qty_delivered` int(11) NOT NULL,
  `supplier_price` double(10,2) NOT NULL,
  `retail_price` double(10,2) NOT NULL,
  `wholesale_price` double(10,2) NOT NULL,
  `qty_onhand` int(11) NOT NULL,
  PRIMARY KEY (`pd_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchases`
--

CREATE TABLE IF NOT EXISTS `tbl_purchases` (
  `purchase_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sup_no` int(11) NOT NULL,
  `ref_no` varchar(15) NOT NULL,
  `invoice_date` date NOT NULL,
  `user_no` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE IF NOT EXISTS `tbl_sales` (
  `SI_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `num_items` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `taxable` int(11) NOT NULL,
  `sales_tax` int(11) NOT NULL,
  `sales_taxExempt` int(11) NOT NULL,
  `zero_rated` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `discount_type` int(11) NOT NULL,
  `discount_amount` int(11) NOT NULL,
  `customer_type` varchar(1) NOT NULL,
  `customer_no` int(11) NOT NULL,
  `cancelled` bit(1) NOT NULL,
  `cancel_datetime` datetime NOT NULL,
  PRIMARY KEY (`SI_no`),
  UNIQUE KEY `SI_no` (`SI_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `setting_no` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(50) NOT NULL,
  `setting_value` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  PRIMARY KEY (`setting_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soldproducts`
--

CREATE TABLE IF NOT EXISTS `tbl_soldproducts` (
  `sp_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `SI_no` int(11) NOT NULL,
  `prod_no` int(11) NOT NULL COMMENT 'PK to tbl_productprice',
  `uom` char(1) NOT NULL,
  `qty` int(11) NOT NULL,
  `uprice` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`sp_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE IF NOT EXISTS `tbl_supplier` (
  `sup_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `barcode` int(50) NOT NULL,
  `sup_name` text NOT NULL,
  `sup_address` text NOT NULL,
  `TIN` varchar(20) NOT NULL,
  `bus_type` text NOT NULL,
  `tax_type` text NOT NULL,
  `contact_person` text NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `discount` double(10,4) NOT NULL,
  `active` bit(1) NOT NULL,
  PRIMARY KEY (`sup_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uom`
--

CREATE TABLE IF NOT EXISTS `tbl_uom` (
  `uom_no` int(11) NOT NULL AUTO_INCREMENT,
  `uom_name` varchar(50) NOT NULL,
  `uom_desc` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`uom_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_useracct`
--

CREATE TABLE IF NOT EXISTS `tbl_useracct` (
  `user_no` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `fullname` text NOT NULL,
  `role` varchar(30) NOT NULL,
  `accessLevel` int(11) NOT NULL,
  `override` bit(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
