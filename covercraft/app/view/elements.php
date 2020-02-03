<?php

class Elements
{
    protected function set_open_div($class, $id, $role)
    {
        $a = '<div class="'. $class .'" id="'. $id .'" role="'. $role .'">';
        return $a;
    }

    protected function set_close_div()
    {
        $a = '</div>';
        return $a;
    }

    protected function set_open_row($class = NULL, $label = NULL)
    {
        $a = '<tr class="" aria-label="" >';
        return $a;
    }

    protected function set_close_row()
    {
        $a = '</tr>';
        return $a;
    }

    protected function set_cell($class, $content)
    {
        $a = '<td class="'. $class .'" >'. $content .'</td>';
        return $a;
    }

    protected function set_button($content = NULL)
    {
        $b_id = preg_replace('/\s+/', '_', $content);
        return '<button type="button" id="'. $b_id .'" class="btn btn-secondary">'. $content .'</button>';
    }

    protected function set_input($type = NULL, $value = NULL, $placeholder = NULL, $name = NULL)
    {
        $b_id = preg_replace('/\s+/', '_', $name);
        return '<input type="'. $type .'" value="'. $value .'" name="'. $b_id .'" id="'. $b_id .'" placeholder="'. $placeholder .'"><label>'. $name .'</label>';
    }
}