<?php

/* Web Variables */
const BPHIMS_APPLICATION_NAME = "Biliran Provincial Hospital Inventory Management System";
const BPHIMS_WEB_TITLE = "BPHIMS";
const BPHIMS_TABLE_LIMIT = 5;
const BPHIMS_DEPARTMENT_SUPPLY = 3;
const BPHIMS_CATEGORY_SUPPLY = 1;
const BPHIMS_CATEGORY_EQUIPMENT = 2;
const BPHIMS_TRANSACTION_DEPARTMENT = 1;
const BPHIMS_TRANSACTION_DOCTOR = 2;
const BPHIMS_ITEM_SUPPLY = 1;
const BPHIMS_ITEM_EQUIPMENT = 2;
const BPHIMS_POSITION_DEPARTMENT_HEAD = 2;
const BPHIMS_POSITION_DOCTOR = 3;
const BPHIMS_UNIT_QUANTITY = 1;
const BPHIMS_UNIT_DOSAGE = 2;

/* System Variables */
const SYS_ERROR = 1;
const SYS_SUCCESS = 2;

/* Database Variables */
const DB_SERVERNAME = "localhost";
const DB_USERNAME = "root";
const DB_PASSWORD = "";
const DB_DATABASE = "bphims";

/* Database Table:users Variables */
const DB_USERS_TYPE_ADMIN = 1;
const DB_USERS_TYPE_USER = 2;

/* Database Table:item Variables */
const DB_ITEMS_UNIT = "pcs|pack|box|pad";

?>