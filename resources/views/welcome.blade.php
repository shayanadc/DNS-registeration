<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>DNS Management</title>
</head>
<body>

<div class="alert alert-dismissible fade" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="container">
    <div class="row shadow p-3 mb-5 bg-white rounded">
    <div class="col">
        <div class="card border-primary mb-3">
            <div class="card-header text-white bg-primary mb-3">
                SignIn
            </div>
            <div class="card-body">
                <form id="login-target">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="email-login" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="password-login" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
        <div class="col">
            <div class="card border-primary mb-3">
                <div class="card-header text-white bg-primary mb-3">
                    SignUp
                </div>
                <div class="card-body">
                    <form id="register-target">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="email-register" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="password-register" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword2">Password</label>
                            <input type="password" class="form-control" id="conf-register" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

<script>

    $("#register-target").submit(function (event) {
        event.preventDefault();
        var email = $("#email-register").val();
        var password = $("#password-register").val();
        var conf_pass = $("#conf-register").val();


        $.ajax({
            url: 'http://127.0.0.1:8000/v1/users',
            type: 'POST',
            data: JSON.stringify({
                "email": email,
                "password": password,
                "password_confirmation": conf_pass
            }),
            dataType: "json",
            contentType: "application/json",
            headers: { "Access-Control-Allow-Origin": "*"}
        }).done(function (data) {
            $( ".alert" ).addClass( "alert-success" );
            $( ".alert" ).addClass( "show" );
            $(".alert").append("<strong> Congratulations!! </strong> You Are Registered");
        }).fail(function (data) {
            $( ".alert" ).addClass( "alert-warning" );
            $( ".alert" ).addClass( "show" );
            $(".alert").append("<strong> Attention!! </strong>" + data.responseJSON.errors[0].title);
        });
        setTimeout(function() {
            $('.alert').fadeOut('slow');}, 3000
        );
    })


    $("#login-target").submit(function (event) {
        event.preventDefault();
        var email = $("#email-login").val();
        var password = $("#password-login").val();

        $.ajax({
            url: 'http://127.0.0.1:8000/v1/login',
            type: 'POST',
            data: JSON.stringify({
                "email": email,
                "password": password
            }),
            dataType: "json",
            contentType: "application/json",
            headers: { "Access-Control-Allow-Origin": "*"}
        }).done(function (data) {
            $.cookie("api_token", data.api_token);
            window.location.href = '/profile'
        }).fail(function (data) {
            $( ".alert" ).addClass( "alert-warning" );
            $( ".alert" ).addClass( "show" );
            $(".alert").append("<strong> Attention!! </strong>" + data.responseJSON.errors[0].title);
        });
        setTimeout(function() {
            $('.alert').fadeOut('slow');}, 3000
        );
    })

</script>
</body>
</html>