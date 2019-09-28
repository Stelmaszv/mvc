/*
var Ajaxdata='';
$(document).ready(function(){
    $.get("index.php?view=ajaxUsers&&title=users", function(data, status){
        if(status==='success') {
            Ajaxdata = data;
        }else{
            console.log('dqd');
        }
        //alert("Data: " + data + "\nStatus: " + status);
    });
});
console.log(Ajaxdata)
*/

class ajaxScrollLoad{
    constructor($url){
        this.page=0;
        this.url=$url;
        this.defultUrl=$url;
        this.nextpage();

    }
    loadUrl(){
        $.get(this.url, function(data, status){
            data=JSON.parse(data)
            if(data.info.CorrentPage<=data.info.lastPage){
                $.get(this.url, function (data, status) {
                    data = JSON.parse(data)
                    for (var i = 0; i < data.result.length; i++) {
                        $(".usersList").prepend('<li>' + data.result[i].login + '</li>');
                    }
                });
            }
        });
    }
    nextpage(){
        var url=this.addpage();
        this.loadUrl();
    }
    addpage(){
        this.page=this.page+1;
        this.url=this.defultUrl;
        this.url=this.url+''+'&&page='+this.page

    }
}
class users extends ajaxScrollLoad{}
$users=new users('http://localhost/mvc/index.php?api=ajaxusers');
$(window).scroll(function() {
    var limit = document.body.offsetHeight - window.innerHeight;
    var $height = $(window).scrollTop();
    if($height>limit-10){
        $users.nextpage();
        $(window).scrollTop($height-limit/3);
    }
});
