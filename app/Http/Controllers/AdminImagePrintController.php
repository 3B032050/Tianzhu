<?php

namespace App\Http\Controllers;

use App\Models\ImagePrint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminImagePrintController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $imagePrints = ImagePrint::orderby('id','ASC')->paginate($perPage);
        $data = ['imagePrints' => $imagePrints];
        return view('admins.image_prints.index',$data);
    }

    public function create()
    {
        return view('admins.image_prints.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:25',
            'image_url' => 'required',
        ]);

        $imagePrint = new ImagePrint;

        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            Storage::disk('image_prints')->put($imageName, file_get_contents($image));

            $imagePrint->image_url = $imageName;
        }
        $imagePrint->name = $request->name;

        $imagePrint->save();

        return redirect()->route('admins.image_prints.index');
    }

    public function edit(ImagePrint $imagePrint)
    {
        $data = [
            'imagePrint'=> $imagePrint,
        ];
        return view('admins.image_prints.edit',$data);
    }

    public function print(ImagePrint $imagePrint)
    {
        $data = [
            'imagePrint'=> $imagePrint,
        ];
        return view('admins.image_prints.print',$data);
    }

    public function preview(ImagePrint $imagePrint)
    {
        $members = User::all();
        $images = [];

        foreach ($members as $member) {
            $manager = new ImageManager(new Driver());
            $image = $manager->read('storage/image_prints/' . $imagePrint->image_url);

            $xCoordinate = 120;
            $yCoordinate = 310;

            $verticalSpacing = 40; //中文间距
            $smallVerticalSpacing = 20; //英文间距

            // Create a cloned image for each member
            $clonedImage = clone $image;

            foreach (mb_str_split($member->name, 1, 'UTF-8') as $char) {
                $fontSize = 24; // 初始字体大小
                $maxWidth = 300; // 设置文字方框最大宽度
                $maxHeight = 100; // 设置文字方框最大高度

                // Get the bounding box of the text
                $bbox = imagettfbbox($fontSize, 0, public_path('fonts/NotoSansTC-Medium.ttf'), $char);

                // Calculate the width and height of the text
                $textWidth = $bbox[2] - $bbox[0];
                $textHeight = $bbox[1] - $bbox[7];

                // Draw a rectangle as background with border
                $clonedImage->rectangle($xCoordinate - 5, $yCoordinate - $textHeight - 5, $xCoordinate + $textWidth + 5, $yCoordinate + 5, function ($draw) {
                    $draw->background('#ffffff'); // 背景颜色
                    $draw->border(1, '#000000'); // 边线颜色和宽度
                });

                // Add text with dynamically adjusted font size
                $clonedImage->text($char, $xCoordinate, $yCoordinate, function ($font) use ($char, $fontSize) {
                    $font->file(public_path('fonts/NotoSansTC-Medium.ttf'));
                    $font->size($fontSize);
                    $font->color('#000000');
                    if (preg_match('/[\p{Han}]/u', $char)) {
                        $font->angle(0);
                    } else {
                        $font->angle(90);
                    }
                });

                // Adjust the vertical position for the next character
                $yCoordinate += (preg_match('/[\p{Han}]/u', $char)) ? $verticalSpacing : $smallVerticalSpacing;
            }

            // Save the modified image
            $fileName = 'output_' . $member->id . '.jpg';
            $clonedImage->save(storage_path('app/public/image_prints/' . $fileName));

            // Store the image URL for display
            $images[] = asset('storage/image_prints/' . $fileName);
        }

        // Pass image URLs to the view
        $data = ['images' => $images];

        // Display the images on the webpage
        return view('admins.image_prints.preview', $data);
    }

    public function downloadMembers(Request $request)
    {
        $members = User::all();
        $zip = new \ZipArchive();
        $zipFileName = 'members_images.zip';
        $zipFilePath = public_path($zipFileName);

        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($members as $key => $member) {
                $imagePath = public_path('path/to/your/output/' . $member->name . '_card.jpg');
                $zip->addFile($imagePath, 'member_' . ($key + 1) . '_card.jpg');
            }
            $zip->close();
        }

        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function update(Request $request, ImagePrint $imagePrint)
    {
        $this->validate($request, [
            'name' => 'required|max:25',
            'image_url' => 'required',
        ]);

        if ($request->hasFile('image_url')) {
            // Delete the old image from storage
            if ($imagePrint->image_url) {
                Storage::disk('image_prints')->delete($imagePrint->image_url);
            }


            // Upload the new image
            $image = $request->file('image_url');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            // Log the image file name

            Storage::disk('image_prints')->put($imageName, file_get_contents($image));

            // Set the new image URL in the Product instance
            $imagePrint->image_url = $imageName;
        }
        $imagePrint->name = $request->name;

        $imagePrint->save();

        return redirect()->route('admins.image_prints.index');
    }

    public function destroy(ImagePrint $imagePrint)
    {
        $imagePrint->delete();
        return redirect()->route('admins.image_prints.index');
    }
}
