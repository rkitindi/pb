<?php

if(isset($_POST['insert']))
{
    try {

        // connect to mysql

        $pdoConnect = new PDO("mysql:host=localhost;dbname=ps_database","demouser","demopassword");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }

    // get values form input text and number
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $like = $_POST['like'];
    $rate = $_POST['rate'];
    $text = $_POST['add'];
    $lastlogdate =  date('Y-m-d H:i:s');

    // mysql query to insert Personal Info
    $pdoQuery = "INSERT INTO `personal_detail`(`name`, `age`, `gender`, `email`) VALUES (:name,:age,:gender,:email)";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(array(":name"=>$name,":age"=>$age,":gender"=>$gender,":email"=>$email));

    // check if mysql insert query successful
    if($pdoExec)
    {
        echo 'Personal Info Inserted';
    }else{
        echo 'Personal Info Not Inserted';
    }

    // mysql query to fetch latest user_id
    $stmt = $pdoConnect->query("SELECT user_id FROM personal_detail ORDER BY user_id DESC LIMIT 1");
    $user = $stmt->fetch();
    $userid = reset($user);

    // mysql query to insert Polls Info
    $pdoQuery = "INSERT INTO `responses`(`user_id`,`date`, `answer1`, `answer2`, `answer3`) VALUES (:userid,:date,:answer1,:answer2,:answer3)";
    $pdoResult = $pdoConnect->prepare($pdoQuery);
    $pdoExec = $pdoResult->execute(array(":userid"=>$userid,":date"=>$lastlogdate,":answer1"=>$like,":answer2"=>$rate,":answer3"=>$text));

    // check if mysql insert query successful
    if($pdoExec)
    {
        echo 'Poll Inserted Successfully';
    }else{
        echo 'Polls Not Inserted';
    }
}

?>
