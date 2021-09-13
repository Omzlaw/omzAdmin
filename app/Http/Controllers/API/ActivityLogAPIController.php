<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateActivityLogAPIRequest;
use App\Http\Requests\API\UpdateActivityLogAPIRequest;
use App\Models\ActivityLog;
use App\Repositories\ActivityLogRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ActivityLogController
 * @package App\Http\Controllers\API
 */

class ActivityLogAPIController extends AppBaseController
{
    /** @var  ActivityLogRepository */
    private $activityLogRepository;

    public function __construct(ActivityLogRepository $activityLogRepo)
    {
        $this->activityLogRepository = $activityLogRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/activityLogs",
     *      summary="Get a listing of the ActivityLogs.",
     *      tags={"ActivityLog"},
     *      description="Get all ActivityLogs",
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
     *                  @SWG\Items(ref="#/definitions/ActivityLog")
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
        $activityLogs = $this->activityLogRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($activityLogs->toArray(), 'Activity Logs retrieved successfully');
    }

    /**
     * @param CreateActivityLogAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/activityLogs",
     *      summary="Store a newly created ActivityLog in storage",
     *      tags={"ActivityLog"},
     *      description="Store ActivityLog",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ActivityLog that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActivityLog")
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
     *                  ref="#/definitions/ActivityLog"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateActivityLogAPIRequest $request)
    {
        $input = $request->all();

        $activityLog = $this->activityLogRepository->create($input);

        return $this->sendResponse($activityLog->toArray(), 'Activity Log saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/activityLogs/{id}",
     *      summary="Display the specified ActivityLog",
     *      tags={"ActivityLog"},
     *      description="Get ActivityLog",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActivityLog",
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
     *                  ref="#/definitions/ActivityLog"
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
        /** @var ActivityLog $activityLog */
        $activityLog = $this->activityLogRepository->find($id);

        if (empty($activityLog)) {
            return $this->sendError('Activity Log not found');
        }

        return $this->sendResponse($activityLog->toArray(), 'Activity Log retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateActivityLogAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/activityLogs/{id}",
     *      summary="Update the specified ActivityLog in storage",
     *      tags={"ActivityLog"},
     *      description="Update ActivityLog",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActivityLog",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="ActivityLog that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/ActivityLog")
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
     *                  ref="#/definitions/ActivityLog"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateActivityLogAPIRequest $request)
    {
        $input = $request->all();

        /** @var ActivityLog $activityLog */
        $activityLog = $this->activityLogRepository->find($id);

        if (empty($activityLog)) {
            return $this->sendError('Activity Log not found');
        }

        $activityLog = $this->activityLogRepository->update($input, $id);

        return $this->sendResponse($activityLog->toArray(), 'ActivityLog updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/activityLogs/{id}",
     *      summary="Remove the specified ActivityLog from storage",
     *      tags={"ActivityLog"},
     *      description="Delete ActivityLog",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of ActivityLog",
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
        /** @var ActivityLog $activityLog */
        $activityLog = $this->activityLogRepository->find($id);

        if (empty($activityLog)) {
            return $this->sendError('Activity Log not found');
        }

        $activityLog->delete();

        return $this->sendSuccess('Activity Log deleted successfully');
    }
}
