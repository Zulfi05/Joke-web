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
$uid = $_SESSION["uid"];
}
    // Connect to the database and verify the connection
    try {
        $db = new PDO($attr, $db_user, $db_pwd, $options);
        $query4 ="SELECT jokes.joke_tittle,
        jokes.joke,
        jokes.joke_id,
        jokes.post_date,
        userinfo.first_name,
        userinfo.last_name, 
        userinfo.username,
        userinfo.avatar,
        AVG(rating.rating) as avg_rating
        from userinfo
        left join jokes on (jokes.uid =userinfo.uid)
        left join rating on (jokes.joke_id=rating.joke_id)
        where  userinfo.uid ='$uid'
        group by userinfo.uid, jokes.joke_id
        ORDER BY jokes.post_date DESC limit 20;";
         $result4 = $db->query($query4);
        while($row6 = $result4->fetchAll()){
            $json=$row6;
        }
    
    
        echo json_encode($json);
        
        // Close the database connection
        $db = null;
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    
?>