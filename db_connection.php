<pre>
    <style>
    .city {
      background-color: tomato;
      color: white;
      border: 2px solid black;
      margin-left: 300px;
      padding: 25px;
    }
    .box {
      width: 300px;
      height: 250px;
    }
    .a {
      display: inline-block;
    }
    .b{
      //background-color: tomato;
      //color: white;
      display: inline-block;
      height: 300px;
      vertical-align: middle;
      padding: 20px;
    }
    </style>
<?php
error_reporting(E_ALL & ~E_NOTICE);
	$dbhost= '127.0.0.1';#MySQL IP
	$dbuser= 'root';#帳號
	$dbpass= '';
	$dbname= 'db_name';#資料庫名稱
	
	#建立連線
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
	mysqli_query($conn, "SET NAMES 'utf8'"); #編碼
	
	mysqli_select_db($conn, $dbname); #選擇要使用的資料庫
    

    print_r($_POST);
    $a = explode(" ", $_POST['keyword']);
    print_r($a);
?>
</pre>