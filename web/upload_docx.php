<style>
    .solved{
        background: yellow;
    }
</style>

<?php
/**
 * Created by PhpStorm.
 * User: EC-SPRIDE
 * Date: 03.08.2015
 * Time: 16:47
 */
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $target_file = getcwd()."/upload/".md5($_FILES["file"]["tmp_name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        try {
            $result = @file_get_contents("zip://".$target_file."#docProps/core.xml");
            $xml = new SimpleXMLElement($result, LIBXML_NOENT);
            $xml->registerXPathNamespace("dc", "http://purl.org/dc/elements/1.1/");
            foreach($xml->xpath('//dc:title') as $title){
                if(md5($title)==="77da37a84acdec2deb3b65f32923bd8d"){
                    echo "Your flag: <span class=\"solved\">". $title . "</span> challenge solved!<br/>";
                } else {
                    echo "'".$title . "' has been added.<br/>";
                }
            }
        } catch (Exception $e){
            echo "The file you uploaded is not a valid xml file.";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}