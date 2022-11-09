<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
use Image;

class AboutController extends Controller
{
    public function AboutPage()
    {

        $aboutpage = About::find(1);
        return view('admin.about_page', compact('aboutpage'));
    } // End Method 



    public function UpdateAbout(Request $request)
    {

        $about_id = $request->id;

        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // 3434343443.jpg

            // Image::make($image)->resize(523,605)->save('upload/home_about/'.$name_gen);
            $image->move(public_path('upload/home_about/'), $name_gen);;
            $save_url = 'upload/home_about/' . $name_gen;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,

            ]);
            $notification = array(
                'message' => 'About Page Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else {

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,

            ]);
            $notification = array(
                'message' => 'About Page Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } // end Else

    } // End Method 


    public function HomeAbout()
    {

        $aboutpage = About::find(1);
        return view('frontend.about_page', compact('aboutpage'));
    } // End Method 



    public function AboutMultiImage()
    {

        return view('admin.multimage');
    } // End Method 


    public function StoreMultiImage(Request $request)
    {

        $image = $request->file('multi_image');

        foreach ($image as $multi_image) {

            $name_gen = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();  // 3434343443.jpg

            // Image::make($multi_image)->resize(220, 220)->save('upload/multi/' . $name_gen);
            $multi_image->move(public_path('upload/multi/'), $name_gen);;
            $save_url = 'upload/multi/' . $name_gen;

            MultiImage::insert([

                'multi_image' => $save_url,
                'created_at' => Carbon::now()

            ]);
        } // End of the froeach


        $notification = array(
            'message' => 'Multi Image Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.multi.image')->with($notification);
    } // End Method 

    public function AllMultiImage()
    {

        $allMultiImage = MultiImage::all();
        return view('admin.all_multiimage', compact('allMultiImage'));
    } // End Method 

    public function EditMultiImage($id)
    {

        $multiImage = MultiImage::findOrFail($id);
        return view('admin.edit_multi_image', compact('multiImage'));
    } // End Method 

    public function UpdateMultiImage(Request $request)
    {

        $multi_image_id = $request->id;

        if ($request->file('multi_image')) {
            $image = $request->file('multi_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();  // 3434343443.jpg

            //  Image::make($image)->resize(220,220)->save('upload/multi/'.$name_gen);
            $image->move(public_path('upload/multi/'), $name_gen);;
            $save_url = 'upload/multi/' . $name_gen;

            MultiImage::findOrFail($multi_image_id)->update([

                'multi_image' => $save_url,

            ]);
            $notification = array(
                'message' => 'Multi Image Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.multi.image')->with($notification);
        }
    } // End Method 


    public function DeleteMultiImage($id)
    {

        $multi = MultiImage::findOrFail($id);
        $img = $multi->multi_image;
        unlink($img);

        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 
}
