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

    <!-- Enter Site ID -->
    <h2>Enter Site ID</h2>
    <form method="POST" action="{{ secure_url(route('submit.site.id', [], false)) }}">
        @csrf
        <label for="site_id">Site ID:</label><br>
        <input type="text" id="site_id" name="site_id"><br>
        <input type="submit" value="Submit">
    </form>

    <!-- Display site id if it exists -->
    @if ($siteId)
        <p>Site ID: {{ $siteId }}</p>
    @else
        <p>No site ID found.</p>
    @endif

    <!-- Display Truly Badge Response -->
    @if ($trulyBadgeResponse)
        <h2>Truly Badge Response</h2>
        <ul>
            @foreach ($trulyBadgeResponse as $key => $value)
                <li>{{ $key }}: {{ $value }}</li>
            @endforeach
        </ul>
    @else
        <p>No Truly Badge response found.</p>
    @endif
</body>
</html>
