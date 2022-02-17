var UserName = "";
var UserId = 0;
const Background = "PHPFiles/ForumArticleOverviewBackground.php?";
const GetUserBackground = "PHPFiles/BackGround.php?";
const SingleQuestionPage = "ForumArticlePage.php?";

function GetUserData(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if(xhttp.readyState === 4 && xhttp.status === 200)
        {
            var ReturnValue = JSON.parse(xhttp.responseText);
            UserId = ReturnValue["UserId"];
            UserName = ReturnValue["UserName"];
        }
    };
    var url = GetUserBackground + "Get=UserData";
    xhttp.open("Get", url);
    xhttp.send();
}

function LoadQuestions(TopicId){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.readyState === 4 && xhttp.status === 200){
            var response = JSON.parse(xhttp.responseText);
            for(var i = 0; i < response[0].length; i++){
                document.getElementById("QuestionContainer").appendChild(CreateNewRow(response[0][i], response[1][i], response[2][i][0].AnswerCnt));
            }
        }
    };
    var url = Background + "Get=Questions&TopicId="+TopicId;
    xhttp.open("GET", url);
    xhttp.send();
}

function CreateNewRow(Data, Info, AnswerCnt){
    var row = document.createElement("div");
    row.className = "row";
    row.appendChild(CreateCol5(Data.Caption, Data.Question, "Frage von " + Data.UserName, Data.CreationDate, Data.QuestionId, true));
    if(Info.length === 0){
        row.appendChild(CreateCol5("Letze Antwort", "Keine Antworten", ""));
    }
    else
    row.appendChild(CreateCol5("Letze Antwort", Info[0].Answer, "Antwort von " + Info[0].AnswerUserName, Info[0].AnswerDate));
    row.appendChild(CreateCol(Data.Closed, AnswerCnt));
    return row;
}

function CreateCol5(HeaderText, QuestionText, QuestionUserName, Date, QuestionId, WithAnchor){
    var Col5 = document.createElement("div");
    Col5.className = "col-5";
    Col5.appendChild(CreateInnerContent(HeaderText, QuestionText, QuestionUserName, Date, QuestionId, WithAnchor));
    return Col5;
}

function CreateInnerContent(HeaderText, QuestionText, QuestionUserName, Date, QuestionId, WithAnchor){
    var InnerContent = document.createElement("div");
    InnerContent.className = "innerCont";
    InnerContent.appendChild(CreateHeader(HeaderText, QuestionId, WithAnchor));
    InnerContent.appendChild(CreateQuestionText(QuestionText));
    InnerContent.appendChild(CreateQuestionUser(QuestionUserName, Date));
    return InnerContent;
}

function CreateHeader(Text, QuestionId, WithAnchor = false){
    var Header = document.createElement("h4");
    if(WithAnchor)
        Header.appendChild(CreateAnchor(SingleQuestionPage + "QuestionId=" + QuestionId, Text));
    else
        Header.textContent = Text;
    return Header;
}

function CreateAnchor(href, Text){
    var anchor = document.createElement("a");
    anchor.className = "QuestionHeader";
    anchor.href = href;
    anchor.textContent = Text;
    return anchor;
}

function CreateQuestionText(Text){
    var QuestionText = document.createElement("p");
    QuestionText.className = "QuestionText";
    QuestionText.textContent = Text;
    return QuestionText;
}

function CreateQuestionUser(Text, Date){
    var QuestionUser = document.createElement("p");
    QuestionUser.className = "QuestionUser";
    QuestionUser.textContent = Text + " am " + Date;
    return QuestionUser;
}

function CreateCol(ClosedQuestion, AnswerCnt){
    var col = document.createElement("div");
    col.className = "col";
    col.appendChild(CreateColInnerContent(ClosedQuestion, AnswerCnt));
    return col;
}

function CreateColInnerContent(ClosedQuestion, AnswerCnt){
    var ColInnerContent = document.createElement("div");
    ColInnerContent.className = "innerCont";
    ColInnerContent.appendChild(CreateHeader("Info"));
    var text = "Status: ";
    if(ClosedQuestion)
        text += "geschlossen";
    else
        text += "offen";
    text += "\r\nAntworten: " + AnswerCnt;
    ColInnerContent.appendChild(CreateQuestionText(text));
    return ColInnerContent;
}