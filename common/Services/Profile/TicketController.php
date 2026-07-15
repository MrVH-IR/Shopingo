<?php

namespace Common\Services\Profile;

use App\Http\Controllers\Controller;
use App\Models\Ticket\TicketAdmin;
use App\Models\Ticket\TicketCategory;
use App\Models\Ticket\TicketPriority;
use Common\Services\Profile\Requests\TicketRequest;
use Common\Services\Response\Responses;
use Illuminate\Http\RedirectResponse;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = auth()->user()->tickets()->with(['category', 'priority', 'admin.user', 'user'])->paginate(10);
        $priorities = TicketPriority::all();
        $categories = TicketCategory::all();
        return view('customer.profile.tickets', compact('tickets', 'priorities', 'categories'));
    }

    public function sendTicket(TicketRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['reference_id'] = TicketAdmin::first()->id;
        $validated['status'] = 1;
        auth()->user()->tickets()->create($validated);
        return Responses::redirectToWithBack('success', 'موفق', 'تیکت شما با موفقیت ارسال شد.');
    }
}
