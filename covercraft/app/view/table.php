<?php

class Table extends Elements
{
    public function set_head()
    {
        $heads = array(
            'id' => 'ID',
            'ordered' => 'DATE',
            'pur_ord' => 'PO',
            'ref' => 'REF',
            'c_name' => 'Customer',
            'add_1' => 'Address',
            'ship' => 'Ship',
            'phone' => 'Phone',
            'email' => 'Email',
            'xr' => '<i class="fa fa-tree"></i>',
            'p_num' => 'Part #',
            'quant' => 'Quant',
            'p_desc' => 'Desc',
            'status' => 'Status'
        );
        $header = '';
        $header .= '<thead class="thead-default">';
        $header .= '<tr>';
        foreach($heads as $k=>$v){
            $header .= '<th id='. $k .'>'. $v .'</th>';
        }
        $header .= '</tr>';
        $header .= '</thead>';
        return $header;
    }
    public function printTable(){

        $head = $this->set_head();

        $data = new CC_Connect();
        $data = $data->get_data();

        $output = '';

        $output .= '<table class="table table-hover table-sm">';
        $output .= $head;
        $output .= '<tbody>';

        foreach($data as $datum):
            $o_time = strtotime($datum['ordered']);

            $output .= '<tr>';
            $output .= '<th scope="row" class="id fit">'. $datum['id'] .'&nbsp;</th>';
            $output .= '<td class="date">'. date("m/d/y<\b\\r>H:i", $o_time) .'&nbsp;</td>';
            $output .= '<td class="p_o">'. $datum['pur_ord'] .'&nbsp;</td>';
            $output .= '<td class="ref">'. $datum['ref'] .'&nbsp;</td>';

            if(!empty($datum['comp'])):
                $output .= '<td>'. $datum['c_name'] .'<br>'. $datum['comp'] .'&nbsp;</td>';
            else:
                $output .= '<td class="name">'. $datum['c_name'] .'&nbsp;</td>';
            endif;

            if(!empty($datum['add_2'])):
                $output .= '<td class="address fit">'. $datum['add_1'] .'<br>'. $datum['add_2'] .'<br>'. $datum['city'] .', '. $datum['state'] .' '. $datum['zip'] .' '. $datum['country'] .'&nbsp;</td>';
            else:
                $output .= '<td class="address fit">'. $datum['add_1'] .'<br>'. $datum['city'] .', '. $datum['state'] .' '. $datum['zip'] .' '. $datum['country'] .'&nbsp;</td>';
            endif;

            $output .= '<td class="ship">'. $datum['ship'] .'&nbsp;</td>';
            $output .= '<td class="phone">'. $datum['phone'] .'&nbsp;</td>';
            $output .= '<td class="email">'. $datum['email'] .'&nbsp;</td>';
            $output .= '<td class="christmas">'. $datum['xr'] .'&nbsp;</td>';
            $output .= '<td class="p_n">'. $datum['p_num'] .'&nbsp;</td>';
            $output .= '<td class="quant">'. $datum['quant'] .'&nbsp;</td>';
            $output .= '<td class="p_desc">'. $datum['p_desc'] .'&nbsp;</td>';
            $output .= '<td class="status">'. $datum['Status'] .'&nbsp;</td>';
            $output .= '</tr>';

        endforeach;
        $output .= '</tbody>';
        $output .= '</table>';

        return $output;
    }
}