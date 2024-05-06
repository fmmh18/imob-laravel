    //btn-user-modal
    document.querySelectorAll(".btn-user-modal").forEach(function(button) {
        button.addEventListener("click", function(e) {
            e.preventDefault();
            var userId = this.getAttribute('data-user-id');

            document.getElementById('user_id').value = ''
            document.getElementById('user_id').value = userId
            var permissionModal = new bootstrap.Modal(document.getElementById('permissionUserModal'));
                permissionModal.show();
            });
    });
    document.querySelector("#is_active").onchange = function() {
        var opcaoSelecionada = this.value;
        if(opcaoSelecionada == 1){
            document.getElementById("cpf").removeAttribute("disabled");
            document.getElementById("name_responsable").removeAttribute("disabled");
            document.getElementById("email_responsable").removeAttribute("disabled");
        }else{
            document.getElementById("cpf").setAttribute("disabled", "disabled");
            document.getElementById("name_responsable").setAttribute("disabled", "disabled");
            document.getElementById("email_responsable").setAttribute("disabled", "disabled");
        }
    };

    document.querySelectorAll('.cgc').forEach(function(element) {
        element.addEventListener('change', function(e) {
          e.preventDefault();

          var baseApiUrl = "https://brasilapi.com.br/";
          var nameFantasyInput = document.querySelector('.name_fantasy');
          var socialReasonInput = document.querySelector('.social_reason');
          var addressInput = document.querySelector('.address');
          var neighborhoodInput = document.querySelector('.neighborhood');
          var cityInput = document.querySelector('.city');
          var stateInput = document.querySelector('.state');
          var zipcodeInput = document.querySelector('.zipcode');
          var numberInput = document.querySelector('.number');

          nameFantasyInput.value = '';
          socialReasonInput.value = '';
          addressInput.value = '';
          neighborhoodInput.value = '';
          cityInput.value = '';
          stateInput.value = '';
          zipcodeInput.value = '';
          numberInput.value = '';

          var cnpj = element.value;
          cnpj = cnpj.replace(/[^a-zA-Z0-9]/g, "");
          if(cnpj != ''){

          fetch(baseApiUrl + 'api/cnpj/v1/' + cnpj)
            .then(function(response) {
              return response.json();
            })
            .then(function(data) {
              // Faça algo com os dados recebidos
                nameFantasyInput.value = data.nome_fantasia;
                nameFantasyInput.disabled = false;
                socialReasonInput.value = data.razao_social;
                socialReasonInput.disabled = false;
                addressInput.value = data.descricao_tipo_de_logradouro + ' ' + data.logradouro;
                addressInput.disabled = false;
                numberInput.value = data.numero;
                numberInput.disabled = false;
                neighborhoodInput.value = data.bairro;
                neighborhoodInput.disabled = false;
                cityInput.value = data.municipio;
                cityInput.disabled = false;
                stateInput.value = data.uf;
                stateInput.disabled = false;
                zipcodeInput.value = data.cep;
                zipcodeInput.disabled = false;
            });
          }
        });
      });
