@props(['url'])

<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Streamline Tech')
                <!-- Replace the src with your custom logo URL -->
                <img src="https://yourwebsite.com/img/custom-logo.png" class="logo" alt="Streamline Tech Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
