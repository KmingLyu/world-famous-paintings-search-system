<html>
    <head>
        <style>
        .class1 {
          text-align: center;  
        }
        body{
            color: white;
            background-color: white;
            background-blend-mode: normal;
            background-image: url('images/2371.jpg')
        }
        .title{
            color: white;
            padding: 20px;
            height: 120px;
            background-color: rgba(0, 0, 0, .8);
        }
        
        .content{
            //margin: 20px;
            color: white;
            height: 100%;
            //width: 1000px;
            padding: 20px;
            background-color: #ABB2B9;
            background-color: rgba(0, 0, 0, .5);
        }
        p{
            text-align: right;
            font-size: 13px;   
        }
        </style>
        <title>Page Title</title>
    </head>
    
    <body>
        <div class="title">
            <h1 class="class1">世界名畫資料庫</h1>
            <p>作者：呂可名</p>
            <p>資料來源: <a href="https://www.ss.net.tw/">名畫檔案-網路畫廊</a></p>
        </div>
        
        <div class="content">
            <h3>依照條件搜尋名畫</h3>
            
            <form method="POST" action="final_project.php">
                <table>
                    <tr>
                        <td>年份(西元)：</td>
                        <td><input name='year[0]' type="number" min="1" max="2000"> ~ <input name='year[1]' type="number" min="1" max="2000"></td>
                    </tr>
                    <tr>
                        <td>尺寸(公分)：</td>
                        <td>
                            高 &nbsp <input name='length[0]' type="number" min="1" max="1000"> ~ <input name='length[1]' type="number" min="1" max="1000">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            寬 &nbsp <input name='width[0]' type="number" min="1" max="2000"> ~ <input name='width[1]' type="number" min="1" max="2000">
                        </td>
                    </tr>
                    <tr>
                        <td>顏色：</td>
                        <td>
                            <input type="checkbox" id="black" name="color_label[black]"><label for="black">黑</label>
                            <input type="checkbox" id="gray" name="color_label[gray]"><label for="gray">灰</label>
                            <input type="checkbox" id="white" name="color_label[white]"><label for="white">白</label>
                            <input type="checkbox" id="red" name="color_label[red]"><label for="red">紅</label>
                            <input type="checkbox" id="orange" name="color_label[orange]"><label for="orange">橙</label>
                            <input type="checkbox" id="yellow" name="color_label[yellow]"><label for="yellow">黃</label>
                            <input type="checkbox" id="green" name="color_label[green]"><label for="green">綠</label>
                            <input type="checkbox" id="blue" name="color_label[blue]"><label for="blue">藍</label>
                            <input type="checkbox" id="purple" name="color_label[purple]"><label for="purple">紫</label>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="radio" id="warm" name="color_sys" value="0"><label for="warm">冷色系</label>
                            <input type="radio" id="cold" name="color_sys" value="1"><label for="cold">暖色系</label>
                        </td>
                    </tr>
                    <tr>
                        <td>排序方式：</td>
                        <td>
                            <input type="radio" id="sort" name="sort" value="name" checked>作品名稱
                            <input type="radio" id="sort" name="sort" value="author">作者
                            <input type="radio" id="sort" name="sort" value="year">年份 
                            <input type="radio" id="sort" name="sort" value="length">高
                            <input type="radio" id="sort" name="sort" value="width">寬
                        <td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="radio" id="order" name="is_ac" value="ASC" checked>正序(小到大)
                            <input type="radio" id="order" name="is_ac" value="DESC">倒序(大到小)
                        </td>
                    </tr>
                </table>
                
                <h3>依照關鍵字搜尋名畫 (以空白符號分開 <span style="font-size: 15px">ex. 梵谷 自畫像<span>)</h3>
                    <input name='keyword' type="text" size="10">
                    <input type="submit" value="搜尋" style="width:60px">
                    <input type="reset" style="width:60px">
            </form>  
        </div>
    </body>
</html>