<?php
/**
 * COVERCRAFT -  SOAP CLIENT
**/

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// INCLUDE nusoap FILE
include_once('nusoap.php');

// INCLUDE DATA CONNECTION
include_once(dirname(__DIR__).'/model/data_connect.php');

// Find + Add New Orders
include_once('create_entry.php');

$go = new Enter_New_Orders();
$go->upload_orders();
$key = "XXXX";
$data = new CC_Connect();
$datas = $data->get_data('', '', '100000', 'Status=0');

// ORDER PARAMETERS
foreach($datas as $datum) {
    if(($datum['Status'] == 0) && ($datum['pur_ord'] !== '')):
        $OrderRequest = Array(
            'po_num'        => $datum['pur_ord'],
            'ref_info'      => $datum['ref'],
            'ship_name'     => $datum['c_name'],
            'ship_company'  => $datum['comp'],
            'ship_address1' => $datum['add_1'],
            'ship_address2' => $datum['add_2'],
            'ship_city'     => $datum['city'],
            'ship_state'    => $datum['state'],
            'ship_zip'      => $datum['zip'],
            'ship_via'      => 'UPS.GND',
            'email'         => '',
            'ship_country'  => $datum['country'],
            'lines' => Array(
                Array(
                    'part_num'  => $datum['p_num'],
                    'part_descr' => $datum['p_desc'],
                    'quantity'  => $datum['quant']
                )
            )
        );

        $service = "GAWebOrder";
        $wsdl = "http://www.gaiwebservices.com/services/GAWebOrder/1.0/GAWebOrder.wsdl";
        $soap = new nusoap_client($wsdl, true);
        $proxy = $soap->getProxy();
        $proxy->$service($key, $OrderRequest);
        // PRINT DEBUG INFO
        $output = '';
        $output .= "<br><table width='400'><tr><td>";
        $output .= "<form>";
        $output .= "<strong>Request:</strong><br>";
        $output .= "<textarea name=\"textarea\" cols=\"150\" rows=\"20\">";
        $output .= $proxy->request;
        $output .= "</textarea>";
        $output .= "<br><br><br><strong>Response:</strong><br>";
        $output .= "<textarea name=\"textarea\" cols=\"150\" rows=\"20\">";
        $output .= $proxy->response;
        $output .= "</textarea>";
        $output .= "</form>";
        $output .= "</td></tr></table>";
        if($proxy->getError()):
            $output .= $proxy->getError();
        else:
            $data->update_sql($datum['id']);
        endif;
        echo $output;
        //Add to log
        $results = $proxy->request . "\n order id =" . $datum['id'] . "\n" . $proxy->response . "\n";
        $file = file_put_contents('cc_results.txt', $results.PHP_EOL, FILE_APPEND | LOCK_EX);
    endif;
}
