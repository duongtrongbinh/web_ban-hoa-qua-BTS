<?php 

namespace App\Traits;
use Storage;
use Illuminate\Support\Str;
class StorageTraits{
    function storageTraitUpload($request, $fieldName, $foderName){
        if($request->hasFile($fieldName)){
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/' . $foderName , $fileNameHash);
            $dataUploadImage = [
                'file_name'=> $fileNameOrigin,
                'file_path'=> Storage::url($filePath)
            ];
            return $dataUploadImage;
        }
        return null;
    }

    function storageTraitUploadMuity($file, $foderName){
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/' . $foderName , $fileNameHash);
            $dataUploadImage = [
                'file_name'=> $fileNameOrigin,
                'file_path'=> Storage::url($filePath)
            ];
            return $dataUploadImage;
    }
}