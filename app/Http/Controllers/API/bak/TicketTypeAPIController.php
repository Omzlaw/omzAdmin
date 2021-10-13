<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTicketTypeAPIRequest;
use App\Http\Requests\API\UpdateTicketTypeAPIRequest;
use App\Models\TicketType;
use App\Repositories\TicketTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TicketTypeController
 * @package App\Http\Controllers\API
 */

class TicketTypeAPIController extends AppBaseController
{
    /** @var  TicketTypeRepository */
    private $ticketTypeRepository;

    public function __construct(TicketTypeRepository $ticketTypeRepo)
    {
        $this->ticketTypeRepository = $ticketTypeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/ticketTypes",
     *      summary="Get a listing of the TicketTypes.",
     *      tags={"TicketType"},
     *      description="Get all TicketTypes",
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
     *                  @SWG\Items(ref="#/definitions/TicketType")
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
        $ticketTypes = $this->ticketTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($ticketTypes->toArray(), 'Ticket Types retrieved successfully');
    }

    /**
     * @param CreateTicketTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/ticketTypes",
     *      summary="Store a newly created TicketType in storage",
     *      tags={"TicketType"},
     *      description="Store TicketType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TicketType that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TicketType")
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
     *                  ref="#/definitions/TicketType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTicketTypeAPIRequest $request)
    {
        $input = $request->all();

        $ticketType = $this->ticketTypeRepository->create($input);

        return $this->sendResponse($ticketType->toArray(), 'Ticket Type saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/ticketTypes/{id}",
     *      summary="Display the specified TicketType",
     *      tags={"TicketType"},
     *      description="Get TicketType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TicketType",
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
     *                  ref="#/definitions/TicketType"
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
        /** @var TicketType $ticketType */
        $ticketType = $this->ticketTypeRepository->find($id);

        if (empty($ticketType)) {
            return $this->sendError('Ticket Type not found');
        }

        return $this->sendResponse($ticketType->toArray(), 'Ticket Type retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTicketTypeAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/ticketTypes/{id}",
     *      summary="Update the specified TicketType in storage",
     *      tags={"TicketType"},
     *      description="Update TicketType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TicketType",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TicketType that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TicketType")
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
     *                  ref="#/definitions/TicketType"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTicketTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var TicketType $ticketType */
        $ticketType = $this->ticketTypeRepository->find($id);

        if (empty($ticketType)) {
            return $this->sendError('Ticket Type not found');
        }

        $ticketType = $this->ticketTypeRepository->update($input, $id);

        return $this->sendResponse($ticketType->toArray(), 'TicketType updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/ticketTypes/{id}",
     *      summary="Remove the specified TicketType from storage",
     *      tags={"TicketType"},
     *      description="Delete TicketType",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TicketType",
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
        /** @var TicketType $ticketType */
        $ticketType = $this->ticketTypeRepository->find($id);

        if (empty($ticketType)) {
            return $this->sendError('Ticket Type not found');
        }

        $ticketType->delete();

        return $this->sendSuccess('Ticket Type deleted successfully');
    }
}
