<?php

namespace App\Livewire\Site;

use Livewire\Component;

class EmbarqueForm extends Component
{
    public string $nome = '';

    public string $email = '';

    public string $telefone = '';

    public string $cidade = '';

    public string $mensagem = '';

    public function submit(): void
    {
        $this->validate([
            'nome' => ['required', 'string', 'min:3', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'telefone' => ['required', 'string', 'min:8', 'max:30'],
            'cidade' => ['nullable', 'string', 'max:120'],
            'mensagem' => ['nullable', 'string', 'max:1000'],
        ]);

        session()->flash('embarque_success', 'Formulario enviado com sucesso. Nossa equipe vai entrar em contato.');

        $this->reset(['nome', 'email', 'telefone', 'cidade', 'mensagem']);
    }

    public function render()
    {
        return view('livewire.site.embarque-form');
    }
}
