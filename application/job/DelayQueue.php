<?php
namespace app\job;
use app\common\model\Member;
use app\common\model\Paihistory;
use app\game\controller\Pkplaywjy;
use think\Exception;
use think\Log;
use think\queue\Job;

class DelayQueue
{
    public function fire(Job $job,$data)
    {
        //获取类型
        switch ($data['type']){
            case   1: //开牌倒计时
                $playcount = $data["playcount"];
                $ids = [];
                foreach ($data["allmember"] as $v) {
                    $ids[] = $v["id"];
                }
                $this->getRoomAndMemberStatus($ids,$data["room_id"],$playcount, unserialize($data["class"]));
                echo "success";
                break;
            default:
                echo "No Type";
        }
        //类型1 到时间了 查询是否选择了牌 没选择 自动先选择1个 然后进行推送
        $job->delete();
    }

    //具体的逻辑
    public function getRoomAndMemberStatus($member,$roomId,$playcount,Pkplaywjy $class){
        //查询会员是否还在房间 - 不在房间了则 不处理了
        $allMember = (new Member())->where("id","in",$member)->select();
        foreach ($allMember as $v) {
            if($v["room_id"] != $roomId) {
                return false;
            }
        }
        //查询是否已经进行了选择，没有进行选择 则自动选择,并返回true ，进行了选择的则不再处理
       $paihistory =  (new Paihistory())->where(["room_id"=>$roomId,"playcount"=>$playcount])->select();

        $paiValue = "";
        foreach ($paihistory as $v) {
            if($v["pai"] != 0) {
                $paiValue = $v["pai"];
            }
        }
        $numbers = [1,2,3];
        foreach ($numbers as $k => $v) {
            if ($v == $paiValue) {
                unset($numbers[$k]);
            }
        }
        //查询到牌的所有历史数据
        foreach ($paihistory as $v) {
            if($v["pai"] == 0) {
                    $randomIndex = array_rand($numbers);
                    $randomNumber = $numbers[$randomIndex];
                    (new Paihistory())->where(["id"=>$v["id"]])->update(["pai"=>$randomNumber]); //修改状态
                    (new Member())->where(["id"=>$v["member_id"]])->update(["gamestatus"=>2,"pai"=>$randomNumber,"issetmultiple"=>1,"issetbanker"=>1]); //直接设置玩家是 抢庄、下注后的状态
                    $class->showalljiaoben($v["member_id"],$roomId);
                //传递过来的实例化方法来触发
            }
        }
    }
}