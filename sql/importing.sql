SELECT DISTINCT(how_you_found_us) FROM user_import;

SELECT * FROM user_import WHERE lastname LIKE '%Cangelosi%';

SELECT * FROM user_import WHERE uid = 1;

SELECT COUNT(*) FROM user_import;

DELETE FROM transactions;
DELETE FROM transactions_entries;
DELETE FROM users WHERE password_hash = '' OR password_hash IS NULL;

SELECT DATE('4/5/10');


INSERT INTO
users
(
	date_added,
	date_updated,
	active,
	`type`,
	`name`,
	birthdate,
	address_street,
	address_apartment,
	address_city,
	address_state,
	address_country,
	address_zip,
	phone_primary_number,
	phone_primary_type,
	phone_secondary_number,
	phone_secondary_type,
	referral	
)
SELECT
 regdatep,
 regdatep,
 1,
 'client',
 CONCAT(firstname, ' ', lastname),
 dobp,
 addr,
 apt,
 city,
 state,
 'US',
 zip,
 p1,
 p1t,
 p2,
 p2t,
 how_you_found_us
FROM user_import;


SELECT * FROM user_import WHERE
(home_phone = '' OR work_phone = '') AND other_phone <> '';

SELECT * FROM user_import WHERE
(home_phone <> '' AND work_phone <> '') AND other_phone <> '';

SELECT 
IF(work_phone = '', CONCAT(home_phone_area,'-',home_phone), CONCAT(work_phone_area, '-', work_phone)), 
IF (other_phone = '', IF (work_phone = '', '', CONCAT(home_phone_area, '-', home_phone)), CONCAT(other_phone_area,'-', other_phone))
work_phone, home_phone, other_phone FROM user_import;



SELECT COUNT(*) FROM user_import WHERE other_phone <> '';
SELECT COUNT(*) FROM user_import WHERE home_phone <> '';
SELECT COUNT(*) FROM user_import WHERE work_phone <> '';

SELECT firstname, COUNT(*) AS cnt FROM user_import GROUP BY UPPER(firstname) ORDER BY cnt DESC;
SELECT lastname, COUNT(*) AS cnt FROM user_import GROUP BY UPPER(lastname) ORDER BY cnt DESC;
SELECT service1_firstname, COUNT(*) AS cnt FROM user_import GROUP BY UPPER(service1_firstname) ORDER BY cnt DESC;
SELECT city, COUNT(*) AS cnt FROM user_import GROUP BY UPPER(city) ORDER BY cnt DESC;
