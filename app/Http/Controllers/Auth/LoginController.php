<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\SocialType\Services\SocialTypeServiceInterface;
use App\User\Services\UserServiceInterface;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * @var UserServiceInterface
     */
    private $userService;
    /**
     * @var SocialTypeServiceInterface
     */
    private $socialTypeService;


    /**
     * Create a new controller instance.
     * @param UserServiceInterface $userService
     * @param SocialTypeServiceInterface $socialTypeService
     */
    public function __construct(UserServiceInterface $userService, SocialTypeServiceInterface $socialTypeService)
    {
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
        $this->socialTypeService = $socialTypeService;
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login', ['social_types' => $this->socialTypeService->getAll()]);
    }

    /**
     * Redirect the user to the authentication page.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(string $provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        if ($socialUser) {
            $user = $this->userService->findOrCreateFromSocial($socialUser, $provider);
            Auth::login($user);
        }

        return redirect(route('login'));
    }

}
