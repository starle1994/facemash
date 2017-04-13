<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

         <title>XOXO</title>
        
        <link href='{!! url('css/bootstrap.min.css') !!}' rel='stylesheet' type='text/css' />
        <script src='{!! url('js/jquery-3.2.0.min.js') !!}' type='text/javascript'></script>
        <script src='{!! url('js/bootstrap.min.js') !!}' type='text/javascript'></script> 
        <link rel="stylesheet" href="{!! url('css/style.css') !!}"/>
        <style type="text/css"> 
        
            .header {
                background-image :url("{{ asset('images/header.png')}}");
                background-size: 100% 100%;    
                background-repeat:   no-repeat;
                color: #fff;
                height: 20px;
                padding: 5px;
                width: : 100%;
            }
            
            .leftButton{
                background-image :url("{{ asset('images/genre.png')}}");
                background-size: 100% 100%;    
                background-repeat:   no-repeat;
                height: 23px;
                margin-left: 30px
            }
            .rightButton{
                background-image :url("{{ asset('images/rk.png')}}");
                background-size: 100% 100%;    
                background-repeat:   no-repeat;
                height: 23px;
                margin-left: 20px;
            }
            .centerButton{
                background-image :url("{{ asset('images/cm.png')}}");
                background-size: 100% 100%;    
                background-repeat:   no-repeat;
                height: 23px;
                 margin-left: 20px;
            }
            
            .line{
                background-image :url("{{ asset('images/line.png')}}");
                background-size: 100% 100%;    
                background-repeat:   no-repeat;
                height: 10px;
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
                        <a href="{{route('genre')}}"><div class="col-md-3  col-xs-3  leftButton"></div></a>
                        <div class="col-md-3  col-xs-3  centerButton"></div>
                        <a href="{{route('ranking')}}"><div class="col-md-3  col-xs-3  rightButton"></div></a>
                    </div>
                    <div class="row please">
                        <p>あなたはどちらがお好きですか？</p>
                        <p>お好きな方を選んでください。</p>
                    </div>
                    <div class="row row-choose">
                    @if($staff != null)
                        <div class="col-md-4 col-md-offset-1 col-xs-5" style="padding-right: 0px;padding-left: 0px">
                            <a id="left" onclick="getRandom('<?php echo $staff[0]['id']  ?>','<?php echo 'left'?>','<?php echo $id ?>');"><img id="imgLeft" class="img-reponsive img-thumbnail" src="{{ asset('uploads/') . '/'.  $staff[0]['image'] }}"></a>
                        </div>
                        <div class="col-md-1 col-xs-1 or">OR</div>
                        <div class="col-md-4 col-xs-5" style="padding-right: 0px;padding-left: 0px" >
                            <a id="right" onclick="getRandom('<?php echo $staff[1]['id']  ?>','<?php echo 'right'?>','<?php echo $id?>');"> <img id="imgRight" class="img-reponsive img-thumbnail" src="{{ asset('uploads/') . '/'.  $staff[1]['image'] }}">
                           </a>
                        </div>
                    @endif
                    </div>      
                    <div class="row row-bottom"><p>Which do you like?</p></div>                     
                 </div>
                <div class = "col-md-4 col-xs-12">
                    <div class = "col-md-10 col-xs-10 col-xs-offset-1">
                        <div class= "chat-box">
                            <div class= "message-box">
                            <?php $viewPrevios = null;
                                    $createAtPrevios = null;
                                    $namePrevios = null;?>
                            @if(count($messages) > 0)
                                @foreach($messages as $message)                                
                                    @if($message->view!=$viewPrevios || $message->name!=$namePrevios)
                                        @if($viewPrevios != null)
                                        </div>
                                        <div class="date-message">{{$createAtPrevios}}</div>
                                        </div>                                    
                                        <div class="line"></div>
                                        @endif
                                        <div class="row-msg">
                                            <div class="col-md-offset-1 name-user name-row"><b>{{$message->name}}</b></div>
                                            <input type="hidden" class="view-hidden" value="<?php echo $message->view;?>" />
                                            <div class="msg-user other-msg col-md-offset-2">
                                                <div class="col-md-offset-2">{{$message->msg}}</div>                                                                                                   
                                    @else
                                        <div class="col-md-offset-2">{{$message->msg}}</div>                                  
                                    @endif
                                    <?php $viewPrevios=$message->view;
                                        $namePrevios = $message->name;
                                        $createAtPrevios=$message->created_at?>
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
                                        <div class="col-md-12 col-xs-12"><input type="text" id="name" maxlength="15" placeholder="名前入力"></div>
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
            var id = <?php echo $id?>;
            var enter = false;
            var numberClick = 0;
            var gen_id = <?php echo $id ?>;
            $(document).on('keydown','.send',function(e){
                var msg = $(this).val();
                var element = $(this);
                var name = $('#name').val(); 
                if(!msg.trim() == '' && e.keyCode == 13 && !e.shiftKey){
                    if(name==""){
                        name = "No name";
                    }else{
                        $('#name').attr('disabled','true');
                    }
                    $.ajax({
                    type:'POST',
                    url: '{{ route('add') }}',
                    data:{_token:"{{csrf_token()}}",msg:msg,name:name,view:view,id:id}
                    });
                    element.val('');
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
                    url: '{{ route('ajax') }}',
                    data:{_token:"{{csrf_token()}}",timePre:timePre,id:id},
                    success:function(data){                          
                        var check = setScrollBottom();
                        for(i = 0; i < data.length ; i++){ 
                            var viewPre = $('.view-hidden:last').val();
                            var namePre = $('.name-row:last b').html();

                            if(data[i]['view']!=viewPre||data[i]['name']!=namePre){
                                if($('.row-msg').length){

                                    $('.message-box').append('<div class="line"></div>');                                       
                                }
                                $('.message-box').append('<div class="row-msg"></div>');

                                if(data[i]['view']!=view){
                                    $('.row-msg:last').append('<div class="col-md-offset-1 name-user name-row"><b>'+data[i]['name']+'</b></div>');
                                    $('.row-msg:last').append('<div class="msg-user other-msg col-md-offset-2"></div>');                                        
                                }else{
                                    $('.row-msg:last').append('<div class="col-md-offset-1 my-name name-row"><b>'+data[i]['name']+'</b></div>');
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
            
            function getRandom(id,choose,genre_id){  
                $.ajax({
                    type:'GET',
                    url: '{{ route('get.random') }}',
                    dataType: 'json',
                    data: 'id='+id+'&choose='+choose+'&genre_id='+genre_id,

                    success:function(staffs){   
                        numberClick = numberClick + 1;    
                                  
                        $("#left").attr("onclick","getRandom('"+staffs[0]['id']+"','left','"+staffs[0]['genre_id']+"')");

                        $("#imgLeft").attr("src","http://enjoyxoxo.com/uploads/"+staffs[0]['image']);

                        $("#right").attr("onclick","getRandom('"+staffs[1]['id']+"','right','"+staffs[0]['genre_id']+"')");

                        $("#imgRight").attr("src","http://enjoyxoxo.com/uploads/"+staffs[1]['image']);                                        
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
                    url:'{{ route('get.time') }}',
                    dataType: 'json',
                    data:'time='+time+'&numberClick='+numberClick+'&genre_id='+gen_id
                    });
                });
                $('#submit').click(function(){
                    var element = $('.send');
                    var msg = element.val();                    
                    var name = $('#name').val();
                    if(!msg.trim() == ''){
                        if(name==""){
                        name = "No name";
                        }else{
                            $('#name').attr('disabled','true');
                        }
                        $.ajax({
                        type:'POST',
                        url: '{{ route('add') }}',
                        data:{_token:"{{csrf_token()}}",msg:msg,name:name,view:view,id:id}
                        });
                        element.val('');
                        enter = true;
                    }
                });              
            });
                                   
        </script>        
    </body>
</html>
