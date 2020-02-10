<?php
$servername = "u1754003";
$username = "u1754003";
$password = "09aug99";

try {
    $conn = new PDO("mysql:host=localhost;dbname=u1754003", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
  }

  $fighterId=$_GET['id'];
  $stmt = $conn->prepare("SELECT fighter.first_name, fighter.last_name, division.weights, country.name, style.title, style.description
    FROM fighter
    JOIN division ON fighter.division_id = division.division_id
    JOIN style ON fighter.style_id = style.style_id
    JOIN country ON fighter.country_id = country.country_id
    WHERE fighter_id = :id");
  $stmt->bindValue('id',$fighterId);
  $stmt->execute();
  $fighterId=$stmt->fetchAll();
  $con=NULL;
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Details Page</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<ul>
<p><a href="Main.php"> Home Page</a></p>
</ul>
<h1>Information</h1>
<?php
echo "<table>";
if ($fighterId){
  foreach ($fighterId as $fighter)
  {
    echo "<tr>";
    echo "<td>{$fighter['first_name']}</td>";
    echo "<td>{$fighter['last_name']}</td>";
    echo "<td>{$fighter['weights']}</td>";
    echo "<td>{$fighter['title']}</td>";
    echo "<td>{$fighter['description']}</td>";
    echo"</tr>";
  }
}
else {
echo "No results";
}
echo "</table>";
?>
</body>
</html>
