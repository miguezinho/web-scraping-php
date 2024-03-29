CREATE TABLE extract_oneprovider.server_config (
	id INTEGER NOT NULL AUTO_INCREMENT,
    dc VARCHAR(30),
    code INTEGER NOT NULL,
    region VARCHAR(30),
    cpu_fabricante VARCHAR(30),
    cpu_familia VARCHAR(30),
    cpu_modelo VARCHAR(30),
    core INTEGER,
    thred INTEGER,
    frequency NUMERIC(4,2),    
    ram INTEGER,
    disk VARCHAR(70),
    disk_type VARCHAR(30),
    port VARCHAR(30),
    bandwidth VARCHAR(30),
    ddos BOOLEAN DEFAULT FALSE,
    price_conventional NUMERIC (15,2),
    price_promotional NUMERIC (15,2),
    currency VARCHAR(30),
    qty INTEGER DEFAULT 0,
    setup NUMERIC (15,2) DEFAULT 0.00,
    status VARCHAR(8) DEFAULT 'inactive',
    
    PRIMARY KEY (id),
    UNIQUE (code)
);