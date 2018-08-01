<?php 
namespace App\GraphQL\Type\Voucher;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
Use App\GraphQL\Type\User\User;
use GraphQL;
/**
 * User Type
 */
class VoucherType extends GraphQLType
{
	
	protected $attributes = [
		'name' => 'VoucherType',
		'description' => 'Voucher'
	];
	public function fields()
	{
		return [
			'id' => [
				'type' => Type::int(),
				'description' => 'ID Voucher'
			],
			'kode' => [
				'type' => Type::string(),
				'description' => 'Kode Voucher'
			],
			'jenis' => [
				'type' => Type::string(),
				'description' => 'Jenis Voucher'
			],
			'syarat' => [
				'type' => Type::string(),
				'description' => 'syarat Voucher'
			],
			'tanggal_kadaluarsa' => [
				'type' => Type::string(),
				'description' => 'tanggal_kadaluarsa Voucher'
			]
			,
			'owner_id' => [
				'args' => [
					'id' =>[
						'type' => Type::string(),
						'description' => 'foreign Voucher id di table kepemilikan',
					],
				],

				'type' => Type::listOf(GraphQL::type('User')),
				'description' => 'foreign Voucher id di table kepemilikan',

				'resolve' =>function($root,$args){
					if(isset($args['id'])){
						return $root->owner->where('owner_id',$args['id']);
					}
					return $root->owner;
				}
			]
		];
	}
}