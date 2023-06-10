# Artwork Gallery
### 資料庫管理專案
### 410530042 張辰瑋

---

## 如何啟動專案 (Docker)
[Docker的官方網站](https://www.docker.com/)

1. 啟動容器，詳細設定可以在 ```docker-compose.yml``` 中找到

    ```bash
    cd 當前專案路徑
    docker-compose up
    ```

2. 連資料庫時如果找不到 ArtworkDB 會自動建立 ArtworkDB 與 Insert 資料  
創建資料庫的 ```ArworkDB.sql``` 與 ```insert_data.sql``` 位於 ```scripts\``` 路徑中


3. 開啟 專案 頁面 (在 ```docker-compose.yml``` 的設定中，默認設定的 apache port 是 8082，SQL server 的 port 是 8081) 

    <http://localhost:8081/>

---
## DB Connect 檔案的設定

DB 的連接字串設定於位於 ```db/dbConnect.php``` 中