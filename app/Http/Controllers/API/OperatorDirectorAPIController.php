<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperatorDirectorAPIRequest;
use App\Http\Requests\API\UpdateOperatorDirectorAPIRequest;
use App\Models\OperatorDirector;
use App\Repositories\OperatorDirectorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OperatorDirectorController
 * @package App\Http\Controllers\API
 */

class OperatorDirectorAPIController extends AppBaseController
{
    /** @var  OperatorDirectorRepository */
    private $operatorDirectorRepository;

    public function __construct(OperatorDirectorRepository $operatorDirectorRepo)
    {
        $this->operatorDirectorRepository = $operatorDirectorRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorDirectors",
     *      summary="Get a listing of the OperatorDirectors.",
     *      tags={"OperatorDirector"},
     *      description="Get all OperatorDirectors",
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
     *                  @SWG\Items(ref="#/definitions/OperatorDirector")
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
        $operatorDirectors = $this->operatorDirectorRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($operatorDirectors->toArray(), 'Operator Directors retrieved successfully');
    }

    /**
     * @param CreateOperatorDirectorAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/operatorDirectors",
     *      summary="Store a newly created OperatorDirector in storage",
     *      tags={"OperatorDirector"},
     *      description="Store OperatorDirector",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorDirector that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorDirector")
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
     *                  ref="#/definitions/OperatorDirector"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOperatorDirectorAPIRequest $request)
    {
        $input = $request->all();

        $operatorDirector = $this->operatorDirectorRepository->create($input);

        return $this->sendResponse($operatorDirector->toArray(), 'Operator Director saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorDirectors/{id}",
     *      summary="Display the specified OperatorDirector",
     *      tags={"OperatorDirector"},
     *      description="Get OperatorDirector",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorDirector",
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
     *                  ref="#/definitions/OperatorDirector"
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
        /** @var OperatorDirector $operatorDirector */
        $operatorDirector = $this->operatorDirectorRepository->find($id);

        if (empty($operatorDirector)) {
            return $this->sendError('Operator Director not found');
        }

        return $this->sendResponse($operatorDirector->toArray(), 'Operator Director retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOperatorDirectorAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/operatorDirectors/{id}",
     *      summary="Update the specified OperatorDirector in storage",
     *      tags={"OperatorDirector"},
     *      description="Update OperatorDirector",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorDirector",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorDirector that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorDirector")
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
     *                  ref="#/definitions/OperatorDirector"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOperatorDirectorAPIRequest $request)
    {
        $input = $request->all();

        /** @var OperatorDirector $operatorDirector */
        $operatorDirector = $this->operatorDirectorRepository->find($id);

        if (empty($operatorDirector)) {
            return $this->sendError('Operator Director not found');
        }

        $operatorDirector = $this->operatorDirectorRepository->update($input, $id);

        return $this->sendResponse($operatorDirector->toArray(), 'OperatorDirector updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/operatorDirectors/{id}",
     *      summary="Remove the specified OperatorDirector from storage",
     *      tags={"OperatorDirector"},
     *      description="Delete OperatorDirector",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorDirector",
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
        /** @var OperatorDirector $operatorDirector */
        $operatorDirector = $this->operatorDirectorRepository->find($id);

        if (empty($operatorDirector)) {
            return $this->sendError('Operator Director not found');
        }

        $operatorDirector->delete();

        return $this->sendSuccess('Operator Director deleted successfully');
    }
}
