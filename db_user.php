<?php 
    header('Content-Type: application/json');

    require_once 'connection.php';

    $sqlQuery = "SELECT COUNT( `disease_id` ) AS cd, disease_name, 
                SUBSTRING( diagnosis_date, 1, 4 ) AS dates
                FROM `diagnosis`
                LEFT JOIN `disease`
                USING ( `disease_id` )
                WHERE `disease_id` =1
                GROUP BY dates";

    $result = mysqli_query($conn, $sqlQuery);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

    mysqli_close($conn);

    echo json_encode($data);

?>