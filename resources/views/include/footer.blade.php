<div class="row">
	<div class="footer_mo">
	@if ($ads->isEmpty() != true)
        <?php $i =0; foreach ($ads as $ad): ?>
            @if($ad->position == 'bottom')
                <a href="{{($ad != null) ? $ad->link : '' }}"><img src="{{ ($ad == null) ? asset('css/images/ad.png') : asset('uploads/'.$ad->image) }}" class="img-responsive bottom_ad" alt="XOXO(ハグ&キス)"></a>
                <?php $i++ ?>
            @endif
        <?php endforeach ?>
        @if($i ==0)
	        <img src="{{ asset('css/images/ad.png')}}" class="img-responsive" alt="XOXO(ハグ&キス)">
	    @endif
    @else
        <img src="{{ asset('css/images/ad.png')}}" class="img-responsive bottom_ad" alt="XOXO(ハグ&キス)">
    @endif
     @include('include.header1')
		<a href="{!! route('index') !!}"><img src="{{asset('css/images/footer.png')}}" alt="" class="img-responsive bottom_ad" alt="XOXO(ハグ&キス)" title="XOXO(ハグ&キス)"></a>
	</div>
</div>

