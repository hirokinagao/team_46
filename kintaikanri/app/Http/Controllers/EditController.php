<?php

// 宮内専用

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\DB;


class EditController extends Controller
{
    /**
     * 
     * 編集画面表示用テストメソッド（ ⇒ 長尾さんのページが完成次第、正式なコードに変更予定）
     * 
     */
    public function edit(Request $request)
    {
        //$requestの情報を代入
        $id = $request->session()->get('id');
        $name = $request->session()->get('name');
        $role = $request->session()->get('role');
        $work_id = $request->session()->get('work_id');
        
        $view = view('edit', [
            'user_name' => $name,   //ここから下3つはheader用に渡すデータ(各画面共通)
            'user_role' => $role,
            'work_id' => $work_id,
        ]);
        return $view;
    }


    /**
     * 編集機能
     * 
     * @param Request $request 
     * @return Response
     */
    // public function メソッド名(Request $request)
    // {

    // }






}
