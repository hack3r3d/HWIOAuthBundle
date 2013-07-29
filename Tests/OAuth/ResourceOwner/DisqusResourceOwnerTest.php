<?php

/*
 * This file is part of the HWIOAuthBundle package.
 *
 * (c) Hardware.Info <opensource@hardware.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HWI\Bundle\OAuthBundle\Tests\OAuth\ResourceOwner;

use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\DisqusResourceOwner;

class DisqusResourceOwnerTest extends GenericOAuth2ResourceOwnerTest
{
    protected $userResponse = <<<json
{
    "response": {
        "id": "1",
        "username": "bar",
        "name": "foo"
    }
}
json;
    protected $paths = array(
        'identifier' => 'response.id',
        'nickname'   => 'response.username',
        'realname'   => 'response.name',
    );

    protected function setUpResourceOwner($name, $httpUtils, array $options)
    {
        $options = array_merge(
            array(
                'authorization_url'   => 'https://disqus.com/api/oauth/2.0/authorize/',
                'access_token_url'    => 'https://disqus.com/api/oauth/2.0/access_token/',
                'infos_url'           => 'https://disqus.com/api/3.0/users/details.json',
            ),
            $options
        );

        return new DisqusResourceOwner($this->buzzClient, $httpUtils, $options, $name, $this->storage);
    }
}
