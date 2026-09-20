<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Check</title>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 24px;
            background: #f5f7fa;
            font-family: Arial, Helvetica, sans-serif;
            color: #1f2937;
        }

        .security-card {
            width: 100%;
            max-width: 420px;
            padding: 40px 32px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.06);
            text-align: center;
        }

        .security-icon {
            width: 56px;
            height: 56px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #f0fdf4;
            color: #16a34a;
            font-size: 26px;
        }

        .security-card h1 {
            margin: 0 0 10px;
            font-size: 22px;
            font-weight: 600;
        }

        .security-card p {
            margin: 0 0 28px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.7;
        }

        .turnstile-wrapper {
            display: flex;
            justify-content: center;
            min-height: 65px;
        }

        .security-footer {
            margin-top: 24px;
            color: #9ca3af;
            font-size: 12px;
        }

        @media (max-width: 480px) {
            .security-card {
                padding: 32px 20px;
            }
        }
    </style>
</head>
<body>
<div class="security-card">
    <div class="security-icon">
        ✓
    </div>
    <h1>Security Check</h1>
    <p>
        Please verify that you are human before continuing.
    </p>
    <div class="turnstile-wrapper">
        <div
            class="cf-turnstile"
            data-sitekey="{{ config('app.cloudflare_key') }}"
            data-callback="turnstileSuccess">
        </div>
    </div>
    <form
        id="verify-form"
        method="POST"
        action="{{ route('verify-human.check') }}"
    >
        @csrf
        <input
            type="hidden"
            name="cf-turnstile-response"
            id="turnstile-token"
        >
    </form>
    <div class="security-footer">
        Protected by Cloudflare Turnstile
    </div>
</div>
<script>
    function turnstileSuccess(token) {
        document.getElementById('turnstile-token').value = token;
        document.getElementById('verify-form').submit();
    }
</script>
</body>
</html>
