
</div>
</div>

<footer class="py-3 bg-light no-print" style="position: absolute; bottom: 10px; width: 100%;">
    <div class="container text-center">
        <p class="mb-0"><?php echo SITE_NAME; ?> &copy; <?php echo date('Y'); ?></p>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Máscaras para campos
        document.addEventListener('DOMContentLoaded', function() {
            // Máscara para data (dd/mm/aaaa)
            const dateInputs = document.querySelectorAll('.date-mask');
            dateInputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    
                    if (value.length > 2) {
                        value = value.substring(0, 2) + '/' + value.substring(2);
                    }
                    if (value.length > 5) {
                        value = value.substring(0, 5) + '/' + value.substring(5, 9);
                    }
                    
                    e.target.value = value;
                });
            });
            
            // Máscara para data e hora (dd/mm/aaaa hh:mm)
            const datetimeInputs = document.querySelectorAll('.datetime-mask');
            datetimeInputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    
                    if (value.length > 2) {
                        value = value.substring(0, 2) + '/' + value.substring(2);
                    }
                    if (value.length > 5) {
                        value = value.substring(0, 5) + '/' + value.substring(5, 9);
                    }
                    if (value.length > 10) {
                        value = value.substring(0, 10) + ' ' + value.substring(10, 12);
                    }
                    if (value.length > 13) {
                        value = value.substring(0, 13) + ':' + value.substring(13, 15);
                    }
                    
                    e.target.value = value;
                });
            });
            
            // Máscara para telefone (00) 00000-0000
            const phoneInputs = document.querySelectorAll('.phone-mask');
            phoneInputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    
                    if (value.length > 0) {
                        value = '(' + value;
                    }
                    if (value.length > 3) {
                        value = value.substring(0, 3) + ') ' + value.substring(3);
                    }
                    if (value.length > 10) {
                        value = value.substring(0, 10) + '-' + value.substring(10, 15);
                    }
                    
                    e.target.value = value;
                });
            });
            
            // Confirmação antes de deletar
            const deleteForms = document.querySelectorAll('form[name="form-delete"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Tem certeza que deseja excluir este registro?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>