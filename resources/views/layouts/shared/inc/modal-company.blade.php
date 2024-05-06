
<div class="modal fade" id="companyModal" tabindex="-1" aria-labelledby="companyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyModalLabel">Selecione a empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{!! route('dashboard.home.setCompany') !!}" >
            <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Selecione a Empresa:</label>
                        <select name="company_id" class="form-control">
                            @foreach ($allCompanies as $item)
                                <option value="{!! $item->id !!}">{!! $item->name_fantasy !!}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Selecionar</button>
            </div>
        </form>
        </div>
    </div>
</div>
