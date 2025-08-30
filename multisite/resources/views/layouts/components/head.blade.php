<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ @$title }}</title>
<meta name="description" content="{{ @$description }}">
<meta name="keywords" content="{{ @$keywords ?? 'plminhphu,pahy' }}">
<meta property="og:title" content="{{ @$title }}" />
<meta property="og:description" content="{{ @$description }}" />
<meta property="og:image" content="{{ asset('images/seo.webp') }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:type" content="website" />
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ @$title }}">
<meta name="twitter:description" content="{{ @$description }}">
<meta name="twitter:image" content="{{ asset('images/seo.webp') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
<link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/font-family.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/bootstrap-icons.css') }}" rel="stylesheet">
<script src="{{ asset('public/js/jquery-3.7.1.min.js') }}"></script>
<style>
    body {
        font-family: 'Quicksand', sans-serif;
    }
</style>
<style>
    #menu {
        width: 80vw;
    }

    /* hiệu ứng xoay */
    .rotate-180 {
        transform: rotate(180deg);
        transition: ease .2s;
    }

    @media (min-width: 992px) {

        /* Sidebar flex item */
        #menu {
            position: relative !important;
            transform: none !important;
            visibility: visible !important;
            top: 0;
            left: 0;
            bottom: 0;
            width: 320px;
            transition: ease .2s;
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

    .offcanvas-header,
    nav {
        height: 56px;
    }

    .modal-backdrop.show {
        background-color: rgb(0 0 0 / 60%);
        backdrop-filter: blur(.2rem);
        opacity: 1;
    }

    .form-control {
        border-color: var(--bs-gray);
    }

    .form-control:focus {
        border-color: var(--bs-gray);
        box-shadow: none;
    }

    .dropdown-menu[data-bs-popper] {
        right: -15px;
        left: auto;
        top: 110%;
    }

    .shimmer-loader {
        position: relative;
        overflow: hidden;
    }

    .shimmer-line {
        background: #e0e0e0;
        border-radius: 4px;
        position: relative;
    }

    .shimmer-line::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: linear-gradient(90deg, rgba(224, 224, 224, 0) 0%, rgba(200, 200, 200, 0.6) 50%, rgba(224, 224, 224, 0) 100%);
        animation: shimmer 1.2s infinite;
    }

    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }
.table-scroll {
  position: relative;
  height: 70vh;
  overflow: hidden;
}
.table-scroll table {
  width: 100%;
  margin-bottom: 0;
}
.table-scroll thead.table-light {
  position: sticky;
  top: 0;
  z-index: 2;
  background: rgba(255,255,255,0.5) !important;
  backdrop-filter: blur(14px);
}
.table-scroll tbody {
  display: block;
  height: 65vh;
  overflow-y: auto;
}
.table-scroll thead, .table-scroll tbody tr {
  display: table;
  width: 100%;
  table-layout: fixed;
}
/* là ... đấy,  */
.table td {
     word-break: break-word;
    text-overflow: ellipsis;
    overflow-x: auto;
    max-width: 220px;;
}
</style>