<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Schedule;
use App\Models\ScheduleRegisterUserData;
use Illuminate\Http\Request;

use DataTables;
use Validator;
use Session;
use Image;
use Auth;
use File;
use Str;

class ScheduleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data                       = [];
            $data['page_title']         = 'Schedule List';
            $data['btnadd'][]       = array(
                'link'  => route('admin.schedule.add'),
                'title' => 'Add Schedule'
            );
            $data['breadcrumb'][]       = array(
                'link'  => route('admin.home'),
                'title' => 'Dashboard'
            );
            $data['breadcrumb'][]       = array(
                'title' => 'List'
            );
            return view('admin.schedule.index', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function datatable(Request $request)
    {
        $schedule = Schedule::query();
        return DataTables::eloquent($schedule)
            ->addColumn('action', function ($schedule) {
                $action      = '';
                $action .= '<a data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit" class="btn btn-outline-secondary btn-sm" href="' . route("admin.schedule.edit", $schedule->id) . '"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                $action .= '<a data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete" class="btn btn-outline-danger btn-sm" href="javascript:void(0);" id="user_id_' . $schedule->id . '" data-id="' . $schedule->id . '" onclick="deleteRecord(this,' . $schedule->id . ');"><i class="fas fa-trash"></i></a>&nbsp;';
                return $action;
            })
            ->addColumn('city_name', function ($schedule) {
                return ($schedule->city) ? $schedule->city->name : '';
            })
            ->editColumn('date_time', function ($schedule) {
                return ($schedule->date_time) ? date('d-m-Y h:i A', strtotime($schedule->date_time)) : '';
            })
            ->editColumn('created_at', function ($schedule) {
                return ($schedule->created_at) ? date('d-m-Y', strtotime($schedule->created_at)) : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(schedule.created_at,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action'])->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data                       = [];
            $data['page_title']         = 'Add Schedule';
            $data['breadcrumb'][]       = array(
                'link'      => route('admin.home'),
                'title'     => 'Dashboard'
            );
            $data['breadcrumb'][]   = array(
                'link'  => route('admin.schedule.index'),
                'title' => 'Schedule'
            );
            $data['breadcrumb'][]       = array(
                'title' => 'Add'
            );
            $data['cities']              = City::where('status', true)->get();
            return view('admin.schedule.add', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function exists(Request $request)
    {
        $scheduleId     = ($request->id) ? $request->id : '';
        if ($scheduleId != '') {
            $result = Schedule::where('id', '!=', $scheduleId)->where('title', $request->title)->count();
        } else {
            $result = Schedule::where('title', $request->title)->count();
        }
        if ($result > 0) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $scheduleId   = ($request->id) ? $request->id : '';
            $rules    = [
                'title'               => 'required',
                'city_id'               => 'required',
                'date_time'               => 'required',
                'desc'               => 'required',
            ];
            if ($scheduleId != '') {
            } else {
                $rules['banner']      = 'required|file';
                $rules['detail_banner']      = 'required|file';
            }
            $messages = [
                'title.required'      => 'The title is required.',
                'city_id.required'         => 'The city field is required.',
                'date_time.required'        => 'The date time field is required.',
                'desc.required'     => 'The short desc field is required.',
            ];
            $validator      = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                if ($scheduleId != '') {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            } else {
                $slug           = preg_replace('/[^(\x20-\x7F)\x0A\x0D]*/','', $request->title);
                $slug           = Str::slug($slug, "-");
                if ($scheduleId != '') {
                    $item                           = Schedule::find($scheduleId);
                    Session::flash('alert-message', 'Schedule updated successfully.');
                } else {
                    $item                           = new Schedule();
                    Session::flash('alert-message', 'Schedule added successfully.');
                }
                if($request->hasFile('banner')){
                    $file   = $request->file('banner');
                    if(!File::exists(public_path('uploads/schedule'))){
                        File::makeDirectory(public_path('uploads/schedule'), $mode = 0777, true, true);
                    }
                    $photo  = generateFileName($file->extension());
                    if($photo!=''){
                        if (isset($item->banner) && $item->banner!='' && File::exists(public_path("uploads/schedule/".$item->banner))) {
                            unlink(public_path("uploads/schedule/".$item->banner));
                        }
                        if ($file->getClientOriginalExtension() == 'gif') {
                            $file->move(public_path('uploads/schedule/'), $photo);
                        } else {
                            Image::make($file)->save(public_path('uploads/schedule/'.$photo));
                        }
                        $item->banner    = $photo;
                    }
                }
                if($request->hasFile('detail_banner')){
                    $file   = $request->file('detail_banner');
                    if(!File::exists(public_path('uploads/schedule'))){
                        File::makeDirectory(public_path('uploads/schedule'), $mode = 0777, true, true);
                    }
                    $photo  = generateFileName($file->extension());
                    if($photo!=''){
                        if (isset($item->detail_banner) && $item->detail_banner!='' && File::exists(public_path("uploads/schedule/".$item->detail_banner))) {
                            unlink(public_path("uploads/schedule/".$item->detail_banner));
                        }
                        if ($file->getClientOriginalExtension() == 'gif') {
                            $file->move(public_path('uploads/schedule/'), $photo);
                        } else {
                            Image::make($file)->save(public_path('uploads/schedule/'.$photo));
                        }
                        $item->detail_banner    = $photo;
                    }
                }
                if($request->hasFile('detail_section_two_banner')){
                    $file   = $request->file('detail_section_two_banner');
                    if(!File::exists(public_path('uploads/schedule'))){
                        File::makeDirectory(public_path('uploads/schedule'), $mode = 0777, true, true);
                    }
                    $photo  = generateFileName($file->extension());
                    if($photo!=''){
                        if (isset($item->detail_section_two_banner) && $item->detail_section_two_banner!='' && File::exists(public_path("uploads/schedule/".$item->detail_section_two_banner))) {
                            unlink(public_path("uploads/schedule/".$item->detail_section_two_banner));
                        }
                        if ($file->getClientOriginalExtension() == 'gif') {
                            $file->move(public_path('uploads/schedule/'), $photo);
                        } else {
                            Image::make($file)->save(public_path('uploads/schedule/'.$photo));
                        }
                        $item->detail_section_two_banner    = $photo;
                    }
                }
                if($request->hasFile('detail_section_four_banner')){
                    $file   = $request->file('detail_section_four_banner');
                    if(!File::exists(public_path('uploads/schedule'))){
                        File::makeDirectory(public_path('uploads/schedule'), $mode = 0777, true, true);
                    }
                    $photo  = generateFileName($file->extension());
                    if($photo!=''){
                        if (isset($item->detail_section_four_banner) && $item->detail_section_four_banner!='' && File::exists(public_path("uploads/schedule/".$item->detail_section_four_banner))) {
                            unlink(public_path("uploads/schedule/".$item->detail_section_four_banner));
                        }
                        if ($file->getClientOriginalExtension() == 'gif') {
                            $file->move(public_path('uploads/schedule/'), $photo);
                        } else {
                            Image::make($file)->save(public_path('uploads/schedule/'.$photo));
                        }
                        $item->detail_section_four_banner    = $photo;
                    }
                }
                if($request->hasFile('detail_section_five_banner')){
                    $file   = $request->file('detail_section_five_banner');
                    if(!File::exists(public_path('uploads/schedule'))){
                        File::makeDirectory(public_path('uploads/schedule'), $mode = 0777, true, true);
                    }
                    $photo  = generateFileName($file->extension());
                    if($photo!=''){
                        if (isset($item->detail_section_five_banner) && $item->detail_section_five_banner!='' && File::exists(public_path("uploads/schedule/".$item->detail_section_five_banner))) {
                            unlink(public_path("uploads/schedule/".$item->detail_section_five_banner));
                        }
                        if ($file->getClientOriginalExtension() == 'gif') {
                            $file->move(public_path('uploads/schedule/'), $photo);
                        } else {
                            Image::make($file)->save(public_path('uploads/schedule/'.$photo));
                        }
                        $item->detail_section_five_banner    = $photo;
                    }
                }
                $item->title               = $request->title;
                $item->slug               = $slug;
                $item->city_id               = $request->city_id;
                $item->metting_point               = $request->metting_point;
                $item->date_time               = $request->date_time;
                $item->desc               = $request->desc;
                $item->detail_section_one_desc_one               = $request->detail_section_one_desc_one;
                $item->detail_section_one_desc_two               = $request->detail_section_one_desc_two;
                $item->detail_section_two_desc_one               = $request->detail_section_two_desc_one;
                $item->detail_section_two_desc_two               = $request->detail_section_two_desc_two;
                $item->detail_section_three_desc_one               = $request->detail_section_three_desc_one;
                $item->detail_section_three_desc_two               = $request->detail_section_three_desc_two;
                $item->detail_section_four_desc_one               = $request->detail_section_four_desc_one;
                $item->detail_section_four_desc_two               = $request->detail_section_four_desc_two;
                $item->detail_face_book_url               = $request->detail_face_book_url;
                $item->detail_twitter_url               = $request->detail_twitter_url;
                $item->detail_google_plus_url               = $request->detail_google_plus_url;
                $item->detail_whatsapp_url               = $request->detail_whatsapp_url;
                $item->detail_plus_url               = $request->detail_plus_url;
                $arr = [];
                if ($request->has('outer-group') && !empty($request->{'outer-group'})) {
                    foreach($request->{'outer-group'}[0]['inner-group'] as $key => $inner) {
                        $arr[$key] = $inner['detail_who_can_attend'];
                    }
                }
                if ($request->has('detail_who_can_attend_edit') && !empty($request->detail_who_can_attend_edit)) {
                    $arr = array_merge($arr, $request->detail_who_can_attend_edit);
                }
                $item->detail_who_can_attend               = json_encode(array_filter($arr));
                $item->status               = $request->status;
                if ($item->save()) {
                    Session::flash('alert-class', 'success');
                    return redirect()->route('admin.schedule.index');
                } else {
                    if ($scheduleId != '') {
                        Session::flash('alert-message', 'Schedule updated unsuccessfully.');
                    } else {
                        Session::flash('alert-message', 'Schedule added unsuccessfully.');
                    }
                    Session::flash('alert-class', 'error');
                    return redirect()->route('admin.schedule.edit', $scheduleId);
                }
            }
        } catch (\Exception $e) {
            Session::flash('alert-message', $e->getMessage());
            Session::flash('alert-class', 'error');
            return redirect()->route('admin.schedule.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data                       = [];
            $data['page_title']         = 'View Schedule';
            $data['breadcrumb'][]       = array(
                'link'      => route('admin.dashboard'),
                'title'     => 'Dashboard'
            );
            $data['breadcrumb'][]   = array(
                'link'  => route('admin.schedule.index'),
                'title' => 'Schedule'
            );
            $data['breadcrumb'][]       = array(
                'title' => 'View'
            );
            $schedule                       = Schedule::where('id', $id)->first();
            if ($schedule) {
                $data['schedule']           = $schedule;
                return view('admin.schedule.view', $data);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data                       = [];
            $data['page_title']         = 'Edit Schedule';
            $data['breadcrumb'][]       = array(
                'link'      => route('admin.home'),
                'title'     => 'Dashboard'
            );
            if (Auth::user()->can('user-list')) {
                $data['breadcrumb'][]   = array(
                    'link'  => route('admin.schedule.index'),
                    'title' => 'Schedule'
                );
            }
            $data['breadcrumb'][]       = array(
                'title' => 'Edit'
            );
            $schedule                       = Schedule::where('id', $id)->first();
            if ($schedule) {
                $data['schedule']           = $schedule;
                $data['cities']              = City::where('status', true)->get();
                return view('admin.schedule.add', $data);
            } else {
                return abort(404);
            }
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $user = Schedule::where('id', $request->id)->first();
                if (!is_null($user)) {
                    if ($user->delete()) {
                        $response['success']    = true;
                        $response['message']    = "Schedule deleted successfully.";
                    } else {
                        $response['success']    = false;
                        $response['message']    = "Schedule deleted unsuccessfully.";
                    }
                } else {
                    $response['success']                = false;
                    $response['message']                = "Schedule record not found.";
                }
            } catch (\Exception $e) {
                $response['success']                    = false;
                $response['message']                    = $e->getMessage();
            }
            return response()->json($response);
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified user status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function statusChange(Request $request)
    {
        if ($request->ajax()) {
            try {
                $schedule = Schedule::where('id', $request->id)->first();
                if (!is_null($schedule)) {
                    $schedule->status               = $request->status;
                    if ($schedule->save()) {
                        $response['success']    = true;
                        $response['message']    = "Status has been changed successfully.";
                    } else {
                        $response['success']    = false;
                        $response['message']    = "Status has been changed unsuccessfully.";
                    }
                } else {
                    $response['success']                = false;
                    $response['message']                = "Oops! Something went wrong..";
                }
            } catch (\Exception $e) {
                $response['success']                    = false;
                $response['message']                    = $e->getMessage();
            }
            return response()->json($response);
        } else {
            return abort(404);
        }
    }

    public function register_index()
    {
        try {
            $data                       = [];
            $data['page_title']         = 'Register List';
            $data['breadcrumb'][]       = array(
                'link'  => route('admin.home'),
                'title' => 'Dashboard'
            );
            $data['breadcrumb'][]       = array(
                'title' => 'List'
            );
            return view('admin.schedule.register_index', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function register_datatable()
    {
        $schedule = ScheduleRegisterUserData::query();
        return DataTables::eloquent($schedule)
            ->editColumn('schedule_id', function ($schedule) {
                return ($schedule->schedule) ? $schedule->schedule->title : '';
            })
            ->editColumn('created_at', function ($schedule) {
                return ($schedule->created_at) ? date('d-m-Y h:i A', strtotime($schedule->created_at)) : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(schedule.created_at,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action'])->addIndexColumn()
            ->make(true);
    }
}
