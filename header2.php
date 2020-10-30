<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>header2</title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            font-family: sans-serif;
            background: url("mypic.jpg"), no-repeat,center,fixed;
        }

        nav{
            background: #fff0CE;
        }

        .menu{
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

         .menu li{
            padding: 20px 20px;
             list-style-type: none;
        }

        /*.menu li:nth-child(1){
        flex:1;
        }*/
        .logo{
            flex:1;
            font-size: x-large;
        }

        @media all and (max-width: 768px){

            .menu {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: center;
            }

            .item{
                text-align: center;
                width: 100%;
                border-bottom: 1px solid white;
            }


            .logo{
                text-align: center;
                font-size: x-large;
                color: white;
            }

        }
    </style>
</head>
<body>

    <nav>
        <ul class="menu">
            <li class="logo">logo</li>
            <li class="item">sign_in</li>
            <li class="item">sign_up</li>
            <li class="item">about</li>
            <li class="item">faq</li>
            <li class="item">
                <input type="text" placeholder="rechercher">
            </li>
        </ul>
    </nav>


</body>
</html>
