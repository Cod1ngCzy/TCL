<?php
    class Connection {
        // Class Property
        protected static $sql_connection;
        public static $connection_properties = [
            'STATUS' => "",
            'ERROR' => "",
            'INFO' => ""
        ];

        // Class Method to Set Connection
        protected static function INIT_CONNECTION($host, $name, $pass, $db){
            // Initialize Database Connection
            if(mysqli_connect($host, $name, $pass, $db)){
                self::$connection_properties['STATUS'] = 'Database Connected';
                return self::$sql_connection = mysqli_connect($host, $name, $pass, $db);
            } else {
                self::$connection_properties['STATUS'] = 'Database Failed';
                self::$connection_properties['ERROR'] = mysqli_connect_error();
                return;
            }
        }
    }

    class MySQL extends Connection {
        protected static $db_name;
        protected static $db_tables = [];

        public static function SET_CONNECTION($host, $name , $pass , $db){
            $sql_properties = [
                'HOSTNAME' =>  $host,
                'USERNAME' =>  $name,
                'PASSWORD' =>  $pass,
                'DBNAME'   =>  $db,
            ];

            // Base Case for Handling Connection
            foreach($sql_properties as $key => $value){
                if($key == 'PASSWORD'){
                    continue;
                } else if (is_null($value) || $value == ""){
                    self::$connection_properties['STATUS'] = "Database Failed to Initialized";
                    return  self::$connection_properties['ERROR'] = "$key should be set";
                }
            }
        
            if(Connection::INIT_CONNECTION($host, $name, $pass, $db)){
                $query_tables = "SHOW TABLES";
                $query_tables_result = mysqli_query(self::$sql_connection, $query_tables);

                if($query_tables_result && mysqli_num_rows($query_tables_result) > 0){
                    while ($table = mysqli_fetch_array($query_tables_result)){
                        $query_table_data = "SHOW COLUMNS FROM $table[0]";
                        $query_table_data_results = mysqli_query(self::$sql_connection,  $query_table_data);

                        if ($query_tables_result && mysqli_num_rows($query_tables_result) > 0){
                            while ($row = mysqli_fetch_assoc($query_table_data_results)) {
                                self::$db_tables[$table[0]][] = $row;
                            }
                        } else{
                            self::$db_tables[$table[0]] = [];
                        }
                    }
                } else {
                    echo "No Tables";
                }

            return self::$db_tables;
        }
    }

    public static function GET_TABLE_DATA(){
        foreach(self::$db_tables as $tables => $columns){
            echo $tables;
            foreach($columns as $column){
                echo $column['Field'] . "<br>";
            }
        }
    }

    public static function QUERY($table_name){
        if (!isset($table_name) || $table_name == ""){
            self::$connection_properties['STATUS'] = 'Uncaught Exception in Database';
            self::$connection_properties['ERROR'] = 'Table not Set';
            return;
        } else {
            $query = "SELECT * FROM $table_name";
            $query_result = mysqli_query(self::$sql_connection, $query);
            self::$connection_properties['INFO'] = "Query Successful";
            return mysqli_fetch_assoc($query_result);
        }
    }

    public static function QUERY_FILTER($table_name, $column_data){
        if (!isset($table_name) || $table_name == ""){
            self::$connection_properties['STATUS'] = 'Uncaught Exception in Database';
            self::$connection_properties['ERROR'] = 'Table not Set';
            return;
        } else if (!isset($column_data) || $column_data == ""){
            self::$connection_properties['STATUS'] = 'Uncaught Exception in Database';
            self::$connection_properties['ERROR'] = 'Table is set but no data hiven';
            return;
        } else {
            $query = "SELECT * FROM $table_name WHERE $column_data limit 1";
            $query_result = mysqli_query(self::$sql_connection, $query);
            self::$connection_properties['INFO'] = "Query Successful";
            return mysqli_fetch_assoc($query_result);
        }
    }
    }

    $tables = MySQL::SET_CONNECTION("localhost","root","","jobapplicant");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>

<script>
    php_status = {
        'Connection Status' : "<?php echo Connection::$connection_properties['STATUS']; ?>",
        'Connection Errors' : "<?php echo Connection::$connection_properties['ERROR']; ?>",
        'Connection Info' : "<?php echo Connection::$connection_properties['INFO']; ?>"
    }
    console.log(php_status['Connection Status']);
    console.log(php_status['Connection Errors']);
    console.log(php_status['Connection Info']);
</script>
</html>