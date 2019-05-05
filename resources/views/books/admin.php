<a href="">
    <form class="navbar-form navbar-right" action="<?= \core\router\generate('admin') ?>">
    </form>
    <html class="gr__pro_dwweb_ru" lang="ru">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="UTF-8">
        <title>Вход</title>
        <style>
            .form {
                position: absolute;
                width: 350px;
                height: 250px;
                border: 1px solid #b8b5b5;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: #ffffff;
                box-shadow: 0px 0px 3px 1px #b0b0b0;
            }

            form {
                margin-top: 21px;
            }

            div.in {
                display: block;
                padding: 10px;
                text-align: center;
                border-bottom: 1px solid #c9d0d5;
                width: 258px;
                margin: auto;
                margin-top: 19px;
            }

            input[type="text"], input[type="password"] {
                margin-left: 10%;
                margin-top: 17px;
                width: 80%;
            }

            button {
                width: 82%;
                margin-left: 10%;
                margin-top: 19px;
            }

            body {
                background: #f2f2f259;
            }
        </style>
        <meta id="Reverso_extension___elForCheckedInstallExtension" name="Reverso extension" content="2.2.188">
    </head>
    <body data-gr-c-s-loaded="true">
    <div class="form">
        <div class="in">Log IN</div>
        <form action="" method="post">
            <input type="text" name="name" placeholder="login" required=""><br>
            <input type="password" name="pas" placeholder="password" required=""><br>
            <button type="submit" name="send" value="1">log in</button>
        </form>
    </div>

    </body>
    </html>

