//<!-- Start of the Script

date = new Date();
hour = date.getHours();
if ((hour >= 1) && (hour <= 5)) {greeting = "Go back to bed!";}
if ((hour >= 6) && (hour <= 11)) {greeting = "Good morning!";}
if ((hour >= 12) && (hour <= 16)) {greeting = "Good afternoon!";}
if ((hour >= 17) && (hour <= 21)) {greeting = "Good evening!";}
if ((hour == 22) || (hour == 23)) {greeting = "Almost bed timeâ€¦";}
if (hour == 0) {greeting = "It's past midnight! Bed time!";}

month = date.getMonth();
if (month = 0) {month = "January";}
if (month = 1) {month = "February";}
if (month = 2) {month = "March";}
if (month = 3) {month = "April";}
if (month = 4) {month = "May";}
if (month = 5) {month = "June";}
if (month = 6) {month = "July";}
if (month = 7) {month = "August";}
if (month = 8) {month = "September";}
if (month = 9) {month = "October";}
if (month = 10) {month = "November";}
if (month = 11) {month = "December";}

day = date.getDate();
year = date.getFullYear();

document.write("Page last loaded: " + date);


//End of the Script -->