<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Cart</title>
    <!-- favicon -->
    <link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAKCgkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAERABERERABERAAARERAAAREAAAAAAAABERABERERABEREBEREREREREAAAAAAAAREQERAREBEBERAREBEQERAREAAAAAAAABEQERAREBEQERAREBEQEREBEAAAAAAAAAEQERERERERERAREREREREQABERERERERERERERERERHn8wAAw+EAAMABAADn8wAA7/8AAMADAADd2wAA3d0AAMABAADd3QAA3d4AAMAAAADf/wAA3/8AAB//AAD//wAA" rel="icon" type="image/x-icon" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- FontAwesome for icon -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
@include('header')

<main class="container-xxl">
    @yield('content')
</main>

<!-- Jquery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @if($count_notifications > 0)
    $("#btn-noti").click(function () {
        $.ajax({
            url: "/notification/read",
            method: 'POST',
            success: function (data) {
                $("#count_notifications").hide();
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
    @endif
</script>
@yield('js')

</body>
</html>
