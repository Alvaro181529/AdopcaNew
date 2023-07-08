<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AvatarController extends Controller
{
    private function compressImage($filePath, $size, $quality)
    {
        $image = Image::make(storage_path('app/public/' . $filePath));

        $image->fit($size, $size, function ($constraint) {
            $constraint->upsize();
        });

        return $image->encode('jpg', $quality);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'picture'=>'required|image|max:10240'
        ]);
        $image = Auth::user()->picture;
        Str::startsWith($image, 'profiles') ? Storage::delete('public' . '/' . $image) : $image;

        if ($request->hasFile('picture')) {
            $avatar['picture'] = $request->file('picture')->store('profiles', 'public');

            // Comprimir la imagen
            $compressedImage = $this->compressImage($avatar['picture'], 400, 50);

            // Guardar la imagen comprimida en el disco
            $ImagePath = $avatar['picture'];
            Storage::disk('public')->put($ImagePath, $compressedImage->stream());

            // Actualizar el campo "picture" del usuario con la ruta de la imagen comprimida
            $user = $request->user();
            $user->picture = $ImagePath;
            $user->save();
        }


        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
