ZF2-ApiRest
======================

Simple Example Api Rest with Zend Framework 2 and Doctrine 2

## Install with Composer

```
    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar install
```

## Getting with Curl

```
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/course
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/course/:id
    $ curl -H 'content-type: application/json' -v -X POST -d '{"name":"test","description":"test"}' http://127.0.0.1:8000/api/course
    $ curl -H 'content-type: application/json' -v -X PUT -d '{"name":"test","description":"test"}' http://127.0.0.1:8000/api/course/:id
    $ curl -H 'content-type: application/json' -v -X DELETE http://127.0.0.1:8000/api/course/:id
```
