<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Common\ErrorMessage;
use App\Http\Services\Admin\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected $title = '';
    protected $indexUrl = '';
    protected $viewPath = '';
    protected $curUrl = '';
    protected $service = null;
    protected $model = null;
    protected $powerTypes = [];

	public function __construct(CommonService $service)
    {
        $this->middleware('auth');
        $this->middleware('power:'.$this->indexUrl);
        $this->curUrl = url()->current();
        $this->service = $service;
        $this->powerTypes = config('power');
    }

    // 显示
    public function index(Request $request){
        if($result = $this->nopower($this->powerTypes['index']['value'])){
            return $result;
        }
        $datas = $this->service->getIndexDatas($request->keyword);
        return $this->view($this->viewPath.'.index', ['datas'=>$datas]);
    }

    // 创建
    public function create(){
        return $this->_create();
    }

    public function _create($data=[]){
        if($result = $this->nopower($this->powerTypes['add']['value'])){
            return $result;
        }
        return $this->view($this->viewPath.'.create', $data);
    }

    // 存储
    public function _store($request){
        if($result = $this->nopower($this->powerTypes['add']['value'])){
            return $result;
        }
        if(false === $this->model->create($request->all())){
            return $this->error();
        }

        return $this->success();
    }

    // 编辑
    public function edit($id){
        return $this->_edit($id);
    }

    public function _edit($id, $data = []){
        if($result = $this->nopower($this->powerTypes['edit']['value'])){
            return $result;
        }
        $info = $this->model->find($id);
        $data['info'] = $info;
        return $this->view($this->viewPath.'.edit', $data);
    }

    // 更新
    public function _update($request, $id){
        if($result = $this->nopower($this->powerTypes['edit']['value'])){
            return $result;
        }
        $model = $this->model->find($id);
        if(false === $model->update($request->all())){
            return $this->error();
        }

        return $this->success();
    }

    // 删除
    public function destroy($id){
        if($result = $this->nopower($this->powerTypes['delete']['value'])){
            return $result;
        }
        if(false === $this->model->destroy($id)){
            return $this->error();
        }

        return $this->success();
    }

    protected function nopower($power){
        $authPower = session('authPower');
        if(!in_array($this->powerTypes['all']['value'], $authPower) && !in_array($power, $authPower)){
            return view('layout.nopower', ['redirectUrl'=>url('admin/home')]);
        }
        return false;
    }

    protected function getPowers(){
        $powerList = [];
        $authPower = session('authPower');
        foreach ($this->powerTypes as $key => $item) {
            if($key == 'all' && in_array($item['value'], $authPower)){
                $powerList[$item['value']] = true;
                return $powerList;
            }
            $powerList[$item['value']] = in_array($item['value'], $authPower);
        }
        return $powerList;
    }

    protected function view($view, $data=[]){
        $data['authRole'] = $this->service->getAuthRoles();
    	$data['leftMenus'] = $this->service->getLeftMenus($this->curUrl);
        $data['curUrl'] = $this->curUrl;
        $data['indexUrl'] = $this->indexUrl;
        $data['title'] = $this->service->getCurMenuName();
        $data['keyword'] = request('keyword');
        $data['authPowers'] = $this->getPowers();
        $data['powerTypes'] = $this->powerTypes;
        $data['authAvatar'] = $this->service->getAuthAvatar();
        $data['systemInfos'] = $this->service->getSystemInfos();
    	return view($view, $data);
    }

    protected function success($message=null, $url=null){
        if($message == null){
            $message = ErrorMessage::getMessage(ErrorMessage::OK);
        }
        if($url == null){
            $url = $this->indexUrl;
        }
        return redirect(url($url))->with('success_message', $message);
    }

    protected function error($message=null, $url=null){
        if($message == null){
            $message = ErrorMessage::getMessage(ErrorMessage::SYSTEM_ERROR);
        }
        if($url == null){
            $url = url()->previous();
        }

        return redirect(url($url))->withErrors($message);
    }
}
