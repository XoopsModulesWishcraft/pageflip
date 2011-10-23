CREATE TABLE `pageflip_books` (
  `bid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cids` varchar(1000) DEFAULT NULL,
  `pids` varchar(1000) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `reference` varchar(128) DEFAULT 'fb_%id%_',
  `description` varchar(500) DEFAULT NULL,
  `language` varchar(64) DEFAULT 'english',
  `default` int(2) DEFAULT '0',
  `pages` int(10) DEFAULT '0',
  `chapters` int(10) DEFAULT '0',
  `stageWidth` int(3) unsigned DEFAULT '100',
  `stageHeight` int(3) unsigned DEFAULT '100',
  `bookWidth` int(5) unsigned DEFAULT '640',
  `bookHeight` int(5) DEFAULT '640',
  `scaleContent` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `centerContent` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `preserveProportions` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `hardcover` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_FALSE',
  `hardcoverThickness` int(4) unsigned DEFAULT '3',
  `hardcoverEdgeColor` varchar(6) DEFAULT 'FFFFFF',
  `highlightHardcover` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `frameWidth` int(4) unsigned DEFAULT '0',
  `frameColor` varchar(6) DEFAULT 'FFFFFF',
  `frameAlpha` int(4) unsigned DEFAULT '100',
  `firstPageNumber` int(4) unsigned DEFAULT '1',
  `autoFlipSize` int(4) unsigned DEFAULT '50',
  `navigationFlipOffset` int(4) unsigned DEFAULT '30',
  `flipOnClick` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `handOverCorner` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `handOverPage` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `alwaysOpened` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_FALSE',
  `staticShadowsType` enum('_MI_PAGEFLIP_ASYMMETRIC','_MI_PAGEFLIP_SYMMETRIC','_MI_PAGEFLIP_DEFAULT') DEFAULT '_MI_PAGEFLIP_ASYMMETRIC',
  `staticShadowsDepth` int(4) unsigned DEFAULT '1',
  `staticShadowsDarkColor` varchar(6) DEFAULT '000000',
  `staticShadowsLightColor` varchar(6) DEFAULT 'FFFFFF',
  `dynamicShadowsDepth` int(4) unsigned DEFAULT '1',
  `dynamicShadowsLightColor` varchar(6) DEFAULT 'FFFFFF',
  `dynamicShadowsDarkColor` varchar(6) DEFAULT '000000',
  `moveSpeed` int(4) unsigned DEFAULT '2',
  `gotoSpeed` int(4) unsigned DEFAULT '3',
  `closeSpeed` int(4) unsigned DEFAULT '3',
  `rigidPageSpeed` int(4) unsigned DEFAULT '5',
  `flipSound` varchar(255) DEFAULT NULL,
  `hardcoverSound` varchar(255) DEFAULT NULL,
  `preloaderType` enum('_MI_PAGEFLIP_PROGESSBAR','_MI_PAGEFLIP_ROUND','_MI_PAGEFLIP_THIN','_MI_PAGEFLIP_DOTS','_MI_PAGEFLIP_GRADIENTWHEEL','_MI_PAGEFLIP_GEARWHEEL','_MI_PAGEFLIP_LINE','_MI_PAGEFLIP_ANIMATEDBOOK','_MI_PAGEFLIP_NONE') DEFAULT '_MI_PAGEFLIP_THIN',
  `pageBackgroundColor` varchar(6) DEFAULT '99CCFF',
  `loadOnDemand` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `allowPagesUnload` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `showUnderlyingPages` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_FALSE',
  `playOnDemand` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `freezeOnFlip` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_FALSE',
  `darkPages` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_FALSE',
  `smoothPages` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_FALSE',
  `rigidPages` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_FALSE',
  `flipCornerStyle` enum('_MI_PAGEFLIP_FIRSTPAGEONLY','_MI_PAGEFLIP_EACHPAGE','_MI_PAGEFLIP_MANUALLY') DEFAULT '_MI_PAGEFLIP_MANUALLY',
  `flipCornerPosition` enum('_MI_PAGEFLIP_BOTTOMRIGHT','_MI_PAGEFLIP_TOPRIGHT','_MI_PAGEFLIP_BOTTOMLEFT','_MI_PAGEFLIP_TOPLEFT') DEFAULT '_MI_PAGEFLIP_BOTTOMRIGHT',
  `flipCornerAmount` int(4) unsigned DEFAULT '50',
  `flipCornerAngle` int(4) unsigned DEFAULT '20',
  `flipCornerRelease` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `flipCornerVibrate` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `flipCornerPlaySound` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_FALSE',
  `zoomEnabled` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `zoomImageWidth` int(5) unsigned DEFAULT '900',
  `zoomImageHeight` int(5) unsigned DEFAULT '1165',
  `zoomOnClick` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `zoomUIColor` varchar(6) DEFAULT '8F9EA6',
  `zoomHint` varchar(255) DEFAULT 'Use double click for zooming in /',
  `zoomHintEnabled` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `centerBook` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `useCustomCursors` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_FALSE',
  `dropShadowsEnabled` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `dropShadowsHideWhenFlipping` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `backgroundColor` varchar(6) DEFAULT 'FFFFFF',
  `backgroundImage` varchar(255) DEFAULT NULL,
  `backgroundImagePlacement` enum('_MI_PAGEFLIP_TOP_LEFT','_MI_PAGEFLIP_CENTER','_MI_PAGEFLIP_FIT') DEFAULT '_MI_PAGEFLIP_FIT',
  `printEnabled` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE') DEFAULT '_MI_PAGEFLIP_TRUE',
  `printTitle` varchar(255) DEFAULT 'Print Pages',
  `downloadURL` varchar(500) DEFAULT NULL,
  `downloadTitle` varchar(128) DEFAULT 'Download PDF',
  `downloadSize` varchar(128) DEFAULT 'Size: 4.7 Mb',
  `downloadComplete` varchar(128) DEFAULT 'Finished',
  `uid` int(13) unsigned DEFAULT '0',
  `created` int(12) unsigned DEFAULT '0',
  `updated` int(12) unsigned DEFAULT '0',
  `actioned` int(12) unsigned DEFAULT '0',
  PRIMARY KEY (`bid`),
  KEY `COMMON` (`cids`(100),`pids`(100),`name`(50),`bid`,`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

insert  into `pageflip_books` (`bid`,`cids`,`pids`,`name`,`reference`,`description`,`language`,`default`,`pages`,`chapters`,`stageWidth`,`stageHeight`,`bookWidth`,`bookHeight`,`scaleContent`,`centerContent`,`preserveProportions`,`hardcover`,`hardcoverThickness`,`hardcoverEdgeColor`,`highlightHardcover`,`frameWidth`,`frameColor`,`frameAlpha`,`firstPageNumber`,`autoFlipSize`,`navigationFlipOffset`,`flipOnClick`,`handOverCorner`,`handOverPage`,`alwaysOpened`,`staticShadowsType`,`staticShadowsDepth`,`staticShadowsDarkColor`,`staticShadowsLightColor`,`dynamicShadowsDepth`,`dynamicShadowsLightColor`,`dynamicShadowsDarkColor`,`moveSpeed`,`gotoSpeed`,`closeSpeed`,`rigidPageSpeed`,`flipSound`,`hardcoverSound`,`preloaderType`,`pageBackgroundColor`,`loadOnDemand`,`allowPagesUnload`,`showUnderlyingPages`,`playOnDemand`,`freezeOnFlip`,`darkPages`,`smoothPages`,`rigidPages`,`flipCornerStyle`,`flipCornerPosition`,`flipCornerAmount`,`flipCornerAngle`,`flipCornerRelease`,`flipCornerVibrate`,`flipCornerPlaySound`,`zoomEnabled`,`zoomImageWidth`,`zoomImageHeight`,`zoomOnClick`,`zoomUIColor`,`zoomHint`,`zoomHintEnabled`,`centerBook`,`useCustomCursors`,`dropShadowsEnabled`,`dropShadowsHideWhenFlipping`,`backgroundColor`,`backgroundImage`,`backgroundImagePlacement`,`printEnabled`,`printTitle`,`downloadURL`,`downloadTitle`,`downloadSize`,`downloadComplete`,`uid`,`created`,`updated`,`actioned`) values (1,'a:2:{i:1;s:1:\"1\";i:2;s:1:\"2\";}','a:15:{i:1;s:1:\"1\";i:2;s:1:\"2\";i:3;s:1:\"3\";i:4;s:1:\"4\";i:5;s:1:\"5\";i:6;s:1:\"6\";i:7;s:1:\"7\";i:8;s:1:\"8\";i:9;s:1:\"9\";i:10;s:2:\"10\";i:11;s:2:\"11\";i:12;s:2:\"12\";i:13;s:2:\"13\";i:14;s:2:\"14\";i:15;s:2:\"15\";}','Demo Book','fb_%id%_','This is the demo book provided with Page Flip','english',1,15,2,100,100,826,584,'_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE',3,'FFFFFF','_MI_PAGEFLIP_TRUE',0,'FFFFFF',100,1,50,30,'_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_ASYMMETRIC',1,'000000','FFFFFF',1,'FFFFFF','000000',2,3,3,5,'http://127.0.0.1/251/modules/pageflip/sounds/02.mp3','http://127.0.0.1/251/modules/pageflip/sounds/02.mp3','_MI_PAGEFLIP_THIN','5b7414','_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_MANUALLY','_MI_PAGEFLIP_BOTTOMRIGHT',50,20,'_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_TRUE',992,1403,'_MI_PAGEFLIP_TRUE','919d6c','Use double click for zooming in!','_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_TRUE','83a51c',NULL,'_MI_PAGEFLIP_FIT','_MI_PAGEFLIP_TRUE','','','','','',1,1316207968,1316440918,0);

CREATE TABLE `pageflip_chapters` (
  `cid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bid` int(10) unsigned DEFAULT '0',
  `pid` int(10) unsigned DEFAULT '0',
  `page` int(5) unsigned DEFAULT '0',
  `name` varchar(128) DEFAULT NULL,
  `uid` int(12) unsigned DEFAULT '0',
  `created` int(13) unsigned DEFAULT '0',
  `updated` int(13) unsigned DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `COMMON` (`bid`,`pid`,`name`(25),`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

insert  into `pageflip_chapters` (`cid`,`bid`,`pid`,`page`,`name`,`uid`,`created`,`updated`) values (1,1,1,1,'Cover',1,1316439317,1316440649);
insert  into `pageflip_chapters` (`cid`,`bid`,`pid`,`page`,`name`,`uid`,`created`,`updated`) values (2,1,4,4,'Modern',1,1316439704,1316440649);

CREATE TABLE `pageflip_css` (
  `cssid` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `bid` int(10) unsigned DEFAULT NULL,
  `mode` enum('_MI_PAGEFLIP_CSS_FOOTER','_MI_PAGEFLIP_CSS_PAGINATION','_MI_PAGEFLIP_CSS_CONTENTS','_MI_PAGEFLIP_CSS_MENU','_MI_PAGEFLIP_CSS_ALTMSG','_MI_PAGEFLIP_CSS_ALTLINK','_MI_PAGEFLIP_CSS_EXTRA') DEFAULT '_MI_PAGEFLIP_CSS_EXTRA',
  `css` varchar(2000) DEFAULT NULL,
  `hover` varchar(2000) DEFAULT NULL,
  `visited` varchar(2000) DEFAULT NULL,
  `reference` varchar(64) DEFAULT NULL,
  `uid` int(12) unsigned DEFAULT '0',
  `created` int(13) unsigned DEFAULT '0',
  `updated` int(13) unsigned DEFAULT '0',
  PRIMARY KEY (`cssid`),
  KEY `COMMON` (`bid`,`mode`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

insert  into `pageflip_css` (`cssid`,`bid`,`mode`,`css`,`hover`,`visited`,`reference`,`uid`,`created`,`updated`) values (1,1,'_MI_PAGEFLIP_CSS_FOOTER','height: 49px;\r\nbackground-color: #000000;\r\nbackground-repeat: repeat-x;','','','Footer',1,1316438679,0);
insert  into `pageflip_css` (`cssid`,`bid`,`mode`,`css`,`hover`,`visited`,`reference`,`uid`,`created`,`updated`) values (2,1,'_MI_PAGEFLIP_CSS_PAGINATION','color: #4e6605;\r\nmargin-left: 10px;','','','PaginationMinor',1,1316438698,0);
insert  into `pageflip_css` (`cssid`,`bid`,`mode`,`css`,`hover`,`visited`,`reference`,`uid`,`created`,`updated`) values (3,1,'_MI_PAGEFLIP_CSS_CONTENTS','float: left;\r\nmargin-top: 17px;\r\nmargin-left: 15px;','','','Contents',1,1316438714,0);
insert  into `pageflip_css` (`cssid`,`bid`,`mode`,`css`,`hover`,`visited`,`reference`,`uid`,`created`,`updated`) values (4,1,'_MI_PAGEFLIP_CSS_MENU','float: right;\r\nmargin-top: 9px;\r\nmargin-right: 15px;','','','Menu',1,1316438733,0);
insert  into `pageflip_css` (`cssid`,`bid`,`mode`,`css`,`hover`,`visited`,`reference`,`uid`,`created`,`updated`) values (5,1,'_MI_PAGEFLIP_CSS_ALTMSG','position: absolute;\r\nbackground-color:#000000;\r\npadding: 20px;\r\nopacity: 0.6;\r\nfilter: alpha(opacity=60);\r\ntext-align:center;','opacity: 0.8;\r\nfilter: alpha(opacity=80);','','altmsg',1,1316438764,0);
insert  into `pageflip_css` (`cssid`,`bid`,`mode`,`css`,`hover`,`visited`,`reference`,`uid`,`created`,`updated`) values (6,1,'_MI_PAGEFLIP_CSS_ALTLINK','color: #FFFFFF;','color: #FFFFFF;','color: #DDDDDD;','altlink',1,1316438798,0);

CREATE TABLE `pageflip_page_links` (
  `lid` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `bid` int(10) unsigned DEFAULT '0',
  `pids` varchar(500) DEFAULT NULL,
  `page` int(10) unsigned DEFAULT '0',
  `uid` int(13) unsigned DEFAULT '0',
  `created` int(13) unsigned DEFAULT '0',
  `updated` int(13) unsigned DEFAULT '0',
  PRIMARY KEY (`lid`),
  KEY `COMMON` (`bid`,`pids`(50),`page`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pageflip_pages` (
  `pid` int(30) unsigned NOT NULL AUTO_INCREMENT,
  `bid` int(10) unsigned DEFAULT '0',
  `cid` int(5) unsigned DEFAULT '0',
  `lid` int(20) unsigned DEFAULT '0',
  `page` int(5) unsigned DEFAULT '0',
  `mode` enum('_MI_PAGEFLIP_MODE_LANDSCAPE','_MI_PAGEFLIP_MODE_PORTTRAIT') DEFAULT NULL,
  `location` enum('_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','_MI_PAGEFLIP_PATH_XOOPS_VAR_PATH','_MI_PAGEFLIP_PATH_OTHER') DEFAULT '_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH',
  `path` varchar(255) DEFAULT 'pageflip',
  `filename` varchar(255) DEFAULT NULL,
  `filetype` enum('_MI_PAGEFLIP_FILETYPE_JPG','_MI_PAGEFLIP_FILETYPE_PNG','_MI_PAGEFLIP_FILETYPE_GIF','_MI_PAGEFLIP_FILETYPE_SWF') DEFAULT '_MI_PAGEFLIP_FILETYPE_JPG',
  `extension` varchar(5) DEFAULT 'jpg',
  `width` int(10) unsigned DEFAULT '0',
  `height` int(10) unsigned DEFAULT '0',
  `size` int(10) unsigned DEFAULT '0',
  `scaleContent` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT') DEFAULT '_MI_PAGEFLIP_DEFAULT',
  `showStaticShadows` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT') DEFAULT '_MI_PAGEFLIP_DEFAULT',
  `rigid` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT') DEFAULT '_MI_PAGEFLIP_DEFAULT',
  `wide` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT') DEFAULT '_MI_PAGEFLIP_DEFAULT',
  `playOnDemand` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT') DEFAULT '_MI_PAGEFLIP_DEFAULT',
  `centerContent` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT') DEFAULT '_MI_PAGEFLIP_DEFAULT',
  `w` int(10) unsigned DEFAULT '0',
  `h` int(10) unsigned DEFAULT '0',
  `freezeOnFlip` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT') DEFAULT '_MI_PAGEFLIP_DEFAULT',
  `smooth` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT') DEFAULT '_MI_PAGEFLIP_DEFAULT',
  `dark` enum('_MI_PAGEFLIP_TRUE','_MI_PAGEFLIP_FALSE','_MI_PAGEFLIP_DEFAULT') DEFAULT '_MI_PAGEFLIP_DEFAULT',
  `uid` int(13) unsigned DEFAULT '0',
  `created` int(13) unsigned DEFAULT '0',
  `updated` int(13) unsigned DEFAULT '0',
  `actioned` int(13) unsigned DEFAULT '0',
  PRIMARY KEY (`pid`),
  KEY `COMMON` (`bid`,`cid`,`lid`,`page`,`mode`,`location`,`filetype`,`extension`,`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (1,1,1,0,1,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','8ecca0e8b444e774515bcb6b.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316439317,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (2,1,1,0,2,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','3aea669e5204e77463eb9c60.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316439614,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (3,1,1,0,3,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','67ca9cff65c4e77466d922d8.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316439661,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (4,1,1,0,4,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','00c3d4b85ef4e774698499b5.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316439704,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (5,1,2,0,5,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','4227a17d50a4e7747ffb5640.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316440063,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (6,1,2,0,6,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','53101d6c2554e77481ca9b4c.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316440092,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (7,1,2,0,7,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','4d938ecee514e774833900b1.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316440115,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (8,1,2,0,8,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','0d5db2e5b704e774848d12aa.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316440136,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (9,1,2,0,9,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','094ef2222164e7748677dbdb.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316440167,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (10,1,2,0,10,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','28f9d51f5c44e774886e288f.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316440198,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (11,1,2,0,11,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','6e2e4c658664e7748a81b5cb.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316440232,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (12,1,2,0,12,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','42decb0eeab4e7748d3b2d55.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316440275,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (13,1,2,0,13,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','5e7f9e87e094e7748f15d8a3.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316440305,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (14,1,2,0,14,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','cef408a075e4e77491375b95.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316440339,1316440740,0);
insert  into `pageflip_pages` (`pid`,`bid`,`cid`,`lid`,`page`,`mode`,`location`,`path`,`filename`,`filetype`,`extension`,`width`,`height`,`size`,`scaleContent`,`showStaticShadows`,`rigid`,`wide`,`playOnDemand`,`centerContent`,`w`,`h`,`freezeOnFlip`,`smooth`,`dark`,`uid`,`created`,`updated`,`actioned`) values (15,1,2,0,15,'_MI_PAGEFLIP_MODE_PORTTRAIT','_MI_PAGEFLIP_PATH_XOOPS_UPLOAD_PATH','\\pageflip','752fbf6536f4e77492b6b6ba.jpeg','_MI_PAGEFLIP_FILETYPE_JPG','jpg',992,1403,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',0,0,'_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT','_MI_PAGEFLIP_DEFAULT',1,1316440363,1316440739,0);
