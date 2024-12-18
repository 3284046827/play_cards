<?php
/**
 * Created by PhpStorm.
 * User: wujunyuan
 * Date: 2017/7/3
 * Time: 13:26
 */

namespace app\game\controller;

use think\Controller;
use think\facade\Queue;
use think\Loader;
use think\Db;
use think\Log;
use Workerman\Lib\Timer;

/**
 * 直接设置为房主是庄家
 * 抢庄是 3
 */
class Pkplaywjy extends Common
{
    private $gamelockfile;
    public function __construct()
    {
        parent::__construct();
        //文件锁路径
        define("LOCK_FILE_PATH", ROOT_PATH."tmp/lock/");
        $this->LOCK_FILE_PATH = ROOT_PATH."tmp/lock/";
        $this->workermanurl = 'http://127.0.0.1:2121';
        $this->workermandata['type'] = 'publish';
        $this->workermandata['content'] = '';
        $this->workermandata['to'] = 0;
        //加载斗牛类
        Loader::import('extend.Game.shitoujiandaobu');
        //创建一个斗牛实例
        $this->douniu = new \shitoujiandaobu(array());

    }

    /**
     * 游戏中使用的文件锁
     * @param $roomid
     * @return bool
     */
    private function gamelock($roomid){
        //锁住不让操作，保证原子性
        $this -> gamelockfile = fopen($this->LOCK_FILE_PATH.$roomid, "r");
        if (!$this -> gamelockfile) {
            $this->error('锁住了');
            return false;
        }
        flock($this -> gamelockfile, LOCK_EX);
    }

    /**
     * 游戏中使用的文件锁,解锁
     * @param $roomid
     * @return bool
     */
    private function gameunlock($roomid){
        //锁住不让操作，保证原子性
        flock($this -> gamelockfile, LOCK_UN);
        fclose($this -> gamelockfile);
    }


    /**
     * 创建房间
     * 底分：score【1,3,5,10,20】
     * 规则、牌型倍数：rule【1,2】，types【1,2,3】
     * 房卡游戏局数：gamenum【10:1,20:2】
     * 固定上庄：openroom【0,100,300,500】
     */
    public function roomcreate()
    {
        $rule['score'] = input('post.score'); //底分
           $rule['types'] = isset($_POST['types']) ? $_POST['types'] : array(); //类型
        $rule['rule'] = input('post.rule'); //规则
        $rule['gamenum'] = input('post.gamenum'); //房卡游戏局数
        $rule['gametype'] = input('post.gametype'); //游戏类型
        if (input('post.openroom')) {
            $rule['openroom'] = input('post.openroom');
        }

        $roomdb = model('room');
        $ret = $roomdb->roomcreate($this->memberinfo['id'], $rule);
        if ($ret) {
            model('member')->comein($ret, array('id' => $this->memberinfo['id']));
            model('member')->where(["id"=>$this->memberinfo['id']])->update(['banker'=>1,"issetmultiple"=>1,"issetbanker"=>1]);
            $this->success('创建成功', url('index', array('room_id' => $ret)));
        } else {
            $this->error($roomdb->getError());
        }
    }

    /**
     * @param $url
     * @param string $data
     * @param string $method
     * @param string $cookieFile
     * @param string $headers
     * @param int $connectTimeout
     * @param int $readTimeout
     * @return mixed
     */
    private function curlRequest($url, $data = '', $method = 'POST', $cookieFile = '', $headers = '', $connectTimeout = 30, $readTimeout = 30)
    {
        $method = strtoupper($method);

        $option = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CONNECTTIMEOUT => $connectTimeout,
            CURLOPT_TIMEOUT => $readTimeout
        );

        if ($data && strtolower($method) == 'post') {
            $option[CURLOPT_POSTFIELDS] = $data;
        }

        $ch = curl_init();
        curl_setopt_array($ch, $option);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect: '));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function sendmsg()
    {
        $memberid = $this->memberinfo['id'];
        $roommember = model('room')->getmember(array('id' => $this->memberinfo['room_id']));
        foreach ($roommember as $v) {
            if ($memberid != $v['id']) {
                //发给除了当前会员之外的房间中所有人
                $this->workermandata['to'] = $v['id'];
                $data['info'] = input('post.data');
                $data['from'] = $memberid;
                $data['type'] = 1;
                $data['msgid'] = input('post.id');
                $this->workermandata['content'] = json_encode($data);
                echo $this->curlRequest($this->workermanurl, $this->workermandata);
            }
        }
    }


    private function workermansend($to, $data)
    {
        $this->workermandata['to'] = $to;
        $this->workermandata['content'] = $data;
        return $this->curlRequest($this->workermanurl, $this->workermandata);
    }


    /**
     * 显示游戏界面
     * @return mixed
     */
    public function index()
    {
        //进入房间的ID
        $room_id = input('room_id');
        if ($room_id > 0) {
            $db = model('member');
            $ret = $db->comein($room_id, array('id' => $this->memberinfo['id']));
            if ($ret === false && $this -> memberinfo['room_id'] != $room_id) {
                $this->error($db->getError());
            }
            //$this->memberinfo['room_id'] = $room_id; 
            $room = model('room')->where(array('id' => $room_id))->find();
            if (!$room) {
                $this->error('房间不存在啊！！！');
            }
            $room = $room->toArray();
            $this->assign('gamerule', unserialize($room['rule'])); //游戏规则
            $this->assign('room', $room); //房间的信息
        } else {
            $this->error('迷路了，找不到房间！！！');
        }
        if ($room['playcount'] == 0) {
            if (input('room_id')) {
                $roomid = input('room_id');
            } else {
                $roomid = $this->memberinfo['room_id'];
            }
            $list = model('room')->getrankinglist($roomid);
            $this->assign('list', $list);
            $this->assign('room', $room);
            return $this->fetch('result:index');
        }
        $this->assign('rand', time()); //当前时间
        return $this->fetch();
    }

    /**
     *进入房间
     */
    public function comein()
    {

        $db = model('member');
        $room_id = input('room_id');
        if ($room_id) {
            $ret = $db->comein($room_id, array('id' => $this->memberinfo['id'])); //修改用户进入房间
            $this->allmember(); //通知 其余的用户 进入房间了
            if ($ret) {
                $this->success('成功进入房间');
            } else {
                $this->error($db->getError());
            }
        } else {
            $this->error('迷路了，找不到房间！！！');
        }

    }

    public function comeout()
    {
        //进入房间的ID
        $memberid = input('memberid') ? input('memberid') : $this->memberinfo['id'];

        $db = model('member');
        $ret = $db->comeout(array('id' => $memberid));
        //$this->allmember();
        if ($ret) {
            $this->success('有人断线');
        } else {
            $this->error('错误');
        }

    }

    /**
     * 通知一个会员更新他自己的玩家界面
     * 逻辑：
     * 1、全部准备好之后，倒计时，让玩家选择出的数据
     * 2.确定把数据传给后端，等待倒计时结束，
     * 3.倒计时结束后，如果玩家还没选择就直接随机1个出来，展示玩家出的数据并返回结果
     * 3.根据结果进行后续的操作
     */
    public function allmember()
    {

        $db = model('member');

        //不知道什么原因会使得
        //会员的牌是空的，然后状态又是摊牌状态，这样会出错，所以把状态改成0
        $db -> where(array('pai' => '', 'gamestatus' => 2)) -> update(array('gamestatus' => 0));

        //会员进入房间时通知所有人更新玩家
        $allmember = model('room')->getmember(array('id' => $this->memberinfo['room_id']));

        $room = model('room')->where(array('id' => $this->memberinfo['room_id']))->find();

        if ($room) {
            $room = $room->toArray();
            $room['rule'] = unserialize($room['rule']);

            //摊牌-等于结束时间（只要双方都提交了就结束了)
            $room['taipaitime'] = (int)$room['taipaitime'] - time(); //结束时间
            $room['starttime'] = (int)$room['starttime'] - time(); //开始时间

            if ($room['taipaitime'] < 0) {
                $room['taipaitime'] = 0;
            }
            if ($room['starttime'] < 0) {
                $room['starttime'] = 0;
            }
        }

        if (!$allmember) {
            return;
        }

        $ranking = model('room')->getranking($room['id']); //获取房间的金币的明细

        //获取会员的状态和结果 - 设置一个庄家 赢了庄家的人 列表 输给庄家的人的列表 - 就2个 暂时就写成单个id
        $willMemberId = 0;
        $lostMemberId = 0;
        $pai = 0;
        //通知所有会员更新界面
        foreach ($allmember as $v) {
            if($v['gamestatus'] == 2) {
                $pai = $v["pai"];
            }
            $ret = $db->getothermember($v['id']); //获取当前房间的其他会员的信息
            foreach ($ret as $key => $val) {
                if (isset($ranking[$val['id']])) {
                    $ret[$key]['money'] = $ranking[$val['id']];
                } else {
                    $ret[$key]['money'] = 0;
                }
                if ($val['gamestatus'] == 3 || $val['gamestatus'] == 2) { //说明确定了选择
                    $ret[$key]['pai'] = $val['pai']; //牌的数据
                    $ret[$key]['info'] = 0; //牌的信息 - 不需要了

                    $tag = $this->getWinStatus($pai,$val['pai']);
                        if($tag == 1) {
                            model("member")->where("id","=",$v["id"])->update(["pairet"=>2]);
                            model("member")->where("id","=",$val["id"])->update(["pairet"=>1]);
                        }

                        if($tag == 2) {
                            model("member")->where("id","=",$v["id"])->update(["pairet"=>1]);
                            model("member")->where("id","=",$val["id"])->update(["pairet"=>2]);
                        }

                        if($tag == 3) {
                            model("member")->where("id","=",$v["id"])->update(["pairet"=>0]);
                            model("member")->where("id","=",$val["id"])->update(["pairet"=>0]);
                        }


                } else {
                    $ret[$key]['pai'] = "";
                    $ret[$key]['info'] = '未知';
                }
            }
            $start = model('room')->getgamestatus(array('id' => $v['room_id']));
            $return['start'] = $start; //false
            $return['data'] = $ret; //房间的其他会员的信息
            $return['room'] = $room; //房间信息
            if (isset($ranking[$v['id']])) {
                $return['money'] = $ranking[$v['id']];
            } else {
                $return['money'] = 0;
            }

            $return['issetbanker'] = $v['issetbanker']; //用户是否点击过抢庄按钮 - 未
            $return['multiple'] = $v['multiple']; //下注倍数
            $return['banker'] = unserialize($room['setbanker']); //设置庄家的结果 设置到这里
            $return['isbanker'] = $v['banker']; //是否是庄玩家
            $return['issetmultiple'] = $v['issetmultiple']; //玩家是否下注
            $return['playcount'] = $room['playcount'] - 1; //房间可玩的次数
            $return['type'] = 4; //类型
            $return['gamestatus'] = $v['gamestatus']; //玩家的游戏状态 1准备好了 3确定了
            //如果会员摊牌状态，通知前端更新
            if ($return['gamestatus'] == 2) { //提交了牌
                $return['pai'] = $v['pai'];
                $return['info'] = 0;
            }elseif($return['gamestatus'] == 3) { //摊牌
                $return['pai'] = $v['pai'];
                $return['info'] = 0;
            } elseif ($return['gamestatus'] == 1) { //1准备好了
                $return['pai'] = '';
            } else {
                $return['pai'] = "";
            }
            $this->workermansend($v['id'], json_encode($return)); //循环单独给 每个会员推送的
        }

    }

    /**
     * 脚本触发的
     * @param $memberId
     * @param $roomId
     * @return void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     *
     */
    public function allmemberjiaoben($memberId,$roomId)
    {

        $db = model('member','common\model');

        //不知道什么原因会使得
        //会员的牌是空的，然后状态又是摊牌状态，这样会出错，所以把状态改成0
        $db -> where(array('pai' => '', 'gamestatus' => 2)) -> update(array('gamestatus' => 0));

        //会员进入房间时通知所有人更新玩家
        $allmember = model('room','common\model')->getmember(array('id' => $roomId));

        $room = model('room','common\model')->where(array('id' => $roomId))->find();

        if ($room) {
            $room = $room->toArray();
            $room['rule'] = unserialize($room['rule']);

            //摊牌-等于结束时间（只要双方都提交了就结束了)
            $room['taipaitime'] = (int)$room['taipaitime'] - time(); //结束时间
            $room['starttime'] = (int)$room['starttime'] - time(); //开始时间

            if ($room['taipaitime'] < 0) {
                $room['taipaitime'] = 0;
            }
            if ($room['starttime'] < 0) {
                $room['starttime'] = 0;
            }
        }

        if (!$allmember) {
            return;
        }

        $ranking = model('room','common\model')->getranking($room['id']); //获取房间的金币的明细

        $pai = 0;
        //通知所有会员更新界面
        foreach ($allmember as $v) {
            if($v['gamestatus'] == 2) {
                $pai = $v["pai"];
            }
            $ret = $db->getothermember($v['id']); //获取当前房间的其他会员的信息
            foreach ($ret as $key => $val) {
                if (isset($ranking[$val['id']])) {
                    $ret[$key]['money'] = $ranking[$val['id']];
                } else {
                    $ret[$key]['money'] = 0;
                }
                if ($val['gamestatus'] == 3 || $val['gamestatus'] == 2) { //说明确定了选择
                    $ret[$key]['pai'] = $val['pai']; //牌的数据
                    $ret[$key]['info'] = 0; //牌的信息 - 不需要了

                    $tag = $this->getWinStatus($pai,$val['pai']);
                    if($tag == 1) {
                        model("member",'common\model')->where("id","=",$v["id"])->update(["pairet"=>2]);
                        model("member",'common\model')->where("id","=",$val["id"])->update(["pairet"=>1]);
                    }

                    if($tag == 2) {
                        model("member",'common\model')->where("id","=",$v["id"])->update(["pairet"=>1]);
                        model("member",'common\model')->where("id","=",$val["id"])->update(["pairet"=>2]);
                    }

                    if($tag == 3) {
                        model("member",'common\model')->where("id","=",$v["id"])->update(["pairet"=>0]);
                        model("member",'common\model')->where("id","=",$val["id"])->update(["pairet"=>0]);
                    }
                } else {
                    $ret[$key]['pai'] = "";
                    $ret[$key]['info'] = '未知';
                }
            }
            $start = model('room','common\model')->getgamestatus(array('id' => $v['room_id']));
            $return['start'] = $start; //false
            $return['data'] = $ret; //房间的其他会员的信息
            $return['room'] = $room; //房间信息
            if (isset($ranking[$v['id']])) {
                $return['money'] = $ranking[$v['id']];
            } else {
                $return['money'] = 0;
            }

            $return['issetbanker'] = $v['issetbanker']; //用户是否点击过抢庄按钮 - 未
            $return['multiple'] = $v['multiple']; //下注倍数
            $return['banker'] = unserialize($room['setbanker']); //设置庄家的结果 设置到这里
            $return['isbanker'] = $v['banker']; //是否是庄玩家
            $return['issetmultiple'] = $v['issetmultiple']; //玩家是否下注
            $return['playcount'] = $room['playcount'] - 1; //房间可玩的次数
            $return['type'] = 4; //类型
            $return['gamestatus'] = $v['gamestatus']; //玩家的游戏状态 1准备好了 3确定了
            //如果会员摊牌状态，通知前端更新
            if ($return['gamestatus'] == 2) { //提交了牌
                $return['pai'] = $v['pai'];
                $return['info'] = 0;
            }elseif($return['gamestatus'] == 3) { //摊牌
                $return['pai'] = $v['pai'];
                $return['info'] = 0;
            } elseif ($return['gamestatus'] == 1) { //1准备好了
                $return['pai'] = '';
            } else {
                $return['pai'] = "";
            }
            $this->workermansend($v['id'], json_encode($return)); //循环单独给 每个会员推送的
        }

    }

    // 1 $pai1 赢 2$pai2 赢  0 ping
    public function getWinStatus($pai1,$pai2)
    {
        if($pai1 == 0 || $pai2 == 0) {
            return 0;
        }
        if($pai1 == $pai2) {
            return 3;
        }
        switch ($pai1) {
            case 1: //shitou
                if($pai2 == 2) { //jiandao
                    return 1;
                }
                if($pai2 == 3) { //bu
                    return 2;
                }
                break;
            case 2://jiandao
                if($pai2 == 1) { //shitou
                    return 2;
                }
                if($pai2 == 3) { //bu
                    return 1;
                }

                break;

            case 3: //bu
                if($pai2 == 1) { //shitou
                    return 1;
                }
                if($pai2 == 2) { //jiandao
                    return 2;
                }
                break;
        }
    }

//    /**
//     * 闲家下注
//     */
//    public function setmultiple()
//    {
//        $room = model('room')->where(array('id' => $this->memberinfo['room_id']))->find();
//        if ($room) {
//            $room = $room->toArray();
//
//
//        }
//        model('room')->where(array('id' => $this->memberinfo['room_id']))->update(array('setbanker' => ''));
//        $multiple = intval(input('multiple'));
//        model('member')->settimes($this->memberinfo['id'], $multiple);
//        model('member')->where(array('id' => $this->memberinfo['id']))->update(array('issetmultiple' => 1));
//
//        if(time() >= $room['xiazhutime']){
//            model('member')->where(array('room_id' => $this->memberinfo['room_id'], 'gamestatus' => array('neq', 0), 'banker' => 0, 'issetmultiple' => 0))->update(array('issetmultiple' => 1));
//        }
//
//        //所有闲家都下注了，就直接开牌
//        $unmultiple = (int)model('member')->where(array('room_id' => $this->memberinfo['room_id'], 'gamestatus' => array('neq', 0), 'banker' => 0, 'issetmultiple' => 0))->count();
//        if ($unmultiple == 0) {
//            model('room')->where(array('id' => $this->memberinfo['room_id']))->update(array('taipaitime' => time() + 15, 'gamestatus' => 4));
//
//        }
//        $this->allmember();
//    }
//
//    /**
//     * 设置庄家
//     */
//    public function setbanker()
//    {
//        $multiple = intval(input('multiple'));
//        if ($multiple > 0) {
//            //model('member')->settimes($this->memberinfo['id'], $multiple);
//            model('member')->where(array('id' => $this->memberinfo['id'], 'issetbanker' => 0))->update(array('multiple' => $multiple));
//            model('member')->where(array('id' => $this->memberinfo['id'], 'gamestatus' => 1))->update(array('banker' => 1));
//        }
//        model('member')->where(array('id' => $this->memberinfo['id']))->update(array('issetbanker' => 1));
//        model('room')->setbanker($this->memberinfo['room_id']);
//        $this->allmember();
//    }

    //
    public function sureSelect(){
        $paiValue = intval(input('selectPai'));
        if (in_array($paiValue,[1,2,3])) {
            $map = array('room_id' => $this->memberinfo['room_id']);
            $allmember = Db::name('member') -> where($map) -> select();

//            var_dump($this->memberinfo['id']."success".$paiValue);
            $playcount = (int)model('paihistory')->where(array('room_id' => $this->memberinfo['room_id']))->max('playcount');
            //修改房间局数-房间-对应的用户
            $data = model('paihistory')
               ->where(["room_id"=>$this->memberinfo["room_id"],"member_id"=>$this->memberinfo["id"],"playcount"=>$playcount])->find();

           if ($data && $data['pai'] == 0) {
               //修改 - 然后查询该房间的所有人是否都已经下注，如果已经下注 则修改房间状态，调用allmember 发送。
               model('paihistory')
                   ->where(["id"=>$data["id"]])->update(["pai"=>$paiValue]);

                    model('member')
                        ->where(["id"=>$this->memberinfo['id']])
                        ->update(["pai"=>$paiValue,"gamestatus"=>2,"issetmultiple"=>1,"issetbanker"=>1]);
                   //查询该房间的全部员工是否已经全部选择完成，完成则直接摊牌
                    $count = model('paihistory')
                        ->where(["room_id"=>$this->memberinfo["room_id"],"playcount"=>$playcount])
                        ->where("pai","<>",0)->group("member_id")->count();
                    if ($count >= count($allmember)) {
                        $this->showall();
                    }
           }

        }
        return true;
    }


    public function gamestart(){
        $gameinit = 0;
        $map = array('room_id' => $this->memberinfo['room_id']);
        $allmember = Db::name('member') -> where($map) -> select();
        foreach ($allmember as $v) {
            if ($v['gamestatus'] == 1) {
                //发现有人未准备，游戏不开始
                $gameinit++;
            }
        }
        $starttime = (int)model('room')->where(array('id' => $this->memberinfo['room_id']))->value('starttime');
        //人齐了，或者人不齐时间到了，两者其一满足就发牌，开始游戏
        if (($gameinit > 1 && $starttime <= time()) || ($gameinit == count($allmember) && $gameinit > 1)) {
            model('room')->where(array('id' => $this->memberinfo['room_id']))->update(array('starttime' => time(), 'gamestatus' => 1));
            //这里发牌
            $this->init();
        }
    }

    /**
     * 点击准备好游戏 gameready()
     * @return void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function gameready()
    {

        $islock = model('room')->where(array('id' => $this->memberinfo['room_id']))->value('islock');
        //gamestatus 0未开始，1准备，2正在抢庄，3闲家正在下注
        if ($islock == 1 && $this->memberinfo['gamestatus'] < 1) {
            $this->error('游戏进行中，不允许加入');
        }
        if ($this->memberinfo['room_id'] == 0) {
            //都没有进房间，开始什么呀，有毛病
            $this->error('都还没有进房间呢');
        }
        $ret = true;
        if(input('gameready') == 1){ //修改 用户为准备状态
            $ret = model('member')->where(['id' => $this->memberinfo['id']])->update(array('gamestatus' => 1,'pai'=>'',"pairet"=>''));
        }

        $gameinit = 0;
        //所有准备好的人数
        $roomdb = model('room');
        $map = array('room_id' => $this->memberinfo['room_id']);
        $allmember = Db::name('member') -> where($map) -> select();
        foreach ($allmember as $v) {
            if ($v['gamestatus'] == 1) {
                //发现有人未准备，游戏不开始
                $gameinit++;
            }
        }
        if ($ret) {
            //两个准备就开始倒计时
            if ($gameinit == 2) {
                //两个人参与时有两种情况
                if ($gameinit == count($allmember)) {
                    //房间里就两个人，马上就开始了
                    model('room')->where(array('id' => $this->memberinfo['room_id']))->update(array('starttime' => time(), 'gamestatus' => 1));
                } else {
                    //房间里还有其他人，超过两个了，再等5秒
                    model('room')->where(array('id' => $this->memberinfo['room_id']))->update(array('starttime' => time() + 5, 'gamestatus' => 1));
                }

            }
        }

        //游戏可以开始了，通知房间中所有会员
        $starttime = (int)model('room')->where(array('id' => $this->memberinfo['room_id']))->value('starttime');
        //人齐了，或者人不齐时间到了，两者其一满足就发牌，开始游戏
        if (($gameinit > 1 && $starttime <= time()) || ($gameinit == count($allmember) && $gameinit > 1)) {
            //这里发牌(进行游戏的主逻辑，改为用户主动提交，机器人则等待用户提交之后进行判断再提交)
            $this->gamelock($this->memberinfo['room_id']);
            $this->init();
            $this->gameunlock($this->memberinfo['room_id']);
        }

        if ($ret) {
            $this->allmember();
            $this->success('准备好了');
        } else {
            $this->success($ret);
//            $this->error(model('member')->getError());
        }
    }

    /**
     * todo 修改为用户主动触发 如果用户不触发 则随机选一个
     * 这里要引入斗牛类了
     * 开始游戏，洗牌，发牌生成N副牌
     * 这里是把数据直接传回前端的
     */
    private function init()
    {
        //issetbanker 用户是否点击过抢庄按钮、
        //issetmultiple 是否下注了，1表示已经下注
        //banker 是否庄家，1是庄家，0是闲家
        //multiple 下注倍数
        model('member')
            ->where(array('room_id' => $this->memberinfo['room_id']))
            ->update(array('issetbanker' => 0, 'issetmultiple' => 0, 'multiple' => 1));
        //查询房间中所有会员， 这个动作是最后一个准备游戏的会员触发的
        $allmember = model('room')->getmember(array('id' => $this->memberinfo['room_id']));

        //遍历所有会员，这块逻辑放到主动触发的接口上
        $memberdb = model('member');
        //牌历史表最大值加1
        $playcount = (int)model('paihistory')->where(array('room_id' => $this->memberinfo['room_id']))->max('playcount') + 1;
        //房间最大的牌次数
        $playcountroom = (int)model('room')->where(array('id' => $this->memberinfo['room_id']))->max('playcount');
        $paiarr = array();


        foreach ($allmember as $v) {
                $map['id'] = $v['id'];
                $data['pai'] = 0;
                $history['pai'] = 0;
                $history['member_id'] = $v['id'];
                $history['room_id'] = $this->memberinfo['room_id'];
                $history['create_time'] = time();
                $history['playcount'] = $playcount;
                $paidata['map'] = $map;
                $paidata['data'] = $data;
                $paidata['history'] = $history;
                $paiarr[$v['id']] = $paidata;
        }

        foreach($paiarr as $k => $v){
            model('paihistory')->insert($v['history']);
            $memberdb->where($v['map'])->update($v['data']);
        }

        //
        $time = time();
        model('room')
            ->where(array('id' => $this->memberinfo['room_id']))
            ->update(array('islock' => 1, 'qiangtime' => $time, 'taipaitime' => $time + 15, 'gamestatus' => 2)); //房间的状态
        $tempthis = $this;
        \think\Queue::later(15,"app\job\DelayQueue",["type"=>1,"playcount"=>$playcount,"allmember"=>$allmember,'room_id' => $this->memberinfo['room_id'],"class"=>serialize($tempthis)]);
    }

    /**
     * 摊牌 - 操作 相当于 石头剪刀布 的全部展示信息
     **/
    public function showall()
    {
        $member_id = $this->memberinfo["id"];
        $roomId = $this->memberinfo["room_id"];

        $roomdb = model('room');
        $roomgamestatus = $roomdb->where(array('id' => $roomId))->value('gamestatus');
        if ($roomgamestatus == 0) {
            $this->error('游戏还没有开始');
        }
        if ($this->memberinfo['room_id'] == 0) {
            //都没有进房间，开始什么呀，有毛病
            $this->error('都还没有进房间呢');
        }

        $ret = model('member')->gameshowall(array('gamestatus' => 2, 'id' => $member_id)); //用户状态 2 -> 3
        $gameshowall = true;
        //所有准备好的人数
        $map = array('room_id' => $roomId, 'gamestatus' => array('neq', 0));
        $allmember = model('member')->where($map)->select();
        foreach ($allmember as $v) {
            $v = $v->toArray();
            if ($v['gamestatus'] != 2) { // 2代表已经提交牌了
                //发现有人未摊牌
                $gameshowall = false;
            }
        }
        if ($gameshowall) {
            model('room')->where(array('id' => $roomId))->update(array('taipaitime' => time(),"gamestatus"=>4));
            model('member')->gameshowall(array('gamestatus' => 2, 'room_id' => $roomId));
        }
        $taipaitime = (int)model('room')->where(array('id' => $roomId))->value('taipaitime');
        if ($taipaitime - time() <= 0) {
            model('member')->gameshowall(array('gamestatus' => 2, 'room_id' => $roomId));
            $gameshowall = true;
        }
        $this->allmember();
        //游戏可以开始了，通知房间中所有会员
        if ($gameshowall) {
            //游戏结束
            $this->theend();
        }

        if ($ret) {
            $this->success('处理正确');
        } else {
            $this->success($ret);
//            $this->error(model('member')->getError());
        }
    }

    /**
     * 延迟任务 触发摊牌
     **/
    public function showalljiaoben($member_id,$roomId)
    {
        $roomdb = model('room','common\model');
        $roomgamestatus = $roomdb->where(array('id' => $roomId))->value('gamestatus');
        if ($roomgamestatus == 0) {
            $this->error('游戏还没有开始');
        }
        if ($this->memberinfo['room_id'] == 0) {
            //都没有进房间，开始什么呀，有毛病
            $this->error('都还没有进房间呢');
        }

        $ret = model('member','common\model')->gameshowall(array('gamestatus' => 2, 'id' => $member_id)); //用户状态 2 -> 3
        $gameshowall = true;
        //所有准备好的人数
        $map = array('room_id' => $roomId, 'gamestatus' => array('neq', 0));
        $allmember = model('member','common\model')->where($map)->select();
        foreach ($allmember as $v) {
            $v = $v->toArray();
            if ($v['gamestatus'] != 2) { // 2代表已经提交牌了
                //发现有人未摊牌
                $gameshowall = false;
            }
        }
        if ($gameshowall) {
            model('room','common\model')->where(array('id' => $roomId))->update(array('taipaitime' => time(),"gamestatus"=>4));
            model('member','common\model')->gameshowall(array('gamestatus' => 2, 'room_id' => $roomId));
        }
        $taipaitime = (int)model('room','common\model')->where(array('id' => $roomId))->value('taipaitime');
        if ($taipaitime - time() <= 0) {
            model('member','common\model')->gameshowall(array('gamestatus' => 2, 'room_id' => $roomId));
            $gameshowall = true;
        }
        $this->allmemberjiaoben($member_id,$roomId);
        //游戏可以开始了，通知房间中所有会员
        if ($gameshowall) {
            //游戏结束
            $this->theendjiaoben($member_id,$roomId);
        }

        if ($ret) {
            $this->success('处理正确');
        } else {
            $this->success($ret);
//            $this->error(model('member',"common\model")->getError());
        }
    }

    /**
     * 一局结束，这里要重新来一局
     * 1.默认进来 状态 0 。准备好 状态变为1，同时房间状态变为 1
     * 2.双方选择，确定或者脚本执行完成双方选择，变为2，房间状态变为4.
     * 3.房间重置为开始状态，并计算得分数据记录，双方数据质控， 双方展示选择的排面，然后进行动画。
     * 4.重新准备开始。
     */
    public function theend()
    {
        //通知前端显示再来一局的准备按钮,这里要计算游戏结果
        //计算出游戏结果后，初始化，牌的数据和牌型全改为原始状态
        //查询房间中所有会员， 这个动作是最后一个准备游戏的会员触发的
        //通知前端显示排名
        $room = model('room')->where(array('id' => $this->memberinfo['room_id']))->find();
        if ($room) {
            $room = $room->toArray();
        }


        $rule = unserialize($room['rule']);
        $this->gamelock($this->memberinfo['room_id']); //锁文件
        model('room')->gameinit(array('id' => $this->memberinfo['room_id'])); //初始化房间
        $this->gameunlock($this->memberinfo['room_id']); //解锁文件
        $gamenum = explode(':', $rule['gamenum']);


        $this->allmember();
        /*通知前端显示金币动画*/
        $allmember = model('room')->getmember(array('id' => $this->memberinfo['room_id']));
        if ($allmember) {
            $rank['end'] = 0;
            if (($room['playcount'] == $gamenum[0] && $room['room_cards_num'] == 0) || $room['playcount'] == 0) {
                $rank['end'] = 1;
            }
            $jinbi = model('room')->where(array('id' => $this->memberinfo['room_id']))->value('jinbi');
            foreach ($allmember as $k => $v) {
                $rank['data'] = unserialize($jinbi);
                $rank['type'] = 999;
                $this->workermansend($v['id'], json_encode($rank));
            }
        }

        /*通知金币动画结束*/
    }

    public function theendjiaoben($memberId,$roomId)
    {
        //通知前端显示再来一局的准备按钮,这里要计算游戏结果
        //计算出游戏结果后，初始化，牌的数据和牌型全改为原始状态
        //查询房间中所有会员， 这个动作是最后一个准备游戏的会员触发的
        //通知前端显示排名
        $room = model('room','common\model')->where(array('id' => $roomId))->find();
        if ($room) {
            $room = $room->toArray();
        }


        $rule = unserialize($room['rule']);
        $this->gamelock($roomId); //锁文件
        model('room','common\model')->gameinit(array('id' => $roomId)); //初始化房间
        $this->gameunlock($roomId); //解锁文件
        $gamenum = explode(':', $rule['gamenum']);


        $this->allmemberjiaoben($memberId,$roomId);
        /*通知前端显示金币动画*/
        $allmember = model('room','common\model')->getmember(array('id' => $roomId));
        if ($allmember) {
            $rank['end'] = 0;
            if (($room['playcount'] == $gamenum[0] && $room['room_cards_num'] == 0) || $room['playcount'] == 0) {
                $rank['end'] = 1;
            }
            $jinbi = model('room','common\model')->where(array('id' => $roomId))->value('jinbi');
            foreach ($allmember as $k => $v) {
                $rank['data'] = unserialize($jinbi);
                $rank['type'] = 999;
                $this->workermansend($v['id'], json_encode($rank));
            }
        }

        /*通知金币动画结束*/
    }


    private function setshownum($num, $room_id)
    {
        $allmember = model('room')->getmember(array('id' => $room_id));
        foreach ($allmember as $k => $v) {
            $pai = unserialize($v['pai']);
            $ret = array(0, 0, 0, 0, 0);
            for ($i = 0; $i < $num; $i++) {
                $ret[$i] = $pai[$i];
            }
            model('member')->where(array('id' => $v['id']))->update(array('tanpai' => serialize($ret)));
        }
    }

    /**
     *通比牛牛：不抢庄，不下注，直接比牌的大小
     */
    public function tombi()
    {
        $rule = model('room')->where(array('id' => $this->memberinfo['room_id']))->value('rule');
        $rule = unserialize($rule);
            $this->setshownum(3, $this->memberinfo['room_id']);
            $time = time();
            $update['taipaitime'] = $time + 15;
            $update['qiangtime'] = $time;
            $update['xiazhutime'] = $time;
            $update['starttime'] = $time;
            $update['gamestatus'] = 4;
            model('room')->where(array('id' => $this->memberinfo['room_id']))->update($update);
            //房间牌最大的id
            $bankermemberid = model('member')->where(array('room_id' => $this->memberinfo['room_id'], 'gamestatus' => array('gt', 0)))->order('pairet desc')->value('id');
            model('member')->where(array('id' => $bankermemberid))->update(array('banker' => 1));
            model('member')->where(array('room_id' => $this->memberinfo['room_id'], 'gamestatus' => array('gt', 0)))->update(array('issetmultiple' => 1, 'issetbanker' => 1));
    }

    public function showone()
    {
        $gamestatus = model('room')->where(array('id' => $this->memberinfo['room_id']))->value('gamestatus');
        if ($gamestatus < 3) {
            $this->error('目前不能翻牌！');
        }

        $key = input('key');
        $map['id'] = $this->memberinfo['id'];
        $member = model('member')->where($map)->find();

        if ($member) {
            $member->toArray();
        } else {
            $this->error('会员不存在');
        }
        if ($member['banker'] == 0 && $member['issetmultiple'] != 1) {
            $this->error('目前不能翻牌！');
        }
        $pai = unserialize($member['pai']);
        $tanpai = unserialize($member['tanpai']);
        $tanpai[$key] = $pai[$key];
        $data['tanpai'] = serialize($tanpai);
        $ret = model('member')->where($map)->update($data);
        if ($ret) {
            $return['code'] = 1;
            $return['msg'] = $tanpai[$key];
            echo json_encode($return);
        } else {
            $this->error('翻牌失败' . model('member')->getError());
        }

        $this->allmember();
    }
}
