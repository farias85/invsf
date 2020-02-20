<?php

namespace INV\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use INV\CommonBundle\Entity\ActivoFijo;
use INV\CommonBundle\Util\Entity;
use Symfony\Component\VarDumper\VarDumper;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('FrontendBundle:Default:index.html.twig');
    }

    public function pdfAction() {
// You can send the html as you want
        //$html = '<h1>Plain HTML</h1>';

        // but in this case we will render a symfony view !
        // We are in a controller and we can use renderView function which retrieves the html from a view
        // then we send that html to the user.
        $html = $this->renderView('@Frontend/Default/index.html.twig', array('someDataToView' => 'Something'));

        $this->returnPDFResponseFromHTML($html);
    }

    public function returnPDFResponseFromHTML($html) {
        //set_time_limit(30); uncomment this line according to your needs
        // If you are not in a controller, retrieve of some way the service container and then retrieve it
        //$pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //if you are in a controlller use :

        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('Our Code World');
        $pdf->SetTitle(('Our Code World Title'));
        $pdf->SetSubject('Our Code World Subject');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();

        $filename = 'ourcodeworld_pdf_demo2';

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        $location = __DIR__ . '/../../../../web/downloads/';
//        VarDumper::dump($location);
//        die();

        //dest = I -> Send PDF to the standard output
        //dest = D -> download PDF as file
        //dest = F, FI, FD -> save PDF to a local file
        //dest = E -> return PDF as base64 mime multi-part email attachment (RFC 2045)
        //dest = S -> returns PDF as a string
        $pdf->Output("{$location}/{$filename}.pdf", 'F'); // This will output the PDF as a response directly
    }

    public function excelAction() {
        // ask the service for a excel object
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("liuggio")
            ->setLastModifiedBy("Giulio De Donato")
            ->setTitle("Office 2005 XLSX Test Document")
            ->setSubject("Office 2005 XLSX Test Document")
            ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
            ->setKeywords("office 2005 openxml php")
            ->setCategory("Test result file");
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!');
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'PhpExcelFileSample.xlsx'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    public function excel2Action() {
        // ask the service for a excel object
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("liuggio")
            ->setLastModifiedBy("Giulio De Donato")
            ->setTitle("Office 2005 XLSX Test Document")
            ->setSubject("Office 2005 XLSX Test Document")
            ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
            ->setKeywords("office 2005 openxml php")
            ->setCategory("Test result file");
        $phpExcelObject->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!');
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // The save method is documented in the official PHPExcel library
        $writer->save('downloads/filename.xlsx');

        // Return a Symfony response (a view or something or this will thrown error !!!)
//        return "A symfony response";
        return $this->render('FrontendBundle:Default:index.html.twig');
    }

    public function excelTodosAction() {

        $em = $this->getDoctrine()->getManager();
        $activoFijos = $em->getRepository(Entity::ACTIVO_FIJO)->findByRevisionTodos();

        //return $this->render('FrontendBundle:Default:show.html.twig', array(
        //'activoFijos' => $activoFijos,));
        $titulo = "Título por defecto";
        $titulos = $this->cabeceraExcelAction();
        // ask the service for a Excel5
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
        $phpExcelObject->getProperties()->setCreator($titulo)
            ->setLastModifiedBy($titulo)
            ->setTitle($titulo)
            ->setSubject($titulo)
            ->setDescription($titulo)
            ->setKeywords($titulo)
            ->setCategory($titulo);
        $phpExcelObject->getActiveSheet()
            ->fromArray(
                $titulos, // The data to set
                NULL, // Array values with this value will not be set
                'A1' // Top left coordinate of the worksheet range where
            //    we want to set these values (default is A1)
            );
        $i = 2;
        $no = (int)1;
        foreach ($activoFijos as $entidad) {
            $array = $entidad->toArray();
            $array[0] = $no;
            $celda = "A" . $i++;
            $phpExcelObject->getActiveSheet()
                ->fromArray(
                    $array, // The data to set
                    NULL, // Array values with this value will not be set
                    $celda // Top left coordinate of the worksheet range where

                );
            $no++;
        }
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            '2094034-AFT.xlsx'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    /**
     * AT1 es un modelo de control de existencia de equipos
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function excelAT1Action() {

        $em = $this->getDoctrine()->getManager();
        $activoFijos = $em->getRepository(Entity::ACTIVO_FIJO)->findByRevisionActivaOK();

        //return $this->render('FrontendBundle:Default:show.html.twig', array(
        //'activoFijos' => $activoFijos,));
        $titulo = "Título por defecto";
        $titulos = $this->cabeceraExcelAction();
        // ask the service for a Excel5
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
        $phpExcelObject->getProperties()->setCreator($titulo)
            ->setLastModifiedBy($titulo)
            ->setTitle($titulo)
            ->setSubject($titulo)
            ->setDescription($titulo)
            ->setKeywords($titulo)
            ->setCategory($titulo);
        $phpExcelObject->getActiveSheet()
            ->fromArray(
                $titulos, // The data to set
                NULL, // Array values with this value will not be set
                'A1' // Top left coordinate of the worksheet range where
            //    we want to set these values (default is A1)
            );
        $i = 2;
        $no = (int)1;
        foreach ($activoFijos as $entidad) {
            $array = $entidad->toArray();
            $array[0] = $no;
            $celda = "A" . $i++;
            $phpExcelObject->getActiveSheet()
                ->fromArray(
                    $array, // The data to set
                    NULL, // Array values with this value will not be set
                    $celda // Top left coordinate of the worksheet range where

                );
            $no++;
        }
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            '2094034-AT1.xlsx'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    public function excelEquiposRotosAction() {

        $em = $this->getDoctrine()->getManager();
        $activoFijos = $em->getRepository(Entity::ACTIVO_FIJO)->findByRevisionActivaRotos();

        //return $this->render('FrontendBundle:Default:show.html.twig', array(
        //'activoFijos' => $activoFijos,));
        $titulo = "Título por defecto";
        $titulos = $this->cabeceraExcelAction();
        // ask the service for a Excel5
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
        $phpExcelObject->getProperties()->setCreator($titulo)
            ->setLastModifiedBy($titulo)
            ->setTitle($titulo)
            ->setSubject($titulo)
            ->setDescription($titulo)
            ->setKeywords($titulo)
            ->setCategory($titulo);
        $phpExcelObject->getActiveSheet()
            ->fromArray(
                $titulos, // The data to set
                NULL, // Array values with this value will not be set
                'A1' // Top left coordinate of the worksheet range where
            //    we want to set these values (default is A1)
            );
        $i = 2;
        $no = (int)1;
        foreach ($activoFijos as $entidad) {
            $array = $entidad->toArray();
            $array[0] = $no;
            $celda = "A" . $i++;
            $phpExcelObject->getActiveSheet()
                ->fromArray(
                    $array, // The data to set
                    NULL, // Array values with this value will not be set
                    $celda // Top left coordinate of the worksheet range where

                );
            $no++;
        }
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            '2094034-Equipos Rotos.xlsx'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    public function angularAction() {
        return $this->render('FrontendBundle:Default:index2.html.twig');
    }

    public function cabeceraExcelAction() {
        $arrayCabecera = array();
        $arrayCabecera[] = "No.";
        $arrayCabecera[] = "Equipo";
        $arrayCabecera[] = "No de Inventario";
        $arrayCabecera[] = "No de Serie";
        $arrayCabecera[] = "Modelo";
        $arrayCabecera[] = "Fecha de Fabricación";
        $arrayCabecera[] = "País de Procedencia";
        $arrayCabecera[] = "Valor inicial CUC";
        $arrayCabecera[] = "Valor inicial MN";
        $arrayCabecera[] = "Función";
        $arrayCabecera[] = "Fecha de explotación";
        $arrayCabecera[] = "Código";
        $arrayCabecera[] = "Tipo";

        return $arrayCabecera;
    }

    public function cabeceraExcel2Action() {
        $arrayCabecera = array();
        $arrayCabecera[] = "No.";
        $arrayCabecera[] = "Equipo";
        $arrayCabecera[] = "No de Inventario";
        $arrayCabecera[] = "No de Serie";
        $arrayCabecera[] = "Marca";
        $arrayCabecera[] = "Modelo";
        $arrayCabecera[] = "Local o área";

        return $arrayCabecera;
    }

    public function excelBajaAction() {
        $em = $this->getDoctrine()->getManager();
        $activoFijos = $em->getRepository(Entity::ACTIVO_FIJO)->findByBaja();

        $titulo = "Título por defecto";
        $titulos = $this->cabeceraExcelAction();
        // ask the service for a Excel5
        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();
        $phpExcelObject->getProperties()->setCreator($titulo)
            ->setLastModifiedBy($titulo)
            ->setTitle($titulo)
            ->setSubject($titulo)
            ->setDescription($titulo)
            ->setKeywords($titulo)
            ->setCategory($titulo);
        $phpExcelObject->getActiveSheet()
            ->fromArray(
                $titulos, // The data to set
                NULL, // Array values with this value will not be set
                'A1' // Top left coordinate of the worksheet range where
            //    we want to set these values (default is A1)
            );
        $i = 2;
        $no = (int)1;
        foreach ($activoFijos as $entidad) {
            $array = $entidad->toArray();
            $array[0] = $no;
            $celda = "A" . $i++;
            $phpExcelObject->getActiveSheet()
                ->fromArray(
                    $array, // The data to set
                    NULL, // Array values with this value will not be set
                    $celda // Top left coordinate of the worksheet range where

                );
            $no++;
        }
        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel2007');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            '2094034-Baja.xlsx'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }
}
