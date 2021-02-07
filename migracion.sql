CREATE SCHEMA editor_db;

CREATE TABLE editor_db.categories ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	description          varchar(300)   DEFAULT 'descripcion de la categoria'   ,
	image                text      ,
	name                 varchar(150)      
 );

ALTER TABLE editor_db.categories MODIFY image text     COMMENT 'svg M path';

CREATE TABLE editor_db.clients ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	first_name           varchar(200)  NOT NULL    ,
	last_name            varchar(100)  NOT NULL    ,
	address              varchar(100)  NOT NULL    ,
	phone                varchar(15)  NOT NULL    ,
	email                varchar(200)      ,
	city                 varchar(100)  NOT NULL    ,
	country              varchar(50)  NOT NULL    
 );

CREATE TABLE editor_db.coupons ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	name                 varchar(100)  NOT NULL    ,
	description          varchar(400)      ,
	total                int  NOT NULL    ,
	avaliables           int  NOT NULL    ,
	discount             int  NOT NULL    ,
	code                 varchar(20)  NOT NULL    
 );

CREATE TABLE editor_db.subcategories ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	name                 varchar(100)      ,
	image                tinytext      ,
	category_id          int UNSIGNED NOT NULL    ,
	description          text      ,
	CONSTRAINT fk_subcategories_categories FOREIGN KEY ( category_id ) REFERENCES editor_db.categories( id ) ON DELETE CASCADE ON UPDATE RESTRICT
 );

CREATE INDEX fk_subcategories_categories ON editor_db.subcategories ( category_id );

CREATE TABLE editor_db.transporters ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	name                 varchar(150)      ,
	phone_number         varchar(20)  NOT NULL    ,
	email                varchar(200)      ,
	identification_number varchar(20)  NOT NULL    
 );

CREATE TABLE editor_db.variations ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	variation            int      ,
	stock                int UNSIGNED     ,
	sold                 int      ,
	images               longtext      ,
	price                int UNSIGNED NOT NULL    ,
	final_price          int      
 );

ALTER TABLE editor_db.variations MODIFY variation int     COMMENT 'Rojo,verde, grande';

ALTER TABLE editor_db.variations MODIFY stock int UNSIGNED    COMMENT 'sold';

ALTER TABLE editor_db.variations MODIFY images longtext     COMMENT 'Json with relative image paths';

CREATE TABLE editor_db.atributes ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	atribute             varchar(100)      ,
	variation_id         int UNSIGNED NOT NULL    ,
	CONSTRAINT fk_atributes_variations FOREIGN KEY ( variation_id ) REFERENCES editor_db.variations( id ) ON DELETE CASCADE ON UPDATE RESTRICT
 );

CREATE INDEX fk_atributes_variations ON editor_db.atributes ( variation_id );

CREATE TABLE editor_db.products ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	name                 varchar(100)      ,
	price                varchar(100)      ,
	discount             int      ,
	description          longtext      ,
	reference            varchar(100)      ,
	subcategory_id       int UNSIGNED NOT NULL    ,
	short_description    varchar(300)      ,
	images               longtext      ,
	look_for_stock       boolean  NOT NULL DEFAULT true   ,
	product_type         enum('simple','variable')  NOT NULL DEFAULT 'simple'   ,
	stock                int      ,
	CONSTRAINT fk_products_subcategories FOREIGN KEY ( subcategory_id ) REFERENCES editor_db.subcategories( id ) ON DELETE CASCADE ON UPDATE RESTRICT
 );

CREATE INDEX fk_products_subcategories ON editor_db.products ( subcategory_id );

CREATE TABLE editor_db.shippings ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	name                 varchar(50)      ,
	price                int UNSIGNED NOT NULL DEFAULT 0   ,
	transporter_id       int UNSIGNED NOT NULL    ,
	CONSTRAINT fk_shipping_transporter FOREIGN KEY ( transporter_id ) REFERENCES editor_db.transporters( id ) ON DELETE CASCADE ON UPDATE RESTRICT
 );

CREATE INDEX fk_shipping_transporter ON editor_db.shippings ( transporter_id );

CREATE TABLE editor_db.atribute_product ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	product_id           int UNSIGNED NOT NULL    ,
	atribute_id          int UNSIGNED NOT NULL    ,
	CONSTRAINT fk_caracteristics_products_atributes FOREIGN KEY ( atribute_id ) REFERENCES editor_db.atributes( id ) ON DELETE CASCADE ON UPDATE RESTRICT,
	CONSTRAINT fk_caracteristics_products_products FOREIGN KEY ( product_id ) REFERENCES editor_db.products( id ) ON DELETE CASCADE ON UPDATE RESTRICT
 );

CREATE INDEX fk_caracteristics_products_atributes ON editor_db.atribute_product ( atribute_id );

CREATE INDEX fk_caracteristics_products_products ON editor_db.atribute_product ( product_id );

CREATE TABLE editor_db.orders ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	client_id            int UNSIGNED NOT NULL    ,
	payment_method       enum('efectivo','pasarela')  NOT NULL    ,
	shipping_id          int UNSIGNED NOT NULL    ,
	final_price          int UNSIGNED NOT NULL    ,
	price                int UNSIGNED NOT NULL    ,
	discount             int UNSIGNED NOT NULL    ,
	coupon_id            int UNSIGNED     ,
	CONSTRAINT fk_purchase_clients FOREIGN KEY ( client_id ) REFERENCES editor_db.clients( id ) ON DELETE CASCADE ON UPDATE RESTRICT,
	CONSTRAINT fk_order_shipping FOREIGN KEY ( shipping_id ) REFERENCES editor_db.shippings( id ) ON DELETE CASCADE ON UPDATE RESTRICT,
	CONSTRAINT fk_order_coupons FOREIGN KEY ( coupon_id ) REFERENCES editor_db.coupons( id ) ON DELETE CASCADE ON UPDATE NO ACTION
 );

CREATE INDEX fk_order_cupons ON editor_db.orders ( coupon_id );

CREATE INDEX fk_order_shipping ON editor_db.orders ( shipping_id );

CREATE INDEX fk_purchase_clients ON editor_db.orders ( client_id );

ALTER TABLE editor_db.orders MODIFY final_price int UNSIGNED NOT NULL   COMMENT 'This includes coupons and discounts';

CREATE TABLE editor_db.transactions ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	status               enum('pending','canceled','aprobed')   DEFAULT 'pending'   ,
	amount               int      ,
	provider             varchar(200)      ,
	order_id             int UNSIGNED NOT NULL    ,
	CONSTRAINT fk_transaction_order FOREIGN KEY ( order_id ) REFERENCES editor_db.orders( id ) ON DELETE CASCADE ON UPDATE RESTRICT
 );

CREATE INDEX fk_transaction_order ON editor_db.transactions ( order_id );

ALTER TABLE editor_db.transactions MODIFY provider varchar(200)     COMMENT 'PSE,Tarjeta de credito, etc';

CREATE TABLE editor_db.order_product ( 
	id                   int UNSIGNED NOT NULL    PRIMARY KEY,
	order_id             int UNSIGNED NOT NULL    ,
	product_id           int UNSIGNED     ,
	variation_id         int UNSIGNED     ,
	CONSTRAINT fk_orders_products_order FOREIGN KEY ( order_id ) REFERENCES editor_db.orders( id ) ON DELETE CASCADE ON UPDATE RESTRICT,
	CONSTRAINT fk_orders_products_products FOREIGN KEY ( product_id ) REFERENCES editor_db.products( id ) ON DELETE CASCADE ON UPDATE RESTRICT,
	CONSTRAINT fk_orders_products_variations FOREIGN KEY ( variation_id ) REFERENCES editor_db.variations( id ) ON DELETE CASCADE ON UPDATE NO ACTION
 );

CREATE INDEX fk_orders_products_order ON editor_db.order_product ( order_id );

CREATE INDEX fk_orders_products_products ON editor_db.order_product ( product_id );
