<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMonitoringLogAPIRequest;
use App\Http\Requests\API\UpdateMonitoringLogAPIRequest;
use App\Models\MonitoringLog;
use App\Repositories\MonitoringLogRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MonitoringLogController
 * @package App\Http\Controllers\API
 */

class MonitoringLogAPIController extends AppBaseController
{
    /** @var  MonitoringLogRepository */
    private $monitoringLogRepository;

    public function __construct(MonitoringLogRepository $monitoringLogRepo)
    {
        $this->monitoringLogRepository = $monitoringLogRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/monitoringLogs",
     *      summary="Get a listing of the MonitoringLogs.",
     *      tags={"MonitoringLog"},
     *      description="Get all MonitoringLogs",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/MonitoringLog")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $monitoringLogs = $this->monitoringLogRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($monitoringLogs->toArray(), 'Monitoring Logs retrieved successfully');
    }

    /**
     * @param CreateMonitoringLogAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/monitoringLogs",
     *      summary="Store a newly created MonitoringLog in storage",
     *      tags={"MonitoringLog"},
     *      description="Store MonitoringLog",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MonitoringLog that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MonitoringLog")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/MonitoringLog"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMonitoringLogAPIRequest $request)
    {
        $input = $request->all();

        $monitoringLog = $this->monitoringLogRepository->create($input);

        return $this->sendResponse($monitoringLog->toArray(), 'Monitoring Log saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/monitoringLogs/{id}",
     *      summary="Display the specified MonitoringLog",
     *      tags={"MonitoringLog"},
     *      description="Get MonitoringLog",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MonitoringLog",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/MonitoringLog"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var MonitoringLog $monitoringLog */
        $monitoringLog = $this->monitoringLogRepository->find($id);

        if (empty($monitoringLog)) {
            return $this->sendError('Monitoring Log not found');
        }

        return $this->sendResponse($monitoringLog->toArray(), 'Monitoring Log retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMonitoringLogAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/monitoringLogs/{id}",
     *      summary="Update the specified MonitoringLog in storage",
     *      tags={"MonitoringLog"},
     *      description="Update MonitoringLog",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MonitoringLog",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MonitoringLog that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MonitoringLog")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/MonitoringLog"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMonitoringLogAPIRequest $request)
    {
        $input = $request->all();

        /** @var MonitoringLog $monitoringLog */
        $monitoringLog = $this->monitoringLogRepository->find($id);

        if (empty($monitoringLog)) {
            return $this->sendError('Monitoring Log not found');
        }

        $monitoringLog = $this->monitoringLogRepository->update($input, $id);

        return $this->sendResponse($monitoringLog->toArray(), 'MonitoringLog updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/monitoringLogs/{id}",
     *      summary="Remove the specified MonitoringLog from storage",
     *      tags={"MonitoringLog"},
     *      description="Delete MonitoringLog",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MonitoringLog",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var MonitoringLog $monitoringLog */
        $monitoringLog = $this->monitoringLogRepository->find($id);

        if (empty($monitoringLog)) {
            return $this->sendError('Monitoring Log not found');
        }

        $monitoringLog->delete();

        return $this->sendSuccess('Monitoring Log deleted successfully');
    }
}
