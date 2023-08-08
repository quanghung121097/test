<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTicketRequest;
use App\Services\TicketService;

class TicketController extends Controller
{
    private $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function search(SearchTicketRequest $request)
    {
        $data['select'] = $request->select ?? ['id', 'airline_company_id', 'type', 'price', 'fee', 'tax', 'start_time'];
        $data['sortBy'] =  $request->sortBy ?? 'price';
        $data['conditions'] = [];
        if (isset($request->start_point)) {
            $data['conditions'][] = [
                'key' => 'start_point',
                'value' => $request->start_point,
            ];
        }
        if (isset($request->end_point)) {
            $data['conditions'][] = [
                'key' => 'end_point',
                'value' => $request->end_point,
            ];
        }
        if (isset($request->start_time)) {
            $data['conditions'][] = [
                'key' => 'start_time',
                'value' => $request->start_time,

            ];
        }
        if (isset($request->type)) {
            $data['conditions'][] = [
                'key' => 'type',
                'value' => $request->type,
            ];
        }
        $tickets = $this->ticketService->search($data);
        if (!empty($tickets)) {
            return response(['success' => true, 'data' => $tickets]);
        } else {
            return response(['success' => false, 'message' => 'Có lỗi xảy ra vui lòng thử lại']);
        }
    }
}
