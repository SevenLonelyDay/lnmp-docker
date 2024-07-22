<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <table border = "1">
            <tr>
                <td>ID</td>
                <td>Username</td>
                <td>status</td>
                <td>login_time</td>
                <td>last_record_time</td>
                <td>title</td>
                <td>content</td>
                <td>token</td>
            </tr>
            @foreach($data as $key => $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['username'] }}</td>
                    @if($value['status'] == 0)
                        <td bgcolor="red">禁用</td>
                    @else
                        <td>正常</td>
                    @endif
                    <td>{{ $value['login_time'] > 0 ? date('Y-m-d H:i:s', $value['login_time'] + 8*60*60) : 'never' }}</td>
                    <td>{{ isset($value['record']['created_at'])?date('Y-m-d H:i:s', strtotime($value['record']['created_at'])):'never' }}</td>
                    <td>{{ isset($value['record']['title'])?$value['record']['title']:'never' }}</td>
                    <td>{{ isset($value['record']['content'])?$value['record']['content']:'never' }}</td>
                    <td>{{ $value['token'] }}</td>
                </tr>
            @endforeach
        </table>
    </body>
</html>
