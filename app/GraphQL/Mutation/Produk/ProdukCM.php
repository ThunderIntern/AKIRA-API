<?php

namespace App\GraphQL\Mutation\Produk;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Produk\Models\Produk;

class ProdukCM extends Mutation
{
    protected $attributes = [
        'name' => 'ProdukCM',
        'description' => 'A mutation'
    ];

    public function type()
    {
        return GraphQL::type('ProdukT'); 
    }

    public function args()
    {
        return [
            'nama' => ['id'=> 'nama', 'type' => Type::nonNull(Type::string())],
            'kode' => ['name'=> 'kode', 'type' => Type::nonNull(Type::string())],
            'waktu' => ['name'=> 'waktu', 'type' => Type::nonNull(Type::int())],
            'harga' => ['name'=> 'harga', 'type' => Type::nonNull(Type::int())],
            'deskripsi' => ['name'=> 'deskripsi', 'type' => Type::nonNull(Type::string())],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $produk = new Produk;
        $produk->fill($args);
        $produk->save();

        return $produk;
    }
}
