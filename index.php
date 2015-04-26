<?php
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

require("config.php");
require("functions.php");

cleanTemp($tmpTime);

?>
<html>
<head>
    <title><? print($scriptTitle); ?></title>
    <LINK REL=stylesheet HREF="<? print($scriptCSS); ?>" TYPE="text/css">
</head>
<body>
<?php
if (isset($_REQUEST["submit"])) {
    $picturefile = $_FILES["picturefile"]["tmp_name"];
    $imgSizeArray = @GetImageSize($picturefile);
    $imgWidth = $imgSizeArray[0];
    $imgHeight = $imgSizeArray[1];
    $imgType = $imgSizeArray[2];
    if ($imgType == 1) {
        // GIF
        $im = imagecreatefromgif($picturefile);
    } else if ($imgType == 2) {
        //JPG
        $im = imagecreatefromjpeg($picturefile);
    } else if ($imgType == 3) {
        //PNG
        $im = imagecreatefrompng($picturefile);
    } else {
        $im = @ImageCreateFromWBMP($picturefile);
        if (!$im) {
            $imgError = $errorCode[0];
        }
}

if ($imgError) {
    print("<font color=red>$imgError</font><br>");
} else {
    $conTo = $_REQUEST["conTo"];
    if ($conTo == 1) {
        //GIF
        $NewImage = image2gif($im);
    } else if ($conTo == 2) {
        // JPG
        $NewImage = image2jpg($im);
    } else if ($conTo == 3) {
        //BMP
        $NewImage = image2bmp($im);
    } else if ($conTo == 4) {
        //PNG
        $NewImage = image2png($im);
    }
    jsWindoPopUp($NewImage, $imgWidth, $imgHeight);
}

?>


<a href="<? print($scriptFile); ?>"><? print($scriptGoBack); ?><a><br><br>
        <? } else {
            print("$scriptIntro <br> $scriptState :<br>");

            ?>
            <br><br>


        <? } ?>

        Please Select your the image you wish to convert.
        <form method="post" action="<? print($scriptFile); ?>" ENCTYPE="multipart/form-data">
            <table>
                <tr>
                    <td>Convert From:</td>
                    <td><INPUT NAME="picturefile" TYPE="file"></td>
                    <td>*.gif,*.jpg,*.png,*.bmp</td>
                </tr>
                <tr>
                    <td>Convert to:</td>
                    <td><select name="conTo">
                            <?
                            $arrTypes = convertArray();
                            for ($i = 0; $i < count($arrTypes); $i++) {
                                $x = $i + 1;
                                print("<option value=\"$x\"");
                                if ($conTo == $x) {
                                    print(" SELECTED ");
                                }
                                print(">$arrTypes[$i]</option>");
                            }

                            ?>
                        </select></td>
                    <td><input type="submit" name="submit" value="Convert"></td>
                </tr>
            </table>
        </form>
        <br>
        <? print("<font size=-1><a href=\"$scriptHome\">$scriptName</a><br>$scriptVER</font>"); ?>
</body>
</html>
