<?php

session_start();

require_once 'FaceBookLiteConnection.php';

$pdo = new FaceBookLiteConnection();
$res = [];
if(filter_has_var(INPUT_GET, "Get")){
    try {
        if(filter_input(INPUT_GET, "Get") == "Questions"){
            $TopicId = filter_input(INPUT_GET, "TopicId");
//                  select Frage as Question, f.ErstellDatum as CreationDate, FragenId as QuestionId, ThemenId as TopicId, Geschlossen as Closed, b.BenutzerName as UserName, b.BenutzerId as UserId from frage f join Benutzer b on f.ErstellerId = b.BenutzerId where ThemenId = 1;
            $sql = "select Frage as Question, Ueberschrift as Caption, f.ErstellDatum as CreationDate, FragenId as QuestionId, ThemenId as TopicId, Geschlossen as Closed, b.BenutzerName as UserName, b.BenutzerId as UserId from frage f join Benutzer b on f.ErstellerId = b.BenutzerId where ThemenId = ". $TopicId . " order by CreationDate desc;";
            $res[0] = $pdo->query($sql);
            $tmpres = [];
            $tmpres2 = [];
            for($i = 0; $i < count($res[0]); $i++){
                $sql = "select Id as AnswerId, Antwort as Answer, FragenId as QuestionId, ErstellerId as AnswerUserId, ErstellDatum as AnswerDate, b.BenutzerName as AnswerUserName from antwort a join benutzer b on a.ErstellerId = b.BenutzerId where FragenId = " . $res[0][$i]['QuestionId'] . " order by ErstellDatum desc Limit 1;";
                $tmpres[$i] = $pdo->query($sql);
                $sql = "select count(*) as AnswerCnt from antwort where FragenId = " . $res[0][$i]['QuestionId'] .";";
                $tmpres2[$i] = $pdo->query($sql);
            }
            $res[1] = $tmpres;
            $res[2] = $tmpres2;
        }
        echo json_encode($res);
        
        
    } catch (Exception $exc) {
        echo json_encode($exc->getTraceAsString());
    }
}
else if(filter_has_var(INPUT_GET, "Add")){
    try {
        
        
    } catch (Exception $exc) {
        echo json_encode($exc->getTraceAsString());
    }
}