<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1,user-scalable=yes">

    <title>swipe</title>

    <style>

        body {
            font-size: 20px;
        }

        /* slide-group */

        .slide-group {
            position: relative;
            max-width: 400px;
            margin: 0 auto;
            overflow: hidden;
        }

        .slide-group ul {
            margin: 0;
            padding: 0;
        }
        .slide-group li {
            list-style: none;
        }

        /* slides */

        .slides {}
        .slides .item {
            position: absolute; top: 0; left: 0; z-index: 1;
            width: 100%;
            background-color: black;
            /* opacity: 0; */
            /* transition: opacity 1s; */
            transition: left 1s;
        }
        .slides .item img {
            display: block;
            width: 100%;
        }
        .slides .item .text {
            display: block;
            padding: .5em 1em;
            color: white;
        }
        .slides .active {
            position: relative; z-index: 3;
            /* opacity: 1; */
        }
        .slides .previous {
            left: -100%;
            z-index: 2;
            /* transition-delay: 1s; */
        }
        .slides .pending {
            left: 100%;
            /* z-index: 4; */
        }
        .slides .previous.pending {
            /* z-index: 1; */
        }
        .slides .active.pending {
            /* z-index: 3; */
            left: 100%;
            transition: none;
        }

        /* menu */

        .menu {
            position: relative; z-index: 4;
            margin-top: 1em !important;
        }
        .menu .item {
            display: inline-block;
            padding: .2em .3em .1em;
            background-color: #ccc;
            cursor: pointer;
            transition: background-color .5s;
        }
        .menu .item a {
            text-decoration: none;
        }
        .menu.-selector {
            float: left;
        }
        .menu.-order {
            float: right;
        }
        .menu.-selector .active {
            background-color: red;
        }

    </style>

    <script src="prefixfree.min.js"></script>

</head>
<body>

<!--div class="slide-group"
    ontouchstart="touchStart(event,'slider');"
    ontouchend="touchEnd(event);"
    ontouchmove="touchMove(event);"
    ontouchcancel="touchCancel(event);"-->
<div class="slide-group">
    <ul class="slides">
        <li class="item item-1 swipe active">   <img src="//lorempixel.com/300/250/cats/1"> <span class="text">Item 1</span></li>
        <li class="item item-2 swipe pending">  <img src="//lorempixel.com/300/250/cats/2"> <span class="text">Item 2</span></li>
        <li class="item item-3 swipe">          <img src="//lorempixel.com/300/250/cats/3"> <span class="text">Item 3</span></li>
        <li class="item item-4 swipe">          <img src="//lorempixel.com/300/250/cats/4"> <span class="text">Item 4</span></li>
        <li class="item item-5 swipe previous"> <img src="//lorempixel.com/300/250/cats/5"> <span class="text">Item 5</span></li>
    </ul>
    <ul class="menu -selector">
        <li class="item item-1 click active">   <a href="item-1">1/5</a></li>
        <li class="item item-2 click pending">  <a href="item-2">2/5</a></li>
        <li class="item item-3 click">          <a href="item-3">3/5</a></li>
        <li class="item item-4 click">          <a href="item-4">4/5</a></li>
        <li class="item item-5 click previous"> <a href="item-5">5/5</a></li>
    </ul>
    <ul class="menu -order">
        <li class="item item-prev click"><a href="item-5">Prev</a></li>
        <li class="item item-next click"><a href="item-2">Next</a></li>
    </ul>
</div>

<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>

jQuery(document).ready(function($){

    (function(){

        $('.slide-group').each(function(index,element){
            var $element = $(element);

            // function slideTransition($slides,href){
            //     $slides.find('.pending').removeClass('pending'); // remove pending
            //     $slides.find('.previous').removeClass('previous'); // remove previous
            //     $slides.find('.active').addClass('previous').removeClass('active'); // set previous, remove active
            //     $slides.find('.' + href).addClass('active'); // set active

            //     // prev / next
            //     // based on nav selector for ease of getting href
            //     var $active = $slides.find('.-selector .active');
            //     var count   = $active.siblings().length;
            //     var prev    = $active.prev().find('a').attr('href');
            //     var next    = $active.next().find('a').attr('href');

            //     $slides.find('.'+(next ? next : 'item-1')).addClass('pending'); // add pending

            //     $slides.find('.item-prev').find('a').attr('href',(prev ? prev : 'item-' + (count + 1))); // set prev
            //     $slides.find('.item-next').find('a').attr('href',(next ? next : 'item-1')); // set next
            // }

            $element
                // .on('touchmove','.swipe',function(event){ event.preventDefault();
                //     var touch = event.originalEvent.touches[0] || event.originalEvent.changedTouches[0];
                //     var elm = $(this).offset();
                //     var x = touch.pageX - elm.left;
                //     var y = touch.pageY - elm.top;
                //     var lastX = 0;

                //     if (x < $(this).width() && x > 0){ // within element bounds
                //         if (y < $(this).height() && y > 0){ // within element bounds

                //             // $('.slides .active .text').text(touch.pageX+' '+touch.pageY);

                //             var currentX = event.originalEvent.touches[0].clientX;
                //                 $('.slides .active .text').text(currentX+' '+lastX);
                //             if (currentX > lastX){
                //                 // moved right
                //                 // $('.slides .active .text').text(touch.pageX+' '+touch.pageY);
                //                 $('.slides .active .text').text('moved right'+currentX+' '+lastX);
                //             }
                //             else if (currentX < lastX){
                //                 // moved left
                //                 // $('.slides .active .text').text(touch.pageX+' '+touch.pageY);
                //                 $('.slides .active .text').text('moved left');
                //             }
                //             lastX = currentX;

                //         } // y
                //     } // x
                // })
               // .on('touchstart','.swipe',function(e){
               //      ts = e.originalEvent.touches[0].clientY;
               //  })
               // .on('touchend','.swipe',function(e){
               //      var te = e.originalEvent.changedTouches[0].clientY;
               //      if(ts > te+5){
               //        slide_down();
               //      }else if(ts < te-5){
               //        slide_up();
               //      }
               //  });
                .on('mousedown touchstart','.swipe',function(event){
                //     console.log("(x,y) = (" + event.pageX + "," + event.pageY +")");

                    console.log(event.originalEvent.pageX);

                    xDown = event.originalEvent.pageX;
                    yDown = event.originalEvent.pageY;
                })
                .on('mouseup touchend','.swipe',function (event) {
                //     console.log("(x,y) = (" + event.pageX + "," + event.pageY +")");

                    xUp = event.originalEvent.pageX;
                    yUp = event.originalEvent.pageY;

                    // if (xDown != xUp || yDown != yUp) {
                    //     alert('Swiped');
                    // }
                    if (xDown > xUp){ // left
                        // slideTransition($element,$(this).find('.item-prev a').attr('href'));
                        $element.find('.item-prev').trigger('click');
                    }
                    else if (xDown < xUp){ // right
                        // slideTransition($element,$(this).find('.item-next a').attr('href'));
                        $element.find('.item-next').trigger('click');
                    }
                    // $('.slides .active .text').text('(' + xDown + ',' + yDown + ') (' + xUp + ',' + yUp +')');
                });

            $element.on('click','.click',function(event){ event.preventDefault();
                // slideTransition($element,$(this).find('a').attr('href'));

                var href = $(this).find('a').attr('href');

                $slides = $element;

                $slides.find('.pending').removeClass('pending'); // remove pending
                $slides.find('.previous').removeClass('previous'); // remove previous
                $slides.find('.active').addClass('previous').removeClass('active'); // set previous, remove active
                $slides.find('.' + href).addClass('active'); // set active

                // prev / next
                // based on nav selector for ease of getting href
                var $active = $slides.find('.-selector .active');
                var count   = $active.siblings().length;
                var prev    = $active.prev().find('a').attr('href');
                var next    = $active.next().find('a').attr('href');

                $slides.find('.'+(next ? next : 'item-1')).addClass('pending'); // add pending

                $slides.find('.item-prev').find('a').attr('href',(prev ? prev : 'item-' + (count + 1))); // set prev
                $slides.find('.item-next').find('a').attr('href',(next ? next : 'item-1')); // set next

             });
        });
    })();

}); // .ready

</script>

<!--script>
var startY = 0;
var curX = 0;
var curY = 0;
var deltaX = 0;
var deltaY = 0;
var horzDiff = 0;
var vertDiff = 0;
var minLength = 72; // the shortest distance the user may swipe
var swipeLength = 0;
var swipeAngle = null;
var swipeDirection = null;

// The 4 Touch Event Handlers

// NOTE: the touchStart handler should also receive the ID of the triggering element
// make sure its ID is passed in the event call placed in the element declaration, like:
// <div id="picture-frame" ontouchstart="touchStart(event,'picture-frame');"  ontouchend="touchEnd(event);" ontouchmove="touchMove(event);" ontouchcancel="touchCancel(event);">

function touchStart(event,passedName) {
    // disable the standard ability to select the touched object
    event.preventDefault();
    // get the total number of fingers touching the screen
    fingerCount = event.touches.length;
    // since we're looking for a swipe (single finger) and not a gesture (multiple fingers),
    // check that only one finger was used
    if ( fingerCount == 1 ) {
        // get the coordinates of the touch
        startX = event.touches[0].pageX;
        startY = event.touches[0].pageY;
        // store the triggering element ID
        triggerElementID = passedName;
    } else {
        // more than one finger touched so cancel
        touchCancel(event);
    }
}

function touchMove(event) {
    event.preventDefault();
    if ( event.touches.length == 1 ) {
        curX = event.touches[0].pageX;
        curY = event.touches[0].pageY;
    } else {
        touchCancel(event);
    }
}

function touchEnd(event) {
    event.preventDefault();
    // check to see if more than one finger was used and that there is an ending coordinate
    if ( fingerCount == 1 && curX != 0 ) {
        // use the Distance Formula to determine the length of the swipe
        swipeLength = Math.round(Math.sqrt(Math.pow(curX - startX,2) + Math.pow(curY - startY,2)));
        // if the user swiped more than the minimum length, perform the appropriate action
        if ( swipeLength >= minLength ) {
            caluculateAngle();
            determineSwipeDirection();
            processingRoutine();
            touchCancel(event); // reset the variables
        } else {
            touchCancel(event);
        }
    } else {
        touchCancel(event);
    }
}

function touchCancel(event) {
    // reset the variables back to default values
    fingerCount = 0;
    startX = 0;
    startY = 0;
    curX = 0;
    curY = 0;
    deltaX = 0;
    deltaY = 0;
    horzDiff = 0;
    vertDiff = 0;
    swipeLength = 0;
    swipeAngle = null;
    swipeDirection = null;
    triggerElementID = null;
}

function caluculateAngle() {
    var X = startX-curX;
    var Y = curY-startY;
    var Z = Math.round(Math.sqrt(Math.pow(X,2)+Math.pow(Y,2))); //the distance - rounded - in pixels
    var r = Math.atan2(Y,X); //angle in radians (Cartesian system)
    swipeAngle = Math.round(r*180/Math.PI); //angle in degrees
    if ( swipeAngle < 0 ) { swipeAngle =  360 - Math.abs(swipeAngle); }
}

function determineSwipeDirection() {

    if ( (swipeAngle <= 45) && (swipeAngle >= 0) ) {
        swipeDirection = 'left';
    } else if ( (swipeAngle <= 360) && (swipeAngle >= 315) ) {
        swipeDirection = 'left';
    } else if ( (swipeAngle >= 135) && (swipeAngle <= 225) ) {
        swipeDirection = 'right';
    } else if ( (swipeAngle > 45) && (swipeAngle < 135) ) {
        swipeDirection = 'down';
    } else {
        swipeDirection = 'up';
    }
}

function processingRoutine() {
    var swipedElement = document.getElementById(triggerElementID);
    if ( swipeDirection == 'left' ) {
        sliders.goToNext();
    } else if ( swipeDirection == 'right' ) {
        sliders.goToPrev();
    } else if ( swipeDirection == 'up' ) {
        sliders.goToPrev();
    } else if ( swipeDirection == 'down' ) {
        sliders.goToNext();
    }
}
</script-->
</body>
</html>
