<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Image;

class HomeSliderController extends Controller
{
    public function HomeSlider(Request $request)
    {

        // $homeslide = HomeSlide::all();
        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeslide'));
    }

    public function CreateSlider(Request $request)
    {
        return view('admin.home_slide.home_slide_create', []);
    }

    public function StoreSlider(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'short_title' => ['required'],
            'video_url' => ['required'],
            'home_slide' => ['required', File::image()->dimensions(Rule::dimensions()->maxWidth(1000)->maxHeight(1000))]
        ]);

        $sliderImage = '';
        if ($request->file('home_slide')) {
            $sliderImage = time() . '_slide.' . $request->file('home_slide')->extension();
            $request->file('home_slide')->move(public_path('slides'), $sliderImage);
        }
        HomeSlide::create([
            'title' => $request->title,
            'video_url' => $request->video_url,
            'short_title' => $request->short_title,
            'home_slide' => $sliderImage
        ]);

        $notification = array(
            'message' => 'Slide saved Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('home.slide')->with($notification);
    }

    public function UpdateSlider(Request $request, HomeSlide $slide)
    {
        $slideData = [
            'title' => $request->title,
            'short_title' => $request->short_title,
            'video_url' => $request->video_url,
        ];
        $msg = 'Home Slide Updated without Image Successfully';
        if ($request->file('home_slide')) {
            $image = $request->file('home_slide');
            $sliderImage = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $request->file('home_slide')->move(public_path('slides'), $sliderImage);
            // Image::make($image)->resize(636, 852)->save('slides/636_852/' . $sliderImage);
            // Image::make($image)->save('slides/' . $sliderImage);
            $slideData['home_slide'] = $sliderImage;
            $msg = 'Home Slide Updated with Image Successfully';
        }
        $slide->update($slideData);
        $notification = array(
            'message' => $msg,
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
