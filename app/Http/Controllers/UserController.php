<?php

namespace App\Http\Controllers;

use Response;
use App\Traits\FileUpload;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\DataTables\UserDataTable;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\GeneralNotification;
use App\Http\Controllers\AppBaseController;


class UserController extends AppBaseController
{
    /** @var $userRepository UserRepository */
    private $userRepository;
    use FileUpload;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        $user = Auth::user();
        if (!$user->hasRole('superadministrator')) {
            Flash::error('Permission Denied');
            return redirect()->back();
        }
        return $userDataTable->render('users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user->hasRole('superadministrator')) {
            Flash::error('Permission Denied');
            return redirect()->back();
        }
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = Auth::user();
        if (!$user->hasRole('superadministrator')) {
            Flash::error('Permission Denied');
            return redirect()->back();
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = $this->userRepository->create($this->saveProfilePicture($input));

        Flash::success('User saved successfully.');
        $notification = "A new user was created successfully";
        $user_active = Auth::user();
        $user_active->notify(new GeneralNotification($notification));
        create_activity('create', 'User');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = Auth::user();
        if (!$user->hasRole('superadministrator')) {
            if ($id != $user->id) {
                Flash::error('Permission Denied');
                return redirect()->back();
            }
        }
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if (!$user->hasRole('superadministrator')) {
            if ($id != $user->id) {
                Flash::error('Permission Denied');
                return redirect()->back();
            }
        }
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = Auth::user();
        if (!$user->hasRole('superadministrator')) {
            if ($id != $user->id) {
                Flash::error('Permission Denied');
                return redirect()->back();
            }
        }
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $input =  $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
        $user = $this->userRepository->update($this->saveProfilePicture($input), $id);

        Flash::success('User updated successfully.');
        create_activity('update', 'User');

        if(!$user->hasRole('superadministrator')){
            return redirect(route('users.show', $user->id));
        }

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user->hasRole('superadministrator')) {
            Flash::error('Permission Denied');
            return redirect()->back();
        }
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $profile_picture_path = str_replace('storage/', 'public/', $user->profile_picture_path);
        Storage::delete($profile_picture_path);

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');
        create_activity('delete', 'User');

        return redirect(route('users.index'));
    }

    public function saveProfilePicture($input)
    {
        if(isset($input['profile_picture'])){
            $file = $input['profile_picture'];
            $user_name = Auth::user()->name;
    
            $profile_picture_path = $this->Upload($file, $user_name);
            $input['profile_picture_path'] = $profile_picture_path;
            return $input;
        }
        return $input;

    }
}
