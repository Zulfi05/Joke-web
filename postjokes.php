<?php
    session_start();
    require_once("db.php");
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data); //encodes
        return $data;
    }
    
    
    
    // Check whether the user has logged in or not.
    if (!isset($_SESSION["uid"])) {
        header("Location: login.php");
        exit();
    } else {
        
            $firstName = $_SESSION["first_name"];
            $lastName = $_SESSION["last_name"];
            $uid = $_SESSION["uid"];
            $avatar = $_SESSION["avatar"];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // If we got here through a POST submitted form, process the form
            $errors = array();
            // Collect and validate form inputs
            $joke_tittle = test_input($_POST["tittle"]);
            $joke = test_input($_POST["jokepo"]);
            // Form Field Regular Expressions

            // Validate the form inputs against their Regexes 
            $dataOK = TRUE;
           // if (strlen($joke_tittle)>50) {
              //  $errors["tittle"] = "Invalid Tittle";
               // $dataOK = FALSE;
            //}
            if ($dataOK) {
                
                try{
                /* ??? */ 
                $db = new PDO($attr, $db_user, $db_pwd, $options);
                
                $query = "INSERT INTO jokes (uid,joke,joke_tittle,avg_rating) 
                VALUES('$uid','$joke','$joke_tittle',0)";
                $result = $db->exec($query);
                
                if (!$result) {
                    $errors["Database Error:"] = "Failed to insert joke";
                }else {
                    
                    $result=null;
                    $db =null;
                    
                    header("Location:Joke_List.php");
                    
                    exit();
                }

                } catch(PDOException $e){
                    die("error: " . $e->getMessage());
                }
        
            }
            if (!empty($errors)) {
                foreach($errors as $error => $message) {
                    print("$error: $message \n<br />");
                }
            }
        }
}

?>
<!DOCTYPE html>
<html lang="en-US">

<head>

    <title>Jokes</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <div class="mygrid">
        <div class="header">
            <h1>Post A Joke <a class="logout" href="logout.php">Logout</a></h1>
            <script src="post_js.js"></script>
            <h2><?=$firstName?></h2>
        </div>
        <div class="div2">
            <img src="images/2.jpg" alt="Image " />
        </div>
        <main class="div3">
            <form action="" method="post" class="auth-form" id="logformid">
                <p class="in">
                    <label>Enter Name of The Joke</label>
                    <input type="text" name="tittle" id="tittle" maxlength="50" class="tittle"/>
                </p>
                <p class="in">
                    <label>Enter Joke</label>
                    <input type="text" name="jokepo" id="jokepo" class="jokepo"/>
                </p>
                <p class="input-field">
                    <button type="submit" id="postbutton" >Post</button>
                </p>
                <p>
                    Total Charecter Count = <span class="counter" id="count">0</span>
                </p>
                <p id="limitmass">
                    Tittle Charecter Limit is <span class="limit" id="massage">Good</span>
                </p>
            </form>
        </main>
        
        <div class="div4">
            <img src="images/4.jpg" alt="Image " />
        </div>
        <div class="div5">
            <img src="images/5.jpg" alt="Image " />
        </div>
        <div class="div6">
            <img src="images/5.jpg" alt="Image " />
        </div>
        
    </div>
    <script src="post_reg_js.js"></script>
</body>

</html>