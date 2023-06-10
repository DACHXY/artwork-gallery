# Artwork Gallery
## 資料庫管理專案

---

### 如何啟動專案 (Docker)

1. build 檔案

    ```bash
    docker build -t artwork-gallery .
    ```

2. 執行 docker 容器

    ```bash
    docker run -p 80:80 -d --name artworkGallery artwork-gallery
    ```
3. 開啟 apache 頁面

    <http://localhost/>