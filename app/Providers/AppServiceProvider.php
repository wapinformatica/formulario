<?php

// app/Providers/AppServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator; // Importe a facade Validator

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Validação de CPF
        Validator::extend('cpf', function ($attribute, $value, $parameters, $validator) {
            return $this->isValidCpf($value);
        });

        // Validação de telefone fixo (##) ####-####
        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\(\d{2}\) \d{4}-\d{4}$/', $value);
        });

        // Validação de celular (##) #####-####
        Validator::extend('cellphone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^\(\d{2}\) \d{5}-\d{4}$/', $value);
        });
    }

    public function register()
    {
        //
    }

    /**
     * Valida CPF
     */
    private function isValidCpf($cpf): bool
    {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}