<?php

namespace App\Controllers;

use CodeIgniter\Controller;

require_once APPPATH . 'ThirdParty\\TCPDFmain\\examples\\tcpdf_include.php';

class PdfController extends Controller
{
  public function index()
  {
    function convertirMayusculas($arreglo)
    {
      // Verificar si se proporcionó un arreglo
      if (!is_array($arreglo)) {
        return "Error: Se debe proporcionar un arreglo como entrada.";
      }

      // Iterar sobre cada elemento del arreglo y convertirlo a mayúsculas
      foreach ($arreglo as $clave => $valor) {
        // Verificar si el valor es una cadena
        if (is_string($valor)) {
          $arreglo[$clave] = strtoupper($valor);
        }
      }
      return $arreglo;
    }

    //arrays para el encabezado y el cuerpo
    $head = $this->request->getVar('columns');
    $body = $this->request->getVar('rows');
    $sala = $this->request->getVar('sala');

    $idpdf = "";

    if (isset($_GET['idpdf'])) {
      $idpdf = $_GET['idpdf'];
    }
    $SubtituloPDF = "vaya papalla";
    if($sala == 1){
      $SubtituloPDF = " DE LA SALA DE ESTUDIOS";
    }else {
      # code...
      $SubtituloPDF = " DE EQUIPOS DE COMPUTO";
    }

    

    $head= explode(",", $head);
    // Convertir el encabezado a mayúsculas

    $head = convertirMayusculas($head);

    //decodificar el cuerpo de json a array
    $body = json_decode($body, true);

   

    // Crear el encabezado de la tabla
    $columns = '<td style="border-bottom: 0.1px solid black; width: 28px;">No</td>';
    $num_column = 1;
    $posicion_name = 0;
    $entradas = 0;
    $salidas = 0;
    foreach ($head as $column => $value) {
      if ($column == 0) {
        if ($idpdf == 1) {
          $columns .= '<td style="border-bottom: 0.1px solid black;">' . $value . '</td>';
        } else {
          if ($value == 'NOMBRE') {
            $columns .= '<td style="color:green;  border-bottom: 0.1px solid black; width: 130px;">' . $value . '</td>';
          } else {
            $columns .= '<td style="color:green;  border-bottom: 0.1px solid black;">' . $value . '</td>';
          }
        }
      } else {
        switch ($value) {
          case 'NOMBRE':
            $columns .= '<td style="border-bottom: 0.1px solid black; width: 130px;"> ' . $value . '</td>';
            $posicion_name = $column;
            break;
          case 'ENTRADA':
            $columns .= '<td style="border-bottom: 0.1px solid black;"> ' . $value . '</td>';
            $entradas = $column;
            break;
          case 'SALIDA':
            $columns .= '<td style="border-bottom: 0.1px solid black;"> ' . $value . '</td>';
            $salidas = $column;
          break;
          default:
            $columns .= '<td style="border-bottom: 0.1px solid black;"> ' . $value . '</td>';
            break;
        }

      }
    }

    // Crear el objeto PDF
    $pdf = new MYPDF('L', 'mm', 'A4', true, 'UTF-8', false);

    // Configurar propiedades
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Autor');
    $pdf->SetTitle('Título');
    $pdf->SetSubject('Asunto');
    $pdf->SetKeywords('Palabras clave');

    $reporte = '';
    if ($idpdf == 0) {
      $reporte = 'REPORTE GENERAL';
    }else{
      $reporte = 'REPORTE GENERAL DE ASISTENCIA';
    }
    // Establecer html
    $html = '
                <style>

                * { font-family: Lato, Helvetica, sans-serif; }
                .header { text-align: center; overflow: hidden; /* Para limpiar el float */ }  
                .center-text { display: inline-block; }
                .content { text-align: center; margin-top: 10px; }
                
                </style>
                <div class="header">
                <div class="center-text">
                    <h1 style="font-family: times, serif;">UNIVERSIDAD DEL ISTMO</h1>
                    <h4 style="font-family: times, serif;">CAMPUS JUCHITÁN</h4>  
                    <h4 style="font-family: times, serif;">DEPARTAMENTO DE BIBLIOTECA</h4>
                </div>
            </div>
            <div class="content">
                <p style="font-family: times, serif;">'. $reporte.''.$SubtituloPDF.'</p>
            </div>
               ';

    $pdf->SetFont('dejavusans', '', 10);
    $pdf->AddPage();
    
    $pdf->Image(base_url("img/logo.png"), 30, 20, 30, '', 'PNG', '', '', true, 300, '', false, false, 0, false, false);
    // Imagen en la esquina superior derecha
    $pdf->Image(base_url("img/suneo.png"), 230, 30, 50, '', 'PNG', '', '', true, 300, '', false, false, 0, false, false);

    // Agregar el contenido HTML al PDF
    $pdf->writeHTML($html, true, false, true, false, '');
    
    // Agregar el contenido HTML al PDF
    $array = array();
    $rows = '';
    foreach ($body as $row ) {
        $rows .= '<tr style="font-size: 6pt;text-align: center;content: center;">';
        foreach ($row as $row2 => $value) {
            if ($row2 == 0) {
                $rows .= '<td style="width: 28px; ">' . $num_column . '</td>';
                if ($idpdf == 1) {
                    $rows .= '<td>' . $value . '</td>';
                } else {
                    if ($row2 == $posicion_name) {
                        $rows .= '<td style="color:green; width: 130px; "  >' . $value . '</td>';
                    } else {
                        $rows .= '<td style="color:green;" >' . $value . '</td>';
                    }
                }
            } else {
              switch ($row2) {
                case $posicion_name:
                  $rows .= '<td style="width: 130px; ">' . $value . '</td>';
                  break;
               case $entradas:
                $rows .= '<td style="color:green; ">' . $value . '</td>';
                  break;
                case $salidas:
                  $rows .= '<td style="color:red;  "  >' . $value . '</td>';
                  break;
                default:
                $rows .= '<td style="padding-top: 0px;">' . $value . '</td>';
                  break;
              }
            }
        }
        $num_column++;
        $rows .= '</tr>';
        $array[] = $rows;
        $rows = '';
    }

    $ppp = 1;
    $pdf->writeHTML('<table cellpadding="1" style="font-weight: bold;border-bottom: 0.1px solid black;font-size: 8pt;text-align: center;content: center;">
     <tr>' . $columns . '</tr></table>', true, false, true, false, '');

     foreach ($array as $row => $value) {
      if ($pdf->getPage() > $ppp) {
          $ppp++;
          $pdf->deletePage($ppp);
          $pdf->AddPage();
          
          $pdf->writeHTML('<table cellpadding="1" style="font-weight: bold;border-bottom: 1px solid black;font-size: 8pt;text-align: center;content: center;">
          <tr >' . $columns . '</tr></table>', true, true, true, false, '');

          $pdf->writeHTML('<table cellpadding="2"  style="border-collapse: collapse; text-align: center;content: center; border-bottom: 0.1px solid black; ">
          '. $array[$row-1] .'</table>', true, true, true, false, '');

          if ($row < count($array)) {
            $pdf->writeHTML('<table cellpadding="2"  style="border-collapse: collapse; text-align: center;content: center; border-bottom: 0.1px solid black; ">
            '.$value .'</table>', true, false, true, false, '');
          }
      }else if ($row < count($array)) {
          $pdf->writeHTML('<table cellpadding="2"  style="border-collapse: collapse; text-align: center;content: center; border-bottom: 0.1px solid black; ">
          '.$value .'</table>', true, false, true, false, '');
      }
    }

    if ($pdf->getPage() > $ppp) {
      $ppp++;
      $pdf->deletePage($ppp);
      $pdf->AddPage();
      
      $pdf->writeHTML('<table cellpadding="1" style="font-weight: bold;border-bottom: 1px solid black;font-size: 8pt;text-align: center;content: center;">
      <tr >' . $columns . '</tr></table>', true, true, true, false, '');

      $pdf->writeHTML('<table cellpadding="2"  style="border-collapse: collapse; text-align: center;content: center; border-bottom: 0.1px solid black; ">
      '. $array[count($array)-1] .'</table>', true, true, true, false, '');
    }

   // Cerrar y generar el PDF
    $pdf->Output('', 'I');
    exit;
   
  }
}

class MYPDF extends \TCPDF
{

  // Page header
  public function Header()
  {

  }

  // Page footer
  public function Footer()
  {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'I', 10);

    // Primer elemento a la izquierda
    date_default_timezone_set('America/Mexico_City');
    $this->Cell(50, 10, date('d/m/y'), 0, 0, 'L', 0, '', 0, false, 'T', 'M');
    $this->setX(110);
    $this->Cell(80, 10, date('h:i a'), 0, 0, 'C', 0, '', 0, false, 'T', 'M');

    // Tercer elemento a la derecha
    $this->Cell(110, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 0, 'R', 0, '', 0, false, 'T', 'M');
  }

}