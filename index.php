<?
include 'DB.php';
include 'functions.php';
export();
?>
<head>
<title> Отзывы </title>
</head>
<body>
<form action= "index.php" method = "POST" autocomplete="off" >
<p> Оставить отзыв </p>
<textarea rows="10" cols="45" name = "comment" pattern="^[А-Яа-яЁё\s]+$" placeholder="Комментарий" required>    </textarea>
</br>
<label> Назовите себя </label>
</br>
<input type="text" name = "user" pattern= "^[А-Яа-яЁё\s]+$" placeholder="Ваше имя" required>
</br>
<label> Вы можете прикрепить файл jpg, png, gif </label>
</br></br>
<input type="file" name = "file"   >
</br>

<input type="submit" name = "submit" value ="Отправить отзыв">
</form>
<? 

	

	if($_POST['submit'])
		{
	$comment[] = $_POST['user'];
	$comment[] = $_POST['comment'];
	$comment[] = $_SERVER['REMOTE_ADDR'];
	$file = $_POST["file"];
	if (isset ($file)
		if (file_check($file)== true){
			$comment[]=$_POST["file"]["name"];
			add($comment);
		}
			
		echo "<pre>";
        print_r($comment);
        echo "</pre>";
		add($comment);
		 
		}
