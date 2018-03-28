<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * Bank
     * @return View
     */
    public function index($id, $userRelationId)
    {
        $model = \App\Concept::findOrFail($id);
        
        return view('admin.content.index', compact('id', 'userRelationId', 'model'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * Bank
     * @return View
     */
    public function show($id)
    {
        $model = \App\Content::findOrFail($id);

        return view('admin.content.show', compact('model'));
    }
    
	/**
	 * any data
	 */
	public function listIndex($id, $userRelationId, Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $model = Content::with(['user', 'userRelation'])
                ->select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'content.*', 'content.order AS order'
				])
                ->where('content.concept_id', $id)
                ->where('content.user_relation_id', $userRelationId);

         $datatables = app('datatables')->of($model)
            ->addColumn('action', function ($model) {
                return '<a href="'.route('content.show', ['id' => $model->id]).'" class="btn btn-xs btn-success rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-eye"></i></a> ';
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
