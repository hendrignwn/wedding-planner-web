<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Message;
use DB;
use Eventviva\ImageResize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Session;

class MessageController extends Controller
{
	protected $rules = [
		'name' => 'required',
        'file' => 'file|min:1|max:20000|image',
        'thumbnail_file' => 'file|min:1|max:20000|image',
		'description' => 'required',
		'message_at' => 'required',
		'status' => 'required',
	];


	/**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.message.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);
		
		$model = new Message();
		$requestData = $request->all();
		
		$model->fill($requestData);
        $filename = null;
		if (isset($request->file)) {
			$files = $request->file('file');
			$filename = $model->generateFilename($files->getClientOriginalExtension());
			$files->move($model->getPath(), $filename);
            $img = new ImageResize($model->getPath() . $filename);
            $img->resizeToWidth(1280);
            $img->save($model->getPath() . $filename);
			$model->file = $filename;
		}
        
		if (isset($request->thumbnail_file)) {
			$files = $request->file('thumbnail_file');
			$files->move($model->getThumbPath(), $filename);
            $img = new ImageResize($model->getThumbPath() . $filename);
            $img->resizeToWidth(480);
            $img->save($model->getThumbPath() . $filename);
		}
        
        if ($request->active_date != null) {
            $model->start_date = explode(' - ', $request->active_date)[0];
            $model->end_date = explode(' - ', $request->active_date)[1];
        } else {
            $model->start_date = null;
            $model->end_date = null;
        }
        
        if ($request->is_all_date == 1) {
            $model->is_all_date = 1;
        } else {
            $model->is_all_date = 0;
        }
        
		$model->save();
        
        Session::flash('success', 'Message added!');
        
        return redirect('admin/message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *Bank
     * @return View
     */
    public function show($id)
    {
        $model = Message::findOrFail($id);

        return view('admin.message.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return View
     */
    public function edit($id)
    {
        $model = Message::findOrFail($id);

        return view('admin.message.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function update($id, Request $request)
    {
		$rules = $this->rules;
        $rules['file'] = 'file|min:1|max:20000|image';
        $rules['thumbnail_file'] = 'file|min:1|max:20000|image';
        $this->validate($request, $rules);
		
		$model = Message::findOrFail($id);
		
        $requestData = $request->all();
		
		$model->fill($requestData);
        $oldFile = $model->file;
        $filename = null;
		if (isset($request->file)) {
			$files = $request->file('file');
            $model->deleteFile($oldFile);
			$filename = $model->generateFilename($files->getClientOriginalExtension());
			$files->move($model->getPath(), $filename);
            $img = new ImageResize($model->getPath() . $filename);
            $img->resizeToWidth(1280);
            $img->save($model->getPath() . $filename);
			$model->file = $filename;
		}
        
		if (isset($request->thumbnail_file)) {
			$files = $request->file('thumbnail_file');
            $model->deleteThumbFile($oldFile);
			$files->move($model->getThumbPath(), $filename);
            $img = new ImageResize($model->getThumbPath() . $filename);
            $img->resizeToWidth(480);
            $img->save($model->getThumbPath() . $filename);
		}
        
        if ($request->active_date != null) {
            $model->start_date = explode(' - ', $request->active_date)[0];
            $model->end_date = explode(' - ', $request->active_date)[1];
        } else {
            $model->start_date = null;
            $model->end_date = null;
        }
        
        if ($request->is_all_date == 1) {
            $model->is_all_date = 1;
        } else {
            $model->is_all_date = 0;
        }
        
		$model->save();
		
        Session::flash('success', 'Message updated!');

        return redirect('admin/message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        $model = Message::findOrFail($id);
        $model->deleteAllFiles();
        $model->delete();
        
        Session::flash('success', 'Message deleted!');

        return redirect('admin/message');
    }
	
	/**
	 * any data
	 */
	public function listIndex(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $model = Message::select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'message.*'
				]);

         $datatables = app('datatables')->of($model)
            ->editColumn('status', function ($model) {
                return $model->getStatusLabel();
            })
            ->editColumn('file', function ($model) {
                return $model->getFileThumbImg();
            })
            ->addColumn('action', function ($model) {
                return '<a href="'.route('message.show', ['id'=>$model->id]).'" class="btn btn-xs btn-success rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-eye"></i></a> '
						. '<a href="'.route('message.edit', ['id'=>$model->id]).'" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> '
						. '<a onclick="modalDelete('.$model->id.')" href="javascript:;" class="btn btn-xs btn-danger rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.delete') .'"><i class="fa fa-trash"></i></a>';
            });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

//        if ($range = $datatables->request->get('range')) {
//            $rang = explode(":", $range);
//            if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] != $rang[1]){
//                $datatables->whereBetween('message.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
//            }else if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] == $rang[1]) {
//                $datatables->whereBetween('message.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
//            }
//        }
		
        return $datatables->make(true);
    }
}
