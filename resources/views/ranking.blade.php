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
            
            .avaId .titleAva1 {
    background-image: url(images/titleNumber.png);
    background-size: 100% 100%;
    background-repeat: no-repeat;
    color: white;
    text-align: left;
    font-size: 18px;
    padding: 10px 0px 10px 35px;
    margin-bottom: 0px; }
  
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
           
        </style>
    </head>
    <body>        
        <div class="container">
           
            <div class="row header">              
            </div>         
            <div class = "row" id="main">
                <div class = "col-md-12  col-xs-12" >
                    @include('include.header1')
                   <div class="avaId">
                   @foreach($genres as $genre)
                        <div class="col-xs-6 col-md-3 pdLeft">
                            <div class="ct-ava">
                                <a href="{{route('ranking.detail',$genre->id)}}"><img src="{{asset('uploads/'.$genre->image)}}" alt="" class="img-reponsive img-thumbnail">
                                <p class="titleAva1">
                                    {{$genre->name}}
                                </p>
                                </a>
                            </div>
                        </div>
                    @endforeach     
                                       
                 </div>
             
            </div>
        </div>
        
       
    </body>
</html>
