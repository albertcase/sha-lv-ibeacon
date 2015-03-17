
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

           submitform(_name,_tel);
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
                 }else(data.code==0){
                    alert(data.msg);
                 }
              }
          })
       }
});
