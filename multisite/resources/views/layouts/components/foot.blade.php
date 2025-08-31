<div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 1055;">
	<div id="appToast" class="toast align-items-center text-bg-light border-0 shadow-sm" role="alert" aria-live="assertive" aria-atomic="true" style="tratransition: ease 3s;">
		<div class="d-flex">
			<div class="toast-body" id="appToastBody">
			</div>
			<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
	</div>
</div>
<script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/js/script.js').'?ver='.env('APP_VER') }}"></script>
