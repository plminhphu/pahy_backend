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
<link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/font-family.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/bootstrap-icons.css') }}" rel="stylesheet">
<script src="{{ asset('public/js/jquery-3.7.1.min.js') }}"></script>
<style>body{font-family:'Quicksand',sans-serif;}</style>
<style>
  #menu {
    width: 80vw;
  }
  /* hiệu ứng xoay */
  .rotate-180 {
    transform: rotate(180deg);
    transition: transform 0.2s ease;
  }
  @media (min-width: 992px) {
    /* Sidebar flex item */
    #menu {
      position: relative !important;
      transform: none !important;
      visibility: visible !important;
      top: 0; left: 0; bottom: 0;
      width: 320px;
      transition: width 0.2s ease;
    }
    /* Thu gọn */
    #menu.collapsed {
      width: 0;
      padding: 0 !important;
      border: none !important;
      overflow: hidden;
    }
    .offcanvas-backdrop {
      display: none;
    }
  }
  .offcanvas-header, nav{
    height: 56px;
  }
</style>