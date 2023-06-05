<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\ContactUsForm;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\HomePageContent;
use App\Models\HomePageSlider;
use App\Models\Schedule;
use App\Models\ScheduleRegisterUserData;
use Illuminate\Http\Request;
use Mail;
use App\Rules\GoogleRecaptcha;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $data = [];
            $data['homePageContent'] = HomePageContent::find(1);
            $data['upcomming_schedule'] = Schedule::whereDate('date_time', '>=', date('Y-m-d'))->where('status', 1)->get();
            $data['galleryData'] = HomePageSlider::inRandomOrder()->limit(48)->where('status', 1)->get();
            return view('front.home', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function about_us()
    {
        try {
            $data = [];
            $data['about_us'] = AboutUs::find(1);
            return view('front.about_us', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function contact_us()
    {
        try {
            $data = [];
            $data['contact_us'] = ContactUs::find(1);
            return view('front.contact_us', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function schedule($city = '')
    {
        try {
            $data = [];
            $upcomming_schedule = Schedule::whereDate('date_time', '>=', date('Y-m-d'))->where('status', 1);
            if ($city != '') {
                $upcomming_schedule->whereHas('city', function($query) use($city){
                    $query->where('name', $city);
                });
            }
            $data['upcomming_schedule'] = $upcomming_schedule->get();
            $data['cities'] = City::where('status', 1)->get();
            $data['active_city'] = $city;
            return view('front.upcomming_schedule', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function schedule_details($slug)
    {
        try {
            $data = [];
            $schedule_details = Schedule::where('slug', $slug)->where('status', 1)->first();
            $faqs = Faq::where('status', 1)->get();
            if ($schedule_details) {
                $data['schedule_details'] = $schedule_details;
                $data['faqs'] = $faqs;
                return view('front.upcomming_schedule_details', $data);
            }
            return abort(404);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function schedule_register_post(Request $request)
    {
        try {
            $exist = ScheduleRegisterUserData::where('email', $request->email)->count();
            if ($exist > 0) {
                return response()->json(['status' => false, 'message' => 'Yor are already registered.']);
            }
            $register = new ScheduleRegisterUserData();
            $register->full_name = $request->full_name;
            $register->mobile = $request->mobile;
            $register->email = $request->email;
            $register->city = $request->city;
            $register->schedule_id = $request->schedule_id;
            if ($register->save()) {
                return response()->json(['status' => true, 'message' => 'Than you for register.']);
            }
            return response()->json(['status' => false, 'message' => 'Something went wrong!!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function contact_us_post(Request $request)
    {
        try {
            $this->validate($request, [
                'g-recaptcha-response' => ['required', new GoogleRecaptcha]
            ]);
            $contact_us = new ContactUsForm();
            $contact_us->name = $request->name;
            $contact_us->mobile = $request->mobile;
            $contact_us->email = $request->email;
            $contact_us->city = $request->city;
            $contact_us->message = $request->message;
            if ($contact_us->save()) {
                Mail::send('email.contact_us', ['contact_us' => $contact_us], function($message) {
                    $message->to(env('MAIL_ADMIN_ADDRESS'), env('APP_NAME'))->subject
                       ('Contact US Form');
                    $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
                 });
                return response()->json(['status' => true, 'message' => 'Than you for contact us. We will connect soon']);
            }
            return response()->json(['status' => false, 'message' => 'Something went wrong!!']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function completed_schedule($city = '')
    {
        try {
            $data = [];
            $completed_schedule = Schedule::whereDate('date_time', '<', date('Y-m-d'))->where('status', 1);
            if ($city != '') {
                $completed_schedule->whereHas('city', function($query) use($city){
                    $query->where('name', $city);
                });
            }
            $data['completed_schedule'] = $completed_schedule->get();
            $data['cities'] = City::where('status', 1)->get();
            $data['active_city'] = $city;
            return view('front.completed_schedule', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function gallery()
    {
        try {
            $data = [];
            $data['gallery'] = Gallery::where('status', 1)->get();
            return view('front.gallery', $data);
        } catch (\Exception $e) {
            return abort(404);
        }
    }
}
