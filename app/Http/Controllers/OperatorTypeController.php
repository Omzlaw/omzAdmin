<?php

namespace App\Http\Controllers;

use App\DataTables\OperatorTypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOperatorTypeRequest;
use App\Http\Requests\UpdateOperatorTypeRequest;
use App\Repositories\OperatorTypeRepository;

use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OperatorTypeController extends AppBaseController
{
    /** @var  OperatorTypeRepository */
    private $operatorTypeRepository;

    public function __construct(OperatorTypeRepository $operatorTypeRepo)
    {
        $this->operatorTypeRepository = $operatorTypeRepo;
    }

    /**
     * Display a listing of the OperatorType.
     *
     * @param OperatorTypeDataTable $operatorTypeDataTable
     * @return Response
     */
    public function index(OperatorTypeDataTable $operatorTypeDataTable)
    {
        return $operatorTypeDataTable->render('operator_types.index');
    }

    /**
     * Show the form for creating a new OperatorType.
     *
     * @return Response
     */
    public function create()
    {
        return view('operator_types.create');
    }

    /**
     * Store a newly created OperatorType in storage.
     *
     * @param CreateOperatorTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateOperatorTypeRequest $request)
    {
        $input = $request->all();

        $operatorType = $this->operatorTypeRepository->create($input);

        Flash::success('Operator Type saved successfully.');
        create_activity('create', 'Operator Type');

        return redirect(route('operatorTypes.index'));
    }

    /**
     * Display the specified OperatorType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operatorType = $this->operatorTypeRepository->find($id);

        if (empty($operatorType)) {
            Flash::error('Operator Type not found');

            return redirect(route('operatorTypes.index'));
        }

        return view('operator_types.show')->with('operatorType', $operatorType);
    }

    /**
     * Show the form for editing the specified OperatorType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $operatorType = $this->operatorTypeRepository->find($id);

        if (empty($operatorType)) {
            Flash::error('Operator Type not found');

            return redirect(route('operatorTypes.index'));
        }

        return view('operator_types.edit')->with('operatorType', $operatorType);
    }

    /**
     * Update the specified OperatorType in storage.
     *
     * @param  int              $id
     * @param UpdateOperatorTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperatorTypeRequest $request)
    {
        $operatorType = $this->operatorTypeRepository->find($id);

        if (empty($operatorType)) {
            Flash::error('Operator Type not found');

            return redirect(route('operatorTypes.index'));
        }

        $operatorType = $this->operatorTypeRepository->update($request->all(), $id);

        Flash::success('Operator Type updated successfully.');
        create_activity('update', 'Operator Type');

        return redirect(route('operatorTypes.index'));
    }

    /**
     * Remove the specified OperatorType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operatorType = $this->operatorTypeRepository->find($id);

        if (empty($operatorType)) {
            Flash::error('Operator Type not found');

            return redirect(route('operatorTypes.index'));
        }

        $this->operatorTypeRepository->delete($id);

        Flash::success('Operator Type deleted successfully.');
        create_activity('delete', 'Operator Type');

        return redirect(route('operatorTypes.index'));
    }
}
