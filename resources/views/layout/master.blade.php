<!DOCTYPE html>
<html>

<head lang="vi">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <base href="{{asset('')}}">

    <link rel="stylesheet" type="text/css" href='css/main.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="o_web_client">
@yield('content')
</body>

</html>
