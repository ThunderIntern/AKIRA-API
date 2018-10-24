<?php 
namespace App\GraphQL\Mutation\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Thunderlabid\Voucher\Models\Voucher;
use Illuminate\Support\Facades\DB;
/**
* User Query
*/
class UpdateVoucher extends Mutation
{
	
	protected $attributes = [
		'name' => 'UpdateVoucher'
	];
	public function type()
	{
		return GraphQL::type('VoucherType');
	}
	public function args()
	{
		return [
			'id' => ['name' => 'id', 'type' => Type::int()],
			'kode' => ['name' => 'kode', 'type' => Type::string()],
			'jenis' => ['name' => 'jenis', 'type' => Type::string()],
			'jumlah' => ['name' => 'jumlah', 'type' => Type::int()],
			'syarat' => ['name' => 'syarat', 'type' => Type::string()],
			'tanggal_kadaluarsa' => ['name' => 'tanggal_kadaluarsa', 'type' => Type::string()],
			'logo_voucher' => ['name' => 'logo_voucher', 'type' => Type::string()],
		];
	}
	public function resolve($root, $args)
	{
		$voucher = Voucher::findOrFail($args['id']);
		try{
			DB::BeginTransaction();
			isset($args['kode'])?$voucher->kode = $args['kode']:'';
			isset($args['jenis'])?$voucher->jenis = $args['jenis']:'';
			isset($args['jumlah'])?$voucher->jumlah = $args['jumlah']:'';
			isset($args['syarat'])?$voucher->syarat = $args['syarat']:'';
			isset($args['tanggal_kadaluarsa'])?$voucher->tanggal_kadaluarsa = $args['tanggal_kadaluarsa']:'';
			isset($args['logo_voucher'])?$voucher->logo_voucher = $args['logo_voucher']:'';
			$voucher->save();
			DB::Commit(); 
			return $voucher; 
		}catch(Exception $e){
			DB::Rollback();
		}
	}
}