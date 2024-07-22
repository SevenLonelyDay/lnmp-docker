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
                <td>UserID</td>
                <td>Username</td>
                <td>Title</td>
                <td>Content</td>
                <td>CreatedAt</td>
            </tr>
            @foreach($data as $key => $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['userid'] }}</td>
                    <td>{{ $value['username'] }}</td>
                    <td>{{ $value['title'] }}</td>
                    <td>{{ $value['content'] }}</td>
                    <td>{{ $value['created_at'] }}</td>
                </tr>
            @endforeach
        </table>
    </body>
</html>
