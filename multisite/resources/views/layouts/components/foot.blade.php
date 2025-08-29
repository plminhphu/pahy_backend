<script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
<sl-alert id="app-toast" variant="neutral" closable duration="3000">
  <sl-icon slot="icon" name="exclamation-triangle"></sl-icon>
  <span id="app-toast-msg">Thông báo</span>
</sl-alert>
<script>
  window.showToast = function (msg, variant = "danger") {
    const alert = document.getElementById("app-toast");
    const msgBox = document.getElementById("app-toast-msg");
    alert.variant = variant;
    msgBox.textContent = msg;
    alert.toast();
  }
</script>