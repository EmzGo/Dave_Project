<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageContent;
use Illuminate\Http\Request;

use Session;
use Image;
use File;

class HomePageContentController extends Controller
{

    public function store(Request $request)
    {
        try {
            $homeId   = ($request->id) ? $request->id : '';
            if ($homeId != '') {
                $item                           = HomePageContent::find($homeId);
                Session::flash('alert-message', 'Home Data updated successfully.');
            } else {
                $item                           = new HomePageContent();
                Session::flash('alert-message', 'Home Data added successfully.');
            }
            if ($request->hasFile('banner')) {
                $file   = $request->file('banner');
                if (!File::exists(public_path('uploads/home_page'))) {
                    File::makeDirectory(public_path('uploads/home_page'), $mode = 0777, true, true);
                }
                $photo  = generateFileName($file->extension());
                if ($photo != '') {
                    if (isset($item->banner) && $item->banner != '' && File::exists(public_path("uploads/home_page/" . $item->banner))) {
                        unlink(public_path("uploads/home_page/" . $item->banner));
                    }
                    if ($file->getClientOriginalExtension() == 'gif') {
                        $file->move(public_path('uploads/home_page/'), $photo);
                    } else {
                        Image::make($file)->save(public_path('uploads/home_page/' . $photo));
                    }
                    $item->banner    = $photo;
                }
            }
            if ($request->hasFile('section_two_banner')) {
                $file   = $request->file('section_two_banner');
                if (!File::exists(public_path('uploads/home_page'))) {
                    File::makeDirectory(public_path('uploads/home_page'), $mode = 0777, true, true);
                }
                $photo  = generateFileName($file->extension());
                if ($photo != '') {
                    if (isset($item->section_two_banner) && $item->section_two_banner != '' && File::exists(public_path("uploads/home_page/" . $item->section_two_banner))) {
                        unlink(public_path("uploads/home_page/" . $item->section_two_banner));
                    }
                    if ($file->getClientOriginalExtension() == 'gif') {
                        $file->move(public_path('uploads/home_page/'), $photo);
                    } else {
                        Image::make($file)->save(public_path('uploads/home_page/' . $photo));
                    }
                    $item->section_two_banner    = $photo;
                }
            }
            if ($request->hasFile('section_three_banner')) {
                $file   = $request->file('section_three_banner');
                if (!File::exists(public_path('uploads/home_page'))) {
                    File::makeDirectory(public_path('uploads/home_page'), $mode = 0777, true, true);
                }
                $photo  = generateFileName($file->extension());
                if ($photo != '') {
                    if (isset($item->section_three_banner) && $item->section_three_banner != '' && File::exists(public_path("uploads/home_page/" . $item->section_three_banner))) {
                        unlink(public_path("uploads/home_page/" . $item->section_three_banner));
                    }
                    if ($file->getClientOriginalExtension() == 'gif') {
                        $file->move(public_path('uploads/home_page/'), $photo);
                    } else {
                        Image::make($file)->save(public_path('uploads/home_page/' . $photo));
                    }
                    $item->section_three_banner    = $photo;
                }
            }
            if ($request->hasFile('section_four_banner')) {
                $file   = $request->file('section_four_banner');
                if (!File::exists(public_path('uploads/home_page'))) {
                    File::makeDirectory(public_path('uploads/home_page'), $mode = 0777, true, true);
                }
                $photo  = generateFileName($file->extension());
                if ($photo != '') {
                    if (isset($item->section_four_banner) && $item->section_four_banner != '' && File::exists(public_path("uploads/home_page/" . $item->section_four_banner))) {
                        unlink(public_path("uploads/home_page/" . $item->section_four_banner));
                    }
                    if ($file->getClientOriginalExtension() == 'gif') {
                        $file->move(public_path('uploads/home_page/'), $photo);
                    } else {
                        Image::make($file)->save(public_path('uploads/home_page/' . $photo));
                    }
                    $item->section_four_banner    = $photo;
                }
            }
            if ($request->hasFile('section_five_contest_image')) {
                $file   = $request->file('section_five_contest_image');
                if (!File::exists(public_path('uploads/home_page'))) {
                    File::makeDirectory(public_path('uploads/home_page'), $mode = 0777, true, true);
                }
                $photo  = generateFileName($file->extension());
                if ($photo != '') {
                    if (isset($item->section_five_contest_image) && $item->section_five_contest_image != '' && File::exists(public_path("uploads/home_page/" . $item->section_five_contest_image))) {
                        unlink(public_path("uploads/home_page/" . $item->section_five_contest_image));
                    }
                    if ($file->getClientOriginalExtension() == 'gif') {
                        $file->move(public_path('uploads/home_page/'), $photo);
                    } else {
                        Image::make($file)->save(public_path('uploads/home_page/' . $photo));
                    }
                    $item->section_five_contest_image    = $photo;
                }
            }
            if ($request->hasFile('section_seven_banner')) {
                $file   = $request->file('section_seven_banner');
                if (!File::exists(public_path('uploads/home_page'))) {
                    File::makeDirectory(public_path('uploads/home_page'), $mode = 0777, true, true);
                }
                $photo  = generateFileName($file->extension());
                if ($photo != '') {
                    if (isset($item->section_seven_banner) && $item->section_seven_banner != '' && File::exists(public_path("uploads/home_page/" . $item->section_seven_banner))) {
                        unlink(public_path("uploads/home_page/" . $item->section_seven_banner));
                    }
                    if ($file->getClientOriginalExtension() == 'gif') {
                        $file->move(public_path('uploads/home_page/'), $photo);
                    } else {
                        Image::make($file)->save(public_path('uploads/home_page/' . $photo));
                    }
                    $item->section_seven_banner    = $photo;
                }
            }
            if ($request->hasFile('section_eight_banner')) {
                $file   = $request->file('section_eight_banner');
                if (!File::exists(public_path('uploads/home_page'))) {
                    File::makeDirectory(public_path('uploads/home_page'), $mode = 0777, true, true);
                }
                $photo  = generateFileName($file->extension());
                if ($photo != '') {
                    if (isset($item->section_eight_banner) && $item->section_eight_banner != '' && File::exists(public_path("uploads/home_page/" . $item->section_eight_banner))) {
                        unlink(public_path("uploads/home_page/" . $item->section_eight_banner));
                    }
                    if ($file->getClientOriginalExtension() == 'gif') {
                        $file->move(public_path('uploads/home_page/'), $photo);
                    } else {
                        Image::make($file)->save(public_path('uploads/home_page/' . $photo));
                    }
                    $item->section_eight_banner    = $photo;
                }
            }
            $item->section_one_banner_desc_one               = $request->section_one_banner_desc_one;
            $item->section_one_banner_desc_two               = $request->section_one_banner_desc_two;
            $item->section_two_title               = $request->section_two_title;
            $item->section_two_banner_desc_one               = $request->section_two_banner_desc_one;
            $item->section_two_banner_desc_two               = $request->section_two_banner_desc_two;
            $item->section_three_title               = $request->section_three_title;
            $item->section_three_desc_one               = $request->section_three_desc_one;
            $item->section_three_desc_two               = $request->section_three_desc_two;
            $item->section_four_title               = $request->section_four_title;
            $item->section_four_desc_one               = $request->section_four_desc_one;
            $item->section_four_desc_two               = $request->section_four_desc_two;
            $item->section_five_contest_title               = $request->section_five_contest_title;
            $item->section_five_contest_sub_title               = $request->section_five_contest_sub_title;
            $item->section_five_contest_desc               = $request->section_five_contest_desc;
            $item->section_five_contest_winning_text               = $request->section_five_contest_winning_text;
            $item->section_five_contest_end_text               = $request->section_five_contest_end_text;
            $item->section_six_community_desc_one               = $request->section_six_community_desc_one;
            $item->section_six_community_desc_two               = $request->section_six_community_desc_two;
            if ($item->save()) {
                Session::flash('alert-class', 'success');
                return redirect()->route('admin.home_page_content.edit');
            } else {
                if ($scheduleId != '') {
                    Session::flash('alert-message', 'Schedule updated unsuccessfully.');
                } else {
                    Session::flash('alert-message', 'Schedule added unsuccessfully.');
                }
                Session::flash('alert-class', 'error');
                return redirect()->route('admin.home_page_content.edit');
            }
        } catch (\Exception $e) {
            Session::flash('alert-message', $e->getMessage());
            Session::flash('alert-class', 'error');
            return redirect()->route('admin.home_page_content.edit');
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
            $homePageContent                       = HomePageContent::where('id', 1)->first();
            if ($homePageContent) {
                $data['homePageContent']           = $homePageContent;
            }
            return view('admin.home_page_content.add', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

}
