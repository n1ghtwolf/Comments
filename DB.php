<?
function add($comment)
{
    $mysqli = new mysqli('localhost', 'root','', 'commentaries') or mysqli_connect_error("Подключение невозможно: ");
    
	$mysqli ->query("INSERT INTO `comments` (`name`,`comment`,`ip`)  VALUES ('{$comment[0]}','{$comment[1]}','{$comment[2]}');");
    $mysqli ->close();

}
function export()
	{
		$mysqli = new mysqli('localhost', 'root','', 'commentaries') or mysqli_connect_error("Подключение невозможно: ");
		
		$sql="SELECT * FROM `comments`";
		$res = mysqli_query($mysqli,$sql);
		
		if ($res->num_rows==0){
		echo "</br>";
		echo "Здесь пока что нет отзывов.Ваш может стать первым!";}	
		//print_r($res);
		
		else {
			echo "<table>";
			echo "<tr>";
				while($comment = mysqli_fetch_assoc($res))
				{					
					echo "<td>";
					echo "<div> Отзыв №{$comment['id']}</div>";
					echo "<div>{$comment['comment']}</div>";
					echo "<div>{$comment['name']}</div>";
					echo "<div>{$comment['ip']}</div>";
					echo "</td>";
					echo "</tr>";						
				}
			echo "</table>";
}
	} 