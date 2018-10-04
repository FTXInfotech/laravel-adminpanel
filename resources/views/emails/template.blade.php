<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <meta name="viewport" content="width=600,initial-scale = 2.3,user-scalable=no">
    <!--[if !mso]><!-- -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans|Fira+Sans+Condensed|Raleway" rel="stylesheet">
    <!--<![endif]-->

    <title>@yield('title', app_name())</title>

    <style type="text/css">
        body {
            width: 100%;
            margin: 0;
            padding: 0;
            mso-margin-top-alt: 0px;
            mso-margin-bottom-alt: 0px;
            mso-padding-alt: 0px 0px 0px 0px;
            -webkit-font-smoothing: antialiased;
            background-color: #495867;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%23a594c1' fill-opacity='0.4'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3Cpath d='M6 5V0H5v5H0v1h5v94h1V6h94V5H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");


            font-family: 'Fira Sans',Raleway, sans-serif;

        }

        p,
        h1,
        h2,
        h3,
        h4 {
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
            font-family: 'Fira Sans',Raleway, sans-serif;
        }

        span.preheader {
            display: none;
            font-size: 1px;
        }

        html {
            width: 100%;
        }

        table {
            font-size: 14px;
            border: 0;
            padding:10px;
        }

        .lap{
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
        }

        .container{
            margin-top: 25px;
            margin-left: 25px;
            margin-right: 25px;
        }

        .content{
            
        }
        /* ----------- responsivity ----------- */

        @media only screen and (max-width: 640px) {
            /*------ top header ------ */
            .main-header {
                font-size: 20px !important;
            }
            .main-section-header {
                font-size: 28px !important;
            }
            .show {
                display: block !important;
            }
            .hide {
                display: none !important;
            }
            .align-center {
                text-align: center !important;
            }
            .no-bg {
                background: none !important;
            }
                 
            /* ====== divider ====== */
            .divider img {
                width: 440px !important;
            }
            /*-------- container --------*/
            .container590 {
                width: 440px !important;
            }
            .container580 {
                width: 400px !important;
            }
            .main-button {
                width: 220px !important;
            }
            
        }

        @media only screen and (max-width: 479px) {
            /*------ top header ------ */
            .main-header {
                font-size: 18px !important;

            }
            .main-section-header {
                font-size: 26px !important;
            }
            
            /*-------- container --------*/
            .container590 {
                width: 210px !important;
            }
            .container590 {
                width: 210px !important;
            }
            .container580 {
                width: 260px !important;
            }
        }
    </style>
</head>


<body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

    <div class="container">
        <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" style="width:60%; margin: 0 auto;" class="bg_color">
            <tr>
                <td align="center">
                    <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                        <tr>
                            <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;"
                                class="main-header">
                                <!-- section text ======-->

                                <div style="line-height: 35px">
                                    {{ app_name() }}
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                        </tr>

                        <tr>
                            <td align="center">
                                <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
                                    <tr>
                                        <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
                        </tr>

                        <tr>
                            <div class="content">
                                <td align="left">
                                    <table border="0" width="80%" align="center" cellpadding="0" cellspacing="0" class="container590">
                                        <tr>
                                            <td align="left" style="color: #888888; width:20px; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                                <!-- section text ======-->

                                                <p style="line-height: 24px; margin-bottom:15px;">
                                                    Hello!
                                                </p>
                                                
                                                <p style="line-height: 24px; margin-bottom:20px;">
                                                    Click here to confirm your account:
                                                </p>
                                                <table border="0" align="center" width="180" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="margin-bottom:20px;">

                                                    <tr>
                                                        <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                                    </tr>

                                                    <tr>
                                                        <td align="center" style="color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 22px; letter-spacing: 2px;">
                                                            <!-- main section button -->

                                                            <div style="line-height: 22px;">
                                                                <a href="{{ $confirmation_url }}" style="color: #ffffff; text-decoration: none;">Confirm Account</a>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                                    </tr>

                                                </table>

                                                <p style="line-height: 24px; margin-bottom:20px;">
                                                    Thank you for using our application!
                                                </p>

                                                <p style="line-height: 24px">
                                                    Regards,</br>
                                                    @yield('title', app_name())
                                                </p>

                                                <br><br>

                                                <p style="line-height: 24px; margin-bottom:20px;">
                                                     If you’re having trouble clicking the "Confirm Account" button, copy and paste the URL below into your web browser: 
                                                </p>

                                                <p style="line-height: 24px; margin-bottom:20px;">
                                                    <a href="{{ $confirmation_url }}" target="_blank" class="lap">
                                                        {{ $confirmation_url}}
                                                    </a>
                                                </p>

                                                <p style="line-height: 24px; margin-bottom: 20px;">
                                                    ©2018 <a href="" target="_blank" class="lap">@yield('title', app_name())</a>
                                                    All Rights are Reserved.
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </div>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td>
            </tr>
        </table>
    </div>
    <!-- end section -->
</body>
</html>