$j = jQuery.noConflict();

$j(document).ready(function() {
    var head = document.getElementsByTagName('head')[0];
    var loadcss = document.createElement('link');
    loadcss.rel = 'stylesheet';
    loadcss.type = 'text/css';
    loadcss.href = 'http://clipplayboy.com/public/css/helloAdsStyle.css';
    loadcss.media = 'all';
    head.appendChild(loadcss);
    var listLink = new Array();
    listLink["https://google.com"] = "Trang google";
    listLink["https://facebook.com"] = "Trang facebook";
    listLink["http://dantri.com.vn"] = "Trang dan tri";
    var dateAds = "";
    //
    dateAds += '<div class="bgtran"></div><div class="flagclassapp"><div id="app">' +
            '<div class="title">' +
            '<h3>dowload app <img onclick="closepopupads();"; src="http://clipplayboy.com/public/css/img/icon.png" alt=""></h3>' +
            '</div>' +
            '<div class="app">';
    var key;
    var index = 0;
    var checkclass = "";

    for (key in listLink) {
        if (index == 0) {
            checkclass = "ios";
        }
        else if (index == 1) {
            checkclass = "android";
        }
        else {
            checkclass = "windows";
        }
        dateAds += '<div id="' + checkclass + '">' +
                '<a class="' + checkclass + '" href="' + key + '" title="' + listLink[key] + '"></a>' +
                '<p>' + listLink[key] + '</p>' +
                '</div>';

        index++;
    }


    dateAds += '</div>' +
            '</div></div>';
    //
    $j("body").append(dateAds);
    $j(".bgtran").hide();
    $j("#app").hide();
    var adshello = sessionStorage.flag;
    if (adshello == null) {
        setTimeout(function() {
            $j(".bgtran").show();
            $j("#app").show();
        }, 2000);
    } else {
        $j(".bgtran").hide();
        $j("#app").hide();
    }
});
function closepopupads() {
    $j(".bgtran").hide();
    $j("#app").hide();
    sessionStorage.flag = "Tat roi thi thoi.Khong hien nua.";
}
;
