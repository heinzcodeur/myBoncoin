
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
    <link rel="stylesheet" href="css/style.css">
    <script src="js/ajax.js"></script>
    <style>

        header a:visited{
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

<header style="z-index: 23">
        <ul>
            <li style="font-family: 'Pacifico', cursive;"><a href="index.php">MyBoncoin.com</a> </li>
            <li><a href="#">annonces</a></li>
            <?php
            if($_SESSION['id_utilisateur']):;
            ?>
                <li><a href="dashboard.php">mon compte</a></li>
                <li><a href="logout.php">deconnexion</a></li>
            <?php else:?>
                <li><a href="connexion.php">connexion</a> </li>
                <li><a href="inscription.php">inscription</a> </li>
            <?php endif ?>
            <li>
                <!--a href="#"><img src="search.png" width="50" height="50"
                                 alt="search"></a-->
            </li>
            <!--li><a href="#">nouveau sur le site</a> </li>
            <li><a href="#">veteran</a></li-->
        </ul>

    </header>




</body>
