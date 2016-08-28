<?php
if ( isset($_GET) && !empty($_GET) ) {
    $prefecture_id  = secure($_GET['prefecture']);
    $year           = secure($_GET['year']);

    if ($prefecture_id) {
        $params[] = " populations.prefecture_id = '$prefecture_id' ";
    }

    if ($year) {
        $params[] = " populations.year = '$year' ";
    }

}

$sql = 'SELECT prefectures.name, populations.* FROM populations LEFT JOIN prefectures ON populations.prefecture_id = prefectures.id';

if ( isset($params) && !empty($params) ) {
    $sql .= ' WHERE ' . implode(' AND ', $params);
}

require_once 'database.php';
$pdo = Database::connect();

foreach ($pdo->query($sql) as $row) {
    echo '<tr>';
    echo '<td>'. $row['id'] . '</td>';
    echo '<td>'. $row['name'] . '</td>';
    echo '<td>'. $row['year'] . '</td>';
    echo '<td>'. $row['count'] . '</td>';
    echo '<td>'. $row['created'] . '</td>';
    echo '</tr>';
}
Database::disconnect();

// Protect user input data
function secure($string) { 
    $string = strip_tags($string); 
    $string = htmlspecialchars($string); 
    $string = trim($string); 
    $string = stripslashes($string); 
    return $string; 
} 
?>  