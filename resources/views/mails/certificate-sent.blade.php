<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dddddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 10px 0;
            border-bottom: 1px solid #dddddd;
        }

        .header img {
            width: 100px;
            height: auto;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .content h1 {
            color: #333333;
        }

        .content p {
            color: #666666;
        }

        .certificate {
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #dddddd;
            color: #999999;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{asset('assets/img/ictau-logo.jpg')}}" class="navbar-brand-img h-100" alt="...">
        </div>
        <div class="content">
            <h1>Congratulations, {{ $applicant->first_name }}</h1>
            <p>We are pleased to present you with this certificate of IPPU Membership</p>
            <p>We hope to work with yo in a great and an amazing journey to make technology better.</p>
            <p>Keep up the great work!</p>
        </div>
        <div class="footer">
            <pre>
                Nkurunungi Gideon

                Chief Executive Officer
                ICT Association of Uganda
            <pre>
        </div>
    </div>
</body>
</html>
