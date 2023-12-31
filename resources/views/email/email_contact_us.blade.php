<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>

    {{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css"> --}}

    <style>
        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: 'Roboto', sans-serif !important;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 24px;
            color: #8094ae;
            font-weight: 400;
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }

        a {
            text-decoration: none;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* .table-body:before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            background-size: 100%;
            background-image: url("{{ asset('theme/assets/email_template/images/top-bg.svg') }}");
            height: 100%;
            width: 20%;
            background-repeat: no-repeat;
        }

        .table-body:after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            background-size: 100%;
            background-image: url("{{ asset('theme/assets/email_template/images/bottom-bg.svg') }}");
            height: 100%;
            width: 20%;
            background-repeat: no-repeat;
            background-position: bottom left;
        } */
    </style>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f5f6fa;">
    <center style="width: 100%; background-color: #f5f6fa;">
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#f5f6fa">
            <tr>
                <td class="table-body" style="padding: 40px 0;">
                    <table style="width:100%;max-width:620px;margin:0 auto;">
                        <tbody>
                            <tr>
                                <td style="text-align:center;padding-bottom:25px">
                                    <a href="#"><img style="height: 40px" src="{{ asset('theme/assets/images/AKD-LOGO.png') }}" alt="logo"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
                        <tbody>
                            <tr>
                                <td style="padding: 30px 30px 0 30px;">
                                    <h2 style="font-size: 18px; color: #002c72;text-transform: uppercase; font-weight: 600; margin: 0; text-align: center;">Contact Us {{$data['account']}}</h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0 30px 20px">
                                    {{-- <p style="margin-bottom: 10px; margin-top: 20px;color: black">Hello,</p> --}}
                                    <p style="margin-bottom: 10px;color: black">
                                       Name: {{$data['name']}}<br>
                                       Account: {{$data['account']}}<br>
                                       Email: {{$data['email']}}<br>
                                    </p>
                                    <p style="margin-bottom: 10px; margin-top: 20px;color: black">{{$data['description']}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0 30px;color: black">
                                                                        
                                    <p style="margin: 0;margin-bottom: 0px">Reguards,</p>
                                                                        
                                    <p style="margin-bottom: 10px;">AKD Team</p></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>