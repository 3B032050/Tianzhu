<?php

namespace App\Http\Controllers;

use App\Models\ImagePrint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Dompdf\Dompdf;
use Dompdf\Options;



class AdminImagePrintController extends Controller
{
    public function index(Request $request)
    {
        $imagePrints = ImagePrint::orderby('id','ASC')->get();
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

//    public function preview(ImagePrint $imagePrint)
//    {
//        $members = User::all();
//        $images = [];
//
//        foreach ($members as $member) {
//            $manager = new ImageManager(new Driver());
//            $image = $manager->read('storage/image_prints/' . $imagePrint->image_url);
//
//            $xCoordinate = 120;
//            $yCoordinate = 310;
//
//            $verticalSpacing = 40; //中文间距
//            $smallVerticalSpacing = 20; //英文间距
//
//            // Create a cloned image for each member
//            $clonedImage = clone $image;
//
//            foreach (mb_str_split($member->name, 1, 'UTF-8') as $char) {
//                $fontSize = 24; // 初始字体大小
//                $maxWidth = 300; // 设置文字方框最大宽度
//                $maxHeight = 100; // 设置文字方框最大高度
//
//                // Get the bounding box of the text
//                $bbox = imagettfbbox($fontSize, 0, public_path('fonts/NotoSansTC-Medium.ttf'), $char);
//
//                // Calculate the width and height of the text
//                $textWidth = $bbox[2] - $bbox[0];
//                $textHeight = $bbox[1] - $bbox[7];
//
//                // Draw a rectangle as background with border
//                $clonedImage->rectangle($xCoordinate - 5, $yCoordinate - $textHeight - 5, $xCoordinate + $textWidth + 5, $yCoordinate + 5, function ($draw) {
//                    $draw->background('#ffffff'); // 背景颜色
//                    $draw->border(1, '#000000'); // 边线颜色和宽度
//                });
//
//                // Add text with dynamically adjusted font size
//                $clonedImage->text($char, $xCoordinate, $yCoordinate, function ($font) use ($char, $fontSize) {
//                    $font->file(public_path('fonts/NotoSansTC-Medium.ttf'));
//                    $font->size($fontSize);
//                    $font->color('#000000');
//                    if (preg_match('/[\p{Han}]/u', $char)) {
//                        $font->angle(0);
//                    } else {
//                        $font->angle(90);
//                    }
//                });
//
//                // Adjust the vertical position for the next character
//                $yCoordinate += (preg_match('/[\p{Han}]/u', $char)) ? $verticalSpacing : $smallVerticalSpacing;
//            }
//
//            // Save the modified image
//            $fileName = 'output_' . $member->id . '.jpg';
//            $clonedImage->save(storage_path('app/public/image_prints/' . $fileName));
//
//            // Store the image URL for display
//            $images[] = asset('storage/image_prints/' . $fileName);
//        }
//
//        // Pass image URLs to the view
//        $data = ['images' => $images];
//
//        // Display the images on the webpage
//        return view('admins.image_prints.preview', $data);
//    }

    public function preview(ImagePrint $imagePrint)
    {
        if($imagePrint -> name === '超薦')
        {
            $members = User::all();
            $images = [];
            $memberCount = 0; // 計數器，用於每六個人執行一次圖片處理

            // 設定圖片中文字的初始位置
            $xCoordinate = 195;
            $yCoordinate = 360;
            $xCoordinate_yang = 70;
            $yCoordinate_yang = 360;
            $xCoordinate_address = 330;
            $yCoordinate_address = 260;
            $verticalSpacing = 40; //中文间距
            $smallVerticalSpacing = 20; //英文间距

            // 初始化圖片管理器
            $manager = new ImageManager(new Driver());
            $image = $manager->read('images/' . $imagePrint->image_url);
            $clonedImage = clone $image;

            foreach ($members as $member) {
                // 遍歷會員資料並將其印在圖片上
                foreach (mb_str_split($member->name, 1, 'UTF-8') as $char) {
                    // 將會員名稱印在圖片上
                    $clonedImage->text($char, $xCoordinate, $yCoordinate, function ($font) use ($char) {
                        $font->file(public_path('fonts/NotoSansTC-Medium.ttf'));
                        $font->size(24);
                        $font->color('#000000');
                        if (preg_match('/[\p{Han}]/u', $char)) {
                            $font->angle(0);
                        } else {
                            $font->angle(90);
                        }
                    });
                    // 調整文字位置
                    $yCoordinate += (preg_match('/[\p{Han}]/u', $char)) ? $verticalSpacing : $smallVerticalSpacing;
                }

                foreach (mb_str_split($member->name, 1, 'UTF-8') as $char2) {
                    $fontSize = 24; // 初始字体大小

                    $clonedImage->text($char2, $xCoordinate_yang, $yCoordinate_yang, function ($font) use ($char2, $fontSize) {
                        $font->file(public_path('fonts/NotoSansTC-Medium.ttf'));
                        $font->size($fontSize);
                        $font->color('#000000');
                        if (preg_match('/[\p{Han}]/u', $char2)) {
                            $font->angle(0);
                        } else {
                            $font->angle(90);
                        }
                    });

                    // Adjust the vertical position for the next character
                    $yCoordinate_yang += (preg_match('/[\p{Han}]/u', $char2)) ? $verticalSpacing : $smallVerticalSpacing;
                }


                foreach (mb_str_split($member->address, 1, 'UTF-8') as $char1) {
                    $fontSize = 24; // 初始字体大小

                    $clonedImage->text($char1, $xCoordinate_address, $yCoordinate_address, function ($font) use ($char1, $fontSize) {
                        $font->file(public_path('fonts/NotoSansTC-Medium.ttf'));
                        $font->size($fontSize);
                        $font->color('#000000');
                        if (preg_match('/[\p{Han}]/u', $char1)) {
                            $font->angle(0);
                        } else {
                            $font->angle(90);
                        }
                    });

                    // Adjust the vertical position for the next character
                    $yCoordinate_address += (preg_match('/[\p{Han}]/u', $char1)) ? $verticalSpacing : $smallVerticalSpacing;
                }

                // 額外的處理，根據您的需求進行修改
                $xCoordinate += 400;
                $xCoordinate_yang += 400;
                $xCoordinate_address += 400;



                // 增加會員計數
                $memberCount++;

                if($memberCount < 3 ){
                    $yCoordinate = 360;
                    $yCoordinate_yang = 360;
                    $yCoordinate_address = 260;
                }
                else if ($memberCount % 3 === 0) {
                    $xCoordinate = 195;
                    $yCoordinate = 1200;
                    $xCoordinate_yang = 70;
                    $yCoordinate_yang = 1200;
                    $xCoordinate_address = 330;
                    $yCoordinate_address = 1080;
                }
                else{
                    $yCoordinate = 1200;
                    $yCoordinate_yang = 1200;
                    $yCoordinate_address = 1080;
                }


                // 每六個會員執行一次處理
                if ($memberCount % 6 === 0) {
                    $memberCount = 0;
                    // 保存修改後的圖片
                    $fileName = 'output_超薦' . $member->id . '.jpg';
                    $clonedImage->save(storage_path('app/public/image_prints/' . $fileName));
                    // 存儲圖片URL
                    $images[] = asset('storage/image_prints/' . $fileName);
                    // 重置圖片以便下一組會員
                    $clonedImage = clone $image;

                    // 重置文字位置
                    $xCoordinate = 195;
                    $yCoordinate = 360;
                    $xCoordinate_yang = 70;
                    $yCoordinate_yang = 360;
                    $xCoordinate_address = 330;
                    $yCoordinate_address = 260;
                }


            }
            if ($memberCount % 6 !== 0) {
                // 保存修改後的圖片
                $fileName = 'output_超薦' . $member->id . '.jpg';
                $clonedImage->save(storage_path('app/public/image_prints/' . $fileName));
                // 存儲圖片URL
                $images[] = asset('storage/image_prints/' . $fileName);
            }
        }
        else
        {
            $members = User::all();
            $images = [];
            $memberCount = 0; // 計數器，用於每六個人執行一次圖片處理

            // 設定圖片中文字的初始位置
            $xCoordinate = 195;
            $yCoordinate = 380;

            $xCoordinate_address = 340;
            $yCoordinate_address = 220;

            $verticalSpacing = 40; //中文间距
            $smallVerticalSpacing = 20; //英文间距

            // 初始化圖片管理器
            $manager = new ImageManager(new Driver());
            $image = $manager->read('images/' . $imagePrint->image_url);
            $clonedImage = clone $image;

            foreach ($members as $member) {
                // 遍歷會員資料並將其印在圖片上
                foreach (mb_str_split($member->name, 1, 'UTF-8') as $char) {
                    // 將會員名稱印在圖片上
                    $clonedImage->text($char, $xCoordinate, $yCoordinate, function ($font) use ($char) {
                        $font->file(public_path('fonts/NotoSansTC-Medium.ttf'));
                        $font->size(24);
                        $font->color('#000000');
                        if (preg_match('/[\p{Han}]/u', $char)) {
                            $font->angle(0);
                        } else {
                            $font->angle(90);
                        }
                    });
                    // 調整文字位置
                    $yCoordinate += (preg_match('/[\p{Han}]/u', $char)) ? $verticalSpacing : $smallVerticalSpacing;
                }

                foreach (mb_str_split($member->address, 1, 'UTF-8') as $char1) {
                    $fontSize = 24; // 初始字体大小

                    $clonedImage->text($char1, $xCoordinate_address, $yCoordinate_address, function ($font) use ($char1, $fontSize) {
                        $font->file(public_path('fonts/NotoSansTC-Medium.ttf'));
                        $font->size($fontSize);
                        $font->color('#000000');
                        if (preg_match('/[\p{Han}]/u', $char1)) {
                            $font->angle(0);
                        } else {
                            $font->angle(90);
                        }
                    });

                    // Adjust the vertical position for the next character
                    $yCoordinate_address += (preg_match('/[\p{Han}]/u', $char1)) ? $verticalSpacing : $smallVerticalSpacing;
                }

                // 額外的處理，根據您的需求進行修改
                $xCoordinate += 410;
                $xCoordinate_address += 420;

                // 增加會員計數
                $memberCount++;

                if($memberCount < 3 ){
                    $yCoordinate = 380;
                    $yCoordinate_address = 220;
                }
                else if ($memberCount % 3 === 0) {
                    $xCoordinate = 195;
                    $yCoordinate = 1240;
                    $xCoordinate_address = 330;
                    $yCoordinate_address = 1080;
                }
                else{
                    $yCoordinate = 1240;
                    $yCoordinate_address = 1080;
                }


                // 每六個會員執行一次處理
                if ($memberCount % 6 === 0) {
                    $memberCount = 0;
                    // 保存修改後的圖片
                    $fileName = 'output_消災' . $member->id . '.jpg';
                    $clonedImage->save(storage_path('app/public/image_prints/' . $fileName));
                    // 存儲圖片URL
                    $images[] = asset('storage/image_prints/' . $fileName);
                    // 重置圖片以便下一組會員
                    $clonedImage = clone $image;

                    // 重置文字位置
                    $xCoordinate = 195;
                    $yCoordinate = 380;
                    $xCoordinate_address = 330;
                    $yCoordinate_address = 220;
                }


            }
            if ($memberCount % 6 !== 0) {
                // 保存修改後的圖片
                $fileName = 'output_消災' . $member->id . '.jpg';
                $clonedImage->save(storage_path('app/public/image_prints/' . $fileName));
                // 存儲圖片URL
                $images[] = asset('storage/image_prints/' . $fileName);
            }
        }


        // 將圖片URL傳遞給視圖
        $data = ['images' => $images];

        // 在網頁上顯示圖片
        return view('admins.image_prints.preview', $data);
    }

    public function download()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true); // 啟用 HTML5 解析器
        $options->set('isRemoteEnabled', true);
        $pdf = new Dompdf($options);
        // 添加 PDF 內容
        $html = '<html><body>';
        $imagePath = public_path('storage/image_prints/');
        $files = scandir($imagePath);

        $images = [];
        foreach ($files as $file) {
            // 檢查檔案是否為圖片檔案
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
                $images[] = $file;
            }
        }
        foreach ($images as $image) {

            $imagePath = public_path('storage/image_prints/'.$image); // 存儲目錄的路徑

            $imageContent = file_get_contents($imagePath); // 不包含存儲目錄路徑
            // 將圖片內容轉換為 base64 編碼
            $base64Image = base64_encode($imageContent);
            // 添加圖片到 HTML
            $html .= '<img src="data:image/jpg;base64,' . $base64Image . '"style="width: 100%; height: 100%;" />';
        }

        $html .= '</body></html>';

        $pdf->loadHtml($html);

        // 渲染 PDF
        $pdf->render();

        // 將 PDF 寫入文件
        $pdf->stream('output.pdf', array('Attachment' => 0));


//        if ($request->hasFile('image')) {
//            $image = $request->file('image');
//            $imageName = time() . '.' . $image->getClientOriginalExtension();
//            $image->move(public_path('images'), $imageName); // 將圖片保存到 public/images 文件夾中
//        } else {
//
//        }
//
//        // 加載 PDF 相關選項
//        $options = new Options();
//        $options->set('isHtml5ParserEnabled', true);
//        $options->set('isRemoteEnabled', true);
//
//        // 初始化 Dompdf
//        $dompdf = new Dompdf($options);
//
//        // 動態生成視圖並傳遞圖片路徑
//        $html = view('admins.image_prints.preview', ['imagePath' => public_path('images/' . $imageName)])->render();
//
//        // 載入 HTML 內容
//        $dompdf->loadHtml($html);
//
//        // 渲染 PDF
//        $dompdf->render();
//
//        // 下載 PDF
//        return $dompdf->stream('preview.pdf');
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
