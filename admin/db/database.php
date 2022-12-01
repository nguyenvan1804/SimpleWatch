<!-- chứa hàm chung -->
<?php
    require_once('config.php');

    //sql: insert, update, delete
    function execute($sql){
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);  
        // mysql_set_charset('utf8');
        $resultset = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }

    //sql: select -> lay du lieu dau ra
    function executeResult($sql){
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);    
        $resultset = mysqli_query($conn, $sql); 
        $data = [];
        while (($row = mysqli_fetch_array($resultset, 1)) != null) {
            $data[] = $row;
        }
        mysqli_close($conn);

        return $data;
    }

    function executeSingleResult($sql){
        $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);    
        $resultset = mysqli_query($conn, $sql); 
        $row = mysqli_fetch_array($resultset, 1);
        mysqli_close($conn);

        return $row;
    }

    $conn = mysqli_connect('localhost:3306', 'root', '', 'shop');  

?>