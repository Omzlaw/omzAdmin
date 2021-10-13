<?php

namespace App\Http\Controllers;

use App\DataTables\StateDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Repositories\StateRepository;

use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class StateController extends AppBaseController
{
    /** @var  StateRepository */
    private $stateRepository;

    public function __construct(StateRepository $stateRepo)
    {
        $this->stateRepository = $stateRepo;
    }

    /**
     * Display a listing of the State.
     *
     * @param StateDataTable $stateDataTable
     * @return Response
     */
    public function index(StateDataTable $stateDataTable)
    {
        return $stateDataTable->render('states.index');
    }

    /**
     * Show the form for creating a new State.
     *
     * @return Response
     */
    public function create()
    {
        return view('states.create');
    }

    /**
     * Store a newly created State in storage.
     *
     * @param CreateStateRequest $request
     *
     * @return Response
     */
    public function store(CreateStateRequest $request)
    {
        $input = $request->all();

        $state = $this->stateRepository->create($input);

        Flash::success('State saved successfully.');
        create_activity('create', 'State');

        return redirect(route('states.index'));
    }

    /**
     * Display the specified State.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        return view('states.show')->with('state', $state);
    }

    /**
     * Show the form for editing the specified State.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        return view('states.edit')->with('state', $state);
    }

    /**
     * Update the specified State in storage.
     *
     * @param  int              $id
     * @param UpdateStateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStateRequest $request)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        $state = $this->stateRepository->update($request->all(), $id);

        Flash::success('State updated successfully.');
        create_activity('update', 'State');

        return redirect(route('states.index'));
    }

    /**
     * Remove the specified State from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $state = $this->stateRepository->find($id);

        if (empty($state)) {
            Flash::error('State not found');

            return redirect(route('states.index'));
        }

        $this->stateRepository->delete($id);

        Flash::success('State deleted successfully.');
        create_activity('delete', 'State');

        return redirect(route('states.index'));
    }
}
