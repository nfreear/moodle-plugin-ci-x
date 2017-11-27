
# moodle-plugin-ci-x

This tool is built on [moodle-plugin-ci][] and [moodle-coding-standard][].

It allows you to test your plugin on [Travis CI][] against the
Moodle coding standard, without each plugin source file needing
the regular [Moodle boilerplate comments][bp].

## Usage

Example `composer.json`, with a `test` script:
```js
{
  "name": "nfreear/moodle-local_example",
  "description": "An example plugin …",
  "type": "moodle-local",

  "require": {
    "php": ">=5.5.9",
    "composer/installers": "^1.4"
  },
  "require-dev": {
    "nfreear/moodle-plugin-ci-x": "^1.0-dev"
  },

  "scripts": {
    "write-ignore-xml": [
      "# ... echo '</libraries>' >> thirdpartylibs.xml"
    ],
    "ci-install": [
      "moodle-plugin-ci install",
      "phpcs --config-set installed_paths vendor/nfreear/moodle-plugin-ci-x/"
    ],
    "test": [
      "moodle-plugin-ci phplint .",
      "moodle-plugin-ci phpcpd .",
      "moodle-plugin-ci phpmd .",
      "moodle-plugin-ci codechecker -s moodle-no-bp .",
      "moodle-plugin-ci csslint .",
      "moodle-plugin-ci shifter .",
      "moodle-plugin-ci jshint .",
      "moodle-plugin-ci validate .",
      "moodle-plugin-ci phpunit . --coverage-text"
    ]
  }
}
```

Note, the relevant line in the `"test"` script above is:

```
moodle-plugin-ci codechecker -s moodle-no-bp .
```

Example `.travis.yml`:
```yaml
language: php

php: 7

git:
  depth: 8

before_install: nvm install v8

install: composer install

script: composer test
```

And, at the commandline / terminal, type:

```sh
composer install && composer ci-install
composer test
```

---
© Nick Freear.

[travis ci]: https://travis-ci.org/ "Continuous Integration (CI) service, Travis-CI"
[moodle-plugin-ci]: https://github.com/moodlerooms/moodle-plugin-ci
[moodle-coding-standard]: https://github.com/moodlerooms/moodle-coding-standard
[moodle-local_codechecker]: https://github.com/moodlehq/moodle-local_codechecker
[moodle-plugin-ci-io]: https://moodlerooms.github.io/moodle-plugin-ci/
[bp]: https://github.com/moodle/moodle/blob/master/version.php#L3-L16
  "Moodle boilerplate comments: '// This file is part of Moodle ...'"

[End]: //.
