<?
function file_check($file){
	$valid_types =  array("gif","jpg", "png", "jpeg");
	$ext 		 = substr($_FILES['userfile']['name'],1 + strrpos($_FILES['userfile']['name'], "."));
		if (!in_array($ext, $valid_types)) 
			{
				echo 'Error: Invalid file type.';
				$ext = false;
			}
		else 
				$ext = true;
	return $ext;
} 
