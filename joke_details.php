<?php
     session_start();
     require_once("db.php");
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data); //encodes
        return $data;
    }
    if (!isset($_SESSION["uid"])) {
        header("Location: login.php");
        exit();
    } else {
        $firstName = $_SESSION["first_name"];
        $lastName = $_SESSION["last_name"];
        $username = $_SESSION["username"];
        $dob = $_SESSION["dob"];
        $uid = $_SESSION["uid"];
        $avatar = $_SESSION["avatar"];
        $_SESSION["joke_id"] = $_GET["joke_id"];
        $joke_id=$_SESSION["joke_id"];
        $db = new PDO($attr, $db_user, $db_pwd, $options);
    }
    
    $uid =  $_SESSION["uid"];
    $rating = "";
    

        
    $query2 ="SELECT jokes.joke_tittle,
    jokes.joke,
    jokes.post_date,
    userinfo.first_name,
    userinfo.last_name, 
    userinfo.username,
    userinfo.dob
    from userinfo
    left join jokes on (jokes.uid =userinfo.uid)
    where  jokes.joke_id='$joke_id'
    group by userinfo.uid, jokes.joke_id
    ORDER BY jokes.post_date ;";
    $result2 = $db->query($query2);
    $row = $result2->fetch();
    ?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Jokes</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="joke_det.js"></script>
</head>

<body>
    <div class="mygrid">
        <div class="header">
            <h1>Joke Details <a class="logout" href="logout.php">Logout</a></h1>
            <h2><?=$firstName?> </h2>
        </div>
        <div class="div2">
            <img src="images/2.jpg" alt="Image " />
        </div>
        <main class="div3">
            
                <h2>Creator Information</h2>
                
                
                    <p>Name : <?=$row['first_name']?> <?=$row['last_name']?></p>
                    <p>Date of birth : <?=$row['dob']?></p>
                    <p>Username : <?=$row['username']?></p>
                <h2>Joke</h2>
                <p class="the_joke">
                <p>Tittle : <?=$row['joke_tittle']?></p>
                <p><?=$row['joke']?></p>
                </p>
                <form action="" method="get" >
                <p class="input-field">
                    
                    <label>Rating:1-5</label>
                    <button type="button" id="decrease" class="hide">Decrease</button>
                    <input type="number"  name="rating" value="0" class="rate" id="rate"/>
                    <button type="button" id="increase" class="increase">Increase</button>
                    <p id="last-login"></p>
                </p>
                
                <p class="input-field">
                    <?php
    
                        $id= $joke_id; 
                    ?>
                    <input type="hidden"  name="submitted" value="1"/>
                    <button type="button" id="ratingform">Save </button>

                </p>
                <button type="button" onclick="window.location.href='Joke_List.php';">GO BACK</button>
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
        <footer class="foot">
        </footer>
    </div>
    <script src="joke_det_reg.js"></script>
</body>

</html>