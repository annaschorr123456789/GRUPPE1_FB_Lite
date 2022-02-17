<?php

require_once 'FaceBookLiteConnection.php';

$pdo = new FaceBookLiteConnection();

if(filter_has_var(INPUT_GET, "Get")){
    if(filter_input(INPUT_GET, "Get") == "NewLine"){
        if(filter_has_var(INPUT_GET, "Newest")){
            $sql = "select ThemenId as LastLoadedTopic from Thema order by ErstellDatum desc Limit 1;"; 
            $res = $pdo->query($sql);
            $LastLoadedLine = $res[0]["LastLoadedTopic"];
        }
        else{
            $LastLoadedLine = filter_input(INPUT_GET, "LastLoaded");
        }
        $QuestionLimit = filter_input(INPUT_GET, "QuestionsToLoad");
        $TopicsToLoad = filter_input(INPUT_GET, "TopicsToLoad");
        $sql = "select ThemenId as TopicId, ThemenName as Topic from Thema where ThemenId < " . $LastLoadedLine . " order by ErstellDatum desc LIMIT ". $TopicsToLoad . ";";
        $TopicIds = $pdo->query($sql);
        for($j = 0, $i = 0; $i < count($TopicIds) * 2; $i+=2, $j++){
            $sql = "select Ueberschrift as Question, ErstellDatum as CreationDate, b.BenutzerName as Questioner, FragenId as QuestionId from Frage f join Benutzer b on b.BenutzerId = f.ErstellerId where ThemenId = " . $TopicIds[$j]["TopicId"] . " order by ErstellDatum desc LIMIT " . $QuestionLimit . ";";
            $res[$j]["Topic"] = $TopicIds[$j];
            $res[$j]["Questions"] = $pdo->query($sql);
        }
        echo json_encode($res);
    }
}