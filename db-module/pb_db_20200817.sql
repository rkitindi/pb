/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pb_db`
--
-- -----------------------------------------------------
-- Schema pb_db
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `pb_db` ;

-- -----------------------------------------------------
-- Schema pb_db
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pb_db` DEFAULT CHARACTER SET utf8 ;
USE `pb_db` ;

-- --------------------------------------------------------

--
-- Table structure for table `action_tbl_at`
--

CREATE TABLE `action_tbl_at` (
  `TransactionID` int(11) NOT NULL,
  `EmployeeID` varchar(255) NOT NULL,
  `FormName` varchar(255) NOT NULL,
  `ActionTaken` varchar(255) NOT NULL,
  `AccessDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bankinfo_hr`
--

CREATE TABLE `bankinfo_hr` (
  `BankInfoId` int(11) NOT NULL,
  `EmployeeId` varchar(255) NOT NULL,
  `BankName` varchar(255) NOT NULL,
  `BankCode` varchar(255) NOT NULL,
  `BranchName` varchar(255) NOT NULL,
  `BranchCodeNumber` varchar(255) NOT NULL,
  `AccountNumber` int(11) NOT NULL,
  `CLABE` int(11) NOT NULL,
  `AccountType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bankinfo_hr`
--

INSERT INTO `bankinfo_hr` (`BankInfoId`, `EmployeeId`, `BankName`, `BankCode`, `BranchName`, `BranchCodeNumber`, `AccountNumber`, `CLABE`, `AccountType`) VALUES
(1, 'mm1002', 'BBVA', 'BBXXVA', 'REFORMA', '22', 1111111111, 2147483647, 'CHECKING');

-- --------------------------------------------------------

--
-- Table structure for table `batchdetails_acc`
--

CREATE TABLE `batchdetails_acc` (
  `BatchId` int(11) NOT NULL,
  `ControlNumber` int(11) NOT NULL,
  `BatchRangeId` varchar(255) NOT NULL,
  `SupplierId` varchar(255) NOT NULL,
  `RegNumber` varchar(255) NOT NULL,
  `DateDispatched` date NOT NULL,
  `DateArrived` date NOT NULL,
  `BatchDocument` varchar(255) NOT NULL,
  `RangeCycle` int(11) NOT NULL,
  `ProductCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batchdetails_acc`
--

INSERT INTO `batchdetails_acc` (`BatchId`, `ControlNumber`, `BatchRangeId`, `SupplierId`, `RegNumber`, `DateDispatched`, `DateArrived`, `BatchDocument`, `RangeCycle`, `ProductCount`) VALUES
(42, 10, 'range001', 'sup003', 'uiy76854', '2019-12-01', '2019-12-03', '', 1, 2),
(43, 100, 'range002', 'sup004', 'we2344rf', '2019-12-05', '2019-12-07', '', 1, 3),
(44, 200, 'range003', 'sup003', 'we2344rf', '2019-12-08', '2019-12-11', '../batchdocuments/switch1.png', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `batchexp_acc`
--

CREATE TABLE `batchexp_acc` (
  `BatchExpId` int(11) NOT NULL,
  `BatchId` int(11) NOT NULL,
  `FreighCost` int(11) NOT NULL,
  `iva` int(11) NOT NULL,
  `retiva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batchexp_acc`
--

INSERT INTO `batchexp_acc` (`BatchExpId`, `BatchId`, `FreighCost`, `iva`, `retiva`) VALUES
(3, 44, 23400, 3744, 936);

-- --------------------------------------------------------

--
-- Table structure for table `batchrange_acc`
--

CREATE TABLE `batchrange_acc` (
  `BatchRangeId` varchar(255) NOT NULL,
  `StartingNumber` int(11) NOT NULL,
  `EndingNumber` int(11) NOT NULL,
  `SFIndication` varchar(1) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `batchrange_acc`
--

INSERT INTO `batchrange_acc` (`BatchRangeId`, `StartingNumber`, `EndingNumber`, `SFIndication`, `Description`) VALUES
('range001', 1, 99, 'N', 'Range 001'),
('range002', 100, 199, 'Y', 'Range 002'),
('range003', 200, 299, 'N', 'Range 003'),
('range004', 300, 399, 'N', 'Range 004'),
('range005', 400, 499, 'N', 'Range 005');

-- --------------------------------------------------------

--
-- Table structure for table `casedetails_prod`
--

CREATE TABLE `casedetails_prod` (
  `CaseCode` varchar(255) NOT NULL,
  `CaseName` varchar(255) NOT NULL,
  `BrandId` int(11) NOT NULL,
  `CasePhoto` varchar(255) DEFAULT NULL,
  `PurchasePrice` int(11) NOT NULL,
  `SupplierId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `casedetails_prod`
--

INSERT INTO `casedetails_prod` (`CaseCode`, `CaseName`, `BrandId`, `CasePhoto`, `PurchasePrice`, `SupplierId`) VALUES
('case001', 'Princess#1', 1, '../case_photos/BOOKS_ORDERED_AMAZON_08012019.JPG', 67, 'sup002'),
('case002', 'Princess#2', 3, '', 23, 'sup002');

-- --------------------------------------------------------

--
-- Table structure for table `collectpayment_sal`
--

CREATE TABLE `collectpayment_sal` (
  `PaymentRef` int(11) NOT NULL,
  `SalesRef` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `PaymentDate` datetime NOT NULL,
  `Attachment` varchar(255) DEFAULT NULL,
  `Confirmation` varchar(1) NOT NULL,
  `Comments` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customerdetails_sal`
--

CREATE TABLE `customerdetails_sal` (
  `CustomerId` varchar(255) NOT NULL,
  `BusinessName` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `Phonenumber` int(11) NOT NULL,
  `ContactName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customerdetails_sal`
--

INSERT INTO `customerdetails_sal` (`CustomerId`, `BusinessName`, `Location`, `EmailAddress`, `Phonenumber`, `ContactName`) VALUES
('cust001', 'Lorenzo Business Name', 'Lorenzo Business Address', 'lorenzo@business.net', 1234567898, 'Lorenzo Tejedor'),
('cust002', 'Eva Business Name', 'Eva Business Address', 'eva@enabusiess.net', 2147483647, 'Eva Molina'),
('GENERAL', 'General', 'General', 'general@general.net', 2147483647, 'Generak');

-- --------------------------------------------------------

--
-- Table structure for table `department_hr`
--

CREATE TABLE `department_hr` (
  `DepartmentId` int(11) NOT NULL,
  `DepartmentName` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department_hr`
--

INSERT INTO `department_hr` (`DepartmentId`, `DepartmentName`, `Description`) VALUES
(1, 'hr', 'Human Resources Department'),
(2, 'finance', 'Finance department'),
(3, 'administration', 'Admin department'),
(4, 'accounting', 'Accounting department'),
(5, 'sales', 'Sales department'),
(6, 'production', 'All employees in Chiapas'),
(7, 'test', 'testing code');

-- --------------------------------------------------------

--
-- Table structure for table `dispatchproduct_acc`
--

CREATE TABLE `dispatchproduct_acc` (
  `DispatchRefNum` int(11) NOT NULL,
  `ProductReceiptNumber` int(11) NOT NULL,
  `POSId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `DateDispatched` datetime NOT NULL,
  `Dispatched` varchar(1) NOT NULL,
  `Comments` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dispatchproduct_acc`
--

INSERT INTO `dispatchproduct_acc` (`DispatchRefNum`, `ProductReceiptNumber`, `POSId`, `Quantity`, `DateDispatched`, `Dispatched`, `Comments`) VALUES
(7, 7, 22, 20, '2019-12-21 00:00:00', 'Y', ''),
(8, 7, 27, 25, '2019-12-21 00:00:00', 'Y', '');

-- --------------------------------------------------------

--
-- Table structure for table `emergencycontact_hr`
--

CREATE TABLE `emergencycontact_hr` (
  `eContactId` int(11) NOT NULL,
  `EmployeeId` varchar(255) NOT NULL,
  `FirstNames` varchar(255) NOT NULL,
  `LastNames` varchar(255) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` int(11) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Relationship` varchar(255) NOT NULL,
  `Other` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emergencycontact_hr`
--

INSERT INTO `emergencycontact_hr` (`eContactId`, `EmployeeId`, `FirstNames`, `LastNames`, `Email`, `Phone`, `Address`, `Relationship`, `Other`) VALUES
(1, 'am1234', 'Alonzo Moya', 'Lucas Feijoo', 'alonzo@email.net', 2147483647, 'Alonzo Moya home address', 'Child', ''),
(2, 'rk4000', 'Emilia Elvira', 'Dante Feijoo', '', 2147483647, 'Emilia Elvira home address', 'other', 'Neighbour');

-- --------------------------------------------------------

--
-- Table structure for table `employeedeptinfo_hr`
--

CREATE TABLE `employeedeptinfo_hr` (
  `EmpDeptInfoId` int(11) NOT NULL,
  `EmployeeId` varchar(255) NOT NULL,
  `DepartmentId` int(11) NOT NULL,
  `PositionTitle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employeedeptinfo_hr`
--

INSERT INTO `employeedeptinfo_hr` (`EmpDeptInfoId`, `EmployeeId`, `DepartmentId`, `PositionTitle`) VALUES
(1, 'am1234', 1, 'HR Manager'),
(2, 'rk4000', 3, 'CEO'),
(3, 'em0002', 6, 'PRODUCTION Manager'),
(4, 'EM0003', 4, 'ACCOUNTING Manager'),
(5, 'ER5000', 5, 'SALES Manager'),
(6, 'jc4002', 5, 'SALES Associate'),
(7, 'jd4001', 5, 'SALES Associate'),
(8, 'mm1002', 2, 'FINANCE Manager'),
(9, 'pr6000', 1, 'Accountant'),
(10, 'LM0001', 6, 'hhh');

-- --------------------------------------------------------

--
-- Table structure for table `employmenttypeinfo_hr`
--

CREATE TABLE `employmenttypeinfo_hr` (
  `EmpTypeInfoId` int(11) NOT NULL,
  `EmployeeId` varchar(255) NOT NULL,
  `EmpTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employmenttypeinfo_hr`
--

INSERT INTO `employmenttypeinfo_hr` (`EmpTypeInfoId`, `EmployeeId`, `EmpTypeId`) VALUES
(1, 'am1234', 2),
(2, 'em0002', 2),
(3, 'EM0003', 4),
(4, 'ER5000', 3),
(5, 'jc4002', 5),
(6, 'jd4001', 2),
(7, 'JI0001', 3),
(8, 'JI0001', 3),
(9, 'mm1002', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employmenttype_hr`
--

CREATE TABLE `employmenttype_hr` (
  `EmpTypeId` int(11) NOT NULL,
  `EmploymentType` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employmenttype_hr`
--

INSERT INTO `employmenttype_hr` (`EmpTypeId`, `EmploymentType`, `Description`) VALUES
(2, 'fulltime', 'Full time employment'),
(3, 'parttime', 'Part time employment'),
(4, 'contractor', 'Consulting Opportunity'),
(5, 'casual', 'Day bu Day employment'),
(6, 'test', 'testing the code');

-- --------------------------------------------------------

--
-- Table structure for table `expensetype_prod`
--

CREATE TABLE `expensetype_prod` (
  `ExpTypeId` int(11) NOT NULL,
  `ExpenseType` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expensetype_prod`
--

INSERT INTO `expensetype_prod` (`ExpTypeId`, `ExpenseType`, `Description`) VALUES
(1, 'administrative', 'Administrative expenses'),
(2, 'loading', 'Loading Truck of banana'),
(3, 'unloading', 'Unloading truck of bananas');

-- --------------------------------------------------------

--
-- Table structure for table `farminfo_prod`
--

CREATE TABLE `farminfo_prod` (
  `FarmId` int(11) NOT NULL,
  `FarmName` varchar(255) NOT NULL,
  `FarmSize` int(11) NOT NULL,
  `SupplierId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `farminfo_prod`
--

INSERT INTO `farminfo_prod` (`FarmId`, `FarmName`, `FarmSize`, `SupplierId`) VALUES
(1, 'Farm Name 1', 10, 'sup003'),
(2, 'Farm name2', 47, 'sup003'),
(3, 'Farm name3', 60, 'sup003'),
(4, 'Farm name3', 1, 'sup003'),
(5, 'Farm name3', 3, 'sup003'),
(6, 'Farm name3', 2, 'sup003'),
(7, 'Farm name8', 6, 'sup003');

-- --------------------------------------------------------

--
-- Table structure for table `leaveinfo_hr`
--

CREATE TABLE `leaveinfo_hr` (
  `LeaveInfoId` int(11) NOT NULL,
  `EmployeeId` varchar(255) NOT NULL,
  `LeaveTypeId` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leaveinfo_hr`
--

INSERT INTO `leaveinfo_hr` (`LeaveInfoId`, `EmployeeId`, `LeaveTypeId`, `StartDate`, `EndDate`) VALUES
(1, 'am1234', 2, '2020-02-04', '2020-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `leavetype_hr`
--

CREATE TABLE `leavetype_hr` (
  `LeaveTypeId` int(11) NOT NULL,
  `LeaveType` varchar(255) NOT NULL,
  `PaymentStatus` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leavetype_hr`
--

INSERT INTO `leavetype_hr` (`LeaveTypeId`, `LeaveType`, `PaymentStatus`, `Description`) VALUES
(1, 'sick', 'paid', 'This is a paid leave'),
(2, 'maternity', 'paid', 'This is a paid leave'),
(3, 'paternity', 'paid', 'This is a paid leave'),
(4, 'annual', 'paid', 'This is annual leave'),
(5, 'study', 'unpaid', 'This is unpaid leave'),
(6, 'emergency', 'unpaid', 'This is unpaid leave'),
(7, 'test', 'paid', 'test code');

-- --------------------------------------------------------

--
-- Table structure for table `login_tbl_adm`
--

CREATE TABLE `login_tbl_adm` (
  `TransactionID` int(11) NOT NULL,
  `EmployeeID` varchar(255) NOT NULL,
  `LoginDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logout_tbl_at`
--

CREATE TABLE `logout_tbl_at` (
  `TransactionID` int(11) NOT NULL,
  `EmployeeID` varchar(255) NOT NULL,
  `LogoutDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `motd_adm`
--

CREATE TABLE `motd_adm` (
  `MessageID` int(11) NOT NULL,
  `MessageDate` date NOT NULL,
  `Message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `motd_adm`
--

INSERT INTO `motd_adm` (`MessageID`, `MessageDate`, `Message`) VALUES
(1, '2019-12-15', 'WORK SMART DONT WORK HARD');

-- --------------------------------------------------------

--
-- Table structure for table `paymentschedule_hr`
--

CREATE TABLE `paymentschedule_hr` (
  `PayScheduleId` int(11) NOT NULL,
  `PaymentSchedule` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paymentschedule_hr`
--

INSERT INTO `paymentschedule_hr` (`PayScheduleId`, `PaymentSchedule`, `Description`) VALUES
(1, 'hourly', 'Hourly payment'),
(2, 'daily', 'Daily payment'),
(3, 'weekly', 'Weekly payment'),
(4, 'biweekly', 'Biweekly payment'),
(5, 'monthly', 'Monthly payment'),
(7, 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `paymenttype_hr`
--

CREATE TABLE `paymenttype_hr` (
  `PayTypeId` int(11) NOT NULL,
  `PaymentType` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paymenttype_hr`
--

INSERT INTO `paymenttype_hr` (`PayTypeId`, `PaymentType`, `Description`) VALUES
(1, 'cash', 'cash payment'),
(2, 'check', 'Check payment'),
(3, 'banktransfer', 'Payment by Bank Transfer'),
(4, 'paypal', 'Paypal payment'),
(5, 'oxxo', 'Payment by OXXO'),
(6, 'TEST', 'TEST CODE');

-- --------------------------------------------------------

--
-- Table structure for table `personalinfo_hr`
--

CREATE TABLE `personalinfo_hr` (
  `EmployeeId` varchar(255) NOT NULL,
  `FirstNames` varchar(255) NOT NULL,
  `LastNames` varchar(255) NOT NULL,
  `JoiningDate` date NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `DateofBirth` date NOT NULL,
  `HomeAddress` varchar(255) NOT NULL,
  `EmpIdPhoto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `personalinfo_hr`
--

INSERT INTO `personalinfo_hr` (`EmployeeId`, `FirstNames`, `LastNames`, `JoiningDate`, `Gender`, `DateofBirth`, `HomeAddress`, `EmpIdPhoto`) VALUES
('am1234', 'Ana maria', 'carlos Gonzales', '2020-01-18', 'F', '1999-06-12', 'Home address', '../employee_ids/AT&T_Logo.jpg'),
('em0002', 'Elizabeth Montreal', 'Joaquin Quesada', '2020-01-18', 'F', '1997-01-11', 'Elizabeth Montreal home address', ''),
('EM0003', 'Ezequiel Manzanedo', 'Cristian Freixa', '2020-01-18', 'M', '2000-07-05', 'Cristian Freixa address', '../employee_ids/ATM.jpg'),
('ER5000', 'Elsa Rosario', 'Alonzo Berganza', '2020-01-18', 'F', '2001-08-07', 'Elsa Rosario', '../employee_ids/descarga.png'),
('jc4002', 'JazmÃ­n  Catalina', 'Xavier GalÃ¡n', '2020-01-18', 'F', '2003-02-15', 'JazmÃ­n  Catalina Address', '../employee_ids/images.jpg'),
('jd4001', 'JesÃºs Dante', 'Luca Montes', '2020-01-18', 'M', '1981-03-30', 'JesÃºs Dante Address', '../employee_ids/laptop.jpg'),
('JI0001', 'Jairo Indiano', 'Ariana Chicote', '2020-01-19', 'M', '1979-02-17', 'Jairo home address', '../employee_ids/UE.jpg'),
('LM0001', 'Luciano Mina', 'Luca Andrade', '2020-01-18', 'M', '1988-08-18', 'Luciano Address', '../employee_ids/server1.jpg'),
('mm1002', 'Miranda  Maria', 'Daniel GuillÃ©n', '2020-01-18', 'F', '1979-09-28', 'Miranda  Maria Address', '../employee_ids/router.jpg'),
('pr6000', 'Primitivo Ricardo', 'Carmelo Sainz', '2020-01-18', 'M', '2005-01-09', 'Primitivo Ricardo Address', '../employee_ids/logo.jpg'),
('rk4000', 'Rajabu Kitindi', 'Jeki Chuki', '2020-01-17', 'M', '2000-01-10', 'Shakespear 177, Anzures, CDMX, Mexico, 11590', '');

-- --------------------------------------------------------

--
-- Table structure for table `posexpdetails_sal`
--

CREATE TABLE `posexpdetails_sal` (
  `POSExpDetailId` int(11) NOT NULL,
  `ProductReceiptId` int(11) NOT NULL,
  `POSExpTypeId` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `ExpenditureDate` datetime NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posexptypes_sal`
--

CREATE TABLE `posexptypes_sal` (
  `POSExpTypeId` int(11) NOT NULL,
  `POSExpType` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posinfo_sal`
--

CREATE TABLE `posinfo_sal` (
  `POSId` int(11) NOT NULL,
  `POSName` varchar(255) NOT NULL,
  `EmployeeID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posinfo_sal`
--

INSERT INTO `posinfo_sal` (`POSId`, `POSName`, `EmployeeID`) VALUES
(22, 'X-22', 'em0002 '),
(27, 'X-27', 'jd4001');

-- --------------------------------------------------------

--
-- Table structure for table `productbrand_prod`
--

CREATE TABLE `productbrand_prod` (
  `BrandId` int(11) NOT NULL,
  `BrandName` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productbrand_prod`
--

INSERT INTO `productbrand_prod` (`BrandId`, `BrandName`, `Description`) VALUES
(1, 'ada', 'Banana from ADA Farms'),
(2, 'db', 'Bananas from Mexico City'),
(3, '2B', 'This is banana from wherever'),
(4, 'aim', 'AIM is nothing');

-- --------------------------------------------------------

--
-- Table structure for table `productinfo_prod`
--

CREATE TABLE `productinfo_prod` (
  `ProductCode` varchar(255) NOT NULL,
  `BrandId` int(11) NOT NULL,
  `QualityId` int(11) NOT NULL,
  `ProductPhoto` varchar(255) DEFAULT NULL,
  `SellingPrice` int(11) NOT NULL,
  `SupplierId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productinfo_prod`
--

INSERT INTO `productinfo_prod` (`ProductCode`, `BrandId`, `QualityId`, `ProductPhoto`, `SellingPrice`, `SupplierId`) VALUES
('prod001', 1, 1, '../product_photos/Captura-Bella.JPG', 100, 'sup003'),
('PROD002', 2, 2, '', 44, 'sup003'),
('PROD003', 4, 3, '../product_photos/_DSC0011.JPG', 45, 'sup003'),
('PROD004', 2, 2, '../product_photos/farm_house.JPG', 66, 'sup004');

-- --------------------------------------------------------

--
-- Table structure for table `productquality_prod`
--

CREATE TABLE `productquality_prod` (
  `QualityId` int(11) NOT NULL,
  `QualityName` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productquality_prod`
--

INSERT INTO `productquality_prod` (`QualityId`, `QualityName`, `Description`) VALUES
(1, 'premium', 'This is GRADE A pproduct'),
(2, 'dedo', 'This is GRADE B product'),
(3, 'mano', 'This is GRADE C quality');

-- --------------------------------------------------------

--
-- Table structure for table `productreceived_sal`
--

CREATE TABLE `productreceived_sal` (
  `ProductReceiptId` int(11) NOT NULL,
  `DispatchRefNum` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `DateReceived` datetime NOT NULL,
  `Received` varchar(1) NOT NULL,
  `Comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productreceived_sal`
--

INSERT INTO `productreceived_sal` (`ProductReceiptId`, `DispatchRefNum`, `Quantity`, `DateReceived`, `Received`, `Comments`) VALUES
(1, 8, 25, '2019-12-28 00:00:00', 'Y', 'Received with thanks'),
(4, 7, 20, '2019-12-28 00:00:00', 'Y', '');

-- --------------------------------------------------------

--
-- Table structure for table `receiveproduct_acc`
--

CREATE TABLE `receiveproduct_acc` (
  `ProductReceiptNumber` int(11) NOT NULL,
  `BatchId` int(11) NOT NULL,
  `ProductCode` varchar(255) NOT NULL,
  `FarmId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `CaseCode` varchar(255) NOT NULL,
  `DateReceived` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receiveproduct_acc`
--

INSERT INTO `receiveproduct_acc` (`ProductReceiptNumber`, `BatchId`, `ProductCode`, `FarmId`, `Quantity`, `CaseCode`, `DateReceived`) VALUES
(3, 44, 'prod001', 1, 76, 'case001', '2019-12-09 00:00:00'),
(5, 44, 'PROD003', 2, 89, 'case002', '2019-12-14 00:00:00'),
(7, 43, 'prod001', 1, 45, 'case001', '2019-12-14 00:00:00'),
(8, 42, 'prod001', 2, 67, 'case002', '2019-12-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `registerdeffectiveprod_sal`
--

CREATE TABLE `registerdeffectiveprod_sal` (
  `DeffectiveRef` int(11) NOT NULL,
  `ProductReceiptId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Confirmation` varchar(1) NOT NULL,
  `DateReported` datetime NOT NULL,
  `Comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reportproblems_adm`
--

CREATE TABLE `reportproblems_adm` (
  `ProblemID` int(11) NOT NULL,
  `EmployeeID` varchar(255) NOT NULL,
  `ProblemDesc` varchar(255) NOT NULL,
  `DateOccured` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reportproblems_adm`
--

INSERT INTO `reportproblems_adm` (`ProblemID`, `EmployeeID`, `ProblemDesc`, `DateOccured`) VALUES
(1, 'mm1002', 'This is the first problem reported', '2020-01-12'),
(2, 'rk4000', 'Problem described', '2020-01-14'),
(3, 'am1234', 'From dashboard', '2020-01-14'),
(4, 'am1234', 'From dashboard', '2020-01-14'),
(5, 'am1234', 'From dashboard', '2020-01-14'),
(6, 'am1234', 'From dashboard', '2020-01-14'),
(7, 'am1234', 'From dashboard', '2020-01-14'),
(8, 'am1234', 'From dashboard', '2020-01-14'),
(9, 'am1234', 'From dashboard', '2020-01-14'),
(10, 'am1234', 'From dashboard', '2020-01-14'),
(11, 'am1234', 'From dashboard', '2020-01-14'),
(12, 'am1234', 'From dashboard', '2020-01-14'),
(13, 'am1234', 'From dashboard', '2020-01-14'),
(14, 'am1234', 'From dashboard', '2020-01-14'),
(15, 'am1234', 'From dashboard', '2020-01-14'),
(16, 'am1234', 'From dashboard', '2020-01-14'),
(17, 'am1234', 'From dashboard', '2020-01-14'),
(18, 'am1234', 'From Reports Module', '2020-01-12'),
(19, 'ER5000', 'fROM aNALYTICS MODULE', '2020-01-14'),
(20, 'rk4000', 'This is from Admin Module', '2020-01-14'),
(21, 'pr6000', 'This is from accounting module', '2020-01-14'),
(22, 'am1234', 'From HR Module', '2020-01-14'),
(23, 'ER5000', 'From Production Module', '2020-01-14'),
(24, 'jc4002', 'From sales', '2020-01-14');

-- --------------------------------------------------------

--
-- Table structure for table `role_perm_adm`
--

CREATE TABLE `role_perm_adm` (
  `ID` int(11) NOT NULL,
  `RoleName` varchar(255) NOT NULL,
  `PermissionName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_perm_adm`
--

INSERT INTO `role_perm_adm` (`ID`, `RoleName`, `PermissionName`) VALUES
(7, 'admin', 'default'),
(8, 'mod-admin', 'insert'),
(9, 'mod-admin', 'update'),
(10, 'mod-admin', 'delete'),
(11, 'mod-admin', 'view'),
(12, 'user', 'insert'),
(13, 'user', 'view'),
(14, 'viewer', 'view');

-- --------------------------------------------------------

--
-- Table structure for table `salaryinfo_hr`
--

CREATE TABLE `salaryinfo_hr` (
  `SalInfoId` int(11) NOT NULL,
  `EmployeeId` varchar(255) NOT NULL,
  `BaseSalary` int(11) NOT NULL,
  `StateTax` int(11) NOT NULL,
  `FederalTax` int(11) NOT NULL,
  `SocialSec` int(11) NOT NULL,
  `NetIncome` int(11) NOT NULL,
  `PayScheduleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salaryinfo_hr`
--

INSERT INTO `salaryinfo_hr` (`SalInfoId`, `EmployeeId`, `BaseSalary`, `StateTax`, `FederalTax`, `SocialSec`, `NetIncome`, `PayScheduleId`) VALUES
(1, 'am1234', 100, 2, 5, 10, 83, 4);

-- --------------------------------------------------------

--
-- Table structure for table `saleproductreceived_sal`
--

CREATE TABLE `saleproductreceived_sal` (
  `SalesRef` int(11) NOT NULL,
  `ProductReceiptId` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `UnitPrice` int(11) NOT NULL,
  `SalesDate` datetime NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `CustomerID` varchar(255) DEFAULT NULL,
  `RecordInsertDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saleproductreceived_sal`
--

INSERT INTO `saleproductreceived_sal` (`SalesRef`, `ProductReceiptId`, `Quantity`, `UnitPrice`, `SalesDate`, `PaymentMethod`, `CustomerID`, `RecordInsertDate`) VALUES
(4, 4, 5, 100, '2019-12-29 00:00:00', 'cash', 'general', '2019-12-30 04:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `suppliercategory_prod`
--

CREATE TABLE `suppliercategory_prod` (
  `CategoryId` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliercategory_prod`
--

INSERT INTO `suppliercategory_prod` (`CategoryId`, `CategoryName`, `Description`) VALUES
(1, 'truck_supplier', 'Truck Supplier'),
(2, 'case_supplier', 'Case Supplier'),
(3, 'banana_farmer', 'Banana brought from CHIAPAS Farms'),
(4, 'banana_reseller', 'Banana bought in Mexico City'),
(5, 'PESTISIDE_SUPPLIER', 'Pesticide Supplier'),
(6, 'FERTILIZER_SUPPLIER', 'Fertilizers Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `supplierinfo_prod`
--

CREATE TABLE `supplierinfo_prod` (
  `SupplierId` varchar(255) NOT NULL,
  `BusinessName` varchar(255) NOT NULL,
  `ContactName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplierinfo_prod`
--

INSERT INTO `supplierinfo_prod` (`SupplierId`, `BusinessName`, `ContactName`, `Address`, `EmailAddress`, `PhoneNumber`, `CategoryId`) VALUES
('sup001', 'Truck Business Name', 'Truck Contact name', 'Truck Business Address', 'truck@email.address', 2147483647, 1),
('sup002', 'Case Business Name', 'Case Contact Name', 'Case Business Address', 'case@email.address', 2147483647, 2),
('sup003', 'Farmer Business Name', 'Farmer Contact Name', 'Farmer Business Address', 'farmer@email.address', 2147483647, 3),
('sup004', 'Reseller Business Name', 'Reseller Contact Name', 'Reseller Business Address', 'reseller@email.address', 2147483647, 4),
('sup005', 'Pesticide Business Name', 'Pesticide Contact Name', 'Pesticide Business Address', 'pesticide@email.address', 2147483647, 5),
('sup006', 'Fertilizer Business Name', 'Fertilizer Contact Name', 'Fertilizer Business Address', 'fertilizer@email.address', 2147483647, 6),
('tes001', 'adasdsa', 'sdads', 'adasd', 'asdasda@adadfa.test', 1234567890, 1);

-- --------------------------------------------------------

--
-- Table structure for table `truckinfo_prod`
--

CREATE TABLE `truckinfo_prod` (
  `RegNumber` varchar(255) NOT NULL,
  `Make` varchar(255) NOT NULL,
  `Model` varchar(255) NOT NULL,
  `Capacity` varchar(255) NOT NULL,
  `DriverName` varchar(255) NOT NULL,
  `SupplierId` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `truckinfo_prod`
--

INSERT INTO `truckinfo_prod` (`RegNumber`, `Make`, `Model`, `Capacity`, `DriverName`, `SupplierId`) VALUES
('daaa', 'sasa', 'asasa', '12', 'err', 'tes001'),
('uiy76854', 'nissan', 'xtrail', '100', 'nissan driver', 'sup001'),
('we2344rf', 'Toyota', 'Hilux', '50', 'Truck Driver', 'sup001');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails_adm`
--

CREATE TABLE `userdetails_adm` (
  `UserDetailID` int(11) NOT NULL,
  `EmployeeID` varchar(255) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `LoginName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userdetails_adm`
--

INSERT INTO `userdetails_adm` (`UserDetailID`, `EmployeeID`, `RoleID`, `LoginName`, `Password`) VALUES
(2, 'rk4000', 5, 'rk4000', '$2y$10$mtBcmANMR1Flrt0T1GBN0.ur2WowaJ6FXmGP0PpEm9s7g7OymC0z6'),
(3, 'am1234', 6, 'am1234', '$2y$10$TTG3G50a0ukNZ/s8sfWOJ.cLzRbomo9VtIOWJ4woAKw2Iq6.aV66e'),
(4, 'em0002', 7, 'em0002', '$2y$10$VWFgJVyHFz/SgEmXr8Y8NeX.2a2mYRl7vMal2Pb.RoYVAls7pirbC'),
(5, 'EM0003', 8, 'EM0003', '$2y$10$Ni5FtrW/A.YEHF31Af6q6OFLJ7vyKZIZJo.5aqgtKFmZVoUJkqVtW'),
(6, 'ER5000', 6, 'ER5000', '$2y$10$15f8Pw7PJe7Gi61dgCsYAuuFn0tSn36sz.g1VbrxIwl8fnw8btmLu'),
(7, 'pr6000', 6, 'pr6000', '$2y$10$wJA/hCZYtNoJYLCpycsS5e9czJ16VYdNwAjJPpI5hHFPpYl0l9O8m'),
(8, 'jc4002', 6, 'jc4002', '$2y$10$gFpvTemt2X.UphKP20Mgb.bmqN0M20JwxnoBlHvGYtV8VZRQCGbPy'),
(9, 'jd4001', 7, 'jd4001', '$2y$10$BiFpAOjfKbaqEO61XfGZYOCnZD85rZDM8loFpUkLpT2ssYdqsycuy'),
(10, 'mm1002', 6, 'mm1002', '$2y$10$tRHoed1DuvxcIgGLdOeYmO4xgBTy0LcEd7a38ltUKWIv.kKutEt0u');

-- --------------------------------------------------------

--
-- Table structure for table `userpermission_adm`
--

CREATE TABLE `userpermission_adm` (
  `PermissionID` int(11) NOT NULL,
  `PermissionName` varchar(255) NOT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userpermission_adm`
--

INSERT INTO `userpermission_adm` (`PermissionID`, `PermissionName`, `Description`) VALUES
(1, 'insert', 'Access to all insert forms'),
(2, 'update', 'Access to all update forms'),
(3, 'delete', 'Gives access to all delete forms'),
(4, 'view', 'This is view only permission, ability to see and print reports only'),
(5, 'default', 'Gives access to all permissions above');

-- --------------------------------------------------------

--
-- Table structure for table `userrole_adm`
--

CREATE TABLE `userrole_adm` (
  `RoleID` int(11) NOT NULL,
  `RoleName` varchar(255) NOT NULL,
  `RoleDescription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userrole_adm`
--

INSERT INTO `userrole_adm` (`RoleID`, `RoleName`, `RoleDescription`) VALUES
(5, 'admin', 'Granted default permission'),
(6, 'mod-admin', 'Granted all permissions in specific module'),
(7, 'user', 'Granted Insert and VIEW permissions in specific module'),
(8, 'viewer', 'Can only view and print reports for specific module');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_tbl_at`
--
ALTER TABLE `action_tbl_at`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `EmployeeID_idx` (`EmployeeID`);

--
-- Indexes for table `bankinfo_hr`
--
ALTER TABLE `bankinfo_hr`
  ADD PRIMARY KEY (`BankInfoId`),
  ADD KEY `EmployeeId_idx` (`EmployeeId`);

--
-- Indexes for table `batchdetails_acc`
--
ALTER TABLE `batchdetails_acc`
  ADD PRIMARY KEY (`BatchId`),
  ADD KEY `SupplierId_idx` (`SupplierId`),
  ADD KEY `RegNumber_idx` (`RegNumber`),
  ADD KEY `BatchRangeId_idx` (`BatchRangeId`);

--
-- Indexes for table `batchexp_acc`
--
ALTER TABLE `batchexp_acc`
  ADD PRIMARY KEY (`BatchExpId`),
  ADD KEY `BatchId_idx` (`BatchId`);

--
-- Indexes for table `batchrange_acc`
--
ALTER TABLE `batchrange_acc`
  ADD PRIMARY KEY (`BatchRangeId`);

--
-- Indexes for table `casedetails_prod`
--
ALTER TABLE `casedetails_prod`
  ADD PRIMARY KEY (`CaseCode`),
  ADD KEY `BrandId_idx` (`BrandId`),
  ADD KEY `SupplierId_idx` (`SupplierId`);

--
-- Indexes for table `collectpayment_sal`
--
ALTER TABLE `collectpayment_sal`
  ADD PRIMARY KEY (`PaymentRef`),
  ADD KEY `SalesRef_idx` (`SalesRef`);

--
-- Indexes for table `customerdetails_sal`
--
ALTER TABLE `customerdetails_sal`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Indexes for table `department_hr`
--
ALTER TABLE `department_hr`
  ADD PRIMARY KEY (`DepartmentId`);

--
-- Indexes for table `dispatchproduct_acc`
--
ALTER TABLE `dispatchproduct_acc`
  ADD PRIMARY KEY (`DispatchRefNum`),
  ADD KEY `ProductReceiptNumber_idx` (`ProductReceiptNumber`),
  ADD KEY `POSId_idx` (`POSId`);

--
-- Indexes for table `emergencycontact_hr`
--
ALTER TABLE `emergencycontact_hr`
  ADD PRIMARY KEY (`eContactId`),
  ADD KEY `EmployeeId_idx` (`EmployeeId`);

--
-- Indexes for table `employeedeptinfo_hr`
--
ALTER TABLE `employeedeptinfo_hr`
  ADD PRIMARY KEY (`EmpDeptInfoId`),
  ADD KEY `DepartmentId_idx` (`DepartmentId`),
  ADD KEY `EmployeeId_idx` (`EmployeeId`);

--
-- Indexes for table `employmenttypeinfo_hr`
--
ALTER TABLE `employmenttypeinfo_hr`
  ADD PRIMARY KEY (`EmpTypeInfoId`),
  ADD KEY `EmpTypeId_idx` (`EmpTypeId`),
  ADD KEY `EmployeeId_idx` (`EmployeeId`);

--
-- Indexes for table `employmenttype_hr`
--
ALTER TABLE `employmenttype_hr`
  ADD PRIMARY KEY (`EmpTypeId`);

--
-- Indexes for table `expensetype_prod`
--
ALTER TABLE `expensetype_prod`
  ADD PRIMARY KEY (`ExpTypeId`);

--
-- Indexes for table `farminfo_prod`
--
ALTER TABLE `farminfo_prod`
  ADD PRIMARY KEY (`FarmId`),
  ADD KEY `SupplierId_idx` (`SupplierId`);

--
-- Indexes for table `leaveinfo_hr`
--
ALTER TABLE `leaveinfo_hr`
  ADD PRIMARY KEY (`LeaveInfoId`),
  ADD KEY `EmployeeId_idx` (`EmployeeId`),
  ADD KEY `LeaveTypeId_idx` (`LeaveTypeId`);

--
-- Indexes for table `leavetype_hr`
--
ALTER TABLE `leavetype_hr`
  ADD PRIMARY KEY (`LeaveTypeId`);

--
-- Indexes for table `login_tbl_adm`
--
ALTER TABLE `login_tbl_adm`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `EmployeeID_idx` (`EmployeeID`);

--
-- Indexes for table `logout_tbl_at`
--
ALTER TABLE `logout_tbl_at`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `EmployeeID_idx` (`EmployeeID`);

--
-- Indexes for table `motd_adm`
--
ALTER TABLE `motd_adm`
  ADD PRIMARY KEY (`MessageID`);

--
-- Indexes for table `paymentschedule_hr`
--
ALTER TABLE `paymentschedule_hr`
  ADD PRIMARY KEY (`PayScheduleId`);

--
-- Indexes for table `paymenttype_hr`
--
ALTER TABLE `paymenttype_hr`
  ADD PRIMARY KEY (`PayTypeId`);

--
-- Indexes for table `personalinfo_hr`
--
ALTER TABLE `personalinfo_hr`
  ADD PRIMARY KEY (`EmployeeId`);

--
-- Indexes for table `posexpdetails_sal`
--
ALTER TABLE `posexpdetails_sal`
  ADD PRIMARY KEY (`POSExpDetailId`),
  ADD KEY `ProductReceiptId_idx` (`ProductReceiptId`),
  ADD KEY `POSExpTypeId_idx` (`POSExpTypeId`);

--
-- Indexes for table `posexptypes_sal`
--
ALTER TABLE `posexptypes_sal`
  ADD PRIMARY KEY (`POSExpTypeId`);

--
-- Indexes for table `posinfo_sal`
--
ALTER TABLE `posinfo_sal`
  ADD PRIMARY KEY (`POSId`),
  ADD KEY `EmployeeID_idx` (`EmployeeID`);

--
-- Indexes for table `productbrand_prod`
--
ALTER TABLE `productbrand_prod`
  ADD PRIMARY KEY (`BrandId`);

--
-- Indexes for table `productinfo_prod`
--
ALTER TABLE `productinfo_prod`
  ADD PRIMARY KEY (`ProductCode`),
  ADD KEY `SupplierId_idx` (`SupplierId`),
  ADD KEY `BrandId_idx` (`BrandId`),
  ADD KEY `QualityId_idx` (`QualityId`);

--
-- Indexes for table `productquality_prod`
--
ALTER TABLE `productquality_prod`
  ADD PRIMARY KEY (`QualityId`);

--
-- Indexes for table `productreceived_sal`
--
ALTER TABLE `productreceived_sal`
  ADD PRIMARY KEY (`ProductReceiptId`),
  ADD KEY `DispatchRefNum_idx` (`DispatchRefNum`);

--
-- Indexes for table `receiveproduct_acc`
--
ALTER TABLE `receiveproduct_acc`
  ADD PRIMARY KEY (`ProductReceiptNumber`),
  ADD KEY `ProductCode_idx` (`ProductCode`),
  ADD KEY `BatchId_idx` (`BatchId`),
  ADD KEY `FarmId_idx` (`FarmId`),
  ADD KEY `CaseCode_idx` (`CaseCode`);

--
-- Indexes for table `registerdeffectiveprod_sal`
--
ALTER TABLE `registerdeffectiveprod_sal`
  ADD PRIMARY KEY (`DeffectiveRef`),
  ADD KEY `ProductReceiptId_idx` (`ProductReceiptId`);

--
-- Indexes for table `reportproblems_adm`
--
ALTER TABLE `reportproblems_adm`
  ADD PRIMARY KEY (`ProblemID`),
  ADD KEY `EmployeeID_idx` (`EmployeeID`);

--
-- Indexes for table `role_perm_adm`
--
ALTER TABLE `role_perm_adm`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `salaryinfo_hr`
--
ALTER TABLE `salaryinfo_hr`
  ADD PRIMARY KEY (`SalInfoId`),
  ADD KEY `EmployeeId_idx` (`EmployeeId`),
  ADD KEY `PayScheduleId_idx` (`PayScheduleId`);

--
-- Indexes for table `saleproductreceived_sal`
--
ALTER TABLE `saleproductreceived_sal`
  ADD PRIMARY KEY (`SalesRef`),
  ADD KEY `ProductReceiptId_idx` (`ProductReceiptId`),
  ADD KEY `CustomerID_idx` (`CustomerID`);

--
-- Indexes for table `suppliercategory_prod`
--
ALTER TABLE `suppliercategory_prod`
  ADD PRIMARY KEY (`CategoryId`);

--
-- Indexes for table `supplierinfo_prod`
--
ALTER TABLE `supplierinfo_prod`
  ADD PRIMARY KEY (`SupplierId`),
  ADD KEY `CategoryId_idx` (`CategoryId`);

--
-- Indexes for table `truckinfo_prod`
--
ALTER TABLE `truckinfo_prod`
  ADD PRIMARY KEY (`RegNumber`),
  ADD KEY `SupplierId_idx` (`SupplierId`);

--
-- Indexes for table `userdetails_adm`
--
ALTER TABLE `userdetails_adm`
  ADD PRIMARY KEY (`UserDetailID`),
  ADD KEY `EmployeeID_idx` (`EmployeeID`),
  ADD KEY `RoleID_idx` (`RoleID`);

--
-- Indexes for table `userpermission_adm`
--
ALTER TABLE `userpermission_adm`
  ADD PRIMARY KEY (`PermissionID`);

--
-- Indexes for table `userrole_adm`
--
ALTER TABLE `userrole_adm`
  ADD PRIMARY KEY (`RoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_tbl_at`
--
ALTER TABLE `action_tbl_at`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bankinfo_hr`
--
ALTER TABLE `bankinfo_hr`
  MODIFY `BankInfoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `batchdetails_acc`
--
ALTER TABLE `batchdetails_acc`
  MODIFY `BatchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `batchexp_acc`
--
ALTER TABLE `batchexp_acc`
  MODIFY `BatchExpId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `collectpayment_sal`
--
ALTER TABLE `collectpayment_sal`
  MODIFY `PaymentRef` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_hr`
--
ALTER TABLE `department_hr`
  MODIFY `DepartmentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dispatchproduct_acc`
--
ALTER TABLE `dispatchproduct_acc`
  MODIFY `DispatchRefNum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `emergencycontact_hr`
--
ALTER TABLE `emergencycontact_hr`
  MODIFY `eContactId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employeedeptinfo_hr`
--
ALTER TABLE `employeedeptinfo_hr`
  MODIFY `EmpDeptInfoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employmenttypeinfo_hr`
--
ALTER TABLE `employmenttypeinfo_hr`
  MODIFY `EmpTypeInfoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employmenttype_hr`
--
ALTER TABLE `employmenttype_hr`
  MODIFY `EmpTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expensetype_prod`
--
ALTER TABLE `expensetype_prod`
  MODIFY `ExpTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `farminfo_prod`
--
ALTER TABLE `farminfo_prod`
  MODIFY `FarmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `leaveinfo_hr`
--
ALTER TABLE `leaveinfo_hr`
  MODIFY `LeaveInfoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `leavetype_hr`
--
ALTER TABLE `leavetype_hr`
  MODIFY `LeaveTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_tbl_adm`
--
ALTER TABLE `login_tbl_adm`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logout_tbl_at`
--
ALTER TABLE `logout_tbl_at`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `motd_adm`
--
ALTER TABLE `motd_adm`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paymentschedule_hr`
--
ALTER TABLE `paymentschedule_hr`
  MODIFY `PayScheduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `paymenttype_hr`
--
ALTER TABLE `paymenttype_hr`
  MODIFY `PayTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posexpdetails_sal`
--
ALTER TABLE `posexpdetails_sal`
  MODIFY `POSExpDetailId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posexptypes_sal`
--
ALTER TABLE `posexptypes_sal`
  MODIFY `POSExpTypeId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productbrand_prod`
--
ALTER TABLE `productbrand_prod`
  MODIFY `BrandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productquality_prod`
--
ALTER TABLE `productquality_prod`
  MODIFY `QualityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productreceived_sal`
--
ALTER TABLE `productreceived_sal`
  MODIFY `ProductReceiptId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `receiveproduct_acc`
--
ALTER TABLE `receiveproduct_acc`
  MODIFY `ProductReceiptNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registerdeffectiveprod_sal`
--
ALTER TABLE `registerdeffectiveprod_sal`
  MODIFY `DeffectiveRef` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reportproblems_adm`
--
ALTER TABLE `reportproblems_adm`
  MODIFY `ProblemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `role_perm_adm`
--
ALTER TABLE `role_perm_adm`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `salaryinfo_hr`
--
ALTER TABLE `salaryinfo_hr`
  MODIFY `SalInfoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saleproductreceived_sal`
--
ALTER TABLE `saleproductreceived_sal`
  MODIFY `SalesRef` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userdetails_adm`
--
ALTER TABLE `userdetails_adm`
  MODIFY `UserDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userpermission_adm`
--
ALTER TABLE `userpermission_adm`
  MODIFY `PermissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userrole_adm`
--
ALTER TABLE `userrole_adm`
  MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action_tbl_at`
--
ALTER TABLE `action_tbl_at`
  ADD CONSTRAINT `EmployeeID_ATA` FOREIGN KEY (`EmployeeID`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bankinfo_hr`
--
ALTER TABLE `bankinfo_hr`
  ADD CONSTRAINT `EmployeeId_BI` FOREIGN KEY (`EmployeeId`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `batchdetails_acc`
--
ALTER TABLE `batchdetails_acc`
  ADD CONSTRAINT `BatchRangeId_BD` FOREIGN KEY (`BatchRangeId`) REFERENCES `batchrange_acc` (`BatchRangeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RegNumber_BD` FOREIGN KEY (`RegNumber`) REFERENCES `truckinfo_prod` (`RegNumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SupplierId_BD` FOREIGN KEY (`SupplierId`) REFERENCES `supplierinfo_prod` (`SupplierId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `batchexp_acc`
--
ALTER TABLE `batchexp_acc`
  ADD CONSTRAINT `BatchId_BC` FOREIGN KEY (`BatchId`) REFERENCES `batchdetails_acc` (`BatchId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `casedetails_prod`
--
ALTER TABLE `casedetails_prod`
  ADD CONSTRAINT `BrandId_CD` FOREIGN KEY (`BrandId`) REFERENCES `productbrand_prod` (`BrandId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SupplierId_CD` FOREIGN KEY (`SupplierId`) REFERENCES `supplierinfo_prod` (`SupplierId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `collectpayment_sal`
--
ALTER TABLE `collectpayment_sal`
  ADD CONSTRAINT `SalesRef_CP` FOREIGN KEY (`SalesRef`) REFERENCES `saleproductreceived_sal` (`SalesRef`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dispatchproduct_acc`
--
ALTER TABLE `dispatchproduct_acc`
  ADD CONSTRAINT `POSId_DP` FOREIGN KEY (`POSId`) REFERENCES `posinfo_sal` (`POSId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ProductReceiptNumber_DP` FOREIGN KEY (`ProductReceiptNumber`) REFERENCES `receiveproduct_acc` (`ProductReceiptNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emergencycontact_hr`
--
ALTER TABLE `emergencycontact_hr`
  ADD CONSTRAINT `EmployeeId_EC` FOREIGN KEY (`EmployeeId`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employeedeptinfo_hr`
--
ALTER TABLE `employeedeptinfo_hr`
  ADD CONSTRAINT `DepartmentId_EDI` FOREIGN KEY (`DepartmentId`) REFERENCES `department_hr` (`DepartmentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `EmployeeId_EDI` FOREIGN KEY (`EmployeeId`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employmenttypeinfo_hr`
--
ALTER TABLE `employmenttypeinfo_hr`
  ADD CONSTRAINT `EmpTypeId_ETI` FOREIGN KEY (`EmpTypeId`) REFERENCES `employmenttype_hr` (`EmpTypeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `EmployeeId_ETI` FOREIGN KEY (`EmployeeId`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `farminfo_prod`
--
ALTER TABLE `farminfo_prod`
  ADD CONSTRAINT `SupplierId_FI` FOREIGN KEY (`SupplierId`) REFERENCES `supplierinfo_prod` (`SupplierId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leaveinfo_hr`
--
ALTER TABLE `leaveinfo_hr`
  ADD CONSTRAINT `EmployeeId_LI` FOREIGN KEY (`EmployeeId`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `LeaveTypeId` FOREIGN KEY (`LeaveTypeId`) REFERENCES `leavetype_hr` (`LeaveTypeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login_tbl_adm`
--
ALTER TABLE `login_tbl_adm`
  ADD CONSTRAINT `EmployeeID_LT` FOREIGN KEY (`EmployeeID`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `logout_tbl_at`
--
ALTER TABLE `logout_tbl_at`
  ADD CONSTRAINT `EmployeeID_LTA` FOREIGN KEY (`EmployeeID`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posexpdetails_sal`
--
ALTER TABLE `posexpdetails_sal`
  ADD CONSTRAINT `POSExpTypeId_PE` FOREIGN KEY (`POSExpTypeId`) REFERENCES `posexptypes_sal` (`POSExpTypeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ProductReceiptId_PE` FOREIGN KEY (`ProductReceiptId`) REFERENCES `productreceived_sal` (`ProductReceiptId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posinfo_sal`
--
ALTER TABLE `posinfo_sal`
  ADD CONSTRAINT `EmployeeID_POSI` FOREIGN KEY (`EmployeeID`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productinfo_prod`
--
ALTER TABLE `productinfo_prod`
  ADD CONSTRAINT `BrandId_PI` FOREIGN KEY (`BrandId`) REFERENCES `productbrand_prod` (`BrandId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `QualityId_PI` FOREIGN KEY (`QualityId`) REFERENCES `productquality_prod` (`QualityId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SupplierId_PI` FOREIGN KEY (`SupplierId`) REFERENCES `supplierinfo_prod` (`SupplierId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productreceived_sal`
--
ALTER TABLE `productreceived_sal`
  ADD CONSTRAINT `DispatchRefNum_PR` FOREIGN KEY (`DispatchRefNum`) REFERENCES `dispatchproduct_acc` (`DispatchRefNum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receiveproduct_acc`
--
ALTER TABLE `receiveproduct_acc`
  ADD CONSTRAINT `BatchId_RP` FOREIGN KEY (`BatchId`) REFERENCES `batchdetails_acc` (`BatchId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CaseCode_RP` FOREIGN KEY (`CaseCode`) REFERENCES `casedetails_prod` (`CaseCode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FarmId_RP` FOREIGN KEY (`FarmId`) REFERENCES `farminfo_prod` (`FarmId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ProductCode_RP` FOREIGN KEY (`ProductCode`) REFERENCES `productinfo_prod` (`ProductCode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `registerdeffectiveprod_sal`
--
ALTER TABLE `registerdeffectiveprod_sal`
  ADD CONSTRAINT `ProductReceiptId_RDP` FOREIGN KEY (`ProductReceiptId`) REFERENCES `productreceived_sal` (`ProductReceiptId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reportproblems_adm`
--
ALTER TABLE `reportproblems_adm`
  ADD CONSTRAINT `EmployeeID_RPA` FOREIGN KEY (`EmployeeID`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salaryinfo_hr`
--
ALTER TABLE `salaryinfo_hr`
  ADD CONSTRAINT `EmployeeId_SI` FOREIGN KEY (`EmployeeId`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PayScheduleId` FOREIGN KEY (`PayScheduleId`) REFERENCES `paymentschedule_hr` (`PayScheduleId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saleproductreceived_sal`
--
ALTER TABLE `saleproductreceived_sal`
  ADD CONSTRAINT `CustomerID_SPR` FOREIGN KEY (`CustomerID`) REFERENCES `customerdetails_sal` (`CustomerId`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `ProductReceiptId_SPR` FOREIGN KEY (`ProductReceiptId`) REFERENCES `productreceived_sal` (`ProductReceiptId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplierinfo_prod`
--
ALTER TABLE `supplierinfo_prod`
  ADD CONSTRAINT `CategoryId` FOREIGN KEY (`CategoryId`) REFERENCES `suppliercategory_prod` (`CategoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `truckinfo_prod`
--
ALTER TABLE `truckinfo_prod`
  ADD CONSTRAINT `SupplierId_TI` FOREIGN KEY (`SupplierId`) REFERENCES `supplierinfo_prod` (`SupplierId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userdetails_adm`
--
ALTER TABLE `userdetails_adm`
  ADD CONSTRAINT `EmployeeID_UD` FOREIGN KEY (`EmployeeID`) REFERENCES `personalinfo_hr` (`EmployeeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RoleID_UD` FOREIGN KEY (`RoleID`) REFERENCES `userrole_adm` (`RoleID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
