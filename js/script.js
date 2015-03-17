$("#main").animate({"opacity":1},600);

document.addEventListener('touchmove' , function (ev){
	ev.preventDefault();
	return false;
} , false)









  
  var pageArr = ["introduction","form"];
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
})


// touch.on($page, 'touchstart', function(ev){
//   ev.preventDefault();
// });

  








































