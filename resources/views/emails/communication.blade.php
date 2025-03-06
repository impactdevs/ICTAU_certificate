<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update from ICTAU</title>
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
        <div class="content">
            {!! $body !!}
        </div>
    </div>
</body>

</html>
