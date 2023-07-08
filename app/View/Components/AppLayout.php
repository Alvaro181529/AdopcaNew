<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Str;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    private function getFirstNameAndLastName($fullName)
    {

        $nameComplete = explode(' ', $fullName);
        $conteo = count($nameComplete);
        $firstName = $nameComplete[0];
        $lastName = ($conteo == 2) ? $nameComplete[$conteo - 1] : (($conteo > 1) ? $nameComplete[$conteo - 2] : '');
        return [
            'firstName' => $firstName,
            'lastName' => $lastName
        ];
    }
    public function render(): View
    {
        $user = Auth::user();
        $avatar = $user->picture ?? 'https://e7.pngegg.com/pngimages/81/570/png-clipart-profile-logo-computer-icons-user-user-blue-heroes-thumbnail.png';
        $picture = Str::startsWith($avatar, 'profiles') ? asset('storage') . '/' . $avatar : $avatar;
        $email = !empty($user->google_id) ? substr(explode('@', $user->email)[0], 0, 0) . str_repeat('*', strlen(explode('@', $user->email)[0])) . '@' . explode('@', $user->email)[1] : $user->email;
        $name = strtoupper($user->name);
        $nameData = $this->getFirstNameAndLastName($name);
        $firstName = $nameData['firstName'];
        $lastName = $nameData['lastName'];

        return view('layouts.app')->with([
            'picture' => $picture,
            'email' => $email,
            'name' => $firstName,
            'last' => $lastName
        ]);
    }
}
