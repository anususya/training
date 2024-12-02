SELECT
    p.product_name,
    p.units_in_stock
FROM
    products AS p
WHERE
    p.units_in_stock < (
        SELECT
            avg(od.quantity) AS avarage
        FROM
            order_details AS od
        GROUP BY
            product_id
        ORDER BY
            avarage
    LIMIT 1
    ) ORDER BY p.units_in_stock ;


SELECT
    o.customer_id,
    sum(o.freight)
FROM
    orders AS o
        JOIN (
        SELECT
            customer_id,
            avg(freight) AS avg_freight
        FROM
            orders
        GROUP BY
            customer_id) AS tab ON
        tab.customer_id = o.customer_id
WHERE
    shipped_date BETWEEN '1996-07-16' AND '1996-07-31'
  AND freight > avg_freight
GROUP BY
    o.customer_id
ORDER BY
    sum(o.freight);


SELECT
    o1.order_id,
    o1.ship_country,
    tbl.total
FROM
    orders o1
        JOIN (
        SELECT
            od.order_id,
            SUM(od.unit_price * od.quantity - od.unit_price * od.quantity * od.discount) AS total
        FROM
            order_details od
                JOIN orders o ON
                od.order_id = o.order_id
        WHERE
            o.order_date >= '1997-09-01'
        GROUP BY
            od.order_id
        ORDER BY
            total DESC) AS tbl ON
        tbl.order_id = o1.order_id
WHERE
    o1.ship_country IN ('Argentina' , 'Bolivia', 'Brazil', 'Chile', 'Colombia', 'Ecuador', 'Guyana', 'Paraguay',
                        'Peru', 'Suriname', 'Uruguay', 'Venezuela')
    LIMIT 3;

SELECT
    DISTINCT (od.product_id),
             p.product_name,
             od.quantity
FROM
    order_details od
        JOIN products p ON
        p.product_id = od.product_id
WHERE
    od.quantity = 10;


SELECT
    product_name
FROM
    products
WHERE
    product_id = ANY(
        SELECT
            product_id
        FROM
            order_details
        WHERE
            quantity = 10);