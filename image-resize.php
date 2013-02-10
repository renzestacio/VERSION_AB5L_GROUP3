<?php
	function imageresize($filename, $type){
	// Set a maximum height and width
	$width = 150;
	$height = 150;

	// Content type
	header('Content-Type: image/jpeg');

	// Get new dimensions
	list($width_orig, $height_orig) = getimagesize($filename);

	$ratio_orig = $width_orig/$height_orig;

	if ($width/$height > $ratio_orig) {
	   $width = $height*$ratio_orig;
	} else {
	   $height = $width/$ratio_orig;
	}

	// Resample
	$image_p = imagecreatetruecolor($width, $height);
					switch(strtolower($type))
					{
						case 'image/jpeg':
							$image = imagecreatefromjpeg($filename);
							break;
						case 'image/png':
							$image = imagecreatefrompng($filename);
							break;
						case 'image/gif':
							$image = imagecreatefromgif($filename);
							break;
						default:
							exit('Unsupported type: '.$type);
					}	
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
	
	// Output
	ob_start();
	imagejpeg($image_p, NULL, 100);
	$data = ob_get_clean();
	// Destroy resources
	imagedestroy($image);
	imagedestroy($image_p);
	// Set new content-type and status code
	header("Content-type: image/jpeg", true, 200);
	// Output data
	return $data;
	}
?>