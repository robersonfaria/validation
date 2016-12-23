#Laravel Custom Validation

Pacote Laravel para validações comuns ao Brasil(pt-BR) tipo: CNPJ,CPF,CEP,CNS

##Instalação

Instale a dependencia com o seguinte comando

```bash
composer require robersonfaria/validation
```

Configure o sua aplicação adicionando o seguinte provider:

config/app.php
```php
'providers' => [
    ...
    RobersonFaria\Validation\ValidationServiceProvider::class,
]
```

##Uso

Para usar basta adicionar o nome da validação que deseja como regra:

```php
$this->validate($request, [
    'field-name' => 'cns'
]);
```

##Validações

###Implementadas

| validation | Sigla | Descrição |
|---|---|---|
| cns | CNS | Cartão Nacional de Saúde|

###Em breve

| validation | Sigla | Descrição |
|---|---|---|
| cnpj | CNPJ | Cadastro Nacional da Pessoa Jurídica. |
| cpf | CPF | Cadastro de Pessoas Físicas. |
| cep_format | CEP Format | Validação do formato do CEP, não validará se o CEP é válido, pelo menos não inicialmente. |

##CHANGELOG
####1.0.0
Criação do pacote e implementação da validação do CNS - Cartão Nacional de Saúde