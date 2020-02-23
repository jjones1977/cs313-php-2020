CREATE TABLE pb_family
(
	id SERIAL NOT NULL PRIMARY KEY,
	surname VARCHAR(100) NOT NULL,
    notes text
);

CREATE TABLE pb_user
(
	id SERIAL NOT NULL PRIMARY KEY,
	username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    displayname VARCHAR(100),
    adult BOOL,
    family_id INT NOT NULL REFERENCES pb_family(id)
);

CREATE TABLE pb_children
(
	id SERIAL NOT NULL PRIMARY KEY,
	family_id INT NOT NULL REFERENCES pb_family(id),
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    age INT,
    notes text
);

CREATE TABLE pb_transactions
(
	id SERIAL NOT NULL PRIMARY KEY,
	children_id INT NOT NULL REFERENCES pb_children(id),
    type_transaction VARCHAR(100),
    amount numeric(10,2),
    notes text
);