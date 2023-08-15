<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $apps['title'] ? $apps['title'] : 'My Apps' }}</title>
    <link href="/vendors/bootstrap-5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="/vendors/select2/dist/css/select2.min.css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css"> --}}
    <link rel="stylesheet" href="/vendors/select2-bootstrap5/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="/vendors/datatables/datatables.min.css">
    <link rel="stylesheet" href="/vendors/datatables/RowGroup-1.2.0/css/rowGroup.bootstrap.css">
    <link rel="stylesheet" href="/vendors/fontawesome/css/all.css" />
    <link rel="stylesheet" href="/asset/css/style.css">
    <script type="text/javascript" src="/asset/jquery.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function copyToClipboard(idelement) {
            // Get the text field
            var copyText = document.getElementById(idelement);

            var range = document.createRange();
            range.selectNode(copyText);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);

            // Copy the selected text to the clipboard
            document.execCommand("copy");

            // Clear the selection
            window.getSelection().removeAllRanges();
        }
    </script>
</head>

<body>
    <x-app-navbar></x-app-navbar>
    <div class="container mt-3 mb-3">
        @if (session()->has('pesan'))
            <div class="alert alert-info">
                {{ session()->get('pesan') }}
            </div>
        @endif
        <div class="card-body mb-3">
            <h4>{{ $apps['desc'] }}</h4>
        </div>
        {{ $slot }}
    </div>
</body>

</html>
