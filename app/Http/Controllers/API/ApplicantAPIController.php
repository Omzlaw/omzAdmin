<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateApplicantAPIRequest;
use App\Http\Requests\API\UpdateApplicantAPIRequest;
use App\Models\Applicant;
use App\Repositories\ApplicantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ApplicantController
 * @package App\Http\Controllers\API
 */

class ApplicantAPIController extends AppBaseController
{
    /** @var  ApplicantRepository */
    private $applicantRepository;

    public function __construct(ApplicantRepository $applicantRepo)
    {
        $this->applicantRepository = $applicantRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/applicants",
     *      summary="Get a listing of the Applicants.",
     *      tags={"Applicant"},
     *      description="Get all Applicants",
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
     *                  @SWG\Items(ref="#/definitions/Applicant")
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
        $applicants = $this->applicantRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($applicants->toArray(), 'Applicants retrieved successfully');
    }

    /**
     * @param CreateApplicantAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/applicants",
     *      summary="Store a newly created Applicant in storage",
     *      tags={"Applicant"},
     *      description="Store Applicant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Applicant that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Applicant")
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
     *                  ref="#/definitions/Applicant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateApplicantAPIRequest $request)
    {
        $input = $request->all();

        $applicant = $this->applicantRepository->create($input);

        return $this->sendResponse($applicant->toArray(), 'Applicant saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/applicants/{id}",
     *      summary="Display the specified Applicant",
     *      tags={"Applicant"},
     *      description="Get Applicant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Applicant",
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
     *                  ref="#/definitions/Applicant"
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
        /** @var Applicant $applicant */
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            return $this->sendError('Applicant not found');
        }

        return $this->sendResponse($applicant->toArray(), 'Applicant retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateApplicantAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/applicants/{id}",
     *      summary="Update the specified Applicant in storage",
     *      tags={"Applicant"},
     *      description="Update Applicant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Applicant",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Applicant that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Applicant")
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
     *                  ref="#/definitions/Applicant"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateApplicantAPIRequest $request)
    {
        $input = $request->all();

        /** @var Applicant $applicant */
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            return $this->sendError('Applicant not found');
        }

        $applicant = $this->applicantRepository->update($input, $id);

        return $this->sendResponse($applicant->toArray(), 'Applicant updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/applicants/{id}",
     *      summary="Remove the specified Applicant from storage",
     *      tags={"Applicant"},
     *      description="Delete Applicant",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Applicant",
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
        /** @var Applicant $applicant */
        $applicant = $this->applicantRepository->find($id);

        if (empty($applicant)) {
            return $this->sendError('Applicant not found');
        }

        $applicant->delete();

        return $this->sendSuccess('Applicant deleted successfully');
    }
}
