<div class="container-fluid container-1524">
    <div class="tp-service-vp-wrap">
        @if (session()->has('embarque_success'))
            <div class="alert alert-success mb-30" role="alert">
                {{ session('embarque_success') }}
            </div>
        @endif

        <form wire:submit="submit" class="row g-4">
            <div class="col-md-6">
                <label class="tp-ff-dm fw-500 fs-18 tp-text-common-white mb-10">Nome</label>
                <input wire:model.defer="nome" type="text" class="form-control" placeholder="Seu nome completo">
                @error('nome') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label class="tp-ff-dm fw-500 fs-18 tp-text-common-white mb-10">E-mail</label>
                <input wire:model.defer="email" type="email" class="form-control" placeholder="voce@exemplo.com">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label class="tp-ff-dm fw-500 fs-18 tp-text-common-white mb-10">Telefone</label>
                <input wire:model.defer="telefone" type="text" class="form-control" placeholder="(00) 00000-0000">
                @error('telefone') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-6">
                <label class="tp-ff-dm fw-500 fs-18 tp-text-common-white mb-10">Cidade</label>
                <input wire:model.defer="cidade" type="text" class="form-control" placeholder="Sua cidade">
                @error('cidade') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-12">
                <label class="tp-ff-dm fw-500 fs-18 tp-text-common-white mb-10">Observacoes</label>
                <textarea wire:model.defer="mensagem" rows="5" class="form-control" placeholder="Informacoes adicionais"></textarea>
                @error('mensagem') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-12">
                <button type="submit" class="tp-btn-2 tp-btn-primary">
                    <span wire:loading.remove wire:target="submit">Enviar formulario</span>
                    <span wire:loading wire:target="submit">Enviando...</span>
                </button>
            </div>
        </form>
    </div>
</div>
