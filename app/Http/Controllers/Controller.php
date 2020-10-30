<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use File;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function uploadFile(Request $request, $fileName,  $path, $old_path){        
        if(File::exists(public_path($old_path))) {
            File::delete(public_path($old_path));
        }
        $file = $request->file($fileName);
        $uploadedFileName = time()."_".$fileName.".".$file->getClientOriginalExtension();
        $file->move($path,  $uploadedFileName);
        return $uploadedFileName;
    }

}
