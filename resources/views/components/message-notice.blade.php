@props(['type', 'value'])
<div id="message-notice">
    @if($type == 'message')
    <p class="p-1 bg-green-100 text-green-800 my-2 flex justify-between">{{ $value }}</p>
    @elseif ($type == 'error')
    <p class="p-1 bg-red-100 text-red-800 my-2 flex justify-between">{{ $value }}</p>
    @endif
</div>
