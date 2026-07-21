<?php

namespace Common\Services\Profile;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Ticket\TicketAdmin;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketFile;
use App\Models\Ticket\TicketPriority;
use Common\Services\Profile\Requests\TicketRequest;
use Common\Services\Response\Responses;
use Illuminate\Http\RedirectResponse;

class TicketController extends Controller
{

    public function __construct(protected TicketService $ticketService) {}
    public function index()
    {
        $tickets = auth()->user()->tickets()->with(['category', 'priority', 'admin.user', 'user', 'children'])->orderBy('created_at', 'desc')->paginate(10);
        $priorities = cache()->remember('ticket_priorities', now()->addHour(), function () {
            return TicketPriority::where('status', 1)->get();
        });
        $categories = cache()->remember('ticket_categories', now()->addHour(), function () {
            return TicketCategory::where('status', 1)->get();
        });
        return view('customer.profile.tickets', compact('tickets', 'priorities', 'categories'));
    }

    public function sendTicket(TicketRequest $request, ImageService $imageService): RedirectResponse
    {
        $this->ticketService->createTicket($request->validated());

        return Responses::redirectToWithBack(
            'success',
            'موفق',
            'تیکت شما با موفقیت ارسال شد.'
        );
    }
}
