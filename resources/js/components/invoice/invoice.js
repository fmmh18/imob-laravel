
document.querySelectorAll(".btn-invoice-create").forEach(function(button) {
    button.addEventListener("click", function(e) {
        e.preventDefault();
        var permissionModal = new bootstrap.Modal(document.getElementById('invoiceModal'));
            permissionModal.show();
    });
});

var checkboxes = document.querySelectorAll("input[name='invoices[]']");
var links = document.querySelectorAll("#links a");

// Adicione um ouvinte de evento de clique a cada checkbox
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('click', function() {
        var a_invoices = [];

        // Itere sobre os checkboxes marcados e adicione os valores ao array
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                a_invoices.push(checkbox.value);
            }
        });

        for (var i = 0; i < links.length; i++) {
            var href = new URL(links[i].getAttribute('href'));
            href.searchParams.set('invoices', a_invoices.join(','));
            links[i].setAttribute('href', href);
        }
        // Agora você pode usar a_invoices conforme necessários
    });
});


document.querySelectorAll(".btn-invoice-pay").forEach(function(button) {
    button.addEventListener("click", function(e) {
        e.preventDefault();

        var url = this.getAttribute('href');

        var selectedInvoices = document.querySelectorAll("input[name='invoices[]']:checked");

        var selectedInvoiceId = this ? this.dataset.id : null;

        var selectedInvoiceLength = this ? this.dataset.leng : null;
        console.log(selectedInvoiceLength);
        var numberOfSelectedInvoices = selectedInvoiceLength != null ? selectedInvoiceLength : selectedInvoices.length;


        if (numberOfSelectedInvoices > 1 || numberOfSelectedInvoices == 0) {
            var title, text;

            if (numberOfSelectedInvoices > 1) {
                title = 'Não é possível a baixar  mais de um título.';
                text = 'Selecione apenas um título para baixa.';
            } else if (numberOfSelectedInvoices == 0) {
                title = 'Atenção!';
                text = 'Selecione um título.';
            }

            new swal({
                title: title,
                text: text,
                type: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'OK!',
                closeOnConfirm: true
            });
        }

        var form = document.getElementById('addpayment');
        var action = new URL(form.getAttribute('action'));
        form.setAttribute('action', url);
        if(numberOfSelectedInvoices == 1 && selectedInvoiceId == undefined)
        {
                selectedInvoices.forEach(function(checkbox) {
                    // Obter o valor de cada checkbox
                    var valorDoCheckbox = checkbox.value;
                    document.getElementById('invoice_to_pay_ids').value = valorDoCheckbox;
                });
                var permissionModal = new bootstrap.Modal(document.getElementById('invoiceModal'));

                permissionModal.show();

        }

        if(selectedInvoiceId != null)
        {

                document.getElementById('invoice_to_pay_ids').value = selectedInvoiceId;

                var permissionModal = new bootstrap.Modal(document.getElementById('invoiceModal'));

                permissionModal.show();

        }

    });
});






