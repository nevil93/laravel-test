<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dates</title>
    <style>
        .table1{
            border: 1px solid #000;
            width: 1400px;
            margin-left: calc(50% - 700px);
        }
        .table2{
            border: 1px solid #000;
            width: 100%;
        }
    </style>
</head>
<body>
<table class="table1" style="text-align: center;">
    <thead>
        <tr>
            <th><strong>Person:</strong></th>
            <th><strong>Message:</strong></th>
        </tr>
    </thead>
    <tbody>
    @foreach($personDates as $person)
        <tr>
            <td>{{$person['name']}}</td>
            <td>
                <table class="table2">
                    @foreach($person['message'] as $message)
                        <tr><td>{{$message}}</td></tr>

                        @endforeach
                </table>
                </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ url('/form')  }}" style="text-align: center; display: block;">Go To Form</a>
</body>
</html>
