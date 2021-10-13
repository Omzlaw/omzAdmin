<?php

namespace App\Http\Controllers;

use App\DataTables\MonitoringLogDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMonitoringLogRequest;
use App\Http\Requests\UpdateMonitoringLogRequest;
use App\Repositories\MonitoringLogRepository;

use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MonitoringLogController extends AppBaseController
{
    /** @var  MonitoringLogRepository */
    private $monitoringLogRepository;

    public function __construct(MonitoringLogRepository $monitoringLogRepo)
    {
        $this->monitoringLogRepository = $monitoringLogRepo;
    }

    /**
     * Display a listing of the MonitoringLog.
     *
     * @param MonitoringLogDataTable $monitoringLogDataTable
     * @return Response
     */
    public function index(MonitoringLogDataTable $monitoringLogDataTable)
    {
        return $monitoringLogDataTable->render('monitoring_logs.index');
    }

    /**
     * Show the form for creating a new MonitoringLog.
     *
     * @return Response
     */
    public function create()
    {
        return view('monitoring_logs.create');
    }

    /**
     * Store a newly created MonitoringLog in storage.
     *
     * @param CreateMonitoringLogRequest $request
     *
     * @return Response
     */
    public function store(CreateMonitoringLogRequest $request)
    {
        $input = $request->all();

        $monitoringLog = $this->monitoringLogRepository->create($input);

        Flash::success('Monitoring Log saved successfully.');
        create_activity('create', 'Monitoring Log');

        return redirect(route('monitoringLogs.index'));
    }

    /**
     * Display the specified MonitoringLog.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $monitoringLog = $this->monitoringLogRepository->find($id);

        if (empty($monitoringLog)) {
            Flash::error('Monitoring Log not found');

            return redirect(route('monitoringLogs.index'));
        }

        return view('monitoring_logs.show')->with('monitoringLog', $monitoringLog);
    }

    /**
     * Show the form for editing the specified MonitoringLog.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $monitoringLog = $this->monitoringLogRepository->find($id);

        if (empty($monitoringLog)) {
            Flash::error('Monitoring Log not found');

            return redirect(route('monitoringLogs.index'));
        }

        return view('monitoring_logs.edit')->with('monitoringLog', $monitoringLog);
    }

    /**
     * Update the specified MonitoringLog in storage.
     *
     * @param  int              $id
     * @param UpdateMonitoringLogRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMonitoringLogRequest $request)
    {
        $monitoringLog = $this->monitoringLogRepository->find($id);

        if (empty($monitoringLog)) {
            Flash::error('Monitoring Log not found');

            return redirect(route('monitoringLogs.index'));
        }

        $monitoringLog = $this->monitoringLogRepository->update($request->all(), $id);

        Flash::success('Monitoring Log updated successfully.');
        create_activity('update', 'Monitoring Log');

        return redirect(route('monitoringLogs.index'));
    }

    /**
     * Remove the specified MonitoringLog from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $monitoringLog = $this->monitoringLogRepository->find($id);

        if (empty($monitoringLog)) {
            Flash::error('Monitoring Log not found');

            return redirect(route('monitoringLogs.index'));
        }

        $this->monitoringLogRepository->delete($id);

        Flash::success('Monitoring Log deleted successfully.');
        create_activity('delete', 'Monitoring Log');

        return redirect(route('monitoringLogs.index'));
    }
}
