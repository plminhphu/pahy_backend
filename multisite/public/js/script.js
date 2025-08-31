
const shimmerloader = `<div class="shimmer-loader"><div class="shimmer-line mb-2" style="width: 80%; height: 20px;"></div><div class="shimmer-line mb-2" style="width: 60%; height: 20px;"></div><div class="shimmer-line mb-2" style="width: 90%; height: 20px;"></div><div class="shimmer-line mb-2" style="width: 80%; height: 20px;"></div><div class="shimmer-line mb-2" style="width: 60%; height: 20px;"></div><div class="shimmer-line mb-2" style="width: 90%; height: 20px;"></div><div class="shimmer-line mb-2" style="width: 80%; height: 20px;"></div><div class="shimmer-line mb-2" style="width: 60%; height: 20px;"></div><div class="shimmer-line mb-2" style="width: 90%; height: 20px;"></div></div>`;
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