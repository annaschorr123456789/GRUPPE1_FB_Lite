/*
    THIS FILE CONTAINS FUNCTIONS FOR THE FEED (HOME) PAGE
    Feed.php
*/

var StartRow = 1;
var EndRow = 2;
const PicturePath = "Img/";
var DownLoadIcon = PicturePath + 'DownLoad.png';
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
var UserId = 4;
var UserName = "Ilhan";
var GenNewLine = true;

const ClassNames = {
    CT: "Comment",
    IB: "IconDiv",
    IG: "Picture",
    LI: "LikeIcon",
    EP: "EndOfPage",
    CI: "CommentIcon",
    US: "UserSection",
    UC: "UserComment",
    PA: "PictureArea",
    FE: "FeedElement",
    DI: "DownLoadLink",
    CS: "CommentSection",
    CC: "CommentContainer",
    SB: "SendCommentButton",
    PD: "PictureDescription",
    CMNT: "fas fa-solid fa-comment fa-stack-2x",
    HRT_EMPTY: "fas fa-solid fa-heart fa-3x",
    DWNLD: "fas fa-solid fa-download fa-3x"
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

function AddNewLinesIfNecessary()
{
    if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight - 3000) {
        if (GenNewLine)
        {
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                GenerateNewLine(this);
            };
            feed = document.getElementById("Feed");
            if (feed.childElementCount === 0)
            {
                xhttp.open("GET", "PHPFiles/BackGround.php?Get=LineData&PictureLimit=" + PictureLoadeSpan + "&CommentLimit=" + CommentLoadeSpan + "&Newest", true);
            } else
            {
                var list = document.querySelectorAll(".Picture");
                var last = list[list.length - 1];
                xhttp.open("GET", "PHPFiles/BackGround.php?Get=LineData&StartId=" + last.id + "&PictureLimit=" + PictureLoadeSpan + "&CommentLimit=" + CommentLoadeSpan, true);
            }
            xhttp.send();
            GenNewLine = false;
        }
    }
}

function GenerateNewLine(xhttp)
{
    if (xhttp.status === 200 && xhttp.readyState === 4)
    {
        result = JSON.parse(xhttp.responseText);
        for (i = 0; i < result.length; i++)
        {
            try
            {
                ImageSource = result[i][0]["PictureSrc"];
                ImgId = result[i][0]["PictureId"];
                ImgUploadUserName = result[i][0]["UploadUserName"];
                ImgUploadTime = result[i][0]["UploadTime"];
                CommentCnt = result[i][0]["CommentCnt"];
                console.log("Bild " + ImgId + " hat " + CommentCnt + " Kommentare");
                var Comments = [];
                for (j = 0; j < result[i].length; j++)
                    Comments.push(result[i][j]["CommentId"], result[i][j]["Comment"], result[i][j]["CommentCreatorName"]);
                feed = document.getElementById("Feed");
                feedElement = document.createElement("div");
                feedElement.className = ClassNames.FE;
                feedElement.appendChild(CreatePictureArea(ImageSource, ImgId, ImgUploadUserName, ImgUploadTime));
                feedElement.appendChild((CreateIconBar(ImageSource, ImgId, CommentCnt)));
                feedElement.appendChild(CreateCommentSection(Comments, ImgId));
                feed.appendChild(feedElement);
            } catch (Exception)
            {
                if (document.getElementsByClassName(ClassNames.EP).length === 0)
                {
                    if (result[0].length === 0)
                    {
                        end = document.createElement("p");
                        end.textContent = "Keine weiteren Bilder verfügbar";
                        end.className = ClassNames.EP;
                        feed.appendChild(end);
                    } else
                        console.log("Fehler bei GenerateNewLine\n" + Exception);
                }
            }
        }
    }
    GenNewLine = true;
}

function CreatePictureArea(ImageSource, ImageId, UploadUserName, UploadTime)
{
    var pictureArea = document.createElement("div");
    pictureArea.className = ClassNames.PA;
    pictureArea.appendChild(CreatePicture(ImageSource, ImageId));
    pictureArea.appendChild(CreatePictureDescription(UploadUserName, UploadTime));
    return pictureArea;
}

function CreatePicture(ImageSource, ImageId) {
    var img = document.createElement("img");
    img.src = PicturePath + ImageSource;
    img.className = ClassNames.IG;
    img.id = ImageId;
    img.onerror = function () {
        img.src = PicturePath + DefaultImageName;
    };
    return img;
}

function CreatePictureDescription(UploadUserName, UploadTime) {
    var pictureDescrption = document.createElement("p");
    pictureDescrption.className = ClassNames.PD;
    pictureDescrption.textContent = UploadUserName + " ~ " + UploadTime;
    return pictureDescrption;
}

function CreateIconBar(PictureSource, PictureId, CommentCnt)
{
    var IconBar = document.createElement("div");
    IconBar.className = ClassNames.IB;
    IconBar.appendChild(CreateIcon(ClassNames.CMNT, null, CommentCnt));
    IconBar.appendChild(CreateIcon(ClassNames.HRT_EMPTY, PictureId));
    IconBar.appendChild(CreateIcon(ClassNames.DWNLD, null, PictureSource));
    return IconBar;
}

function CreateIcon(ClassName, PictureId, extra = null)
{
    var Icon = document.createElement("i");
    Icon.className = ClassName;

    switch (Icon.className)
    {
        case ClassNames.DWNLD:
            Icon.id = "DownloadIcon";
            var anchor = document.createElement('a');
            anchor.download = extra;
            anchor.href = PicturePath + extra;
            anchor.appendChild(Icon);
            return anchor;

        case ClassNames.HRT_EMPTY:
            CheckIfPictureIsLiked(Icon, PictureId);
            Icon.onclick = function () {
                AddPictureToFavorites(PictureId, Icon);
            };
            break;

        case ClassNames.CMNT:
            var IconTemp = document.createElement('span');
            IconTemp.className = ClassName;
            IconTemp.id = "CommentIcon";
            var Wrap = document.createElement('span');
            Wrap.className = "fa-stack";
            Wrap.appendChild(IconTemp);
            var Num = document.createElement('strong');
            Num.className = "fa-stack-1x";
            Num.textContent = extra;
            Num.id = "CommentIconNumber";
            Wrap.appendChild(Num);
            Icon = Wrap;
            break;

        default:
            console.log("Fehler bei Iconerstellung");
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
    CommentContainer.onscroll = function () {
        AddNewCommentIfNecessary(PictureId, 0 + PictureId, CommentLoadeSpan);
    };
    if (!Comments[0] && !Comments[1] && !Comments[2])
        return CommentContainer;
    for (k = 0; k < Comments.length; k += 3)
    {
        CommentContainer.appendChild(CreateComment(Comments[k], Comments[k + 1], Comments[k + 2]));
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
    SubmitButton.onclick = function () {
        SafeUserComment(PictureId);
    };
    return SubmitButton;
}

function AddNewCommentIfNecessary(PictureId, CommentContainerId, Cnt)
{
    var element = document.getElementById(CommentContainerId);
    if (element.offsetHeight + element.scrollTop >= element.scrollHeight)
    {
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            GenerateNewComments(this, element);
        };
        url = "PHPFiles/BackGround.php?Get=Comments&PictureId=" + PictureId + "&LastCommentId=" + element.lastElementChild.id + "&Order=desc&CommentLimit=" + Cnt + ";";
        xhttp.open("GET", url, true);
        xhttp.send();
    }
}

function GenerateNewComments(xhttp, CommentContainer)
{
    if (xhttp.status === 200 && xhttp.readyState === 4)
    {
        res = JSON.parse(xhttp.responseText);
        for (i = 0; i < res.length; i++)
        {
            try
            {
                CommentContainer.appendChild(CreateComment(res[i]["KommentarId"], res[i]["Kommentar"], res[i]["BenutzerName"]));
            } catch (Exception)
            {
                console.log(Exception);
            }
        }
    }
}

function SafeUserComment(PictureId)
{
    UserComment = document.getElementById("U" + PictureId);
    Comment = UserComment.value;
    if (!Comment)
        return;

    UserComment.value = "";
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        AppendWrittenComment(this, 0 + PictureId, Comment);
    };
    url = "PHPFiles/BackGround.php?Add=Comment&Comment=" + Comment + "&PictureId=" + PictureId + "&UserId=" + UserId;
    xhttp.open("GET", url);
    xhttp.send();
}

function AddPictureToFavorites(PictureId, LikeIconImg)
{
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (xhttp.status === 404)
            console.log("Verbindung zum Server fehlgeschlagen.");
        if (xhttp.status === 200 && xhttp.readyState === 4)
        {
            if (xhttp.responseText === "added")
                LikeIconImg.style.cssText = "color: red";
            else
                LikeIconImg.style.cssText = "color: black";
        }
    };
    url = "PHPFiles/BackGround.php?Add=FavorisedPicture&PictureId=" + PictureId + "&UserId=" + UserId;
    xhttp.open("GET", url);
    xhttp.send();
}

function AppendWrittenComment(xhttp, CommentContainerId, Comment)
{
    if (xhttp.status === 200 && xhttp.readyState === 4)
        document.getElementById(CommentContainerId).insertBefore(CreateComment(xhttp.responseText, Comment, UserName), document.getElementById(CommentContainerId).childNodes[0]);
}

function CheckIfPictureIsLiked(Icon, PictureId)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        AlterIconPicture(Icon, xhttp);
    };
    url = "PHPFiles/BackGround.php?Get=PictureLiked&PictureId=" + PictureId + "&UserId=" + UserId;
    xhttp.open("GET", url);
    xhttp.send();
}

function AlterIconPicture(Icon, xhttp)
{
    if (xhttp.status === 404)
        console.log("Verbindung zum Server fehlgeschlagen.");
    if (xhttp.status === 200 && xhttp.readyState === 4)
    {
        if (xhttp.responseText === "Liked")
            Icon.style.cssText = "color: red";
    }
}