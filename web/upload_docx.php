<style>
    .solved{
        background: yellow;
    }
</style>

<?php
if(isset($_POST["submit"])) {
    $target_file = getcwd()."/upload/".md5($_FILES["file"]["tmp_name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        try {
            $result = @file_get_contents("zip://".$target_file."#docProps/core.xml");
            $xml = new SimpleXMLElement($result, LIBXML_NOENT);
            $xml->registerXPathNamespace("dc", "http://purl.org/dc/elements/1.1/");
            foreach($xml->xpath('//dc:title') as $title){
                echo "Title '".$title . "' has been added.<br/>";
            }
        } catch (Exception $e){
            echo "The file you uploaded is not a valid xml or docx file.";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}