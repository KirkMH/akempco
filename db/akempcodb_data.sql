-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2026 at 05:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akempcodb`
--
CREATE DATABASE IF NOT EXISTS `akempcodb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `akempcodb`;

-- --------------------------------------------------------

--
-- Table structure for table `audit_tbl`
--

CREATE TABLE `audit_tbl` (
  `audit_no` bigint(20) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `table_name` varchar(25) DEFAULT NULL,
  `fieldspec` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_supplier_price`
-- (See below for the actual view)
--
CREATE TABLE `product_supplier_price` (
`barcode` varchar(200)
,`prod_name` text
,`supplier_name` text
,`latest_cost` double(10,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_2_product`
--

CREATE TABLE `tbl_2_product` (
  `prod_no` bigint(20) NOT NULL,
  `barcode` varchar(200) DEFAULT NULL,
  `prod_name` text DEFAULT NULL,
  `short_name` text DEFAULT NULL,
  `srprice` double(10,2) DEFAULT 0.00,
  `numWholesale` smallint(6) DEFAULT 0,
  `qty_begin` int(11) DEFAULT 0,
  `actual_count` int(11) DEFAULT 0,
  `variance` int(11) DEFAULT 0,
  `qty_delivered` int(11) DEFAULT 0,
  `qty_sold` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) DEFAULT 0,
  `package` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_2_productsupplier`
--

CREATE TABLE `tbl_2_productsupplier` (
  `ps_no` bigint(20) NOT NULL,
  `sup_no` int(11) DEFAULT 0,
  `prod_no` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_2_purchasedetail`
--

CREATE TABLE `tbl_2_purchasedetail` (
  `pd_id` bigint(20) NOT NULL,
  `purchase_id` bigint(20) DEFAULT 0,
  `prod_no` bigint(20) DEFAULT 0,
  `qty_delivered` int(11) DEFAULT 0,
  `supplier_price` double(10,2) DEFAULT 0.00,
  `retail_price` double(10,2) DEFAULT 0.00,
  `wholesale_price` double(10,2) DEFAULT 0.00,
  `qty_onhand` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_2_purchases`
--

CREATE TABLE `tbl_2_purchases` (
  `purchase_id` bigint(20) NOT NULL,
  `sup_no` int(11) DEFAULT 0,
  `ref_no` varchar(15) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `user_no` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_2_supplier`
--

CREATE TABLE `tbl_2_supplier` (
  `sup_no` bigint(20) NOT NULL,
  `barcode` int(50) DEFAULT 0,
  `sup_name` text DEFAULT NULL,
  `sup_address` text DEFAULT NULL,
  `TIN` varchar(20) DEFAULT NULL,
  `bus_type` text DEFAULT NULL,
  `tax_type` text DEFAULT NULL,
  `contact_person` text DEFAULT NULL,
  `contact_no` text DEFAULT NULL,
  `discount` double DEFAULT 0,
  `active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_24oct20purchasedetail`
--

CREATE TABLE `tbl_24oct20purchasedetail` (
  `pd_id` bigint(20) NOT NULL,
  `purchase_id` bigint(20) DEFAULT 0,
  `prod_no` bigint(20) DEFAULT 0,
  `qty_delivered` int(11) DEFAULT 0,
  `supplier_price` double(10,2) DEFAULT 0.00,
  `retail_price` double(10,2) DEFAULT 0.00,
  `wholesale_price` double(10,2) DEFAULT 0.00,
  `qty_onhand` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_audittrail`
--

CREATE TABLE `tbl_audittrail` (
  `at_no` bigint(20) NOT NULL,
  `action` text NOT NULL,
  `reference` text NOT NULL,
  `timestamp` datetime NOT NULL,
  `user_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bo`
--

CREATE TABLE `tbl_bo` (
  `bo_no` int(11) NOT NULL,
  `barcode` text DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `sup_no` bigint(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_creditpayment`
--

CREATE TABLE `tbl_creditpayment` (
  `cp_no` bigint(20) NOT NULL,
  `customer_type` varchar(1) NOT NULL,
  `customer_no` bigint(20) NOT NULL,
  `paid` double(10,2) NOT NULL,
  `payDate` date NOT NULL,
  `ref_no` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cust_no` bigint(20) NOT NULL,
  `cust_type` text NOT NULL,
  `cust_name` text NOT NULL,
  `id_no` int(11) NOT NULL,
  `SI_no` int(11) NOT NULL,
  `discount_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `dept_no` int(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_desc` text NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discount`
--

CREATE TABLE `tbl_discount` (
  `disc_no` bigint(20) NOT NULL,
  `disc_description` text DEFAULT NULL,
  `percentage` double(5,4) DEFAULT 0.0000,
  `lessVAT` tinyint(1) DEFAULT 0 COMMENT 'deduct from total first',
  `active` tinyint(1) DEFAULT 1,
  `user_no` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_giftcert`
--

CREATE TABLE `tbl_giftcert` (
  `gc_no` bigint(20) NOT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `con_no` bigint(11) DEFAULT NULL,
  `amount` double(10,2) DEFAULT 0.00,
  `source` varchar(50) DEFAULT NULL,
  `regDate` varchar(20) DEFAULT NULL,
  `expiryDate` varchar(20) DEFAULT NULL,
  `user_no` int(11) DEFAULT 0,
  `returned` tinyint(1) DEFAULT 0,
  `active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groupcredit`
--

CREATE TABLE `tbl_groupcredit` (
  `group_no` bigint(20) NOT NULL,
  `group_name` text DEFAULT NULL,
  `department` text DEFAULT NULL,
  `headName` text DEFAULT NULL,
  `contact_no` varchar(13) DEFAULT NULL,
  `num_members` int(11) DEFAULT NULL,
  `credit_limit` double(10,2) DEFAULT 0.00,
  `charge_total` double(10,2) DEFAULT 0.00,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groupmembers`
--

CREATE TABLE `tbl_groupmembers` (
  `gm_no` bigint(20) NOT NULL,
  `group_no` int(11) DEFAULT NULL,
  `gm_name` text DEFAULT NULL,
  `contact_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inventorycount`
--

CREATE TABLE `tbl_inventorycount` (
  `ic_no` bigint(20) NOT NULL,
  `dmonth` int(11) NOT NULL DEFAULT 0,
  `dyear` int(11) NOT NULL DEFAULT 0,
  `prod_no` bigint(20) NOT NULL DEFAULT 0,
  `prod_name` text DEFAULT NULL,
  `short_name` varchar(20) DEFAULT NULL,
  `on_hand` int(11) NOT NULL DEFAULT 0,
  `actual` int(11) NOT NULL DEFAULT 0,
  `variance` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `member_no` bigint(20) NOT NULL,
  `barcode` bigint(20) UNSIGNED DEFAULT NULL,
  `member_name` text DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `member_tin` varchar(20) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `member_address` text DEFAULT NULL,
  `dept_no` tinyint(3) DEFAULT NULL,
  `credit_limit` double(10,2) DEFAULT 0.00,
  `charge_total` double(10,2) DEFAULT 0.00,
  `extra_credit` double(10,2) DEFAULT 0.00,
  `member_type` varchar(15) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_packages`
--

CREATE TABLE `tbl_packages` (
  `pk_no` bigint(20) NOT NULL COMMENT 'package number',
  `barcode` text DEFAULT NULL,
  `pk_name` text DEFAULT NULL,
  `spk_name` varchar(30) DEFAULT NULL,
  `num_qty` int(11) DEFAULT NULL,
  `pk_price` double(10,2) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `pay_no` bigint(20) NOT NULL,
  `SI_no` int(11) DEFAULT NULL,
  `paymentType` text DEFAULT NULL,
  `amount` double(10,2) DEFAULT 0.00,
  `reference_no` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `prod_no` bigint(20) NOT NULL,
  `barcode` varchar(200) DEFAULT NULL,
  `prod_name` text DEFAULT NULL,
  `short_name` text DEFAULT NULL,
  `srprice` double(10,2) DEFAULT 0.00,
  `numWholesale` smallint(6) DEFAULT 0,
  `qty_begin` int(11) DEFAULT 0,
  `actual_count` int(11) DEFAULT 0,
  `variance` int(11) DEFAULT 0,
  `qty_delivered` int(11) DEFAULT 0,
  `qty_sold` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) DEFAULT 0,
  `package` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productpackage`
--

CREATE TABLE `tbl_productpackage` (
  `pp_no` bigint(20) NOT NULL,
  `pk_no` int(11) DEFAULT 0,
  `prod_no` bigint(20) DEFAULT 0,
  `qty` int(11) DEFAULT 0,
  `ucost` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productprice`
--

CREATE TABLE `tbl_productprice` (
  `pprice_no` bigint(20) NOT NULL,
  `prod_no` int(11) DEFAULT NULL,
  `wholeSalePrice` float DEFAULT NULL,
  `retailPrice` float DEFAULT NULL,
  `numWholesale` smallint(6) DEFAULT NULL,
  `uom_no` varchar(25) DEFAULT NULL,
  `sellingPrice` decimal(10,2) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `d_from` varchar(15) DEFAULT NULL,
  `d_to` varchar(15) DEFAULT NULL,
  `qty_onhand` int(11) DEFAULT NULL,
  `min_stock` int(11) DEFAULT NULL,
  `max_stock` int(11) DEFAULT NULL,
  `active` bit(1) DEFAULT NULL,
  `b_inventory` int(11) DEFAULT NULL COMMENT 'beginning inventory or physical count result'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productsupplier`
--

CREATE TABLE `tbl_productsupplier` (
  `ps_no` bigint(20) NOT NULL,
  `sup_no` int(11) DEFAULT 0,
  `prod_no` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchasedetail`
--

CREATE TABLE `tbl_purchasedetail` (
  `pd_id` bigint(20) NOT NULL,
  `purchase_id` bigint(20) DEFAULT 0,
  `prod_no` bigint(20) DEFAULT 0,
  `qty_delivered` int(11) DEFAULT 0,
  `supplier_price` double(10,2) DEFAULT 0.00,
  `retail_price` double(10,2) DEFAULT 0.00,
  `wholesale_price` double(10,2) DEFAULT 0.00,
  `qty_onhand` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchasedetail_21nov24`
--

CREATE TABLE `tbl_purchasedetail_21nov24` (
  `pd_id` bigint(20) NOT NULL,
  `purchase_id` bigint(20) DEFAULT 0,
  `prod_no` bigint(20) DEFAULT 0,
  `qty_delivered` int(11) DEFAULT 0,
  `supplier_price` double(10,2) DEFAULT 0.00,
  `retail_price` double(10,2) DEFAULT 0.00,
  `wholesale_price` double(10,2) DEFAULT 0.00,
  `qty_onhand` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchases`
--

CREATE TABLE `tbl_purchases` (
  `purchase_id` bigint(20) NOT NULL,
  `sup_no` int(11) DEFAULT 0,
  `ref_no` varchar(15) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `user_no` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales`
--

CREATE TABLE `tbl_sales` (
  `SI_no` bigint(20) NOT NULL,
  `num_items` int(11) DEFAULT 0,
  `grand_total` double(10,2) DEFAULT 0.00,
  `tendered` double(10,2) NOT NULL DEFAULT 0.00,
  `taxable` double(10,2) DEFAULT 0.00,
  `sales_tax` double(10,2) DEFAULT 0.00,
  `sales_taxExempt` double(10,2) DEFAULT 0.00,
  `zero_rated` double(10,2) DEFAULT 0.00,
  `timestamp` datetime DEFAULT current_timestamp(),
  `discount_type` int(11) DEFAULT 0,
  `discount_amount` double(10,2) DEFAULT 0.00,
  `customer_type` varchar(1) DEFAULT '0',
  `customer_no` int(11) DEFAULT 0,
  `cancelled` tinyint(1) DEFAULT 0,
  `cancel_datetime` datetime DEFAULT current_timestamp(),
  `cash_change` double(10,2) NOT NULL DEFAULT 0.00,
  `payment_info` text DEFAULT NULL,
  `cashier` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `setting_no` int(11) NOT NULL,
  `setting_name` varchar(50) DEFAULT NULL,
  `setting_value` varchar(50) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soldproducts`
--

CREATE TABLE `tbl_soldproducts` (
  `sp_no` bigint(20) NOT NULL,
  `SI_no` int(11) DEFAULT NULL,
  `prod_no` int(11) DEFAULT NULL COMMENT 'PK to tbl_productprice',
  `uom` char(1) DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  `uprice` double(10,2) DEFAULT 0.00,
  `discount` double(10,2) DEFAULT 0.00,
  `num_wholesale` int(11) NOT NULL DEFAULT 0 COMMENT 'if wholesale, how many retail items are included'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `sup_no` bigint(20) NOT NULL,
  `barcode` int(50) DEFAULT 0,
  `sup_name` text DEFAULT NULL,
  `sup_address` text DEFAULT NULL,
  `TIN` varchar(20) DEFAULT NULL,
  `bus_type` text DEFAULT NULL,
  `tax_type` text DEFAULT NULL,
  `contact_person` text DEFAULT NULL,
  `contact_no` text DEFAULT NULL,
  `discount` double DEFAULT 0,
  `active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uom`
--

CREATE TABLE `tbl_uom` (
  `uom_no` int(11) NOT NULL,
  `uom_name` varchar(50) DEFAULT NULL,
  `uom_desc` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_useracct`
--

CREATE TABLE `tbl_useracct` (
  `user_no` bigint(20) NOT NULL,
  `username` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `fullname` text DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `accessLevel` int(11) DEFAULT NULL,
  `override` tinyint(1) DEFAULT 0,
  `active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test123`
--

CREATE TABLE `test123` (
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `update_21nov24_withnumwholesale`
-- (See below for the actual view)
--
CREATE TABLE `update_21nov24_withnumwholesale` (
`pd_id` bigint(20)
,`purchase_id` bigint(20)
,`prod_no` bigint(20)
,`qty_delivered` int(11)
,`supplier_price` double(10,2)
,`retail_price` double(10,2)
,`wholesale_price` double(10,2)
,`qty_onhand` int(11)
,`numWholesale` smallint(6)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `update_nov24_exempted_prod`
-- (See below for the actual view)
--
CREATE TABLE `update_nov24_exempted_prod` (
`prod_no` bigint(20)
,`barcode` varchar(200)
,`prod_name` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `update_nov24_non_vat_prod`
-- (See below for the actual view)
--
CREATE TABLE `update_nov24_non_vat_prod` (
`prod_no` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_bo`
-- (See below for the actual view)
--
CREATE TABLE `view_bo` (
`prod_no` bigint(20)
,`bo_qty` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_charge_payments`
-- (See below for the actual view)
--
CREATE TABLE `view_charge_payments` (
`SI_no` bigint(20)
,`customer_no` int(11)
,`customer_type` varchar(1)
,`paymentType` text
,`amount` double(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_delivered`
-- (See below for the actual view)
--
CREATE TABLE `view_delivered` (
`prod_no` bigint(20)
,`delivered` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_member_balances`
-- (See below for the actual view)
--
CREATE TABLE `view_member_balances` (
`member_no` bigint(20)
,`barcode` bigint(20) unsigned
,`member_name` text
,`total_charge` double(19,2)
,`total_payment` double(19,2)
,`balance` double(19,2)
,`credit_limit` double(10,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_member_charges`
-- (See below for the actual view)
--
CREATE TABLE `view_member_charges` (
`customer_no` int(11)
,`customer_type` varchar(1)
,`total_charge` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_member_credit_balances`
-- (See below for the actual view)
--
CREATE TABLE `view_member_credit_balances` (
`member_no` bigint(20)
,`barcode` bigint(20) unsigned
,`member_name` text
,`total_charge` double(19,2)
,`total_payment` double(19,2)
,`balance` double(19,2)
,`credit_limit` double(10,2)
,`credit_balance` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_member_payments`
-- (See below for the actual view)
--
CREATE TABLE `view_member_payments` (
`customer_no` bigint(20)
,`total_payment` double(19,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_purchases`
-- (See below for the actual view)
--
CREATE TABLE `view_purchases` (
`pd_id` bigint(20)
,`prod_no` bigint(20)
,`barcode` varchar(200)
,`prod_name` text
,`qty_delivered` int(11)
,`supplier_price` double(10,2)
,`retail_price` double(10,2)
,`wholesale_price` double(10,2)
,`qty_onhand` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_sold`
-- (See below for the actual view)
--
CREATE TABLE `view_sold` (
`prod_no` int(11)
,`sold_qty` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_stockonhand`
-- (See below for the actual view)
--
CREATE TABLE `view_stockonhand` (
`prod_no` bigint(20)
,`delivered` decimal(32,0)
,`sold_qty` decimal(32,0)
,`bo_qty` decimal(41,0)
,`qtyoh` decimal(42,0)
);

-- --------------------------------------------------------

--
-- Structure for view `product_supplier_price`
--
DROP TABLE IF EXISTS `product_supplier_price`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_supplier_price`  AS SELECT `p`.`barcode` AS `barcode`, trim(`p`.`prod_name`) AS `prod_name`, `s`.`sup_name` AS `supplier_name`, `pd`.`supplier_price` AS `latest_cost` FROM ((((`tbl_product` `p` join `tbl_purchasedetail` `pd` on(`p`.`prod_no` = `pd`.`prod_no`)) join `tbl_purchases` `pur` on(`pd`.`purchase_id` = `pur`.`purchase_id`)) join `tbl_supplier` `s` on(`pur`.`sup_no` = `s`.`sup_no`)) left join `tbl_purchasedetail` `pd2` on(`pd`.`prod_no` = `pd2`.`prod_no` and `pd`.`purchase_id` < `pd2`.`purchase_id`)) WHERE `p`.`active` = 1 AND `pd2`.`purchase_id` is null ORDER BY trim(`p`.`prod_name`) ASC ;

-- --------------------------------------------------------

--
-- Structure for view `update_21nov24_withnumwholesale`
--
DROP TABLE IF EXISTS `update_21nov24_withnumwholesale`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `update_21nov24_withnumwholesale`  AS SELECT `tbl_purchasedetail`.`pd_id` AS `pd_id`, `tbl_purchasedetail`.`purchase_id` AS `purchase_id`, `tbl_purchasedetail`.`prod_no` AS `prod_no`, `tbl_purchasedetail`.`qty_delivered` AS `qty_delivered`, `tbl_purchasedetail`.`supplier_price` AS `supplier_price`, `tbl_purchasedetail`.`retail_price` AS `retail_price`, `tbl_purchasedetail`.`wholesale_price` AS `wholesale_price`, `tbl_purchasedetail`.`qty_onhand` AS `qty_onhand`, `tbl_product`.`numWholesale` AS `numWholesale` FROM (`tbl_purchasedetail` join `tbl_product` on(`tbl_purchasedetail`.`prod_no` = `tbl_product`.`prod_no`)) ;

-- --------------------------------------------------------

--
-- Structure for view `update_nov24_exempted_prod`
--
DROP TABLE IF EXISTS `update_nov24_exempted_prod`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `update_nov24_exempted_prod`  AS SELECT `tbl_product`.`prod_no` AS `prod_no`, `tbl_product`.`barcode` AS `barcode`, `tbl_product`.`prod_name` AS `prod_name` FROM `tbl_product` WHERE `tbl_product`.`barcode` in ('559','560','561','562','563','4806519460061','4806519460177','4806519460092','4806519460108','4806519460351','4806519460559','4806520639944','4806520638268','4806520639975','4806520639661','48041867','4806520636646','48041973','4806520631979','4806520634321','4806520634291','4806520638244','4806520631177','4806519308967','4806519308974','4806519309018','4806519308981','4806519309643','200','201','4806519309537','4806519309438','48041973','4806519308981','48041867','4806520631665','4806520636271','4806520634208','4806520636875','48042116','475','448','475','407','350','405','351','395','52','326','54','61','81','167','69','558','487','349','549','488','347','6921434400201','6921434400195','6921434400218','191','165','166','86','94','93','87','556','522','527','6910181211093','6910181211079','6910181211086','418','434','537','397','4806502720615','4806502720417','4806502720301','4806502721452','4806502725702','4806502720080','4806502725726','4806502726822','4806502725269','4806502721445','4806502725894','4806502720165','4806502721476','453','409','458','398','410','408','567','471','86','477','478','68873658','VAP1404','VAP1088','322','83','82','1234567890','554','555','193','194','195','6945573604207','6900077051926','6900077051940','6945573603699','468') ;

-- --------------------------------------------------------

--
-- Structure for view `update_nov24_non_vat_prod`
--
DROP TABLE IF EXISTS `update_nov24_non_vat_prod`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `update_nov24_non_vat_prod`  AS SELECT `tbl_productsupplier`.`prod_no` AS `prod_no` FROM `tbl_productsupplier` WHERE `tbl_productsupplier`.`sup_no` in (1,24,25,26,28,8,70,11) ;

-- --------------------------------------------------------

--
-- Structure for view `view_bo`
--
DROP TABLE IF EXISTS `view_bo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_bo`  AS SELECT `tbl_product`.`prod_no` AS `prod_no`, sum(`tbl_bo`.`quantity`) AS `bo_qty` FROM (`tbl_bo` join `tbl_product` on(`tbl_bo`.`barcode` = `tbl_product`.`barcode`)) GROUP BY `tbl_product`.`prod_no` ;

-- --------------------------------------------------------

--
-- Structure for view `view_charge_payments`
--
DROP TABLE IF EXISTS `view_charge_payments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_charge_payments`  AS SELECT `tbl_sales`.`SI_no` AS `SI_no`, `tbl_sales`.`customer_no` AS `customer_no`, `tbl_sales`.`customer_type` AS `customer_type`, `tbl_payment`.`paymentType` AS `paymentType`, `tbl_payment`.`amount` AS `amount` FROM (`tbl_sales` join `tbl_payment` on(`tbl_sales`.`SI_no` = `tbl_payment`.`SI_no`)) WHERE `tbl_sales`.`cancelled` = 0 AND `tbl_payment`.`paymentType` = 'Charge' ;

-- --------------------------------------------------------

--
-- Structure for view `view_delivered`
--
DROP TABLE IF EXISTS `view_delivered`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_delivered`  AS SELECT `tbl_purchasedetail`.`prod_no` AS `prod_no`, sum(`tbl_purchasedetail`.`qty_delivered`) AS `delivered` FROM `tbl_purchasedetail` GROUP BY `tbl_purchasedetail`.`prod_no` ;

-- --------------------------------------------------------

--
-- Structure for view `view_member_balances`
--
DROP TABLE IF EXISTS `view_member_balances`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_member_balances`  AS SELECT `tbl_members`.`member_no` AS `member_no`, `tbl_members`.`barcode` AS `barcode`, `tbl_members`.`member_name` AS `member_name`, `view_member_charges`.`total_charge` AS `total_charge`, `view_member_payments`.`total_payment` AS `total_payment`, `view_member_charges`.`total_charge`- `view_member_payments`.`total_payment` AS `balance`, `tbl_members`.`credit_limit` AS `credit_limit` FROM ((`tbl_members` join `view_member_charges` on(`tbl_members`.`member_no` = `view_member_charges`.`customer_no`)) join `view_member_payments` on(`tbl_members`.`member_no` = `view_member_payments`.`customer_no`)) WHERE `tbl_members`.`active` = 1 ORDER BY `tbl_members`.`member_name` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `view_member_charges`
--
DROP TABLE IF EXISTS `view_member_charges`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_member_charges`  AS SELECT `tbl_sales`.`customer_no` AS `customer_no`, `tbl_sales`.`customer_type` AS `customer_type`, sum(`tbl_payment`.`amount`) AS `total_charge` FROM (`tbl_sales` join `tbl_payment` on(`tbl_sales`.`SI_no` = `tbl_payment`.`SI_no`)) WHERE `tbl_sales`.`cancelled` = 0 AND `tbl_payment`.`paymentType` = 'Charge' AND `tbl_sales`.`customer_type` = 'm' GROUP BY `tbl_sales`.`customer_no`, `tbl_sales`.`customer_type` ;

-- --------------------------------------------------------

--
-- Structure for view `view_member_credit_balances`
--
DROP TABLE IF EXISTS `view_member_credit_balances`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_member_credit_balances`  AS SELECT `view_member_balances`.`member_no` AS `member_no`, `view_member_balances`.`barcode` AS `barcode`, `view_member_balances`.`member_name` AS `member_name`, `view_member_balances`.`total_charge` AS `total_charge`, `view_member_balances`.`total_payment` AS `total_payment`, `view_member_balances`.`balance` AS `balance`, `view_member_balances`.`credit_limit` AS `credit_limit`, `view_member_balances`.`credit_limit`- `view_member_balances`.`balance` AS `credit_balance` FROM `view_member_balances` ;

-- --------------------------------------------------------

--
-- Structure for view `view_member_payments`
--
DROP TABLE IF EXISTS `view_member_payments`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_member_payments`  AS SELECT `tbl_creditpayment`.`customer_no` AS `customer_no`, sum(`tbl_creditpayment`.`paid`) AS `total_payment` FROM `tbl_creditpayment` WHERE `tbl_creditpayment`.`customer_type` = 'm' GROUP BY `tbl_creditpayment`.`customer_no` ;

-- --------------------------------------------------------

--
-- Structure for view `view_purchases`
--
DROP TABLE IF EXISTS `view_purchases`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_purchases`  AS SELECT `d`.`pd_id` AS `pd_id`, `p`.`prod_no` AS `prod_no`, `p`.`barcode` AS `barcode`, `p`.`prod_name` AS `prod_name`, `d`.`qty_delivered` AS `qty_delivered`, `d`.`supplier_price` AS `supplier_price`, `d`.`retail_price` AS `retail_price`, `d`.`wholesale_price` AS `wholesale_price`, `d`.`qty_onhand` AS `qty_onhand` FROM (`tbl_purchasedetail` `d` join `tbl_product` `p` on(`d`.`prod_no` = `p`.`prod_no`)) ORDER BY `d`.`pd_id` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `view_sold`
--
DROP TABLE IF EXISTS `view_sold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_sold`  AS SELECT `tbl_soldproducts`.`prod_no` AS `prod_no`, sum(`tbl_soldproducts`.`qty`) AS `sold_qty` FROM `tbl_soldproducts` GROUP BY `tbl_soldproducts`.`prod_no` ;

-- --------------------------------------------------------

--
-- Structure for view `view_stockonhand`
--
DROP TABLE IF EXISTS `view_stockonhand`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stockonhand`  AS SELECT `view_delivered`.`prod_no` AS `prod_no`, `view_delivered`.`delivered` AS `delivered`, ifnull(`view_sold`.`sold_qty`,0) AS `sold_qty`, ifnull(`view_bo`.`bo_qty`,0) AS `bo_qty`, `view_delivered`.`delivered`- ifnull(`view_sold`.`sold_qty`,0) - ifnull(`view_bo`.`bo_qty`,0) AS `qtyoh` FROM ((`view_delivered` left join `view_sold` on(`view_delivered`.`prod_no` = `view_sold`.`prod_no`)) left join `view_bo` on(`view_delivered`.`prod_no` = `view_bo`.`prod_no`)) ORDER BY `view_delivered`.`prod_no` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_tbl`
--
ALTER TABLE `audit_tbl`
  ADD PRIMARY KEY (`audit_no`);

--
-- Indexes for table `tbl_2_product`
--
ALTER TABLE `tbl_2_product`
  ADD PRIMARY KEY (`prod_no`);

--
-- Indexes for table `tbl_2_productsupplier`
--
ALTER TABLE `tbl_2_productsupplier`
  ADD PRIMARY KEY (`ps_no`);

--
-- Indexes for table `tbl_2_purchasedetail`
--
ALTER TABLE `tbl_2_purchasedetail`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `tbl_2_purchases`
--
ALTER TABLE `tbl_2_purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `tbl_2_supplier`
--
ALTER TABLE `tbl_2_supplier`
  ADD PRIMARY KEY (`sup_no`);

--
-- Indexes for table `tbl_24oct20purchasedetail`
--
ALTER TABLE `tbl_24oct20purchasedetail`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `tbl_audittrail`
--
ALTER TABLE `tbl_audittrail`
  ADD PRIMARY KEY (`at_no`);

--
-- Indexes for table `tbl_bo`
--
ALTER TABLE `tbl_bo`
  ADD PRIMARY KEY (`bo_no`);

--
-- Indexes for table `tbl_creditpayment`
--
ALTER TABLE `tbl_creditpayment`
  ADD PRIMARY KEY (`cp_no`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cust_no`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`dept_no`);

--
-- Indexes for table `tbl_discount`
--
ALTER TABLE `tbl_discount`
  ADD PRIMARY KEY (`disc_no`);

--
-- Indexes for table `tbl_giftcert`
--
ALTER TABLE `tbl_giftcert`
  ADD PRIMARY KEY (`gc_no`);

--
-- Indexes for table `tbl_groupcredit`
--
ALTER TABLE `tbl_groupcredit`
  ADD PRIMARY KEY (`group_no`);

--
-- Indexes for table `tbl_groupmembers`
--
ALTER TABLE `tbl_groupmembers`
  ADD PRIMARY KEY (`gm_no`);

--
-- Indexes for table `tbl_inventorycount`
--
ALTER TABLE `tbl_inventorycount`
  ADD PRIMARY KEY (`ic_no`);

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD PRIMARY KEY (`member_no`);

--
-- Indexes for table `tbl_packages`
--
ALTER TABLE `tbl_packages`
  ADD PRIMARY KEY (`pk_no`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`pay_no`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`prod_no`);

--
-- Indexes for table `tbl_productpackage`
--
ALTER TABLE `tbl_productpackage`
  ADD PRIMARY KEY (`pp_no`);

--
-- Indexes for table `tbl_productprice`
--
ALTER TABLE `tbl_productprice`
  ADD PRIMARY KEY (`pprice_no`);

--
-- Indexes for table `tbl_productsupplier`
--
ALTER TABLE `tbl_productsupplier`
  ADD PRIMARY KEY (`ps_no`);

--
-- Indexes for table `tbl_purchasedetail`
--
ALTER TABLE `tbl_purchasedetail`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `tbl_purchasedetail_21nov24`
--
ALTER TABLE `tbl_purchasedetail_21nov24`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `tbl_purchases`
--
ALTER TABLE `tbl_purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  ADD PRIMARY KEY (`SI_no`),
  ADD UNIQUE KEY `SI_no` (`SI_no`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`setting_no`);

--
-- Indexes for table `tbl_soldproducts`
--
ALTER TABLE `tbl_soldproducts`
  ADD PRIMARY KEY (`sp_no`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`sup_no`);

--
-- Indexes for table `tbl_uom`
--
ALTER TABLE `tbl_uom`
  ADD PRIMARY KEY (`uom_no`);

--
-- Indexes for table `tbl_useracct`
--
ALTER TABLE `tbl_useracct`
  ADD PRIMARY KEY (`user_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_tbl`
--
ALTER TABLE `audit_tbl`
  MODIFY `audit_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_2_product`
--
ALTER TABLE `tbl_2_product`
  MODIFY `prod_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_2_productsupplier`
--
ALTER TABLE `tbl_2_productsupplier`
  MODIFY `ps_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_2_purchasedetail`
--
ALTER TABLE `tbl_2_purchasedetail`
  MODIFY `pd_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_2_purchases`
--
ALTER TABLE `tbl_2_purchases`
  MODIFY `purchase_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_2_supplier`
--
ALTER TABLE `tbl_2_supplier`
  MODIFY `sup_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_24oct20purchasedetail`
--
ALTER TABLE `tbl_24oct20purchasedetail`
  MODIFY `pd_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_audittrail`
--
ALTER TABLE `tbl_audittrail`
  MODIFY `at_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bo`
--
ALTER TABLE `tbl_bo`
  MODIFY `bo_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_creditpayment`
--
ALTER TABLE `tbl_creditpayment`
  MODIFY `cp_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cust_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `dept_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_discount`
--
ALTER TABLE `tbl_discount`
  MODIFY `disc_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_giftcert`
--
ALTER TABLE `tbl_giftcert`
  MODIFY `gc_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_groupcredit`
--
ALTER TABLE `tbl_groupcredit`
  MODIFY `group_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_groupmembers`
--
ALTER TABLE `tbl_groupmembers`
  MODIFY `gm_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_inventorycount`
--
ALTER TABLE `tbl_inventorycount`
  MODIFY `ic_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `member_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_packages`
--
ALTER TABLE `tbl_packages`
  MODIFY `pk_no` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'package number';

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `pay_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `prod_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_productpackage`
--
ALTER TABLE `tbl_productpackage`
  MODIFY `pp_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_productprice`
--
ALTER TABLE `tbl_productprice`
  MODIFY `pprice_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_productsupplier`
--
ALTER TABLE `tbl_productsupplier`
  MODIFY `ps_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchasedetail`
--
ALTER TABLE `tbl_purchasedetail`
  MODIFY `pd_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchasedetail_21nov24`
--
ALTER TABLE `tbl_purchasedetail_21nov24`
  MODIFY `pd_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchases`
--
ALTER TABLE `tbl_purchases`
  MODIFY `purchase_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sales`
--
ALTER TABLE `tbl_sales`
  MODIFY `SI_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `setting_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_soldproducts`
--
ALTER TABLE `tbl_soldproducts`
  MODIFY `sp_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `sup_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_uom`
--
ALTER TABLE `tbl_uom`
  MODIFY `uom_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_useracct`
--
ALTER TABLE `tbl_useracct`
  MODIFY `user_no` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
