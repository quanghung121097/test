<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTicketRequest;
use App\Services\AirlineCompanyService;
use App\Services\LocationService;
use App\Services\TicketService;
use App\Services\TicketTypeService;

class TicketController extends Controller
{
    private $ticketService, $locationService, $airlineCompanyService, $ticketTypeService;

    public function __construct(
        TicketService $ticketService,
        LocationService $locationService,
        AirlineCompanyService $airlineCompanyService,
        TicketTypeService $ticketTypeService
    ) {
        $this->ticketService = $ticketService;
        $this->locationService = $locationService;
        $this->airlineCompanyService = $airlineCompanyService;
        $this->ticketTypeService = $ticketTypeService;
    }

    public function index()
    {
        $locations = $this->locationService->all();
        $airlineCompanys = $this->airlineCompanyService->all();
        $ticketTypes = $this->ticketTypeService->all();
        return response(
            [
                'success' => true,
                'data' => [
                    'locations' => $locations,
                    'airlineCompanys' => $airlineCompanys,
                    'ticketTypes' => $ticketTypes
                ]
            ]
        );
    }

    public function search(SearchTicketRequest $request)
    {
        $data['with'] = $request->with ?? ['airlineCompany', 'type'];
        $data['sortBy'] =  $request->sortBy ?? 'price';
        $data['conditions'] = [];
        if (isset($request->start_location)) {
            $data['conditions'][] = [
                'key' => 'start_location',
                'value' => $request->start_location,
            ];
        }
        if (isset($request->end_location)) {
            $data['conditions'][] = [
                'key' => 'end_location',
                'value' => $request->end_location,
            ];
        }
        if (isset($request->start_time)) {
            $data['conditions'][] = [
                'key' => 'start_time',
                'value' => $request->start_time,

            ];
        }
        if (isset($request->type_id)) {
            $data['conditions'][] = [
                'key' => 'type_id',
                'value' => $request->type_id,
            ];
        }
        $tickets = $this->ticketService->search($data);
        if (!empty($tickets)) {
            return response(['success' => true, 'data' => $tickets]);
        } else {
            return response(['success' => false, 'message' => 'Có lỗi xảy ra vui lòng thử lại']);
        }
    }

    public function detail($id)
    {
        $ticket = $this->ticketService->find($id);
        if (!empty($ticket)) {
            return response(['success' => true, 'data' => $ticket]);
        } else {
            return response(['success' => false, 'message' => 'Có lỗi xảy ra vui lòng thử lại']);
        }
    }
}
