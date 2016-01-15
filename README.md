ESNBundle
===================

This bundle will help your project with Galaxy CAS authentification and Galaxy Roles management.

Installation
------------

Install the bundle:

    composer require "esn/esnbundle" 1.0.x-dev

Register the bundle in `app/AppKernel.php`:

``` php
<?php
// app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new Esn\EsnBundle\EsnEsnBundle(),
    );
}
```
