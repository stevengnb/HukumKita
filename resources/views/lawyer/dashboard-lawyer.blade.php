<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>LAWYER DASHBOARD</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="d-grid my-3">
            <button class="btn btn-dark btn-lg" type="submit">Logout</button>
        </div>
    </form>
</body>
</html>
