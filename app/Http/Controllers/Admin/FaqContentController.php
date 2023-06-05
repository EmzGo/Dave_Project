<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Faq;
use Illuminate\Http\Request;

use DataTables;
use Validator;
use Session;

class FaqContentController extends Controller
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
            $data['page_title']         = 'FAQ List';
            $data['btnadd'][]       = array(
                'link'  => route('admin.faq_content.add'),
                'title' => 'Add FAQ'
            );
            $data['breadcrumb'][]       = array(
                'link'  => route('admin.home'),
                'title' => 'Dashboard'
            );
            $data['breadcrumb'][]       = array(
                'title' => 'List'
            );
            return view('admin.faq_content.index', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function datatable(Request $request)
    {
        $faq = Faq::query();
        return DataTables::eloquent($faq)
            ->addColumn('action', function ($faq) {
                $action      = '';
                $action .= '<a data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit" class="btn btn-outline-secondary btn-sm" href="' . route("admin.faq_content.edit", $faq->id) . '"><i class="fas fa-pencil-alt"></i></a>&nbsp;';
                $action .= '<a data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete" class="btn btn-outline-danger btn-sm" href="javascript:void(0);" id="user_id_' . $faq->id . '" data-id="' . $faq->id . '" onclick="deleteRecord(this,' . $faq->id . ');"><i class="fas fa-trash"></i></a>&nbsp;';
                return $action;
            })
            ->editColumn('created_at', function ($faq) {
                return ($faq->created_at) ? date('d-m-Y', strtotime($faq->created_at)) : '';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(faq.created_at,'%d-%m-%Y') like ?", ["%$keyword%"]);
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
            $data['page_title']         = 'Add FAQ';
            $data['breadcrumb'][]       = array(
                'link'      => route('admin.home'),
                'title'     => 'Dashboard'
            );
            $data['breadcrumb'][]   = array(
                'link'  => route('admin.faq_content.index'),
                'title' => 'FAQ'
            );
            $data['breadcrumb'][]       = array(
                'title' => 'Add'
            );
            $data['cities']              = City::where('status', true)->get();
            return view('admin.faq_content.add', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function store(Request $request)
    {
        try {
            $faqId   = ($request->id) ? $request->id : '';
            $rules    = [
                'question'               => 'required',
                'answer'               => 'required',
            ];
            $messages = [
                'question.required'      => 'The question is required.',
                'answer.required'         => 'The answer field is required.',
            ];
            $validator      = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                if ($faqId != '') {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                } else {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            } else {
                if ($faqId != '') {
                    $item                           = Faq::find($faqId);
                    Session::flash('alert-message', 'FAQ updated successfully.');
                } else {
                    $item                           = new Faq();
                    Session::flash('alert-message', 'FAQ added successfully.');
                }
                $item->question               = $request->question;
                $item->answer               = $request->answer;
                $item->status               = $request->status;
                if ($item->save()) {
                    Session::flash('alert-class', 'success');
                    return redirect()->route('admin.faq_content.index');
                } else {
                    if ($faqId != '') {
                        Session::flash('alert-message', 'FAQ updated unsuccessfully.');
                    } else {
                        Session::flash('alert-message', 'FAQ added unsuccessfully.');
                    }
                    Session::flash('alert-class', 'error');
                    return redirect()->route('admin.faq_content.edit', $faqId);
                }
            }
        } catch (\Exception $e) {
            Session::flash('alert-message', $e->getMessage());
            Session::flash('alert-class', 'error');
            return redirect()->route('admin.faq_content.index');
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
            $data['page_title']         = 'Edit FAQ';
            $data['breadcrumb'][]       = array(
                'link'      => route('admin.home'),
                'title'     => 'Dashboard'
            );
            $data['breadcrumb'][]   = array(
                'link'  => route('admin.faq_content.index'),
                'title' => 'FAQ'
            );
            $data['breadcrumb'][]       = array(
                'title' => 'Edit'
            );
            $faq                       = Faq::where('id', $id)->first();
            if ($faq) {
                $data['faq']           = $faq;
                return view('admin.faq_content.add', $data);
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
                $user = Faq::where('id', $request->id)->first();
                if (!is_null($user)) {
                    if ($user->delete()) {
                        $response['success']    = true;
                        $response['message']    = "Faq deleted successfully.";
                    } else {
                        $response['success']    = false;
                        $response['message']    = "Faq deleted unsuccessfully.";
                    }
                } else {
                    $response['success']                = false;
                    $response['message']                = "Faq record not found.";
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
                $faq = Faq::where('id', $request->id)->first();
                if (!is_null($faq)) {
                    $faq->status               = $request->status;
                    if ($faq->save()) {
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
