/*
    THIS FILE CONTAINS FUNCTIONS FOR THE PROFILE PAGE
    Profile.html
*/

var UserId;
var UserName;

function CheckNewPassword() {
    var oldPassword = document.getElementById("oldPassword").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            if (xhttp.responseText === "true") {
                if (document.getElementById("newPasswordValidate").value === document.getElementById("newPassword").value) {
                    ChangeUserPasswordTo(document.getElementById("newPassword").value);
                } else
                    alert("Passwörter stimmen nicht überein");
            } else
            {
                alert("Password ist nicht richtig");
            }
        }
    };
    xhttp.open("GET", "PHPFiles/ProfileChanger.php?UserId=" + UserId + "&Check=Password&Password=" + oldPassword);
    xhttp.send();
}

function ChangeUserPasswordTo(NewPassword) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        CheckChangeState(xhttp);
    };
    xhttp.open("GET", "PHPFiles/ProfileChanger.php?UserId=" + UserId + "&Alter=Password&Password=" + NewPassword);
    xhttp.send();
}

function CheckChangeState(xhttp) {
    if (xhttp.status === 404)
        console.log("Seite zum ändern des Passwords nicht gefunden");
    if (xhttp.readyState === 4 && xhttp.status === 200) {
        if (xhttp.responseText === "altered") {
            document.getElementById("oldPassword").value = "";
            document.getElementById("newPassword").value = "";
            document.getElementById("newPasswordValidate").value = "";
            alert("Erfolgreich geändert");
            console.log("Password wurde geändert");
        } else {
            alert("Fehler beim ändern des Passwords");
        }
    }
}

function ChangeUserName() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200)
        {
            if (xhttp.responseText === "true") {
                alert("Benutzername wurde erfogreich geändert");
                UserName = document.getElementById("NewUserName").value;
                document.getElementById("NewUserName").value = "";
            } else if (xhttp.responseText === "already assigned") {
                alert("Der Benutzer Name ist bereits vergeben");
            } else {
                alert("Ein fehler beim bearbeiten des Benutzer Namens ist aufgetreten");
            }
        }
    }
    var NewUserName = document.getElementById("NewUserName").value;
    var url = "PHPFiles/ProfileChanger.php?UserId=" + UserId + "&Alter=UserName&NewUserName=" + NewUserName;
    xhttp.open("GET", url);
    xhttp.send();
}

function CheckOldEmailAdress() {
    if (document.getElementById("newEmail").value !== document.getElementById("newEmailValidate").value) {
        alert("Die Email Adressen stimmen nicht überein");
        return;
    }
    var OldEmail = document.getElementById("oldEmail").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            if (xhttp.responseText === "true") {
                CheckNewEmailAdress(document.getElementById("newEmail").value);
            } else if (xhttp.responseText === "false") {
                alert("Angegebene Email Adresse stimmt nicht");
            } else {
                alert("Ein fehler beim ändern der Email Adresse ist aufgetreten");
                console.log("Fehler beim finden der Email Adresse");
            }
        }
    };
    var url = "PHPFiles/ProfileChanger.php?UserId=" + UserId + "&Check=EmailAndUserId&Email=" + OldEmail;
    xhttp.open("GET", url);
    xhttp.send();
}

function CheckNewEmailAdress(NewEmailAdress) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            if (xhttp.responseText === "true") {
                ChangeEmailAdressTo(document.getElementById("newEmail").value);
            } else if (xhttp.responseText === "already assigned") {
                alert("Email Adresse wird schon verwendet");
                console.log("Email Adresse wird schon verwendet");
            } else {
                console.log("Fehler beim validieren der neuen Email");
            }
        }
    };
    var url = "PHPFiles/ProfileChanger.php?UserId=" + UserId + "&Check=Email&Email=" + NewEmailAdress;
    xhttp.open("GET", url);
    xhttp.send();
}


function ChangeEmailAdressTo(NewEmailAdress) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            if (xhttp.responseText === "true") {
                alert("Email Adresse erfolgreich geändert");
                document.getElementById("newEmail").value = "";
                document.getElementById("newEmailValidate").value = "";
                document.getElementById("oldEmail").value = "";
            } else {
                alert("Ein fehler beim ändern der Email Adress ist aufgetreten");
            }
        }
    };
    var url = "PHPFiles/ProfileChanger.php?UserId=" + UserId + "&Alter=Email&Email=" + NewEmailAdress;
    xhttp.open("GET", url);
    xhttp.send();
}

function SetUserValues()
{
    var UserNameNode = document.getElementById("UserName");
    UserNameNode.textContent = UserName;

}

function GetUserData()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200)
        {
            var ReturnValue = JSON.parse(xhttp.responseText);
            UserId = ReturnValue["UserId"];
            UserName = ReturnValue["UserName"];
            var DescriptionContent = document.createElement("p");
            DescriptionContent.textContent = ReturnValue["Description"];
            DescriptionContent.className = "text mt-3";
            document.getElementById("Description").appendChild(DescriptionContent);
            var JoinDateElement = document.createElement("p");
            JoinDateElement.textContent = ReturnValue["JoinDate"];
            JoinDateElement.className = "join";
            document.getElementById("JoinDate").appendChild(JoinDateElement);
            SetUserValues();
        }
    };
    var url = "PHPFiles/BackGround.php?Get=UserData";
    xhttp.open("Get", url);
    xhttp.send();
}

function ChangeDescription()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200) {
            if (xhttp.responseText === "true") {
                window.location.reload();
            } else {
                alert("Ein Fehler beim Ändern der Beschreibung ist aufgetreten.");
            }
        }
    };
    var NewDescription = document.getElementById("NewDescription").value;
    var url = "PHPFiles/ProfileChanger.php?UserId=" + UserId + "&Alter=Description&Description=" + NewDescription;
    xhttp.open("GET", url);
    xhttp.send();
}