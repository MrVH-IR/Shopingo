<?php

namespace Common\Services\Profile;

use App\Http\Services\Image\ImageService;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketAdmin;
use App\Models\Ticket\TicketFile;
use Common\Services\Exception\ExceptionLogger;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Throwable;

class TicketService
{
    public function __construct(
        protected ImageService $imageService
    ) {
    }

    /**
     * @param array $data
     * @return Ticket|string
     * @throws Throwable
     */
    public function createTicket(array $data): Ticket|string
    {
        try {
            return DB::transaction(function () use ($data) {
                $ticketImage = $data['file'] ?? null;
                unset($data['file']);

                $data['reference_id'] = TicketAdmin::query()->value('id');
                $data['status'] = 1;

                $ticket = auth()->user()->tickets()->create($data);

                if ($ticketImage instanceof UploadedFile) {
                    $this->createTicketFile($ticket, $ticketImage);
                }

                return $ticket;
            });
        } catch (Throwable $th) {
            return ExceptionLogger::error($th, 'خطا در ذخیره تیکت');
        }
    }

    protected function createTicketFile(Ticket $ticket, UploadedFile $file): void
    {
        $this->imageService->setExclusiveDirectory(
            'images' . DIRECTORY_SEPARATOR . 'tickets'
        );

        $path = $this->imageService->fitAndSave($file, 320, 320);

        TicketFile::create([
            'file_path' => $path,
            'file_size' => $file->getSize(),
            'file_type' => $file->getMimeType(),
            'ticket_id' => $ticket->id,
            'user_id'   => $ticket->user_id,
        ]);
    }
}
