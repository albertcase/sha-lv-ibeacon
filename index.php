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
<style type="text/css">
  /*page.css*/
  /* Reset CSS
 * --------------------------------------- */
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,
form,fieldset,input,textarea,p,blockquote,th,td {
    padding: 0;
    margin: 0;
    font-family: "Microsoft YaHei";
}
a{
  text-decoration:none;
}
table {
    border-spacing: 0;
}
fieldset,img {
    border: 0;
}
address,caption,cite,code,dfn,em,strong,th,var {
    font-weight: normal;
    font-style: normal;
}
strong{
  font-weight: bold;
}
ol,ul {
    list-style: none;
    margin:0;
    padding:0;
}
caption,th {
    text-align: left;

}
h1,h2,h3,h4,h5,h6 {
    font-weight: normal;
    font-size: 100%;
    margin:0;
    padding:0;
    color:#444;
}
q:before,q:after {
    content:'';
}
abbr,acronym { border: 0;
}


/* Custom CSS
 * --------------------------------------- */
body{
  font-family: arial,helvetica;
  color: #333;
  color: rgba(0,0,0,0.5);
  background: #000;
  font-size: 65%;
}


/* 阻止旋转屏幕时自动调整字体大小 */
* { -webkit-text-size-adjust: none;}
* { font-weight: normal; font-style: normal;}
*, *:after, *:before { -webkit-box-sizing: border-box;  -moz-box-sizing: border-box; box-sizing: border-box; padding: 0; margin: 0;}


.section{
  text-align:center;
}



*{
  margin: 0;
  padding: 0;
}

body { font: 14px/1.6 "Microsoft Yahei";}


html,body{
  width: 100%;
  height: 100%;
  overflow: hidden;
  position: relative;
}


.wrap-page{
  position:absolute;
  left:0;
  right:0;
  opacity: 0;
  top: 0;
  bottom: 0;
  overflow:hidden;
}

.demo-test {
  /*display: -webkit-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;*/
}

.page-active {
  -webkit-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  z-index: 9;
}

.page {
  overflow: hidden;
  /*-webkit-overflow-scrolling: touch;
  overflow-scrolling: touch;*/

  position: absolute;
  left: 0;
  width: 100%;
  top: 0;
  bottom: 0;
  height:100%;
  background: #000;
}

.demo-test {
  width: 100%;
  height: 100%;
  text-align: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
  font-size:40px;
  color: #fff;
  position:absolute;
  left: 0; 
  top:0;
}


.page-prev {
  -webkit-transform: translate3d(0, -100%, 0);
  transform: translate3d(0, -100%, 0);
}

.page-next {
  -webkit-transform: translate3d(0, 100%, 0);
  transform: translate3d(0, 100%, 0); 
}

.page-in {
  -webkit-transition: -webkit-transform 600ms cubic-bezier(0.42, 0, 0.58, 1);
  -ms-transition: transform 600ms cubic-bezier(0.42, 0, 0.58, 1);
  transition: transform 600ms cubic-bezier(0.42, 0, 0.58, 1);
}

.page-out {
  -webkit-transition: -webkit-transform 500ms cubic-bezier(0.42, 0, 0.58, 1);
  -ms-transition: transform 500ms cubic-bezier(0.42, 0, 0.58, 1);
  transition: transform 500ms cubic-bezier(0.42, 0, 0.58, 1);
}





/* ---------- 内容样式区域star ---------- */
/* home page */
.titleImg{
  width: 100%;
  line-height: 0;
  margin: -60px 0 0 0;
  display: inline-block;
}

.titleImg img:nth-child(2){
  margin: 8px 0 6px 0;
  display: inline-block;
}


.titleImg a{
  width: 40%;
  height: 27px;
  line-height: 27px;
  text-align: center;
  border:1px #4d4d4d solid;
  color: #fff;
  margin: 6px 0 0 0;
  font-size: 12px;
  display:inline-block;
  letter-spacing: 2px;
}



/* introduction page */
.logo {
  margin: 14% 0 0 0;
}
.intro {
  width: 100%;
  line-height: 0;
  margin: 10% 0 0 0;
  display: inline-block;
}
.up {
  margin: 6% 0 0 0;
  display: inline-block;
}


/* form page */
.logo h1 {
  
  margin: 10% 0 0 0;
  font-size: .4em;
  color: #fff;
  line-height: 130%;
}
#formval {
  
  margin: 10% 0 0 0;
}
#formval ul li{
  font-size: .38em;
  width:60%;
  height: 40px;
  line-height: 40px;
  background-color: #323232; 
  margin: 5% 0 0 0;
  position: relative;
  left:20%;

  
}
#formval a{
  width: 60%;
  height: 40px;
  line-height: 40px;
  text-align: center;
  border:1px #4d4d4d solid;
  color: #fff;
  font-size: .5em;
  display:inline-block;
  margin-top: 5%;
  letter-spacing: 10px;
}
.formtext{
  margin: 20px 0 0 -10%;
  position: relative;
  z-index: 100;

}
.formtext input{
  width:54%;
  background: none;
  border: none;
  font-size: 1em;
  color: #fff;
}
.series {
  position: absolute;
  left: 0;
  bottom: 4%;
  width: 100%;
  text-align: center;
}

/* qrcode page */
.qrcodeCon{
  margin: 6% 0 0 0;
}



/* map page */
.mapcon {
  /*position: absolute;
  left: 0;
  bottom: 0%;*/
  width: 100%;
  text-align: center;
  line-height: 0;
  float: left;
  display: inline-block;
  height: 78%;
}

.mapcon img{
  height:100%;
}

.guide{
  width: 100%;
  line-height: 0;
  margin: 2% 0 0 0;
  overflow:auto;
  position: relative;
  height:20%;
  float: left;
  display: inline-block;
}

.floor li{
  float: left;
  display: inline-block;
}

.floor li span{
  background: #2e2e2e;
  border-radius: 6px;
  color: #fff;
  padding: 9px 15px 0 15px;
  float: left;
  display: inline-block;
  font-size: 12px;
  line-height: 16px;
  text-align: left;
  height:70px;
  margin: 6px;
  position: relative;
}

.floor li span.curfloor{
  width: 70px;
  height:70px;
  padding: 0;
  line-height: 70px;
  font-size: 38px;
  text-align: center;
  color: #ff0015;
  background: #fff;
}

.floor li span.curfloor.hover{
  background: #ff0015;
  color: #fff;
}

.floor li span em{
  width: 20px;
  height: 20px;
  border-radius: 20px;
  line-height: 20px;
  text-align: center;
  background: #ea0115;
  position: absolute;
  left: -6px;
  top: -6px;
}


.floor li span.floorArr{
  width: 90px;
  height:auto;
  background: none;
  border-radius: 0;
}

.floor li span.floorArr img{
  margin: 16px 0 0 0;
  display: inline-block;
}

/* ---------- 内容样式区域end ---------- */


.arr{
  width:30px;
  height:30px;
  background:url("../images/introduction/up.png") no-repeat center;
  background-size: 100% auto;
  position:fixed;
  left:50%;
  z-index: 12;
  bottom:0.6em;
  margin: 0 0 0 -15px;
}


.arr { 
  -webkit-animation: start 1.5s infinite ease-in-out;
     -moz-animation: start 1.5s infinite ease-in-out;
          animation: start 1.5s infinite ease-in-out;
}



/**
 * = animate 动画样式
 *******************************************************************************************************/
/*箭头指示引导*/
@-webkit-keyframes start {
  0%,30% {opacity: 0;-webkit-transform: translate(0,10px);}
  60% {opacity: 1;-webkit-transform: translate(0,0);}
  100% {opacity: 0;-webkit-transform: translate(0,-8px);}
}
@-moz-keyframes start {
  0%,30% {opacity: 0;-webkit-transform: translate(0,10px);}
  60% {opacity: 1;-webkit-transform: translate(0,0);}
  100% {opacity: 0;-webkit-transform: translate(0,-8px);}
}
@keyframes start {
  0%,30% {opacity: 0;-webkit-transform: translate(0,10px);}
  60% {opacity: 1;-webkit-transform: translate(0,0);}
  100% {opacity: 0;-webkit-transform: translate(0,-8px);}
}





/* 横屏css */

#heng{
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 999;
    background: #000 url("../images/heng.png") no-repeat center;
    background-size: 60% auto;
    top: 0;
    left: 0;
    display: none;
}


/* 设备竖屏时调用该段css代码 */
@media all and (orientation : portrait){
  #heng{
    display: none;
  }
}
/* 设备横屏时调用该段css代码 */
@media all and (orientation : landscape){
  #heng{
    display: inline-block;
  }
}

/* iphone 5 */
@media only screen and (max-width: 320px) and (max-height:504px) {
  .titleImg a{
    width: 40%;
    height: 24px;
    line-height: 24px;
    text-align: center;
    border:1px #4d4d4d solid;
    color: #fff;
    margin: 4px 0 0 0;
    font-size: 12px;
    display:inline-block;
    letter-spacing: 2px;
  }
  .up {
    margin: 4% 0 0 0;
    display: inline-block;
  }
  .logo h1 {
  
    margin: 6% 0 0 0;
    font-size: .36em;
    color: #fff;
    line-height: 130%;
  }
  #formval {
    margin: 6% 0 0 0;
  }

  #formval ul li{
    font-size: .34em;
    width:60%;
    height: 40px;
    line-height: 40px;
    background-color: #323232; 
    margin: 5% 0 0 0;
    position: relative;
    left:20%;
  
  }
  #formval a{
    width: 60%;
    height: 40px;
    line-height: 40px;
    text-align: center;
    border:1px #4d4d4d solid;
    color: #fff;
    font-size: .42em;
    display:inline-block;
    margin-top: 5%;
    letter-spacing: 10px;
  }

} 

/* galaxy s4 */ 
@media only screen and (max-width: 360px) and (max-height:567px) {
  .titleImg a{
    width: 40%;
    height: 24px;
    line-height: 24px;
    text-align: center;
    border:1px #4d4d4d solid;
    color: #fff;
    margin: 4px 0 0 0;
    font-size: 12px;
    display:inline-block;
    letter-spacing: 2px;
  }
  .logo h1 {
  
    margin: 6% 0 0 0;
    font-size: .36em;
    color: #fff;
    line-height: 130%;
  }
  #formval {
    margin: 6% 0 0 0;
    height: auto;
  }

  #formval ul li{
    font-size: .34em;
    width:60%;
    height: 40px;
    line-height: 40px;
    background-color: #323232; 
    margin: 5% 0 0 0;
    position: relative;
    left:20%;
  
  }
  #formval a{
    width: 60%;
    height: 40px;
    line-height: 40px;
    text-align: center;
    border:1px #4d4d4d solid;
    color: #fff;
    font-size: .42em;
    display:inline-block;
    margin-top: 5%;
    letter-spacing: 10px;
  }
}


/* Note1 */
@media only screen and (min-width: 400px) and (max-height:568px) {
  .titleImg{
    width: 100%;
    line-height: 0;
    margin: -80px 0 0 0;
    display: inline-block;
  }
  .titleImg img:nth-child(2){
    width:64%;
    margin: 8px 0 6px 0;
    display: inline-block;
  }
  .logo {
    margin: 12% 0 0 0;
  }
  .intro{
    width: 100%;
    line-height: 0;
    margin: 5% 0 0 0;
    display: inline-block;
  }
  .qrcodeCon {
    margin: 4% 0 0 0;
  }
  .map {
    position: absolute;
    left: 0;
    bottom: 0%;
    width: 98%;
    text-align: center;
   
  }
  .series {
    position: absolute;
    left: 0;
    bottom: 1%;
    width: 100%;
    text-align: center;
  }
}  

</style>
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
          <p><a href="javascript:objScript.maplink();">立即前往</a></p>
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
            </li>
            <li>
              <span class="curfloor">1F</span><span><em>3</em>左拐<br />100米</span>              
            </li>
          </ul>
        </div>  
        <div class="mapcon">
          <img src="/images/map/map1.png" />
        </div>  
      </div>
    </section>

    

  </div>

<script type="text/javascript">
  //script.js
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
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript">
  //main.js
var objScript = new Object({
       isPhoneNum : function(value){
            return /^0?(13[0-9]|15[012356789]|18[012356789]|14[57])[0-9]{8}$/.test(value);
       },
　　　　checkform : function (_name,_tel){
　　　　　　 if(_name == ""){
                alert("名字不能为空！");
                return false;
           }
           if(_tel!=="" && !this.isPhoneNum(_tel)){
                alert("手机号码填写有误！");
                return false;
           }

           // var curshow = $(".page-active").data("page");
           // pagechange.moveClick(curshow,'home');
          this.submitform(_name,_tel);
　　　　},
       maplink : function(){
          var curshow = $(".page-active").data("page");
          pagechange.moveClick(curshow,'map');
       },
       qrcodelink : function(){
          var curshow = $(".page-active").data("page");
          pagechange.moveClick(curshow,'qrcode');
       },
       submitform : function(usename,usemobile){
          $.ajax({
              type: "POST",
              url: "/Request.php?model=finish",
              data: {
                   "name": usename,"mobile":usemobile
              },
              dataType:"json",
              success: function(data){
                 if(data.code==1){
                    var curshow = $(".page-active").data("page");
                    pagechange.moveClick(curshow,'home');
                 }else if(data.code==0){
                    alert(data.msg);
                 }
              }
          })
       }
});

</script>
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
</body>
</html>