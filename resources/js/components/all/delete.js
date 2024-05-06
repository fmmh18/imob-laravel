document.querySelectorAll(".btn-delete").forEach(function(button) {
    button.addEventListener("click", function(e) {
        e.preventDefault();

        var url = this.getAttribute('href');

    new swal({
        title: 'Deseja realmente excluir esse item?',
        text: "Não será possivel a recuperação do mesmo.",
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
    }).then((result) => {
        if (result.isConfirmed == true ) {
             window.location.href = url;
            }
      });
    });
});
