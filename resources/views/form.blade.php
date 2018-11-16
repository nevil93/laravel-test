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
            width: 30%;
        }
    </style>
</head>
<body>
    @if(count($errors) > 0)
        <div class="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
            </ul>
        </div>

        @endif
    <form action="{{url('/view')}}" method="post">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <p>Name: <input type="text" maxlength="30" name="name"></p>
        <p>Email: <input type="email" name="email"></p>
        <p>Message:</p>
        <textarea name="message"cols="30" rows="10"></textarea><br>

        <button>SEND!</button>

    </form>
</body>
</html>
