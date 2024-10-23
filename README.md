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
