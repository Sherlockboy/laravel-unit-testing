
# PHPUnit example
### Task description

You have products database:

| Product code | Name         | Price  |
|--------------|--------------|--------|
| FR1          | Fruit Tea    | $3.11  |
| SR1          | Strawberries | $5.00  |
| CF1          | Coffee       | $11.23 |

1. CEO wants that if you buy at least one tea, next should be free.
2. CTO wants low prices, so that, if you buy 3 or more strawberries price should drop to $4.50.

Your code should be flexible, because CTO and CEO often changes the rules.

The service should look like this:
```
$ch = new Checkout($pricing_rules);
$co->scan($item1);
$co->scan($item2);
$price = $ch->total();
```

Implement a checkout system that fulfils these requirements.

### Test data

Basket: FR1,SR1,FR1,FR1,CF1  
Total price expected: $22.45

Basket: FR1,FR1  
Total price expected: $3.11

Basket: SR1,SR1,FR1,SR1  
Total price expected: $16.61
