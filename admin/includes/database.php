    <?php

    require_once("new_config.php");

    class Database
    {
        public  $connection;

        function __construct()
        {
            $this->open_db_connection();
        }

        public function open_db_connection()
        {
            // $this->connection = mysqli_connect();
            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($this->connection->connect_errno) {
                
                die("database connection failed badly" . $this->connection->connect_error);
            }
        }


        // query method
        public function query($sql)
        {
            $result = $this->connection->query($sql);
            return $result;
        }

        private function confirm_query($result)
        {
            if (!$result) {
                die('query failed'.$this->connection->error);
            }
        }

        public function escape_string($string){ 
            $escape_string = $this->connection->real_escape_string($string);
            return $escape_string;
        }

        public function insert_id(){
            return mysqli_insert_id($this->connection);
        }
    }


    $database = new Database();
