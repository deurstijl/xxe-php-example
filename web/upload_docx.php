<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>.docx uploader</title>
</head>
<body>
<div align="center">
<h1>.docx uploader</h1>

<?php
if(isset($_POST["submit"])) {
    $target_file = getcwd()."/upload/".md5($_FILES["file"]["tmp_name"]);
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        try {
            $result = @file_get_contents("zip://".$target_file."#docProps/core.xml");
            $xml = new SimpleXMLElement($result, LIBXML_NOENT);
            $xml->registerXPathNamespace("dc", "http://purl.org/dc/elements/1.1/");
            foreach($xml->xpath('//dc:title') as $title){
                echo "Title '".$title . "' has been added to the archive.<br/>";
            }
        } catch (Exception $e){
            echo "The file you uploaded is not a valid docx file.";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
</div>
</body>
</html>