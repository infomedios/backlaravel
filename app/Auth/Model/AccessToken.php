<?php

namespace App\Auth\Model;

use App\Models\User;
use Laravel\Passport\Bridge\AccessToken as PassportAccessToken;
use Lcobucci\JWT\Token\Builder;
use League\OAuth2\Server\CryptKey;
use DateTimeImmutable; 
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class AccessToken extends PassportAccessToken
{

    private $privateKey;
    
    public function convertToJWT(CryptKey $privateKey)
    {   
        $now = new DateTimeImmutable();
        $config = Configuration::forSymmetricSigner(new Sha256(), InMemory::plainText('testing'));

        $builder = $config->builder();
        $user = User::find($this->getUserIdentifier());
        $builder->permittedFor($this->getClient()->getIdentifier())
            ->identifiedBy($this->getIdentifier(), true)
            ->issuedAt(new DateTimeImmutable())
            ->canOnlyBeUsedAfter(new DateTimeImmutable())
            ->expiresAt($now->modify('+1 hour'))
            ->relatedTo($this->getUserIdentifier())
            ->withClaim('scopes', [])
            ->withClaim('id', $user->id)
            ->withClaim('name', $user->name)
            ->withClaim('email', $user->email);
        return $builder
            ->getToken($config->signer(), $config->signingKey());
    }

    public function setPrivateKey(CryptKey $privateKey)
    {
        $this->privateKey = $privateKey;
    }

    public function __toString()
    {
        return $this->convertToJWT($this->privateKey)->toString();
    }

}