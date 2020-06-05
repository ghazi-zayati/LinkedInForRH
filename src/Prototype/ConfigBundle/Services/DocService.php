<?php

namespace Prototype\ConfigBundle\Services;

use Doctrine\ORM\EntityManager;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\Container;
use Prototype\ConfigBundle\Entity\AppUser;
use Symfony\Bundle\FrameworkBundle\Controller;
use \DateTime;

class DocService extends \PhpOffice\PhpWord\PhpWord
{
    private $em = null;
    private $tmp;
    private $container;

    public function __construct(EntityManager $em, $templating, $tmp,Container $container)
    { //Son constructeur avec l'entity manager en paramètre
        $this->em = $em;
        $this->tmp = $tmp;
        $this->templating = $templating;
        $this->container = $container;
    }

    public function returnPDFResponseFromHTMLvig($dir,$lang,$user){

		$html = $this->templating->render('Users/list.html.twig', ["user"=>$user,"lang"=>$lang]);
	    $pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT,PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setFontSubsetting(true);
        $lg = Array();
        $lg['a_meta_charset'] = 'UTF-8';
        if($lang=="fr" || $lang=="en" )
            $lg['a_meta_dir'] = 'ltr';
        else
            $lg['a_meta_dir'] = 'rtl';

        $lg['a_meta_language'] = 'fa';
        $lg['w_page'] = 'page';
		$pdf->setLanguageArray($lg);
        // Font Arabe
        $pdf->SetFont('dejavusans', '', 12);

        $pdf->AddPage('R', 'A4');
        $date = new DateTime();
        $fileurl="/uploads/".$date->getTimestamp()."_". $lang.".pdf";
        $filename=$dir."/uploads/".$date->getTimestamp()."_". $lang.".pdf";
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 4, $fill = 0,  $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename,'F'); // Force Générate PDF
        $servername = $_SERVER['HTTP_HOST'];

        return $servername.$fileurl;
    }



}