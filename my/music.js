/**
 * Created by oiooooio on 2016/9/11.
 */

var cur_music_name = "";

function clear_local_music() {
    localStorage.clear();
}

function store_music_name(music_name) {
    localStorage.setItem((localStorage.length+1).toString(), music_name)
}

function get_next_music_name(cur_music_name) {
    if(localStorage.length == 0){
        return "";
    }

    if(cur_music_name == null){
        return localStorage[localStorage.key(0)];
    }

    var pos;
    for(pos = 0; pos < localStorage.length; ++pos){
        var key = localStorage.key(pos);
        if(cur_music_name.indexOf(localStorage[key]) != -1){
            break;
        }
    }

    if (pos+1 >= localStorage.length){return localStorage[localStorage.key(0)];}
    return localStorage[localStorage.key(pos+1)];
}

function set_current_music_name(text_name) {
    var control_text = document.getElementById(text_name);
    control_text.innerHTML = cur_music_name;
}

function next_music(path, control_name) {
    var c_audio = document.getElementById(control_name);
    cur_music_name = get_next_music_name(decodeURI(c_audio.src));
    c_audio.setAttribute("src", path+cur_music_name);
    c_audio.play();
}

function next_music_and_set_text(path, audio_name, switch_bt_name, text_name){
    next_music(path, audio_name);
    set_current_music_name(text_name);
    var style = document.getElementsByClassName("bt_play");
    style[switch_bt_name].style.animationPlayState = "running";
}

function switch_music(audio_name, switch_bt_name) {
    var c_audio = document.getElementById(audio_name);
    var style = document.getElementsByClassName("bt_play");
    if(!c_audio.paused){
        c_audio.pause();
        style[switch_bt_name].style.animationPlayState = "paused";
    }
    else {
        c_audio.play();
        style[switch_bt_name].style.animationPlayState = "running";
    }
}
