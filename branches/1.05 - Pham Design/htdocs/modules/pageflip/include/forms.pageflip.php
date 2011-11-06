<?php

	function pageflip_books_get_form($object, $as_array=false) {
		
		if (!is_object($object)) {
			$handler = xoops_getmodulehandler('books', 'pageflip');
			$object = $handler->create(); 
		}
		
		xoops_loadLanguage('forms', 'pageflip');
		$ele = array();
		
		if ($object->isNew()) {
			$sform = new XoopsThemeForm(_FRM_PAGEFLIP_FORM_ISNEW_BOOK, 'book', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'new');
		} else {
			$sform = new XoopsThemeForm(_FRM_PAGEFLIP_FORM_EDIT_BOOK, 'book', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'edit');
		}
		
		$sform->setExtra( "enctype='multipart/form-data'" ) ;
		
		$id = $object->getVar('bid');
		if (empty($id)) $id = '0';
		
		$ele['op'] = new XoopsFormHidden('op', 'books');
		$ele['fct'] = new XoopsFormHidden('fct', 'save');
		if ($as_array==false)
			$ele['id'] = new XoopsFormHidden('id', $id);
		else 
			$ele['id'] = new XoopsFormHidden('id['.$id.']', $id);
		$ele['sort'] = new XoopsFormHidden('sort', isset($_REQUEST['sort'])?$_REQUEST['sort']:'created');
		$ele['order'] = new XoopsFormHidden('order', isset($_REQUEST['order'])?$_REQUEST['order']:'DESC');
		$ele['start'] = new XoopsFormHidden('start', isset($_REQUEST['start'])?intval($_REQUEST['start']):0);
		$ele['limit'] = new XoopsFormHidden('limit', isset($_REQUEST['limit'])?intval($_REQUEST['limit']):30);
		$ele['filter'] = new XoopsFormHidden('filter', isset($_REQUEST['filter'])?$_REQUEST['filter']:'1,1');
							
		$ele['name'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_NAME:''), $id.'[name]', ($as_array==false?35:21),128, $object->getVar('name'));
		$ele['name']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_NAME_DESC:''));
		$ele['description'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DESCRIPTION:''), $id.'[description]', ($as_array==false?35:21), 500, $object->getVar('description'));
		$ele['description']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DESCRIPTION_DESC:''));
		$ele['reference'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_REFERENCE:''), $id.'[reference]', ($as_array==false?35:21), 128, $object->getVar('reference'));
		$ele['reference']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_REFERENCE_DESC:''));
		$ele['language'] = new PageflipFormSelectLanguage(($as_array==false?_FRM_PAGEFLIP_FORM_TEXT_LANGUAGE:''), $id.'[language]', $object->getVar('language'));
		$ele['language']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_TEXT_LANGUAGE_DESC:''));
		$ele['default'] = new XoopsFormRadioYN(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DEFAULT:''), $id.'[default]', $object->getVar('default'));
		$ele['default']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DEFAULT_DESC:''));
		$ele['stageWidth'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STAGEWIDTH:''), $id.'[stageWidth]', ($as_array==false?5:5), 3, $object->getVar('stageWidth'));
		$ele['stageWidth']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STAGEWIDTH_DESC:''));
		$ele['stageHeight'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STAGEHEIGHT:''), $id.'[stageHeight]', ($as_array==false?5:5), 3, $object->getVar('stageHeight'));
		$ele['stageHeight']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STAGEHEIGHT_DESC:''));
		$ele['bookWidth'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BOOKWIDTH:''), $id.'[bookWidth]', ($as_array==false?5:5), 5, $object->getVar('bookWidth'));
		$ele['bookWidth']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BOOKWIDTH_DESC:''));
		$ele['bookHeight'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BOOKHEIGHT:''), $id.'[bookHeight]', ($as_array==false?5:5), 5, $object->getVar('bookHeight'));
		$ele['bookHeight']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BOOKHEIGHT_DESC:''));
		$ele['scaleContent'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_SCALECONTENT:''), $id.'[scaleContent]', $object->getVar('scaleContent'));
		$ele['scaleContent']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_SCALECONTENT_DESC:''));
		$ele['centerContent'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_CENTERCONTENT:''), $id.'[centerContent]', $object->getVar('centerContent'));
		$ele['centerContent']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_CENTERCONTENT_DESC:''));
		$ele['preserveProportions'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PRESERVEPROPORTIONS:''), $id.'[preserveProportions]', $object->getVar('preserveProportions'));
		$ele['preserveProportions']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PRESERVEPROPORTIONS_DESC:''));
		$ele['hardcover'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HARDCOVER:''), $id.'[hardcover]', $object->getVar('hardcover'));
		$ele['hardcover']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HARDCOVER_DESC:''));
		$ele['hardcoverThickness'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HARDCOVERTHICKNESS:''), $id.'[hardcoverThickness]', ($as_array==false?5:5), 5, $object->getVar('hardcoverThickness'));
		$ele['hardcoverThickness']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HARDCOVERTHICKNESS_DESC:''));
		$ele['hardcoverEdgeColor'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HARDCOVEREDGECOLOUR:''), $id.'[hardcoverEdgeColor]', ($as_array==false?7:7), 6, $object->getVar('hardcoverEdgeColor'));
		$ele['hardcoverEdgeColor']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HARDCOVEREDGECOLOUR_DESC:''));
		$ele['highlightHardcover'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HIGHLIGHTHARDCOVER:''), $id.'[highlightHardcover]', $object->getVar('highlightHardcover'));
		$ele['highlightHardcover']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HIGHLIGHTHARDCOVER_DESC:''));
		$ele['frameWidth'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FRAMEWIDTH:''), $id.'[frameWidth]', ($as_array==false?5:5), 5, $object->getVar('frameWidth'));
		$ele['frameWidth']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FRAMEWIDTH_DESC:''));
		$ele['frameColor'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FRAMECOLOUR:''), $id.'[frameColor]', ($as_array==false?7:7), 6, $object->getVar('frameColor'));
		$ele['frameColor']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FRAMECOLOUR_DESC:''));
		$ele['frameAlpha'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FRAMEALPHA:''), $id.'[frameAlpha]', ($as_array==false?5:5), 5, $object->getVar('frameAlpha'));
		$ele['frameAlpha']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FRAMEALPHA_DESC:''));
		$ele['firstPageNumber'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FIRSTPAGENUMBER:''), $id.'[firstPageNumber]', ($as_array==false?5:5), 5, $object->getVar('firstPageNumber'));
		$ele['firstPageNumber']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FIRSTPAGENUMBER_DESC:''));
		$ele['autoFlipSize'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_AUTOFLIPSIZE:''), $id.'[autoFlipSize]', ($as_array==false?5:5), 5, $object->getVar('autoFlipSize'));
		$ele['autoFlipSize']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_AUTOFLIPSIZE_DESC:''));
		$ele['navigationFlipOffset'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_NAVIGATIONFLIPOFFSET:''), $id.'[navigationFlipOffset]', ($as_array==false?5:5), 5, $object->getVar('navigationFlipOffset'));
		$ele['navigationFlipOffset']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_NAVIGATIONFLIPOFFSET_DESC:''));
		$ele['flipOnClick'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPONCLICK:''), $id.'[flipOnClick]', $object->getVar('flipOnClick'));
		$ele['flipOnClick']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPONCLICK_DESC:''));
		$ele['handOverCorner'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HANDOVERCORNER:''), $id.'[handOverCorner]', $object->getVar('handOverCorner'));
		$ele['handOverCorner']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HANDOVERCORNER_DESC:''));
		$ele['handOverPage'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HANDOVERPAGE:''), $id.'[handOverPage]', $object->getVar('handOverPage'));
		$ele['handOverPage']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HANDOVERPAGE_DESC:''));
		$ele['alwaysOpened'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ALWAYSOPENED:''), $id.'[alwaysOpened]', $object->getVar('alwaysOpened'));
		$ele['alwaysOpened']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ALWAYSOPENED_DESC:''));
		$ele['staticShadowsType'] = new PageflipFormSelectShadowsType(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STATICSHADOWTYPE:''), $id.'[staticShadowsType]', $object->getVar('staticShadowsType'));
		$ele['staticShadowsType']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STATICSHADOWTYPE_DESC:''));
		$ele['staticShadowsDepth'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STATICSHADOWDEPTH:''), $id.'[staticShadowsDepth]', ($as_array==false?5:5), 5, $object->getVar('staticShadowsDepth'));
		$ele['staticShadowsDepth']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STATICSHADOWDEPTH_DESC:''));
		$ele['staticShadowsDarkColor'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STATICSHADOWSDARKCOLOUR:''), $id.'[staticShadowsDarkColor]', ($as_array==false?7:7), 6, $object->getVar('staticShadowsDarkColor'));
		$ele['staticShadowsDarkColor']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STATICSHADOWSDARKCOLOUR_DESC:''));
		$ele['staticShadowsLightColor'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STATICSHADOWSLIGHTCOLOUR:''), $id.'[staticShadowsLightColor]', ($as_array==false?7:7), 6, $object->getVar('staticShadowsLightColor'));
		$ele['staticShadowsLightColor']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_STATICSHADOWSLIGHTCOLOUR_DESC:''));
		$ele['dynamicShadowsDepth'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DYNAMICSHADOWDEPTH:''), $id.'[dynamicShadowsDepth]', ($as_array==false?5:5), 5, $object->getVar('dynamicShadowsDepth'));
		$ele['dynamicShadowsDepth']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DYNAMICSHADOWDEPTH_DESC:''));
		$ele['dynamicShadowsDarkColor'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DYNAMICSHADOWDARKCOLOUR:''), $id.'[dynamicShadowsDarkColor]', ($as_array==false?7:7), 6, $object->getVar('dynamicShadowsDarkColor'));
		$ele['dynamicShadowsDarkColor']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DYNAMICSHADOWDARKCOLOUR_DESC:''));
		$ele['dynamicShadowsLightColor'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DYNAMICSHADOWLIGHTCOLOUR:''), $id.'[dynamicShadowsLightColor]', ($as_array==false?7:7), 6, $object->getVar('dynamicShadowsLightColor'));
		$ele['dynamicShadowsLightColor']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DYNAMICSHADOWLIGHTCOLOUR_DESC:''));
		$ele['moveSpeed'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_MOVESPEED:''), $id.'[moveSpeed]', ($as_array==false?5:5), 5, $object->getVar('moveSpeed'));
		$ele['moveSpeed']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_MOVESPEED_DESC:''));
		$ele['gotoSpeed'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_GOTOSPEED:''), $id.'[gotoSpeed]', ($as_array==false?5:5), 5, $object->getVar('gotoSpeed'));
		$ele['gotoSpeed']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_GOTOSPEED_DESC:''));
		$ele['closeSpeed'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_CLOSESPEED:''), $id.'[closeSpeed]', ($as_array==false?5:5), 5, $object->getVar('closeSpeed'));
		$ele['closeSpeed']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_CLOSESPEED_DESC:''));
		$ele['rigidPageSpeed'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_RIGIDPAGESPEED:''), $id.'[rigidPageSpeed]', ($as_array==false?5:5), 5, $object->getVar('rigidPageSpeed'));
		$ele['rigidPageSpeed']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_RIGIDPAGESPEED_DESC:''));
		$ele['flipSound'] = new PageflipFormSelectSounds(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPSOUND:''), $id.'[flipSound]', $object->getVar('flipSound'));
		$ele['flipSound']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPSOUND_DESC:''));
		$ele['hardcoverSound'] = new PageflipFormSelectSounds(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HARDCOVERSOUND:''), $id.'[hardcoverSound]', $object->getVar('hardcoverSound'));
		$ele['hardcoverSound']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_HARDCOVERSOUND_DESC:''));
		$ele['preloaderType'] = new PageflipFormSelectPreloaderType(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PRELOADERTYPE:''), $id.'[preloaderType]', $object->getVar('preloaderType'));
		$ele['preloaderType']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PRELOADERTYPE_DESC:''));
		$ele['pageBackgroundColor'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PAGEBACKGROUNDCOLOUR:''), $id.'[pageBackgroundColor]', ($as_array==false?7:7), 6, $object->getVar('pageBackgroundColor'));
		$ele['pageBackgroundColor']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PAGEBACKGROUNDCOLOUR_DESC:''));
		$ele['loadOnDemand'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_LOADONDEMAND:''), $id.'[loadOnDemand]', $object->getVar('loadOnDemand'));
		$ele['loadOnDemand']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_LOADONDEMAND_DESC:''));
		$ele['allowPagesUnload'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ALLOWPAGESUNLOAD:''), $id.'[allowPagesUnload]', $object->getVar('allowPagesUnload'));
		$ele['allowPagesUnload']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_AlLOWPAGESUNLOAD_DESC:''));
		$ele['showUnderlyingPages'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_SHOWUNDERLYINGPAGES:''), $id.'[showUnderlyingPages]', $object->getVar('showUnderlyingPages'));
		$ele['showUnderlyingPages']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_SHOWUNDERLYINGPAGES_DESC:''));
		$ele['freezeOnFlip'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FREEZEONFLIP:''), $id.'[freezeOnFlip]', $object->getVar('freezeOnFlip'));
		$ele['freezeOnFlip']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FREEZEONFLIP_DESC:''));
		$ele['playOnDemand'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PLAYONDEMAND:''), $id.'[playOnDemand]', $object->getVar('playOnDemand'));
		$ele['playOnDemand']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PLAYONDEMAND_DESC:''));
		$ele['darkPages'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DARKPAGES:''), $id.'[darkPages]', $object->getVar('darkPages'));
		$ele['darkPages']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DARKPAGES_DESC:''));
		$ele['smoothPages'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_SMOOTHPAGES:''), $id.'[smoothPages]', $object->getVar('smoothPages'));
		$ele['smoothPages']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_SMOOTHPAGES_DESC:''));
		$ele['rigidPages'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_RIGIDPAGES:''), $id.'[rigidPages]', $object->getVar('rigidPages'));
		$ele['rigidPages']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_RIGIDPAGES_DESC:''));
		$ele['flipCornerStyle'] = new PageflipFormSelectCornerStyle(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERSTYLE:''), $id.'[flipCornerStyle]', $object->getVar('flipCornerStyle'));
		$ele['flipCornerStyle']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERSTYLE_DESC:''));
		$ele['flipCornerPosition'] = new PageflipFormSelectCornerPosition(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERPOSITION:''), $id.'[flipCornerPosition]', $object->getVar('flipCornerPosition'));
		$ele['flipCornerPosition']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERPOSITION_DESC:''));
		$ele['flipCornerAmount'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERAMOUNT:''), $id.'[flipCornerAmount]', ($as_array==false?5:5), 5, $object->getVar('flipCornerAmount'));
		$ele['flipCornerAmount']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERAMOUNT_DESC:''));
		$ele['flipCornerAngle'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERANGLE:''), $id.'[flipCornerAngle]', ($as_array==false?5:5), 5, $object->getVar('flipCornerAngle'));
		$ele['flipCornerAngle']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERANGLE_DESC:''));
		$ele['flipCornerRelease'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERRELEASE:''), $id.'[flipCornerRelease]', $object->getVar('flipCornerRelease'));
		$ele['flipCornerRelease']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERRELEASE_DESC:''));
		$ele['flipCornerVibrate'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERVIBRATE:''), $id.'[flipCornerVibrate]', $object->getVar('flipCornerVibrate'));
		$ele['flipCornerVibrate']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERVIBRATE_DESC:''));
		$ele['flipCornerPlaySound'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERPLAYSOUND:''), $id.'[flipCornerPlaySound]', $object->getVar('flipCornerPlaySound'));
		$ele['flipCornerPlaySound']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_FLIPCORNERPLAYSOUND_DESC:''));
		$ele['zoomEnabled'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMENABLED:''), $id.'[zoomEnabled]', $object->getVar('zoomEnabled'));
		$ele['zoomEnabled']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMENABLED_DESC:''));
		$ele['zoomImageWidth'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMIMAGEWIDTH:''), $id.'[zoomImageWidth]', ($as_array==false?5:5), 5, $object->getVar('zoomImageWidth'));
		$ele['zoomImageWidth']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMIMAGEWIDTH_DESC:''));
		$ele['zoomImageHeight'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMIMAGEHEIGHT:''), $id.'[zoomImageHeight]', ($as_array==false?5:5), 5, $object->getVar('zoomImageHeight'));
		$ele['zoomImageHeight']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMIMAGEHEIGHT_DESC:''));
		$ele['zoomOnClick'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMONCLICK:''), $id.'[zoomOnClick]', $object->getVar('zoomOnClick'));
		$ele['zoomOnClick']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMONCLICK_DESC:''));
		$ele['zoomUIColor'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMUICOLOUR:''), $id.'[zoomUIColor]', ($as_array==false?7:7), 6, $object->getVar('zoomUIColor'));
		$ele['zoomUIColor']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMUICOLOUR_DESC:''));
		$ele['zoomHint'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMHINT:''), $id.'[zoomHint]', ($as_array==false?35:35), 255, $object->getVar('zoomHint'));
		$ele['zoomHint']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMHINT_DESC:''));
		$ele['zoomHintEnabled'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMHINTENABLED:''), $id.'[zoomHintEnabled]', $object->getVar('zoomHintEnabled'));
		$ele['zoomHintEnabled']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ZOOMHINTENABLED_DESC:''));
		$ele['centerBook'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_CENTERBOOK:''), $id.'[centerBook]', $object->getVar('centerBook'));
		$ele['centerBook']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_CENTERBOOK_DESC:''));
		$ele['useCustomCursors'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_USECUSTOMCURSORS:''), $id.'[useCustomCursors]', $object->getVar('useCustomCursors'));
		$ele['useCustomCursors']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_USECUSTOMCURSORS_DESC:''));
		$ele['dropShadowsEnabled'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DROPSHADOWENABLED:''), $id.'[dropShadowsEnabled]', $object->getVar('dropShadowsEnabled'));
		$ele['dropShadowsEnabled']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DROPSHADOWENABLED_DESC:''));
		$ele['dropShadowsHideWhenFlipping'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DROPSHADOWHIDEWHENFLIPPING:''), $id.'[dropShadowsHideWhenFlipping]', $object->getVar('dropShadowsHideWhenFlipping'));
		$ele['dropShadowsHideWhenFlipping']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DROPSHADOWHIDEWHENFLIPPING_DESC:''));
		$ele['backgroundColor'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BACKGROUNDCOLOUR:''), $id.'[backgroundColor]', ($as_array==false?7:7), 6, $object->getVar('backgroundColor'));	
		$ele['backgroundColor']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BACKGROUNDCOLOUR_DESC:''));
		if (strlen($object->getVar('backgroundImage'))>0) {
			$ele['backgroundImageDisplay'] = new XoopsFormElementTray(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BACKGROUNDIMAGEDISPLAY:''), '<br/>');
			$ele['backgroundImageDisplay']->addElement(new XoopsFormLabel('', '<img src="'.XOOPS_URL.'/modules/pageflip/thumbnail.php?bid='.$object->getVar('bid').'&op=background"/>'));
			$ele['backgroundImageDisplay']->addElement(new XoopsFormRadioYN(_FRM_PAGEFLIP_FORM_BOOKS_BACKGROUNDIMAGEDELETE, $id.'[backgroundImageDelete]', false));
			$ele['backgroundImageDisplay']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BACKGROUNDIMAGEDISPLAY_DESC:''));			
		}
		$ele['backgroundImage'] = new XoopsFormFile(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BACKGROUNDIMAGE:''), $id.'_backgroundImage');
		$ele['backgroundImage']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BACKGROUNDIMAGE_DESC:''));
		$ele['backgroundImagePlacement'] = new PageflipFormSelectImagePlacement(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BACKGROUNDIMAGEPLACEMENT:''), $id.'[backgroundImagePlacement]', $object->getVar('backgroundImagePlacement'));
		$ele['backgroundImagePlacement']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_BACKGROUNDIMAGEPLACEMENT_DESC:''));
		$ele['printEnabled'] = new PageflipFormSelectTF(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PRINTENABLED:''), $id.'[printEnabled]', $object->getVar('printEnabled'));
		$ele['printEnabled']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PRINTENABLED_DESC:''));
		$ele['printTitle'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PRINTTITLE:''), $id.'[printTitle]', ($as_array==false?35:35), 255, $object->getVar('printTitle'));	
		$ele['printTitle']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PRINTTITLE_DESC:''));
		$ele['downloadURL'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DOWNLOADURL:''), $id.'[downloadURL]', ($as_array==false?35:35), 500, $object->getVar('downloadURL'));	
		$ele['downloadURL']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DOWNLOADURL_DESC:''));
		$ele['downloadTitle'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DOWNLOADTITLE:''), $id.'[downloadTitle]', ($as_array==false?25:25), 128, $object->getVar('downloadTitle'));	
		$ele['downloadTitle']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DOWNLOADTITLE_DESC:''));
		$ele['downloadSize'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DOWNLOADSIZE:''), $id.'[downloadSize]', ($as_array==false?25:25), 128, $object->getVar('downloadSize'));	
		$ele['downloadSize']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DOWNLOADSIZE_DESC:''));
		$ele['downloadComplete'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DOWNLOADCOMPLETE:''), $id.'[downloadComplete]', ($as_array==false?35:35), 255, $object->getVar('downloadComplete'));	
		$ele['downloadComplete']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_DOWNLOADCOMPLETE_DESC:''));

		if ($object->getVar('pages')>0) {
			$ele['pages'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_PAGES:''), $object->getVar('pages'));
		}
		
		if ($object->getVar('chapters')>0) {
			$ele['chapters'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_CHAPTERS:''), $object->getVar('chapters'));
		}
		
		if ($object->getVar('created')>0) {
			$ele['created'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_CREATED:''), date(_DATESTRING, $object->getVar('created')));
		}
		
		if ($object->getVar('updated')>0) {
			$ele['updated'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_UPDATED:''), date(_DATESTRING, $object->getVar('updated')));
		}
		
		if ($object->getVar('actioned')>0) {
			$ele['actioned'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_BOOKS_ACTIONED:''), date(_DATESTRING, $object->getVar('actioned')));
		}	
		
		if ($as_array==true)
			return $ele;
		
		$ele['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		$required = array('name');
		
		foreach($ele as $id => $obj)			
			if (in_array($id, $required))
				$sform->addElement($ele[$id], true);			
			else
				$sform->addElement($ele[$id], false);
		
		return $sform->render();
		
	}

	
	function pageflip_pages_get_form($object, $as_array=false) {
		
		if (!is_object($object)) {
			$handler = xoops_getmodulehandler('pages', 'pageflip');
			$object = $handler->create(); 
		}
		
		xoops_loadLanguage('forms', 'pageflip');
		$ele = array();
		
		if ($object->isNew()) {
			$sform = new XoopsThemeForm(_FRM_PAGEFLIP_FORM_ISNEW_PAGES, 'pages', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'new');
		} else {
			$sform = new XoopsThemeForm(_FRM_PAGEFLIP_FORM_EDIT_PAGES, 'pages', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'edit');
		}
		
		$components = pageflip_getFilterURLComponents(isset($_REQUEST['filter'])?$_REQUEST['filter']:'1,1', '', 'created');
		
		$sform->setExtra( "enctype='multipart/form-data'" ) ;
		
		$id = $object->getVar('pid');
		if (empty($id)) $id = '0';
		
		$ele['op'] = new XoopsFormHidden('op', 'pages');
		$ele['fct'] = new XoopsFormHidden('fct', 'save');
		if ($as_array==false)
			$ele['id'] = new XoopsFormHidden('id', $id);
		else 
			$ele['id'] = new XoopsFormHidden('id['.$id.']', $id);
		$ele['sort'] = new XoopsFormHidden('sort', isset($_REQUEST['sort'])?$_REQUEST['sort']:'created');
		$ele['order'] = new XoopsFormHidden('order', isset($_REQUEST['order'])?$_REQUEST['order']:'DESC');
		$ele['start'] = new XoopsFormHidden('start', isset($_REQUEST['start'])?intval($_REQUEST['start']):0);
		$ele['limit'] = new XoopsFormHidden('limit', isset($_REQUEST['limit'])?intval($_REQUEST['limit']):30);
		$ele['filter'] = new XoopsFormHidden('filter', isset($_REQUEST['filter'])?$_REQUEST['filter']:'1,1');

		if ($object->isNew()) {
			$ele['file'] = new XoopsFormFile(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_FILE:''), 'imagefile', $GLOBALS['xoopsModuleConfig']['maximum_filesize']);
			$ele['file']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_FILE_DESC:''));
			$required = array('bid', 'cid', 'page', 'file');
		} else {
			$ele['thumbnail'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_THUMBNAIL:''), '<img src="'.XOOPS_URL.'/modules/pageflip/thumbnail.php?pid='.$object->getVar('pid').'" />');
			$ele['thumbnail']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_THUMBNAIL_DESC:''));
			$ele['file'] = new XoopsFormFile(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_REPLACEFILE:''), 'imagefile', $GLOBALS['xoopsModuleConfig']['maximum_filesize']);
			$ele['file']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_REPLACEFILE_DESC:''));
			$required = array('bid', 'cid', 'page');
		}
		$ele['bid'] = new PageflipFormSelectBooks(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_BOOKS:''), $id.'[bid]', $object->getVar('bid'), 1, false, true);
		$ele['bid']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_BOOKS_DESC:''));
		$ele['bid']->setExtra('onchange="window.open(\''.$_SERVER['PHP_SELF'].'?'.$components['extra'].'&bid=\'+this.options[this.selectedIndex].value'.',\'_self\')"');
		$ele['cid'] = new PageflipFormSelectChapters(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_CHAPTER:''), $id.'[cid]', $object->getVar('cid'));
		$ele['cid']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_CHAPTER_DESC:''));
		$ele['page'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_PAGE:''), $id.'[page]', 5, 7, $object->getVar('page'));
		$ele['page']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_PAGE_DESC:''));		
		$ele['newChapter'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_NEWCHAPTER:''), $id.'[newChapter]', ($as_array==false?35:35), 128, '');
		$ele['newChapter']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_NEWCHAPTER_DESC:''));	
		$ele['scaleContent'] = new PageflipFormSelectTFD(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_SCALECONTENT:''), $id.'[scaleContent]', $object->getVar('scaleContent'));
		$ele['scaleContent']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_SCALECONTENT_DESC:''));
		$ele['showStaticShadows'] = new PageflipFormSelectTFD(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_SHOWSTATICSHADOW:''), $id.'[showStaticShadows]', $object->getVar('showStaticShadows'));
		$ele['showStaticShadows']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_SHOWSTATICSHADOW_DESC:''));
		$ele['rigid'] = new PageflipFormSelectTFD(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_RIGID:''), $id.'[rigid]', $object->getVar('rigid'));
		$ele['rigid']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_RIGID_DESC:''));
		$ele['wide'] = new PageflipFormSelectTFD(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_WIDE:''), $id.'[wide]', $object->getVar('wide'));
		$ele['wide']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_WIDE_DESC:''));
		$ele['playOnDemand'] = new PageflipFormSelectTFD(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_PLAYONDEMAND:''), $id.'[playOnDemand]', $object->getVar('playOnDemand'));
		$ele['playOnDemand']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_PLAYONDEMAND_DESC:''));
		$ele['centerContent'] = new PageflipFormSelectTFD(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_CENTERCONTENT:''), $id.'[centerContent]', $object->getVar('centerContent'));
		$ele['centerContent']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_CENTERCONTENT_DESC:''));
		$ele['w'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_W:''), $id.'[w]', ($as_array==false?5:5), 6, $object->getVar('w'));
		$ele['w']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_W_DESC:''));	
		$ele['h'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_H:''), $id.'[h]', ($as_array==false?5:5), 6, $object->getVar('h'));
		$ele['h']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_H_DESC:''));	
		$ele['freezeOnFlip'] = new PageflipFormSelectTFD(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_FREEZEONFLIP:''), $id.'[freezeOnFlip]', $object->getVar('freezeOnFlip'));
		$ele['freezeOnFlip']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_FREEZEONFLIP_DESC:''));
		$ele['smooth'] = new PageflipFormSelectTFD(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_SMOOTH:''), $id.'[smooth]', $object->getVar('smooth'));
		$ele['smooth']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_SMOOTH_DESC:''));
		$ele['dark'] = new PageflipFormSelectTFD(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_DARK:''), $id.'[dark]', $object->getVar('dark'));
		$ele['dark']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_DARK_DESC:''));
		
		if ($object->getVar('created')>0) {
			$ele['created'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_CREATED:''), date(_DATESTRING, $object->getVar('created')));
		}
		
		if ($object->getVar('updated')>0) {
			$ele['updated'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_UPDATED:''), date(_DATESTRING, $object->getVar('updated')));
		}

		if ($object->getVar('actioned')>0) {
			$ele['actioned'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_PAGES_ACTIONED:''), date(_DATESTRING, $object->getVar('actioned')));
		}
		
		if ($as_array==true)
			return $ele;
		
		$ele['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		foreach($ele as $id => $obj)			
			if (in_array($id, $required))
				$sform->addElement($ele[$id], true);			
			else
				$sform->addElement($ele[$id], false);
		
		return $sform->render();
		
	}
	
	function pageflip_chapters_get_form($object, $as_array=false) {
		
		if (!is_object($object)) {
			$handler = xoops_getmodulehandler('chapters', 'pageflip');
			$object = $handler->create(); 
		}
		
		xoops_loadLanguage('forms', 'pageflip');
		$ele = array();	
		
		if ($object->isNew()) {
			$sform = new XoopsThemeForm(_FRM_PAGEFLIP_FORM_ISNEW_CHAPTERS, 'chapters', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'new');
		} else {
			$sform = new XoopsThemeForm(_FRM_PAGEFLIP_FORM_EDIT_CHAPTERS, 'chapters', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'edit');
		}
		
		$sform->setExtra( "enctype='multipart/form-data'" ) ;
		
		$id = $object->getVar('cid');
		if (empty($id)) $id = '0';
		
		$ele['op'] = new XoopsFormHidden('op', 'chapters');
		$ele['fct'] = new XoopsFormHidden('fct', 'save');
		if ($as_array==false)
			$ele['id'] = new XoopsFormHidden('id', $id);
		else 
			$ele['id'] = new XoopsFormHidden('id['.$id.']', $id);
		$ele['sort'] = new XoopsFormHidden('sort', isset($_REQUEST['sort'])?$_REQUEST['sort']:'created');
		$ele['order'] = new XoopsFormHidden('order', isset($_REQUEST['order'])?$_REQUEST['order']:'DESC');
		$ele['start'] = new XoopsFormHidden('start', isset($_REQUEST['start'])?intval($_REQUEST['start']):0);
		$ele['limit'] = new XoopsFormHidden('limit', isset($_REQUEST['limit'])?intval($_REQUEST['limit']):30);
		$ele['filter'] = new XoopsFormHidden('filter', isset($_REQUEST['filter'])?$_REQUEST['filter']:'1,1');
					
		$ele['bid'] = new PageflipFormSelectBooks(($as_array==false?_FRM_PAGEFLIP_FORM_CHAPTERS_BOOKS:''), $id.'[bid]', $object->getVar('bid'));
		$ele['bid']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_CHAPTERS_BOOKS_DESC:''));
		$ele['page'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_CHAPTERS_PAGE:''), $id.'[page]', ($as_array==false?5:5), 6, $object->getVar('page'));
		$ele['page']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_CHAPTERS_PAGE_DESC:''));	
		$ele['name'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_CHAPTERS_NAME:''), $id.'[name]', ($as_array==false?35:21), 128, $object->getVar('name'));
		$ele['name']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_CHAPTERS_NAME_DESC:''));	

		if ($object->getVar('created')>0) {
			$ele['created'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_CHAPTERS_CREATED:''), date(_DATESTRING, $object->getVar('created')));
		}
		
		if ($object->getVar('updated')>0) {
			$ele['updated'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_CHAPTERS_UPDATED:''), date(_DATESTRING, $object->getVar('updated')));
		}
			
		if ($as_array==true)
			return $ele;
		
		$ele['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		$required = array('bid', 'page', 'name');
		
		foreach($ele as $id => $obj)			
			if (in_array($id, $required))
				$sform->addElement($ele[$id], true);			
			else
				$sform->addElement($ele[$id], false);
		
		return $sform->render();
		
	}
	
	function pageflip_css_get_form($object, $as_array=false) {
		
		if (!is_object($object)) {
			$handler = xoops_getmodulehandler('css', 'pageflip');
			$object = $handler->create(); 
		}
		
		xoops_loadLanguage('forms', 'pageflip');
		$ele = array();	
		
		if ($object->isNew()) {
			$sform = new XoopsThemeForm(_FRM_PAGEFLIP_FORM_ISNEW_CSS, 'css', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'new');
		} else {
			$sform = new XoopsThemeForm(_FRM_PAGEFLIP_FORM_EDIT_CSS, 'css', $_SERVER['PHP_SELF'], 'post');
			$ele['mode'] = new XoopsFormHidden('mode', 'edit');
		}
		
		$sform->setExtra( "enctype='multipart/form-data'" ) ;
		
		$id = $object->getVar('cssid');
		if (empty($id)) $id = '0';
		
		$ele['op'] = new XoopsFormHidden('op', 'css');
		$ele['fct'] = new XoopsFormHidden('fct', 'save');
		if ($as_array==false)
			$ele['id'] = new XoopsFormHidden('id', $id);
		else 
			$ele['id'] = new XoopsFormHidden('id['.$id.']', $id);
		$ele['sort'] = new XoopsFormHidden('sort', isset($_REQUEST['sort'])?$_REQUEST['sort']:'created');
		$ele['order'] = new XoopsFormHidden('order', isset($_REQUEST['order'])?$_REQUEST['order']:'DESC');
		$ele['start'] = new XoopsFormHidden('start', isset($_REQUEST['start'])?intval($_REQUEST['start']):0);
		$ele['limit'] = new XoopsFormHidden('limit', isset($_REQUEST['limit'])?intval($_REQUEST['limit']):30);
		$ele['filter'] = new XoopsFormHidden('filter', isset($_REQUEST['filter'])?$_REQUEST['filter']:'1,1');
					
		$ele['bid'] = new PageflipFormSelectBooks(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_BOOKS:''), $id.'[bid]', $object->getVar('bid'));
		$ele['bid']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_BOOKS_DESC:''));
		$ele['mode'] = new PageflipFormSelectCSSMode(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_MODE:''), $id.'[mode]', $object->getVar('mode'));
		$ele['mode']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_MODE_DESC:''));
		$ele['reference'] = new XoopsFormText(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_REFERENCE:''), $id.'[reference]', ($as_array==false?35:21), 64, $object->getVar('reference'));
		$ele['reference']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_REFERENCE_DESC:''));	
		$ele['css'] = new XoopsFormTextArea(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_CSS:''), $id.'[css]', $object->getVar('css'));
		$ele['css']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_CSS_DESC:''));	
		$ele['hover'] = new XoopsFormTextArea(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_HOVER:''), $id.'[hover]', $object->getVar('hover'));
		$ele['hover']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_HOVER_DESC:''));	
		$ele['visited'] = new XoopsFormTextArea(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_VISITED:''), $id.'[visited]', $object->getVar('visited'));
		$ele['visited']->setDescription(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_VISITED_DESC:''));	
		
		if ($object->getVar('created')>0) {
			$ele['created'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_CREATED:''), date(_DATESTRING, $object->getVar('created')));
		}
		
		if ($object->getVar('updated')>0) {
			$ele['updated'] = new XoopsFormLabel(($as_array==false?_FRM_PAGEFLIP_FORM_CSS_UPDATED:''), date(_DATESTRING, $object->getVar('updated')));
		}
	
		if ($as_array==true)
			return $ele;
		
		$ele['submit'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		
		$required = array('bid', 'page', 'name');
		
		foreach($ele as $id => $obj)			
			if (in_array($id, $required))
				$sform->addElement($ele[$id], true);			
			else
				$sform->addElement($ele[$id], false);
		
		return $sform->render();
		
	}
?>