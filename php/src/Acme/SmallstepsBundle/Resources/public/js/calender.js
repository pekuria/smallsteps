function previousWeek(month, year) {
    var week = parseInt(document.getElementById('week_number_span').innerHTML);

    Date.prototype.getWeek = function() {
        var d = new Date(+this);
        d.setHours(0, 0, 0);
        d.setDate(d.getDate() + 4 - (d.getDay() || 7));
        return Math.ceil((((d - new Date(d.getFullYear(), 0, 1)) / 8.64e7) + 1) / 7);
    };

    var weekNumber = (new Date()).getWeek();

    if ((week - 1) > weekNumber) {
        week--;
        if (week > 52) {
            var week = 1;
            document.getElementById('week_number_span').innerHTML = week;
            //console.log(parseInt(week));
        }
        if (week < 1) {
            var week = 52;
            document.getElementById('week_number_span').innerHTML = week;
            //console.log(parseInt(week));
        }
        else
        {
            document.getElementById('week_number_span').innerHTML = week;
        }
        document.location.href = "?weekNum=" + week;
    }
}
function nextWeek($date, year) {
    var week = parseInt(document.getElementById("week_number_span").innerHTML);// = "WeekNumber" + week -1;
    week++;
    if (week > 52) {
        var week = 1;
        document.getElementById('week_number_span').innerHTML = week;

    }
    if (week < 1) {
        var week = 52;
        document.getElementById('week_number_span').innerHTML = week;
    }
    else
    {
        document.getElementById('week_number_span').innerHTML = week;
    }
    document.location.href = "?weekNum=" + week;
}

 