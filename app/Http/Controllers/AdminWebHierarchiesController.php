<?php

namespace App\Http\Controllers;

use App\Models\Web_hierarchy;
use App\Models\Web_content;
use Illuminate\Http\Request;

class AdminWebHierarchiesController extends Controller
{
    public function index()
    {
        $web_hierarchies = Web_hierarchy::orderby('web_id','ASC')->get();
        $data = ['web_hierarchies' => $web_hierarchies];
        return view('admins.web_hierarchies.index', $data);
    }

    public function create($web_id)
    {
        $web_hierarchy = Web_hierarchy::where('web_id',$web_id)->first();
        $data = ['web_hierarchy' => $web_hierarchy];
        return view('admins.web_hierarchies.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'web_id' => 'required',
            'parent_id' => 'required',
            'title' => 'required',
        ]);

        # 判斷如果web_id是否重複
        $existingWebId = Web_hierarchy::where('web_id', $request->input('web_id'))->exists();
        if (!$existingWebId)
        {
            # 如果web_id沒有重複就輸入至資料庫
            Web_hierarchy::create($request->all());
            Web_content::create([
                'web_id' => $request->web_id,
                'content' => '輸入內容..',
            ]);
        }
        else
        {
            # 如果web_id重複就不放進資料庫
            return redirect()->back()->with('error', 'Web ID already exists');
        }
        return redirect()->route('admins.web_hierarchies.index');
    }

    public function edit($web_id)
    {
        $web_hierarchy = Web_hierarchy::where('web_id',$web_id)->first();
        $data = [
            'web_hierarchy'=> $web_hierarchy,
        ];
        return view('admins.web_hierarchies.edit',$data);
    }


    public function update(Request $request, Web_hierarchy $web_hierarchy)
    {
        $this->validate($request,[
            'web_id' => 'required',
            'parent_id' => 'required',
            'title' => 'required',
        ]);

        $web_hierarchy->update($request->all());
        return redirect()->route('admins.web_hierarchies.index');
    }

    public function destroy($web_hierarchy)
    {
        // Check if the hierarchy has child elements
        $childHierarchies = Web_Hierarchy::where('parent_id', $web_hierarchy)->get();

        if ($childHierarchies->count() > 0) {
            return redirect()->back()->with('error', '此目錄下含有子階層，不可刪除');
        }

        // Retrieve the hierarchy to be deleted
        $hierarchyToDelete = Web_Hierarchy::where('web_id', $web_hierarchy)->first();

        if ($hierarchyToDelete) {
            // Delete the hierarchy
            $hierarchyToDelete->delete();

//            // Delete associated Web_content
//            $hierarchyToDelete->Web_content::delete();

            // Update the web_id of child hierarchies with greater values
            $parentHierarchies = Web_Hierarchy::where('parent_id', $hierarchyToDelete->parent_id)->get();

            foreach ($parentHierarchies as $parentHierarchy) {
                $checkId = explode('.', $parentHierarchy->web_id);
                $checkCount = count($checkId);
                $checkResult = end($checkId);

                if ($checkResult > $hierarchyToDelete->web_id) {
                    $checkId[$checkCount - 1] = $checkResult - 1;
                    $checkAfter = implode('.', $checkId);

                    // Update the web_id of the child hierarchy
                    $parentHierarchy->update(['web_id' => $checkAfter]);
                }
            }
        }
        return redirect()->route('admins.web_hierarchies.index');
    }

    public function web_print($tree, $rootId=0 , $level=0)
    {
        foreach ($tree as $leaf) {
            if ($leaf['parent_id'] == $rootId) {
                echo "<span style='font-size: 20px;'>";
                echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                echo $leaf['web_id'] . "&nbsp;" . $leaf['web_title'];
                echo "<a href='" . route('admins.web_hierarchies.create', ['web_id' => $leaf['web_id']]) . "'><font size='2px'>新增子階層</font></a>&nbsp";
                echo "<a href='" . route('admins.web_hierarchies.edit', ['web_hierarchy' => $leaf['web_id']]) . "'><font size='2px'>修改</font></a>&nbsp";
                // Form for deleting hierarchy
                echo "<form method='POST' action='".route('admins.web_hierarchies.destroy', ['web_hierarchy' => $leaf['web_id']])."' style='display:inline;'>";
                echo csrf_field();
                echo method_field('DELETE');
                echo "<button type='submit'>刪除</button>";
                echo "</form>";
                echo "<a href=". route('admins.web_contents.edit',['web_content' => $leaf['web_id']]).">編輯網頁內容</a>";
                echo "<br>";

                echo "</span>";

                foreach ($tree as $l) {
                    if ($l['parent_id'] == $leaf['web_id'])
                    {
                        if ($leaf['web_id'] != 0) {
                            $this->web_print($tree, $leaf['web_id'], $level + 1);
                            break;
                        }
                    }
                }
            }
            elseif ($leaf['parent_id'] == 'none' and $rootId == 0)
            {
                echo "<span style='font-size: 20px;'>";
                echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                echo $leaf['web_title'];
                echo "<a href='" . route('admins.web_hierarchies.create', ['web_id' => $leaf['web_id']]) . "'><font size='2px'>新增子階層</font></a><br>";
                echo "</span>";
            }
        }
    }

    function adding($hierarchy_id)
    {
        $maximum = 0;

        // Use Eloquent to query the database
        $webHierarchies = Web_Hierarchy::where('parent_id', $hierarchy_id)->get();

        if ($webHierarchies->count() > 0) {
            foreach ($webHierarchies as $webHierarchy) {
                if ($hierarchy_id == 0) {
                    if ($webHierarchy->web_id > $maximum) {
                        $maximum = $webHierarchy->web_id;
                    }
                } else {
                    $array_id = explode(".", $webHierarchy->web_id);
                    $array_count = count($array_id);
                    $array_create = $array_id[$array_count - 1];
                    if ($array_create > $maximum) {
                        $maximum = $array_create;
                    }
                }
            }

            if ($hierarchy_id == 0) {
                $array_after = $maximum + 1;
            } else {
                $array_id[$array_count - 1] = $maximum + 1;
                $array_after = implode(".", $array_id);
            }
        } else {
            if ($hierarchy_id == '0') {
                $array_after = $hierarchy_id + 1;
            } else {
                $array_after = $hierarchy_id . ".1";
            }
        }

        return $array_after;
    }
}
