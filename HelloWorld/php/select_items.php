<?php
//First load the DB connection
require_once("db_connect.php");

//This will show errors in the browser if there are some
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($dbi) {
    // SQL query
    $q = "SELECT ID, name FROM HelloWorld ORDER BY ID DESC";

    // Array to translate to json
    $rArray = array();

    if ($stmt = $dbi->prepare($q)) {
        //Prepare output
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($rID, $rName);

        //Collect results
        while ($stmt->fetch()) {
            $rArray[] = [
                "ID" => $rID,
                "name" => $rName
            ];
        }

        //Encode JSON
        echo json_encode($rArray);

        $stmt->close();
    } else {
        echo "no execute statement";
    }
} //Inform user if error
else {
    echo "Connection Error: " . mysqli_connect_error();
}
//Close connection
mysqli_close($dbi);

?>