<?php
session_start();
include_once('./config/database.php');
include_once('./config/Pdb.php');
include_once('./config/rand.php');
$_POST=$_REQUEST;
$db=Pdb::getDb();
if(isset($_POST['model'])){
	switch ($_POST['model']) {
		case 'islogin':
			//print getUuid::guid();die;
			if(isset($_COOKIE['lv_ibeacon_uuid'])){
				$uuid=$_COOKIE['lv_ibeacon_uuid'];
			}else{
				$uuid=getUuid::guid();
				@setcookie("lv_ibeacon_uuid",$uuid,time()+3600*24*365,"/");
			}
			$sql="select id from lv_ibeacon_info where uuid=".$db->quote($uuid);
			$rs=$db->getOne($sql);
			if($rs){
				print json_encode(array("code"=>1,"msg"=>"已经完善过"));
				exit;
			}
			print json_encode(array("code"=>0,"msg"=>"没有完善过"));
			exit;
			break;
	
		case 'finish':
			if(isset($_COOKIE['lv_ibeacon_uuid'])){
				$uuid=$_COOKIE['lv_ibeacon_uuid'];
			}else{
				$uuid=getUuid::guid();
				@setcookie("lv_ibeacon_uuid",$uuid,time()+3600*24*365,"/");
			}
			$tag=false;
			$name=isset($_POST['name'])?$_POST['name']:$tag=true;
			$mobile=isset($_POST['mobile'])?$_POST['mobile']:"";
			if($tag){
				print json_encode(array("code"=>2,"msg"=>"请填写必填项"));
				exit;
			}
			$sql="insert into  lv_ibeacon_info set name=".$db->quote($name).",mobile=".$db->quote($mobile).",uuid=".$db->quote($uuid);
			$db->execute($sql);
			print json_encode(array("code"=>1,"msg"=>"提交成功"));
			exit;
			break;
	
		case 'test':
			echo "<pre>";
			print_r($_COOKIE);exit;
			break;
		default:
			# code...
			print json_encode(array("code"=>9999,"msg"=>"No Model"));
			exit;
			break;
	}
}		
print "error";
exit;
