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
### Cakephp
1. Create database and tables (scripts included on concrete5.sql)
2. Update database credentials on config/app.php

### Rawphp
1. Create database and tables (scripts included on concrete5.sql)
2. Update database credentials on inc/database.php

## Technology Used

1. PHP Ver.7.
2. Didn't use any kind of framework and/or third party libraries.
3. MySQL as a database.
4. The character set of the table is UTF-8.

## What I have done

1. Designed basic database structure.
2. Read csv file line by line instead of reading whole file once.
3. Checked file types both in php and html
4. Used PDO 
5. Transaction method to make sure proper data storing
6. Designed database as prefecture name as Unique key to avoid duplicate entries
7. Used a little bit design for my eye satisfaction
8. Used basic validation
9. Tried to follow [PHP Standards Recommendations](http://www.php-fig.org/psr/) 
10. Used AJAX process to get the filtered data.

## What I could do

1. Could use any framework. But, for this small project I avoided it
2. Could use CSV import class
3. Could use more validation and display error messages. But avoided to finish it soon.

![Screen1](https://raw.githubusercontent.com/biplob-ice/PopulationStatistics/master/screenshots/index.png)
![Screen2](https://raw.githubusercontent.com/biplob-ice/PopulationStatistics/master/screenshots/import.png)
