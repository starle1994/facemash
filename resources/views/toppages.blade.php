<!DOCTYPE html>
<html lang="en">
    <head>
        @include('include.head')
    </head>
    <body>      
         <img src="{{ asset('css/images/banner.png')}}" class="img-responsive" alt="XOXO(ハグ&キス)">   
        <div class="container" style="margin-top: 10px; padding-right: 10px; padding-left:10px">
                
            <div class = "row" >
            
                <div class = "col-md-12  col-xs-12" >
                    
                     @if ($ads->isEmpty() != true)
                            <?php foreach ($ads as $ad): ?>
                                @if($ad->position == 'top')
                                    <a href="{{($ad != null) ? $ad->link : '' }}"><img src="{{ ($ad == null) ? asset('css/images/ad.png') : asset('uploads/'.$ad->image) }}" class="img-responsive" alt="XOXO(ハグ&キス)"></a>
                               
                                @endif
                            <?php endforeach ?>
                        @else
                            <img src="{{ asset('css/images/ad.png')}}" class="img-responsive" alt="XOXO(ハグ&キス)">
                        @endif
                   <div class="avaId">
                   <div class = "col-md-12  col-xs-12" style="text-align: center; border: 1px solid orange;">
                  ssdsdsd
                  </div>
                   @foreach($genres as $genre)
                        <div class="col-xs-6 col-md-3 pdLeft" style="border: 1px solid orange;">
                            <div class="ct-ava">
                             <a href="{{route('genre.detail',$genre->id)}}">
                                <img src="{{asset('uploads/'.$genre->image)}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                
                            </a>
                            </div>
                        </div>
                    @endforeach     
                                       
                 </div>
             
            </div>
        </div>
        @include('include.footer')
       
    </body>
</html>
