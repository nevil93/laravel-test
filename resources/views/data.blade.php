<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data</title>
    <style>
        body{
            background-color: #ddd;
        }
        .table1{
            margin: 50px 0;
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
    <form action="" class="form" method="POST">
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        <input type="text" name="search" id="search">
        <button class="btn">Search</button>
        <a href="#" id="refresh" class="btn" style="display: inline; margin-left: 0;">Refresh</a>
    </form>
    @if(session('result'))
        <strong style="text-align: center; display: block; margin-top: 20px; font-size: 20px">Data from DB</strong>
        <table class="table1" style="text-align: center;">
            <thead>
                <tr>
                    <th><strong>Person:</strong></th>
                    <th><strong>Messages:</strong></th>
                </tr>
            </thead>
            <tbody>
            @foreach(session('result') as $result)
                <tr>
                    <td>{{$result['name']}}</td>
                    <td>
                        @foreach($result['message'] as $message)
                        <table class="table2">
                            <tr>
                                <td>{{$message}}</td>
                            </tr>
                        </table>
                        @endforeach
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <a href="{{ url('/form')  }}" class="btn">Go To Form</a>
    <script type="text/javascript" src="{{ asset('js/form.js') }}"></script>
</body>
</html>
