@component('mail::message')

@if ( isset($data['custom']) && $data['custom'] )

{!! $data['html'] !!}

@else

@if ( isset($data['title']) && $data['title'] )
#{!! $data['title'] !!}<br>
@endif

@if ( isset($data['body']) && $data['body'] )
{!! $data['body'] !!}
@endif
	
@endif


@if ( !isset($data['signature']) || $data['signature'] === true )
<br>
باتشکر,<br>
فانوس
@elseif ( isset($data['signature']) && $data['signature'] !== false )
{!! $data['signature'] !!}
@endif

@endcomponent