const NewTopicsToLoad = 10;
const NewQuestionsToLoadCnt = 10;
const UrlStart = "PHPFiles/ForumMainPageBackground.php?";
const SpecificForumStart = "ForumArticlePage.php?";
const ForumArticleOverviewStart = "ForumArticleOverviewPage.php";

const ClassNames = {
    IW:"innerWrap",
    IC:"innerCont",
    IN:"inner"
};

function LoadNewLine(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {PrintNewLines(xhttp);};
    var url = UrlStart + "Get=NewLine&" + "&QuestionsToLoad=" + NewQuestionsToLoadCnt + "&TopicsToLoad=" + NewTopicsToLoad;
    if(document.getElementsByClassName(ClassNames.IW)[0].childElementCount - 1 === 0){
        url  += "&Newest";
        console.log("Loading Newest");
    }
    else{
        var LastLoadedLine = document.getElementsByClassName(ClassNames.IW)[0].lastElementChild.id;
        url += "&LastLoaded=" + LastLoadedLine;
    }
    xhttp.open("GET", url);
    xhttp.send();
}

function PrintNewLines(xhttp){
    if(xhttp.status === 404){
        console.log("Seite konnte nicht gefunden werden");
    }
    if(xhttp.readyState === 4 && xhttp.status === 200){
        var response = JSON.parse(xhttp.responseText);
        for(var i = 0; i < response.length; i++){
            var Container = document.getElementsByClassName("innerWrap")[0];
            Container.appendChild(CreateInnerContent(response[i]["Topic"], response[i]["Questions"]));
        }
    }
}

function CreateInnerContent(Topic, Questions){
    var innerContent = document.createElement("div");
    innerContent.id = Topic["TopicId"];
    innerContent.className = ClassNames.IC;
    innerContent.appendChild(CreateInner(Topic, Questions, innerContent.id));
    return innerContent;
}

function CreateInner(Topic, Questions, TopicId){
    var inner = document.createElement("div");
    inner.className = ClassNames.IN;
    inner.appendChild(CreateHeadLine(Topic));
    inner.appendChild(CreateQuestionList(Questions, TopicId));
    return inner;
}

function CreateHeadLine(Topic){
    var HeadLine = document.createElement("h4");
    HeadLine.textContent = Topic["Topic"];
    return HeadLine;
}

function CreateQuestionList(Questions, TopicId){
    var QuestionList = document.createElement("ul");
    for(var i = 0; i < Questions.length; i++){
        QuestionList.append(CreateListItem(Questions[i]["Question"], SpecificForumStart+"QuestionId=" + Questions[i]["QuestionId"]));
    }
    QuestionList.append(QuestionEndLine(TopicId));
    return QuestionList;
}

function QuestionEndLine(TopicId){
    var anchor = document.createElement("a");
    anchor.href = ForumArticleOverviewStart + "?TopicId=" + TopicId;
    anchor.textContent = "Alles anzeigen";
    return anchor;
}

function CreateListItem(Question, href){
    var ListItem = document.createElement("li");
    ListItem.append(CreateAnchor(Question, href));
    return ListItem;
}

function CreateAnchor(Question, href){
    var anchor = document.createElement("a");
    anchor.href = href;
    anchor.textContent = Question + "?";
    return anchor;
}