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
                        alert("Please enter your name");
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

                                    $('.message-box').append('<div class="line"></div>');                                    
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
                                                                    
                                }
                            else{

                                $('.msg-user:last').append('<div class="col-md-offset-2">'+data[i]['msg']+'</div>');
                                $('.date-message:last').html(data[i]['created_at']);                               
                            }                                       
                        } 
                        if(check==true||enter==true){
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
                    console.log(staffs); 
                        numberClick = numberClick + 1;                    
                        $("#left").attr("onclick","getRandom('"+staffs[0]['id']+"','left')");

                        $("#imgLeft").attr("src","http://"+$(location).attr('host')+"/uploads/"+staffs[0]['image']);

                        $("#right").attr("onclick","getRandom('"+staffs[1]['id']+"','right')");

                        $("#imgRight").attr("src","http://"+$(location).attr('host')+"/uploads/"+staffs[1]['image']);                        
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
                            alert("Please enter your name");
                        }
                    enter = true;
                    }
                });              
            });
                   