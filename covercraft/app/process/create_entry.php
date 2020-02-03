<?php

include_once(dirname(__FILE__).'/../../../config.php');

class Enter_New_Orders
{
    private function set_connect()
    {
        $conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if ($conn->connect_error) {
            die('Error establishing connection: ' . $conn->connect_error);
        }
        return $conn;
    }

    private function check_table()
    {
        $sql = "CREATE TABLE IF NOT EXISTS orders(
                id INT(12) AUTO_INCREMENT primary key,
                ordered DATE,
                pur_ord VARCHAR(25) NOT NULL,
                ref VARCHAR(13) NOT NULL,
                c_name VARCHAR(25) NOT NULL,
                comp VARCHAR(50),
                add_1 VARCHAR(50),
                add_2 VARCHAR(50),
                city VARCHAR(25) NOT NULL,
                state VARCHAR(25) NOT NULL,
                zip VARCHAR(11) NOT NULL,
                country VARCHAR(2) NOT NULL,
                ship VARCHAR(10) NOT NULL,
                phone VARCHAR(12),
                email VARCHAR(50),
                xr VARCHAR(4),
                p_num VARCHAR(12),
                quant VARCHAR(3) NOT NULL,
                p_desc VARCHAR(100) NOT NULL,
                Status TINYINT(1)
            )";
        if($this->set_connect()->Query("SHOW TABLES LIKE orders")):
            return 'Table "orders" already exists';
        else:
            if ($this->set_connect()->query($sql) === TRUE) {
                echo "Table 'orders' created successfully<br>";
            } else {
                echo "Error creating table: " . $this->set_connect()->error;
            }
        endif;
    }

    /*
     * upload orders to db
     */
    public function upload_orders()
    {
        $this->check_table();
        $f = @fopen(dirname(__DIR__).'/tmp/covercraft', 'r');

        if (empty($f)):
            die('No Order Record Found');
        else:
            echo "Order Record Found<br>";
        endif;

        while (!feof($f)):
            $buffer = fgets($f, 40960);
            list($po, $ref, $c_name, $comp, $add_1, $add_2, $city, $state, $zip, $country, $ship, $phone, $email, $xr, $p_num, $quantity, $p_desc) = explode(',', $buffer);
            if(empty($p_desc))
                $p_desc = 'N/A';
            if($po):
                $sql_in = "INSERT INTO orders (pur_ord,ref,c_name,comp,add_1,add_2,city,state,zip,country,ship,phone,email,xr,p_num,quant,p_desc,Status)
                    VALUES ('" . $po . "','" . $ref . "','" . $c_name . "','" . $comp . "','" . $add_1 . "','" . $add_2 . "','" . $city . "','" . $state . "','" . $zip . "','" . $country . "','" . $ship . "','" . $phone . "','" . $email . "','" . $xr . "','" . $p_num . "','" . $quantity . "','" . $p_desc . "',0)";
                mysqli_query($this->set_connect(), $sql_in);
            endif;
        endwhile;

        fclose($f);
    }
}
