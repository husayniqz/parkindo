<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4 font-weight-bold">SISTEM PARKIR LOGIN</h3>
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="******">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2">Masuk Aplikasi</button>
                        </form>
                        <div class="mt-3 text-center text-muted" style="font-size: 12px;">
                            Petunjuk Demo:<br>
                            admin / petugas / owner (pass: password123)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>