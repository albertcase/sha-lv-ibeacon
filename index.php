
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
<body>
<div id="heng"></div>
<!-- <span class="arr"></span> -->


<div id="main" class="wrap-page">

    <section class="page introduction page-active" data-page="introduction">
      <div class="demo-test"> 
        <div class="logo">
          <img src="/images/logo.png" width="25%" />
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
          <img src="/images/logo.png" width="25%" />
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
          <img src="/images/qrcode/qrcode.png" width="50%" />
        </div>  

        <div class="series">
          <img src="/images/series.png"  width="30%"/>
        </div> 
      </div>
    </section>

  
    <section class="page map page-next" data-page="map">
      <div class="demo-test">
       
        <div class="guide" id="content">
          <p>
          <img src="/images/map/mapTips1.png" />
          </p>
        </div>  
        <div class="map">
          <img src="/images/map/map1.png" width="80%"/>
        </div>  
      </div>
    </section>

    

  </div>


<script type="text/javascript" src="/js/script.js"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
  <script src="/js/jquery.mCustomScrollbar.concat.min.js"></script>
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