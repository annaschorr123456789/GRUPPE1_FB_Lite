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
    Frage varchar(100),
    FragenId int auto_increment primary key,
    ThemenId int,
    foreign key fk_Frage_Thema (ThemenId) references Thema(ThemenId),
    ErstellDatum datetime not null,
    Geschlossen boolean not null default false,
    Ueberschrift varchar(100) not null default "default"
);

create Table Antwort(
	Id int auto_increment primary key,
    Antwort varchar(100),
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
insert into Kommentare values(1,40,2,"sfdma");
insert into Kommentare values(2,40,2,"fadfkoa");
insert into Kommentare values(3,40,2,"fda");
insert into Kommentare values(4,40,2,"fadfkoa");
insert into Kommentare values(5,40,2,"lldfkasd");
insert into Kommentare values(6,40,2,"adkoae");
insert into Kommentare values(7,40,2,"ö,öaf");
insert into Kommentare values(8,40,2,"lmdaf");
insert into Kommentare values(9,40,2,"kldf");
insert into Kommentare values(10,40,2,"dfmklf");
insert into Kommentare values(11,40,2,"mälkdf");
insert into Kommentare values(12,40,2,"djskf");
insert into Kommentare values(13,40,2,"jiewf");
insert into Kommentare values(14,40,2,"AÄJD");

insert into Thema(ThemenName, ErstellDatum) values("Trockenfutter", "2020.03.24 12:08:09");
insert into Thema(ThemenName, ErstellDatum) values("Nassfutter", "2022.03.24 12:08:09");
insert into Thema(ThemenName, ErstellDatum) values("test", "2023.04.12 12:30:07");

insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Ist trockenfutter gut für meinen Hund", 1, "2022.02.15 12:06:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage1", 1, "2022.02.15 12:07:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage2", 1, "2022.02.15 12:08:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage3", 1, "2022.02.15 12:09:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage4", 1, "2022.02.15 12:10:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage5", 1, "2022.02.15 12:11:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage6", 1, "2022.02.15 12:12:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage7", 1, "2022.02.15 12:13:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage8", 1, "2022.02.15 12:14:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage9", 1, "2022.02.15 12:15:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage10", 1, "2022.02.15 12:16:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage11", 1, "2022.02.15 12:17:20");
insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(1, "Frage12", 1, "2022.02.15 12:18:20");

insert into Frage(ErstellerId, Frage, ThemenId, ErstellDatum) values(4, "Ist nassfutter gut für meinen Hund", 2, "2022.02.15 12:06:20");


insert into Antwort(Antwort, FragenId, ErstellerId) values("Ja", 14, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Nein", 14, 2);
insert into Antwort(Antwort, FragenId, ErstellerId) values("glaube nicht", 14, 1);
insert into Antwort(Antwort, FragenId, ErstellerId) values("glaube schon", 14, 3);
insert into Antwort(Antwort, FragenId, ErstellerId) values("wer das liest ist doff", 14, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("denen hast du es gezeigt", 14, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Ja", 14, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Nein", 14, 2);
insert into Antwort(Antwort, FragenId, ErstellerId) values("glaube nicht", 14, 1);
insert into Antwort(Antwort, FragenId, ErstellerId) values("glaube schon", 14, 3);
insert into Antwort(Antwort, FragenId, ErstellerId) values("wer das liest ist doff", 14, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("denen hast du es gezeigt", 14, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Ja", 14, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Nein", 14, 2);
insert into Antwort(Antwort, FragenId, ErstellerId) values("glaube nicht", 14, 1);
insert into Antwort(Antwort, FragenId, ErstellerId) values("glaube schon", 14, 3);
insert into Antwort(Antwort, FragenId, ErstellerId) values("wer das liest ist doff", 14, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("denen hast du es gezeigt", 14, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Antwort1", 2, 2);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Antwort2", 2, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Antwort3", 2, 1);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Antwort4", 2, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Antwort5", 2, 1);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Antwort6", 2, 1);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Antwort7", 2, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Antwort8", 2, 4);
insert into Antwort(Antwort, FragenId, ErstellerId) values("Antwort9", 2, 4);




