# world-famous-paintings-search-system
蒐集 名畫檔案-網路畫廊 (https://www.ss.net.tw/) 網頁中的名畫資訊，建立資料庫，並設計一個搜尋系統。

<img src='form.png' alt='form' width='500' /> <img src='result.png' alt='result' width='500' />

## Python 網路爬蟲

- 網址：https://www.ss.net.tw/
- 爬取資料：圖片、圖片編號、作者、年分、原作尺寸、原作材質、瀏覽人次

## OpenCV 顏色分析

- 建立顏色範圍表
- 計算每種顏色的遮罩比例
- 按照遮罩比例給予圖片標籤

## PHP 資料庫搜尋

本系統使用 PHP 來實現資料庫的搜尋功能，主要包含三個核心檔案：`db_connection.php`、`form.php` 和 `results.php`。這些檔案協同運作，提供使用者友好的介面來搜尋和瀏覽名畫資料庫中的作品。

### 1. `db_connection.php`

`db_connection.php` 負責與 MySQL 資料庫建立連線，並處理來自搜尋表單的資料。其主要功能包括：

- **設定資料庫連線參數**：指定資料庫主機（`$dbhost`）、使用者名稱（`$dbuser`）、密碼（`$dbpass`）及資料庫名稱（`$dbname`）。
- **建立連線**：使用 `mysqli_connect` 函數連接到 MySQL 資料庫，並設定編碼為 UTF-8 以支援多語言文字。
- **處理 POST 資料**：接收並解析使用者透過表單提交的搜尋條件，如年份範圍、尺寸範圍、顏色標籤及關鍵字。
- **構建 SQL 查詢**：根據使用者的搜尋條件動態生成 SQL 語句，並確保條件之間的邏輯關係正確（如使用 `AND` 連接多個條件）。
- **執行查詢並回傳結果**：執行生成的 SQL 查詢，並將結果傳遞給 `results.php` 顯示。

### 2. `form.php`

`form.php` 提供使用者一個友好的搜尋介面，讓使用者可以根據不同的條件來搜尋名畫。主要功能包括：

- **年份範圍搜尋**：使用者可以輸入起始年份和結束年份來篩選作品。
- **尺寸範圍搜尋**：使用者可以輸入作品的高度和寬度範圍。
- **顏色標籤搜尋**：提供多個顏色選項，使用者可以選擇多個顏色來篩選作品。
- **色系選擇**：選擇冷色系或暖色系以進一步篩選作品。
- **排序方式**：使用者可以選擇依作品名稱、作者、年份、高度或寬度進行排序，並選擇升序或降序。
- **關鍵字搜尋**：使用者可以輸入多個關鍵字，以空白分隔，來進行模糊搜尋。


### 3. `results.php`

`results.php` 負責根據使用者在 `form.php` 中提交的搜尋條件，從資料庫中檢索符合條件的名畫，並將結果以友好的方式展示給使用者。其主要功能包括：

- **接收並解析搜尋條件**：從 `POST` 請求中獲取使用者的搜尋條件，如年份、尺寸、顏色標籤、色系及關鍵字。
- **動態生成 SQL 查詢**：根據使用者的輸入條件動態構建 SQL 語句，確保查詢的準確性和效率。
- **執行查詢並處理結果**：執行生成的 SQL 查詢，計算符合條件的資料筆數，並逐筆顯示結果，包括名畫圖片、名稱、作者、年份、尺寸、材質及相關連結。
- **顯示搜尋摘要**：展示使用者的搜尋條件及排序方式，提供清晰的搜尋結果摘要。
- **樣式設計**：使用內嵌的 CSS 來美化搜尋結果的展示，確保介面的美觀與一致性。


### 系統運作流程

1. **使用者輸入搜尋條件**：使用者在 `form.php` 上輸入想要搜尋的條件，如年份範圍、尺寸範圍、顏色標籤及關鍵字，並選擇排序方式及排序順序。
2. **提交搜尋請求**：當使用者點擊「搜尋」按鈕後，表單資料會以 POST 方式提交至 `final_project.php`（假設 `final_project.php` 包含 `db_connection.php` 和 `results.php` 的相關邏輯）。
3. **處理搜尋請求**：
    - `db_connection.php` 會建立資料庫連線，並解析使用者的搜尋條件。
    - 根據解析後的條件，動態生成 SQL 查詢語句以篩選資料庫中的名畫資料。
4. **顯示搜尋結果**：`results.php` 會執行生成的 SQL 查詢，並將符合條件的名畫資料以友好的介面顯示給使用者，包括圖片、作品名稱、作者、年份、尺寸、材質及相關連結。
