<?php

/*
 * Connection between sql database and website
 */

session_start();

require_once 'FaceBookLiteConnection.php';

$pdo = new FaceBookLiteConnection();
$res = [];
if (filter_has_var(INPUT_GET, "Get")) {
    $Limit = filter_input(INPUT_GET, "CommentLimit");
    if (filter_input(INPUT_GET, "Get") == "Comments") { // Returns new Comment Data
        $PictureId = filter_input(INPUT_GET, "PictureId");
        $CommentId = filter_input(INPUT_GET, "LastCommentId");
        $Limit = filter_input(INPUT_GET, "CommentLimit");
        $sql = "select KommentarId, Kommentar, BenutzerName from Kommentare k inner join benutzer b on k.BenutzerId = b.BenutzerId where BildId = " . $PictureId . " and KommentarId < " . $CommentId . " order by KommentarId desc Limit " . $Limit . ";";
        $res = $pdo->query($sql);
    } else if (filter_input(INPUT_GET, "Get") == "LineData") { // Returns new Line Data
        if (filter_has_var(INPUT_GET, "Newest")) {
            $res = $pdo->query("select BildId as PictureId from Bilder order by BildId desc Limit 1;");
            $PictureId = $res[0]["PictureId"];
            $PictureId++;
        } else {
            $PictureId = filter_input(INPUT_GET, "StartId");
        }

        for ($j = 0, $i = $PictureId - 1; $i > $PictureId - filter_input(INPUT_GET, "PictureLimit"); $i--, $j++) {
            $sql = "SELECT b.Quelle AS PictureSrc, b.BildId AS PictureId, b.HochladeZeit as UploadTime, b.BenutzerId as UserId, k.KommentarId AS CommentId, k.Kommentar AS Comment, Benutzer.BenutzerName as CommentCreatorName, (select BenutzerName from Benutzer where BenutzerId = b.BenutzerId) as UploadUserName, (SELECT COUNT(*) FROM Kommentare WHERE BildId = PictureId) AS CommentCnt FROM Bilder b LEFT JOIN kommentare k ON b.BildId = k.BildId left join benutzer on k.BenutzerId = benutzer.BenutzerId WHERE b.BildId = " . $i . " ORDER BY k.KommentarId desc LIMIT " . $Limit . ";";
            $res[$j] = $pdo->query($sql);
        }
    } else if (filter_input(INPUT_GET, "Get") == "PictureLiked") {
        $PictureId = filter_input(INPUT_GET, "PictureId");
        $UserId = filter_input(INPUT_GET, "UserId");
        $sql = "select count(*) as Liked from LikedPictures where BildId = " . $PictureId . " and BenutzerId = " . $UserId . ";";
        $res = $pdo->query($sql);
        if ($res[0]["Liked"] == 1) {
            echo "Liked";
        } else {
            echo "NotLiked";
        }

        return;
    } else if (filter_input(INPUT_GET, "Get") == "UserData") {
        $UserName = $_SESSION["loggedInAs"];
        $sql = "SELECT MitgliedSeit AS JoinDate, BenutzerId AS UserID, Beschreibung as Description FROM Benutzer WHERE BenutzerName = '" . $UserName . "';";
        $res = $pdo->query($sql);
        $UserId = $res[0]["UserID"];
        $return["UserId"] = $UserId;
        $return["UserName"] = $UserName;
        $Description = $res[0]["Description"];
        $return["Description"] = $Description;
        $JoinDate = $res[0]["JoinDate"];
        $return["JoinDate"] = $JoinDate;
        echo json_encode($return);
        return;
    } else {
        $sql = "";
    }
    echo json_encode($res);
}

if (filter_has_var(INPUT_GET, "Add")) {
    if (filter_input(INPUT_GET, "Add") === "Comment") {
        $Comment = filter_input(INPUT_GET, "Comment");
        $PictureId = filter_input(INPUT_GET, "PictureId");
        $sql = "select max(KommentarId) as KommentarId from Kommentare where BildId = " . $PictureId . ";";
        $BiggestCommentId = $pdo->query($sql)[0]["KommentarId"];
        $BiggestCommentId++;
        $UserId = filter_input(INPUT_GET, "UserId");
        $sql = "insert into Kommentare values(" . $BiggestCommentId . "," . $PictureId . "," . $UserId . ",'" . $Comment . "');";
        $pdo->execute($sql);
        echo $BiggestCommentId;
    }

    if (filter_input(INPUT_GET, "Add") === "FavorisedPicture") {
        $PictureId = filter_input(INPUT_GET, "PictureId");
        $UserId = filter_input(INPUT_GET, "UserId");
        $sql = "insert into LikedPictures values(" . $PictureId . "," . $UserId . ");";
        try {
            $pdo->execute($sql);
            echo "added";
        } catch (Exception $ex) {
            $sql = "DELETE FROM LikedPictures WHERE BildId = " . $PictureId . " and BenutzerId = " . $UserId . ";";
            $pdo->execute($sql);
            echo "deleted";
        }
    }
}