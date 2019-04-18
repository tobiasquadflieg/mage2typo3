#
# Table structure for table 'tx_mage2typo3_domain_model_products'
#
CREATE TABLE tx_mage2typo3_domain_model_products (

	sku varchar(255) DEFAULT '' NOT NULL,
	created_at int(11) DEFAULT '0' NOT NULL,
	updated_at int(11) DEFAULT '0' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	status varchar(255) DEFAULT '' NOT NULL,
	tags varchar(255) DEFAULT '' NOT NULL,
	price double(11,2) DEFAULT '0.00' NOT NULL,
	description text,
	short_description text,
	categories int(11) unsigned DEFAULT '0' NOT NULL,
	images int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_mage2typo3_domain_model_productcategories'
#
CREATE TABLE tx_mage2typo3_domain_model_productcategories (

	products int(11) unsigned DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_mage2typo3_domain_model_productcategories'
#
CREATE TABLE tx_mage2typo3_domain_model_productcategories (

	products int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_mage2typo3_domain_model_products'
#
CREATE TABLE tx_mage2typo3_domain_model_products (
	categories int(11) unsigned DEFAULT '0' NOT NULL,
);
