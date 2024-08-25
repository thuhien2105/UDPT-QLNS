<!DOCTYPE html>
<html>

<head lang="vi">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">

    <link rel="stylesheet" type="text/css" href='css/main.css'>
    <link rel="stylesheet" type="text/css" href='css/custom.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="o_web_client">
    @yield('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('script')
    <div id="notification-container">
        @if (session('notifications'))
            @foreach (session('notifications') as $notification)
                @if (is_array($notification) && isset($notification['message']) && isset($notification['type']))
                    <div class="notification {{ htmlspecialchars($notification['type'], ENT_QUOTES, 'UTF-8') }}">
                        {{ htmlspecialchars($notification['message'], ENT_QUOTES, 'UTF-8') }}
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</body>

</html>
