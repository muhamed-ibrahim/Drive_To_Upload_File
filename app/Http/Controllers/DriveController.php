<?php

namespace App\Http\Controllers;

use App\Models\Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DriveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }


    public function publicDrives(){
        $drive = DB::table('drives')
            ->join('users', 'userId', 'users.id')->where('status',1)
            ->get();
        return view('drive.publicDrive',compact('drive'));
    }
    public function index()
    {
        $id= auth()->user()->id;
        $drive = Drive::where('userId','=',$id)->get();
        return view('drive.index',compact('drive'));
    }

    public function indexAll()
    {
        $drive = Drive::all();
        return view('drive.index',compact('drive'));
    }



    public function create()
    {
        return view('drive.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'discribtion'=>'required|string',
            'file_input'=>'required|file|max:2024|mimes:png,jpg,pdf',

        ]);

        $drive = new Drive();
        $drive->title = $request->title;
        $drive->discribtion = $request->discribtion;
        $drive->userId = auth()->user()->id;
        $driveDate = $request->file('file_input');
        $fileName =time().$driveDate->getClientOriginalName();
        $driveDate->move(public_path().'/drives/',$fileName);
        $drive->file = $fileName;
        $drive->save();
        return redirect()->back()->with('done','File Uploaded Successfully');


    }


    public function show($id)
    {
        $drive = Drive::find($id);
        return view('drive.show',compact('drive'));
    }


    public function edit($id)
    {
        $drive =Drive::find($id);
        return view('drive.edit',compact('drive'));

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required|string',
            'discribtion'=>'required|string',
            'file_input'=>'file|max:2024|mimes:png,jpg,pdf',

        ]);

        $drive =Drive::find($id);
        $drive->title = $request->title;
        $drive->discribtion = $request->discribtion;
        $driveDate = $request->file('file_input');
        if(!empty($driveDate)){
            $driveName = $drive->file;
            unlink(public_path().'/drives/'.$driveName);
            $fileName =time().$driveDate->getClientOriginalName();
            $driveDate->move(public_path().'/drives/',$fileName);
            $drive->file = $fileName;
        }
        else{
            $drive->file=$drive->file;
        }

        $drive->save();
        return redirect('drive/list')->with('done','File Updated Successfully');
    }

    public function destroy($id)
    {
        $drive =Drive::find($id);
        $driveName = $drive->file;
        unlink(public_path().'/drives/'.$driveName);
        $drive->delete();
        return redirect()->back()->with('done','File Deleted Successfully');
    }

    public function download($id){
        $drive =Drive::find($id);
        $path = public_path("drives/$drive->file");
        return response()->download($path);
    }
    public function sharedDrive(Request $request, $id){
        $drive = Drive::find($id);
        if($drive->status==1){
            $drive->status=0;
            $drive->save();
            return redirect('/drive/list')->with('done','private drive');


        }else{
            $drive->status=1;
            $drive->save();
            return redirect('/drive/list')->with('done','public drive');

        }
    }


    public function goto401(){
        return view('drive.401');

    }


}
