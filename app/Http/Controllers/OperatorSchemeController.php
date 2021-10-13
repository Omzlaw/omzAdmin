<?php

namespace App\Http\Controllers;

use App\DataTables\OperatorSchemeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOperatorSchemeRequest;
use App\Http\Requests\UpdateOperatorSchemeRequest;
use App\Repositories\OperatorSchemeRepository;

use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OperatorSchemeController extends AppBaseController
{
    /** @var  OperatorSchemeRepository */
    private $operatorSchemeRepository;

    public function __construct(OperatorSchemeRepository $operatorSchemeRepo)
    {
        $this->operatorSchemeRepository = $operatorSchemeRepo;
    }

    /**
     * Display a listing of the OperatorScheme.
     *
     * @param OperatorSchemeDataTable $operatorSchemeDataTable
     * @return Response
     */
    public function index(OperatorSchemeDataTable $operatorSchemeDataTable)
    {
        return $operatorSchemeDataTable->render('operator_schemes.index');
    }

    /**
     * Show the form for creating a new OperatorScheme.
     *
     * @return Response
     */
    public function create()
    {
        return view('operator_schemes.create');
    }

    /**
     * Store a newly created OperatorScheme in storage.
     *
     * @param CreateOperatorSchemeRequest $request
     *
     * @return Response
     */
    public function store(CreateOperatorSchemeRequest $request)
    {
        $input = $request->all();

        $operatorScheme = $this->operatorSchemeRepository->create($input);

        Flash::success('Operator Scheme saved successfully.');
        create_activity('create', 'Operator Scheme');

        return redirect(route('operatorSchemes.index'));
    }

    /**
     * Display the specified OperatorScheme.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operatorScheme = $this->operatorSchemeRepository->find($id);

        if (empty($operatorScheme)) {
            Flash::error('Operator Scheme not found');

            return redirect(route('operatorSchemes.index'));
        }

        return view('operator_schemes.show')->with('operatorScheme', $operatorScheme);
    }

    /**
     * Show the form for editing the specified OperatorScheme.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $operatorScheme = $this->operatorSchemeRepository->find($id);

        if (empty($operatorScheme)) {
            Flash::error('Operator Scheme not found');

            return redirect(route('operatorSchemes.index'));
        }

        return view('operator_schemes.edit')->with('operatorScheme', $operatorScheme);
    }

    /**
     * Update the specified OperatorScheme in storage.
     *
     * @param  int              $id
     * @param UpdateOperatorSchemeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperatorSchemeRequest $request)
    {
        $operatorScheme = $this->operatorSchemeRepository->find($id);

        if (empty($operatorScheme)) {
            Flash::error('Operator Scheme not found');

            return redirect(route('operatorSchemes.index'));
        }

        $operatorScheme = $this->operatorSchemeRepository->update($request->all(), $id);

        Flash::success('Operator Scheme updated successfully.');
        create_activity('update', 'Operator Scheme');

        return redirect(route('operatorSchemes.index'));
    }

    /**
     * Remove the specified OperatorScheme from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operatorScheme = $this->operatorSchemeRepository->find($id);

        if (empty($operatorScheme)) {
            Flash::error('Operator Scheme not found');

            return redirect(route('operatorSchemes.index'));
        }

        $this->operatorSchemeRepository->delete($id);

        Flash::success('Operator Scheme deleted successfully.');
        create_activity('delete', 'Operator Scheme');

        return redirect(route('operatorSchemes.index'));
    }
}
