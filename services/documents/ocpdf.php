<?php

require_once('../../vendor/autoload.php');

// GET REQUISITION INFO
$actual_link = 'http://'.$_SERVER['HTTP_HOST'];
$json=[
    "id" => $_GET['id']
];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => $actual_link."/truckdmback/Requisitions/getOc",  
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
    CURLOPT_URL => $actual_link."/truckdmback/Requisitions/getOcsMaterial",  
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
                    '<td>'.$value->Cantidad.'</td>'.
                    '<td>'.$value->Unidad.'</td>'.
                    '<td>'.$value->Descripcion.'</td>'.
                    '<td>'.$value->PrecioU.'</td>'.
                    '<td>'.$value->TotalU.'</td>'.
                '</tr>';
}

$html ='<html>
        <table>
            <tr>
                <td><img src ="../../template/img/logotdm.png" width="200px" height="100px"><br><b>Proyecto:</b>'.$responseInfo->data[0]->Project.'<br><b>Equipo:</b>'.$responseInfo->data[0]->Equipment.'<br><b>No. Economico:</b>'.$responseInfo->data[0]->Number.'</td>
                <td></td>
                <td><center><h3>Orden de Compra</h3></center><br><br></td>
                <td><b>Folio:</b>'.$responseInfo->data[0]->Folio.'<br><b>Fecha de Emisión:</b>'.$responseInfo->data[0]->Emition_Date.'<br><b>Fecha Requerida:</b>'.$responseInfo->data[0]->Limit_Date.'<br><b>Clave Depto. Emisor:</b>'.$responseInfo->data[0]->Depto.'</td>
            </tr>
        </table>
        <table>
            <thead>
                <tr>
                    <td><b>Proveedor</b></td>
                    <td><b>Datos de Facturación</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><textarea cols="30" row="15" class="form-control">'.$responseInfo->data[0]->Supplier.'</textarea></td>
                    <td><textarea cols="60" row="40" class="form-control">TRUCK DRILL MACHINES, S.A. DE C.V. ENVIAR FACTURA ORIGINAL Y REMISIÓN FIRMADA DE ENTREGA.</textarea></td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <td><b>Entregar En</b></td>
                    <td><b>Datos Envío Factura</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><textarea cols="30" row="15" class="form-control">'.$responseInfo->data[0]->Deliver.'</textarea></td>
                    <td><textarea cols="60" row="40" class="form-control">- paulina.hernandez@lopezrdzcia.com, C.C: gerado.lopez@lopezrdzcia.com, C.C: mdiaz@truckdm.com.mx</textarea></td>
                </tr>
            </tbody>
        </table>
        <table>
        <thead>
            <tr>
                <td><b>Método de Pago:</b></td>
                <td><b>Forma de Pago:</b></td>
                <td><b>Uso de CDFI:</b></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>PPD</td>
                <td>99</td>
                <td>Gastos en General</td>
            </tr>
        </tbody>
    </table>
        <br><br><br><br><br>
        <table style="cellspacing="0" cellpadding="8"  style="background-color:#EAF4FB"">
            <thead>
                <tr style="background-color: #D0EBFD;">
                    <th>Partida</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Descripción</th>
                    <th>Precio U.</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                '.$detalle.'
            </tbody>
        </table>
        <br><br>
        <div>
            <b>Condiciones de Pago:</b>'.$responseInfo->data[0]->Payment_Conditions.'
        </div><br>
        <div>
            <b>Condiciones de Entrega:</b>'.$responseInfo->data[0]->Deliver_Conditions.'
        </div><br><br>
        <div>
            <div style="text-align:left;position:inline;">
                <label>_____________________</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_____________________
            </div>
        </div>
        <div>
        <div style="text-align:left;position:inline;">
            <label><b>Cuenta Por Pagar:</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><b>Jefe de Contabilidad y Finanzas:</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Jefe Admvo.</b>
        </div>
    </div>
      
    </html>' ;



$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();

?>