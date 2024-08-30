<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body>
    <table class="header" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td class="header">
                <a href="{{ $url }}" style="display: inline-block;">
                    <!-- Remove or customize the logo here -->
                    @if (trim($slot) === 'Your Application Name')
                        <!-- Remove or replace the image source -->
                        <img src="path_to_your_custom_logo.png" class="logo" alt="Your Application Name">
                    @else
                        {{ $slot }}
                    @endif
                </a>
            </td>
        </tr>
    </table>
</body>
</html>
