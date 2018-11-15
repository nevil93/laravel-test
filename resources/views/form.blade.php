<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Form</title>
</head>
<body>
    <form action="{{url('/view')}}" method="post">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <p>Name: <input type="text" maxlength="30" name="name"></p>
        <p>Email: <input type="email" name="email"></p>
        <p>Message:</p>
        <textarea name="message"cols="30" rows="10"></textarea>

        <button>SEND!</button>

    </form>
</body>
</html>
