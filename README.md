# Objective

Made a simple application to select Japan's prefecture and year and display its population data.
Population CSV data collected from the following link from data.go.jp

http://www.data.go.jp/data/dataset/mhlw_20160201_0018/resource/f8b8b257-1501-4efa-9422-ace35f6d5117

## Functions

### CSV Import

Function to import CSV data onto a MySQL database.

### Display Population

1. Displaying population data from MySQL database
2. Filter option by prefecture and year as GET requests by ajax.

## Installation
# Cakephp
1. Create database and tables (scripts included on concrete5.sql)
2. Update database credentials on config/app.php

# Rawphp
1. Create database and tables (scripts included on concrete5.sql)
2. Update database credentials on inc/database.php

## Technology Used

1. PHP Ver.7.
2. Didn't use any kind of framework and/or third party libraries.
3. MySQL as a database.
4. The character set of the table is UTF-8.

## What I have done

1. Deesigned basic database structure.
2. Read csv file line by line instead of reaing whole file once.
3. Checked file types both in php and html
4. Used PDO 
5. Transaction method to make sure proper data storing
6. Designed database as prefecture name as Unique key to avoid duplicate entrys
7. Used a little bit design for my eye satisfaction

2. If you know how to take care of multibyte files. (CSV file is encoded as Shift-JIS)
3. You can validate and add error processes against irregular entry.
4. You can follow [PHP Standards Recommendations](http://www.php-fig.org/psr/) 
5. [Option] If you can use [Doctrine](http://www.doctrine-project.org/), it would be a plus (Not required)
6. [Option] If you're familiar with AJAX process.
7. [Option] If you can create a concrete5 package.

## What I could do

1. Could use any framework. But, for this small project I avoided it
2. Could use CSV import class
3. Could use more validation and display error messages