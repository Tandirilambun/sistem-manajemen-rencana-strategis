// Toast untuk Notifications
let getBody = document.getElementById("body-html").getAttribute("data-value");
let boolValue = getBody === "true";
document.addEventListener("DOMContentLoaded", function () {
    var toastHTMLelement = document.getElementById("liveToast");
    var toastElement = new bootstrap.Toast(toastHTMLelement);
    if (boolValue) {
        toastElement.show();
    }
});

//Modal for renstrapage if data is null
try {
    var modalElement = document.getElementById("warning-modal");
    var myModal = new bootstrap.Modal(modalElement);

    window.addEventListener("DOMContentLoaded", () => {
        myModal.show();
    });
} catch (error) {
    // pass
}

try {
    var modalElement = document.getElementById("notifModal");
    var myModal = new bootstrap.Modal(modalElement);

    window.addEventListener("DOMContentLoaded", () => {
        myModal.show();
    });
} catch (error) {
    // pass
}

try {
    var modalElement = document.getElementById("zeroModal");
    var myModal = new bootstrap.Modal(modalElement);

    window.addEventListener("DOMContentLoaded", () => {
        myModal.show();
    });
} catch (error) {
    // pass
}

//popover
var popoverTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="popover"]')
);
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
});

//Modal for renstrapage if searching is null or not found
try {
    var srchElement = document.getElementById("search-modal");
    var srchModal = new bootstrap.Modal(srchElement);

    window.addEventListener("DOMContentLoaded", () => {
        console.log("Search modal");
        srchModal.show();
    });
} catch (error) {
    //pass
}

window.onload = function () {
    let bar = document.querySelectorAll(".bar");
    bar.forEach((progress) => {
        console.log(progress);
        let value = progress.getAttribute("data-value");
        progress.style.width = `${value}%`;
        let count = 0;
        let progressAnimation = setInterval(() => {
            count++;
            progress.setAttribute("data-text", `${count}%`);
            if (count >= value) {
                clearInterval(progressAnimation);
            }
        }, 14);
    });
};

//khusus summary
window.onload = function () {
    let bar = document.querySelectorAll(".bar");
    bar.forEach((progress) => {
        let value = progress.getAttribute("data-value");
        if (value != 0) {
            progress.style.width = `${value}%`;
            let count = 0;
            let progressAnimation = setInterval(() => {
                count++;
                progress.setAttribute("data-text", `${count} %`);
                if (count >= value) {
                    clearInterval(progressAnimation);
                }
            }, 14);
        } else {
            progress.setAttribute("data-text", "0 %");
        }
    });
};

//Untuk Chart
let container_chart = document.getElementsByClassName("container-chart");

for (let index = 0; index < container_chart.length; index++) {
    let str_id = container_chart[index].children[0].getAttribute("data-id");
    let progressBar = document.getElementById("circular-progress-" + str_id);
    let valueContainer = document.getElementById("value-container-" + str_id);

    let progressValue = 0;
    let progressEndValue = document.getElementById(
        "value-container-" + str_id
    ).innerHTML;
    let speed = 14;
    let progress = setInterval(() => {
        if (progressEndValue > 0) {
            progressValue++;
            valueContainer.textContent = `${progressValue}%`;
            progressBar.style.background = `conic-gradient(
                #008800 ${progressValue * 3.6}deg,
                #80ff80 ${progressValue * 3.6}deg
    )`;
            if (progressValue == progressEndValue) {
                clearInterval(progress);
            }
        } else {
            valueContainer.textContent = `${progressValue}%`;
            progressBar.style.background = `conic-gradient(
                #008800 ${progressValue * 0}deg,
                #80ff80 ${progressValue * 0}deg
    )`;
            clearInterval(progress);
        }
    }, speed);
}

var loader = document.getElementById("custom-loader");
var overlay = document.getElementById("loading-overlay");
var msg = document.getElementById("loading-message");
window.addEventListener("load", function(){
    overlay.style.display = 'none';
    loader.style.display = 'none';
    msg.style.display = 'none';
});

