/**
 * Created by oiooooio on 2016/10/2.
 */



/** 格式化输入字符串**/
//用法: "hello{0}".format('world')；返回'hello world'
String.prototype.format= function(){
    var args = arguments;
    return this.replace(/\{(\d+)\}/g,function(s,i){
        return args[i];
    });
};

Function.prototype.get_multi_lines = function () {
    var lines = String(this);
    lines = lines.substring(lines.indexOf("/*")+3, lines.lastIndexOf("*/"));
    return lines;
};
