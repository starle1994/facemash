<!DOCTYPE html>
<html lang="en">
    <head>
        @include('include.head')
    </head>
    <body>        
        <div class="container">
           <a href="{{route('index')}}">
               <h1 class="row titleAva2"> 
                   XOXO(ハグ&キス)      
              </h1>    
             </a>         
            <div class = "row" id="main">
                <div class = "col-md-12  col-xs-12" >
                     <div class="ad_mobi">
                        @include('include.ad_top')
                    </div>
                    @include('include.header1')

                   <div class="avaId">
                   <div class = "col-md-6 col-xs-12" >
                    <?php for($i=0; $i < 4; $i++){ ?>
                     <?php $n = $i+1?>
                        @if(isset($images[$i]))
                        <div id="no1">
                            <div class="col-xs-6 col-md-6 pdLeft ">
                            <div class="ct-ava">
                                <img src="{{asset('uploads/'.$images[$i]->image)}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                <p class="titleAva1">
                                    {{ 'No'.$n }}
                                </p>
                            </div>
                            <p style="font-size: 15px ;font-weight: bold;">{{ number_format($images[$i]->rating) }} click</p>
                        </div>
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
<script src='https://enjoyxoxo.com/js/jquery-3.2.0.min.js' type='text/javascript'></script>
<script src='https://enjoyxoxo.com/js/bootstrap.min.js' type='text/javascript'></script> 
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
