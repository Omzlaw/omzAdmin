<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMailBoxAPIRequest;
use App\Http\Requests\API\UpdateMailBoxAPIRequest;
use App\Models\MailBox;
use App\Repositories\MailBoxRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MailBoxController
 * @package App\Http\Controllers\API
 */

class MailBoxAPIController extends AppBaseController
{
    /** @var  MailBoxRepository */
    private $mailBoxRepository;

    public function __construct(MailBoxRepository $mailBoxRepo)
    {
        $this->mailBoxRepository = $mailBoxRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/mailBoxes",
     *      summary="Get a listing of the MailBoxes.",
     *      tags={"MailBox"},
     *      description="Get all MailBoxes",
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
     *                  @SWG\Items(ref="#/definitions/MailBox")
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
        $mailBoxes = $this->mailBoxRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($mailBoxes->toArray(), 'Mail Boxes retrieved successfully');
    }

    /**
     * @param CreateMailBoxAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/mailBoxes",
     *      summary="Store a newly created MailBox in storage",
     *      tags={"MailBox"},
     *      description="Store MailBox",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MailBox that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MailBox")
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
     *                  ref="#/definitions/MailBox"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateMailBoxAPIRequest $request)
    {
        $input = $request->all();

        $mailBox = $this->mailBoxRepository->create($input);

        return $this->sendResponse($mailBox->toArray(), 'Mail Box saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/mailBoxes/{id}",
     *      summary="Display the specified MailBox",
     *      tags={"MailBox"},
     *      description="Get MailBox",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MailBox",
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
     *                  ref="#/definitions/MailBox"
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
        /** @var MailBox $mailBox */
        $mailBox = $this->mailBoxRepository->find($id);

        if (empty($mailBox)) {
            return $this->sendError('Mail Box not found');
        }

        return $this->sendResponse($mailBox->toArray(), 'Mail Box retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateMailBoxAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/mailBoxes/{id}",
     *      summary="Update the specified MailBox in storage",
     *      tags={"MailBox"},
     *      description="Update MailBox",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MailBox",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="MailBox that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/MailBox")
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
     *                  ref="#/definitions/MailBox"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateMailBoxAPIRequest $request)
    {
        $input = $request->all();

        /** @var MailBox $mailBox */
        $mailBox = $this->mailBoxRepository->find($id);

        if (empty($mailBox)) {
            return $this->sendError('Mail Box not found');
        }

        $mailBox = $this->mailBoxRepository->update($input, $id);

        return $this->sendResponse($mailBox->toArray(), 'MailBox updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/mailBoxes/{id}",
     *      summary="Remove the specified MailBox from storage",
     *      tags={"MailBox"},
     *      description="Delete MailBox",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of MailBox",
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
        /** @var MailBox $mailBox */
        $mailBox = $this->mailBoxRepository->find($id);

        if (empty($mailBox)) {
            return $this->sendError('Mail Box not found');
        }

        $mailBox->delete();

        return $this->sendSuccess('Mail Box deleted successfully');
    }
}
