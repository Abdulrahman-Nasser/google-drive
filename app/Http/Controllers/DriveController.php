<?php

namespace App\Http\Controllers;

use App\Models\Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriveController extends Controller
{

    // view list of files
    public function index()
    {
        $usierID = auth()->user()->id;
        $drives = Drive::where('userID', $usierID)->get();
        return view('drives.index', compact('drives'));
    }

    // view all files
    public function allFile()
    {
        $drives = Drive::all();
        return view('drives.allFile', compact('drives'));
    }

    // create file 
    public function create()
    {
        return view('drives.create');
    }

    // store file in database
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'title' => 'required|min:2|max:20|string',
            'description' => 'required|min:3|max:50|string',
            'fileUpload' => 'required|mimes:png,jpg,pdf|max:2048'
        ]);

        // insert data into database
        $drive = new Drive();
        $drive->title = $request->title;
        $drive->description = $request->description;
        $drive_data = $request->file('fileUpload');
        $file_name = time() . $drive_data->getClientOriginalName();
        $location = public_path('./drives/');
        $drive_data->move($location, $file_name);
        $drive->file = $file_name;
        $drive->userID = auth()->user()->id;
        $drive->save();
        return redirect()->back()->with('done', 'inserted done');
    }


    // show file details
    public function show($id)
    {
        $drive = Drive::find($id);
        return view('drives.show', compact('drive'));
    }

    // edit file
    public function edit($id)
    {
        $drive = Drive::find($id);
        return view('drives.edit', compact('drive'));
    }

    // update file
    public function update(Request $request, $id)
    {
        $drive = Drive::find($id);
        $drive->title = $request->title;
        $drive->description = $request->description;

        // File 
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

        $drive->file = $file_name;
        $drive->save();
        return redirect()->route('drive.index')->with('done', 'inserted done');
    }

    // delete file
    public function destroy($id)
    {
        $drive = Drive::find($id);
        $path = public_path('/drives/' . $drive->file);
        unlink($path);
        $drive->delete();
        return redirect()->route('drive.index')->with('done', 'Deleted Successfully');
    }

    // downliad file
    public function download($id)
    {
        $drive = Drive::find($id);
        $drive_name = $drive->file;
        $path = public_path('/drives/' . $drive_name);
        $headers = [
            'Content-Type' => 'application/pdf',
        ];
        return response()->download($path, $drive_name, $headers);
    }

    // show public files
    public function share($id)
    {
        $drive = Drive::find($id);
        if ($drive->status == 'private') {
            $drive->status = 'public';
            $drive->save();
            return redirect()->route('drive.index')->with('done', 'File shared successfully');
        } else {
            $drive->status = 'private';
            $drive->save();
            return redirect()->route('drive.index')->with('done', 'File Become Private');
        }
    }

    // Shared files
    public function shared()
    {
        $drive = Drive::where('status', 'public')->get();
        return view('drives.share', compact('drive'));
    }

    // show shared files
    public function showSharedfile($id)
    {
        $drive = DB::table('shared_file' )->get()->firstWhere('id',$id);
        return view('drives.publicFile', compact('drive'));
    }
}
