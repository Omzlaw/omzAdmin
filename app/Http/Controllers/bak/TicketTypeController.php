<?php

namespace App\Http\Controllers;

use App\DataTables\TicketTypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTicketTypeRequest;
use App\Http\Requests\UpdateTicketTypeRequest;
use App\Repositories\TicketTypeRepository;

use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TicketTypeController extends AppBaseController
{
    /** @var  TicketTypeRepository */
    private $ticketTypeRepository;

    public function __construct(TicketTypeRepository $ticketTypeRepo)
    {
        $this->ticketTypeRepository = $ticketTypeRepo;
    }

    /**
     * Display a listing of the TicketType.
     *
     * @param TicketTypeDataTable $ticketTypeDataTable
     * @return Response
     */
    public function index(TicketTypeDataTable $ticketTypeDataTable)
    {
        return $ticketTypeDataTable->render('ticket_types.index');
    }

    /**
     * Show the form for creating a new TicketType.
     *
     * @return Response
     */
    public function create()
    {
        return view('ticket_types.create');
    }

    /**
     * Store a newly created TicketType in storage.
     *
     * @param CreateTicketTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateTicketTypeRequest $request)
    {
        $input = $request->all();

        $ticketType = $this->ticketTypeRepository->create($input);

        Flash::success('Ticket Type saved successfully.');
        create_activity('create', 'Ticket Type');

        return redirect(route('ticketTypes.index'));
    }

    /**
     * Display the specified TicketType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ticketType = $this->ticketTypeRepository->find($id);

        if (empty($ticketType)) {
            Flash::error('Ticket Type not found');

            return redirect(route('ticketTypes.index'));
        }

        return view('ticket_types.show')->with('ticketType', $ticketType);
    }

    /**
     * Show the form for editing the specified TicketType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ticketType = $this->ticketTypeRepository->find($id);

        if (empty($ticketType)) {
            Flash::error('Ticket Type not found');

            return redirect(route('ticketTypes.index'));
        }

        return view('ticket_types.edit')->with('ticketType', $ticketType);
    }

    /**
     * Update the specified TicketType in storage.
     *
     * @param  int              $id
     * @param UpdateTicketTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTicketTypeRequest $request)
    {
        $ticketType = $this->ticketTypeRepository->find($id);

        if (empty($ticketType)) {
            Flash::error('Ticket Type not found');

            return redirect(route('ticketTypes.index'));
        }

        $ticketType = $this->ticketTypeRepository->update($request->all(), $id);

        Flash::success('Ticket Type updated successfully.');
        create_activity('update', 'Ticket Type');

        return redirect(route('ticketTypes.index'));
    }

    /**
     * Remove the specified TicketType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ticketType = $this->ticketTypeRepository->find($id);

        if (empty($ticketType)) {
            Flash::error('Ticket Type not found');

            return redirect(route('ticketTypes.index'));
        }

        $this->ticketTypeRepository->delete($id);

        Flash::success('Ticket Type deleted successfully.');
        create_activity('delete', 'Ticket Type');

        return redirect(route('ticketTypes.index'));
    }
}
