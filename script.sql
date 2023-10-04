CREATE DATABASE IF NOT EXISTS transacciones;

CREATE TABLE bank (
    bank_id INT NOT NULL AUTO_INCREMENT,
    description_bank VARCHAR(255) NOT NULL,
    PRIMARY KEY (bank_id)
);

CREATE TABLE account_type (
    account_type_id INT NOT NULL AUTO_INCREMENT,
    description_type VARCHAR(255) NOT NULL,
    PRIMARY KEY (account_type_id)
);
/
CREATE TABLE transaction(
    CUS VARCHAR(255) NOT NULL,
    bank_send_id INT NOT NULL,
    bank_receives_id INT NOT NULL,
    account_root VARCHAR(255) NOT NULL,
    account_destination VARCHAR(255) NOT NULL,
    amount INT NOT NULL,
    transaction_date VARCHAR(255) NOT NULL,
    description_transaction VARCHAR(255) NOT NULL,
    account_type_send_id INT NOT NULL,
    account_type_receives_id INT NOT NULL,
    PRIMARY KEY (CUS),
    FOREIGN KEY (bank_send_id) REFERENCES bank(bank_id),
    FOREIGN KEY (bank_receives_id) REFERENCES bank(bank_id),
    FOREIGN KEY (account_type_send_id) REFERENCES account_type(account_type_id),
    FOREIGN KEY (account_type_receives_id) REFERENCES account_type(account_type_id)
);



-- Inserts datos banco y tipo de cuenta

INSERT INTO bank (description_bank) VALUES ('Banco Davivienda');
INSERT INTO bank (description_bank) VALUES ('Banco de Bogota');
INSERT INTO bank (description_bank) VALUES ('Av Villas');
INSERT INTO bank (description_bank) VALUES ('Banco de Occidente');
INSERT INTO bank (description_bank) VALUES ('Bancolombia');


INSERT INTO account_type (description_type) VALUES ('Ahorros');
INSERT INTO account_type (description_type) VALUES ('Corriente');