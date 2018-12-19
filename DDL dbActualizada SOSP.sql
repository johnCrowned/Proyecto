create schema db_SOSPP;

use db_SOSPP;

CREATE TABLE db_SOSP.role (
    roleId VARCHAR(40) PRIMARY KEY,
    description VARCHAR(200) NOT NULL,
    statusRole BOOLEAN NOT NULL
)  ENGINE INNODB;
insert into db_SOSP.role values ('01','APRENDIZ',1);
insert into db_SOSP.role values ('02','INTRUCTOR',1);
insert into db_SOSP.role values ('03','ADMINISTRADOR',1);


CREATE TABLE db_SOSP.documentType (
    documentName VARCHAR(50) PRIMARY KEY,
    description VARCHAR(200) NOT NULL,
    statusDocType BOOLEAN NOT NULL
)  ENGINE INNODB;

insert into db_SOSP.documentType values ('CC','CEDULA DE CIUDADANIA',1);
insert into db_SOSP.documentType values ('CE','CEDULA DE Extranjeria',1);
insert into db_SOSP.documentType values ('TT','TARJETA DE IDENTIDAD',1);

CREATE TABLE db_SOSP.customer (
    documentNumber VARCHAR(50),
    firstName VARCHAR(50) NOT NULL,
    secondName VARCHAR(50) NULL,
    firstLastName VARCHAR(50) NOT NULL,
    secondLastName VARCHAR(50) NULL,
    documentName VARCHAR(50),
    CONSTRAINT documentType_customer FOREIGN KEY (documentName)
        REFERENCES db_sosp.documentType (documentName),
    PRIMARY KEY (documentNumber , documentName)
)  ENGINE INNODB;

INSERT INTO db_SOSP.customer values ('1022997832','JUAN','PABLO','CORONADO','RAMIREZ','CC');
INSERT INTO db_SOSP.customer values ('1013677903','	IVAN','FELIPE','TORRES','GOMEZ','CC');

CREATE TABLE db_SOSP.users (
    mail VARCHAR(100) NOT NULL,
    passwordUser VARCHAR(64) NOT NULL,
    photo LONGBLOB NULL,
    documentName VARCHAR(50),
    documentNumber VARCHAR(50),
    CONSTRAINT customer_users FOREIGN KEY (documentName , documentNumber)
        REFERENCES db_sosp.customer (documentName , documentNumber),
    PRIMARY KEY (documentName , documentNumber)
)  ENGINE INNODB;
insert into db_SOSP.users values ('jpcoronado23@misena.edu.co','123','photo','CC','1022997832');
insert into db_SOSP.users values ('IVAN@misena.edu.co','123','photo','CC','1013677903');

CREATE TABLE db_SOSP.customer_has_role (
    statusCustomerRole BOOLEAN NOT NULL,
    terminationDate DATE NOT NULL,
    documentNumber VARCHAR(50),
    documentName VARCHAR(50),
    CONSTRAINT customer_customer_has_role FOREIGN KEY (documentName , documentNumber)
        REFERENCES db_sosp.customer (documentName , documentNumber),
    roleId VARCHAR(40),
    CONSTRAINT role_customer_has_role FOREIGN KEY (roleId)
        REFERENCES db_sosp.role (roleId),
    PRIMARY KEY (documentNumber , documentName , roleId)
)  ENGINE INNODB;
insert into db_SOSP.customer_has_role values (1,22/09/2017,'1022997832','CC','01');
insert into db_SOSP.customer_has_role values (1,22/09/2017,'1013677903','CC','03');

CREATE TABLE db_SOSP.formationStatus (
    statusId VARCHAR(45) PRIMARY KEY,
    statusF BOOLEAN NOT NULL
)  ENGINE INNODB;

CREATE TABLE db_SOSP.instructorType (
    insTypeId VARCHAR(30) PRIMARY KEY,
    statusI BOOLEAN NOT NULL
)  ENGINE INNODB;

CREATE TABLE db_SOSP.programStatus (
    programStatusID VARCHAR(40) PRIMARY KEY,
    idStatus BOOLEAN NOT NULL
)  ENGINE INNODB;

CREATE TABLE db_SOSP.LevelTraining(
idLevelTraining varchar(40)PRIMARY KEY ,
descripcion varchar(100)not null,
state boolean not null

)ENGINE INNODB;

CREATE TABLE db_SOSP.program (
    programCode_version VARCHAR(15) PRIMARY KEY,
    programName VARCHAR(100) NOT NULL,
    programStatusID VARCHAR(40) NOT NULL,
    CONSTRAINT programStatus_program FOREIGN KEY (programStatusID)
        REFERENCES db_sosp.programStatus (programStatusID),
        idLevelTraining varchar(40)not null,
    constraint LevelTraining_program
    foreign key (idLevelTraining) references db_sosp.LevelTraining (idLevelTraining)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.workingDay (
    workingDayName VARCHAR(40) PRIMARY KEY,
    statusW VARCHAR(45) NOT NULL,
    description VARCHAR(200) NULL
)  ENGINE INNODB;



CREATE TABLE db_SOSP.trimester (
   trimesterId VARCHAR(20),
   workingDayName VARCHAR(40),
   CONSTRAINT workingday_trimester FOREIGN KEY (workingDayName)
   REFERENCES db_SOSP.workingDay (workingDayName),
   idLevelTraining varchar(40),
   CONSTRAINT LevelTraining_trimester
   foreign key (idLevelTraining) references db_sosp.LevelTraining(idLevelTraining),
   PRIMARY KEY (trimesterId , workingDayName,idLevelTraining)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.ficha (
    fichaNumber VARCHAR(20) PRIMARY KEY,
    statusf BOOLEAN NOT NULL,
    programCode_version VARCHAR(15) NOT NULL,
    CONSTRAINT program_ficha FOREIGN KEY (programCode_version)
        REFERENCES db_SOSP.program (programCode_version),
    workingDayName VARCHAR(40) NOT NULL,
    CONSTRAINT workingDay_projectGroup FOREIGN KEY (workingDayName)
        REFERENCES db_SOSP.workingDay (workingDayName)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.projectGroup (
    statusP BOOLEAN NOT NULL,
    proyectName VARCHAR(100) NOT NULL,
    fichaNumber VARCHAR(20) NOT NULL,
    groupCode INT,
    CONSTRAINT ficha_projectGroup FOREIGN KEY (fichaNumber)
        REFERENCES db_SOSP.ficha (fichaNumber),
    PRIMARY KEY (groupCode , fichaNumber)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.apprentice (
    statusId VARCHAR(45) NOT NULL,
    CONSTRAINT formationStatus_apprentice FOREIGN KEY (statusId)
        REFERENCES db_SOSP.formationStatus (statusId),
    documentNumber VARCHAR(50),
    documentName VARCHAR(50),
    CONSTRAINT customer_apprentice FOREIGN KEY (documentName , documentNumber)
        REFERENCES db_sosp.customer (documentName , documentNumber),
    fichaNumber VARCHAR(20),
    groupCode INT,
    CONSTRAINT projectGroup_apprentice FOREIGN KEY (fichaNumber , groupCode)
        REFERENCES db_SOSP.projectGroup (fichaNumber , groupCode),
    PRIMARY KEY (documentNumber , documentName , fichaNumber , groupCode)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.fichaInstructor (
    documentNumber VARCHAR(50),
    documentName VARCHAR(50),
    CONSTRAINT customer_fichaInstructor FOREIGN KEY (documentNumber , documentName)
        REFERENCES db_SOSP.customer (documentNumber , documentName),
    fichaNumber VARCHAR(20),
    CONSTRAINT ficha_fichaInstructor FOREIGN KEY (fichaNumber)
        REFERENCES db_SOSP.ficha (fichaNumber),
    trimesterId VARCHAR(20),
    workingDayName VARCHAR(40),
    idLevelTraining varchar(40),
    CONSTRAINT trimester_fichaInstructor FOREIGN KEY (trimesterId , workingDayName,idLevelTraining)
        REFERENCES db_SOSP.trimester (trimesterId , workingDayName,idLevelTraining), 
    insTypeId VARCHAR(30),
    CONSTRAINT instructorType_fichaInstructor FOREIGN KEY (insTypeId)
        REFERENCES db_SOSP.instructorType (insTypeId),
    
    PRIMARY KEY (documentNumber , documentName , fichaNumber,trimesterId,workingDayName,insTypeId,idLevelTraining)
)  ENGINE INNODB;



CREATE TABLE db_SOSP.competence (
    codeC VARCHAR(40),
    denomination TEXT(100) NOT NULL,
    programCode_version VARCHAR(15),
    CONSTRAINT program_competence FOREIGN KEY (programCode_version)
        REFERENCES db_SOSP.program (programCode_version),
    PRIMARY KEY (codeC , programCode_version)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.checkList (
    listId VARCHAR(45),
    statusCL BOOLEAN NOT NULL,
    programCode_version VARCHAR(15),
    CONSTRAINT program_checkList FOREIGN KEY (programCode_version)
        REFERENCES db_SOSP.program (programCode_version),
    PRIMARY KEY (listID , programCode_version)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.fichaHasCheckList (
    fichaNumber VARCHAR(20),
    CONSTRAINT ficha_fichaHasCheckList FOREIGN KEY (fichaNumber)
        REFERENCES db_SOSP.ficha (fichaNumber),
    listId VARCHAR(45),
    CONSTRAINT checkList_fichaHasCheckList FOREIGN KEY (listId)
        REFERENCES db_SOSP.checkList (listId),
    PRIMARY KEY (fichaNumber , listID)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.valoration (
    valueV VARCHAR(30) PRIMARY KEY,
    statusV BOOLEAN NOT NULL
)  ENGINE INNODB;

CREATE TABLE db_SOSP.learningResult (
    codeL VARCHAR(40),
    denomination TEXT(100) NOT NULL,
    codeC VARCHAR(15),
    programCode_version VARCHAR(15),
    CONSTRAINT competence_learningResult FOREIGN KEY (codeC , programCode_version)
        REFERENCES db_SOSP.competence (codeC , programCode_version),
    PRIMARY KEY (codeL , codeC , programCode_version)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.learningResultHasTrimester (
    codeL VARCHAR(40),
    codeC VARCHAR(15),
    programCode_version VARCHAR(15),
    CONSTRAINT learningResult_learningResultHasTrimester FOREIGN KEY (codeL , codeC , programCode_version)
        REFERENCES db_SOSP.learningResult (codeL , codeC , programCode_version),
    trimesterId VARCHAR(20),
    workingDayName VARCHAR(40),
    idLevelTraining varchar(40),
    CONSTRAINT trimester_learningResultHasTrimester FOREIGN KEY (trimesterId , workingDayName,idLevelTraining)
        REFERENCES db_SOSP.trimester (trimesterId , workingDayName,idLevelTraining),
        
    
    PRIMARY KEY (codeL , codeC , programCode_version , trimesterId , workingDayName,idLevelTraining)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.listItem (
    itemId INT,
    itemQuestion VARCHAR(100) NOT NULL,
    codeL VARCHAR(40) NOT NULL,
    codeC VARCHAR(15) NOT NULL,
    programCode_version VARCHAR(15) NOT NULL,
    CONSTRAINT learningResult_listItem FOREIGN KEY (codeL , codeC , programCode_version)
        REFERENCES db_SOSP.learningResult (codeL , codeC , programCode_version),
    listId VARCHAR(45) NOT NULL,
    CONSTRAINT checkList_listItem FOREIGN KEY (listId)
        REFERENCES db_SOSP.checkList (listId),
    PRIMARY KEY (itemId , listId)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.groupAnswer (
    dateG DATETIME,
    fichaNumber VARCHAR(20),
    groupCode INT,
    CONSTRAINT projectGroup_groupAnswer FOREIGN KEY (fichaNumber , groupCode)
        REFERENCES db_SOSP.projectGroup (fichaNumber , groupCode),
    itemId INT,
    listId VARCHAR(45),
    CONSTRAINT listItem_groupAnswer FOREIGN KEY (itemId , listId)
        REFERENCES db_SOSP.listItem (itemId , listId),
    valueV VARCHAR(30) NOT NULL,
    CONSTRAINT valoration_groupAnswer FOREIGN KEY (valueV)
        REFERENCES db_SOSP.valoration (valueV),
    PRIMARY KEY (fichaNumber , groupCode , itemId , listId)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.observationItem (
    observationId INT,
    observation TEXT(1000) NOT NULL,
    jury TEXT(1000) NULL,
    dateOI DATETIME NOT NULL,
    userOI VARCHAR(150) NOT NULL,
    fichaNumber VARCHAR(20),
    groupCode INT,
    itemId INT,
    listId VARCHAR(45),
    CONSTRAINT groupAnswer_observationItem FOREIGN KEY (itemId , listId , fichaNumber , groupCode)
        REFERENCES db_SOSP.groupAnswer (itemId , listId , fichaNumber , groupCode),
    PRIMARY KEY (observationId , itemId , listId , fichaNumber , groupCode)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.generalObservation (
    observationId INT,
    observation TEXT(1000) NOT NULL,
    jury TEXT(1000),
    dateGO DATETIME NOT NULL,
    userGO VARCHAR(150) NOT NULL,
    fichaNumber VARCHAR(20) NOT NULL,
    groupCode INT,
    CONSTRAINT projectGroup_generalObservation FOREIGN KEY (fichaNumber , groupCode)
        REFERENCES db_SOSP.projectGroup (fichaNumber , groupCode),
    PRIMARY KEY (observationId , fichaNumber , groupCode)
)  ENGINE INNODB;

CREATE TABLE db_SOSP.mailServer (
    mailUser VARCHAR(100) PRIMARY KEY,
    passwordMS VARCHAR(64) NOT NULL,
    smtpPort INT NOT NULL,
    smtpSslTrust VARCHAR(50) NOT NULL,
    smtpStarttlsEnable BOOLEAN NOT NULL,
    smtpAuoth BOOLEAN NOT NULL,
    issueRecuperation VARCHAR(50) NOT NULL,
    recuperationMessage VARCHAR(50) NOT NULL
)  ENGINE INNODB;


ALTER TABLE `listitem`
  MODIFY `itemId` INT(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `groupAnswer`
  MODIFY `itemId` INT(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;