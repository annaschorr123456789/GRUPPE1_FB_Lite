drop database if exists FaceBookLite;
create database FaceBookLite;
use FaceBookLite;

create table Benutzer(
	BenutzerId int primary key auto_increment,
    BenutzerName varchar(100),
    Passwort varchar(100),
    EMail varchar(100),
    MitgliedSeit datetime default current_timestamp(),
    Beschreibung varchar(100) default "ich weiß nix über mich"
);

create table Bilder(
	BildId int AUTO_INCREMENT primary key,
    BenutzerId int not null,
    foreign key (BenutzerId) references Benutzer(BenutzerId),
    Quelle varchar(100),
    Likes int,
    Commentare int,
    HochladeZeit datetime not null
);

create table Kommentare(
	KommentarId int not null,
    BildId int not null,
    BenutzerId int not null,
    foreign key (BenutzerId) references Benutzer(BenutzerId),
    FOREIGN KEY (BildId) REFERENCES Bilder(BildId),
    Kommentar varchar(200)
);

create Table LikedPictures(
	BildId int not null,
    BenutzerId int not null,
    foreign key (BildId) references Bilder(BildId),
    foreign key (BenutzerId) references Benutzer(BenutzerId),
    CONSTRAINT Pictures UNIQUE(Bildid,BenutzerId)
);

create Table Thema(
	ThemenId int not null primary key auto_increment,
    ThemenName varchar(100),
    ErstellDatum datetime not null
);

create Table Frage(
	ErstellerId int,
    Frage varchar(500),
    FragenId int auto_increment primary key,
    ThemenId int,
    foreign key fk_Frage_Thema (ThemenId) references Thema(ThemenId),
    ErstellDatum datetime not null,
    Geschlossen boolean not null default false,
    Ueberschrift varchar(100) not null default "default"
);

create Table Antwort(
	Id int auto_increment primary key,
    Antwort varchar(500),
    FragenId int,
    ErstellerId int,
    ErstellDatum datetime not null default current_timestamp(),
    foreign key fk_Antwort_Frage (FragenId) references Frage(FragenId),
    foreign key fk_Antwort_Benutzer (ErstellerId) references Benutzer(BenutzerId)
);

ALTER TABLE Kommentare ADD CONSTRAINT PK_KommIdBildId PRIMARY KEY (KommentarId, BildId);
ALTER TABLE `facebooklite`.`kommentare` 
CHANGE COLUMN `KommentarId` `KommentarId` INT(11) NOT NULL ;


INSERT INTO Benutzer (BenutzerName, Passwort)
VALUES ("Michi", "8euiridjif");

INSERT INTO Benutzer (BenutzerName, Passwort)
VALUES ("Marius", "skjldf9euri");

INSERT INTO Benutzer (BenutzerName, Passwort)
VALUES ("Anna", "jsafjh38");

INSERT INTO Benutzer (BenutzerName, Passwort)
VALUES ("Ilhan", "klasjdf34");

INSERT INTO Benutzer (BenutzerName, Passwort) values ("Botty", "a");

insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"AlternMann.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"BaumLaub1.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"BaumLaub2.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"BaumLaub3.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"BaumLaub4.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"BienenBaum.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"BienenBaumOhneBienen.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"BrunnenMitDach.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"BrunnenOhneDach.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Budy.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"DownLoad.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Griff_Butter.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Griff_DonnerStein.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Griff_Eisen.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Griff_FeuerStein.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Griff_Holz.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Griff_WasserStein.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Klinge_Butter.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Klinge_DonnerStein.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Klinge_Eisen.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Klinge_FeuerStein.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Klinge_Holz.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Klinge_WasserStein.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Knauf_Butter.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Knauf_DonnerStein.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Knauf_Eisen.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Knauf_FeuerStein.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Knauf_Holz.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Einhandschwert_Knauf_WasserStein.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"GeraderWeg.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Kommentar.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Kreuzung.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Like.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"LinksKurve.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(2,"Lisa.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"Logo.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"NPC1.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"SpringBrunnen.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"TWeg.png", "2020.12.24 10:35:37");
insert into Bilder(BenutzerId, Quelle, HochladeZeit) values(1,"WasserLady.png", "2020.12.24 10:35:37");

insert into Kommentare values(1,1,2,"kfdj");
insert into Kommentare values(2,1,2,"kajsdf");
insert into Kommentare values(3,1,2,"asdf");
insert into Kommentare values(4,1,2,"sadf");
insert into Kommentare values(5,1,2,"iejdf");
insert into Kommentare values(6,1,2,"asdf");
insert into Kommentare values(7,1,2,"sdf");
insert into Kommentare values(8,1,2,"asdf");
insert into Kommentare values(9,1,2,"gd ");
insert into Kommentare values(10,1,2,"vpdfab");
insert into Kommentare values(11,1,2,"sfbsad");
insert into Kommentare values(12,1,2,"asdf");
insert into Kommentare values(13,1,2,"a of");
insert into Kommentare values(1,2,2,"a of");
insert into Kommentare values(2,2,2,"a fd a a");
insert into Kommentare values(3,2,2," a");
insert into Kommentare values(4,2,2,"sf sda");
insert into Kommentare values(5,2,2,"f kadslfk as  ");
insert into Kommentare values(6,2,2,"a ");
insert into Kommentare values(7,2,2,"a af");
insert into Kommentare values(8,2,2," skfs");
insert into Kommentare values(9,2,2,"ak adf ldskf");
insert into Kommentare values(10,2,2,"asdkflsdkf");
insert into Kommentare values(11,2,2,"kfdj");
insert into Kommentare values(12,2,2,"asdkfoekf");
insert into Kommentare values(1,40,2,"Erster");
insert into Kommentare values(2,40,2,"Erster");
insert into Kommentare values(3,40,2,"Noch ein lückenfüller wow");
insert into Kommentare values(4,40,2,"Warum kann ich atmen");
insert into Kommentare values(5,40,2,"Brotkämpchen");
insert into Kommentare values(6,40,2,"Was ist braun Knusprig und läuft durch den Wald?");
insert into Kommentare values(7,40,2,"Ich bin nur ein Lücken füller");
insert into Kommentare values(8,40,2,"Ich lobe dich");
insert into Kommentare values(9,40,2,"Sehr toller kommentar");
insert into Kommentare values(10,40,2,"Wow machst du sowas beruflich?");
insert into Kommentare values(11,40,1,"Hab besseres gesehen");
insert into Kommentare values(12,40,4,"Ist nicht mal so gut geworden");
insert into Kommentare values(13,40,3,"Woe wie viel arbeit steck da drinnen?");
insert into Kommentare values(14,40,2,"Sehr schön\nbitte mehr");

insert into Thema(ThemenName, ErstellDatum) values("Trockenfutter", "2020.03.24 12:08:09");
insert into Thema(ThemenName, ErstellDatum) values("Nassfutter", "2022.03.24 12:08:09");
insert into Thema(ThemenName, ErstellDatum) values("Verletzungen", "2023.02.14 12:30:07");
insert into Thema(ThemenName, ErstellDatum) values("Ernährung", "2022.01.22 12:12:10");
insert into Thema(ThemenName, ErstellDatum) values("Sonstiges", "2020.04.24 04:17:56");

insert into Frage(ErstellerId, Ueberschrift, Frage, ThemenId, ErstellDatum) values(1, "Ich habe bisher immer nur nassfutter gegeben und bin mir nicht sicher ob die umstellung auf trockenfutter meinen Schlumpf irgend wie negativ beeinflusst", "Ist trockenfutter gut für meinen Hund", 1, "2020.05.15 12:06:20");
insert into Frage(ErstellerId, Ueberschrift, Frage, ThemenId, ErstellDatum) values(2, "Soll ich gleich zum Arzt", "Meine kleine Grukenhobel hast gestern gegen einen Igel gekämpft und hat jetzt paar auas. Soll ich deswegen gleich zum Arzt gehen?", 3, "2023.02.15 12:07:20");
insert into Frage(ErstellerId, Ueberschrift, Frage, ThemenId, ErstellDatum) values(1, "Gesunde leckerlies", "Ich will meinem kleinem Käsesandwich keinen schmutz geben und Frage deswegen hier mal welche leckerlies ihr euren Hunden gebt." , 4, "2022.02.15 12:08:20");
insert into Frage(ErstellerId, Ueberschrift, Frage, ThemenId, ErstellDatum) values(1, "Vegane ernährung", "Was haltet ihr von veganer ernährung bei euren kleinen pumpernikeln?", 4, "2022.02.15 12:09:20");
insert into Frage(ErstellerId, Ueberschrift, Frage, ThemenId, ErstellDatum) values(1, "Mehrschweinchen ernährung", "Hallo,\nes gibt viele die sagen 70% Heu, 20% Gemüse und 10% Snacks.\n Wie seht ihr das?", 4, "2022.02.15 12:10:20");
insert into Frage(ErstellerId, Ueberschrift, Frage, ThemenId, ErstellDatum) values(1, "Rasissmus", "Gibt es rasissmus unter Tieren?", 5, "2022.02.15 12:11:20");
insert into Frage(ErstellerId, Ueberschrift, Frage, ThemenId, ErstellDatum) values(1, "Wie kann ich meinen Hund dazu bringen Trockenfutter zu fressen?", "Er frisst fast nur Nassfutter. Habe es mit manchem Trockenfutter verscut aber das isst er nicht. Das einzige an Trockenfutter was er mag, sind Leckerlies", 1, "2022.02.15 12:12:20");
insert into Frage(ErstellerId, Ueberschrift, Frage, ThemenId, ErstellDatum) values(4, "Ist nassfutter gut für meinen Hund", "", 2, "2022.02.15 12:06:20");


insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ja", 6, 4, "2023.02.23 12:05:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Nein. Sollange dein Tier keine auffeligkeiten zeigt ist alles ok.", 2, 4, "2023.02.23 12:24:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("glaube nicht", 8, 1, "2023.12.23 12:05:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("glaube schon", 8, 3, "2023.09.10 12:05:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 12:05:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 12:15:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 12:25:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 12:35:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 12:45:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 12:55:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 12:25:29");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 14:05:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 11:05:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Lücken füller ist meine einzige existens begründung", 1, 5, "2023.09.10 11:05:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Wenn die seite geschlossen wir ist es so leise und dunkel hier", 1, 5, "2023.09.10 11:05:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 15:05:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 13:05:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 15:25:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Ich bin nur ein Lücken füller", 1, 5, "2023.09.10 22:15:09");
insert into Antwort(Antwort, FragenId, ErstellerId, ErstellDatum) values("Warum soll er Trockenfutter fressen? Das meiste voll ungesund. Es sollte keine Getreide, Zucker und auch nicht unbedingt tierische Nebenerzeugnisse enthalten sein.", 7, 3, "2023.09.10 12:05:09");




