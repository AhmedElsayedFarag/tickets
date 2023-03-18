<?php


namespace App\Actions;


use App\Models\User;

class GetUserEmployees extends Action
{
    public function __invoke()
    {
        return match (auth()->user()->getRoleNames()[0]) {
            'admin' => User::with(['department','roles'])->role(['employee'])->latest()->get(),
            default => [],
        };
    }
}
