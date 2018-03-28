<?php

namespace App\Http\Controllers\Admin;

use App\ContentDetailList;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentDetailListController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * Bank
     * @return View
     */
    public function show($id)
    {
        $model = ContentDetailList::findOrFail($id);

        return view('admin.content-detail-list.show', compact('model'));
    }
    
	/**
	 * any data
	 */
	public function listIndex($id, Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $model = ContentDetailList::select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'content_detail_list.*'
				])
                ->where('content_detail_list.content_detail_id', $id);

         $datatables = app('datatables')->of($model)
            ->editColumn('value', function ($model) {
                return $model->getValueUrl();
            })
            ->addColumn('action', function ($model) {
                return '';
            });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

//        if ($range = $datatables->request->get('range')) {
//            $rang = explode(":", $range);
//            if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] != $rang[1]){
//                $datatables->whereBetween('user-relation.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
//            }else if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] == $rang[1]) {
//                $datatables->whereBetween('user-relation.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
//            }
//        }
		
        return $datatables->make(true);
    }
}
