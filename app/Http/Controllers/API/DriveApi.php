<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drive;

class DriveApi extends Controller
{
    // show all files
    public function index()
    {
        $drive = Drive::all();
        $message = [
            'message' => "Get All Files Done",
            'Data' => $drive,
            'status' => 200
        ];
        return response($message, 200);
    }

    // store all files
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'title' => 'required|min:2|max:20|string',
            'description' => 'required|min:3|max:50|string',
            'fileUpload' => 'required|mimes:png,jpg,pdf|max:2048'
        ]);

        // insert data into database
        $drive_data = $request->file('fileUpload');
        $file_name = time() . $drive_data->getClientOriginalName();
        $location = public_path('./drives/');
        $drive_data->move($location, $file_name);

        $drive = Drive::create([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $file_name,
            'userID' => 1,
            'status' => 'private'
        ]);

        $message = [
            'message' => "created All Files Done",
            'Data' => $drive,
            'status' => 201
        ];
        return response($message, 201);
    }

    // update file
    public function update(Request $request, $id)
    {
        // validation
        $request->validate([
            'title' => 'required|min:2|max:20|string',
            'description' => 'required|min:3|max:50|string',
            'fileUpload' => 'required|mimes:png,jpg,pdf|max:2048'
        ]);

        // insert data into database
        $drive = Drive::find($id);
        $drive_data = $request->file('fileUpload');
        if ($drive_data != null) {
            $file_name = time() . $drive_data->getClientOriginalName();
            $location = public_path('./drives/');
            $drive_data->move($location, $file_name);
            $path = public_path('/drives/' . $drive->file);
            unlink($path);
        } else {
            $file_name = $drive->file;
        }

        $drive->update([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $file_name,
            'userID' => 1,
            'status' => 'private'
        ]);

        $message = [
            'message' => "Update All Files Done",
            'Data' => $drive,
            'status' => 201
        ];
        return response($message, 201);
    }

    // delete file 
    public function delete($id)
    {
        $drive = Drive::find($id);
        $path = public_path('/drives/' . $drive->file);
        unlink($path);
        $drive->delete();
        $message = [
            'message' => "File Deleted Successfully",
            'Data' => $drive,
            'status' => 201
        ];
        return response($message, 201);
    }
}
