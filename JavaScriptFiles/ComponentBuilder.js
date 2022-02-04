
function BuildComponents(footer, menu)
{
    if(footer == "Footer")
        BuildFooter();
    if(menu == "Menu")
        BuildMenu();
}


function BuildFooter()
{
    $.ajax({
            url:"ComponentBuilder.php",    
            type: "get",    
            dataType: 'text',
            success:function(result){
                var footer = document.createElement('div');
                footer.setAttribute('class', 'Footer');
                footer.innerHTML = result;
                document.getElementById('FooterTarget').appendChild(footer);
            }
        });
        
        
        var footer = document.createElement('div');
                footer.setAttribute('class', 'Footer');
                footer.innerHTML = "Test";
                document.getElementById('FooterTarget').appendChild(footer);
        
    
}

function BuildMenu()
{
    
}

function Replace()
{
    div.innerHTML = div.innerHTML
        .replace(/{VENDOR}/g, 'ACME Inc.')
        .replace(/{PRODUCT}/g, 'Best TNT')
        .replace(/{PRICE}/g, '$1.49');
}
