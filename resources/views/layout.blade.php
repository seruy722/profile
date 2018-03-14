<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>App</title>
        <style>
            table,tr,td{
                border: 1px solid black;
                border-collapse: collapse;
                padding: 10px;
            }
            .fio{
                font-size: 25px;
                font-weight: bold;
            }
            a{
                text-decoration: none;
                font-size: 18px;
            }
            .alert-danger{
                color: red;
            }
            .container{
                display: flex;
                justify-content: space-around;
            }
            .left_side{
                margin-right: 50px;
            }
        </style>
    </head>
    <body>
        @yield('content')
    </body>
</html>