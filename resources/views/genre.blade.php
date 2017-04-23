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
                    @include('include.header1')
                   <div class="avaId">
                   @foreach($genres as $genre)
                        <div class="col-xs-6 col-md-3 pdLeft">
                            <div class="ct-ava">
                             <a href="{{route('genre.detail',$genre->id)}}">
                                <img src="{{asset('uploads/'.$genre->image)}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
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
        @include('include.footer')
       
    </body>
</html>
