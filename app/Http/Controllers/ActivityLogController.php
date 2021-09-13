<?php

namespace App\Http\Controllers;

use Response;
use App\Http\Requests;
use Laracasts\Flash\Flash;
use App\DataTables\ActivityLogDataTable;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ActivityLogRepository;
use App\Http\Requests\CreateActivityLogRequest;
use App\Http\Requests\UpdateActivityLogRequest;

class ActivityLogController extends AppBaseController
{
    /** @var  ActivityLogRepository */
    private $activityLogRepository;

    public function __construct(ActivityLogRepository $activityLogRepo)
    {
        $this->activityLogRepository = $activityLogRepo;
    }

    /**
     * Display a listing of the ActivityLog.
     *
     * @param ActivityLogDataTable $activityLogDataTable
     * @return Response
     */
    public function index(ActivityLogDataTable $activityLogDataTable)
    {
        return $activityLogDataTable->render('activity_logs.index');
    }

    /**
     * Show the form for creating a new ActivityLog.
     *
     * @return Response
     */
    public function create()
    {
        return view('activity_logs.create');
    }

    /**
     * Store a newly created ActivityLog in storage.
     *
     * @param CreateActivityLogRequest $request
     *
     * @return Response
     */
    public function store(CreateActivityLogRequest $request)
    {
        $input = $request->all();

        $activityLog = $this->activityLogRepository->create($input);

        Flash::success('Activity Log saved successfully.');

        return redirect(route('activityLogs.index'));
    }

    /**
     * Display the specified ActivityLog.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $activityLog = $this->activityLogRepository->find($id);

        if (empty($activityLog)) {
            Flash::error('Activity Log not found');

            return redirect(route('activityLogs.index'));
        }

        return view('activity_logs.show')->with('activityLog', $activityLog);
    }

    /**
     * Show the form for editing the specified ActivityLog.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activityLog = $this->activityLogRepository->find($id);

        if (empty($activityLog)) {
            Flash::error('Activity Log not found');

            return redirect(route('activityLogs.index'));
        }

        return view('activity_logs.edit')->with('activityLog', $activityLog);
    }

    /**
     * Update the specified ActivityLog in storage.
     *
     * @param  int              $id
     * @param UpdateActivityLogRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActivityLogRequest $request)
    {
        $activityLog = $this->activityLogRepository->find($id);

        if (empty($activityLog)) {
            Flash::error('Activity Log not found');

            return redirect(route('activityLogs.index'));
        }

        $activityLog = $this->activityLogRepository->update($request->all(), $id);

        Flash::success('Activity Log updated successfully.');

        return redirect(route('activityLogs.index'));
    }

    /**
     * Remove the specified ActivityLog from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $activityLog = $this->activityLogRepository->find($id);

        if (empty($activityLog)) {
            Flash::error('Activity Log not found');

            return redirect(route('activityLogs.index'));
        }

        $this->activityLogRepository->delete($id);

        Flash::success('Activity Log deleted successfully.');

        return redirect(route('activityLogs.index'));
    }
}
