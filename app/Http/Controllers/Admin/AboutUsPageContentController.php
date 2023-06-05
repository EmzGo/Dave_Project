<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

use Session;
use Image;
use File;

class AboutUsPageContentController extends Controller
{

    public function store(Request $request)
    {
        try {
            $homeId   = ($request->id) ? $request->id : '';
            if ($homeId != '') {
                $item                           = AboutUs::find($homeId);
                Session::flash('alert-message', 'Aboutus Data updated successfully.');
            } else {
                $item                           = new AboutUs();
                Session::flash('alert-message', 'Aboutus Data added successfully.');
            }
            if ($request->hasFile('banner')) {
                $file   = $request->file('banner');
                if (!File::exists(public_path('uploads/aboutus_page'))) {
                    File::makeDirectory(public_path('uploads/aboutus_page'), $mode = 0777, true, true);
                }
                $photo  = generateFileName($file->extension());
                if ($photo != '') {
                    if (isset($item->banner) && $item->banner != '' && File::exists(public_path("uploads/aboutus_page/" . $item->banner))) {
                        unlink(public_path("uploads/aboutus_page/" . $item->banner));
                    }
                    if ($file->getClientOriginalExtension() == 'gif') {
                        $file->move(public_path('uploads/aboutus_page/'), $photo);
                    } else {
                        Image::make($file)->save(public_path('uploads/aboutus_page/' . $photo));
                    }
                    $item->banner    = $photo;
                }
            }
            if ($request->hasFile('section_two_image')) {
                $file   = $request->file('section_two_image');
                if (!File::exists(public_path('uploads/aboutus_page'))) {
                    File::makeDirectory(public_path('uploads/aboutus_page'), $mode = 0777, true, true);
                }
                $photo  = generateFileName($file->extension());
                if ($photo != '') {
                    if (isset($item->section_two_image) && $item->section_two_image != '' && File::exists(public_path("uploads/aboutus_page/" . $item->section_two_image))) {
                        unlink(public_path("uploads/aboutus_page/" . $item->section_two_image));
                    }
                    if ($file->getClientOriginalExtension() == 'gif') {
                        $file->move(public_path('uploads/aboutus_page/'), $photo);
                    } else {
                        Image::make($file)->save(public_path('uploads/aboutus_page/' . $photo));
                    }
                    $item->section_two_image    = $photo;
                }
            }
            if ($request->hasFile('section_four_image')) {
                $file   = $request->file('section_four_image');
                if (!File::exists(public_path('uploads/aboutus_page'))) {
                    File::makeDirectory(public_path('uploads/aboutus_page'), $mode = 0777, true, true);
                }
                $photo  = generateFileName($file->extension());
                if ($photo != '') {
                    if (isset($item->section_four_image) && $item->section_four_image != '' && File::exists(public_path("uploads/aboutus_page/" . $item->section_four_image))) {
                        unlink(public_path("uploads/aboutus_page/" . $item->section_four_image));
                    }
                    if ($file->getClientOriginalExtension() == 'gif') {
                        $file->move(public_path('uploads/aboutus_page/'), $photo);
                    } else {
                        Image::make($file)->save(public_path('uploads/aboutus_page/' . $photo));
                    }
                    $item->section_four_image    = $photo;
                }
            }
            $item->section_one_community_title               = $request->section_one_community_title;
            $item->section_one_community_desc_one               = $request->section_one_community_desc_one;
            $item->section_one_community_desc_two               = $request->section_one_community_desc_two;
            $item->section_three_travel_title               = $request->section_three_travel_title;
            $item->section_three_travel_desc_one               = $request->section_three_travel_desc_one;
            $item->section_three_travel_desc_two               = $request->section_three_travel_desc_two;
            $item->section_five_learn_title               = $request->section_five_learn_title;
            $item->section_five_learn_desc_one               = $request->section_five_learn_desc_one;
            $item->section_five_learn_desc_two               = $request->section_five_learn_desc_two;
            if ($item->save()) {
                Session::flash('alert-class', 'success');
                return redirect()->route('admin.aboutus_page_content.edit');
            } else {
                if ($scheduleId != '') {
                    Session::flash('alert-message', 'Schedule updated unsuccessfully.');
                } else {
                    Session::flash('alert-message', 'Schedule added unsuccessfully.');
                }
                Session::flash('alert-class', 'error');
                return redirect()->route('admin.aboutus_page_content.edit');
            }
        } catch (\Exception $e) {
            Session::flash('alert-message', $e->getMessage());
            Session::flash('alert-class', 'error');
            return redirect()->route('admin.aboutus_page_content.edit');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        try {
            $data                       = [];
            $data['page_title']         = 'Edit Home Page Content';
            $data['breadcrumb'][]       = array(
                'link'      => route('admin.home'),
                'title'     => 'Dashboard'
            );
            $data['breadcrumb'][]       = array(
                'title' => 'Edit'
            );
            $aboutUsPageContent                       = AboutUs::where('id', 1)->first();
            if ($aboutUsPageContent) {
                $data['aboutUsPageContent']           = $aboutUsPageContent;
            }
            return view('admin.aboutus_page_content.add', $data);
        } catch (\Exception $e) {
            dd($e);
            return abort(404);
        }
    }

}
