#
# Table structure for table 'tx_mage2typo3_domain_model_product'
#
CREATE TABLE tx_mage2typo3_domain_model_product (

	sku varchar(255) DEFAULT '' NOT NULL,
	created_at int(11) DEFAULT '0' NOT NULL,
	updated_at int(11) DEFAULT '0' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	status varchar(255) DEFAULT '' NOT NULL,
	tags varchar(255) DEFAULT '' NOT NULL,
	price double(11,2) DEFAULT '0.00' NOT NULL,
	description text,
	short_description text,
	product_image int(11) unsigned NOT NULL default '0',
	categories int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_mage2typo3_domain_model_productcategory'
#
CREATE TABLE tx_mage2typo3_domain_model_productcategory (

	product int(11) unsigned DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_mage2typo3_domain_model_shop'
#
CREATE TABLE tx_mage2typo3_domain_model_shop (

	shop_name varchar(255) DEFAULT '' NOT NULL,
	url varchar(255) DEFAULT '' NOT NULL,
	user_name varchar(255) DEFAULT '' NOT NULL,
	password varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_mage2typo3_domain_model_importconfiguration'
#
CREATE TABLE tx_mage2typo3_domain_model_importconfiguration (

	name varchar(255) DEFAULT '' NOT NULL,
	shop int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_mage2typo3_domain_model_productcategory'
#
CREATE TABLE tx_mage2typo3_domain_model_productcategory (

	product int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_mage2typo3_domain_model_product'
#
CREATE TABLE tx_mage2typo3_domain_model_product (
	categories int(11) unsigned DEFAULT '0' NOT NULL,
);
