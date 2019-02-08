<?php
$host = 'db';
$dbname = 'database';
$user = 'user';
$pass = 'pass';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT table_name FROM information_schema.tables WHERE table_schema = :dbname";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
    $stmt->execute();
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (!in_array('games', $tables)) {
        $games_sql = "CREATE TABLE games (
                  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  user_id INT(10),
                  winner INT(10),
                  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                  )";
        $conn->exec($games_sql);
    }
    if (!in_array('moves', $tables)) {
        $moves_sql = "CREATE TABLE moves (
                  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  game_id INT(10),
                  player_id INT(10),
                  x_position INT(10),
                  y_position INT(10),
                  path VARCHAR(250),
                  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                  )";
        $conn->exec($moves_sql);
    }
    if (!in_array('users', $tables)) {
        $users_sql = "CREATE TABLE users (
                  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  name VARCHAR(250),
                  email VARCHAR(250),
                  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                  )";
        $conn->exec($users_sql);
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':dbname', $dbname, PDO::PARAM_STR);
    $stmt->execute();
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables in database $dbname: <br>";
    foreach ($tables as $table) {
        echo $table . "<br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
