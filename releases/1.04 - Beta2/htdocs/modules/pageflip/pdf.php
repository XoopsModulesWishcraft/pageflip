<?php

// $Id: makepdf.php,v 4.04 2008/06/05 15:58:07 wishcraft Exp $


error_reporting(0);
include 'header.php';
$GLOBALS['xoopsLogger']->activated = false;

require_once($GLOBAL['xoops']->path(_MI_PAGEFLIP_FRAMEWORK_TCPF));
$filename = XOOPS_ROOT_PATH.'/Frameworks/tcpdf/config/lang/'._LANGCODE.'.php';
if(file_exists($filename)) {
	include_once $filename;
} else {
	include_once XOOPS_ROOT_PATH.'/Frameworks/tcpdf/config/lang/en.php';
}
error_reporting(0);

if(empty($_POST["pdf_data"])) {
	
	$bid = isset($_GET['bid']) ? intval($_GET['bid']) : 0;

	if ( empty($bid_id) )  die(_MN_ERROR_NOBOOK);

	$post_handler =& xoops_getmodulehandler('books', 'pageflip');
	$user_handler =& xoops_gethandler('user');
	$book = & $post_handler->get($bid);
	$user = $user_handler->get($book->getVar('uid'));
	
	$pdf_data['title'] = $book->getVar("name");
	$pdf_data['subject'] = $book->getVar('description');
	$pdf_data['date'] = date(_DATESTRING, ($book->getVar('updated')>0?$book->getVar('updated'):$book->getVar('created')));
	$pdf_data['author'] = strlen($user->getVar('name'))>0?$user->getVar('name'). ' ('.$user->getVar('uname').')':$user->getVar('uname');
	$pdf_data['url'] = $book->getURL();

	require_once($GLOBALS['xoops']->path('class/template.php'));
	$GLOBAL['xoopsTpl'] = new xoopsTpl();
	$GLOBAL['xoopsTpl']->assign('pages', $books->getPDFPages());
	$GLOBAL['xoopsTpl']->assign('book', $book->toArray());
	ob_start();
	$GLOBAL['xoopsTpl']->display('db:pageflip_pdf.html');
	$pdf_data['content'] = ob_get_content();
	ob_end_clean();

}else{
	$pdf_data = unserialize(base64_decode($_POST["pdf_data"]));
}

$pdf_data['filename'] = preg_replace("/[^0-9a-zA-Z\-_\.]/i",'', $pdf_data["title"]);
$pdf_data['title'] = _MN_PAGEFLIP_PDF_SUBJECT.': '.$pdf_data["title"];
$pdf_data['author'] = _MN_PAGEFLIP_PDF_AUTHOR.': '.$pdf_data['author'];
$pdf_data['date'] = _MN_PAGEFLIP_PDF_DATE. ': '.date(_DATESTRING, $pdf_data['date']);
$pdf_data['url'] = _MN_PAGEFLIP_PDF_URL. ': '.$pdf_data['url'];

//Other stuff
$puff='<br />';
$puffer='<br />';

//create the A4-PDF...
$pdf=new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, _CHARSET, false);
if(method_exists($pdf, "encoding")){
	$pdf->encoding($pdf_data, _CHARSET);
	$pdf->encoding($pdf_config, _CHARSET);
}
$pdf->SetCreator($pdf_config['creator']);
$pdf->SetTitle($pdf_data['title']);
$pdf->SetAuthor($pdf_config['author']);
$pdf->SetSubject($pdf_data['subject']);
$out=str_replace(' ', ', ',$pdf_config['url'].' '.$pdf_data['author'].' '.$pdf_data['title'].' '.$pdf_data['subject']);
$pdf->SetKeywords($out);
$pdf->SetAutoPageBreak(true,25);
$pdf->SetMargins($pdf_config['margin']['left'],$pdf_config['margin']['top'],$pdf_config['margin']['right']);
$pdf->Open();

//First page
$pdf->AddPage();
$pdf->SetXY(24,25);
$pdf->SetTextColor(10,60,160);
$pdf->SetFont($pdf_config['font']['slogan']['family'],$pdf_config['font']['slogan']['style'],$pdf_config['font']['slogan']['size']);
$pdf->WriteHTML($pdf_config['slogan'], $pdf_config['scale']);
$pdf->Image(XOOPS_ROOT_PATH.DS.'images'.DS.'logo.png',$pdf_config['logo']['left'],$pdf_config['logo']['top'],$pdf_config['logo']['width'],$pdf_config['logo']['height'],'',$pdf_config['url']);
$pdf->Line(25,30,190,30);
$pdf->SetXY(25,35);
$pdf->SetFont($pdf_config['font']['title']['family'],$pdf_config['font']['title']['style'],$pdf_config['font']['title']['size']);
$pdf->WriteHTML($pdf_data['title'],$pdf_config['scale']);

if (!empty($pdf_data['subject'])){
	$pdf->WriteHTML($puff,$pdf_config['scale']);
	$pdf->SetFont($pdf_config['font']['subject']['family'],$pdf_config['font']['subject']['style'],$pdf_config['font']['subject']['size']);
	$pdf->WriteHTML($pdf_data['subject'],$pdf_config['scale']);
}
if (!empty($pdf_data["subsubtitle"])) {
	$pdf->WriteHTML($puff,$pdf_config["scale"]);
	$pdf->SetFont($pdf_config["font"]["subsubtitle"]["family"],$pdf_config["font"]["subsubtitle"]["style"],$pdf_config["font"]["subsubtitle"]["size"]);
	$pdf->WriteHTML($pdf_data["subsubtitle"],$pdf_config["scale"]);
}

$pdf->WriteHTML($puff,$pdf_config['scale']);
$pdf->SetFont($pdf_config['font']['author']['family'],$pdf_config['font']['author']['style'],$pdf_config['font']['author']['size']);
$pdf->WriteHTML($pdf_data['author'],$pdf_config['scale']);
$pdf->WriteHTML($puff,$pdf_config['scale']);
$pdf->WriteHTML($pdf_data['date'],$pdf_config['scale']);
$pdf->WriteHTML($puff,$pdf_config['scale']);
$pdf->WriteHTML($pdf_data['url'],$pdf_config['scale']);
$pdf->WriteHTML($puff,$pdf_config['scale']);

$pdf->SetTextColor(0,0,0);
$pdf->WriteHTML($puffer,$pdf_config['scale']);

$pdf->SetFont($pdf_config['font']['content']['family'],$pdf_config['font']['content']['style'],$pdf_config['font']['content']['size']);
$pdf->WriteHTML($pdf_data['content'],$pdf_config['scale']);

$pdf->Output();
?>