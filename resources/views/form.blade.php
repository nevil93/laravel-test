<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Form</title>
    <style>
        .alert{
            color: darkred;
            background-color: palevioletred;
            border-radius: 5px;
            width: 100%;
        }
        .alert ul{
            list-style: none;
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
        }
        .btn:hover{
            background-color: greenyellow;
            color: #000;
        }
        .form{
            width: 400px;
            text-align: center;
            margin-left: calc(50% - 200px);
            background-color: #fafafa;
            padding: 15px;
            border-radius: 10px;
        }
        .form-result{
            list-style: none;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="form">
        @if(count($errors) > 0)
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <form action="" method="post">
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <p>Name: <input type="text" maxlength="30" name="name"></p>
            <p>Email: <input type="email" name="email"></p>
            <p>Message:</p>
            <textarea name="message"cols="30" rows="10"></textarea><br>

            <button class="btn">SEND!</button>
        </form>
        <br>
            <a href="{{ url('/dates')  }}">Dates</a>
    </div>
</body>
</html>
