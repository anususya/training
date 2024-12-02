EXPLAIN ANALYZE SELECT *
                FROM products
                WHERE units_in_stock < 10;

CREATE INDEX units_in_stock_idx ON products(units_in_stock);

EXPLAIN ANALYZE SELECT *
                FROM products
                WHERE units_in_stock < 10;


EXPLAIN ANALYZE SELECT *
                FROM products
                WHERE product_name = 'sit';

CREATE INDEX product_name_idx_hash_index ON products USING HASH (product_name);

EXPLAIN ANALYZE SELECT *
                FROM products
                WHERE product_name = 'sit';


EXPLAIN ANALYZE SELECT *
                FROM products
                WHERE discontinued = 1 AND reorder_level = 25;

CREATE INDEX discontinued_reorder_idx ON products (discontinued, reorder_level);

EXPLAIN ANALYZE SELECT *
                FROM products
                WHERE discontinued = 1 AND reorder_level = 25;
