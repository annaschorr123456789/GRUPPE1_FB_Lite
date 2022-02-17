/*
    THIS FILE CONTAINS FUNCTIONS FOR THE FORUM PAGES
   ForumNewQuestionPage.html
   ForumNewTopicPage.html
*/

function openDialog(id)
{
    var dialog = document.querySelector(id);

    if (!dialog.hasAttribute('open')) {
        dialog.setAttribute('open', 'open');
    }
}

function openPopup() {
    var popup1 = document.getElementById("myPopup");
    popup1.classList.toggle("show");
}

