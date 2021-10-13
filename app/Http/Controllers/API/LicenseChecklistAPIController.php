<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLicenseChecklistAPIRequest;
use App\Http\Requests\API\UpdateLicenseChecklistAPIRequest;
use App\Models\LicenseChecklist;
use App\Repositories\LicenseChecklistRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LicenseChecklistController
 * @package App\Http\Controllers\API
 */

class LicenseChecklistAPIController extends AppBaseController
{
    /** @var  LicenseChecklistRepository */
    private $licenseChecklistRepository;

    public function __construct(LicenseChecklistRepository $licenseChecklistRepo)
    {
        $this->licenseChecklistRepository = $licenseChecklistRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/licenseChecklists",
     *      summary="Get a listing of the LicenseChecklists.",
     *      tags={"LicenseChecklist"},
     *      description="Get all LicenseChecklists",
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
     *                  @SWG\Items(ref="#/definitions/LicenseChecklist")
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
        $licenseChecklists = $this->licenseChecklistRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($licenseChecklists->toArray(), 'License Checklists retrieved successfully');
    }

    /**
     * @param CreateLicenseChecklistAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/licenseChecklists",
     *      summary="Store a newly created LicenseChecklist in storage",
     *      tags={"LicenseChecklist"},
     *      description="Store LicenseChecklist",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LicenseChecklist that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LicenseChecklist")
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
     *                  ref="#/definitions/LicenseChecklist"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLicenseChecklistAPIRequest $request)
    {
        $input = $request->all();

        $licenseChecklist = $this->licenseChecklistRepository->create($input);

        return $this->sendResponse($licenseChecklist->toArray(), 'License Checklist saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/licenseChecklists/{id}",
     *      summary="Display the specified LicenseChecklist",
     *      tags={"LicenseChecklist"},
     *      description="Get LicenseChecklist",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LicenseChecklist",
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
     *                  ref="#/definitions/LicenseChecklist"
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
        /** @var LicenseChecklist $licenseChecklist */
        $licenseChecklist = $this->licenseChecklistRepository->find($id);

        if (empty($licenseChecklist)) {
            return $this->sendError('License Checklist not found');
        }

        return $this->sendResponse($licenseChecklist->toArray(), 'License Checklist retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLicenseChecklistAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/licenseChecklists/{id}",
     *      summary="Update the specified LicenseChecklist in storage",
     *      tags={"LicenseChecklist"},
     *      description="Update LicenseChecklist",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LicenseChecklist",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LicenseChecklist that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LicenseChecklist")
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
     *                  ref="#/definitions/LicenseChecklist"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLicenseChecklistAPIRequest $request)
    {
        $input = $request->all();

        /** @var LicenseChecklist $licenseChecklist */
        $licenseChecklist = $this->licenseChecklistRepository->find($id);

        if (empty($licenseChecklist)) {
            return $this->sendError('License Checklist not found');
        }

        $licenseChecklist = $this->licenseChecklistRepository->update($input, $id);

        return $this->sendResponse($licenseChecklist->toArray(), 'LicenseChecklist updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/licenseChecklists/{id}",
     *      summary="Remove the specified LicenseChecklist from storage",
     *      tags={"LicenseChecklist"},
     *      description="Delete LicenseChecklist",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LicenseChecklist",
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
        /** @var LicenseChecklist $licenseChecklist */
        $licenseChecklist = $this->licenseChecklistRepository->find($id);

        if (empty($licenseChecklist)) {
            return $this->sendError('License Checklist not found');
        }

        $licenseChecklist->delete();

        return $this->sendSuccess('License Checklist deleted successfully');
    }
}
