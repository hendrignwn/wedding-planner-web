<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserHasCategory;
use App\Http\Controllers\Controller;
use DB;
use Eventviva\ImageResize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Session;

class UserRelationController extends Controller
{
	protected $rules = [
		'name' => 'required',
		'email' => 'required|unique:user,email|email',
		'password' => 'required|min:6',
		'status' => 'required',
		'role' => 'required',
	];

	/**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.user-relation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.user-relation.create');
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
		
		$model = new User();
		$requestData = $request->all();
		
		$model->fill($requestData);
        $model->password = bcrypt($requestData['password']);
		$model->save();
		
        Session::flash('success', 'User added!');
        
        return redirect('admin/user-relation');
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
        $model = \App\UserRelation::findOrFail($id);

        return view('admin.user-relation.show', compact('model'));
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
        $model = \App\User::findOrFail($id);

        return view('admin.user-relation.edit', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return View
     */
    public function profile()
    {
        $model = \App\User::findOrFail(\Auth::user-relation()->id);

        return view('admin.user-relation.profile', compact('model'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function updateProfile(Request $request)
    {
		$rules = $this->rules;
        $rules['email'] = 'required|unique:user-relation,email,' . \Auth::user-relation()->id;
		unset($rules['password']);
		unset($rules['status']);
		unset($rules['role']);
        $this->validate($request, $rules);
		
		$model = \App\User::findOrFail(\Auth::user-relation()->id);
		$oldPassword = $model->password;
		
        $requestData = $request->all();
		
		$model->fill($requestData);
		if (!empty($request->password)) {
			$model->password = bcrypt($requestData['password']);
		} else {
			$model->password = $oldPassword;
		}
        $model->save();
		
        Session::flash('success', 'User updated!');

        return redirect('admin/user-relation/profile');
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
        $rules['email'] = 'required|unique:user-relation,email,' . $id;
		unset($rules['password']);
        $this->validate($request, $rules);
		
		$model = \App\User::findOrFail($id);
		$oldPassword = $model->password;
		
        $requestData = $request->all();
		
		$model->fill($requestData);
		if (!empty($request->password)) {
			$model->password = bcrypt($requestData['password']);
		} else {
			$model->password = $oldPassword;
		}
        $model->save();
		
        Session::flash('success', 'User updated!');

        return redirect('admin/user-relation');
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
        return redirect('admin/user-relation');
		
        Session::flash('success', 'User deleted!');

        return redirect('admin/user-relation');
    }
	
	/**
	 * any data
	 */
	public function listIndex(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $model = \App\UserRelation::select([
					DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'user_relation.*'
				]);

         $datatables = app('datatables')->of($model)
            ->addColumn('relation_name', function ($model) {
                return $model->getRelationName();
            })
            ->editColumn('wedding_day', function ($model) {
                return \Carbon\Carbon::parse($model->wedding_day)->format('d M Y');
            })
            ->addColumn('action', function ($model) {
                return '<a href="user-relation/'.$model->id.'" class="btn btn-xs btn-success rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-eye"></i></a> '
						. '<a href="user-relation/'.$model->id.'/edit" class="btn btn-xs btn-primary rounded" data-toggle="tooltip" title="" data-original-title="'. trans('systems.edit') .'"><i class="fa fa-pencil"></i></a> ';
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
