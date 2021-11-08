CREATE TABLE tt_content (
    tx_gallerycontent_template varchar(25),
    tx_gallerycontent_cropratio varchar(25),
    tx_gallerycontent_cropratiozoom varchar(25),
    tx_gallerycontent_showtitle int(11) DEFAULT '0' NOT NULL,
    tx_gallerycontent_showdesc int(11) DEFAULT '0' NOT NULL,
    tx_gallerycontent_showtitlezoom int(11) DEFAULT '0' NOT NULL,
    tx_gallerycontent_showdesczoom int(11) DEFAULT '0' NOT NULL,
);
