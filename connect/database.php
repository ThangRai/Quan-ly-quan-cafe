<?php
    class Database {
       
        private  $servername;
        private  $database;
        private  $username;
        private  $password;
        private  $conn;

        public function __construct() {
            $this->servername = "localhost";
            $this->database = "db_ql3scoffee";
            $this->username = "root";
            $this->password = "";

            $this->connect();
        }

        public function connect() {
            try {
                $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
    
                if (!$this->conn) {
                    throw new Exception("Connection failed: " . mysqli_connect_error());
                }
                return $this->conn;
    
            } catch (Exception $e) {
                echo "Kết nối thất bại: " . $e->getMessage();
            }
        }


        // hàm đóng kết nối
        public function close() {
            if ($this->conn) {
                mysqli_close($this->conn);
            }
        }

        // tự gọi đến hàm đòng kết nối khi ko sd đối tượng đó nữa
        // public function __destruct() {
        //     $this->close();
        // }

        public function select($query)
        {
            if ($this->conn) {
                $result = $this->conn->query($query) or die($this->conn->error.__LINE__);
                if ($result->num_rows > 0) {
                    return $result;
                }
                return false;
            } else {
                die("Kết nối chưa được thiết lập.");
            }
        }

        // Hàm insert
        public function insert($query)
        {
            if ($this->conn) {
                $insert_row = $this->conn->query($query);
                if ($insert_row) {
                    return true;
                } else {
                    return "Thêm thất bại: " . $this->conn->error;
                }
            } else {
                return "Kết nối thất bại!";
            }
        }

        // Hàm update
        public function update($query)
        {
            if ($this->conn) {
                $update_row = $this->conn->query($query);
                if ($update_row) {
                    return true;
                } else {
                    return "Sửa thất bại : " . $this->conn->error;
                }
            } else {
                return "Kết nối thất bại!";
            }
        }

        // Hàm delete
        public function delete($query)
        {
            if ($this->conn) {
                $delete_row = $this->conn->query($query);
                if ($delete_row) {
                    return true;
                } else {
                    return "Xóa thất bại : " . $this->conn->error;
                }
            } else {
                return "Kết nối thất bại!";
            }
        }



    }

?>
