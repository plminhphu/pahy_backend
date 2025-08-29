<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ @$title }}</title>
<meta name="description" content="{{ @$description  }}">
<meta name="keywords" content="{{ @$keywords ?? 'plminhphu,pahy' }}">
<meta property="og:title" content="{{ @$title }}" />
<meta property="og:description" content="{{ @$description  }}" />
<meta property="og:image" content="{{ asset('images/seo.webp') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:type" content="website" />
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ @$title }}">
<meta name="twitter:description" content="{{ @$description  }}">
<meta name="twitter:image" content="{{ asset('images/seo.webp') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
<script src="{{ asset('public/js/jquery-3.7.1.min.js') }}"></script>
<link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
<style>body{font-family:'Quicksand',sans-serif;}</style>