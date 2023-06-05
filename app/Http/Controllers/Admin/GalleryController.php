<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

use DataTables;
use Validator;
use Session;
use Image;
use File;

class GalleryController extends Controller
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
            $data['page_title']         = 'Gallery List';
            $data['breadcrumb'][]       = array(
                'link'  => route('admin.home'),
                'title' => 'Dashboard'
            );
            $data['breadcrumb'][]       = array(
                'title' => 'List'
            );
            return view('admin.gallery.index', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function datatable()
    {
        $gallery = Gallery::query();
        return DataTables::eloquent($gallery)
            ->addColumn('action', function ($gallery) {
                $action      = '';
                $action .= '<a data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete" class="btn btn-outline-danger btn-sm" href="javascript:void(0);" id="user_id_' . $gallery->id . '" data-id="' . $gallery->id . '" onclick="deleteRecord(this,' . $gallery->id . ');"><i class="fas fa-trash"></i></a>&nbsp;';
                return $action;
            })
            ->editColumn('created_at', function ($gallery) {
                return ($gallery->created_at) ? date('d-m-Y', strtotime($gallery->created_at)) : '';
            })
            ->editColumn('image', function ($gallery) {
                return '<img src="'.asset('uploads/gallery/'.$gallery->image).'" width="150px" />';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(gallery.created_at,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action', 'image'])->addIndexColumn()
            ->make(true);
    }


    public function store(Request $request)
    {
        try {
            $rules    = [
                'image'               => 'required|file',
            ];

            $messages = [
                'image.required'      => 'The image is required.',
            ];
            $validator      = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            } else {
                $item                           = new Gallery();
                Session::flash('alert-message', 'Image added successfully.');
                if($request->hasFile('image')){
                    $file   = $request->file('image');
                    if(!File::exists(public_path('uploads/gallery'))){
                        File::makeDirectory(public_path('uploads/gallery'), $mode = 0777, true, true);
                    }
                    $photo  = generateFileName($file->extension());
                    if($photo!=''){
                        if ($file->getClientOriginalExtension() == 'gif') {
                            $file->move(public_path('uploads/gallery/'), $photo);
                        } else {
                            Image::make($file)->save(public_path('uploads/gallery/'.$photo));
                        }
                        $item->image    = $photo;
                    }
                }
                $item->status               = 1;
                if ($item->save()) {
                    Session::flash('alert-class', 'success');
                    return redirect()->route('admin.gallery.list');
                } else {
                    Session::flash('alert-message', 'Image added unsuccessfully.');
                    Session::flash('alert-class', 'error');
                    return redirect()->route('admin.gallery.list');
                }
            }
        } catch (\Exception $e) {
            Session::flash('alert-message', $e->getMessage());
            Session::flash('alert-class', 'error');
            return redirect()->route('admin.gallery.list');
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
                $gallery = Gallery::where('id', $request->id)->first();
                if (!is_null($gallery)) {
                    if ($gallery->delete()) {
                        $response['success']    = true;
                        $response['message']    = "Image deleted successfully.";
                    } else {
                        $response['success']    = false;
                        $response['message']    = "Image deleted unsuccessfully.";
                    }
                } else {
                    $response['success']                = false;
                    $response['message']                = "Image record not found.";
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
                $gallery = Gallery::where('id', $request->id)->first();
                if (!is_null($gallery)) {
                    $gallery->status               = $request->status;
                    if ($gallery->save()) {
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
}
