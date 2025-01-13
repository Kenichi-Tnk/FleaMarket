<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <h1>Email Verification</h1>
    <p>Please check your email for verification link.</p>
    <form action="{{ route('verification.send') }}" method="post">
        @csrf
        <button type="submit">Resend Verification Email</button>
    </form>
</body>
</html>