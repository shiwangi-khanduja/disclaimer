
document.addEventListener('DOMContentLoaded', function() {
   
    window.addEventListener('scroll', function() {
        var popupShown = false;
        var accepts = document.getElementsByClassName("disclamier-button")[0];
        var decline = document.getElementsByClassName("disclamier-decline")[0];
        var modal = document.getElementById('myModal');
        let cookie_consent = getCookie("user_cookie_consent");

        if (window.scrollY > 500 && !popupShown ) {
            if (modal && cookie_consent == "") {
                modal.style.display = 'block';
                popupShown = true;
            }else{
                modal.style.display = 'none';
                popupShown = false;
            }
        }
        // When the user clicks accepts save cookies and close popup.
        accepts.onclick = function() {
            deleteCookie('user_cookie_consent');
            setCookie('user_cookie_consent', 1, 30);
            modal.style.display = "none";
        }

        // When the user clicks decline save cookies and close popup.
        decline.onclick = function() {
            modal.style.display = "none";
        }
    });
});

// Create cookie
function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// Delete cookie
function deleteCookie(cname) {
    const d = new Date();
    d.setTime(d.getTime() + (24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=;" + expires + ";path=/";
}

// Read cookie
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

