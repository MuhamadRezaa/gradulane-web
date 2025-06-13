<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .card {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>

<body>
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Login</h4>
            <form method="POST" action="/login">
                @csrf
                <div class="mb-3">
                    <label for="identifier" class="form-label">Email atau NIM</label>
                    <input type="text" class="form-control" id="identifier" name="identifier"
                        placeholder="Masukan Email atau NIM" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Masukan Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
