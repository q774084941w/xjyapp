<?php
// +----------------------------------------------------------------------
// | XjyApplet [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright © 2016-2026 AII Rights Reserved  http://www.ccapp.com.cn/
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +---------------------------------------------------------------------
// | Author: 小李 < 1017658209@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\controller;

use alipay\AopsdkController;
use cmf\controller\AdminBaseController;
use think\Db;
use think\Exception;
use think\Request;

class SellerController extends AdminBaseController
{
	public function _initialize()
    {
    	if (cmf_get_current_admin_id() == null) {
    		$this->error("您没有访问权限！");
    	}

        if(session('admin_parent_id') == 1)
        {
            $user_id = session('ADMIN_ID');
        }else
        {
            $user_id = session('admin_parent_id');
        }

        $this->admin_user_id = $user_id;
    }

	/**
     * 商家管理列表
     * @adminMenu(
     *     'name'   => '商家管理',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商家管理',
     *     'param'  => ''
     * )
     */
    
	public function index()
	{
		if(cmf_get_current_admin_id() == 1)
		{
			if($this->request->isPost())
			{
				$search_uid = $this->request->param('uid');
				if($search_uid)
				{
					$where['id'] = ['like',"%$search_uid%"];
				}

				$search_key = $this->request->param('keyword');
				if($search_key)
				{
					$where['seller_nickname'] = ['like',"%$search_key%"];
				}
			}

			if(empty($where)){
				$where = "id != 0";//可能有错
			}

			$data = Db::name('seller')
				->where('delete_time','eq',0)
	        	->where($where)
	        	->order("id DESC")
	        	->paginate(10);

        	$val =null;

        	foreach ($data as $key => $value) {
        		$val.=$value['id'].',';
        	}

        	$whe['id'] = ['in',$val];

        	$user = Db::name('user')->where($whe)->order("id DESC")->select();

	        $page = $data->render();

	        $this->assign("user", $user);
	        $this->assign("seller", $data);
	        $this->assign("page",$page);

	        return $this->fetch();
		}else
		{

            $id = $this->admin_user_id;

			$this->redirect('seller/sellerDetailed',array('id'=>$id));
		}
		
    
	}

	/**
     * 商家添加提交
     * @adminMenu(
     *     'name'   => '商家添加',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商家添加',
     *     'param'  => ''
     * )
     */

	public function sellerAdd()
	{
		$id = $this->request->param("id", 0, 'intval');

		$this->assign('id',$id);

		return $this->fetch();
		

	
	}

	/**
     * 商家添加提交
     * @adminMenu(
     *     'name'   => '商家添加提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商家添加提交',
     *     'param'  => ''
     * )
     */
    
    public function sellerAddPost()
    {

        if($this->request->isPost())
	    	{
	    		$data   = $this->request->param();

	    		$data['post']['create_time'] = strtotime($data['post']['create_time']);

				$result = $this->validate($data['post'], 'seller.post');

				if($result !== true)
	            {
	            	$this->error($result);
	            }else
	            {

	            	$data['post']['id'] = $data['id'];

	            	if(!empty($data['photo_urls']))
	            	{
	            		$data['post']['seller_advert'] ='';
	            		foreach($data['photo_urls'] as $key => $value)
	            		{
	            			$data['post']['seller_advert'] .=$data['photo_urls'][$key].";"; 
	            		}
	            	}
                    try{
                        $result = Db::name('seller')->insert($data['post']);

                        if ($result)
                        {
                            $this->success("添加商家成功", url("seller/index"));
                        }else
                        {
                            $this->error("添加商家失败");
                        }
                    }catch (Exception $e){
	            	    $this->error($e->getMessage());
                    }

		        }
	    	}

    }

	/**
     * 商家删除操作
     * @adminMenu(
     *     'name'   => '商家删除',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商家删除',
     *     'param'  => ''
     * )
     */

	public function sellerDel()
	{		
		if (cmf_get_current_admin_id() == 1) 
		{
			$id = $this->request->param("id", 0, 'intval');

			$where['id'] 		= $id ;
    		$where['delete_time'] 	= strtotime(date('Y-m-d H:i:s',time()));
			$del['object_id'] 	= $id;
	    	$del['create_time']	= $where['delete_time'];
	    	$del['table_name']	= 'seller';
	    	$del['name'] 		= '商家信息';
	    	$del['uid']         = session('ADMIN_ID');
            $del['seller_id']        = $this->admin_user_id;

    		$req 	= Db::name('recycle_bin')->insert($del);
			$status = Db::name('seller')->update($where);

	        if (!empty($status))
	        {
	        	$this->success("删除成功！", url('seller/index'));
	        } else 
	        {
	            $this->error("删除失败！");
	        }
        }else
		{
			$this->error("您没有访问权限！");
		}
	}

	/**
     * 商家信息修改
     * @adminMenu(
     *     'name'   => '商家修改',
     *     'parent' => 'index',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商家修改',
     *     'param'  => ''
     * )
     */

	public function sellerEdit()
	{

		$id = $this->request->param("id", 0, 'intval');

		if(empty($id))
		{
			$id = session('ADMIN_ID');
		}

		if(session('ADMIN_ID') == $id || cmf_get_current_admin_id() == 1 || session('admin_parent_id') != 1)
		{
			$data = Db::name('seller')->where(["id" => $id])->find();

			$data['advet'] = array();

			if(!empty($data['seller_advert']))
			{
				$data['advet'] = explode(';',$data['seller_advert']);

				array_pop( $data['advet']);
			}

	        if (!$data) 
	        {
	            $this->error("该商家不存在！");
	        }

	        $this->assign("data", $data);

	        return $this->fetch();
		}else
		{
			$this->error('无权修改他人信息！');
		}

		
	}

	/**
     * 修改商家提交
     * @adminMenu(
     *     'name'   => '修改商家提交',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '修改商家提交',
     *     'param'  => ''
     * )
     */

	public function sellerEditPost()
	{
		if($this->request->isPost())
		{
			$data  	= $this->request->param();

			$id 	= $this->request->param("id", 0, 'intval');	

			if(session('ADMIN_ID') == $id || cmf_get_current_admin_id() == 1 || session('admin_parent_id') != 1)
			{
				$data['post']['id'] = $id;

	            $result = $this->validate($data['post'], 'seller.post');

	            if(cmf_get_current_admin_id() == 1)
	            {

	            	$data['post']['create_time'] = strtotime($data['post']['create_time']);

	            }
	            if(true !== $result)
	            {
	            	$this->error($result);
	            }
	            else
	        	{

	        		if(!empty($data['photo_urls']))
	        		{
	        			$data['post']['seller_advert'] = "";
	        			foreach($data['photo_urls'] as $key => $value)
	        			{
	        				$data['post']['seller_advert'] .= $value.';';
	        			}
	        		}
	        		if (Db::name('seller')->update($data['post']) !== false) 
	    			{
	                    $this->success("修改成功！", url('seller/index'));
	                }else 
	                {
	                    $this->error("修改失败！");
	                }
		        }
			}else
			{
				$this->error('无权修改他人信息！');
			}
		}
		
	}

	/**
     * 地图
     * @adminMenu(
     *     'name'   => '地图',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '地图',
     *     'param'  => ''
     * )
     * 菜单模块未实现
     */
    
	public function map(){

		return $this->fetch();
		
	}

	/**
     * 商家详细查看
     * @adminMenu(
     *     'name'   => '商家详细',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商家详细',
     *     'param'  => ''
     * )
     */
    
    public function sellerDetailed(){
    	
		$id = $this->request->param("id", 0, 'intval');

		if(empty($id))
		{
			$id = session('ADMIN_ID');
		}

		if(session('ADMIN_ID') == $id or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)
		{

			$data = Db::name('seller')->where(["id" => $id])->find();

	        if (!$data) 
	        {
                $this->redirect('seller/sellerAdd',array('id'=>session('ADMIN_ID')));
	        }

	        $this->assign("data", $data);

	        return $this->fetch();	
        }else
			{
				$this->error('无权查看他人信息！');
			}
    }

    /**
     * 用户密码修改
     * @adminMenu(
     *     'name'   => '密码修改',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '密码修改',
     *     'param'  => ''
     * )
     */
    
    public function password()
    {
    	
		$id = $this->request->param("id", 0, 'intval');

		if(session('ADMIN_ID') == $id or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1)
		{

			$this->assign("id", $id);			

	        return $this->fetch();	
        }else
			{
				$this->error('无权修改他人信息！');
			}
    }

    /**
     * 用户密码修改提交
     * @adminMenu(
     *     'name'   => '修改提交',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '修改提交',
     *     'param'  => ''
     * )
     */
    
    public function passwordPost(){

    	$id = $this->request->param("id", 0, 'intval');

    	$seller = Db::name('user')->where(['id'=>$id])->find();

		if($this->request->isPost())
		{
			$data  	= $this->request->param();

			$result = $this->validate($data, 'seller.password');

			if(true !== $result)
	            {
	            	$this->error($result);
	            }
	            else
	        	{
	        		$data['user_pass'] = cmf_password($data['user_pass']);

	        		$data['old_pass']=null;

	        		if($seller['user_pass'] == cmf_password($data['old_pass']) or cmf_get_current_admin_id() == 1 or session('admin_parent_id') != 1){

	        			if($seller['user_pass'] == $data['user_pass'])
		        		{
		        			$this->error('新老密码不能相同！');
		        		}else
		        		{
		        			$seller['user_pass'] = $data['user_pass'];

		        			if (Db::name('user')->update($seller) !== false) 
			    			{
			                    $this->success("修改成功！", url('seller/index'));
			                }else 
			                {
			                    $this->error("修改失败！");
			                }       			
		        		}
	        		}else
	        		{
	        			$this->error("原密码不正确！");
	        		}	        		
	        	}

		}else
		{
			$this->error('错误操作！');
		}
    }

     /**
     * 用户密码修改提交
     * @adminMenu(
     *     'name'   => '修改提交',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '修改提交',
     *     'param'  => ''
     * )
     */
    
    public function sellerList(){

    	$where   = [];
    	$tj = null;
        $request = input('request.');

        $keywordComplex = [];
        if (!empty($request['keyword'])) {
            $keyword = $request['keyword'];

            $keywordComplex['user_login|user_nickname|user_email']    = ['like', "%$keyword%"];
        }

        //$data = Db::query("select xjy_user.id from xjy_user,xjy_seller where xjy_user.id = xjy_seller.id");
        $data = Db::name('user')
            ->alias('a')
            ->join('__SELLER__ b','a.user_id=b.seller_id')
            ->field('a,id')->select();
        foreach ($data as $key => $value) {
        	$tj .= $value['id'].',';
        }

      	$where['id'] = ['not in',$tj];

        $usersQuery = Db::name('user');

        $list = $usersQuery->whereOr($keywordComplex)->where($where)->order("create_time DESC")->paginate(10);

        // 获取分页显示
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch();
    }

    /**
     * 商家餐桌类型
     * @adminMenu(
     *     'name'   => '餐桌类型',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '餐桌类型',
     *     'param'  => ''
     * )
     */
    
    public function sellerTable(){

        $asd = Request::instance();
    	if(cmf_get_current_admin_id() == 1)
    	{
    		$id = $this->request->param("id", 0, 'intval');
    	}else
    	{

            $id  =  $this->admin_user_id;

    	}
    	if(empty($id)&&$id!=0)
    	{
    		$this->error('错误操作！','seller/index');
    	}elseif($this->request->isPost())
		{	
			$data  	= $this->request->param();

			if( (!empty($data['add']['table_name']) || !empty($data['old_table'])) && !empty($data['rest']['menu']) && !empty($data['rest']['num']) )
			{
			    //餐桌类型的选择或添加
			    if(!empty($data['add']['table_name'])){
                    $data['add']['seller_id'] = $id;
                    $last_id   = Db::name('seller_table')->insertGetid($data['add']);
                }elseif (!empty($data['old_table'])){
                    $last_id    = $data['old_table'];
                }else{
                    $this->error('餐桌类型不能为空');
                }

                $table_id = $this->takeRest($data,$last_id,$id);
            	if (!$table_id)
	            {
	            	$this->error("添加餐桌失败");
	            }else
	            {
                    import('phpqrcode/phpqrcode',EXTEND_PATH);

                    $level = 'L';// 纠错级别：L、M、Q、H
                    $size =5;// 点的大小：1到10,用于手机端4就可以了

                    $errorCorrectionLevel = intval($level);  
                    //生成图片大小  
                    $matrixPointSize = intval($size);  
                    //生成二维码图片  
                    $object = new \QRcode();
                    foreach ($table_id as $key=>$val){
                        $logo = $this->logoPng($key);
                        $res = $asd->domain() ."/user/index/scan_order/id/".$val;
                        $QRpng = './upload/QR_code/seller-table-'.$val.'.png';
                        //第二个参数false的意思是不生成图片文件，如果你写上‘picture.png’则会在根目录下生成一个png格式的图片文件
                        $object->png($res, $QRpng, $errorCorrectionLevel, $matrixPointSize, 2);
                        $this->changeQRpng($QRpng,$logo);
                    }
                    $this->success('添加成功');
	            	//$this->redirect('seller/sellerTable', ['id' => $id]);
	            }
			}elseif(!empty($data['rest']['id']) and !empty($data['rest']['old_menu']) and !empty($data['rest']['table_id'])){
			    $last_id = $data['rest']['table_id'];
			    if(!empty($data['edit']['table_name'])){
                    $data['edit']['seller_id'] = $id;
                    $last_id = Db::name('seller_table')->insertGetId($data['edit']);

                }
				if( !empty($data['rest']['menu']) && $data['rest']['old_menu'] != $data['rest']['menu'] ){
                     $result=$this->changeRest($data,$id);
                }else{
                    $arr = array(
                        'table_id' => $last_id,
                        'tb_id'    => $data['rest']['tb_id'],
                    );
                    $result  = Db::name('rest')->where('id',$data['rest']['id'])->update($arr);
                }
				if (!$result) 
	            {
	            	$this->error("修改餐桌失败");
	            }else
	            {	
                    import('phpqrcode/phpqrcode',EXTEND_PATH);               
                    $res = $asd->domain() ."/user/index/scan_order/id/".$data['rest']['id'];
                    $level = 'L';// 纠错级别：L、M、Q、H
                    $size =5;// 点的大小：1到10,用于手机端4就可以了

                    $errorCorrectionLevel = intval($level);  
                    //生成图片大小  
                    $matrixPointSize = intval($size);
                    $logo = $this->logoPng($data['rest']['tb_id']);
                    //生成二维码图片  
                    $object = new \QRcode();
                    $QRpng = './upload/QR_code/seller-table-'.$data['rest']['id'].'.png';
                    //第二个参数false的意思是不生成图片文件，如果你写上‘picture.png’则会在根目录下生成一个png格式的图片文件  
                    $object->png($res, $QRpng, $errorCorrectionLevel, $matrixPointSize, 2);
                    $this->changeQRpng($QRpng,$logo);
	            	$this->success("修改成功！");
	            	$this->redirect('seller/sellerTable', ['id' => $id]);
	            }
			}else{
                $this->error('参数错误');
            }
		}
        $menu_id = $where   = '';
        $getdata = $this->request->param();
        $tb_id   = $this->request->param('menu');
        if(!empty($tb_id)){
            $where = 'a.id='.$tb_id;
            $menu_id = $tb_id;
        }
        //
        $table = Db::name('food_menu')
            ->field('b.id,table_name,table_describe,name,tb_id,table_id')
            ->alias('a')
            ->join('__REST__ b','a.id=b.menu_id')
            ->join('__SELLER_TABLE__ c','c.id=b.table_id')
            ->where('c.seller_id ='.$id)
            ->where('c.delete_time =0')
            ->where('b.delete_time=0')
            ->where($where)
            ->paginate(10);
        //服务台分类
        $model = model('FoodMenu');
        $menu = $model->index();
        $this->assign('menu',$menu);
        $table_name = Db::name('seller_table')
                    ->field('id,table_name')
                    ->where('seller_id',$id)
                    ->where('delete_time=0')
                    ->select();

        $table->appends($getdata);
        $page = $table->render();
    	$this->assign('table',$table);
    	$this->assign('menu_id',$menu_id);
        $this->assign("page",$page);
        $this->assign('table_name',$table_name);
        return $this->fetch();
    }

    /**
     * 服务厅分配排号
     * @adminMenu(
     *     'name'   => '服务厅分配',
     *     'parent' => 'sellerTable',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '服务厅分配',
     *     'param'  => ''
     * )
     */
    protected function takeRest($data,$last_id,$id){
        if(empty($last_id)){
            $this->error('未找到餐桌类型');
        }
        $tb_id = Db::name('rest')
                    ->field('tb_id')
                    ->where('menu_id',$data['rest']['menu'])
                    ->where('seller_id',$id)
                    ->where('delete_time',0)
                    ->order('tb_id desc')
                    ->find();
        if(empty($tb_id)){
            $tb_id['tb_id']=0;
        }
        $table_id = array();
        for($i=$tb_id['tb_id']+1;$i<=($data['rest']['num']+$tb_id['tb_id']);$i++){
            $arr = [
                'table_id' => $last_id,
                'tb_id'    => $i,
                'menu_id'  => $data['rest']['menu'],
                'seller_id' => $id
            ];


            $table_id[$i] = Db::name('rest')->insertGetId($arr);
        }
        return $table_id;
    }

    /**
     * 更改服务厅和排号
     * @adminMenu(
     *     'name'   => '更改服务厅和排号',
     *     'parent' => 'sellerTable',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '更改服务厅和排号',
     *     'param'  => ''
     * )
     */
    protected function changeRest($data,$id){

        if($data['rest']['menu']!=0){
            $subQuery = Db::name('food_menu')
                        ->field('id')
                        ->where('name','=',$data['rest']['old_menu'])
                        ->find();
            if($subQuery['id']!=$data['rest']['menu']){
                $theLast = Db::name('rest')
                    ->field('tb_id')
                    ->where('menu_id',$data['rest']['menu'])
                    ->where('seller_id',$id)
                    ->where('delete_time',0)
                    ->order('tb_id desc')
                    ->find();
                $arr = array(
                    'tb_id'   => $theLast['tb_id']+1,
                    'menu_id' => $data['rest']['menu']
                );
                return Db::name('rest')
                    ->where('id',$data['rest']['id'])
                    ->update($arr);
            }

        }
        return true;

    }

    /**
     * 商家餐桌删除
     * @adminMenu(
     *     'name'   => '餐桌删除',
     *     'parent' => 'admin/User/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '餐桌删除',
     *     'param'  => ''
     * )
     */
    
    public function sellerTableDel(){

    	$id = $this->request->param("id", 0, 'intval');

    	$where['id'] 		   = $id ;
    	$where['delete_time']   = 1;
    	$del['object_id'] 	   = $id;
    	$del['create_time']	   = strtotime(date('Y-m-d H:i:s',time()));
    	$del['table_name']	   = 'rest';
    	$del['name'] 		   = '餐桌信息';
    	$del['uid']            = session('ADMIN_ID');
        $del['seller_id']        = $this->admin_user_id;

    	$req 	= Db::name('recycle_bin')->insert($del);
    	$result = Db::name('rest')->update($where);
    	if (!$result) 
        {
        	$this->error("删除失败");
        }else
        {	
        	$this->success("删除成功！");
        	$this->redirect('seller/sellerTable', ['id' => $id]);
        }
    }

   /**
     * 商家提现操作
     * @adminMenu(
     *     'name'   => '商家提现操作',
     *     'parent' => '/',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商家提现操作',
     *     'param'  => ''
     * )
     */ 

   public function withdrawals()
   {
        $this->Statistics();
   		$seller_id 	=  $this->admin_user_id;

   		$data 		= Db::name('user')
   			->where('id','eq',$seller_id)
   			->where('user_type','eq',2)
   			->field('id,withdrawals_time,seller_openid,seller_name,user_RMB,Alipay_RMB')
   			->find();

		/*生成二维码*/
     	import('phpqrcode/phpqrcode',EXTEND_PATH);
      	$res = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx979cb71291915d83&redirect_uri=https://xiaojiuyun.cn/user/getcode/index/seller_id/".$seller_id."&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirectype=code&scope=snsapi_userinfo&state=1#wechat_redirect";
     	$level = 'L';// 纠错级别：L、M、Q、H
     	$size =4;// 点的大小：1到10,用于手机端4就可以了
     	$QRcode = new \QRcode();
     	// ob_start();
     	// $QRcode->png($data,false,$level,$size,2);
     	// $imageString = base64_encode(ob_get_contents());
     	// ob_end_clean();
     	// return "data:image/jpg;base64,".$imageString;

     	$errorCorrectionLevel = intval($level);  
        //生成图片大小  
        $matrixPointSize = intval($size);  
        //生成二维码图片  
        $object = new \QRcode();  
        //第二个参数false的意思是不生成图片文件，如果你写上‘picture.png’则会在根目录下生成一个png格式的图片文件  
        $object->png($res, './upload/QR_code/seller-'.$seller_id.'.png', $errorCorrectionLevel, $matrixPointSize, 2);  

		$this->assign('seller',$data);

   		return $this->fetch();

   }



    /**
     * 查询方式
     */
    protected function Statistics(){
        $data = Db::name('order')
                    ->where('seller_id', $this->admin_user_id)
                    ->where('pay',2)
                    ->field('pay_class,sum(order_price) as price')
                    ->group('pay_class')
                    ->select();
        $data   = json_decode( json_encode( $data ), true );
        $this->assign('arr',$data);
    }

   /**
     * 商家提现信息修改
     * @adminMenu(
     *     'name'   => '商家提现信息修改',
     *     'parent' => 'admin/seller/withdrawals',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '商家提现信息修改',
     *     'param'  => ''
     * )
     */

   public function withdrawalsEditPost()
   {
   		$seller_id 	=  $this->admin_user_id;
        $res 	 	= input('post.');

        if(empty($res['seller_name']))
        {
        	$this->error('错误操作！');
        }

        $request = Db::name('user')->where('id','eq',$seller_id)->update(['seller_name'=>$res['seller_name']]);

        if($request)
        {
        	$this->success('修改成功！');
        }else
        {
        	$this->error('修改失败！');
        }
   }

   /**
     * 用户提现申请
     * @adminMenu(
     *     'name'   => '用户提现申请',
     *     'parent' => 'admin/seller/withdrawals',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户提现申请',
     *     'param'  => ''
     * )
     */
    
    public function withdrawalsPost()
    {

    	$data = Db::name('user')->where('id','eq',session('ADMIN_ID'))->find();

    	if(empty($data))
    	{
    		$this->error('错误操作！');
    	}

    	if(strtotime('+10 day',$data['withdrawals_time']) > time())
    	{
    		$this->error('距离上次提现时间未超过10天！');
    	}

    	if( $data['user_RMB'] < 100 )
    	{
    		$this->error('提现金额不得少于100元！');
    	}

    	import('WxTransfers_Api',EXTEND_PATH);

    	$path = \WxTransfersConfig::getRealPath(); // 证书文件路径
		$config['wxappid'] = \WxTransfersConfig::APPID;
		$config['mch_id'] = \WxTransfersConfig::MCHID;
		$config['key'] = \WxTransfersConfig::KEY;
		$config['PARTNERKEY'] = \WxTransfersConfig::KEY;
		$config['api_cert'] = $path . \WxTransfersConfig::SSLCERT_PATH;
		$config['api_key'] = $path . \WxTransfersConfig::SSLKEY_PATH;
		$config['rootca'] = $path . \WxTransfersConfig::SSLROOTCA;
		
		$wxtran=new \WxTransfers($config);
		
		// $wxtran->setLogFile('D:\\transfers.log');//日志地址
		
		//转账
		$res=array(
			'openid'=>$data['seller_openid'],//openid
			'check_name'=>'FORCE_CHECK',//是否验证真实姓名参数
			're_user_name'=>$data['seller_name'],//姓名	
			'amount'=>($data['user_RMB']-round($data['user_RMB']*0.025,2))*100,//最小1元 也就是100
			// 'amount' => 100,
			'desc'=>'小九云小程序商家提现',//描述
			'spbill_create_ip'=>$wxtran->getServerIp(),//服务器IP地址
		);

		// var_dump(json_encode($wxtran->transfers($res),JSON_UNESCAPED_UNICODE));
		// var_dump($wxtran->error);

		// dump($wxtran->transfers($data));
		
		if($wxtran->transfers($res))				//这里判断好像有问题
		{
			Db::name('user')->where('id','eq',session('ADMIN_ID'))->update(['withdrawals_time'=>time(),'user_RMB'=>0]);
			$this->success('提现申请成功！');
		}else
		{
			$this->error($wxtran->error);
		}

		//获取转账信息
		// var_dump($wxtran->getInfo('1491561782201712091728085266'));
		// var_dump($wxtran->error);
    }

    /**
     * OpenidAjax
     * @adminMenu(
     *     'name'   => 'OpenidAjax',
     *     'parent' => 'admin/seller/withdrawals',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => 'OpenidAjax',
     *     'param'  => ''
     * )
     */

    public function openidAjax()
    {
        if($this->request->isajax())
        {
            $seller_id          = $this->request->POST('seller_id');
            $openid             = $this->request->POST('Openid');

            $res = Db::name('user')->where('id','eq',$seller_id)->find();

            if($res['seller_openid'] == $openid )
            {

                echo $openid;

            }else
            {

                echo $res['seller_openid'];

            }
        }
    }

    /**
     * 支付宝提现
     * @adminMenu(
     *     'name'   => '支付宝提现',
     *     'parent' => 'admin/seller/withdrawals',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '支付宝提现',
     *     'param'  => ''
     * )
     */
    public function alipayCash(){
        $seller_id 	=  $this->admin_user_id;

        $data 		= Db::name('user')
            ->where('id','eq',$seller_id)
            ->where('user_type','eq',2)
            ->field('id,withdrawals_time,seller_openid,seller_name,user_RMB,mobile,Alipay_RMB')
            ->find();
        $this->assign('seller',$data);
//        dump($data);exit;
        return $this->fetch();
    }

    /**
     * 支付宝提交
     */
    public function apCash(){
        if($this->request->isPost()){

            $data = Db::name('user')->where('id','eq',session('ADMIN_ID'))->find();

            if(empty($data))
            {
                $this->error('错误操作！');
            }

            if(strtotime('+10 day',$data['withdrawals_time']) > time())
            {
                $this->error('距离上次提现时间未超过10天！');
            }

            if( $data['user_RMB'] < 100 )
            {
                $this->error('提现金额不得少于100元！');
            }

            $out_biz = "aop" . date('Ymdhis') . mt_rand(100, 1000);
            $id  = $this->request->param('id');  //商户转账唯一订单号
            $price_old  = $this->request->param('price_old');  //商户转账唯一订单号
            $payee_account =  $this->request->param('account');//收款方账户
            $oldamount  = $this->request->param('price');//转账金额，单位：元
            $amount  = $oldamount-round($oldamount*0.008,2);
            $payer_show_name = '沙箱环境';//付款方姓名
            $payee_real_name = $this->request->param('name');//收款方真实姓名
            $remark  =  $this->request->param('remark');//备注
            $alipay  =  new AopsdkController();
            $result  =  $alipay->aopSDK($out_biz,$payee_account,$amount,$payer_show_name,$payee_real_name,$remark);
            if($result){
                $arr = array(
                    'Alipay_RMB'=>$price_old - $oldamount,
                    'withdrawals_time'=> time()
                );
                Db::name('user')->where('id',$id)->update($arr);
                $this->success('提现成功');
            }else{
                $this->error($result);
            }
        }else{
            $this->error('操作失误');
        }

    }

    /**
     * 二维码中间图标
     * @adminMenu(
     *     'name'   => '二维码中间图标',
     *     'parent' => 'admin/seller/withdrawals',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '二维码中间图标',
     *     'param'  => ''
     * )
     */
    public function logoPng($str='1',$size=100){
        $string = './upload/QR_code/logo/logo.png';
        $logo = imagecreatefromstring(file_get_contents($string));
        $logo_width = imagesx($logo);//logo图片宽度
        //2.造颜料
        $red       = imagecolorallocate($logo, 255, 255, 255);

        $fontWidth = imagefontwidth ( $size );

        $textWidth = $fontWidth * strlen ( $str )*8;
        $x = ceil ( ($logo_width - $textWidth) / 2 );//计算文字的水平位置
        //3.填充背景颜色

        imagefttext($logo,$size,0,$x,155,$red,'./static/font-awesome/fonts/wrlh.ttf',$str);
        //7.输出图片
        header('content-type:image/png');
        $newstring = './upload/QR_code/logo/logo1.png';
        imagepng($logo,$newstring);
        //8.销毁画布
        imagedestroy($logo);
        return $newstring;
    }

    /**
     * 修改二维码图片
     * @adminMenu(
     *     'name'   => '修改二维码图片',
     *     'parent' => 'admin/seller/withdrawals',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '修改二维码图片',
     *     'param'  => ''
     * )
     */
    public function changeQRpng($QRpng,$logo){
        $QR = imagecreatefromstring(file_get_contents($QRpng));

            $logo = imagecreatefromstring(file_get_contents($logo));

            $QR_width = imagesx($QR);//二维码图片宽度

            $QR_height = imagesy($QR);//二维码图片高度

            $logo_width = imagesx($logo);//logo图片宽度

            $logo_height = imagesy($logo);//logo图片高度

            $logo_qr_width = $QR_width / 5;

            $scale = $logo_width/$logo_qr_width;

            $logo_qr_height = $logo_height/$scale;

            $from_width = ($QR_width - $logo_qr_width) / 2;

//重新组合图片并调整大小

            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,

            $logo_qr_height, $logo_width, $logo_height);

//输出图片

        imagepng($QR, $QRpng);
    }


    /**
     * 下载压缩包
     * 只能压缩本地文件
     */
    public function zipDown(){
        $data  = $this->request->param();
        $files =  $this->fileTothis($data['data']);

        //$files = array('upload/qrcode/1/1.jpg');
        $zipName = './upload/qrcode/download.zip';
        $zip = new \ZipArchive();//使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释
        if ($zip->open($zipName, \ZipArchive::OVERWRITE | \ZipArchive::CREATE)!==TRUE) {
            exit('无法打开文件，或者文件创建失败');
        }
        foreach($files as $val){
            if(file_exists($val)){
                $zip->addFile($val, basename($val));
            }
        }
        $zip->close();//关闭

        if(!file_exists($zipName)){
            exit("无法找到文件"); //即使创建，仍有可能失败
        }
        echo str_replace('./','http://'.$_SERVER['HTTP_HOST'].'/',$zipName);
    }


    /**
     * 修改路径
     * @param $data
     * @return array
     */
    public function fileTothis($data){
        $newArr = [];
        foreach ($data as $val){
            $newArr[] = str_replace( 'http://'.$_SERVER['HTTP_HOST'],'./',$val);
        }
        return $newArr;
    }

}