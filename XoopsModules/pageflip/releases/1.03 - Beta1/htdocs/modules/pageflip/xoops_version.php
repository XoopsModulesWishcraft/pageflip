<?php

// $Author$
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Simon Roberts (AKA wishcraft)                                     //
// URL: http://www.chronolabs.org.au                                         //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //

$modversion['name'] = _MI_PAGEFLIP_NAME;
$modversion['version'] = 1.03;
$modversion['releasedate'] = "Saturday: September 17, 2011";
$modversion['description'] = _MI_PAGEFLIP_DESCRIPTION;
$modversion['author'] = "Wishcraft";
$modversion['credits'] = "Simon Roberts (simon@chronolabs.coop)";
$modversion['help'] = "pageflip.html";
$modversion['license'] = "GPL";
$modversion['official'] = 0;
$modversion['status']  = "RC";
$modversion['image'] = "images/pageflip_slogo.png";
$modversion['dirname'] = _MI_PAGEFLIP_DIRNAME;

$modversion['author_realname'] = "Simon Roberts";
$modversion['author_website_url'] = "http://www.chronolabs.coop";
$modversion['author_website_name'] = "Chronolabs Cooperative";
$modversion['author_email'] = "simon@chronolabs.coop";
$modversion['demo_site_url'] = "http://xoops.demo.chronolabs.coop";
$modversion['demo_site_name'] = "Chronolabs Co-op XOOPS Demo";
$modversion['support_site_url'] = "";
$modversion['support_site_name'] = "Chronolabs";
$modversion['submit_bug'] = "";
$modversion['submit_feature'] = "";
$modversion['usenet_group'] = "sci.chronolabs";
$modversion['maillist_announcements'] = "";
$modversion['maillist_bugs'] = "";
$modversion['maillist_features'] = "";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

// Main things
$modversion['hasMain'] = 1;

//$modversion['onUpdate'] = "include/update.php";
//$modversion['onInstall'] = "include/install.php";
//$modversion['onUninstall'] = "include/uninstall.php";

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

// $modversion['sqlfile']['postgresql'] = "sql/pgsql.sql";
// Tables created by sql file (without prefix!)
$modversion['tables'][0] = "pageflip_books";
$modversion['tables'][1] = "pageflip_chapters";
$modversion['tables'][2] = "pageflip_pages";
$modversion['tables'][3] = "pageflip_page_links";
$modversion['tables'][4] = "pageflip_css";

// Blocks
$modversion['blocks'][1]['file'] = "pageflip_block_book.php";
$modversion['blocks'][1]['name'] = 'Book' ;
$modversion['blocks'][1]['description'] = "Shows book";
$modversion['blocks'][1]['show_func'] = "b_pageflip_block_book_show";
$modversion['blocks'][1]['edit_func'] = "b_pageflip_block_book_edit";
$modversion['blocks'][1]['options'] = "0";
$modversion['blocks'][1]['template'] = "pageflip_block_book.html" ;

// Templates
$modversion['templates'][1]['file'] = 'pageflip_index.html';
$modversion['templates'][1]['description'] = 'Main Index for Book';
$modversion['templates'][2]['file'] = 'pageflip_book.html';
$modversion['templates'][2]['description'] = 'Main Book Display';
$modversion['templates'][3]['file'] = 'pageflip_flippingbook_js.html';
$modversion['templates'][3]['description'] = 'Main Control Flipping Book Javascript';
$modversion['templates'][4]['file'] = 'pageflip_liquid_css.html';
$modversion['templates'][4]['description'] = 'Main Control Liquid CSS';
$modversion['templates'][5]['file'] = 'pageflip_liquid_js.html';
$modversion['templates'][5]['description'] = 'Main Control Liquid Javascript';
$modversion['templates'][6]['file'] = 'pageflip_books.html';
$modversion['templates'][6]['description'] = 'Main Control Books List';
$modversion['templates'][7]['file'] = 'pageflip_cpanel_books_list.html';
$modversion['templates'][7]['description'] = 'Main Control Panel Book List';
$modversion['templates'][8]['file'] = 'pageflip_cpanel_books_edit.html';
$modversion['templates'][8]['description'] = 'Main Control Panel Book Edit';
$modversion['templates'][9]['file'] = 'pageflip_cpanel_css_list.html';
$modversion['templates'][9]['description'] = 'Main Control Panel CSS List';
$modversion['templates'][10]['file'] = 'pageflip_cpanel_css_edit.html';
$modversion['templates'][10]['description'] = 'Main Control Panel CSS Edit';
$modversion['templates'][11]['file'] = 'pageflip_cpanel_pages_list.html';
$modversion['templates'][11]['description'] = 'Main Control Panel Page List';
$modversion['templates'][12]['file'] = 'pageflip_cpanel_pages_edit.html';
$modversion['templates'][12]['description'] = 'Main Control Panel Page Edit';
$modversion['templates'][13]['file'] = 'pageflip_cpanel_chapters_list.html';
$modversion['templates'][13]['description'] = 'Main Control Panel Chapters List';
$modversion['templates'][14]['file'] = 'pageflip_cpanel_chapters_edit.html';
$modversion['templates'][14]['description'] = 'Main Control Panel Chapters Edit';
$modversion['templates'][15]['file'] = 'pageflip_pdf.html';
$modversion['templates'][15]['description'] = 'Main Control PDF Output Template';


$i = 0;
$i++;
$modversion['config'][$i]['name'] = 'uploaddirtype';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_UPLOADDIRTYPE';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_UPLOADDIRTYPE_DESC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = XOOPS_UPLOAD_PATH;
$modversion['config'][$i]['options'] = array(	_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH	=>	XOOPS_UPLOAD_PATH,
												_MI_PAGEFLIP_PATH_XOOPS_VAR_PATH	=>	XOOPS_VAR_PATH,
												_MI_PAGEFLIP_PATH_OTHER				=>	'');

$i++;
$modversion['config'][$i]['name'] = 'uploaddir';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_UPLOADDIR';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_UPLOADDIR_DESC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'pageflip';

$i++;
$modversion['config'][$i]['name'] = 'scale_images';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_SCALE_IMAGES';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_SCALE_IMAGES_DESC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = true;

$i++;
$modversion['config'][$i]['name'] = 'auto_crop_images';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_AUTO_CROP_IMAGES';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_AUTO_CROP_IMAGES_DESC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = true;

$i++;
$modversion['config'][$i]['name'] = 'allowed_file_extensions';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_ALLOWED_FILE_EXTENSION';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_ALLOWED_FILE_EXTENSION_DESC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "jpg|jpeg|png|gif|swf|pdf";

$i++;
$modversion['config'][$i]['name'] = 'allowed_mimetypes';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_ALLOWED_MIMETYPES';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_ALLOWED_MIMETYPES_DESC';
$modversion['config'][$i]['formtype'] = 'textarea';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = "image/jpeg|image/pjpeg|image/png|image/gif|application/x-shockwave-flash|application/pdf";

$i++;
$modversion['config'][$i]['name'] = 'maximum_filesize';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_MAXIMUM_FILESIZE';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_MAXIMUM_FILESIZE_DESC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 1024*1024*2.5;

$i++;
$modversion['config'][$i]['name'] = 'thumbnail_width';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_THUMBNAIL_WIDTH';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_THUMBNAIL_WIDTH_DESC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 140;

$i++;
$modversion['config'][$i]['name'] = 'thumbnail_height';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_THUMBNAIL_HEIGHT';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_THUMBNAIL_HEIGHT_DESC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 140;

$i++;
$modversion['config'][$i]['name'] = 'auto_generate';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_AUTO_GENERATE';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_AUTO_GENERATE_DESC';
$modversion['config'][$i]['formtype'] = 'yesno';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = true;

$i++;
$modversion['config'][$i]['name'] = 'print_width';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_PRINT_WIDTH';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_PRINT_WIDTH_DESC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 2480;

$i++;
$modversion['config'][$i]['name'] = 'print_height';
$modversion['config'][$i]['title'] = '_MI_PAGEFLIP_PRINT_HEIGHT';
$modversion['config'][$i]['description'] = '_MI_PAGEFLIP_PRINT_HEIGHT_DESC';
$modversion['config'][$i]['formtype'] = 'text';
$modversion['config'][$i]['valuetype'] = 'int';
$modversion['config'][$i]['default'] = 3508;
?>
