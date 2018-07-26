<?php

namespace App\GraphQL\Type\Terapis;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as BaseType;
use GraphQL;

class TerapisT extends BaseType
{
    protected $attributes = [
        'name' => 'TerapisT',
        'description' => 'A type'
    ];

    public function fields()
    {
         return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
            'nama' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'rating' => [
                'type' => Type::nonNull(Type::float()),
            ],
            'status' => [
                'type' => Type::nonNull(Type::string()),
            ]
        ];
    }

    protected function resolveStatusField($root, $args)
    {
        if($root->status){
            return "Tersedia";
        }else{
            return "Tidak Tersedia";
        }
    }
}
