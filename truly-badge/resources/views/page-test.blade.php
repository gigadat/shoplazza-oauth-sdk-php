<!DOCTYPE html>
<html>
<head>
    <title>Truly Legit Page Test</title>
</head>
<body>
    <h1>Token and Shop Details</h1>

    @if ($tokenAndShop)
        <ul>
            @foreach ($tokenAndShop as $key => $value)
                <li>{{ $key }}: {{ $value }}</li>
            @endforeach
        </ul>
    @else
        <p>No token and shop details found.</p>
    @endif
</body>
</html>
