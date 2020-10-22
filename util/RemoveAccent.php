<?php 

class RemoveAccent // class to to remove accent when name the image 
{


	public function removeAccentAndSpace($param)
	{
	        $param= strtr($param,
	          "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
	           "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
	        
	        $param = str_replace(CHR(32),"",$param); 
	        return $param;
	}
}	