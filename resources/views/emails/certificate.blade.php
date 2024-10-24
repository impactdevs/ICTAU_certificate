<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }

        .certificate {
            border: 5px solid #4CAF50;
            padding: 30px;
            margin: 20px auto;
            width: 70%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4CAF50;
        }

        .name {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <h1>Certificate of Attendance</h1>
        <p>This certifies that</p>
        <div class="name">{{ $firstName }} {{ $lastName }}</div>
        <p>has successfully attended the National ICT Inaugural Summit</p>
        <p>held from October 23 to 24, 2023.</p>
        <div class="footer">
            <p>Issued on: {{ date('F j, Y') }}</p>
            <p>Thank you for your participation!</p>
        </div>
    </div>
</body>

</html>
