<?php
/**
 * Created by PhpStorm.
 * User: wujunyuan
 * Date: 2017/7/3
 * Time: 13:27
 */

namespace app\game\controller;


use think\Controller;
use Hooklife\ThinkphpWechat\Wechat;
use think\Session;
use think\Request;
class Login extends Controller
{
    /**
     *显示用户登录界面
     */
    public function index()
    {
        //使用微信登录，直接跳转到微信授权地址，这里要用微信的开发包了
//
//        $url = Wechat::app()->oauth->scopes(['snsapi_userinfo'])->redirect() -> getTargetUrl();
//        $this->redirect($url);
        return $this->fetch();
    }

    /**
     * 处理用户登录
     * 接收数据，然后验证
     */
    public function dologin()
    {
        $data=input();
        if($data['username']=='' || $data['password']==''){
            return $this->error("请先填写完整");
        }
        $user=model('member')->where(array('username'=>$data['username']))->find();
        if($user){
            if(md5($data['password'])!=$user['password']){
                return $this->error("密码错误");
            }else{
                Session::set('member_id', $user['id']);
                return $this->success("登录成功",url('index/index'));
            }
        }else{
            $db = model('member');
            $data['openid'] = $data['username'];
            $data['nickname'] = $data['username'];
            $data['password'] = md5($data['password']);
            $data['photo'] = "/static/touxiang/img_".rand(1,319).".png";
            //写入数据库信息，返回一个ID，注意$member是一个id
            $memberid = $db -> insert($data);
            if($memberid){
                $lastid = $db ->getLastInsID();
                Session::set('member_id', $lastid);
                return $this->success("注册成功,登录中",url('index/index'));
            }else{
                $this->error($db -> getError());
            }
        }

    }

    /**
     * 微信登录，这里发起微信登录请求，要设置一个回调地址
     */
    public function weixinlogin()
    {

    }

    /**
     * 微信登录回调地址，这里获取微信传回来的数据，然后查询数据库，验证用户信息登录
     */
    public function weixinloginback()
    {
        $user = Wechat::app()->oauth->user();
        //var_dump($user);
        $ret = $user->toArray();
        //数据模型
        $db = model('member');
        //查询用户的条件
        $map['openid'] = $ret['id'];
        //
        $member = $db->where($map)->find();
        //用户存在了，设置session，直接登录
        if ($member) {
            $member = $member -> toArray();
            Session::set('member_id', $member['id']);
            $this->redirect(url('Index/index'));
        } else {
            //用户不存在，写入数据，然后设置session再登录
            $data['openid'] = $ret['id'];
            $data['nickname'] = $ret['nickname'];
            $data['photo'] = $ret['avatar'];
            //写入数据库信息，返回一个ID，注意$member是一个id
            $memberid = $db -> insert($data);
            if($memberid){
                $lastid = $db ->getLastInsID();
                Session::set('member_id', $lastid);
                $this->redirect(url('Index/index'));
            }else{
                $this->error($db -> getError());
            }
        }
    }

    /**
     * 退出登录
     */
    public function logout(){
        Session::set('member_id', NULL);
        $this->redirect(url('Index/index'));
    }

//
//
//    public function comeout()
//    {
//        //进入房间的ID
//        $memberid = input('id');
//        $db = model('member');
//        $db->comeout(array('id' => $memberid));
//    }
}