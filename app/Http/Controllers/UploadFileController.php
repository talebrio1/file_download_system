<?php

namespace App\Http\Controllers;

use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadFileController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required',
            'file' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->hasFile('file')){

            if(Storage::exists('public/files/uploads')== false){
             Storage::makeDirectory('public/files/uploads');
            }
        }

        $file = $request->file('file');
        $fileName = time().$file->getClientOriginalName();
        $file->move(public_path('files/uploads/'),$fileName);
        
        $file_path = $fileName;

        $uploadfile = new UploadFile();
        $uploadfile->name = $request->name;
        $uploadfile->description = $request->description;
        $uploadfile->file_path = $file_path;
        $uploadfile->save();

     
        return redirect()->back()->with('success',"File Successfully Uploaded");
    }

        public function downloads($file)
        {
            $filePath = public_path('files/uploads/'.$file);
    
            if (!file_exists($filePath)) {
                abort(404, 'File not found');
            }

            Log::info('File path: ' . $filePath);
            
            return response()->download(public_path('files/uploads/'.$file));
        }

        public function destroy($file)
        {
            $file = UploadFile::where('file_path',$file)->first();
            $file->delete();

            return redirect()->back();
        }

        public function view($id)
        {
            $file = UploadFile::find($id);
           

            return view('view',compact('file'));
        }
}
