<?php

namespace App\Http\Controllers\Admin;

use App\ContentDetail;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentDetailController extends Controller
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
        $model = \App\ContentDetail::findOrFail($id);

        return view('admin.content-detail.show', compact('model'));
    }
    
	/**
	 * any data
	 */
	public function listIndex($id, Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $model = ContentDetail::select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'content_detail.*'
				])
                ->where('content_detail.content_id', $id);

         $datatables = app('datatables')->of($model)
            ->addColumn('action', function ($model) {
                return '<a href="content-detail/'.$model->id.'" class="btn btn-xs btn-success rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-eye"></i></a> ';
						//. '<a href="user-relation/'.$model->id.'/edit" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> ';
						//. '<a href="#" onclick="modalDelete('.$model->id.')" class="btn btn-xs btn-danger rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.delete') .'"><i class="fa fa-trash-o"></i></a>';
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
