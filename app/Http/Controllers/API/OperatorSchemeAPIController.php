<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperatorSchemeAPIRequest;
use App\Http\Requests\API\UpdateOperatorSchemeAPIRequest;
use App\Models\OperatorScheme;
use App\Repositories\OperatorSchemeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OperatorSchemeController
 * @package App\Http\Controllers\API
 */

class OperatorSchemeAPIController extends AppBaseController
{
    /** @var  OperatorSchemeRepository */
    private $operatorSchemeRepository;

    public function __construct(OperatorSchemeRepository $operatorSchemeRepo)
    {
        $this->operatorSchemeRepository = $operatorSchemeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorSchemes",
     *      summary="Get a listing of the OperatorSchemes.",
     *      tags={"OperatorScheme"},
     *      description="Get all OperatorSchemes",
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
     *                  @SWG\Items(ref="#/definitions/OperatorScheme")
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
        $operatorSchemes = $this->operatorSchemeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($operatorSchemes->toArray(), 'Operator Schemes retrieved successfully');
    }

    /**
     * @param CreateOperatorSchemeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/operatorSchemes",
     *      summary="Store a newly created OperatorScheme in storage",
     *      tags={"OperatorScheme"},
     *      description="Store OperatorScheme",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorScheme that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorScheme")
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
     *                  ref="#/definitions/OperatorScheme"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOperatorSchemeAPIRequest $request)
    {
        $input = $request->all();

        $operatorScheme = $this->operatorSchemeRepository->create($input);

        return $this->sendResponse($operatorScheme->toArray(), 'Operator Scheme saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/operatorSchemes/{id}",
     *      summary="Display the specified OperatorScheme",
     *      tags={"OperatorScheme"},
     *      description="Get OperatorScheme",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorScheme",
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
     *                  ref="#/definitions/OperatorScheme"
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
        /** @var OperatorScheme $operatorScheme */
        $operatorScheme = $this->operatorSchemeRepository->find($id);

        if (empty($operatorScheme)) {
            return $this->sendError('Operator Scheme not found');
        }

        return $this->sendResponse($operatorScheme->toArray(), 'Operator Scheme retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOperatorSchemeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/operatorSchemes/{id}",
     *      summary="Update the specified OperatorScheme in storage",
     *      tags={"OperatorScheme"},
     *      description="Update OperatorScheme",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorScheme",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="OperatorScheme that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/OperatorScheme")
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
     *                  ref="#/definitions/OperatorScheme"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOperatorSchemeAPIRequest $request)
    {
        $input = $request->all();

        /** @var OperatorScheme $operatorScheme */
        $operatorScheme = $this->operatorSchemeRepository->find($id);

        if (empty($operatorScheme)) {
            return $this->sendError('Operator Scheme not found');
        }

        $operatorScheme = $this->operatorSchemeRepository->update($input, $id);

        return $this->sendResponse($operatorScheme->toArray(), 'OperatorScheme updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/operatorSchemes/{id}",
     *      summary="Remove the specified OperatorScheme from storage",
     *      tags={"OperatorScheme"},
     *      description="Delete OperatorScheme",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of OperatorScheme",
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
        /** @var OperatorScheme $operatorScheme */
        $operatorScheme = $this->operatorSchemeRepository->find($id);

        if (empty($operatorScheme)) {
            return $this->sendError('Operator Scheme not found');
        }

        $operatorScheme->delete();

        return $this->sendSuccess('Operator Scheme deleted successfully');
    }
}
