<?php

require '../Modelo/modeloContrato.php';
$a=$_GET['a'];

    $nombreLargo = conseguirNombreLargo($a);
        $nombreCorto = conseguirNombreCorto($a);
        $nombreProyecto = conseguirProyecto($a);
        $codigoCPTIS = conseguirCodigoProyecto($a);
        $nombreRLegal = conseguirRepresentanteLegal($a);
        date_default_timezone_set("America/La_Paz");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        include ('fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetMargins(25, 25);
        $pdf->Ln(12);
        $pdf->SetFont('Times', 'B', 24);
        $pdf->MultiCell(170, 10,' CONTRATO DE PRESTACION DE SERVICIOS - CONSULTORIA' , 0, 'C', FALSE);
        $pdf->Ln(12);
        $pdf->SetFont('Times', null, 14);
        $pdf->Cell(160, 2, $fecha , 0, 1, 'C');
        $pdf->Ln(12);
        $p1 = utf8_decode("     Que suscribe la empresa Taller de Ingeniería de Software - TIS, "
                . "que en lo sucesivo se le denominará TIS, por una parte, y la "
                . "consultora ".$nombreLargo.", registrada debidamente en el De"
                . "partamento de Procesamiento de datos y Registro e inscripcio"
                . "nes, domiciliada en la ciudad de Cochabamba, que en lo suces"
                . "ivo se denominará ".$nombreCorto.", por otra parte, de confo"
                . "rmidad a las clausulas que se detallan a continuación.");
        $pdf->MultiCell(160, 6, $p1 , 0, 'J', FALSE);
        $p2 = utf8_decode("PRIMERA.- TIS contratara los servicios de Contratista para la "
                . "provisión del ".$nombreProyecto.", consultoría que se realiz"
                . "ará conforme a la modalidad y presupuesto entregado por la C"
                . "onsultora, en su documento de propuesta técnica, y normas es"
                . "tipuladas por TIS.");
        $pdf->MultiCell(160, 6, $p2 , 0, 'J', FALSE);
        $p3 = utf8_decode("SEGUNDO.- El objeto de este contrato es la provisión de un produ"
                . "cto software.");
        $pdf->MultiCell(160, 6, $p3 , 0, 'J', FALSE);
        $p4 = utf8_decode("TERCERO.- La consultora ".$nombreCorto.", se hace responsable "
                . "por la buena ejecucion de las distintas fases, que involucre"
                . "n su ingenieria del proyecto, especificadas en la propuesta "
                . "técnica corregida de acuerdo al pliego de especificaciones");
        $pdf->MultiCell(160, 6, $p4 , 0, 'J', FALSE);
        $p5 = utf8_decode("CUARTO.- Para cualquier otro punto no estipulado en "
                . "este contrato debe hacerse referencia a la CPTIS - "
                .$codigoCPTIS.", Pliego de Especificaciones y/o al PG-TIS (Plan "
                . "Global - TIS).");
        $pdf->MultiCell(160, 6, $p5 , 0, 'J', FALSE);
        $p6 = utf8_decode("QUINTO.- Se pone en evidencia que cualquier incumpli"
                . "miento de las clausulas en el presente contrato es pasible a"
                . " la disolución del mismo.");
        $pdf->MultiCell(160, 6, $p6 , 0, 'J', FALSE);
        $p7 = utf8_decode("SEXTO.- La consultora ".$nombreCorto.", declara su a"
                . "bsoluta conformidad con los términos del presente contrato. "
                . "Se deja constancia  de que los datos y antecedentes personal"
                . "es jurídicos proporcionados pr el adjudicatorio son verídico"
                . "s.");
        $pdf->MultiCell(160, 6, $p7 , 0, 'J', FALSE);
        $p8 = utf8_decode("SEPTIMO.- El presente contrato se disuelve también, "
                . "por cualquier motivo de incumplimiento a normas establecidas"
                . "en PG-TIS (Plan Global - TIS).");
        $pdf->MultiCell(160, 6, $p8 , 0, 'J', FALSE);
        $p9 = utf8_decode("OCTAVO.- Por la disolución del contrato, TIS tiene t"
                . "odo el derecho de ejecutar la boleta de garaantía, que es en"
                . "tregada por el contratado como documento de seriedad de la e"
                . "mpresa.");
        $pdf->MultiCell(160, 6, $p9 , 0, 'J', FALSE);
        $p10 = utf8_decode("NOVENO.- La información que TIS brinde al contratad"
                . "o debe ser de rigurosa confidencialidad , y no utilizarce pa"
                . "ra otros fines que no sea el desarrollo del proyecto.");
        $pdf->MultiCell(160, 6, $p10 , 0, 'J', FALSE);
        $p11 = utf8_decode("DECIMO.- TIS representada por su directorio "
                ."Lic. Corina Flores V., Liz. M. Leticia Blanco C., Lic. David "
                . "Escalera F., Lic. Patricia Rodriguez e Ing. Americo Fiorilo,"
                . " y por otra la consultora ".$nombreCorto."rep"
                . "resentada por su representante legal ".$nombreRLegal.", dan "
                . "su plena conformidad a los términos y condiciones establecid"
                . "os en el presente Contrato de Prestación de Servicios y Cons"
                . "ultoría, firmado en constancia al pie del presente documento"
                . ".");
        $pdf->MultiCell(160, 6, $p11 , 0, 'J', FALSE);
        $pdf->Ln(9);
        $pdf->Cell(160, 2, "Cochabamba, ".$fecha , 0, 1, 'C');
        $pdf->SetXY(30, 100);
        $pdf->MultiCell(70, 6, "REPRESENTANTE\nMIEMBRO DIRECTORIO", 0, 'C', FALSE);
        $pdf->SetXY(120, 100);
        $pdf->MultiCell(70, 6, "REPRESENTANTE\nCONSULTORA", 0, 'C', FALSE);
        
        $pdf->Output("../contrato".$nombreLargo.".pdf");
        
        echo "<script language='javascript'>window.open('../contrato".$nombreLargo.".pdf','_self');</script>"; //para ver el archivo pdf generado
        
        exit;
