var _____WB$wombat$assign$function_____ = function(name) {return (self._wb_wombat && self._wb_wombat.local_init && self._wb_wombat.local_init(name)) || self[name]; };
if (!self.__WB_pmw) { self.__WB_pmw = function(obj) { this.__WB_source = obj; return this; } }
{
  let window = _____WB$wombat$assign$function_____("window");
  let self = _____WB$wombat$assign$function_____("self");
  let document = _____WB$wombat$assign$function_____("document");
  let location = _____WB$wombat$assign$function_____("location");
  let top = _____WB$wombat$assign$function_____("top");
  let parent = _____WB$wombat$assign$function_____("parent");
  let frames = _____WB$wombat$assign$function_____("frames");
  let opener = _____WB$wombat$assign$function_____("opener");

/**
 * Created by thephpjo on 21.04.14.
 */


function NIM_demo(){
    this.canvas =   document.getElementById("paintonme");
    this.context =  this.canvas.getContext("2d");

    this.movearea = document.getElementById("moveonme");

    this.canvasTimeScale = 5 * 1000;

    this.paintColors = ["#bbd","#464","#d88"];
    this.totalLanes =  this.paintColors.length;

    this.leftMargin = 100;

    var self = this;

    this.init = function(){
        this.canvas.width = window.innerWidth - 250;
        this.flush();
        this.movearea.addEventListener("mousemove",this.regularHandler);
        this.movearea.addEventListener("mousemove",helpers.debounce(self.debounceHandler,100,this));
        this.movearea.addEventListener("mousemove",helpers.throttle(self.throttleHander,100,this));
    }

    /**
     * painting the rectangle / line
     * @param lane
     * @param time
     */
    this.paintRect = function(lane,time){
        if(time > this.canvasTimeScale){
            this.startTime += time;
            time = 0;
            this.flush()
        }
//            console.log(lane,time);
        this.context.fillStyle = this.paintColors[lane];

        var x =         (this.canvas.width - this.leftMargin)  / this.canvasTimeScale * time + this.leftMargin;
        var y =         this.canvas.height / this.totalLanes      * lane;
        var height =    this.canvas.height / this.totalLanes;
        var width =     1;

        this.context.fillRect(x,y,width,height);
    }

    this.flush = function(){
        this.context.fillStyle = "#ffffff";
        this.context.fillRect(0,0,this.canvas.width,this.canvas.height);

        this.context.font = "200 18px Roboto,Helvetica,Arial";
        this.context.fillStyle = this.paintColors[0];
        this.context.fillText("Regular", 0, 100);

        this.context.fillStyle = this.paintColors[1];
        this.context.fillText("debounce", 0, 300);

        this.context.fillStyle = this.paintColors[2];
        this.context.fillText("throttle", 0, 500);
    }
    /**
     * get the time difference
     * @returns {number}
     */
    this.getTimeDiff = function(){
        var time = new Date().getTime();
        if(!this.startTime){
            this.startTime = time;
        }
        time -= this.startTime;
        return time;
    }

    this.regularHandler = function(){
        self.paintRect(0,self.getTimeDiff());
    }
    this.debounceHandler = function(){
        self.paintRect(1,self.getTimeDiff());
    }
    this.throttleHander = function(){
        self.paintRect(2,self.getTimeDiff());
    }
}




}
/*
     FILE ARCHIVED ON 09:23:26 Jan 17, 2022 AND RETRIEVED FROM THE
     INTERNET ARCHIVE ON 04:03:21 Jun 06, 2023.
     JAVASCRIPT APPENDED BY WAYBACK MACHINE, COPYRIGHT INTERNET ARCHIVE.

     ALL OTHER CONTENT MAY ALSO BE PROTECTED BY COPYRIGHT (17 U.S.C.
     SECTION 108(a)(3)).
*/
/*
playback timings (ms):
  captures_list: 132.146
  exclusion.robots: 0.111
  exclusion.robots.policy: 0.097
  cdx.remote: 0.108
  esindex: 0.014
  LoadShardBlock: 103.297 (3)
  PetaboxLoader3.datanode: 50.347 (4)
  load_resource: 81.548
  PetaboxLoader3.resolve: 43.7
*/