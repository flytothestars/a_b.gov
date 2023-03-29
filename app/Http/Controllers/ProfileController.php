<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Repositories\IIndustryRepository;
use App\Repositories\INewsCategoryRepository;
use App\Repositories\INewsRepository;
use App\Repositories\IProfileRepository;
use App\Repositories\IServiceGroupRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $profileRepository;
    private $industryRepository;

    public function __construct(IProfileRepository $profileRepository, IIndustryRepository $industryRepository)
    {
        $this->profileRepository = $profileRepository;
        $this->industryRepository = $industryRepository;
    }

    public function index()
    {
        $profile = Auth::user()->profile;

        if (optional($profile)->first_name) {
            return redirect()->route('appeals.index');
        } else {
            return redirect()->route('profile.info');
        }
    }

    public function info()
    {
        $profile = Auth::user()->profile;
        $industryList = $this->industryRepository->all();

        return view('client.profile.index')
            ->with('profile', $profile)
            ->with('prof_active', true)
            ->with('industryList', $industryList);
    }

    public function store(ProfileRequest $request)
    {
        $profile = Auth::user()->profile;


        $this->profileRepository->update($profile->id, $request->validated());
        $name = $request->validated()['last_name'].' '.$request->validated()['first_name'].' '.$request->validated()['second_name'];
        $user = User::find(auth()->user()->id);
        $user->name = $name;
        $user->email = $request->validated()['email'];
        $user->update();
        return response([
            'message' => trans('messages.pages.Profile.yourPasswordHasBeenChanged')
        ]);
    }
}
