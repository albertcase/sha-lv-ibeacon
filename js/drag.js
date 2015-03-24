 var reqAnimationFrame = (function () {
        return window[Hammer.prefixed(window, 'requestAnimationFrame')] || function (callback) {
            window.setTimeout(callback, 1000 / 60);
        };
    })();

    var log = document.querySelector("#log");
    var el = document.querySelector("#hit");

    var START_X = Math.round((window.innerWidth - el.offsetWidth) / 2);
    var START_Y = Math.round((window.innerHeight - el.offsetHeight) / 2);

    var ticking = false;
    var transform;
    var timer;

    var mc = new Hammer.Manager(el);

    mc.add(new Hammer.Pan({ threshold: 0, pointers: 0 }));

    mc.add(new Hammer.Swipe()).recognizeWith(mc.get('pan'));
    //mc.add(new Hammer.Rotate({ threshold: 0 })).recognizeWith(mc.get('pan'));
    mc.add(new Hammer.Pinch({ threshold: 0 })).recognizeWith([mc.get('pan')]);

    mc.add(new Hammer.Tap({ event: 'doubletap', taps: 2 }));
    mc.add(new Hammer.Tap());

    mc.on("panstart panmove", onPan);
    mc.on("pinchstart pinchmove", onPinch);


    function resetElement() {
        el.className = 'animate';
        transform = {
            translate: { x: START_X, y: START_Y },
            scale: 1,
            angle: 0,
            rx: 0,
            ry: 0,
            rz: 0
        };

        requestElementUpdate();

    }

    function updateElementTransform() {
        var value = [
                    //'translate3d(' + transform.translate.x + 'px, ' + transform.translate.y + 'px, 0)',
                    'scale(' + transform.scale + ', ' + transform.scale + ')'
        ];

        value = value.join(" ");
        //el.textContent = value;
        el.style.webkitTransform = value;
        el.style.mozTransform = value;
        el.style.transform = value;
        ticking = false;
    }

    function requestElementUpdate() {
        if(!ticking) {
            reqAnimationFrame(updateElementTransform);
            ticking = true;
        }
    }

    function logEvent(str) {
        //log.insertBefore(document.createTextNode(str +"\n"), log.firstChild);
    }

    function onPan(ev) {
        el.className = '';
        transform.translate = {
            x: ev.center.x/2 + ev.deltaX,
            y: ev.center.y/2 + ev.deltaY
        };

        requestElementUpdate();
        logEvent(ev.type);
    }

    var initScale = 1;
    function onPinch(ev) {
        if(ev.type == 'pinchstart') {
            initScale = transform.scale || 1;
        }

        el.className = '';
        transform.scale = initScale * ev.scale;

        // requestElementUpdate();
        // logEvent(ev.type);
    }

    resetElement();



    var isdrag=false;   
        var tx,x,ty,y;    
        $(function(){  
            document.getElementById("hit").addEventListener('touchend',function(){  
                sdrag = false;  
                if(parseInt($("#hit").offset().top) > parseInt($(".mapcon").css("height")) || parseInt($("#hit").offset().top) < -parseInt($("#hit").css("height"))+110 || parseInt($("#hit").offset().left) < -parseInt($("#hit").css("width"))+60){
                    $("#hit").css("left","0");  
                    $("#hit").css("top","0");
                }
            });  
            document.getElementById("hit").addEventListener('touchstart',selectmouse);  
            document.getElementById("hit").addEventListener('touchmove',movemouse);  
        });  
        function movemouse(e){   

           if (isdrag){   
               var lval = tx + e.touches[0].pageX - x;  
               var tval = ty + e.touches[0].pageY - y; 
               if(parseInt($("#hit").offset().top) > parseInt($(".mapcon").css("height")) || parseInt($("#hit").offset().top) < -parseInt($("#hit").css("height"))+110 || parseInt($("#hit").offset().left) < -parseInt($("#hit").css("width"))+60){
                    $("#hit").css("left","0");  
                    $("#hit").css("top","0");
               }else{
                    $("#hit").css("left",lval);  
                    $("#hit").css("top",tval);
               }
               
   
               return false;   
           }  
           
        }   
         
        function selectmouse(e){   
           isdrag = true;   
           tx = parseInt(document.getElementById("hit").style.left+0);   
           x = e.touches[0].pageX; 
           ty = parseInt(document.getElementById("hit").style.top+0);   
           y = e.touches[0].pageY;   
           
           return false;   
        } 