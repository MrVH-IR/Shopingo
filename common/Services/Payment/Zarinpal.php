<?php

namespace Common\Services\Payment;

use App\Models\Market\Order;
use Common\Services\Payment\Contracts\PaymentGateway;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Random\RandomException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Zarinpal implements PaymentGateway
{

    /**
     * @throws ConnectionException
     * @throws RequestException
     * @throws RandomException
     */
    public function request(Order $order): array
    {
        if (config('payment.zarinpal.sandbox')) {
            $this->useSandbox();
        }
        try {
            return Http::acceptJson()
                ->contentType('application/json')
                ->post(
                    config('payment.zarinpal.zarinpalGateway'),
                    [
                        'merchant_id'   => config('payment.zarinpal.merchantId'),
                        'amount'        => (int) $order->productAmountWithDelivery(),
                        'callback_url'  => route('customer.sales-process.zarinpal-callback', $order),
                        'referrer_id'   => config('payment.zarinpal.referrer_id', ''),
                        'description'   => sprintf(
                            'خرید آنلاین با شماره سفارش %d توسط کاربر %d',
                            $order->id,
                            $order->user_id
                        ),
                        'metadata' => [
                            'mobile' => $order->user?->mobile,
                            'email' => $order->user?->email,
                        ],
                    ]
                )
                ->throw()
                ->json();
        } catch (Throwable $e) {
            $this->logException($e);
            throw $e;
        }
    }

    /**
     * @throws ConnectionException
     * @throws RequestException
     * @throws RandomException
     */
    public function verify(Order $order, string $authority): array
    {
        try {
            return Http::acceptJson()
                ->contentType('application/json')
                ->post(
                    config('payment.zarinpal.sandboxVerifyGateway'),
                    [
                        'merchant_id' => config('payment.zarinpal.merchantId'),
                        'amount' => (int) $order->productAmountWithDelivery(),
                        'authority' => $authority,
                    ]
                )
                ->throwIf(fn ($response) => $response->serverError())
                ->json();
        } catch (Throwable $e) {
            $this->logException($e);
            throw $e;
        }
    }

    private function useSandbox(): void
    {
        config([
            'payment.zarinpal.zarinpalGateway' =>
                config('payment.zarinpal.sandboxGateway'),

            'payment.zarinpal.verifyGateway' =>
                config('payment.zarinpal.sandboxVerifyGateway'),
        ]);
    }

    /**
     * @throws RandomException
     */
    private function logException(Throwable $e): void
    {
        $errorId = now()->format('YmdHis') . random_int(1000, 9999);
        Log::error('Zarinpal Exception', [
            'error_id' => $errorId,
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
            'trace' => $e->getTraceAsString(),
            'response' => $e instanceof RequestException && $e->response
                ? $e->response->body()
                : null,
        ]);
    }

    public static function getErrorMessage(int $code): string
    {
        return match ($code) {
            -9  => 'خطای اعتبارسنجی اطلاعات ارسالی.',
            -10 => 'آی‌پی یا مرچنت کد پذیرنده صحیح نیست.',
            -11 => 'مرچنت کد فعال نیست. با پشتیبانی زرین‌پال تماس بگیرید.',
            -12 => 'تعداد درخواست‌ها بیش از حد مجاز است. کمی بعد دوباره تلاش کنید.',
            -13 => 'محدودیت تراکنش ترمینال. مدارک حساب خود را تکمیل کنید.',
            -14 => 'دامنه Callback با دامنه ثبت‌شده در زرین‌پال مطابقت ندارد.',
            -15 => 'درگاه پرداخت تعلیق شده است.',
            -16 => 'سطح تأیید پذیرنده پایین‌تر از سطح نقره‌ای است.',
            -17 => 'محدودیت پذیرنده در سطح آبی.',
            -18 => 'آدرس Referrer با دامنه ثبت‌شده مطابقت ندارد.',
            -19 => 'امکان ایجاد تراکنش برای این ترمینال وجود ندارد.',

            // Payment Request
            -30 => 'پذیرنده اجازه استفاده از سرویس تسهیم شناور را ندارد.',
            -31 => 'حساب بانکی تسویه را در پنل زرین‌پال ثبت کنید.',
            -32 => 'مبلغ تسهیم از مبلغ کل تراکنش بیشتر است.',
            -33 => 'درصدهای تسهیم وارد شده معتبر نیست.',
            -34 => 'مبلغ تسهیم ثابت از مبلغ کل تراکنش بیشتر است.',
            -35 => 'تعداد دریافت‌کنندگان تسهیم بیش از حد مجاز است.',
            -36 => 'حداقل مبلغ تسهیم باید ۱۰٬۰۰۰ ریال باشد.',
            -37 => 'یک یا چند شماره شبا غیرفعال است.',
            -38 => 'شماره شبا به درستی در شاپرک ثبت نشده است.',
            -39 => 'خطایی در سرویس تسهیم رخ داده است.',
            -40 => 'پارامتر expire_in نامعتبر است.',
            -41 => 'حداکثر مبلغ پرداخت ۱۰۰ میلیون تومان است.',

            // Payment Verify
            -50 => 'مبلغ پرداختی با مبلغ درخواست وریفای مطابقت ندارد.',
            -51 => 'پرداخت ناموفق بوده است.',
            -52 => 'خطای غیرمنتظره رخ داده است. با پشتیبانی زرین‌پال تماس بگیرید.',
            -53 => 'این تراکنش متعلق به این مرچنت کد نیست.',
            -54 => 'Authority نامعتبر است.',
            -55 => 'تراکنش مورد نظر یافت نشد.',

            // Payment Reverse
            -60 => 'امکان ریورس کردن تراکنش با بانک وجود ندارد.',
            -61 => 'تراکنش موفق نیست یا قبلاً ریورس شده است.',
            -62 => 'آی‌پی درگاه ثبت نشده است.',
            -63 => 'مهلت ریورس کردن تراکنش به پایان رسیده است.',

            // Success
            100 => 'عملیات با موفقیت انجام شد.',
            101 => 'تراکنش قبلاً با موفقیت وریفای شده است.',
            default => 'خطای ناشناخته از سمت زرین‌پال.',
        };
    }
}
