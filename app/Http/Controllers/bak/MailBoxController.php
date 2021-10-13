<?php

namespace App\Http\Controllers;

use App\DataTables\MailBoxDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMailBoxRequest;
use App\Http\Requests\UpdateMailBoxRequest;
use App\Repositories\MailBoxRepository;

use Laracasts\Flash\Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MailBoxController extends AppBaseController
{
    /** @var  MailBoxRepository */
    private $mailBoxRepository;

    public function __construct(MailBoxRepository $mailBoxRepo)
    {
        $this->mailBoxRepository = $mailBoxRepo;
    }

    /**
     * Display a listing of the MailBox.
     *
     * @param MailBoxDataTable $mailBoxDataTable
     * @return Response
     */
    public function index(MailBoxDataTable $mailBoxDataTable)
    {
        return $mailBoxDataTable->render('mail_boxes.index');
    }

    /**
     * Show the form for creating a new MailBox.
     *
     * @return Response
     */
    public function create()
    {
        return view('mail_boxes.create');
    }

    /**
     * Store a newly created MailBox in storage.
     *
     * @param CreateMailBoxRequest $request
     *
     * @return Response
     */
    public function store(CreateMailBoxRequest $request)
    {
        $input = $request->all();

        $mailBox = $this->mailBoxRepository->create($input);

        Flash::success('Mail Box saved successfully.');
        create_activity('create', 'Mail Box');

        return redirect(route('mailBoxes.index'));
    }

    /**
     * Display the specified MailBox.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mailBox = $this->mailBoxRepository->find($id);

        if (empty($mailBox)) {
            Flash::error('Mail Box not found');

            return redirect(route('mailBoxes.index'));
        }

        return view('mail_boxes.show')->with('mailBox', $mailBox);
    }

    /**
     * Show the form for editing the specified MailBox.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mailBox = $this->mailBoxRepository->find($id);

        if (empty($mailBox)) {
            Flash::error('Mail Box not found');

            return redirect(route('mailBoxes.index'));
        }

        return view('mail_boxes.edit')->with('mailBox', $mailBox);
    }

    /**
     * Update the specified MailBox in storage.
     *
     * @param  int              $id
     * @param UpdateMailBoxRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMailBoxRequest $request)
    {
        $mailBox = $this->mailBoxRepository->find($id);

        if (empty($mailBox)) {
            Flash::error('Mail Box not found');

            return redirect(route('mailBoxes.index'));
        }

        $mailBox = $this->mailBoxRepository->update($request->all(), $id);

        Flash::success('Mail Box updated successfully.');
        create_activity('update', 'Mail Box');

        return redirect(route('mailBoxes.index'));
    }

    /**
     * Remove the specified MailBox from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mailBox = $this->mailBoxRepository->find($id);

        if (empty($mailBox)) {
            Flash::error('Mail Box not found');

            return redirect(route('mailBoxes.index'));
        }

        $this->mailBoxRepository->delete($id);

        Flash::success('Mail Box deleted successfully.');
        create_activity('delete', 'Mail Box');

        return redirect(route('mailBoxes.index'));
    }
}
