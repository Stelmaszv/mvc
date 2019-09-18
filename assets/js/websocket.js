/*
$(document).ready(function(){
    var conn = new WebSocket('ws://localhost:8080');
    var chatForm=$(".chat");
    fields=chatForm.find('#sendtext');
    messagesList= $(".messList");
    chatForm.on("submit",function(e){
        e.preventDefault();
        var message=fields.val();
        messagesList.prepend('<li>'+message+'</li>');
        var myJSON = JSON.stringify({ type: "messages",mess:message});
        conn.send(myJSON)
    });
    conn.onopen = function(e) {
        console.log('SocketOn');
    };
    conn.onmessage = function(e){
        messagesList.prepend('<li>'+e.data+'</li>');
    };
})
*/
class web {
    constructor(Settings) {
        this.settings=Settings
        this.com  = new WebSocket('ws://localhost:8080');
        this.chatForm=$(Settings.classEl);
        this.outPut-= $(Settings.outPut);
        this.chatForm.on("submit",function(e){
            e.preventDefault();
        });
        this.onopen();
        this.onsubmit();
        this.onmessage();
    }

}
Settings={"classEl":".chat", "outPut":"messList"}
//ws = new web(Settings);
class chat extends web{
    onopen(){
        this.com.onopen = function(e) {

        };
    }
    onsubmit(){
        var com=new WebSocket('ws://localhost:8080');
        this.chatForm.on("submit",function(e){
            var fields=$(".chat").find('#sendtext');
            var message=fields.val();
            var myJSON = JSON.stringify({ type: "messages",mess:message});
            com.send(myJSON)
        });
    }
    onmessage(){
        this.com.onmessage = function(e){
            $(".messList").prepend('<li>'+e.data+'</li>');
        };
    }
}
new chat(Settings);



