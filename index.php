
<?
include 'DB.php';
include 'functions.php';
echo "<label>Отзывы посетителей</label>";
export();
?>
<head>
<title> Отзывы </title>
<script>

function validate(form)
	{
		var elements = form.elements;
			if (!elements.user.value)
				{
					alert("заполните поля");
				}
			else acces(elements.user.value,regexp = /[А-Яа-яЁё]/);
			
			if (!elements.comment.value)
				{
					alert("заполните поля");
				}
			else acces(elements.comment.value,regexp = /^[^#$%^&*'"]/);
			
			if (elements.file.value)
				{
					var dotCheck = substr.elements.file.value(1 + elements.file.value,".");	
					var validTypes = array("gif","jpg", "png", "jpeg");
				}
			if(!in_array(dotCheck,validTypes))
				{
					alert("Разрешены только файлы с расширением: gif,jpg,png,jpeg");
				}
	}
	

function acces(elements, regexp) 
	{
		if (!regexp.test(elements)) 
			{
				alert("Не допустимые символы");
			} 
	}
</script>
</head>

<body>
<form action= "index.php" method = "POST" autocomplete="off" enctype=multipart/form-data  >
<p> Оставить отзыв </p>
<p><textarea rows="10" cols="45" name="comment"id="comment" pattern="^[А-Яа-яЁё\s]+$" placeholder="Комментарий"  required> </textarea></p>
</br>
<label> Назовите себя </label>
</br>
<input type="text" name="user" id ="user" pattern="^[А-Яа-яЁё\s]+$" placeholder="Ваше имя" required >
</br>
<label> Вы можете прикрепить файл jpg, png, gif </label>
</br>
<input type="file" name="file"id ="file" >
</br>

<input type="submit" id="submit" name="submit" onclick="validate(this.form)" value ="Отправить отзыв">
</form>

<? 

	

	if($_POST['submit'])
		{
	$comment[] = $_POST['user'];
	$comment[] = $_POST['comment'];
	$comment[] = $_SERVER['REMOTE_ADDR'];
		



	echo "<pre>";
        //print_r($_POST["file"]);
        var_dump($_FILES);
        echo "</pre>";
	/*if (isset ($file))
		if (file_check($file)== true){
			$comment[]=$_POST["file"]["name"];
			add($comment);
		}
			*/
		echo "<pre>";
        print_r($comment);
        echo "</pre>";
		//add($comment);
		 
		}
