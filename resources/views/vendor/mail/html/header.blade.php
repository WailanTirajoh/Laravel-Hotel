<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                {{-- <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo"> --}}
                <img src="{{ asset('img/logo/sip.png') }}" alt="" width="70" height="70"
                    class="d-inline-block align-text-top">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
