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
            transition: .5s;$data = [];
        if (session()->has('id')) {
            $user = $em->find(Person::class, session('id'));
            $message = $em->getRepository(Message::class)->findOneBy(['id' => session('msgId')]);
            $data['personData'] = [
                $message->getPerson()->getName(),
                $message->getPerson()->getEmail(),
                $message->getContent()
            ];
        }
        return view('form', $data);
            cursor: pointer;
            outline: none;
        }
        .btn:hover{
            background-color: greenyellow;
            color: #000;
        }
        .form{
            margin-top: 100px;
            width: 400px;
            text-align: center;
            margin-left: calc(50% - 200px);
            background-color: #fafafa;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #000;
            box-shadow: 0 0 10px 1px #081d34;
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
            <div>
                <ul class="form-result">
                    @if(isset($personData))
                        @foreach($personData as $data)
                            <li>{{$data}}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </form>
        <br>
            <a href="{{ url('/data')  }}">Data</a>
    </div>
</body>
</html>
