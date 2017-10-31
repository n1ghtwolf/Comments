<?
function file_check($file)//проверка расширения файла
	{
		$valid_types =  array("gif","jpg", "png");
		$ext 		 = substr($file['file']['name'],1 + strrpos($file['file']['name'], "."));
			if (!in_array($ext, $valid_types)) 
				{
					echo 'Только файлы с раширениями:gif,jpg,png ';
					$ext = false;
				}
			else 
				$ext = true;
		
		return $ext;
	} 
