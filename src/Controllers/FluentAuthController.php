<?php

namespace Iluminar\Fluent\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Iluminar\Fluent\Core\Authenticate;

class FluentAuthController extends Controller
{
    protected $request;
    protected $model;
    protected $modelName;
    protected $modelNamespace;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->modelNamespace = ucfirst(Config::get('fluent.user_model_namespace', 'app'));
        $this->modelName = $this->modelNamespace.'\\'.ucfirst(Config::get('fluent.user_model', 'user'));
        $this->model = new  $this->modelName();
    }

    public function redirect()
    {
        $authenticate = new Authenticate($this->request);

        return $authenticate->redirect();
    }

    public function callback()
    {
        try {
            $authenticate = new Authenticate($this->request);
            $user = $authenticate->user();
            $authUser = $this->findOrCreateUser($user);
            Auth::login($authUser, true);

            return redirect('/');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Return user if exists; create and return if doesn't.
     *
     * @param $twitterUser
     *
     * @return User
     */
    private function findOrCreateUser($fbUser)
    {
        $authUser = $this->model->where('fb_id', $fbUser['id'])->first();

        if ($authUser) {
            if($authUser->token != $fbUser['token']) {
                $authUser->token = $fbUser['token'];
                $authUser->save();
            }
            return $authUser;
        }
        $user = new $this->model();
        $user->name = $fbUser['name'];
        $user->token = $fbUser['token'];
        $user->refresh_token = $fbUser['refreshToken'];
        $user->expires_in = $fbUser['expiresIn'];
        $user->fb_id = $fbUser['id'];
        $user->save();

        return $user;
    }
}
