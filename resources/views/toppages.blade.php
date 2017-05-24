<!DOCTYPE html>
<html lang="en">
    <head>
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <script>
        (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-8855221633077463",
          enable_page_level_ads: true
        });
      </script>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="google-site-verification" content="Ds3c45ZbOW9e2xVVC7_JRZ2lBOOhFpNtbi7jEJfNvps" />
      <meta name="google-site-verification" content="aICw0zyq39VHqiZ2HAjJiwf8hJdVutaRbcsyQHogUNU" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="XOXO(ハグ&キス)。 メタディスクリプション
      名古屋のすべてに順位をつけよう。２つの画像をクリックするだけでNo.1が決まります。名古屋めし、ラーメン、スイーツ、観光地などの定番ランキングから、クラブ、ホスト、キャバクラなどのディープなランキングまで、あらゆるジャンルに対応。" >
      <meta name="keywords" content="XOXO(ハグ&キス)"> 
      <meta name="author" content="名古屋の人気ランキングはあなたが決める-XOXO(ハグ&キス)ハグキス">
      <meta name="copyright" content="名古屋の人気ランキングはあなたが決める-XOXO(ハグ&キス)ハグキス">
      <link rel="alternate" hreflang="ja-jp" href="{{route('index')}}" />
      <link rel="canonical" href="{{route('index')}}">
      <title>XOXO(ハグ&キス)</title>
      <link href='{!! url('css/bootstrap.min.css') !!}' rel='stylesheet' type='text/css' />
      <link rel="stylesheet" href="{!! url('css/top_page_style.css') !!}"/>
      <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-97838538-1', 'auto');
        ga('send', 'pageview');

      </script>
    </head>
    <body>   
        <div class="banner">
           <img src="{{ asset('css/images/banner.png')}}" class="img-responsive" alt="XOXO(ハグ&キス)">  
        </div>   
        <div class="container" style="margin-top: 10px; padding-right: 10px; padding-left:10px">
             <a href="{{route('index')}}">
               <h1 class="row titleAva2"> 
                   XOXO(ハグ&キス)      
              </h1>    
             </a>
            <div class = "row" id="main">
            
              <div class = "col-md-6  col-xs-12" >
                  <div class="ads">
                    @include('include.ad_top')
                  </div>
                   <div class="avaId">
                       <div class = "col-md-12  col-xs-12 title">
                          <b>2in1</b>
                      </div>
                      <div class = "col-md-12  col-xs-12 content">
                       @foreach($genres as $genre)
                       
                            <div class="col-xs-6 col-md-6 pdLeft">
                                <div class="ct-ava">
                                 <a href="{{route('genre.detail',$genre->id)}}">
                                    <img src="{{asset('uploads/'.$genre->image)}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                    
                                </a>
                                </div>
                            </div>
                        
                        @endforeach     
                      </div> 
                      <div class = "col-md-12  col-xs-12 title_bottom">
                        <a href="{{route('genre')}}"><b>もっと見る</b></a>
                      </div>                    
                </div>
              </div>
              <div class = "col-md-6  col-xs-12" >
                     <div class="avaId">
                        <div class = "col-md-12  col-xs-12 title">
                          <b>ランキング</b>
                        </div>
                        <div class = "col-md-12  col-xs-12 content">
                         @foreach($genres as $genre)
                         
                              <div class="col-xs-6 col-md-6 pdLeft">
                                  <div class="ct-ava">
                                   <a href="{{route('ranking.detail',$genre->id)}}">
                                      <img src="{{ $genre->ranking_img != null ? asset('uploads/'.$genre->ranking_img) : asset('css/images/img_ranking.png') }}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                      
                                  </a>
                                  </div>
                              </div>
                          
                          @endforeach     
                        </div> 
                        <div class = "col-md-12  col-xs-12 title_bottom">
                          <a href="{{route('ranking')}}"><b>もっと見る</b></a>
                        </div>                    
                  </div>
              </div>
              <div class = "col-md-12 ads_pc" >
                <div class="col-md-6">   
                  <a href="{{ isset($ads[0]) ? $ads[0]->link : '' }}"><img src="{{ (!isset($ads[0])) ? asset('css/images/ad.png') : asset('uploads/'.$ads[0]->image) }}" class="img-responsive" alt="XOXO(ハグ&キス)"></a>
                </div>
                <div class="col-md-6">   
                  <a href="{{ isset($ads[1]) ? $ads[1]->link : '' }}"><img src="{{ (!isset($ads[1])) ? asset('css/images/ad.png') : asset('uploads/'.$ads[1]->image) }}" class="img-responsive" alt="XOXO(ハグ&キス)"></a>
                </div>
              </div>
              <div class = "col-md-6  col-xs-12" >
                     
                   <div class="avaId">
                      <div class = "col-md-12  col-xs-12 title">
                        <b>トーク</b>
                      </div>
                      <div class = "col-md-12  col-xs-12 content">
                       @foreach($genres as $genre)
                            <div class="col-xs-6 col-md-6 pdLeft">
                                <div class="ct-ava">
                                 <a href="{{route('genre.detail',$genre->id)}}">
                                    <img src="{{ $genre->talk_img != null ? asset('uploads/'.$genre->talk_img) : asset('css/images/img_ranking.png')}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                    
                                </a>
                                </div>
                            </div>
                        
                        @endforeach     
                      </div> 
                      <div class = "col-md-12  col-xs-12 title_bottom">
                       <a href="{{route('genre')}}"><b>もっと見る</b></a>
                      </div>                    
                </div>
            </div>
            <div class = "col-md-6  col-xs-12" >
                     
                   <div class="avaId">
                      <div class = "col-md-12  col-xs-12 title">
                        <b>コンテンツ</b>
                      </div>
                      <div class = "col-md-12  col-xs-12 content">
                       
                            <div class="col-xs-6 col-md-6 pdLeft">
                                <div class="ct-ava">
                                 <a href="{{ isset($content[0]) ? $content[0]->url : ''}}">
                                    <img src="{{ isset($content[0]) ? asset('uploads/'.$content[0]->image) : asset('css/images/img_ranking.png')}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                    
                                </a>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6 pdLeft">
                                <div class="ct-ava">
                                 <a href="{{ isset($content[1]) ? $content[1]->url : ''}}">
                                    <img src="{{ isset($content[1]) ? asset('uploads/'.$content[1]->image) : asset('css/images/img_ranking.png')}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                    
                                </a>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6 pdLeft">
                                <div class="ct-ava">
                                 <a href="{{ isset($content[2]) ? $content[2]->url : ''}}">
                                    <img src="{{ isset($content[2]) ? asset('uploads/'.$content[2]->image) : asset('css/images/img_ranking.png')}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                    
                                </a>
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6 pdLeft">
                                <div class="ct-ava">
                                 <a href="{{ isset($content[3]) ? $content[3]->url : ''}}">
                                    <img src="{{ isset($content[3]) ? asset('uploads/'.$content[3]->image) : asset('css/images/img_ranking.png')}}" alt="" class="img-reponsive img-thumbnail" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)">
                                    
                                </a>
                                </div>
                            </div>
                               
                         
                      </div> 
                      <div class = "col-md-12  col-xs-12 title_bottom">
                        <b>もっと見る</b>
                      </div>                    
                </div>
            </div>
            <div class = "col-md-12 ads_pc" style="margin-bottom: 10px">
                <div class="col-md-6">   
                  <a href="{{ isset($ads[2]) ? $ads[2]->link : '' }}"><img src="{{ (!isset($ads[2])) ? asset('css/images/ad.png') : asset('uploads/'.$ads[2]->image) }}" class="img-responsive" alt="XOXO(ハグ&キス)"></a>
                </div>
                <div class="col-md-6">   
                  <a href="{{ isset($ads[3]) ? $ads[3]->link : '' }}"><img src="{{ (!isset($ads[3])) ? asset('css/images/ad.png') : asset('uploads/'.$ads[3]->image) }}" class="img-responsive" alt="XOXO(ハグ&キス)"></a>
                </div>
              </div>
          </div>
        @include('include.footer')
       
    </body>
</html>
