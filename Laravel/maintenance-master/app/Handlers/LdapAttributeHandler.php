<?php

namespace App\Handlers;

class LdapAttributeHandler extends Handler
{
    /**
     * Returns true to synchronize the `from_ad`
     * attribute on the users table.
     *
     * @return bool
     */
    public function fromAd()
    {
        return true;
    }
}
