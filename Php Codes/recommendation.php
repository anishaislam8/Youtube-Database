<html>
<head>
<title> Recommendation </title>
</head>
<body>

<?php
session_start();

$conn_string = "host=localhost port=5432 dbname=project user=postgres password=hr";
$db = pg_connect($conn_string);

$userName = $_SESSION['username'];

$result = pg_query($db, "select user_id from users where user_name = '$userName'");
$ans = pg_fetch_assoc($result);

$func = pg_query($db,"select * from recommendnew({$ans['user_id']})");

echo "<p> <h3 style=\"text-align:left;\"><a href = \"logout.php\"><font color = \"red\"> LOG OUT? </font> </a>  </h3></p>";
//echo "<br/>";

echo "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ";
echo " <button type = \"submit\" name = \"submit\" style = \"background:red; height:50px; width:80px;\"> <a href = \"user.php\"> <font color = \"white\">Back</font> </a> </button>";

echo "<h1><font color = \"#FC0000\"> <center> <u> Recommended Videos </u> </center> </font> </h1>";
echo "<table align = \"center\" bgcolor = \"#FFFBDA\">";


while($row = pg_fetch_row($func))
{

	$res2 = pg_query($db, "select title,video_id from video where content_path = '{$row['0']}' ");
	$ans2 = pg_fetch_assoc($res2);
	
	$id = $ans2['video_id'];
	$name = $ans2['title'];
	echo "<tr><td><p style = \"font-family:georgia,garamond,serif;font-size:24px;\"><a href = 'watch.php?id=$id'>$name</a></p></td></tr>";
}
echo "</table>";

?>

</body>
</html>
