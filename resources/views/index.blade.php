<!doctype html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/gif" href="./images/icon.gif"/>
    <title>Lastfm</title>
</head>

<body class="h-100">

<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-lg-6 col-md-12">
            <div class="text-center mb-3">
                <img src="https://www.last.fm/static/images/logo_static.adb61955725c.png"/>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Username" id="username">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="view">View</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<script type="text/javascript">

    function redirect() {
        location.href = "http://" + window.location.hostname + "/" + document.getElementById("username").value;
    }

    document.getElementById("view").addEventListener("click", redirect);

    document.getElementById("username").addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            redirect();
        }
    })
</script>
