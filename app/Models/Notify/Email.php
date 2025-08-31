<?php

namespace App\Models\Notify;

use App\Http\Services\Time\TimeService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes , HasFactory;

    protected $table = 'public_mail';

    protected $fillable = ["subject", "body" , "status" , "published_at"];

    public function getPublishedAtJalaliAttribute(): string
    {
        $timeService = new TimeService;
        $carbon = \Carbon\Carbon::parse($this->published_at);
        $jalaliDate = implode("/" ,$timeService->gregorian_to_jalali($carbon->year, $carbon->month, $carbon->day));
        $time = $carbon->format('H:i:s');

        return $jalaliDate . ' ' . $time;
    }
}
