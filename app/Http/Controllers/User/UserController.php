<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('user.index')->withData($this->userService->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = bcrypt($data['password']);
            $data['status'] = isset($data['status']) ? 1 : 0;
            $this->userService->store($data);

            return redirect()->route('user.index')->withSuccess('User created Successfully');
        } catch (\Throwable $th) {
            throw $th;

            return redirect()->back()->withError('user creating error')->withInput($request->validated());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit')->withModel($user)->withRoles(Role::all()->pluck('id', 'name')->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            $data['password'] = isset($data['password']) ? bcrypt($data['password']) : $user->password;
            $data['status'] = isset($data['status']) ? 1 : 0;
            $user->update($data);

            return redirect()->route('user.index')->withSuccess('user Updated Successfully');
        } catch (\Throwable $th) {
            throw $th;

            return redirect()->back()->withError('user Updating error');
        }
    }
}
