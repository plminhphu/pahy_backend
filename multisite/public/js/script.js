
function shimmerloader(){
	const count = Math.floor(Math.random() * 15) + 8; //random number between 8 and 22
	let loader = '<div class="shimmer-loader p-md-4 p-2">';
	for(let i=0; i<count; i++){
		// random width between 60 and 90
		const width = Math.floor(Math.random() * 41) + 60; 
		loader += `<div class="shimmer-line mb-2" style="width: ${width}%; height: 20px;"></div>`;
	}
	loader += '</div>';
	return loader;
}
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