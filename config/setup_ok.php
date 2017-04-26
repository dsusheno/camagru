<?php
session_start();
include "../config/database.php";
?>

<html>
<head>
    <title>PicYourSelf</title>
    <link rel="stylesheet" type="text/css" href="../front/css/body.css" />
</head>
<body>
<?php
if ($_POST['code'] == "setup")
{
    try {
        $DB_con = new PDO("mysql:host={$DB_DSN}", $DB_USER,$DB_PASSWORD);
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DROP DATABASE IF EXISTS camagru";
        $DB_con->exec($sql);
        $sql = "CREATE DATABASE IF NOT EXISTS camagru; USE camagru;";
        $DB_con->exec($sql);
        $sql = "CREATE TABLE users(
                login VARCHAR(50) NOT NULL,
                pwd VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                activated INT(1) DEFAULT 0,
                pwd_activation TEXT NOT NULL,
                PRIMARY KEY (login)
        );";
        $sql .= "CREATE TABLE comments(
                id INT(11) NOT NULL AUTO_INCREMENT,
                img_path VARCHAR(50) NOT NULL,
                login VARCHAR(50) NOT NULL,
                comment TEXT NOT NULL,
                comment_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
        );";
        $sql .= "CREATE TABLE images(
                id INT(11) NOT NULL AUTO_INCREMENT,
                name  TEXT NOT NULL,
                img_path text NOT NULL,
                login VARCHAR(50),
                time_creat TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
        );";
         $sql .= "CREATE TABLE likes(
                img_path TEXT NOT NULL,
                login VARCHAR(50) NOT NULL
        );";
        $DB_con->exec($sql);
        echo "<h3>DATABASE CONFIGURATED</h3>";
        ?>
        <script type="text/javascript">
            function timeOut() {
                window.location = "../front/index.php";
            }
            window.setTimeout(timeOut, 3000);
        </script>
        <?php
    }
    catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    die();
    }
    $DB_con = null;
    if ($_SESSION['user_session'])
    {
        unset($_SESSION['user_session']);
        session_destroy();
    }
}
else
{
    echo "<h3>Oooopppss! Wrong Code.</h3>";
    ?>
    <script type="text/javascript">
    function timeOut() {
        window.location = "../config/setup.php";
    }
    window.setTimeout(timeOut, 3000);
    </script>
    <?php
}
?>
</body>
</html>
