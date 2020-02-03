<?php
/*
 * create connection to db
 */
include_once(dirname(__FILE__).'/../../../config.php');

class CC_Connect
{
    private $rowsPage = 10;
    private function set_connect()
    {
        $conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die('Error establishing connection: ' . $conn->connect_error);
        }
        return $conn;
    }

    private function set_page()
    {
        return (isset($_GET['page'])) ? $_GET['page'] : 1;
    }

    public function set_data($order_by = null, $order_dir = null, $limit = null, $where = null)
    {
        $source = $this->get_connect();
        $start_from = ($this->set_page() - 1)*$this->rowsPage;
        $order_by = (!empty($order_by)) ? "ORDER BY $order_by" : "ORDER BY id";
        $order_dir = (!empty($order_dir)) ? $order_dir : "DESC";
        $limit = (!empty($limit)) ? $limit : $this->rowsPage;
        $limitQuery = "LIMIT $start_from, $limit";
        if (!empty($where)) {
            $where = "WHERE $where";
        }
        $query = "SELECT * FROM orders $where $order_by $order_dir $limitQuery";
        return mysqli_query($source, $query);
    }

    public function get_connect()
    {
        return $this->set_connect();
    }

    public function get_page()
    {
        return $this->set_page();
    }

    public function get_data($order_by = null, $order_dir = null, $limit = null, $where = null)
    {
        return $this->set_data($order_by, $order_dir, $limit, $where);
    }

    public function update_sql($o_id = null)
    {
        $source = $this->get_connect();
        mysqli_query($source, "UPDATE orders SET Status='1' WHERE id='$o_id'");
    }
}
