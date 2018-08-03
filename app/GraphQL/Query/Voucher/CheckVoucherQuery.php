<?php 
namespace App\GraphQL\Query\Voucher;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Thunderlabid\Voucher\Models\Voucher;
use App\Events\CheckVoucherEvent;
/**
 * User Query
 */
class CheckVoucherQuery extends Query
{
	
	protected $attributes = [
		'name' => 'Voucher'
	];
	public function type()
	{
		return GraphQL::type('CheckVoucherType');
	}
	public function args()
	{
		return [
			'kode' => ['name' => 'kode', 'type' => Type::string()],
			'jumlah' => ['name' => 'jumlah', 'type' => Type::int()],
			];
	}
	public function resolve($root, $args){
		$event = event(new CheckVoucherEvent($args['kode']));
		// dd($event[0]);
		if($event){
			return ['kode'=>'','jumlah'=>$event[0]];
		}else
		{
			dd('false');
		}
			
			
		
	}
}