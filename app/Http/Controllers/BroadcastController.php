<?php

namespace App\Http\Controllers;

use Response;
use App\Models\User;
use App\Http\Requests;
use Laracasts\Flash\Flash;

use App\DataTables\BroadcastDataTable;
use App\Repositories\BroadcastRepository;
use App\Notifications\GeneralNotification;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateBroadcastRequest;
use App\Http\Requests\UpdateBroadcastRequest;
use Notification;

class BroadcastController extends AppBaseController
{
    /** @var  BroadcastRepository */
    private $broadcastRepository;

    public function __construct(BroadcastRepository $broadcastRepo)
    {
        $this->broadcastRepository = $broadcastRepo;
    }

    /**
     * Display a listing of the Broadcast.
     *
     * @param BroadcastDataTable $broadcastDataTable
     * @return Response
     */
    public function index(BroadcastDataTable $broadcastDataTable)
    {
        return $broadcastDataTable->render('broadcasts.index');
    }

    /**
     * Show the form for creating a new Broadcast.
     *
     * @return Response
     */
    public function create()
    {
        return view('broadcasts.create');
    }

    /**
     * Store a newly created Broadcast in storage.
     *
     * @param CreateBroadcastRequest $request
     *
     * @return Response
     */
    public function store(CreateBroadcastRequest $request)
    {
        $input = $request->all();

        $broadcast = $this->broadcastRepository->create($input);

        Flash::success('Broadcast saved successfully.');
        create_activity('create', 'Broadcast');

        $users = User::all();
        $message = 'Code: ' . $broadcast->code . ' Subject: ' . $broadcast->subject . ' Message: ' . $broadcast->message . ' Start: ' . $broadcast->date_start . ' End: ' . $broadcast->date_end;
        Notification::send($users, new GeneralNotification($message));

        return redirect(route('broadcasts.index'));
    }

    /**
     * Display the specified Broadcast.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $broadcast = $this->broadcastRepository->find($id);

        if (empty($broadcast)) {
            Flash::error('Broadcast not found');

            return redirect(route('broadcasts.index'));
        }

        return view('broadcasts.show')->with('broadcast', $broadcast);
    }

    /**
     * Show the form for editing the specified Broadcast.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $broadcast = $this->broadcastRepository->find($id);

        if (empty($broadcast)) {
            Flash::error('Broadcast not found');

            return redirect(route('broadcasts.index'));
        }

        return view('broadcasts.edit')->with('broadcast', $broadcast);
    }

    /**
     * Update the specified Broadcast in storage.
     *
     * @param  int              $id
     * @param UpdateBroadcastRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBroadcastRequest $request)
    {
        $broadcast = $this->broadcastRepository->find($id);

        if (empty($broadcast)) {
            Flash::error('Broadcast not found');

            return redirect(route('broadcasts.index'));
        }

        $broadcast = $this->broadcastRepository->update($request->all(), $id);

        $users = User::all();
        $message = 'Re:Edit ' . 'Code: ' . $broadcast->code . ' Subject: ' . $broadcast->subject . ' Message: ' . $broadcast->message . ' Start: ' . $broadcast->date_start . ' End: ' . $broadcast->date_end;
        Notification::send($users, new GeneralNotification($message));

        Flash::success('Broadcast updated successfully.');
        create_activity('update', 'Broadcast');

        return redirect(route('broadcasts.index'));
    }

    /**
     * Remove the specified Broadcast from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $broadcast = $this->broadcastRepository->find($id);

        if (empty($broadcast)) {
            Flash::error('Broadcast not found');

            return redirect(route('broadcasts.index'));
        }

        $this->broadcastRepository->delete($id);

        Flash::success('Broadcast deleted successfully.');
        create_activity('delete', 'Broadcast');

        return redirect(route('broadcasts.index'));
    }
}
