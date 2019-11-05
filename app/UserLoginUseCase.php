<?php
/**
 * Created by PhpStorm.
 * User: shayanadc
 * Date: 11/5/19
 * Time: 11:48 AM
 */

namespace App;


class UserLoginUseCase
{
    public function __construct(UserLoginPresenter $presenter)
    {
        $this->presenter = $presenter;
    }
    public function __invoke(array $attributes){
        try{
            $user = User::isExist($attributes['email'])->firstOrFail();
            $user->verifyPasswordOrThrowException($attributes['password']);
            $output['api_token'] = $user->api_token;
            return $this->presenter->present($output);
        }catch (\Exception $exception){
            return $this->presenter->presentException($exception);
        }
    }

}