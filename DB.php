<?
function add($comment)//добавление записей в бд
	{
		$mysqli = new mysqli('localhost', 'root','', 'commentaries') or mysqli_connect_error("Подключение невозможно: ");
    
		$mysqli ->query("INSERT INTO `comments` (`name`,`comment`,`ip`,`img`)  VALUES ('{$comment[0]}','{$comment[1]}','{$comment[2]}','{$comment[3]}');");
		$mysqli ->close();

	}
function export()//вывод отзывов из бд
	{
		$mysqli = new mysqli('localhost', 'root','', 'commentaries') or mysqli_connect_error("Подключение невозможно: ");
		
		$sql="SELECT * FROM `comments`";
		$res = mysqli_query($mysqli,$sql);
		
			if ($res->num_rows==0)
				{
					echo "</br>";
					echo "Здесь пока что нет отзывов.Ваш может стать первым!";
				}	
		
		
			else 
				{
					echo "<table>";
					echo "<tr>";
						while($comment = mysqli_fetch_assoc($res))
							{					
								echo "<td>";
								echo "<div> Отзыв №{$comment['id']}</div>";
								echo "<div>Написал коментарий:{$comment['comment']}</div>";
								echo "<div>Пользователь:{$comment['name']}</div>";
								echo "<div>С такого ип адреса:{$comment['ip']}</div>";
								echo "<div><img src='" . $comment['img'] . "' alt='' /></div>";
								echo "</td>";
								echo "</tr>";						
							}
					echo "</table>";
				}
	} 