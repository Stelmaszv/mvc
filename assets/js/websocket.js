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