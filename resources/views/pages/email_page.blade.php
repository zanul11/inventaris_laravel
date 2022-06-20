<!DOCTYPE html>
<html>

<head>
    <title>Tes kirim email</title>
</head>

<body>
    <form action="kirim-email" method="POST">
        @csrf
        <input type="email" name="email" required>
        <button type="Submit">Submit</button>

    </form>
</body>

</html>