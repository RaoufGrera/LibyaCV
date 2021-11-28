<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form action="{{ url('/oauth/clients') }}" method="POST">
        <p>
            <input type="text" name="name" />

        </p>
        <p>
            <input type="text" name="redirect" />

        </p>
        <p>
            <input type="submit" name="send" value="enter" />

        </p>
        {{ csrf_field() }}
    </form>
</body>
</html>
