const express = require("express");
const app = express();
var server = app.listen("3000");
const io = require("socket.io")(server);
const bodyParser = require("body-parser");
var branches = {};
app.use(bodyParser.urlencoded({
    extended: true
}));

app.use(bodyParser.json());


app.post("/update_queue", function (req, res) {
    var params = req.body;

    if (params.branch_id in branches) {
        branches[params.branch_id].forEach(function (socket) {
            socket.emit("update_queue",params);
        });
    }

    res.send("success");
});

app.post("/calling", function (req, res) {
    var params = req.body;

    if (params.branch_id in branches) {
        branches[params.branch_id].forEach(function (socket) {
            
            socket.emit("calling", params);

        });
    }

    res.send("success");


});


io.on("connection", function (client) {

    client.on("add_to_branch", function (branch_id) {
        if (branch_id in branches) {
            branches[branch_id].push(client);
        } else {
            branches[branch_id] = [client];
        }
    });

    client.on("disconnect", function () {
        for (var branch_id in branches) {
            branch_id = branches[branch_id];
            branch_id.forEach(function (socket, index) {
                if (socket.id == client.id) {
                    branch_id.splice(index, 1);
                    return 1;
                }
            });
        }
    });

});
