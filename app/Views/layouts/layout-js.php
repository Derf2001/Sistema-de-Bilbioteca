<script>
    function showpanel() {
        const newAccountBtn = document.getElementById('new-account-btn');
        const newAccountPanel = document.querySelector('.new-account-panel');
        const adminTable = document.querySelector('.admin-table');

        const guardarBtn = document.querySelector('.new-account-btn2');

        newAccountPanel.classList.toggle('show');
        adminTable.classList.toggle('show-panel');
        newAccountBtn.style.display = 'none';
    }
    function closepanel() {
        const adminTable = document.querySelector('.admin-table');
        const newAccountPanel = document.querySelector('.new-account-panel');
        const newAccountBtn = document.getElementById('new-account-btn');
        newAccountPanel.classList.toggle('show');
        adminTable.classList.toggle('show-panel');
        newAccountBtn.style.display = 'flex';
        document.getElementById('new-account-name').value = '';
        document.getElementById('new-account-password').value = '';
        reset();
    }

    const cancelarBtn = document.querySelector('.cancel-btn');

    cancelarBtn.addEventListener('click', function () {
        document.getElementById('aux').value = 0;
        closepanel();
    });
</script>
<script>
    const searchInput = document.getElementById('search');
    const searchIcon = document.querySelector('.search-form i');
    const accountName = document.getElementById('new-account-name');
    const accountPassword = document.getElementById('new-account-password');

    // Cambia el color del texto al escribir
    searchInput.addEventListener('input', function () {
        this.style.color = this.value ? 'white' : '#A0AEC0';
    });
    accountName.addEventListener('input', function () {
        this.style.color = this.value ? 'white' : '#A0AEC0';
    });
    accountPassword.addEventListener('input', function () {
        this.style.color = this.value ? 'white' : '#A0AEC0';
    });

    // Cambia el color del texto al hacer clic en el icono
    searchIcon.addEventListener('click', function () {
        searchInput.style.color = searchInput.value ? 'white' : '#A0AEC0';
    });


</script>
<script src="<?= base_url('js/sweetalert2@11.js') ?>"></script>
<script src="<?= base_url('js/jquery.min.js') ?>"></script>

<script>
    function cerrarSesion() {
        console.log('cerrar sesion');
        $.ajax({
            url: '<?= base_url('CerrarSession') ?>',
            type: 'POST',
            data: { 
                "cerrar": "cerrada"
            },success: function (response) {
                var res = JSON.parse(response);
                if (res.error == 'cerrada') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sesión cerrada!',
                        text: 'La sesión se ha cerrado correctamente...',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            setTimeout(() => {
                                window.location.href = '<?= base_url('Principal') ?>';
                            }, 2000)
                        }
                    });
                }
            }
        });
    }
</script>