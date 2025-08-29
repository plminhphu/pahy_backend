<script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
<sl-alert id="app-toast" variant="danger" closable duration="3000"
    class="position-fixed top-0 start-0 m-3" style="z-index:1100; min-width:260px">
    <sl-icon slot="icon" name="exclamation-triangle"></sl-icon>
    <span id="app-toast-msg">Thông báo</span>
</sl-alert>
<script>
  window.showToast = function (msg, variant = "danger") {
    const toast = document.getElementById("app-toast");
    const msgBox = document.getElementById("app-toast-msg");
    toast.variant = variant;
    msgBox.textContent = msg;
    toast.show();
  }
</script>