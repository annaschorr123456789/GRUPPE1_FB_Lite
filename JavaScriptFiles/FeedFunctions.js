var StartRow = 1;
var EndRow = 2;
var KommentarIcon = 'Bilder/Kommentar.png';
var LikeIcon = 'Bilder/Like.png';
var LikedIcon = 'Bilder/LikeRed.png';
var DownLoadIcon = 'Bilder/DownLoad.png';
const ImageEndId = 1;
const CommentIconEndId = 2;
const LikeIconEndId = 3;
const DownloadIconEndId = 4;
const CommentEndId = 5;
const CommentSectionEndId = 6;
const OwnCommentEndId = 7;
const ButtonEndId = 8;
var LastLoadedIndex = 0;
const LoadNewLineSpan = 10;
const PictureLoadeSpan = 10;
const CommentLoadeSpan = 10;
const DefaultImageName = "DefaultImage.png";
const PicturePath = "Bilder/";
var UserId = 4;
var UserName = "Ilhan";
var GenNewLine = true;
// use md5 vielleicht mit salt
// pdo prepared statements

const ClassNames = {
    CT:"Comment",
    IB:"IconDiv",
    IG:"Picture",
    LI:"LikeIcon",
    CI:"CommentIcon",
    US:"UserSection",
    UC:"UserComment",
    DI:"DownLoadLink",
    CS:"CommentSection",
    CC:"CommentContainer",
    SB:"SendCommentButton",
    EP:"EndOfPage"
};

function AddNewLinesIfNecessary()
{
//    Get=LineData&Limit=10&Newest          |   newest Line Data
//    Get=LineData&PictureId=1&Limit=10     |   LineData after explicite PictureId
    if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
        if(GenNewLine)
        {
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {GenerateNewLine(this);};
            feed = document.getElementById("Feed");
            if(feed.childElementCount === 0)
            {
                xhttp.open("GET", "BackGround.php?Get=LineData&PictureLimit=" + PictureLoadeSpan + "&CommentLimit=" + CommentLoadeSpan + "&Newest", true);
            }
            else
            {
                var list = document.querySelectorAll(".Picture");
                var last = list[list.length - 1];
                xhttp.open("GET", "BackGround.php?Get=LineData&StartId=" + last.id + "&PictureLimit=" + PictureLoadeSpan + "&CommentLimit=" + CommentLoadeSpan, true);
            }
            xhttp.send();
            GenNewLine = false;
        }
    }
}

function GenerateNewLine(xhttp)
{
    if(xhttp.status === 200 && xhttp.readyState === 4)
    {
        result = JSON.parse(xhttp.responseText);
        for(i = 0; i < result.length; i++)
        {
            try
            {
                ImageSource = result[i][0]["BildQuelle"];
                ImgId = result[i][0]["BildId"];
                var Comments = [];
                for(j = 0; j < result[i].length; j++)
                    Comments.push(result[i][j]["KommentarId"], result[i][j]["Kommentar"], result[i][j]["BenutzerName"]);
                feed = document.getElementById("Feed");
                feed.appendChild(CreatePicture(ImageSource, ImgId));
                feed.appendChild((CreateIconBar(ImageSource, ImgId)));
                feed.appendChild(CreateCommentSection(Comments, ImgId));
            }
            catch(Exception)
            {
                if(document.getElementsByClassName(ClassNames.EP).length === 0)
                {
                    if(result[0].length === 0)
                    {
                        end = document.createElement("p");
                        end.textContent = "Keine weiteren Bilder verfügbar";
                        end.className = ClassNames.EP;
                        feed.appendChild(end);
                    }
                    else
                    console.log("Fehler bei GenerateNewLine\n" + Exception);
                }
            }
        }
    }
    GenNewLine = true;
}

function CreatePicture(ImageSource, ImageId)
{
    var img = document.createElement("img");
    img.src = PicturePath + ImageSource;
    img.className = ClassNames.IG;
    img.id = ImageId;
    img.onerror = function() {
        img.src = PicturePath + DefaultImageName;
    };
    return img;
}

function CreateIconBar(PictureSource, PictureId)
{
    var IconBar = document.createElement("div");
    IconBar.className = ClassNames.IB;
    IconBar.appendChild(CreateIcon(ClassNames.CI, KommentarIcon));
    IconBar.appendChild(CreateIcon(ClassNames.LI, LikeIcon, PictureId));
    IconBar.appendChild(CreateIcon(ClassNames.DI, DownLoadIcon, null, PictureSource));
    return IconBar;
}

function CreateIcon(ClassName, Source, PictureId, link = null)
{
    var Icon = document.createElement("img");
    Icon.src = Source;
    Icon.className = ClassName;
    
    switch(Icon.className)
    {
        case ClassNames.DI:
            var anchor = document.createElement('a');
            anchor.download = link;
            anchor.href = PicturePath + link;
            anchor.appendChild(Icon);
            return anchor;
        
        case ClassNames.LI:
            Icon.onclick = function() {
                AddPictureToFavorites(PictureId, Icon);
            };
            break;
            
        case ClassNames.CI:
            
            break;
            
        default:
            console.log("Fehler bei Icon erstellung");
            break;
    }
    return Icon;
}

function CreateCommentSection(Comments, PictureId)
{
    var CommentSection = document.createElement("div");
    CommentSection.className = ClassNames.CS;
    CommentSection.appendChild(CreateCommentContainer(Comments, PictureId));
    CommentSection.appendChild(CreateUserSection(PictureId));
    return CommentSection;
}

function CreateCommentContainer(Comments, PictureId)
{       
    var CommentContainer = document.createElement("div");
    CommentContainer.className = ClassNames.CC;
    CommentContainer.id = 0 + PictureId;
    CommentContainer.onscroll = function(){AddNewCommentIfNecessary(PictureId, 0 + PictureId, CommentLoadeSpan);};
    if(!Comments[0] && !Comments[1] && !Comments[2])
        return CommentContainer;
    for(k = 0; k < Comments.length; k+=3)
    {
        CommentContainer.appendChild(CreateComment(Comments[k], Comments[k+1], Comments[k+2]));
    }
    return CommentContainer;
}

function CreateComment(CommentId, Commentery, UserName)
{
    var Comment = document.createElement("p");
    Comment.id = CommentId;
    Comment.className = ClassNames.CT;
    Comment.textContent = Commentery;
    Comment.textContent += "\n~" + UserName;
    return Comment;
}

function CreateUserSection(PictureId)
{
    var UserSection = document.createElement("div");
    UserSection.className = ClassNames.US;
    UserSection.appendChild(CreateUserComment(PictureId));
    UserSection.appendChild(CreateSubmitButton(PictureId));
    return UserSection;
}

function CreateUserComment(PictureId)
{
    var UserComment = document.createElement("textarea");
    UserComment.className = ClassNames.UC;
    UserComment.id = "U" + PictureId;
    UserComment.placeholder = "Verfasse hier deinen Kommentar";
    return UserComment;
}

function CreateSubmitButton(PictureId)
{
    var SubmitButton = document.createElement("button");
    SubmitButton.textContent = "Kommentieren";
    SubmitButton.className = ClassNames.SB;
    SubmitButton.onclick = function() {SafeUserComment(PictureId);};
    return SubmitButton;
}

function AddNewCommentIfNecessary(PictureId, CommentContainerId, Cnt)
{
    var element = document.getElementById(CommentContainerId);
    if (element.offsetHeight + element.scrollTop >= element.scrollHeight)
    {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {GenerateNewComments(this, element);};
        url = "BackGround.php?Get=Comments&PictureId=" + PictureId + "&LastCommentId=" + element.lastElementChild.id + "&Order=desc&CommentLimit=" + Cnt + ";";
        console.log(url);
        xhttp.open("GET", url, true);
        xhttp.send();
    }
}

function GenerateNewComments(xhttp, CommentContainer)
{
    if(xhttp.status === 200 && xhttp.readyState === 4)
    {
        res = JSON.parse(xhttp.responseText);
        for(i = 0; i < res.length; i++)
        {
            try
            {
                CommentContainer.appendChild(CreateComment(res[i]["KommentarId"], res[i]["Kommentar"], res[i]["BenutzerName"]));
            }
            catch(Exception)
            {
                console.log(Exception);
            }
        }
    }
}

function SafeUserComment(PictureId)
{
    UserComment = document.getElementById("U"+PictureId);
    Comment = UserComment.value;
    if(!Comment)
        return;
    
    UserComment.value = "";
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {AppendWrittenComment(this, 0+PictureId, Comment);};
    url = "BackGround.php?Add=Comment&Comment=" + Comment +"&PictureId=" + PictureId + "&UserId=" + UserId;
    xhttp.open("GET", url);
    xhttp.send();
}

function AddPictureToFavorites(PictureId, LikeIconImg)
{
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(xhttp.status === 404) 
            console.log("Verbindung zum Server fehlgeschlagen.");
        if(xhttp.status === 200 && xhttp.readyState === 4)
        {
            if(xhttp.responseText === "added")
                LikeIconImg.src = LikedIcon;
            else
                LikeIconImg.src = LikeIcon;
        }
    };
    url = "BackGround.php?Add=FavorisedPicture&PictureId=" + PictureId + "&UserId=" + UserId;
    xhttp.open("GET", url);
    xhttp.send();
}

function AppendWrittenComment(xhttp, CommentContainerId, Comment)
{
    if(xhttp.status === 200 && xhttp.readyState === 4)
        document.getElementById(CommentContainerId).insertBefore(CreateComment(xhttp.responseText, Comment, UserName),document.getElementById(CommentContainerId).childNodes[0]);
}