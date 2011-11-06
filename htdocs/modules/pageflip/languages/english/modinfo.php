<?php
	
	//Xoops version
	define('_MI_PAGEFLIP_NAME', 'Page Flipping Books');
	define('_MI_PAGEFLIP_DESCRIPTION', 'Module made from the resources of <a href="http://page-flip.com/">Page Flip</a>');
	define('_MI_PAGEFLIP_DIRNAME', 'pageflip');
	
	//preferences
	define('_MI_PAGEFLIP_UPLOADDIRTYPE','Upload Prefix Path');
	define('_MI_PAGEFLIP_UPLOADDIRTYPE_DESC','This is the prefix for the path for the upload');
	define('_MI_PAGEFLIP_UPLOADDIR','Upload Postfix Path');
	define('_MI_PAGEFLIP_UPLOADDIR_DESC','This is the postfix for the upload.');
	define('_MI_PAGEFLIP_SCALE_IMAGES','Scale Images');
	define('_MI_PAGEFLIP_SCALE_IMAGES_DESC','Scale images for book?');
	define('_MI_PAGEFLIP_AUTO_CROP_IMAGES','Autocrop Images');
	define('_MI_PAGEFLIP_AUTO_CROP_IMAGES_DESC','Autocrop images for book?');
	define('_MI_PAGEFLIP_ALLOWED_FILE_EXTENSION','Allowed file extenstions for upload');
	define('_MI_PAGEFLIP_ALLOWED_FILE_EXTENSION_DESC','This is the allowed file extension for uploading to the module.');
	define('_MI_PAGEFLIP_ALLOWED_MIMETYPES','Allowed mime-types for the upload');
	define('_MI_PAGEFLIP_ALLOWED_MIMETYPES_DESC','This is the the allowed mime types for the uploading to the module.');
	define('_MI_PAGEFLIP_MAXIMUM_FILESIZE','Maxmimum file size');
	define('_MI_PAGEFLIP_MAXIMUM_FILESIZE_DESC','Maximum file size in bytes to be uploaded');
	define('_MI_PAGEFLIP_THUMBNAIL_WIDTH','Thumbnail width');
	define('_MI_PAGEFLIP_THUMBNAIL_WIDTH_DESC','The width in pixels of a thumbnail');
	define('_MI_PAGEFLIP_THUMBNAIL_HEIGHT','Thumbnail height');
	define('_MI_PAGEFLIP_THUMBNAIL_HEIGHT_DESC','This height in pixels of a thumbnail');
	define('_MI_PAGEFLIP_AUTO_GENERATE','Auto Generate PDF download for each book?');
	define('_MI_PAGEFLIP_AUTO_GENERATE_DESC','Enables PDF Generation for each book.');
	define('_MI_PAGEFLIP_PRINT_WIDTH', 'Print Width Size');
	define('_MI_PAGEFLIP_PRINT_WIDTH_DESC', 'The print width size for images.');
	define('_MI_PAGEFLIP_PRINT_HEIGHT', 'Print Height Size');
	define('_MI_PAGEFLIP_PRINT_HEIGHT_DESC', 'The print height size for images.');
	
	//Admin Menus
	define('_MI_PAGEFLIP_TITLE_ADMENU1', 'Books');
	define('_MI_PAGEFLIP_ICON_ADMENU1', '');
	define('_MI_PAGEFLIP_LINK_ADMENU1', 'admin/index.php?op=books&fct=list');
	define('_MI_PAGEFLIP_TITLE_ADMENU2', 'Pages');
	define('_MI_PAGEFLIP_ICON_ADMENU2', '');
	define('_MI_PAGEFLIP_LINK_ADMENU2', 'admin/index.php?op=pages&fct=list');
	define('_MI_PAGEFLIP_TITLE_ADMENU3', 'Chapters');
	define('_MI_PAGEFLIP_ICON_ADMENU3', '');
	define('_MI_PAGEFLIP_LINK_ADMENU3', 'admin/index.php?op=chapters&fct=list');
	define('_MI_PAGEFLIP_TITLE_ADMENU4', 'CSS');
	define('_MI_PAGEFLIP_ICON_ADMENU4', '');
	define('_MI_PAGEFLIP_LINK_ADMENU4', 'admin/index.php?op=css&fct=list');
	
	// Enumeration for CSS
	define('_MI_PAGEFLIP_CSS_FOOTER', 'Footer');
	define('_MI_PAGEFLIP_CSS_PAGINATION', 'Pagination');
	define('_MI_PAGEFLIP_CSS_CONTENTS', 'Contents');
	define('_MI_PAGEFLIP_CSS_MENU', 'Menu');
	define('_MI_PAGEFLIP_CSS_ALTMSG', 'Alternative Message');
	define('_MI_PAGEFLIP_CSS_ALTLINK', 'Alternative Link');
	define('_MI_PAGEFLIP_CSS_EXTRA', 'Extra CSS');
	
	// Enumeration Value for CSS
	define('_MI_PAGEFLIP_CSS_FOOTER_VALUE', 'Footer');
	define('_MI_PAGEFLIP_CSS_PAGINATION_VALUE', 'PaginationMinor');
	define('_MI_PAGEFLIP_CSS_CONTENTS_VALUE', 'Contents');
	define('_MI_PAGEFLIP_CSS_MENU_VALUE', 'Menu');
	define('_MI_PAGEFLIP_CSS_ALTMSG_VALUE', 'altmsg');
	define('_MI_PAGEFLIP_CSS_ALTLINK_VALUE', 'altlink');
	define('_MI_PAGEFLIP_CSS_EXTRA_VALUE', '');
	
	// Enumeration for Books
	define('_MI_PAGEFLIP_TRUE', _YES);
	define('_MI_PAGEFLIP_FALSE', _NO);
	define('_MI_PAGEFLIP_DEFAULT', 'Default');
	define('_MI_PAGEFLIP_ASYMMETRIC', 'Asymmetrical');
	define('_MI_PAGEFLIP_SYMMETRIC', 'Symmetrical');
	define('_MI_PAGEFLIP_PROGESSBAR', 'Progress Bar');
	define('_MI_PAGEFLIP_ROUND', 'Round');
	define('_MI_PAGEFLIP_THIN', 'Thin');
	define('_MI_PAGEFLIP_DOTS', 'Dots');
	define('_MI_PAGEFLIP_GRADIENTWHEEL', 'Gradient Wheel');
	define('_MI_PAGEFLIP_GEARWHEEL', 'Gear Wheel');
	define('_MI_PAGEFLIP_LINE', 'Line');
	define('_MI_PAGEFLIP_ANIMATEDBOOK', 'Animated Book');
	define('_MI_PAGEFLIP_NONE', 'None');
	define('_MI_PAGEFLIP_FIRSTPAGEONLY', 'First Page Only');
	define('_MI_PAGEFLIP_EACHPAGE', 'Each Page');
	define('_MI_PAGEFLIP_MANUALLY', 'Manually');
	define('_MI_PAGEFLIP_BOTTOMRIGHT', 'Bottom right');
	define('_MI_PAGEFLIP_TOPRIGHT', 'Top right');
	define('_MI_PAGEFLIP_BOTTOMLEFT', 'Bottom left');
	define('_MI_PAGEFLIP_TOPLEFT', 'Top left');
	define('_MI_PAGEFLIP_FIT', 'Fit to size');
	define('_MI_PAGEFLIP_TOP_LEFT', 'Top left');
	define('_MI_PAGEFLIP_CENTER', 'Center');

	// Enumeration Values for Books
	define('_MI_PAGEFLIP_TRUE_VALUE', 'true');
	define('_MI_PAGEFLIP_FALSE_VALUE', 'false');
	define('_MI_PAGEFLIP_DEFAULT_VALUE', 'Default');
	define('_MI_PAGEFLIP_ASYMMETRIC_VALUE', 'Asymmetric');
	define('_MI_PAGEFLIP_SYMMETRIC_VALUE', 'Symmetric');
	define('_MI_PAGEFLIP_PROGESSBAR_VALUE', 'Progress Bar');
	define('_MI_PAGEFLIP_ROUND_VALUE', 'Round');
	define('_MI_PAGEFLIP_THIN_VALUE', 'Thin');
	define('_MI_PAGEFLIP_DOTS_VALUE', 'Dots');
	define('_MI_PAGEFLIP_GRADIENTWHEEL_VALUE', 'Gradient Wheel');
	define('_MI_PAGEFLIP_GEARWHEEL_VALUE', 'Gear Wheel');
	define('_MI_PAGEFLIP_LINE_VALUE', 'Line');
	define('_MI_PAGEFLIP_ANIMATEDBOOK_VALUE', 'Animated Book');
	define('_MI_PAGEFLIP_NONE_VALUE', 'None');
	define('_MI_PAGEFLIP_FIRSTPAGEONLY_VALUE', 'first page only');
	define('_MI_PAGEFLIP_EACHPAGE_VALUE', 'each page');
	define('_MI_PAGEFLIP_MANUALLY_VALUE', 'manually');
	define('_MI_PAGEFLIP_BOTTOMRIGHT_VALUE', 'bottom-right');
	define('_MI_PAGEFLIP_TOPRIGHT_VALUE', 'top-right');
	define('_MI_PAGEFLIP_BOTTOMLEFT_VALUE', 'bottom-left');
	define('_MI_PAGEFLIP_TOPLEFT_VALUE', 'top-left');
	define('_MI_PAGEFLIP_FIT_VALUE', 'fit');
	define('_MI_PAGEFLIP_TOP_LEFT_VALUE', 'top left');
	define('_MI_PAGEFLIP_CENTER_VALUE', 'center');

	// Enumeration for Pages
	define('_MI_PAGEFLIP_MODE_LANDSCAPE', 'Landscape');
	define('_MI_PAGEFLIP_MODE_PORTTRAIT', 'Porttrait');
	define('_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH', 'Upload Path');
	define('_MI_PAGEFLIP_PATH_XOOPS_VAR_PATH', 'Secure Data Path');
	define('_MI_PAGEFLIP_PATH_OTHER', 'Other Path');
	define('_MI_PAGEFLIP_FILETYPE_SWF', 'Shockwave Flash');
	define('_MI_PAGEFLIP_FILETYPE_GIF', 'GIF File');
	define('_MI_PAGEFLIP_FILETYPE_PNG', 'PNG File');
	define('_MI_PAGEFLIP_FILETYPE_JPG', 'JPG File');
	
	// Enumeration Values for Pages
	define('_MI_PAGEFLIP_MODE_LANDSCAPE_VALUE', 'Landscape');
	define('_MI_PAGEFLIP_MODE_PORTTRAIT_VALUE', 'Portrait');
	define('_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH_VALUE', XOOPS_UPLOAD_PATH);
	define('_MI_PAGEFLIP_PATH_XOOPS_VAR_PATH_VALUE', XOOPS_VAR_PATH);
	define('_MI_PAGEFLIP_PATH_OTHER_VALUE', DIRECTORY_SEPARATOR);
	define('_MI_PAGEFLIP_FILETYPE_SWF_VALUE', 'Adobe Flash');
	define('_MI_PAGEFLIP_FILETYPE_GIF_VALUE', 'GIF File');
	define('_MI_PAGEFLIP_FILETYPE_PNG_VALUE', 'PNG File');
	define('_MI_PAGEFLIP_FILETYPE_JPG_VALUE', 'JPEG File');
	
	//Javascript Sprintf Statements (Do Not Change)
	define('_MI_PAGEFLIP_JS_SWFOBJECT', '/modules/pageflip/js/swfobject.js');
	define('_MI_PAGEFLIP_JS_WHEEL', '/modules/pageflip/js/wheel.js');
	define('_MI_PAGEFLIP_JS_LIQUID', '/modules/pageflip/js/liquid.php?bid=%s&block=%s');
	define('_MI_PAGEFLIP_JS_FLIPPINGBOOK', '/modules/pageflip/js/flippingbook.php?bid=%s&block=%s');
	
	//CSS Sprintf Statements (Do Not Change)
	define('_MI_PAGEFLIP_CSS_LIQUID', '/modules/pageflip/css/liquid.php?bid=%s&block=%s');
	
	//Framework Includes
	define('_MI_PAGEFLIP_FRAMEWORK_WIDEIMAGE', '/Frameworks/wideimage/WideImage.php');
	define('_MI_PAGEFLIP_FRAMEWORK_TCPF', '/Frameworks/tcpdf/tcpdf.php');
	
?>
	
	