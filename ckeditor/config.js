/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
config.uiColor = '#000';	// 外框色
config.width = 800;
config.resize_maxWidth = 770;
config.resize_minWidth = 770;
config.height = '400px'; //可以這樣寫
config.skin = 'office2003';
//config.toolbarCanCollapse = true;
//config.toolbarStartupExpanded = true;

config.contentsCss = '/includes/css/sub.css';

//['Source','-','Templates','-','Cut','Copy','Paste'],
//['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
//['Link','Unlink','Anchor'],
//['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
//'/', ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
//['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
//['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
//['Format','FontSize','-','TextColor','BGColor']

config.toolbar = 'Full';
 
config.toolbar_Full =
[
    ['Source','-','NewPage','Preview','-','Templates'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
    '/',
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['BidiLtr', 'BidiRtl'],['Link','Unlink'],['Maximize', 'ShowBlocks'],
    '/',
    ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
    ['Styles','Format','Font','FontSize'],
    ['TextColor','BGColor'],
    ['Maximize', 'ShowBlocks']
    ['TextColor','BGColor']
];
 
config.toolbar_Basic =
[
    ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About']
];

// }ҤWǥ\G
config.filebrowserBrowseUrl = '/ckfinder/ckfinder.html';
config.filebrowserImageBrowseUrl = '/ckfinder/ckfinder.html?Type=Images';
config.filebrowserFlashBrowseUrl = '/ckfinder/ckfinder.html?Type=Flash';
config.filebrowserUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'; //iWǤ@ɮ
config.filebrowserImageUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';//iWǹ
config.filebrowserFlashUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';//iWFlashɮ
};
