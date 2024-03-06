<?php
session_start();
require_once("db.php");

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}
if (!isset($_SESSION["uid"])) {
    header("Location: login.php");
    exit();
}else{
    $errors = array();
$rating = intval($_GET['q']);
$joke_id = $_SESSION["joke_id"];
$uid = $_SESSION["uid"];
}
    // Connect to the database and verify the connection
    if($rating != null){
    try {
        $db = new PDO($attr, $db_user, $db_pwd, $options);
        
        $query3 ="SELECT COUNT(*)
        from rating
        where joke_id='$joke_id' AND uid= '$uid'";
        $result3 = $db->query($query3);
        $matches = $result3->fetchColumn();
        //echo  $result3;
       if($matches == 0){
        $query4 = "INSERT INTO rating (joke_id,uid,rating) 
            VALUES('$joke_id','$uid','$rating')";
            $result4 = $db->exec($query4);
        }else{
            $query = "UPDATE rating set joke_id ='$joke_id' ,uid= '$uid',rating = '$rating' 
            where joke_id='$joke_id' and uid= '$uid'";
            $result = $db->exec($query);
        }
        $json = array();
        $query6 = "SELECT rating FROM rating where joke_id='$joke_id' and uid= '$uid';";
        $result6 = $db->query($query6);
        
        while($row6 = $result6->fetchAll()){
            $json=$row6;
        }
    
        echo json_encode($json);
        // Close the database connection
        $db = null;
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    }else{
        echo  $errors["dob"] = "Invalid DOB";
    }
?>
