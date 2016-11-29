<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "Le champ :attribute doit être accepté.",
	"active_url"           => "Le champ :attribute n'est pas une URL valide.",
	"after"                => "Le champ :attribute doit être une date après :date.",
	"alpha"                => "Le champ :attribute ne peut contenir que des lettres.",
	"alpha_dash"           => "Le champ :attribute ne peut contenir des lettres, des chiffres ou des tirets.",
	"alpha_num"            => "Le champ :attribute ne peut contenir que des lettres ou des chiffres.",
	"array"                => "Le champ :attribute doit être un tableau.",
	"before"               => "Le champ :attribute doit être une date avant :date.",
	"between"              => [
		"numeric" => "Le champ :attribute doit être compris entre :min et :max.",
		"file"    => "Le champ :attribute doit peser entre :min et :max kilo-octets.",
		"string"  => "Le champ :attribute doit comprendre entre :min et :max caractères.",
		"array"   => "Le champ :attribute doit contenir entre :min et :max éléments.",
	],
	"boolean"              => "Le champ :attribute ne peut être que vrai ou faux.",
	"confirmed"            => "La confirmation du champ :attribute ne correspond pas.",
	"date"                 => "Le champ :attribute n'est pas une date valide.",
	"date_format"          => "Le champ :attribute ne correspond pas au format :format.",
	"different"            => "Les champs :attribute et :other doivent être different.",
	"digits"               => "Le champ :attribute doit être :digits chiffres.",
	"digits_between"       => "Le champ :attribute doit être un chiffre entre :min et :max .",
	"email"                => "Le champ :attribute doit être une adresse email valide.",
	"filled"               => "Le champ :attribute est requis.",
	"exists"               => "Le champ selected :attribute est invalide.",
	"image"                => "Le champ :attribute doit être une image.",
	"in"                   => "Le champ selected :attribute est invalide.",
	"integer"              => "Le champ :attribute doit être un entier.",
	"ip"                   => "Le champ :attribute doit être une adresse IP valide.",
	"max"                  => [
		"numeric" => "Le champ :attribute ne pourra être supérieur à :max.",
		"file"    => "Le champ :attribute ne pourra être supérieur à :max kilo-octets.",
		"string"  => "Le champ :attribute ne pourra être supérieur à :max caractères.",
		"array"   => "Le champ :attribute ne peut pas avoir plus de :max éléments.",
	],
	"mimes"                => "Le champ :attribute doit être a file of type: :values.",
	"min"                  => [
		"numeric" => "Le champ :attribute doit être au moins supérieur ou égal à :min.",
		"file"    => "Le champ :attribute doit peser au moins :min kilo-octets.",
		"string"  => "Le champ :attribute doit comprendre au moins :min caractères.",
		"array"   => "Le champ :attribute doit contenir au moins :min éléments.",
	],
	"not_in"               => "Le champ :attribute est invalids.",
	"numeric"              => "Le champ :attribute doit être un nombre.",
	"regex"                => "Le champ :attribute a un format invalide.",
	"required"             => "Le champ :attribute est requis.",
	"required_if"          => "Le champ :attribute est requis lorsque :other est :value.",
	"required_with"        => "Le champ :attribute est requis lorsque :values est présent.",
	"required_with_all"    => "Le champ :attribute est requis lorsque :values est présent.",
	"required_without"     => "Le champ :attribute est requis lorsque :values n'est pas présent.",
	"required_without_all" => "Le champ :attribute est requis lorsque aucun :values n'est présent.",
	"same"                 => "Les champs :attribute et :other doivent correspondre.",
	"size"                 => [
		"numeric" => "Le champ :attribute doit être de :size.",
		"file"    => "Le champ :attribute doit peser :size kilo-octets.",
		"string"  => "Le champ :attribute doit comprendre :size caractères.",
		"array"   => "Le champ :attribute doit contenir :size éléments.",
	],
	"unique"               => "Le champ :attribute est déjà pris.",
	"url"                  => "Le champ :attribute format est invalide.",
	"timezone"             => "Le champ :attribute doit être une timezone valide.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
