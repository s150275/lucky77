<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Replace Selected Textarea Elements &mdash; CKEditor Sample</title>
<meta content="text/html; charset=big5" http-equiv="content-type"/>
<link href="../sample.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<form action="../sample_posteddata.php" method="post">
<p>
<textarea cols="80" id="editor1" name="editor1" rows="10">&lt;p&gt;This is some &lt;strong&gt;sample text&lt;/strong&gt;. You are using &lt;a href="http://ckeditor.com/"&gt;CKEditor&lt;/a&gt;.&lt;/p&gt;</textarea>
</p>
<p>
<input type="submit" value="Submit"/>
</p>
</form>

<?php
// Include the CKEditor class.
include_once "../../ckeditor.php";
// Create a class instance.
$CKEditor = new CKEditor();
// Path to the CKEditor directory, ideally use an absolute path instead of a relative dir.
//   $CKEditor->basePath = '/ckeditor/'
// If not set, CKEditor will try to detect the correct path.
$CKEditor->basePath = '../../';
// Replace a textarea element with an id (or name) of "editor1".
$CKEditor->replace("editor1");
?>

</body>
</html>
