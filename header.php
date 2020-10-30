
<?php
session_start();
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <base href="/myboncoin/">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=substr($_SERVER['PHP_SELF'], mb_strripos($_SERVER['PHP_SELF'], "/")+1);?></title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="newstyle.css">
    <script src="js/ajax.js"></script>
    <script src="js/jquery.js"></script>

        <script type="text/javascript">

            $(function() {
                $(".toggle").on("click", function() {
                    /*if($(window).width()<=768){
                    if ($(".item").css('display') == 'none') {
                        $(".item").show();
                    } else {
                        $(".item").hide();
                    }
                    }*/
                    if ($(".item").hasClass("active")) {
                                 $(".item").removeClass("active");
                             } else {
                                 $(".item").addClass("active");
                             }

                });

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

            /* Fonction executée lors de l'utilisation du clic droit.
            $(document).on("contextmenu",function()
            $(document).bind("contextmenu",function()
            {
// Si vous voulez ajouter un message d'alerte
                alert('Merci de respecter le travail du webmaster en ne copiant pas le contenu sans autorisation');
// On indique au navigateur de ne pas réagir en cas de clic droit.
                return false;
            });
*/

        </script>
    <!--script src="js/annonces.js"></script-->

</head>

<body>
<?php
echo '<pre>';
//print_r(explode('',$_SERVER['PHP_SELF']));
echo '</pre>';

?>
<header>
        <ul class="menu">
            <!--li class="logo"><a href="index.php" style="font-family: 'Pacifico', cursive;"><?=substr($_SERVER['PHP_SELF'], mb_strripos($_SERVER['PHP_SELF'], "/")+1);?></a> </-->
        <li class="logo">
            <a href="index.php" style="font-family: 'Pacifico', cursive;">Index.php</a>
             </li>

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
