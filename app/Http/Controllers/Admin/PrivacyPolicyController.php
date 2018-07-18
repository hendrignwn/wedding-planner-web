<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use App\Procedure;
use DB;
use Eventviva\ImageResize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Session;

class PrivacyPolicyController extends Controller
{
	protected $rules = [
		'name' => 'required',
		'description' => 'required',
	];


	/**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return redirect(route('privacy-policy.edit', ['id' => Page::CATEGORY_PRIVACY_POLICY]));
        return view('admin.privacy-policy.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.privacy-policy.create');
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
		
		$model = new Procedure();
		$requestData = $request->all();
		
        $model->fill($requestData);
		if (isset($request->file)) {
			$files = $request->file('file');
			$filename = $model->generateFilename($files->getClientOriginalExtension());
			$files->move($model->getPath(), $filename);
            $img = new ImageResize($model->getPath() . $filename);
            $img->resizeToWidth(1280);
            $img->save($model->getPath() . $filename);
			$model->file = $filename;
		}
		$model->save();
		
        Session::flash('success', 'Procedure added!');
        
        return redirect('admin/privacy-policy');
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
        $model = Page::findOrFail($id);

        return view('admin.privacy-policy.show', compact('model'));
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
        $model = Page::findOrFail($id);

        return view('admin.privacy-policy.edit', compact('model'));
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
        $this->validate($request, $rules);
		
		$model = Page::findOrFail($id);
		
        $requestData = $request->all();
		
		$model->fill($requestData);
		$model->save();
		
        Session::flash('success', 'Term of Use updated!');

        return redirect(route('privacy-policy.edit', ['id' => $model->id]));
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
        return redirect('admin/privacy-policy');
		
        Session::flash('success', 'Procedure deleted!');

        return redirect('admin/privacy-policy');
    }
	
	/**
	 * any data
	 */
	public function listIndex(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $model = Page::select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'page.*'
				])
                ->whereCategory(Page::CATEGORY_PRIVACY_POLICY);

         $datatables = app('datatables')->of($model)
            ->addColumn('action', function ($model) {
                return '<a href="privacy-policy/'.$model->id.'/edit" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> ';
            });

        if ($keyword = $request->get('search')['value']) {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        }

//        if ($range = $datatables->request->get('range')) {
//            $rang = explode(":", $range);
//            if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] != $rang[1]){
//                $datatables->whereBetween('privacy-policy.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
//            }else if($rang[0] != "Invalid date" && $rang[1] != "Invalid date" && $rang[0] == $rang[1]) {
//                $datatables->whereBetween('privacy-policy.created_at', ["$rang[0] 00:00:00", "$rang[1] 23:59:59"]);
//            }
//        }
		
        return $datatables->make(true);
    }
}
