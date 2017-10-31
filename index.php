
<?
include 'DB.php';
include 'functions.php';
echo "<label>Отзывы посетителей:</label>";
export();
?>
<head>
<title> Отзывы </title>  
<style>
.granted { border: 2px solid green; }

.denied { border: 2px solid red; }
textarea {
	/* = Убираем скролл */
	overflow: auto;

	/* = Убираем увеличение */
	resize: none;
	width: 300px;
	height: 150px;

	/* = Добавим фон, рамку, отступ*/
	background: #f6f6f6;
	border: 1px solid #cecece;
	border-radius: 8px 0 0 0;
	padding: 8px 0 8px 10px;
}

input {
	width: 300px;
	background: #f6f6f6;
	border: 1px solid #cecece;
	border-radius: 8px 0 0 0;
	padding: 8px 0 8px 10px;
}
table{
	background: #f6f6f6;
	border: 1px solid #cecece;
	border-radius: 8px 0 0 0;
}
td{
	background: #f6f6f6;
	border: 1px solid #cecece;
	border-radius: 8px 0 0 0;
}
  </style>
<script>
function grant(element)// присвоить класс отправки
	{
		element.classList.remove("denied");
		element.classList.add("granted");
	
	}
function denie(element)//присвоить визуально запрещающий класс отправки сообщения
	{
 
		element.classList.remove("granted");
		element.classList.add("denied");
	
	}

function validate(form) // ф-ция валидации формы 
	{
		var elements = form.elements;
		var sub = true;
		
			if (!elements.user.value)
				{
					denie(elements.user);
					sub = false;
				}
			else acces(elements.user,/[А-Яа-яЁё]/);
			
			if (!elements.comment.value)
				{
					denie(elements.comment);
					sub = false;
				}
			else acces(elements.comment,/^[^#$%^&*'"]/);
			
			if (elements.file.value)
				{
					var get = false;
					var file = elements.file.value;
					var dotCheck =  file.split('.').pop();
					var validTypes = ['gif','jpg','png'];
							for (var i = 0; i < validTypes.length; i++) 
								{
									if (validTypes[i] == dotCheck) 
										{
		                                 	get = true;
										}
								}
					if (get==false)
						{
							sub = false;
							denie(elements.file);
						}
				}
			if (elements.val.value)
				{
					var check = parseInt(elements.val.value);
					var sum = parseInt(elements.sum.value);
	
						if(sum==check)
							{
								grant(elements.val);
							} 
				}
			else 
				{
					denie(elements.val);
					sub = false;
				}
	
	return sub;
	}
	

function acces(elements, regexp)//проверка ввода запрещенных символов
	{
		if (!regexp.test(elements.value)) 
			{
				denie(elements);
			} 
		
	}
	
function randomNumber(m,n)//функция для генерации случайных чисел
	{
		m = parseInt(m);
		n = parseInt(n);
		return Math.floor( Math.random() * (n - m + 1) ) + m;
	};

window.onload=function() //при загрузке документа генерируем случайные числа для проверки робот\нет и добавляем в html
			{
				var aspmA = randomNumber(1,23); 
				var aspmB = randomNumber(1,23); 
				var sumAB = aspmA + aspmB;  
				document.getElementById('aspm').innerHTML = aspmA + ' + ' + aspmB;  
				document.getElementById('sum').innerHTML =sumAB;  
			}
</script>
</head>

<body>
<form action= "index.php" method = "POST" autocomplete="off" enctype=multipart/form-data  >
<p> Оставить отзыв </p>
<p><textarea rows="10" cols="45" id="comment" name="comment" pattern="^[А-Яа-яЁё\s]+$" placeholder="Ваш отзыв"  required></textarea></p>
</br>
<label> Назовите себя </label>
</br>
<input type="text" name="user" id="user" pattern="^[А-Яа-яЁё\s]+$" placeholder="Ваше имя" required >
</br>
<label> Вы можете прикрепить файл jpg, png, gif </label>
</br>
<input type="file" id="file" name="file" >
</br>
<span id="aspm"></span>
</br>
<input type ="text" name="val" id="val" required >
<input type="hidden" name ="sum" id="sum">
</br>

<input type="submit" id="submit" name="submit" onclick="validate(this.form)" value ="Отправить отзыв">
</form>

<? 
if($_POST['submit'])
	{
		$comment[] = $_POST['user'];
		$comment[] = $_POST['comment'];
		$comment[] = $_SERVER['REMOTE_ADDR'];
			if (is_uploaded_file($_FILES['file']['tmp_name']))
				{
					$file=$_FILES;
			
					echo "<pre>";
					//print_r($_POST["file"]);
					var_dump($file);
					echo "</pre>";
					if (file_check($file)== true)
						{
							@mkdir("img", 0777);
							copy($_FILES['file']['tmp_name'],"img/".basename($_FILES['file']['name']));
							$comment[]="img/".$_FILES["file"]["name"];
							echo "проверка прошла успешно";
							echo "<pre>";
							print_r($comment);
							echo "</pre>";
							add($comment);
						}
				}
			else 
				{
					echo "<pre>";
					print_r($comment);
					echo "</pre>";
					add($comment);
				}
	}
