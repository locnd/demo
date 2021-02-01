<html>
    <head>
        <title>Kênh 14</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            body {
                margin: 0;
            }
            .header1 {
                background-color: black;
            }
            .header-content {
                width: 1000px;
                margin-top: 0;
                margin-right: auto;
                margin-bottom: 0;
                margin-left: auto;
                color: white;
                height: 40px;
                line-height: 40px;
            }
            .header-link, .header-search {
                display: inline-block;
            }
            .header-search {
                float: right;
            }
            .header-link a{
                display: inline-block;
                margin-right: 20px;
                color: white;
                text-decoration: none;
                font-size: 12px;
                text-transform: uppercase;
                font-weight: 600;
                padding-left: 20px;
                background-image: url("top-icon.png");
                background-position: left 6px center;
                background-repeat: no-repeat;
            }
            .header-search {
                display: inline-block;
                float: right;
            }
            .header-search-input {
                background-color: black;
                color: white;
                border: none;
                padding: 2px 5px;
                margin-right: 5px;
            }
            .header2 {
                background-color: #f0a52b;
            }
            .header2 .header-content{
                height: auto;
                line-height: inherit;
                padding: 5px 0;
            }
            .logo {
                background-position: 0 0;
                width: 157px;
                height: 60px;
                text-decoration: none;
                background: url(icons.png);
                background-repeat: no-repeat;
                display: block;
                margin: 10px 0;
            }
            @media only screen and (max-width: 510px) {
                .header-search {
                    display: none;
                }
            }
            @media only screen and (max-width: 329px) {
                .header-link {
                    display: none;
                }
                .header-search {
                    display: inline-block;
                }
            }
            .content-body {
                width: 1000px;
                margin: 0 auto;
            }
            .main {
                width: calc(60% - 2px);
                display: inline-block;
            }
            .right-sidebar {
                width: calc(40% - 2px);
                display: inline-block;
                vertical-align: top;
            }
            @media only screen and (max-width: 999px) {
                .header-content, .content-body {
                    width: 100%;
                }
            }
            .item-image, .item-content {
                display: inline-block;
            }
            .item-image {
                width: 260px;
            }
            .item-content {
                width : calc(100% - 264px);
                vertical-align: top;
            }
            .item {
                margin-top: 20px;
                padding-bottom: 20px;
                border-bottom: 1px solid #ccc;
            }
            .item-title {
                font-weight: 600;
                font-size: 18px;
                margin-bottom: 10px;
                color: black;
                text-decoration: none;
                display: block;
            }
            .item-content .item-title {
                font-size: 10px;
            }
            .modal {
                display: none;
                background: white;
                position: fixed;
                width: 500px;
                height: 100px;
                left: calc(50% - 250px);
                top: calc(50vh - 50px);
                z-index: 3000;
            }
            .cover {
                display: none;
                position: fixed;
                width: 100%;
                height: 100vh;
                background: black;
                top: 0;
                left: 0;
                opacity: 0.7;
                z-index: 2000;
            }
            .mg-l-5 {
                margin-left: 5px;
            }
            .item-content .title2 {
                font-size: 18px;
            }
        </style>
    </head>
    <body>
        <div class="header1">
            <div class="header-content">
                <div class="header-link">
                    <a id="link1" href="#">Magazine</a>
                    <a id="link2" href="#">Đọc chậm</a>
                    <a id="link3" href="#">Khám phá</a>
                </div>
                <div class="header-search">
                    <input class="header-search-input" placeholder="Tìm kiếm...">
                    <a href="#">
                        <span class="t-search-icon">
                            <svg width="12" height="12" viewBox="0 0 12 12">
                                <path d="M12.000,10.909 C12.000,11.999 10.909,11.999 10.909,11.999 L7.788,8.879 C6.979,9.467 5.986,9.818 4.909,9.818 C2.198,9.818 -0.000,7.620 -0.000,4.909 C-0.000,2.197 2.198,-0.000 4.909,-0.000 C7.620,-0.000 9.818,2.197 9.818,4.909 C9.818,5.986 9.467,6.978 8.879,7.788 L12.000,10.909 ZM4.909,1.091 C2.800,1.091 1.091,2.800 1.091,4.909 C1.091,7.017 2.800,8.727 4.909,8.727 C7.017,8.727 8.727,7.017 8.727,4.909 C8.727,2.800 7.017,1.091 4.909,1.091 Z" fill="#fff"></path>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header2">
            <div class="header-content">
                <a class="logo" href="/"></a>
            </div>
        </div>
        <div class="content">
            <div class="content-body">
                <div class="main">
                    <br>
                    <a href="/create.php">Thêm</a>
                    <br>
                    <a onclick="openPopup()">Popup</a>
                    <br>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "123456";
                    $dbname = "demo";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                      echo ("Connection failed: " . $conn->connect_error);
                    } else {
                        $conn->set_charset("utf8");
                        $sql = "SELECT * FROM baiviet";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($baiviet = $result->fetch_assoc()) {
                                // $baiviet la 1 bai viet
                                echo '<div class="item" id="item'.$baiviet['id'].'">';
                                    echo '<div class="item-image">';
                                    echo '<img src="'.$baiviet['hinhanh'].'">';
                                    echo '</div>';
                                    echo '<div class="item-content">';
                                        echo '<a href="#" class="item-title title2">'.$baiviet['tieude'].'</a>';
                                        echo '<div class="item-short">'.$baiviet['tomtat'].'</div>';
                                        echo '<a href="/edit.php?id='.$baiviet['id'].'" type="button">Sửa</a>';
                                echo '<input onclick="deleteElement('.$baiviet['id'].')" class="btn-delete-item mg-l-5" type="button" value="Xóa tin">';
                                echo '<input onclick="deleteElement('.$baiviet['id'].')" class="btn-delete-item mg-l-5" type="button" value="Xóa tin">';
                                echo '<input onclick="deleteElement('.$baiviet['id'].')" class="btn-delete-item mg-l-5" type="button" value="Xóa tin">';
                                    echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "0 results";
                        }
                    }
                    $conn->close(); ?>
                </div>
                <div class="right-sidebar">
                    <div></div>
                </div>
            </div>
        </div>
        <hr><hr><hr>
        <div class="footer">
            Footer
        </div>

        <div class="modal" id="popup">
            <div class="modal-title">
                Delete ???
            </div>
            <div class="model-buttons">
                <span onclick="closePopup()">Cancel</span>&nbsp;&nbsp;&nbsp;&nbsp;<span onclick="alert('ok')">OK</span>
            </div>
        </div>
        <div class="cover" onclick="closePopup()"></div>

        <script>
            function deleteElement(id) {
                if (confirm("Delete item ?")) {
                    ajax(id);
                }
            }
            function ajax(id) {
                $.ajax({
                    url: "/delete.php?id="+id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response){
                        if (response.success) {
                            $('#item'+id).remove();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (e) {
                    }
                });
            }
            function openPopup() {
                $('.cover').fadeIn(100);
                $('.modal').fadeIn(100);

                setTimeout(function () {
                    closePopup();
                }, 2000);
            }
            function closePopup() {
                $('.modal').fadeOut(100);
                $('.cover').fadeOut(100);
            }
        </script>
    </body>
</html>
