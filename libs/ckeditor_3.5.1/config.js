﻿/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};

CKEDITOR.editorConfig = function( config )
{
    config.toolbar = 'MyToolbar';
	config.filebrowserUploadUrl = '../libs/ckeditor_3.5.1/ckupload.php';
 
    config.toolbar_MyToolbar =
    [
         ['Source','-','Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About','-','Image']
    ];
	
	config.height = 420; 
	config.width = 	600;
};

