<?php

class Pagination
{
    function pagination()
    {
        $connection = new CC_Connect();
        $connect = $connection->get_connect();
        $rowsPage = 10;
        $page_query = "SELECT * FROM orders";
        $sort = '';
        $order = '';
        $page = '';
        if (isset($_GET['page'])):
            $page = 1;
        endif;
        if (isset($_GET['sort'])):
            $sort = $_GET['sort'];
        endif;
        if (isset($_GET['order'])):
            $order = $_GET['order'];
        endif;
        $needle = '';
        if (!empty($sort) && ($sort != 'DELETE')) {
            if ($_GET['sort']):
                $needle = ' '. $_GET['sort'];
            else:
                $needle = 'id';
            endif;
            $page_query = "SELECT * FROM orders ". $needle;

        }
        if (!empty($order) && ($order != 'DELETE')) {
            if ($_GET['order']):
                $order = $_GET['order'];
                $page_query = "SELECT * FROM orders ORDER BY". $needle ." ". $order;
            endif;
        }

        $page_result = mysqli_query($connect, $page_query);
        $total_records = mysqli_num_rows($page_result);
        $total_pages = ceil($total_records/$rowsPage);
        $start_loop = $connection->get_page();
        $difference = $total_pages - $start_loop;

        $output = '';
        $output .= '<nav aria-label="Page navigation example">';
        $output .= '<ul class="pagination">';
        for($i = 1; $i <= $total_pages; $i++):
            $output .= '<li class="page-item"><a class="page-link" href="index.php?page='. $i .'">'. $i .'</a>';
        endfor;
        $output .= '</ul>';
        $output .= '</nav>';
        return $output;
    }
}