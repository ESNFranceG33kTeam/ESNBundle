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

Configuration :

``` yaml
# app/config/config.yml
esn:
    host: %cas_host%
    port: %cas_port%
    context: %cas_context%
```

Add the parameters to use for a proper galaxy authentification : 

``` yaml
# app/config/parameters.yml
cas_host: 
cas_port:
cas_context: 
```

Enable CURL in your apache :

``` shell
sudo apt-get install php5-curl
```
