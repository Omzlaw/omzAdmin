<?php

namespace App\Http\Controllers;

use App\DataTables\LicenseTypeDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLicenseTypeRequest;
use App\Http\Requests\UpdateLicenseTypeRequest;
use App\Repositories\LicenseTypeRepository;

use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class LicenseTypeController extends AppBaseController
{
    /** @var  LicenseTypeRepository */
    private $licenseTypeRepository;

    public function __construct(LicenseTypeRepository $licenseTypeRepo)
    {
        $this->licenseTypeRepository = $licenseTypeRepo;
    }

    /**
     * Display a listing of the LicenseType.
     *
     * @param LicenseTypeDataTable $licenseTypeDataTable
     * @return Response
     */
    public function index(LicenseTypeDataTable $licenseTypeDataTable)
    {
        return $licenseTypeDataTable->render('license_types.index');
    }

    /**
     * Show the form for creating a new LicenseType.
     *
     * @return Response
     */
    public function create()
    {
        return view('license_types.create');
    }

    /**
     * Store a newly created LicenseType in storage.
     *
     * @param CreateLicenseTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateLicenseTypeRequest $request)
    {
        $input = $request->all();

        $licenseType = $this->licenseTypeRepository->create($input);

        Flash::success('License Type saved successfully.');
        create_activity('create', 'License Type');

        return redirect(route('licenseTypes.index'));
    }

    /**
     * Display the specified LicenseType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $licenseType = $this->licenseTypeRepository->find($id);

        if (empty($licenseType)) {
            Flash::error('License Type not found');

            return redirect(route('licenseTypes.index'));
        }

        return view('license_types.show')->with('licenseType', $licenseType);
    }

    /**
     * Show the form for editing the specified LicenseType.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $licenseType = $this->licenseTypeRepository->find($id);

        if (empty($licenseType)) {
            Flash::error('License Type not found');

            return redirect(route('licenseTypes.index'));
        }

        return view('license_types.edit')->with('licenseType', $licenseType);
    }

    /**
     * Update the specified LicenseType in storage.
     *
     * @param  int              $id
     * @param UpdateLicenseTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLicenseTypeRequest $request)
    {
        $licenseType = $this->licenseTypeRepository->find($id);

        if (empty($licenseType)) {
            Flash::error('License Type not found');

            return redirect(route('licenseTypes.index'));
        }

        $licenseType = $this->licenseTypeRepository->update($request->all(), $id);

        Flash::success('License Type updated successfully.');
        create_activity('update', 'License Type');

        return redirect(route('licenseTypes.index'));
    }

    /**
     * Remove the specified LicenseType from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $licenseType = $this->licenseTypeRepository->find($id);

        if (empty($licenseType)) {
            Flash::error('License Type not found');

            return redirect(route('licenseTypes.index'));
        }

        $this->licenseTypeRepository->delete($id);

        Flash::success('License Type deleted successfully.');
        create_activity('delete', 'License Type');

        return redirect(route('licenseTypes.index'));
    }
}
