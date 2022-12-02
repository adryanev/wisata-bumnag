<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('landing/images/app_transparent_background.png') }}" class="logo" alt="{{ config('app.name') }} Logo">
@else
<img src="{{ asset('landing/images/app_transparent_background.png') }}" class="logo" alt="{{ config('app.name') }} Logo">

{{ $slot }}
@endif
</a>
</td>
</tr>
