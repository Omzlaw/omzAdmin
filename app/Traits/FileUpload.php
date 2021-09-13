<?php

namespace App\Traits;

trait FileUpload
{
    public function Upload($file, $user_name)
    {
        $file_extension = $file->getClientOriginalExtension();
        $file_url = $file->storeAs(
            'public/uploads/' . $user_name . '/' . 'profilepicture',  'profilepicture' . '.' . $file_extension
        );
        $file_path = str_replace('public/', 'storage/', $file_url);
        return $file_path;
    }

}