# Records-Management-Office

php v8.2.4

mariaDB setup v10.3.39

---

![screenshot-20230412-020957](https://github.com/oeufyoc/Records-Management-Office/assets/51881147/27995309-caa4-4031-b369-af31d2601bd6)

Generation of MEMBERS DATA, para sa tanan na personal data

		CREATE TABLE humans (
		  serial_code VARCHAR(12) NOT NULL,
		  last_name VARCHAR(255) NOT NULL,
		  first_name VARCHAR(255) NOT NULL,
		  middle_initial VARCHAR(255) NOT NULL,
		  age INT NOT NULL,
		  gender VARCHAR(10) NOT NULL,
		  address VARCHAR(255) NOT NULL,
		  birthdate DATE NOT NULL,
		  social_status VARCHAR(10) NOT NULL,
		  phone_number VARCHAR(20) NOT NULL,
		  facebook_account VARCHAR(255) NOT NULL,
		  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		  PRIMARY KEY (serial_code),
		  UNIQUE (last_name, first_name, middle_initial)
		);

Amo ini an auto increment ko na serial number sa kada entry san human, an format kay YEAR-MONTH-DAY-SERIAL an problema ko pa dd kay kun pano idisplay an month na two digits, halimbawa sa april 2023, imbis na 20234, dapat 202304.
  
		DELIMITER $$
		CREATE TRIGGER generate_serial_code
		BEFORE INSERT ON humans
		FOR EACH ROW
		BEGIN
		    DECLARE today_date DATE;
		    DECLARE serial_num INT;
		    SET today_date = CURDATE();
		    SET serial_num = (SELECT COUNT(*) FROM humans WHERE DATE(created_at) = today_date) + 1;
		    SET NEW.serial_code = CONCAT(YEAR(today_date), MONTH(today_date), DAY(today_date), LPAD(serial_num, 4, '0'));
		    SET NEW.created_at = DATE_FORMAT(NOW(), '%Y%m%d');
		END$$
		DELIMITER ;

Generation of LEADERS TABLE, purpose ko sa leaders table kay para sa tracking san members sa kada leader.
  
		CREATE TABLE leaders (
		  id INT AUTO_INCREMENT PRIMARY KEY,
		  serial_code VARCHAR(10) NOT NULL,
		  active_member BOOLEAN NOT NULL DEFAULT FALSE,
		  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		  FOREIGN KEY (serial_code) REFERENCES humans(serial_code)
		);

Trigger ini para automatic na iadd an usad na MEMBER sa LEADERS table, magiging true sa active_member na column, kaya ko ini gin butang san tracking san active kag inactive na member sa LEADERS table kay para rin sa history san mga connected na leader san MEMBER
  
		CREATE TRIGGER set_active_member_true
		BEFORE INSERT ON leaders
		FOR EACH ROW
		SET NEW.active_member = TRUE;

		
		DELIMITER //
		CREATE TRIGGER set_active_member_false
		BEFORE UPDATE ON leaders
		FOR EACH ROW
		IF NEW.active_member = FALSE THEN
		    SET NEW.active_member = TRUE;
		ELSE
		    SET NEW.active_member = FALSE;
		END IF;
		DELIMITER ;
		
		
