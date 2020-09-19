
<?php
session_start();
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$_SERVER['php_self']?></title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="">
    <script src="js/ajax.js"></script>
    <style>

        /*basic style */
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            font-family: sans-serif;
        }

        header {
            background: orangered;
            top: 0;
            left: 0;
            width: 100%;
            position: fixed;
            z-index: 9;
        }

        .menu {
            display: flex;
            list-style-type: none;
            justify-content: center;
        }

        .item {
            padding: 30px 26px;
            display: block;
        }


        .logo {
            flex: 1;
            padding: 8px 8px;
        }

        .logo a {
            font-size: 31px;
        }


        .menu li a {
            text-decoration: none;
            font-family: sans-serif;
            display: block;
            color: white;
        }

        .toggle {
            display: none;
        }

        .active {
            display: block;
        }
        @media all and (min-width: 769px) {
            * {
                box-sizing: border-box;
                padding: 0;
                margin: 0;
            }

            body {
                font-family: sans-serif;
            }

            header {
                background: orangered;
                top: 0;
                left: 0;
                width: 100%;
                position: fixed;
                z-index: 9;
            }

            .menu {
                display: flex;
                list-style-type: none;
                justify-content: center;
            }

            .item {
                padding: 30px 26px;
                display: block;
            }


            .logo {
                flex: 1;
                padding: 8px 8px;
            }

            .logo a {
                font-size: 31px;
            }


            .menu li a {
                text-decoration: none;
                font-family: sans-serif;
                display: block;
                color: white;
            }

            .toggle {
                display: none;
            }
            .active {
            display: block;
            }

        }

        /* Mobile menu*/
        @media all and (max-width: 768px) {
            .menu {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: center;
            }

            .bars {
                background: #ffffff;
                display: inline-block;
                height: 2px;
                position: relative;
                transition: background .2s ease-out;
                width: 18px;
            }

            .bars:before,
            .bars:after {
                background: #ffffff;
                content: '';
                display: block;
                height: 100%;
                position: absolute;
                transition: all .2s ease-out;
                width: 100%;
            }

            .bars:before {
                top: 5px;
            }

            .bars:after {
                top: -5px;
            }

            .toggle {
                order: 1;
                cursor: pointer;
                display:block ;
                padding-right: 5px;
            }

            .item {
                width: 100%;
                text-align: center;
                order: 3;
                display: none;
                border-bottom: 1px solid #ffffff;
            }
            .logo {
            text-align: center;
            }
        }

        /*
        .menu ul li{
        }






        menu a:visited{
            color:#00a5;
        }

        .alert-danger{
            color: orangered;
        }

        .alert{
            color: orangered;
        }

        .alert-success{
            color: forestgreen;
        }

        a:visited{
            color: #9530ff;
        }

        .container{
            margin:auto;
            margin-top: 100px;
            text-align: center;
            /*background-color: lightsteelblue;*/
        }

        .container ul {
            /*width:92.7%;*/
            color: rgba(38, 63, 255, 0.99);
            border:1px solid black;
            margin: auto;
            border-radius: 9px;
            margin-bottom: 3px;
            height: 150px;
        }


        .wrapper{
            /*background-color: lightsteelblue;*/
            display: flex;
            flex-wrap: wrap;
            width: 74.7%;
            margin: 0 auto;
            justify-content: center;
        }





    </style>
    <script src="js/jquery.js"></script>

        <script type="text/javascript">

            $(function() {
                $(".toggle").on("click", function() {
                    //if($(window).width()<=768){
                    if ($(".item").css('display') == 'none') {
                        $(".item").show();
                    } else {
                        $(".item").hide();
                    }
                    //}
                    /*if ($(".item").hasClass("active")) {
                                 $(".item").removeClass("active");
                             } else {
                                 $(".item").addClass("active");
                             }

                });*/
                })
            });

            var timeNow = Math.floor((new Date().getTime())/1000);
            document.querySelector('html').addEventListener('click',
                function () {
                    timeNow=Math.floor((new Date().getTime())/1000);
                }
            )
            document.querySelector('html').addEventListener('mouseover',
                function () {
                    timeNow=Math.floor((new Date().getTime())/1000);
                }
            )
            document.querySelector('html').addEventListener('doubleclick',
                function () {
                    timeNow=Math.floor((new Date().getTime())/1000);
                }
            )
            var time2=function(){
                var timeNow2 = Math.floor((new Date().getTime())/1000);
                var time = timeNow2-timeNow;
                if(time<300){
                    console.log(time);
                }else{
                    window.location='killsession.php';
                }
            }

            setInterval(time2,1000);

            //setInterval("endSession()", 10000);

        function endSession()
        {
            // convertie timestamp js (milliseconde) en seconde
            var timeNow = new Date().getTime();
            timeNow = timeNow * 0.001;
            timeNow = Math.floor(timeNow);
            //récupère le timestamp php
            <?php if($_SESSION['timer']) :  ?>
                var timeExpire = '<?php echo $_SESSION['timer']; ?>' ;
                if (timeNow >= timeExpire)
                {
                    <?php unset($_SESSION)?>
                    window.location='index.php';
                }
            <?php endif; ?>
        }

        function ok(){
            return 'ok';
        }

        function filterform(){
            var form=$('#filtrer');
            $('#lesfiltres').append(form);
            form.show();
        }

    </script>
    <!--script src="js/annonces.js"></script-->

</head>

<body>

<header>
        <ul class="menu">
            <li class="logo"><a href="index.php" style="font-family: 'Pacifico', cursive;">MyBoncoin.com</a> </>

            <li class="item"><a href="navbar.html">annonces</a></li>
            <?php
            if($_SESSION['id_utilisateur']):;
            ?>
                <li class="item"><a href="dashboard.php">mon compte</a></li>
                <li class="item"><a href="logout.php">deconnexion</a></li>
            <?php else:?>
                <li class="item"><a href="connexion.php">connexion</a> </li>
                <li class="item"><a href="inscription.php">inscription</a> </li>
            <?php endif ?>
            <!--li class="item">
                <a href="#"><img src="search.png" width="50" height="50"
                                 alt="search"></a>
            </li>
            <li><a href="#">nouveau sur le site</a> </li>
            <li><a href="#">veteran</a></li-->
            <li class="toggle"><span class="bars"></span></li>
        </ul>
    </header>




</body>
