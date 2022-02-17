const AnswersToLoad = 20;
const BackgroundUrl = "PHPFiles/ForumArticlePageBackground.php?";
var UserId = 4;
var UserName = "Ilhan";

const ClassNames = {
    AWC:"answerContainer",
    AWE:"answerElement",
    AW:"answer",
    UD:"UserDescription"
};


function GetUserData()
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState === 4 && xhttp.status === 200)
        {
            var ReturnValue = JSON.parse(xhttp.responseText);
            UserId = ReturnValue["UserId"];
            UserName = ReturnValue["UserName"];
            AddNewLinesIfNecessary();
        }
    };
    var url = "PHPFiles/BackGround.php?Get=UserData";
    xhttp.open("Get", url);
    xhttp.send();
}

function AddNewAnswersIfNecessary(QuestionId){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {AddNewAnswers(xhttp);};
    if(document.getElementsByClassName(ClassNames.AWC)[0].childElementCount === 0){
        var url = BackgroundUrl + "Get=Answer&AnswerLimit=" + AnswersToLoad + "&Newest&QuestionId=" + QuestionId;
    }
    else{
        var list = document.querySelectorAll(".answers");
        var LastLoadedAnswer = list[list.length - 1].id;
        var url = BackgroundUrl + "Get=Answer&AnswerLimit=" + AnswersToLoad + "&LastLoadedAnswer=" + LastLoadedAnswer + "&QuestionId=" + QuestionId;
    }
    xhttp.open("GET", url);
    xhttp.send();
}

function AddNewAnswers(xhttp){
    if(xhttp.status === 200 && xhttp.readyState === 4){
        var result = JSON.parse(xhttp.responseText);
        var answers = document.getElementsByClassName(ClassNames.AWC)[0];
        for(var i = 0; i < result.length; i++){
            answers.appendChild(CreateNewAnswer(result[i]["Answer"]));
            answers.appendChild(CreateNewUserDescription(result[i]["Creator"], result[i]["CreationDate"]));
        }
    }
}

function CreateNewAnswer(answertext){
    var answer = document.createElement("div");
    answer.className = ClassNames.AW;
    answer.textContent = answertext;
    return answer;
}

function CreateNewUserDescription(UserName, Date){
    var UserDescription = document.createElement("div");
    UserDescription.className = ClassNames.UD;
    UserDescription.textContent = Date + " ~ " + UserName;
    return UserDescription;
}

function AddAnswerToQuestion(QuestionId){
    var Answer = document.getElementById("UserComment").value;
    if(Answer === ""){
        alert("Schreibe erst eine Antwort bevor du sie abschickst");
        return;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(xhttp.status === 200 && xhttp.readyState === 4){
            if(xhttp.responseText === "true"){
                AppendWrittenComment(document.getElementsByClassName(ClassNames.AWC)[0], Answer);
                alert("Erfolgreich geantwortet");
            }
            else{
                alert("Fehler beim antworten");
                console.log(xhttp.responseText);
            }
        }
    };
    var url = BackgroundUrl + "Add=Answer&Answer=" + Answer + "&QuestionId=" + QuestionId + "&UserId=" + UserId;
    xhttp.open("GET", url);
    xhttp.send();
}

function AppendWrittenComment(AnswerContainer, Answer)
{
    AnswerContainer.insertBefore(CreateNewAnswer(Answer),AnswerContainer.childNodes[0]);
    var today = new Date();
    var date = today.getFullYear()+'-';
    if(today.getMonth()+1 < 10)
        date += "0";
    date += (today.getMonth()+1)+'-';
    if(today.getDate() < 10)
        date += "0";
    date += today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    
    AnswerContainer.insertBefore(CreateNewUserDescription(UserName, date + " " + time),AnswerContainer.childNodes[1]);
}