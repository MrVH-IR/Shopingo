<?php

namespace Common\Controllers\Home\Jobs;

use Common\Controllers\Home\Action\GetUserController;
use Common\Models\UserCyberData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class StoreUserCyberDataJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $ip,
        public array $headers,
        public ?int $userId = null
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $headers = $this->cleanHeaders($this->headers);

        UserCyberData::on('sqlite')->updateOrCreate(
            [
                'ip_address' => $this->ip,
                'user_id' => $this->userId,
            ],
            [
                'header' => $headers,
            ]
        );
    }

    private function cleanHeaders(array $headers): array
    {
        $keep = [
            'user-agent',
            'accept-language',
            'accept',
            'referer',
            'x-forwarded-for',
        ];

        return collect($headers)
            ->only($keep)
            ->map(fn ($v) => is_array($v) ? $v[0] : $v)
            ->toArray();
    }
}
