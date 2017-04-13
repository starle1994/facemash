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
                height: 437px;
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
            .avaId .titleAva1 {
    background-image: url(images/titleNumber.png);
    background-size: 100% 100%;
    background-repeat: no-repeat;
    color: white;
    text-align: left;
    font-size: 18px;
    padding: 10px 0px 10px 35px;
    margin-bottom: 0px; }
  .avaId .titleAva2 {
    background-image: url(images/titleGigo.png);
    background-size: 100% 100%;
    background-repeat: no-repeat;
    color: white;
    text-align: left;
    font-size: 18px;
    padding: 10px 0px 10px 35px;
    margin-bottom: 0px; }
  .avaId .ct-ava img {
    max-width: 100%;
    width: 100%; }
  .avaId .ct-ava .titleAva1 {
    background-image: url("{{ asset('images/number1.png')}}");
    background-size: 100% 100%;
    background-repeat: no-repeat;
    color: white;
    text-align: center;
    font-size: 16px;
    padding: 10px 0;
    margin-bottom: 0px; }
  .avaId .ct-ava .titleAva2 {
    background-image: url(images/number2.png);
    background-size: 100% 100%;
    background-repeat: no-repeat;
    color: white;
    text-align: center;
    font-size: 16px;
    padding: 10px 0;
    margin-bottom: 0px; }
  .avaId .ct-ava .titleAva3 {
    background-image: url(images/number3.png);
    background-size: 100% 100%;
    background-repeat: no-repeat;
    color: white;
    text-align: center;
    font-size: 16px;
    padding: 10px 0;
    margin-bottom: 0px; }
  .avaId .titleAva4 {
    background-image: url(images/titleSli1.png);
    background-size: 100% 100%;
    background-repeat: no-repeat;
    color: white;
    text-align: center;
    font-size: 16px;
    padding: 10px 0;
    margin-bottom: 0px; }
  .avaId .titleAva5 {
    background-image: url(images/titleSli2.png);
    background-size: 100% 100%;
    background-repeat: no-repeat;
    color: white;
    text-align: center;
    font-size: 16px;
    padding: 10px 0;
    margin-bottom: 0px; }
  .avaId .titleAva6 {
    background-image: url(images/titleContent.png);
    background-size: 100% 100%;
    background-repeat: no-repeat;
    color: white;
    text-align: center;
    font-size: 16px;
    padding: 10px 0;
    margin-bottom: 0px; }           
        </style>
    </head>
    <body>        
        <div class="container">
           
            <div class="row header">              
            </div>         
            <div class = "row" id="main">
                <div class = "col-md-12  col-xs-12" >
                    <div class="row header1">
                        <div class = "col-md-8 col-xs-12" >
                           <a href="{{route('genre')}}"><div class="col-md-3  col-xs-3  leftButton"></div></a>
                        <div class="col-md-3  col-xs-3  centerButton"></div>
                        <a href="{{route('ranking')}}"><div class="col-md-3  col-xs-3  rightButton"></div></a>
                        </div>
                    </div>

                   <div class="avaId">
                   <div class = "col-md-6 col-xs-12" >
                    <?php for($i=0; $i < 4; $i++){ ?>
                     <?php $n = $i+1?>
                        @if($images[$i] != null)
                        <div class="col-xs-6 col-md-6 pdLeft">
                            <div class="ct-ava">
                                <img src="{{asset('uploads/'.$images[$i]->image)}}" alt="">
                                <p class="titleAva1">
                               
                                    {{ 'No'.$n }}
                                </p>
                            </div>
                        </div>
                        @endif
                       <?php $n++?>
                    <?php } ?>   
                   </div>  
                   <div class = "col-md-6 col-xs-12" >
                  <?php for ($i=4; $i < 10; $i++) { ?>
                    <?php $n = $i+1?>
                        @if($images[$i] != null)
                        <div class="col-xs-6 col-md-6 pdLeft">
                            <div class="ct-ava">
                                <img src="{{asset('uploads/'.$images[$i]->image)}}" alt="">
                                <p class="titleAva1">
                                      {{ 'No'.$n }}
                                </p>
                            </div>
                        </div>
                        @endif
                        <?php $n++?>
                   <?php } ?>  
                   </div>                     
                 </div>
             
            </div>
        </div>
        
       
    </body>
</html>
