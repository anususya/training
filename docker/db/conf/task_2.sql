SELECT
    *
FROM
    orders
WHERE
    ship_country LIKE 'U%';


SELECT
    order_id,
    customer_id,
    ship_country,
    freight
FROM
    orders
WHERE
    ship_country LIKE 'N%'
ORDER BY
    freight DESC
    LIMIT 10;


SELECT
    first_name,
    last_name,
    home_phone,
    region
FROM
    employees
WHERE
    region IS NULL;


SELECT
    count(*)
FROM
    customers
WHERE
    region IS NOT NULL;


SELECT
    country,
    count(*) AS count
FROM
    suppliers
GROUP BY
    country
ORDER BY
    count DESC;


SELECT
    ship_country,
    sum(freight) AS summary
FROM
    orders
WHERE
    ship_region IS NOT NULL
GROUP BY
    ship_country
HAVING
    sum(freight) > 2750
ORDER BY
    summary DESC


SELECT
    country
FROM
    customers
UNION
SELECT
    country
FROM
    suppliers
ORDER BY
    country ;


SELECT
    country
FROM
    customers
INTERSECT
SELECT
    country
FROM
    suppliers
INTERSECT
SELECT
    country
FROM
    employees
ORDER BY
    country ;


SELECT
    country
FROM
    customers
INTERSECT
SELECT
    country
FROM
    suppliers
EXCEPT
SELECT
    country
FROM
    employees
ORDER BY
    country ;
