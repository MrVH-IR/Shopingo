<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body style="margin:0;padding:0;background:#f4f6f8;font-family:Tahoma,Arial,sans-serif;direction:rtl;">
<table width="100%" cellpadding="0" cellspacing="0" border="0"
       style="background:#f4f6f8;padding:40px 15px;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" border="0"
                   style="max-width:600px;width:100%;background:#ffffff;border-radius:12px;overflow:hidden;">
                <tr>
                    <td style="padding:25px 30px;text-align:center;border-bottom:1px solid #eeeeee;">
                        <div style="font-size:20px;font-weight:bold;color:#222222;">
                            {{ config('app.app_persian_name') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding:35px 30px;text-align:right;color:#333333;">
                        <h1 style="margin:0 0 25px;font-size:22px;line-height:1.8;color:#222222;">
                            {{ $title }}
                        </h1>
                        <div style="font-size:14px;line-height:2.2;color:#444444;">
                            {!! nl2br(e($body)) !!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding:20px 30px;text-align:center;background:#fafafa;border-top:1px solid #eeeeee;">
                        <div style="font-size:12px;line-height:1.8;color:#888888;">
                            این ایمیل به صورت خودکار توسط
                            {{ config('app.app_persian_name') }}
                            ارسال شده است.
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
