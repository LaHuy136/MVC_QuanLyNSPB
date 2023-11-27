<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>t2.html</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            font-size: 1rem;
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
            background-color: #cbe4f7;
        }

        .menu {
            padding: 10px;
        }

        .list-category {
            list-style: none;
        }

        .category-item__link {
            display: flex;
            justify-content: center;
            margin: 0 0 30px -40px;
            padding: 2px 0;
            text-decoration: none;
            border: 1px solid #f9f9f9;
            border-radius: 4px;
            background-color: #fff;
        }

        .category-item__link:hover {
            background-color: #acd4f2;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="menu">
        <ul class="list-category">
            <li class="category-item">
                <a href="../Controller/C_Staff.php?mod1" target="f3" class="category-item__link">Đăng nhập</a>
            </li>
            <li class="category-item">
                <a href="../Controller/C_Staff.php?" target="f3" class="category-item__link">Xem nhân viên</a>
            </li>
            <li class="category-item">
                <a href="../Controller/C_Department.php?" target="f3" class="category-item__link">Xem phòng ban</a>
            </li>
            <li class="category-item">
                <a href="../Controller/C_Staff.php?mod2" target="f3" class="category-item__link">Tìm kiếm</a>
            </li>
        </ul>
    </div>
</body>

</html>