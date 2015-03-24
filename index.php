<?php
if(date('Ymd') >= 20150321 && date('Ymd') <= 20150322){
  $s = isset($_GET['s']) ? $_GET['s'] : "";
  print '<span style="font-size:300px">' . $s . '</span>';
  exit;
}
include_once('./config/database.php');
include_once('./config/Pdb.php');
include_once('./config/uUid.php');
$db = Pdb::getDb();
$s = isset($_GET['s']) ? $_GET['s'] : "";
$id = substr($s,4);
if(isset($_COOKIE['lv_ibeacon_uuid'])){
    $uuid = $_COOKIE['lv_ibeacon_uuid'];
}else{
    $uuid = getUuid::guid();
    @setcookie("lv_ibeacon_uuid", $uuid, time()+3600*24*365, "/");
}
if($id){
  $db->execute("insert into lv_ibeacon_pv set uuid=".$db->quote($uuid).",resource=".$db->quote($id));

  if(in_array($id, array(13, 14, 15, 16, 17, 18))){
    switch ($id) {
      case '13':  
        $taget = 'http://www.seriescampaign.com/rooms.php#eighth';
        break;
      case '14':  
        $taget = 'http://www.seriescampaign.com/rooms.php#sixth';
        break;
      case '15':  
        $taget = 'http://www.seriescampaign.com/rooms.php#nine';
        break;
      case '16':  
        $taget = 'http://www.seriescampaign.com/rooms.php#second';
        break;
      case '17':  
        $taget = 'http://www.seriescampaign.com/rooms.php#third';
        break;
      case '18':  
        $taget = 'http://www.seriescampaign.com/rooms.php#seventh';
        break;
    }
    Header("Location: " . $taget);
    exit;

  }

}
$sql = "select id from lv_ibeacon_info where uuid=" . $db->quote($uuid);
$rs = $db->getOne($sql);
$finish = $rs ? 1 : 0;

//$id=1;$finish=0;
?> 
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
  <meta name="robots" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
	<meta content="yes"name="apple-mobile-web-app-capable"/>
 	<meta content="black"name="apple-mobile-web-app-status-bar-style"/>
	<meta name="format-detection"content="telphone=no"/>
	<title>路易威登</title>
  <link rel="stylesheet" type="text/css" href="/css/jquery.mCustomScrollbar.css" />
  <link rel="stylesheet" type="text/css" href="/css/page.css" />
	<script type="text/javascript" src="/js/zepto.js"></script>
  <script type="text/javascript" src="/js/touch.js"></script>
</head>
<body data-id="<?php echo $id;?>" data-finish="<?php echo $finish;?>" >
<div id="heng"></div>
<!-- <span class="arr"></span> -->


<div id="main" class="wrap-page">

    <section class="page introduction page-active" data-page="introduction">
      <div class="demo-test"> 
        <div class="logo">
          <img src="/images/logo.png" width="30%" />
        </div>
        <div class="intro" >
          <img src="/images/introduction/intro.png" width="75%" />
        </div>
        <div class="arr"></div>    
      </div>
    </section>

    <section class="page form page-next" data-page="form">
      <div class="demo-test">
       
        <div class="logo">
          <img src="/images/logo.png" width="30%" />
          <h1>填写个人信息<br/>获取你的专属邀请函</h1>
        </div>
        <div class="form">
          <form name="formval" id="formval">
            <ul>
              <li>  
                <span class="formtext">姓名：
                  <input type="text" id="name" placeholder="" name="name" data-role="none">
                </span>
              </li>
              <li>     
                <span class="formtext">电话：
                  <input type="tel" id="mobile" placeholder="" name="mobile" maxlength="11" data-role="none">
                </span>         
              </li>
              <p><a class="formsubmit" href="javascript:;">提交</a><p>
            </ul>
          </form>
        </div>
        <div class="series">
          <img src="/images/series.png"  width="30%"/>
        </div>   
      </div>
    </section>

    <section class="page home page-next" data-page="home">
      <div class="demo-test">
        <div class="titleImg">
          <img src="/images/home/homeBg.jpg" width="100%" />
          <img src="/images/home/homeIntro.png" width="75%" />
          <p><a class="immediately" href="javascript:;">立即前往</a></p>
          <p><a class="attention" href="javascript:;">一键关注</a></p>
        </div>
      </div>
    </section>

  </div>

<script type="text/javascript" src="/js/script.js"></script>
<script type="text/javascript">
function orientationChange() {
    switch(window.orientation) {
    　　case 0:
            document.getElementById('heng').style.display="none";
            break;
    　　case -90:
            document.getElementById('heng').style.display="block";
            break;
    　　case 90:
            document.getElementById('heng').style.display="block";
            break;
    　　case 180:
        　　document.getElementById('heng').style.display="none";
        　　break;
    };

};


addEventListener('load', function(){
    orientationChange();
    window.onorientationchange = orientationChange;
});


</script>
<script type="text/javascript">
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?b751a13184b796ac249b8a020fc0baf6";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>