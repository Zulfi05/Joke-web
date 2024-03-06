<?php
    session_start();
    require_once("db.php");

    // Check whether the user has logged in or not.
    if (!isset($_SESSION["uid"])) {
        header("Location: login.php");
        exit();
    } else {
        $firstName = $_SESSION["first_name"];
        $lastName = $_SESSION["last_name"];
        $uid = $_SESSION["uid"];
        $avatar = $_SESSION["avatar"];
    }

    // Connect to the database and verify the connection
    try {
        $db = new PDO($attr, $db_user, $db_pwd, $options);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $query ="SELECT jokes.joke_tittle,
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
    where  userinfo.uid='$uid'
    group by userinfo.uid, jokes.joke_id
    ORDER BY jokes.post_date DESC;";
            $result = $db->query($query);
            $query3 ="SELECT jokes.joke_tittle,
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
    where  userinfo.uid='$uid'
    group by userinfo.uid, jokes.joke_id
    ORDER BY jokes.post_date DESC;";
            $result3 = $db->query($query3);
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
    where  userinfo.uid!='$uid'
    group by userinfo.uid, jokes.joke_id
    ORDER BY jokes.post_date DESC;";
            $result2 = $db->query($query2);
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
    where  userinfo.uid!='$uid'
    group by userinfo.uid, jokes.joke_id
    ORDER BY jokes.post_date DESC;";
            $result4 = $db->query($query4);
            if (!$result2) {
                // handle errors
                $errors["Database Error"] = "Could not retrieve user information";
            } 
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Jokes</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="joke_list.js"></script>
</head>

<body>
    <div class="mygrid_list">
        <div class="List_header">
            <h1> <?=$firstName?>'s Jokes List <a class="logout" href="logout.php">Logout</a></h1>
            <h2><?=$firstName?></h2>
            
        </div>
        <div class="search">
            <p class="search_bar">

                <input class="inlistline18" type="text" placeholder="Search Jokes" name="S" />
                <button class="searchbutton" type="submit">Go</button>
            </p>


        </div>
        <div class="post_jokes">
            <p><a class="pjokes" href="postjokes.php">Post Jokes</a></p>

        </div>
        <main class="list_left" id= "list_left">
            <h2><?=$firstName?>'s Jokes</h2>
            <?php
            $row = $result->fetchAll();
            
            
            if(sizeof($row)>20){
                $_SESSION["latestidL"]=$row[0]['joke_id'];
            for($i=0;$i<20;$i++){
                ?>
                <div class="list_rightjoke">
                    <p><?=$row[$i]['joke_tittle']?></p>
                    <p><?=$row[$i]['joke']?></p>
                    <p><?=$row[$i]['post_date']?></p>
                    <p><?=$row[$i]['avg_rating']?></p>
                </div>
                <?php  
            } } else{
                $row3 = $result3->fetchAll();
                $_SESSION["latestidL"]=$row3[0]['joke_id'];
                for($i=0;$i<sizeof($row3);$i++){
            ?>
                <div class="list_rightjoke">
                    <p><?=$row3[$i]['joke_tittle']?></p>
                    <p><?=$row3[$i]['joke']?></p>
                    <p><?=$row3[$i]['post_date']?></p>
                    <p><?=$row3[$i]['avg_rating']?></p>
                </div>
            <?php
                }}
                ?>

        </main>
        <main class="list_right" id="list_right">
            <h2>Other User's Jokes</h2>
            <?php
            $row2 = $result2->fetchAll();
             
            if(sizeof($row2)>20){
                $_SESSION["latestid"]=$row2[0]['joke_id'];
                for($i=0;$i<20;$i++){
            ?>
            <div class="list_rightjoke" >
                    <p><?=$row2[$i]['first_name']?></p>
                    <p><img class="img2" src="<?=$row2[$i]['avatar']?>" alt="Image " /></p>
                    <?php
    
                       $id= $row2[$i]['joke_id'];
                       
                    ?>
                    <p><a href="joke_details.php?joke_id=<?php echo $id?>"><?=$row2[$i]['joke_tittle']?></a></p>
                    <p><?=$row2[$i]['joke']?></p>
                    <p><?=$row2[$i]['post_date']?></p>
                    <p><?=$row2[$i]['avg_rating']?></p>


                </div>
            <?php

            }}else{ 
                $row4 = $result4->fetchAll();
                $_SESSION["latestid"]=$row2[0]['joke_id']; 
                for($i=0;$i<sizeof($row4);$i++){
                ?>
                <div class="list_rightjoke" >
                        <p><?=$row4[$i]['first_name']?></p>
                        <p><img class="img2" src="<?=$row4[$i]['avatar']?>" alt="Image " /></p>
                        <?php
        
                           $id= $row4[$i]['joke_id'];
                           
                        ?>
                        <p><a href="joke_details.php?joke_id=<?php echo $id?>"><?=$row4[$i]['joke_tittle']?></a></p>
                        <p><?=$row4[$i]['joke']?></p>
                        <p><?=$row4[$i]['post_date']?></p>
                        <p><?=$row4[$i]['avg_rating']?></p>


                </div>
            <?php
                }}
                $db=null;
            ?>
                
            
        </main>
    </div>
</body>

</html>