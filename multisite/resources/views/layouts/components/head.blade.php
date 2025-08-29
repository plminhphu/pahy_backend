<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ @$title ?? 'Sớm có mặt thôi' }}</title>
<meta name="description" content="{{ @$description ?? 'Trang web đang trong quá trình phát triển. Hẹn gặp lại bạn sau!' }}">
<meta name="keywords" content="{{ @$keywords ?? 'plminhphu,pahy' }}">
<meta property="og:title" content="{{ @$title ?? 'Sớm có mặt thôi' }}" />
<meta property="og:description" content="{{ @$description ?? 'Trang web đang trong quá trình phát triển. Hẹn gặp lại bạn sau!' }}" />
<meta property="og:image" content="{{ asset('images/seo.webp') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:type" content="website" />
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ @$title ?? 'Sớm có mặt thôi' }}">
<meta name="twitter:description" content="{{ @$description ?? 'Trang web đang trong quá trình phát triển. Hẹn gặp lại bạn sau!' }}">
<meta name="twitter:image" content="{{ asset('images/seo.webp') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
<script src="{{ asset('public/js/jquery-3.7.1.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<style>body{font-family:'Quicksand',sans-serif;}</style>
