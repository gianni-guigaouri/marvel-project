<?php 

require_once ('util/RemoveAccent.php');

class UploadImage // class to add image to img folder check if valid or not 
{


	public function validImageRecipe($picture, $personnageName)
	{
		$dirlink = "link-default.jpg";
		$folder = 'public/img/personnages/'; 
		$maxSize = 1000000 * 5; 
	   	if ($_FILES['image']['error'] == UPLOAD_ERR_OK AND $_FILES['image']['size'] <= $maxSize) 
	   	{
			$nomFichier = $_FILES['image']['name']; 
			$tmpFichier = $_FILES['image']['tmp_name']; 
			$file = new \finfo(); // Classe FileInfo
			$mimeType = $file->file($_FILES['image']['tmp_name'], FILEINFO_MIME_TYPE); 
			$mimTypeOK = array('image/jpeg', 'image/jpg', 'image/png', 'image/gif'); 
		        
	      	if (in_array($mimeType, $mimTypeOK)) 
	      	{ 
	         	$newFileName = explode('.', $nomFichier);
            	$fileExtension = 'jpg'; 
            	$beforeFinalFileName = $personnageName.'.'.$fileExtension;

            	$accent = new RemoveAccent();
            	$finalFileName = $accent->removeAccentAndSpace($beforeFinalFileName);

            	if(move_uploaded_file($tmpFichier, $folder.$finalFileName)) 
            	{ 
	         		$dirlink = $finalFileName; 
	         	}	
	         	else
	         	{
	         		$dirlink = "link-default.jpg";
	         	}
			} 
			else
   			{
   				throw new Exception('Ce type de fichier est interdit, mime type incorrect !');
   			}
		} 
		else 
		{
		   throw new Exception('Merci de choisir un fichier image (uniquement au format jpg) à uploader et ne dépassant pas 5Mo !');    
		}
		
		return $dirlink;
	}
}	