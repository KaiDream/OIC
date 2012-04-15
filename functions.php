<?
/*
 * OIC - the Online Image Converter                   
 * Copyright (C) 2001 Ray Lopez (http://www.TheDreaming.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */



function image2jpg($im) {
        $timeer = microtime();
        $filename = "tmp/$timeer.jpg";
        imagejpeg($im, $filename);
        return($filename);
}

function image2gif($im) {
        $timeer = microtime();
        $filename = "tmp/$timeer.gif";
        imagegif($im, $filename);
        return($filename);
}

function image2bmp($im) {
        $timeer = microtime();
        $filename = "tmp/$timeer.bmp";
        imagegif($im, $filename);
        return($filename);
}

function image2png($im) {
        $timeer = microtime();
        $filename = "tmp/$timeer.png";
        imagegif($im, $filename);
        return($filename);
}

function convertArray() {
	$arrConvert[] = "GIF";
	$arrConvert[] = "JPG";
	$arrConvert[] = "BMP";
	$arrConvert[] = "PNG";
	return $arrConvert;
}

function cleanTemp($old) {
	$currentTime = time();
	$handle=opendir("tmp/");
	while (false!==($file = readdir($handle))) { 
		if ($file != "." && $file != "..") { 
			$fileDate = filemtime($file); 
			if(($currentTime - $fileDate) > $old) {
				unlink("tmp/".$file);
			}
		}
	}	
}

function jsWindoPopUp($image, $width, $height) {
	print("<script language=javascript>");
	print("	window.open(\"$image\" ,\"OICImage\",\"width=$width,height=$height,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0,hotkeys=0,locationbar=0\");");
	print("</script>");
}

?>
