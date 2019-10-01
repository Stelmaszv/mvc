class web {
    constructor(Settings) {
        this.com  = new WebSocket('ws://localhost:8080');
        this.onopen();
        this.onsubmit();
        this.onmessage();
    }
}
class chat extends web{
    onopen(){
        this.com.onopen = function(e) {

        };
    }
    onsubmit(){
        var com  = new WebSocket('ws://localhost:8080');
        $('.chat').on("submit",function(e){
            e.preventDefault();
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
new chat();