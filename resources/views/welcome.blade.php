<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <style type="text/css"> 
        @media screen and (min-width: 320px)
        {
            body {                
                margin: 0;
                padding: 0;
                text-align: center;
               
                font-family: "ＭＳ Ｐゴシック";
            }
            body p {
                 font-size: 25px;
            }
            .or{
               
                margin-top: 150px;
            }
        }
        @media (max-width: 767px)
        { 
            body {                
                margin: 0;
                padding: 0;
                text-align: center;
                font-size: 15px;
                font-family: "ＭＳ Ｐゴシック";
            }
            .or{
                font-size: 10px;
                margin-top: 100px;
                margin-right: 10px;
            }
        } 
            .container{
                margin-top: 35px;
                margin-bottom: 35px;
            }
            .chat-box{
                font-size: 13px;
                margin-top: 35px;  
                border-style: solid;
                border-radius: 4px;
                border-width: 1px;
                border-color: orange;
            }
            .message-box{
                width: 100%;
                height: 400px;
                overflow: scroll;                              
            }
            .input-box{
                background-color: orange;
                height: 90px;
            }
            .input-box input{
                height: 100%;                
            }
            .input-msg{
                padding: 10px;
                height: 100%;                
            }
            .input-button{
                padding: 10px;
                float:right;
                height: 100%;                
            }
            a {
                text-decoration: none;
                color: darkblue;
            }
            a:hover {
                text-decoration: underline;
            }
            img {
                width: 100%;
                height: 100%;                
            }
            .header {
                background-image :url("{{ asset('images/header.png')}}");
                background-size: 100% 100%;    
                background-repeat:   no-repeat;
                color: #fff;
                height: 20px;
                padding: 5px;
                width: : 100%;
            }
            .header a{
                color: #fff;
                text-decoration: none;
            }
            #main{
                border-right: solid;
                border-bottom: solid;
                border-left : solid;
                border-width: 1px;
                border-color: orange;
                height: auto;
            }
            #footer {
                font: 12px Tahoma;
                margin: 25px 0 50px 0;
            }
            #footer a {
                margin-right: 10px;
            }
            .leftButton{
                background-image :url("{{ asset('images/left.png')}}");
                background-size: 100% 100%;    
                background-repeat:   no-repeat;
                height: 23px;
            }
            .rightButton{
                background-image :url("{{ asset('images/right.png')}}");
                background-size: 100% 100%;    
                background-repeat:   no-repeat;
                height: 23px;
            }
            .header1{
                margin-top: 35px;
                margin-bottom: 40px;
            }
            .please{
                margin-bottom: 30px;
            }
            .row-choose{
                margin-left: 1%;
            }
            .row-choose div{
              
                text-align: center;
                vertical-align: middle;
      
            }
            .row-bottom{
                margin-top: 30px;
            }
            .line{
                background-image :url("{{ asset('images/line.png')}}");
                background-size: 100% 100%;    
                background-repeat:   no-repeat;
                height: 10px;
            }
            .row-msg{
                text-align: left;
                word-wrap: break-word;
            }
            .my-msg{
                border: 1px solid #00ff80;
                border-radius: 4px;
                background-color: #00ff80;                
            }
            .other-msg{
                border: 1px solid #00bfff;
                border-radius: 4px;
                background-color: #00bfff;                
            }            
            .date-message{
                font-size: 10px;
                text-align: right;
            }
            .row-name{
                font-size: 13px;
            }
            .my-name{
                font-size:13px;
                text-align: right;
                margin-right: 12%
            }
            .send{
                height: 100% !important; 
                width: 100%;
            }
            #name{
                width: 100%;
            }
            #submit{
                width: 100%;
                height: 100%;
            }            
        </style>
    </head>
    <body>        
        <div class="container">
           
            <div class="row header">              
            </div>         
            <div class = "row" id="main">
                <div class = "col-md-8 col-xs-12" >
                    <div class="row header1">
                        <div class="col-md-3 col-md-offset-2 col-xs-3 col-xs-offset-2 leftButton"></div>
                        <div class="col-md-3 col-md-offset-2 col-xs-3 col-xs-offset-2 rightButton"></div>
                    </div>
                    <div class="row please">
                        <p>あなたはどちらがお好きですか？</p>
                        <p>お好きな方を選んでください。</p>
                    </div>
                    <div class="row row-choose">
                        <div class="col-md-4 col-md-offset-1 col-xs-5" style="padding-right: 0px;padding-left: 0px">
                            <a id="left" onclick="getRandom('<?php echo $staff[0]['id']  ?>','<?php echo 'left'?>');"><img id="imgLeft" class="img-reponsive img-thumbnail" src="{{ asset('uploads/') . '/'.  $staff[0]['image'] }}"></a>
                        </div>
                        <div class="col-md-1 col-xs-1 or">OR</div>
                        <div class="col-md-4 col-xs-5" style="padding-right: 0px;padding-left: 0px" >
                            <a id="right" onclick="getRandom('<?php echo $staff[1]['id']  ?>','<?php echo 'right'?>');"> <img id="imgRight" class="img-reponsive img-thumbnail" src="{{ asset('uploads/') . '/'.  $staff[1]['image'] }}">
                           </a>
                        </div>
                    </div>      
                    <div class="row row-bottom"><p>Which do you like?</p></div>                     
                 </div>
                <div class = "col-md-4 col-xs-12">
                    <div class = "col-md-10 col-xs-10 col-xs-offset-1">
                        <div class= "chat-box">
                            <div class= "message-box">
                            <?php $viewPrevios = null;
                                    $createAtPrevios = null;?>
                            @if(count($tests) > 0)
                                @foreach($tests as $test)                                
                                    @if($test->view!=$viewPrevios)
                                        @if($viewPrevios != null)
                                        </div>
                                        <div class="date-message">{{$createAtPrevios}}</div>
                                        </div>                                    
                                        <div class="line"></div>
                                        @endif
                                        <div class="row-msg">
                                            <div class="col-md-offset-1 name-user"><b>{{$test->name}}</b></div>
                                            <input type="hidden" class="view-hidden" value="<?php echo $test->view;?>" />
                                            <div class="msg-user other-msg col-md-offset-2">
                                                <div class="col-md-offset-2">{{$test->msg}}</div>                                                                                                   
                                    @else
                                        <div class="col-md-offset-2">{{$test->msg}}</div>                                  
                                    @endif
                                    <?php $viewPrevios=$test->view;
                                        $createAtPrevios=$test->created_at?>
                                @endforeach 
                            </div>
                            </div>
                            <div class="date-message">{{$createAtPrevios}}</div>
                            @else
                            </div>
                            @endif
                            </div> 
                            <div class="input-box">
                                <div class="col-md-9 col-xs-9 input-msg">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12"><input type="text" id="name" maxlength="15" placeholder="あなたの名前ください。"></div>
                                        <div class="col-md-12 col-xs-12"><textarea name="msg" class="form-control send"></textarea></div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-xs-3 input-button">
                                    <input type="button" name="submit" id="submit" value="送信" style="margin-left: -10px">
                                </div>
                            </div>                       
                        </div>                            
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript"> 
        /// chat
            var view = <?php echo $view?>;
            var enter = false;
            var numberClick = 0;
            $(document).on('keydown','.send',function(e){
                var msg = $(this).val();
                var element = $(this);
                var name = $('#name').val(); 
                if(!msg == '' && e.keyCode == 13 && !e.shiftKey){
                    if(name!=""){
                        $.ajax({
                        type:'POST',
                        url:'jp/test/add',
                        data:{_token:"{{csrf_token()}}",msg:msg,name:name,view:view}
                        });
                        element.val('');
                        $('#name').attr('disabled','true');
                   }else{
                        alert("あなたの名前を入力してください");
                    }
                    enter = true;
                }
            });

            $(function(){
                var msgBox = $('.message-box');
                msgBox.scrollTop(msgBox.prop("scrollHeight"));
                liveChat();
            });

            function liveChat(){                              
                var timePre = $('.date-message:last').html();
                var xhr = $.ajax({
                    url:'jp/ajax',
                    data:{_token:"{{csrf_token()}}",timePre:timePre},
                    success:function(data){                          
                        var check = setScrollBottom();
                        for(i = 0; i < data.length ; i++){ 
                            var viewPre = $('.view-hidden:last').val();

                            if(data[i]['view']!=viewPre){
                                if($('.row-msg').length){

                                    $('.message-box').append('<div class="line"></div>');                                       
                                }
                                $('.message-box').append('<div class="row-msg"></div>');

                                if(data[i]['view']!=view){
                                    $('.row-msg:last').append('<div class="col-md-offset-1 name-user"><b>'+data[i]['name']+'</b></div>');
                                    $('.row-msg:last').append('<div class="msg-user other-msg col-md-offset-2"></div>');                                        
                                }else{
                                    $('.row-msg:last').append('<div class="col-md-offset-1 my-name"><b>'+data[i]['name']+'</b></div>');
                                    $('.row-msg:last').append('<div class="msg-user my-msg col-md-offset-2"></div>');                                        
                                }

                                $('.row-msg:last').append('<input type="hidden" class="view-hidden" value="'+data[i]['view']+'" />');

                                $('.msg-user:last').append('<div class="col-md-offset-2">'+data[i]['msg']+'</div>');

                                $('.message-box').append('<div class="date-message">'+data[i]['created_at']+'</div>');                                                                        
                           }else{

                                $('.msg-user:last').append('<div class="col-md-offset-2">'+data[i]['msg']+'</div>');
                                $('.date-message:last').html(data[i]['created_at']);                               
                            } 

                            } 

                        if(check==true|| enter==true){
                            var msgBox = $('.message-box');
                            msgBox.scrollTop(msgBox.prop("scrollHeight"));
                            enter = false;
                        }                                       
                        setTimeout(liveChat,1000);                    
                    },
                    error:function(){

                        setTimeout(liveChat,5000);  
                    }
                });
            }

            // number
            
            function getRandom(id,choose){  

                $.ajax({
                    type:'GET',
                    url:'jp/get-random',
                    dataType: 'json',
                    data: 'func=getRandom&id='+id+'&choose='+choose,

                    success:function(staffs){   
                        numberClick = numberClick + 1;                    
                        $("#left").attr("onclick","getRandom('"+staffs[0]['id']+"','left')");

                        $("#imgLeft").attr("src","http://"+$(location).attr('host')+"/facemash"+"/public"+"/uploads/"+staffs[0]['image']);

                        $("#right").attr("onclick","getRandom('"+staffs[1]['id']+"','right')");

                        $("#imgRight").attr("src","http://"+$(location).attr('host')+"/facemash"+"/public"+"/uploads/"+staffs[1]['image']);                        
                    }
                });
            }

            function setScrollBottom(){
                var divMessage = $('.message-box');
                if(divMessage.scrollTop() + divMessage.innerHeight() >= divMessage[0].scrollHeight){
                    return true;
                }else{
                    return false;
                }
            }

            $(document).ready(function(){                
                var dateOld = new Date();
                var timeOld = dateOld.getTime();
                $(window).on('beforeunload', function(){

                    var dateNew = new Date();
                    var timeNew = dateNew.getTime();                    
                    var time = timeNew - timeOld;
                    time = time * 1.66666667 * Math.pow(10,-5);
                    time = time.toFixed(2);

                    $.ajax({
                    type:'GET',
                    url:'jp/get-time',
                    dataType: 'json',
                    data:'time='+time+'&numberClick='+numberClick
                    });
                });
                $('#submit').click(function(){
                    var element = $('.send');
                    var msg = element.val();                    
                    var name = $('#name').val();
                    if(!msg == ''){
                        if(name!=""){
                            $.ajax({
                            type:'POST',
                            url:'jp/test/add',
                            data:{_token:"{{csrf_token()}}",msg:msg,name:name,view:view}
                            });
                            element.val('');
                            $('#name').attr('disabled','true');
                        }else{
                            alert("あなたの名前を入力してください");
                        }
                    enter = true;
                    }
                });              
            });
                                   
        </script>        
    </body>
</html>
