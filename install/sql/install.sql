SET sql_mode = '';

CREATE TABLE IF NOT EXISTS `acc_coa` (
  `HeadCode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `HeadName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `PHeadName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `HeadLevel` int(11) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsTransaction` tinyint(1) NOT NULL,
  `IsGL` tinyint(1) NOT NULL,
  `HeadType` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `IsBudget` tinyint(1) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `IsDepreciation` tinyint(1) NOT NULL,
  `DepreciationRate` decimal(18,2) NOT NULL,
  `CreateBy` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CreateDate` datetime NOT NULL,
  `UpdateBy` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UpdateDate` datetime NOT NULL,
  PRIMARY KEY (`HeadName`),
  KEY `customer_id` (`customer_id`),
  KEY `manufacturer_id` (`manufacturer_id`),
  KEY `HeadCode` (`HeadCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acc_coa`
--

INSERT INTO `acc_coa` (`HeadCode`, `HeadName`, `PHeadName`, `HeadLevel`, `IsActive`, `IsTransaction`, `IsGL`, `HeadType`, `IsBudget`, `customer_id`, `manufacturer_id`, `IsDepreciation`, `DepreciationRate`, `CreateBy`, `CreateDate`, `UpdateBy`, `UpdateDate`) VALUES
('50202', 'Account Payable', 'Current Liabilities', 2, 1, 0, 1, 'L', 0, NULL, NULL, 0, '0.00', 'admin', '2015-10-15 19:50:43', '', '2019-08-10 11:01:12'),
('10203', 'Account Receivable', 'Current Asset', 2, 1, 0, 0, 'A', 0, NULL, NULL, 0, '0.00', '', '2019-08-10 11:01:12', 'admin', '2013-09-18 15:29:35'),
('1', 'Assets', 'COA', 0, 1, 0, 0, 'A', 0, NULL, NULL, 0, '0.00', '', '2019-08-10 11:01:12', '', '2019-08-10 11:01:12'),
('10201', 'Cash & Cash Equivalent', 'Current Asset', 2, 1, 0, 1, 'A', 0, NULL, NULL, 0, '0.00', '1', '2019-06-12 11:47:24', 'admin', '2015-10-15 15:57:55'),
('1020102', 'Cash At Bank', 'Cash & Cash Equivalent', 3, 1, 0, 1, 'A', 0, NULL, NULL, 0, '0.00', '1', '2019-03-18 06:08:18', 'admin', '2015-10-15 15:32:42'),
('1020101', 'Cash In Hand', 'Cash & Cash Equivalent', 3, 1, 1, 0, 'A', 0, NULL, NULL, 0, '0.00', '1', '2019-01-26 07:38:48', 'admin', '2016-05-23 12:05:43'),
('102', 'Current Asset', 'Assets', 1, 1, 0, 0, 'A', 0, NULL, NULL, 0, '0.00', '', '2019-08-10 11:01:12', 'admin', '2018-07-07 11:23:00'),
('502', 'Current Liabilities', 'Liabilities', 1, 1, 0, 0, 'L', 0, NULL, NULL, 0, '0.00', 'anwarul', '2014-08-30 13:18:20', 'admin', '2015-10-15 19:49:21'),
('1020301', 'Customer Receivable', 'Account Receivable', 3, 1, 0, 1, 'A', 0, NULL, NULL, 0, '0.00', '1', '2019-01-24 12:10:05', 'admin', '2018-07-07 12:31:42'),
('50204', 'Employee Ledger', 'Current Liabilities', 2, 1, 0, 1, 'L', 0, NULL, NULL, 0, '0.00', '1', '2019-04-08 10:36:32', '', '2019-08-10 11:01:12'),
('404', 'Employee Salary', 'Expence', 1, 1, 1, 0, 'E', 0, NULL, NULL, 0, '0.00', '1', '2019-05-23 05:46:14', '', '2019-08-10 11:01:12'),
('2', 'Equity', 'COA', 0, 1, 0, 0, 'L', 0, NULL, NULL, 0, '0.00', '', '2019-08-10 11:01:12', '', '2019-08-10 11:01:12'),
('4', 'Expence', 'COA', 0, 1, 1, 0, 'E', 0, NULL, NULL, 0, '0.00', '1', '2019-06-18 11:40:41', '', '2019-08-10 11:01:12'),
('405', 'Fixed Assets Cost', 'Expence', 1, 1, 1, 0, 'E', 0, NULL, NULL, 0, '0.00', '1', '2019-05-29 05:32:01', '', '2019-08-10 11:01:12'),
('3', 'Income', 'COA', 0, 1, 0, 0, 'I', 0, NULL, NULL, 0, '0.00', '1', '2019-05-20 05:32:59', '', '2019-08-10 11:01:12'),
('10107', 'Inventory', 'Non Current Assets', 1, 1, 0, 0, 'A', 0, NULL, NULL, 0, '0.00', '2', '2018-07-07 15:21:58', '', '2019-08-10 11:01:12'),
('5', 'Liabilities', 'COA', 0, 1, 0, 0, 'L', 0, NULL, NULL, 0, '0.00', 'admin', '2013-07-04 12:32:07', 'admin', '2015-10-15 19:46:54'),
('1020302', 'Loan Receivable', 'Account Receivable', 3, 1, 0, 1, 'A', 0, NULL, NULL, 0, '0.00', '1', '2019-01-26 07:37:20', '', '2019-08-10 11:01:12'),
('101', 'Non Current Assets', 'Assets', 1, 1, 0, 0, 'A', 0, NULL, NULL, 0, '0.00', '', '2019-08-10 11:01:12', 'admin', '2015-10-15 15:29:11'),
('501', 'Non Current Liabilities', 'Liabilities', 1, 1, 0, 0, 'L', 0, NULL, NULL, 0, '0.00', 'anwarul', '2014-08-30 13:18:20', 'admin', '2015-10-15 19:49:21'),
('402', 'Product Purchase', 'Expence', 1, 1, 1, 0, 'E', 0, NULL, NULL, 0, '0.00', '1', '2019-05-20 07:46:59', '', '2019-08-10 11:01:12'),
('304', 'Product Sale', 'Income', 1, 1, 1, 0, 'I', 0, NULL, NULL, 0, '0.00', '1', '2019-06-16 12:15:40', '', '2019-08-10 11:01:12'),
('305', 'Service Income', 'Income', 1, 1, 1, 0, 'I', 0, NULL, NULL, 0, '0.00', '1', '2019-05-22 13:36:02', '', '2019-08-10 11:01:12'),
('301', 'Store Income', 'Income', 1, 1, 0, 0, 'I', 0, NULL, NULL, 0, '0.00', '2', '2018-07-07 13:40:37', 'admin', '2015-09-17 17:00:02'),
('50205', 'Supplier Ledger', 'Current Liabilities', 2, 1, 0, 1, 'L', 0, NULL, NULL, 0, '0.00', '1', '2019-10-06 06:18:49', '', '2019-08-10 11:01:12'),
('10203000001', 'Walking Customer-1', 'Customer Receivable', 4, 1, 1, 0, 'A', 0, 1, NULL, 0, '0.00', '1', '2019-11-12 07:06:55', '', '2019-08-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `acc_transaction`
--

CREATE TABLE IF NOT EXISTS `acc_transaction` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VNo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Vtype` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VDate` date DEFAULT NULL,
  `COAID` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Narration` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Debit` decimal(18,2) DEFAULT NULL,
  `Credit` decimal(18,2) DEFAULT NULL,
  `IsPosted` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreateBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `IsAppove` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `ID` (`ID`),
  KEY `COAID` (`COAID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asset_purchase`
--

CREATE TABLE IF NOT EXISTS `asset_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_date` date NOT NULL,
  `supplier_id` varchar(30) NOT NULL,
  `grand_total` float NOT NULL,
  `payment_type` tinyint(4) DEFAULT NULL,
  `bank_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `att_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `sign_in` varchar(30) NOT NULL,
  `sign_out` varchar(30) NOT NULL,
  `staytime` varchar(30) NOT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bank_add`
--

CREATE TABLE IF NOT EXISTS `bank_add` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` varchar(50) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `ac_name` varchar(250) DEFAULT NULL,
  `ac_number` varchar(250) DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  `signature_pic` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company_information`
--

CREATE TABLE IF NOT EXISTS `company_information` (
  `company_id` varchar(50) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `website` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_information`
--

INSERT INTO `company_information` (`company_id`, `company_name`, `email`, `address`, `mobile`, `website`, `status`) VALUES
('NOILG8EGCRXXBWUEUQBM', 'bdtask Shop', 'bdtask@gmail.com', 'B-25, Mannan Plaza, 4th Floor, Khilkhet\r\nDhaka-1229, Bangladesh ', '1922296392', 'http://www.bdtask.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `currency_tbl`
--

CREATE TABLE IF NOT EXISTS `currency_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(50) NOT NULL,
  `icon` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency_tbl`
--

INSERT INTO `currency_tbl` (`id`, `currency_name`, `icon`) VALUES
(1, 'Taka', '৳'),
(2, 'Dollar', '$');

-- --------------------------------------------------------

--
-- Table structure for table `customer_information`
--

CREATE TABLE IF NOT EXISTS `customer_information` (
  `customer_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) NOT NULL,
  `address2` text DEFAULT NULL,
  `customer_mobile` varchar(100) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `email_address` varchar(200) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `city` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `status` int(2) NOT NULL COMMENT '1=paid,2=credit',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_by` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_information`
--

INSERT INTO `customer_information` (`customer_id`, `customer_name`, `customer_address`, `address2`, `customer_mobile`, `customer_email`, `email_address`, `contact`, `phone`, `fax`, `city`, `state`, `zip`, `country`, `status`, `create_date`, `create_by`) VALUES
(1, 'Walking Customer', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-07-22 23:17:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `daily_closing`
--

CREATE TABLE IF NOT EXISTS `daily_closing` (
  `closing_id` varchar(255) NOT NULL,
  `last_day_closing` float NOT NULL,
  `cash_in` float NOT NULL,
  `cash_out` float NOT NULL,
  `date` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `adjustment` float NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`closing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(150) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_history`
--

CREATE TABLE IF NOT EXISTS `employee_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `rate_type` int(11) NOT NULL,
  `hrate` float NOT NULL,
  `email` varchar(50) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `address_line_1` text NOT NULL,
  `address_line_2` text NOT NULL,
  `image` text DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_payment`
--

CREATE TABLE IF NOT EXISTS `employee_salary_payment` (
  `emp_sal_pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `generate_id` int(11) NOT NULL,
  `employee_id` varchar(50) CHARACTER SET latin1 NOT NULL,
  `total_salary` decimal(18,2) NOT NULL DEFAULT 0.00,
  `total_working_minutes` varchar(50) CHARACTER SET latin1 NOT NULL,
  `working_period` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `payment_due` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `payment_date` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `paid_by` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `salary_month` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`emp_sal_pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_setup`
--

CREATE TABLE IF NOT EXISTS `employee_salary_setup` (
  `e_s_s_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `sal_type` varchar(30) NOT NULL,
  `salary_type_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `create_date` date DEFAULT NULL,
  `update_date` datetime(6) DEFAULT NULL,
  `update_id` varchar(30) CHARACTER SET latin1 NOT NULL,
  `gross_salary` float NOT NULL,
  PRIMARY KEY (`e_s_s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `type` varchar(100) NOT NULL,
  `voucher_no` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `expense_item`
--

CREATE TABLE IF NOT EXISTS `expense_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_item_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fixed_assets`
--

CREATE TABLE IF NOT EXISTS `fixed_assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(50) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `insert_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) DEFAULT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `invoice` bigint(20) DEFAULT NULL,
  `total_discount` decimal(10,2) DEFAULT 0.00 COMMENT 'total invoice discount',
  `invoice_discount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_tax` decimal(10,2) DEFAULT 0.00,
  `prevous_due` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sales_by` varchar(30) DEFAULT NULL,
  `invoice_details` varchar(200) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `payment_type` int(11) NOT NULL DEFAULT 1,
  `bank_id` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `invoice` (`invoice`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE IF NOT EXISTS `invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_details_id` varchar(30) NOT NULL,
  `invoice_id` bigint(20) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `batch_id` varchar(30) NOT NULL,
  `cartoon` float DEFAULT NULL,
  `quantity` float NOT NULL,
  `rate` decimal(12,2) DEFAULT NULL,
  `manufacturer_rate` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(12,2) DEFAULT NULL,
  `discount` decimal(12,0) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `paid_amount` decimal(12,0) DEFAULT NULL,
  `due_amount` decimal(10,2) DEFAULT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `product_id` (`product_id`),
  KEY `batch_id` (`batch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `phrase` text NOT NULL,
  `english` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=961 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `phrase`, `english`) VALUES
(1, 'user_profile', 'User Profile'),
(2, 'setting', 'Web Setting'),
(3, 'language', 'Language'),
(4, 'manage_users', 'Manage Users'),
(5, 'add_user', 'Add User'),
(6, 'manage_company', 'Manage Company'),
(7, 'web_settings', 'Software Settings'),
(8, 'manage_accounts', 'Manage Accounts'),
(9, 'create_accounts', 'Create Accounts'),
(10, 'manage_bank', 'Manage Bank'),
(11, 'add_new_bank', 'Add New Bank'),
(12, 'settings', 'Settings'),
(13, 'closing_report', 'Closing Report'),
(14, 'closing', 'Closing'),
(15, 'cheque_manager', 'Cheque Manager'),
(16, 'accounts_summary', 'Accounts Summary'),
(17, 'expense', 'Expense'),
(18, 'income', 'Income'),
(19, 'accounts', 'Accounts'),
(20, 'stock_report', 'Stock Report'),
(21, 'stock', 'Stock'),
(22, 'pos_invoice', 'POS Invoice'),
(23, 'manage_invoice', 'Manage Invoice '),
(24, 'new_invoice', 'New Invoice'),
(25, 'invoice', 'Invoice'),
(26, 'manage_purchase', 'Manage Purchase'),
(27, 'add_purchase', 'Add Purchase'),
(28, 'purchase', 'Purchase'),
(29, 'paid_customer', 'Paid Customer'),
(30, 'manage_customer', 'Manage Customer'),
(31, 'add_customer', 'Add Customer'),
(32, 'customer', 'Customer'),
(33, 'manufacturer_payment_actual', 'Manufacturer Payment Actual'),
(34, 'manufacturer_sales_summary', 'Manufacturer  Sales Summary'),
(35, 'manufacturer_sales_details', 'Manufacturer Sales Details'),
(36, 'manufacturer_ledger', 'Manufacturer Ledger'),
(37, 'manage_manufacturer', 'Manage Manufacturer'),
(38, 'add_manufacturer', 'Add Manufacturer'),
(39, 'manufacturer', 'Manufacturer'),
(40, 'product_statement', 'Medicine Statement'),
(41, 'manage_product', 'Manage Medicine'),
(42, 'add_product', 'Add Medicine'),
(43, 'product', 'Medicine'),
(44, 'manage_category', 'Manage Category'),
(45, 'add_category', 'Add Category'),
(46, 'category', 'Category'),
(47, 'sales_report_product_wise', 'Sales Report (Medicine Wise)'),
(48, 'purchase_report', 'Purchase Report'),
(49, 'sales_report', 'Sales Report'),
(50, 'todays_report', 'Todays Report'),
(51, 'report', 'Report'),
(52, 'dashboard', 'Dashboard'),
(53, 'online', 'Online'),
(54, 'logout', 'Logout'),
(56, 'total_purchase', 'Total Purchase'),
(57, 'total_amount', 'Total Amount'),
(58, 'manufacturer_name', 'Manufacturer  Name'),
(59, 'invoice_no', 'Invoice No'),
(60, 'purchase_date', 'Purchase Date'),
(61, 'todays_purchase_report', 'Todays Purchase Report'),
(62, 'total_sales', 'Total Sales'),
(63, 'customer_name', 'Customer Name'),
(64, 'sales_date', 'Sales Date'),
(65, 'todays_sales_report', 'Todays Sales Report'),
(66, 'home', 'Home'),
(67, 'todays_sales_and_purchase_report', 'Todays sales and purchase report'),
(68, 'total_ammount', 'Total Amount'),
(69, 'rate', 'Sale Price'),
(70, 'product_model', 'Medicine Type'),
(71, 'product_name', 'Medicine Name'),
(72, 'search', 'Search'),
(73, 'end_date', 'End Date'),
(74, 'start_date', 'Start Date'),
(75, 'total_purchase_report', 'Total Purchase Report'),
(76, 'total_sales_report', 'Total Sales Report'),
(77, 'total_seles', 'Total Sales'),
(78, 'all_stock_report', 'All Stock Report'),
(79, 'search_by_product', 'Search By Medicine'),
(80, 'date', 'Date'),
(81, 'print', 'Print'),
(82, 'stock_date', 'Stock Date'),
(83, 'print_date', 'Print Date'),
(84, 'sales', 'Sales'),
(85, 'price', 'Price'),
(86, 'sl', 'SL.'),
(87, 'add_new_category', 'Add new category'),
(88, 'category_name', 'Category Name'),
(89, 'save', 'Save'),
(90, 'delete', 'Delete'),
(91, 'update', 'Update'),
(92, 'action', 'Action'),
(93, 'manage_your_category', 'Manage your category '),
(94, 'category_edit', 'Category Edit'),
(95, 'status', 'Status'),
(96, 'active', 'Active'),
(97, 'inactive', 'Inactive'),
(98, 'save_changes', 'Save Changes'),
(99, 'save_and_add_another', 'Save And Add Another'),
(100, 'model', 'Medicine Type'),
(101, 'manufacturer_price', 'Manufacturer Price'),
(102, 'sell_price', 'Sell Price'),
(103, 'image', 'Image'),
(104, 'select_one', 'Select One'),
(105, 'details', 'Details'),
(106, 'new_product', 'New Medicine'),
(107, 'add_new_product', 'Add new medicine'),
(108, 'barcode', 'Barcode'),
(109, 'qr_code', 'Qr-Code'),
(110, 'product_details', 'Medicine Details'),
(111, 'manage_your_product', 'Manage your medicine'),
(112, 'product_edit', 'Medicine Edit'),
(113, 'edit_your_product', 'Edit your medicine'),
(114, 'cancel', 'Cancel'),
(115, 'incl_vat', 'Incl. Vat'),
(116, 'money', 'Dollar'),
(117, 'grand_total', 'Grand Total'),
(118, 'quantity', 'Quantity'),
(119, 'product_report', 'Medicine Report'),
(120, 'product_sales_and_purchase_report', 'Medicine sales and purchase report'),
(121, 'previous_stock', 'Previous Stock'),
(122, 'out', 'Out'),
(123, 'in', 'In'),
(124, 'to', 'To'),
(125, 'previous_balance', 'Previous Balance'),
(126, 'customer_address', 'Customer Address'),
(127, 'customer_mobile', 'Customer Mobile'),
(128, 'customer_email', 'Customer Email'),
(129, 'add_new_customer', 'Add new customer'),
(130, 'balance', 'Balance'),
(131, 'mobile', 'Mobile'),
(132, 'address', 'Address'),
(133, 'manage_your_customer', 'Manage your customer'),
(134, 'customer_edit', 'Customer Edit'),
(135, 'paid_customer_list', 'Paid Customer List'),
(136, 'ammount', 'Amount'),
(137, 'customer_ledger', 'Customer Ledger'),
(138, 'manage_customer_ledger', 'Manage Customer Ledger'),
(139, 'customer_information', 'Customer Information'),
(140, 'debit_ammount', 'Debit Amount'),
(141, 'credit_ammount', 'Credit Amount'),
(142, 'balance_ammount', 'Balance Amount'),
(143, 'receipt_no', 'Receipt NO'),
(144, 'description', 'Description'),
(145, 'debit', 'Debit'),
(146, 'credit', 'Credit'),
(147, 'item_information', 'Item Information'),
(148, 'total', 'Total'),
(149, 'please_select_manufacturer', 'Please Select Manufacturer'),
(150, 'submit', 'Submit'),
(151, 'submit_and_add_another', 'Submit And Add Another One'),
(152, 'add_new_item', 'Add New Item'),
(153, 'manage_your_purchase', 'Manage your purchase'),
(154, 'purchase_edit', 'Purchase Edit'),
(155, 'purchase_ledger', 'Purchase Ledger'),
(156, 'invoice_information', 'Invoice Information'),
(157, 'paid_ammount', 'Paid Amount'),
(158, 'discount', 'Discount / Pcs.'),
(159, 'save_and_paid', 'Save And Paid'),
(160, 'payee_name', 'Payee Name'),
(161, 'manage_your_invoice', 'Manage your invoice'),
(162, 'invoice_edit', 'Invoice Edit'),
(163, 'new_pos_invoice', 'New POS invoice'),
(164, 'add_new_pos_invoice', 'Add new pos invoice'),
(165, 'product_id', 'Medicine ID'),
(166, 'paid_amount', 'Paid Amount'),
(167, 'authorised_by', 'Authorised By'),
(168, 'checked_by', 'Checked By'),
(169, 'received_by', 'Received By'),
(170, 'prepared_by', 'Prepared By'),
(171, 'memo_no', 'Memo No'),
(172, 'website', 'Website'),
(173, 'email', 'Email'),
(174, 'invoice_details', 'Invoice Details'),
(175, 'reset', 'Reset'),
(176, 'payment_account', 'Payment Account'),
(177, 'bank_name', 'Bank Name'),
(178, 'cheque_or_pay_order_no', 'Cheque/Pay Order No'),
(179, 'payment_type', 'Payment Type'),
(180, 'payment_from', 'Payment From'),
(181, 'payment_date', 'Payment Date'),
(182, 'add_income', 'Add Income'),
(183, 'cash', 'Cash'),
(184, 'cheque', 'Cheque'),
(185, 'pay_order', 'Pay Order'),
(186, 'payment_to', 'Payment To'),
(187, 'total_expense_ammount', 'Total Expense Amount'),
(188, 'transections', 'Transactions'),
(189, 'accounts_name', 'Accounts Name'),
(190, 'outflow_report', 'Expense Report'),
(191, 'inflow_report', 'Income Report'),
(192, 'all', 'All'),
(193, 'account', 'Account'),
(194, 'from', 'From'),
(195, 'account_summary_report', 'Account Summary Report'),
(196, 'search_by_date', 'Search By Date'),
(197, 'cheque_no', 'Cheque No'),
(198, 'name', 'Name'),
(199, 'closing_account', 'Closing Account'),
(200, 'close_your_account', 'Close your account'),
(201, 'last_day_closing', 'Last Day Closing'),
(202, 'cash_in', 'Cash In'),
(203, 'cash_out', 'Cash Out'),
(204, 'cash_in_hand', 'Cash In Hand'),
(205, 'add_new_bank', 'Add New Bank'),
(206, 'day_closing', 'Day Closing'),
(207, 'account_closing_report', 'Account Closing Report'),
(208, 'last_day_ammount', 'Last Day Amount'),
(209, 'adjustment', 'Adjustment'),
(210, 'pay_type', 'Pay Type'),
(211, 'customer_or_manufacturer', 'Customer,Manufacturer Or Others'),
(212, 'transection_id', 'Transactions ID'),
(213, 'accounts_summary_report', 'Accounts Summary Report'),
(214, 'bank_list', 'Bank List'),
(215, 'bank_edit', 'Bank Edit'),
(216, 'debit_plus', 'Debit (+)'),
(217, 'credit_minus', 'Credit (-)'),
(218, 'account_name', 'Account Name'),
(219, 'account_type', 'Account Type'),
(220, 'account_real_name', 'Account Real Name'),
(221, 'manage_account', 'Manage Account'),
(222, 'company_name', 'Company Name'),
(223, 'edit_your_company_information', 'Edit your company information'),
(224, 'company_edit', 'Company Edit'),
(225, 'admin', 'Admin'),
(226, 'user', 'User'),
(227, 'password', 'Password'),
(228, 'last_name', 'Last Name'),
(229, 'first_name', 'First Name'),
(230, 'add_new_user_information', 'Add new user information'),
(231, 'user_type', 'User Type'),
(232, 'user_edit', 'User Edit'),
(233, 'rtr', 'RTR'),
(234, 'ltr', 'LTR'),
(235, 'ltr_or_rtr', 'LTR/RTR'),
(236, 'footer_text', 'Footer Text'),
(237, 'favicon', 'Favicon'),
(238, 'logo', 'Logo'),
(239, 'update_setting', 'Update Setting'),
(240, 'update_your_web_setting', 'Update your Web setting'),
(241, 'login', 'Login'),
(242, 'your_strong_password', 'Your strong password'),
(243, 'your_unique_email', 'Your unique email'),
(244, 'please_enter_your_login_information', 'Please enter your login information.'),
(245, 'update_profile', 'Update Profile'),
(246, 'your_profile', 'Your Profile'),
(247, 're_type_password', 'Re-Type Password'),
(248, 'new_password', 'New Password'),
(249, 'old_password', 'Old Password'),
(250, 'new_information', 'New Information'),
(251, 'old_information', 'Old Information'),
(252, 'change_your_information', 'Change your information'),
(253, 'change_your_profile', 'Change your profile'),
(254, 'profile', 'Profile'),
(255, 'wrong_username_or_password', 'Wrong User Name Or Password !'),
(256, 'successfully_updated', 'Successfully Updated.'),
(257, 'blank_field_does_not_accept', 'Blank Field Does Not Accept !'),
(258, 'successfully_changed_password', 'Successfully changed password.'),
(259, 'you_are_not_authorised_person', 'You are not authorised person !'),
(260, 'password_and_repassword_does_not_match', 'Passwor and re-password does not match !'),
(261, 'new_password_at_least_six_character', 'New Password At Least 6 Character.'),
(262, 'you_put_wrong_email_address', 'You put wrong email address !'),
(263, 'cheque_ammount_asjusted', 'Cheque amount adjusted.'),
(264, 'successfully_payment_paid', 'Successfully Payment Paid.'),
(265, 'successfully_added', 'Successfully Added.'),
(266, 'successfully_updated_2_closing_ammount_not_changeale', 'Successfully Updated -2. Note: Closing Amount Not Changeable.'),
(267, 'successfully_payment_received', 'Successfully Payment Received.'),
(268, 'already_inserted', 'Already Inserted !'),
(269, 'successfully_delete', 'Successfully Delete.'),
(270, 'successfully_created', 'Successfully Created.'),
(271, 'logo_not_uploaded', 'Logo not uploaded !'),
(272, 'favicon_not_uploaded', 'Favicon not uploaded !'),
(273, 'manufacturer_mobile', 'Manufacturer  Mobile'),
(274, 'manufacturer_address', 'Manufacturer  Address'),
(275, 'manufacturer_details', 'Manufacturer Details'),
(276, 'add_new_manufacturer', 'Add New Manufacturer'),
(277, 'manage_suppiler', 'Manage Manufacturer'),
(278, 'manage_your_manufacturer', 'Manage your Manufacturer'),
(279, 'manage_manufacturer_ledger', 'Manage Manufacturer'),
(280, 'invoice_id', 'Invoice ID'),
(281, 'deposite_id', 'Deposit ID'),
(282, 'manufacturer_actual_ledger', 'Manufacturer Actual Ledger'),
(283, 'manufacturer_information', 'Manufacturer Information'),
(284, 'event', 'Event'),
(285, 'add_new_income', 'Add New Income'),
(286, 'add_expese', 'Add Expense'),
(287, 'add_new_expense', 'Add New Expense'),
(288, 'total_income_ammount', 'Total Income Amount'),
(289, 'create_new_invoice', 'Create New Invoice'),
(290, 'create_pos_invoice', 'Create POS Invoice'),
(291, 'total_profit', 'Total Profit'),
(292, 'monthly_progress_report', 'Monthly Progress Report'),
(293, 'total_invoice', 'Total Invoice'),
(294, 'account_summary', 'Account Summary'),
(295, 'total_manufacturer', 'Total manufacturer'),
(296, 'total_product', 'Total Medicine'),
(297, 'total_customer', 'Total Customer'),
(298, 'manufacturer_edit', 'Manufacturer Edit'),
(299, 'add_new_invoice', 'Add New Invoice'),
(300, 'add_new_purchase', 'Add new purchase'),
(301, 'currency', 'Currency'),
(302, 'currency_position', 'Currency Position'),
(303, 'left', 'Left'),
(304, 'right', 'Right'),
(305, 'add_tax', 'Add Tax'),
(306, 'manage_tax', 'Manage Tax'),
(307, 'add_new_tax', 'Add new tax'),
(308, 'enter_tax', 'Enter Tax'),
(309, 'already_exists', 'Already Exists !'),
(310, 'successfully_inserted', 'Successfully Inserted.'),
(311, 'tax', 'Tax'),
(312, 'tax_edit', 'Tax Edit'),
(313, 'product_not_added', 'Medicine not added !'),
(314, 'total_tax', 'Total Tax'),
(315, 'manage_your_manufacturer_details', 'Manage your Manufacturer'),
(316, 'invoice_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s                                       standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.'),
(317, 'thank_you_for_choosing_us', 'Thank you very much for choosing us.'),
(318, 'billing_date', 'Billing Date'),
(319, 'billing_to', 'Billing To'),
(320, 'billing_from', 'Billing From'),
(321, 'you_cant_delete_this_product', 'Sorry !!  You can\'t delete this medicine.This medicine already used in calculation system!'),
(322, 'old_customer', 'Old Customer'),
(323, 'new_customer', 'New Customer'),
(324, 'new_manufacturer', 'New Manufacturer'),
(325, 'old_manufacturer', 'Old Manufacturer'),
(326, 'credit_customer', 'Credit Customer'),
(327, 'account_already_exists', 'This Account Already Exists !'),
(328, 'edit_income', 'Edit Income'),
(329, 'you_are_not_access_this_part', 'You are not authorised person !'),
(330, 'account_edit', 'Account Edit'),
(331, 'due', 'Due'),
(332, 'expense_edit', 'Expense Edit'),
(333, 'please_select_customer', 'Please select customer !'),
(334, 'profit_report', 'Profit Report (Invoice Wise)'),
(335, 'total_profit_report', 'Total profit report'),
(336, 'please_enter_valid_captcha', 'Please enter valid captcha.'),
(337, 'category_not_selected', 'Category not selected.'),
(338, 'manufacturer_not_selected', 'Manufacturer not selected.'),
(339, 'please_select_product', 'Please select medicine'),
(340, 'product_model_already_exist', 'Medicine model already exist !'),
(341, 'invoice_logo', 'Invoice Logo'),
(342, 'available_quantity', 'Available Quantity'),
(343, 'you_can_not_buy_greater_than_available_quantity', 'You can not select grater than availale quantity !'),
(344, 'customer_details', 'Customer details'),
(345, 'manage_customer_details', 'Manage customer details.'),
(346, 'box_size', 'Box size'),
(347, 'expire_date', 'Expiry  date'),
(348, 'product_location', 'Medicine  Shelf'),
(349, 'generic_name', 'Generic name'),
(350, 'payment_method', 'Payment Method'),
(351, 'card_no', 'Card no'),
(352, 'medicine', 'Medicine'),
(353, 'medicine_search', 'Medicine Search'),
(354, 'what_you_search', 'Enter what you search'),
(355, 'company', 'Company'),
(356, 'customer_search', 'Customer search'),
(357, 'invoice_search', 'Invoice search'),
(358, 'purchase_search', 'Purchase search'),
(359, 'daily_closing_report', 'Daily closing report.'),
(360, 'closing_search_report', 'Closing Search Report'),
(361, 'category_list', 'Category List'),
(362, 'company_list', 'Company List'),
(363, 'customers_list', 'Customer List'),
(364, 'credit_customer_list', 'Credit Customer List'),
(365, 'previous_balance_adjustment', 'Previous Balance Adjustment'),
(366, 'invoice_list', 'Invoice List'),
(367, 'add_pos_invoice', 'Add POS Invoice'),
(368, 'add_invoice', 'Add Invoice'),
(369, 'product_list', 'Medicine List'),
(370, 'purchases_list', 'Purchase List'),
(371, 'purchase_list', 'Purchase List'),
(372, 'stock_list', 'Stock List'),
(373, 'all_report', 'All Report'),
(374, 'daily_sales_report', 'Daily sales Report'),
(375, 'product_wise_sales_report', 'Medicine Wise Sales Report'),
(376, 'bank_update', 'Bank Update'),
(377, 'account_list', 'Account List'),
(378, 'manufacturer_list', 'Manufacturer  List'),
(379, 'manufacturer_search_item', 'Manufacturer  Search Item'),
(380, 'user_list', 'User List'),
(381, 'user_search_item', 'User Search Item'),
(382, 'change_password', 'Change Password'),
(383, 'admin_login_area', 'Admin Login Area'),
(384, 'accounts_inflow_form', 'Account Inflow Form'),
(385, 'accounts_outflow_form', 'Accounts Outflow Form'),
(386, 'accounts_tax_form', 'Accounts Tax Form'),
(387, 'accounts_manage_tax', 'Accounts Manage Tax'),
(388, 'accounts_tax_edit', 'Accounts Tax Edit'),
(389, 'accounts_summary_data', 'Accounts Summary Data'),
(390, 'accounts_details_data', 'Accounts Details Data'),
(391, 'datewise_summary_data', 'Datewise Summary Data'),
(392, 'accounts_cheque_manager', 'Account Cheque Manager'),
(393, 'accounts_edit_data', 'Accounts Edit Data'),
(394, 'print_barcode', 'Print Barcode'),
(395, 'print_qrcode', 'Print Qrcode'),
(396, 'add_new_account', 'Add New Account'),
(397, 'table_edit', 'Table Edit'),
(398, 'secret_key', 'Secret Key'),
(399, 'site_key', 'Site Key'),
(400, 'captcha', 'Captcha'),
(401, 'please_add_walking_customer_for_default_customer', 'Please add walking customer for default customer. '),
(402, 'barcode_qrcode_scan_here', 'Barcode Or QRcode scan here'),
(403, 'manage_your_credit_customer', 'Manage your credit customer'),
(404, 'unit', 'Unit'),
(405, 'total_discount', 'Total Discount'),
(406, 'meter_m', 'Meter (M)'),
(407, 'piece_pc', 'Piece (Pc)'),
(408, 'kilogram_kg', 'Kilogram (Kg)'),
(409, 'import_product_csv', 'Import Medicine (CSV)'),
(410, 'close', 'Close'),
(411, 'csv_file_informaion', 'File Information (CSV)'),
(412, 'download_example_file', 'Download Example File'),
(413, 'upload_csv_file', 'Upload CSV File'),
(414, 'manufacturer_id', 'Manufacturer ID'),
(415, 'category_id', 'Category ID'),
(416, 'are_you_sure_to_delete', 'Are you sure,want to delete ?'),
(417, 'stock_report_manufacturer_wise', 'Stock Report (Manufacturer Wise)'),
(418, 'stock_report_product_wise', 'Stock Report (Medicine Wise)'),
(419, 'select_manufacturer', 'Select Manufacturer'),
(420, 'select_product', 'Select Medicine '),
(421, 'phone', 'Phone'),
(422, 'in_quantity', 'In Quantity'),
(423, 'out_quantity', 'Sold QTY'),
(424, 'in_taka', 'In Taka'),
(425, 'out_taka', 'Out Taka'),
(426, 'data_synchronizer', 'Data Synchronizer'),
(427, 'synchronize', 'Synchronize'),
(428, 'backup_restore', 'Backup And Restore'),
(429, 'synchronizer_setting', 'Synchronizer Setting'),
(430, 'backup_and_restore', 'Backup And Restore'),
(431, 'hostname', 'Host Name'),
(432, 'username', 'User Name'),
(433, 'ftp_port', 'FTP Port'),
(434, 'ftp_debug', 'FTP Debug'),
(435, 'project_root', 'Project Root'),
(436, 'internet_connection', 'Internet connection'),
(437, 'ok', 'Ok'),
(438, 'not_available', 'Not available'),
(439, 'outgoing_file', 'Outgoing File'),
(440, 'available', 'Available'),
(441, 'incoming_file', 'Incoming file'),
(442, 'data_upload_to_server', 'Data upload to server'),
(443, 'download_data_from_server', 'Download data from server'),
(444, 'data_import_to_database', 'Data import to database'),
(445, 'please_wait', 'Please Wait'),
(446, 'ooops_something_went_wrong', 'Ooops something went wrong'),
(447, 'file_information', 'File Information'),
(448, 'size', 'Size'),
(449, 'backup_date', 'Backup date'),
(450, 'backup_now', 'Backup Now'),
(451, 'are_you_sure', 'Are you sure ?'),
(452, 'download', 'Downlaod'),
(453, 'database_backup', 'Database Backup'),
(454, 'backup_successfully', 'Backup Successfully'),
(455, 'please_try_again', 'Please Try Again'),
(456, 'restore_successfully', 'Restore successfully'),
(457, 'download_successfully', 'Download Successfully'),
(458, 'delete_successfully', 'Delete Successfully'),
(459, 'ftp_setting', 'FTP Setting'),
(460, 'save_successfully', 'Save successfully'),
(461, 'upload_successfully', 'Upload successfully.'),
(462, 'unable_to_upload_file_please_check_configuration', 'unable to upload file please check configuration.'),
(463, 'please_configure_synchronizer_settings', 'Please Configure Synchronizer Settings '),
(464, 'unable_to_download_file_please_check_configuration', 'Unable To Download File,Please Check Configuration.'),
(465, 'data_import_first', 'Data Import First'),
(466, 'data_import_successfully', 'Data Import Successfully'),
(467, 'unable_to_import_data_please_check_config_or_sql_file', 'Unable to import data please check config or sql file.'),
(468, 'restore_now', 'Restore Now'),
(469, 'out_of_stock', 'Out Of Stock'),
(470, 'others', 'Others'),
(471, 'shelf', 'Shelf'),
(472, 'discount_type', 'Discount Type '),
(473, 'discount_percentage', 'Discount'),
(474, 'fixed_dis', 'Fixed Dis'),
(475, 'full_paid', 'Full Paid'),
(476, 'available_qnty', 'Ava.Qty'),
(477, 'stock_ctn', 'Stock/Qnt'),
(478, 'sale_price', 'Sale Price'),
(479, 'manufacturer_rate', 'Manufacturer  Price'),
(480, 'please_upload_image_type', 'Sorry!!! Please Upload jpg,jpeg,png,gif typeimage'),
(481, 'ml', 'Milli liter(ml)'),
(482, 'mg', 'Milli Gram(mg)'),
(483, 'you_can_not_buy_greater_than_available_qnty', 'You can not sale more than available quantity ! please purchase this Product'),
(484, 'due_amount', 'Due Amount'),
(485, 'return_invoice', 'Return Invoice'),
(486, 'sold_qty', 'Sold Qty'),
(487, 'ret_quantity', 'Return QTY'),
(488, 'deduction', 'Deduction'),
(489, 'return', 'Return'),
(490, 'note', 'Return Reasone'),
(491, 'usablilties', 'Return Usability'),
(492, 'adjs_with_stck', 'Adjust With Stock'),
(493, 'return_to_manufacturer', 'Return To Manufacturer'),
(494, 'wastage', 'Wastage'),
(495, 'to_deduction', 'Total Deduction'),
(496, 'nt_return', 'Net Return'),
(497, 'return_id', 'Return Id'),
(498, 'return_details', 'Return Details'),
(499, 'add_return', 'Add Return'),
(500, 'return_list', 'Return List'),
(501, 'stock_return_list', 'Stock Return List'),
(502, 'wastage_return_list', 'Wastage Return List'),
(503, 'check_return', 'Check Return'),
(504, 'quantity_must_be_fillup', 'Return Quantity Must be Fill Up'),
(505, 'expeire_date', 'Expiry  date'),
(506, 'batch_id', 'Batch ID'),
(507, 'manufacturer_return_list', 'Manufacturer  Return List'),
(508, 'c_r_slist', 'Customer Return List '),
(509, 'manufacturer_return', 'Manufacturer  Return '),
(510, 'wastage_list', 'Wastage List'),
(511, 'in_qnty', 'In Quantity'),
(512, 'out_qnty', 'Sold QTY'),
(513, 'stock_sale', 'Stock Sell Price'),
(514, 'add_product_csv', 'Import Medicine (CSV)'),
(515, 'purchase_id', 'Purchase ID'),
(516, 'add_payment', 'Add Payment'),
(517, 'add_new_payment', 'Add new Payment'),
(518, 'transaction', 'Transaction'),
(519, 'manage_transaction', 'Manage Transaction'),
(520, 'choose_transaction', 'Choose Transaction'),
(521, 'receipt', 'Receipt'),
(522, 'payment', 'Payment'),
(523, 'transaction_categry', 'Transaction Category'),
(524, 'transaction_mood', 'Transaction Mood'),
(525, 'payment_amount', 'Payment Amount'),
(526, 'receipt_amount', 'Receipt Amount'),
(527, 'daily_summary', 'Daily Summary'),
(528, 'daily_cash_flow', 'Daily  Cashflow'),
(529, 'custom_report', 'Custom Report'),
(530, 'root_account', 'Root Account'),
(531, 'office', 'Office'),
(532, 'loan', 'Loan'),
(533, 'successfully_saved', 'Successfully Saved'),
(534, 'bank', 'Bank'),
(535, 'bank_transaction', 'Bank Transaction'),
(536, 'office_loan', 'Office Loan'),
(537, 'add_person', 'Add Person'),
(538, 'manage_loan', 'Manage Person'),
(539, 'add_loan', 'Add Loan'),
(540, 'ac_name', 'Account Name'),
(541, 'ac_no', 'Account No'),
(542, 'branch', 'Branch'),
(543, 'signature_pic', 'Signature '),
(544, 'withdraw_deposite_id', 'Withdraw Deposit ID'),
(545, 'select_report', 'Select Report'),
(546, 'per_qty', 'Purchase Qty'),
(547, 'stock_report_batch_wise', 'Stock Report(Batch Wise)'),
(548, 'box', 'Box'),
(549, 'gram', 'Gram'),
(550, 'profit_report_manufacturer_wise', 'Profit/Loss Report(Manufacturer)'),
(551, 'calculate', 'Calculate'),
(552, 'profit_report_product_wise', 'Profit/Loss  Report Product Wise'),
(553, 'view_report', 'View Report'),
(554, 'report_for', 'Report For'),
(555, 'total_sale_qty', 'Total Sale QTY'),
(556, 'total_purchase_pric', 'Total purchase Price'),
(557, 'total_sale', 'Total Sale'),
(558, 'net_profit', 'Net Profit'),
(559, 'loss', 'Loss'),
(560, 'product_type', 'Medicine Type'),
(561, 'add_type', 'Add Medicine Type'),
(562, 'add_new_type', 'Add New Medicine  Type'),
(563, 'type', 'Type'),
(564, 'type_name', 'Type Name'),
(565, 'manage_type', 'Manage Medicine Type'),
(566, 'type_id', 'Type Id'),
(567, 'type_edit', 'Edit Type'),
(568, 'profitloss', 'profit/Loss'),
(569, 'manufacturer_wise', 'Manufacturer Wise'),
(570, 'product_wise', 'Medicine Wise'),
(571, 'medicine_info', 'Medicine Information'),
(572, 'choose_another_invno', 'Choose Another Invoice No !!'),
(573, 'return_manufacturers', 'Return Manufacturers'),
(574, 'return_manufacturer', 'Return Manufacturers'),
(575, 'please_input_correct_invoice_no', 'Please Input Correct Invoice No'),
(576, 'stock_purchase_price', 'Stock Purchase Price'),
(577, 'manufacturer_returns', 'Manufacturer  Return '),
(578, 'invoice_discount', 'Invoice Discount'),
(579, 'qty', 'Qty'),
(580, 'discounts', 'Discount'),
(581, 'sub_total', 'Sub Total'),
(582, 'paid', 'Paid'),
(583, 'change', 'Change'),
(584, 'purchase_price', 'Purchase Price'),
(585, 'expiry', 'Expiry'),
(586, 'batch', 'Batch'),
(587, 'role_permission', 'Role Permission'),
(588, 'user_assign_role', 'Assign  User Role'),
(589, 'permission', 'Permission'),
(590, 'personal_loan', 'Personal Loan'),
(591, 'role_name', 'Role Name'),
(592, 'create', 'Create'),
(593, 'read', 'Read'),
(594, 'add_role', 'Add Role'),
(595, 'You do not have permission to access. Please contact with administrator.', 'You do not have permission to access. Please contact with administrator.'),
(596, 'role_permission_added_successfully', 'Role Permission Added successfully.'),
(597, 'role_list', 'Role List'),
(598, 'role_permission_updated_successfully', 'Role Permission Updated Successfully.'),
(599, 'add_phrase', 'Add Phrase'),
(600, 'language_home', 'Language Home'),
(601, 'phrase_edit', 'Phrase Edit'),
(602, 'no_role_selected', 'No Role Selected'),
(603, 'category_added_successfully', 'Category added successfully'),
(604, 'category_already_exist', 'Category already exist'),
(605, 'select_manufacturer', 'Select Manufacturer'),
(607, 'select_tax', 'Select Tax'),
(608, 'must_input_numbers', 'Must input numbers'),
(609, 'please_check_your_price', 'Please Check Your Price'),
(610, 'your_profit_is', 'Your Profit is'),
(611, 'failed', 'Failed'),
(612, 'you_have_reached_the_limit_of_adding', 'You have reached the limit of adding'),
(613, 'inputs', 'inputs'),
(614, 'expiry_date_should_be_greater_than_puchase_date', 'Expiry Date should be greater than Puchase Date'),
(615, 'expiry_date_should_be_greater_than_puchase_date', 'Expiry Date should be greater than Puchase Date'),
(616, 'product_name', 'Medicine Name'),
(617, 'total_quantity', 'Total Quantity'),
(618, 'rates', 'Rate'),
(619, 'total_amount', 'Total Amount'),
(621, 'receipt_detail', 'Receipt Detail'),
(622, 'amount', 'Amount'),
(623, 'save_and_add_another_one', 'Save and add another one'),
(624, 'checque_number', 'Checque Number'),
(625, 'edit_receipt', 'Edit Receipt'),
(626, 'receipt_list', 'Receipt List'),
(627, 'search_by_customer_name', 'Search By Customer Name'),
(628, 'actions', 'Actions'),
(629, 'no_data_found', 'No Data Found'),
(630, 'edit', 'Edit'),
(631, 'product_not_found', 'Medicine  not found'),
(632, 'request_failed_please_check_your_code_and_try_again', 'Request Failed, Please check your code and try again'),
(633, 'You_can_not_return_more_than_sold_quantity', 'You Can Not Return More than Sold quantity'),
(634, 'you_can_not_return_less_than_1', 'You Can Not Return Less than 1'),
(635, 'transection_details', 'Transection Details'),
(636, 'transection_details_datewise', 'Transection  Details Datewise'),
(637, 'transection_id', 'Transactions ID'),
(638, 'select_option', 'Select Option'),
(639, 'loan_list', 'Loan List'),
(640, 'todays_details', 'Todays Details'),
(641, 'transaction_details', 'Transaction Details'),
(642, 'person_id', 'Person ID'),
(643, 'total_transection', 'Total Transection'),
(644, 'transaction_id', 'Transaction ID'),
(645, 'transection_report', 'Transection Report'),
(646, 'add_transection', 'Add Transection'),
(647, 'manage_transection', 'Manage Transection'),
(648, 'select_id', 'Select ID'),
(649, 'choose_transection', 'Choose Transection'),
(650, 'update_transection', 'Update Transection'),
(651, 'manufacturer_all', 'Manufacturer All'),
(652, 'select_all', 'Select All'),
(653, 'all', 'All'),
(654, 'max_rate', 'Max Rate'),
(655, 'min_rate', 'Min Rate'),
(656, 'average_rate', 'Average Rate'),
(657, 'date_expired_please_choose_another.', 'Date Expired!! Please Choose another'),
(658, 'your_medicine_is_date_expiry_Please_choose_another', 'Your Medicine is Date Expiry !! Please Choose another'),
(659, 'meno', 'MEMO'),
(660, 'out_of_stock_and_date_expired_medicine', 'Out of Stock and Date Expired Medicine'),
(661, 'edit_profile', 'Edit Profile'),
(662, 'deposit_detail', 'Deposit detail'),
(663, 'new_deposit', 'New Deposit'),
(664, 'edit_deposit', 'Edit Deposit'),
(665, 'select_customer', 'Select Customer'),
(666, 'draw', 'Draw'),
(667, 'deposit', 'Deposit'),
(668, 'select_type', 'Select Type'),
(669, 'transaction_type', 'Transaction Type'),
(670, 'cash', 'Cash'),
(671, 'select_bank', 'Select Bank'),
(672, 'drawing', 'Drawing'),
(673, 'expenses', 'Expenses'),
(674, 'banking', 'Banking'),
(675, 'daily_closing', 'Daily Closing'),
(676, 'title', 'Title'),
(677, 'error_get_data_from_ajax', 'Error get data from ajax'),
(678, 'toggle_navigation', 'Toggle Navigation'),
(679, 'this_product_not_found', 'This Medicine  Not Found !'),
(680, 'search_by_date_from', 'Search By Date: From'),
(681, 'manufacturer_sales_report', 'Manufacturer Sales Report'),
(682, 'transection', 'Transection'),
(683, 'transection_mood', 'Transection Mood'),
(684, 'transection_categry', 'Transection Categry'),
(685, 'export_csv', 'Export CSV'),
(686, 'select manufacturer', 'Select Manufacturer'),
(687, 'customer_return', 'Customer Return'),
(688, 'return_form', 'Return Form'),
(689, 'data_not_found', 'Data Not Found'),
(690, 'export_csv', 'Export CSV'),
(691, 'manage_person', 'Manage Person'),
(692, 'backup', 'Back Up'),
(693, 'total_balance', 'Total Balance'),
(694, 'product_id_model_manufacturer_id_can_not_null', 'Medicine Id & Medicine Type & Manufacturer Id Can not be Blank'),
(695, 'product_name_can_not_be_null', 'Medicine  Name can Not be Blank'),
(696, 'product_model_can_not_be_null', 'Medicine  Model Can Not be Blank'),
(697, 'sms', 'SMS'),
(698, 'sms_configure', 'Sms Configuration'),
(699, 'url', 'Url'),
(700, 'sender_id', 'Sender ID'),
(701, 'api_key', 'Api Key'),
(702, 'barcode_or_qrcode', 'Barcode Or QRcode '),
(703, 'currency_name', 'Currency Name'),
(704, 'add_currency', 'Add Currency'),
(705, 'currency_icon', 'Currency Icon'),
(706, 'currency_list', 'Currency List'),
(707, 'import', 'Import'),
(708, 'c_o_a', 'Chart Of Account'),
(709, 'supplier_payment', 'Supplier Payment'),
(710, 'customer_receive', 'Customer Receive'),
(711, 'debit_voucher', 'Debit Voucher'),
(712, 'credit_voucher', 'Credit voucher'),
(713, 'voucher_approval', 'Voucher Approval'),
(714, 'contra_voucher', 'Contra Voucher'),
(715, 'journal_voucher', 'Journal Voucher'),
(716, 'voucher_report', 'Voucher Report'),
(717, 'cash_book', 'Cash Book'),
(718, 'inventory_ledger', 'Inventory Ledger'),
(719, 'bank_book', 'Bank Book'),
(720, 'general_ledger', 'General Ledger'),
(721, 'trial_balance', 'Trial Balance'),
(722, 'profit_loss_report', 'Profit Loss Report'),
(723, 'cash_flow', 'Cash Flow'),
(724, 'coa_print', 'COA Print'),
(725, 'manufacturer_payment', 'Manufacturer Payment'),
(726, 'add_more', 'Add More'),
(727, 'code', 'Code'),
(728, 'remark', 'Transaction Details'),
(729, 'voucher_no', 'Voucher NO'),
(730, 'accounts_tree_view', 'Accounts Tree view'),
(731, 'find', 'Find'),
(732, 'voucher_type', 'Voucher Type'),
(733, 'particulars', 'Particulars'),
(734, 'cash_flow_statement', 'Cash Flow Statement'),
(735, 'amount_in_dollar', 'Amount In Dollar'),
(736, 'opening_cash_and_equivalent', 'Opening Cash and Equivalent'),
(737, 'with_details', 'With Details'),
(738, 'transaction_head', 'Transaction Head'),
(739, 'gl_head', 'General Ledger Head'),
(740, 'no_report', 'No Report'),
(741, 'pre_balance', 'Pre Balance'),
(742, 'current_balance', 'Current Balance'),
(743, 'from_date', 'From Date'),
(744, 'to_date', 'To Date'),
(745, 'profit_loss', 'Profit Loss Statement'),
(746, 'add_expense_item', 'Add Expense Item'),
(747, 'manage_expense_item', 'Manage Expense Item'),
(748, 'add_expense', 'Add Expense'),
(749, 'manage_expense', 'Manage Expense'),
(750, 'expense_statement', 'Expense Statement'),
(751, 'expense_type', 'Expense Type'),
(752, 'expense_item_name', 'Expense Item Name'),
(753, 'opening_balance', 'Opening Balance'),
(754, 'tax_settings', 'Tax Settings'),
(755, 'add_incometax', 'Add Income Tax'),
(756, 'manage_income_tax', 'Manage Income tax'),
(757, 'tax_report', 'Tax Report'),
(758, 'invoice_wise_tax_report', 'Invoice Wise Tax Report'),
(759, 'number_of_tax', 'Number of Tax'),
(760, 'default_value', 'Default Value'),
(761, 'reg_no', 'Registration No'),
(762, 'tax_name', 'Tax Name'),
(763, 'service_id', 'Service Id'),
(764, 'service', 'Service'),
(765, 'add_service', 'Add Service'),
(766, 'manage_service', 'Manage Service'),
(767, 'service_invoice', 'Service Invoice'),
(768, 'manage_service_invoice', 'Manage Service Invoice'),
(769, 'service_name', 'Service Name'),
(770, 'charge', 'Charge'),
(771, 'add', 'Add'),
(772, 'previous', 'Previous'),
(773, 'net_total', 'Net Total'),
(774, 'hanging_over', 'Estimated Time Of Departure'),
(775, 'service_discount', 'Service Discount'),
(776, 'hrm', 'HRM'),
(777, 'add_designation', 'Add Designation'),
(778, 'manage_designation', 'Manage Designation'),
(779, 'add_employee', 'Add Employee'),
(780, 'manage_employee', 'Manage Employee'),
(781, 'attendance', 'Attendance'),
(782, 'add_attendance', 'Add Attendance'),
(783, 'manage_attendance', 'Manage Attendance'),
(784, 'attendance_report', 'Attendance Report'),
(785, 'payroll', 'Payroll'),
(786, 'add_benefits', 'Add Benefits'),
(787, 'manage_benefits', 'Manage Benefits'),
(788, 'add_salary_setup', 'Add Salary Setup'),
(789, 'manage_salary_setup', 'Manage Salary Setup'),
(790, 'salary_generate', 'Salary Generate'),
(791, 'manage_salary_generate', 'Manage Salary Generate'),
(792, 'salary_payment', 'Salary Payment'),
(793, 'designation', 'Designation'),
(794, 'rate_type', 'Rate Type'),
(795, 'hour_rate_or_salary', 'Hourly Rate/Salary'),
(796, 'blood_group', 'Blood Group'),
(797, 'address_line_1', 'Address Line 1'),
(798, 'address_line_2', 'Address Line 2'),
(799, 'picture', 'Picture'),
(800, 'country', 'Country'),
(801, 'city', 'City'),
(802, 'zip', 'Zip code'),
(803, 'single_checkin', 'Single Check In'),
(804, 'bulk_checkin', 'Bulk Check In'),
(805, 'checkin', 'Check In'),
(806, 'employee_name', 'Employee Name'),
(807, 'check_in', 'Check In'),
(808, 'checkout', 'Check Out'),
(809, 'confirm_clock', 'Confirm Clock'),
(810, 'stay', 'Stay'),
(811, 'download_sample_file', 'Download Sample File'),
(812, 'employee', 'Employee'),
(813, 'sign_in', 'Check In'),
(814, 'sign_out', 'Check  Out'),
(815, 'staytime', 'Stay Time'),
(816, 'benefits_list', 'Benefit List'),
(817, 'benefits', 'Benefits'),
(818, 'benefit_type', 'Benefit Type'),
(819, 'salary_benefits', 'Salary Benefits'),
(820, 'salary_benefits_type', 'Salary Benefits Type'),
(821, 'hourly', 'Hourly'),
(822, 'salary', 'Salary'),
(823, 'timezone', 'Time Zone'),
(824, 'request', 'Request'),
(825, 'datewise_report', 'Date Wise Report'),
(826, 'work_hour', 'Work Hours'),
(827, 'employee_wise_report', 'Employee Wise Report'),
(828, 'date_in_time_report', 'In Time Report'),
(829, 'successfully_checkout', 'Successfully Checked Out'),
(830, 'setup_tax', 'Setup Tax'),
(831, 'start_amount', 'Start Amount'),
(832, 'end_amount', 'End Amount'),
(833, 'tax_rate', 'Tax Rate'),
(834, 'setup', 'Setup'),
(835, 'income_tax_updateform', 'Income Tax Update Form'),
(836, 'salary_type', 'Salary Type'),
(837, 'addition', 'Addition'),
(838, 'gross_salary', 'Gross Salary'),
(839, 'set', 'Set'),
(840, 'salary_month', 'Salary Month'),
(841, 'generate', 'Generate '),
(842, 'total_salary', 'Total Salary'),
(843, 'total_working_minutes', 'Total Working Hours'),
(844, 'working_period', 'Total Working Days'),
(845, 'paid_by', 'Paid By'),
(846, 'pay_now', 'Pay Now ?'),
(847, 'confirm', 'Confirm'),
(848, 'generate_by', 'Generate By'),
(849, 'gui_pos', 'GUI POS'),
(850, 'add_fixed_assets', 'Add Fixed Assets'),
(851, 'fixed_assets_list', 'Fixed Asset List'),
(852, 'fixed_assets_purchase', 'Purchase Fixed Assets'),
(853, 'fixed_assets_purchase_manage', 'Fixed Assets Purchase List'),
(854, 'fixed_assets', 'Fixed Assets'),
(855, 'item_code', 'Item code'),
(856, 'item_name', 'Item Name'),
(857, 'opening_assets', 'Assets Qty'),
(858, 'edit_fixed_asset', 'Edit Fixed Assets'),
(859, 'save_change', 'Save Change'),
(860, 'in_word', 'In Word'),
(861, 'purchase_pad_print', 'Purchase Pad Print'),
(862, 'fixed_assets_purchase_details', 'Fixed Assets Purchase Details'),
(863, 'manage_language', 'Manage Language'),
(864, 'person_edit', 'Person Edit'),
(865, 'person_ledger', 'Person Ledger'),
(866, 'medicine_name', 'Medicine Name'),
(867, 'unit_list', 'Unit List'),
(868, 'add_unit', 'Add Unit'),
(869, 'edit_unit', 'Edit Unit'),
(870, 'unit_name', 'Unit Name'),
(871, 'unit_not_selected', 'Unit did not Selected'),
(872, 'supplier', 'Supplier'),
(873, 'add_supplier', 'Add Supplier'),
(874, 'manage_supplier', 'Manage Supplier'),
(875, 'supplier_ledger', 'Supplier Ledger'),
(876, 'supplier_sales_details', 'Supplier Sales Details'),
(877, 'purchase_detail', 'Purchase details'),
(878, 'purchase_information', 'Purchase Information'),
(879, 'account_head', 'Account Head'),
(880, 'transaction_date', 'Transaction Date'),
(881, 'approved', 'Approve'),
(882, 'date_wise_report', 'Date Wise Report'),
(883, 'time_wise_report', 'Time Wise Report'),
(884, 'report_date', 'Report Date'),
(885, 's_time', 'Start Time'),
(886, 'e_time', 'End Time'),
(887, 'basic', 'Basic'),
(888, 'supplier_name', 'Supplier Name'),
(889, 'supplier_mobile', 'Supplier Mobile'),
(890, 'supplier_address', 'Supplier Address'),
(891, 'supplier_details', 'Supplier Details'),
(892, 'select_supplier', 'Select Supplier'),
(893, 'accounts_report', 'Accounts Report'),
(894, 'account_code', 'Account Code'),
(895, 'human_resource_management', 'Human Resource '),
(896, 'menu_name', 'Menu Name'),
(897, 'head_of_account', 'Account Head'),
(898, 'successfully_approved', 'Successfully Approved'),
(899, 'supplier_edit', 'Supplier Edit'),
(900, 'supplier_id', 'Supplier ID'),
(901, 'strength', 'Strength'),
(902, 'out_of_date', 'Out Of Date'),
(903, 'dis', 'Dis'),
(904, 'date_expired_please_choose_another', 'Date Expire Please Choose another'),
(905, 'expired', 'Expired'),
(906, 'cash_adjustment', 'Cash Adjustment'),
(907, 'adjustment_type', 'Adjustment Type'),
(908, 'cash_payment', 'Cash Payment'),
(909, 'bank_payment', 'Bank Payment'),
(910, 'yes', 'Yes'),
(911, 'no', 'No'),
(912, 'credit_account_head', 'Credit Account Head'),
(913, 'general_ledger_of', 'General Ledger Of'),
(914, 'debit_account_head', 'Debit Account Head'),
(915, 'update_successfully', 'Successfully Updated'),
(916, 'statement_of_comprehensive_income', 'Statement of Comprehensive Income'),
(917, 'deduct', 'Deduct'),
(918, 'payslip', 'Payslip'),
(919, 'salary_slip', 'Salary Slip'),
(920, 'salary_date', 'Salary Date'),
(921, 'earnings', 'Earnings'),
(922, 'basic_salary', 'Basic Salary'),
(923, 'total_addition', 'Total Addition'),
(924, 'total_deduction', 'Total Deduction'),
(925, 'net_salary', 'Net Salary'),
(926, 'ref_number', 'Reference No'),
(927, 'employee_signature', 'Employee Signature'),
(928, 'authorized_signature', 'Authorized Signature'),
(929, 'chairman', 'Chairman'),
(930, 'bank_ledger', 'Bank Ledger'),
(931, 'api_secret', 'Api Secret'),
(932, 'service_csv_upload', 'Service Csv Upload'),
(933, 'shipping_cost', 'Shipping Cost'),
(934, 'customer_advance', 'Customer Advance'),
(935, 'customer_csv_upload', 'Customer CSV Upload'),
(936, 'contact', 'Contact'),
(937, 'fax', 'Fax'),
(938, 'state', 'State'),
(939, 'address1', 'Address1'),
(940, 'address2', 'Address2'),
(941, 'manufacturer_advance', 'Manufacturer Advance'),
(942, 'csv_upload_manufacturer', 'CSV Upload Manufacturer'),
(943, 'restore', 'Restore '),
(944, 'advance_type', 'Advance Type'),
(945, 'receive', 'Receive'),
(946, 'note_name', 'Notes'),
(947, 'pcs', 'PCS'),
(948, 'do_you_want_to_print', 'Do You Want To Print ?'),
(949, 'the_salary_of', NULL),
(950, 'already_generated', 'Already Generated'),
(951, 'successfully_generated', 'Successfully Generated'),
(952, 'service_edit', 'Service Edit'),
(953, 'signature', 'Signature'),
(954, 'manage', 'Manage'),
(955, 'income_expense_statement', 'Income Expense Statement'),
(956, 'cash_received', 'Cash Received'),
(957, 'bank_received', 'Bank Received'),
(958, 'total_due', 'Total Due'),
(959, 'total_service', 'Total Service'),
(960, 'type_not_selected', 'Type did not Selected');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer_information`
--

CREATE TABLE IF NOT EXISTS `manufacturer_information` (
  `manufacturer_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `manufacturer_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `emailnumber` varchar(200) DEFAULT NULL,
  `email_address` varchar(200) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `city` text DEFAULT NULL,
  `state` text DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  PRIMARY KEY (`manufacturer_id`),
  KEY `manufacturer_id` (`manufacturer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `description`, `image`, `directory`, `status`) VALUES
(1, 'Invoice', '', '', 'invoice', 1),
(2, 'Customer', '', '', 'customer', 1),
(3, 'Medicine', '', '', 'medicine', 1),
(4, 'Manufacturer', '', '', 'manufacturer', 1),
(5, 'Purchase', '', '', 'purchase', 1),
(6, 'Stock', '', '', 'stock', 1),
(7, 'Return', '', '', 'return', 1),
(8, 'Report', '', '', 'report', 1),
(9, 'Accounts', '', '', 'accounts', 1),
(10, 'Bank', '', '', 'bank', 1),
(11, 'Tax', '', '', 'tax', 1),
(12, 'Human Resource', '', '', 'human_resource_info', 1),
(13, 'Supplier', '', '', 'supplier', 1),
(14, 'Service', '', '', 'service', 1),
(15, 'Search', '', '', 'search', 1),
(16, 'Settings', '', '', 'settings', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_tax_setup`
--

CREATE TABLE IF NOT EXISTS `payroll_tax_setup` (
  `tax_setup_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `end_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `rate` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`tax_setup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `personal_loan`
--

CREATE TABLE IF NOT EXISTS `personal_loan` (
  `per_loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(30) NOT NULL,
  `person_id` varchar(30) NOT NULL,
  `debit` varchar(20) NOT NULL,
  `credit` float NOT NULL,
  `date` varchar(30) NOT NULL,
  `details` varchar(100) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=no paid,2=paid',
  PRIMARY KEY (`per_loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person_information`
--

CREATE TABLE IF NOT EXISTS `person_information` (
  `person_id` varchar(50) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `person_phone` varchar(50) NOT NULL,
  `person_address` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person_ledger`
--

CREATE TABLE IF NOT EXISTS `person_ledger` (
  `transaction_id` varchar(50) NOT NULL,
  `person_id` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `debit` decimal(12,2) NOT NULL DEFAULT 0.00,
  `credit` decimal(10,2) NOT NULL DEFAULT 0.00,
  `details` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=no paid,2=paid',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pesonal_loan_information`
--

CREATE TABLE IF NOT EXISTS `pesonal_loan_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` varchar(50) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `person_phone` varchar(30) NOT NULL,
  `person_address` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_information`
--

CREATE TABLE IF NOT EXISTS `product_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(30) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `generic_name` varchar(250) NOT NULL,
  `strength` varchar(250) NOT NULL,
  `box_size` varchar(30) NOT NULL,
  `product_location` varchar(50) NOT NULL,
  `price` varchar(20) NOT NULL,
  `tax` varchar(20) DEFAULT NULL,
  `product_model` varchar(50) DEFAULT NULL,
  `manufacturer_id` bigint(20) NOT NULL,
  `manufacturer_price` decimal(10,2) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `product_details` varchar(250) DEFAULT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `manufacturer_id` (`manufacturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase`
--

CREATE TABLE IF NOT EXISTS `product_purchase` (
  `chalan_no` varchar(100) NOT NULL,
  `manufacturer_id` varchar(100) NOT NULL,
  `grand_total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_discount` decimal(10,2) DEFAULT 0.00,
  `purchase_date` varchar(50) NOT NULL,
  `purchase_details` text NOT NULL,
  `status` int(2) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(30) NOT NULL,
  `bank_id` varchar(30) DEFAULT NULL,
  `payment_type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `manufacturer_id` (`manufacturer_id`),
  KEY `purchase_id` (`purchase_id`),
  KEY `bank_id` (`bank_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_purchase_details`
--

CREATE TABLE IF NOT EXISTS `product_purchase_details` (
  `purchase_detail_id` varchar(100) NOT NULL,
  `purchase_id` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `quantity` decimal(12,2) NOT NULL DEFAULT 0.00,
  `rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) DEFAULT 0.00,
  `batch_id` varchar(25) NOT NULL,
  `expeire_date` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `purchase_id` (`purchase_id`),
  KEY `product_id` (`product_id`),
  KEY `batch_id` (`batch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_return`
--

CREATE TABLE IF NOT EXISTS `product_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_id` varchar(30) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `purchase_id` varchar(30) DEFAULT NULL,
  `date_purchase` varchar(20) NOT NULL,
  `date_return` varchar(30) NOT NULL,
  `byy_qty` decimal(12,2) NOT NULL DEFAULT 0.00,
  `ret_qty` decimal(10,2) NOT NULL DEFAULT 0.00,
  `customer_id` varchar(20) NOT NULL,
  `manufacturer_id` varchar(30) NOT NULL,
  `product_rate` decimal(12,2) NOT NULL DEFAULT 0.00,
  `deduction` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_deduct` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_tax` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_ret_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `net_total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `reason` text NOT NULL,
  `usablity` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_service`
--

CREATE TABLE IF NOT EXISTS `product_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` varchar(255) DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE IF NOT EXISTS `role_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `create` tinyint(1) DEFAULT NULL,
  `read` tinyint(1) DEFAULT NULL,
  `update` tinyint(1) DEFAULT NULL,
  `delete` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_module_id` (`fk_module_id`),
  KEY `fk_user_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salary_sheet_generate`
--

CREATE TABLE IF NOT EXISTS `salary_sheet_generate` (
  `ssg_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `gdate` varchar(30) DEFAULT NULL,
  `start_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `end_date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `generate_by` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`ssg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salary_type`
--

CREATE TABLE IF NOT EXISTS `salary_type` (
  `salary_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `sal_name` varchar(100) NOT NULL,
  `salary_type` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`salary_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sec_role`
--

CREATE TABLE IF NOT EXISTS `sec_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sec_userrole`
--

CREATE TABLE IF NOT EXISTS `sec_userrole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `roleid` int(11) NOT NULL,
  `createby` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `createdate` datetime DEFAULT NULL,
  UNIQUE KEY `ID` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_invoice`
--

CREATE TABLE IF NOT EXISTS `service_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucher_no` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  `total_amount` decimal(20,2) NOT NULL DEFAULT 0.00,
  `total_discount` decimal(20,2) NOT NULL DEFAULT 0.00,
  `invoice_discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `due_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `previous` decimal(10,2) NOT NULL DEFAULT 0.00,
  `details` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id` (`employee_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_invoice_details`
--

CREATE TABLE IF NOT EXISTS `service_invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `service_inv_id` varchar(30) NOT NULL,
  `qty` decimal(10,2) NOT NULL DEFAULT 0.00,
  `charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `service_inv_id` (`service_inv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sms_settings`
--

CREATE TABLE IF NOT EXISTS `sms_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(100) DEFAULT NULL,
  `api_secret` varchar(100) DEFAULT NULL,
  `from` varchar(100) DEFAULT NULL,
  `isinvoice` int(11) NOT NULL DEFAULT 0,
  `ispurchase` int(11) DEFAULT 0,
  `isservice` int(11) NOT NULL DEFAULT 0,
  `isreceive` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sms_settings`
--

INSERT INTO `sms_settings` (`id`, `api_key`, `api_secret`, `from`, `isinvoice`, `ispurchase`, `isservice`, `isreceive`) VALUES
(1, '60d6748a', 'NrW61s2AfTbgYkNk', 'isahaq', 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_fixed_asset`
--

CREATE TABLE IF NOT EXISTS `stock_fixed_asset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `item_code` varchar(50) NOT NULL,
  `qty` float NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sub_module`
--

CREATE TABLE IF NOT EXISTS `sub_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `directory` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_module`
--

INSERT INTO `sub_module` (`id`, `mid`, `name`, `description`, `image`, `directory`, `status`) VALUES
(1, 1, 'New Invoice', '', '', 'new_invoice', 1),
(2, 1, 'Manage Invoice', '', '', 'manage_invoice', 1),
(3, 1, 'POS INVOICE', '', '', 'pos_invoice', 1),
(4, 1, 'GUI POS', '', '', 'gui_pos', 1),
(5, 9, 'Chart Of Account', '', '', 'show_tree', 1),
(6, 9, 'Manufacturer Payment', '', '', 'manufacturer_payment', 1),
(7, 9, 'Supplier Payment', '', '', 'supplier_payment', 1),
(8, 9, 'Customer Receive', '', '', 'customer_receive', 1),
(9, 9, 'Debit Voucher', '', '', 'debit_voucher', 1),
(10, 9, 'Credit Voucher', '', '', 'credit_voucher', 1),
(11, 9, 'Contra Voucher', '', '', 'contra_voucher', 1),
(12, 9, 'Journal Voucher', '', '', 'journal_voucher', 1),
(13, 9, 'Voucher Approval', '', '', 'aprove_v', 1),
(14, 9, 'Report', '', '', 'ac_report', 1),
(15, 9, 'Cash Book', '', '', 'cash_book', 1),
(16, 9, 'Bank Book', '', '', 'bank_book', 1),
(17, 9, 'General Ledger', '', '', 'general_ledger', 1),
(18, 9, 'Inventory Ledger', '', '', 'Inventory_ledger', 1),
(19, 9, 'Cash Flow', '', '', 'cash_flow_report', 1),
(20, 9, 'Profit Loss Statement', '', '', 'profit_loss_report', 1),
(21, 9, 'Trial Balance', '', '', 'trial_balance', 1),
(22, 3, 'Category', '', '', 'add_category', 1),
(23, 3, 'Medicine Type', '', '', 'medicine_type', 1),
(24, 3, 'Add Medicine', '', '', 'add_medicine', 1),
(25, 3, 'Import Medicine(CSV)', '', '', 'import_medicine_csv', 1),
(26, 3, 'Manage Medicine', '', '', 'manage_medicine', 1),
(27, 2, 'Add Customer', '', '', 'add_customer', 1),
(28, 2, 'Manage Customer', '', '', 'manage_customer', 1),
(29, 2, 'Credit Customer', '', '', 'credit_customer', 1),
(30, 2, 'Paid Customer', '', '', 'paid_customer', 1),
(31, 4, 'Add Manufacturer', '', '', 'add_manufacturer', 1),
(32, 4, 'Manage Manufacturer', '', '', 'manage_manufacturer', 1),
(33, 4, 'Manufacturer Ledger', '', '', 'manufacturer_ledger', 1),
(34, 4, 'Manufacturer Sales Details', '', '', 'manufacturer_sales_details', 1),
(35, 5, 'Add Purchase', '', '', 'add_purchase', 1),
(36, 5, 'Manage Purchase', '', '', 'manage_purchase', 1),
(37, 12, 'Add Designation', '', '', 'add_designation', 1),
(38, 12, 'Manage Designation', '', '', 'manage_designation', 1),
(39, 12, 'Add Employee', '', '', 'add_employee', 1),
(40, 12, 'Manage Employee', '', '', 'manage_employee', 1),
(41, 12, 'Add Attendance', '', '', 'add_attendance', 1),
(42, 12, 'Manage Attendance', '', '', 'manage_attendance', 1),
(43, 12, 'Attendance Report', '', '', 'attendance_report', 1),
(44, 12, 'Add Benefits', '', '', 'add_benefits', 1),
(45, 12, 'Manage Benefits', '', '', 'manage_benefits', 1),
(46, 12, 'Add Salary Setup', '', '', 'add_salary_setup', 1),
(47, 12, 'Manage Salary Setup', '', '', 'manage_salary_setup', 1),
(48, 12, 'Salary Generate', '', '', 'salary_generate', 1),
(49, 12, 'Manage Salary Generate', '', '', 'manage_salary_generate', 1),
(50, 12, 'Salary Payment', '', '', 'salary_payment', 1),
(51, 12, 'Add Expense Item', '', '', 'add_expense_item', 1),
(52, 12, 'Manage Expense Item', '', '', 'manage_expense_item', 1),
(53, 12, 'Add Expense', '', '', 'add_expense', 1),
(54, 12, 'Manage Expense', '', '', 'manage_expense', 1),
(55, 12, 'Add Fixed Assets', '', '', 'add_fixed_assets', 1),
(56, 12, 'Fixed Asset List', '', '', 'fixed_assets_list', 1),
(57, 12, 'Purchase Fixed Assets', '', '', 'fixed_assets_purchase', 1),
(58, 12, 'Fixed Asset Purchase List', '', '', 'fixed_assets_purchase_manage', 1),
(59, 16, 'Manage Company', '', '', 'manage_company', 1),
(60, 7, 'Return', '', '', 'return', 1),
(61, 7, 'Stock Return List', '', '', 'stock_return_list', 1),
(62, 7, 'Manufacturer Return List', '', '', 'manufacturer_return_list', 1),
(63, 7, 'Wastage Return List', '', '', 'wastage_return_list', 1),
(64, 15, 'Medicine', '', '', 'medicine_search', 1),
(65, 15, 'Customer', '', '', 'customer_search', 1),
(66, 15, 'Invoice', '', '', 'invoice_search', 1),
(67, 15, 'Purchase', '', '', 'purcahse_search', 1),
(68, 14, 'Add Service', '', '', 'create_service', 1),
(69, 14, 'Manage Service', '', '', 'manage_service', 1),
(70, 14, 'Service Invoice', '', '', 'service_invoice', 1),
(71, 14, 'Manage Service Invoice', '', '', 'manage_service_invoice', 1),
(72, 11, 'Tax Settings', '', '', 'tax_settings', 1),
(73, 11, 'Add Income Tax', '', '', 'add_incometax', 1),
(74, 11, 'Manage Income Tax', '', '', 'manage_income_tax', 1),
(75, 11, 'Tax Report', '', '', 'tax_report', 1),
(76, 11, 'Invoice Wise Tax Report', '', '', 'invoice_wise_tax_report', 1),
(77, 6, 'Stock Report', '', '', 'stock_report', 1),
(80, 6, 'Stock Report(Batch Wise)', '', '', 'stock_report_batch_wise', 1),
(81, 8, 'Today\'s Report', '', '', 'todays_report', 1),
(82, 8, 'Sales Report', '', '', 'sales_report', 1),
(83, 8, 'Purchase Report', '', '', 'purchase_report', 1),
(84, 8, 'Sales Report(Medicine Wise)', '', '', 'sales_report_medicine_wise', 1),
(85, 8, 'Profit/Loss', '', '', 'profit_loss', 1),
(86, 10, 'Add New Bank', '', '', 'add_new_bank', 1),
(87, 10, 'Bank Transaction', '', '', 'bank_transaction', 1),
(88, 10, 'Manage Bank', '', '', 'manage_bank', 1),
(89, 12, 'Add Person(Personal Loan)', '', '', 'office_add_person', 1),
(90, 12, 'Manage Person(Personal Loan)', '', '', 'office_manage_loan', 1),
(91, 12, 'Add Person(Office Loan)', '', '', 'personal_add_person', 1),
(92, 12, 'Add Loan(Office Loan)', '', '', 'personal_add_loan', 1),
(93, 12, 'Add Payment(Office Loan)', '', '', 'personal_add_payment', 1),
(94, 12, 'Manage Loan(Office Loan)', '', '', 'personal_manage_loan', 1),
(95, 16, 'Add User', '', '', 'add_user', 1),
(96, 16, 'Manage Users', '', '', 'manage_users', 1),
(97, 16, 'Lanaguage', '', '', 'language', 1),
(98, 16, 'Currency', '', '', 'currency', 1),
(99, 16, 'Web Setting', '', '', 'soft_setting', 1),
(100, 16, 'Add Role', '', '', 'add_role', 1),
(101, 16, 'Role List', '', '', 'role_list', 1),
(102, 16, 'Assign User Role', '', '', 'user_assign_role', 1),
(103, 16, 'Permission', '', '', 'permission', 1),
(104, 16, 'SMS', '', '', 'configure_sms', 1),
(105, 3, 'Add Unit', '', '', 'add_unit', 1),
(106, 3, 'Unit List', '', '', 'unit_list', 1),
(107, 13, 'Add Supplier', '', '', 'add_supplier', 1),
(108, 13, 'Manage Supplier', '', '', 'manage_supplier', 1),
(109, 13, 'Supplier Ledger', '', '', 'supplier_ledger', 1),
(110, 9, 'COA Print', '', '', 'coa_print', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_information`
--

CREATE TABLE IF NOT EXISTS `supplier_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` varchar(100) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `details` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_ledger`
--

CREATE TABLE IF NOT EXISTS `supplier_ledger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `chalan_no` varchar(100) DEFAULT NULL,
  `deposit_no` varchar(50) DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `description` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `cheque_no` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `status` int(2) NOT NULL,
  `d_c` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `synchronizer_setting`
--

CREATE TABLE IF NOT EXISTS `synchronizer_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `port` varchar(10) NOT NULL,
  `debug` varchar(10) NOT NULL,
  `project_root` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tax_collection`
--

CREATE TABLE IF NOT EXISTS `tax_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  `relation_id` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tax_information`
--

CREATE TABLE IF NOT EXISTS `tax_information` (
  `tax_id` varchar(15) NOT NULL,
  `tax` float DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`tax_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tax_settings`
--

CREATE TABLE IF NOT EXISTS `tax_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `default_value` float NOT NULL,
  `tax_name` varchar(250) NOT NULL,
  `nt` int(11) NOT NULL,
  `reg_no` varchar(100) DEFAULT NULL,
  `is_show` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE IF NOT EXISTS `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(15) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(250) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` int(2) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `logo` varchar(250) DEFAULT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `last_name`, `first_name`, `company_name`, `address`, `phone`, `gender`, `date_of_birth`, `logo`, `status`) VALUES
(1, '2', 'User', 'Admin', NULL, NULL, NULL, NULL, NULL, 'http://localhost/saleserp_v9.8/assets/dist/img/profile_picture/profile.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` int(2) DEFAULT NULL,
  `security_code` varchar(255) DEFAULT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `user_id`, `username`, `password`, `user_type`, `security_code`, `status`) VALUES
(1, '2', 'admin@example.com', '41d99b369894eb1ec3f461135132d8bb', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `web_setting`
--

CREATE TABLE IF NOT EXISTS `web_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) DEFAULT NULL,
  `invoice_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `timezone` varchar(200) DEFAULT NULL,
  `currency_position` varchar(10) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `rtr` varchar(255) DEFAULT NULL,
  `captcha` int(11) DEFAULT 1 COMMENT '0=active,1=inactive',
  `site_key` varchar(250) DEFAULT NULL,
  `secret_key` varchar(250) DEFAULT NULL,
  `discount_type` int(11) DEFAULT 1,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `web_setting`
--

INSERT INTO `web_setting` (`setting_id`, `logo`, `invoice_logo`, `favicon`, `currency`, `timezone`, `currency_position`, `footer_text`, `language`, `rtr`, `captcha`, `site_key`, `secret_key`, `discount_type`) VALUES
(1, 'http://softest8.bdtask.com/pharmacysasmodel/./my-assets/image/logo/5df28e7f70df1725d5763d7a925e9915.png', 'http://softest8.bdtask.com/pharmacysasmodel/my-assets/image/logo/ef9ff92adbea3b2d1afe4cfa8b02c04c.png', 'http://softest8.bdtask.com/pharmacysasmodel/my-assets/image/logo/ba8f3211bb73f7bcc05f7a3b5b91aef6.png', '$', 'Asia/Dhaka', '0', 'Copyright© 2020 bdtask. All rights reserved.', 'english', '0', 1, '', '', 1);
