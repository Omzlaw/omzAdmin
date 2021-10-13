<?php

namespace App\Http\Controllers;

use App\DataTables\OperatorLicenseDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOperatorLicenseRequest;
use App\Http\Requests\UpdateOperatorLicenseRequest;
use App\Repositories\OperatorLicenseRepository;

use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OperatorLicenseController extends AppBaseController
{
    /** @var  OperatorLicenseRepository */
    private $operatorLicenseRepository;

    public function __construct(OperatorLicenseRepository $operatorLicenseRepo)
    {
        $this->operatorLicenseRepository = $operatorLicenseRepo;
    }

    /**
     * Display a listing of the OperatorLicense.
     *
     * @param OperatorLicenseDataTable $operatorLicenseDataTable
     * @return Response
     */
    public function index(OperatorLicenseDataTable $operatorLicenseDataTable)
    {
        return $operatorLicenseDataTable->render('operator_licenses.index');
    }

    /**
     * Show the form for creating a new OperatorLicense.
     *
     * @return Response
     */
    public function create()
    {
        return view('operator_licenses.create');
    }

    /**
     * Store a newly created OperatorLicense in storage.
     *
     * @param CreateOperatorLicenseRequest $request
     *
     * @return Response
     */
    public function store(CreateOperatorLicenseRequest $request)
    {
        $input = $request->all();

        $operatorLicense = $this->operatorLicenseRepository->create($input);

        Flash::success('Operator License saved successfully.');
        create_activity('create', 'Operator License');

        return redirect(route('operatorLicenses.index'));
    }

    /**
     * Display the specified OperatorLicense.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operatorLicense = $this->operatorLicenseRepository->find($id);

        if (empty($operatorLicense)) {
            Flash::error('Operator License not found');

            return redirect(route('operatorLicenses.index'));
        }

        return view('operator_licenses.show')->with('operatorLicense', $operatorLicense);
    }

    /**
     * Show the form for editing the specified OperatorLicense.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $operatorLicense = $this->operatorLicenseRepository->find($id);

        if (empty($operatorLicense)) {
            Flash::error('Operator License not found');

            return redirect(route('operatorLicenses.index'));
        }

        return view('operator_licenses.edit')->with('operatorLicense', $operatorLicense);
    }

    /**
     * Update the specified OperatorLicense in storage.
     *
     * @param  int              $id
     * @param UpdateOperatorLicenseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOperatorLicenseRequest $request)
    {
        $operatorLicense = $this->operatorLicenseRepository->find($id);

        if (empty($operatorLicense)) {
            Flash::error('Operator License not found');

            return redirect(route('operatorLicenses.index'));
        }

        $operatorLicense = $this->operatorLicenseRepository->update($request->all(), $id);

        Flash::success('Operator License updated successfully.');
        create_activity('update', 'Operator License');

        return redirect(route('operatorLicenses.index'));
    }

    /**
     * Remove the specified OperatorLicense from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operatorLicense = $this->operatorLicenseRepository->find($id);

        if (empty($operatorLicense)) {
            Flash::error('Operator License not found');

            return redirect(route('operatorLicenses.index'));
        }

        $this->operatorLicenseRepository->delete($id);

        Flash::success('Operator License deleted successfully.');
        create_activity('delete', 'Operator License');

        return redirect(route('operatorLicenses.index'));
    }
}
