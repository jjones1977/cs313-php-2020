CREATE TABLE pb_family
(
	id SERIAL NOT NULL PRIMARY KEY,
	surname VARCHAR(100) NOT NULL,
	notes TEXT
);

CREATE TABLE pb_children
(
	id SERIAL NOT NULL PRIMARY KEY,
	family_id INT NOT NULL REFERENCES pb_family(id),
	first_name VARCHAR(100) NOT NULL,
	last_name VARCHAR(100),
	age INT,
	notes TEXT
);

CREATE TABLE pb_transactions
(
	id SERIAL NOT NULL PRIMARY KEY,
	children_id INT NOT NULL REFERENCES pb_children(id),
	type_transaction VARCHAR(100),
	amount NUMERIC (10, 2),
	notes TEXT
);