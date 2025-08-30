<script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
<div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 1055;">
	<div id="appToast" class="toast align-items-center text-bg-light border-0 shadow-sm" role="alert" aria-live="assertive" aria-atomic="true" style="tratransition: ease 3s;">
		<div class="d-flex">
			<div class="toast-body" id="appToastBody">
			</div>
			<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
		</div>
	</div>
</div>
<script>
function showBootstrapToast(message, type = 'danger') {
	const toastEl = $('#appToast');
	const toastBody = $('#appToastBody');
	toastBody.text(message);
	toastEl.removeClass('text-bg-danger text-bg-success text-bg-warning text-bg-info text-bg-light')
					.addClass('text-bg-' + type);
	const toast = new bootstrap.Toast(toastEl[0]);
	toast.show();
}
document.getElementById('openMenu')?.addEventListener('click', function () {
	document.getElementById('menu').classList.remove('collapsed');
	document.getElementById('openMenuI').classList.remove('d-md-block');
});
document.getElementById('closeMenu')?.addEventListener('click', function () {
	document.getElementById('menu').classList.add('collapsed');
	document.getElementById('openMenuI').classList.add('d-md-block');
});
</script>