<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <style>
        body{
            background-color: #ddd;
        }
        .table{
            margin: 50px 0;
            border: 1px solid #000;
            width: 1400px;
            margin-left: calc(50% - 700px);
            border-collapse: collapse;
            box-shadow: 0 0 10px 1px #081d34;
        }
        table {
            width: 100%;
            height: 100%;
            vertical-align: center;
        }
        tr {
            border: 1px solid #000;
        }
        .table tbody tr td, .table thead tr th{
            border: 1px solid #000;
        }
        .messages {
            padding: 0 !important;
        }
        .btn{
            padding: 10px;
            background: none;
            border: 0;
            background-color: green;
            border-radius: 5px;
            color: #fff;
            transition: .5s;
            cursor: pointer;
            outline: none;
            text-decoration: none;
        }
        .btn:hover{
            background-color: greenyellow;
            color: #000;
        }

        form.form{
            margin-top: 50px;
        }
        .form input{
            width: 300px;
            padding: 5px;
            font-size: 16px;
            outline: none;
        }

        a.btn{
            margin-top: 50px;
            display: block;
            width: 100px;
            margin-left: calc(50% - 50px);
        }
    </style>
</head>
<body style="text-align: center;">
    <form action="" class="form" method="GET">
        <input type="text" name="search" id="search">
        {{--<button class="btn">Search</button>--}}
        <a href="#" id="refresh" class="btn" style="display: inline; margin-left: 0;">Refresh</a>
    </form>
    <div class="container-fluid">
        <table class="table">

        </table>
    </div>
    <a href="{{ url('/form')  }}" class="btn">Go To Form</a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
</body>
</html>
