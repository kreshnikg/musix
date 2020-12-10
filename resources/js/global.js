window.fmtMSS = function (s){return(s-(s%=60))/60+(9<s?':':':0')+s}

window.getCSRFToken = function () {
    return document.head.querySelector(`meta[name="csrf-token"]`).content
}
