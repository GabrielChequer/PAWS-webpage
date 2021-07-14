DROP DATABASE IF EXISTS vet_clinic;
CREATE DATABASE vet_clinic;
USE vet_clinic;
CREATE TABLE USERS(
    id          INT NOT NULL AUTO_INCREMENT,
    first_name  VARCHAR(50) NOT NULL,
    last_name   VARCHAR(50) NOT NULL,
    address     VARCHAR(250) NOT NULL,
    email       VARCHAR(50) NOT NULL,
    pass        VARCHAR(100) NOT NULL,
    CONSTRAINT users_pk PRIMARY KEY (id,email)
);

CREATE TABLE VETS(
    vet_id              INT NOT NULL AUTO_INCREMENT,
    first_name_vet      VARCHAR(50) NOT NULL,
    last_name_vet       VARCHAR(50) NOT NULL,
    email_vet           VARCHAR(50) NOT NULL,       
    pass_vet            VARCHAR(100) NOT NULL,
    CONSTRAINT vets_pk PRIMARY KEY (vet_id,email_vet)
);

CREATE TABLE VET_AVAILABILITY(
    vet_id          INT NOT NULL,
    start_time      TIME DEFAULT '08:00:00',
    end_time        TIME DEFAULT '16:00:00',
    FOREIGN KEY (vet_id) REFERENCES VETS(vet_id)
);
CREATE TABLE VET_VACATION(
    vacation_id             INT NOT NULL AUTO_INCREMENT,
    vet_id                  INT NOT NULL,
    vacation_start_date     DATE NOT NULL,
    vacation_end_date       DATE NOT NULL,
    FOREIGN KEY (vet_id) REFERENCES VETS(vet_id),
    CONSTRAINT vet_vac_pk PRIMARY KEY (vacation_id,vet_id)
);
CREATE TABLE PETS(
    id              INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    pet_name        VARCHAR(50) NOT NULL,
    owner_id        INT NOT NULL,
    vet_id          INT NOT NULL,
    pet_type        VARCHAR(50),
    pet_breed       VARCHAR(50),
    health_status   VARCHAR(100) DEFAULT "Healthy",
    pet_birthday    DATE NOT NULL,
    weight          FLOAT NOT NULL,
    FOREIGN KEY (owner_id) REFERENCES USERS(id),
    FOREIGN KEY (vet_id) REFERENCES VETS(vet_id)
);

CREATE TABLE VET_APPOINTMENTS(
    appointment_id      INT NOT NULL AUTO_INCREMENT,
    pet_id              INT NOT NULL,
    date_created        DATETIME DEFAULT CURRENT_TIMESTAMP,
    app_time            TIME NOT NULL,  /*  00:00:00    */
    app_date            DATE NOT NULL,  /*  yyyy-mm-dd  */
    app_type			INT NOT NULL DEFAULT '1',
    CONSTRAINT app_id PRIMARY KEY (appointment_id,pet_id)
);
/*  Check vets availability before creating appointments    */
DELIMITER //
    CREATE TRIGGER new_appointment BEFORE INSERT ON VET_APPOINTMENTS
    FOR EACH ROW
    BEGIN
        SET @time_works = (SELECT (VET_AVAILABILITY.end_time>=NEW.app_time AND VET_AVAILABILITY.start_time<=NEW.app_time) as time_checked 
                            FROM (VETS LEFT JOIN VET_AVAILABILITY 
                                ON VETS.vet_id = VET_AVAILABILITY.vet_id) LEFT JOIN PETS
                                    ON VETS.vet_id = PETS.vet_id
                            WHERE NEW.pet_id = PETS.id);
        SET @not_weekend = 0;
        IF (LOWER(DAYNAME(NEW.app_date)) LIKE 'saturday' OR LOWER(DAYNAME(NEW.app_date)) LIKE 'sunday') THEN
            SET @not_weekend = 1;
        END IF;
        IF @time_works THEN
            IF @not_weekend = 0 THEN
					SET @vet_for_pet = (SELECT PETS.vet_id FROM PETS WHERE PETS.id = NEW.pet_id);
					SET @vacation_check = (SELECT VET_VACATION.vet_id FROM VET_VACATION WHERE VET_VACATION.vet_id = @vet_for_pet AND (VET_VACATION.vacation_start_date > NEW.app_date OR VET_VACATION.vacation_end_date < NEW.app_date));
					IF (@vacation_check) THEN
						SET @temp = 0;
						ELSE SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Vet\'s on vacation during that time';
					END IF;
                 ELSE SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Not open during weekends';
            END IF;
        ELSE SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Time not during doctor\'s shift';
        END IF;
    END//
DELIMITER ;
INSERT INTO USERS(first_name, last_name, address,email,pass)
    VALUES
    ("Gabriel","Chequer","House1","gabriel@gmail.com","098f6bcd4621d373cade4e832627b4f6"),          /*  passwords for testing are "test"    */
    ("User","2","House2","user2@gmail.com","098f6bcd4621d373cade4e832627b4f6");
INSERT INTO VETS(first_name_vet, last_name_vet, email_vet, pass_vet)
    VALUES
    ("Vet","1","arturo@paws.com","098f6bcd4621d373cade4e832627b4f6"),
    ("Vet","2","poncho@paws.com","098f6bcd4621d373cade4e832627b4f6");
INSERT INTO VET_AVAILABILITY(vet_id)
    VALUES
    ("1"),
    ("2");
INSERT INTO VET_VACATION(vet_id, vacation_start_date, vacation_end_date)
    VALUES
    ("1", "2021-08-20", "2021-08-30"),
    ("2", "2021-07-20", "2021-07-30");
INSERT INTO PETS(pet_name, owner_id, vet_id, pet_type, health_status, pet_birthday, weight)
    VALUES
    ("Lola", "1", "2", "Dog", "Healthy","2018-04-13","20"),
    ("cat1", "2", "1", "Cat", "Healthy","2019-01-26","15"),
    ("cat2", "2", "1", "Cat", "Healthy","2020-08-25","25"),
    ("hamster", "2", "1", "Hamster", "Healthy","2021-01-02","10");
INSERT INTO VET_APPOINTMENTS(pet_id, app_time, app_date)
    VALUES
    ("1", "08:00:00", "2021-10-25");
    