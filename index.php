<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<style>
    html, body {
    margin: 0;
    padding: 0;
    font-size: 14px;
    font-family: Arial, Helvetica, sans-serif;
    box-sizing: border-box;
    overflow: hidden;
    }

    #container {
        display: flex;
        flex-direction: column;
    }

    #centerFrame {
        display: flex;
    }

    .frame-center.left {
        height: 80vh;
        width: 200px;
        margin-right: 5px;
    }

    .frame-center.main {
        width: 78%;
    }

    .frame-center.right {
        width: 200px;
    }

</style>
<body>
    <div id="container">
        <iframe class="frame-top" src="View/t1.php" name="f1""></iframe>
        <div id="centerFrame">
            <iframe class="frame-center left" src="View/t2.php" name="f2"></iframe>
            
            <iframe class="frame-center main" src="View/t3.php" name="f3"></iframe>
            
            <iframe class="frame-center right" src="View/t4.php" name="f4"></iframe>
        </div>
    </div>

    
</body>

</html>