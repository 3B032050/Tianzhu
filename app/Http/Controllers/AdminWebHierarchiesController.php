<?php

namespace App\Http\Controllers;

use App\Models\Web_hierarchy;
use Illuminate\Http\Request;

class AdminWebHierarchiesController extends Controller
{
    public function index()
    {
        $web = Web_hierarchy::all();
        $data = ['web' => $web];

        return view('admins.web_hierarchies.index', $data);
    }

    public function web_print($tree, $rootId=0 , $level=0)
    {
        foreach ($tree as $leaf) {
            if ($leaf['parent_id'] == $rootId) {
                echo "<span style='font-size: 20px;'>";
                if ($leaf['web_id'] == 0) {
                    echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                    echo "<a href='" . route('web_hierarchy.add', ['web_id' => $leaf['web_id']]) . "'><button>+</button></a>";
                    echo $leaf['web_title'];
                    echo "<a href='" . route('web_hierarchy.adding', ['web_id' => $leaf['web_id']]) . "'><font size='2px'>新增子階層</font></a><br>";
                } else {
                    echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                    echo $leaf['web_id'] . "&nbsp;" . $leaf['web_title'];
                    echo "<a href='" . route('web_hierarchy.adding', ['web_id' => $leaf['web_id']]) . "'><font size='2px'>新增子階層</font></a><br>";
                }
                echo "</span>";

                if (!request()->has('zoom_out')) {
                    foreach ($tree as $l) {
                        if ($l['parent_id'] == $leaf['web_id']) {
                            if ($leaf['web_id'] != 0) {
                                $this->web_print($tree, $leaf['web_id'], $level + 1);
                                break;
                            }
                        }
                    }
                }

                if (request()->has('adding') && $leaf['web_id'] == request('adding')) {
                    $array_after = adding(request('adding'));
                    echo "<form method='get' action='" . route('web_hierarchy.add', ['web_id' => $leaf['web_id']]) . "'>";
                    echo "<input type='hidden' name='parent_id' value='" . $leaf['web_id'] . "'>";
                    echo $array_after;
                    echo "<input type='hidden' name='web_id' value='$array_after'>";
                    echo "<input type='text' name='web_title' padding='15px'>";
                    echo "<input type='submit' name='hierarchy_add_submit' value='新增'>";
                    echo "<input type='submit' name='hierarchy_add_cancel' value='取消'>";
                    echo "</form>";
                }
            }
        }
    }
}
