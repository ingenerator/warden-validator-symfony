This provides the default validation interface for [ingenerator/warden-core], based on
symfony validator.

**Warden is under heavy development and not recommended for production use outwith inGenerator.**

[![Build Status](https://travis-ci.org/ingenerator/warden-validator-symfony.svg?branch=0.1.x)](https://travis-ci.org/ingenerator/warden-validator-symfony)


# Installing warden-validator-symfony

This isn't in packagist yet : you'll need to add our package repository to your composer.json:

```json
{
  "repositories": [
    {"type": "composer", "url": "https://php-packages.ingenerator.com"}
  ]
}
```

`$> composer require ingenerator/warden-validator-symfony`

To use annotation-based validation mapping (which is defined by default in the warden
base entities) you will need to also require `doctrine/annotations` and configure this 
in your validation builder.

Alternatively, you can define yaml or other validation mapping and register that as 
required.

# Contributing

Contributions are welcome but please contact us before you start work on anything to check your
plans line up with our thinking and future roadmap. 

# Contributors

This package has been sponsored by [inGenerator Ltd](http://www.ingenerator.com)

* Andrew Coulton [acoulton](https://github.com/acoulton) - Lead developer

# Licence

Licensed under the [BSD-3-Clause Licence](LICENSE)
