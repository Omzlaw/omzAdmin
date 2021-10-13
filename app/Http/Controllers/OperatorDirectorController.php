<?php

namespace App\Http\Controllers;

use App\DataTables\OperatorDirectorDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOperatorDirectorRequest;
use App\Http\Requests\UpdateOperatorDirectorRequest;
use App\Repositories\OperatorDirectorRepository;

use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OperatorDirectorController extends AppBaseController
{
    /** @var  OperatorDirectorRepository */
    private $operatorDirectorRepository;

    public function __construct(OperatorDirectorRepository $operatorDirectorRepo)
    {
        $this->operatorDirectorRepository = $operatorDirectorRepo;
    }

    /**
     * Display a listing of the OperatorDirector.
     *
     * @param OperatorDirectorDataTable $operatorDirectorDataTable
     * @return Response
     */
    public function index(OperatorDirectorDataTable $operatorDirectorDataTable)
    {
        return $operatorDirectorDataTable->render('operator_directors.index');
    }

    /**
     * Show the form for creating a new OperatorDirector.
     *
     * @return Response
     */
    public function create()
    {
        return view('operator_directors.create');
    }

    /**
     * Store a newly created OperatorDirector in storage.
     *
     * @param CreateOperatorDirectorRequest $request
     *
     * @return Response
     */
    public function store(CreateOperatorDirectorRequest $request)
    {
        $input = $request->all();

        $operatorDirector = $this->operatorDirectorRepository->create($input);

        Flash::success('Operator Director saved successfully.');
        create_activity('create', 'Operator Director');

        return redirect(route('operatorDirectors.index'));
    }

    /**
     * Display the specified OperatorDirector.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operatorDirector = $this->operatorDirectorRepository->find($id);

        if (empty($operatorDirector)) {
            Flash::error('Operator Director not found');

            return redirect(route('operatorDirectors.index'));
        }

        return view('operator_directors.show')->with('operatorDirector', $operatorDirector);
    }

    /**
     * Show the form for editing the specified OperatorDirector.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $operatorDirector = $this->operatorDirectorRepository->find($id);

        if (empty($operatorDirector)) {
            Flash::error('Operator Director not found');

            return redirect(route('operatorDirectors.index'));
        }

        return view('operator_directors.edit')->with('operatorDirector', $operatorDirector);
    }

    /**
     * Update the specified OperatorDirector in storage.
     *
     * @param  int              $id
     * @param UpdateOperatorDirectorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperatorDirectorRequest $request)
    {
        $operatorDirector = $this->operatorDirectorRepository->find($id);

        if (empty($operatorDirector)) {
            Flash::error('Operator Director not found');

            return redirect(route('operatorDirectors.index'));
        }

        $operatorDirector = $this->operatorDirectorRepository->update($request->all(), $id);

        Flash::success('Operator Director updated successfully.');
        create_activity('update', 'Operator Director');

        return redirect(route('operatorDirectors.index'));
    }

    /**
     * Remove the specified OperatorDirector from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operatorDirector = $this->operatorDirectorRepository->find($id);

        if (empty($operatorDirector)) {
            Flash::error('Operator Director not found');

            return redirect(route('operatorDirectors.index'));
        }

        $this->operatorDirectorRepository->delete($id);

        Flash::success('Operator Director deleted successfully.');
        create_activity('delete', 'Operator Director');

        return redirect(route('operatorDirectors.index'));
    }
}
