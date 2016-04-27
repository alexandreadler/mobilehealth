<?php
/**
 * An helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace {
/**
 * Foto
 *
 * @property integer $id
 * @property integer $galerias_id
 * @property string $filename
 * @property integer $size
 * @property string $path
 * @property string $url
 * @property-read \Galeria $fotos
 * @method static \Illuminate\Database\Query\Builder|\Foto whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Foto whereGaleriasId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Foto whereFilename($value) 
 * @method static \Illuminate\Database\Query\Builder|\Foto whereSize($value) 
 * @method static \Illuminate\Database\Query\Builder|\Foto wherePath($value) 
 * @method static \Illuminate\Database\Query\Builder|\Foto whereUrl($value) 
 */
	class Foto {}
}

namespace {
/**
 * Carroceria
 *
 * @property integer $id
 * @property string $nome
 * @property string $descricao
 * @property-read \Illuminate\Database\Eloquent\Collection|\Veiculo[] $veiculos
 * @method static \Illuminate\Database\Query\Builder|\Carroceria whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Carroceria whereNome($value) 
 * @method static \Illuminate\Database\Query\Builder|\Carroceria whereDescricao($value) 
 */
	class Carroceria {}
}

namespace {
/**
 * Pais
 *
 * @property integer $id
 * @property string $sigla
 * @property string $nome
 * @method static \Illuminate\Database\Query\Builder|\Pais whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Pais whereSigla($value) 
 * @method static \Illuminate\Database\Query\Builder|\Pais whereNome($value) 
 */
	class Pais {}
}

namespace {
/**
 * Galeria
 *
 * @property integer $id
 * @property-read \Veiculo $veiculo
 * @property-read \Illuminate\Database\Eloquent\Collection|\Foto[] $fotos
 * @method static \Illuminate\Database\Query\Builder|\Galeria whereId($value) 
 */
	class Galeria {}
}

namespace {
/**
 * Tipo
 *
 * @property integer $id
 * @property string $nome
 * @property string $descricao
 * @property-read \Illuminate\Database\Eloquent\Collection|\Veiculo[] $veiculos
 * @method static \Illuminate\Database\Query\Builder|\Tipo whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Tipo whereNome($value) 
 * @method static \Illuminate\Database\Query\Builder|\Tipo whereDescricao($value) 
 */
	class Tipo {}
}

namespace {
/**
 * Membro
 *
 * @property integer $id
 * @property string $nome
 * @property string $cpf
 * @property string $logradouro
 * @property integer $numero
 * @property string $bairro
 * @property string $cep
 * @property string $telefone_fixo
 * @property string $celular
 * @property string $email
 * @property integer $banco
 * @property string $agencia
 * @property string $conta
 * @property integer $cidade_id
 * @property integer $estado_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Cidade $cidade
 * @property-read \Estado $estado
 * @property-read \Illuminate\Database\Eloquent\Collection|\Veiculo[] $veiculos
 * @method static \Illuminate\Database\Query\Builder|\Membro whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereNome($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereCpf($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereLogradouro($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereNumero($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereBairro($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereCep($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereTelefoneFixo($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereCelular($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereEmail($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereBanco($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereAgencia($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereConta($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereCidadeId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereEstadoId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereDeletedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Membro whereUpdatedAt($value) 
 */
	class Membro {}
}

namespace {
/**
 * Estado
 *
 * @property integer $id
 * @property integer $pais_id
 * @property string $sigla
 * @property string $nome
 * @property-read \Illuminate\Database\Eloquent\Collection|\Membro[] $cidadaos
 * @method static \Illuminate\Database\Query\Builder|\Estado whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Estado wherePaisId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Estado whereSigla($value) 
 * @method static \Illuminate\Database\Query\Builder|\Estado whereNome($value) 
 */
	class Estado {}
}

namespace {
/**
 * Banco
 *
 * @property integer $id
 * @property string $cod
 * @property string $nome
 * @method static \Illuminate\Database\Query\Builder|\Banco whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Banco whereCod($value) 
 * @method static \Illuminate\Database\Query\Builder|\Banco whereNome($value) 
 */
	class Banco {}
}

namespace {
/**
 * Usuario
 *
 * @property integer $id
 * @property string $login
 * @property string $senha
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereLogin($value) 
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereSenha($value) 
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereUpdatedAt($value) 
 */
	class Usuario {}
}

namespace {
/**
 * User
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $confirmation_code
 * @property string $remember_token
 * @property boolean $confirmed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\User whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereUsername($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereEmail($value) 
 * @method static \Illuminate\Database\Query\Builder|\User wherePassword($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereConfirmationCode($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereRememberToken($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereConfirmed($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\User whereUpdatedAt($value) 
 */
	class User {}
}

namespace {
/**
 * Cidade
 *
 * @property integer $id
 * @property integer $estado_id
 * @property string $nome
 * @property-read \Illuminate\Database\Eloquent\Collection|\Membro[] $cidadaos
 * @method static \Illuminate\Database\Query\Builder|\Cidade whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Cidade whereEstadoId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Cidade whereNome($value) 
 */
	class Cidade {}
}

namespace {
/**
 * Cor
 *
 * @property integer $id
 * @property string $nome
 * @property-read \Illuminate\Database\Eloquent\Collection|\Veiculo[] $veiculos
 * @method static \Illuminate\Database\Query\Builder|\Cor whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Cor whereNome($value) 
 */
	class Cor {}
}

namespace {
/**
 * Veiculo
 *
 * @property integer $id
 * @property integer $membro_id
 * @property integer $carroceria_id
 * @property integer $galeria_id
 * @property integer $tipo_id
 * @property string $placa
 * @property string $ano
 * @property integer $cor_id
 * @property string $documento
 * @property string $emissao_documento
 * @property string $renavam
 * @property float $valor
 * @property float $mensalidade
 * @property integer $cotas
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Membro $dono
 * @property-read \Cor $cor
 * @property-read \Carroceria $carroceria
 * @property-read \Tipo $tipo
 * @property-read \Galeria $galeria
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereMembroId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereCarroceriaId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereGaleriaId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereTipoId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo wherePlaca($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereAno($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereCorId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereDocumento($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereEmissaoDocumento($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereRenavam($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereValor($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereMensalidade($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereCotas($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereDeletedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Veiculo whereUpdatedAt($value) 
 */
	class Veiculo {}
}

