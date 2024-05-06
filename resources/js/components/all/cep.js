document.querySelectorAll('.zipcode').forEach(function (element) {
    element.addEventListener('change', function (e) {
        e.preventDefault();

        var baseApiUrl = "https://brasilapi.com.br/";
        var addressInput = document.querySelector('.street');
        var neighborhoodInput = document.querySelector('.neighborhood');
        var cityInput = document.querySelector('.city');
        var stateInput = document.querySelector('.state');

        if (addressInput) {
            addressInput.value = '';
        }

        if (neighborhoodInput) {
            neighborhoodInput.value = '';
        }

        if (cityInput) {
            cityInput.value = '';
        }

        if (stateInput) {
            stateInput.value = '';
        }

        var zipcode = element.value;
        zipcode = zipcode.replace(/[^a-zA-Z0-9]/g, "");

        if (zipcode != '') {
            fetch(baseApiUrl + 'api/cep/v1/' + zipcode)
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(function (data) {
                    address.value = data.street;
                    address.disabled = false;
                    neighborhood.value = data.neighborhood;
                    neighborhood.disabled = false;
                    city.value = data.city;
                    city.disabled = false;
                    state.value = data.state;
                    state.disabled = false;
                })
        }
    });
});
