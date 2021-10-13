<?php

namespace App\Http\Controllers;

use App\DataTables\LicenseChecklistDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLicenseChecklistRequest;
use App\Http\Requests\UpdateLicenseChecklistRequest;
use App\Repositories\LicenseChecklistRepository;

use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class LicenseChecklistController extends AppBaseController
{
    /** @var  LicenseChecklistRepository */
    private $licenseChecklistRepository;

    public function __construct(LicenseChecklistRepository $licenseChecklistRepo)
    {
        $this->licenseChecklistRepository = $licenseChecklistRepo;
    }

    /**
     * Display a listing of the LicenseChecklist.
     *
     * @param LicenseChecklistDataTable $licenseChecklistDataTable
     * @return Response
     */
    public function index(LicenseChecklistDataTable $licenseChecklistDataTable)
    {
        return $licenseChecklistDataTable->render('license_checklists.index');
    }

    /**
     * Show the form for creating a new LicenseChecklist.
     *
     * @return Response
     */
    public function create()
    {
        return view('license_checklists.create');
    }

    /**
     * Store a newly created LicenseChecklist in storage.
     *
     * @param CreateLicenseChecklistRequest $request
     *
     * @return Response
     */
    public function store(CreateLicenseChecklistRequest $request)
    {
        $input = $request->all();

        $licenseChecklist = $this->licenseChecklistRepository->create($input);

        Flash::success('License Checklist saved successfully.');
        create_activity('create', 'License Checklist');

        return redirect(route('licenseChecklists.index'));
    }

    /**
     * Display the specified LicenseChecklist.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $licenseChecklist = $this->licenseChecklistRepository->find($id);

        if (empty($licenseChecklist)) {
            Flash::error('License Checklist not found');

            return redirect(route('licenseChecklists.index'));
        }

        return view('license_checklists.show')->with('licenseChecklist', $licenseChecklist);
    }

    /**
     * Show the form for editing the specified LicenseChecklist.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $licenseChecklist = $this->licenseChecklistRepository->find($id);

        if (empty($licenseChecklist)) {
            Flash::error('License Checklist not found');

            return redirect(route('licenseChecklists.index'));
        }

        return view('license_checklists.edit')->with('licenseChecklist', $licenseChecklist);
    }

    /**
     * Update the specified LicenseChecklist in storage.
     *
     * @param  int              $id
     * @param UpdateLicenseChecklistRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLicenseChecklistRequest $request)
    {
        $licenseChecklist = $this->licenseChecklistRepository->find($id);

        if (empty($licenseChecklist)) {
            Flash::error('License Checklist not found');

            return redirect(route('licenseChecklists.index'));
        }

        $licenseChecklist = $this->licenseChecklistRepository->update($request->all(), $id);

        Flash::success('License Checklist updated successfully.');
        create_activity('update', 'License Checklist');

        return redirect(route('licenseChecklists.index'));
    }

    /**
     * Remove the specified LicenseChecklist from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $licenseChecklist = $this->licenseChecklistRepository->find($id);

        if (empty($licenseChecklist)) {
            Flash::error('License Checklist not found');

            return redirect(route('licenseChecklists.index'));
        }

        $this->licenseChecklistRepository->delete($id);

        Flash::success('License Checklist deleted successfully.');
        create_activity('delete', 'License Checklist');

        return redirect(route('licenseChecklists.index'));
    }
}
