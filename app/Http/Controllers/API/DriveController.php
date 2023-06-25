<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Drive;
use Illuminate\Http\Request;

class DriveController extends Controller
{

    public function index()
    {
        $message = [
            'drives' => Drive::all(),
            'message' => 'list of all drives',
            'status' => 200,
        ];
        return response($message, 200);
    }




    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'discribtion' => 'required|string',
            'file' => 'required|file|max:2024|mimes:png,jpg,pdf',

        ]);
        $driveDate = $request->file('file');
        if ($request->hasfile('file')) {
            $fileName = time() . $driveDate->getClientOriginalName();
            $driveDate->move(public_path() . '/drives/', $fileName);
        }
        $create = Drive::create([
            "title" => $request->title,
            "discribtion" => $request->discribtion,
            "userId" => $request->userId,
            "file" => $fileName,
        ]);
        $drive  = [
            "createDrive" => $create,
            "message" => "drive created successfully",
            "status" => 200,
        ];
        return response($drive, 200);
    }


    public function show($id)
    {
        $message = [
            'drives' => Drive::find($id),
            'message' => 'list of all drives',
            'status' => 200,
        ];
        return response($message, 200);
    }




    public function update(Request $request, $id)
    {
        $drives = Drive::find($id);

        $request->validate([
            'title' => 'required|string',
            'discribtion' => 'required|string',
            'file' => 'required|file|max:2024|mimes:png,jpg,pdf',

        ]);
        $driveDate = $request->file('file');
        if ($request->hasfile('file')) {
            $fileName = time() . $driveDate->getClientOriginalName();
            $driveDate->move(public_path() . '/drives/', $fileName);
        }
        $drives->update([
            "title" => $request->title,
            "discribtion" => $request->discribtion,
            "userId" => $request->userId,
            "file" => $fileName,
        ]);
        $drive  = [
            "createDrive" => $drives,
            "message" => "drive created successfully",
            "status" => 200,
        ];
        return response($drive, 200);
    }


    public function destroy($id)
    {

        $message = [
            'drives' => Drive::destroy($id),
            'message' => 'list of all drives',
            'status' => 200,
        ];
        return response($message, 200);
    }
}
