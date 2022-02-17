<?php

require_once 'FaceBookLiteConnection.php';
$pdo = new FaceBookLiteConnection();

if(filter_has_var(INPUT_GET, "Get")){
    if(filter_input(INPUT_GET, "Get") == "Answer"){
        $QuestionId = filter_input(INPUT_GET, "QuestionId");
        if(filter_has_var(INPUT_GET, "Newest")){
            $sql = "select Id as AnswerId from Antwort where FragenId = " . $QuestionId . " order by ErstellDatum desc Limit 1;";
            $res = $pdo->query($sql);
            $LastLoadedAnswer = $res[0]["AnswerId"]+1;
        }
        else
        {
            $LastLoadedAnswer = filter_input(INPUT_GET, "LastLoadedAnswer") + 1;
        }
        $AnswerLimit = filter_input(INPUT_GET, "AnswerLimit");
        $sql = "select Id, Antwort as Answer, b.BenutzerName as Creator, ErstellDatum as CreationDate from antwort a join benutzer b on a.ErstellerId = b.BenutzerId where FragenId = " . $QuestionId ." and Id < " . $LastLoadedAnswer . " order by CreationDate desc Limit " . $AnswerLimit . ";";
        $res = $pdo->query($sql);
    }
    echo json_encode($res);
}
else if(filter_has_var(INPUT_GET, "Add")){
    if(filter_input(INPUT_GET, "Add") == "Answer"){
        try {
            $Answer = filter_input(INPUT_GET, "Answer");
            $QuestionId = filter_input(INPUT_GET, "QuestionId");
            $UserId = filter_input(INPUT_GET, "UserId");
            $sql = "insert into Antwort(Antwort, FragenId, ErstellerId) values('" . $Answer . "', " . $QuestionId . ", " . $UserId . ");";
            $pdo->execute($sql);
            echo "true";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

    }
}