const express = require("express");
const bodyParser = require("body-parser");
const app = express();
const md5 = require("md5");

app.set("view engine", "ejs");
app.use(bodyParser.urlencoded({ extended: true }));

app.get("/", (req, res) => {
  var data = {
    encrypt: ""
  };
  res.render(__dirname + "/public/index.ejs", { data });
});

app.post("/", (req, res) => {
  if (req.body.submit == "encrypt") {
    data = {
      encrypt: md5(req.body.encrypt_string)
    };
  } else {
    data = {
      encrypt: ""
    };
  }

  res.render(__dirname + "/public/index.ejs", { data });
});

app.listen(8081, "");
console.log("app listen on port 8081");
