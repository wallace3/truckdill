<?php

require_once('../../vendor/autoload.php');

// GET REQUISITION INFO
$actual_link = 'http://'.$_SERVER['HTTP_HOST'];
$json=[
    "id" => $_GET['id']
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $actual_link."/truckdmback/Requisitions/getRequisitionsbyId",  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",    
    CURLOPT_POSTFIELDS => json_encode($json),                     
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "cache-control: no-cache"
    ]
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$responseInfo	= json_decode($response);
curl_close($curl);

// PETICIÓN PARA OBTENER MATERIALES
$json2=[
    "id" => $_GET['id']
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $actual_link."/truckdmback/Requisitions/getRequisitionMaterialbyId",  
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",    
    CURLOPT_POSTFIELDS => json_encode($json),                     
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "cache-control: no-cache"
    ]
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$responseMaterial	= json_decode($response);
curl_close($curl);

$detalle="";
foreach ($responseMaterial->data as $key => $value) {
    $detalle .= '<tr>'.
                    '<td>'.$value->Partida.'</td>'.
                    '<td>'.$value->Marca.'</td>'.
                    '<td>'.$value->Modelo.'</td>'.
                    '<td>'.$value->Descripcion.'</td>'.
                    '<td>'.$value->Cantidad.'</td>'.
                    '<td>'.$value->Unidad.'</td>'.
                    '<td>'.$value->Area.'</td>'.
                '</tr>';
}

$html ='<html>
        <table>
            <tr>
                <td><img src ="../../template/img/logotdm.png" width="200px" height="100px"><br><b>Proyecto:</b>'.$responseInfo->data[0]->Project.'<br><b>Equipo:</b>'.$responseInfo->data[0]->Equipment.'<br><b>No. Economico:</b>'.$responseInfo->data[0]->Number.'</td>
                <td></td>
                <td><center><h3>Requisición de Compra</h3></center><br><br></td>
                <td><b>Folio:</b>'.$responseInfo->data[0]->Folio.'<br><b>Fecha de Emisión:</b>'.$responseInfo->data[0]->Emition_Date.'<br><b>Fecha Requerida:</b>'.$responseInfo->data[0]->Required_Date.'<br><b>Clave Depto. Emisor:</b>'.$responseInfo->data[0]->Depto.'</td>
            </tr>
        </table>
        <br><br><br><br><br>
        <table style="cellspacing="0" cellpadding="8"  style="background-color:#EAF4FB"">
            <thead>
                <tr style="background-color: #D0EBFD;">
                    <th>Partida</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>area</th>
                </tr>
            </thead>
            <tbody>
                '.$detalle.'
            </tbody>
        </table>
        <br><br>
        <div>
            <b>Justificación:</b>'.$responseInfo->data[0]->Justification.'
        </div><br>
        <div>
            <b>Observaciones:</b>'.$responseInfo->data[0]->Observations.'
        </div><br><br>
        <div>
            <div style="text-align:left;position:inline;">
                <label><b>Solicitante:</b>'.$responseInfo->data[0]->Employee.'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><b>Residente:</b>'.$responseInfo->data[0]->resident.'</label>
            </div>
        </div>
      
    </html>' ;



$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();

?>