<?php  
$error="";

$db = pg_connect("host=localhost port=5432 dbname=car_pooling user=postgres password=byakuya~720");
if(!$db){
    echo "failed";
}else{
    echo "success";
}
if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = pg_query_params($db, 'SELECT password FROM useraccount WHERE email= $1', array($email)); 
    $row = pg_fetch_array($result);
    echo $row[0];
    echo $password;
    $verify = $password == $row[0];

    if ($verify) {
        $_SESSION['user']=$email;
        echo "password is valid";
        header("Location: www.yahoo.com");    
    }else{
        $error = "Username or Password is invalid!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login Below</h2>
    <form method="post" name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Email:<br>
        <input type="text" name="email">
        <br>
        Password:<br>
        <input type="text" name="password">
        <br><br>
        test
        <input type="submit" name="submit">
        <div><?php if(isset($error)) {echo $error; } ?></div>
    </form>
</body>

</html>

