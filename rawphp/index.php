<?php require_once 'inc/database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="page-header">
                    <a href="import.php" class="btn btn-success pull-right">CSV Import</a>
                    <h3> Japan's Population Data </h3>    
                </div>

                <form action="" method="get" id="ajaxForm">
                    <select name="prefecture">
                        <option value="">-- Select Prefecture --</option>
                        <?php
                            $pdo = Database::connect();
                            $sql = 'SELECT name from prefectures ORDER BY id';
                            $query = $pdo->prepare($sql);
                            $query->execute();
                            $prefectures = $query->fetchAll(PDO::FETCH_COLUMN);            
                            foreach ($prefectures as $key => $value) {
                                echo '<option value="'. ($key+1) .'">' . $value . '</option>';
                            }
                        ?>
                    </select>
                  
                    <select name="year">
                        <option value="">-- Select Year --</option>
                        <?php
                            $pdo = Database::connect();
                            $sql = 'SELECT DISTINCT year from populations';
                            $query = $pdo->prepare($sql);
                            $query->execute();
                            $years = $query->fetchAll(PDO::FETCH_COLUMN);            
                            foreach ($years as $year) {
                                echo '<option value="'. $year .'">' . $year . '</option>';
                            }
                        ?>
                    </select>
                    <!-- <input type="submit" class="btn btn-dafault btn-xs" value="Get population" /> -->
                    <div id="result"></div>
                </form>

                <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Prefecture</th>
                          <th>Year</th>
                          <th>Count</th>
                          <th>Created</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                </table>


            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function() {

        // default view data load
        fetchData();

        // ajax filtering
        $('#ajaxForm').on('change keyup', function(e) {
            e.preventDefault();
            fetchData($(this).serialize());
        });
    });

    function fetchData(formData) {
        $.ajax({ 
            type: "GET",
            url: "inc/fetchData.php",
            data: formData,
            dataType: "html",
            success: function(data){
                $("tbody").html(data);
            }
        });        
    }        
    </script>

</body>
</html>