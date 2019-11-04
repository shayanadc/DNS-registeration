<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <form class="form-inline">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">@</span>
            </div>
            <input type="text" id="email-sign" class="form-control" aria-label="Username" aria-describedby="basic-addon1" disabled>
        </div>
    </form>
    <div class="collapse navbar-collapse float-md-right" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0" id="logout">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</button>
        </form>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Create New Domain
                </div>
                <div class="card-body">
                    <form class="form-inline" id="domain-register-target">
                        <div class="form-group mx-md-5 mb-2">
                            <label for="inputPassword2" class="sr-only">Domain</label>
                            <input type="text" class="form-control" id="domain-name" placeholder="domain name">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">save +</button>

                        <div class="alert alert-dismissible fade offset-1" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Create New TXT Record
                </div>
                <div class="card-body">
                    <form class="form-inline" id="txt-record-target">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Domains</label>
                            </div>

                            <select class="custom-select" id="domain-select-ids" required>
                                <option value="">Choose</option>
                            </select>
                        </div>
                        <div class="form-group mx-md-5 mb-2">
                            <label for="inputPassword2" class="sr-only">Content</label>
                            <input required type="text" class="form-control" id="record-content" placeholder="content">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">save +</button>

                    </form>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Domain Name</th>
                    <th scope="col">Content</th>
                    <th scope="col">Approved</th>
                </tr>
                </thead>
                <tbody id="tbody-rec">


                </tbody>
            </table>
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
    $(document).ready(function () {
        if ($.cookie("api_token")) {
            $.ajax({
                url: 'http://127.0.0.1:8000/v1/users/current',
                type: 'GET',
                contentType: "application/json",
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    "Authorization" : 'Bearer ' + $.cookie("api_token"),
                    "Accept" : "application/json"
                }
            }).done(function (data) {
                $('#email-sign').attr("placeholder", data.email)
            }).fail(function (data) {
                window.location.href = '/'
            });

            $.ajax({
                url: 'http://127.0.0.1:8000/v1/domains',
                type: 'GET',
                contentType: "application/json",
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    "Authorization" : 'Bearer ' + $.cookie("api_token"),
                    "Accept" : "application/json"
                }
            }).done(function (data) {
                $.each(data, function (index, item) {
                    $('#domain-select-ids').append($('<option>', {
                    value: item.id,
                    text: item.name
                }));
            });
            });

            $.ajax({
                url: 'http://127.0.0.1:8000/v1/records',
                type: 'GET',
                contentType: "application/json",
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    "Authorization" : 'Bearer ' + $.cookie("api_token"),
                    "Accept" : "application/json"
                }
            }).done(function (data) {
                $.each(data, function (index, item) {
                $('#tbody-rec').append(`
                    <tr>
                    <th scope="row">${index}</th>
                        <td>${item.domain.name}</td>
                        <td>${item.content}</td>
                        <td>${item.domain.approved}</td>
                   </tr>
                        `)
                });
            });
        } else {
            window.location.href = '/'
        }
    });

    $("#logout").submit(function (event) {
        $.removeCookie("api_token");
    });
    $("#txt-record-target").submit(function (event) {
        event.preventDefault();
        var record_content = $("#record-content").val();
        var domain_id = $("#domain-select-ids").val();

        $.ajax({
            url: 'http://127.0.0.1:8000/v1/records',
            type: 'POST',
            data: JSON.stringify({
                "content": record_content,
                "domain_id" : domain_id
            }),
            dataType: "json",
            contentType: "application/json",
            headers: {
                "Access-Control-Allow-Origin": "*",
                "Authorization" : 'Bearer ' + $.cookie("api_token"),
                "Accept" : "application/json"
            }
        }).done(function (data) {
            console.log(data)
        }).fail(function (data) {
    });
    });


    $("#domain-register-target").submit(function (event) {
        event.preventDefault();
        var domain_name = $("#domain-name").val();

        $.ajax({
            url: 'http://127.0.0.1:8000/v1/domains',
            type: 'POST',
            data: JSON.stringify({
                "name": domain_name
            }),
            dataType: "json",
            contentType: "application/json",
            headers: {
                "Access-Control-Allow-Origin": "*",
                "Authorization" : 'Bearer ' + $.cookie("api_token"),
                "Accept" : "application/json"
            }
        }).done(function () {
            $( ".alert" ).addClass( "alert-success" );
            $( ".alert" ).addClass( "show" );
            $(".alert").append("<strong> Congratulations!! </strong> You Domain Is Registered");
        }).fail(function (data) {
            $( ".alert" ).addClass( "alert-warning" );
            $( ".alert" ).addClass( "show" );
            $(".alert").append("<strong> Attention!! </strong>" + data.responseJSON.errors[0].title);
        });
    });

    setTimeout(function() {
        $('.alert').fadeOut('slow');}, 3000
    );
</script>
</body>
</html>