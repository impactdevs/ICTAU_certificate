<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <header style="text-align: center; border-bottom: 1px solid #ddd; padding-bottom: 20px; margin-bottom: 20px;">
            <h1>{{ config('app.name') }}</h1>
        </header>

            {!! $body !!}

        <footer style="text-align: center; border-top: 1px solid #ddd; padding-top: 20px; margin-top: 20px;">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>