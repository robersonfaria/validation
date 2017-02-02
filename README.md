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

Publique o arquivo de configuração(no momento tem somente as mensagens de erros separadas por liguagem)

```bash
php artisan vendo:publish --provider="RobersonFaria\Validation\ValidationServiceProvider"
```

##Uso

Para usar basta adicionar o nome da validação que deseja como regra:

```php
$this->validate($request, [
    "field-name" => "cns"
]);
```

##Mensagens de erro

As mensagens podem ser customizadas alterando o arquivo `config/custom-validation.php` o conteúdo padrão é o seguinte:

```php
<?php
return [
    'pt-BR' => [
        'cns' => 'O campo :attribute é inválido.',
        'cnpj' => 'O campo :attribute é inválido.',
        'cpf' => 'O campo :attribute é inválido.',
        'cep_format' => 'O campo :attribute não possui um formato de cep válido',
    ],
    'en' => [
        'cns ' => 'The field :attribute is not valid',
        'cnpj ' => 'The field :attribute is not valid',
        'cpf' => 'The field :attribute is not valid',
        'cep_format' => 'The field :attribute does not have a valid zip format',
    ]
];
```
A linguagem para exibição da mensagem de erro será decidida a partir do parâmetro **_locale_** do arquivo `config/app.php`.

Ou ainda, se desejar, pode customizar a mensagem de erro em tempo de execução:

```php
$this->validate($request, [
    "field-name" => "cns"
],[
    "field-name.cns" => 'Mensagem customizada para o campo :attribute'
]);
```

##Validações

| validation | Sigla | Descrição |
|---|---|---|
| cns | CNS | Cartão Nacional de Saúde|
| cnpj | CNPJ | Cadastro Nacional da Pessoa Jurídica. |
| cpf | CPF | Cadastro de Pessoas Físicas. |
| cep_format | CEP Format | Validação do formato do CEP, não validará se o CEP é válido, pelo menos não inicialmente. |


##CHANGELOG
####1.0.0
Criação do pacote e implementação da validação do CNS - Cartão Nacional de Saúde

####1.0.1
Implementação das validações de CNPJ, CPF e formato de CEP.

####1.0.2
Adicionado merge do arquivo de configuração para quando tiver modificações.

####1.0.3
Correção de autoload no composer.json