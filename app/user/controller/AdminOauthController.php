<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Powerless < wzxaini9@gmail.com>
// +----------------------------------------------------------------------
namespace app\user\controller;

use cmf\controller\AdminBaseController;
use think\Db;
use think\Validate;

class AdminOauthController extends AdminBaseController
{
    public function _initialize()
    {

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
     * 后台第三方用户列表
     * @adminMenu(
     *     'name'   => '第三方用户',
     *     'parent' => 'user/AdminIndex/default1',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '第三方用户',
     *     'param'  => ''
     * )
     */
    public function index()
    {
        $request = $this->request->param();
        $where=array();
        if($this->request->isPost()){
            if(!empty($request['nickname'])){
                $where['a.nickname'] = ['like',"%".$request['nickname']."%"];
            }
            if(!empty($request['real_name'])){
                $where['b.real_name'] = ['like',"%".$request['real_name']."%"];
            }
            if(!empty($request['mobile'])){
                $where['b.mobile'] = $request['mobile'];
            }
            if(!empty($request['card_number'])){
                $where['d.card_number'] = $request['card_number'];
            }
        }
        $oauthUserQuery = Db::name('third_party_user')
            ->where($where)
            ->alias('a')
            ->field('a.status,a.id,a.user_id,a.avatarUrl,a.union_id,a.nickname,b.score,b.mobile,b.user_RMB,b.real_name,count(d.id) as card_number')
            ->join('__USER__ b','a.user_id=b.id')
            ->join('__USER_CARD__ d','d.user_id=b.id','LEFT');

        if(cmf_get_current_admin_id() == 1)
        {
            $lists = $oauthUserQuery
                ->order('a.id DESC')
                ->paginate(10);
        }else
        {
            $user_id = $this->admin_user_id;
            $data  = Db::name('seller')->where('id','eq',$user_id)->find();

            $lists = $oauthUserQuery
                ->where('a.app_id','eq',$data['appid'])
                ->group('a.id')
                ->order('a.id DESC')
                ->paginate(10);
        }
        // 获取分页显示
        $lists->appends($request);
        $page = $lists->render();
        $this->assign('lists', $lists);
        $this->assign('page', $page);
        //等级
        $user_level = Db::name('user_level')->select();
        $this->assign('level',$user_level);
        // 渲染模板输出
        return $this->fetch();
    }

    /**
     * 我的所有卡片Ajax
     * @adminMenu(
     *     'name'   => '我的所有卡片',
     *     'parent' => 'user/AdminIndex/default1',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '我的所有卡片',
     *     'param'  => ''
     * )
     */
    public function myCard(){
        $user_id = $this->request->param('user_id');
        $data    = Db::name('user_card')
            ->where('user_id',$user_id)
            ->field('id,card_no,user_RMB')
            ->select();
        echo json_encode($data);
    }

    /**
     * 后台删除第三方用户绑定
     * @adminMenu(
     *     'name'   => '删除第三方用户绑定',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除第三方用户绑定',
     *     'param'  => ''
     * )
     */
    /* public function delete()
     {
         $id = input('param.id', 0, 'intval');
         if (empty($id)) {
             $this->error('非法数据！');
         }
         $result = Db::name("OauthUser")->where("id", $id)->delete();
         if ($result !== false) {
             $this->success("删除成功！", "admin_oauth/index");
         } else {
             $this->error('删除失败！');
         }
     }*/



    /**
     * 用户信息详情
     * @adminMenu(
     *     'name'   => '用户信息详情',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户信息详情',
     *     'param'  => ''
     * )
     */
    public function details(){
        $id         = $this->request->param('id');

        $data       = Db::name('third_party_user')
                    ->alias('a')
                    ->join('__USER__ b','a.user_id=b.id')
                    ->where("a.status", 1)
                    ->where('a.id',$id)
                    ->find();
        //用户所持有卡
        $user_card  = Db::name('user_card')
            ->field('a.*,b.grade_name,b.discount')
            ->alias('a')
            ->join('__USER_LEVEL__ b','a.user_lv=b.id')
            ->where('a.user_id',$data['user_id'])
            ->where('a.type','neq',3)
            ->paginate(5);
        $this->assign('user_card',$user_card);
        $page = $user_card->render();
        $this->assign('page',$page);
        $this->assign('edit_id',$id);
        //等级
        $user_level = Db::name('user_level')->select();
        $this->assign('level',$user_level);
        $this->assign($data);
        return $this->fetch();
    }

    /**
     * 用户信息修改
     * @adminMenu(
     *     'name'   => '用户信息修改',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户信息修改',
     *     'param'  => ''
     * )
     */
    public function edit(){

        $id = $this->request->param('id');
        if($this->request->isPost()){
            $data = $this->request->param();
            Db::name('user')
                ->where('id',$id)
                ->update($data['post']);
            Db::name('third_party_user')
                ->where('user_id',$id)
                ->update($data['third']);
            $this->success('修改成功',url('AdminOauth/index'));
        }
        $data = Db::name('third_party_user')
            ->alias('a')
            ->join('__USER__ b','a.user_id=b.id')
            ->where("a.status", 1)
            ->where('a.id',$id)
            ->find();
        $level = Db::name('user_level')->field('id,grade_name')->select();
        $this->assign('level',$level);
        $this->assign($data);
        return $this->fetch();
    }

    /**
     * 用户等级列表
     * @adminMenu(
     *     'name'   => '用户等级列表',
     *     'parent' => 'user/AdminIndex/default1',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户等级列表',
     *     'param'  => ''
     * )
     */
    public function levelIndex(){
        $where = array(
            'type' => 0
        );
        $seller_id = $this->admin_user_id;
        $where['seller_id'] = $seller_id;

        $data = Db::name('user_level')
                    ->where($where)
                    ->order('sort')
                    ->paginate(10);
        $this->assign('data',$data);
        $page = $data->render();
        $this->assign('page', $page);
        return $this->fetch();
    }

    /**
     * 用户等级添加
     * @adminMenu(
     *     'name'   => '用户等级添加',
     *     'parent' => 'levelIndex',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户等级添加',
     *     'param'  => ''
     * )
     */
    public function levelAdd(){
        if($this->request->isPost()){

            $seller_id = $this->admin_user_id;
            $data = $this->request->param();
            $data['add']['seller_id'] = $seller_id;
            $result = Db::name('user_level')->insert($data['add']);
            if($result){
                $this->success('添加成功');
            }else{
                $this->error('添加失败');
            }
        }

    }

    /**
     * 用户等级修改
     * @adminMenu(
     *     'name'   => '用户等级修改',
     *     'parent' => 'levelIndex',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户等级修改',
     *     'param'  => ''
     * )
     */
    public function levelEdit(){
        if($this->request->isPost()){
            $data = $this->request->param();
            if(!empty($data['edit']['id'])){
                $result = Db::name('user_level')
                        ->where('id',$data['edit']['id'])
                        ->update($data['add']);
                if($result){
                    $this->success('修改成功');
                }else{
                    $this->error('修改失败');
                }
            }else{
                $this->error('缺少重要参数');
            }
        }
    }

    /**
     * 用户等级删除
     * @adminMenu(
     *     'name'   => '用户等级删除',
     *     'parent' => 'levelIndex',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '用户等级删除',
     *     'param'  => ''
     * )
     */
    public function levelDelete(){
        $id = $this->request->param('id');
        $if = Db::name('user')->where('user_lv',$id)->value('user_lv');
        if(empty($if)){
            $result = Db::name('user_level')
                ->where('id',$id)
                ->delete();
            if($result){
                $this->success('删除成功');
            }else{
                $this->error('删除失败');
            }
        }else{
            $this->error('您不能删除，有人在使用');
        }
    }

    /**
     * 快捷添加会员号
     * @adminMenu(
     *     'name'   => '快捷添加会员号',
     *     'parent' => 'levelIndex',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '快捷添加会员号',
     *     'param'  => ''
     * )
     */
    public function addLevel(){
        if($this->request->isPost()){
            $data   = $this->request->param();
            //查看该卡是否在使用
            $result=$this->isHad($data);
            if($result){
                //没有使用
                $data['add']['card_time'] = time();
                $result = Db::name('user_card')->insert($data['add']);
                if($result){
                    $this->success('添加成功',url('AdminOauth/index'));
                }else{
                    $this->error('添加失败',url('AdminOauth/index'));
                }
            }else{
                $this->error('该卡已经有人在使用',url('AdminOauth/index'));
            }
        }else{
            $this->error('错误操作',url('AdminOauth/index'));
        }
    }

    /**
     * 修改会员号
     * @adminMenu(
     *     'name'   => '修改会员号',
     *     'parent' => 'levelIndex',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '修改会员号',
     *     'param'  => ''
     * )
     */
    public function changeLevel(){
        if($this->request->isPost()){
            $data       = $this->request->param();
            $user_id    = $this->request->param('user_id');
            //查看该卡是否在使用
            $result=$this->isHad($data,$user_id);
            if($result) {
                $id = $this->request->param('id');
                $result = Db::name('user_card')->where('id', $id)->update($data['edit']);
                if ($result) {
                    $this->success('修改成功');
                } else {
                    $this->error('修改失败' . $result);
                }
            }else{
                $this->error('该卡已经有人在使用',url('AdminOauth/index'));
            }
        }else{
            $this->error('错误操作');
        }
    }

    /**
     * 查看该卡是否有人在使用
     * @adminMenu(
     *     'name'   => '查看该卡是否有人在使用',
     *     'parent' => 'levelIndex',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '查看该卡是否有人在使用',
     *     'param'  => ''
     * )
     */
    protected function isHad($data,$user_id=''){
        if(!empty($data['add'])){
            $card_no     = $data['add']['card_no'];
            $card_number = $data['add']['card_number'];
        }elseif (!empty($data['edit'])){
            $card_no     = $data['edit']['card_no'];
            $card_number = $data['edit']['card_number'];
        }else{
            return false;
        }
        $id    = Db::name('user_card')
            ->field('id,user_id')
            ->where('card_no',$card_no)
            ->where('card_number',$card_number)
            ->find();
        if(empty($id) || $id['user_id']==$user_id){
            return true;
        }else{
            $this->error('该卡已经有人在使用',url('AdminOauth/index'));
            return false;
        }
    }

    /**
     * 快捷充值
     * @adminMenu(
     *     'name'   => '快捷充值',
     *     'parent' => 'levelIndex',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '快捷充值',
     *     'param'  => ''
     * )
     */
    public function user_RMB(){
        if($this->request->isPost()){
            $card_id = $this->request->param('card_id');
            if(empty($card_id)){
                $this->error('您未选择卡号');
            }
            $harge   = $this->request->param('harge');
            $pass       = Db::name('user')->where('id',session('ADMIN_ID'))->value('harge');
            if(empty($pass)){
                $this->error('您还未设置充值密码');
            }
            if(!cmf_compare_password($harge,$pass)){
                $this->error('充值密码不正确');
            }
            $user_RMB   = Db::name('user_card')
                ->where('id',$card_id)
                ->field('user_id,user_RMB')
                ->find();
            $number = $this->request->param('number',0,'float');
            $arr      = array(
                'user_RMB' => $user_RMB['user_RMB']+$number
            );
            $result = Db::name('user_card')
                ->where('id',$card_id)
                ->update($arr);
            if($result){
                $seller_id = $this->admin_user_id;
                //充值记录
                $record = array(
                    'time'      => time(),
                    'user_id'   => session('ADMIN_ID'),
                    'before'    => $user_RMB['user_RMB'],
                    'amount'    => $number,
                    'men_id'    => $user_RMB['user_id'],
                    'card_id'   => $card_id,
                    'seller_id' => $seller_id,
                );
                Db::name('recharge_record')->insert($record);

                $allRMB   = Db::name('user')
                    ->where('id',$user_RMB['user_id'])
                    ->value('user_RMB');
                $arr      = array(
                    'user_RMB' => $allRMB+$number
                );
                 Db::name('user')
                     ->where('id',$user_RMB['user_id'])
                     ->update($arr);
                $this->success('充值成功');
            }else{
                $this->error('充值失败');
            }
        }else{
            $this->error('错误操作',url('AdminOauth/index'));
        }
    }

    /**
     * 拉黑恢复操作
     * @adminMenu(
     *     'name'   => '拉黑恢复操作',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '拉黑恢复操作',
     *     'param'  => ''
     * )
     */
    public function ban()
    {
        $id = $this->request->param('id', 0, 'intval');
        if (!empty($id)) {
            $val = $this->request->param('val', 0, 'intval');
            $result = Db::name('third_party_user')->where(["id" => $id])->setField('status', $val);
            if ($result !== false) {
                $this->success("操作成功！", url("adminOauth/index"));
            } else {
                $this->error('操作失败！', url("adminOauth/index"));
            }
        } else {
            $this->error('数据传入失败！', url("adminOauth/index"));
        }
    }

    /**
     * 回退金额
     * @adminMenu(
     *     'name'   => '回退金额',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '回退金额',
     *     'param'  => ''
     * )
     */
    public function refund(){
        $request  = $this->request->param();
        $where    = array(
            'e.card_no'     => $request['card_no'],
            'e.card_number' => $request['card_number'],
        );
        $data     = Db::name('recharge_record')
                    ->field('a.*,b.harge')
                    ->alias('a')
                    ->join('__USER__ b','b.id=a.user_id')
                    ->join('__USER__ c','c.id=a.men_id')
                    ->join('__THIRD_PARTY_USER__ d','c.id=d.user_id')
                    ->join('__USER_CARD__ e','e.id=a.card_id')
                    ->where($where)
                    ->whereTime('a.time','-2 hours')
                    ->order('a.id DESC')
                    ->find();
        if(empty($data)){
            $this->error('没有记录，请在充值错误后两小时内回退\n只回退最新一条');
        }
        if(!cmf_compare_password($request['harge'],$data['harge'])){
            $this->error('充值密码不正确,需要充值人员的密码');
        }
        $result = Db::name('user_card')->where('id',$data['card_id'])->update(array('user_RMB'=>$data['before']));
        if(!$result){
            $this->error('你已经回退完成');
        }
        $result = Db::name('recharge_record')->where('id',$data['id'])->update(array('type'=>2));
        if(!$result){
            $this->error('操作失败', url("adminOauth/index"));
        }else{
            $this->success("操作成功！", url("adminOauth/index"));
        }
    }

    /**
     * 充值记录页面
     * @adminMenu(
     *     'name'   => '充值记录页面',
     *     'parent' => 'levelIndex',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '充值记录页面',
     *     'param'  => ''
     * )
     */
    public function recharge(){
        $request = $this->request->param();
        $seller_id = $this->admin_user_id;
        $where = array(
            'a.seller_id' => $seller_id,
        );
       /* if(!empty($request['user'])){
            $where['b.id'] = $request['user'];
        }*/
        if(!empty($request['type'])){
            $where['a.type'] = $request['type'];
        }

        if(!empty($request['user_keyword'])){
            $ret = Validate::is($request['user_keyword'],'chs');
            if($ret){
                $where['b.user_nickname'] = ['like',"%".$request['user_keyword']."%"];
            }else{
                $where['b.user_login'] = ['like',"%".$request['user_keyword']."%"];
            }
        }
        if(!empty($request['men_keyword'])){
            $ret = Validate::is($request['men_keyword'],'chs');
            if($ret){
                $where['c.user_nickname'] = ['like',"%".$request['men_keyword']."%"];
            }else{
                $where['c.user_login'] = ['like',"%".$request['men_keyword']."%"];
            }
        }

        $recharge_record = Db::name('recharge_record');
        if(!empty($request['beginTime']) || !empty($request['endTime'])){
            if(empty($request['beginTime'])){
                $request['beginTime']= '1970-01-01' ;
            }
            $endTime = $request['endTime'];
            if(empty($endTime)){
                $endTime= date('Y-m-d',time());
            }
            $endTime =    date("Y-m-d",strtotime("$endTime   +1   day"));
            $recharge_record->whereTime('time','between',[$request['beginTime'],$endTime]);
        }
        $data = $recharge_record
            ->field('a.*,b.user_login as waiter_login,b.user_nickname as waiter_nickname,c.user_login,c.user_nickname,d.id as third_id,e.card_no')
            ->alias('a')
            ->join('__USER__ b','b.id=a.user_id')
            ->join('__USER__ c','c.id=a.men_id')
            ->join('__THIRD_PARTY_USER__ d','c.id=d.user_id')
            ->join('__USER_CARD__ e','e.id=a.card_id')
            ->where($where)
            ->order('id DESC')
            ->paginate(10);
        $data->appends($request);
        $page = $data->render();
        $this->assign('data', $data);
        $this->assign('page', $page);
        //服务员列表
        $user = Db::name('user')
            ->field('id,user_login,user_nickname')
            ->where('Supermarket','neq',1)
            ->where('parent_id',$seller_id)
            ->select();
        $this->assign('user', $user);
        return $this->fetch();
    }
}