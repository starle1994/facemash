<!DOCTYPE html>
<html lang="en">
    <head>
        @include('include.head')
        <style type="text/css">
            .titleAva2 {
               background-image :url(images/header.png);
            }
            
            .leftButton{
                background-image :url("{{ asset('images/genre.png')}}");
            }
            .rightButton{
                background-image :url("{{ asset('images/rk.png')}}");
            }
            .centerButton{
                background-image :url("{{ asset('images/cm.png')}}");
            }
            
            .line{
                background-image :url("{{ asset('images/line.png')}}");
            }
  
          .titleAva1  a{color: #fff}
           .titleAva1 {
            background-image: url("{{ asset('images/number1.png')}}"); }
        </style>
    </head>
    <body>        
        <div class="container">
           
            <h1 class="row titleAva2"> 
                  XOXO(ハグ&キス)     
            </h1>         
            <div class = "row" id="main">
                <div class = "col-md-12  col-xs-12" >
                    @include('include.header1')

                   <div class="avaId">
                   <div class = "col-md-6 col-xs-12" >
                    <?php for($i=0; $i < 4; $i++){ ?>
                     <?php $n = $i+1?>
                        @if(isset($images[$i]))
                        <div class="col-xs-6 col-md-6 pdLeft">
                            <div class="ct-ava">
                                <img src="{{asset('uploads/'.$images[$i]->image)}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                <p class="titleAva1">
                                    {{ 'No'.$n }}
                                </p>
                            </div>
                            <p style="font-size: 15px ;font-weight: bold;">{{ number_format($images[$i]->rating) }} click</p>
                        </div>
                        @endif
                       <?php $n++?>
                    <?php } ?>   
                   </div>  
                   <div class = "col-md-6 col-xs-12" >
                  <?php for ($i=4; $i < 10; $i++) { ?>
                    <?php $n = $i+1?>
                        @if(isset($images[$i]))
                        <div class="col-xs-6 col-md-6 pdLeft">
                            <div class="ct-ava">
                                <img src="{{asset('uploads/'.$images[$i]->image)}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                <p class="titleAva1">
                                      {{ 'No'.$n }}
                                </p>
                            </div>
                            <p style="font-size: 15px ;font-weight: bold;">{{ number_format($images[$i]->rating) }} click</p>
                        </div>
                        @endif
                        <?php $n++?>
                   <?php } ?>  
                   </div>                     
                 </div>
             
            </div>
            @include('include.footer')
        </div>
        
       
    </body>
<script type="text/javascript">
    window.onload = function(){
        var height = $('.container .avaId .pdLeft div:first-child img').height();    
                $('.container .avaId .pdLeft .ct-ava img').height(height);   
        };
    $(document).ready(function () {  
         
        $( window ).resize(function() {
             var height = $('.container .avaId .pdLeft div:first-child img').height();      
                $('.container .avaId .pdLeft .ct-ava img').height(height);

        });
});
</script>  
</html>
