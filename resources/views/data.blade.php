<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dates</title>
    <style>
        body{
            background-color: #ddd;
        }
        .table1{
            margin: 100px 0;
            border: 1px solid #000;
            width: 1400px;
            margin-left: calc(50% - 700px);
            border-collapse: collapse;
            box-shadow: 0 0 10px 1px #081d34;
        }
        .table2{
            width: 100%;
            border-collapse: collapse;
        }
        .table2 tr{
            border: 1px solid #000;
        }
        table tr{
            border: 1px solid #000;
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

    </style>
</head>
<body style="text-align: center;">
    <table class="table1" style="text-align: center;">
        <thead>
            <tr>
                <th><strong>Person:</strong></th>
                <th><strong>Messages:</strong></th>
            </tr>
        </thead>
        <tbody>
        @foreach($personData as $person)
            <tr>
                <td>{{$person['name']}}</td>
                <td>
                    <table class="table2">
                        @foreach($person['message'] as $message)
                        <tr>
                            <td>{{$message}}</td>
                        </tr>

                            @endforeach
                    </table>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ url('/form')  }}" class="btn">Go To Form</a>
</body>
</html>
