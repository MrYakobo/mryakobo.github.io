/*Share-metoden i index.html (FXtend Voice)*/
function share(){
        var url = "http://fxtend.gq/Voice/message.php?";
        var d = document.getElementById("textInput").value;
        
        $.post("save-json.php",{content:d},function(data){
            document.getElementById("url").innerHTML = url+data;
            SelectText("url");
        });
}
-----
/*Useful shorthand for for-loops, Copyright Josef Karlsson @ fxtend.gq*/
/*Usage: while(f(max-value)){
Your code here
}*/
function f(n){return n>i?(i++,!0):(i=0,!1)}var i=-1;