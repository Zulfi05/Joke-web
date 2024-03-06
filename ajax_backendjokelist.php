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
$latestid=$_SESSION["latestid"];
}
    // Connect to the database and verify the connection

    try {
        $latestid=$_SESSION["latestid"];
        $db = new PDO($attr, $db_user, $db_pwd, $options);
        $query6= "SELECT count(joke_id) from jokes where joke_id > '$latestid';";
        $result6 = $db->query($query6);
        $matches = $result6->fetchColumn();
        $json = array();
        if($matches != 0){
        $query2 ="SELECT jokes.joke_tittle,
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
        where  userinfo.uid!='$uid' AND jokes.joke_id > '$latestid'
        group by userinfo.uid, jokes.joke_id
        ORDER BY jokes.post_date DESC;";
        $result2 = $db->query($query2);
        
        
        

        while($row6 = $result2->fetchAll()){
            
            for($i=0;$i<1;$i++){
                $_SESSION["latestid"]=$row6[0]['joke_id'];
            }
            $json=$row6;
        }
        
    
        echo json_encode($json);
        }else{
            echo json_encode($json);
        }
        // Close the database connection
        $db = null;
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
?>
