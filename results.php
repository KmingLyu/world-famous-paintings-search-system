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
        display: flex;
        width: 400px;
        height: 150px;
    }
    .a{
        flex: none;
        width: 120px;
        height: 120px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px solid black;
        background-color: white;
    }
    .b{
        flex: auto;
        display: inline-block;
        vertical-align: top;
        margin-left: 30px;
        font-size: 15px;
    }
    body{
        background-color: black;
        color: white;
        background-color: rgba(0, 0, 0, .8);
        background-blend-mode: multiply;
        background-image: url('images/2371.jpg')
    }
    .content{
        color: white;
        height: auto;
        padding: 20px;
        background-color: rgba(0, 0, 0, .3);
    }
    .small-img{
        flex: none;
        max-width: 120px;
        max-height: 120px;
    }
    </style>
<body>
<div class="content">
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

    $qry = "";
    $msg = "";
    $flag = 0;
    $sort = $_POST['sort'];
    $order = $_POST['is_ac'];
    $msg_dict = array('name'=>"作品名稱", 'author'=>"作者", 'year'=>"年份(西元)", 'length'=>"高(公分)", 'width'=>"寬(公分)", 'black'=>"黑", 'gray'=>"灰", 'white'=>"白", 'red'=>"紅", 'orange'=>"橙", 'yellow'=>"黃", 'green'=>"綠", 'blue'=>"藍", 'purple'=>"紫");
	$order_dict = array('DESC'=>"倒序(大到小)", 'ASC'=>"正序(小到大)");
    
    foreach($_POST as $key=>$each){ 
        //year, size
        if($key=="year" || $key=="length" || $key=="width"){
            if($each[0] && $each[1]){
                //$msg = $msg.;
                if($flag) $qry = $qry."AND ";
                $flag = 1;
                $qry = $qry.$key." BETWEEN ".$each[0]." AND ".$each[1]." ";
                $msg = $msg.$msg_dict[$key]."=".$each[0]."~".$each[1]."; ";
            }  
        }
        //color
        else if($key=="color_label"){
            $msg = $msg."顏色=";
            foreach($each as $color_key=>$color_each){
                if($flag) $qry = $qry."AND ";
                $flag = 1;
                $qry = $qry.$key." LIKE '%".$color_key."%' ";
                $msg = $msg.$msg_dict[$color_key];
            }
            $msg = $msg."; ";
        }
        //color_sys
        else if($key=="color_sys"){
            if($flag) $qry = $qry."AND ";
            $flag = 1;
            $is_warm = $each;
            if($is_warm){
                $qry = $qry."(`color_label` LIKE '%red%' OR `color_label` LIKE '%orange%' OR `color_label` LIKE '%yellow%') AND (`color_label` NOT LIKE '%green%' AND `color_label` NOT LIKE '%blue%' AND `color_label` NOT LIKE '%purple%')";
                $msg = $msg."色系=暖色系; ";
            }
            else{
                $qry = $qry."(`color_label` LIKE '%green%' OR `color_label` LIKE '%blue%' OR `color_label` LIKE '%purple%') AND (`color_label` NOT LIKE '%red%' AND `color_label` NOT LIKE '%orange%' AND `color_label` NOT LIKE '%yellow%')";
                $msg = $msg."色系=冷色系; ";
            }
        }
        //keyword
        else if($key=="keyword" && $each){
            $a = explode(" ",$each);
            $msg = $msg."關鍵字=";
            foreach($a as $keyword){
                if($flag) $qry = $qry."AND ";
                $flag = 1;
                $qry = $qry."(`name` LIKE '%".$keyword."%' OR `number` LIKE '%".$keyword."%' OR `author` LIKE '%".$keyword."%' OR `material` LIKE '%".$keyword."%') ";
                $msg = $msg.$keyword.",";
            }
        } 
    }

    if(!$qry) $qry = "1 ";
    $qry_data = "SELECT * FROM `data01` WHERE ".$qry." ORDER BY ".$sort." ".$order; 
    $qry_count = "SELECT COUNT(*) AS count FROM `data01` WHERE ".$qry;
    //echo $qry_data."\n\n";
    
    $result = mysqli_query($conn, $qry_data);
    $data_count = mysqli_query($conn, $qry_count);
    $c = mysqli_fetch_array($data_count, MYSQLI_ASSOC)['count'];
    echo "<div class='search'>";
    echo "搜尋條件：".$msg."\n";
    echo "排序方式：".$msg_dict[$sort].", ".$order_dict[$order]."\n";
    
    if(mysqli_num_rows($result)==0)
        echo "<h3>找不到東西</h3>";
    else{
        //print_r($result);
        echo "<h3>搜尋到 ".$c." 筆資料：</h3>";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            $image = '../images/'.$row["k"].'.jpg';
            echo '<div class="box">';
            echo '<div class="a">';
            echo "<a href=".$image."><img class='small-img' src=".$image." style='max-width: 120px; max-height: 120px;' alt='一張圖片'></a>\n";
            echo "</div>";
            
            echo '<div class="b">';
            echo "作品名稱：".$row["name"]."\n";
            echo "作　　者：".$row["author"]."\n";
            echo "年　　份：".$row["year"]."\n";
            echo "原作尺寸：".$row["length"]."x".$row["width"]."\n";
            echo "原作材質：".$row["material"]."\n";
            echo "<a href=https://www.ss.net.tw/paint-177-".$row["k"].".html>網頁連結</a>\n";

            echo "</div>";
            echo "</div>";
        }
    }
    
    mysqli_close($conn);
?>
</div>
</body>
</pre>