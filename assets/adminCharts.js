function manageRefererChart() {
    //doughnut
    let referer = $('#referersChart').data("referersChart");
    let refererNbr = $('#referersNbrChart').data("referersNbrChart");
    let ctxD = document.getElementById("refererChart").getContext('2d');
    let myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: referer,
            datasets: [{
                data: refererNbr,
                backgroundColor: ["#41abb5", "#688e94", "#c48a02", "#c9001b", "#78136c", "#125c12", "#a35622", "#d9bb34", "#70b82e", "#d93866", "#b8b2b2", "#fa8a29", "#ffffff", "#3912ba", "#7df2c5", "#000000", "#22624d", "#c16a4e", "#939234", "#1235b5", "#f6a2cc", "#41abb5", "#688e94", "#c48a02", "#c9001b", "#78136c", "#125c12", "#a35622", "#d9bb34", "#70b82e", "#d93866"],
                hoverBackgroundColor: ["#d1cbcb", "#91c0c7", "#e3a005", "#e6001f", "#961787", "#1a7d1a", "#a34e15", "#917b17", "#599c1c", "#9e193f", "#238f99", "#fbae6a", "#c9c9c9", "#8261ef", "#94f4d0", "#424242", "#349373", "#cb846c", "#c1bf4e", "#2a53ea", "#f8b9d9", "#d1cbcb", "#91c0c7", "#e3a005", "#e6001f", "#961787", "#1a7d1a", "#a34e15", "#917b17", "#599c1c", "#9e193f"]
            }]
        },
        options: {
            responsive: true
        }
    });
}

function managePageChart() {
    //doughnut
    let page = $('#pagesChart').data("pagesChart");
    let pageNbr = $('#pagesNbrChart').data("pagesNbrChart");
    let ctxD = document.getElementById("pageChart").getContext('2d');
    let myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: page,
            datasets: [{
                data: pageNbr,
                backgroundColor: ["#41abb5", "#688e94", "#c48a02", "#c9001b", "#78136c", "#125c12", "#a35622", "#d9bb34", "#70b82e", "#d93866", "#b8b2b2", "#fa8a29", "#ffffff", "#3912ba", "#7df2c5", "#000000", "#22624d", "#c16a4e", "#939234", "#1235b5", "#f6a2cc", "#41abb5", "#688e94", "#c48a02", "#c9001b", "#78136c", "#125c12", "#a35622", "#d9bb34", "#70b82e", "#d93866"],
                hoverBackgroundColor: ["#d1cbcb", "#91c0c7", "#e3a005", "#e6001f", "#961787", "#1a7d1a", "#a34e15", "#917b17", "#599c1c", "#9e193f", "#238f99", "#fbae6a", "#c9c9c9", "#8261ef", "#94f4d0", "#424242", "#349373", "#cb846c", "#c1bf4e", "#2a53ea", "#f8b9d9", "#d1cbcb", "#91c0c7", "#e3a005", "#e6001f", "#961787", "#1a7d1a", "#a34e15", "#917b17", "#599c1c", "#9e193f"]
            }]
        },
        options: {
            responsive: true
        }
    });
}

function manageUniquePageChart() {
    //doughnut
    let uniquePage = $('#uniquePagesChart').data("uniquePagesChart");
    let uniquePageNbr = $('#uniquePagesNbrChart').data("uniquePagesNbrChart");
    let ctxD = document.getElementById("uniquePageChart").getContext('2d');
    let myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: uniquePage,
            datasets: [{
                data: uniquePageNbr,
                backgroundColor: ["#41abb5", "#688e94", "#c48a02", "#c9001b", "#78136c", "#125c12", "#a35622", "#d9bb34", "#70b82e", "#d93866", "#b8b2b2", "#fa8a29", "#ffffff", "#3912ba", "#7df2c5", "#000000", "#22624d", "#c16a4e", "#939234", "#1235b5", "#f6a2cc", "#41abb5", "#688e94", "#c48a02", "#c9001b", "#78136c", "#125c12", "#a35622", "#d9bb34", "#70b82e", "#d93866"],
                hoverBackgroundColor: ["#d1cbcb", "#91c0c7", "#e3a005", "#e6001f", "#961787", "#1a7d1a", "#a34e15", "#917b17", "#599c1c", "#9e193f", "#238f99", "#fbae6a", "#c9c9c9", "#8261ef", "#94f4d0", "#424242", "#349373", "#cb846c", "#c1bf4e", "#2a53ea", "#f8b9d9", "#d1cbcb", "#91c0c7", "#e3a005", "#e6001f", "#961787", "#1a7d1a", "#a34e15", "#917b17", "#599c1c", "#9e193f"]
            }]
        },
        options: {
            responsive: true
        }
    });
}

function manageComputerChart() {
    //doughnut
    let computer = $('#computersChart').data("computersChart");
    let computerNbr = $('#computersNbrChart').data("computersNbrChart");
    let ctxD = document.getElementById("computerChart").getContext('2d');
    let myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: computer,
            datasets: [{
                data: computerNbr,
                backgroundColor: ["#41abb5", "#688e94", "#c48a02", "#c9001b", "#78136c", "#125c12", "#a35622", "#d9bb34", "#70b82e", "#d93866", "#b8b2b2", "#fa8a29", "#ffffff", "#3912ba", "#7df2c5", "#000000", "#22624d", "#c16a4e", "#939234", "#1235b5", "#f6a2cc", "#41abb5", "#688e94", "#c48a02", "#c9001b", "#78136c", "#125c12", "#a35622", "#d9bb34", "#70b82e", "#d93866"],
                hoverBackgroundColor: ["#d1cbcb", "#91c0c7", "#e3a005", "#e6001f", "#961787", "#1a7d1a", "#a34e15", "#917b17", "#599c1c", "#9e193f", "#238f99", "#fbae6a", "#c9c9c9", "#8261ef", "#94f4d0", "#424242", "#349373", "#cb846c", "#c1bf4e", "#2a53ea", "#f8b9d9", "#d1cbcb", "#91c0c7", "#e3a005", "#e6001f", "#961787", "#1a7d1a", "#a34e15", "#917b17", "#599c1c", "#9e193f"]
            }]
        },
        options: {
            responsive: true
        }
    });
}

$(document).ready(function() {
    manageRefererChart();
    managePageChart();
    manageUniquePageChart();
    manageComputerChart();
});