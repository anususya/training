SELECT
    customers.company_name,
    employees.last_name,
    employees.first_name,
    employees.city,
    shippers.company_name
FROM
    orders
        JOIN customers ON
        orders.customer_id = customers.customer_id
        JOIN employees ON
        orders.employee_id = employees.employee_id
        JOIN shippers ON
        orders.ship_via = shippers.shipper_id
WHERE
    customers.city = 'London'
  AND employees.city = 'London'
  AND shippers.company_name = 'Speedy Express';


SELECT
    p.product_name,
    p.units_in_stock,
    p.discontinued,
    c.category_name ,
    s.contact_name,
    s.phone
FROM
    products AS p
        JOIN categories AS c ON
        p.category_id = c.category_id
        JOIN suppliers AS s ON
        p.supplier_id = s.supplier_id
WHERE
    p.discontinued = 1
  AND c.category_name IN ('Beverages', 'Seafood')
  AND p.units_in_stock < 20;


SELECT
    c.contact_name,
    o.order_id
FROM
    orders AS o
        RIGHT JOIN customers AS c ON
        o.customer_id = c.customer_id
WHERE
    o.order_id IS NULL;

SELECT
    c.contact_name,
    o.order_id
FROM
    customers AS c
        LEFT JOIN orders AS o ON
        o.customer_id = c.customer_id
WHERE
    o.order_id IS NULL;