# BFOP Assert

This library contains efficient functions (assertions/validations) to test the input and output of your methods.
With these functions, you can greatly reduce the amount of coding needed to write a safe implementation.

All assertions in the Assert class throw an BFOP\Assert\InvalidArgumentException if they fail.

FAQ
---

**What's the difference to [webmozart/assert]?**

This library is heavily inspired by Bernhard Schussek's wonderful [assert package],
but introduces the following points.

- possibility of validation without throwing exception.
- possibility of combining validations/assertions: NOT, AND, OR operations.

At first, I tried to inspire the change necessary to implement those points above in the webmozart/asset
(https://github.com/webmozarts/assert/issues/129). I don't see the maintainers changing the lib to support those points.
Moreover, I might be not necessary as well as too many people raised those wishes.


Installation
------------

Use [Composer] to install the package:

```bash
composer require brfop/assert
```

Validation Example
------------------

```php
use BRFOP\Assert\Valid;

class OrderController
{
    public function index(Request $request)
    {
        /// ...
        if (Valid::uuid($request->query->get('parent_id'))) {
            $parentId = $request->query_get('parent_id');
        }
        
        if(isset($parentId)){
            $query->where('parent_id = :parent_id')->setParameter('parent_id', $parentId);
        }
    }
}
```

With the Valid class you can use the same validations in the Assert classe, but the methods will return `true`
if the validation passes and `false` if not.


Assertion Example
-----------------

```php
use BRFOP\Assert\Assert;

class Employee
{
    public function __construct($id)
    {
        Assert::integer($id, 'The employee ID must be an integer. Got: %s');
        Assert::greaterThan($id, 0, 'The employee ID must be a positive integer. Got: %s');
    }
}
```

If you create an employee with an invalid ID, an exception is thrown:

```php
new Employee('foobar');
// => BRFOP\Assert\InvalidArgumentException:
//    The employee ID must be an integer. Got: string

new Employee(-10);
// => BRFOP\Assert\InvalidArgumentException:
//    The employee ID must be a positive integer. Got: -10
```


## Support AND, OR and NOT

```php title="Simple OR example"
$value = 'ANOTHER VALUE';
$valid = Valid::or($value, [ValidC::integer(), ValidC::eq('NOT FOUND')]); // $valid = false, DON'T throw exception
Assert::or($value, [ValidC::integer(), ValidC::eq('NOT FOUND')]); // throws exception
```

```php title="More complex OR example"
$value = 'ANOTHER VALUE';
$valid = Valid::or($value, []); // $valid = false, DON'T throw exception
$valid = Valid::or($value, [ValidC::eq('wrong value'), ValidC::or([ValidC::integer(), ValidC::eq('another value')])]); // $valid = false, DON'T throw exception
Assert::or($value, [ValidC::integer(), ValidC::eq('NOT FOUND')]); // throws exception
```

Assert

23/out/2024

estou agora avaliando a melhor maneira de implementar 

Valid::all();
Assert::all();

Talvez o seguinte?

Valid::all($value, [Valid::string(...), ValidCallable::eq('test value')])

Referencias

- https://github.com/webmozarts/assert/issues/129
- https://github.com/webmozarts/assert/issues/182
- https://github.com/webmozarts/assert/issues/173
- https://github.com/BackEndTea/Assert


