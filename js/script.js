$("#main").animate({"opacity":1},600);

document.addEventListener('touchmove' , function (ev){
	ev.preventDefault();
	return false;
} , false)



$(function(){
  var pageArr = ["home","introduction","form","qrcode","map"];
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
  


function pageChange(){
    this.movePrev = function(a){
        var curArrIndex = pageArr.indexOf(a.data("page"));
        curArrIndex++;
        if(curArrIndex>=pageArr.length)return false;

        if(curArrIndex>=pageArr.length-1){
            $(".arr").hide();
        }else{
            $(".arr").show();
        }

        a.removeClass('page-active').addClass('page-prev page-out');
        $('.'+pageArr[curArrIndex]).removeClass('page-next').addClass('page-active page-in');

        pageSlideOver();
        //history.pushState({"page": pageArr[curArrIndex]}, "" , "?page="+pageArr[curArrIndex]);
    },
    this.moveNext = function(a){
        var curArrIndex = pageArr.indexOf(a.data("page"));
        curArrIndex--;
        if(curArrIndex<0)return false;
        $(".arr").show();

        a.removeClass('page-active').addClass('page-next page-out');
        $('.'+pageArr[curArrIndex]).removeClass('page-prev').addClass('page-active page-in');

        pageSlideOver();
        //history.pushState({"page": pageArr[curArrIndex]}, "" , "?page="+pageArr[curArrIndex]);
    },
    this.moveClick = function(curshow,curclick){
        var curShowIndex = pageArr.indexOf(curshow);
        var curClickIndex = pageArr.indexOf(curclick);
        if(curShowIndex === curClickIndex)return false;

        if(curShowIndex > curClickIndex){
          $("."+curshow).removeClass('page-active').addClass('page-next page-out');
          $('.'+curclick).removeClass('page-prev').addClass('page-active page-in');
        }else{
          $("."+curshow).removeClass('page-active').addClass('page-prev page-out');
          $('.'+curclick).removeClass('page-next').addClass('page-active page-in');
        }

        pageSlideOver();
        //history.pushState({"page": curclick}, "" , "?page="+curclick);
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

  
});


















