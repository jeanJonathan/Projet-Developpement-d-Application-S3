<?php
    $connection = mysqli_connect("lakartxela","garricastres_bd","garricastres_bd","garricastres_bd");
    
    $sql = "SELECT *  FROM CD";

    $result = $connection->query($sql);
    foreach ($result as $row) {
        echo "<option value='$row[genre]'>$row[genre]</option>";
    }
?>