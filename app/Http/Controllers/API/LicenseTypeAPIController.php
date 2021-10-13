<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLicenseTypeAPIRequest;
use App\Http\Requests\API\UpdateLicenseTypeAPIRequest;
use App\Models\LicenseType;
use App\Repositories\LicenseTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LicenseTypeController
 * @package App\Http\Controllers\API
 */

class LicenseTypeAPIController extends AppBaseController
{
    /** @var  LicenseTypeRepository */
    private $licenseTypeRepository;

    public function __construct(LicenseTypeRepository $licenseTypeRepo)
    {
        $this->licenseTypeRepository = $licenseTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/licenseTypes",
     *      summary="Get a listing of the LicenseTypes.",
     *      tags={"LicenseType"},
     *      description="Get all LicenseTypes",
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
     *                  @SWG\Items(ref="#/definitions/LicenseType")
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
        $licenseTypes = $this->licenseTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($licenseTypes->toArray(), 'License Types retrieved successfully');
    }

    /**
     * @param CreateLicenseTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/licenseTypes",
     *      summary="Store a newly created LicenseType in storage",
     *      tags={"LicenseType"},
     *      description="Store LicenseType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LicenseType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LicenseType")
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
     *                  ref="#/definitions/LicenseType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateLicenseTypeAPIRequest $request)
    {
        $input = $request->all();

        $licenseType = $this->licenseTypeRepository->create($input);

        return $this->sendResponse($licenseType->toArray(), 'License Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/licenseTypes/{id}",
     *      summary="Display the specified LicenseType",
     *      tags={"LicenseType"},
     *      description="Get LicenseType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LicenseType",
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
     *                  ref="#/definitions/LicenseType"
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
        /** @var LicenseType $licenseType */
        $licenseType = $this->licenseTypeRepository->find($id);

        if (empty($licenseType)) {
            return $this->sendError('License Type not found');
        }

        return $this->sendResponse($licenseType->toArray(), 'License Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateLicenseTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/licenseTypes/{id}",
     *      summary="Update the specified LicenseType in storage",
     *      tags={"LicenseType"},
     *      description="Update LicenseType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LicenseType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="LicenseType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/LicenseType")
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
     *                  ref="#/definitions/LicenseType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateLicenseTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var LicenseType $licenseType */
        $licenseType = $this->licenseTypeRepository->find($id);

        if (empty($licenseType)) {
            return $this->sendError('License Type not found');
        }

        $licenseType = $this->licenseTypeRepository->update($input, $id);

        return $this->sendResponse($licenseType->toArray(), 'LicenseType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/licenseTypes/{id}",
     *      summary="Remove the specified LicenseType from storage",
     *      tags={"LicenseType"},
     *      description="Delete LicenseType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of LicenseType",
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
        /** @var LicenseType $licenseType */
        $licenseType = $this->licenseTypeRepository->find($id);

        if (empty($licenseType)) {
            return $this->sendError('License Type not found');
        }

        $licenseType->delete();

        return $this->sendSuccess('License Type deleted successfully');
    }
}
