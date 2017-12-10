/**
 * Created by oiooooio on 2016/9/15.
 */

(function (){
    "use strict";

    var $log = document.querySelector("#log");
    var theater = new TheaterJS();

    theater
        .describe("wangli", .6, "#wangli");

    theater
        .on("*", function (eventName, originalEvent, sceneName, arg) {
            var args  = Array.prototype.splice.apply(arguments, [3]),
                log = '{\n      name: "' + sceneName + '"';

            if (args.length > 0) log += ",\n      args: " + JSON.stringify(args).split(",").join(", ");
            log += "\n    }";

            $log.innerHTML = log;
        })
        .on("say:start, erase:start", function (eventName) {
            var self  = this,
                current = self.current.voice;

            self.utils.addClass(current, "saying");
        })
        .on("say:end, erase:end", function (eventName) {
            var self  = this,
                current = self.current.voice;

            self.utils.removeClass(current, "saying");
        });

    theater
    // .write("wangli:wangli.", 100)
    // .write("wangli:What?")
    // .write({ name: "call", args: [kill, true] })
    // .write("wangli:Nooo...", -3, "!!! ", 100, "No! ", 100)
    // .write("wangli:That's not true!", 100)
    // .write("wangli:That's impossible!")
    // .write("wangli:Search your feelings.", 300)
    // .write("wangli:You know it to be true.", 500)
       .write(
            "wangli: 你觉得孤独就对了,那是让你认识自己的机会,<br>", 500,
            "你觉得不被理解就对了,那是让你认清朋友的机会,<br>", 500,
            "你觉得黑暗就对了,那是让你发现光芒的机会,<br>", 500,
            "你觉得无助就对了,那样你才能知道谁是你的贵人,<br>", 500,
            "你觉得迷茫就对了,谁的青春不迷茫。<br>", 500,
            "摘自《谁的青春不迷茫》<br>", 500
        )
        .write({ name: "call", args: [kill, true] })

        // .write("wangli:wangli.", 800)
        // .write("wangli:You can destroy the Emperor.", 300)
        // .write("wangli:He has foreseen this. ", 100)
        // .write("wangli:It is your destiny.", 1600)
        // .write("wangli:Join me.", 200)
        // .write("wangli:Together we can rule the galaxy.", 800)
        // .write("wangli:As father and son.", 600)
        // .write("wangli:Come with me. ", 800)
        // .write("wangli:It is the only way.", 200)
        // .write(function () { theater.play(true); })
    ;

    var span_class = document.getElementById("wangli");
    var span_classes = ["color1", "color2", "color3"];

    function randClass() {
        var index = Math.random();
        if (index < 0.333 && index >= 0){return span_classes[0];}
        else if(index >= 0.333 && index <= 0.667){return span_classes[1];}
        else {return span_classes[2];}
    }
    
    function toggleClass () {
        var className = randClass();
        if (theater.utils.hasClass(span_class, className)) theater.utils.removeClass(span_class, className);
        else theater.utils.addClass(span_class, className);
    }

    function kill () {
        var self  = this,
            delay = 300,
            i = 0,
            timeout = setTimeout(function blink () {
                toggleClass();
                if (++i < 1000) timeout = setTimeout(blink, delay);
                else self.next();
            }, delay);

        return self;
    }
})();

