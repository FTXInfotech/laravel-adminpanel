<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media  only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
        .button{   
                font-family: Avenir, Helvetica, sans-serif;
                box-sizing: border-box;
                box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
                font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
                display: inline-grid;
                width: 200px;
                min-height: 20px;
                padding: 10px;
                background-color: #3869D4;
                border-radius: 3px;
                color: #ffffff;
                font-size: 15px;
                line-height: 25px;
                text-align: center;
                text-decoration: none;
                -webkit-text-size-adjust: none;
        }
        .confirm{
            padding:10px 35px;
            font-family: Avenir, Helvetica, sans-serif;
            box-sizing: border-box;
            text-align: left;
            margin-left: 300px;
            color: #74787E;
            font-size: 16px;
            display: block;
        }

        /* Body Tag */
        body{
            font-family: Avenir, Helvetica, sans-serif;
            box-sizing: border-box;
            color: #74787E;
            height: 100%;
            hyphens: auto;
            line-height: 0px;
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #F2F4F6;
            -moz-hyphens: auto;
            -ms-word-break: break-all;
            -webkit-hyphens: auto;
            -webkit-text-size-adjust: none;
            word-break: break-word;
        }

        /* paragraph */       
        p.link{
            text-align: center;
            font-family: Avenir, Helvetica, sans-serif;
            box-sizing: border-box;
        }

        p.thnx{
            font-family: Avenir, Helvetica, sans-serif;
            box-sizing: border-box;
            text-align: left;
            margin-top: 0;
            color: #74787E;
            font-size: 16px;
            margin-left: 330px;
            line-height: 1.5em;
        }

        p.regards{
            font-family: Avenir, Helvetica, sans-serif;
            box-sizing: border-box;
            text-align: left;
            margin-top: 0;
            color: #74787E;
            font-size: 16px;
            margin-left: 330px;
            line-height: 1.5em;
        }

        p.promotion{
            font-family: Avenir, Helvetica, sans-serif;
            box-sizing: border-box;
            text-align: left;
            margin-top: 0;
            color: #74787E;
            font-size: 14px;
            margin-left: 330px;
            line-height: 1.5em;
        }

        p.promoLink{
            font-family: Avenir, Helvetica, sans-serif;
            box-sizing: border-box;
            text-align: left;
            margin-top: 0;
            color: #74787E;
            font-size: 12px;
            line-height: 1.5em;
            margin-left: 330px;
        }

        p.copyright{
            font-family: Avenir, Helvetica, sans-serif;
            box-sizing: border-box;
            text-align: center;
            margin-top: 0;
            color: #74787E;
            font-size: 12px;
            line-height: 1.5em;
            margin-left: 0px;
        }

        /* anchor tag */
        a#title {
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; 
            font-size: 16px; 
            font-weight: bold; 
            color: #2F3133; 
            text-decoration: none; 
            text-shadow: 0 1px 0 white;
        }

        a#link{
            text-align: center; 
            font-family: Avenir, Helvetica, sans-serif; 
            box-sizing: border-box;
            box-sizing: border-box; 
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); 
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; 
            display: inline-block; 
            width: 200px; 
            min-height: 20px; 
            padding: 10px; 
            background-color: #3869D4; 
            border-radius: 3px; 
            color: #ffffff; font-size: 15px; 
            line-height: 25px; 
            text-align: center; 
            text-decoration: none; 
            -webkit-text-size-adjust: none;
        }

        a#promoLink{
            font-family: Avenir, Helvetica, sans-serif; 
            box-sizing: border-box; 
            color: #3869D4;
            font-size: 14px;

        }

        a#copyright{
            font-family: Avenir, Helvetica, sans-serif; 
            box-sizing: border-box; 
            color: #3869D4;
            line-height: 15em;
        }

        /* header tag */

        h1.title{
            padding: 25px 0;
            text-align:center;
        }

        h1.greatings{
            box-sizing: border-box;
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
            padding: 35px 35px 0 35px;
            font-family: Avenir, Helvetica, sans-serif;
            box-sizing: border-box;
            margin-left: 300px;
            color: #2F3133;
            font-size: 19px;
            font-weight: bold;
            text-align: left;
            line-height: 1.6; 
            display: block;
        }
    </style>
</head>

<body>

    <h1 class="title">
        <a id="title" href="http://127.0.0.1:8001" target="_blank">
            @yield('title', app_name())
        </a>
    </h1>

    <h1 class="greatings">Hello!</h1>

    <p class="confirm">Click here to confirm your account:</p>

    <p class="link">
        <a href="http://127.0.0.1:8001/account/confirm/a1eab89c40867053f04184e542a133c2" class="button" target="_blank">
        Confirm Account
        </a>
    </p>

    <p class="thnx">Thank you for using our application!</p>

    <p class="regards">Regards,<br>Laravel Admin Panel</p>

    <p class="promotion">
        If you’re having trouble clicking the "Confirm Account" button, copy and paste the URL <br> below into your web browser:
    </p>

    <p class="promoLink">
        <a id="promoLink" href="http://127.0.0.1:8001/account/confirm/a1eab89c40867053f04184e542a133c2" target="_blank">
            http://127.0.0.1:8001/account/confirm/a1eab89c40867053f04184e542a133c2
        </a>
    </p>

    <p class="copyright">
        © 2018 <a id="copyright" href="http://127.0.0.1:8001" target="_blank">@yield('title', app_name())</a>.
        All Rights Reserved.
    </p>

</body>
</html>