DROP DATABASE IF EXISTS task1 WITH (FORCE);
CREATE DATABASE task1;

\c task1

CREATE TABLE regions (
	region_id serial,
	region_name varchar NOT NULL
);

CREATE TABLE factories (
	factory_id serial,
	factory_name varchar NOT NULL ,
	region_id int NOT NULL
);

CREATE TABLE machines (
	machine_id serial,
	machine_name varchar NOT NULL ,
	factory_id int NOT NULL
);

CREATE TABLE products (
	product_id serial,
	item_id int NOT NULL ,
	product_name varchar NOT NULL ,
	packaging_id int NOT NULL
);

CREATE TABLE factories_products (
    product_id int NOT NULL,
    factory_id int NOT NULL,

    CONSTRAINT product_factory_pkey PRIMARY KEY (product_id, factory_id)
);

CREATE TABLE machines_products (
    product_id int NOT NULL,
    machine_id int NOT NULL,

    CONSTRAINT product_machine_pkey PRIMARY KEY (product_id, machine_id)
);

CREATE TABLE orders (
	order_id serial,
	factory_id int NOT NULL ,
	date timestamp NOT NULL
);

CREATE TABLE delivery_cost (
	delivery_cost_id serial,
	order_id int NOT NULL ,
	quantity int NOT NULL ,
	price_per_unit decimal NOT NULL ,
	total_amount decimal NOT NULL
);

CREATE TABLE order_items (
	order_item_id serial,
	item_id int NOT NULL ,
	order_id int NOT NULL ,
	date timestamp NOT NULL ,
	type varchar,
	quantity int NOT NULL ,
	unit_measure decimal,
	price_per_unit decimal,
	cost_per_unit decimal,
	total_amount decimal NOT NULL
);

CREATE TABLE dates (
	date date NOT NULL,
	week_day char,
	week int NOT NULL,
	month char,
	quarter char,
	year smallint
);

CREATE TABLE weekly_fix_cost (
	fix_cost_id serial,
	machine_id int NOT NULL ,
	week int NOT NULL ,
	fix_cost_description varchar,
	total_amount decimal NOT NULL ,
	region_id int NOT NULL
);

CREATE TABLE weekly_packaging_cost (
	packing_id serial,
	week int NOT NULL ,
	product_id int NOT NULL ,
	packaging_item varchar,
	unit_measure decimal,
	total_amount decimal NOT NULL
);


ALTER TABLE  regions ADD CONSTRAINT pk_regions PRIMARY KEY (region_id);

ALTER TABLE  factories ADD CONSTRAINT pk_factories PRIMARY KEY (factory_id);

ALTER TABLE  machines ADD CONSTRAINT pk_machines PRIMARY KEY (machine_id);

ALTER TABLE  products ADD CONSTRAINT pk_products PRIMARY KEY (product_id);

ALTER TABLE  orders ADD CONSTRAINT pk_orders PRIMARY KEY (order_id);

ALTER TABLE  delivery_cost ADD CONSTRAINT pk_delivery_cost PRIMARY KEY (delivery_cost_id);

ALTER TABLE  order_items ADD CONSTRAINT pk_order_item PRIMARY KEY (order_item_id);

ALTER TABLE  weekly_packaging_cost ADD CONSTRAINT pk_weekly_pack_cost PRIMARY KEY (packing_id);

ALTER TABLE  weekly_fix_cost ADD CONSTRAINT pk_weekly_fix_cost PRIMARY KEY (fix_cost_id);


ALTER TABLE  dates ADD CONSTRAINT u_week UNIQUE (week);

ALTER TABLE dates ADD CONSTRAINT u_date UNIQUE (date);


ALTER TABLE factories ADD CONSTRAINT fk_factories_regions FOREIGN KEY (region_id) REFERENCES regions;

ALTER TABLE machines ADD CONSTRAINT fk_machines_factories FOREIGN KEY (factory_id) REFERENCES factories;

ALTER TABLE machines_products ADD CONSTRAINT fk_machines_products FOREIGN KEY (machine_id) REFERENCES machines;

ALTER TABLE machines_products ADD CONSTRAINT fk_products_machines FOREIGN KEY (product_id) REFERENCES products;

ALTER TABLE factories_products ADD CONSTRAINT fk_factories_products FOREIGN KEY (factory_id) REFERENCES factories;

ALTER TABLE factories_products ADD CONSTRAINT fk_products_factories FOREIGN KEY (product_id) REFERENCES products;

ALTER TABLE orders ADD CONSTRAINT fk_orders_factories FOREIGN KEY (factory_id) REFERENCES factories;

ALTER TABLE orders ADD CONSTRAINT fk_orders_dates FOREIGN KEY (date) REFERENCES dates(date);

ALTER TABLE delivery_cost ADD CONSTRAINT fk_delivery_orders FOREIGN KEY (order_id) REFERENCES orders;

ALTER TABLE order_items ADD CONSTRAINT fk_order_items_orders FOREIGN KEY (order_id) REFERENCES orders;

ALTER TABLE order_items ADD CONSTRAINT fk_order_item_products FOREIGN KEY (item_id) REFERENCES products;

ALTER TABLE weekly_packaging_cost ADD CONSTRAINT fk_pack_week FOREIGN KEY (week) REFERENCES dates(week);

ALTER TABLE weekly_packaging_cost ADD CONSTRAINT fk_pack_product FOREIGN KEY (product_id) REFERENCES products;

ALTER TABLE weekly_fix_cost ADD CONSTRAINT fk_week_fix_machine FOREIGN KEY (machine_id) REFERENCES machines;

ALTER TABLE weekly_fix_cost ADD CONSTRAINT fk_week_fix_week FOREIGN KEY (week) REFERENCES dates(week);

ALTER TABLE weekly_fix_cost ADD CONSTRAINT fk_factories_regions FOREIGN KEY (region_id) REFERENCES regions;
