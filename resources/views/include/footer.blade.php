<div class="row">
	<div class="footer_des">
		<b><a href="{!! route('index') !!}">XOXO(ハグ&キス)</a>-</b>
		<b><a href="{!! route('index') !!}">好きな方にプッシュ!</a>-</b>
		<b><a href="https://www.youtube.com/watch?v=O6oNd7MY_HQ">xoxo プロモーション スイーツin名古屋 編 </a>-</b>
		<b><a href="https://www.youtube.com/watch?v=gFdIyk__GUo">xoxoプロモーション ホスト編</a>-</b>
		<b><a href="https://www.youtube.com/watch?v=jF1DhOtraU4">xoxoプロモーション</a>-</b>
	</div>
	<div class="footer_mo">
	@if ($ads->isEmpty() != true)
        <?php foreach ($ads as $ad): ?>
            @if($ad->position == 'bottom')
                <a href="{{($ad != null) ? $ad->link : '' }}"><img src="{{ ($ad == null) ? asset('css/images/ad.png') : asset('uploads/'.$ad->image) }}" class="img-responsive bottom_ad" alt="XOXO(ハグ&キス)"></a>
            @endif
        <?php endforeach ?>
    @else
        <img src="{{ asset('css/images/ad.png')}}" class="img-responsive bottom_ad" alt="XOXO(ハグ&キス)">
    @endif
     @include('include.header1')
		<a href="{!! route('index') !!}"><img src="{{asset('css/images/footer.png')}}" alt="" class="img-reponsive " alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)"></a>
	</div>
</div>

