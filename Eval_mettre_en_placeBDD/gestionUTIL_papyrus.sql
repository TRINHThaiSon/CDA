CREATE user 'util1'@'%' identified by 'Afpa12345';
grant all privileges on PAPYRUS.* to 'util1'@'%';

CREATE USER 'util2'@'%' IDENTIFIED BY 'Afpa12345';
grant select ON PAPYRUS.* to util2;

CREATE USER 'util3'@'%' IDENTIFIED BY 'Afpa12345';
grant select ON PAPYRUS.fournis to util3;