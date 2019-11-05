<?php
/**
 * Created by PhpStorm.
 * User: shayanadc
 * Date: 11/5/19
 * Time: 11:55 AM
 */

namespace App;


class UserLoginPresenter
{
    public function present(array $attributes){
        return response()->json($attributes,200);
    }
    public function presentException(\Exception $exception){
        return response()->json([
               'errors' => [['title' => $exception->getMessage()]]
        ], 400);
    }

}