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
                   <div class = "col-md-7 col-xs-12 big" >
                    <?php for($i=0; $i < 4; $i++){ ?>
                     <?php $n = $i+1?>
                        @if(isset($images[$i]))
                        
                        <div class=" {{ ($n == 1|| $n==3) ? 'col-xs-12 col-md-7' : 'col-xs-12 col-md-5'}} pdLeft {{ ($n == 2 || $n == 1)  ? '' : 'nn2'}}">
                            <div class="{{ ($n == 1|| $n==3)  ? 'col-xs-11 col-md-10' : 'col-xs-12 col-md-12'}} mal ">
                                <div class="ct-ava  {{ ($n == 1|| $n==3)  ? 'number1' : 'no-nb1'}} ">
                                    <img src="{{asset('uploads/'.$images[$i]->image)}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                    <p class="titleAva1">
                                        {{ 'No'.$n }}
                                    </p>
                                     <p style="font-size: 15px ;font-weight: bold;">{{ number_format($images[$i]->rating) }} click</p>
                                </div>
                            </div>
                            @if($n ==1)
                            <img src="{{asset('css/images/no1.png')}}" alt="" class="img-reponsive img-thumbnail no1" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                            @endif
                        </div>
                       
                        
                        @endif
                       <?php $n++?>
                    <?php } ?>   
                   </div>  
                   <div class = "col-md-5 col-xs-12 no-nb2" >
                  <?php for ($i=4; $i < 10; $i++) { ?>
                    <?php $n = $i+1?>
                        @if(isset($images[$i]))
                        <div class="col-xs-6 col-md-6 pdLeft">
                            <div class="ct-ava">
                                <img  src="{{asset('uploads/'.$images[$i]->image)}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
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
                $('.container .avaId .pdLeft .ct-ava img').height(height/1.3);   
                var height = $('.container .avaId .big div:first-child').height();    
                $('.container .avaId .big div').height(height); 
                $('.container .avaId .big .no1').height(height);   
    
        };
         
    $(document).ready(function () {  
         
        $( window ).resize(function() {
             var height = $('.container .avaId .pdLeft div:first-child img').height();      
                $('.container .avaId .pdLeft .ct-ava img').height(height/1.3);
                     var height = $('.container .avaId .big div:first-child').height();    
                $('.container .avaId .big div').height(height);  
                 $('.container .avaId .big .no1').height(height);    
        });
});
</script>  
</html>
