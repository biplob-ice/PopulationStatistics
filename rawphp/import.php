<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Import</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">

                <a href="index.php"><< Back</a>

                <h3 class="page-header">Import Population Data</h3>

                <form action="" method="post" enctype="multipart/form-data" class="form-inline">
                  <div class="form-group">
                    <label for="file">CSV Upload</label>
                    <input type="file" class="form-control" name="file" id="file" accept="text/csv">
                  </div>
                  <button type="submit" class="btn btn-default">Upload</button>
                </form>            
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>



<?php
if ( isset($_FILES['file']) ) {
    require_once 'inc/FileUploader.php';

    $fileUploader = new FileUploader();
    if ($filename = $fileUploader->upload()) {
        import($filename);
    }
}

function import($filename)
{
    $start = microtime(true);

    // open the file
    $handle = fopen($filename, "r");

    // skip the 1st and 2nd row
    fgetcsv($handle);
    fgetcsv($handle);

    // read years from 3rd row
    $years = fgetcsv($handle);

    // read each data row in the file
    // and prepare data for prefectures and populations table
    $i = 0;
    while ( ($row = fgetcsv($handle)) !== FALSE )
    {
        $i++;
        foreach ($years as $key => $year) {

            if ($key == 0) {
                $prefectures[] = (isset($row[$key])) ? $row[$key] : '';
                continue;
            }

            // set array as (prefecture_id, year, count, created) to insert
            $populations[] = array( $i, $year, $row[$key], date('Y-m-d H:i:s') );  
        }   
    }

    // close the file
    fclose($handle);       

    try {
       // save data into database
        require_once 'inc/database.php';
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();

        // insert prefectures
        $sql = "INSERT INTO prefectures (name) VALUES(?)";
        $query = $pdo->prepare($sql);
        foreach ($prefectures as $prefecture) {
            $query->execute(array($prefecture));
        }

        // insert populations data
        $sql = "INSERT INTO populations (prefecture_id,year,count, created) VALUES (?, ?, ?, ?)";
        $query = $pdo->prepare($sql);
        foreach ($populations as $population) {
            $query->execute($population);
        }

        $pdo->commit();
        Database::disconnect(); 

        $end = microtime(true);
        echo '<div class="alert alert-success">CSV import completed in ' . ($end - $start);
    } catch (PDOException $e) {
        $pdo->rollback();
        echo '<div class="alert alert-danger">Could not import for the following reason. <br/> </div>' . $e;
    }
} 
?>