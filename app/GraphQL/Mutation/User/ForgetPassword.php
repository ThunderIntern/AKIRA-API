<?php

namespace App\GraphQL\Mutation\User;

use Folklore\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Thunderlabid\Otorisasi\Models\User;

class ForgetPassword extends Mutation
{
    protected $attributes = [
        'name' => 'ForgetPassword',
        'description' => 'A mutation'
    ];
    
    public function type()
    {
        return GraphQL::type('User');
    }
    
    public function args()
    {
        return [
            'id'            => ['name' => 'id',       'type' => Type::nonNull(Type::int())],
            'new_password'      => ['name' => 'new_password',       'type' => Type::nonNull(Type::string())]
        ];
    }
    
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = User::find($args['id']);        
        $user->password = app('hash')->make($args['new_password']);
        $user->save();

        return $user;
    }
}
