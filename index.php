<?php
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
$sql = "select id from lv_ibeacon_info where uuid=" . $db->quote($uuid);
$rs = $db->getOne($sql);
if($rs){
    $finish=1;
}else{
    $finish=0;
}

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
  <link rel="stylesheet" type="text/css" href="/css/page.css" />
  <link rel="stylesheet" type="text/css" href="/css/jquery.mCustomScrollbar.css" />
	<script src="/js/zepto.js"></script>
  <script src="/js/touch.js"></script>
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
              <p><a href="javascript:objScript.checkform($('#name').val(),$('#mobile').val());">提交</a><p>
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
          <p><a href="javascript:objScript.maplink();">立即前往</a><p>
          <p><a href="javascript:objScript.qrcodelink();">一键关注</a></p>
        </div>
      </div>
    </section>

    
    <section class="page qrcode page-next" data-page="qrcode">
      <div class="demo-test">
        
        <div class="logo">
          <img src="/images/logo.png" width="34%" />
        </div>
        <div class="qrcodeCon">
          <img src="/images/qrcode/qrcode.jpg" width="50%" />
          <img src="/images/qrcode/click.png" width="50%" >
        </div>  

        <div class="series">
          <img src="/images/series.png"  width="30%"/>
        </div> 
      </div>
    </section>

  
    <section class="page map page-next" data-page="map">
      <div class="demo-test">
       
        <div class="guide" id="content">
          <ul class="floor">
            <li>
                <span class="curfloor hover">B1</span><span><em>1</em>向前<br />100米<br />左拐</span><span><em>2</em>前往<br />
                三号电梯<br />
                上行</span><span class="floorArr"><img src="/images/map/stepArr.png" width="100%" /></span>
                <span class="curfloor">1F</span><span><em>3</em>左拐<br />100米</span>
            </li>
          <ul>
        </div>  
        <div class="mapcon">
          <img src="/images/map/map1.png" />
        </div>  
      </div>
    </section>

    

  </div>

<script>
  var curFinish = $('body').data("finish");
var curId = $('body').data("id");



$("#main").animate({"opacity":1},600);

document.addEventListener('touchmove' , function (ev){
  ev.preventDefault();
  return false;
} , false)

  if(curFinish==1){
    var pageArr = ["introduction","home"];
  }else{
    var pageArr = ["introduction","form"];
  }
  var pageArr2 = ["introduction","form","home","map","qrcode"];
  var $page = $('.page'),
      $menu = $('.menu li');
  
  function pageSlideOver(){
    $('.page-out').live('transitionend', function(){
        $(this).removeClass('page-out');
    });
    $('.page-in').live('transitionend', function(){
        $(this).removeClass('page-in');
    });
  }
  

var curmoveval = false;
function pageChange(){
    this.movePrev = function(a){
        var curArrIndex = pageArr.indexOf(a.data("page"));
        curArrIndex++;
        if(curArrIndex>=pageArr.length||curmoveval)return false;

        if(curArrIndex>=pageArr.length-1){
            $(".arr").hide();
        }else{
            $(".arr").show();
        }

        a.removeClass('page-active').addClass('page-prev page-out');
        $('.'+pageArr[curArrIndex]).removeClass('page-next').addClass('page-active page-in');

        pageSlideOver();
    },
    this.moveNext = function(a){
        var curArrIndex = pageArr.indexOf(a.data("page"));
        curArrIndex--;
        if(curArrIndex<0||curmoveval)return false;
        $(".arr").show();

        a.removeClass('page-active').addClass('page-next page-out');
        $('.'+pageArr[curArrIndex]).removeClass('page-prev').addClass('page-active page-in');

        pageSlideOver();
    },
    this.moveClick = function(curshow,curclick){
        curmoveval=true;
        var curShowIndex = pageArr2.indexOf(curshow);
        var curClickIndex = pageArr2.indexOf(curclick);
        if(curShowIndex === curClickIndex)return false;

        if(curShowIndex > curClickIndex){
          $("."+curshow).removeClass('page-active').addClass('page-next page-out');
          $('.'+curclick).removeClass('page-prev').addClass('page-active page-in');
        }else{
          $("."+curshow).removeClass('page-active').addClass('page-prev page-out');
          $('.'+curclick).removeClass('page-next').addClass('page-active page-in');
        }

        pageSlideOver();
    }

}

var pagechange = new pageChange();


$page.swipeUp(function(ev){
    pagechange.movePrev($(this));
    ev.preventDefault();
})

$page.swipeDown(function(ev){
    pagechange.moveNext($(this));
    ev.preventDefault();
})

$menu.tap(function(event){
    var curshow = $(".page-active").data("page");
    var curclick = $(this).data("page");
    pagechange.moveClick(curshow,curclick);
    return false;
});
</script>
<!-- <script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
<script type="text/javascript">
  (function($){
    $(window).load(function(){  
      $("#content").mCustomScrollbar({
          axis:"x",
          advanced:{autoExpandHorizontalScroll:true},
      }); 
    });
  })(jQuery);
</script>
-->
</body>
</html>