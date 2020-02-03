<?php

class Controls extends Elements
{
    public function printControls()
    {
        $controls = array(
            'print',
            'export'
        );

        foreach($controls as $control):
            echo $this->set_open_div('btn-group mr-4', '', 'group');
            echo $this->set_button($control);
            echo $this->set_close_div();
        endforeach;
    }

    public function printInputs()
    {
        $controls = array(
            0 => array( //check all
                'checkbox',
                '',
                '',
                'select all'
            ),
            1 => array(
                'date',
                '',
                'Date',
                ''
            )
        );

        foreach($controls as $control):
            echo $this->set_open_div('input-group mr-4', '', 'group');
            echo $this->set_Input($control[0], $control[1], $control[2], $control[3]);
            echo $this->set_close_div();
        endforeach;
    }

    public function printPagination()
    {
        $paginate = new Pagination();
        $pagein = $paginate->pagination();
        echo $pagein;
    }
}